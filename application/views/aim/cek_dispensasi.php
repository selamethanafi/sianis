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
		$limite = $limit * 4;
		$ta = $this->db->query("select * from `siswa_proses_izin` where `token`='$token' limit $limite,4");
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
			echo '<div class="container-fluid">';
			echo '<a href="'.base_url().'aim/suratdispensasi">';
			echo '<table width="100%"><tr>';
			$no = 0;
			foreach($ta->result() as $a)
			{
				echo '<td width="45%">';
				?>
					<table width="100%"><tr align="center"><td><?php echo $baris1.'<br />'.$baris2.'<br />'.$baris3.'<br />'.$baris4.'</td></tr></table><br />';
				?>
				<table width="100%"><tr><td><p class="text-center">SURAT DISPENSASI</p></td></tr></table>
				<?php
				echo '<table><tr><td width="150">Nama Siswa</td><td>'.nis_ke_nama($a->nis).'</td></tr>
				<tr><td>Kelas</td><td>'.nis_ke_kelas_thnajaran_semester($a->nis,$thnajaran,$semester).'</td></tr>
				<tr><td>Tanggal</td><td>'.tanggal($a->tanggal).'</td></tr>
				<tr><td>Jam ke-</td><td>'.$a->jamke.'</td></tr>
				<tr><td>Dispensasi</td><td>'.$a->dispensasi.'</td></tr>
				<tr><td>Alasan</td><td>'.$a->alasan.'</td></tr>';
				echo '</table>';
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
				$kodeguru = $namaguru;
				$tanggal = $a->tanggal;
				$alasan = 'D';
				$keterangan = 'diberi dispensasi '.$a->dispensasi.' karena '.$a->alasan;
				$nis = $a->nis;
				$kembali = $a->kembali;
				$tb = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal' and `alasan`='D'");						
				if($tb->num_rows()==0)
				{
					$this->db->query("insert into `siswa_absensi` (`nis`,`tanggal`,`thnajaran`,`semester`,`alasan`,`keterangan`,`kodeguru`,`kembali`) values ('$nis','$tanggal','$thnajaran','$semester','$alasan','$keterangan','$kodeguru','$kembali')");
				}

				echo '<br /><table width="100%"><tr><td>Mengetahui,<br />Guru Piket<br /><br /><br />'.$namaguru.'</td><td><br />Siswa<br /><br /><br />'.nis_ke_nama($a->nis).'</td></tr></table>';
				echo '</td>';
				$no++;
				  if($no==1) echo '<td width="50"></td>';
				  if($no==2)
				{ echo "</tr><tr><td></td><td><br /><br /><br /><br /><br /><br /><br /><br /></td></tr><tr>";
					$no = 0;
				}
			}
			$limit++;
			?>
			</tr></table></a>
			<script>print()</script>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>aim/suratdispensasi'; // the redirect goes here

},5000);
			</script>
			<?php
		}
	}
	?>


