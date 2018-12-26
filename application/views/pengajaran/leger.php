<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: lihat_nilai.php
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
<?php echo form_open('pengajaran/leger','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">';
	echo "<option value='".$kelas."'>".$kelas."</option>";
	foreach($daftar_kelas->result() as $l)
	{
	echo "<option value='".$l->ruang."'>".$l->ruang."</option>";
	}
	
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Unduh Leger" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/leger" class="btn btn-info"><b>Batal</b></a></p>';
?>
</div></div>
</form>
</div>
