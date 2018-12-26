<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kat_tutorial.php
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
<div class="card-header"><h3>Daftar Mata Pelajaran</h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>admin/tambahtutorial" class="btn btn-primary">Tambah Materi Pelajaran</a> 
<a href="<?php echo base_url(); ?>admin/tambahkattutorial" class="btn btn-info">Tambah Mata Pelajaran</a></p>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Kategori Materi Pelajaran</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($kategori->result_array() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".$b["nama_kategori"]."</td><td width='20'><a href='".base_url()."admin/editkattutorial/".$b["id_kategori_tutorial"]."' title='Edit'>Edit</a></td>
<td width='20'><a href='".base_url()."admin/hapuskattutorial/".$b["id_kategori_tutorial"]."' onClick=\"return confirm('Anda yakin ingin menghapus kategori ini?')\" title='Hapus'>Hapus</a></td></tr>";
$nomor++;
}
?>
</table>
<p><?php echo $paginator;?></p>
</div></div></div>
