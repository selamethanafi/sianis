<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: cetak_kekurangan_siswa_per_kelas_per_tahun.php
// Lokasi      		: application/views/keuangan
// Terakhir diperbarui	: Rab 01 Jul 2015 11:34:03 WIB 
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>DAFTAR KEKURANGAN PEMBAYARAN SISWA (Tanpa Tunggakan Tahun Lain) KELAS <?php echo $ruang;?> TAHUN <?php echo $thnajaran;?> - <?php echo $this->config->item('nama_web');?></title>
</head>

<body>

<?php
$warna="#D6F3FF";
if ((!empty($thnajaran)) and (!empty($ruang)))
	{
	echo '<table width="870" cellpadding="2" cellspacing="1" class="widget-small">
	<tr><td align="center"><h2>DAFTAR KEKURANGAN PEMBAYARAN SISWA (Tanpa Tunggakan Tahun Lain) KELAS '.$ruang.' TAHUN '.$thnajaran.'</h2></TD><TR></table>';

	$warna="#D6F3FF";
	$nomor=1;
	$truang =mysql_query("select * from m_ruang where ruang='$ruang'");
	$druang = mysql_fetch_array($truang);
	$tingkat = $druang['tingkat'];
//
	echo '<table width="870" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">
	<tr bgcolor="#FFF" align="center"><td>Nama</td>';
	$tmacam = mysql_query("select * from m_uang where status='1'");
	$dmacam = mysql_fetch_array($tmacam);
	$item= 1;
	do
		{
		echo '<td align="center">'.substr($dmacam['nama'],0,5).'</td>';
		$macam[$item]=$dmacam['nama'];
		$item++;
		}
	while ($dmacam = mysql_fetch_array($tmacam));
	echo '<td>Jumlah</td></tr>';
	$tsk = mysql_query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$ruang' and status='Y' order by no_urut");
	$dsk = mysql_fetch_array($tsk);
	$jmlbsrtung = 0;
	do
		{
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}

		$nis = $dsk['nis'];
		$nama = $dsk['nama'];
		echo '<tr bgcolor="'.$warna.'"><td>'.$nama.'</td>';		
		$jmltung= 0;
		$itemx=1;
		do {
			$macam_pembayaran = $macam[$itemx];
			$tset = mysql_query("select * from m_uang_besar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and tingkat='$tingkat'");
			$dset = mysql_fetch_array($tset);
			$besar[$itemx]=$dset['besar'];
			//cari yang dibayar siswa
			$tsb = mysql_query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
			$dsb = mysql_fetch_array($tsb);
			$bayar[$itemx]=0;
			do
				{
				$bayar[$itemx]=$bayar[$itemx]+$dsb['besar'];
				}
			while ($dsb = mysql_fetch_array($tsb));
			$kurang[$itemx]=$besar[$itemx]-$bayar[$itemx];
			echo '<td align="right">'.$kurang[$itemx].'</td>';
			$jmltung=$jmltung+$kurang[$itemx];
			$itemx++;
			}
		while ($itemx<$item);

		echo '<td align="right">'.$jmltung.'</td></tr>';
		$jmlbsrtung = $jmlbsrtung + $jmltung;
		$nomor++;
		}
	while ($dsk = mysql_fetch_array($tsk));
	echo '</table><br>Jumlah Semua Tunggakan '.$jmlbsrtung.'';	
	}

echo '<br>per tanggal '.date("d").'-'.date("m").'-'.date("Y").'';
?>
<br><br>
<a href="<?php echo base_url(); ?>index.php/keuangan/kekurangansiswaperkelaspertahun"><div class="pagingpage"><b><?php echo $this->config->item('nama_web');?></b></div></a>

