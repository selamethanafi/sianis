<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : lck_prestasi.php
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

//by selamet hanafi
/*    * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
*/
/* setting zona waktu */ 
date_default_timezone_set('Asia/Jakarta');
$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("lembar prestasi");
$this->fpdf->SetAuthor("Selamet Hanafi");
$this->fpdf->SetSubject("Sistem Informasi Madrasah");
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(2,2,2);
$kolom1 = 1;
$kolom2 = 17;
$lebar_kertas = $kolom1+$kolom2; // kolom 1 + kolom 2
$tinggi_kertas = 26.5;
$x=1.5;
$y = 1.5;
$x2 = 4.0;
$x3 = 5.0;
$x4 = 8.0;
$ada = 0;
$tbr =0.4;
$t1 = 0.6;
$t2 = 0.5;
$t3 = 0.4;
$semester = '2';
$namasiswa ='';
$thnajaran2 = $thnajaran+1;
$thnajaran = $thnajaran.'/'.$thnajaran2;
$kelas = '';
$tkelas = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
foreach($tkelas->result() as $dkelas)
{
$kelas = $dkelas->kelas;
}
$ttglcetak = $this->db->query("select * from `m_tapel` where `thnajaran`='$thnajaran'");
$tanggalcetak='';
foreach($ttglcetak->result() as $dtglcetak)
{
	if ($semester=='1')
	{$tanggalcetak=$dtglcetak->akhir1;}
	else
	{$tanggalcetak=$dtglcetak->akhir2;}
}
$tkepala = $this->db->query("select * from `m_kepala` where `thnajaran`='$thnajaran' and `semester`='$semester'");
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
foreach($tkepala->result() as $dkepala)
{
	$posisi_x = $dkepala->posisi_x / 10;
	$posisi_y = $dkepala->posisi_y / 10;
	$lebar = $dkepala->lebar / 10;
	$tinggi = $dkepala->tinggi / 10;
}
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$namawalikelas = '';
$nipwalikelas = '';
$kodewalikelas = '';
foreach($twalikelas->result() as $dwalikelas)
{
	$kodewalikelas = $dwalikelas->kodeguru;
}
$namawalikelas = cari_nama_pegawai($kodewalikelas);
$nipwalikelas = cari_nip_pegawai($kodewalikelas);
$jurusan = kelas_jadi_program($kelas);
$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
$adasiswa = $tb->num_rows();
if ($adasiswa>0)
{
	foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$nisn = nisn($nis);
	$namasiswa = nis_ke_nama($nis);
	$kelasditinggalkan = $b->kelas;
	$tdata_siswa=$this->db->query("select * from `datsis` where `nis`='$nis'");
	$this->fpdf->AddPage();
	$this->fpdf->SetY($y);
	$yyy = $this->fpdf->GetY();	
	$this->fpdf->setFont('Arial','B',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(18,0.5,'Catatan Prestasi Yang Telah Dicapai',0,2,'C',0);
	$this->fpdf->setFont('Arial','',10);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,'',0,2,'C',0);
	$this->fpdf->Cell(3,0.5,'Nama Peserta Didik',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(5,0.5,': '.$namasiswa,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nomor Induk / NISN',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$nis.' / '.$nisn,0,2,'L',0);
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(3,0.5,'Nama Madrasah',0,0,'L',0);
	$this->fpdf->SetX($x+4);
	$this->fpdf->Cell(3,0.5,': '.$this->config->item('sek_nama'),0,2,'L',0);
	$this->fpdf->SetX($x);		
	$this->fpdf->setFont('Arial','',10); 
	$this->fpdf->Cell($kolom1+$kolom2,$t1,'',0,2,'C',0);
	$this->fpdf->Cell($kolom1,$t1,'No',1,0,'C',0);
	$this->fpdf->Cell($kolom2,$t1,'Prestasi yang pernah dicapai',1,2,'C',0);
	$this->fpdf->SetX($x);		
	//cari prestasi
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran'");
	$adapres = $tpres->num_rows();
		if ($adapres>0)
		{
		$no = 1;
			foreach($tpres->result() as $dpres)
			{
			$this->fpdf->SetX($x);		
			$ypresatas = $this->fpdf->GetY();
			$this->fpdf->SetXY($x,$ypresatas);		 
			$this->fpdf->Cell($kolom1,$t1,$no,0,0,'C',0);
			$this->fpdf->MultiCell($kolom2,$t1,$dpres->keterangan.'. '.$dpres->kegiatan,0,'L',0);
			$ypresbawah = $this->fpdf->GetY();
			$selisihpres = $ypresbawah - $ypresatas;
			$this->fpdf->SetXY($x,$ypresatas);		 
			$this->fpdf->Cell($kolom1,$selisihpres,'',1,0,'C',0);
			$this->fpdf->Cell($kolom2,$selisihpres,'',1,0,'C',0);
			$this->fpdf->SetY($ypresbawah);		
			$no++;
			}
		}
		else
		{
		    $this->fpdf->SetX($x);
		    $this->fpdf->Cell($kolom1+$kolom2,$t1,'---------------------',1,2,'C',0);
		}
	$this->fpdf->SetX($x);
	$this->fpdf->Cell(18,0.3,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->Cell(1,0.3,'',0,2,'L',0);
	$this->fpdf->Cell(18,0.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->setFont('Arial','',10);	 
	$this->fpdf->Cell(1,0.5,'Mengetahui',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(5,0.5,$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak),0,2,'L',0);
	$this->fpdf->SetX(2.5);
	$yy = $this->fpdf->GetY();
	$this->fpdf->Cell(1,0.5,'Orang tua / Wali',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'Wali Kelas',0,2,'L',0);
	$this->fpdf->SetX(9);
	$yyy = $yy - 1;
	$posisine_y = $yyy + $posisi_y;
	$this->fpdf->Image('images/ttd/'.$ttdkepala.'',$posisi_x+7,$posisine_y,$lebar,$tinggi);
	$this->fpdf->SetXY(9,$yy);
	$this->fpdf->Cell(0.8,0.5,$this->config->item('plt').'Kepala',0,0,'L',0);
	$this->fpdf->Cell(18,1.5,' ',0,2,'C',0); // spasi kosong
	$this->fpdf->SetX(2.5);
	$this->fpdf->Cell(1.0,0.5,'_______________________',0,0,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,$namakepala,0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,$namawalikelas,0,2,'L',0);
	$this->fpdf->SetX(9);
	$this->fpdf->Cell(1,0.5,'NIP '.$nipkepala.'',0,0,'L',0);
	$this->fpdf->SetX(14);
	$this->fpdf->Cell(2,0.5,'NIP '.$nipwalikelas.'',0,2,'L',0);
	}//akhir cetak lembar keempat di semester 2
}
else
{
	$this->fpdf->AddPage();
	$this->fpdf->SetY(1.0);
	$this->fpdf->SetFont('Arial','',8);
	$this->fpdf->SetXY($x,$y);
	$this->fpdf->Cell(18,0.5,'DATA SISWA TIDAK ADA',0,2,'C',0);
}
/* setting Cell untuk page number */

$namafile='keterangan_prestasi_'.$nis.'_'.$namasiswa.'_'.$thnajaran.'.pdf';
$namafile = str_replace(" ", "_", $namafile);
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($namafile,"I");
?>
