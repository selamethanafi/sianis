<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:00:03 WIB 
// Nama Berkas 		: unggah.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//			  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/upload/unggah" class="btn btn-info"><b>Tambah / Unggah Berkas</b></a></p>
<div class="table-responsive">
<?php
$nomor=$page+1;
if(count($query->result())>0)
{
	?>
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Judul File</strong></td><td><strong>Kategori</strong></td><td><strong>File</strong></td><td><strong>Tgl. Upload</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
	<?php
	foreach($query->result() as $t)
	{
	echo "<tr><td align='center'>".$nomor."</td><td>".$t->judul_file."</td><td>".$t->nama_kategori_download."</td><td align=\"center\"><b><a href='".$this->config->item('url_unduhan')."/".$t->nama_file."'><span class=\"glyphicon glyphicon-download\"></span></a></b></td><td align=\"center\">".date_to_long_string($t->tgl_posting)."</td><td align=\"center\">
<a href='".base_url()."guru/upload/edit/".$t->id_download."' title='Edit File'><span class=\"glyphicon glyphicon-pencil\"></span></a></td>
<td align=\"center\"><a href='".base_url()."guru/upload/hapus/".$t->id_download."' onClick=\"return confirm('Anda yakin ingin menghapus file ini?')\" title='Hapus File'><span class=\"fa fa-trash-alt\"></span></a></td>
</td></tr>";
$nomor++;	
	}
	echo '</table></div>';
}
else{
echo '<div class="alert alert-info">Anda belum pernah mengunggah berkas</div>';
}
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div></div></div>
