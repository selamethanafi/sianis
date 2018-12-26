<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
      <?php
      if(empty($tokenmd5))
	{
		echo '<div class="container-fluid"><div class="well"><h2>Proses Pengajuan Izin Meninggalkan Madrasah</h2>';
		echo '<div class="alert alert-danger">Galat, token kosong</div>';
		echo '<p class="text-center"><a href="'.base_url().'aim/token" class="btn btn-primary btn-lg">Coba Lagi</a></p>';
		echo '</div></div>
		<br /><br />
		</body>
		</html>';
	}
	else
	{
		$ta = $this->db->query("select * from `siswa_proses_izin` where `tokenmd5`='$tokenmd5'");
		if($ta->num_rows() == 0)
		{
		echo '<div class="container-fluid"><div class="well"><h2>Proses Pengajuan Izin Meninggalkan Madrasah</h2>';
			echo '<div class="alert alert-danger">Galat, tidak ditemukan</div>';	
		echo '<p class="text-center"><a href="'.base_url().'aim/token" class="btn btn-primary btn-lg">Coba Lagi</a></p>';
		echo '</div></div>
		<br /><br />
		</body>
		</html>';


		}
		else
		{
			$thnajaran = cari_thnajaran();
			$semester = cari_semester();
			?>
			<div class="kartuizin">
				<table width="100%"><tr align="center"><td><?php echo $this->config->item('baris1').'<br />'.$this->config->item('baris2').'<br />'.$this->config->item('baris3').'<br />'.$this->config->item('baris4').'</td></tr><table><br />';
			?>
			<p class="text-center">SURAT IZIN</p>
			<?php
			foreach($ta->result() as $a)
			{
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
				echo '</td></tr><table>';
				if(substr($a->kode_guru,0,2) == '08')
				{
					$idlink = $a->kode_guru;
					$tc = $this->db->query("select * from `tbllogin` where `idlink` = '$idlink'");
					$namaguru = '';
					foreach($tc->result() as $c)
					{
						$namaguru = $c->nama;
					}
				}
				else
				{
					$namaguru = cari_nama_pegawai($a->kode_guru);
				}
				$tanggal = $a->tanggal;
				$kode_guru = $a->kode_guru;
				$alasan = 'M';
				$keterangan = $a->jamke.' '.$a->alasan;
				$nis = $a->nis;
				$kembali = $a->kembali;
				$alasanizin = $a->alasan;
			}
			$tb = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal' and `alasan`='M'");						
			if($tb->num_rows()==0)
			{
				$this->db->query("insert into `siswa_absensi` (`nis`,`tanggal`,`thnajaran`,`semester`,`alasan`,`keterangan`,`kode_guru`,`kembali`) values ('$nis','$tanggal','$thnajaran','$semester$','$alasan','$keterangan','$kode_guru','$kembali')");
				$sms = $this->config->item('sms');
				if($sms == 1)
				{
						$nohp = cari_seluler_orangtua($nis);
						$namasiswa = nis_ke_nama($nis);
						$pesan = 'Ananda '.$namasiswa.' izin meninggalkan madrasah ('.$alasanizin.')';
						$id_sms_user = $this->config->item('id_sms_user');
						if(!empty($nohp))
						{
							$this->load->model('Situs_model');
							$this->Situs_model->Kirim_SMS_Umum($nohp,$pesan,$id_sms_user);
						}


				}
			}
			echo '<br /><table width="100%"><tr><td>Mengetahui,<br />Guru Piket<br /><br /><br />'.$namaguru.'</td><td><br />Siswa<br /><br /><br />'.nis_ke_nama($a->nis).'</td></tr></table>';

			?>
			<script>print();</script>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>aim'; // the redirect goes here

},30000);
			</script>
			<?php
		}
	}
	?>


