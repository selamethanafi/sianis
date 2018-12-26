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
}

$tsk = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `kelas`,`no_urut`");
$filename = 'peserta_tes_'.$thnajaran.'_'.$semester.'_kelas_'.$kelas;
$filename = berkas($filename);
$csv_output = 'user_id	user_name	user_password	user_email	user_regdate	user_ip	user_firstname	user_lastname	user_birthdate	user_birthplace	user_regnumber	user_ssn	user_level	user_verifycode	user_otpkey	user_groups';
$csv_output .= "\n";
foreach($tsk->result() as $d)
	{
	$nis = $d->nis;
	$namasiswa = nis_ke_nama($nis);
	$passbaru = random_string('num','7').'*';
	$ta = $this->db->query("select `nis`,`password_tes` from `datsis` where `nis` = '$nis'");
	$password_tes = '';
	foreach($ta->result() as $a)
	{
		$password_tes = $a->password_tes;
	}
	if(empty($password_tes))
	{
		$this->db->query("update `datsis` set `password_tes` = '$passbaru' where `nis`='$nis'");
	}
	else
	{
		$passbaru = $password_tes;
	}
	$this->db->query("update `datsis` set `password_tes` = '$passbaru' where `nis`='$nis'");
	$tgllhr = tanggal_lahir_siswa($nis);
	$tmpt = tempat_lahir_siswa($nis);
	$group = $d->kelas.' '.$thnajaran;
	$csv_output .= '	'; //user id
	$csv_output .= $nis.'	'; //username
	$csv_output .= $passbaru.'	'; //password
	$csv_output .= '	'; //email
	$csv_output .= '	'; //regdate
	$csv_output .= '	'; //ip
	$csv_output .= ucwords(strtolower($namasiswa)).'	'; //nama
	$csv_output .= ucwords(strtolower($namasiswa)).'	'; //nama
	$csv_output .= $tgllhr.'	'; //tglhr
	$csv_output .= $tmpt.'	'; //tmpt
	$csv_output .= '	'; //regnumber
	$csv_output .= '	'; //ssn
	$csv_output .= '1	'; //level
	$csv_output .= '	'; //verifycode
	$csv_output .= '	'; //otpk
	$csv_output .= $group; //16
	$csv_output .= "\n";
}

header("Content-type: application/vnd.ms-excel");
header( "Content-disposition: filename=".$filename.".tsv");
print $csv_output;
exit;

?>
