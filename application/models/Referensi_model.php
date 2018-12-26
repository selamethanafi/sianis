<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : helper_model.php
// Lokasi      : application/models/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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

class Referensi_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
	function ambil_nilai($str) 
	{
		$ref ='referensi tidak ditemukan';
		$t=$this->db->query("select * from `m_referensi` where `opsi`= '$str'");
		foreach($t->result() as $tt)
		{
			$ref=$tt->nilai;
		}
		return $ref;
  	}
}
