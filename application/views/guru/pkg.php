<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pkg.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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

$adaid = 0;
$tx = $this->db->query("select * from p_pegawai where `kd`='$nim'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
}
$gurubk = 0;
$tc = $this->db->query("select * from `gurubk` where `nip` = '$nippegawai'");
if($tc->num_rows()>0)
{
	$gurubk = 1;
}
if($gurubk == 1)
{
	echo '<div class="container-fluid"><h3>Modul Penilaian Kinerja Guru BK</h3>';
	echo '<p><a href="'.base_url().'pkg" class="btn btn-primary"><b>Kembali ke Daftar Kompetensi Guru BK</b></a>';
}
else
{
	echo '<div class="container-fluid"><h3>Modul Penilaian Kinerja Guru</h3>';
	echo '<p><a href="'.base_url().'pkg" class="btn btn-primary"><b>Kembali ke Daftar Kompetensi Guru</b></a>';
}
if($gurubk == 1)
{
	if(($id > 57) and ($id < 75))
	{
		$adaid = 1;
	}
	if(($id > 57) and ($id < 74))
	{
		$id2 = $id + 1;
	?>
	 <a href="<?php echo base_url(); ?>pkg/entry/<?php echo $id2; ?>" class="btn btn-primary"><b>Kompetensi Selanjutnya</b></a> 
	<?php
	}

}
else
{
	if(($id > 0) and ($id < 15))
	{
		$adaid= 1;
	}
	if(($id > 0) and ($id < 14))
	{
		$id2 = $id + 1;
		$adaid= 1;
	?>
	 <a href="<?php echo base_url(); ?>pkg/entry/<?php echo $id2; ?>" class="btn btn-primary"><b>Kompetensi Selanjutnya</b></a> 
	<?php
	}
}
echo '</p>';
$tahun = $tahunpenilaian;
	//2014 JADI 2014/2015 SMT 1
	$awal = $tahunpenilaian;
	$akhir = $tahunpenilaian+1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;
$tahunkemarin = $tahun - 1;
if ($adaid == 1)
{
	//perbarui daftar dahulu
//	$this->db->query("DELETE FROM `pkg_t_nilai` WHERE `tahun`='2018'");
	$ta = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id' order by nourut");
	foreach($ta->result() as $a)
	{
		$id_indikator = $a->id_pkg_m_indikator;
		//cari di nilai guru
		$tb = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
		$tbkemarin = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahunkemarin'");
		$skorkemarin = 0;
		foreach($tbkemarin->result() as $bkemarin)
		{
			$skorkemarin = $bkemarin->skor;
		}
		if(count($tb->result())==0)
		{
			$this->db->query("insert into pkg_t_nilai (`id_indikator`,`skor`,`nip`,`tahun`) values ('$id_indikator','$skorkemarin', '$nippegawai','$tahun')");
			}
	}
$kompetensi = id_ke_kompetensi_guru($id);
echo '<h2>Tahun '.$tahun.'</h2>';
echo form_open('pkg/updateskorpkg','class="form-horizontal" role="form"');?>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Indikator</strong></td><td><strong>Skor <?php echo $tahunkemarin;?></strong></td><td><strong>Skor</strong></td><td><strong>Ubah Skor</strong></td></tr>

<?php

$ta = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id' order by nourut");
$nomor = 1;
$jskor = 0;
foreach($ta->result() as $a)
	{
	$id_indikator = $a->id_pkg_m_indikator;

	$tckemarin = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahunkemarin'");
	$skorekemarin = 0;
	foreach($tckemarin->result() as $ckemarin)
		{
		$skorekemarin = $ckemarin->skor;
		}
	echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->indikator.'</td><td align="center">'.$skorekemarin.'</td><td align="center">';
	//cari nilai

	$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
	foreach($tc->result() as $c)
		{
		$skore = $c->skor;
		$id_pkg_t_nilai = $c->id_pkg_t_nilai;
		}
	echo ''.$skore.'</td><td>';
	echo '<select name="skor_'.$nomor.'" class="form-control">';
	if ($skore == 1)
		{
		$skorh = 'Terpenuhi sebagian';
		echo '<option value="'.$skore.'">'.$skorh.'</option>';
		echo '<option value="0">tidak ada bukti (tidak terpenuhi)</option>';
		echo '<option value="2">Seluruhnya terpenuhi</option></select>';

		}
	elseif ($skore == 2)
		{
		$skorh = 'Seluruhnya terpenuhi';
		echo '<option value="'.$skore.'">'.$skorh.'</option>';
		echo '<option value="0">tidak ada bukti (tidak terpenuhi)</option>';
		echo '<option value="1">Terpenuhi sebagian</option></select>';

		}
	else 
		{
		$skorh = 'tidak ada bukti (Tidak terpenuhi)';
		echo '<option value="'.$skore.'">'.$skorh.'</option>';
		echo '<option value="1">Terpenuhi sebagian</option>';
		echo '<option value="2">Seluruhnya terpenuhi</option></select>';

		}
	?>

	<?php
 	echo '<input type="hidden" name="id_pkg_t_nilai_'.$nomor.'"  value ='.$id_pkg_t_nilai.'>';
	echo "</td></tr>";
	$jskor = $jskor + $skore;
	$nomor++;
	}
$cacah_indikator = $nomor - 1;
$skormaks = 2 * $cacah_indikator;
if($skormaks >0)
{
	$persentase = $jskor / $skormaks * 100;
}
else
{
	$persentase = 0;
}
$nilai = 0;
if (($persentase > 0) and ($persentase<=25))
	{
	$nilai = 1;
	}
if (($persentase > 25) and ($persentase<=50))
	{
	$nilai = 2;
	}
if (($persentase > 50) and ($persentase<=75))
	{
	$nilai = 3;
	}
if ($persentase > 75)
	{
	$nilai = 4;
	}


echo '<tr><td></td><td align="center">Total skor untuk kompetensi ini</td><td align="center">'.$jskor.'</td><td></td><td>
<input type="hidden" name="cacah_indikator"  value ="'.$cacah_indikator.'">
<input type="hidden" name="id_kompetensi"  value ="'.$id.'"><p class="text-center"><input type="submit" value="Perbarui Skor" class="btn btn-primary"></p></td></tr>
<tr><td></td><td align="center">Skor maksimum kompetensi ini = jumlah indikator x 2</td><td align="center">'.$skormaks.'</td><td></td></tr>
<tr><td></td><td align="center">Persentase = (total skor/skor maksimal) x 100%</td><td align="center">'.round($persentase,2).'</td><td></td></tr>
<tr><td></td><td align="center">Nilai untuk kompetensi ini</td><td align="center">'.$nilai.'</td><td></td></tr>
<tr><td></td><td align="center">Nilai untuk kompetensi
(0% &lt; X ≤ 25% = 1; 25% &lt; X ≤ 50% = 2;
50% &lt; X ≤ 75% = 3; 75% &lt; X ≤ 100% = 4)
</td><td align="center"></td><td></td></tr></table></div></form>';
}
else
{
echo 'Galat, kode kompetensi tidak ditemukan';
}
?>
</div>
