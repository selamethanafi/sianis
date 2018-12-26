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
$te = $this->db->query("select * from `m_ruang` where `ruang`='$kelas'");
$program = '';
foreach($te->result() as $e)
{
	$program = $e->program;
}

$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `kelas`,`no_urut`");
$filename = 'peserta_ubk_beesmart_'.$thnajaran.'_'.$semester.'_kelas_'.$kelas;
$filename = berkas($filename).'.xls';
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data siswa';
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NOMER UJIAN');
$this->excel->getActiveSheet()->setCellValue('B1','NAMA SISWA');
$this->excel->getActiveSheet()->setCellValue('C1','NIS/NISN');
$this->excel->getActiveSheet()->setCellValue('D1','SESI UJIAN');
$this->excel->getActiveSheet()->setCellValue('E1','RUANG UJIAN');
$this->excel->getActiveSheet()->setCellValue('F1','KODE LEVEL');
$this->excel->getActiveSheet()->setCellValue('G1','KODE KELAS');
$this->excel->getActiveSheet()->setCellValue('H1','JENIS KELAMIN');
$this->excel->getActiveSheet()->setCellValue('I1','PASSWORD');
$this->excel->getActiveSheet()->setCellValue('J1','JURUSAN');
$this->excel->getActiveSheet()->setCellValue('K1','FOTO');
$this->excel->getActiveSheet()->setCellValue('L1','AGAMA');
$this->excel->getActiveSheet()->setCellValue('M1','PILIHAN');
$this->excel->getActiveSheet()->setCellValue('N1','KODE SEKOLAH');
$this->excel->getActiveSheet()->setCellValue('O1','NAMA KELAS');
$kode_level = '?';
if(substr($kelas,0,2) == 'X-')
{
	$kode_level = 'X';
}
if(substr($kelas,0,3) == 'XI-')
{
	$kode_level = 'XI';
}
if(substr($kelas,0,4) == 'XII-')
{
	$kode_level = 'XII';
}


$baris = 3;

$nomor = 1;
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$jenkel = substr($b->jenkel,0,1);
		$alamat = $b->alamat;
		$this->excel->getActiveSheet()->getCell('A'.$baris)->setValueExplicit($nis, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($namasiswa, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($b->nisn, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('D'.$baris)->setValueExplicit('1', PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('E'.$baris)->setValueExplicit('1', PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('F'.$baris)->setValueExplicit($kode_level, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('G'.$baris)->setValueExplicit($kelas, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('H'.$baris)->setValueExplicit($jenkel, PHPExcel_Cell_DataType::TYPE_STRING);
		$password_tes = $b->password_tes;
		$this->excel->getActiveSheet()->getCell('I'.$baris)->setValueExplicit($password_tes, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('J'.$baris)->setValueExplicit($program, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('K'.$baris)->setValueExplicit($b->foto, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('L'.$baris)->setValueExplicit($b->agama, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('M'.$baris)->setValueExplicit('', PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('N'.$baris)->setValueExplicit('ALL', PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('O'.$baris)->setValueExplicit($kelas, PHPExcel_Cell_DataType::TYPE_STRING);
		$baris++;

	} //akhir foreach $tb
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
// akhir unduh xls
