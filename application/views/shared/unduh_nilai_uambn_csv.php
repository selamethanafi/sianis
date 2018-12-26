<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_nilai_ujian_nasional_csv.php
// Lokasi      		: application/views/shared
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
$ta = $this->db->query("select * from m_walikelas where `id_walikelas` = '$id_walikelas'");
$kelas = '';
foreach($ta->result() as $a)
{
	$kelas = $a->kelas;
}
$kelase = berkas($kelas);
$program = kelas_jadi_program($kelas);
//Daftar_Nilai_X.1_2011_1
$filename = 'Nilai_UAMBN_'.$kelase.'_'.$thnajaranawal.'_'.$thnajaranakhir.''; 	
//header kolom
$csv_output = '"","","","",""';
$taa = $this->db->query("select * from mapel_uambn where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($taa->result() as $aa)
	{
	$csv_output .= ',"'.$aa->nmapel.'",""';
	}
$csv_output .= "\n";
$csv_output .= '"NO","NOMOR PESERTA","NAMA","ASAL MADRASAH","STATUS (N/S)"';
$taa = $this->db->query("select * from mapel_uambn where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($taa->result() as $aa)
	{
	$csv_output .= ',"T","P"';
	}
$csv_output .= "\n";
$nomor = 1;
$tb = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='2' and status='Y' order by no_urut ");
foreach($tb->result() as $b)
	{
	$nis = $b->nis;
	$csv_output .= '"'.$nomor.'","'.nomor_un($nis).'","'.nis_ke_nama($nis).'","'.$this->config->item('sek_nama').'","'.substr($this->config->item('sek_status'),0,1).'"';
	//ujian nasional
	$taa = $this->db->query("select * from mapel_uambn where thnajaran='$thnajaran' and program='$program' order by no_urut");
	foreach($taa->result() as $aa)
		{
		$mapel = $aa->mapel;
		$tertulis = '';
		$praktik  = '';
		$te = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");			
		foreach($te->result() as $e)
			{
			$tertulis = $e->nilai;
			$praktik = $e->praktik;
			}
		$csv_output .= ',"'.$tertulis.'"';
		$csv_output .= ',"'.$praktik.'"';
		}
	$csv_output .= "\n";		
	$nomor++;
	}
header("Content-type: application/vnd.ms-excel");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>
