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
$ta = $this->db->query("select * from `siswa_nomor_tes_un` where `thnajaran`='$thnajaran'");
$filename = 'peserta_uambnbk_'.$thnajaran;
$filename = berkas($filename).'.xls';
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data siswa';
$npsn = $this->config->item('sek_npsn');
$nsm = $this->config->item('sek_nsm');

$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NPSN*');
$this->excel->getActiveSheet()->setCellValue('B1','NSM*');
$this->excel->getActiveSheet()->setCellValue('C1','NISN*');
$this->excel->getActiveSheet()->setCellValue('D1','NO UN');
$this->excel->getActiveSheet()->setCellValue('E1','JURUSAN');
$this->excel->getActiveSheet()->setCellValue('F1','NAMA*');
$this->excel->getActiveSheet()->setCellValue('G1','KELAS');
$this->excel->getActiveSheet()->setCellValue('H1','TAHUN AJARAN');
$this->excel->getActiveSheet()->setCellValue('I1','TEMPAT LAHIR');
$this->excel->getActiveSheet()->setCellValue('J1','TGL LAHIR');
$baris = 2;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$nomor_un = $a->no_peserta;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$nisn = $b->nisn;
		$tmpt = $b->tmpt;
		$tgllhr = $b->tgllhr;
	}
	$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester` = '1' and `nis`='$nis'");
	$kelas = '';
	foreach($tc->result() as $c)
	{
		$kelas = $c->kelas;
	}
	$this->excel->getActiveSheet()->getCell('A'.$baris)->setValueExplicit($npsn, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($nsm, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($nisn, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('D'.$baris)->setValueExplicit($nomor_un, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('E'.$baris)->setValueExplicit('', PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('F'.$baris)->setValueExplicit($namasiswa, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('G'.$baris)->setValueExplicit($kelas, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('H'.$baris)->setValueExplicit('', PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('I'.$baris)->setValueExplicit($tmpt, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('J'.$baris)->setValueExplicit($tgllhr, PHPExcel_Cell_DataType::TYPE_STRING);
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
