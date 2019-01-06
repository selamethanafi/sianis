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

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetTitle("kartu tes");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->AddFont('free3of9');

// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
//query /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// nama tes]
//echo $teskd;
$namates='';
$pelaksanaan = '';
$tnamates = $this->db->query("SELECT * from nama_tes where id_nama_tes='$id_nama_tes'");
foreach($tnamates ->result() as $dnamates)
	{
	$namates = $dnamates->nama_tes;
	$pelaksanaan = $dnamates->pelaksanaan;
	}


$a=60;
$kali = 1;

$ygambarkiri = 8;
$xgambarkiri = 9;
$ygambarkanan = 9;
$xgambarkanan = 92;
$xtekskiri  = 15;
$ytekskiri  = 9;
$xtekskanan  = 88;
$ytekskanan  = 8;
$xgrskanan = 5;
$xgrskiri = 8;
$ygrskanan = 24;
$ygrskiri = 24;
$lkonan = 118;
$lkori = 71;
$tlogo = 40;
$llogo = 30;
$kiri = 8;
$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
foreach($tkepala->result() as $dkepala)
{
	$posisi_x = $dkepala->px_kartu;
	$posisi_y = $dkepala->py_kartu;
	$lebar = $dkepala->l_kartu;
	$tinggi = $dkepala->t_kartu;
}

$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$qnil  = $this->db->query("SELECT * from siswa_nomor_tes where kelas='$kelas' order by no_peserta DESC");
foreach($qnil->result() as $rnil)
{
$no_unik = $rnil->no_unik;
if (!empty($no_unik))
	{
	$y_nomor = $rnil->no_peserta.'-'.$no_unik;
	}
	else
	{
	$y_nomor = $rnil->no_peserta;
	}
	
$nis = $rnil->nis;
$noruang = $rnil->ruang;
$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
$foto ='';
$namasiswa='';
$kode = '';
$jenkel = '';
foreach($tdatsis->result() as $ddatsis)
	{
	$namasiswa = ucwords(strtolower($ddatsis->nama));
	$foto = $ddatsis->foto;
	$kode = $ddatsis->nis;
	$jenkel = $ddatsis->jenkel;
	}
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


	
$namafile="kosong";
// kolom kiri bagian 1
$this->fpdf->SetFont('Times','',8);
$xxx = $xgambarkiri;
$yyy = $ygambarkiri;
$this->fpdf->Image('images/depag.png',$xxx,$yyy,15,15);
$this->fpdf->SetXY($kiri+6,$ytekskiri);
$this->fpdf->setFont('Times','B',8);
$this->fpdf->cell($lkori,4,'KEMENTERIAN AGAMA',0,2,'C',0);
$this->fpdf->cell($lkori,4,$this->config->item('sek_nama'),0,2,'C',0);
$this->fpdf->setFont('Times','B',6);
$this->fpdf->cell($lkori,4,$this->config->item('sek_alamat'),0,2,'C',0);
$this->fpdf->setFont('Times','B',8);
$this->fpdf->SetXY($kiri,$ygrskiri);
$this->fpdf->Cell($lkori,0, '', 1, 0, 'C', 1);
$this->fpdf->SetXY($kiri,$ytekskiri+16);
$this->fpdf->cell($lkori,4,'Nomor Peserta',0,2,'C',0);
$this->fpdf->cell($lkori,4,''.$namates.'',0,2,'C',0);
$this->fpdf->cell($lkori,4,'Tahun Pelajaran '.$thnajaran.'',0,2,'C',0);
// nomor meja
$this->fpdf->setFont('Times','B',18);
$this->fpdf->SetXY($kiri+15,$ytekskiri+32);
$this->fpdf->cell($lkori-30,8,'Ruang '.$noruang.'',1,2,'C',0);
$this->fpdf->cell($lkori-30,8,''.$y_nomor.'',1,2,'C',0);

// kolom kanan bagian 1
$xxx = $xgambarkanan;
$yyy = $ygambarkanan;
$this->fpdf->Image('images/depag.png',$xxx,$yyy,15,15);
$this->fpdf->SetFont('Times','',8);
$this->fpdf->SetXY($xtekskanan+20,$ytekskiri);
$this->fpdf->setFont('Times','B',8);
$this->fpdf->cell($lkonan-20,4,'KEMENTERIAN AGAMA',0,2,'C',0);
$this->fpdf->cell($lkonan-20,4,$this->config->item('sek_nama'),0,2,'C',0);
$this->fpdf->cell($lkonan-20,4,$this->config->item('sek_alamat'),0,2,'C',0);
$this->fpdf->SetXY($xtekskanan,$ygrskanan);
$this->fpdf->Cell($lkonan,0, '', 1, 0, 'C', 1);

// nama tes
$this->fpdf->SetXY($xtekskanan,$ytekskanan+16);
$this->fpdf->cell($lkonan,4,'Kartu Peserta '.$namates.'',0,2,'C',0);
$this->fpdf->cell($lkonan,4,'Tahun Pelajaran '.$thnajaran.'',0,2,'C',0);
$this->fpdf->SetXY($xtekskanan+5,$ytekskanan+25);
$xxx = $xtekskanan+5;
$yyy = $this->fpdf->GetY();
$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto.'',$xxx,$yyy,22.5,30);
$this->fpdf->SetXY($xtekskanan+35,$ytekskanan+24);

$this->fpdf->cell(40,4,'Ruang',0,2,'L',0);
$this->fpdf->cell(40,4,'Nomor',0,2,'L',0);
$this->fpdf->cell(40,4,'Nama',0,2,'L',0);
$this->fpdf->SetXY($xtekskanan+60,$ytekskanan+24);
$this->fpdf->cell(40,4,': '.$noruang.'',0,2,'L',0);
$this->fpdf->cell(40,4,': '.$y_nomor.'',0,2,'L',0);
$this->fpdf->cell(40,4,': '.$namasiswa.'',0,2,'L',0);
$yyy = $this->fpdf->GetY();
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$posisiy = $posisi_y + $yyy;
$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x,$posisiy,$lebar,$tinggi);
$this->fpdf->SetXY($xtekskanan+35,$ytekskanan+36);
$this->fpdf->cell(40,4,$this->config->item('plt').'Kepala',0,2,'L',0);

$this->fpdf->SetXY($xtekskanan+35,$ytekskanan+47);
$this->fpdf->cell(40,4,$namakepala,0,2,'L',0);
$this->fpdf->cell(40,4,'NIP '.$nipkepala,0,0,'L',0);
$this->fpdf->SetFont('free3of9','',36);
$this->fpdf->cell(40,4,'*'.$nis.'*',0,2,'L',0);

$this->fpdf->setFont('Times','B',10);
// garis keliling kartu
if ($kali==1)
{
$this->fpdf->SetXY($kiri,5);
$this->fpdf->Cell($lkori, $a, '', 1, 0, 'C', 0);$this->fpdf->SetXY(88,5);$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
}
if ($kali==2)
{
$this->fpdf->SetXY($kiri,75);
$this->fpdf->Cell($lkori, $a, '', 1, 1, 'C', 0);$this->fpdf->SetXY(88,75);$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
}
if ($kali==3)
{
$this->fpdf->SetXY($kiri,146);
$this->fpdf->Cell($lkori, $a, '', 1, 1, 'C', 0);$this->fpdf->SetXY(88,146);$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
}
if ($kali==4)
{
$this->fpdf->SetXY($kiri,216);
$this->fpdf->Cell($lkori, $a, '', 1, 1, 'C', 0);$this->fpdf->SetXY(88,216);$this->fpdf->Cell(118, $a, '', 1, 1, 'C', 0);
}
$this->fpdf->SetXY(1,286);

$ygambarkiri = $ygambarkiri + 70;
$ytekskiri = $ytekskiri + 70;
$ygambarkanan = $ygambarkanan + 70;
$ytekskanan = $ytekskanan + 70;
$ygrskanan = $ygrskanan + 70;
$ygrskiri = $ygrskiri + 70;
$kali = $kali+1;

if ($kali > 4)
	{
	$kali = 1;
	$ygambarkiri = 8;
	$xgambarkiri = 10;
	$ygambarkanan = 8;
	$xgambarkanan = 95;
	$xtekskiri  = 15;
	$ytekskiri  = 9;
	$xtekskanan  = 88;
	$ytekskanan  = 8;
	$xgrskanan = 5;
	$xgrskiri = 8;
	$ygrskanan = 24;
	$ygrskiri = 24;
	$lkonan = 118;
	$lkori = 71;
	$tlogo = 40;
	$llogo = 30;
	$kiri = 8;
	$this->fpdf->AliasNbPages();
	$this->fpdf->AddPage();
	}
}

$this->fpdf->Output("kartu_tes_$kelas.pdf","I");
?>
