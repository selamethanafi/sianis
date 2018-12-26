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
$thnajaran ='';
$semester = '';
foreach($td->result() as $d)
{
	$kelas = $d->kelas;
	$thnajaran = $d->thnajaran;
	$semester = $d->semester;
}
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
$filename = 'kelas_ubk_'.$thnajaran.'_'.$semester;
$filename = berkas($filename).'.xls';
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data kelas';
$baris=2;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A2','KODE KELAS');
$this->excel->getActiveSheet()->setCellValue('B2','XKODELEVEL');
$this->excel->getActiveSheet()->setCellValue('C2','NAMA KELAS');
$this->excel->getActiveSheet()->setCellValue('D2','JURUSAN');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$kelas = $a->kelas;
	$kodekelas = hilangkanspasi($kelas);
	$jurusan = '?';
	$tingkat = '?';
	$tb = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
	foreach($tb->result() as $b)
	{
		$jurusan = $b->program;
		$tingkat = $b->tingkat;
	}
	$this->excel->getActiveSheet()->getCell('A'.$baris)->setValueExplicit($kodekelas, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($tingkat, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($kelas, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getCell('D'.$baris)->setValueExplicit($jurusan, PHPExcel_Cell_DataType::TYPE_STRING);
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
