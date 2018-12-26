<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pkg_helper.php
// Lokasi      		: application/helpers
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php

// ------------------------------------------------------------------------

/**
 * Fungsi - Fungsi Helpers
 * 
 * @author		Selamet Hanafi
 */

// ------------------------------------------------------------------------
if ( ! function_exists('id_ke_kompetensi_guru'))
{
	function id_ke_kompetensi_guru($str) 
	{
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kompetensi = $CI->Helper_model->id_ke_kompetensi_guru($str); 
		return $kompetensi;
  	}
}
if ( ! function_exists('cari_tahun_penilaian'))
{
	function cari_tahun_penilaian()
	{
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tahunpenilaian = $CI->Helper_model->cari_tahun_penilaian(); 
	return $tahunpenilaian;
	}
}


// ------------------------------------------------------------------------


/* End of file fungsi_helper.php */
/* Location: application/helpers/pkg_helper.php */
