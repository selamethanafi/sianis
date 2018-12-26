<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_rapor.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php
$xloc = base_url().'panitiates/kartuubk';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';
echo '<div class="panel panel-default">
<div class="panel-heading"><h3>'.$judulhalaman.'</h3></div>
<div class="panel-body">';
if(!empty($tahun1))
{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label"><a href="'.base_url().'panitiates/kartuubk">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
}
if (!empty($semester))
{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label"><a href="'.base_url().'panitiates/kartuubk/'.$tahun1.'">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '</select></div></div>';
}
if (!empty($id_tes))
{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label"><a href="'.base_url().'panitiates/kartuubk/'.$tahun1.'/'.$semester.'">Nama Tes</a></label></div><div class="col-sm-9">';
	echo "<select name=\"id_tes\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `nama_tes` where `id_nama_tes`='$id_tes'");
	foreach($tdx->result() as $dx)
	{
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_tes.'">'.$dx->nama_tes.'</option>';
	}
	echo '</select></div></div>';
}
if (!empty($id_kelas))
{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label"><a href="'.base_url().'panitiates/kartuubk/'.$tahun1.'/'.$semester.'">Kelas</a></label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '??';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	}
	$td = $this->db->query("select * from `m_walikelas` where `kurikulum`='KTSP' and `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
}

if (empty($tahun1))
{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($semester))
{
	echo '<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2">2</option>';
	echo '</select></div></div>';
}
elseif(empty($id_tes))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Tes</label></div><div class="col-sm-9">';
	echo "<select name=\"id_tes\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	foreach($daftar_tes->result() as $k)
	{
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$k->id_nama_tes.'">'.$k->nama_tes.'</option>';
	}
	echo '</select></div></div>';
}
else
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_tes.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}
	echo '</select></div></div>';
}
echo '</div></div></div>';
