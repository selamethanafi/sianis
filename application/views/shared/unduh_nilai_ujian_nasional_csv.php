<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_nilai_ujian_nasional_csv.php
// Lokasi      		: application/views/shared
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$thnajaranawal = substr(berkas($thnajaran),0,4);
$thnajaranakhir = substr(berkas($thnajaran),5,4);
$kelase = berkas($kelas);
$judul = 'nilai';
$tf = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran'");
$pembagi = count($tf->result());
$program = kelas_jadi_program($kelas);
//Daftar_Nilai_X.1_2011_1
$filename = 'Nilai_Ujian_Nasional_Ijazah_'.$kelase.'_'.$thnajaranawal.'_'.$thnajaranakhir.''; 	
//header kolom
if($thnajaran == '2014/2015')
{
$csv_output = '"","","","",""';
$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($taa->result() as $aa)
	{
	$csv_output .= ',"'.$aa->mapel.'","",""';
	}
$csv_output .= "\n";
$csv_output .= '"nomor","nama","tempat, tanggal lahir","nisn","no peserta UN"';
$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($taa->result() as $aa)
	{
	$csv_output .= ',"NS","NUN"';
	}
$csv_output .= "\n";
$nomor = 1;
$tb = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='2' and status='Y' order by no_urut ");
foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$csv_output .= '"'.$nomor.'","'.nis_ke_nama($nis).'","'.tempat_lahir_siswa($nis).', '.date_to_long_string(tanggal_lahir_siswa($nis)).'","'.nisn($nis).'","'.nomor_un($nis).'"';
	//ujian nasional
	$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
	foreach($taa->result() as $aa)
		{
		$mapel = $aa->mapel;
		$te = $this->db->query("select * from nilai_un where nis='$nis' and mapel='$mapel'");			
		foreach($te->result() as $e)
			{
			$csv_output .= ',"'.$e->ns.'"';
			$csv_output .= ',"'.$e->un.'"';
			}
		}
	$csv_output .= "\n";		
	$nomor++;
	}

}
else
{
$csv_output = '"","","","",""';
$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($taa->result() as $aa)
	{
	$csv_output .= ',"'.$aa->mapel.'","",""';
	}
$csv_output .= "\n";
$csv_output .= '"nomor","nama","tempat, tanggal lahir","nisn","no peserta UN"';
$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($taa->result() as $aa)
	{
	$csv_output .= ',"NS","NUN","NA"';
	}
$csv_output .= "\n";
$nomor = 1;
$tb = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='2' and status='Y' order by no_urut ");
foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$csv_output .= '"'.$nomor.'","'.nis_ke_nama($nis).'","'.tempat_lahir_siswa($nis).', '.date_to_long_string(tanggal_lahir_siswa($nis)).'","'.nisn($nis).'","'.nomor_un($nis).'"';
	//ujian nasional
	$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
	foreach($taa->result() as $aa)
		{
		$mapel = $aa->mapel;
		$te = $this->db->query("select * from nilai_un where nis='$nis' and mapel='$mapel'");			
		foreach($te->result() as $e)
			{
			$csv_output .= ',"'.$e->ns.'"';
			$csv_output .= ',"'.$e->un.'"';
			$csv_output .= ',"'.$e->na.'"';
			}
		}
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
