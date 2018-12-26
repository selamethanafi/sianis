<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 16 Jan 2015 08:43:21 WIB 
// Nama Berkas 		: unduh_skp.php
// Lokasi      		: application/views/shared/
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
$namasekolah = berkas($this->config->item('sek_nama'));
$filename = 'data_rekap_ppk_'.$namasekolah.'_'.$tahun.'.xls';
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Worksheet');
$this->excel->getActiveSheet()->setCellValue('A1','DAFTAR NOMINATIF PENILAIAN PRESTASI KERJA PEGAWAI NEGERI SIPIL');
$this->excel->getActiveSheet()->setCellValue('A2','PADA '.$this->config->item('sek_nama'));
$this->excel->getActiveSheet()->setCellValue('A4','Periode Penilaian Januari s.d. Desember '.$tahun);
$this->excel->getActiveSheet()->setCellValue('A5','Nomor');
$this->excel->getActiveSheet()->setCellValue('B5','Nama Pegawai');
$this->excel->getActiveSheet()->setCellValue('C5','NIP');
$this->excel->getActiveSheet()->setCellValue('D5','Jabatan');
$this->excel->getActiveSheet()->setCellValue('E5','Unit Kerja');
$this->excel->getActiveSheet()->setCellValue('F5','Nilai');
$this->excel->getActiveSheet()->setCellValue('G5','Sebutan');
$this->excel->getActiveSheet()->setCellValue('H5','Keterangan');
$this->excel->getActiveSheet()->setCellValue('A6','1');
$this->excel->getActiveSheet()->setCellValue('B6','2');
$this->excel->getActiveSheet()->setCellValue('C6','3');
$this->excel->getActiveSheet()->setCellValue('D6','4');
$this->excel->getActiveSheet()->setCellValue('E6','5');
$this->excel->getActiveSheet()->setCellValue('F6','6');
$this->excel->getActiveSheet()->setCellValue('G6','7');
$this->excel->getActiveSheet()->setCellValue('H6','8');
$ta = $this->db->query("select * from `p_pegawai` where `status`='Y'");
$nomor = 1;
$baris = 7;
foreach($ta->result() as $a)
{
	$kepeg = $a->status_kepegawaian;
	if(($kepeg == 'CPNS') or ($kepeg == 'PNS'))
	{
		$namapegawai = $a->nama;
		$nippegawai = $a->nip;
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,$nomor);
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,$namapegawai);
		$this->excel->getActiveSheet()->setCellValueExplicit('C'.$baris,$nippegawai, PHPExcel_Cell_DataType::TYPE_STRING);
		$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nippegawai'");	
		$idskakhir = '';
		$npk = '0';
		foreach($tz->result() as $z)
		{
			$idskakhir = $z->skakhir;
			$npk = $z->npk;
		}
		if($npk < 100)
		{
			$pnpk = 'Amat Baik';
		}
		if ($npk < 91)
		{
			$pnpk = 'Baik';
		}
		if ($npk < 76)
		{
			$pnpk = 'Cukup';
		}
		$gol = id_sk_jadi_golongan($idskakhir) ;
		$pangkat = golongan_jadi_pangkat($gol);
		$jabatan = golongan_jadi_jabatan($gol);
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,$jabatan);
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,$this->config->item('unit_kerja'));
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,round($npk,2));
		$this->excel->getActiveSheet()->setCellValue('G'.$baris,$pnpk);
		$nomor++;
		$baris++;
	}

}

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
