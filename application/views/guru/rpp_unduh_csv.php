<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rpp_unduh_csv.php
// Lokasi      : application/views/guru/
// Author: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
	$filename = 'rpp_kodeguru_'.$kodeguru.''; 	
	$csv_output = '"semester","kodeguru","mapel","kelas","no_rpp","standar_kompetensi","waktu","kompetensi_dasar","indikator_pencapaian_kompetensi","tujuan_pembelajaran","materi_pembelajaran","model_pembelajaran","sumber_belajar","strategi_pembelajaran","pendahuluan","eksplorasi","elaborasi","konfirmasi","penutup","penilaian"';
	$csv_output .= "\n";
	$ta = $this->db->query("select * from guru_rpp_induk where kodeguru = '$kodeguru' order by no_rpp");
	foreach($ta->result() as $a)
	{
		$csv_output .= '"'.$a->semester.'","'.$a->kodeguru.'","'.$a->mapel.'","'.$a->kelas.'","'.$a->no_rpp.'","'.$a->standar_kompetensi.'","'.$a->waktu.'","'.$a->kompetensi_dasar.'","'.$a->indikator_pencapaian_kompetensi.'","'.$a->tujuan_pembelajaran.'","'.$a->materi_pembelajaran.'","'.$a->model_pembelajaran.'","'.$a->sumber_belajar.'","'.$a->strategi_pembelajaran.'","'.$a->pendahuluan.'","'.$a->eksplorasi.'","'.$a->elaborasi.'","'.$a->konfirmasi.'","'.$a->penutup.'","'.$a->penilaian.'"';
		$csv_output .= "\n";
	}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>
