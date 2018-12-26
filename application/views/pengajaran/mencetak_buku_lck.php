<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_buku_lck.php
// Lokasi      : application/views/pengajaran
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<p><a href="<?php echo base_url();?>pengajaran/cetakbukulck" class="btn btn-info">Kelas Lain</a></p>
<?php
echo form_open('pengajaran/cetakbukulck','class="form-horizontal" role="form"');?>
	<div class="panel panel-default">
	<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="panel-body">
	<?php
	if(!empty($page))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bagian yang dicetak</label></div><div class="col-sm-9"><select name="page" class="form-control"><option value="'.$page.'">'.$page.'</option></select></div></div>';
	}

	if (!empty($thnajaran))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><select name="thnajaran" class="form-control">';
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}
	if(!empty($kelas))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="kelas" class="form-control"><option value="'.$kelas.'">'.$kelas.'</option></select></div></div>';
	}
	if(!empty($nis))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="nis" class="form-control"><option value="'.$nis.'">'.nis_ke_nama($nis).' '.$nis.'</option></select></div></div>';
	}

	if((empty($thnajaran)) or (empty($semester)) or (empty($kelas)) or (empty($page)))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Bagian yang dicetak</label></div><div class="col-sm-9"><select name="page" class="form-control">';
	echo "<option value='LCK'>LCK</option>";
	echo "<option value='Sampul'>Sampul</option>";
	echo "<option value='Identitas sekolah'>Identitas sekolah</option><option value='Identitas Siswa'>Identitas Siswa</option><option value='Keterangan masuk sekolah'>Keterangan masuk sekolah</option><option value='Keterangan keluar sekolah'>Keterangan keluar sekolah</option><option value='Prestasi yang pernah dicapai siswa'>Prestasi yang pernah dicapai siswa</option><option value='Organisasi yang pernah diikuti siswa'>Organisasi yang pernah diikuti siswa</option></select></div></div>";

	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">';
		foreach($daftar_tapel->result_array() as $k)
		{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">';
		echo "<option value='1'>1</option>";
		echo "<option value='2'>2</option>";
	echo '</select></div></div>';
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="kelas" class="form-control">';
		foreach($daftar_kelas->result_array() as $ka)
		{
			echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
		}
		echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></p></div></div></form>';
	}
	else
	{
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
		if($page=='LCK')
		{
		$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
		echo '<p class="help-block">Silakan klik tautan cetak untuk mencetak. Kalau tidak muncul, berarti ada nilai yang belum dikunci oleh walikelas.</p>';
		$adasiswa = $ta->num_rows();
		if ($adasiswa == 0)
			{
			echo '<div class="alert alert-warning">Tidak data siswa</div>';
			}
			
		echo '<table class="table table-hover table-striped table-bordered">';
		echo '<tr align="center"><td>NIS</td><td>LCK</td><td>Sampul</td><td>Prestasi</td><td>Ket. Masuk</td><td>Ket. Keluar</td></tr>';
		$nomor = 1;
			foreach($ta->result() as $a)
			{
				echo "<tr><td>".nis_ke_nama($a->nis)."</td>";
				$nis = $a->nis;
				$adayangbelumdikunci = 0;
				$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
				foreach($tc->result() as $c)
				{
				if(empty($c->kunci))
					{
					$adayangbelumdikunci++;
					}
					
				}
				//cari id_thnajaran
				$id_thnajaran = '';
				$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
				foreach($td->result() as $d)
				{
					$id_thnajaran = $d->id;
				}
				echo '<td align="center">';
				if ($adayangbelumdikunci==0)
						{
							if($kurikulum == '2015')
							{
							?>	
								<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$a->nis;?>/akhir/2015','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a>
								<?php
							}
							else
							{
							?>	
								<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo $id_thnajaran.'/'.$semester.'/'.$a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a>
								<?php
							}

						}
				echo '</td>';
				?>
				<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/sampul/lck/<?php echo $a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a>
				</td>
				<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/prestasi/lck/<?php echo $a->nis;?>/<?php echo $thnajaran;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a>
				</td>
				<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/masuk/lck/<?php echo $a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a>
				</td>
				<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/keluar/lck/<?php echo $a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="glyphicon glyphicon-print"></span></a>
				</td>
				<?php
				echo '</tr>';
				$nomor++;
			}
		echo '</table>';
		}
		if($page=='Sampul')
		{
		if(substr($kelas,0,2) =='X-')
			{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='1' and `kelas`='$kelas' order by no_urut");
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
				{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
				}
				else
				{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/1/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}
			}
						else
			{
				echo '<div class="alert alert-warning">harus kelas X</div>';

			}
		}//akhir halaman
		if($page=='Identitas sekolah')
		{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
			?>	
			<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/2/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">CETAK <span class="glyphicon glyphicon-print"></span></a></p>
			<?php
		
		}//akhir halaman
		if($page=='Keterangan masuk sekolah')
		{
		if(substr($kelas,0,2) =='X-')
			{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='1' and `kelas`='$kelas' order by no_urut");
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
				{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
				}
				else
				{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/5/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}
			}
						else
			{
				echo '<div class="alert alert-warning">harus kelas X</div>';

			}
		}//akhir halaman
		if($page=='Keterangan keluar sekolah')
		{
		if(substr($kelas,0,4) =='XII-')
			{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelas' order by no_urut");
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
				{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
				}
				else
				{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/6/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}
			}
						else
			{
				echo '<div class="alert alert-warning">harus kelas XII</div>';

			}
		}//akhir halaman
		if($page=='Prestasi yang pernah dicapai siswa')
		{
		if(substr($kelas,0,4) =='XII-')
			{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelas' order by no_urut");
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
				{
				echo '<div class="alert alert-info">Tidak data siswa</div>';
				}
				else
				{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/7/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}
			}
						else
			{
				echo '<div class="alert alert-warning">harus kelas XII</div>';

			}
		}//akhir halaman
		if($page=='Organisasi yang pernah diikuti siswa')
		{
		if(substr($kelas,0,4) =='XII-')
			{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelas' order by no_urut");
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
				{
				echo '<div class="alert alert-info">Tidak data siswa di semester 2</div>';
				}
				else
				{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/8/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}
			}
						else
			{
				echo '<div class="alert alert-warning">harus kelas XII</div>';
			}
		}//akhir halaman
		if($page=='Identitas Siswa')
		{
		if(substr($kelas,0,2) =='X-')
			{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='1' and `kelas`='$kelas' order by no_urut");
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
				{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
				}
				else
				{
					$id_thnajaran = '';
					$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
					foreach($td->result() as $d)
					{
					$id_thnajaran = $d->id;
					}
					$id_ruang ='';
					$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
					foreach($te->result() as $e)
					{
					$id_ruang = $e->id_ruang;
					}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/3/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="glyphicon glyphicon-print"></span></a></p>
				<?php
				}
			}
						else
			{
				echo '<div class="alert alert-warning">harus kelas X</div>';
			}
		}//akhir halaman
		echo '</div></div></form>';

	}	
?>
</div>
