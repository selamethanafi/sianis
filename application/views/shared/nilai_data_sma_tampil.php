<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: nilai_data_sma_tampil.php
// Lokasi      		: application/views/shared/
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
?>
<div class="container-fluid">
<input type="button" value="Tutup jendela ini" onclick="self.close()">
atau gunakan Ctrl + W
<?php
//tahun
$versi = date("Y");
$ta = $this->db->query("select * from m_walikelas where `id_walikelas` = '$id_walikelas'");
$kelas = '';
foreach($ta->result() as $a)
{
	$kelas = $a->kelas;
}

if ($thnajaran == '2014/2015')
{
	$semester = '2';
	$kolom = 'Z';
	if (!empty($kelas))
	{
		$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester'and status='Y' order by no_urut ");
		$program = kelas_jadi_program($kelas);
		$baris=1;
		echo '<div class="CSSTableGenerator"><table><tr><td>No</td><td>KD PES</td><td>NAMA PESERTA</td><td>KD STUDI</td>';
		//mapel un
		$ta = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
		foreach($ta->result() as $a)
		{	
			echo '<td>'.$a->nmapel.'</td>';
		}
		echo '</tr>';
		//cari nomor un
		$tsiswanomortes = $this->db->query("select * from `siswa_nomor_tes_un` where `thnajaran` ='$thnajaran' and `kelas`='$kelas' order by no_peserta ASC");
		$nomor = 1;
		foreach($tsiswanomortes->result() as $b)
		{
			$baris++;
			$nis=$b->nis;
			$namasiswa = nis_ke_nama($nis);
			$no_peserta = $b->no_peserta.'-'.$b->no_unik;
			echo '<tr><td>'.$nomor.'</td><td>'.$no_peserta.'</td><td>'.$namasiswa.'</td><td></td>';
			//mapel un
			$ta = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
			$nokol = 5;
			foreach($ta->result() as $a)
			{	
				$mapel = $a->mapel;
				//cari nilai
				$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
				$pembagi = 0;
				$nilai = 0;
				foreach($tc->result() as $c)
				{
					$thnajaranx = $c->thnajaran_penilaian;
					$semesterx = $c->semester;
					$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");			
					foreach($td->result() as $d)
					{
						$nilai = $nilai + $d->kog;
					}
					$pembagi++;
				}
				$NS = 0;
				if ($pembagi > 0)
				{
					$NS = $nilai / $pembagi;
				}
				$NS = round($NS,1);
				echo '<td>'.$NS.'</td>';
				$nokol++;
			}
			echo '</tr>';
			$nomor++;
		}
	echo '</table></div>';
	} // kalau kelas tidak kosong
}
elseif($thnajaran == '2015/2016')
{
$cacahitemnilai = 5;//termasuk US
$pembagi = 3;
$range = $pembagi - 1;
$semester = '2';
$kolom = 'Z';
if ((!empty($thnajaran)) and (!empty($kelas)))
{
	$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and status='Y' order by no_urut ");

$thnajarane = berkas($thnajaran);
$table = 'nilai'; // table you want to export
$kelase = berkas($kelas);
$filename = 'Nilai_Sekolah_peserta_ujian_nasional_tahun_'.$thnajarane.'_kelas_'.$kelase.'.xls'; 
$program = kelas_jadi_program($kelas);
$baris=1;
echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td>No</td><td>No Peserta</td><td>Identitas</td><td>Semester</td>';
//mapel un
$ta = $this->db->query("select * from mapel_un where thnajaran='$thnajaran' and program='$program' order by no_urut");
foreach($ta->result() as $a)
{	
	echo '<td>'.$a->nmapel.'</td>';
}
//cari nomor un
if($halaman == 2)
{
	$limit = 'limit 5,5';
	$nomor = 6;
}
elseif($halaman == 3)
{
	$limit = 'limit 10,5';
	$nomor = 11;
}
elseif($halaman == 4)
{
	$limit = 'limit 15,5';
	$nomor = 16;
}
elseif($halaman == 5)
{
	$limit = 'limit 20,5';
	$nomor = 21;
}
elseif($halaman == 6)
{
	$limit = 'limit 25,5';
	$nomor = 26;
}
elseif($halaman == 7)
{
	$limit = 'limit 30,5';
	$nomor = 31;
}
else
{
	$limit = 'limit 0,5';
	$nomor = 1;
}

$tsiswanomortes = $this->db->query("select * from `siswa_nomor_tes_un` where `thnajaran` ='$thnajaran' and `kelas`='$kelas' order by no_peserta ASC $limit ");
$adasiswa = $tsiswanomortes->num_rows();
if($adasiswa == 0)
{
echo '<tr><td colspan="15">Siswa tidak ada</td></tr>';
}
$nbarissiswa =1;
$baris = 1;
//$kolom = 'JJ';
foreach($tsiswanomortes->result() as $b)
{
	$nis=$b->nis;
	$nama = nis_ke_nama($nis);
	$no_peserta = $b->no_peserta.'-'.$b->no_unik;
	
	//tahun penilaian
	$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
	
	foreach($tc->result() as $c)
		{
		$thnajaranx = $c->thnajaran_penilaian;
		$semesterx = $c->semester;
		if($baris == 1)
		{
			echo '<tr><td>'.$nomor.'</td><td>'.$no_peserta.'</td><td>'.$nama.'</td>';
		}
		else
		{
			echo '<tr><td colspan="3"></td>';
			
		}

		echo '<td align="center">'.$thnajaranx.'-'.$semesterx.'</td>';
		foreach($ta->result() as $a)
			{	
				$mapel = $a->mapel;
				$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");			
				$nilai = 0;
				foreach($td->result() as $d)
					{
					$nilai = ($d->kog);
					}

				echo '<td align="center">'.$nilai.'</td>';
			}
		$baris++;
		}

	echo '</tr>';
		echo '<tr><td colspan="3"></td><td align="center">US</td>';
		$baris = 1;
		foreach($ta->result() as $a)
			{	
				$mapel = $a->mapel;
				$te = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");			
				$nilai = 0;
				foreach($te->result() as $e)
					{
						$nilai = $e->nilai;
					}
				echo '<td align="center">'.$nilai.'</td>';
			}
	$nomor++;
}
echo '</table>';	
} // akhir unduh xls
} //akhir sebelum 2015
else
{
	echo '<h1>Aplikasi tahun pelajaran ini tidak dibuat</h1>';
}
?>
<input type="button" value="Tutup jendela ini" onclick="self.close()">
atau gunakan Ctrl + W
</div>

