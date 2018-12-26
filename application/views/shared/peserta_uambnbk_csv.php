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
$ta = $this->db->query("select * from `siswa_nomor_tes_un` where `thnajaran`='$thnajaran'");
$filename = 'peserta_uambnbk_'.$thnajaran;
$filename = berkas($filename);
$npsn = $this->config->item('sek_npsn');
$nsm = $this->config->item('sek_nsm');

$csv_output = '';
foreach($ta->result() as $a)
{	
	$nis = $a->nis;
	$nomor_un = $a->no_peserta;
	$tb = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tb->result() as $b)
	{
		$namasiswa = strtolower($b->nama);
		$namasiswa = ucwords($namasiswa);
		$nisn = $b->nisn;
		$tmpt = $b->tmpt;
		$tgllhr = $b->tgllhr;
	}
	$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester` = '1' and `nis`='$nis'");
	$kelas = '';
	foreach($tc->result() as $c)
	{
		$kelas = $c->kelas;
	}
	$csv_output .= '"'.$npsn.'","'.$nsm.'","'.$nisn.'","'.$nomor_un.'","","'.$namasiswa.'","'.$kelas.'","","'.$tmpt.'","'.$tgllhr.'"';
	$csv_output .= "\n";		
	}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

