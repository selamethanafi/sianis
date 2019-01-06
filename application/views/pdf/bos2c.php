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
$this->fpdf->FPDF("P","cm","Legal");
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(1.5,1,1);
$x=2;
$y = 2.0;
// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();
$this->fpdf->SetXY($x+12,$y);
$this->fpdf->setFont('Arial','B',9);
$this->fpdf->Cell(6,0.8,'Formulir BOS-2C',1,2,'C',0);
$this->fpdf->setFont('Arial','',9);
$this->fpdf->Cell(6,0.1,'',0,2,'C',0);
$this->fpdf->Cell(6,0.4,'Dibuat Oleh Madrasah',0,2,'C',0);
$this->fpdf->Cell(6,0.4,'Dikirim ke PPK Provinsi atau Kab/Kota',0,2,'C',0);
$this->fpdf->Cell(6,0.1,'',0,2,'C',0);
$this->fpdf->SetXY($x+12,$y+0.8);
$this->fpdf->Cell(6,1,'',1,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(6,1.5,'',0,2,'C',0);
$this->fpdf->setFont('Arial','B',9);
$this->fpdf->Cell(19,0.8,'PERNYATAAN TENTANG JUMLAH SISWA MADRASAH ALIYAH',0,2,'C',0);
$this->fpdf->Cell(6,0.4,'',0,2,'C',0);
$this->fpdf->setFont('Arial','',9);
$this->fpdf->SetX($x);
$this->fpdf->Cell(19,0.8,'Yang bertanda tangan di bawah ini:',0,2,'L',0);
$this->fpdf->Cell(6,0.4,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'Nama ',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$namakepala,0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(5,0.5,'Jabatan',0,0,'L',0);
$this->fpdf->Cell(14,0.5,': '.$this->config->item('plt').'Kepala Madrasah',0,1,'L',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(6,0.4,'',0,2,'C',0);
$this->fpdf->SetX($x);
$this->fpdf->Cell(19,0.8,'Menyatakan dengan sesungguhnya bahwa:',0,2,'L',0);
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
$k1 = 1.3;
$k2 = 1.5;
$k3 = 1.5;
$this->fpdf->Cell(2.5,2,'Jumlah Siswa',1,2,'C',0);
$this->fpdf->SetXY($x+2.5,$y);
$this->fpdf->Cell($k1*6,0.5,'Jenjang Kelas',1,0,'C',0);
$this->fpdf->Cell(3,0.5,'Jumlah',0,2,'C',0);
$this->fpdf->SetXY($x+2.5+($k1*6),$y);
$this->fpdf->Cell(3,1,'',1,2,'C',0);
$this->fpdf->SetXY($x+2.5,$y+0.5);
$this->fpdf->Cell($k1*2,0.5,'10',1,0,'C',0);
$this->fpdf->Cell($k1*2,0.5,'11',1,0,'C',0);
$this->fpdf->Cell($k1*2,0.5,'12',1,0,'C',0);
$this->fpdf->Cell($k2*2,0.5,'Jenis Kelamin',0,1,'C',0);
$this->fpdf->SetXY($x+($k2*2)+($k1*6)+2.5,$y);
$this->fpdf->Cell(4.5,1,'Usia (tahun)',1,2,'C',0);
$this->fpdf->SetXY($x+2.5,$y+1);
$this->fpdf->Cell($k1,0.5,'Lk',1,0,'C',0);
$this->fpdf->Cell($k1,0.5,'Pr',1,0,'C',0);
$this->fpdf->Cell($k1,0.5,'Lk',1,0,'C',0);
$this->fpdf->Cell($k1,0.5,'Pr',1,0,'C',0);
$this->fpdf->Cell($k1,0.5,'Lk',1,0,'C',0);
$this->fpdf->Cell($k1,0.5,'Pr',1,0,'C',0);
$this->fpdf->Cell($k2,0.5,'Lk',1,0,'C',0);
$this->fpdf->Cell($k2,0.5,'Pr',1,0,'C',0);
$this->fpdf->Cell($k3,0.5,'< 15',1,0,'C',0);
$this->fpdf->Cell($k3,0.5,'= 15-17',1,0,'C',0);
$this->fpdf->Cell($k3,0.5,'> 17',1,0,'C',0);
$ja = 0;
$jb = 0;
$jc = 0;
$jlx = 0;
$jlxi = 0;
$jlxii = 0;
$jpx = 0;
$jpxi = 0;
$jpxii = 0;
$jl = 0;
$jp = 0;
if($semester == 1)
{
	$tahunsekarang = $tahun1;
}
else
{
	$tahunsekarang = $tahun2;
}


$ta = $this->db->query("select * from `m_kelas` order by `kelas`");
foreach($ta->result() as $a)
{
	$tingkat = $a->kelas;
	$tb = $this->db->query("select * from `siswa_kelas` where `kelas` like '$tingkat-%' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'");
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		$jenkel = jenkel_siswa($nis,0);
		$tahunlahir = substr(tanggal_lahir_siswa($nis),0,4);
		$usia = $tahunsekarang - $tahunlahir;
		if($usia < 15)
		{
			$ja++;
		}
		if(($usia == 15) or ($usia ==16) or ($usia ==17))
		{
			$jb++;
		}
		if($usia > 17)
		{
			$jc++;
		}
		if($jenkel == 'L')
		{
			$jl++;
			if($tingkat == 'X')
			{
				$jlx++;
			}
			if($tingkat == 'XI')
			{
				$jlxi++;
			}
			if($tingkat == 'XII')
			{
				$jlxii++;
			}

		}
		else
		{
			$jp++;
			if($tingkat == 'X')
			{
				$jpx++;
			}
			if($tingkat == 'XI')
			{
				$jpxi++;
			}
			if($tingkat == 'XII')
			{
				$jpxii++;
			}
		}

	}
}
$this->fpdf->SetXY($x+2.5,$y+1.5);
$this->fpdf->Cell($k1,0.5,$jlx,1,0,'C',0);
$this->fpdf->Cell($k1,0.5,$jpx,1,0,'C',0);
$this->fpdf->Cell($k1,0.5,$jlxi,1,0,'C',0);
$this->fpdf->Cell($k1,0.5,$jpxi,1,0,'C',0);
$this->fpdf->Cell($k1,0.5,$jlxii,1,0,'C',0);
$this->fpdf->Cell($k1,0.5,$jpxii,1,0,'C',0);
$this->fpdf->Cell($k2,0.5,$jl,1,0,'C',0);
$this->fpdf->Cell($k2,0.5,$jp,1,0,'C',0);
$this->fpdf->Cell($k3,0.5,$ja,1,0,'C',0);
$this->fpdf->Cell($k3,0.5,$jb,1,0,'C',0);
$this->fpdf->Cell($k3,0.5,$jc,1,0,'C',0);
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
