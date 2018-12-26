<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: tutorial_edit.php
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
<div class="container-fluid"><h3>Modul Meninjau Materi Pelajaran</h3>
<input type="button" value="Tutup jendela ini" onclick="self.close()" class="btn btn-primary">
atau gunakan Ctrl + W


<?php
foreach($kategori->result() as $k)
{
	$judul=$k->judul_tutorial;
	$isi=$k->isi;
	$gambar=$k->gambar;
	$id=$k->id_tutorial;
	$status = $k->status;
}
if (empty($judul))
{
	echo '<div class="alert alert-warning"><strong>Materi dimaksud tidak ada atau tidak boleh disunting</strong>.</div>';	
}
else
{
	foreach($kategori->result() as $k)
	{
		$id_sel=$k->id_kategori_tutorial;
	}
	foreach($cur_kat->result() as $k)
	{
		if($k->id_kategori_tutorial==$id_sel)
		{
			$nama_kategori = $k->nama_kategori;
		}
	}
	?>
	<form class="form-horizontal" role="form">
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Kategori</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $nama_kategori;?></p></div>
	</div>
	</form>	
	<h3><p class="text-center"><?php echo $judul; ?></p></h3>
	<?php echo $isi; ?>
	<input type="button" value="Tutup jendela ini" onclick="self.close()" class="btn btn-primary">atau gunakan Ctrl + W
	<?php
}//akhir berhak
?>
</div>
