<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 07 Sep 2015 22:48:23 WIB 
// Nama Berkas 		: saran.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Dari Nama</strong></td><td><strong>Nomor Seluler</strong></td><td><strong>Kritik / Saran / Aduan</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
	if(empty($page))
	{
		$page = 0;
	}
        $link_hapus = anchor('tatausaha/saran/hapus/'.$page.'/'.$b->id_saran,'<span class="glyphicon glyphicon-trash"></span>', array('title' => 'Hapus', 'data-confirm' => 'Anda yakin akan menghapus data ini?'));
echo "<tr><td>".$b->nama_tamu."</td><td align=\"center\">".$b->nosel_tamu."</td><td>".$b->saran."</td><td  align=\"center\">".$link_hapus."</td></tr>";
$nomor++;
}
?>
</table>
<?php
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php }?>
</div></div></div>
