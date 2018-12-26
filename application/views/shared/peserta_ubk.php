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
$baris=2;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A2','Nomor');
$this->excel->getActiveSheet()->setCellValue('B2','NIS');
$this->excel->getActiveSheet()->setCellValue('C2','Nama');
$this->excel->getActiveSheet()->setCellValue('D2','email');
$this->excel->getActiveSheet()->setCellValue('E2','HP');
$this->excel->getActiveSheet()->setCellValue('F2','Wali');
$this->excel->getActiveSheet()->setCellValue('G2','Alamat');
$this->excel->getActiveSheet()->setCellValue('H2','Password');
$this->excel->getActiveSheet()->setCellValue('I2','Nama Server');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$passbaru = $b->password_tes;
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$alamat = $b->alamat;
		$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($nis, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($namasiswa, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('E'.$baris)->setValueExplicit($b->hp, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('G'.$baris)->setValueExplicit($alamat, PHPExcel_Cell_DataType::TYPE_STRING);
		$password_tes = $b->password_tes;
		$this->excel->getActiveSheet()->getCell('H'.$baris)->setValueExplicit($passbaru, PHPExcel_Cell_DataType::TYPE_STRING);
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
