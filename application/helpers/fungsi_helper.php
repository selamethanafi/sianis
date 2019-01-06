<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: fungsi_helper.php
// Lokasi      		: application/helpers
// Terakhir diperbarui	: Min 06 Jan 2019 20:27:14 WIB 
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
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
//$koneksi = mysqli_connect('localhost',$db['default']['username'], $db['default']['password'], $db['default']['database']);
if ( ! function_exists('angka_jadi_bulan'))
{
	function angka_jadi_bulan($postedmonth)
	{
		$bulan='';
		if ($postedmonth=="01")
			{
			$bulan = "Januari";
			}
		if ($postedmonth=="02")
			{
			$bulan = "Februari";
			}
		if ($postedmonth=="03")
			{
			$bulan = "Maret";
			}
		if ($postedmonth=="04")
			{
			$bulan = "April";
			}
		if ($postedmonth=="05")
			{
			$bulan = "Mei";
			}
		if ($postedmonth=="06")
			{
			$bulan = "Juni";
			}
		if ($postedmonth=="07")
			{
			$bulan = "Juli";
			}
		if ($postedmonth=="08")
			{
			$bulan = "Agustus";
			}
		if ($postedmonth=="09")
			{
			$bulan = "September";
			}
		if ($postedmonth=="10")
			{
			$bulan = "Oktober";
			}
		if ($postedmonth=="11")
			{
			$bulan = "November";
			}
		if ($postedmonth=="12")
			{
			$bulan = "Desember";
			}
		return $bulan;	
	}
}

if ( ! function_exists('xhuruff'))
{
//angka ke huruf
function xhuruff($str)
	{
	$search = array ("'1'",
				"'2'",
				"'3'",
				"'4'",
				"'5'",
				"'6'",
				"'7'",
				"'8'",
				"'9'",
				"'0'");

	$replace = array ("SATU",
				"DUA",
				"TIGA",
				"EMPAT",
				"LIMA",
				"ENAM",
				"TUJUH",
				"DELAPAN",
				"SEMBILAN",
				" ");

	$str = preg_replace($search,$replace,$str);
	return $str;
	}
}
if ( ! function_exists('dengan_huruf'))
{
//angka ke huruf
function dengan_huruf($str)
	{
	$search = array ("'1'",
				"'2'",
				"'3'",
				"'4'",
				"'5'",
				"'6'",
				"'7'",
				"'8'",
				"'9'",
				"'0'");

	$replace = array ("satu",
				"dua",
				"tiga",
				"empat",
				"lima",
				"enam",
				"tujuh",
				"delapan",
				"sembilan",
				"nol");

	$str = preg_replace($search,$replace,$str);
	return $str;
	}
}
if ( ! function_exists('xhuruf'))
{
//angka ke huruf
function xhuruf($str)
	{
	$search = array ("'1'","'2'","'3'","'4'","'5'","'6'","'7'","'8'","'9'","'0'");
	$replace = array ("satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh");
	if (strlen($str>1))
		{
		$str .= "  ".preg_replace($search,$replace,$str);
		}
		else
		{
		$str .= " ".preg_replace($search,$replace,$str);
		}
	return $str;
	}
}

if ( ! function_exists('xduit'))
{
//pencacah bilangan duit
function xduit($str)
	{
	//bernilai 2 digit
	if (strlen($str) < 3 )
		{
		$rupiah = "Rp $str,00";
		}

	//bernilai 3 digit
	else if (strlen($str) == 3)
		{
		$nil1 = substr($str,-3);
		$rupiah = "Rp $nil1,00";
		}

	//bernilai 4 digit
	else if (strlen($str) == 4)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,-3);
		$rupiah = "Rp $nil1.$nil2,00";
		}


	//jika ada 5 digit
	else if (strlen($str) == 5)
		{
		$nil1 = substr($str,0,2);
		$nil2 = substr($str,-3);
		$rupiah = "Rp $nil1.$nil2,00";
		}

	//jika ada 6 digit
	else if (strlen($str) == 6)
		{
		$nil1 = substr($str,0,3);
		$nil2 = substr($str,-3);
		$rupiah = "Rp $nil1.$nil2,00";
		}

	//jika ada 7 digit
	else if (strlen($str) == 7)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,1,3);
		$nil3 = substr($str,-3);
		$rupiah = "Rp $nil1.$nil2.$nil3,00";
		}

	//jika ada 8 digit
	else if (strlen($str) == 8)
		{
		$nil1 = substr($str,0,2);
		$nil2 = substr($str,2,3);
		$nil3 = substr($str,-3);
		$rupiah = "Rp $nil1.$nil2.$nil3,00";
		}

	//jika ada 9 digit
	else if (strlen($str) == 9)
		{
		$nil1 = substr($str,0,3);
		$nil2 = substr($str,3,3);
		$nil3 = substr($str,-3);
		$rupiah = "Rp $nil1.$nil2.$nil3,00";
		}
	return $rupiah;
	}
	
}
if ( ! function_exists('date_to_long_string'))
{
	function date_to_long_string($tanggale)
	{
		$str= $tanggale;
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
  		$postedday=substr($str,8,2);
		if($postedday<10)
		{
			$postedday = substr($postedday,-1);
		}
		$bulan='';
		if ($postedmonth=="01")
			{
			$bulan = "Januari";
			}
		if ($postedmonth=="02")
			{
			$bulan = "Februari";
			}
		if ($postedmonth=="03")
			{
			$bulan = "Maret";
			}
		if ($postedmonth=="04")
			{
			$bulan = "April";
			}
		if ($postedmonth=="05")
			{
			$bulan = "Mei";
			}
		if ($postedmonth=="06")
			{
			$bulan = "Juni";
			}
		if ($postedmonth=="07")
			{
			$bulan = "Juli";
			}
		if ($postedmonth=="08")
			{
			$bulan = "Agustus";
			}
		if ($postedmonth=="09")
			{
			$bulan = "September";
			}
		if ($postedmonth=="10")
			{
			$bulan = "Oktober";
			}
		if ($postedmonth=="11")
			{
			$bulan = "November";
			}
		if ($postedmonth=="12")
			{
			$bulan = "Desember";
			}
		$tanggalpanjang = "$postedday $bulan $postedyear";	

		return $tanggalpanjang;	
	}
}

if ( ! function_exists('satuan'))
{
	function satuan($str)
	{
		if ($str == '1')
			{
			$str = 'satu';
			}
		if ($str == '2')
			{
			$str = 'dua';
			}
		if ($str == '3')
			{
			$str = 'tiga';
			}
		if ($str == '4')
			{
			$str = 'empat';
			}
		if ($str == '5')
			{
			$str = 'lima';
			}
		if ($str == '6')
			{
			$str = 'enam';
			}
		if ($str == '7')
			{
			$str = 'tujuh';
			}
		if ($str == '8')
			{
			$str = 'delapan';
			}
		if ($str == '9')
			{
			$str = 'sembilan';
			}
		return  $str;
		
	
	}
}
if ( ! function_exists('number_to_long_string'))
{
	function number_to_long_string($str)
	{
	if ($str == 0)
		{
		$str = "";
		}
	else if (strlen($str) == 1)
		{
		$str = satuan($str);
		}
		else
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,1,1);
		if ($str=="10")
			{
			$str = "sepuluh";
			return $str;
			}
		elseif ($str=="100")
			{
			$str = "seratus";
			return $str;
			}
		else if ($str == "11")
			{
			$str = "sebelas";
			return $str;

			}

		else if (($nil1 == "1") and ($nil2 > 1))
			{
			if ($nil2 == 2)
				{$str = "DUA BELAS";}
			if ($nil2 == 3)
				{$str = "TIGA BELAS";}
			if ($nil2 == 4)
				{$str = "EMPAT BELAS";}
			if ($nil2 == 5)
				{$str = "LIMA BELAS";}
			if ($nil2 == 6)
				{$str = "ENAM BELAS";}
			if ($nil2 == 7)
				{$str = "TUJUH BELAS";}
			if ($nil2 == 8)
				{$str = "delapan BELAS";}
			if ($nil2 == 9)
				{$str = "sembilan BELAS";}

			}

		else
		{
			if ($nil2 == 0)
				{
				$str = satuan($nil1).' puluh';
				}
				else
				{
				$str = satuan($nil1).' puluh '.satuan($nil2);
				}
		}
		} // akhir kalau lebih dari 1 digit

//		$str = $nil1.'-'.$nil2;
	return $str;
	}

}
if ( ! function_exists('cari_thnajaran'))
{
	function cari_thnajaran()
	{

		$tahuny = date("Y");
		$bulany = date("m");
		$tanggaly = date("d");
		if (($bulany=='07') or ($bulany=='08') or ($bulany=='09') or ($bulany=='10') or ($bulany=='11') or ($bulany=='12'))
		{
			$tahuny2 = $tahuny+1;
			$thnajaran = ''.$tahuny.'/'.$tahuny2.'';
		}
		else
		{
			$tahuny1 = $tahuny-1;
			$thnajaran = ''.$tahuny1.'/'.$tahuny.'';
		}
		//$thnajaran = '2018/2019';
		return $thnajaran;
	}
}

if ( ! function_exists('cari_semester'))
{
	function cari_semester()
	{

		$tahuny = date("Y");
		$bulany = date("m");
		$tanggaly = date("d");
		if (($bulany=='07') or ($bulany=='08') or ($bulany=='09') or ($bulany=='10') or ($bulany=='11') or ($bulany=='12'))
		{
			$semester= '1';
		}
		else
		{
			$semester= '2';
		}
		//$semester='1';
		return $semester;
	}
}


if ( ! function_exists('kelas_jadi_program'))
{
	function kelas_jadi_program($kelas)
	{
		$program='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$program = $CI->Helper_model->kelas_jadi_program($kelas);
		return $program;
	}
}
if ( ! function_exists('kelas_jadi_tingkat'))
{
	function kelas_jadi_tingkat($kelas)
	{
		$tingkat='';
		if(substr($kelas,0,2) == 'X-')
		{
			$tingkat = 'X';
		}
		if(substr($kelas,0,3) == 'XI-')
		{
			$tingkat = 'XI';
		}
		if(substr($kelas,0,4) == 'XII-')
		{
			$tingkat = 'XII';
		}
		return $tingkat;
	}
}
if ( ! function_exists('nomor_urut_terakhir'))
{
	function nomor_urut_terakhir($thnajaran,$kelas)
	{
		$no_urut='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$no_urut = $CI->Helper_model->nomor_urut_terakhir($thnajaran,$kelas);
		return $no_urut;
	}
}
if ( ! function_exists('berkas'))
{
	function berkas($str) 
	{
	$str = preg_replace("/ /","_", $str);
	$str = preg_replace("/`/","", $str);
	$str = preg_replace("/,/","", $str);
	$str = preg_replace("/\./","_", $str);
	$str = preg_replace("/\//","_", $str);
	return $str;
  	}
}
if ( ! function_exists('nopetik'))
{
	function nopetik($str) 
	{
	$str = preg_replace("/’/","", $str);
	$str = preg_replace("/'/","`", $str);
	return $str;
  	}
}

if ( ! function_exists('bersihkan'))
{
	function bersihkan($str) 
	{
	$str = preg_replace("/ /","_", $str);
	$str = preg_replace("/'/","`", $str);
	$str = preg_replace("/,/","_", $str);
	$str = preg_replace("/\./","_", $str);
	$str = preg_replace("/\//","_", $str);
	return $str;
  	}
}

if ( ! function_exists('get_emoticons'))
{
	function get_emoticons($str) 
	{
	$str = preg_replace("/<p>/","", $str);
	$str = preg_replace("/<\/p>/","<br>", $str);
	$str = preg_replace("/..\/..\/js\/tiny_mce\/plugins\/emotions\/img/","/js/tiny_mce/plugins/emotions/img", $str);
	return $str;
  	}
}

if ( ! function_exists('cari_foto'))
{
	function cari_foto($username)
	{
		$foto = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tdatsis = $CI->Helper_model->get_foto($username);
		foreach($tdatsis->result() as $ddatsis)
			{
			$foto = $ddatsis->foto;
			}
		return $foto;
	}
}

if ( ! function_exists('id_mapel_jadi_mapel'))
{
	function id_mapel_jadi_mapel($str) 
	{
		$mapel = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$mapel = $CI->Helper_model->id_mapel_jadi_mapel($str);
		return $mapel;
  	}
}
if ( ! function_exists('id_mapel_jadi_ranah'))
{
	function id_mapel_jadi_ranah($str) 
	{
		$ranah = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$ranah = $CI->Helper_model->id_mapel_jadi_ranah($str);
		return $ranah;
  	}
}
if ( ! function_exists('id_mapel_jadi_kkm_ulangan'))
{
	function id_mapel_jadi_kkm_ulangan($str,$ulangan) 
	{
		$kkm_ulangan = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kkm_ulangan = $CI->Helper_model->id_mapel_jadi_kkm_ulangan($str,$ulangan);
		return $kkm_ulangan;
  	}
}
if ( ! function_exists('id_mapel_jadi_kkm'))
{
	function id_mapel_jadi_kkm($str) 
	{
		$kkm = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kkm = $CI->Helper_model->id_mapel_jadi_kkm($str);
	return $kkm;
  	}
}
if ( ! function_exists('id_mapel_jadi_cacah_ulangan'))
{
	function id_mapel_jadi_cacah_soal($str,$ulangan) 
	{
		$cacah_soal = '0';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$cacah_soal = $CI->Helper_model->id_mapel_jadi_cacah_soal($str,$ulangan);
	return $cacah_soal;
  	}
}

if ( ! function_exists('id_mapel_jadi_kelas'))
{
	function id_mapel_jadi_kelas($str) 
	{
		$kelas = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kelas = $CI->Helper_model->id_mapel_jadi_kelas($str);
		return $kelas;

  	}
}
if ( ! function_exists('id_kd_jadi_kd'))
{
	function id_kd_jadi_kd($str) 
	{
		$kd = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kd = $CI->Helper_model->id_kd_jadi_kd($str);
	return $kd;
  	}
}
if ( ! function_exists('id_kd_jadi_sk'))
{
	function id_kd_jadi_sk($str) 
	{
	$sk='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$sk = $CI->Helper_model->id_kd_jadi_sk($str);
	return $sk;
  	}
}
if ( ! function_exists('tanggal_ke_hari'))
{
	function tanggal_ke_hari($str) 
	{
	$dinane='?';
	if(strlen($str)==10)
	{
	$x = substr($str,0,4);
	$y = substr($str,5,2);
	$z = substr($str,8,2);
	$dina = date("l", mktime(0, 0, 0, $y, $z, $x));

	if ($dina == 'Sunday')
		{
		$dinane = 'Minggu';
		}
	if ($dina == 'Monday')
		{
		$dinane = 'Senin';
		}
	if ($dina == 'Tuesday')
		{
		$dinane = 'Selasa';
		}
	if ($dina == 'Wednesday')
		{
		$dinane = 'Rabu';
		}
	if ($dina == 'Thursday')
		{
		$dinane = 'Kamis';
		}
	if ($dina == 'Friday')
		{
		$dinane = 'Jumat';
		}
	if ($dina == 'Saturday')
		{
		$dinane = 'Sabtu';
		}
	}
	return $dinane;
  	}
}

if ( ! function_exists('kelas_jadi_tingkat'))
{
	function kelas_jadi_tingkat($str) 
	{
		$tingkat = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tingkat = $CI->Helper_model->kelas_jadi_tingkat($str);
	return $tingkat;
  	}
}

if ( ! function_exists('cari_kepala'))
{
	function cari_kepala($thnajaran,$semester) 
	{
		$namakepala = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namakepala = $CI->Helper_model->cari_kepala($thnajaran,$semester);
		return $namakepala;
  	}
}
if ( ! function_exists('cari_nip_kepala'))
{
	function cari_nip_kepala($thnajaran,$semester) 
	{
		$nipkepala = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$nipkepala = $CI->Helper_model->cari_nip_kepala($thnajaran,$semester);

	return $nipkepala;
  	}
}

if ( ! function_exists('cari_ttd_kepala'))
{
	function cari_ttd_kepala($thnajaran,$semester) 
	{
		$ttdkepala = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$ttdkepala = $CI->Helper_model->cari_ttd_kepala($thnajaran,$semester); 
	return $ttdkepala;
  	}
}
if ( ! function_exists('cari_ttd_kepala_stempel'))
{
	function cari_ttd_kepala_stempel($thnajaran,$semester) 
	{
		$ttdkepala = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$ttdkepala = $CI->Helper_model->cari_ttd_kepala($thnajaran,$semester); 
		$ttdkepala = preg_replace("/jpg/","png", $ttdkepala);
	return $ttdkepala;
  	}
}

if ( ! function_exists('tanggalcetak'))
{
	function tanggalcetak($thnajaran,$semester) 
	{
		$tanggalcetak = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tanggalcetak = $CI->Helper_model->tanggalcetak($thnajaran,$semester); 
	return $tanggalcetak;
  	}
}
if ( ! function_exists('awalsemester'))
{
	function awalsemester($thnajaran,$semester) 
	{
		$awalsemester = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$awalsemester = $CI->Helper_model->awalsemester($thnajaran,$semester); 
	return $awalsemester;
  	}
}

if ( ! function_exists('tanggalsiswaditerima'))
{
	function tanggalsiswaditerima($thnajaran) 
	{
		$tanggalsiswaditerima = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tanggalsiswaditerima = $CI->Helper_model->tanggalsiswaditerima($thnajaran); 
	return $tanggalsiswaditerima;
  	}
}

if ( ! function_exists('cari_nama_pegawai'))
{
	function cari_nama_pegawai($kodeguru) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_nama_pegawai($kodeguru);
		return $namapegawai;
  	}
}
if ( ! function_exists('cari_nip_pegawai'))
{
	function cari_nip_pegawai($kodeguru) 
	{
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$nippegawai = $CI->Helper_model->cari_nip_pegawai($kodeguru);
	return $nippegawai;
  	}
}
if ( ! function_exists('predikat_akhlak'))
{
	function predikat_akhlak($nilai) 
	{
	$predikat_akhlak='Kurang';
	if ($nilai>1.75)
		{$predikat_akhlak='Cukup';
		}
	if ($nilai>2.75)
		{$predikat_akhlak='Baik';
		}
	if ($nilai>3.25)
		{$predikat_akhlak='Amat Baik';
		}
	return $predikat_akhlak;
  	}
}

if ( ! function_exists('nis_ke_nama'))
{
	function nis_ke_nama($nis)
	{
		$namasiswa ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namasiswa = $CI->Helper_model->nis_ke_nama($nis);
		return $namasiswa;
	}
}
if ( ! function_exists('kode_ke_pelanggaran'))
{
	function kode_ke_pelanggaran($kode)
	{
		$namapelanggaran ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapelanggaran = $CI->Helper_model->kode_ke_pelanggaran($kode);
		return $namapelanggaran;
	}
}
if ( ! function_exists('remisi'))
{
	function remisi($nis)
	{
		$remisi = 0;
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$remisi = $CI->Helper_model->remisi($nis);
		return $remisi;
	}
}

if ( ! function_exists('day_to_hari'))
{
	function day_to_hari($dina) 
	{
	$dinane='';
	if ($dina == 'Sunday')
		{
		$dinane = 'Minggu';
		}
	if ($dina == 'Monday')
		{
		$dinane = 'Senin';
		}
	if ($dina == 'Tuesday')
		{
		$dinane = 'Selasa';
		}
	if ($dina == 'Wednesday')
		{
		$dinane = 'Rabu';
		}
	if ($dina == 'Thursday')
		{
		$dinane = 'Kamis';
		}
	if ($dina == 'Friday')
		{
		$dinane = 'Jumat';
		}
	if ($dina == 'Saturday')
		{
		$dinane = 'Sabtu';
		}

	return $dinane;
  	}
}
if ( ! function_exists('tanpa_paragraf'))
{
	function tanpa_paragraf($str) 
	{
	$str = preg_replace("/<p>/","", $str);
	$str = preg_replace("/<\/p>/","<br>", $str);
	return $str;
  	}
}
if ( ! function_exists('tanpa_tabel'))
{
	function tanpa_tabel($str) 
	{
	$str = preg_replace("/<table>/","", $str);
	$str = preg_replace("/<td>/","", $str);
	$str = preg_replace("/<tr>/","", $str);
	$str = preg_replace("/<\/td>/","&nbsp;&nbsp;&nbsp;&nbsp;", $str);
	$str = preg_replace("/<\/tr>/","<br />", $str);
	$str = preg_replace("/<\/table>/","", $str);
	return $str;
  	}
}

if ( ! function_exists('tanggal_ke_day'))
{
	function tanggal_ke_day($str) 
	{
	//2013-02-01
	$x = substr($str,0,4);
	$y = substr($str,5,2);
	$z = substr($str,8,2);
	$dina = date("l", mktime(0, 0, 0, $y, $z, $x));
	return $dina;
  	}
}

if ( ! function_exists('nilai_akhlak'))
{
	function nilai_akhlak($str) 
	{
	$prednilaihuruf = '?';
	if ($str==4)
		{
		$prednilaihuruf = 'Amat Baik';
		}
	if ($str==3)
		{
		$prednilaihuruf = 'Baik';
		}
	if ($str==2)
		{
		$prednilaihuruf = 'Cukup';
		}
	if ($str==1)
		{
		$prednilaihuruf = 'Kurang';
		}

	return $prednilaihuruf;
  	}
}
if ( ! function_exists('tanggal_hari_ini'))
{
	function tanggal_hari_ini() 
	{
		$tahuny = date("Y");
		$bulany = date("m");
		$tanggaly = date("d");
		$tanggalhariini = "$tahuny-$bulany-$tanggaly";
		//$tanggalhariini = '2016-01-31';
	return $tanggalhariini;
  	}
}
if ( ! function_exists('jenkel_siswa'))
{
	function jenkel_siswa($nis,$pilihan)
	{
		//pilihan = 0 => L / p
		$jeniskelamin ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$jeniskelamin = $CI->Helper_model->jenkel_siswa($nis,$pilihan);
		return $jeniskelamin;

	}
}
if ( ! function_exists('tempat_lahir_siswa'))
{
	function tempat_lahir_siswa($nis)
	{
		$tempatlahir ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tempatlahir = $CI->Helper_model->tempat_lahir_siswa($nis);
		return $tempatlahir;
	}
}
if ( ! function_exists('tanggal_lahir_siswa'))
{
	function tanggal_lahir_siswa($nis)
	{
		$tanggallahir ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tanggallahir = $CI->Helper_model->tanggal_lahir_siswa($nis);
		return $tanggallahir;
	}
}
if ( ! function_exists('nomor_un'))
{
	function nomor_un($nis)
	{
		$nomorun ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$nomorun = $CI->Helper_model->nomor_un($nis);
		return $nomorun;
	}
}
if ( ! function_exists('fotosiswa'))
{
	function fotosiswa($nis)
	{
		$fotosiswa ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$fotosiswa = $CI->Helper_model->fotosiswa($nis);
		return $fotosiswa;
	}
}
if ( ! function_exists('id_mapel_jadi_kelompok'))
{
	function id_mapel_jadi_kelompok($str) 
	{
		$kelompok = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kelompok = $CI->Helper_model->id_mapel_jadi_kelompok($str);
	return $kelompok;
  	}
}
if ( ! function_exists('id_mapel_jadi_kodeguru'))
{
	function id_mapel_jadi_kodeguru($str) 
	{
		$kodeguru = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kodeguru = $CI->Helper_model->id_mapel_jadi_kodeguru($str);
	return $kodeguru;
  	}
}

if ( ! function_exists('predikat_nilai'))
{
	function predikat_nilai($nilai) 
	{
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tdatsis = $CI->Helper_model->tabel_predikat();
		$predikat_nilai = '?';
		$stop = 0;
		if($nilai == '-')
		{
			$predikat_nilai ='-';
		}
		else
		{
			foreach($tdatsis->result() as $dpn)	
			{
				if ($nilai>=$dpn->batas)
				{	
					if ($stop == 0)
					{
						$predikat_nilai = $dpn->predikat;
					$stop = 1;
					}
				}
			}
		}
	return $predikat_nilai;
  	}
}


if ( ! function_exists('konversi_nilai'))
{
	function konversi_nilai($nilai) 
	{
		if($nilai == '-')
		{
			$konversi_nilai = '-';
		}
		else
		{
			$konversi_nilai = $nilai / 25;
			//$konversi_nilai = (3 * $nilai / 100) + 1;

		}
		$konversi_nilai = round($konversi_nilai,2);
		return $konversi_nilai;
  	}
}
if ( ! function_exists('predikat_afektif'))
{
	function predikat_afektif($nilai) 
	{
	$predikat_afektif = $nilai;
	if (($nilai == 'A') or ($nilai == 'AB') or ($nilai == 'SB'))
		{
		$predikat_afektif = 'SB';
		}
	
	return $predikat_afektif;
  	}
}

if ( ! function_exists('deskripsi_nilai'))
{
	function deskripsi_nilai($nilai) 
	{
		$deskripsi_nilai = 'perlu belajar lebih giat lagi untuk menguasai ';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tdatsis = $CI->Helper_model->tabel_predikat();
		$stop = 0;
		foreach($tdatsis->result() as $dpn)
			{
//			$deskripsi_nilai = $dpn->keterangan;
			if ($nilai>=$dpn->batas)
				{
				if ($stop == 0)
					{
					$deskripsi_nilai = $dpn->keterangan;
					$stop = 1;
					}
				}	

			}
		return $deskripsi_nilai;
  	}
}
if ( ! function_exists('deskripsi_nilai_2015'))
{
	function deskripsi_nilai_2015($nilai,$kkm) 
	{
		if($nilai>85)
		{
			$deskripsi_nilai = 'sangat baik dalam ';
		}
		elseif($nilai>=$kkm)
		{
			$deskripsi_nilai = 'sudah baik dalam ';
		}
		else
		{
			$deskripsi_nilai = 'dengan bimbingan yang lebih, Ananda akan dapat meningkatkan kemampuan dalam';
		}
		return $deskripsi_nilai;
  	}
}
if ( ! function_exists('deskripsi_nilai_2018'))
{
	function deskripsi_nilai_2018($nilai,$kkm) 
	{
		if($nilai>=90)
		{
			$deskripsi_nilai = 'sangat baik dalam ';
		}
		elseif($nilai>=76)
		{
			$deskripsi_nilai = 'sudah baik dalam ';
		}
		elseif($nilai>=$kkm)
		{
			$deskripsi_nilai = 'sudah cukup baik dalam ';
		}
		else
		{
			$deskripsi_nilai = 'dengan bimbingan yang lebih, Ananda akan dapat meningkatkan kemampuan dalam';
		}
		return $deskripsi_nilai;
  	}
}

if ( ! function_exists('deskripsi_nilai_keterampilan'))
{
	function deskripsi_nilai_keterampilan($nilai) 
	{
		$deskripsi_nilai = 'tidak terampil';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tdatsis = $CI->Helper_model->tabel_predikat();
		$stop = 0;
		foreach($tdatsis->result() as $dpn)
			{
			if ($nilai>=$dpn->batas)
				{
				if ($stop == 0)
					{
					$deskripsi_nilai = $dpn->keterangan2;
					$stop = 1;
					}
				}	

			}
		return $deskripsi_nilai;
  	}
}

if ( ! function_exists('apakah_positif'))
{
	function apakah_positif($nilai) 
	{
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tdatsis = $CI->Helper_model->tabel_predikat();
		$apakah_positif ='0';
		$stop = 0;
		foreach($tdatsis->result() as $dpn)	
		{
			if ($nilai>=$dpn->batas)
			{	
			if ($stop == 0)
				{
				$apakah_positif = $dpn->positif;
				$stop = 1;
				}
			}
		}

	return $apakah_positif;
  	}
}

if ( ! function_exists('nisn'))
{
	function nisn($nis)
	{
		$nisn ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$nisn = $CI->Helper_model->nisn($nis);
		return $nisn;
	}
}
if ( ! function_exists('xduitf'))
{

//pencacah bilangan duit ---> bilangan
	function xduitf($str)
	{
	//empat digit. ribu. ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (strlen($str) < 4)
		{
		$terbilang = $str;
		}
		else
	{
	$terbilang ='';
	if (strlen($str) == 4)
		{
		$nil1 = substr($str,0,1);

		//nek seribu
		if ($nil1 == "1")
			{
			$terbilang .="SERIBU ";
			}
		else
			{
			$terbilang .= xhuruff($nil1);
			$terbilang .= " RIBU ";
			}

		$nil2 = substr($str,-3,-2);


		//nek nol
		if ($nil2 == "0")
			{
			$terbilang .= "";
			}

		//nek satu
		else if ($nil2 == "1")
			{
			$terbilang .= " SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil2);
			$terbilang .= " RATUS ";
			}

		$nil3 = substr($str,-2,-1);
		$nil4 = substr($str,-1);

		//nek belas
		if (($nil3 == "1") AND ($nil4 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		else if (($nil3 == "1") AND ($nil4 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil3 == "1") AND ($nil4 > "1"))
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nul
			if ($nil3 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil4);
				}
			else
				{
				$terbilang .= xhuruff($nil3);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil4);
				}
			}
		}



	//lima digit. puluh ribu. ///////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (strlen($str) == 5)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,-4,-3);

		//nek sepuluh
		if (($nil1 == "1") AND ($nil2 == "0"))
			{
			$terbilang .= "SEPULUH RIBU ";
			}
		else if (($nil1 == "1") AND ($nil2 == "1"))
			{
			$terbilang .= " SEBELAS RIBU ";
			}
		else if (($nil1 == "1") AND ($nil2 > "1"))
			{
			$terbilang .= xhuruff($nil2);
			$terbilang .= " BELAS RIBU ";
			}
		else
			{
			$terbilang .= xhuruff($nil1);
			$terbilang .= " PULUH ";
			$terbilang .= xhuruff($nil2);
			$terbilang .= " RIBU ";
			}


		$nil3 = substr($str,-3,-2);

		//nek nol
		if ($nil3 == "0")
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= "";
			}
		else if ($nil3 == "1")
			{
			$terbilang .= " SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= " RATUS ";
			}

		$nil4 = substr($str,-2,-1);
		$nil5 = substr($str,-1);

		//nek belas
		if (($nil4 == "1") AND ($nil5 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		else if (($nil4 == "1") AND ($nil5 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil4 == "1") AND ($nil5 > "1"))
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nol
			if ($nil4 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil5);
				}
			else
				{
				$terbilang .= xhuruff($nil4);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil5);
				}
			}
		}


	//enam digit. ratusan ribu. /////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (strlen($str) == 6)
		{
		$nil1 = substr($str,0,1);

		//nek seratus
		if ($nil1 == "1")
			{
			$terbilang .= "SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil1);
			$terbilang .= " RATUS ";
			}

		$nil2 = substr($str,-5,-4);
		$nil3 = substr($str,-4,-3);

		//nek belas
		if (($nil2 == "1") AND ($nil3 == "0"))
			{
			$terbilang .= " SEPULUH RIBU ";
			}
		else if (($nil2 == "1") AND ($nil3 == "1"))
			{
			$terbilang .= " SEBELAS RIBU ";
			}
		else if (($nil2 == "1") AND ($nil3 > "1"))
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= " BELAS RIBU ";
			}
		else
			{
			//nek nol
			if ($nil2 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil3);
				$terbilang .= " RIBU ";
				}
			else
				{
				$terbilang .= xhuruff($nil2);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil3);
				$terbilang .= " RIBU ";
				}
			}


		$nil4 = substr($str,-3,-2);

		//nek nol
		if ($nil4 == "0")
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= "";
			}
		else if ($nil4 == "1")
			{
			$terbilang .= " SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " RATUS ";
			}

		$nil5 = substr($str,-2,-1);
		$nil6 = substr($str,-1);

		//nek belas
		if (($nil5 == "1") AND ($nil6 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		else if (($nil5 == "1") AND ($nil6 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil5 == "1") AND ($nil6 > "1"))
			{
			$terbilang .= xhuruff($nil6);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nol
			if ($nil5 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil6);
				}
			else
				{
				$terbilang .= xhuruff($nil5);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil6);
				}
			}
		}


	//tujuh digit. juta. ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (strlen($str) == 7)
		{
		//8 540 000
		$nil1 = substr($str,0,1);
		$terbilang .= xhuruff($nil1);
		$terbilang .= " JUTA ";

		$nil2 = substr($str,1,1);


		//nek nol
		if ($nil2 == "0")
			{
			$terbilang .= xhuruff($nil2);
			$terbilang .= "";
			}
		//nek seratus
		else if ($nil2 == "1")
			{
			$terbilang .= " SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil2);
			$terbilang .= " RATUS ";
			}

		$nil3 = substr($str,2,1);
		$nil4 = substr($str,3,1);
		$nil5 = substr($str,4,1);
		$nil6 = substr($str,5,1);
		$nil7 = substr($str,6,1);
		//nek belas
		if (($nil3 == "1") AND ($nil4 == "0"))
			{
			$terbilang .= " SEPULUH RIBU ";
			}
		else if (($nil3 == "1") AND ($nil4 == "1"))
			{
			$terbilang .= " SEBELAS RIBU ";
			}
		else if (($nil3 == "1") AND ($nil4 > "1"))
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " BELAS RIBU ";
			}
		else if (($nil3 > "1") AND ($nil4 == "0"))
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= " PULUH ";
			$terbilang .= " RIBU ";
			}

		else if (($nil3 > "1") AND ($nil4 > "1"))
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= " PULUH ";
			$terbilang .= xhuruff($nil4);
			$terbilang .= " RIBU ";
			}
		//nek null
		else if (($nil2 == "0") AND ($nil3 == "0")
			AND ($nil4 == "0") AND ($nil5 == "0")
			AND ($nil6 == "0") AND ($nil7 == "0"))
			{
			$terbilang .= xhuruff($nil4);
			//$terbilang .= " RIBU ";
			}
		else if ($nil4 == "1")
			{
			$terbilang .= " SERIBU ";
			}
		else if ($nil4 > "1")
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " RIBU ";
			}


		$nil5 = substr($str,-3,-2);


		//nek nol
		if ($nil5 == "0")
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= "";
			}
		//seratus
		else if ($nil5 == "1")
			{
			$terbilang .= " SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= " RATUS ";
			}

		$nil6 = substr($str,-2,-1);
		$nil7 = substr($str,-1);

		//nek sepuluh
		if (($nil6 == "1") AND ($nil7 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		//sebelas
		else if (($nil6 == "1") AND ($nil7 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil6 == "1") AND ($nil7 > "1"))
			{
			$terbilang .= xhuruff($nil7);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nol
			if ($nil6 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil7);
				}

			else
				{
				$terbilang .= xhuruff($nil6);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil7);
				}
			}
		}
	//delapan digit. puluhan juta. //////////////////////////////////////////////////////////////////////////////////////////////////////
	if (strlen($str) == 8)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,-7,-6);

		//sepuluh
		if (($nil1 == "1") AND ($nil2 == "0"))
			{
			$terbilang .= "SEPULUH ";
			}
		//sebelas
		else if (($nil1 == "1") AND ($nil2 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		//nek belas
		else if (($nil1 == "1") AND ($nil2 > "1"))
			{
			$terbilang .= xhuruff($nil2);
			$terbilang .= " BELAS ";
			}
		else
			{
			$terbilang .= xhuruff($nil1);
			$terbilang .= " PULUH ";
			$terbilang .= xhuruff($nil2);
			}

		$terbilang .= " JUTA ";

		$nil3 = substr($str,-6,-5);

		//nek seratus
		if ($nil3 == "1")
			{
			$terbilang .= "SERATUS ";
			}

		//nek nol
		else if ($nil3 == "0")
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= "";
			}
		else
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= " RATUS ";
			}

		$nil4 = substr($str,-5,-4);
		$nil5 = substr($str,-4,-3);
		$nil6 = substr($str,-3,-2);
		$nil7 = substr($str,-2,-1);
		$nil8 = substr($str,-1);


		//nek belas
		if (($nil4 == "1") AND ($nil5 == "0"))
			{
			$terbilang .= " SEPULUH RIBU ";
			}
		elseif (($nil4 > "1") AND ($nil5 == "0"))
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " PULUH RIBU ";
			}

		else if (($nil4 == "1") AND ($nil5 == "1"))
			{
			$terbilang .= " SEBELAS RIBU ";
			}
		else if (($nil4 == "1") AND ($nil5 > "1"))
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= " BELAS RIBU ";
			}
		else if (($nil4 > "1") AND ($nil5 > "1"))
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " PULUH ";
			$terbilang .= xhuruff($nil5);
			$terbilang .= " RIBU ";
			}
		else if ($nil5 == "1")
			{
			$terbilang .= " SERIBU ";
			}
		else if ($nil5 > "1")
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= " RIBU ";
			}



		//nek seratus
		if ($nil6 == "1")
			{
			$terbilang .= "SERATUS ";
			}

		//nek nol
		else if ($nil6 == "0")
			{
			$terbilang .= xhuruff($nil6);
			$terbilang .= "";
			}
		else
			{
			$terbilang .= xhuruff($nil6);
			$terbilang .= " RATUS ";
			}



		//nek belas
		if (($nil7 == "1") AND ($nil8 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		else if (($nil7 == "1") AND ($nil8 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil7 == "1") AND ($nil8 > "1"))
			{
			$terbilang .= xhuruff($nil8);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nol
			if ($nil7 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil8);
				}
			else
				{
				$terbilang .= xhuruff($nil7);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil8);
				}
			}
		}


	//sembilan digit. ratusan juta. ////////////////////////////////////////////////////////////////////////////////////////////////////
	if (strlen($str) == 9)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,-8,-7);
		$nil3 = substr($str,-7,-6);


		//seratus
		if ($nil1 == "1")
			{
			$terbilang .= "SERATUS ";
			}
		else
			{
			$terbilang .= xhuruff($nil1);
			$terbilang .= " RATUS ";
			}

		//belas
		if (($nil2 == "1") AND ($nil3 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		else if (($nil2 == "1") AND ($nil3 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil2 == "1") AND ($nil3 > "1"))
			{
			$terbilang .= xhuruff($nil3);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nol
			if ($nil2 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil3);
				}
			else
				{
				$terbilang .= xhuruff($nil2);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil3);
				}
			}


		$terbilang .= " JUTA ";


		$nil4 = substr($str,-6,-5);
		$nil5 = substr($str,-5,-4);
		$nil6 = substr($str,-4,-3);
		$nil7 = substr($str,-3,-2);
		$nil8 = substr($str,-2,-1);
		$nil9 = substr($str,-1);


		//nek ratus
		if ($nil4 == "1")
			{
			$terbilang .= " SERATUS ";
			}
		//nek nol
		else if ($nil4 == "0")
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= "";
			}
		else
			{
			$terbilang .= xhuruff($nil4);
			$terbilang .= " RATUS ";
			}

		//nek belas
		if (($nil5 == "1") AND ($nil6 == "0"))
			{
			$terbilang .= " SEPULUH RIBU ";
			}
		elseif (($nil5 > "1") AND ($nil6 == "0"))
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= " PULUH RIBU ";
			}

		else if (($nil5 == "1") AND ($nil6 == "1"))
			{
			$terbilang .= " SEBELAS RIBU ";
			}
		else if (($nil5 == "1") AND ($nil6 > "1"))
			{
			$terbilang .= xhuruff($nil6);
			$terbilang .= " BELAS RIBU ";
			}
		else if (($nil5 > "1") AND ($nil6 > "1"))
			{
			$terbilang .= xhuruff($nil5);
			$terbilang .= " PULUH ";
			$terbilang .= xhuruff($nil6);
			$terbilang .= " RIBU ";
			}
		else if ($nil6 == "1")
			{
			$terbilang .= " SERIBU ";
			}
		else if ($nil6 > "1")
			{
			$terbilang .= xhuruff($nil6);
			$terbilang .= " RIBU ";
			}



		//nek seratus
		if ($nil7 == "1")
			{
			$terbilang .= "SERATUS ";
			}

		//nek nol
		else if ($nil7 == "0")
			{
			$terbilang .= xhuruff($nil7);
			$terbilang .= "";
			}
		else
			{
			$terbilang .= xhuruff($nil7);
			$terbilang .= " RATUS ";
			}



		//nek belas
		if (($nil8 == "1") AND ($nil9 == "0"))
			{
			$terbilang .= " SEPULUH ";
			}
		else if (($nil8 == "1") AND ($nil9 == "1"))
			{
			$terbilang .= " SEBELAS ";
			}
		else if (($nil8 == "1") AND ($nil9 > "1"))
			{
			$terbilang .= xhuruff($nil9);
			$terbilang .= " BELAS ";
			}
		else
			{
			//nek nol
			if ($nil8 == "0")
				{
				$terbilang .= "";
				$terbilang .= xhuruff($nil9);
				}
			else
				{
				$terbilang .= xhuruff($nil8);
				$terbilang .= " PULUH ";
				$terbilang .= xhuruff($nil9);
				}
			}
		}

	$terbilang .= "RUPIAH";
	}
	return $terbilang;
	}
}

if ( ! function_exists('cari_pengawas'))
{
	function cari_pengawas($thnajaran,$semester) 
	{
		$namapengawas ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapengawas = $CI->Helper_model->cari_pengawas($thnajaran,$semester);
	return $namapengawas;
  	}
}
if ( ! function_exists('cari_nip_pengawas'))
{
	function cari_nip_pengawas($thnajaran,$semester) 
	{
		$nippengawas ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$nippengawas = $CI->Helper_model->cari_nip_pengawas($thnajaran,$semester);
	return $nippengawas;
  	}
}
if ( ! function_exists('nis_ke_kelas'))
{
	function nis_ke_kelas($nis)
	{
		$kelassiswa ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kelassiswa = $CI->Helper_model->nis_ke_kelas($nis);
		return $kelassiswa;
	}
}
if ( ! function_exists('nis_ke_status'))
{
	function nis_ke_status($nis)
	{
		$status ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$status = $CI->Helper_model->nis_ke_status($nis);
		return $status;
	}
}
if ( ! function_exists('seluler'))
{
	function seluler($str)
	{
		if (substr($str,0,1)=="0")
		{
		$panjang =strlen($str);
		$sisa = $panjang-1;
		$nosel = substr($str,-$sisa);
		$str = "+62$nosel";
		}
		if (substr($str,0,1)=="8")
		{
		$panjang =strlen($str);
		$sisa = $panjang-1;
		$nosel = substr($str,-$sisa);
		$str = "+628$nosel";
		}
		if (substr($str,0,2)=="62")
		{
		$panjang =strlen($str);
		$sisa = $panjang-2;
		$nosel = substr($str,-$sisa);
		$str = "+62$nosel";
		}
		if($str == '+62')
		{
			$str = '';
		}
		return $str;
	}
}
if ( ! function_exists('cari_seluler_pegawai'))
{
	function cari_seluler_pegawai($kodeguru) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_seluler_pegawai($kodeguru);
		return $namapegawai;
  	}
}
if ( ! function_exists('cari_username_pegawai'))
{
	function cari_username_pegawai($kodeguru) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_username_pegawai($kodeguru);
		return $namapegawai;
  	}
}
if ( ! function_exists('golongan_jadi_pangkat'))
{
	function golongan_jadi_pangkat($golongan) 
	{	
		$pangkat = '';
		if($golongan=='III/a')
		{
		$pangkat = 'Penata muda';
		}
		if($golongan=='III/b')
		{
		$pangkat = 'Penata Muda Tingkat I';
		}
		if($golongan=='III/c')
		{
		$pangkat = 'Penata';
		}
		if($golongan=='III/d')
		{
		$pangkat = 'Penata Tingkat I';
		}
		if($golongan=='IV/a')
		{
		$pangkat = 'Pembina';
		}
		if($golongan=='IV/b')
		{
		$pangkat = 'Pembina Tingkat I';
		}
		if($golongan=='IV/c')
		{
		$pangkat = 'Pembina Utama Muda';
		}
		if($golongan=='IV/d')
		{
		$pangkat = 'Pembina Utama Madya';
		}
		if($golongan=='IV/e')
		{
		$pangkat = 'Pembina Utama';
		}
		
		return $pangkat;
  	}
}
if ( ! function_exists('golongan_jadi_jabatan'))
{
	function golongan_jadi_jabatan($golongan) 
	{	
		$jabatan = '';
		if(($golongan=='III/a') or ($golongan=='III/b'))
			{
			$jabatan = 'Guru pertama';
			}
		if(($golongan=='III/c') or ($golongan=='III/d'))
			{
			$jabatan = 'Guru muda';
			}
		if(($golongan=='IV/a') or ($golongan=='IV/b') or ($golongan=='IV/c'))
			{
			$jabatan = 'Guru madya';
			}
		if(($golongan=='IV/d') or ($golongan=='IV/e'))
			{
			$jabatan = 'Guru utama';
			}		
		return $jabatan;
  	}
}
if ( ! function_exists('id_sk_jadi_golongan'))
{
	function id_sk_jadi_golongan($str) 
	{
		$golongan = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$golongan = $CI->Helper_model->id_sk_jadi_golongan($str);
		return $golongan;
  	}
}
if ( ! function_exists('id_sk_jadi_gapok'))
{
	function id_sk_jadi_gapok($str) 
	{
		$golongan = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$golongan = $CI->Helper_model->id_sk_jadi_gapok($str);
		return $golongan;
  	}
}

if ( ! function_exists('id_sk_per_semester'))
{
	function id_sk_per_semester($kode,$thnajaran,$semester) 
	{
		$id_sk = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$id_sk = $CI->Helper_model->id_sk_per_semester($kode,$thnajaran,$semester);
		return $id_sk;
  	}
}

if ( ! function_exists('predikat_perilaku'))
{
	function predikat_perilaku($nilai) 
	{
	$predikat_perilaku = '??';
	if($nilai < 100)
		{
		$predikat_perilaku = '(Amat Baik)';
		}
	if ($nilai < 91)
		{
		$predikat_perilaku = '(Baik)';
		}
	if ($nilai < 76)
		{
		$predikat_perilaku = '(Cukup)';
		}
	return $predikat_perilaku;
  	}
}
if ( ! function_exists('cegah'))
{
	function cegah($str) 
	{
	    $str = trim(htmlentities(htmlspecialchars($str)));
	$str = preg_replace("/'/", "xpsijix", $str);
	$str = preg_replace("/@/", "xtkeongx", $str);
	$str = preg_replace("/%/", "xpersenx", $str);
	$str = preg_replace("/_/", "xgwahx", $str);
	$str = preg_replace("/1=1/", "x1smdgan1x", $str);
	$str = str_replace("/", "xgmringx", $str);
	$str = preg_replace("/!/", "xpentungx", $str);
	$str = str_replace("<", "xkkirix", $str);
	$str = preg_replace("/>/", "xkkananx", $str);
	$str = preg_replace("/{/", "xkkurix", $str);
	$str = preg_replace("/}/", "xkkurnanx", $str);
	$str = preg_replace("/;/", "xkommax", $str);
	$str = preg_replace("/-/", "xstrix", $str);
	$str = preg_replace("/_/", "xstripbwhx", $str);
	$str = preg_replace("/ /", "xspasix", $str);
	return $str;
  	}
}
if ( ! function_exists('balikin'))
{
	function balikin($str) 
	{
	$str = preg_replace("/xpersenx/", "%", $str);
	$str = preg_replace("/xtkeongx/", "@", $str);
	$str = preg_replace("/xgwahx/", "_", $str);
	$str = preg_replace("/x1smdgan1x/", "1=1", $str);
	$str = preg_replace("/xgmringx/", "/", $str);
	$str = preg_replace("/xpentungx/", "!", $str);
	$str = preg_replace("/xpsijix/", "'", $str);
	$str = preg_replace("/xkkirix/", "<", $str);
	$str = preg_replace("/xkkananx/", ">", $str);
	$str = preg_replace("/xkkurix/", "{", $str);
	$str = preg_replace("/xkkurnanx/", "}", $str);
	$str = preg_replace("/xkommax/", ";", $str);
	$str = preg_replace("/xstrix/", "-", $str);
	$str = preg_replace("/xstripbwhx/", "_", $str);
	$str = preg_replace("/ koma /", ",", $str);
	$str = preg_replace("/xspasix/", " ", $str);
	$str = str_replace(CHR(13), "", $str);
	$str = str_replace(CHR(10) & CHR(10), "</P><P>", $str);
	$str = str_replace(CHR(10), "<BR>", $str);
	return $str;
  	}
}
if ( ! function_exists('id_mapel_jadi_thnajaran'))
{
	function id_mapel_jadi_thnajaran($str) 
	{
		$thnajaran = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$thnajaran = $CI->Helper_model->id_mapel_jadi_thnajaran($str);
		return $thnajaran;
  	}
}
if ( ! function_exists('id_mapel_jadi_semester'))
{
	function id_mapel_jadi_semester($str) 
	{
		$semester = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$semester = $CI->Helper_model->id_mapel_jadi_semester($str);
		return $semester;
  	}
}

if ( ! function_exists('nis_ke_alamat'))
{
	function nis_ke_alamat($nis)
	{
		$namasiswa ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namasiswa = $CI->Helper_model->nis_ke_alamat($nis);
		return $namasiswa;
	}
}
if ( ! function_exists('hilangkanpetik'))
{
	function hilangkanpetik($str) 
	{
	$str = preg_replace("/'/","", $str);
	return $str;
  	}
}
if ( ! function_exists('hilangkanspasi'))
{
	function hilangkanspasi($str) 
	{
	$str = preg_replace("/ /","", $str);
	return $str;
  	}
}

if ( ! function_exists('cari_tugas_tambahan'))
{
	function cari_tugas_tambahan($thnajaran,$semester,$kodeguru) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_tugas_tambahan($thnajaran,$semester,$kodeguru);
		return $namapegawai;
  	}
}
if ( ! function_exists('nis_ke_kelas_thnajaran_semester'))
{
	function nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester)
	{
		$kelassiswa ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kelassiswa = $CI->Helper_model->nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		return $kelassiswa;
	}
}
if ( ! function_exists('id_thnajaran_jadi_thnajaran'))
{
	function id_thnajaran_jadi_thnajaran($str) 
	{
		$thnajaran = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$thnajaran = $CI->Helper_model->id_thnajaran_jadi_thnajaran($str);
		return $thnajaran;
  	}
}
if ( ! function_exists('id_ruang_jadi_ruang'))
{
	function id_ruang_jadi_ruang($str) 
	{
		$ruang = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$ruang = $CI->Helper_model->id_ruang_jadi_ruang($str);
		return $ruang;
  	}
}
if ( ! function_exists('tanggal'))
{
	function tanggal($str)
	{
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
  		$postedday=substr($str,8,2);
		$tanggalbiasa = $postedday.'-'.$postedmonth.'-'.$postedyear;	
		return $tanggalbiasa;	
	}
}
if ( ! function_exists('tanggal_indonesia_ke_barat'))
{
	function tanggal_indonesia_ke_barat($str)
	{
		$postedyear=substr($str,6,4);
		$postedmonth=substr($str,3,2);
  		$postedday=substr($str,0,2);
		$tanggalbarat = $postedyear.'-'.$postedmonth.'-'.$postedday;	
		return $tanggalbarat;	
	}
}

if ( ! function_exists('tahunsaja'))
{
	function tahunsaja($str)
	{
		$tahunsaja=substr($str,0,4);
		return $tahunsaja;	
	}
}
if ( ! function_exists('bulansaja'))
{
	function bulansaja($str)
	{
		$bulansaja=substr($str,5,2);
		return $bulansaja;	
	}
}

function get_col_letter($num){
    $comp=0;    
    $pre='';
    $letters=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	//if the number is greater than 26, calculate to get the next letters
	if($num > 26) {
	//divide the number by 26 and get rid of the decimal
	$comp=floor($num/26);
	//check if multiple of 26, and force "Z" cell
	if(($num%26)!=0) {
	return get_col_letter($comp).$letters[($num-$comp*26)-1]; }
	else {
	return get_col_letter($comp-1).'Z'; } }
	else {
	//return the letter
	return $letters[($num-1)]; 
	}   
}
if ( ! function_exists('cari_kurikulum'))
{
	function cari_kurikulum($thnajaran,$semester,$kelas) 
	{
		$kurikulum = '?';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kurikulum = $CI->Helper_model->cari_kurikulum($thnajaran,$semester,$kelas);
		return $kurikulum;
  	}
}
if ( ! function_exists('cari_os'))
{
	function cari_os() 
	{
		$os = '';
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/Linux/',$agent)) $os = 'Linux';
		elseif(preg_match('/Win/',$agent)) $os = 'Windows';
		elseif(preg_match('/Android/',$agent)) $os = 'Android';		
		elseif(preg_match('/Mac/',$agent)) $os = 'Mac';
		else $os = 'UnKnown';
//		$os = 'Windows';
		return $os;
  	}
}
if ( ! function_exists('gantibulan'))
{
function gantibulan($no)
	{
	$bulane = '';
	if(($no == '01') or ($no == '1'))
		{$bulane = 'Januari';
		}
	if(($no == '02') or ($no == '2'))
		{$bulane = 'Februari';
		}
	if(($no == '03') or ($no == '3'))
		{$bulane = 'Maret';
		}
	if(($no == '04') or ($no == '4'))
		{$bulane = 'April';
		}
	if(($no == '05') or ($no == '5'))
		{$bulane = 'Mei';
		}
	if(($no == '06') or ($no == '6'))
		{$bulane = 'Juni';
		}
	if(($no == '07') or ($no == '7'))
		{$bulane = 'Juli';
		}
	if(($no == '08') or ($no == '8'))
		{$bulane = 'Agustus';
		}
	if(($no == '09') or ($no == '9'))
		{$bulane = 'September';
		}
	if($no == '10')
		{$bulane = 'Oktober';
		}
	if($no == '11')
		{$bulane = 'November';
		}
	if($no == '12')
		{$bulane = 'Desember';
		}
	return $bulane;
	}
}
function jenis_tugas($jenis)
{
	if ($jenis=='01')
		{
		$jenise = 'Mandiri Terstruktur';
		}
	else if ($jenis=='10')
		{
		$jenise = 'Kelompok Tak Terstruktur';
		}
	else if ($jenis=='11')
		{
		$jenise= 'Kelompok Terstruktur';
		}
	else
		{
		$jenise= 'Mandiri Tak Terstruktur';
		}
	return $jenise;	
}

if ( ! function_exists('predikat_sikap'))
{
	function predikat_sikap($nilai) 
	{
	$predikat_sikap ='Kurang';
	if ($nilai== 'A')
		{$predikat_sikap='Sangat Baik';
		}
	if ($nilai=='B')
		{$predikat_sikap='Baik';
		}
	if ($nilai=='C')
		{$predikat_sikap='Cukup';
		}
	return $predikat_sikap;
  	}
}
if ( ! function_exists('predikat_nilai_2015'))
{
	function predikat_nilai_2015($nilai,$versi) 
	{
		if($versi == 1)
		{
			if($nilai >= 81)
			{
				$predikat_nilai = 'A';
			}
			elseif($nilai >= 75)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 70)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}
		elseif($versi == 2) // man 2 sragen
		{
			if($nilai >= 81)
			{
				$predikat_nilai = 'A';
			}
			elseif($nilai > 75)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 71)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}

		}
		else
		{		
			$predikat_nilai = $versi;
		}
	return $predikat_nilai;
  	}
}
if ( ! function_exists('predikat_nilai_2018'))
{
	function predikat_nilai_2018($nilai,$kkm) 
	{
		if($kkm == 71)
		{
			if($nilai >= 91)
			{
					$predikat_nilai = 'A';
			}
			elseif($nilai >= 81)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 71)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}
		elseif($kkm == 72)
		{
			if($nilai >= 90)
			{
					$predikat_nilai = 'A';
			}
			elseif($nilai >= 81)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 72)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}
		elseif($kkm == 73)
		{
			if($nilai >= 91)
			{
					$predikat_nilai = 'A';
			}
			elseif($nilai >= 82)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 73)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}
		elseif($kkm == 74)
		{
			if($nilai >= 92)
			{
					$predikat_nilai = 'A';
			}
			elseif($nilai >= 83)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 74)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}
		elseif($kkm == 75)
		{
			if($nilai >= 91)
			{
					$predikat_nilai = 'A';
			}
			elseif($nilai >= 83)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 75)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}

		elseif($kkm == 70)
		{
			if($nilai >= 90)
			{
					$predikat_nilai = 'A';
			}
			elseif($nilai >= 80)
			{
				$predikat_nilai = 'B';
			}
			elseif($nilai >= 70)
			{
				$predikat_nilai = 'C';
			}
			else
			{
				$predikat_nilai = 'D';
			}
		}
		else
		{
			$predikat_nilai = '?';
		}
	return $predikat_nilai;
  	}
}
if ( ! function_exists('predikat_deskripsi_nilai_2018'))
{
	function predikat_deskripsi_nilai_2018($nilai,$kkm) 
	{
		if($kkm == 71)
		{
			if($nilai >= 91)
			{
					$predikat_nilai = 'sangat baik';
			}
			elseif($nilai >= 81)
			{
				$predikat_nilai = 'baik';
			}
			elseif($nilai >= 71)
			{
				$predikat_nilai = 'cukup';
			}
			else
			{
				$predikat_nilai = 'kurang';
			}
		}
		elseif($kkm == 72)
		{
			if($nilai >= 90)
			{
				$predikat_nilai = 'sangat baik';
			}
			elseif($nilai >= 81)
			{
				$predikat_nilai = 'baik';
			}
			elseif($nilai >= 72)
			{
				$predikat_nilai = 'cukup';
			}
			else
			{
				$predikat_nilai = 'kurang';
			}
		}
		elseif($kkm == 73)
		{
			if($nilai >= 91)
			{
				$predikat_nilai = 'sangat baik';
			}
			elseif($nilai >= 82)
			{
				$predikat_nilai = 'baik';
			}
			elseif($nilai >= 73)
			{
				$predikat_nilai = 'cukup';
			}
			else
			{
				$predikat_nilai = 'kurang';
			}
		}
		elseif($kkm == 74)
		{
			if($nilai >= 92)
			{
					$predikat_nilai = 'sangat baik';
			}
			elseif($nilai >= 83)
			{
				$predikat_nilai = 'baik';
			}
			elseif($nilai >= 74)
			{
				$predikat_nilai = 'cukup';
			}
			else
			{
				$predikat_nilai = 'kurang';
			}
		}
		elseif($kkm == 75)
		{
			if($nilai >= 91)
			{
					$predikat_nilai = 'sangat baik';
			}
			elseif($nilai >= 83)
			{
				$predikat_nilai = 'baik';
			}
			elseif($nilai >= 75)
			{
				$predikat_nilai = 'cukup';
			}
			else
			{
				$predikat_nilai = 'kurang';
			}
		}

		elseif($kkm == 70)
		{
			if($nilai >= 90)
			{
				$predikat_nilai = 'sangat baik';
			}
			elseif($nilai >= 80)
			{
				$predikat_nilai = 'baik';
			}
			elseif($nilai >= 70)
			{
				$predikat_nilai = 'cukup';
			}
			else
			{
				$predikat_nilai = 'kurang';
			}
		}
		else
		{
			$predikat_nilai = '?';
		}
	return $predikat_nilai;
  	}
}

if ( ! function_exists('cari_kkm'))
{
	function cari_kkm($thnajaran,$semester,$kelas,$mapel) 
	{
		$kkm = '?';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kkm = $CI->Helper_model->cari_kkm($thnajaran,$semester,$kelas,$mapel);
		return $kkm;
  	}
}
if ( ! function_exists('cari_seluler_siswa'))
{
	function cari_seluler_siswa($nis) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_seluler_siswa($nis);
		return $namapegawai;
  	}
}
if ( ! function_exists('cari_seluler_orangtua'))
{
	function cari_seluler_orangtua($nis) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_seluler_orangtua($nis);
		return $namapegawai;
  	}
}
if ( ! function_exists('predikat_penilaian_diri'))
{
	function predikat_penilaian_diri($nilai) 
	{
	$predikat_akhlak='Kurang';
	if ($nilai == 2)
		{$predikat_akhlak='Cukup';
		}
	if ($nilai == 3)
		{$predikat_akhlak='Baik';
		}
	if ($nilai == 4)
		{$predikat_akhlak='Amat Baik';
		}
	return $predikat_akhlak;
  	}
}
if ( ! function_exists('buang_rp'))
{
	function buang_rp($str) 
	{
	$str = preg_replace("/Rp /","", $str);
	return $str;
  	}
}
if ( ! function_exists('cari_walikelas'))
{
	function cari_walikelas($thnajaran,$semester,$kelas) 
	{
		$kurikulum = '?';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$kurikulum = $CI->Helper_model->cari_walikelas($thnajaran,$semester,$kelas);
		return $kurikulum;
  	}
}
if ( ! function_exists('tanggal_slash'))
{
	function tanggal_slash($str)
	{
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
  		$postedday=substr($str,8,2);
		$tanggalbiasa = $postedday.'/'.$postedmonth.'/'.$postedyear;	
		if($tanggalbiasa == '//')
		{
			$tanggalbiasa = '';
		}
		if($tanggalbiasa == '00/00/0000')
		{
			$tanggalbiasa = '';
		}
		return $tanggalbiasa;	
	}
}
if ( ! function_exists('date_slash'))
{
	function date_slash($str)
	{
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
  		$postedday=substr($str,8,2);
		$tanggalbiasa = $postedyear.'/'.$postedmonth.'/'.$postedday;	
		return $tanggalbiasa;	
	}
}

if ( ! function_exists('name_of_day'))
{
	function name_of_day($str) 
	{
	$dina='?';
	if(strlen($str)==10)
	{
		$x = substr($str,0,4);
		$y = substr($str,5,2);
		$z = substr($str,8,2);
		$dina = date("l", mktime(0, 0, 0, $y, $z, $x));
	}
	return $dina;
  	}
}
if ( ! function_exists('tmtsk'))
{
	function tmtsk($str) 
	{
		$tmtsk = array();
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tmtsk = $CI->Helper_model->tmtsk($str);
		return $tmtsk;
  	}
}
	function ubahjenkel($jenkel)
	{
		if(substr($jenkel,0,1) == 'L')
		{
			$jenkel = 'Laki - laki';
		}
		elseif(substr($jenkel,0,1) == 'P')
		{
			$jenkel = 'Perempuan';
		}
		else
		{
			$jenkel = '?';
		}
		return $jenkel;
	}	
	function Pangkat_Sebelum($golongan)
	{
		$golongans = '';
		if($golongan == 'II/b')
		{
			$golongans = 'II/a';
		}
		if($golongan == 'II/c')
		{
			$golongans = 'II/b';
		}
		if($golongan == 'II/d')
		{
			$golongans = 'II/c';
		}
		if($golongan == 'III/a')
		{
			$golongans = 'II/d';
		}
		if($golongan == 'III/b')
		{
			$golongans = 'III/a';
		}
		if($golongan == 'III/c')
		{
			$golongans = 'III/b';
		}
		if($golongan == 'III/d')
		{
			$golongans = 'III/c';
		}
		if($golongan == 'IV/a')
		{
			$golongans = 'III/d';
		}
		if($golongan == 'IV/b')
		{
			$golongans = 'IV/a';
		}
		if($golongan == 'IV/c')
		{
			$golongans = 'IV/b';
		}
		if($golongan == 'IV/d')
		{
			$golongans = 'IV/c';
		}
		if($golongan == 'IV/e')
		{
			$golongans = 'IV/d';
		}
		return $golongans;
	}	
	function Pangkat_Sesudah($golongan)
	{
		$golongans = '';
		if($golongan == 'I/d')
		{
			$golongans = 'II/a';
		}
		if($golongan == 'II/a')
		{
			$golongans = 'II/b';
		}
		if($golongan == 'II/b')
		{
			$golongans = 'II/c';
		}
		if($golongan == 'II/c')
		{
			$golongans = 'II/d';
		}
		if($golongan == 'II/d')
		{
			$golongans = 'III/a';
		}
		if($golongan == 'III/a')
		{
			$golongans = 'III/b';
		}
		if($golongan == 'III/b')
		{
			$golongans = 'III/c';
		}
		if($golongan == 'III/c')
		{
			$golongans = 'III/d';
		}
		if($golongan == 'III/d')
		{
			$golongans = 'IV/a';
		}
		if($golongan == 'IV/a')
		{
			$golongans = 'IV/b';
		}
		if($golongan == 'IV/b')
		{
			$golongans = 'IV/c';
		}
		if($golongan == 'IV/c')
		{
			$golongans = 'IV/d';
		}
		if($golongan == 'IV/d')
		{
			$golongans = 'IV/e';
		}

		return $golongans;
	}	
if ( ! function_exists('cari_chat_id_pegawai'))
{
	function cari_chat_id_pegawai($kodeguru) 
	{	
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namapegawai = $CI->Helper_model->cari_chat_id_pegawai($kodeguru);
		return $namapegawai;
  	}
}
if ( ! function_exists('cari_kepala_baru'))
{
	function cari_kepala_baru($thnajaran,$semester) 
	{
		$namakepala = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$namakepala = $CI->Helper_model->cari_kepala_baru($thnajaran,$semester);
		return $namakepala;
  	}
}
if ( ! function_exists('cari_nip_kepala_baru'))
{
	function cari_nip_kepala_baru($thnajaran,$semester) 
	{
		$nipkepala = '';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$nipkepala = $CI->Helper_model->cari_nip_kepala_baru($thnajaran,$semester);

	return $nipkepala;
  	}
}
if ( ! function_exists('jam_saja'))
{
	function jam_saja()
	{
		$jam = date("H:i");
		$jam_saja =substr($jam,0,2);
		return $jam_saja;	
	}
}
if ( ! function_exists('menit_saja'))
{
	function menit_saja()
	{
		$jam = date("H:i");
		$menit_saja=substr($jam,3,2);
		return $menit_saja;	
	}
}
if ( ! function_exists('kode_sekolah_ard'))
{
	function kode_sekolah_ard($sekolah)
	{
		$kode_sekolah_ard='1';
		if ($sekolah=="Tidak berpendidikan formal")
			{
			$kode_sekolah_ard = "1";
			}
		if ($sekolah=="SD / SLTP")
			{
			$kode_sekolah_ard = "2";
			}
		if ($sekolah=="SLTA")
			{
			$kode_sekolah_ard = "4";
			}
		if ($sekolah=="D1")
			{
			$kode_sekolah_ard = "5";
			}
		if ($sekolah=="D2")
			{
			$kode_sekolah_ard = "6";
			}
		if ($sekolah=="D3")
			{
			$kode_sekolah_ard = "7";
			}
		if ($sekolah=="D4")
			{
			$kode_sekolah_ard = "8";
			}
		if ($sekolah=="S1")
			{
			$kode_sekolah_ard = "9";
			}
		if ($sekolah=="S2")
			{
			$kode_sekolah_ard = "10";
			}
		if ($sekolah=="S3")
			{
			$kode_sekolah_ard = "11";
			}
		return $kode_sekolah_ard;	
	}
}
if ( ! function_exists('sekolah_ard'))
{
	function sekolah_ard($sekolah)
	{
		$sekolah = preg_replace("/ /","", $sekolah);
		$kode_sekolah_ard='';
		if ($sekolah=="Tidak berpendidikan formal")
			{
			$kode_sekolah_ard = "TK";
			}
		if ($sekolah=="SD/MI/PaketA")
		{
			$kode_sekolah_ard = "SD";
		}
		if ($sekolah=="SD/SLTP")
			{
			$kode_sekolah_ard = "SD";
			}
		if ($sekolah=="SLTP")
			{
			$kode_sekolah_ard = "SMP";
			}

		if ($sekolah=="SLTA")
			{
			$kode_sekolah_ard = "SMA";
			}
		if ($sekolah=="D1")
			{
			$kode_sekolah_ard = "D1";
			}
		if ($sekolah=="D2")
			{
			$kode_sekolah_ard = "D2";
			}
		if ($sekolah=="D3")
			{
			$kode_sekolah_ard = "D3";
			}
		if ($sekolah=="D4")
			{
			$kode_sekolah_ard = "D4";
			}
		if ($sekolah=="S1")
			{
			$kode_sekolah_ard = "S1";
			}
		if ($sekolah=="S2")
			{
			$kode_sekolah_ard = "S2";
			}
		if ($sekolah=="S3")
			{
			$kode_sekolah_ard = "S3";
			}
		return $kode_sekolah_ard;	
	}
}
if ( ! function_exists('cek_host_ard'))
{
	function cek_host_ard($url_ard_unduh)
	{
		$online = 0;
		$port = substr($url_ard_unduh,-2);
		$port_host = 80;
		if(is_numeric($port))
		{
			$port_host = $port;
		}
		if(strpos($url_ard_unduh, 'https://') !== false)
		{
			$server_pusate = 'ssl://'.str_replace('https://','',$url_ard_unduh);
			$port_host = '443';
		}
		if(strpos($url_ard_unduh, 'http://') !== false)
		{
			$server_pusate = str_replace('http://','',$url_ard_unduh);
		}
		if($socket =@ fsockopen($server_pusate, $port_host, $errno, $errstr, 10))
		{
			$online = 1;
			fclose($socket);
		}
		return $online;	
	}
}
if ( ! function_exists('koneksi_mysql'))
{
	function koneksi_mysql($url_ard_unduh)
	{
		$file = file_get_contents($url_ard_unduh.'/api/sekolah.php');
		$json = json_decode($file, true);
		$koneksi_mysql = '<h3 class="text-danger">Gagal tersambung ke database ARD</h3>';
		if($json)
		{
			foreach($json as $data)
			{
				$koneksi_mysql = $data['school_id'];
			}
		}
		return $koneksi_mysql;	
	}
}
if ( ! function_exists('batas_sangat_baik'))
{
	function batas_sangat_baik($kkm)
	{
		if($kkm == 71)
		{
			$batas = 91;
		}
		elseif($kkm == 72)
		{
			$batas = 90;
		}
		elseif($kkm == 73)
		{
			$batas = 91;
		}
		elseif($kkm == 74)
		{
			$batas = 92;
		}
		elseif($kkm == 75)
		{
			$batas = 91;
		}
		else
		{
			$batas = 90;
		}
		return $batas;	
	}
}
if ( ! function_exists('batas_baik'))
{
	function batas_baik($kkm)
	{
		if($kkm == 71)
		{
			$batas = 81;
		}
		elseif($kkm == 72)
		{
			$batas = 81;
		}
		elseif($kkm == 73)
		{
			$batas = 82;
		}
		elseif($kkm == 74)
		{
			$batas = 83;
		}
		elseif($kkm == 75)
		{
			$batas = 83;
		}
		else
		{
			$batas = 80;
		}
		return $batas;	
	}
}
// ------------------------------------------------------------------------


/* End of file fungsi_helper.php */
/* Location: ./system/helpers/fungsi_helper.php */
