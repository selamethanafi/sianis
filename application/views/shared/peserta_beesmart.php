<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 02 Mar 2015 07:29:17 WIB 
// Nama Berkas 		: peseeta_tes.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
$td = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
$kelas = '';
foreach($td->result() as $d)
{
	$kelas = $d->kelas;
	$thnajaran = $d->thnajaran;
}
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `kelas`,`no_urut`");
$filename = 'peserta_ubk_'.$thnajaran.'_'.$semester.'_kelas_'.$kelas;
$filename = berkas($filename).'.xls';
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data siswa';
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','nomor ujian');
$this->excel->getActiveSheet()->setCellValue('B1','nama siswa');
$this->excel->getActiveSheet()->setCellValue('C1','nis');
$this->excel->getActiveSheet()->setCellValue('D1','sesi ujian');
$this->excel->getActiveSheet()->setCellValue('E1','ruang ujian');
$this->excel->getActiveSheet()->setCellValue('F1','kode level');
$this->excel->getActiveSheet()->setCellValue('G1','kode kelas');
$this->excel->getActiveSheet()->setCellValue('H1','JENIS KELAMIN');
$this->excel->getActiveSheet()->setCellValue('I1','PASSWORD');
$this->excel->getActiveSheet()->setCellValue('J1','JURUSAN');
$this->excel->getActiveSheet()->setCellValue('K1','FOTO');
$this->excel->getActiveSheet()->setCellValue('L1','AGAMA');
$this->excel->getActiveSheet()->setCellValue('M1','PILIHAN');
$baris=2;
$this->excel->getActiveSheet()->setCellValue('A2','nomor ujian');
$this->excel->getActiveSheet()->setCellValue('B2','nama siswa');
$this->excel->getActiveSheet()->setCellValue('C2','nis');
$this->excel->getActiveSheet()->setCellValue('D2','sesi ujian');
$this->excel->getActiveSheet()->setCellValue('E2','ruang ujian');
$this->excel->getActiveSheet()->setCellValue('F2','kode level');
$this->excel->getActiveSheet()->setCellValue('G2','kode kelas');
$this->excel->getActiveSheet()->setCellValue('H2','JENIS KELAMIN');
$this->excel->getActiveSheet()->setCellValue('I2','PASSWORD');
$this->excel->getActiveSheet()->setCellValue('J2','JURUSAN');
$this->excel->getActiveSheet()->setCellValue('K2','FOTO');
$this->excel->getActiveSheet()->setCellValue('L2','AGAMA');
$this->excel->getActiveSheet()->setCellValue('M2','PILIHAN');
$baris++;
$nomor = 1;
$sesi = 2;
$ruang = 'LABTIK';
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$password_tes = $b->password_tes;
		$jenkel = substr($b->jenkel,0,1);
		$agama = $b->agama;

	} //akhir foreach $tb
	$tc = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
	foreach($tc->result() as $c)
	{
		$jurusan = $c->program;
		$tingkat = $c->tingkat;
	}
	$kelas = preg_replace("/ /","",$kelas);
	$this->excel->getActiveSheet()->getCell('A'.$baris)->setValueExplicit('U'.$nis, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($namasiswa, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($nis, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('D'.$baris)->setValueExplicit($sesi, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('E'.$baris)->setValueExplicit($ruang, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('F'.$baris)->setValueExplicit($tingkat, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('G'.$baris)->setValueExplicit($kelas, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('H'.$baris)->setValueExplicit($jenkel, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('I'.$baris)->setValueExplicit($password_tes, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('J'.$baris)->setValueExplicit($jurusan, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('L'.$baris)->setValueExplicit($agama, PHPExcel_Cell_DataType::TYPE_STRING);
	$baris++;
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
// akhir unduh xls
