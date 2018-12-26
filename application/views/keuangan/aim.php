<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : siswa.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<?php
echo '<p><a href="'.base_url().'keuangan/aim" class="btn btn-success">Muat Ulang</a></p>';
$tb = $this->db->query("select * from `siswa_proses_bayar`");
if($tb->num_rows() >0)
{
?>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Besar</strong></td><td width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($tb->result() as $b)
{
	$nis = $b->nis;
	$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC limit 0,1");
	$kelas = '';
	foreach($ta->result() as $a)
	{
		$kelas = $a->kelas;
	}
	echo '<tr><td>'.$nomor.'</td><td>'.$b->nis.'</td><td>'.nis_ke_nama($nis).'</td><td>'.$kelas.'</td><td>'.xduit($b->besar).'<td><a href="'.base_url().'keuangan/terima/'.$nis.'" class="btn btn-success">Terima</a></td></tr>';
	$nomor++;
}
?>
</table></div>
<?php
}
else
{
	echo '<div class="alert alert-info">Belum ada pembayaran</div>';
}
?>
</div></div></div>
