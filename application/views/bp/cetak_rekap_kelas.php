<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 10 Jun 2015 12:16:38 WIB 
// Nama Berkas 		: cetak_rekap_kelas.php
// Lokasi      		: application/views/bp/
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>REKAP KETIDAKHADIRAN DAN PELANGGARAN TATA TERTIB - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<div class="potret">
<?php

echo '<table>
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="75" alt="logo kementerian / pemerintah"></td><td align="center">'.$this->config->item('baris1').'<br>'.$this->config->item('baris2').'<br>'.$this->config->item('baris3').'<br>'.$this->config->item('baris4').'</TD><TR>
</table>';
echo '<p class="text-center">';
?>
<a href="<?php echo base_url(); ?>bp/rekapkelas/"><b>REKAPITULASI KETIDAKHADIRAN DAN PELANGGARAN TATA TERTIB</b></a></p>
<table>
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
</table><br>
<?php
echo '<table class="table table-striped table-bordered">
<tr align="center">
<td>Nomor</td><td>NIS</td><td width="200">Nama</td>
<td align="center">S</td><td>I</td><td>TK</td>
<td>Tlt</td><td>B</td><td>IMS</td><td>KP</td></tr>';
$ts = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut");
$nomor =1;
foreach($ts->result() as $ds)
{
	$nis = $ds->nis;
	echo '<tr><td align="center">'.$nomor.'</td><td>'.$nis.'</td><td>'.ucwords(strtolower(nis_ke_nama($nis))).'</td>';

	//sakit
	$tabs = $this->db->query("select * from siswa_absensi where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$sakit =0;
	$izin = 0;
	$alpa = 0;
	$bolos = 0;
	$izinx = 0;
	$terlambat = 0;
	foreach($tabs->result_array() as $dabs)
	{
		if ($dabs['alasan']=='S')
			$sakit=$sakit+1;
		if ($dabs['alasan']=='I')
			$izin=$izin+1;
		if ($dabs['alasan']=='A')
			$alpa=$alpa+1;
		if ($dabs['alasan']=='T')
			$terlambat=$terlambat+1;
		if ($dabs['alasan']=='B')
			$bolos=$bolos+1;
		if ($dabs['alasan']=='M')
			$izinx=$izinx+1;

	}

	if ($sakit>0)
		{
		echo '<td align="center">'.$sakit.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($izin>0)
		{
		echo '<td align="center">'.$izin.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($alpa>0)
		{
		echo '<td align="center">'.$alpa.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($bolos>0)
		{
		echo '<td align="center">'.$bolos.'</td>';
		}
		else
		{
		echo '<td></td>';
		}

	if ($terlambat>0)
		{
		echo '<td align="center">'.$terlambat.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	if ($izinx>0)
		{
		echo '<td align="center">'.$izinx.'</td>';
		}
		else
		{
		echo '<td></td>';
		}
	//kredit
	$tk = $this->db->query("select * from siswa_kredit where thnajaran='$thnajaran' and nis='$nis'");
	$poin=0;
	foreach($tk->result_array() as $dk)
	{
		$poin = $poin + $dk['point'];
	}

	if ($poin>0)
		{
		echo '<td align="center">'.$poin.'</td>';
		}
		else
		{
		echo '<td></td>';
		}

	echo '</tr>';
	$nomor++;
}


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

