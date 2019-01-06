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
$kiri = 8;
$lebarkartu = 95;
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetTitle("kartu pembayaran");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->AddFont('free3of9');

// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
//query /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// nama tes]
//echo $teskd;
$namates='kartu pembayaran';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
if($nis == 'semua')
{
	$ta = $this->db->query("select * from `siswa_kelas` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by no_urut");
}
else
{
	$ta = $this->db->query("select * from `siswa_kelas` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' and `nis`='$nis' order by no_urut");
}
$cacah = $ta->num_rows();
$halaman = $cacah / 2;
$halaman = round($halaman);
$halaman = $halaman * 2;
$kali = 1;
$kolom = 1;
$y = 0;
$yy = 0;
$a=130;
$xgambarkiri = 40;
$ygambarkiri = 15;
$xgambarkanan = 145;
$this->fpdf->setFont('Times','B',10);
$hal = 1;
foreach($ta->result() as $da)
{
	$this->fpdf->setXY($kiri,$y+10);
	$this->fpdf->SetFont('Times','',9);
	$this->fpdf->cell($lebarkartu,4,'DAFTAR PEMBAYARAN',0,2,'C',0);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->setX($kiri);
	$this->fpdf->cell(20,4,'NIS / Nama',0,0,'L',0);
	$this->fpdf->cell($lebarkartu-20,4,': '.$da->nis.' / '.nis_ke_nama($da->nis),0,2,'L',0);
	$this->fpdf->setX($kiri);
	$this->fpdf->cell(20,4,'Kelas',0,0,'L',0);
	$this->fpdf->cell($lebarkartu-20,4,': '.nis_ke_kelas_thnajaran_semester($da->nis,$thnajaran,$semester),0,2,'L',0);
	$this->fpdf->SetX($kiri);
	$this->fpdf->cell(6,4,'No',1,0,'C',0);
	$this->fpdf->cell(20,4,'Macam',1,0,'C',0);
	$this->fpdf->cell(18,4,'Tanggal',1,0,'C',0);
	$this->fpdf->cell(18,4,'Jumlah',1,0,'C',0);
	$this->fpdf->cell(21,4,'OPR',1,0,'C',0);
	$this->fpdf->cell(12,4,'Paraf',1,2,'C',0);
	$this->fpdf->setX($kiri);
//	$this->fpdf->Cell($lebarkartu, $a, '', 1, 1, 'C', 0);
	$this->fpdf->cell(6,$a,'',1,0,'C',0);
	$this->fpdf->cell(20,$a,'',1,0,'C',0);
	$this->fpdf->cell(18,$a,'',1,0,'C',0);
	$this->fpdf->cell(18,$a,'',1,0,'C',0);
	$this->fpdf->cell(21,$a,'',1,0,'C',0);
	$this->fpdf->cell(12,$a,'',1,2,'C',0);
	if($kali == 1)
	{
		$this->fpdf->setX($kiri);
		$this->fpdf->Cell($lebarkartu, 9, '', 0, 1, 'C', 0);
	}
	$kali++;
	$hal++;
	$yy= 5;
	$y = $this->fpdf->getY();
	if($kali == 3) 
	{
		if($hal<=$halaman)
		{
			$this->fpdf->AddPage();
			$kali = 1;
			$y = 0;
		}
	}
}
$this->fpdf->Output("kartu_pembayaran_belakang_".$kelas.".pdf","I");
?>
