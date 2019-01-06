<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_sampul.php
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
$this->fpdf->SetTitle("Sampul LCK");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$pilihanlogo = 1;
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$lebar = 17.5;
$tinggi = 30;
$x=0;
$xx = 2;
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


// Setting Font : String Family, String Style, Font size 
$tdata_siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester' and kelas='$kelas' and status='Y' order by no_urut ASC");
$thnajaranx = str_replace("/", "_", $thnajaran);
$adasiswa = $tdata_siswa->num_rows();
if ($adasiswa>0)
{
	foreach($tdata_siswa->result() as $a)
	{	
	$nis= $a->nis;
	$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by `thnajaran` ASC limit 0,1");
	foreach($tb->result() as $b)
	{
		$thnajaran = $b->thnajaran;
		$semester = $b->semester;
		$kelas = $b->kelas;
	}
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

	$nisn = nisn($nis);
	$namasiswa = nis_ke_nama($nis);
	$fotosiswa = cari_foto($nis);
	$this->fpdf->AddPage();
	$this->fpdf->SetX($x+$xx,$y);
	$this->fpdf->SetLineWidth(0.3);
	$this->fpdf->SetDrawColor(0,80,180);
	$this->fpdf->SetFillColor(255,255,255);
    	$this->fpdf->SetTextColor(220,50,50);
	//bingkai
    	$this->fpdf->Cell($lebar,$tinggi,'',1,1,'C',true);
	$this->fpdf->Image('images/logo.jpg',7.5,4,6,6);
	$this->fpdf->SetFont('Times','',8);

	$this->fpdf->SetXY($x+$xx,12);
	$this->fpdf->setFont('Arial','',14);
	$this->fpdf->Cell($lebar,0.8,$baris1,0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,$baris2,0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,strtoupper($this->config->item('sek_nama')),0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,strtoupper($this->config->item('sek_kab')),0,2,'C',0);
    	$this->fpdf->SetTextColor(0,0,0);
	$this->fpdf->SetDrawColor(0,0,0);
	$this->fpdf->SetFillColor(255,255,255);
	$this->fpdf->SetLineWidth(0);
	$this->fpdf->SetXY(6,16);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell(9,0.8,'Nama Peserta Didik',0,2,'C',0);
	$this->fpdf->Cell(9,0.8,$namasiswa,1,2,'C',0);
	$this->fpdf->Cell(9,0.8,'NIS/NISN : '.$nis.' / '.$nisn,1,2,'C',0);
	$this->fpdf->SetXY($x+$xx,25);
	$this->fpdf->setFont('Arial','',12);
	$this->fpdf->Cell($lebar,0.8,'KEMENTERIAN AGAMA',0,2,'C',0);
	$this->fpdf->Cell($lebar,0.8,'REPUBLIK INDONESIA',0,2,'C',0);
	} //akhir ada siswa
}

else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->SetXY(1.5,1.0);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA',0,2,'C',0);
}
/* setting Cell untuk page number */

$namafile='sampul_lck_kelas_'.$kelas.'_'.$thnajaranx.'_semester_'.$semester.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
