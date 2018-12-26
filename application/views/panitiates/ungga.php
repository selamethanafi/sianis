<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: impor_siswa.php
// Lokasi      		: application/views/panitiates/
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
<?php echo form_open_multipart('panitiates/proses_impor_siswa','class="form-horizontal" role="form"');?>
<p>format data</p>
<p class="text-info">"nis","nama","kelas""no_peserta","no_unik","ruang","baris","kolom","kiri_kanan"</p><p class="text-info">Kiri diisi dengan 1</p><p class="text-info">Kanan diisi dengan 2</p>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9 form-control-static"><input type="file" name="csvfile"></div></div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p></form>
</div></div></div>
