<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 10 Jan 2015 21:40:31 WIB 
// Nama Berkas 		: ppkpns_pdf.php
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
$x2 = $x+1;
$y = 7;
$x1 = 2;
$tinggi = 0.5;
$tinggi2 = 0.7;
$tinggi3 = 1;
$tinggi4 = 0.5;
	$awal = $tahun ;
	$akhir = $tahun + 1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;
$id_sk = '?';
$tkepeg = $this->db->query("select * from `p_tugas_tambahan` where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kode'");
$adatambahan = 0;
$tambahan = '';
foreach($tkepeg->result() as $dkepeg)
	{
	$tambahan = $dkepeg->nama_tugas;
	}
	$nama_penilai = '';
	$nip_penilai = '';
	$pangkat_golongan_penilai = '';
	$jabatan_penilai = '';
	$unit_organisasi_penilai = '';
	$nama_atasan_penilai = '';
	$nip_atasan_penilai = '';
	$pangkat_golongan_atasan_penilai = '';
	$jabatan_atasan_penilai = '';
	$unit_organisasi_atasan_penilai = '';
$tzz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
$permanen = '';
foreach($tzz->result() as $zz)
	{
	$permanen = $zz->permanen;
	$idskawal = $zz->skawal;
	$idskakhir = $zz->skakhir;
}
$golongan = id_sk_jadi_golongan($idskakhir) ;
$pangkat = golongan_jadi_pangkat($golongan);
$jabatan = golongan_jadi_jabatan($golongan);

if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
	{
	$adatambahan = 1;
	}
if ($adatambahan ==0)
{
$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='guru'");
}
if ($adatambahan ==1)
{
$ta = $this->db->query("select * from `pejabat_penilai` where tahun = '$tahun' and dinilai='kepala'");
}

foreach($ta->result() as $a)
	{
	$nama_penilai = $a->nama_penilai;
	$nip_penilai = $a->nip_penilai;
	$pangkat_golongan_penilai = $a->pangkat_golongan;
	$jabatan_penilai = $a->jabatan;
	$unit_organisasi_penilai = $a->unit_organisasi;
	$nama_atasan_penilai = $a->nama_atasan;
	$nip_atasan_penilai = $a->nip_atasan;
	$pangkat_golongan_atasan_penilai = $a->pangkat_golongan_atasan;
	$jabatan_atasan_penilai = $a->jabatan_atasan;
	$unit_organisasi_atasan_penilai = $a->unit_organisasi_atasan;

	}

$tc = $this->db->query("select * from `pkg_masa` where tahun = '$tahun'");
foreach($tc->result() as $c)
	{
	$tpejabat = $c->tpejabat;
 	$tybs = $c->tybs;
	$tatasanpejabat = $c->tatasanpejabat;
	$tawal = $c->awal;
	$takhir = $c->akhir;

	}
$bisa = 0;
$bisa2 = 0;
$bisa1= 0;
$pesan = '';
if (empty($id_sk))
	{
	$pesan .= ' sk per semester belum ada (id sk kosong)';
	}
if (!empty($id_sk))
	{
	$pesan = '';
	$bisa1 = 1;
	}
if (empty($golongan))
	{
	$pesan .= ' golongan tidak terdefinisi (kosong)';
	$bisa2 = 0;
	}
if (!empty($id_sk))
	{
	$pesan = '';
	$bisa2 = 1;
	}

// cari golongan dulu
//$golongan = trim(golongan($kode,$thnajaran,$semester));
if (($golongan=='III/a') or ($golongan=='III/b') or ($golongan=='III/c') or ($golongan=='III/d') or ($golongan=='IV/a') or ($golongan=='IV/b') or ($golongan=='IV/c') or ($golongan=='IV/d'))
{
$bisa = 1;
$pesan = '';
}
else
{
$pesan .= 'Golongan '.$golongan.' (id_sk awal '.$idskawal.' akhir '.$idskakhir.'  tidak sesuai dengan aplikasi';
$bisa = 0;
}
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
$permanen = 1;
$skp = 0;
	$pelayanan = '';
	$komitmen = '';
	$integritas = '';
	$disiplin = '';
	$kerjasama = '';
	$kepemimpinan = '';
	$ppelayanan = '';
	$pkomitmen = '';
	$pintegritas = '';
	$pdisiplin = '';
	$pkerjasama = '';
	$pkepemimpinan = '';
	$bulanawal = substr($tawal,5,2);
	$bulanakhir = substr($takhir,5,2);
	$masapenilaian = $bulanakhir - $bulanawal + 1;
foreach($tz->result() as $z)
	{
	$permanen = $z->kepala;
	$skp = $z->skp;
	$pelayanan = $z->pelayanan;
	$komitmen = $z->komitmen;
	$integritas = $z->integritas;
	$disiplin = $z->disiplin;
	$kerjasama = $z->kerjasama;
	$kepemimpinan = $z->kepemimpinan;
	}
	if($masapenilaian>0)
	{
		$pelayanan = $pelayanan / $masapenilaian ;
		$komitmen = $komitmen / $masapenilaian ;
		$integritas = $integritas / $masapenilaian ;
		$kerjasama = $kerjasama / $masapenilaian ;
		$disiplin = $disiplin / $masapenilaian ;
		$kepemimpinan = $kepemimpinan / $masapenilaian ;
	}
	else
	{
		$pelayanan = $pelayanan / 12 ;
		$komitmen = $komitmen / 12 ;
		$integritas = $integritas / 12 ;
		$kerjasama = $kerjasama / 12 ;
		$disiplin = $disiplin / 12 ;
		$kepemimpinan = $kepemimpinan / 12 ;
	}

if($adatambahan == 1)
	{
		$jppk = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;//+ $kepemimpinan;
		$rppk = $jppk / 5;
	}
else
	{
		$jppk = $pelayanan + $komitmen + $integritas + $disiplin + $kerjasama;
		$rppk = $jppk / 5;
	}


$jskp = $skp * 0.6;
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
if (($bisa == 1) and ($bisa1==1) and ($bisa2==1))
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
$this->fpdf->setFont('Times','',10);
$this->fpdf->cell(18,$tinggi,'PENILAIAN PRESTASI KERJA',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
$this->fpdf->cell(18,$tinggi,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(10,$tinggi,$this->config->item('sek_nama'),0,0,'L',0);
$this->fpdf->cell(10,$tinggi,'JANGKA WAKTU PENILAIAN',0,2,'L',0);
$this->fpdf->cell(10,$tinggi,date_to_long_string($tawal).' s.d. '.date_to_long_string($takhir),0,2,'L',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetX($x);
$this->fpdf->cell(1,$tinggi2,'1',0,0,'C',0);
$this->fpdf->cell(17,$tinggi2,'YANG DINILAI',1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'a. Nama',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,cari_nama_pegawai($kode),1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'b. NIP',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,cari_nip_pegawai($kode),1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'c. Pangkat, Golongan ruang',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$pangkat.', '.$golongan,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'d. Jabatan / Pekerjaan',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$jabatan,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'e. Unit Organisasi',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$this->config->item('sek_nama'),1,2,'L',0);
$y2 = $this->fpdf->getY();
$selisih = $y2 - $y1;
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$tinggi2,'2',0,0,'C',0);
$this->fpdf->cell(17,$tinggi2,'PEJABAT PENILAI',1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'a. Nama',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$nama_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'b. NIP',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$nip_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'c. Pangkat, Golongan ruang',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$pangkat_golongan_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'d. Jabatan / Pekerjaan',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$jabatan_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'e. Unit Organisasi',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$unit_organisasi_penilai,1,2,'L',0);
$y2 = $this->fpdf->getY();
$selisih = $y2 - $y1;
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$tinggi2,'3',0,0,'C',0);
$this->fpdf->cell(17,$tinggi2,'ATASAN PEJABAT PENILAI',1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'a. Nama',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$nama_atasan_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'b. NIP',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$nip_atasan_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'c. Pangkat, Golongan ruang',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$pangkat_golongan_atasan_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'d. Jabatan / Pekerjaan',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$jabatan_atasan_penilai,1,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->cell(7,$tinggi2,'e. Unit Organisasi',1,0,'L',0);
$this->fpdf->cell(10,$tinggi2,$unit_organisasi_atasan_penilai,1,2,'L',0);
$y2 = $this->fpdf->getY();
$y3 = $this->fpdf->getY();
$selisih = $y2 - $y1;
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$tinggi3,'4',0,0,'C',0);
$this->fpdf->cell(14,$tinggi3,'UNSUR YANG DINILAI',1,0,'L',0);
$this->fpdf->cell(3,$tinggi3,'JUMLAH',1,2,'C',0);
$this->fpdf->SetX($x+1);
$this->fpdf->cell(14,$tinggi3,'a. Sasaran Kerja Pegawai (SKP)',1,0,'L',0);
$this->fpdf->SetX($x+12);
$this->fpdf->cell(3,$tinggi3,$skp.' x 60%',0,0,'L',0);
$this->fpdf->SetX($x+15);
$this->fpdf->cell(3,$tinggi3,round($jskp,2),1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetX($x+1);
$this->fpdf->cell(4,$tinggi2,'b. Perilaku Kerja',0,0,'L',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'1. Orientasi Pelayanan',1,0,'L',0);
$this->fpdf->cell(2,$tinggi2,round($pelayanan,2),1,0,'C',0);
$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($pelayanan,2)),1,2,'C',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'2. Integritas',1,0,'L',0);
$this->fpdf->cell(2,$tinggi2,round($integritas,2),1,0,'C',0);
$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($integritas,2)),1,2,'C',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'3. Komitmen',1,0,'L',0);
$this->fpdf->cell(2,$tinggi2,round($komitmen,2),1,0,'C',0);
$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($komitmen,2)),1,2,'C',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'4. Disiplin',1,0,'L',0);
$this->fpdf->cell(2,$tinggi2,round($disiplin,2),1,0,'C',0);
$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($disiplin,2)),1,2,'C',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'5. Kerjasama',1,0,'L',0);
$this->fpdf->cell(2,$tinggi2,round($kerjasama,2),1,0,'C',0);
$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($kerjasama,2)),1,2,'C',0);

$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'6. Kepemimpinan',1,0,'L',0);
/*
if($adatambahan == 1)
	{
		$this->fpdf->cell(2,$tinggi2,round($kepemimpinan,2),1,0,'C',0);
		$this->fpdf->cell(3,$tinggi2,predikat_perilaku(round($kepemimpinan,2)),1,2,'C',0);
	}
	else
*/
	{
		$this->fpdf->cell(2,$tinggi2,'',1,0,'C',0);
		$this->fpdf->cell(3,$tinggi2,'',1,2,'C',0);
	}
	
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'Jumlah',1,0,'L',0);
$this->fpdf->cell(5,$tinggi2,round($jppk,2),1,2,'C',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'Nilai rata - rata',1,0,'L',0);
$this->fpdf->cell(5,$tinggi2,round($rppk,2),1,2,'C',0);
$this->fpdf->SetX($x+5);
$this->fpdf->cell(5,$tinggi2,'Nilai Perilaku Kerja',1,0,'L',0);
$this->fpdf->cell(5,$tinggi2,round($rppk,2).' x 40%',1,0,'C',0);
$npp =$rppk * 0.4;
$this->fpdf->cell(3,$tinggi2,round($npp,2),1,2,'C',0);
$y2 = $this->fpdf->getY();
$selisih = $y2-$y1;
$this->fpdf->SetXY(17,$y1);
$this->fpdf->cell(3,$selisih,'',1,2,'C',0);
$this->fpdf->SetX($x+1);
$this->fpdf->cell(14,2,'Nilai Prestasi Kerja',1,0,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetX($x+15);
$npk = $jskp + $npp;
$pnpk = '?';
if($npk < 100)
	{
	$pnpk = '(Amat Baik)';
	}
if ($npk < 91)
	{
	$pnpk = '(Baik)';
	}
if ($npk < 76)
	{
	$pnpk = '(Cukup)';
	}
$this->fpdf->cell(3,1,round($npk,2),1,2,'C',0);
$this->fpdf->cell(3,1,$pnpk,0,2,'C',0);
$this->fpdf->SetXY($x+15,$y1);
$this->fpdf->cell(3,2,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$selisih = $y3 - $y1;
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(1,$selisih,'',1,2,'C',0);
$this->fpdf->AddPage();
$this->fpdf->SetXY($x,2);
$y1 = $this->fpdf->getY();
$this->fpdf->cell(1,$tinggi,'5',0,0,'C',0);
$this->fpdf->cell(10,$tinggi,'KEBERATAN DARI PEGAWAI NEGERI SIPIL',0,2,'L',0);
$this->fpdf->cell(10,$tinggi,'YANG DINILAI (APABILA ADA)',0,2,'L',0);
$this->fpdf->SetXY($x+12,$y1+3);
$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
$y2 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$selisih = $y2 - $y1;
$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->cell(1,$tinggi,'6',0,0,'C',0);
$this->fpdf->cell(10,$tinggi,'TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN',0,2,'L',0);
$this->fpdf->cell(10,$tinggi,'',0,2,'L',0);
$this->fpdf->SetXY($x+12,$y1+3);
$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
$y2 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$selisih = $y2 - $y1;
$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->cell(1,$tinggi,'7',0,0,'C',0);
$this->fpdf->cell(10,$tinggi,'KEPUTUSAN ATASAN PEJABAT PENILAI ATAS',0,2,'L',0);
$this->fpdf->cell(10,$tinggi,'KEBERATAN',0,2,'L',0);
$this->fpdf->SetXY($x+12,$y1+4);
$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
$y2 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$selisih = $y2 - $y1;
$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->cell(1,$tinggi,'8',0,0,'C',0);
$this->fpdf->cell(10,$tinggi,'REKOMENDASI',0,0,'L',0);
$this->fpdf->cell(10,$tinggi,'',0,2,'L',0);
$this->fpdf->SetXY($x+12,$y1+3);
$this->fpdf->cell(10,1,'Tanggal ....................',0,2,'L',0);
$y2 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$selisih = $y2 - $y1;
$this->fpdf->cell(18,$selisih,'',1,2,'C',0);
$y1 = $this->fpdf->getY();
$this->fpdf->SetXY($x+8,$y1+0.5);
$this->fpdf->cell(10,$tinggi4,'9. DIBUAT TANGGAL, '.date_to_long_string($tpejabat),0,2,'C',0);
$this->fpdf->SetX($x+8);
$this->fpdf->cell(10,$tinggi4,'PEJABAT PENILAI,',0,2,'C',0);
$this->fpdf->cell(10,1.5,'',0,2,'C',0);
$this->fpdf->cell(10,$tinggi4,$nama_penilai,0,2,'C',0);
$this->fpdf->cell(10,$tinggi4,'NIP '.$nip_penilai,0,2,'C',0);
$this->fpdf->cell(10,$tinggi4,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(10,$tinggi4,'10. DITERIMA TANGGAL, '.date_to_long_string($tybs),0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->cell(10,$tinggi4,'PEGAWAI NEGERI SIPIL',0,2,'C',0);
$this->fpdf->cell(10,$tinggi4,'YANG DINILAI',0,2,'C',0);
$this->fpdf->cell(10,1.5,'',0,2,'C',0);
$this->fpdf->cell(10,$tinggi4,cari_nama_pegawai($kode),0,2,'C',0);
$this->fpdf->cell(10,$tinggi4,'NIP '.cari_nip_pegawai($kode),0,2,'C',0);
$this->fpdf->SetX($x+8);
$this->fpdf->cell(10,$tinggi4,'11. DITERIMA TANGGAL, '.date_to_long_string($tatasanpejabat),0,2,'C',0);
$this->fpdf->SetX($x+10);
$this->fpdf->cell(7,$tinggi4,'ATASAN PEJABAT PENILAI,',0,2,'C',0);
$this->fpdf->cell(7,1.5,'',0,2,'C',0);
$this->fpdf->cell(7,$tinggi4,$nama_atasan_penilai,0,2,'C',0);
$this->fpdf->cell(7,$tinggi4,'NIP '.$nip_atasan_penilai,0,2,'C',0);
$y2 = $this->fpdf->getY();
$this->fpdf->SetXY($x,$y1);
$this->fpdf->cell(18,$y2-$y1+0.5,'',1,2,'C',0);
$this->db->query("update `ppk_pns` set `npk`='$npk' where `tahun`='$tahun' and `kode`='$kode'");
}
else
{
	$this->fpdf->FPDF("P","cm","A4");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Penilaian Prestasi Kerja PNS");
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
	$this->fpdf->MultiCell(18,0.4,'an '.cari_nama_pegawai($kode).' '.$pesan,0,'L',0);
}

$this->fpdf->Output('penilaian_prestasi_kerja_'.$tahun.'_'.$kode.'.pdf',"I");
?>
