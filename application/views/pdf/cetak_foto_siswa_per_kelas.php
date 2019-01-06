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
$x=15;
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
   di footer, nanti kita akan membuat page number dengan format : number page / total page
*/
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetTitle("foto per kelas");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$ta  = $this->db->query("SELECT * from `siswa_kelas` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `no_urut` ASC");
$kali = 0;
$baris = 0;
$this->fpdf->setFont('Arial','',9);
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$foto ='';
	$namasiswa='';
	$jenkel = '';
	$tdatsis = $this->db->query("select `nis`,`foto`,`jenkel`,`nama` from `datsis` where `nis`='$nis'");
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
	if($kali>5)
	{
		$baris++; 
		$kali = 0;
	}
	if($kali == 0)
	{
		$l = 5;
	}
	else
	{
		$l = 33 * $kali + 5;
	}
	$y = 45 * $baris;
	if($baris == 0)
	{
		$t = 5;
	}
	else
	{
		$t = $y+5;
	}

	$this->fpdf->Image($this->config->item('folderfotosiswa').'/'.$foto.'',$l,$t,30,40);
	$kali++;

}

$this->fpdf->Output("foto.pdf","I");
exit();
?>
