<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: upload_edit.php
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

<?php
foreach($kategori->result_array() as $k)
{
$judul=$k["judul_file"];
$nama_file=$k["nama_file"];
$id=$k["id_download"];
}
if (empty($judul))
{
	echo '<strong>Berkas dimaksud tidak ada atau tidak boleh disunting</strong>.';
}
else
{
?>
<?php echo form_open('guru/upload','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul File</label></div><div  class="col-sm-9"><input type="text" name="judul" class="form-control" size="50" value="<?php echo $judul; ?>"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kategori Berkas</label></div><div  class="col-sm-9">
<?php
foreach($kategori->result_array() as $k)
{
$id_sel=$k["id_kat"];
$judul=$k["judul_file"];
}
?>
<select name="kategori" class="form-control">
<?php
foreach($cur_kat->result_array() as $k)
{
if($k["id_kategori_download"]==$id_sel)
{
echo "<option value='".$k["id_kategori_download"]."' selected>".$k["nama_kategori_download"]."</option>";
}
else
{
echo "<option value='".$k["id_kategori_download"]."'>".$k["nama_kategori_download"]."</option>";
}
}
?>
</select>
</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama File</label></div><div  class="col-sm-9"><?php echo $nama_file; ?></div></div>
<p class="text-center"><input type="submit" value="Perbarui Data Berkas" class="btn btn-primary"><input type="hidden" name="id_download" value="<?php echo $id; ?>" /></p>
</form>
<?php
}//akhir berhak
?>
</div></div></div>
