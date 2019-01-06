<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : denah_tempat_duduk.php
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

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("kartu tes");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->AddFont('free3of9');
$namates='';
$tnamates = $this->db->query("SELECT * from nama_tes where id_nama_tes='$id_nama_tes'");
foreach($tnamates->result() as $dnamates)
	{
	$namates = $dnamates->nama_tes;
	$pelaksanaan = $dnamates->pelaksanaan;
	}
$totalbaris = 1;
$ta=$this->db->query("select * from `siswa_denah_tempat_duduk` where `ruang`='$ruang' order by baris");
$this->fpdf->AddPage();
$x = 15;
$x = 15;
$y = 10;
$x2 = 40;
$this->fpdf->Image('images/depag.png',$x,$y,15,15);
$this->fpdf->SetXY($x,$y);
$this->fpdf->setFont('Times','B',12);
$this->fpdf->cell(180,5,'KEMENTERIAN AGAMA',0,2,'C',0);
$this->fpdf->cell(180,5,$this->config->item('sek_nama'),0,2,'C',0);
$this->fpdf->cell(180,5,$this->config->item('sek_alamat'),0,2,'C',0);
$this->fpdf->cell(180,5,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(180,1,' ',1,2,'C',1);
$this->fpdf->cell(180,5,' ',0,2,'C',0);
$this->fpdf->cell(180,5,'DENAH TEMPAT DUDUK PESERTA',0,2,'C',0);
$this->fpdf->cell(180,5,''.strtoupper($namates).'',0,2,'C',0);
$this->fpdf->cell(180,5,'TAHUN PELAJARAN '.$thnajaran.'',0,2,'C',0);
$this->fpdf->cell(180,5,'RUANG '.$ruang.'',0,2,'C',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(180,3,' ',0,2,'C',0); // spasi kosong
$this->fpdf->setFont('Times','',12);
$this->fpdf->SetX(75);
$this->fpdf->cell(60,5,'MEJA PENGAWAS',1,1,'C',0);
$this->fpdf->cell(180,3,' ',0,2,'C',0); // spasi kosong
//data siswa
$x3=25;
$yyy = $this->fpdf->GetY();
$kolom = 1;
foreach($ta->result() as $a)
{
	$barisnya = $a->baris;
	do
	{
	if ($kolom > 4)
		{$kolom = 1;}
	$kolome = 'kiri'.$kolom;
	$kolome2 = 'kanan'.$kolom;
	$nis = $a->$kolome;
	$nis2 = $a->$kolome2;	
	$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
	$foto ='';
	$jenkel='';
	foreach($tdatsis->result() as $ddatsis)
	{
		$foto = $ddatsis->foto;
		$kode = $ddatsis->nis;
		$jenkel = $ddatsis->jenkel;
	}
//	$foto = '';
	if (empty($foto))
		{	
		if ($jenkel == 'Laki-laki')
			{
			$foto = 'putra.jpg';
			}
		else if ($jenkel == 'Perempuan')
			{
			$foto = 'putri.jpg';
			}
		else 
			{
			$foto = 'mbuh.jpg';
			}
		}
	$y_nomor = '';
	$tb = $this->db->query("select * from `siswa_nomor_tes` where nis = '$nis'");
	foreach($tb->result() as $b)
	{
		$no_unik = $b->no_unik;
		if (!empty($no_unik))
			{
			$y_nomor = $b->no_peserta.'-'.$no_unik;
			}
			else
			{
			$y_nomor = $b->no_peserta;
			}
	}
	$tdatsis2 = $this->db->query("select * from datsis where nis = '$nis2'");
	$foto2 ='';
	$jenkel2='';
	foreach($tdatsis2->result() as $ddatsis2)
	{
		$foto2 = $ddatsis2->foto;
		$kode2 = $ddatsis2->nis;
		$jenkel2 = $ddatsis2->jenkel;
	}
//	$foto2 = '';
	if (empty($foto2))
		{	
		if ($jenkel2 == 'Laki-laki')
			{
			$foto2 = 'putra.jpg';
			}
		else if ($jenkel2 == 'Perempuan')
			{
			$foto2 = 'putri.jpg';
			}
		else 
			{
			$foto2 = 'mbuh.jpg';
			}
		}
	$y_nomor2 = '';
	$tb2 = $this->db->query("select * from `siswa_nomor_tes` where nis = '$nis2'");
	foreach($tb2->result() as $b2)
	{
		$no_unik2 = $b2->no_unik;
		if (!empty($no_unik2))
			{
			$y_nomor2 = $b2->no_peserta.'-'.$no_unik2;
			}
			else
			{
			$y_nomor2 = $b2->no_peserta;
			}
	}
		if ($kolom == 4)
			{
			$x4 = $x3+120;

			}
		if ($kolom == 3)
			{
			$x4 = $x3+80;

			}
		if ($kolom == 2)
			{
			$x4= $x3+40;
			}
		if ($kolom == 1)
			{
			$x4 = $x3;

			}

	$this->fpdf->SetX($x4);
	$xxx = $x4+5;
	$yne = $yyy+(($barisnya - 1)*30);
	$this->fpdf->SetY($yne);
	if(!empty($nis))
		{
		$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto.'',$xxx,$yne,18,24);
		}
	$xxx2 = $x4+5+18;
	if(!empty($nis2))
		{
		$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto2.'',$xxx2,$yne,18,24);
		}

	$this->fpdf->SetY($yne+25);
	$this->fpdf->SetX($x4+5);
	$this->fpdf->setFont('Times','',10);
	$this->fpdf->cell(18,3,substr($y_nomor,-5),0,0,'C',0);
	$this->fpdf->cell(18,3,substr($y_nomor2,-5),0,2,'C',0);		
	$kolom++;
	}
	while ($kolom <5);
}
$this->fpdf->Output("denah_tempat_duduk_ruang_tunggal".$ruang.".pdf","I");
?>
