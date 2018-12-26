<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 19 Jan 2015 21:01:19 WIB 
// Nama Berkas 		: form_unduh_bph.php
// Lokasi      		: application/views/guru/
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
if ((empty($id_mapel)) or (empty($semester)) or (empty($kodeguru)) or (empty($tahun1)))
{
	
	echo '<div class="container-fluid"><div class="alert alert-warning">Galat, parameter tidak lengkap.&nbsp;&nbsp;&nbsp;';
	echo '<a href="'.base_url().'unggah/unduhperangkat/'.$item.'">Kembali</a></div></div>';
}
else
{
	$mapel = berkas(id_mapel_jadi_mapel($id_mapel));
	$kelas = berkas(id_mapel_jadi_kelas($id_mapel));
	/*
	$filename = 'rph_bph_tugas_'.$thnajaran.'_'.$semester.'_'.$kelas.'_'.$mapel.'_'.$kodeguru.''; 
	$csv_output = '"thnajaran","semester","kelas","kodeguru","mapel","tanggal","jamke","rencana","sk","kd","keterangan","materi","materi_selanjutnya","tanggal_bph","hambatan_siswa","tugas","tanggalselesai","is_mandiri","solusi"';
	$csv_output .= "\n";
	$ta = $this->db->query("select * from guru_rph where kelas = '$kelas' and thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' order by tanggal,kelas ASC");
	foreach($ta->result() as $a)
	{
		$csv_output .= '"'.$a->thnajaran.'","'.$a->semester.'","'.$a->kelas.'","'.$a->kodeguru.'","'.$a->mapel.'","'.$a->tanggal.'","'.$a->jamke.'","'.$a->rencana.'","'.$a->sk.'","'.$a->kd.'","'.$a->keterangan.'","'.$a->materi.'","'.$a->materi_selanjutnya.'","'.$a->tanggal_bph.'","'.$a->hambatan_siswa.'","'.$a->tugas.'","'.$a->tanggalselesai.'","'.$a->is_mandiri.'","'.$a->solusi.'"';					
		$csv_output .= "\n";
	}
	*/
	$filename = 'rph_bph_'.$thnajaran.'_'.$semester.'_'.$kelas.'_'.$mapel.'_'.$kodeguru.''; 
	$csv_output = '"thnajaran","semester","kelas","kodeguru","mapel","tanggal","jamke","kode_rpp","kode_rpp2","tanggal_bph","hambatan_siswa","solusi","alat_dan_bahan","lab","keterangan"';
	$csv_output .= "\n";
	$ta = $this->db->query("select * from guru_rph_ringkas where kelas = '$kelas' and thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' order by tanggal,kelas ASC");
	foreach($ta->result() as $a)
	{
		$csv_output .= '"'.$a->thnajaran.'","'.$a->semester.'","'.$a->kelas.'","'.$a->kodeguru.'","'.$a->mapel.'","'.$a->tanggal.'","'.$a->jamke.'","'.$a->kode_rpp.'","'.$a->kode_rpp2.'","'.$a->tanggal_bph.'","'.$a->hambatan_siswa.'","'.$a->solusi.'","'.$a->alat_dan_bahan.'","'.$a->lab.'","'.$a->keterangan.'"';
		$csv_output .= "\n";
	}

	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: csv" . date("Y-m-d") . ".csv");
	header( "Content-disposition: filename=".$filename.".csv");
	print $csv_output;
 
exit;
}
?>
