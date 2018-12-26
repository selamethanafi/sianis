<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: impor_status_siswa.php
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
<div class="alert alert-info">
Datum terakhir NIS <b><?php echo $nisterakhir;?></b> Nama <?php echo $namasiswa;?>
<p>format data</p>
"thnajaran","semester","nis","nama","aktif"
</div>
<?php echo form_open_multipart('tatausaha/proses_impor_status_siswa','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile"></p></div></div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>
</div></div></div>
