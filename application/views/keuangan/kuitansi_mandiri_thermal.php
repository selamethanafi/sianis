<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
		class item
		{
		 	private $name;
		 	private $price;
		 	private $dollarSign;
		 	public function __construct($name = '', $price = '', $dollarSign = false)
		 	{
			$this -> name = $name;
			$this -> price = $price;
			$this -> dollarSign = $dollarSign;
			}
	
			public function __toString()
			{
				$rightCols = 10;
				$leftCols = 38;
				if ($this -> dollarSign) 
				{
					$leftCols = $leftCols / 2 - $rightCols / 2;
				}
				$left = str_pad($this -> name, $leftCols) ;
				$sign = ($this -> dollarSign ? '$ ' : '');
				$right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
				return "$left$right\n";
			 }
		}
			require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php');
			use Mike42\Escpos\Printer;
			use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
?>

<?php
if((!empty($tanggal)) and (!empty($nis)))
{
	$ta = $this->db->query("select * from `siswa_bayar` where `tanggal`='$tanggal' and `nis`='$nis'");
	$ada = $ta->num_rows();
	if($ada == 0)
	{
		echo 'data tidak ditemukan <a href="'.base_url().'keuangan/siswa">Batal</a>';
	}
	else
	{
		$namasiswa = nis_ke_nama($nis);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		$connector = new CupsPrintConnector($nama_printer_pembayaran);
		$printer = new Printer($connector);
		$printer -> initialize();
		$date = date('D j M Y H:i:s');
		$printer -> feed();
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer -> text("Komite Madrasah\n".$sek_nama."\n");
		$printer -> selectPrintMode();
		$printer -> setUnderline(1);
		$printer -> text("Kuitansi Pembayaran\n");
		$printer -> setUnderline(0);
		$printer -> feed();

		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> text("Nama : ".$namasiswa."\n");
		$printer -> text("Kelas : ".$kelas."\n");
		$printer -> feed();
		$jumlah = 0;
		foreach($ta->result() as $a)
		{
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$pembayaran = new item($a->macam_pembayaran, number_format($a->besar));
			$printer -> text($pembayaran);
			if(!empty($a->keterangan))
			{
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("* ".$a->keterangan."\n");
			}
			$jumlah = $jumlah + $a->besar;
		}
		$printer -> setJustification(Printer::JUSTIFY_RIGHT);
		$printer -> setEmphasis(true);
		$printer -> text("Jumlah ".xduit($jumlah)."\n");
		$printer -> setEmphasis(false);
		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$terbilang = strtolower(xduitf($jumlah));
		$terbilang = preg_replace("/  /"," ", $terbilang);
		$terbilang = preg_replace("/ribu  rupiah/","ribu rupiah", $terbilang);
		$terbilang = preg_replace("/ratus  ribu/","ratus ribu", $terbilang);
		$printer -> text("Terbilang: ".$terbilang."\n");
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text($lokasi.', '.date_to_long_string($tanggal)."\n");
		$printer -> text("Petugas");
		$printer -> feed(3);
		$printer -> text($namauser);
		$printer -> feed(2);
		/* Cut the receipt and open the cash drawer */
		$printer -> cut();
		$printer -> pulse();
		$printer -> close();

			?>
			<script>setTimeout(function () {
				window.location.href= '<?php echo base_url();?>keuangan/aim'; // the redirect goes here
				},1000);
			</script>
			<?php


	}
}
else
{
	echo '<p class="text-warning">Tidak ada data yang dicetak, <a href="'.base_url().'keuangan/siswa"><strong>Batal</strong></a></p>';
}
?>
</div></body></html>
