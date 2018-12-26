<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:58:42 WIB 
// Nama Berkas 		: rata_pkg.php
// Lokasi      		: application/views/tatausaha/
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
<?php
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahun;?></h3></div>
<div class="card-body">
<?php 
$tg =$this->db->query("select * from `ppk_pns` where `tahun`='$tahun' and `kode` !=''");
$cacah = $tg->num_rows();
$total_nilai_pkg = 0;
$nomor_guru = 1;
echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">';
foreach($tg->result() as $g)
{
	$nippegawai = $g->kode;
	$tx = $this->db->query("select * from p_pegawai where `nip`='$nippegawai'");
	foreach($tx->result() as $x)
	{
		$nama_pegawai = $x->nama;
	}

$gurubk = 0;
$jskore2 = 0;
$tc = $this->db->query("select * from `gurubk` where `nip` = '$nippegawai'");
if($tc->num_rows()>0)
{
	$gurubk = 1;
}
echo '<tr><td>'.$nomor_guru.'</td><td>'.$nama_pegawai.' '.$nippegawai.'</td>';
if($gurubk == 1)
{
	$totalskorpkg = 68;
}
else
{
	$totalskorpkg = 56;
}
?>
<?php
if($gurubk == 0)
{
}
$nomor =1;
if($gurubk == 1)
{
	$ta = $this->db->query("select * from pkg_m_kompetensi where untuk='bk' order by nourut");
}
else
{
	$ta = $this->db->query("select * from pkg_m_kompetensi where untuk='guru' order by nourut");
}

$jskor = 0;
foreach($ta->result() as $a)
{
	$skor = 0;
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
	{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `nip`='$nippegawai' and `tahun`='$tahun'");

		foreach($tc->result() as $c)
		{
			$nskor = $nskor + $c->skor;
		}
		$cacah_indikator++;
	}
	$skormaks = 2 * $cacah_indikator;
	if($skormaks > 0)
	{
		$persentase = $nskor / $skormaks * 100;
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
	$jskor = $jskor + $nilai;
	$nomor++;
}
$jskore = $jskor / $totalskorpkg * 100;
$sebutan = '<div class="alert alert-danger">Buruk</div>';
if ($jskore > 76)
	{
	$sebutan = 'Baik';
	}
if ($jskore == 76)
	{
	$sebutan = 'Baik';
	}
if ($jskore == 91)
	{
	$sebutan = 'Amat Baik';
	}

if ($jskore > 91)
	{
	$sebutan = 'Amat Baik';
	}
$total_nilai_pkg = $total_nilai_pkg + $jskor;
echo '<td align="center">'.$jskor.'</td><td>'.$sebutan.'</td></tr>';
$nomor_guru++;
}
echo '</table></div>';
$rata_pkg = $total_nilai_pkg / $cacah;
$rata_pkg = round($rata_pkg,2);
echo $rata_pkg;
?>

</div></div></div>
