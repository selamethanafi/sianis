<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: subjects_value.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
	<form method="post" action="<?php echo base_url(); ?>guruard/subjects_value/<?php echo $id_mapel;?>" class="form-horizontal" role="form">
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Subjects Value dari ARD</label></div><div class="col-sm-9"><input type="text" name="post_subjects_value" value="<?php echo $subjects_value;?>" class="form-control"> </div></div>
	<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
</form>
</div></div></div>
