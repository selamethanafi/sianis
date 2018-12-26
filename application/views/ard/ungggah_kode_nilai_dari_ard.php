<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 10 Nov 2014 04:24:41 WIB 
// Nama Berkas 		: unggah_foto.php
// Lokasi      		: application/views/tatausaha/
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
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
echo form_open_multipart('guruard/unggahkodenilai/'.$id_mapel,'class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?></p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $mapel;?></p></div></div>
format csv
<p>"student_id","student_value"</p>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile" class="textfield"></p></div></div>
<p class="text-center"><input type="submit" value="Unggah Berkas" class="btn btn-primary"></p></form>
</div></div></div>

