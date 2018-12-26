<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: keluarnegeri.php
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
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/keluarnegeri/tambah" class="btn btn-info"><b>Tambah Data Keluar Negeri</b></a></p>
<?php

if(count($querykeluarnegeri->result())>0)
{
	echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr align="center"><td>NO</td>
	<td>NEGARA</td><td>TUJUAN KUNJUNGAN<td>LAMA</td><td>YANG MEMBIAYAI</td><td colspan="2">Aksi</td></tr>';
	
	$urut=1;
	foreach($querykeluarnegeri->result() as $t)
	{
	echo '<tr><td align="center">'.$urut.'</td><td>'.$t->negara.'</td><td>'.$t->tujuan_kunjungan.'</td><td>'.$t->lama.'</td><td>'.$t->pembiaya.'</td>';
echo "<td align=\"center\"><a href='".base_url()."guru/keluarnegeri/ubah/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td>
<td align=\"center\"><a href='".base_url()."guru/keluarnegeri/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td>
</td></tr>";		
	$urut=$urut+1;
	}	 
	echo '</table></div>';
}
else
{
	echo '<div class="alert alert-warning">Belum ada data</div>';
}
?>
</div></div></div>
