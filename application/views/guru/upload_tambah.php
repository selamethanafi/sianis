<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: upload_tambah.php
// Lokasi      		: application/views/guru/
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
<?php echo form_open_multipart('guru/upload','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul Berkas</label></div><div  class="col-sm-9"><input type="text" name="judul" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kategori Berkas</label></div><div  class="col-sm-9">
<select name="kategori" class="form-control">
<?php
foreach($kategori->result_array() as $k)
{
echo "<option value='".$k["id_kategori_download"]."'>".$k["nama_kategori_download"]."</option>";
}
?>
</select>
</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div  class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile"></p>
<p class="text-warning">Nama file yang akan di-upload harap tidak mengandung karakter seperti ."`~* dan sebagainya.</p></div></div>
<p class="text-center"><input type="submit" value="Upload Berkas" class="btn btn-primary"></p>
</form>
</div></div></div>
