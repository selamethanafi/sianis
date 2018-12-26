<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 16:00:09 WIB 
// Nama Berkas 		: anggota_perpustakaan.php
// Lokasi      		: application/views/tatausaha/
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
?>
<?php
$filename = 'daftar_sikap_spiritual_sosial_siswa_kelas_'.$kelas.'_semester_'.$semester.'_tahun_'.$thnajaran.'.xlsx'; 	
//load our new PHPExcel library
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = substr('data_siswa',0,20);
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NO URUT');
$this->excel->getActiveSheet()->setCellValue('B1','No Induk');
$this->excel->getActiveSheet()->setCellValue('C1','NAMA PESERTA DIDIK');
$this->excel->getActiveSheet()->setCellValue('D1','Predikat Predikat');
$this->excel->getActiveSheet()->setCellValue('E1','Deskripsi');
$this->excel->getActiveSheet()->setCellValue('F1','Predikat');
$this->excel->getActiveSheet()->setCellValue('G1','Predikat');
$this->excel->getActiveSheet()->setCellValue('H1','Deskripsi');
$ta = $this->db->query("SELECT * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' ORDER BY `no_urut` ASC");
$nourut = 1;
$baris = 1;
foreach($ta->result() as $a)
{	
	$baris++;
	$nis = $a->nis;
	$tb = $this->db->query("SELECT * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,$nourut);
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,$b->nis);
		$this->excel->getActiveSheet()->setCellValue('C'.$baris,$b->nama);
	}
	$td = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$sikap_spiritual = '';
	$sikap_sosial = '';
	$pred1 = '';
	$pred2 = '';
	foreach($td->result() as $d)
	{
		$pred1 = $d->satu;
		$pred2 = $d->dua;
		$sikap_spiritual = $d->kom1;
		$sikap_sosial = $d->kom2;
	}

	if($pred1 == 'A')
	{
		$pred1_angka = 4;		
	}
	elseif($pred1 == 'B')
	{
		$pred1_angka = 3;		
	}
	elseif($pred1 == 'C')
	{
		$pred1_angka = 2;		
	}
	else
	{
		$pred1_angka = 1;		
	}
	if($pred2 == 'A')
	{
		$pred2_angka = 4;		
	}
	elseif($pred2 == 'B')
	{
		$pred2_angka = 3;		
	}
	elseif($pred2 == 'C')
	{
		$pred2_angka = 2;		
	}
	else
	{
		$pred2_angka = 1;		
	}
	$this->excel->getActiveSheet()->setCellValue('D'.$baris,$pred1_angka);
	$this->excel->getActiveSheet()->setCellValue('E'.$baris,predikat_sikap($pred1));
	$this->excel->getActiveSheet()->setCellValue('F'.$baris,$sikap_spiritual);
	$this->excel->getActiveSheet()->setCellValue('G'.$baris,$pred2_angka);
	$this->excel->getActiveSheet()->setCellValue('H'.$baris,predikat_sikap($pred2));
	$this->excel->getActiveSheet()->setCellValue('I'.$baris,$sikap_sosial);
	$nourut++
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
