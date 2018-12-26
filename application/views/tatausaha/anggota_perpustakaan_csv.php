<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 16:01:03 WIB 
// Nama Berkas 		: anggota_perpustakaan_csv.php
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
		$tahun = date("Y");
		$bulan = date("m");
		$tanggal = date("d");

$filename = 'anggota_perpustakaan'; 	
//$csv_output = '"member_id","member_name","gender","member_type_id","","birth_date","member_address","is_new","member_image","inst_name","member_phone","member_since_date","register_date","expire_date","is_pending","mpasswd"';
//$csv_output .= "\n";
$csv_output = '';
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'");
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$kelas = $a->kelas;
	$tb = $this->db->query("SELECT * from datsis where `nis`='$nis' and `ket`='Y'");
	$ada = $tb->num_rows();
	if($ada>0)
	{
	foreach($tb->result() as $b)
		{
		
		$member_id = $b->nis;
		$member_name = $b->nama;
		$gender = '';
		if ($b->jenkel=='Laki-laki')
			{
			$gender = 1;
			}
			if ($b->jenkel=='Perempuan')
			{
			$gender = 0;
			}
		$birth_date = $b->tgllhr;
		$member_type_id = "Siswa";
		$member_address =ucwords(strtolower($b->alamat));
		$is_new = 0;
		$foto = $b->foto;
		$member_image='';	
		if (!empty($foto))
			{
			$member_image = $foto;
			}
		$member_phone = $b->hp;
		$member_since_date = $b->tglditerima;
		$dx = substr($member_since_date,8,2);
		$mx = substr($member_since_date,5,2);
		$yx = substr($member_since_date,0,4);
		$register_date = "$tahun-$bulan-$tanggal";
		$thnx = $yx;
		if ($yx=='0000')
			{
			if (substr($kelas,0,2)=='X-')
				{
				$thnx = $tahun + 3;
				$member_since_date = ''.$tahun.'-07-01';
				$expire_date = "$thnx-07-01";
				}
			if (substr($kelas,0,3)=='XI-')
				{
				$thnx = $tahun + 2;
				$thny = $tahun - 1;
				$member_since_date = ''.$thny.'-07-01';
				$expire_date = "$thnx-07-01";
				}
			if (substr($kelas,0,4)=='XII-')
				{
				$thnx = $tahun + 1;
				$thny = $tahun - 2;
				$member_since_date = ''.$thny.'-07-01';
				$expire_date = "$thnx-07-01";
				}
			}
			else
			{
			$thnx = substr($member_since_date,0,4)+3;
			$expire_date = "$thnx-$mx-$dx";
			}
		$is_pending = 0;
		// cari password
		$mpasswd = md5($b->nis);
		$inst_name = 'MAN Tengaran';
		$csv_output .= '"'.$member_id.'","'.$member_name.'","'.$gender.'","'.$member_type_id.'","","'.$member_address.'","","'.$inst_name.'","'.$is_new.'","'.$member_image.'","'.$member_id.'","'.$member_phone.'","","'.$member_since_date.'","'.$register_date.'","'.$expire_date.'","'.$birth_date.'","","'.$mpasswd.'"';
		$csv_output .= "\n";
		}
	}
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

?>
