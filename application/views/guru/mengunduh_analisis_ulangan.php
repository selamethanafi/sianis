<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 26 Peb 2015 17:41:49 WIB 
// Nama Berkas 		: mengunduh_analisis_ulangan.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//======================================
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
$mapel = id_mapel_jadi_mapel($id_mapel);
$kelas = id_mapel_jadi_kelas($id_mapel);
if ((empty($thnajaran)) or (empty($semester)) or (empty($ulangan)) or (empty($id_mapel)) or (empty($kelas)) or (empty($kodeguru)))
{

	echo 'Galat, parameter tidak lengkap. '.$thnajaran.' '.$semester.' '.$mapel.' '.$kelas.' '.$ulangan.' '.$kodeguru.' &nbsp;&nbsp;&nbsp;';
	echo '<a href="'.base_url().'index.php/unggah/unduhperangkat">Kembali</a>';
}
else
{
	$filename = 'analisis_'.$ulangan.'_'.$mapel.'_'.$kelas.'_'.$thnajaran.'_'.$semester.'_'.$kodeguru.''; 	
	$filename = berkas($filename);
	$csv_output = '"thnajaran","semester","mapel","kelas","nis","no_urut","ulangan","jawaban","nilai_s1","nilai_s2","nilai_s3","nilai_s4","nilai_s5","nilai_s6","nilai_s7","nilai_s8","nilai_s9","nilai_s10","nilai_s11","nilai_s12","nilai_s13","nilai_s14","nilai_s15","nilai_s16","nilai_s17","nilai_s18","nilai_s19","nilai_s20","nilai_s21","nilai_s22","nilai_s23","nilai_s24","nilai_s25","nilai_s26","nilai_s27","nilai_s28","nilai_s29","nilai_s30","nilai_s31","nilai_s32","nilai_s33","nilai_s34","nilai_s35","nilai_s36","nilai_s37","nilai_s38","nilai_s39","nilai_s40","nilai_s41","nilai_s42","nilai_s43","nilai_s44","nilai_s45","nilai_s46","nilai_s47","nilai_s48","nilai_s49","nilai_s50","dicapai","nilai_ideal","persentase","ketuntasan","status","uraian_1","uraian_2","uraian_3","uraian_4","uraian_5","nilai_akhir","terkunci","kelompok"';
	$csv_output .= "\n";
	$ta = $this->db->query("select * from analisis where kelas = '$kelas' and semester='$semester' and thnajaran='$thnajaran' and mapel='$mapel' and `ulangan`='$ulangan'");
	foreach($ta->result() as $a)
	{
	$csv_output .= '"'.$a->thnajaran.'","'.$a->semester.'","'.$a->mapel.'","'.$a->kelas.'","'.$a->nis.'","'.$a->no_urut.'","'.$a->ulangan.'","'.$a->jawaban.'","'.$a->nilai_s1.'","'.$a->nilai_s2.'","'.$a->nilai_s3.'","'.$a->nilai_s4.'","'.$a->nilai_s5.'","'.$a->nilai_s6.'","'.$a->nilai_s7.'","'.$a->nilai_s8.'","'.$a->nilai_s9.'","'.$a->nilai_s10.'","'.$a->nilai_s11.'","'.$a->nilai_s12.'","'.$a->nilai_s13.'","'.$a->nilai_s14.'","'.$a->nilai_s15.'","'.$a->nilai_s16.'","'.$a->nilai_s17.'","'.$a->nilai_s18.'","'.$a->nilai_s19.'","'.$a->nilai_s20.'","'.$a->nilai_s21.'","'.$a->nilai_s22.'","'.$a->nilai_s23.'","'.$a->nilai_s24.'","'.$a->nilai_s25.'","'.$a->nilai_s26.'","'.$a->nilai_s27.'","'.$a->nilai_s28.'","'.$a->nilai_s29.'","'.$a->nilai_s30.'","'.$a->nilai_s31.'","'.$a->nilai_s32.'","'.$a->nilai_s33.'","'.$a->nilai_s34.'","'.$a->nilai_s35.'","'.$a->nilai_s36.'","'.$a->nilai_s37.'","'.$a->nilai_s38.'","'.$a->nilai_s39.'","'.$a->nilai_s40.'","'.$a->nilai_s41.'","'.$a->nilai_s42.'","'.$a->nilai_s43.'","'.$a->nilai_s44.'","'.$a->nilai_s45.'","'.$a->nilai_s46.'","'.$a->nilai_s47.'","'.$a->nilai_s48.'","'.$a->nilai_s49.'","'.$a->nilai_s50.'","'.$a->dicapai.'","'.$a->nilai_ideal.'","'.$a->persentase.'","'.$a->ketuntasan.'","'.$a->status.'","'.$a->uraian_1.'","'.$a->uraian_2.'","'.$a->uraian_3.'","'.$a->uraian_4.'","'.$a->uraian_5.'","'.$a->nilai_akhir.'","'.$a->terkunci.'","'.$a->kelompok.'"';
		$csv_output .= "\n";
	}
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: csv" . date("Y-m-d") . ".csv");
	header( "Content-disposition: filename=".$filename.".csv");
	print $csv_output;
 
exit;
}
?>
