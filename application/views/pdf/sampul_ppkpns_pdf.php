<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 10 Jan 2015 21:40:31 WIB 
// Nama Berkas 		: sampul_ppkpns_pdf.php
// Lokasi      		: application/views/pdf/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
$x = 2;
$x2 = $x+2;
$y = 7;
$x1 = 2;
$tinggi = 0.8;
$tinggi2 = 1;

	$awal = $tahunpenilaian ;
	$akhir = $tahunpenilaian + 1;
	$thnajaran = $awal."/".$akhir;
	$semester = 2;
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nip' and `tahun`='$tahunpenilaian'");
$idskawal = '';
$idskakhir = '';
$tawal = '';
$takhir = '';
foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
	$tawal = $b->tawal;
	$takhir = $b->takhir;
}
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);
$tc = $this->db->query("select * from `pkg_masa` where tahun = '$tahunpenilaian'");
foreach($tc->result() as $c)
	{
	$tpejabat = $c->tpejabat;
 	$tybs = $c->tybs;
	$tatasanpejabat = $c->tatasanpejabat;
	$t1 = $c->awal;
	$t2 = $c->akhir;

	}
$bisa = 0;
$bisa2 = 0;
$bisa1= 0;
$pesan = '';
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nip'");
$permanen = 0;
foreach($tz->result() as $z)
	{
	$permanen = $z->kepala;
	}

if($permanen == 1)
{
$bisa = 1;
}
else
{
$bisa = 0;
$pesan .= ' Hasil SKP belum permanen';
}
//cari skp
//akhir skp
if ($bisa == 1)
{
$this->fpdf->FPDF("P","cm","Legal");		
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("Penilaian Prestasi Kerja PNS");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->SetKeywords("sistem, informasi, madrasah");
// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
$this->fpdf->AddPage();
$xxx = 9.5;
$yyy = 2;
$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2.5,2.5);
$this->fpdf->SetXY($x,5);
$this->fpdf->setFont('Times','',16);
$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,'PENILAIAN PRESTASI KERJA',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,'Jangka Waktu Penilaian',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,date_to_long_string($t1).' s.d. '.date_to_long_string($t2),0,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetX($x);
$this->fpdf->cell(18,3*$tinggi,'',0,2,'C',0);
$this->fpdf->SetX($x2);
$this->fpdf->setFont('Times','',14);
$this->fpdf->cell(6,$tinggi2,'Nama Pegawai',0,0,'L',0);
$this->fpdf->setFont('Times','B',14);
$this->fpdf->cell(10,$tinggi2,': '.cari_nama_pegawai($kodeguru),0,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->setFont('Times','',14);
$this->fpdf->cell(6,$tinggi2,'NIP',0,0,'L',0);
$this->fpdf->cell(10,$tinggi2,': '.cari_nip_pegawai($kodeguru),0,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(6,$tinggi2,'Pangkat, Golongan ruang',0,0,'L',0);
$this->fpdf->cell(10,$tinggi2,': '.$pangkat2.' / '.$gol2,0,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(6,$tinggi2,'Jabatan',0,0,'L',0);
$this->fpdf->cell(10,$tinggi2,': '.$jabatan2,0,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(6,$tinggi2,'Unit Kerja',0,0,'L',0);
$this->fpdf->cell(10,$tinggi2,': '.$this->config->item('unit_kerja'),0,2,'L',0);
$this->fpdf->SetXY($x,30);
$this->fpdf->cell(18,$tinggi,strtoupper($this->config->item('unit_kerja')),0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(18,$tinggi,'TAHUN '.$tahunpenilaian,0,2,'C',0);

}
else
{
	$this->fpdf->FPDF("P","cm","A4");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Sampul Penilaian Prestasi Kerja PNS");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	$x = 1.5;
	$y1 = 3;
	$x1 = 2;
	$this->fpdf->AddPage();
	$xxx = 9;
	$yyy = 3;
	$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2.5,2.5);
	$this->fpdf->SetXY($x,5.5);
	$this->fpdf->setFont('Times','',12);
	$this->fpdf->cell(18,$tinggi,'PENILAIAN PRESTASI KERJA',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->MultiCell(18,0.4,'an '.cari_nama_pegawai($kodeguru).' '.$pesan,0,'L',0);
}

$this->fpdf->Output('sampul_penilaian_prestasi_kerja_'.$tahunpenilaian.'_'.$kodeguru.'.pdf',"I");
?>
