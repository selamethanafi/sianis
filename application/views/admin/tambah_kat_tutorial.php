<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: tambah_kat_tutorial.php
// Lokasi      		: application/views/admin
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
<p><a href="<?php echo base_url(); ?>admin/tambahtutorial" class="btn btn-primary">Tambah Materi Pelajaran</a> <a href="<?php echo base_url(); ?>admin/kattutorial" class="btn btn-info">Daftar Mata Pelajaran</a><p>
<?php echo form_open('admin/simpankattutorial','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><input type="text" name="nama" placeholder="nama mata pelajaran" class="form-control"></div></div>
<p><input type="submit" class="btn btn-success" value="Simpan Mata Pelajaran"></p>
</form>
</div></div></div>
