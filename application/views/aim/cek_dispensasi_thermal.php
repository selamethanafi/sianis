<?php
			require_once(APPPATH.'vendor/mike42/escpos-php/autoload.php');
			use Mike42\Escpos\Printer;
			use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
      <?php
      if(empty($token))
	{
		echo '<div class="container-fluid"><div class="well"><h2>Proses Pengajuan Dispensasi</h2>';
		echo '<div class="alert alert-danger"><h1>Galat, token kosong</h1></div>';
		echo '</div></div>
		<br /><br />';
		?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>aim/suratdispensasi'; // the redirect goes here

		},3000);
			</script>
		</body>
		</html>
		<?php
	}
	else
	{
		$ta = $this->db->query("select * from `siswa_proses_izin` where `token`='$token'");
		if($ta->num_rows() == 0)
		{
		echo '<div class="container-fluid"><div class="well"><h2>Proses Pengajuan Dispensasi</h2>';
			echo '<div class="alert alert-danger"><h1>Galat, token '.$token.' tidak ditemukan</h1></div>';	
		echo '</div></div>
		<br /><br />';
		?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>aim/suratdispensasi';
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
			$thnajaran = cari_thnajaran();
			$semester = cari_semester();
			$this->db->query("update `siswa_proses_izin` set `valid`='1' where `token`='$token'");
			foreach($ta->result() as $a)
			{
				$namasiswa = nis_ke_nama($a->nis);
				$kelas = nis_ke_kelas_thnajaran_semester($a->nis,$thnajaran,$semester);
				$tanggal = $a->tanggal;
				$jamke = $a->jamke;
				$dispensasi = $a->dispensasi;
				$alasan = $a->alasan;
				$idlink = $a->kodeguru;
				$tc = $this->db->query("select * from `tbllogin` where `idlink` = '$idlink'");
				$namaguru = '';
				foreach($tc->result() as $c)
				{
					$namaguru = $c->nama;
				}
				if(empty($namaguru))
				{
					$td = $this->db->query("select `nama`, `chat_id` from `p_pegawai` where `kd` = '$idlink'");
					foreach($td->result() as $d)
					{
						$namaguru = $d->nama;
					}
				}
				$connector = new CupsPrintConnector($nama_printer);
			        $printer = new Printer($connector);
			        $printer -> initialize();
		       	       /* Date is kept the same for testing */
		       		$date = date('D j M Y H:i:s');  
				$printer -> text("\n");	
			        $printer -> setJustification(Printer::JUSTIFY_CENTER);
			        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
			        $printer -> text("$sek_nama\n");
			        $printer -> selectPrintMode();
			        $printer -> setUnderline(1);
			        $printer -> text("Surat Dispensasi\n");
			        $printer -> setUnderline(0);
			        $printer -> feed();
			        $printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("Nama : ".$namasiswa."\n");
				$printer -> text("Kelas : ".$kelas."\n");
				$printer -> text("Tanggal : ".date_to_long_string($tanggal)."\n");
				$printer -> text("Jam pelajaran ke : ".$jamke."\n");
				$printer -> text("Dispensasi : ".$dispensasi."\n");
				$printer -> text("Alasan : ".$alasan."\n");
	        		$printer -> feed();
				$printer -> setJustification(Printer::JUSTIFY_CENTER);
			        $printer -> text("Dicetak oleh sistem, tidak memerlukan tanda tangan\n");
			        $printer -> text($date . "\n");
			        $printer -> feed(2);
			        /* Cut the receipt and open the cash drawer */
			        $printer -> cut();
			        $printer -> pulse();
			        $printer -> close();

				$kodeguru = $namaguru;
				$keterangan = 'diberi dispensasi '.$dispensasi.' karena '.$alasan;
				$nis = $a->nis;
				$kembali = $a->kembali;
				$tb = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal' and `alasan`='D'");						
				if($tb->num_rows()==0)
				{
					$this->db->query("insert into `siswa_absensi` (`nis`, `tanggal`, `thnajaran`, `semester`, `alasan`, `keterangan`, `kodeguru`, `kembali`) values ('$nis', '$tanggal', '$thnajaran', '$semester', 'D', '$keterangan', '$kodeguru', '$kembali')");
				}
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
	?>


