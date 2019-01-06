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
$this->fpdf->FPDF("P","cm","Legal");		
$this->fpdf->AliasNbPages();
$this->fpdf->SetTitle("Ijazah Sementara");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
$this->fpdf->SetKeywords("sistem, informasi, madrasah");
// Cell(lebar, tinggi, teks, bingkai, ganti baris, perataan, fill, mixed link)
$this->fpdf->AddPage();
$x = 4;
$xxx = 10;
$yyy = 3;
$lebar = 14;
$thnajaran = $tahun1.'/'.$tahun2;
//cari kelas
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `nis`='$nis' and `semester`='2'");
$kelas = '';
foreach($ta->result() as $a)
{
	$kelas = $a->kelas;
}
$tb = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item`='nomor ijazah'");
$nomor_ijazah = '';
foreach($tb->result() as $b)
{
	$nomor_ijazah = $b->konten;
}
$tb = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item`='lokasi'");
$lokasi = '';
foreach($tb->result() as $b)
{
	$lokasi = $b->konten;
}
$tb = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item`='tanggal kelulusan'");
$tanggal_lulus = '';
foreach($tb->result() as $b)
{
	$tanggal_lulus = $b->konten;
}

$jurusan = $this->helper->kelas_jadi_program($kelas);
$namakepala = $this->helper->cari_kepala($thnajaran,'2');
$nipkepala = $this->helper->cari_nip_kepala($thnajaran,'2');

$this->fpdf->Image('images/garuda_pancasila.jpg',$xxx,$yyy,2,2);
$this->fpdf->SetXY($x,5);
$this->fpdf->setFont('Arial','B',16);
$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'KEMENTERIAN AGAMA',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'R E P U B L I K    I N D O N E S I A',0,2,'C',0);
$this->fpdf->Cell($lebar,1.5,'IJAZAH SEMENTARA',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'MADRASAH ALIYAH NEGERI',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'PEMINATAN '.strtoupper($jurusan),0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
$this->fpdf->setFont('Arial','B',14);
$this->fpdf->Cell($lebar,0.6,'TAHUN PELAJARAN '.$thnajaran,0,2,'C',0);
$this->fpdf->setFont('Arial','',12);
$this->fpdf->Cell($lebar,0.6,'Nomor '.$nomor_ijazah.'      /'.$tahun2,0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
$this->fpdf->MultiCell($lebar,0.6,'Yang bertanda tangan di bawah ini Kepala '.ucwords(strtolower($this->config->item('sek_nama_panjang'))).' nomor pokok sekolah nasional : '.$this->config->item('sek_npsn').' '.$this->config->item('sek_kab').' provinsi '.$this->config->item('sek_prov').' menerangkan bahwa',0,'L',0);
$l = 6;
$this->fpdf->SetX($x);
$this->fpdf->Cell($lebar,0.4,'',0,2,'C',0);
$this->fpdf->Cell($l,0.6,'nama',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$datasiswa['nama_siswa'],0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'tempat dan tanggal lahir',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$datasiswa['tmpt'].', '.date_to_long_string($datasiswa['tgllhr']),0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'nama orang tua / wali',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$datasiswa['nmortu'],0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'nomor induk siswa',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$nis,0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'nomor induk siswa nasional',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$datasiswa['nisn'],0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'nomor peserta ujian nasional',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$this->config->item('kode_un_satuan').'-'.substr($thnajaran,2,2).'-'.$this->config->item('kode_un_provinsi').'-'.$this->helper->nomor_un($nis),0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'madrasah asal',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.ucwords(strtolower($this->config->item('sek_nama_panjang'))),0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->setFont('Arial','B',16);
$this->fpdf->Cell($lebar,1.8,'LULUS',0,2,'C',0);
$this->fpdf->setFont('Arial','',12);
$this->fpdf->MultiCell($lebar,0.5,'dari satuan pendidikan setelah memenuhi seluruh kriteria sesuai dengan peraturan perundang-undangan.',0,'L',0);

$x2 = 10;
$l2 = 8;
$yyy = $this->fpdf->GetY();
$this->fpdf->SetX($x2);
$this->fpdf->Cell($l2,1,'',0,2,'C',0);
$folderfotosiswa = $this->config->item('folderfotosiswa');
if (!empty($datasiswa['foto']))
{
	$this->fpdf->Image(''.$folderfotosiswa.'/'.$datasiswa['foto'].'',5.5,$yyy+1.5,3,4);
}
$this->fpdf->SetX($x2);
$this->fpdf->Cell($l2,0.6,$lokasi.', '.date_to_long_string($tanggal_lulus),0,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->Cell($l2,0.6,$this->config->item('plt').'Kepala Madrasah,',0,2,'L',0);
$this->fpdf->Cell($l2,2.5,'',0,2,'C',0);
$this->fpdf->Cell($l2,0.6,$namakepala,0,2,'L',0);
$this->fpdf->SetX($x2);
$this->fpdf->Cell($l2,0.6,'NIP '.$nipkepala,0,2,'L',0);

/*
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.$datasiswa[''],0,2,'L',0);
*/
$this->fpdf->AddPage();
$this->fpdf->SetXY($x,3);
$this->fpdf->setFont('Arial','B',12);
$this->fpdf->Cell($lebar,0.6,'DAFTAR NILAI',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'MADRASAH ALIYAH',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'PEMINATAN '.strtoupper($jurusan),0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'TAHUN PELAJARAN '.$thnajaran,0,2,'C',0);
$x1 = 2;
$t= 0.5;
$this->fpdf->setFont('Arial','',10);
$this->fpdf->SetX($x1);
$this->fpdf->Cell($lebar,0.4,'',0,2,'C',0);
$this->fpdf->Cell($l,$t,'nama',0,0,'L',0);
$this->fpdf->Cell($l,$t,': '.$datasiswa['nama_siswa'],0,2,'L',0);
$this->fpdf->SetX($x1);
$this->fpdf->Cell($l,$t,'tempat dan tanggal lahir',0,0,'L',0);
$this->fpdf->Cell($l,$t,': '.$datasiswa['tmpt'].', '.date_to_long_string($datasiswa['tgllhr']),0,2,'L',0);
$this->fpdf->SetX($x1);
$this->fpdf->Cell($l,$t,'nomor induk siswa',0,0,'L',0);
$this->fpdf->Cell($l,$t,': '.$nis,0,2,'L',0);
$this->fpdf->SetX($x1);
$this->fpdf->Cell($l,$t,'nomor induk siswa nasional',0,0,'L',0);
$this->fpdf->Cell($l,$t,': '.$datasiswa['nisn'],0,2,'L',0);
$this->fpdf->SetX($x1);
$this->fpdf->Cell($l,$t,'nomor peserta ujian nasional',0,0,'L',0);
$this->fpdf->Cell($l,$t,': '.$this->config->item('kode_un_satuan').'-'.substr($thnajaran,2,2).'-'.$this->config->item('kode_un_provinsi').'-'.$this->helper->nomor_un($nis),0,2,'L',0);


$k1 = 2;
$k2 = 8;
$k3 = 2;
$k4 = 6;
$this->fpdf->SetX($x1);
$this->fpdf->Cell($lebar,$t,'',0,2,'C',0);
$y1 = $this->fpdf->GetY();
$this->fpdf->SetX($x1);
$this->fpdf->Cell($k1,$t+$t,'Nomor',0,0,'C',0);
$this->fpdf->Cell($k2,$t+$t,'Mata Pelajaran',0,0,'C',0);
$this->fpdf->Cell($k3+$k4,$t,'Nilai',1,'2','C',0);
$this->fpdf->SetX($x1+$k1+$k2);
$this->fpdf->Cell($k3,$t,'Angka',1,0,'C',0);
$this->fpdf->Cell($k4,$t,'Huruf',1,2,'C',0);
$this->fpdf->SetXY($x1,$y1);
$this->fpdf->Cell($k1,$t+$t,'',1,0,'C',0);
$this->fpdf->Cell($k2,$t+$t,'',1,0,'C',0);
$this->fpdf->Cell($k3,$t,'',0,0,'C',0);
$this->fpdf->Cell($k4,$t,'',0,2,'C',0);
$this->fpdf->Cell($k4,$t,'',0,2,'C',0);
$t = 0.6;
$jr = 0;
$ju = 0;
$pembagi = 0;
$td = $this->db->query("select * from `leger_ijazah` where `nis`='$nis'");
$tc = $this->db->query("select * from `m_mapel_ijazah` where `thnajaran`='$thnajaran' and `jurusan` = '$jurusan' order by no_urut");
if($tc->num_rows()>0)
{
	foreach($tc->result() as $c)
	{
		$nomor = $c->no_urut;
		$field = 'r'.$nomor;
		$mapel = $c->mapel;
		$jenis = $c->jenis;

		$this->fpdf->SetX($x1);
		$this->fpdf->Cell($k1,$t,$nomor,1,0,'C',0);
		$nilai = 0;
		foreach($td->result() as $d)
		{
			$nilai = $d->$field;
		}
		$nilai_ujian = '';
		if($jenis == 1)
		{
			$mapel = 'Keterampilan / '.$mapel;
		}
		if($jenis == 2)
		{
			$mapel = 'Muatan lokal '.$mapel;
		}
		$this->fpdf->Cell($k2,$t,$jenis.' '.$mapel,1,0,'L',0);
		$this->fpdf->Cell($k3,$t,$nilai,1,0,'C',0);
		$dhuruf = 'nilai diluar ketentuan';
		if(($nilai>0) and ($nilai<101))
		{
			if(strlen($nilai==1))
			{
				$dhuruf = dengan_huruf($nilai);
			}
			elseif(strlen($nilai==2))
			{
				$dhuruf = dengan_huruf(substr($nilai,0,1)).' '.dengan_huruf(substr($nilai,1,1));
			}
			else
			{
				$dhuruf = dengan_huruf(substr($nilai,0,1)).' '.dengan_huruf(substr($nilai,1,1)).' '.dengan_huruf(substr($nilai,2,1));
			}
		}
		$this->fpdf->Cell($k4,$t,$dhuruf,1,2,'C',0);
		$jr = $jr + $nilai;
		$pembagi++;
	}
	if($pembagi > 0)
	{
		$rjr = $jr / $pembagi;
	}
	$this->fpdf->SetX($x1);
	$this->fpdf->Cell($k1+$k2,$t,'Nilai rata rata',1,0,'C',0);
	$this->fpdf->Cell($k3,$t,round($rjr,2),1,0,'C',0);
	$x2 = 13;
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell($l2,1,'',0,2,'C',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell($l2,0.6,$lokasi.', '.date_to_long_string($tanggal_lulus),0,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell($l2,0.6,$this->config->item('plt').'Kepala Madrasah,',0,2,'L',0);
	$this->fpdf->Cell($l2,2,'',0,2,'C',0);
	$this->fpdf->Cell($l2,0.6,$namakepala,0,2,'L',0);
	$this->fpdf->SetX($x2);
	$this->fpdf->Cell($l2,0.6,'NIP '.$nipkepala,0,2,'L',0);
	
}
$this->fpdf->Output('ijazah_sementara_'.$tahun1.'_'.$tahun2.'_.pdf',"I");
//$config['sek_nama_panjang']

?>
