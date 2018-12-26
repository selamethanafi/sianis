<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: emiss_helper.php
// Lokasi      		: application/helpers
// Terakhir diperbarui	: Min 02 Apr 2017 05:58:58 WIB 
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
function ambil_nis($str)
{
	$nis = substr($str,-4);
	return $nis;
}
function ubah_jenkel($str)
{
	if($str == 'L')
	{
		$str2 = 'Laki-laki';
	}
	elseif($str == 'P')
	{
		$str2 = 'Perempuan';
	}
	else
	{
		$str2 = '';
	}
	return $str2;
}
function date_to_en($tanggal)
{
    $tanggal = preg_replace("/\//", "-", $tanggal);
    $tgl = date('Y-m-d', strtotime($tanggal));
    if ($tgl == '1970-01-01') {
        return '';
    } else {
        return $tgl;
    }
}
function ubah_kelas($str)
{
	if($str == '11')
	{
		$str2 = 'XI-';
	}
	elseif($str == '12')
	{
		$str2 = 'XII-';
	}
	else
	{
		$str2 = 'X-';
	}
	return $str2;
}
function ubah_agama($str)
{
	if($str == '1')
	{
		$str2 = 'Islam';
	}
	elseif($str == '2')
	{
		$str2 = 'Kristen';
	}
	elseif($str == '3')
	{
		$str2 = 'Katholik';
	}
	elseif($str == '4')
	{
		$str2 = 'Hindu';
	}
	elseif($str == '5')
	{
		$str2 = 'Budha';
	}
	elseif($str == '6')
	{
		$str2 = 'Konghucu';
	}
	else
	{
		$str2 = '';
	}
	return $str2;
}
function ubah_jarak($str)
{
	if($str == '1')
	{
		$str2 = '0 - 1 km';
	}
	elseif($str == '2')
	{
		$str2 = '1 - 3 km';
	}
	elseif($str == '3')
	{
		$str2 = '3 - 5 km';
	}
	elseif($str == '4')
	{
		$str2 = '5 - 10 km';
	}
	else
	{
		$str2 = 'lebih dari 10 km';
	}
	return $str2;
}
function ubah_transportasi($str)
{
	if($str == '1')
	{
		$str2 = 'Berjalan kaki';
	}
	elseif($str == '2')
	{
		$str2 = 'Sepeda';
	}
	elseif($str == '3')
	{
		$str2 = 'Sepeda Motor';
	}
	elseif($str == '4')
	{
		$str2 = 'Mobil Pribadi';
	}
	elseif($str == '5')
	{
		$str2 = 'Antarjemput Sekolah';
	}

	elseif($str == '6')
	{
		$str2 = 'Angkutan Umum';
	}

	elseif($str == '7')
	{
		$str2 = 'Perahu/Sampan';
	}

	else
	{
		$str2 = 'Lainnya';
	}
	return $str2;
}

function ubah_pendidikan($str)
{
	if($str == '0')
	{
		$str2 = 'Tidak Berpendidikan Formal';
	}
	elseif($str == '1')
	{
		$str2 = 'SD / SLTP';
	}
	elseif($str == '2')
	{
		$str2 = 'SLTA';
	}
	elseif($str == '3')
	{
		$str2 = 'D1';
	}
	elseif($str == '4')
	{
		$str2 = 'D2';
	}
	elseif($str == '5')
	{
		$str2 = 'D3';
	}

	elseif($str == '6')
	{
		$str2 = 'D4';
	}
	elseif($str == '7')
	{
		$str2 = 'S1';
	}
	elseif($str == '8')
	{
		$str2 = 'S2';
	}
	elseif($str == '9')
	{
		$str2 = 'S3';
	}
	else
	{
		$str2 = '';
	}
	return $str2;
}
function ubah_duit($str)
{
	if($str == '1')
	{
		$str2 = '<=  Rp 500.000';
	}
	elseif($str == '2')
	{
		$str2 = 'Rp 500.001 - Rp 1.000.000';
	}
	elseif($str == '3')
	{
		$str2 = 'Rp 1.000.001 - Rp 2.000.000';
	}
	elseif($str == '4')
	{
		$str2 = 'Rp 2.000.001 - Rp 3.000.000';
	}
	elseif($str == '5')
	{
		$str2 = 'Rp 3.000.001 - Rp 5.000.000';
	}
	else
	{
		$str2 = '> Rp 5.000.000';
	}
	return $str2;
}
function ubah_jenis_rumah($str)
{
	if($str == '1')
	{
		$str2 = 'Rumah Orangtua';
	}
	elseif($str == '2')
	{
		$str2 = 'Rumah Saudara/Kerabat';
	}
	elseif($str == '3')
	{
		$str2 = 'Asrama Madrasah/Pesantren';
	}
	elseif($str == '4')
	{
		$str2 = 'Rumah Sewa/Kontrak';
	}
	elseif($str == '5')
	{
		$str2 = 'Panti Asuhan';
	}
	elseif($str == '6')
	{
		$str2 = 'Rumah Singgah';
	}
	else
	{
		$str2 = 'Lainnya';
	}
	return $str2;
}
function ubah_cita($str)
{
	if($str == '1')
	{
		$str2 = 'PNS';
	}
	elseif($str == '2')
	{
		$str2 = 'TNI/Polri';
	}
	elseif($str == '3')
	{
		$str2 = 'Guru/Dosen';
	}
	elseif($str == '4')
	{
		$str2 = 'Dokter';
	}
	elseif($str == '5')
	{
		$str2 = 'Politikus';
	}
	elseif($str == '6')
	{
		$str2 = 'Wiraswasta';
	}
	elseif($str == '7')
	{
		$str2 = 'Pekerja Seni/Lukis/Artis/Sejenis';
	}
	else
	{
		$str2 = 'Lainnya';
	}
	return $str2;
}
 
function ubah_hobi($str)
{
	if($str == '1')
	{
		$str2 = 'Olahraga';
	}
	elseif($str == '2')
	{
		$str2 = 'Kesenian';
	}
	elseif($str == '3')
	{
		$str2 = 'Membaca';
	}
	elseif($str == '4')
	{
		$str2 = 'Menulis';
	}
	elseif($str == '5')
	{
		$str2 = 'Travelling';
	}
	else
	{
		$str2 = 'Lainnya';
	}
	return $str2;
}
  
function ubah_pekerjaan($str)
{
	if($str == '01')
	{
		$str2 = 'Tidak bekerja (Di rumah saja)';
	}
	elseif($str == '02')
	{
		$str2 = 'Pensiunan/Almarhum';
	}
	elseif($str == '03')
	{
		$str2 = 'PNS (selain poin 05 dan 10)';
	}
	elseif($str == '04')
	{
		$str2 = 'TNI/Polisi';
	}
	elseif($str == '05')
	{
		$str2 = 'Guru/Dosen';
	}
	elseif($str == '06')
	{
		$str2 = 'PegawaiSwasta';
	}
	elseif($str == '07')
	{
		$str2 = 'Pengusaha/Wiraswasta';
	}
	elseif($str == '08')
	{
		$str2 = 'Pengacara/Hakim/Jaksa/Notaris';
	}
	elseif($str == '09')
	{
		$str2 = 'Seniman/Pelukis/Artis/Sejenis';
	}
	elseif($str == '10')
	{
		$str2 = 'Dokter/Bidan/Perawat';
	}
	elseif($str == '11')
	{
		$str2 = 'Pilot/Pramugari';
	}
	elseif($str == '12')
	{
		$str2 = 'Pedagang';
	}
	elseif($str == '13')
	{
		$str2 = 'Petani/Peternak';
	}
	elseif($str == '14')
	{
		$str2 = 'Nelayan';
	}
	elseif($str == '15')
	{
		$str2 = 'Buruh(Tani/Pabrik/Bangunan)';
	}
	elseif($str == '16')
	{
		$str2 = 'Sopir/Masinis/Kondektur';
	}
	elseif($str == '17')
	{
		$str2 = 'Politikus';
	}
	else
	{
		$str2 = 'Lainnya';
	}
	return $str2;
}
/* End of file emiss_helper.php */

