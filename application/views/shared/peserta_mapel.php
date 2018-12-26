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
$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by `nama_kategori`");
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$filename = 'mapel_'.$thnajaran.'_'.$semester;
$filename = berkas($filename).'.xls';
//load our new PHPExcel library
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data kelas';
$baris=1;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','KODE');
$this->excel->getActiveSheet()->setCellValue('B1','MAPEL');
$this->excel->getActiveSheet()->setCellValue('C1','HARIAN');
$this->excel->getActiveSheet()->setCellValue('D1','UTS');
$this->excel->getActiveSheet()->setCellValue('E1','UAS');
$this->excel->getActiveSheet()->setCellValue('F1','KKM');
$this->excel->getActiveSheet()->setCellValue('G1','PILIHAN');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$kode = 'MP'.$nomor;
	$mapel = $a->nama_kategori;
	$boleh = '0';
	$tb = $this->db->query("select * from `m_mapel_rapor` where `nama_mapel_portal`='$mapel'");
	if($tb->num_rows() > 0)
	{
		foreach($tb->result() as $b)
		{
			$boleh = $b->pilihan;
		}
		if($boleh == 0)
		{
			$pilihan = "N";
		}
		else
		{
			$pilihan = "Y";
		}
		$this->excel->getActiveSheet()->getCell('A'.$baris)->setValueExplicit($kode, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($mapel, PHPExcel_Cell_DataType::TYPE_STRING);
		$this->excel->getActiveSheet()->setCellValue('C'.$baris,'0');
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,'0');
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,'0');
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,'0');
		$this->excel->getActiveSheet()->getCell('G'.$baris)->setValueExplicit($pilihan, PHPExcel_Cell_DataType::TYPE_STRING);
		$baris++;
		$nomor++;
	}
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
// akhir unduh xls
