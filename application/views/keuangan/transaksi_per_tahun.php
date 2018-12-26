<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : terima.php
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
if($tahun1 >0)
{
	$tahun2 = $tahun1+ 1;
	$thnajaran = $tahun1.'/'.$tahun2;
}
else
{
	$tahun1 = substr(cari_thnajaran(),0,4);
	$thnajaran = cari_thnajaran();
}
$xloc = base_url().'keuangan/semuatransaksi';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
<?php
echo '<option value="'.$tahun1.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result() as $a)
{
	$tahun1x = substr($a->thnajaran,0,4);
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$a->thnajaran.'</option>';
}
echo '</select></div></div></form>';
?>
<h4>Tahun Pelajaran <?php echo $thnajaran;?></h4>
<?php
$tb = $this->db->query("select * from `siswa_bayar` where `thnajaran` = '$thnajaran' order by tanggal");
?>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Tanggal</strong></td><td><strong>Pembayaran</strong></td><td><strong>Besar</strong><td><strong>Keterangan</strong></td></tr>
<?php
		$nomor=1;
		$total = 0;
		foreach($tb->result() as $ba)
		{
		$str = $ba->tanggal;	
		$nis= $ba->nis;
		echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'<td>'.tanggal($str).'</td><td>'.$ba->macam_pembayaran.'</td>
<td align="right">'.xduit($ba->besar).'</td><td>'.$ba->keterangan.'</td></tr>';
		$total = $total + $ba->besar;
		$nomor++;
		}
		echo '</table></div>';
		echo number_format($total);
?>

</div></div></div>
