<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_masuk.php
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

//by selamet hanafi
/*    * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
*/
/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');
$this->fpdf->FPDF("P","cm","A4");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(2,2,2);
$lebar = 18;
$tinggi = 25.5;
$x=1.5;
$y = 3;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 7.5;
$ada = 0;
$tbr =0.4;
$selisihkanan = ($x - 0.5) * 2;
$lebar_logo = $lebar+$selisihkanan;
$tinggi_logo = 27.5;
$x_logo = 0.5;
$y_logo = 0.5;
$pilihanlogo = 1;
$te = $this->db->query("select * from `m_logo` limit 0,1");
foreach($te->result() as $e)
	{
	$lebar_logo = $e->lebar;
	$tinggi_logo = $e->tinggi;
	$separuh_lebar_logo = $lebar_logo / 2;
	$separuh_lebar = $lebar / 2;
	$x_logo = $separuh_lebar - $separuh_lebar_logo + $x;
	$y_logo = $e->posisi_y;
	$pilihanlogo = $e->pilihan;
	}
//pilihan 1 sebagai latar, 2 sebagai siluet
if($pilihanlogo == '1')
{
$selisihkanan = ($x - 0.5) * 2;
$lebar_logo = $lebar+$selisihkanan;
$tinggi_logo = 27.5;
$x_logo = 0.5;
$y_logo = 0.5;
}

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
// AddPage merupakan fungsi untuk membuat halaman baru
// Setting Font : String Family, String Style, Font size 

$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
$adasiswa = $tb->num_rows();
$namakepalaawal = cari_kepala($thnajaran,$semester);
$nipkepalaawal = cari_nip_kepala($thnajaran,$semester);
if ($adasiswa>0)
{
	foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$tdata_siswa=$this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tdata_siswa->result() as $a)
		{
		$pinsek = $a->pinsek;
		}
	$nisn = nisn($nis);
	$namasiswa = nis_ke_nama($nis);
	$this->fpdf->AddPage();
	if(!empty($pilihanlogo))
		{
		$this->fpdf->Image('images/latar.jpg',$x_logo,$y_logo,$lebar_logo,$tinggi_logo);
		}

	$this->fpdf->SetX($x,$y);
	$this->fpdf->SetFont('Arial','',12);
	$spasi3 = 0.8;
	$this->fpdf->Cell($lebar,$spasi3,'KETERANGAN MASUK SEKOLAH',0,2,'C',0);
	$this->fpdf->Cell($lebar,$spasi3,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,1,'NO',1,0,'C',0);
	$this->fpdf->Cell($lebar-1,1,'MASUK',1,2,'C',0);
	$yy1 = $this->fpdf->GetY();
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($lebar,0.3,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'1',0,0,'C',0);
	$this->fpdf->Cell(5,$spasi3,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->Cell(0.5,$spasi3,':',0,0,'L',0);
	$this->fpdf->MultiCell(5.5,$spasi3,$namasiswa,0,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'2',0,0,'C',0);
	$this->fpdf->Cell(5,$spasi3,'NIS / NISN',0,0,'L',0);
	$this->fpdf->Cell(0.5,$spasi3,':',0,0,'L',0);
	$this->fpdf->Cell(5.5,$spasi3,$nis.' / '.$nisn,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'3',0,0,'C',0);
	//cari apakah siswa pindahan
	$this->fpdf->Cell(5,$spasi3,'Nama Sekolah Asal',0,0,'L',0);
	$this->fpdf->Cell(0.5,$spasi3,':',0,0,'L',0);
	if (!empty($a->pinsek))
		{
		$this->fpdf->MultiCell(5.5,$spasi3,$a->pinsek,0,'L',0);
		}
		else
		{
		$this->fpdf->MultiCell(5.5,$spasi3,$a->sltp,0,'L',0);
		}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'4',0,0,'C',0);
	$this->fpdf->Cell(5,$spasi3,'Masuk di Sekolah ini:',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'',0,0,'C',0);
	$this->fpdf->Cell(5,$spasi3,'a. Tanggal',0,0,'L',0);
	$this->fpdf->Cell(0.5,$spasi3,':',0,0,'L',0);
	$this->fpdf->Cell(5.5,$spasi3,date_to_long_string($a->tglditerima),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'',0,0,'C',0);
	$this->fpdf->Cell(5,$spasi3,'b. Di kelas',0,0,'L',0);
	$this->fpdf->Cell(0.5,$spasi3,':',0,0,'L',0);
	$this->fpdf->Cell(5.5,$spasi3,$a->kls,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,$spasi3,'5',0,0,'C',0);
	$this->fpdf->Cell(5,$spasi3,'Tahun Pelajaran',0,0,'L',0);
	$this->fpdf->Cell(0.5,$spasi3,':',0,0,'L',0);
	$this->fpdf->Cell(5.5,$spasi3,$thnajaran,0,2,'L',0);
	$this->fpdf->SetXY($x+12,$yy1);
	$this->fpdf->Cell(6,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(6,$spasi3,$this->config->item('lokasi').', '.date_to_long_string($a->tglditerima),0,2,'C',0);
	$this->fpdf->Cell(6,$spasi3,$this->config->item('plt').'Kepala '.$this->config->item('sek_nama'),0,2,'C',0);
	$this->fpdf->Cell(6,2.4,'',0,2,'C',0);
	$this->fpdf->Cell(6,$spasi3,$namakepalaawal,0,2,'C',0);
	$this->fpdf->Cell(6,$spasi3,'NIP '.$nipkepalaawal,0,2,'C',0);
	$this->fpdf->Cell(6,1,'',0,2,'C',0);
	$yy2 = $this->fpdf->GetY();
	$selisih = $yy2 - $yy1;
	$this->fpdf->SetXY($x,$yy1);
	$this->fpdf->Cell(1,$selisih,'',1,0,'C',0);
	$this->fpdf->Cell(5,$selisih,'',1,0,'C',0);
	$this->fpdf->Cell(6,$selisih,'',1,0,'C',0);
	$this->fpdf->Cell(6,$selisih,'',1,2,'C',0);
	}
}
else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Arial','',8);
	$this->fpdf->SetXY($x,$y);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA',0,2,'C',0);
}
/* setting Cell untuk page number */

$namafile='keterangan_masuk_'.$nis.'_'.$namasiswa.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
