<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : pkg_proses.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<?php
$tahun = $tahunpenilaian;
$tahunkemarin = $tahun - 1;
if (!empty($id))
{
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
		echo '<div class="container-fluid"><h3>Penilaian Kinerja Guru BK</h3><p><a href="'.base_url().'pkg/" class="btn btn-info"><b>Kembali ke Daftar Kompetensi</b></a></p>';
	}
	else
	{
		echo '<div class="container-fluid"><h3>Penilaian Kinerja Guru</h3><p><a href="'.base_url().'pkg/" class="btn btn-info"><b>Kembali ke Daftar Kompetensi</b></a></p>';
	}
if($gurubk == 0)
{
	if(($id<0) or ($id>57))
	{
		$id = 'aaaaa';
	}
}
else
{
	if(($id<58) or ($id>74))
	{
		$id = 'iiii';
	}
}
//perbarui daftar dahulu
$ta = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id' order by nourut");
if(count($ta->result())==0)
{
	echo 'Galat, kode parameter tidak ditemukan';
}
else
{
foreach($ta->result() as $a)
	{
	$id_indikator = $a->id_pkg_m_indikator;
/*
	$tbkemarin = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahunkemarin'");
	$nilaikemarin = 0;
	foreach($tbkemarin->result() as $bkemarin)
	{
		$nilaikemarin = $bkemarin->skor;
	}
*/
	//cari di nilai guru
//	$this->db->query("delete from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
	$tb = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
		if(count($tb->result())==0)
		{
		$this->db->query("insert into pkg_t_nilai (`id_indikator`,`nip`,`tahun`) values ('$id_indikator','$nippegawai','$tahun')");
		}
	}

$kompetensi = id_ke_kompetensi_guru($id);
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $tahun?></p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kompetensi</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kompetensi;?></p></div></div>
<div class="tabel-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>Proses</strong></td><td><strong>Indikator</strong></td><td width="100"><strong>Skor</strong></td></tr>

<?php

$ta = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id' order by nourut");
$nomor = 1;
$jskor = 0;
foreach($ta->result() as $a)
	{
	$id_indikator = $a->id_pkg_m_indikator;
	echo '<tr><td align="center"><a href="'.base_url().'pkg/proses/'.$id.'/'.$id_indikator.'"><span class="fa fa-edit"></span></a></td><td>'.$a->indikator.'</td><td align="center">';
	//cari nilai
	$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");
	foreach($tc->result() as $c)
		{
		$skore = $c->skor;
		$id_pkg_t_nilai = $c->id_pkg_t_nilai;
		}
	echo ''.$skore.'</td></tr>';
	$jskor = $jskor + $skore;
	$nomor++;
	}
$cacah_indikator = $nomor - 1;
$skormaks = 2 * $cacah_indikator;
$persentase = $jskor / $skormaks * 100;
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


echo '<tr><td></td><td align="center">Total skor untuk kompetensi ini</td><td align="center">'.$jskor.'</td></tr>
<tr><td></td><td align="center">Skor maksimum kompetensi ini = jumlah indikator x 2</td><td align="center">'.$skormaks.'</td></tr>
<tr><td></td><td align="center">Persentase = (total skor/skor maksimal) x 100%</td><td align="center">'.round($persentase,2).' %</td></tr>
<tr><td></td><td align="center">Nilai untuk kompetensi ini</td><td align="center">'.$nilai.'</td></tr>
<tr><td></td><td align="center">Nilai untuk kompetensi
(0% &lt; X ≤ 25% = 1; 25% &lt; X ≤ 50% = 2;
50% &lt; X ≤ 75% = 3; 75% &lt; X ≤ 100% = 4)
</td></tr></table></div>';
}
}
else
{
echo 'Galat, kode kompetensi tidak ditemukan';
}
?>
</div>

