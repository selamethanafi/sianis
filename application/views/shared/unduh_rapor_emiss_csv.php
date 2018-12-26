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
$filename = 'Nilai_Rapor_emiss_'.$kelase.'_'.$thnajaranawal.'_'.$thnajaranakhir.''; 	
//header kolom
$csv_output = '"NO","NO-REG","Nama"';
$taa = $this->db->query("select * from `m_mapel_emiss` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
$cacah_mapel_emiss = $taa->num_rows();
foreach($taa->result() as $aa)
{
	$csv_output .= ',"'.$aa->mapel.'","","","","",""';
}
$csv_output .= ',"S","I","A"';
$csv_output .= "\n";
$nomor = 1;
$tb = $this->db->query("select * from `leger_nilai` where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and `kelas`='$kelas'");
foreach($tb->result() as $b)
{
	$nis = $b->nis;
	$datasiswa = $this->helper->data_siswa($nis);
	$noreg = $this->config->item('sek_npsn_emiss').substr($datasiswa['tglditerima'],2,2).$nis;
	if(substr($datasiswa['tglditerima'],2,2) == '00')
	{
		$noreg = $nis;
	}
	$csv_output .= '"'.$nomor.'","'.$noreg.'","'.nis_ke_nama($nis).'"';
	for($i=1;$i<=$cacah_mapel_emiss;$i++)
	{
		$fkog = 'k'.$i;
		$fpsi = 'p'.$i;
		$fafe = 's'.$i;
		$fkkm = 'l'.$i;
		$csv_output .= ',"'.$b->$fkkm.'","'.$b->$fkog.'","","'.$b->$fpsi.'","","'.$b->$fafe.'"';		
	}
	//absensi
	$tc = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and `semester`='$semester' and `nis` = '$nis'");
	$s = '';
	$i = '';
	$tk = '';
	foreach($tc->result() as $c)
	{
		$s = $c->sakit;
		$i = $c->izin;
		$tk = $c->tanpa_keterangan;
	}
	$csv_output .= ',"'.$s.'","'.$i.'","'.$tk.'"';		
	$csv_output .= "\n";		
	$nomor++;
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>
