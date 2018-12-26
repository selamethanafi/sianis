<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_nilai_ijazah_csv.php
// Lokasi      		: application/views/shared
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$thnajaranawal = substr(berkas($thnajaran),0,4);
$thnajaranakhir = substr(berkas($thnajaran),5,4);
$kelase = berkas($kelas);
$judul = 'nilai';
$tf = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran'");
$pembagi = count($tf->result());
$program = kelas_jadi_program($kelas);
//Daftar_Nilai_X.1_2011_1
$filename = 'Nilai_Ijazah_'.$kelase.'_'.$thnajaranawal.'_'.$thnajaranakhir.''; 	
//header kolom
//$csv_output = '"","","","",""';
//$csv_output .= "\n";
$csv_output = '"nomor","nama","tempat, tanggal lahir","nisn","no peserta UN"';
if($thnajaran == '2016/2017')
{
	$ta = $this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' order by `no_urut`");
}
else
{
	$ta = $this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='2' and kelas='$kelas' order by no_urut_rapor");
}
if($thnajaran == '2016/2017')
{
	foreach($ta->result() as $a)
	{
		if(!empty($a->mapel))
		{
		$csv_output .= ',"'.$a->mapel.'",""';
		}
	}
	$csv_output .= "\n";
	$csv_output .= '"","","","",""';
	foreach($ta->result() as $a)
	{
		$csv_output .= ',"NR","NUM"';
	}
	$csv_output .= "\n";
	$nomor = 1;
	$tb = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='2' order by no_urut ");
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		$csv_output .= '"'.$nomor.'","'.nis_ke_nama($nis).'","'.tempat_lahir_siswa($nis).', '.date_to_long_string(tanggal_lahir_siswa($nis)).'","'.nisn($nis).'","'.nomor_un($nis).'"';
		foreach($ta->result() as $a)
		{
			$mapel = $a->mapel;
			$pembagi = $a->cacah_semester;
			$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
			$nilai = 0;
			foreach($tc->result() as $c)
			{
				$thnajaranx = $c->thnajaran_penilaian;
				$semesterx = $c->semester;
				$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");			
				foreach($td->result() as $d)
				{
					if ($mapel == 'Seni Budaya')
					{
						$nilai = $nilai + (($d->psikomotor)/10);
					}
					else
					{
						$nilai = $nilai + (($d->kog)/10);
					}
				}

			}
			//nilai ujian madrasah
			$te = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");
			$nilai_um = 0;			
			if(count($te->result())>0)
			{
				foreach($te->result() as $e)
				{
					if ($mapel == 'Seni Budaya')
					{
						if ($e->praktik>10)
						{
							$nilai_um = $e->praktik / 10;
						}
						else
						{
							$nilai_um = $e->praktik;
						}
					}
					else
					{
						if ($e->nilai > 0)
						{
							$nilai_um = $e->nilai / 10;
						}
						else
						{
							$nilai_um = $e->nilai;
						}
					}
				}
			} //akhir kalau ada nilai um
			else
			{
				$nilai_um = 0;
			}


		}
		$nilai = ROUND(($nilai / $pembagi),2);
		$csv_output .= ',"'.$nilai.'"';
		$csv_output .= ',"'.$nilai_um.'"';
		$csv_output .= "\n";
		$nomor++;
	}

}
elseif($thnajaran == '2015/2016')
{
	$ta = $this->db->query("select * from `m_mapel_rapor` where thnajaran='$thnajaran' and semester='2' and kelas='$kelas' order by no_urut");
	foreach($ta->result() as $a)
	{
		if(!empty($a->nama_mapel_portal))
		{
		$csv_output .= ',"'.$a->nama_mapel_portal.'",""';
		}
	}
	$csv_output .= "\n";
	$csv_output .= '"","","","",""';
	foreach($ta->result() as $a)
	{
		if(!empty($a->nama_mapel_portal))
		{
		$csv_output .= ',"NR","NUM"';
		}
	}
}
elseif($thnajaran == '2014/2015')
{
	$ta = $this->db->query("select * from `m_mapel_rapor` where thnajaran='$thnajaran' and semester='2' and kelas='$kelas' order by no_urut");
	foreach($ta->result() as $a)
	{
		if(!empty($a->nama_mapel_portal))
		{
		$csv_output .= ',"'.$a->nama_mapel_portal.'","",""';
		}
	}
	$csv_output .= "\n";
	$csv_output .= '"","","","",""';
	foreach($ta->result() as $a)
	{
		if(!empty($a->nama_mapel_portal))
		{
		$csv_output .= ',"NR","NUM","NM"';
		}
	}
}
else
{
	$ta = $this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='2' and kelas='$kelas' order by no_urut_rapor");
	foreach($ta->result() as $a)
	{
	$csv_output .= ',"'.$a->mapel.'","",""';
	}
	$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
	foreach($taa->result() as $aa)
	{
	$csv_output .= ',"'.$aa->mapel.'","",""';
	}
	$csv_output .= "\n";
	$csv_output .= '"","","","",""';
	foreach($ta->result() as $a)
	{
	$csv_output .= ',"NR","NUM","NM"';
	}
	$taa = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
	foreach($taa->result() as $aa)
	{
	$csv_output .= ',"NS","NUN","NA"';
	}
}
$csv_output .= "\n";

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>
