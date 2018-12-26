<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Jum 20 Mei 2016 20:02:58 WIB 
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
<p><a href="<?php echo base_url(); ?>admin/carisiswa" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> <b>Pencarian Siswa</b></a></p>
<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td width="300"><strong>Username / NIS</strong></td><td width="460"><strong>Nama</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
echo "<tr><td>".$nomor."</td><td>".$b->username."</td><td>".$b->nama."</td><td align=\"center\"><a href='".base_url()."admin/pengguna/edit/".$b->username."' title='Edit'><span class=\"fa fa-edit\"></span></a></td>
<td align=\"center\"><a href='".base_url()."admin/hapusloginsiswa/".$b->username."' onClick=\"return confirm('Anda yakin ingin menghapus user ".$b->nama." ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span>
</a></td></tr>";
$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
</div></div></div>
