<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 11:54:32 WIB 
// Nama Berkas 		: pengumuman.php
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
<p><a href="<?php echo base_url(); ?>guru/pengumuman/tambah" class="btn btn-info">Tambah Pengumuman</a></p>
<?php
$nomor=$page+1;
if(count($query->result())>0){
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Judul Pengumuman</strong></td><td><strong>Tanggal</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
	foreach($query->result() as $t)
	{
		echo "<tr><td align='center'>".$nomor."</td><td>".$t->judul_pengumuman."</td><td align='center'>".date_to_long_string($t->tanggal)."</td><td align='center'><a href='".base_url()."guru/pengumuman/edit/".$t->id_pengumuman."' title='Edit Pengumuman'><span class=\"fa fa-edit\"></span></a></td><td align='center'><a href='".base_url()."guru/pengumuman/hapus/".$t->id_pengumuman."' onClick=\"return confirm('Anda yakin ingin menghapus ".$t->judul_pengumuman."?')\" title='Hapus Pengumuman'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
	$nomor++;	
	}
	echo '</table>';
}
else
{
	echo '<div class="alert alert-warning">Anda belum pernah menuliskan pengumuman';
}
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div></div></div>

