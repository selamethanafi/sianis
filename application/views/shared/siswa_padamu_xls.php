<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: siswa_padamu_xls.php
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
?>
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `kelas`,`no_urut` ");
$thnajarane = berkas($thnajaran);
$filename = 'data_siswa_padamu_tahun_'.$thnajarane.'.xls'; 
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = 'data siswa';
$baris=1;
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NO');
$this->excel->getActiveSheet()->setCellValue('B1', 'KODE SISTEM');
$this->excel->getActiveSheet()->setCellValue('C1', 'NO INDUK');
$this->excel->getActiveSheet()->setCellValue('D1','NISN');
$this->excel->getActiveSheet()->setCellValue('E1','NAMA');
$this->excel->getActiveSheet()->setCellValue('F1','KELAMIN (L/P)');
$this->excel->getActiveSheet()->setCellValue('G1','TEMPAT LAHIR');
$this->excel->getActiveSheet()->setCellValue('H1','TGL LAHIR (YYYY-MM-DD)');
$this->excel->getActiveSheet()->setCellValue('I1','ALAMAT');
$this->excel->getActiveSheet()->setCellValue('J1','TINGKAT');
$this->excel->getActiveSheet()->setCellValue('K1','TAHUN MASUK');
$baris++;
$nomor = 1;
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$nisn = nisn($nis);
	$namasiswa = strtoupper(nis_ke_nama($nis));
	$namasiswa = ucwords($namasiswa);
	$namasiswa = preg_replace("/`/","'", $namasiswa);
	$kelamin = jenkel_siswa($nis,0);
	$tempat = tempat_lahir_siswa($nis);
	$tanggallahir = tanggal_lahir_siswa($nis);
	$alamat = nis_ke_alamat($nis);
	$alamat2 ='';
	$goldarah = '';
	$hp = '';
	$kelas = $a->kelas;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	$tahunmasuk = '';
	$kodepadamu = '';
	foreach($tb->result() as $b)
		{
		$tahunmasuk = substr($b->tglditerima,0,4);
		$kodepadamu = $b->kodepadamu;
	if (!empty($b->jalan))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Jalan '.$b->jalan;
		}
	if (!empty($b->rt))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'RT '.$b->rt;

		}
	if (!empty($b->rw))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'RW '.$b->rw;
		}
	if (!empty($b->dusun))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Dusun '.$b->dusun;
		}
	if (!empty($b->desa))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Desa '.$b->desa;
		}
	if (!empty($b->kec))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Kec. '.$b->kec;
		}
	if (!empty($b->kab))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Kab. '.$b->kab;
		}
	if (!empty($b->prov))
		{
		if (!empty($alamat2))
			{
			$alamat2 .= ' ';
			}
		$alamat2 .= 'Prov. '.$b->prov;
		}
	$goldarah = $b->goldarah;
	$hp = $b->hp;
	} //akhir foreach $tb
	if ($tahunmasuk == '0000')
		{
		$tahunmasuk = '';
		}
	$tingkat = '';
	if (substr($kelas,0,2) == 'X-')
		{
		$tingkat = 10;
		} 
	if (substr($kelas,0,3) == 'XI-')
		{
		$tingkat = 11;
		} 
	if (substr($kelas,0,4) == 'XII-')
		{
		$tingkat = 12;
		}
	if ($tingkat != '')
	{
	$this->excel->getActiveSheet()->setCellValue('A'.$baris,$nomor);
	$this->excel->getActiveSheet()->setCellValue('B'.$baris,$kodepadamu);
	$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($kodepadamu, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->setCellValue('C'.$baris,$nis);
	$this->excel->getActiveSheet()->getCell('C'.$baris)->setValueExplicit($nis, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getStyle('C'.$baris.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
	$this->excel->getActiveSheet()->getCell('D'.$baris)->setValueExplicit($nisn, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getStyle('D'.$baris.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
	$this->excel->getActiveSheet()->setCellValue('E'.$baris,$namasiswa);
	$this->excel->getActiveSheet()->setCellValue('F'.$baris,$kelamin);
	$this->excel->getActiveSheet()->setCellValue('G'.$baris,$tempat);
	$this->excel->getActiveSheet()->getCell('H'.$baris)->setValueExplicit($tanggallahir, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getStyle('H'.$baris.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
	$this->excel->getActiveSheet()->setCellValue('I'.$baris,$alamat);
	$this->excel->getActiveSheet()->setCellValue('J'.$baris,$tingkat);
	$this->excel->getActiveSheet()->setCellValue('K'.$baris,$tahunmasuk);
//	$this->excel->getActiveSheet()->setCellValue('L'.$baris,$alamat2);
//	$this->excel->getActiveSheet()->setCellValue('M'.$baris,$hp);
//	$this->excel->getActiveSheet()->setCellValue('N'.$baris,$goldarah);
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
// akhir unduh xls
