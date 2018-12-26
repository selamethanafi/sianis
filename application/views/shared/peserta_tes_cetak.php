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
$td = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
$kelas = '';
foreach($td->result() as $d)
{
	$kelas = $d->kelas;
	$thnajaran = $d->thnajaran;
}
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `kelas`,`no_urut`");
$filename = 'peserta_ubk_'.$thnajaran.'_'.$semester.'_kelas_'.$kelas;
$filename = berkas($filename);
$csv_output = '';
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$passbaru = random_string('nozero','7').'*';
		$this->db->query("update `datsis` set `password_tes` = '$passbaru' where `nis`='$nis'");
		$nama_siswa = strtolower($b->nama);
		$nama_siswa = ucwords($nama_siswa);
		$tmpt = $b->tmpt;
		$tgllhr = $b->tgllhr;
		$ttl = $tmpt.', '.tanggal($tgllhr);
		$alamat = $b->alamat;
		$foto = $b->foto;
		$csv_output .= '"'.$nis.'","'.$nis.'","'.$nama_siswa.'","'.$passbaru.'","'.$kelas.'","","","'.$foto.'","",""';
		$csv_output .= "\n";		
	} //akhir foreach $tb
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

