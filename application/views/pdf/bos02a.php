<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 05 Jan 2016 11:02:22 WIB 
// Nama Berkas 		: blanko_nilai.php
// Lokasi      		: application/views/pdf/
// Author      		: Selamet Hanafi
//	                  selamethanafi@yahoo.co.id
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
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
$this->fpdf->FPDF("P","cm","A4");
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,1,1);
$x=1.5;
$yatas = 2.0;
$batasbawah = 27;
// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();
$this->fpdf->SetXY($x+10,$yatas);
$this->fpdf->setFont('Arial','B',9);
$this->fpdf->Cell(8,0.8,'Formulir BOS-02A dan BOS-02B',1,2,'C',0);
$this->fpdf->setFont('Arial','',9);
$this->fpdf->Cell(8,0.1,'',0,2,'C',0);
$this->fpdf->Cell(8,0.4,'Dibuat Oleh Madrasah dan dikirim',0,2,'C',0);
$this->fpdf->Cell(8,0.4,'ke EMIS Kantor Kemenag Kab/Kota',0,2,'C',0);
$this->fpdf->Cell(6,0.1,'',0,2,'C',0);
$this->fpdf->SetXY($x+10,$yatas+0.8);
$this->fpdf->Cell(8,1,'',1,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->setFont('Arial','',9);
$this->fpdf->Cell(6,0.4,'',0,2,'C',0);
$this->fpdf->Cell(5,0.5,'Nama Madrasah',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$this->config->item('sek_nama'),0,2,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'NSM',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$this->config->item('sek_nsm'),0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'Alamat Madrasah',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$this->config->item('sek_alamat'),0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'Semester/Tahun Pelajaran',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$semester.' / '.$thnajaran,0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'Kabupaten/Kota',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$this->config->item('sek_kab'),0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'Provinsi',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$this->config->item('sek_prov'),0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(6,0.4,'',0,2,'C',0);
$this->fpdf->Cell(19,0.8,'memiliki jumlah siswa sebagai berikut:',0,2,'L',0);
$this->fpdf->Cell(6,0.4,'',0,2,'C',0);
$this->fpdf->SetX($x);
$y = $this->fpdf->GetY();
$k1 = 1;
$k2 = 6;
$k3 = 2;
$k4 = 2;
$k5 = 3.5;
$k6 = 4;
$this->fpdf->Cell($k1,0.5,'No',1,0,'C',0);
$this->fpdf->Cell($k2,0.5,'Nama Siswa',1,0,'C',0);
$this->fpdf->Cell($k3,0.5,'NISN',1,0,'C',0);
$this->fpdf->Cell($k4,0.5,'Tanggal Lahir',1,0,'C',0);
$this->fpdf->Cell($k5,0.5,'Kelas',1,0,'C',0);
$this->fpdf->Cell($k6,0.5,'Nama Ibu Kandung',1,2,'C',0);
$ta = $this->db->query("select * from `m_kelas` order by `kelas`");
$nomor = 1;
$td = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `kelas`,`no_urut`");
$cacahsiswa = $td->num_rows();
$batascacahsiswa = $cacahsiswa - 2;

foreach($ta->result() as $a)
{
	$tingkat = $a->kelas;
	$tb = $this->db->query("select * from `siswa_kelas` where `kelas` like '$tingkat-%' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `kelas`,`no_urut`");
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		$kelas = $b->kelas;
		$tc = $this->db->query("select `nis`,`nisn`,`nama`,`jenkel`,`tgllhr`,`nmibu` from `datsis` where `nis`='$nis'");
		$jenkel = '';
		$tgllhr = '';
		$nisn = '';
		$namasiswa = '';
		$nmibu = '';
		foreach($tc->result() as $c)
		{
			$jenkel = $c->jenkel;
			$tgllhr = tanggal($c->tgllhr);
			$nisn = $c->nisn;
			$namasiswa = $c->nama;
			$nmibu = $c->nmibu;
		}
		$this->fpdf->SetX($x);
		$this->fpdf->Cell($k1,0.5,$nomor,1,0,'C',0);
		$this->fpdf->Cell($k2,0.5,$namasiswa,1,0,'L',0);
		$this->fpdf->Cell($k3,0.5,$nisn,1,0,'C',0);
		$this->fpdf->Cell($k4,0.5,$tgllhr,1,0,'C',0);
		$this->fpdf->Cell($k5,0.5,$kelas,1,0,'C',0);
		$this->fpdf->Cell($k6,0.5,$nmibu,1,2,'L',0);
		$nomor++;
		$ybatas = $this->fpdf->GetY();
		if(($ybatas > $batasbawah) or ($nomor == $batascacahsiswa))
		{
			$this->fpdf->AddPage();
			$this->fpdf->SetXY($x,$yatas);
			$k1 = 1;
			$k2 = 6;
			$k3 = 2;
			$k4 = 2;
			$k5 = 2;
			$k6 = 5;
			$this->fpdf->Cell($k1,0.5,'No',1,0,'C',0);
			$this->fpdf->Cell($k2,0.5,'Nama Siswa',1,0,'C',0);
			$this->fpdf->Cell($k3,0.5,'NISN',1,0,'C',0);
			$this->fpdf->Cell($k4,0.5,'Tanggal Lahir',1,0,'C',0);
			$this->fpdf->Cell($k5,0.5,'Kelas',1,0,'C',0);
			$this->fpdf->Cell($k6,0.5,'Nama Ibu Kandung',1,2,'C',0);
		}		
	}
}
$this->fpdf->SetX($x+12);
$this->fpdf->Cell(6,2,'',0,2,'C',0);
$this->fpdf->Cell(6,0.5,$this->config->item('lokasi').',',0,2,'L',0);
$this->fpdf->Cell(6,0.5,$this->config->item('plt').'Kepala Madrasah / Penjab PPs',0,2,'L',0);
$this->fpdf->Cell(6,2,'',0,2,'L',0);
$this->fpdf->Cell(6,0.5,$namakepala,0,2,'L',0);
$this->fpdf->Cell(6,0.5,'NIP '.$nipkepala,0,2,'L',0);



$sekolah = berkas($this->config->item('sek_nama'));
$thnajaranx = berkas($thnajaran);
$namafile='formulir_bos_2c_'.$sekolah.'_'.$thnajaranx.'_semester_'.$semester.'.pdf';
$namafile = str_replace(" ", "_", $namafile);

$this->fpdf->Output($namafile,"I");
?>
