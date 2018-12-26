<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 16:00:09 WIB 
// Nama Berkas 		: anggota_perpustakaan.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
		$tahun = date("Y");
		$bulan = date("m");
		$tanggal = date("d");

$filename = 'anggota_perpustakaan.xls'; 	
//load our new PHPExcel library

//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = substr('daftar_siswa',0,20);
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1', 'member_id');
$this->excel->getActiveSheet()->setCellValue('B1', 'member_name');
$this->excel->getActiveSheet()->setCellValue('C1','gender');
$this->excel->getActiveSheet()->setCellValue('D1', 'birth_date');
$this->excel->getActiveSheet()->setCellValue('E1','member_type_id');
$this->excel->getActiveSheet()->setCellValue('F1','member_address');
$this->excel->getActiveSheet()->setCellValue('G1','is_new');
$this->excel->getActiveSheet()->setCellValue('H1','member_image');
$this->excel->getActiveSheet()->setCellValue('I1','inst_name');
$this->excel->getActiveSheet()->setCellValue('J1','member_phone');
$this->excel->getActiveSheet()->setCellValue('K1','member_since_date');
$this->excel->getActiveSheet()->setCellValue('L1','register_date');
$this->excel->getActiveSheet()->setCellValue('M1','expire_date');
$this->excel->getActiveSheet()->setCellValue('N1','is_pending');
$this->excel->getActiveSheet()->setCellValue('O1','mpasswd');
$ta = $this->db->query("SELECT * from datsis where ket='Y' ORDER BY nis ASC");
$nourut = 1;
$baris = 1;
$pembagiujian = 1;
foreach($ta->result() as $a)
{	
	$baris++;
	$nis = $a->nis;
	$member_id = $a->nis;
	$member_name = $a->nama;
	$gender = '';
	if ($a->jenkel=='Laki-laki')
		{
		$gender = 1;
		}
	if ($a->jenkel=='Perempuan')
		{
		$gender = 0;
		}
	$birth_date = $a->tgllhr;
	$member_type_id = "1";
	$member_address =ucwords(strtolower($a->alamat));
	$is_new = 0;
	$foto = $a->foto;
	$member_image='';
	if (!empty($foto))
		{
		$member_image = "http://mantengaran.sch.id/foto_siswa_qrswt/$foto";
		}

	$member_phone = $a->hp;
	if (substr($member_phone,0,1)=='6')
		{
			$member_phone = "+".$member_phone;
		}
	if (substr($member_phone,0,2)=='08')
		{
			$member_phone = "+628".$member_phone;
		}
	if (substr($member_phone,0,3)=='+08')
		{
			$noasli = substr($member_phone,2,15);
			$member_phone = "+628".$noasli;
		}

	$member_since_date = $a->tglditerima;
	$dx = substr($member_since_date,8,2);
	$mx = substr($member_since_date,5,2);
	$yx = substr($member_since_date,0,4);
	$register_date = "$tahun-$bulan-$tanggal";
	$thnx = $yx;
	if ($yx=='0000')
		{
		if (substr($a->kdkls,0,2)=='X-')
			{
			$thnx = $tahun + 3;
			$member_since_date = ''.$tahun.'-07-01';
			$expire_date = "$thnx-07-01";
			}
		if (substr($a->kdkls,0,3)=='XI-')
			{
			$thnx = $tahun + 2;
			$thny = $tahun - 1;
			$member_since_date = ''.$thny.'-07-01';
			$expire_date = "$thnx-07-01";
			}
		if (substr($a->kdkls,0,4)=='XII-')
			{
			$thnx = $tahun + 1;
			$thny = $tahun - 2;
			$member_since_date = ''.$thny.'-07-01';
			$expire_date = "$thnx-07-01";
			}


		}
		else
		{

		$thnx = substr($member_since_date,0,4)+3;
		$expire_date = "$thnx-$mx-$dx";
		}
		

	$is_pending = 0;
	// cari password
	$mpasswd = md5($a->nis);
	$inst_name = $a->kdkls;
	$this->excel->getActiveSheet()->setCellValue('A'.$baris.'',$member_id);
	$this->excel->getActiveSheet()->setCellValue('B'.$baris.'',$member_name);
	$this->excel->getActiveSheet()->setCellValue('C'.$baris.'',$gender);
	$this->excel->getActiveSheet()->setCellValue('D'.$baris.'',$birth_date);
	$this->excel->getActiveSheet()->setCellValue('E'.$baris.'',$member_type_id);
	$this->excel->getActiveSheet()->setCellValue('F'.$baris.'',$member_address);
	$this->excel->getActiveSheet()->setCellValue('G'.$baris.'',$is_new);
	$this->excel->getActiveSheet()->setCellValue('H'.$baris.'',$member_image);
	$this->excel->getActiveSheet()->setCellValue('I'.$baris.'',$inst_name);
	$this->excel->getActiveSheet()->setCellValue('J'.$baris.'',$member_phone);
	$this->excel->getActiveSheet()->setCellValue('K'.$baris.'',$member_since_date);
	$this->excel->getActiveSheet()->setCellValue('L'.$baris.'',$register_date);
	$this->excel->getActiveSheet()->setCellValue('M'.$baris.'',$expire_date);
	$this->excel->getActiveSheet()->setCellValue('N'.$baris.'',$is_pending);
	$this->excel->getActiveSheet()->setCellValue('O'.$baris.'',$mpasswd);

}

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
