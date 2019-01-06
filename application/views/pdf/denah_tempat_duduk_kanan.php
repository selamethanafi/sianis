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
	if($barisnya < 6)
	{
	do
	{
		if ($kolom > 4)
		{$kolom = 1;}
		$kolome = 'kanan'.$kolom;
		$nis = $a->$kolome;
		$namasiswa = nis_ke_nama($nis);
		$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
		$foto ='';
		$jenkel='';
		foreach($tdatsis->result() as $ddatsis)	
		{
			$foto = $ddatsis->foto;
			$kode = $ddatsis->nis;
			$jenkel = $ddatsis->jenkel;
		}
//		$foto = '';
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
		if($kolom == 1)
		{
			$yyy = $yyy + 5;
		}
		$yne = $yyy+(($barisnya - 1)*45);
		//pojok kiri atas bingkai
		$ypojokkiriatas = $yne-2;
		$xpojokkiriatas = $x4;
		//tinggi binkai = 
		$this->fpdf->SetY($yne);
		if(!empty($nis))
		{
			//aslin 30 * 40
			$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto.'',$xxx+3,$yne,25,33);
		}
		$this->fpdf->SetY($yne+35);
		$this->fpdf->SetX($x4+2);
		$this->fpdf->MultiCell(37,4,$namasiswa,0,'C',0);
	//	$this->fpdf->cell(40,3,$namasiswa,0,1,'C',0);	
		$this->fpdf->SetY($yne+43);
		$this->fpdf->SetX($x4+2);
		$this->fpdf->cell(37,4,$y_nomor,0,0,'C',0);
		$this->fpdf->SetXY($xpojokkiriatas,$ypojokkiriatas);
		if($barisnya>0)
		{
			$this->fpdf->cell(40,50,'',1,1,'C',0);
		}
		$kolom++;
	}
	while ($kolom <5);
	} // sementara hanya 5 baris
}
$this->fpdf->Output("denah_tempat_duduk_ruang_tunggal_ruang_".$ruang.".pdf","I");
?>
