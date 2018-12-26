<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unggah_ketidakhadiran.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 10:09:05 WIB 
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
<form class="form-horizontal" role="form" action="<?php echo base_url();?>bp/prosesunggahrekapketidakhadiran" enctype="multipart/form-data" method="post">
<div class="card">
<div class="card-header"><h4><?php echo $judulhalaman;?></h4></div>
<div class="card-body">
	<div class="alert alert-info">
	<p class="help-block">
	format data<br />
	"nis","s","i","a"</p>
	</div>
	<div class="form-group row">
	<label for="berkas" class="col-sm-1 control-label">Berkas</label>
	<div class="col-sm-11" ><input type="file" name="csvfile"></div>
</div>
<p class="text-center"><button type="submit" class="btn btn-primary">KIRIM BERKAS</button></p></div></div></form>
</div>
