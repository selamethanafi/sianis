<?php
			require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php');
			use Mike42\Escpos\Printer;
			use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <?php
if(empty($token))
{
	echo '<div class="container-fluid"><div class="well"><h2>Proses Pengajuan Izin Meninggalkan Madrasah</h2>';
	echo '<div class="alert alert-danger"><h1>Galat, token kosong</h1></div>';
	echo '</div></div>
	<br /><br />';
	?>
		<script>setTimeout(function () {
		window.location.href= '<?php echo base_url();?>aim/token'; // the redirect goes here

		},3000);
		</script>
	</body>
	</html>
	<?php
}
else
{
	$ta = $this->db->query("select * from `siswa_proses_izin` where `token`='$token'");
	$ada = $ta->num_rows();
	if($ta->num_rows() == 0)
	{
		echo '<div class="container-fluid"><div class="well"><h2>Proses Pengajuan Izin Meninggalkan Madrasah</h2>';
			echo '<div class="alert alert-danger"><h1>Galat, token '.$token.' tidak ditemukan</h1></div>';	
		echo '</div></div>
		<br /><br />';
		?>
		<script>setTimeout(function () {
		window.location.href= '<?php echo base_url();?>aim/token';
		},3000);
			</script>
		</body>
		</html>
		<?php
		echo '</body>
		</html>';


	}
	else
	{
		?>
		<?php
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$this->db->query("update `siswa_proses_izin` set `valid`='1' where `token`='$token'");
		$this->load->helper('telegram');
		$thnajaran = cari_thnajaran();
		$semester= cari_semester();
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			$alasan = $a->alasan;
			$namasiswa = nis_ke_nama($nis);
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$pesan = 'Ananda '.$namasiswa.' kelas '.$kelas.' dizinkan '.$alasan;
			$connector = new CupsPrintConnector($nama_printer);
			$printer = new Printer($connector);
			$printer -> initialize();
			/* Date is kept the same for testing */
		       	$date = date('D j M Y H:i:s');  
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			$printer -> text("$sek_nama\n");
			$printer -> selectPrintMode();
			$printer -> setUnderline(1);
			$printer -> text("Surat Izin Meninggalkan Madrasah\n");
			$printer -> setUnderline(0);
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$printer -> text("Nama : ".$namasiswa."\n");
			$printer -> text("Kelas : ".$kelas."\n");
			$printer -> text("Tanggal : ".date_to_long_string($a->tanggal)."\n");
			$printer -> text("Jam pelajaran ke : ".$a->jamke."\n");
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			if($a->kembali == 'Y')
			{
				$printer -> text("diizinkan meninggalkan madrasah");
				$printer -> feed();
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("untuk keperluan $alasan.\n\nSetelah selesai, siswa kembali ke madrasah.\n");
			}
			else
			{
				$printer -> text("diizinkan pulang\n");
				$printer -> feed();
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("karena $alasan.\n");
			}
			$printer-> feed();	
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text("Dicetak oleh sistem, tidak memerlukan tanda tangan\n");
			$printer -> text($date . "\n");
			$printer -> feed(2);
			/* Cut the receipt and open the cash drawer */
			$printer -> cut();
			$printer -> pulse();
			$printer -> close();
			$chat_id = $a->kodeguru;
			$tc = $this->db->query("select * from `p_pegawai` where `kd` = '$chat_id'");
			$namaguru = '?';
			foreach($tc->result() as $c)
			{
				$namaguru = $c->nama;
				$kode_guru = $c->kd;
			}
			if($namaguru == '?')
			{
				$td = $this->db->query("select * from `tbllogin` where `idlink` = '$chat_id'");
				foreach($td->result() as $d)
				{
					$namaguru = $d->nama;
					$kode_guru = $d->username;
				}
			}
			$tanggal = $a->tanggal;
			$keterangan = $a->jamke.' '.$a->alasan;
			$nis = $a->nis;
			$kembali = $a->kembali;
			$alasanizin = $a->alasan;
			$tb = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal' and `alasan`='M'");						
			if($tb->num_rows()==0)
			{
				$this->db->query("insert into `siswa_absensi` (`nis`, `tanggal`, `thnajaran`, `semester`, `alasan`, `keterangan`, `kodeguru`, `kembali`) values ('$nis','$tanggal','$thnajaran','$semester', 'M', '$keterangan', '$kode_guru', '$kembali')");
				$namasiswa = nis_ke_nama($nis);
				$nohp = cari_seluler_orangtua($nis);
				$pesan = 'Ananda '.$namasiswa.' dizinkan meninggalkan madrasah ('.$alasanizin.')';
				$kirimsms = postsms($url_sms_post,$nohp,$pesan);
			}
			echo 'Silakan ambil surat';
			?>
			<script>setTimeout(function () {
				window.location.href= '<?php echo base_url();?>aim'; // the redirect goes here
				},1000);
			</script>
			<?php
		}
	}
}
	?>


