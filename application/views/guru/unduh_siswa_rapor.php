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
$filename = 'daftar_siswa_kelas_'.$kelas.'_semester_'.$semester.'_tahun_'.$thnajaran.'.xlsx'; 	
//load our new PHPExcel library
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = substr('data_siswa',0,20);
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','No.');
$this->excel->getActiveSheet()->setCellValue('B1','NIS');
$this->excel->getActiveSheet()->setCellValue('C1','/');
$this->excel->getActiveSheet()->setCellValue('D1','NISN');
$this->excel->getActiveSheet()->setCellValue('E1','NIS/NISN');
$this->excel->getActiveSheet()->setCellValue('F1','Nama');
$this->excel->getActiveSheet()->setCellValue('G1','Tempat Tanggal Lahir');
$this->excel->getActiveSheet()->setCellValue('H1','Jenis Kelamin');
$this->excel->getActiveSheet()->setCellValue('I1','Agama');
$this->excel->getActiveSheet()->setCellValue('J1','Status dalam keluarga');
$this->excel->getActiveSheet()->setCellValue('K1','Anak ke');
$this->excel->getActiveSheet()->setCellValue('L1','Alamat Peserta Didik');
$this->excel->getActiveSheet()->setCellValue('M1','Nomor telepon / HP');
$this->excel->getActiveSheet()->setCellValue('N1','Sekolah Asal');
$this->excel->getActiveSheet()->setCellValue('O1','Diterima di sekolah ini Kelas');
$this->excel->getActiveSheet()->setCellValue('P1','Tanggal diterima');
$this->excel->getActiveSheet()->setCellValue('Q1','Nama Ayah');
$this->excel->getActiveSheet()->setCellValue('R1','Nama Ibu');
$this->excel->getActiveSheet()->setCellValue('S1','Alamat Orang Tua');
$this->excel->getActiveSheet()->setCellValue('T1','Nomor telepon / HP');
$this->excel->getActiveSheet()->setCellValue('U1','Pekerjaan ayah');
$this->excel->getActiveSheet()->setCellValue('V1','Pekerjaan ibu');
$this->excel->getActiveSheet()->setCellValue('W1','Nama Wali Peserta Didik');
$this->excel->getActiveSheet()->setCellValue('X1','Alamat Wali Peserta Didik');
$this->excel->getActiveSheet()->setCellValue('Y1','Nomor Telpon / HP');
$this->excel->getActiveSheet()->setCellValue('Z1','Pekerjaan Wali Peserta Didik');
$ta = $this->db->query("SELECT * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' ORDER BY `no_urut` ASC");
$nourut = 1;
$baris = 1;
foreach($ta->result() as $a)
{	
	$baris++;
	$nis = $a->nis;
	$tb = $this->db->query("SELECT * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('A'.$baris,$nourut);
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,$b->nis);
		$this->excel->getActiveSheet()->setCellValue('C'.$baris,'/');
		$this->excel->getActiveSheet()->setCellValue('D'.$baris,'\''.$b->nisn);
		$this->excel->getActiveSheet()->setCellValue('E'.$baris,$b->nis.'/'.$b->nisn);
		$this->excel->getActiveSheet()->setCellValue('F'.$baris,$b->nama);
		$this->excel->getActiveSheet()->setCellValue('G'.$baris,$b->tmpt.', '.date_to_long_string($b->tgllhr));
		$this->excel->getActiveSheet()->setCellValue('H'.$baris,substr($b->jenkel,0,1));
		$this->excel->getActiveSheet()->setCellValue('I'.$baris,$b->agama);
		$this->excel->getActiveSheet()->setCellValue('J'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('K'.$baris,$b->anakke);
		$this->excel->getActiveSheet()->setCellValue('L'.$baris,$b->alamat);
		$this->excel->getActiveSheet()->setCellValue('M'.$baris,'\''.$b->hp);
		$this->excel->getActiveSheet()->setCellValue('N'.$baris,$b->sltp);
		$this->excel->getActiveSheet()->setCellValue('O'.$baris,$b->kls);
		$this->excel->getActiveSheet()->setCellValue('P'.$baris,date_to_long_string($b->tglditerima));
		$this->excel->getActiveSheet()->setCellValue('Q'.$baris,$b->nmayah);
		$this->excel->getActiveSheet()->setCellValue('R'.$baris,$b->nmibu);
		$this->excel->getActiveSheet()->setCellValue('S'.$baris,$b->alayah);
		$this->excel->getActiveSheet()->setCellValue('T'.$baris,'\''.$b->tayah);
		$this->excel->getActiveSheet()->setCellValue('U'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('V'.$baris,'');
		$this->excel->getActiveSheet()->setCellValue('W'.$baris,$b->nmwali);
		$this->excel->getActiveSheet()->setCellValue('X'.$baris,$b->awali);
		$this->excel->getActiveSheet()->setCellValue('Y'.$baris,'\''.$b->twali);
		$this->excel->getActiveSheet()->setCellValue('Z'.$baris,'');
		$nourut++;
	}
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
