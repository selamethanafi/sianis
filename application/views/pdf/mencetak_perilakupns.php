<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 10 Jan 2015 21:40:31 WIB 
// Nama Berkas 		: mencetak_perilakupns_pdf.php
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
$y = 2;
$x1 = 2;
$tinggi = 0.8;
$tinggi2 = 1.6;
$tinggi3 = 6;
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
$tc = $this->db->query("select * from `pkg_masa` where tahun = '$tahunpenilaian'");
foreach($tc->result() as $c)
{
	$t1 = $c->awal;
	$t2 = $c->akhir;
}
$tanggalawal = date_to_long_string($t1);
$tanggalakhir = date_to_long_string($t2);
$bisa = 0;
$bisa2 = 0;
$bisa1= 0;
$pesan = '';
$hasil_skp = '-';
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$nip'");
$permanen = 0;
foreach($tz->result() as $z)
	{
	$permanen = $z->kepala;
	$hasil_skp = $b->skp;
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
if ($bisa == 1)
{
	$td = $this->db->query("select * from `perilaku_pns` where tahun = '$tahunpenilaian' and `nip` = '$nip' order by bulan");
	$pelayanan = 0;
	$komitmen = 0;
	$integritas = 0;
	$disiplin = 0;
	$kerjasama = 0;
	$kepemimpinan = 0;
	foreach($td->result() as $d)
	{
		$pelayanan = $pelayanan + $d->pelayanan;
		$komitmen = $komitmen + $d->komitmen;
		$integritas = $integritas + $d->integritas;
		$disiplin = $disiplin + $d->disiplin;
		$kerjasama = $kerjasama + $d->kerjasama;
		$kepemimpinan = $kepemimpinan + $d->kepemimpinan;
	}
	if((empty($hasil_skp)) or ($hasil_skp == 0))
	{
		$hasil_skp = '-';
	}
	$pelayanan = round($pelayanan / 12,2);
	$komitmen = round($komitmen / 12,2);
	$integritas = round($integritas / 12,2);
	$disiplin = round($disiplin / 12,2);
	$kerjasama = round($kerjasama / 12,2);
	$kepemimpinan = round($kepemimpinan / 12,2);
	$jumlahperilaku = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;
	$rataperilaku = round($jumlahperilaku / 5,2);


	$this->fpdf->FPDF("P","cm","Legal");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Penilaian Perilaku PNS");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
	$this->fpdf->AddPage();
	$this->fpdf->SetXY($x,$y);
	$this->fpdf->setFont('Times','',16);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'BUKU CATATAN PERILAKU PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Times','',10);
	$this->fpdf->cell(6,$tinggi,'Nama',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,': '.cari_nama_pegawai($kodeguru),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(6,$tinggi,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,': '.cari_nip_pegawai($kodeguru),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(6,$tinggi,'Unit organisasi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi,': '.$this->config->item('sek_nama'),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(6,$tinggi,'',0,2,'L',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi2,'No',1,0,'C',0);
	$this->fpdf->cell(4,$tinggi2,'Tanggal',1,0,'C',0);
	$this->fpdf->cell(7,$tinggi2,'Uraian',1,0,'C',0);
	$this->fpdf->cell(6,$tinggi,'Nama/NIP dan',0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->cell(6,$tinggi,'Paraf Pejabat Penilai',0,2,'C',0);
	$this->fpdf->SetXY($x+12,$y1);
	$this->fpdf->cell(6,$tinggi2,'',1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi,'1',1,0,'C',0);
	$this->fpdf->cell(4,$tinggi,'2',1,0,'C',0);
	$this->fpdf->cell(7,$tinggi,'3',1,0,'C',0);
	$this->fpdf->cell(6,$tinggi,'4',1,2,'C',0);
	$y1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$tinggi,'1',0,0,'C',0);
	$this->fpdf->cell(4,$tinggi,$tanggalawal,0,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(4,$tinggi,'s.d.',0,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(4,$tinggi,$tanggalakhir,0,2,'C',0);
	$this->fpdf->SetXY($x+5,$y1);
	$t = 0.6;
	$this->fpdf->SetX($x+5);
	$this->fpdf->MultiCell(7,$t,'Penilaian SKP sampai dengan akhir Desember '.$tahunpenilaian.' = '.$hasil_skp,0,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->MultiCell(7,$t,'Penilaian perilaku kerja sebagai berikut:',0,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Orientasi Pelayanan',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$pelayanan.' '.predikat_perilaku($pelayanan),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Integritas ',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$integritas.' '.predikat_perilaku($integritas),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Komitmen',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$komitmen.' '.predikat_perilaku($komitmen),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Disiplin ',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$disiplin.' '.predikat_perilaku($disiplin),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Kerjasama',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$kerjasama.' '.predikat_perilaku($kerjasama),0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Jumlah ',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$jumlahperilaku,0,2,'L',0);
	$this->fpdf->SetX($x+5);
	$this->fpdf->Cell(4.5,$t,'Nilai rata - rata',0,0,'L',0);
	$this->fpdf->Cell(2.5,$t,'= '.$rataperilaku.' '.predikat_perilaku($rataperilaku),0,2,'L',0);
	$this->fpdf->SetXY($x+12,$y1);
	$this->fpdf->Cell(6,$t,'',0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,$t,$d->jabatan_penilai,0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,2,'',0,2,'C',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,$t,$d->nama_penilai,0,2,'C',0);
	if (!empty($d->nip_penilai))
	{
		$this->fpdf->SetX($x+12);
		$this->fpdf->Cell(6,$t,'NIP '.$d->nip_penilai,0,2,'C',0);
	}
	$this->fpdf->SetXY($x,$y1);
	$this->fpdf->cell(1,$tinggi3,'',1,0,'C',0);
	$this->fpdf->cell(4,$tinggi3,'',1,0,'C',0);
	$this->fpdf->cell(7,$tinggi3,'',1,0,'C',0);
	$this->fpdf->cell(6,$tinggi3,'',1,2,'C',0);

	$this->fpdf->SetXY($x,30);
	$this->fpdf->cell(18,$tinggi,strtoupper($this->config->item('unit_kerja')),0,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'TAHUN '.$tahunpenilaian,0,2,'C',0);


}
else
{
	$this->fpdf->FPDF("P","cm","A4");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Buku Cata Perilaku PNS");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	$x = 1.5;
	$y1 = 3;
	$x1 = 2;
	$this->fpdf->AddPage();
	$this->fpdf->SetXY($x,5.5);
	$this->fpdf->setFont('Times','',12);
	$this->fpdf->cell(18,$tinggi,'BUKU CATATAN PERILAKU PEGAWAI NEGERI SIPIL',0,2,'C',0);
	$this->fpdf->MultiCell(18,0.4,'an '.cari_nama_pegawai($kodeguru).' '.$pesan,0,'L',0);
}

$this->fpdf->Output('perilaku_pns_'.$tahunpenilaian.'_'.$kodeguru.'.pdf',"I");
?>
