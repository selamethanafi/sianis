<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:37:29 WIB 
// Nama Berkas 		: form_unggah_catatan_walikelas.php
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
$xloc = base_url().'sinkronard/formwalikelas';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$kelas = '';
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

$tw = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
foreach($tw->result() as $w)
{
	$kelas =$w->kelas;
}
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'">'.$kelas.'</option>';
foreach($ta->result() as $a)
{
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
}
echo '</select></div></div>';

echo '</form>';

if(!empty($id_walikelas))
{
	echo form_open_multipart('sinkronard/prosesunggahwalikelas','class="form-horizontal" role="form"');?>
format csv
<p>"nis","nama","sakit","izin","alpa","e1","n1","k1","e2","k2","n2","e3","n3","k3","predikat_sikap_spiritual","deskripsi_sikap_spiritual","predikat_sikap_sosial","deskripsi_sikap_sosial","catatan_walikelas"</p>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile" class="textfield"></p></div></div>
<p class="text-center"><input type="submit" value="Unggah Berkas" class="btn btn-primary"></p></form>
<?php
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y'");	
foreach($ta->result() as $a)
{
	$nis = 	$a->nis;
	$tb = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");	
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `kepribadian` (`thnajaran`, `semester`, `kelas`, `nis`) values ('$thnajaran', '$semester', '$kelas', '$nis')");
	}
}
echo 'Siap mengupload';
}
echo '</div></div></div>';
