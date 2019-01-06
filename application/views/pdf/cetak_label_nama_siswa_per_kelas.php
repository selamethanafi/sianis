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

$this->fpdf->FPDF("P","mm","A4");

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$x=2;
$y = 2;
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetTitle("foto per kelas");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$ta  = $this->db->query("SELECT * from `siswa_kelas` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `no_urut` ASC");
$kali = 0;
$baris = 0;
$l = 66;
$t = 30;
$this->fpdf->setFont('Arial','',9);
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$nisn = nisn($nis);
	$namasiswa = ucwords(strtolower(nis_ke_nama($nis)));
	$yy = $t * $baris; // $yy = 30
	$y2 = $y * $baris; // $y2 = 4
	if($baris == 0)
	{
		$posy = $yy+$y;
	}
	else
	{
		$posy = $yy+$y2+$y2+$y; 
	}
	if($kali == 1)
	{
		$posx = $x+$l+4;
	}
	elseif($kali == 2)
	{
		$posx = $x+$l+$l+8;
	}
	else
	{
		$posx = $x;
	}
	$this->fpdf->setFont('Arial','',12);
	$posyy = $posy + 5; // 2
	$this->fpdf->setXY($posx,$posyy);
	$this->fpdf->MultiCell($l,6,$namasiswa,0,'C',0);
	$this->fpdf->setXY($posx,$posyy+12);
	$this->fpdf->Cell($l,6,'NIS / NISN : '.$nis.' / '.$nisn,0,2,'C',0);
	$this->fpdf->setXY($posx,$posy);
	$this->fpdf->Cell($l,$t,'',1,2,'C',0);
	$kali++;
	if($kali == 3)
	{
		$kali = 0;
		$baris++;
		$batasy = $this->fpdf->GetY();
		if($batasy > 240)
		{
			$this->fpdf->AddPage();
			$baris = 0;
		}

	}
}

$this->fpdf->Output("label_rapor.pdf","I");
exit();
?>
