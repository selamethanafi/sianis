<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_identitas_sekolah.php
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

/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');

$folderfotosiswa = $this->config->item('folderfotosiswa');

$this->fpdf->FPDF("P","cm","Legal");
$this->fpdf->SetTitle("Identitas Sekolah");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(2,2,2);
$lebar = 17.5;
$tinggi = 30;
$x = 2;
$y = 3;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();

// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();
	$semester = '1';
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
	if($kurikulum == '2015')
	{
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_1_identitas_sekolah_2015'");
		foreach($ta->result() as $a)
		{
			$baris1 = $a->nilai;
		}
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_2_identitas_sekolah_2015'");
		foreach($ta->result() as $a)
		{
			$baris2 = $a->nilai;
		}
	}
	elseif($kurikulum == '2013')
	{
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_1_identitas_sekolah_2013'");
		foreach($ta->result() as $a)
		{
			$baris1 = $a->nilai;
		}
		$ta = $this->db->query("select * from `m_referensi` where `opsi`='baris_2_identitas_sekolah_2013'");
		foreach($ta->result() as $a)
		{
			$baris2 = $a->nilai;
		}
	}
	else
	{
		$baris1 = 'LAPORAN HASIL BELAJAR';
		$baris2 = 'PESERTA DIDIK';
	}

// Setting Font : String Family, String Style, Font size 
	$this->fpdf->SetX($x,$y);

		$this->fpdf->SetLineWidth(0.3);
		$this->fpdf->SetDrawColor(0,80,180);
		$this->fpdf->SetFillColor(255,255,255);
	    	$this->fpdf->SetTextColor(220,50,50);
		//bingkai
	    	//$this->fpdf->Cell($lebar,$tinggi,'',1,1,'C',true);
	$this->fpdf->SetXY($x,4);
	$this->fpdf->setFont('Arial','',14);
	$this->fpdf->Cell($lebar,0.8,$baris1,0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,$baris2,0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,strtoupper($this->config->item('sek_nama')),0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,strtoupper($this->config->item('sek_kab')),0,2,'C',0);
    	$this->fpdf->SetTextColor(0,0,0);
	$this->fpdf->SetDrawColor(0,0,0);
	$this->fpdf->SetFillColor(255,255,255);
	$this->fpdf->SetXY($x+1,10);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell(4,0.6,'Nama Sekolah',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_nama'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'NPSN/NSS',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_npsn').' / '.$this->config->item('sek_nss'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Alamat Sekolah',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_alamat'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Kelurahan',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_desa'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Kecamatan',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_kec'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Kabupaten/Kota',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_kab'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Provinsi',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_prov'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'Website',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_website'),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->Cell(4,0.6,'E-mail',0,0,'L',0);
	$this->fpdf->Cell(8,0.6,': '.$this->config->item('sek_email'),0,2,'L',0);
	$this->fpdf->SetLineWidth(0);
	$this->fpdf->SetXY($x,25);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell($lebar,0.8,'KEMENTERIAN AGAMA',0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,'REPUBLIK INDONESIA',0,2,'C',0);

/* setting Cell untuk page number */

$namafile='identitas_sekolah.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
