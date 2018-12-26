<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 10 Jun 2015 12:16:38 WIB 
// Nama Berkas 		: unduh_ketidakhadiran.php
// Lokasi      		: application/views/bp/
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
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
	{
$thnajarane = berkas($thnajaran);
$kelase = berkas($kelas);
$filename = 'daftar_ketidakhadiran_siswa_kelas_'.$kelase.'_semester_'.$semester.'_tahun_'.$thnajarane.''; 	
$csv_output = '"thnajaran","semester","nis","nama","tanggalabsen","alasan","keterangan","kode_guru","lama_terlambat"';
$csv_output .= "\n";
$qdt = $this->db->query("SELECT * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas'");
//nek gak null
$dt_nox = 0;
foreach($qdt->result() as $rdt)
{
	$dt_nox = $dt_nox + 1;
	$nis = $rdt->nis;
	$qdty = $this->db->query("SELECT * from siswa_absensi where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
	$tdty = $qdty->num_rows();
	if ($tdty>0)
	{
		foreach($qdty->result() as $rdty)
		{
		$alasan = $rdty->alasan;
		$kode_guru = $rdty->kode_guru;
		$lama_terlambat =  $rdty->lama_terlambat;
		$tanggal =  $rdty->tanggal;
		$keterangan =  $rdty->keterangan;
		$csv_output .= '"'.$thnajaran.'","'.$semester.'","'.$nis.'","'.nis_ke_nama($nis).'","'.$tanggal.'","'.$alasan.'","'.$keterangan.'","'.$kode_guru.'","'.$lama_terlambat.'"';
		$csv_output .= "\n";
		}
	}
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
}
