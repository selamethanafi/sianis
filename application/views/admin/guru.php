<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: guru.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Jum 20 Mei 2016 20:31:15 WIB 
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
<a href="<?php echo base_url(); ?>admin/pengguna/tambah" class="btn btn-info"><span class="fa fa-plus"></span> <b>Guru</b></a></p></p>
<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama Guru</strong></td><td><strong>Nama Pengguna</strong></td><td><strong>Batas Login</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
echo "<tr><td>".$nomor."</td><td>".$b->nama."</td><td>".$b->username."</td><td align=\"center\">".$b->next_login."</td><td align=\"center\"><a href='".base_url()."admin/pengguna/edit/".$b->username."' title='Edit'><span class=\"fa fa-edit\"></span></a></td></tr>";

$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	echo $paginator;
	}?>
</div></div></div>
