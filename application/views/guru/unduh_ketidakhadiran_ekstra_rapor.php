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
$filename = 'daftar_ketidakhadiran_ekstra_siswa_kelas_'.$kelas.'_semester_'.$semester.'_tahun_'.$thnajaran.'.xlsx'; 	
//load our new PHPExcel library
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$titel = substr('data_siswa',0,20);
$this->excel->getActiveSheet()->setTitle($titel);
$this->excel->getActiveSheet()->setCellValue('A1','NO.');
$this->excel->getActiveSheet()->setCellValue('B1','NAMA');
$this->excel->getActiveSheet()->setCellValue('C1','NOMOR INDUK/ NISN');
$this->excel->getActiveSheet()->setCellValue('D1','SAKIT');
$this->excel->getActiveSheet()->setCellValue('E1','IJIN');
$this->excel->getActiveSheet()->setCellValue('F1','ALPHA');
$this->excel->getActiveSheet()->setCellValue('G1','EKSKUL 1');
$this->excel->getActiveSheet()->setCellValue('H1','NILAI');
$this->excel->getActiveSheet()->setCellValue('I1','KETERANGAN');
$this->excel->getActiveSheet()->setCellValue('J1','EKSKUL 2');
$this->excel->getActiveSheet()->setCellValue('K1','NILAI');
$this->excel->getActiveSheet()->setCellValue('L1','KETERANGAN');
$this->excel->getActiveSheet()->setCellValue('M1','EKSKUL 3');
$this->excel->getActiveSheet()->setCellValue('N1','NILAI');
$this->excel->getActiveSheet()->setCellValue('O1','KETERANGAN');
$this->excel->getActiveSheet()->setCellValue('P1','Prestasi-1');
$this->excel->getActiveSheet()->setCellValue('Q1','KETERANGAN');
$this->excel->getActiveSheet()->setCellValue('R1','Prestasi-2');
$this->excel->getActiveSheet()->setCellValue('S1','KETERANGAN');
$this->excel->getActiveSheet()->setCellValue('T1','Prestasi-3');
$this->excel->getActiveSheet()->setCellValue('U1','KETERANGAN');
$this->excel->getActiveSheet()->setCellValue('V1','Catatan Wali Kelas');
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
		$this->excel->getActiveSheet()->setCellValue('B'.$baris,$b->nama);
		$this->excel->getActiveSheet()->setCellValue('C'.$baris,$b->nis.'/'.$b->nisn);
	}
	$nilai_pribadi = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis'");
	$sakit = 0;
	$izin = 0;
	$tanpa_keterangan = 0;
	$catatanwalikelas = '';
	foreach($nilai_pribadi->result() as $d)
	{
		$catatanwalikelas = $d->wali;
		$sakit = $d->sakit;
		$izin = $d->izin;
		$tanpa_keterangan = $d->tanpa_keterangan;
		$terlambat = $d->terlambat;
		$membolos = $d->membolos;
	} //kalau ada pribadi
	$this->excel->getActiveSheet()->setCellValue('D'.$baris,$sakit);
	$this->excel->getActiveSheet()->setCellValue('E'.$baris,$izin);
	$this->excel->getActiveSheet()->setCellValue('F'.$baris,$tanpa_keterangan);
	$tnilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis' limit 0,1");
	$nama_ekstra = '';
	$nilai_ekstra = '';
	$keterangan_ekstra = '';
	foreach($tnilai_ekstra->result() as $dne)
	{
		$nama_ekstra = $dne->nama_ekstra;
		$nilai_ekstra = $dne->nilai;
		$keterangan_ekstra = $dne->keterangan;
	}
	$this->excel->getActiveSheet()->setCellValue('G'.$baris,$nama_ekstra);
	$this->excel->getActiveSheet()->setCellValue('H'.$baris,$nilai_ekstra);
	$this->excel->getActiveSheet()->setCellValue('I'.$baris,$keterangan_ekstra);
	$tnilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis' limit 1,1");
	$nama_ekstra = '';
	$nilai_ekstra = '';
	$keterangan_ekstra = '';
	foreach($tnilai_ekstra->result() as $dne)
	{
		$nama_ekstra = $dne->nama_ekstra;
		$nilai_ekstra = $dne->nilai;
		$keterangan_ekstra = $dne->keterangan;
	}
	$this->excel->getActiveSheet()->setCellValue('J'.$baris,$nama_ekstra);
	$this->excel->getActiveSheet()->setCellValue('K'.$baris,$nilai_ekstra);
	$this->excel->getActiveSheet()->setCellValue('L'.$baris,$keterangan_ekstra);
	$tnilai_ekstra = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`=$semester and `nis`='$nis' limit 2,1");
	$nama_ekstra = '';
	$nilai_ekstra = '';
	$keterangan_ekstra = '';
	foreach($tnilai_ekstra->result() as $dne)
	{
		$nama_ekstra = $dne->nama_ekstra;
		$nilai_ekstra = $dne->nilai;
		$keterangan_ekstra = $dne->keterangan;
	}
	$this->excel->getActiveSheet()->setCellValue('M'.$baris,$nama_ekstra);
	$this->excel->getActiveSheet()->setCellValue('N'.$baris,$nilai_ekstra);
	$this->excel->getActiveSheet()->setCellValue('O'.$baris,$keterangan_ekstra);
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran' limit 0,1");
	$kegiatan ='';
	$keterangan = '';
	foreach($tpres->result() as $dpres)
	{
		$kegiatan = $dpres->kegiatan;
		$keterangan = $dpres->keterangan;
	}
	$this->excel->getActiveSheet()->setCellValue('P'.$baris,$kegiatan);
	$this->excel->getActiveSheet()->setCellValue('Q'.$baris,$keterangan);
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran' limit 1,1");
	$kegiatan ='';
	$keterangan = '';
	foreach($tpres->result() as $dpres)
	{
		$kegiatan = $dpres->kegiatan;
		$keterangan = $dpres->keterangan;
	}
	$this->excel->getActiveSheet()->setCellValue('R'.$baris,$kegiatan);
	$this->excel->getActiveSheet()->setCellValue('S'.$baris,$keterangan);
	$tpres = $this->db->query("select * from `siswa_prestasi` where `nis`='$nis' and `thnajaran`='$thnajaran' limit 2,1");
	$kegiatan ='';
	$keterangan = '';
	foreach($tpres->result() as $dpres)
	{
		$kegiatan = $dpres->kegiatan;
		$keterangan = $dpres->keterangan;
	}
	$this->excel->getActiveSheet()->setCellValue('T'.$baris,$kegiatan);
	$this->excel->getActiveSheet()->setCellValue('U'.$baris,$keterangan);
	$this->excel->getActiveSheet()->setCellValue('V'.$baris,$catatanwalikelas);
	$nourut++;
}
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
