<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 03 Des 2014 19:49:54 WIB 
// Nama Berkas 		: impor_mapel.php
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
<?php echo form_open_multipart('pengajaran/proses_impor_siswa','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div>
		<div class="col-sm-9" ><input type="file" name="csvfile"><p class="help-block">format berkas: <br />
"thnajaran","nis","kelas","ruang","no_peserta","no_unik"</p>
</div></div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></div></div>
</div></div></form>
</div>
