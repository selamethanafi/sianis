<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_semua_nilai_xls.php
// Lokasi      		: application/views/shared
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$thnajaranawal = substr(berkas($thnajaran),0,4);
$thnajaranakhir = substr(berkas($thnajaran),5,4);
$table = 'nilai'; // table you want to export
$tc = $this->db->query("select * from m_walikelas where `id_walikelas`='$id_kelas'");
foreach($tc->result() as $c)
{
	$kelas = $c->kelas;
}
$kelase = berkas($kelas);
$judul = 'nilai';
//Daftar_Nilai_X.1_2011_1
$filename = 'Daftar_Semua_Nilai_'.$kelase.'_'.$thnajaranawal.'_'.$thnajaranakhir.'_'.$semester.'.xls'; 	
// MULAI CARI NILAI

//SISWA KELAS X-1
$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ");
//activate worksheet number 1
// cari mata pelajaran


$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Worksheet');
$this->excel->getActiveSheet()->setCellValue('A1', 'Daftar Semua Nilai Tahun '.$thnajaran.' Semester '.$semester.' Kelas '.$kelas);
$this->excel->getActiveSheet()->setCellValue('A3', 'No.');
$this->excel->getActiveSheet()->setCellValue('B3', 'NIS');
//$this->excel->getActiveSheet()->mergeCells("B3:B4");
$this->excel->getActiveSheet()->setCellValue('C3', 'Nama Siswa');
//$this->excel->getActiveSheet()->mergeCells("C3:C4");
$tb = $this->db->query("select * from m_mapel_rapor where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' order by no_urut");
$nokol = 4;
foreach($tb->result() as $b)
{	
	$kolom = get_col_letter($nokol);
	$nama_mapel = $b->nama_mapel_portal;
	if(!empty($nama_mapel))
	{
		$this->excel->getActiveSheet()->setCellValue($kolom.'3',$nama_mapel);
		$nokol++;
	}
}
$this->excel->getActiveSheet()->getStyle('A3:'.$kolom.'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('A3:'.$kolom.'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A3:'.$kolom.'3')->getFont()->setBold(true);
// akhir judul

$nourut = 1;
$baris = 5;
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$nama = nis_ke_nama($nis);
	$this->excel->getActiveSheet()->setCellValue('A'.$baris.'', $nourut);
//	$this->excel->getActiveSheet()->setCellValue('B'.$baris.'', $nisn);
	$this->excel->getActiveSheet()->getCell('B'.$baris)->setValueExplicit($nis, PHPExcel_Cell_DataType::TYPE_STRING);
	$this->excel->getActiveSheet()->getStyle('B'.$baris.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
	$this->excel->getActiveSheet()->setCellValue('C'.$baris.'', $nama);	
	$nokol = 4;
	foreach($tb->result() as $b)
	{
		$kolom = get_col_letter($nokol);
		$nama_mapel = $b->nama_mapel_portal;
		if(!empty($nama_mapel))
		{
			$this->excel->getActiveSheet()->setCellValue($kolom.'3',$nama_mapel);
			$td = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and mapel = '$nama_mapel' ");
			if(count($td->result())>0)
			{
				foreach($td->result() as $d)
				{
					$kog = $d->kog;
					if ($nama_mapel == 'Seni Budaya')
						{
						$kog = $d->psi;
						}
				}		
			}
			else
			{
				$kog = 0;
			}
			$this->excel->getActiveSheet()->setCellValue($kolom.''.$baris,$kog);
			$nokol++;
		}
	}
	$baris++;
	$nourut++;
}


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
