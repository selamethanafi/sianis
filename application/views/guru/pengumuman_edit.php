<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 11:55:10 WIB 
// Nama Berkas 		: pengumuman_edit.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/pengumuman/tampil" class="btn btn-info">Batal / kembali ke daftar pengumuman</a></p>
<?php
foreach($kategori->result_array() as $k)
{
	$judul=$k["judul_pengumuman"];
	$isi=$k["isi"];
	$id=$k["id_pengumuman"];
}
if (empty($judul))
{
	echo '<strong>Pengumuman dimaksud tidak ada atau tidak boleh disunting</strong>.';
}
else
{
?>
<?php echo form_open('guru/pengumuman','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>"></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Isi</label></div><div class="col-sm-12"><textarea name="isi" rows="10" class="form-control"><?php echo $isi; ?></textarea></div></div>
<input type="hidden" name="id_pengumuman" value="<?php echo $id; ?>" />
<p class="text-center"><input type="submit" value="Update Pengumuman" class="btn btn-primary"></p>
</form>
<?php
}//akhir berhak
?>

</div></div></div>

