<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 08 Sep 2018 10:41:35 WIB 
// Nama Berkas 		: unduh_borang_skp.php
// Lokasi      		: application/views/guru/
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
$tx = $this->db->query("select * from p_pegawai where `nip`='$nip'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;
	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
	$namapegawai = $x->nama;
//	$tipepegawai 
}
$namaberkas = berkas($namapegawai);
$filename = 'skp_'.$namaberkas.'_'.$nip.'_'.$tahun.'.xls';
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Worksheet');
//$this->excel->getActiveSheet()->setCellValue('C7',$nippegawai);
//baris 28 mulai data skp
$baris = 12;
$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nim' order by nourut");
if(count($ta->result())>0)
{
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		if ((substr($a->kegiatan,0,8)=='Unsur ut') or (substr($a->kegiatan,0,15) == 'Unsur Penunjang') or ($a->kegiatan == 'Unsur PKB'))
		{
		}
		else
		{
			$this->excel->getActiveSheet()->setCellValue('B'.$baris,$nomor);
			$this->excel->getActiveSheet()->setCellValue('C'.$baris,strip_tags($a->kegiatan));
			$this->excel->getActiveSheet()->setCellValue('F'.$baris,$a->ak_target);
			$this->excel->getActiveSheet()->setCellValue('G'.$baris,$a->kuantitas);
			$this->excel->getActiveSheet()->setCellValue('H'.$baris,$a->satuan);
			$this->excel->getActiveSheet()->setCellValue('I'.$baris,$a->kualitas);
			$this->excel->getActiveSheet()->setCellValue('J'.$baris,$a->waktu);
			$this->excel->getActiveSheet()->setCellValue('K'.$baris,'bulan');
			$this->excel->getActiveSheet()->setCellValue('L'.$baris,$a->biaya);
			$baris++;
			$nomor++;
		}
	}
}
$cacah = $nomor - 1;
$this->excel->getActiveSheet()->setCellValue('M6',$cacah);
//$this->excel->getActiveSheet()->mergeCells("A3:A4");       
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
