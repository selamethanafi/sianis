<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:38:22 WIB 
// Nama Berkas 		: form_unggah_nilai.php
// Lokasi      		: application/views/sinkronard/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="container-fluid">
<?php
$xloc = base_url().'sinkronard/formnilai';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$subjects_value_id = '';
$kelase = '';
$mapele = '';
if(empty($tahun1))
{
	$tahun1 = substr(cari_thnajaran(),0,4);
}
if(empty($semester))
{
	$semester = cari_semester();
}
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
if(!empty($tahun1))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran </label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.$c->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
if(!empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}

if(!empty($category_level_id))
{

	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">';
	echo "<select name=\"category_level_id\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$category_level_id.'">'.$category_level_id.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/10">10</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/11">11</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/12">12</option>';
	echo '</select></div></div>';
}
if(!empty($category_majors_id))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jurusan</label></div><div class="col-sm-9">';
	echo "<select name=\"category_majors_id\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	if($category_majors_id == 1)
	{
		echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'">'.$category_majors_id.' IPA</option>';
	}
	elseif($category_majors_id == 2)
	{	echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'">'.$category_majors_id.' IPS</option>';}
	elseif($category_majors_id == 3)
	{	echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'">'.$category_majors_id.' BAHASA</option>';
	}
	elseif($category_majors_id == 4)
	{	echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'">'.$category_majors_id.' KEAGAMAAN</option>';}
	else
	{	echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'">'.$category_majors_id.' JURUSAN TIDAK JELAS</option>';
	}
	echo '<option value="'.$xloc.'/'.$category_level_id.'/1">1 IPA</option>';
	echo '<option value="'.$xloc.'/'.$category_level_id.'/2">2 IPS</option>';
	echo '<option value="'.$xloc.'/'.$category_level_id.'/3">3 BAHASA</option>';
	echo '<option value="'.$xloc.'/'.$category_level_id.'/4">4 KEAGAMAAN</option>';
	echo '</select></div></div>';
}
if(!empty($category_subjects_id))
{
	$online = cek_host_ard($url_ard_unduh);
	if($online == 1)
	{
		$mysqld = koneksi_mysql($url_ard_unduh);
		if($mysqld == 'ada')
		{
			$file = file_get_contents($url_ard_unduh.'/api/subject_id_balik.php?category_subjects_id='.$category_subjects_id);
			$json = json_decode($file, true);
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran ARD</label></div><div class="col-sm-9">';
			echo "<select name=\"category_subjects_id\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
			foreach($json as $data)
			{
				echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'/'.$category_subjects_id.'">'.$data['category_subjects_name_group'].'</option>';
			}
			echo '</select></div></div>';
			$file = file_get_contents($url_ard_unduh.'/api/category_subjects_id.php?category_subjects_id='.$category_subjects_id);
			$json = json_decode($file, true);
			foreach($json as $data)
			{
				$subjects_value_id = $data['subjects_value_id'];
			}
		}
		else
		{
			echo $mysqld;
		}
	}
	else
	{
		echo '<h4 class="text-danger">Tidak terhubung ke server ARD '.$url_ard_unduh.'</h4>';
	}
}

if(!empty($id_mapel))
{
	$ta = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($ta->result() as $a)
	{
		$kelase = $a->kelas;
		$mapele = $a->mapel;
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';
		echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="'.$xloc.'/'.$category_level_id.'/'.$category_majors_id.'/'.$category_subjects_id.'/'.$id_mapel.'">'.$mapele.' '.$kelase.'</option>';
		echo '</select></div></div>';
	}
}
if(empty($tahun1))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran </label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.$c->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}
elseif(empty($category_level_id))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">';
	echo "<select name=\"category_level_id\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'">'.$category_level_id.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/10">10</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/11">11</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/12">12</option>';
	echo '</select></div></div>';
}
elseif(empty($category_majors_id))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jurusan</label></div><div class="col-sm-9">';
	echo "<select name=\"category_majors_id\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/'.$category_majors_id.'">'.$category_majors_id.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/1">1 IPA</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/2">2 IPS</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/3">3 BAHASA</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/4">4 KEAGAMAAN</option>';
	echo '</select></div></div>';
}
elseif(empty($category_subjects_id))
{
	$online = cek_host_ard($url_ard_unduh);
	if($online == 1)
	{
		$mysqld = koneksi_mysql($url_ard_unduh);
		if($mysqld == 'ada')
		{
			$file = file_get_contents($url_ard_unduh.'/api/subject_id.php?category_majors_id='.$category_majors_id.'&category_level_id='.$category_level_id);
			$json = json_decode($file, true);
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran ARD</label></div><div class="col-sm-9">';
			echo "<select name=\"category_subjects_id\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/'.$category_majors_id.'/"></option>';
			foreach($json as $data)
			{
				echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/'.$category_majors_id.'/'.$data['category_subjects_id'].'">'.$data['category_subjects_name'].' &bull; '.$data['category_subjects_group'].' &bull; '.$data['category_subjects_id'].'</option>';
			}
			echo '</select></div></div>';
		}
		else
		{
			echo $mysqld;
		}
	}
	else
	{
		echo '<h4 class="text-danger">Tidak terhubung ke server ARD '.$url_ard_unduh.'</h4>';
	}
}
elseif(empty($id_mapel))
{
	if($category_level_id == '10')
	{
		$kelas = 'X-';
	}
	elseif($category_level_id == '11')
	{
		$kelas = 'XI-';
	}
	elseif($category_level_id == '12')
	{
		$kelas = 'XII-';
	}
	else
	{
		$kelas = 'aa-';
	}
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` like '%$kelas%' order by `mapel`");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/'.$category_majors_id.'/'.$category_subjects_id.'/"></option>';
	foreach($ta->result() as $a)
	{
		$kelase = $a->kelas;
		$tb = $this->db->query("select * from `m_ruang` where `ruang`='$kelase'");
		$jurusan = '?';
		foreach($tb->result() as $b)
		{
			$jurusan = $b->category_majors_id;
		}
		if($jurusan == $category_majors_id)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$category_level_id.'/'.$category_majors_id.'/'.$category_subjects_id.'/'.$a->id_mapel.'">'.$a->mapel.' '.$kelase.'</option>';
		}

	}
	echo '</select></div></div>';
}
echo 	$subjects_value_id;

echo '</form>';
if(!empty($id_mapel))
{
	echo form_open_multipart('sinkronard/prosesunggahnilai/'.$id_mapel,'class="form-horizontal" role="form"');?>
format csv
<p>"nis","nama","ph1","ph2","ph3","ph4","ph5","ph6","ph7","ph8","ph9","ph10","pas","pengetahuan","predikat_pengetahuan","deskripsi_pengetahuan","praktik","proyek","portofolio","keterampilan","predikat_keterampilan","deskripsi_keterampilan"</p>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile" class="textfield"></p></div></div>
<p class="text-center"><input type="hidden" name="subjects_value_id" value="<?php echo $subjects_value_id;?>"><input type="hidden" name="mapel" value="<?php echo $mapele;?>"><input type="hidden" name="kelas" value="<?php echo $kelase;?>"><input type="submit" value="Unggah Berkas" class="btn btn-primary"></p></form>
<?php
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelase' and `status`='Y'");	
foreach($ta->result() as $a)
{
	$nis = 	$a->nis;
	$no_urut = $a->no_urut;
	$tada = $this->guru->Cek_Nilai($thnajaran,$semester,$mapele,$nis);
	$ada = $tada->num_rows();
	$status= 'Y';
	$pbk['thnajaran'] = $thnajaran;
	$pbk['semester'] = $semester;
	$pbk['kelas'] = $kelase;
	$pbk['nis'] = $nis;
	$pbk['mapel'] = $mapele;
	$pbk['kd_mapel'] = '';
	$pbk['no_urut'] = $no_urut;
	$pbk['status'] = $status;
	$this->guru->Add_Nilai($pbk,$ada);
}
$ta = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelase' and `mapel`='$mapele' and `status`='Y'");	
foreach($ta->result() as $a)
{
	$nis = 	$a->nis;
	$no_urut = $a->no_urut;
	echo $no_urut.' '.$nis.' '.nis_ke_nama($nis).' '.$mapele.'<br />';
}
}

echo '</div></div></div>';
