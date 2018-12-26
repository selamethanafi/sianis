<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_buku_lck.php
// Lokasi      : application/views/pengajaran
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$pesan = '';
$xloc = base_url().''.$usere.'/cetakbukurapor';
if($page == 1)
{
	$item = 'Sampul';
	$semester = 1;
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas X</p></div>';
}
elseif($page == 2)
{
	$item = 'Rapor K13 sebelum permen 53/2015';
}
elseif($page == 9)
{
	$item = 'Rapor K13 permen 53/2015';
}
elseif($page == 10)
{
	$item = 'Rapor KTSP';
}

elseif($page== 3)
{
	$item =	'Identitas sekolah';
	$semester = 1;
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas X Semester 1</p></div>';
}
elseif($page== 4)
{
	$item =	'Identitas Siswa';
	$semester = 1;
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas X Semester 1</p></div>';
}
elseif($page== 5)
{
	$item =	'Keterangan masuk sekolah';
	$semester = 1;
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas X Semester 1</p></div>';
}
elseif($page== 6)
{
	$item =	'Keterangan keluar sekolah';
	$semester = 2;
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas XII Semester 2</p></div>';
}
elseif($page== 7)
{
	$item =	'Prestasi yang pernah dicapai siswa';
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas XII Semester 2</p></div>';
	$semester = 2;
}
elseif($page== 8)
{
	$item =	'Organisasi yang pernah diikuti siswa';
	$pesan = '<div class="alert alert-info"><p class="text-warning">Khusus Kelas XII</p></div>';
	$semester = 2;
}
else
{
	$item = '';
}
if($tahun1 > 0)
{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
}
else
{
	$thnajaran = '';
}

$kelasx= '';
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo $pesan;?>
<form name="formx" method="post" action="<?php echo $xloc;?>" class="form-horizontal" role="form">
	<?php
	if(!empty($item))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().$usere.'/cetakbukurapor" title="Cetak yang lain">Bagian yang dicetak</a></label></div><div class="col-sm-9"><select name="page" class="form-control"><option value="'.$page.'">'.$item.'</option></select></div></div>';
	}
	if (!empty($tahun1))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().$usere.'/cetakbukurapor/'.$page.'" title="Ganti Tahun Pelajaran">Tahun Pelajaran</a></label></div><div class="col-sm-9"><select name="tahun1" class="form-control">';
		echo "<option value='".$tahun1."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().$usere.'/cetakbukurapor/'.$page.'/'.$tahun1.'" title="Ganti Semester">Semester</a></label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}
	if(!empty($id_walikelas))
	{
		$ta = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
		foreach($ta->result() as $a)
		{
			$kelasx = $a->kelas;
		}
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().$usere.'/cetakbukurapor/'.$page.'/'.$tahun1.'/'.$semester.'" title="Ganti Kelas">Kelas</a></label></div><div class="col-sm-9"><select name="id_walikelas" class="form-control"><option value="'.$id_walikelas.'">'.$kelasx.'</option></select></div></div>';
	}

	if(empty($item))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Bagian yang dicetak</label></div><div class="col-sm-9"><select name="page" onChange="MM_jumpMenu('self',this,0)" class="form-control">
			<option value=""></option>
			<option value="<?php echo $xloc;?>/1">Sampul</option>
			<option value="<?php echo $xloc;?>/2">Rapor K13 sebelum permen 53/2015</option>
			<option value="<?php echo $xloc;?>/9">Rapor K13 permen 53/2015</option>
			<option value="<?php echo $xloc;?>/10">Rapor KTSP</option>
			<option value="<?php echo $xloc;?>/3">Identitas sekolah</option>
			<option value="<?php echo $xloc;?>/4">Identitas Siswa</option>
			<option value="<?php echo $xloc;?>/5">Keterangan masuk sekolah</option>
			<option value="<?php echo $xloc;?>/6">Keterangan keluar sekolah</option>
			<option value="<?php echo $xloc;?>/7">Prestasi yang pernah dicapai siswa</option>
			<option value="<?php echo $xloc;?>/8">Organisasi yang pernah diikuti siswa</option>
			</select>
		</div></div>
		<?php
	}
	elseif(empty($tahun1))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'">'.$thnajaran.'</option>';
		foreach($daftar_tapel->result() as $k)
		{
			echo '<option value="'.$xloc.'/'.$page.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
		}
		echo '</select></div></div>';
	}
	elseif(empty($semester))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		if($semester == 1)
		{
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/2">2</option>';
		}
		elseif($semester == 2)
		{
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/1">1</option>';
		}
		else
		{
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/1">1</option>';
			echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/2">2</option>';
		}

		echo '</select></div></div>';
	}
	elseif(empty($id_walikelas))
	{
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$kelasx.'</option>';
		if($page == 1)
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester'");
			foreach($ta->result() as $a)
			{
				if(substr($a->kelas,0,2) == 'X-')
				{
					echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
				}
			}
		}
		if($page == 2)
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester' and `kurikulum`='2013'");
			foreach($ta->result() as $a)
			{
				echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
			}
		}
		if($page == 9)
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester' order by `kelas`");
			foreach($ta->result() as $a)
			{
				if(($a->kurikulum == '2015') or ($a->kurikulum == '2018'))
				{
					echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
				}
			}
		}
		if($page == 10)
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester' ");
			foreach($ta->result() as $a)
			{
				if($a->kurikulum == 'KTSP')
				{
					echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
				}
			}
		}

		if(($page == 3) or ($page == 4) or ($page == 5))
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester'");
			foreach($ta->result() as $a)
			{
				if(substr($a->kelas,0,2) == 'X-')
				{
					echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
				}
			}
		}
		if(($page == 6) or ($page == 7))
		{
			$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester'");
			foreach($ta->result() as $a)
			{
				if(substr($a->kelas,0,4) == 'XII-')
				{
					echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
				}
			}
		}

		echo '</select>Kalau tidak ada kelas, cek data walikelas dan kurikulum</div></div>';
	}

	else
	{
		$kurikulum = cari_kurikulum($thnajaran,$semester,$kelasx);
		if($page=='1')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
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
				$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelasx'");
				foreach($te->result() as $e)
				{
					$id_ruang = $e->id_ruang;
				}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/1/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="fa fa-print"></span></a></p>
				<?php
			}
		}//akhir sampul

		// LCK
		if($page=='2')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
			
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
			{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
			}
			echo '<table class="table table-hover table-striped table-bordered">';
			echo '<tr align="center"><td>Nama</td><td>Mapel Belum dikunci</td><td>Cetak PDF</td><td>Cetak HTML</td></tr>';
			$nomor = 1;
			foreach($ta->result() as $a)
			{
				echo "<tr><td>".nis_ke_nama($a->nis)."</td>";
				$nis = $a->nis;
				$adayangbelumdikunci = 0;
				$mapel = '';
				$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y' ");
				foreach($tc->result() as $c)
				{
					if($c->kunci != 1)
					{
						$adayangbelumdikunci++;
						$mapel .= ' '.$c->mapel;
					}
					
				}
				//cari id_thnajaran
				$id_thnajaran = '';
				$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
				foreach($td->result() as $d)
				{
					$id_thnajaran = $d->id;
				}
				echo '<td>'.$adayangbelumdikunci.' '.$mapel.'</td>';
					if($kurikulum == '2015')
					{
// /bukulck/2016/2/1422/akhir/2013
						?>	
						<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>/akhir/2015','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
						<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?><?php echo $usere;?>/rapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/akhir/2015';?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
						<?php
					}
					elseif($kurikulum == '2013')
					{
						?>	
						<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>/akhir/2013','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?><?php echo $usere;?>/rapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/akhir/'.$kurikulum;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
						<?php
					}
					else
					{


					}
				echo '</tr>';
				$nomor++;
			}
			echo '</table>';
		} // akhir lck
		if($page=='3')
		{
			$id_thnajaran = '';
			$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
			foreach($td->result() as $d)
			{
				$id_thnajaran = $d->id;
			}
			$id_ruang ='';
			$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelasx'");
			foreach($te->result() as $e)
			{
				$id_ruang = $e->id_ruang;
			}
		?>	
		<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/2/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">CETAK <span class="fa fa-print"></span></a></p>
		<?php
		}//akhir halaman
		if($page=='4')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
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
				$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelasx'");
				foreach($te->result() as $e)
				{
					$id_ruang = $e->id_ruang;
				}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/3/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="fa fa-print"></span></a></p>
				<?php
			}
		}//akhir halaman
		if($page=='5')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
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
				$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelasx'");
				foreach($te->result() as $e)
				{
					$id_ruang = $e->id_ruang;
				}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/5/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="fa fa-print"></span></a></p>
				<?php
			}
		}//akhir halaman
		if($page=='6')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelasx' order by no_urut");
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
				$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelasx'");
				foreach($te->result() as $e)
				{
					$id_ruang = $e->id_ruang;
				}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/6/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak tanpa tanda tangan<span class="fa fa-print"></span></a> <a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/6/<?php echo $id_thnajaran.'/'.$id_ruang;?>/1','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak dengan tanda tangan <span class="fa fa-print"></span></a></p>
				<?php
			}
		}//akhir halaman
		if($page=='7')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
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
				$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelasx'");
				foreach($te->result() as $e)
				{
					$id_ruang = $e->id_ruang;
				}
				?>	
				<p class="text-center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/lck/7/<?php echo $id_thnajaran.'/'.$id_ruang;?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-primary">Cetak <span class="fa fa-print"></span></a></p>
				<?php
			}
		}//akhir halaman
		if($page=='9')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
			
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
			{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
			}
			echo '<table class="table table-hover table-striped table-bordered">';
			echo '<tr align="center"><td>Nama</td><td>Mapel Belum dikunci</td><td>Cetak PDF</td><td>Cetak HTML</td></tr>';
			$nomor = 1;
			foreach($ta->result() as $a)
			{
				echo "<tr><td>".nis_ke_nama($a->nis)."</td>";
				$nis = $a->nis;
				$adayangbelumdikunci = 0;
				$mapel = '';
				$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
				foreach($tc->result() as $c)
				{
					if($c->kunci != 1)
					{
						$adayangbelumdikunci++;
						$mapel .= ' '.$c->mapel;
					}
					
				}
				//cari id_thnajaran
				$id_thnajaran = '';
				$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
				foreach($td->result() as $d)
				{
					$id_thnajaran = $d->id;
				}
				echo '<td>'.$adayangbelumdikunci.' '.$mapel.'</td><td align="center">';
						?>	
						<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukulck/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>/akhir/<?php echo $kurikulum;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a>
<td align="center"><a href="javascript:;"  onClick="window.open('<?php echo base_url();?><?php echo $usere;?>/rapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis.'/akhir/'.$kurikulum;?>/akhir/2015','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a></td>
						<?php
				echo '</tr>';
				$nomor++;
			}
			echo '</table>';
		} // akhir lck
		if($page=='10')
		{
			$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasx' order by no_urut");
			
			$adasiswa = $ta->num_rows();
			if ($adasiswa == 0)
			{
				echo '<div class="alert alert-warning">Tidak data siswa</div>';
			}
			echo '<table class="table table-hover table-striped table-bordered">';
			echo '<tr align="center"><td>Nama</td><td>Mapel Belum dikunci</td><td>Cetak</td></tr>';
			$nomor = 1;
			foreach($ta->result() as $a)
			{
				echo "<tr><td>".nis_ke_nama($a->nis)."</td>";
				$nis = $a->nis;
				$adayangbelumdikunci = 0;
				$mapel = '';
				$tc = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `status`='Y'");
				foreach($tc->result() as $c)
				{
					if($c->kunci != 1)
					{
						$adayangbelumdikunci++;
						$mapel .= ' '.$c->mapel;
					}
					
				}
				//cari id_thnajaran
				$id_thnajaran = '';
				$td = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
				foreach($td->result() as $d)
				{
					$id_thnajaran = $d->id;
				}
				echo '<td>'.$adayangbelumdikunci.' '.$mapel.'</td><td align="center">';
						?>	
						<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/bukurapor/<?php echo substr($thnajaran,0,4).'/'.$semester.'/'.$a->nis;?>','yes','scrollbars=yes,width=550,height=400')"><span class="fa fa-print"></span></a>
						<?php
				echo '</td></tr>';
				$nomor++;
			}
			echo '</table>';
		} // akhir lck

	}
	?>

</form>

</div></div></div>

