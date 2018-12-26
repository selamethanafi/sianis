<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 14 Nov 2014 07:17:50 WIB 
// Nama Berkas 		: kartu_osis.php
// Lokasi      		: application/views/tatausaha/
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
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' and `kelas` like 'X-%'");
$filename = 'data_kartu_osis'; 	
$csv_output = '"nis","nisn","nama","tmpt","tgllhr","jenkel","alamat","foto"';
$csv_output .= "\n";
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$kelas = $a->kelas;
	$tsiswa = $this->db->query("select * from `datsis` where `nis`='$nis'");
	foreach($tsiswa->result_array() as $d)
		{
		$foto = $d['foto'];
		$csv_output .= '"';
		$csv_output .= $d['nis'].'","'; //
		$csv_output .= $d['nis'].' / '.$d['nisn'].'","'; //
		$namasiswa = strtolower($d['nama']);
		$namasiswa = ucwords($namasiswa);
		$csv_output .= $namasiswa.'","'; //E
		$csv_output .= ucwords(strtolower($d['tmpt'])).'","'; //
		//tanggal
		$str = $d['tgllhr'];	
		$tanggalle = ''.substr($str,5,2).'-'.substr($str,8,2).'-'.substr($str,0,4).'';
		$bulan = substr($str,5,2);
		$bulane = '';
		$tanggalle ='';
		if ($bulan == '01')
			{
			$bulane = 'Januari';
			}
		if ($bulan == '02')
			{
			$bulane = 'Februari';
			}
		if ($bulan == '03')
				{
			$bulane = 'Maret';
			}
		if ($bulan == '04')
			{
			$bulane = 'April';
			}
		if ($bulan == '05')
			{
			$bulane = 'Mei';
			}
		if ($bulan == '06')
			{
			$bulane = 'Juni';
			}
		if ($bulan == '07')
			{
			$bulane = 'Juli';
			}
		if ($bulan == '08')
			{
			$bulane = 'Agustus';
			}
		if ($bulan == '09')
			{
			$bulane = 'September';
			}
		if ($bulan == '10')
			{
			$bulane = 'Oktober';
			}
		if ($bulan == '11')
			{
			$bulane = 'November';
			}
		if ($bulan == '12')
		{
			$bulane = 'Desember';
		}
		if (!empty($bulane))
		{
			$tanggalle = ''.substr($str,8,2).' '.$bulane.' '.substr($str,0,4);
		}

		$csv_output .= $tanggalle.'","'; //
		$csv_output .= $d['jenkel'].'","'; //
		$alamat = '';
		if (!empty($d['dusun']))
		{
			$alamat .= ucwords(strtolower($d['dusun']));
		}
		if (!empty($d['rt']))
		{
			if (empty($alamat))
			{
				$alamat .= 'RT '.$d['rt'];
			}
			else
			{
				$alamat .= ' RT '.$d['rt'];
			}
		}
		if (!empty($d['rw']))
		{
			if (empty($alamat))
			{
				$alamat .= 'RW '.$d['rw'];
			}
			else
			{
				$alamat .= ' RW '.$d['rw'];
			}
		}
		if (!empty($d['desa']))
		{
			if (empty($alamat))
			{
				$alamat .= ucwords(strtolower($d['desa']));
			}
			else
			{
				$alamat .= " ".ucwords(strtolower($d['desa']));
			}

		}
		if (!empty($d['kec']))
		{
			if (empty($alamat))
			{
				$alamat .= ucwords(strtolower($d['kec']));
			}
			else
			{
			$alamat .= " ".ucwords(strtolower($d['kec']));
			}

		}
		if (!empty($d['kab']))
		{
		if (empty($alamat))
			{
			$alamat .= ucwords(strtolower($d['kab']));
			}
			else
			{
			$alamat .= " ".ucwords(strtolower($d['kab']));
			}

		}



		$csv_output .= $alamat.'","'; //
		$csv_output .= $foto.'"'; //
		$csv_output .= "\n";
	}
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

?>
