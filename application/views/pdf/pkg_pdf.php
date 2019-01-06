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
	//2014 JADI 2014/2015 SMT 1
	$awal = $thnpkg;
	$akhir = $thnpkg+1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;

	//2014 JADI 2013/2014 SMT 2
	$awal1 = $thnpkg - 1;
	$akhir1 = $thnpkg;
	$thnajaran1 = $awal1."/".$akhir1;
	$semester1 = 1;
$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
$txx = $this->db->query("select * from p_pegawai where `nip`='$nipkepala'");
foreach($txx->result() as $xx)
{
	$usernamepegawaix = $xx->kd;
}
//data kepala
$bulantmtx = '';
$tahuntmtx = '';
$tahunmasax = '';
$bulanmasax = '';	
$pangkatx = '';
$golonganx = '';
$pangkatgolonganx='';
$tmtx = '';
$tahungolx= '';
$bulangolx='';
$tkepegx = $this->db->query("select * from p_kepegawaian where idpegawai = '$usernamepegawaix' order by tanggal DESC limit 0,1 ");
foreach($tkepegx->result() as $dkepegx)
{
	$pangkatx = $dkepegx->pangkat;
	$golonganx = substr($dkepegx->gol,3,10);
	if(($golonganx=='III/a') or ($golonganx=='III/b'))
		{
		$jabatanx = 'Guru pertama';
		}
	if(($golonganx=='III/c') or ($golonganx=='III/d'))
		{
		$jabatanx = 'Guru muda';
		}
	if(($golonganx=='IV/a') or ($golonganx=='IV/b'))
		{
		$jabatanx = 'Guru madya';
		}
	if(($golonganx=='IV/c') or ($golonganx=='IV/d'))
		{
		$jabatanx = 'Guru utama';
		}
	
	$pangkatgolonganx = $pangkatx.'/'.$jabatanx.'/'.$golonganx;
	$tahunmasax = $dkepegx->tahun;
	$bulanmasax = $dkepegx->bulan;	
	$tahuntmtx = substr($dkepegx->tmt,0,4);
	$bulantmtx = substr($dkepegx->tmt,5,2);
	$tmtx = $dkepegx->tmt;
	}
$tmasa = $this->db->query("select * from pkg_masa where tahun='$thnpkg'");
foreach($tmasa->result() as $dmasa)
{
	$tanggalkp4 = $dmasa->akhir;
	$tanggalawal = $dmasa->awal;
	$tanggalakhir = $dmasa->akhir;
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
$tahunkp4 = substr($tanggalkp4,0,4);
$bulankp4 = substr($tanggalkp4,5,2);

$bulankp4x = $bulankp4;
$tahunkp4x = $tahunkp4;
if ($bulankp4x<$bulantmtx)
	{$bulankp4x = $bulankp4x+12;
	$tahunkp4x = $tahunkp4x - 1;
	}
$jmlbulanx = $bulankp4x - $bulantmtx;
$jmltahunx = $tahunkp4x - $tahuntmtx;
if ($jmlbulanx > 11)
	{
	$jmlbulanx = $jmlbulanx - 12;
	$jmltahunx = $jmltahunx + 1;
	}

$tahungolx = $tahunmasax + $jmltahunx;
$bulangolx = $bulanmasax + $jmlbulanx;
if ($bulangolx>11)
	{$bulangolx=0;
	 $tahungolx++;
	}

$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nip' and `tahun`='$tahun'");
$idskawal = '';
$idskakhir = '';

foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
}
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($gol1);
$jabatan1 = golongan_jadi_jabatan($gol1);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($gol2);
$jabatan2 = golongan_jadi_jabatan($gol2);
$gurubk = 0;
$tx = $this->db->query("select * from `p_pegawai` where `nip`='$nip'");
foreach($tx->result() as $dx)
{
	$kodeguru = $dx->kd;
	$idpegawai = $dx->kd;
	$namaguru = $dx->nama;
	$nipguru = $dx->nip;
	$karpeg = $dx->karpeg;
	$nuptk = $dx->nuptk;
	$nrg = $dx->nrg;
	$tmt_di_sekolah = $dx->tmt_di_sekolah;
	$tanggallahirpegawai = date_to_long_string($dx->tanggallahir);
	$tempatlahir = $dx->tempat;
	$tmt_guru = $dx->tmt_guru;
	$tugas_pokok = $dx->tugas_pokok;
	if($dx->jenkel == 'Lk')
	{
		$jenkel = 'Laki - laki';
	}
	elseif($dx->jenkel == 'Pr')
	{
		$jenkel = 'Perempuan';
	}
	else
	{
		$jenkel = '';
	}
	$tbk = $this->db->query("select * from `gurubk` where `nip` = '$nip'");
	if($tbk->num_rows()>0)
	{
		$gurubk = 1;
	}
	//cari pangkat golongan
	$pangkatgolongan = $pangkat2.', '.$gol2.', '.$jabatan2;
	if (empty($pangkat))
	{
		$pangkatgolongan = '-';
	}
	if (empty($jabatan))
	{
		$jabatan = '-';
	}
	$tkepeg = $this->db->query("select * from `p_kepegawaian` where id = '$idskakhir'");
	$adask = $tkepeg->num_rows();
	if ($adask == 0)
	{
		$tmt = '';
		$tahunmasa = 0;
		$bulanmasa = 0;
	}
	else
	{
		foreach($tkepeg->result() as $t)
		{
			$tmt = $t->tmt;
			$tahunmasa = $t->tahun;
			$bulanmasa = $t->bulan;	

		}
	}
	$pendidikanterakhir = '';
	$jurusan = '';
	$td = $this->db->query("select * from `p_pendidikan` where `idpegawai`='$idpegawai' order by `tahunlulus` DESC limit 0,1");
	foreach($td->result() as $d)
	{
		$pendidikanterakhir = $d->tingkat;
		$jurusan = $d->jurusan;
	}

}

$x = 2;
$x2 = $x+2;
$y = 7;
$x1 = 2;
$marginatas = 2;
$tinggi = 0.8;
$tinggi2 = 1;
$tinggi3 = 0.4;
$tinggi4 = 0.5;
$tahunkp4 = substr($takhir,0,4);
$bulankp4 = substr($takhir,5,2);
$tahuntmt = substr($tmt,0,4);
$bulantmt = substr($tmt,5,2);
$tahunkp44 = $tahunkp4;
if ($bulankp4<$bulantmt)
	{$bulankp4 = $bulankp4+12;
	$tahunkp4 = $tahunkp4 - 1;
	}
$jmlbulan = $bulankp4 - $bulantmt;
$jmltahun = $tahunkp4 - $tahuntmt;
if ($jmlbulan > 11)
	{
	$jmlbulan = $jmlbulan - 12;
	$jmltahun = $jmltahun + 1;
	}

$tahungol = $tahunmasa + $jmltahun;
$bulangol = $bulanmasa + $jmlbulan;
if ($bulangol>11)
	{$bulangol=0;
	 $tahungol++;
	}

$bisa = 0;
$bisa2 = 0;
$bisa1= 0;
$pesan = '';
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip'");
$permanen = 0;
foreach($tz->result() as $z)
{
	$permanen = $z->permanen_pkg;
}

if($permanen == 1)
{
$bisa = 1;
}
else
{
$bisa = 0;
$pesan .= ' Hasil PKG belum permanen';
}
//cari penilai
$te = $this->db->query("SELECT * FROM `pkg_tim_penilai` where `tahun`= '$thnpkg' and `kode_ternilai`='$nip'");
$adate = $te->num_rows();
if($adate == 0)
{
	$bisa = 0;
	$pesan .= ' Belum ada data penilai';
}

$nippenilai = '';
$namapenilai = '';
$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
$tambahan = '';
foreach($ttambahan->result() as $dtambahan)
{
	$tambahan = $dtambahan->nama_tugas;
}
$kepala = 0;
if (substr($tambahan,0,10)=='Kepala Mad')
{
	$kepala = 1;
	$bisa = 1;
}
if ($bisa == 1)
{
	$this->fpdf->FPDF("P","cm","A4");
	$this->fpdf->SetMargins(2,2,2);		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Penilaian Kinerja Guru");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
	$this->fpdf->AddPage();
	$xxx = 9.5;
	$yyy = 2;
	//$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2.5,2.5);
	$this->fpdf->SetXY($x,2);
	$this->fpdf->setFont('Helvetica','',16);
	if($gurubk == 0)
	{
		$this->fpdf->cell(18,$tinggi,'INSTRUMEN PENILAIAN KINERJA GURU (PKG)',0,2,'C',0);
	}
	else
	{
		$this->fpdf->cell(18,$tinggi,'INSTRUMEN PENILAIAN KINERJA GURU (PKG) BK',0,2,'C',0);
	}

	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Helvetica','',10);
	$this->fpdf->cell(18,$tinggi,'IDENTITAS GURU YANG DINILAI KINERJANYA',0,2,'L',0);
	$this->fpdf->cell(8,$tinggi4,'Nama Guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$namaguru,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$nipguru,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Tempat, tanggal lahir',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tempatlahir.', '.$tanggallahirpegawai,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Pangkat, Golongan ruang, Jabatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pangkat2.',  '.$gol2.', '.$jabatan2,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'TMT sebagai guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmt_guru),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Masa Kerja',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tahungol.' tahun '.$bulangol.' bulan',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Jenis Kelamin',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$jenkel,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Pendidikan terakhir / Spesialisasi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pendidikanterakhir.'/'.$jurusan,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Program keahlian yang diampu',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tugas_pokok,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Nama Instansi / madrasah',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_nama,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Telepon',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_telepon,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Kelurahan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_desa,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Kecamatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kec,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Kabupaten / kota',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kab,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Provinsi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_prov,0,2,'L',0);
	//cari penilai
	foreach($te->result() as $e)
	{
		$nippenilai = $e->kode_penilai;
		$namapenilai = $e->nama_penilai;
		$tanggalpenilaian = date_to_long_string($e->tanggal);
	}
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,$tinggi,'IDENTITAS PENILAI DAN KEPALA MADRASAH',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Nama Penilai',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$namapenilai,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'NIP Penilai',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$nippenilai,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Nama Kepala Madrasah',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.cari_kepala_baru($thnajaran,$semester),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.cari_nip_kepala_baru($thnajaran,$semester),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Periode Penilaian',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': Januari s.d. Desember '.$thnpkg,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Tahun',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$thnpkg,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Tempat, tanggal Penilaian',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kec.', '.$tanggalpenilaian,0,2,'L',0);
	$tinggi4=0.4;
	$this->fpdf->AddPage();
	$this->fpdf->setFont('Helvetica','',12);
	if($gurubk == 0)
	{
		$this->fpdf->cell(18,$tinggi2,'REKAP HASIL PENILAIAN KINERJA GURU MATA PELAJARAN',0,2,'C',0);
	}
	else
	{
		$this->fpdf->cell(18,$tinggi2,'REKAP HASIL PENILAIAN KINERJA GURU BK',0,2,'C',0);
	}

	$this->fpdf->setFont('Helvetica','',9);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi4,'a.',0,0,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Nama Guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$namaguru,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$nipguru,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Tempat, tanggal lahir',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tempatlahir.', '.$tanggallahirpegawai,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Pangkat, Golongan ruang, Jabatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pangkat2.',  '.$gol2.', '.$jabatan2,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'TMT sebagai guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmt_guru),0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Masa Kerja',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tahungol.' tahun '.$bulangol.' bulan',0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Jenis Kelamin',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$jenkel,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Pendidikan terakhir / Spesialisasi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pendidikanterakhir.'/'.$jurusan,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Program keahlian yang diampu',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tugas_pokok,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(1,$tinggi4,'b.',0,0,'L',0);
	$this->fpdf->cell(7,$tinggi4,'Nama Instansi / madrasah',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_nama,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Telepon',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_telepon,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Kelurahan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_desa,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Kecamatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kec,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Kabupaten / kota',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kab,0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(7,$tinggi4,'Provinsi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_prov,0,2,'L',0);
	$this->fpdf->Cell(9,0.3,'',0,2,'C',0);
	$yy = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$tinggi = 0.5;

	$this->fpdf->Cell(9,$tinggi,'Periode Penilaian',1,0,'C',0);
	$this->fpdf->Cell(4,$tinggi,'Formatif',1,0,'C',0);
	$this->fpdf->Cell(2,$tinggi,'',1,0,'C',0);
	$this->fpdf->Cell(3,3*$tinggi,'Tahun '.$thnpkg,1,2,'C',0);
	$this->fpdf->SetXY($x,$yy+$tinggi);
	$this->fpdf->Cell(9,2*$tinggi,'Januari s.d. Desember '.$thnpkg,1,0,'C',0);
	$this->fpdf->SetX($x+9,$yy);

	$this->fpdf->SetX($x+9,$yy);
	$this->fpdf->Cell(4,$tinggi,'Sumatif',1,0,'C',0);	$this->fpdf->Cell(2,$tinggi,'',1,2,'C',0);
	$this->fpdf->SetX($x+9,$yy);
	$this->fpdf->Cell(4,$tinggi,'Kemajuan',1,0,'C',0);	$this->fpdf->Cell(2,$tinggi,'',1,2,'C',0);
	$this->fpdf->SetX($x+14,$yy);
	$this->fpdf->Cell(2,0.3,'',0,2,'C',0);


	$k1 = 2;
	$k2 = 14;
	$k3 = 2;
	$tinggi5 = 0.5;
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1,$tinggi,'No',1,0,'C',0);
	$this->fpdf->Cell($k2,$tinggi,'Kompetensi',1,0,'C',0);
	$this->fpdf->Cell($k3,$tinggi,'Nilai',1,2,'C',0);
	$jskor = 0;
	for($noitem=1;$noitem<5;$noitem++)
	{
		if($noitem == 1)
		{
			$judulitem = 'A. Pedagogik';
			$kelompok = 'A';
		}
		if($noitem == 2)
		{
			$judulitem = 'B. Kepribadian';
			$kelompok = 'B';
		}

		if($noitem == 3)
		{
			$judulitem = 'C. Sosial';
			$kelompok = 'C';
		}

		if($noitem == 4)
		{
			$judulitem = 'D. Profesional';
			$kelompok = 'D';
		}

		$this->fpdf->SetX($x);
		$this->fpdf->Cell($k1+$k2+$k3,$tinggi,$judulitem,1,2,'L',0);
		if($gurubk == 0)
		{
			$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='$kelompok' and `untuk`='guru' order by nourut");
		}
		else
		{
			$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='$kelompok' and `untuk`='bk' order by nourut");
		}

		$nomor = 1;
		foreach($ta->result() as $a)
		{
			$id_kompetensi = $a->id_pkg_m_kompetensi;
			$this->fpdf->setFont('Helvetica','',9);
			$yy1 = $this->fpdf->getY();
			$this->fpdf->SetX($x+$k1);
			$this->fpdf->MultiCell($k2,$tinggi5,$a->kompetensi,1,'L',0);
			$yy2 =  $this->fpdf->getY();
			$selisih = $yy2 - $yy1;
			$this->fpdf->SetXY($x,$yy1);
			$this->fpdf->Cell($k1,$selisih,$nomor,1,0,'C',0);
			//cari indikator
			$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
			$nskor = 0;
			$cacah_indikator = 0;
			foreach($tb->result() as $b)
			{
				$id_indikator = $b->id_pkg_m_indikator;
				//cari skor per indikator
				$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nip' and `tahun`='$thnpkg'");
				foreach($tc->result() as $c)
				{
					$nskor = $nskor + $c->skor;
				}
				$cacah_indikator++;
			}
			$skormaks = 2 * $cacah_indikator;
			$persentase = $nskor / $skormaks * 100;
			$nilai = 0;
			if (($persentase > 0) and ($persentase<=25))
			{
				$nilai = 1;
			}
			if (($persentase > 25) and ($persentase<=50))
			{
				$nilai = 2;
			}
			if (($persentase > 50) and ($persentase<=75))
			{
				$nilai = 3;
			}
			if ($persentase > 75)
			{
				$nilai = 4;
			}
			$this->fpdf->SetXY($x+$k1+$k2,$yy1);
			$this->fpdf->Cell($k3,$selisih,$nilai,1,2,'C',0);
			$jskor = $jskor + $nilai;
			$nomor++;
		}
	}
	if($gurubk == 0)
	{
		$jskore = $jskor / 56 * 100;
	}
	else
	{
		$jskore = $jskor / 68 * 100;
	}

	$sebutan = 'Buruk';
	if ($jskore >= 76)
	{
		$sebutan = 'Baik';
	}
	if ($jskore >= 91)
	{
		$sebutan = 'Amat Baik';
	}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1+$k2,$tinggi,'Jumlah (Hasil Penilaian Kinerja Guru)',1,0,'C',0);
	$this->fpdf->Cell($k3,$tinggi,$jskor,1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell($k1+$k2,$tinggi,'Sebutan',1,0,'C',0);
	$this->fpdf->Cell($k3,$tinggi,$sebutan,1,2,'C',0);
	$this->fpdf->SetX($x);
	if($gurubk == 0)
	{
		$this->fpdf->MultiCell(18,$tinggi,'Nilai diisi berdasarkan laporan dan evaluasi PK Guru. Nilai minimum per kompetensi = 1 dan nilai maksimum = 4',0,'L',0);
	}
	else
	{
		$this->fpdf->MultiCell(18,$tinggi,'Nilai diisi berdasarkan laporan dan evaluasi PK Guru BK. Nilai minimum per kompetensi = 1 dan nilai maksimum = 4',0,'L',0);
	}

	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,$tinggi5,$sek_kec.', '.$tanggalpenilaian,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,$tinggi5,'Guru yang dinilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'Penilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'Kepala '.$sek_nama,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,1.5,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,$tinggi5,$namaguru,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,$namapenilai,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,cari_kepala_baru($thnajaran,$semester),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,$tinggi5,'NIP '.$nipguru,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'NIP '.$nippenilai,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'NIP '.cari_nip_kepala_baru($thnajaran,$semester),0,2,'L',0);
// pkg tambahan
	$ttambahan1 = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran1' and semester='$semester1' and kodeguru = '$kodeguru'");
	$tambahan1 = '';
	foreach($ttambahan1->result() as $dtambahan1)
		{
		$tambahan1 = $dtambahan1->nama_tugas;
		}
	if (substr($tambahan1,0,10)=='Kepala Mad')
		{
		$adatambahan1 = 1;
		}
	if (substr($tambahan1,0,4)=='Waka')
		{
		$adatambahan1 = 1;
		}
	if (substr($tambahan1,0,10)=='Kepala Lab')
		{
		$adatambahan1 = 1;
		}
	if (substr($tambahan1,0,10)=='Kepala Per')
		{
		$adatambahan1 = 1;
		}

	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$tambahan = '';
	$jwtambahan = 0;
	foreach($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jwtambahan = $dtambahan->jtm;
		}
	$jwm = 24;
	$adatambahan = 0;
	if (substr($tambahan,0,10)=='Kepala Mad')
		{
		$jwm = 6;
		$kg = 0.25;
		$kt = 0.75;
		$pktmaks = 24;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if (substr($tambahan,0,4)=='Waka')
		{
		$jwm = 12;
		$kg = 0.5;
		$kt = 0.5;
		$pktmaks = 20;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if (substr($tambahan,0,10)=='Kepala Lab')
		{
		$jwm = 12;
		$kg = 0.5;
		$kt = 0.5;
		$pktmaks = 28;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if (substr($tambahan,0,10)=='Kepala Per')
		{
		$jwm = 12;
		$kg = 0.5;
		$kt = 0.5;
		$pktmaks = 40;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if ($tambahan=='Bimbingan TIK')
		{
		$jwm = 24;
		$kg = 1;
		$kt = 0;
		$pktmaks = 40;
		$adatambahan = 0;
		}

		if (substr($tambahan,0,10)=='Kepala Mad')
		{
		$untuk = 'kepala madrasah';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Kuri')
		{
		$untuk = 'waka kurikulum';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Sara')
		{
		$untuk = 'waka sarana';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Kesi')
		{
		$untuk = 'waka kesiswaan';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Huma')
		{
		$untuk = 'waka humas';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Kepala Laboratoriu')
		{
		$untuk = 'kepala laboratorium';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Kepala Perpustakaa')
		{
		$untuk = 'kepala perpustakaan';
		$skorx = 4;
		}
		if ($tambahan=='Bimbingan TIK')
		{
		$untuk = $tambahan;
		$skorx = 4;
		}
		$jskort=0;
	if($adatambahan == 1)
	{
		$namasekolah = $this->config->item('sek_nama');
		$this->fpdf->AddPage();
		$this->fpdf->setFont('Helvetica','',12);
		$this->fpdf->cell(18,$tinggi,'INSTRUMEN PENILAIAN KINERJA GURU (PKG)',0,2,'C',0);
		$this->fpdf->cell(18,$tinggi,'SEBAGAI '.strtoupper($tambahan),0,2,'C',0);
		$this->fpdf->setFont('Helvetica','',9);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'',0,2,'L',0);
		$this->fpdf->cell(18,$tinggi,'Yang bertanda tangan di bawah ini',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Nama',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.cari_kepala_baru($thnajaran,$semester),0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'NIP',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.cari_nip_kepala_baru($thnajaran,$semester),0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Pangkat/Jabatan/Golongan',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$pangkatgolonganx,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'TMT',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmtx),0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Masa kerja',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$tahungolx.' tahun '.$bulangolx.' bulan',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Jabatan',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': Kepala Madrasah',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Unit kerja',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$namasekolah,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(10,$tinggi4,'menyatakan bahwa',0,2,'L',0);
		$this->fpdf->cell(8,$tinggi4,'',0,0,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Nama',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$namaguru,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'NIP',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$nipguru,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Tempat/Tanggal Lahir',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$tempatlahir.', '.$tanggallahirpegawai,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Pangkat/Golongan',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$pangkat2.',  '.$gol2,0,2,'L',0);	
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'TMT',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmt),0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Jabatan',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$jabatan2,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'Unit kerja',0,0,'L',0);
		$this->fpdf->cell(10,$tinggi4,': '.$namasekolah,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'',0,0,'L',0);
		$this->fpdf->cell(8,$tinggi4,'',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(12,$tinggi4,'telah melakukan kegiatan tugas tambahan sebagai '.$tambahan.' dengan penilaian sebagai berikut:',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(8,$tinggi4,'',0,'2','L',0);
		$k1 = 1;
		$k2 = 10;
		$k3 = 3;
		$k4 = 3;
		$this->fpdf->SetX($x);
		$this->fpdf->cell($k1,$tinggi4,'No',1,0,'C',0);
		$this->fpdf->cell($k2,$tinggi4,'Kompetensi',1,0,'C',0);
		$this->fpdf->cell($k3,$tinggi4,'Kode',1,0,'C',0);
		$this->fpdf->cell($k4,$tinggi4,'Skor Rata -rata',1,2,'C',0);
		$ta = $this->db->query("select * from `pkg_m_kompetensi` where `untuk`='$untuk' order by kelompok");
		$nomor = 1;
		$jskort = 0;
		$tinggi4 = 0.5;
		foreach($ta->result() as $a)
		{
			$id_kompetensi = $a->id_pkg_m_kompetensi;
			$this->fpdf->SetX($x);
			$this->fpdf->cell($k1,$tinggi4,$nomor,1,0,'C',0);
			$this->fpdf->cell($k2,$tinggi4,$a->kompetensi,1,0,'C',0);
			$this->fpdf->cell($k3,$tinggi4,$a->kelompok,1,0,'C',0);
			//cari indikator
			$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
			$nskort = 0;
			$cacah_indikator = 0;
			foreach($tb->result() as $b)
			{
				$id_indikator = $b->id_pkg_m_indikator;
				//cari skor per indikator
				$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nip' and `tahun`='$thnpkg'");
				foreach($tc->result() as $c)
				{
					$nskort = $nskort + $c->skor;
				}
				$cacah_indikator++;
			}
			$ratat = $nskort / $cacah_indikator;
			$jskort = $jskort + $ratat;
			$this->fpdf->cell($k4,$tinggi4,round($ratat,2),1,2,'C',0);
			$nomor++;
		}
		$cacah_kompetensi = $nomor - 1;
		$skortertinggit = $skorx * $cacah_kompetensi;
		if ($skortertinggit > 0 )
		{
			$jskoret = $jskort / $skortertinggit * 100;
		}
		else
		{
			$jskoret = 0;
		}
		$sebutan = 'Buruk';
		if ($jskoret > 76)
		{
			$sebutan = 'Baik';
		}
		if ($jskoret == 76)
		{
			$sebutan = 'Baik';
		}
		if ($jskoret == 91)
		{
			$sebutan = 'Amat Baik';
		}
		if ($jskoret > 91)
		{
			$sebutan = 'Amat Baik';
		}
		$this->fpdf->SetX($x);
		$this->fpdf->cell($k1+$k2+$k3,$tinggi4,'Total Skor Rata - rata',1,0,'C',0);
		$this->fpdf->cell($k4,$tinggi4,round($jskort,2),1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell($k1+$k2+$k3,$tinggi4,'Persentase Skor',1,0,'C',0);
		$this->fpdf->cell($k4,$tinggi4,round($jskoret,2),1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell($k1+$k2+$k3,$tinggi4,'Sebutan',1,0,'C',0);
		$this->fpdf->cell($k4,$tinggi4,$sebutan,1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->cell(1,1.5,'',0,2,'C',0);
		$this->fpdf->SetX($x+12);
		$this->fpdf->Cell(6,$tinggi5,$sek_kec.', '.$tanggalpenilaian,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(6,$tinggi5,'Guru yang dinilai',0,0,'L',0);
		$this->fpdf->Cell(6,$tinggi5,'Penilai',0,0,'L',0);
		$this->fpdf->Cell(6,$tinggi5,'Kepala '.$sek_nama,0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(6,1.5,'',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(6,$tinggi5,$namaguru,0,0,'L',0);
		$this->fpdf->Cell(6,$tinggi5,$namapenilai,0,0,'L',0);
		$this->fpdf->Cell(6,$tinggi5,cari_kepala_baru($thnajaran,$semester),0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(6,$tinggi5,'NIP '.$nipguru,0,0,'L',0);
		$this->fpdf->Cell(6,$tinggi5,'NIP '.$nippenilai,0,0,'L',0);
		$this->fpdf->Cell(6,$tinggi5,'NIP '.cari_nip_kepala_baru($thnajaran,$semester),0,2,'L',0);
	}
	$this->fpdf->AddPage();
	$this->fpdf->setFont('Helvetica','',12);
	$this->fpdf->cell(18,$tinggi,'PERHITUNGAN ANGKA KREDIT',0,2,'C',0);
	$this->fpdf->Cell(6,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->setFont('Helvetica','',9);
	$this->fpdf->cell(8,$tinggi4,'Nama Guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$namaguru,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'NIP',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$nipguru,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Tempat, tanggal lahir',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tempatlahir.', '.$tanggallahirpegawai,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Pangkat, Golongan ruang, Jabatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pangkat2.',  '.$gol2.', '.$jabatan2,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'TMT sebagai guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmt_guru),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Masa Kerja',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tahungol.' tahun '.$bulangol.' bulan',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Jenis Kelamin',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$jenkel,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Pendidikan terakhir / Spesialisasi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pendidikanterakhir.'/'.$jurusan,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Program keahlian yang diampu',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$tugas_pokok,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Nama Instansi / madrasah',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_nama,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Telepon',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_telepon,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Kelurahan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_desa,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Kecamatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kec,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Kabupaten / kota',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_kab,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Provinsi',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_prov,0,2,'L',0);
	$this->fpdf->Cell(6,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$tinggi = 0.7;
	if($gurubk == 0)
	{
		$this->fpdf->cell(15,$tinggi,'Nilai PK Guru Mata Pelajaran',1,0,'L',0);
	}
	else
	{
		$this->fpdf->cell(15,$tinggi,'Nilai PK Guru BK',1,0,'L',0);
	}

	$this->fpdf->cell(3,$tinggi,$jskor,1,2,'C',0);
	$yy1 = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$this->fpdf->MultiCell(15,$tinggi,'Konversi Nilai PK Guru ke dalam skala 0 - 100 sesuai permenneg PAN dan RM Nomor 16 Tahun 2009 dengan rumus',0,'L',0);
	$this->fpdf->cell(15,$tinggi,'Nilai PKG (100) = (Nilai PKG / Nilai PKG Tertinggi) x 100',0,2,'L',0);
	if($gurubk == 0)
	{
		$this->fpdf->cell(15,$tinggi,'Nilai PKG (100) = ('.$jskor.' / 56) x 100',0,2,'L',0);
	}
	else
	{
		$this->fpdf->cell(15,$tinggi,'Nilai PKG (100) = ('.$jskor.' / 68) x 100',0,2,'L',0);
	}
	$yy2 = $this->fpdf->getY();
	$selisih = $yy2 - $yy1;
	if($gurubk == 0)
	{
		$nilaipkg = $jskor / 56 * 100;
	}
	else
	{
		$nilaipkg = $jskor / 68 * 100;
	}

	$sebutan = 'Kurang';
	$npk = 25;
	if (($nilaipkg>51) or ($nilaipkg==51))
	{
		$sebutan = 'Sedang';
		$npk = 50;
	}
	if (($nilaipkg>61) or ($nilaipkg==61))
	{
		$sebutan = 'Cukup';
		$npk = 75;
	}
	if (($nilaipkg>76) or ($nilaipkg==76))
	{
		$sebutan = 'Baik';
		$npk = 100;
	}
	if ( ($nilaipkg>91) or ($nilaipkg==91))
	{
		$sebutan = 'Amat Baik';
		$npk = 125;
	}
	$sebutanguru = $sebutan;
	$this->fpdf->SetXY($x,$yy1);
	$this->fpdf->cell(15,$selisih,'',1,0,'C',0);
	$this->fpdf->cell(3,$selisih,round($nilaipkg,2),1,2,'C',0);
	$yy1 = $this->fpdf->getY();
	$this->fpdf->SetX($x);
	$this->fpdf->MultiCell(18,$tinggi,'Berdasarkan hasil konversi ke dalam skala sesuai peraturan tersebut selanjutnya ditetapkan sebutan dan persentase angka kreditnya',1,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(15,$tinggi,'Nilai PKG tersebut mendapat sebutan',1,0,'L',0);
	$this->fpdf->cell(3,$tinggi,$sebutanguru,1,2,'C',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(15,$tinggi,'Nilai persentase angka kredit',1,0,'L',0);
	$this->fpdf->cell(3,$tinggi,$npk.' %',1,2,'C',0);
	$this->db->query("update `ppk_pns` set `pkg`='$npk' where tahun = '$tahun' and kode = '$nip'");
	$akk = '?';
	$akpkb = '?';
	$akp = '?';
	$golongan = $gol2;
	$kegolongan = '?';	
	if ($golongan=='III/a')
	{
		$ak = 100;
		$akk = 50;
		$akpkb =  3+0;
		$akp = 5;
		$kegolongan = 'III/b';
	}
	if ($golongan=='III/b')
	{
		$ak = 150;
		$akk = 50;
		$akpkb =  3+4;
		$akp = 5;
		$kegolongan = 'III/c';
	}
	if ($golongan=='III/c')
	{
		$ak = 200;
		$akk = 100;
		$akpkb =  3+6;
		$akp = 10;
		$kegolongan = 'III/d';
	}
	if ($golongan=='III/d')
	{
		$ak = 300;
		$akk = 100;
		$akpkb =  4+8;
		$akp = 10;
		$kegolongan = 'IV/a';
	}
	if ($golongan=='IV/a')
	{
		$ak = 400;
		$akk = 150;
		$akpkb =  4+12;
		$akp = 15;
		$kegolongan = 'IV/b';
	}
	if ($golongan=='IV/b')
	{
		$ak = 550;
		$akk = 150;
		$akpkb =  4+12;
		$akp = 15;
		$kegolongan = 'IV/c';
	}
	if ($golongan=='IV/c')
	{
		$ak = 700;
		$akk = 150;
		$akpkb =  5+14;
		$akp = 15;
		$kegolongan = 'IV/d';
	}
	if ($golongan=='IV/d')
	{
		$ak = 850;
		$akk = 200;
		$akpkb =  5+20;
		$akp = 20;
		$kegolongan = 'IV/e';
	}
	// cari mapel
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	$jtm = 0;
	foreach($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		$jtm = $jtm + $dmapel->jam;

	}
	$tmapeltik = $this->db->query("select * from bimtik_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	if($tmapeltik->num_rows()>0)
	{
		$jtm = 24;
	}
	$tlain = $this->db->query("SELECT * FROM `p_tugas_tambahan_luar` where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$jtmlain = 0;
	foreach($tlain->result() as $dlain)
	{
		$jtmlain = $dlain->jtm;

	}
	$jw = $jtm + $jtmlain+$jwtambahan;
	if ($jw>$jwm)
		{
		$jw = $jwm;
		}
	$aksetahun = (($akk - $akpkb - $akp) * ($jw/$jwm) * $npk)/400;

	$yy1 = $this->fpdf->getY();
	$this->fpdf->SetXY($x,$yy1);
	$this->fpdf->cell(15,4,'',1,0,'C',0);
	$this->fpdf->SetXY($x+1,$yy1+0.5);
	$this->fpdf->cell(4,1,'AKK Minimal Golongan',1,0,'C',0);
	$this->fpdf->cell(3,1,'AKPKB Minimal',1,0,'C',0);
	$this->fpdf->cell(4,1,'AKP Minimal',1,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(4,0.5,$akk,1,0,'C',0);
	$this->fpdf->cell(3,0.5,$akpkb,1,0,'C',0);
	$this->fpdf->cell(4,0.5,$akp,1,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(11,0.5,$golongan.' ke '.$kegolongan,1,2,'C',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(11,0.5,'Perolehan angka kredit (untuk pembelajaran) dihitung berdasarkan rumus berikut',0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(11,0.5,'Angka kredit 1 tahun = ((AKK - AKPKB - AKP) x (JW/JWM) x NPK)/4',0,2,'L',0);
	$this->fpdf->SetX($x+1);
	$this->fpdf->cell(11,0.5,'Angka kredit 1 Tahun = (( '.$akk.' - '.$akpkb.' - '.$akp.' ) x ('.$jw.'/'.$jwm.') x '.$npk.'%)/4',0,2,'L',0);
	$this->fpdf->SetXY($x+15,$yy1);
	$this->fpdf->cell(3,4,$aksetahun,1,2,'C',0);
	$this->fpdf->SetX($x);
	
	if($adatambahan == 1)
	{
		$this->fpdf->cell(15,$tinggi,'Nilai PK '.$tambahan,1,0,'L',0);
		$this->fpdf->cell(3,$tinggi,round($jskort,2),1,2,'C',0);
		$yy1 = $this->fpdf->getY();
		$nilaipkg = $jskort / $pktmaks * 100;
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Konversi Nilai PK '.$tambahan.' ke dalam skala 0 - 100 sesuai',0,0,'L',0);
		$this->fpdf->cell(3,$tinggi,round($nilaipkg,2),0,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'permenneg PAN dan RM Nomor 16 Tahun 2010 dengan Rumus',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Nilai PKG (100) = (Nilai PKG / Nilai PKG Tertinggi) x 100',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Nilai PKG (100) = ('.round($jskort,3).' / '.$pktmaks.') x 100',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
		$yy2 = $this->fpdf->getY();
		$selisih = $yy2-$yy1;
		$this->fpdf->SetXY($x,$yy1);
		$this->fpdf->Cell(15,$selisih,'',1,0,'L',0);
		$this->fpdf->Cell(3,$selisih,'',1,2,'L',0);
		$yy1 = $this->fpdf->getY();
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Berdasarkan hasil konversi ke dalam skala sesuai peraturan tersebut selanjutnya ditetapkan',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'sebutan dan persentase angka kreditnya',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
		$yy2 = $this->fpdf->getY();
		$selisih = $yy2-$yy1;
		$this->fpdf->SetXY($x,$yy1);
		$this->fpdf->Cell(18,$selisih,'',1,2,'L',0);

		$sebutan = 'Kurang';
		$npk = 25;
		if (($nilaipkg>51) or ($nilaipkg==51))
		{
			$sebutan = 'Sedang';
			$npk = 50;
		}
		if (($nilaipkg>61) or ($nilaipkg==61))
		{
			$sebutan = 'Cukup';
			$npk = 75;
		}
		if (($nilaipkg>76) or ($nilaipkg==76))
		{
			$sebutan = 'Baik';
			$npk = 100;
		}
			if ( ($nilaipkg>91) or ($nilaipkg==91))
		{
			$sebutan = 'Amat Baik';
			$npk = 125;
		}
		$this->db->query("update `ppk_pns` set `pkg_tambahan`='$npk' where tahun = '$tahun' and kode = '$nip'");
		$sebutantambahan = $sebutan;
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Nilai PK '.$tambahan.' tersebut mendapat sebutan',1,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,$sebutan,1,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Nilai persentase angka kredit',1,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,$npk.'%',1,2,'C',0);
		$aksetahun2 = (($akk - $akpkb - $akp) * $npk)/400;
		$this->fpdf->SetX($x);
		$yy1 = $this->fpdf->getY();
		if($yy1>27)
		{
			$yy1 = 2;
		}
		$this->fpdf->Cell(15,$tinggi,'Perolehan angka kredit ('.$tambahan.') dihitung berdasarkan rumus berikut',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,$aksetahun2,0,2,'C',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Angka kredit 1 tahun = ((AKK - (AKPKB - AKP)) x NPK)/400',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Angka kredit 1 Tahun = (( '.$akk.' - '.$akpkb.' - '.$akp.' ) x '.$npk.'%)/4',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'C',0);
		$yy2 = $this->fpdf->getY();
		$selisih = $yy2-$yy1;
		$this->fpdf->SetXY($x,$yy1);
		$this->fpdf->Cell(15,$selisih,'',1,0,'L',0);
		$this->fpdf->Cell(3,$selisih,'',1,2,'L',0);

		$akakhir = ($kg * $aksetahun) + ($kt * $aksetahun2);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'Nilai Akhir = '.$kg.' x '.$aksetahun.' + '.$kt.' x '.$aksetahun2,1,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,$akakhir,1,2,'C',0);
	/*
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
		$this->fpdf->SetX($x);
		$this->fpdf->Cell(15,$tinggi,'',0,0,'L',0);
		$this->fpdf->Cell(3,$tinggi,'',0,2,'L',0);
	*/
	}
	$this->fpdf->Cell(6,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+12);
	$this->fpdf->Cell(6,$tinggi5,$sek_kec.', '.$tanggalpenilaian,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,$tinggi5,'Guru yang dinilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'Penilai',0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'Kepala '.$sek_nama,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,1.5,'',0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,$tinggi5,$namaguru,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,$namapenilai,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,cari_kepala_baru($thnajaran,$semester),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(6,$tinggi5,'NIP '.$nipguru,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'NIP '.$nippenilai,0,0,'L',0);
	$this->fpdf->Cell(6,$tinggi5,'NIP '.cari_nip_kepala_baru($thnajaran,$semester),0,2,'L',0);
	$this->fpdf->AddPage();
	$this->fpdf->SetXY($x,2);
	$this->fpdf->setFont('Helvetica','',12);
	$this->fpdf->cell(18,$tinggi,'LAPORAN DAN EVALUASI',0,2,'C',0);
	$this->fpdf->SetX($x);
	if($gurubk == 0)
	{
		$this->fpdf->cell(18,$tinggi,'PENILAIAN KINERJA GURU MATA PELAJARAN',0,2,'C',0);
	}
	else
	{
		$this->fpdf->cell(18,$tinggi,'PENILAIAN KINERJA GURU BK',0,2,'C',0);
	}

	$this->fpdf->cell(18,0.5,'',0,2,'L',0);
	$this->fpdf->setFont('Helvetica','',10);
	$tinggi4 = 0.5;
	$this->fpdf->cell(8,$tinggi4,'Nama Guru',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$namaguru,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'NIP / Nomor Seri Karpeg',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$nipguru.' / '.$karpeg,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Pangkat, Golongan ruang, Jabatan',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$pangkat2.',  '.$gol2.', '.$jabatan2,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Terhitung Mulai Tanggal',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmt),0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'NUPTK / NRG',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$nuptk.'/ '.$nrg,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Nama madrasah',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_nama,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Alamat',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.$sek_desa,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Tanggal mulai bekerja di madrasah ini',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': '.date_to_long_string($tmt_di_sekolah),0,2,'L',0);

	$this->fpdf->SetX($x);
	$this->fpdf->cell(8,$tinggi4,'Periode Penilaian',0,0,'L',0);
	$this->fpdf->cell(10,$tinggi4,': Januari s.d. Desember '.$thnpkg,0,2,'L',0);
	$this->fpdf->cell(18,1,'',0,2,'L',0);
	$yy1 = $this->fpdf->getY() + 0.5;
	$this->fpdf->SetX($x);
	$this->fpdf->cell(18,6.8,'',1,2,'L',0);
	$this->fpdf->SetXy($x,$yy1);
	$this->fpdf->cell(18,$tinggi4,'PERSETUJUAN',0,2,'C',0);
	$this->fpdf->cell(18,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+0.5);
	$this->fpdf->Multicell(17,$tinggi4,'Penilai dan guru yang dinilai telah membaca dan memahami semua aspek yang ditulis  / dilaporkan dalam form ini dan menyatakan setuju',0,'L',0);
	$this->fpdf->cell(18,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+0.5);
	$this->fpdf->cell(2.5,$tinggi4,'Nama guru',0,0,'L',0);
	$this->fpdf->cell(6.5,$tinggi4,': '.$namaguru,0,0,'L',0);
	$this->fpdf->cell(2.5,$tinggi4,'Nama Penilai',0,0,'L',0);
	$this->fpdf->cell(6.5,$tinggi4,': '.$namapenilai,0,2,'L',0);
	$this->fpdf->cell(18,1.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+0.5);
	$this->fpdf->cell(2.5,$tinggi4,'Tanda Tangan',0,0,'L',0);
	$this->fpdf->cell(6.5,$tinggi4,':',0,0,'L',0);
	$this->fpdf->cell(2.5,$tinggi4,'Tanda Tangan',0,0,'L',0);
	$this->fpdf->cell(6.5,$tinggi4,':',0,2,'L',0);
	$this->fpdf->cell(18,0.5,'',0,2,'L',0);
	$this->fpdf->SetX($x+0.5);
	$this->fpdf->cell(2.5,$tinggi4,'Tanggal',0,0,'L',0);
	$this->fpdf->cell(6.5,$tinggi4,': '.$tanggalpenilaian,0,2,'L',0);

}
else
{
	$this->fpdf->FPDF("P","cm","A4");		
	$this->fpdf->AliasNbPages();
	$this->fpdf->SetTitle("Penilaian Kinerja Guru");
	$this->fpdf->SetAuthor("Selamet Hanafi");
	$this->fpdf->SetSubject("Sistem Informasi Madrasah");
	$this->fpdf->SetKeywords("sistem, informasi, madrasah");
	$x = 1.5;
	$y1 = 3;
	$x1 = 2;
	$this->fpdf->AddPage();
	$xxx = 9;
	$yyy = 3;
	$this->fpdf->SetXY($x,5.5);
	$this->fpdf->setFont('Times','',12);
	$this->fpdf->cell(18,$tinggi,'PENILAIAN KINERJA GURU',0,2,'C',0);
	$this->fpdf->MultiCell(18,0.4,'an '.$namaguru.' '.$pesan,0,'L',0);
}
$namaguru = berkas($namaguru);
$this->fpdf->Output('penilaian_kinerja_guru_'.$namaguru.'_'.$tahun.'.pdf',"I");
?>
