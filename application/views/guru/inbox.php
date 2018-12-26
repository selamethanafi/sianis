<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:06:05 WIB 
// Nama Berkas 		: inbox.php
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

<table class="table table-striped table-hover table-bordered">
<tr><td><strong>No.</strong></td><td><strong>Pengirim</strong></td><td><strong>Subjek Pesan</strong></td><td><strong>Waktu</strong></td><td><strong>Aksi</strong></td></tr>
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
<td><a href='".base_url()."guru/detailinbox/".$str."'>".$tanda_awal."".$t->subjek."".$tanda_blk."</a></td>
<td>".$tanda_awal."".$t->waktu."".$tanda_blk."</td>
<td align=\"center\"><a href='".base_url()."guru/hapusinbox/".$str."' onClick=\"return confirm('Anda yakin ingin menghapus pesan ini?')\" title='Hapus pesan'><span class=\"fa fa-trash-alt\"></span></a>
</td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Inbox Pesan anda masih kosong.</td></tr>";
}
?>
</table><?php
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div></div></div>
