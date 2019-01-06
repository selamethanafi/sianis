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

$this->fpdf->FPDF("P","mm","A4");

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
$baris = 1;
$y = 2;
$lkolom = 84;
$kiri = 8;
$tkepala = $this->Nilai_model->Kepala($thnajaran,$semester);
foreach($tkepala->result() as $dkepala)
{
	$posisi_x = $dkepala->px_kartu;
	$posisi_y = $dkepala->py_kartu;
	$lebar = $dkepala->l_kartu;
	$tinggi = $dkepala->t_kartu;
}
	$posisi_xx = $posisi_x - 85;
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$qnil  = $this->db->query("SELECT * from `siswa_kelas` where kelas='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester'  order by no_urut DESC");
$no= 1;
foreach($qnil->result() as $rnil)
{
	$nis = $rnil->nis;
	$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
	$foto ='';
	$namasiswa='';
	$kode = '';
	$jenkel = '';
	foreach($tdatsis->result() as $ddatsis)
	{
		$namasiswa = ucwords(strtolower($ddatsis->nama));
		$foto = $ddatsis->foto;
		$password = $ddatsis->password_tes;
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
	// kolom kiri bagian 1
	$this->fpdf->SetFont('Times','',8);
	$this->fpdf->Image('images/depag.png',$kiri+2,$y,10,10);
	$this->fpdf->SetXY($kiri+6,$y);
	$this->fpdf->setFont('Times','B',8);
	$this->fpdf->cell($lkolom,4,$baris1kartu,0,2,'C',0);
	$this->fpdf->cell($lkolom,4,$baris2kartu,0,2,'C',0);
	$this->fpdf->setFont('Times','B',6);
	$this->fpdf->cell($lkolom,4,$baris3kartu,0,2,'C',0);
	$this->fpdf->setFont('Times','B',8);
	$this->fpdf->SetX($kiri);
	$this->fpdf->Cell($lkolom,1, '', 0, 2, 'C', 1);
	$this->fpdf->SetX($kiri);
	$this->fpdf->Cell($lkolom,1, '', 0, 2, 'C', 0);

	// nama tes
	$this->fpdf->SetX($kiri);
	$this->fpdf->cell($lkolom,3,'Kartu Peserta Tes Daring '.$namates.'',0,2,'C',0);
	$this->fpdf->cell($lkolom,3,'Tahun Pelajaran '.$thnajaran.'',0,2,'C',0);
	$this->fpdf->SetX($kiri+25);
	$this->fpdf->cell(15,1,'',0,2,'L',0);
	$this->fpdf->SetX($kiri+25);
	$this->fpdf->cell(15,3,'Nama',0,0,'L',0);
	$this->fpdf->cell(5,3,':',0,0,'L',0);
	$this->fpdf->MultiCell(40,3,$namasiswa,0,'L',0);
	$yyy = $this->fpdf->GetY();
	$yfoto = $yyy;
	$this->fpdf->SetX($kiri+25);
	$this->fpdf->cell(15,3,'Username',0,0,'L',0);
	$this->fpdf->cell(5,3,':',0,0,'L',0);
	$this->fpdf->cell(40,3,$nis,0,2,'L',0);
	$this->fpdf->SetX($kiri+25);
	$this->fpdf->cell(15,3,'Password',0,0,'L',0);
	$this->fpdf->cell(5,3,':',0,0,'L',0);
	$this->fpdf->cell(40,3,$password,0,2,'L',0);
	$yyy = $this->fpdf->GetY();
	$xxx = $kiri+2;
	$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto.'',$xxx,$yfoto,18,22);

	$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
	$posisiy = $posisi_y + $yyy;
	$this->fpdf->Image('images/ttd/'.$ttdkepala,$posisi_xx,$posisiy,$lebar,$tinggi);
	$this->fpdf->SetXY($kiri+30,$yyy);
	$this->fpdf->cell(40,3,$plt.'Kepala',0,2,'L',0);
	$this->fpdf->SetXY($kiri+30,$yyy+10);
	$this->fpdf->cell(40,3,$namakepala,0,2,'L',0);
	$this->fpdf->cell(40,3,'NIP '.$nipkepala,0,2,'L',0);
	$yyy = $this->fpdf->GetY();

	  if($no%2!=0)
	{
		$kiri  = 110;
		$xgrs = 100;
		$xgambar = 105;
		$kiri = 103;
		$posisi_xx = $posisi_x + 10;
	}
	else
	{
		$kiri  = 8;
		$y = $yyy + 10;
		$posisi_xx = $posisi_x - 85;
		$baris = $baris+1;
	}
	$no++;

	if ($baris > 5)
	{
		$baris = 1;
		$y = 5;
		$lkolom = 84;
		$kiri = 8;
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
	}
}
$this->fpdf->Output("kartu_tes_versi_2_$kelas.pdf","I");
?>
