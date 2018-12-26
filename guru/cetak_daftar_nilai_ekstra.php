<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: cetak_daftar_nilai_ekstra.php
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
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>DAFTAR NILAI ESKTRAKURIKULER - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<div class="potret">
<?php

echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100"><img src ="'.base_url().'/images/depag.png" width="90" alt="logo sekolah"> </td><td align="center">'.$this->config->item('baris1').'<br />'.$this->config->item('baris2').'<br />'.$this->config->item('baris3').'<br />'.$this->config->item('baris4').'</TD><TR>
</table><br />';
?>
<p class="text-center"><a href="<?php echo base_url(); ?>guru/ekstrakurikuler/<?php echo $id_mapel;?>/<?php echo $id_kelas;?>"><b> DAFTAR NILAI EKSTRAKURIKULER</b></a></p>
<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Ekstrakurikuler</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
</table>

<table class="table table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td>
<?php
if ($kelas=='semua')
	{echo '<td><strong>Kelas</strong></td>';}
?>
<td><strong>Nilai</strong></td><td><strong>Keterangan</strong></td></tr>
<?php
$nomor=1;
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);

	echo "<tr><td align='center'>".$nomor."</td><td>".$namasiswa."</td>";
	if ($kelas=='semua')
		{echo "<td align='center'>".$t->kelas."</td>";}
	echo "<td align='center'>".$t->nilai."</td><td align='center'>".$t->keterangan."</td></tr>";
	$nomor++;	
	}
}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}

echo '</table>';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'" alt="tanda tangan"><tr><td width="150"></td><td>Mengetahui,<br />Kepala<br /><br /><br />'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br />Guru Mata Pelajaran<br /><br /><br />'.$namapegawai.'<br />NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
?>
</div>
</body></html>
