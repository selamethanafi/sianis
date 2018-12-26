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
<?php echo form_open_multipart('panitiates/unggahjadwal','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div>
<div class="col-sm-9 form-control-static">
	<select name="tingkat" class="form-control">
	<option value="X">X</option>
	<option value="XI">XI</option>
	<option value="XII">XII</option>
	</select>
</div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9 form-control-static"><input type="file" name="userfile"><p class="help-block">Ekstensi nama file harus <strong>png</strong> dan <strong>harus huruf kecil</strong></p></div></div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p></form>
<p><a href="<?php echo base_url();?>panitiates/unggahjadwal" class="btn btn-primary">Reload</a></p>
<img src="<?php echo base_url();?>images/jadwal_ulangan_kelas_X.png" alt="gambar jadwal kelas X tidak ditemukan" class="img img-rounded" width="300">
<img src="<?php echo base_url();?>images/jadwal_ulangan_kelas_XI.png" alt="gambar jadwal kelas XI tidak ditemukan" class="img img-rounded" width="300"><img src="<?php echo base_url();?>images/jadwal_ulangan_kelas_XII.png" alt="gambar jadwal kelas XII tidak ditemukan" class="img img-rounded" width="300">
</div></div></div>
