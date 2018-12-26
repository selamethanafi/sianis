<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: cetak_daftar_nilai.php
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
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9"  class="ie"lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"lang="en-US">
<![endif]-->
<!-- This doesn't work but i prefer to leave it here... maybe in the future the MS will support it... i hope... -->
<!--[if IE 10]>
<html id="ie10"  class="ie"lang="en-US">
<![endif]-->
<!--[if !IE]>
<html lang="en-US">
<![endif]-->
<!-- START HEAD -->
<head>
<meta charset="UTF-8" />
<meta lang="id" />
<!-- this line will appear only if the website is visited with an iPad -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
<title><?php echo $judulhalaman;?></title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
<link rel="stylesheet" href="<?php echo base_url();?>css/teks.css">		
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
</head>
<body>
<div class="container-fluid">
<?php
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
$ta = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
$kelas = '';
foreach($ta->result() as $a)
{
	$kelas = $a->kelas;
}
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` = '$kelas' and `status`='Y'");?>
<br /><br />
<table width="100%" cellpadding="2" cellspacing="1">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
</table>
<table class="table table-striped table-bordered">
<tr align="center"><td width="5%"><strong>No.</strong></td><td width="20%"><strong>Nama Siswa</strong></td><td width="25%"><strong>Nama</strong></td><td width="15%"><strong>Hubungan dengan Siswa</strong></td><td><strong>Nomor Ponsel</strong></td><td width="15%"><strong>Tanda Tangan</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $t)
{
	echo '<tr><td align="center">'.$nomor.'</td><td>'.nis_ke_nama($t->nis).'</td><td></td><td></td><td></td><td></td></tr>';
	$nomor++;
}
echo '</table></div>';
?>
