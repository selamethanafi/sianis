<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_jawaban_siswa_unduh_csv.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
	$thnajarane = berkas($thnajaran);
	$mapele = berkas($mapel);
	$kelase = berkas($kelas);
	$filename = 'jawaban_siswa_ulangan_'.$ulangan.'_tahun_'.$thnajarane.'_semester_'.$semester.'_'.$mapele.'_kelas_'.$kelase.'_kodeguru_'.$kodeguru.''; 	
	$csv_output = '"thnajaran","semester","mapel","kelas","ulangan","nis","nama","kelompok","jawaban"';
	$csv_output .= "\n";
	$ta =$this->db->query("select * from analisis where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and status='Y' and `ulangan` = '$ulangan' order by no_urut ASC");
	$baris=2;
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$namasiswa = nis_ke_nama($nis);
		$csv_output .= '"'.$a->thnajaran.'","'.$a->semester.'","'.$a->mapel.'","'.$a->kelas.'","'.$a->ulangan.'","'.$a->nis.'","'.$namasiswa.'","'.$a->kelompok.'","'.$a->jawaban.'"';
		$csv_output .= "\n";
		$baris++;
	}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>
