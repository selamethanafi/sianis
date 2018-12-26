<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_semua_nilai.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Rab 01 Jul 2015 11:18:33 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php
$xloc = base_url().'bp/unduhsemuanilai';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	}
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$k->thnajaran.'</option>';
	}

	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1/'.$id_kelas.'">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2/'.$id_kelas.'">2</option>';
	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
	}
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
echo '</div></div></form>
</div>';
