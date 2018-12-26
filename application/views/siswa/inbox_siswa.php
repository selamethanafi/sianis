<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: inbox_mhs.php
// Lokasi      		: application/views/siswa/
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
<tr align="center"><td><strong>No.</strong></td><td><strong>Pengirim</strong></td><td><strong>Subjek Pesan</strong></td><td><strong>Waktu</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
		if(($t->status_pesan)=="N")
		{
		$tanda_awal="<b>";
		$tanda_blk="</b>";
		}
		else
		{
		$tanda_awal=" ";
		$tanda_blk=" ";
		}
$sambung="9002".$t->id_inbox."";
$coded = base64_encode($sambung);
$str = preg_replace("/=/", "eqsmdng", $coded);
echo "<tr><td align='center'>".$tanda_awal."".$nomor."".$tanda_blk."</td>
<td>".$tanda_awal."".$t->nama."".$tanda_blk."</td>
<td><a href='".base_url()."siswa/detailinbox/".$str."'>".$tanda_awal."".$t->subjek."".$tanda_blk."</a></td>
<td  align='center'>".$tanda_awal."".$t->waktu."".$tanda_blk."</td>
<td  align='center'><a href='".base_url()."siswa/hapusinbox/".$str."' onClick=\"return confirm('Anda yakin ingin menghapus file ini?')\" title='Hapus File'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Inbox Pesan anda masih kosong.</td></tr>";
}
echo '</table>';
if(!empty($paginator))
	{
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
	}
?>
</div></div></div>
