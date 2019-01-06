<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : nominasi.php
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

$this->fpdf->FPDF("P","mm","Legal");		
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("Nominasi Peserta Tes");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->SetKeywords("sistem, informasi, madrasah");
$this->fpdf->AddFont('free3of9');
$x = 15;
$y = 70;
$x2 = 20;
// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
//query /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// nama tes]
//echo $teskd;
$namates='';
$pelaksanaan = '';
$tnamates = $this->db->query("SELECT * from nama_tes where id_nama_tes='$id_nama_tes'");
foreach($tnamates->result() as $dnamates)
	{
	$namates = $dnamates->nama_tes;
	$pelaksanaan = $dnamates->pelaksanaan;
	}

$truang = $this->db->query("SELECT * from m_ruang");
$cacahruang = $truang->num_rows();
$ruange = 1;
do
{
	// cari ada penghuni atau tidak
	$tada = $this->db->query("SELECT * from `siswa_nomor_tes` where `ruang`='$ruange'");
	$ada = $tada->num_rows();
	// kalau ada
	if ($ada>0)
	{
	$this->fpdf->AddPage();
	$xxx = 20;
	$yyy = 15;
	$this->fpdf->Image('images/depag.png',$xxx,$yyy,15,15);
	$this->fpdf->SetXY($x2,15);
	$this->fpdf->setFont('Times','B',12);
	$this->fpdf->cell(180,5,'KEMENTERIAN AGAMA',0,2,'C',0);
	$this->fpdf->cell(180,5,$this->config->item('sek_nama'),0,2,'C',0);
	$this->fpdf->cell(180,5,$this->config->item('sek_alamat'),0,2,'C',0);
	$this->fpdf->cell(180,5,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(180,1,' ',1,2,'C',1);
	$this->fpdf->cell(180,5,' ',0,2,'C',0);
	$this->fpdf->cell(180,5,'DAFTAR NOMINASI',0,2,'C',0);
	$this->fpdf->cell(180,5,''.$namates.'',0,2,'C',0);
	$this->fpdf->cell(180,5,'TAHUN PELAJARAN '.$thnajaran.'',0,2,'C',0);
	$this->fpdf->cell(180,5,'RUANG '.$ruange.'',0,2,'C',0);

	$this->fpdf->SetX($x2);
	$this->fpdf->cell(180,3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->setFont('Times','',12);
	$qnil = $this->db->query("SELECT * from siswa_nomor_tes where ruang='$ruange' order by no_peserta");
	$nomor =1;
	$this->fpdf->cell(15,5,'Nomor',1,0,'C',0);
	$this->fpdf->cell(85,5,'Nama',1,0,'L',0);
	$this->fpdf->cell(40,5,'Kelas',1,0,'C',0);
	$this->fpdf->cell(30,5,'Nomor Tes',1,2,'C',0);
		foreach($qnil->result() as $rnil)
		{
		$nis = $rnil->nis;
		$namasiswa = ucwords(strtolower(nis_ke_nama($nis)));
		$kelas =$rnil->kelas;
		$no_unik = $rnil->no_unik;
		if (!empty($no_unik))
			{
			$y_nomor = $rnil->no_peserta.'-'.$no_unik;
			}
			else
			{
			$y_nomor = $rnil->no_peserta;
			}

		$nomortes = $y_nomor;
		$this->fpdf->SetX($x2);
		$this->fpdf->cell(15,5,$nomor,1,0,'C',0);
		$this->fpdf->cell(85,5,$namasiswa,1,0,'L',0);
		$this->fpdf->cell(40,5,$kelas,1,0,'C',0);
		$this->fpdf->cell(30,5,$nomortes,1,2,'C',0);
		$nomor++;
		}

	//$this->fpdf->AddPage();
	}
	$ruange++;
}
while ($ruange <= $cacahruang);
$namates = ''.$namates.'_'.$thnajaran.'';
//$this->fpdf->cell(3,3,'+',0,1,'L',0);

$this->fpdf->Output("daftar_nominasi_$namates.pdf","I");
exit();
?>
