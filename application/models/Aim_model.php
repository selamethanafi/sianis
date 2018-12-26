<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: admin_model.php
// Lokasi      		: application/views/models
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
class Aim_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function Cek_Token($token)
	{
		$t=$this->db->query("select `token` from `siswa_proses_izin` where `token`='$token'");
		$adat = $t->num_rows();
		return $adat;
	}
	function Simpan_Izin($in)
	{
		$kat=$this->db->insert('siswa_proses_izin',$in);
		return $kat;
	}

}
