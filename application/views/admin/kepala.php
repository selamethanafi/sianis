<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pegawai.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Sen 11 Apr 2016 05:32:07 WIB 
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
<p><a href="<?php echo base_url(); ?>admin/pengguna/tambah" class="btn btn-info"><b>Tambah Pegawai</b></a></p>
<div class="table-responsiver"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Nama Pengguna</strong></td><td colspan="2" width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
echo "<tr><td>".$nomor."</td><td>".$b->nama."</td><td>".$b->username."</td><td align=\"center\"><a href='".base_url()."admin/pengguna/edit/".cegah($b->username)."' title='Edit'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."admin/hapuspengguna/".cegah($b->username)."'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";

$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	echo '<h5>'.$paginator.'</h5>';
	}?>
</div></div></div>
