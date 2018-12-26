<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: nilai_remidi_unggah.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Jum 13 Mei 2016 10:52:16 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$mapelkelas = '';
if(!empty($sukses))
{?>
    <div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Sukses!</strong> data berhasil di simpan
     </div>
<?php
}
?>
<?php
$data = 0;
$xloc = base_url().'ekstrakurikuler/proses';
?>
<form class="form-horizontal" role="form" name="formx" enctype="multipart/form-data" method="post" action="<?php echo $xloc;?>">
    <div class="form-group row row">
	<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?></p>
        </div>
    </div>
    <div class="form-group row row">
	<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
	<div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p>
	</div>
    </div>
    <div class="form-group row row">
       <div class="col-sm-3"><label for="inputfile" class="control-label">Berkas</label></div>
       <div class="col-sm-9"><input type="file" name="userfile">
	        <p class="help-block">Format Berkas CSV<br />"nis","nama","nama_ekstra","nilai","deskripsi"</p>
       </div>
   </div>
		<p class="text-center"><button type="submit" class="btn btn-primary">Kirim Berkas</button></p>
</form>
</div></div></div>

