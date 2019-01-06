<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_keluar.php
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
$this->fpdf->FPDF("P","cm","Legal");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(2,2,2);
$lebar = 18;
$tinggi = 25.5;
$x=1.5;
$y = 2;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
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

$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
$adasiswa = $tb->num_rows();
$namakepalaawal = cari_kepala($thnajaran,$semester);
$nipkepalaawal = cari_nip_kepala($thnajaran,$semester);
$adasiswa = $tb->num_rows();
if ($adasiswa>0)
{
	foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$kelasditinggalkan = $b->kelas;
	$tdata_siswa=$this->db->query("select * from `datsis` where `nis`='$nis'");
		foreach($tdata_siswa->result() as $a)
		{
		$namasiswa = $a->nama;		
		$alasankeluar = $a->alasankeluar;
		$tanggalkeluar = date_to_long_string($a->tanggalkeluar);
		$this->fpdf->AddPage();
		if(!empty($pilihanlogo))
			{
			$this->fpdf->Image('images/latar.jpg',$x_logo,$y_logo,$lebar_logo,$tinggi_logo);
			}
		$this->fpdf->SetX($x,$y);
		$this->fpdf->SetFont('Arial','',12);
		$this->fpdf->SetXY($x,$y);
		$this->fpdf->Cell(18,0.5,'KETERANGAN MENINGGALKAN SEKOLAH',0,2,'C',0);
		$this->fpdf->Cell(18,0.5,'NAMA PESERTA DIDIK : '.$namasiswa,0,2,'C',0);
		$this->fpdf->Cell(18,0.5,'',0,2,'C',0);
		$this->fpdf->Cell(18,1,'KELUAR',1,2,'C',0);
		$this->fpdf->Cell(4,1.8,'Tanggal',1,0,'C',0);
		$yy = $this->fpdf->GetY();
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->Cell(3,0.6,'Kelas',0,2,'C',0);
		$this->fpdf->Cell(3,0.6,'yang',0,2,'C',0);
		$this->fpdf->Cell(3,0.6,'Ditinggalkan',0,2,'C',0);
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->Cell(3,1.8,'',1,2,'C',0);
		$this->fpdf->SetXY($x+7,$yy);
		$this->fpdf->Cell(5,0.6,'Sebab-sebab Keluar',0,2,'C',0);
		$this->fpdf->Cell(5,0.6,'atau Atas Permintaan',0,2,'C',0);
		$this->fpdf->Cell(5,0.6,'(Tertulis)',0,2,'C',0);
		$this->fpdf->SetXY($x+7,$yy);
		$this->fpdf->Cell(5,1.8,'',1,2,'C',0);
		$this->fpdf->SetXY($x+12,$yy);
		$this->fpdf->Cell(6,0.6,'Tanda Tangan Kepala Sekolah,',0,2,'C',0);
		$this->fpdf->Cell(6,0.6,'Stempel Sekolah, dan',0,2,'C',0);
		$this->fpdf->Cell(6,0.6,'Tanda Tangan Orang Tua/Wali',0,2,'C',0);
		$this->fpdf->SetXY($x+12,$yy);
		$this->fpdf->Cell(6,1.8,'',1,2,'C',0);
		$this->fpdf->SetX($x);
		$yy1 = $this->fpdf->GetY();
		$this->fpdf->Cell(4,0.5,'',0,2,'C',0);
		$yy = $this->fpdf->GetY();
		$this->fpdf->Cell(4,0.8,$tanggalkeluar,0,0,'C',0);
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->Cell(3,0.8,$kelasditinggalkan,0,2,'C',0);
		$this->fpdf->Cell(3,1.6,'',0,2,'C',0);
		$this->fpdf->SetXY($x+4,$yy);
		$this->fpdf->SetXY($x+7,$yy);
		if(empty($a->nosurat))
			{
			$this->fpdf->MultiCell(5,0.6,$alasankeluar,0,'C',0);
			}
			else
			{
			$this->fpdf->MultiCell(5,0.6,$alasankeluar.'. Nomor surat pindah / keluar '.$a->nosurat,0,'C',0);
			}
		$this->fpdf->SetXY($x+7,$yy);
		$this->fpdf->SetXY($x+12,$yy);
		$this->fpdf->Cell(6,0.6,$this->config->item('lokasi').', '.$tanggalkeluar,0,2,'C',0);
		$this->fpdf->Cell(6,0.6,$this->config->item('plt').'Kepala '.$this->config->item('sek_nama'),0,2,'C',0);
		$this->fpdf->Cell(6,2.4,'',0,2,'C',0);
		$this->fpdf->Cell(6,0.6,$namakepalaawal,0,2,'C',0);
		$this->fpdf->Cell(6,0.6,'NIP '.$nipkepalaawal,0,2,'C',0);
		$this->fpdf->Cell(6,1.2,'',0,2,'C',0);
		$this->fpdf->SetX($x+12);
		$this->fpdf->Cell(6,0.6,'Orang Tua/Wali,',0,2,'C',0);
		$this->fpdf->Cell(6,2.1,'',0,2,'C',0);
		$this->fpdf->Cell(6,0.6,'_________________________',0,2,'C',0);
		$this->fpdf->Cell(6,1,'',0,2,'C',0);
		$yy2 = $this->fpdf->GetY();
		$selisih = $yy2 - $yy1;
		$this->fpdf->SetXY($x,$yy1);
		$this->fpdf->Cell(4,$selisih,'',1,0,'C',0);
		$this->fpdf->Cell(3,$selisih,'',1,0,'C',0);
		$this->fpdf->Cell(5,$selisih,'',1,0,'C',0);
		$this->fpdf->Cell(6,$selisih,'',1,2,'C',0);
		}
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

$namafile='keterangan_keluar_'.$nis.'_'.$namasiswa.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
