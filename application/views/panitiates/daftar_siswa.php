<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: daftar_siswa.php
// Lokasi      		: application/views/panitiates/
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
$tsiswa = $this->db->query("select * from siswa_kelas where status='Y' and thnajaran='$thnajaran' and `semester`='$semester' order by kelas,no_urut ASC");
$filename = 'daftar_nominasi_peserta_tes'; 	
$csv_output = '"nis","nama","kelas","no_peserta","no_unik","ruang","baris","kolom","kiri_kanan"';
$csv_output .= "\n";
$nomor = 1;
$kelase ='';
foreach($tsiswa->result_array() as $a)
	{
	$nis = $a['nis'];
	$kelas='??';
	if (substr($a['kelas'],0,2)=='X-')
		{$kelas='1';}
	if (substr($a['kelas'],0,3)=='XI-')
		{$kelas='2';}
	if (substr($a['kelas'],0,4)=='XII-')
		{$kelas='3';}
	if ($kelas != $kelase)
		{$nomor=1;
		$kelase = $kelas;
		}
	if ($nomor <1000)

		{
		$nopeserta = "$kelas$nomor";
		}
	if ($nomor <100)
		{
		$nopeserta = $kelas."0".$nomor;
		}

	if ($nomor <10)
		{
		$nopeserta = $kelas."00".$nomor;
		}
	if($kelas != '??')
	{
	$csv_output .= '"';
	$csv_output .= $nis.'","'; //
	$csv_output .= nis_ke_nama($a['nis']).'","'; //E
	$csv_output .= $a['kelas'].'","';
	$csv_output .= $nopeserta.'","","","","",""'; //
	$csv_output .= "\n";
	$nomor++;
	}
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

?>
