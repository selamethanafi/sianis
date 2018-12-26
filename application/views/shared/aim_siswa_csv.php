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
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$filename = 'siswa_aim_'.$thnajaran.'_semester_'.$semester.'_';
$filename = berkas($filename);
$csv_output = '"nis","nama","kelas","hp_ayah","hp_ibu","hp_wali"';
$csv_output .= "\n";
$ta = $this->db->query("SELECT * from `datsis` where `ket`='Y' order by `nama`");
foreach($ta->result() as $rdt)
{	
	$nis = $rdt->nis;
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	if(!empty($kelas))
	{
		$csv_output .='"'.$rdt->nis.'","'.$rdt->nama.'","'.$kelas.'","'.$rdt->tayah.'","'.$rdt->tibu.'","'.$rdt->twali.'"'; 
		$csv_output .= "\n";
	}
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

