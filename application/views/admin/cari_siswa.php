<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: cari_siswa.php
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
<?php echo form_open('admin/carisiswa','class="form-horizontal" role="form"');?>
<?php
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div  class="col-sm-9"><input type="text" name="nama" class="form-control"></div></div>';
echo '<p class="text-center"><input type="submit" value="Cari Siswa" class="btn btn-primary">&nbsp&nbsp&nbsp<a href="'.base_url().'admin/carisiswa" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
</div></div></div>
