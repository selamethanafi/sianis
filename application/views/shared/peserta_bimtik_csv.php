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
$tb = $this->db->query("select * from `m_walikelas` where `id_walikelas` = '$id_walikelas'");
$kelas = '';
foreach($tb->result() as $b)
{
	$kelas = $b->kelas;
}

$filename = 'peserta_bimtik_'.$thnajaran.'_semester_'.$semester.'_kelas_'.$kelas;
$filename = berkas($filename);
$csv_output = '"NIS","NISN","Nama Siswa","Tempat Lahir","Tanggal Lahir","Jenis Kelamin","Kelas","Nomor Urut"';
$csv_output .= "\n";
$ta = $this->db->query("SELECT * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `status`='Y' and `semester`='$semester' order by no_urut ");
foreach($ta->result() as $rdt)
{	
	$nis = $rdt->nis;
	$namasiswa = nis_ke_nama($nis);
	$nisn = nisn($nis);
	$jenkel = jenkel_siswa($nis,0);
	$tgllhr = tanggal_lahir_siswa($nis);
	$tmpt = tempat_lahir_siswa($nis);
	$csv_output .='"'.$nis.'","'.$nisn.'","'.$namasiswa.'","'.$tmpt.'","'.$tgllhr.'","'.$jenkel.'","'.$rdt->kelas.'","'.$rdt->no_urut.'"'; 
	$csv_output .= "\n";
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

