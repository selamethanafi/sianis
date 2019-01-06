<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : masuk_lhb.php
// Lokasi      : application/views/pdf
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

/*    * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
*/
/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');
$this->fpdf->FPDF("P","cm","A4");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(2,2,2);
$lebar_kertas = 18;
$tinggi_kertas = 27;
$x=1.5;
$y = 3;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;
$tbr =0.4;

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
// AddPage merupakan fungsi untuk membuat halaman baru
// Setting Font : String Family, String Style, Font size 
$tdata_siswa=$this->db->query("select * from `datsis` where `nis`='$nis'");
$adasiswa = $tdata_siswa->num_rows();
if ($adasiswa>0)
{
	foreach($tdata_siswa->result() as $a)
		{
		$pinsek = $a->pinsek;
		}
		$namakepalaawal ='';
		$nipkepalaawal = '';
		$semester = 1;
		$thnajaran = '';
		$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by `thnajaran` ASC,`semester` ASC limit 0,1");
		foreach($tb->result() as $b)
			{
			$thnajaran = $b->thnajaran;
			$thnajaranawal = $b->thnajaran;
			$semester = $b->semester;
			}
		if (!empty($thnajaran))
			{
			$namakepalaawal = cari_kepala($thnajaran,$semester);
			$nipkepalaawal = cari_nip_kepala($thnajaran,$semester);
			}
	
	$nisn = nisn($nis);
	$namasiswa = nis_ke_nama($nis);
	$this->fpdf->AddPage();
	$this->fpdf->SetX($x,$y);
	$spasi3 = 0.8;
	$this->fpdf->SetFont('Arial','',12);
	$this->fpdf->SetXY($x,2);
	$this->fpdf->Cell(18,$spasi3,'KETERANGAN MASUK SEKOLAH',0,2,'C',0);
	$this->fpdf->Cell(18,$spasi3,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(1,1,'NO',1,0,'C',0);
	$this->fpdf->Cell(17,1,'MASUK',1,2,'C',0);
	$yy1 = $this->fpdf->GetY();
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
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
	$this->fpdf->Cell(5.5,$spasi3,$thnajaranawal,0,2,'L',0);
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
else
{
	$this->fpdf->AddPage();
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
