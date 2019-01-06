<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kartu_tes.php
// Lokasi      : application/views/pdf/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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

$this->fpdf->FPDF("P","mm","Legal");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,1,1);
$x=1.5;
$y = 7.0;
$x2 = 4.0;
$x3 = 1.0;
$x4 = 5.0;
$ada = 0;

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetTitle("kartu tes");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->AddFont('free3of9');

// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
$a=60;
$kali = 1;
$ygambarkiri = 8;
$xgambarkiri = 9;
$ygambarkanan = 9;
$xgambarkanan = 92;
$xtekskiri  = 15;
$ytekskiri  = 9;
$xtekskanan  = 88;
$ytekskanan  = 8;
$xgrskanan = 5;
$xgrskiri = 8;
$ygrskanan = 24;
$ygrskiri = 24;
$lkonan = 118;
$lkori = 71;
$tlogo = 40;
$llogo = 30;
$kiri = 8;
$tingkat = kelas_jadi_tingkat($kelas);
$qnil  = $this->db->query("SELECT * from siswa_nomor_tes where kelas='$kelas' order by no_peserta DESC");
foreach($qnil->result() as $rnil)
{
	// garis keliling kartu
	if ($kali==1)
	{
		$this->fpdf->Image('images/jadwal_ulangan_kelas_'.$tingkat.'.png',$kiri,5,118,$a);
		$this->fpdf->SetXY($kiri,5);
		$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
	}
	if ($kali==2)
	{
		$this->fpdf->Image('images/jadwal_ulangan_kelas_'.$tingkat.'.png',$kiri,75,118,$a);
		$this->fpdf->SetXY($kiri,75);
		$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
	}
	if ($kali==3)
	{
		$this->fpdf->Image('images/jadwal_ulangan_kelas_'.$tingkat.'.png',$kiri,146,118,$a);
		$this->fpdf->SetXY($kiri,146);
		$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
	}
	if ($kali==4)
	{
		$this->fpdf->Image('images/jadwal_ulangan_kelas_'.$tingkat.'.png',$kiri,216,118,$a);
		$this->fpdf->SetXY($kiri,216);
		$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
	}
	$this->fpdf->SetXY(1,286);
	$ygambarkiri = $ygambarkiri + 70;
	$ytekskiri = $ytekskiri + 70;
	$ygambarkanan = $ygambarkanan + 70;
	$ytekskanan = $ytekskanan + 70;
	$ygrskanan = $ygrskanan + 70;
	$ygrskiri = $ygrskiri + 70;
	$kali = $kali+1;
	if ($kali > 4)
	{
		$kali = 1;
		$ygambarkiri = 8;
		$xgambarkiri = 10;
		$ygambarkanan = 8;
		$xgambarkanan = 95;
		$xtekskiri  = 15;
		$ytekskiri  = 9;
		$xtekskanan  = 88;
		$ytekskanan  = 8;
		$xgrskanan = 5;
		$xgrskiri = 8;
		$ygrskanan = 24;
		$ygrskiri = 24;
		$lkonan = 118;
		$lkori = 71;
		$tlogo = 40;
		$llogo = 30;
		$kiri = 8;
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
	}
}
$this->fpdf->Output("kartu_jadwal_tes_kelas_".$kelas.".pdf","I");
?>
