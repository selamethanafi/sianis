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
$this->fpdf->SetTitle("surat keterangan hasil unbk");
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
$tb = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item`='nomor skl'");
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
$tanggal_lulus = tanggal_hari_ini();
$bulan = substr($tanggal_lulus,5,2);
$jurusan = $this->helper->kelas_jadi_program($kelas);
$namakepala = $this->helper->cari_kepala($thnajaran,'2');
$nipkepala = $this->helper->cari_nip_kepala($thnajaran,'2');

$this->fpdf->SetXY($x,5);
$this->fpdf->setFont('Arial','B',14);
$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'SURAT KETERANGAN',0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'HASIL UJIAN NASIONAL BERBASIS KOMPUTER',0,2,'C',0);
$this->fpdf->setFont('Arial','',12);
$this->fpdf->Cell($lebar,0.6,'Nomor '.$nomor_ijazah.'/'.$bulan.'/'.$tahun2,0,2,'C',0);
$this->fpdf->Cell($lebar,0.6,'',0,2,'C',0);
$this->fpdf->MultiCell($lebar,0.6,'Yang bertanda tangan di bawah ini Kepala '.ucwords(strtolower($this->config->item('sek_nama_panjang'))).' menerangkan bahwa :',0,'L',0);
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
$this->fpdf->Cell($l,0.6,': '.$this->config->item('kode_un_satuan').'-'.substr($thnajaran,7,2).'-'.$this->config->item('kode_un_provinsi').'-'.$this->helper->nomor_un($nis),0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'madrasah asal',0,0,'L',0);
$this->fpdf->Cell($l,0.6,': '.ucwords(strtolower($this->config->item('sek_nama_panjang'))),0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->setFont('Arial','B',16);
$this->fpdf->Cell($lebar,1.8,'LULUS',0,2,'C',0);
$this->fpdf->setFont('Arial','',12);
$this->fpdf->SetX($x);
$this->fpdf->Cell($l,0.6,'dengan hasil sebagai berikut :',0,2,'L',0);
$k1 = 2;
$t= 0.6;
$k2 = 8;
$k3 = 4;
$this->fpdf->Cell($k1,$t,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell($k1,$t,'Nomor',1,0,'C',0);
$this->fpdf->Cell($k2,$t,'Mata Pelajaran',1,0,'L',0);
$this->fpdf->Cell($k3,$t,'Nilai Ujian Nasional',1,2,'C',0);
$tc = $this->db->query("select * from `mapel_un` where `thnajaran`='$thnajaran' and `program` = '$jurusan' order by no_urut");
if($tc->num_rows()>0)
{
	foreach($tc->result() as $c)
	{
		$nomor = $c->no_urut;
		$mapel = $c->mapel;
		$pilihan = $c->pilihan;
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($k1,$t,$nomor,1,0,'C',0);
		$nilai_un = '-';
		$tg = $this->db->query("select * from `nilai_un` where `nis`='$nis' and `mapel`='$mapel'");
		foreach($tg->result() as $g)
		{
			$nilai_un = $g->un;
		}
		if($pilihan == 1)
		{
			$this->fpdf->Cell($k2,$t,$mapel.' *',1,0,'L',0);
		}
		else
		{
			$this->fpdf->Cell($k2,$t,$mapel,1,0,'L',0);

		}
		if($nilai_un == '0.00')
		{
			$nilai_un = '-';
		}
			$this->fpdf->Cell($k3,$t,$nilai_un,1,2,'C',0);
	}
}
$x2 = 10;
$l2 = 8;
$this->fpdf->SetX($x);
$this->fpdf->setFont('Arial','',12);
$this->fpdf->Cell($lebar,0.6,'* mata ujian pilihan',0,2,'L',0);

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

$this->fpdf->Output('ijazah_sementara_'.$tahun1.'_'.$tahun2.'_.pdf',"I");
//$config['sek_nama_panjang']

?>
