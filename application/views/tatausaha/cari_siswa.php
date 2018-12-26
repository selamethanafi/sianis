<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: cari_siswa.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Min 15 Mei 2016 18:30:14 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php echo form_open('tatausaha/carisiswa','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="panel-body">

<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Nama / NIS</label></div>
	<div class="col-sm-9" ><input type="text" name="nama" class="form-control" autofocus></div>
</div>
<p class="text-center"><button type="submit" class="btn btn-primary">CARI SISWA</button></p></div></div>
</form>
</div>
