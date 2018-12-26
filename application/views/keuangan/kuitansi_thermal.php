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
	<script src="<?php echo base_url();?>assets/js/jumpmenu.js"></script>
<?php
if((!empty($id)) or (!empty($idn)))
{
	if(empty($id))
	{
		$id = 'where `nis`=\'xxy\'';
	}
	if(empty($idn))
	{
		$idn = 'where `nis`=\'xx\'';
	}

	$ta = $this->db->query("select * from `siswa_bayar` $id");
	$tan = $this->db->query("select * from `non_komite_bayar` $idn");
	$ada = $ta->num_rows();
	$adan = $tan->num_rows();
	if(($ada == 0) and ($adan == 0))
	{
		echo 'data tidak ditemukan <a href="'.base_url().'keuangan/siswa">Batal</a>';
	}
	else
	{
		echo '<table width="100%"><tr><td>';
		if(!empty($baris1))
		{
			echo $baris1;
		}
		if(!empty($baris2))
		{
			echo '<br>'.$baris2;
		}
		if(!empty($baris3))
		{
			echo '<br>'.$baris3;
		}
		if(!empty($baris4))
		{
			echo '<br>'.$baris4;
		}
		if(!empty($baris5))
		{
			echo '<br>'.$baris5;
		}
		echo '
</td><td><table width="100%"><tr><td align="center">';
		$xloc = base_url().'keuangan/buku/'.$nis.'/'.$tahun1.'/'.$semester.'/'.$id2;
		echo '<form name="formx" method="post" action="'.$xloc.'">';
		?>
			<select name="kartu" onChange="MM_jumpMenu('self',this,0)">
			<option value="">KUITANSI</option>
			<?php
			for($i=0;$i<=40;$i++)
			{
				echo '<option value="'.$xloc.'/'.$i.'">'.$i.'</option>';
			}
			?>
			</select>
		</form>
		<?php
		echo '</td></tr></table></td></tr></table>';
		echo '<table width="100%"><tr><td>NIS</td><td>'.$nis.'</td></tr><tr><td>Nama</td><td>'.nis_ke_nama($nis).'</td></tr></table>';
		echo '<table width="100%" bgcolor="#ccc"><tr bgcolor="#fff" align="center"><td>Tanggal<td>Macam Pembayaran</td><td>Besar</td><td>Keterangan</td></tr>';
		$jumlah = 0;
		foreach($ta->result() as $a)
		{
			echo '<tr bgcolor="#fff"><td>'.tanggal($a->tanggal).'</td><td>'.$a->macam_pembayaran.'</td><td align="right">'.number_format($a->besar).'</td><td>'.$a->keterangan.'</td></tr>';
			$jumlah = $jumlah + $a->besar;
		}
		foreach($tan->result() as $an)
		{
			$id_non_komite = $an->id_non_komite;
			$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
			$nama_tunggakan = '';
			foreach($tg->result() as $g)
			{
				$nama_tunggakan = $g->nama_tunggakan;
			}

			echo '<tr bgcolor="#fff"><td>'.tanggal($an->tanggal).'</td><td>'.$nama_tunggakan.'</td><td align="right">'.number_format($an->besar).'</td><td>'.$an->keterangan.'</td></tr>';
			$jumlah = $jumlah + $an->besar;
		}

		echo '</table>'.xduit($jumlah).' Terbilang: '.strtolower(xduitf($jumlah)).'<br />';
		echo '<table width="100%"><tr><td width="60%"></td><td>'.$lokasi.', '.date_to_long_string(tanggal_hari_ini()).'<br />Petugas<br /><br /><br /><a href="'.base_url().'keuangan/terima/'.$nis.'">'.$namauser.'</a></td></tr></table>';
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
		foreach($tan->result() as $an)
		{
			$id_non_komite = $an->id_non_komite;
			$tg = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
			$nama_tunggakan = '';
			foreach($tg->result() as $g)
			{
				$nama_tunggakan = $g->nama_tunggakan;
			}
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$pembayaran = new item($nama_tunggakan, number_format($an->besar));
			$printer -> text($pembayaran);
			if(!empty($an->keterangan))
			{
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text($an->keterangan."\n");
			}

			$jumlah = $jumlah + $an->besar;
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
		$printer -> text($lokasi.', '.date_to_long_string(tanggal_hari_ini())."\n");
		$printer -> text("Petugas");
		$printer -> feed(3);
		$printer -> text($namauser);
		$printer -> feed(2);
		/* Cut the receipt and open the cash drawer */
		$printer -> cut();
		$printer -> pulse();
		$printer -> close();

	}
}
else
{
	echo '<p class="text-warning">Tidak ada data yang dicetak, <a href="'.base_url().'keuangan/siswa"><strong>Batal</strong></a></p>';
}
?>
</div></body></html>
