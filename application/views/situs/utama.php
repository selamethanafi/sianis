<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid"><br />
	<div class="jumbotron">
           <h1>Berita Utama</h1>
				<?php
				foreach($berita_utama->result() as $berita_top)
				{
					$isi_berita = substr(strip_tags($berita_top->isi),0,600);
					echo '<h3><a href="'.base_url().'situs/detailberita/'.$berita_top->id_berita.'">'.$berita_top->judul_berita.'</a></h3><p class="text-info">Kategori <strong>'.$berita_top->nama_kategori.'</strong> - '.date_to_long_string($berita_top->tanggal).' -|- '.$berita_top->waktu.' WIB</p>';
					if(!empty($berita_top->gambar))
					{
						echo '<img src="'.base_url().'images/berita/'.$berita_top->gambar.'" class="img img-rounded">';
					}
					$penuh = $berita_top->penuh;
					if($penuh == '1')
					{
						echo '<p class="text-justify">'.$berita_top->isi;	
					}
					else
					{
						echo '<p class="text-justify">'.$isi_berita.'</p> <strong><a href="'.base_url().'situs/detailberita/'.$berita_top->id_berita.'">[Baca Selengkapnya]</a></strong>';	
					}
				}
				?>
	</div>
	<div class="jumbotron">
           <h1>Berita Terbaru</h1>
	   <div class="row">
           <?php
	
           foreach($slide_berita->result() as $berita)
           {

		$isi_berita = substr(strip_tags($berita->isi),0,400);
		echo '
		<div class="col">
			<div class="card">
				<div class="card-header"><h4><a href="'.base_url().'situs/detailberita/'.$berita->id_berita.'">'.$berita->judul_berita.'</a></h4>
				<p class="text-info">Kategori <strong>'.$berita->nama_kategori.'</strong> - '.tanggal($berita->tanggal).' '.$berita->waktu.' WIB</p></div><div class="card-body">
				<img src="'.base_url().'images/berita/'.$berita->gambar.'" alt="" width="100" height="75" class="img img-rounded">'.$isi_berita.' <strong><a href="'.base_url().'situs/detailberita/'.$berita->id_berita.'">[Baca Selengkapnya]</a></strong>
				</div>
			</div>
		</div>';
           }
           ?>
		</div>
	</div> 
	<div class="jumbotron">
           <h1>Materi Pelajaran</h1>
	   <div class="row">
           <?php
		foreach($tampil_tutorial_acak->result() as $tutorial)
		{
			$isi_tutorial = substr(strip_tags($tutorial->isi),0,400);
		echo '
		<div class="col">
			<div class="card">
				<div class="card-header"><h4><a href="'.base_url().'situs/detailmateri/'.$tutorial->id_tutorial.'">'.$tutorial->judul_tutorial.'</a></h4>
				<p class="text-info">'.tanggal($tutorial->tanggal).' -|- '.$tutorial->waktu.' WIB</p></div><div class="card-body">'.$isi_tutorial.' ... <a href="'.base_url().'situs/detailmateri/'.$tutorial->id_tutorial.'" class="btn btn-primary"><strong>Baca</strong></a>
				</div>
			</div>
		</div>';
           }
           ?>
		</div>
	</div> 
	<div class="jumbotron">
		<div class="row">

			<div class="col">
				<div class="card">
					<div class="card-header"><h4>Kritik dan Saran</h4></div>
					<div class="card-body">
								<?php echo form_open('situs/saran','class="form-horizontal" role="form"');
								if(!empty($pesan_galat))
								{
									echo $pesan_galat;
								}
								if(!isset($nama_tamu))
									{$nama_tamu = '';}
								if(!isset($nosel_tamu))
									{$nosel_tamu = '';}
								if(!isset($saran))
								{$saran = '';}
								?>
								<p><label>Nama <span>*</span></label>
								<input class="form-control" type="text" name="nama_tamu" value="<?php echo $nama_tamu;?>" required/>
								</p>
								<p>
								<label>No HP <span>*</span></label>
								<input class="form-control" type="number" name="nosel_tamu" value="<?php echo $nosel_tamu;?>" required/>
								</p>
								<p>
								<label>Kritik / Saran / Pengaduan <span>*</span></label>
								<textarea class="form-control" rows="5" name="saran" required></textarea>
								</p>
								<?php
								$this->load->helper('captcha');
								$word = strtoupper(random_string('alnum','4'));
								$vals = array(
									'word' => $word,
									'img_path' => './captcha/',
									'img_url' => ''.base_url().'captcha/',
									'font_path'	 => $this->config->item('fonts_path').'/monaco.ttf',
									'img_width' => '130',
									'font_size' => '12',
									'img_height' => 50,
									'expiration' => 600,
									'colors'		=> array(
									'background' => array(255, 255, 255),
									'border' => array(255, 255, 255),
									'text' => array(0, 0, 0),
									'grid' => array(255, 255,150)
										)
									);
								$cap = create_captcha($vals);
								$data = array(
									'captcha_time' => $cap['time'],
									'ip_address' => $this->input->ip_address(),
									'word' => $cap['word']
									);
								$query = $this->db->insert_string('captcha', $data);
								$this->db->query($query);
								?>
								<p>
									<label for="name">Kode Keamanan</label><p><?php	echo $cap['image'];?>
									<input type="text" class="form-control" name="captcha" placeholder="kode keamanan">
								</p><p><input type="submit" value="Kirim Saran / Kritik / Aduan" class="btn btn-primary"></p></form>

					</div>					
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Pengguna Facebook</h4></div>
					<div class="body">
						<div class="fb-comments" data-href="<?php echo base_url();?>" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Tautan Penting</h4></div>
					<div class="body">
						<?php $tt = $this->db->query("select * from tbltautan order by no_urut");?>
						<ul>
							<?php foreach($tt->result() as $a)
							{
								echo '<li><a href="'.$a->url.'">'.$a->teks.'</a></li>';
							}
							?>
						</ul>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Siswa Terlambat Hari Ini</h4></div>
					<div class="body">
						<?php
						foreach($tidakmasuk->result() as $dtm)
						{
							$nis = $dtm->nis;
							$thnajaran = cari_thnajaran();
							$semester = cari_semester();
							$namasiswa = nis_ke_nama($nis);
							$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
							if ($dtm->alasan=='T')
							{
								echo '<strong> '.$namasiswa."</strong> ".$kelas.", &nbsp;";
							}
						}
						?>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Siswa Tidak Hadir Hari Ini</h4></div>
					<div class="body">
						<?php
						foreach($tidakmasuk->result() as $dtm)
						{
							$nis = $dtm->nis;
							$nis = $dtm->nis;
							$thnajaran = cari_thnajaran();
							$semester = cari_semester();
							$namasiswa = nis_ke_nama($nis);
							$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
							if (($dtm->alasan=='S') or ($dtm->alasan=='I') or ($dtm->alasan=='B') or ($dtm->alasan=='A'))
								echo '<strong> '.$namasiswa."</strong> ".$kelas." (".$dtm->alasan."), &nbsp;";
						}
						?>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>KBM Hari Ini</h4></div>
					<div class="body">
						<?php
						$tanggalhariini = tanggal_hari_ini();
						$tkbm = $this->db->query("select * from `guru_rph_ringkas` where `tanggal`='$tanggalhariini'");
						foreach($tkbm->result() as $kbm)
						{
							$kode_rpp = $kbm->kode_rpp;
							$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
							$rencana ='';
							foreach($trpp->result() as $rpp)
							{
								$rencana = $rpp->rencana;
							}
							echo '<br /><strong>'.$kbm->kelas.' '.$kbm->mapel.'</strong> '.strip_tags(preg_replace("/&nbsp;/"," ",$rencana));
						}
						?>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-header"><h4>Pengumuman</h4></div>
						<?php
						foreach($pengumuman->result() as $umum)
						{
						?>
							<!-- Modal -->
							<div class="modal fade" id="myModalpengumuman<?php echo $umum->id_pengumuman;?>">
								<div class="modal-dialog">
								      <!-- Modal content-->
									<div class="modal-content">
									        <div class="modal-header">
										          <h4 class="modal-title"><?php echo $umum->judul_pengumuman;?></h4><button type="button" class="close" data-dismiss="modal">&times;</button>
									        </div>
									        <div class="modal-body">
											<?php
											echo '<p>Diterbitkan pada tanggal : '.date_to_long_string($umum->tanggal).' oleh '.$umum->nama.'<p class="text-info">'.$umum->isi.'</p>';
											?>
										</div>
									        <div class="modal-footer">
										          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
									        </div>
									</div>
							        </div>
				                        </div>
							<!-- akhir modal -->
							<hr>
							<div class="card-body">
								<?php
								$isi=substr(strip_tags($umum->isi),0,150);
								$ptng_isi=nl2br($isi);
								echo '<h5>'.$umum->judul_pengumuman.'</h5>'.date_to_long_string($umum->tanggal).' - oleh <strong>'.$umum->nama.'</strong><br />'.$ptng_isi.'.... '?>
								<a href="#" data-toggle="modal" data-target="#myModalpengumuman<?php echo $umum->id_pengumuman;?>" class="btn btn-info">Lihat</a>
							</div>
							<?php

						}
						?>
						<div class="card-body">
						<br /><a href="<?php echo base_url(); ?>situs/pengumuman" class="btn btn-primary"><i class="fa fa-bullhorn"></i> Lihat Semua Pengumuman </a>
						</div>
					</div>
				</div>
			<div class="col">
				<div class="card">
					<div class="card-header"><h4>Pencarian</h4>
						<div class="card-body">
							<form method="post" action="<?php echo base_url(); ?>situs/pencarian">
							<p><label>Keyword</label><input name="katakunci" type="text" class="form-control"></p>
							<p><label>Kategori</label><select name="pencarian" class="form-control"><option value="berita">Berita</option>
								<option value="profil">Profil</option>
								<option value="pengumuman">Pengumuman</option>
								<option value="agenda">Agenda Madrasah</option>
								<option value="tutorial">Materi Pelajaran</option>
								</select></p><p class="text-center"><input type="submit" value="Cari" class="btn btn-primary"> <input type="reset" value="Hapus" class="btn btn-info"/></p></form>
						</div>
					</div>
				</div>
				<hr>
				<div class="card">	
					<div class="card-header"><h4>Jajak Pendapat</h4>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo base_url(); ?>situs/hasilpolling" class="form-horizontal" role="form">
						<?php
						if($soal_polling->num_rows()>0)
						{
							foreach($soal_polling->result_array() as $soal)
							{
								echo "<input type='hidden' name='id_soal' value='".$soal['id_soal_poll']."'>";
								echo $soal['soal_poll'];
							}
							foreach($jawaban_polling->result() as $jawaban)
							{
								echo '<p><input type="radio" name="polling" value="'.$jawaban->id_jawaban_poll.'"> ';
								echo $jawaban->jawaban;
								echo "</p>";
							}
							?>
							<p class="text-center"><input type="submit" value="Pilih dan Vote" class="btn btn-primary"/> <a href="<?php echo base_url(); ?>situs/lihathasil" class="btn btn-info">Lihat Hasil Polling</a></p></form>
						<?php
						}
						else
						{
							echo 'belum ada jajak pendapat';
						}?>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Agenda <?php echo $this->config->item('sek_tipe');?></h4>
					</div>
					<div class="card-body">
						<ul>
							<?php
							foreach($agenda->result() as $agenda)
							{
								$tema =$agenda->tema_agenda;
								$tanggal = date_to_long_string($agenda->tgl_posting);
								$deskripsi = $agenda->isi;
								$tanggalmulai = date_to_long_string($agenda->tgl_mulai);
								$tanggalsampai = date_to_long_string($agenda->tgl_selesai);
								$tempat = $agenda->tempat;
								$waktu = $agenda->jam;
								$keterangan = $agenda->keterangan;
								?>
								<!-- Modal -->
								<div class="modal fade" id="myModal<?php echo $agenda->id_agenda;?>" role="dialog">	
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"><?php echo $agenda->tema_agenda;?></h4> <button type="button" class="close" data-dismiss="modal">&times;</button>
										        </div>
											<div class="modal-body">
											          <?php
												echo '<p>Pelaksanaan : </p><p class="text-info">'.$tanggal.' </p> <p>Kegiatan : </p><p class="text-info">'.$deskripsi.'</p><p>Tanggal </p><p class="text-info">'.$tanggalmulai.' s.d. '.$tanggalsampai.'</p><p>Tempat : </p><p class="text-info">'.$tempat.'</p><p>Waktu : </p><p class="text-info">'.	$waktu.'</p><p>Keterangan : </p><p class="text-info">'.$keterangan.'</p>';?>
										        </div>
										        <div class="modal-footer">
											          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
										        </div>
									 	</div>
      									</div>
								</div>
								 <?php
								echo '<li><p>'.$agenda->tema_agenda.' <a href="#" data-toggle="modal" data-target="#myModal'.$agenda->id_agenda.'" class="btn btn-info">Lihat</a></p></li>';
							}
							?>
						</ul>
						<p class="text-center"><a href="<?php echo base_url(); ?>situs/agenda" class="btn btn-primary"><i class="fa fa-bullhorn"></i> Lihat Semua Agenda</a></p>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Daftar Ketidakhadiran Siswa</h4>
					</div>
					<div class="card-body">
						<?php
						foreach($tidakmasuk2->result() as $dtm2)
						{
							$nis = $dtm2->nis;
							$thnajaran = cari_thnajaran();
							$semester = cari_semester();
							$namasiswa = nis_ke_nama($nis);
							$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
							echo '<strong> '.$nis."</strong> ".$kelas." (".$dtm2->alasan."), &nbsp;";
						}
						?>
						<p class="text-center"><a href="<?php echo base_url(); ?>situs/daftarabsen/" class="btn btn-primary"><i class="fa fa-bullhorn"></i> Lihat Daftar Ketidakhadiran</a></p>

					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-header"><h4>Flag Counter</h4>
					</div>
					<div class="card-body">
						<a href="http://s04.flagcounter.com/more/vKIc"><img src="https://s04.flagcounter.com/count2/vKIc/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Free counters!" border="0"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
