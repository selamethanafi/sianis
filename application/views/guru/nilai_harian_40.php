<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 10 Mei 2016 22:30:05 WIB 
// Nama Berkas 		: nilai_harian.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tanggalhariini = tanggal_hari_ini();
$tahun = tahunsaja(tanggal_hari_ini());
$bulan = bulansaja(tanggal_hari_ini());
$tanggal= substr(tanggal_hari_ini(),8,2);
$jam_saja = jam_saja();
$menit_saja = menit_saja();

if($bulan == '01')
	{
		$bulane = 'Januari';
	}
	if($bulan == '02')
	{
		$bulane = 'Februari';
	}
	if($bulan == '03')
	{
		$bulane = 'Maret';
	}
	if($bulan == '04')
	{
		$bulane = 'April';
	}
	if($bulan == '05')
	{
		$bulane = 'Mei';
	}
	if($bulan == '06')
	{
		$bulane = 'Juni';
	}
	if($bulan == '07')
	{
		$bulane = 'Juli';
	}
	if($bulan == '08')
	{
		$bulane = 'Agustus';
	}
	if($bulan == '09')
	{
		$bulane = 'September';
	}
	if($bulan == '10')
	{
		$bulane = 'Oktober';
	}
	if($bulan == '11')
	{
		$bulane = 'November';
	}
	if($bulan == '12')
	{
		$bulane = 'Desember';
	}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan '.$bulane.' '.$tahun;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
$id_bulanan = '';
foreach($ta->result() as $a)
{
	$id_bulanan = $a->id_bulanan;
}

$ulangane = '';
$materi = '';
$nomor_materi = '100';
	$jenis_deskripsi = 0;
	$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($tmapel->result() as $dtmapel)
	{
		$jenis_deskripsi = $dtmapel->jenis_deskripsi;
	}
	if ($jenis_deskripsi==1)
		{$jenis_deskripsine = "Berdasarkan Ulangan (Deskripsi Otomatis)";
		}
	if ($jenis_deskripsi==2)
		{
		$jenis_deskripsine = "Berdasarkan Nilai Akhir (Deskripsi Otomatis)";
		}
	if ($jenis_deskripsi==5)
		{
		$jenis_deskripsine = "Berdasarkan Nilai Sekolah (NS) (Deskripsi Otomatis)";
		}

	if ($jenis_deskripsi==3)
		{
		$jenis_deskripsine = "Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)";
		}
	if ($jenis_deskripsi==0)
		{$jenis_deskripsine = "Kopi Paste / Manual";
		}
	if ($jenis_deskripsi==4)
		{$jenis_deskripsine = "Berdasar bank deskripsi";
		}
	if ($jenis_deskripsi==6)
		{$jenis_deskripsine = $this->config->item('versi_deskripsi');
		}
if ($itemnilai=='1')
	{
	$kkm_ulangan = $kkm_uh1;
	$materi = $materi1;
	$nomor_materi = 1;
	$ulangane = 'UH1';
	}
if ($itemnilai=='2')
	{
	$kkm_ulangan = $kkm_uh2;
	$materi = $materi2;
	$nomor_materi = 2;
	$ulangane = 'UH2';
	}
if ($itemnilai=='3')
	{
	$kkm_ulangan = $kkm_uh3;
	$materi = $materi3;
	$nomor_materi = 3;
	$ulangane = 'UH3';
	}
if ($itemnilai=='11')
	{
	$kkm_ulangan = $kkm_uh4;
	$materi = $materi4;
	$nomor_materi = 4;
	$ulangane = 'UH4';
	}
if ($itemnilai=='18')
	{
	$kkm_ulangan = $kkm;
	$materi = $materi5;
	$nomor_materi = 5;
	$ulangane = 'UH5';
	}
if ($itemnilai=='19')
	{
	$kkm_ulangan = $kkm;
	$materi = $materi6;
	$nomor_materi = 6;
	$ulangane = 'UH6';
	}
if ($itemnilai=='20')
	{
	$kkm_ulangan = $kkm;
	$materi = $materi7;
	$nomor_materi = 7;
	$ulangane = 'UH7';
	}
if ($itemnilai=='21')
	{
	$kkm_ulangan = $kkm;
	$materi = $materi8;
	$nomor_materi = 8;
	$ulangane = 'UH8';
	}
if ($itemnilai=='22')
	{
	$kkm_ulangan = $kkm;
	$materi = $materi9;
	$nomor_materi = 9;
	$ulangane = 'UH9';
	}
if ($itemnilai=='23')
	{
	$kkm_ulangan = $kkm;
	$materi = $materi10;
	$nomor_materi = 10;
	$ulangane = 'UH10';
	}

if ($itemnilai=='7')
	{
	if($jenis_deskripsi == 6)
	{
		$materi = '';
		$nomor_materi = '100';
	}
	else
	{
		$materi = $materi5;
		$nomor_materi = 5;
	}
	$kkm_ulangan = $kkm_mid;
	$ulangane = 'UTS';
	}
if ($itemnilai=='8')
{
	if($jenis_deskripsi == 6)
	{
		$materi = '';
		$nomor_materi = '100';
	}
	else
	{
		$materi = $materi6;
		$nomor_materi = 6;
	}
	$kkm_ulangan = $kkm_uas;
	if($semester == 1)
	{
		$ulangane = 'UAS';
	}
	else
	{
		$ulangane = 'UKK';
	}
}
if ($itemnilai=='13')
	{
	if($jenis_deskripsi == 6)
	{
		$materi = '';
		$nomor_materi = '100';
	}
	$ulangane = 'FINAL';
	}

$cacah_siswa = $query->num_rows();
$kkm_ulangan = $kkm;

?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<table class="table table-striped table-bordered">
<tr><td><strong>Tahun Pelajaran.</strong></td><td><strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td><strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td><strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td><strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Ranah Penilaian</strong></td><td><strong><?php echo $ranah;?></strong></td></tr>
<tr><td><strong>KKM / Cacah Ulangan Harian / Cacah Tugas</strong></td><td><strong><?php echo $kkm;?> </strong> / <strong><?php echo $ncacah_ulangan_harian;?></strong> / <strong><?php echo $ncacah_tugas;?></strong></td></tr>
<tr><td><strong>Bobot Ulangan Harian / Cacah Tugas / Mid / Semester</strong></td><td><strong><?php echo $nbobot_ulangan_harian;?>%</strong> / <strong><?php echo $nbobot_tugas;?>%</strong> / <strong><?php echo $nbobot_mid;?>%</strong> / <strong><?php echo $nbobot_semester;?>%</strong></td></tr>
<tr><td><strong>KKM Ulangan</strong></td><td><strong><?php echo $kkm_ulangan;?> </strong></td></tr>
<tr><td><strong>Materi / KD Ulangan</strong></td><td><strong><?php echo $materi;?> </strong></td></tr>
<tr><td><strong>Jenis Deskripsi</strong></td><td><strong><?php echo $jenis_deskripsine;?></strong></td></tr>
</table>
<div class="alert alert-info">Mohon dipertimbangkan dengan sepenuh hati saat menilai siswa yang berkeinginan melanjutkan diterima di perguruan tinggi. Mari kita antarkan mereka ke jenjang perguruan tinggi. (Pakne Naya).</div>
<?php
$bisa = '0';
if (($itemnilai=='1') and ($ncacah_ulangan_harian>0))
{
	$bisa = '1';
}
if (($itemnilai=='2') and ($ncacah_ulangan_harian>1))
{
	$bisa = '1';
}
if (($itemnilai=='3') and ($ncacah_ulangan_harian>2))
{
	$bisa = '1';
}
if (($itemnilai=='11') and ($ncacah_ulangan_harian>3))
{
	$bisa = '1';
}
if (($itemnilai=='18') and ($ncacah_ulangan_harian>4))
{
	$bisa = '1';
}
if (($itemnilai=='19') and ($ncacah_ulangan_harian>5))
{
	$bisa = '1';
}
if (($itemnilai=='20') and ($ncacah_ulangan_harian>6))
{
	$bisa = '1';
}
if (($itemnilai=='21') and ($ncacah_ulangan_harian>7))
{
	$bisa = '1';
}
if (($itemnilai=='22') and ($ncacah_ulangan_harian>8))
{
	$bisa = '1';
}
if (($itemnilai=='23') and ($ncacah_ulangan_harian>9))
{
	$bisa = '1';
}
if (($itemnilai=='24') and ($ncacah_tugas>4))
{
	$ulangane = 'TU 5';
	$bisa = '1';
}
if (($itemnilai=='25') and ($ncacah_tugas>5))
{
	$ulangane = 'TU 6';
	$bisa = '1';
}
if (($itemnilai=='26') and ($ncacah_tugas>6))
{
	$ulangane = 'TU 7';
	$bisa = '1';
}
if (($itemnilai=='27') and ($ncacah_tugas>7))
{
	$ulangane = 'TU 8';
	$bisa = '1';
}
if (($itemnilai=='28') and ($ncacah_tugas>8))
{
	$ulangane = 'TU 9';
	$bisa = '1';
}
if (($itemnilai=='29') and ($ncacah_tugas>9))
{
	$ulangane = 'TU 10';
	$bisa = '1';
}
if (($itemnilai=='14') and ($cacah_kuis>0))
{
	$bisa = '1';
	$ulangane = 'KUIS 1';
}
if (($itemnilai=='15') and ($cacah_kuis>1))
{
	$bisa = '1';
	$ulangane = 'KUIS 2';
}
if (($itemnilai=='16') and ($cacah_kuis>2))
{
	$bisa = '1';
	$ulangane = 'KUIS 3';
}
if (($itemnilai=='17') and ($cacah_kuis>3))
{
	$bisa = '1';
	$ulangane = 'KUIS 4';
}
if (($itemnilai=='4') and ($ncacah_tugas>0))
{
	$ulangane = 'TU 1';
	$bisa = '1';
}
if (($itemnilai=='5') and ($ncacah_tugas>1))
{
	$ulangane = 'TU 2';
	$bisa = '1';
}
if (($itemnilai=='6') and ($ncacah_tugas>2))
{
	$ulangane = 'TU 3';
	$bisa = '1';
}
if (($itemnilai=='12') and ($ncacah_tugas>3))
{
	$ulangane = 'TU 4';
	$bisa = '1';
}
if ($itemnilai=='8')
{
	$bisa = '1';
}
if ($itemnilai=='7')
{
	$bisa = '1';
}
if ($itemnilai=='10')
{
	$bisa = '0';
}
if ($itemnilai=='13')
{
	$bisa = '1';
}
if($cacah_siswa == 0)
{
	$bisa = 0;
}
if($bisa == '1')
{
echo 'cacahsiswa '.$cacah_siswa;
echo form_open('guru/updatenilaiharian2/'.$id_mapel.'/'.$itemnilai.'/'.$nomor_materi.'/'.$cacah_siswa.'/'.$separuh);?>
<div class="table-responsive">
<table class="table table-hover table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td>
<?php
if ($itemnilai=='10')
{
	echo '<td><strong>NA</strong></td>';
}
if ($itemnilai=='13')
{
	echo '<td><strong>Menurut Perhitungan</strong></td>';
}
?>
<td width="150"><strong>NILAI <?php echo $ulangane;?></strong></td>
<td><strong>PTS</strong></td><td><strong>PAS</strong></td><td><strong>Nilai Rapor</strong></td></tr>
<?php
$nomor=1;
if(empty($separuh))
{
	$nomore = 1;
}
else
{
	$nomore = 31;
}

foreach($query->result() as $t)
{
	$nis = $t->nis;
	$tkuliah = $this->db->query("select `nis`, `nama`,`kuliah` from `datsis` where `nis`='$nis'");
	$kuliah = '';
	$namasiswa = '';
	foreach($tkuliah->result() as $k)
	{
		$kuliah = $k->kuliah;
		$namasiswa = $k->nama;
	}
	if($kuliah == 'Ya')
	{
		echo '<tr><td align="center">'.$nomor.'</td><td><div class="alert alert-success">'.$namasiswa.'</div><p class="text-success">Semoga diterima di PTN Amiin.</p></td>';
	}
	else
	{
		echo '<tr><td align="center">'.$nomor.'</td><td class="danger">'.$namasiswa.'</td>';
	}

	echo "<td align=\"center\">";
	if (($itemnilai=='1') and ($ncacah_ulangan_harian>0))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='2') and ($ncacah_ulangan_harian>1))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='3') and ($ncacah_ulangan_harian>2))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='11') and ($ncacah_ulangan_harian>3))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='18') and ($ncacah_ulangan_harian>4))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='19') and ($ncacah_ulangan_harian>5))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='20') and ($ncacah_ulangan_harian>6))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='21') and ($ncacah_ulangan_harian>7))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='22') and ($ncacah_ulangan_harian>8))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='23') and ($ncacah_ulangan_harian>9))
	{
		echo '<input type="number" min="0" max="100" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='4') and ($ncacah_tugas>0))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='5') and ($ncacah_tugas>1))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='6') and ($ncacah_tugas>2))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='12') and ($ncacah_tugas>3))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='24') and ($ncacah_tugas>4))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='25') and ($ncacah_tugas>5))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='26') and ($ncacah_tugas>6))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='27') and ($ncacah_tugas>7))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='28') and ($ncacah_tugas>8))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='29') and ($ncacah_tugas>9))
	{
		echo '<input type="number" min="0" max="100" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}

	if ($itemnilai=='7')
	{
		echo '<input type="text" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if ($itemnilai=='8')
	{
		echo '<input type="text" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_tu5_'.$nomor.'" value ="'.$t->nilai_tu5.'" >';
		echo '<input type="hidden" name="nilai_tu6_'.$nomor.'" value ="'.$t->nilai_tu6.'" >';
		echo '<input type="hidden" name="nilai_tu7_'.$nomor.'" value ="'.$t->nilai_tu7.'" >';
		echo '<input type="hidden" name="nilai_tu8_'.$nomor.'" value ="'.$t->nilai_tu8.'" >';
		echo '<input type="hidden" name="nilai_tu9_'.$nomor.'" value ="'.$t->nilai_tu9.'" >';
		echo '<input type="hidden" name="nilai_tu10_'.$nomor.'" value ="'.$t->nilai_tu10.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if ($itemnilai=='13')
	{
		if (($t->kunci=='T') or ($t->kunci=='0'))
		{
			if($jujug == 'T')
			{
				echo $t->nilai_na.'</td><td><input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" ><p class="text-center">'.$t->kog.'</p>';
			}
			else
			{

			echo $t->nilai_na.'</td><td><input type="number" min="0" max="100" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" class="form-control">';
			}
		}
		else
		{
			echo $t->nilai_na.'</td><td><input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" ><p class="text-center">'.$t->kog.'</p>';
		}
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'">';
	}
	if (($itemnilai=='14') and ($cacah_kuis>0))
	{
		echo '<input type="number" min="0" max="100" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='15') and ($cacah_kuis>1))
	{
		echo '<input type="number" min="0" max="100" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='16') and ($cacah_kuis>2))
	{
		echo '<input type="number" min="0" max="100" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}
	if (($itemnilai=='17') and ($cacah_kuis>3))
	{
		echo '<input type="number" min="0" max="100" name="nilai_ku4_'.$nomor.'" value ="'.$t->nilai_ku4.'" class="form-control">';
		echo '<input type="hidden" name="nilai_uh1_'.$nomor.'" value ="'.$t->nilai_uh1.'" >';
		echo '<input type="hidden" name="nilai_uh2_'.$nomor.'" value ="'.$t->nilai_uh2.'" >';
		echo '<input type="hidden" name="nilai_uh3_'.$nomor.'" value ="'.$t->nilai_uh3.'" >';
		echo '<input type="hidden" name="nilai_uh4_'.$nomor.'" value ="'.$t->nilai_uh4.'" >';
		echo '<input type="hidden" name="nilai_uh5_'.$nomor.'" value ="'.$t->nilai_uh5.'" >';
		echo '<input type="hidden" name="nilai_uh6_'.$nomor.'" value ="'.$t->nilai_uh6.'" >';
		echo '<input type="hidden" name="nilai_uh7_'.$nomor.'" value ="'.$t->nilai_uh7.'" >';
		echo '<input type="hidden" name="nilai_uh8_'.$nomor.'" value ="'.$t->nilai_uh8.'" >';
		echo '<input type="hidden" name="nilai_uh9_'.$nomor.'" value ="'.$t->nilai_uh9.'" >';
		echo '<input type="hidden" name="nilai_uh10_'.$nomor.'" value ="'.$t->nilai_uh10.'" >';
		echo '<input type="hidden" name="nilai_tu1_'.$nomor.'" value ="'.$t->nilai_tu1.'" >';
		echo '<input type="hidden" name="nilai_tu2_'.$nomor.'" value ="'.$t->nilai_tu2.'" >';
		echo '<input type="hidden" name="nilai_tu3_'.$nomor.'" value ="'.$t->nilai_tu3.'" >';
		echo '<input type="hidden" name="nilai_tu4_'.$nomor.'" value ="'.$t->nilai_tu4.'" >';
		echo '<input type="hidden" name="nilai_ku1_'.$nomor.'" value ="'.$t->nilai_ku1.'" >';
		echo '<input type="hidden" name="nilai_ku2_'.$nomor.'" value ="'.$t->nilai_ku2.'" >';
		echo '<input type="hidden" name="nilai_ku3_'.$nomor.'" value ="'.$t->nilai_ku3.'" >';
		echo '<input type="hidden" name="nilai_mid_'.$nomor.'" value ="'.$t->nilai_mid.'" >';
		echo '<input type="hidden" name="nilai_uas_'.$nomor.'" value ="'.$t->nilai_uas.'" >';
		echo '<input type="hidden" name="nilai_na_'.$nomor.'" value ="'.$t->nilai_na.'" >';
		echo '<input type="hidden" name="nilai_kog_'.$nomor.'" value ="'.$t->kog.'" >';
	}

	echo '<input type="hidden" name="kd_'.$nomor.'"  value ="'.$t->kd.'"><input type="hidden" name="nis_'.$nomor.'"  value ="'.$t->nis.'">';
	echo '</td><td align="center">'.$t->nilai_mid.'</td><td align="center">'.$t->nilai_uas.'</td><td align="center">'.$t->kog.'</td></tr>';
	$nomor++;
	$nomore++;
}
	if (($itemnilai=='1') or ($itemnilai=='2') or ($itemnilai=='3') or ($itemnilai=='11') or ($itemnilai=='7') or ($itemnilai=='8'))
	{
	echo "<tr><td align='center'></td><td>KKM</td><td align='center'>".$kkm_ulangan."</td></tr>";
	}

echo '</table></div>';
/*	
	?>
		<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
		<input type="hidden" name="cacah_ulangan_harian" value="<?php echo $ncacah_ulangan_harian;?>">
		<input type="hidden" name="cacah_kuis" value="<?php echo $cacah_kuis;?>">
		<input type="hidden" name="cacah_tugas" value="<?php echo $ncacah_tugas;?>">
		<input type="hidden" name="bobot_ulangan_harian" value="<?php echo $nbobot_ulangan_harian;?>">
		<input type="hidden" name="bobot_tugas" value="<?php echo $nbobot_tugas;?>">
		<input type="hidden" name="bobot_mid" value="<?php echo $nbobot_mid;?>">
		<input type="hidden" name="bobot_kuis" value="<?php echo $nbobot_kuis;?>">
		<input type="hidden" name="bobot_semester" value="<?php echo $nbobot_semester;?>">
		<input type="hidden" name="kkm_ulangan" value="<?php echo $kkm_ulangan;?>">
		<input type="hidden" name="materi" value="<?php echo $materi;?>">
		<input type="hidden" name="nomor_materi" value="<?php echo $nomor_materi;?>">
		<input type="hidden" name="itemnilai" value="<?php echo $itemnilai;?>">
		<input type="hidden" name="jenis_deskripsi" value="<?php echo $jenis_deskripsi;?>">
*/
		echo '<input type="hidden" name="id_bulanan"  value ="'.$id_bulanan.'">';

if(empty($id_bulanan))
{
	echo '<div class="alert alert-warning">Data klasifikasi kegiatan bulanan belum ditentukan</div>';
}
else
{
	$kegiatanharian = 'menilai dan mengevaluasi proses dan hasil belajar mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
	$tb = $this->db->query("select * from `sieka_harian` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`) values ('$tahun','$nip', '$kegiatanharian', '$tanggalhariini', '$id_bulanan', '$jam_saja', '$menit_saja')");
	}
	
}
?>
		<p class="text-center"><input type="submit" value="Simpan Nilai" class="btn btn-primary"></p>
		</form>
<?php
} // bisa
else
{
	echo '<div class="alert alert-warning"><strong>Galat, silakan memeriksa cacah ulangan, cacah tugas, cacah kuis atau item penilaian</strong> <a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'" class="btn btn-info">Batal</a></div>';
}

?>
</div></div></div>
