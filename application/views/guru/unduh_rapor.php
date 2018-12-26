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
$filename = 'nilai_mapel_'.$mapel.'_kelas_'.$kelas.'_semester_'.$semester.'_tahun_'.$thnajaran.'.xlsx'; 	
//load our new PHPExcel library
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = substr('nilai_siswa',0,20);
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NO');
$this->excel->getActiveSheet()->setCellValue('B1','NIS');
$this->excel->getActiveSheet()->setCellValue('C1','Nama');
$this->excel->getActiveSheet()->setCellValue('D1','Pengetahuan');
$this->excel->getActiveSheet()->setCellValue('E1','Predikat');
$this->excel->getActiveSheet()->setCellValue('E1','Deskripsi Pengetahuan');
$this->excel->getActiveSheet()->setCellValue('G1','Keterampilan');
$this->excel->getActiveSheet()->setCellValue('H1','Predikat');
$this->excel->getActiveSheet()->setCellValue('I1','Deskripsi Keterampilan');
$ta = $this->db->query("SELECT * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' ORDER BY `no_urut` ASC");
$nourut = 1;
$baris = 1;
foreach($ta->result() as $a)
{	
	$baris++;
	$nis = $a->nis;
	$nama_siswa = nis_ke_nama($nis);
	$tb = $this->db->query("SELECT * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `status`='Y' and `nis`='$nis'");
	$this->excel->getActiveSheet()->setCellValue('B'.$baris.'',$nis);
	$this->excel->getActiveSheet()->setCellValue('C'.$baris.'',$nama_siswa);
	foreach($tb->result() as $b)
	{
		$this->excel->getActiveSheet()->setCellValue('D'.$baris.'',$b->kog);
		$this->excel->getActiveSheet()->setCellValue('E'.$baris.'',predikat_nilai_2018($b->kog,$kkm));
		$this->excel->getActiveSheet()->setCellValue('F'.$baris.'',$b->keterangan);
		$this->excel->getActiveSheet()->setCellValue('G'.$baris.'',$b->psi);
		$this->excel->getActiveSheet()->setCellValue('H'.$baris.'',predikat_nilai_2018($b->psi,$kkm));
		$this->excel->getActiveSheet()->setCellValue('I'.$baris.'',$b->deskripsi);
	}
}
$baris = 52;
$this->excel->getActiveSheet()->setCellValue('D'.$baris.'',$kkm);

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
