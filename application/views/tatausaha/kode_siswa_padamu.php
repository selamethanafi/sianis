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
if(isset($sukses))
{
	echo '<div class="alert alert-success">Proses unggah kode siswa dari padamu sukses.</div>';
}
else
{
echo form_open_multipart('tatausaha/unggahdatasiswapadamu','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile" class="textfield"></p></div></div>
<p class="text-center"><input type="submit" value="Unggah Berkas" class="btn btn-primary"></p></form>
<?php
}
?>
</div></div></div>

