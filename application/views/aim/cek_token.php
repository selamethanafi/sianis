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
		<a href="<?php echo base_url();?>aim">
		<?php
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$this->db->query("update `siswa_proses_izin` set `valid`='1' where `token`='$token'");
		if($ada == 1)
		{
		?>
			<div class="kartuizin">
				<table width="100%"><tr align="center"><td><?php echo $baris1.'<br />'.$baris2.'<br />'.$baris3.'<br />'.$baris4.'</td></tr></table><br />';?>
			<p class="text-center">SURAT IZIN</p>
			<?php
			$this->load->helper('telegram');
			$thnajaran = cari_thnajaran();
			$semester= cari_semester();
			foreach($ta->result() as $a)
			{
				$nis = $a->nis;
				$alasan = $a->alasan;
				$namasiswa = nis_ke_nama($nis);
				$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
				$pesantelegram = 'Ananda '.$namasiswa.' kelas '.$kelas.' dizinkan '.$alasan;
				$fotosiswa = fotosiswa($a->nis);
				$folderfotosiswa = $this->config->item('folderfotosiswa');
				echo '<p class="text-center"><img src="'.base_url().''.$folderfotosiswa.'/'.$fotosiswa.'" width="60" class="img img-rounded"></p>';
				echo '<table width="100%"><tr><td>Nama Siswa</td><td>'.nis_ke_nama($a->nis).'</td></tr>
				<tr><td>Kelas</td><td>'.nis_ke_kelas_thnajaran_semester($a->nis,$thnajaran,$semester).'</td></tr>
				<tr><td>Tanggal</td><td>'.tanggal($a->tanggal).'</td></tr>
				<tr><td>Jam ke-</td><td>'.$a->jamke.'</td></tr>
				<tr><td>Alasan</td><td>'.$a->alasan.'</td></tr>
				<tr><td>Kembali ke Madrasah</td><td>';
				if($a->kembali == 'Y')
				{
					echo 'Ya';
				}
				else
				{
					echo 'Tidak';
				}
				echo '</td></tr></table>';
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
				echo '<br /><table width="100%"><tr><td>Mengetahui,<br />Guru Piket<br /><br /><br />'.$namaguru.'</td><td><br />Siswa<br /><br /><br />'.nis_ke_nama($a->nis).'</td></tr></table>';
				?>
				</a>
				<script>print()</script>
				<?php
				$tb = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal' and `alasan`='M'");						
				if($tb->num_rows()==0)
				{
					$this->db->query("insert into `siswa_absensi` (`nis`, `tanggal`, `thnajaran`, `semester`, `alasan`, `keterangan`, `kodeguru`, `kembali`) values ('$nis', '$tanggal', '$thnajaran', '$semester', 'M', '$keterangan', '$kode_guru', '$kembali')");
					$namasiswa = nis_ke_nama($nis);
					$nohp = cari_seluler_orangtua($nis);
					$pesan = 'Ananda '.$namasiswa.' dizinkan meninggalkan madrasah ('.$alasanizin.')';
					$kirimsms = postsms($url_sms_post,$nohp,$pesan);
					$kirimtelegram = kirimtelegram($chat_id_grup_guru,$pesantelegram,$token_bot);
				}
				?>
				<script>setTimeout(function () {
						window.location.href= '<?php echo base_url();?>aim'; // the redirect goes here

					},30000);
				</script>
				<?php
			}
		}
		else
		{
			$rombongan = '';
			$nama_pertama = '';
			foreach($ta->result() as $a)
			{
				$nis = $a->nis;
				$namasiswa = nis_ke_nama($nis);
				$alasan = $a->alasan;
				if(empty($rombongan))
				{
					$rombongan .= $namasiswa;
					$nama_pertama = $namasiswa;
				}
				else
				{
					$rombongan .= ', '.$namasiswa;
				}
				$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
				$pesan = 'Ananda '.$namasiswa.' kelas '.$kelas.' dizinkan '.$alasan;
				$kirimtelegram = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
				$chat_id = $a->kodeguru;
				$tc = $this->db->query("select * from `p_pegawai` where `chat_id` = '$chat_id'");
				$namaguru = '?';
				foreach($tc->result() as $c)
				{
					$namaguru = $c->nama;
					$kode_guru = $c->kd;
				}
				$tanggal = $a->tanggal;
				$alasan = 'M';
				$keterangan = $a->jamke.' '.$a->alasan;
				$nis = $a->nis;
				$kembali = $a->kembali;
				$alasanizin = $a->alasan;
				$tb = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal' and `alasan`='M'");						
				if($tb->num_rows()==0)
				{
					$this->db->query("insert into `siswa_absensi` (`nis`,`tanggal`,`thnajaran`,`semester`,`alasan`,`keterangan`,`kodeguru`,`kembali`) values ('$nis','$tanggal','$thnajaran','$semester$','$alasan','$keterangan','$kode_guru','$kembali')");
					$namasiswa = nis_ke_nama($nis);
					$nohp = cari_seluler_orangtua($nis);
					$pesan = 'Ananda '.$namasiswa.' dizinkan meninggalkan madrasah ('.$alasanizin.')';
					$id_sms_user = '';
					if(($this->config->item('sms')== 1) and (!empty($nohp)))
					{
						$this->Situs_model->Kirim_SMS_Umum($nohp,$pesan,$id_sms_user);
					}
				}
			}
			// mulai mencetak
			?>
			<div class="kartuizin">
				<table width="100%"><tr align="center"><td><?php echo $baris1.'<br />'.$baris2.'<br />'.$baris3.'<br />'.$baris4.'</td></tr></table><br />';?>
			<p class="text-center">SURAT IZIN</p>
			<?php
				echo '<table width="100%"><tr><td valign="top">Nama Siswa</td><td>'.$rombongan.'</td></tr>
				<tr><td>Kelas</td><td>'.nis_ke_kelas_thnajaran_semester($a->nis,$thnajaran,$semester).'</td></tr>
				<tr><td>Tanggal</td><td>'.tanggal($a->tanggal).'</td></tr>
				<tr><td>Jam ke-</td><td>'.$a->jamke.'</td></tr>
				<tr><td>Alasan</td><td>'.$a->alasan.'</td></tr>
				<tr><td>Kembali ke Madrasah</td><td>';
				if($a->kembali == 'Y')
				{
					echo 'Ya';
				}
				else
				{
					echo 'Tidak';
				}
				echo '</td></tr></table>';
				echo '<br /><table width="100%"><tr><td>Mengetahui,<br />Guru Piket<br /><br /><br />'.$namaguru.'</td><td><br />Siswa<br /><br /><br />'.$nama_pertama.'</td></tr></table>';
				?>
				<script>print()</script>
				<script>setTimeout(function () {
						window.location.href= '<?php echo base_url();?>aim'; // the redirect goes here

					},30000);
				</script>
				<?php


		}
	}
}
	?>


