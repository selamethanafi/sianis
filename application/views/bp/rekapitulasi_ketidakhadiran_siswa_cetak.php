<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
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
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Rekapitulasi Ketidakhadiran Siswa - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<div class="potret">
<?php

echo '<table>
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="75" alt="logo kementerian / pemerintah"></td><td align="center">'.$this->config->item('baris1').'<br>'.$this->config->item('baris2').'<br>'.$this->config->item('baris3').'<br>'.$this->config->item('baris4').'</TD><TR>
</table>';
?>
<a href="<?php echo base_url();?>bp/carisiswa"><h4 class="text-center">Rekapitulasi Ketidakhadiran Siswa</h4></a>
<?php
$namasiswa = nis_ke_nama($nis);
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
echo '<h4>Nama : '.$namasiswa.'</h4>';
echo '<h4>Kelas : '.$kelas.'</h4>';
$ta = $this->db->query("select * from `siswa_absensi` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' order by `tanggal` ASC");
echo '<table class="table table-striped table-bordered"><tr><td align="center">Nomor</td><td align="center">Tanggal</td><td align="center">Alasan</td><td align="center">Keterangan</td></tr>';
$nomor = 1;
foreach($ta->result() as $a)
{
	echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.tanggal($a->tanggal).'</td><td align="center">'.$a->alasan.'</td><td align="center">'.$a->keterangan.'</td></tr>';
	$nomor++;
}
echo '</table>';


		$namakepala = '';
		$nipkepala = '';
		$namakepala = cari_kepala($thnajaran,$semester);
		$nipkepala = cari_nip_kepala($thnajaran,$semester);
		$tahun = date("Y");
		$bulan = date("m");
		$tanggal = date("d");
		$tanggalcetak = "$tahun-$bulan-$tanggal";
		$tanggalcetak = date_to_long_string($tanggalcetak);
echo '</table><br>
<table>
<tr><td valign="top" width="100"></td><td valign="top" >Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td><td valign="top" width="100"></td>
<td valign="top" >'.$this->config->item('lokasi').', '.$tanggalcetak.'<br>Staf BK<br><br><br><br>______________________<br>NIP </TD><TR>
</table><br><br>';
?>

</div>
