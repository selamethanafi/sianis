<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:58:42 WIB 
// Nama Berkas 		: pkg_index.php
// Lokasi      		: application/views/guru/
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
$tahun = $tahunpenilaian;
$namapenilai = '';
$nippenilai = '';
$tanggal = '';
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahun;?></h3></div>
<div class="card-body">
<?php echo $alert;
$tx = $this->db->query("select * from p_pegawai where `kd`='$kodeguru'");
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
$tf = $this->db->query("select * from `pkg_tim_penilai` where `kode_ternilai` = '$nim' and `tahun`='$tahun'");
foreach($tf->result() as $f)
{
	$nippenilai = $f->kode_penilai;
	$namapenilai = $f->nama_penilai;
	$tanggal = $f->tanggal;
}
echo '<h4>Data Penilai PKG</h4>';
echo '<table width="100%"><tr><td>Nama</td><td>: '.$namapenilai.'</td></tr><tr><td>NIP Penilai</td><td>: '.$nippenilai.' <a href="'.base_url().'pkg/penilai">Ubah Penilai</a></td></tr><tr><td>Tanggal PKG</td><td>: '.date_to_long_string($tanggal).' <a href="'.base_url().'pkg/penilai">Ubah Tanggal</a></td></tr>';

echo '</table>';
if($gurubk == 1)
{
	echo '<h4>Daftar Kompetensi Guru BK</h4>';
	$totalskorpkg = 68;
}
else
{
	echo '<h4>Daftar Kompetensi Guru</h4>';
	$totalskorpkg = 56;
}
?>

<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td>Nomor</td><td>Kompetensi</td><td>Skor</td><td>Langsung</td>
<?php
if($gurubk == 0)
{
	echo '<td>Rinci</td>';
}
echo '</tr>';
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
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$tahun'");

		foreach($tc->result() as $c)
		{
			$nskor = $nskor + $c->skor;
		}
		$cacah_indikator++;
	}
	$skormaks = 2 * $cacah_indikator;
	$persentase = $nskor / $skormaks * 100;
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
	echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->kompetensi.'</td><td align="center">'.$nilai.'</td>';
	if($status_pkg == '1')
	{
		if($gurubk == 0)
		{
			echo '<td></td><td></td></tr>';
		}
		else
		{
			echo '<td></td></tr>';
		}

	}
	else
	{
		echo '<td align="center"><a href="'.base_url().'pkg/entry/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-bullseye"></span></a></td>';
		if($gurubk == 0)
		{
			echo '<td align="center"><a href="'.base_url().'pkg/proses/'.$a->id_pkg_m_kompetensi.'"><span class="fa fa-bullseye"></span></a></td>';
		}
		echo '</tr>';
	}
	$nomor++;
}
$jskore = $jskor / $totalskorpkg * 100;
$sebutan = '<div class="alert alert-danger">Buruk</div>';
if ($jskore > 76)
	{
	$sebutan = '<div class="alert alert-success">Baik</div>';
	}
if ($jskore == 76)
	{
	$sebutan = '<div class="alert alert-success">Baik</div>';
	}
if ($jskore == 91)
	{
	$sebutan = '<div class="alert alert-success">Amat Baik</div>';
	}

if ($jskore > 91)
	{
	$sebutan = '<div class="alert alert-success">Amat Baik</div>';
	}

echo '<tr><td colspan="2">Jumlah Skor</td><td align="center">'.$jskor.'</td><td colspan="2">'.$sebutan.'</tr></table>';
if($gurubk == 1)
{
	echo '<h4><a href="'.base_url().'pkg/rekap">Rekapitulasi Hasil Penilaian Kinerja Guru BK</a></h4>';
}
else
{
	echo '<h4><a href="'.base_url().'pkg/rekap">Rekapitulasi Hasil Penilaian Kinerja Guru Kelas/Mata Pelajaran
 </a></h4>';
}

	echo '<h4><a href="'.base_url().'pkg/angkakredit">Perhitungan Angka Kredit</a><h4>';
if($gurubk == 0)
{
?>
<h3>Tugas Tambahan</h3>
<?php
	echo '<h4><a href="'.base_url().'pkg/tambahan">Tugas Tambahan</a></h4>';
}
if($status_pkg != '1')
{
	echo '<p class="text-center"><a href="'.base_url().'pkg/permanenpkg" class="btn btn-primary">PERMANENKAN PKG</a></p>';
}
else
{
	echo '<p class="text-center">';
	?><a href="javascript:;"  onClick="window.open('<?php echo base_url();?>pdf_report/pkg/<?php echo $tahunpenilaian.'/'.$kodeguru.'';?>','yes','scrollbars=yes,width=550,height=400')" class="btn btn-success"><strong>Cetak Hasil PKG</strong></a> 
	<?php
	echo '<a href="'.base_url().'pkg/permanenpkg/batal" class="btn btn-primary">BATAL PERMANEN PKG</a></p>';
}
$nilaipkg = round($jskore,0);
$this->db->query("update `ppk_pns` set `pkg`='$nilaipkg' where `tahun`='$tahun' and `kode`='$kodeguru'");
echo $nilaipkg;
?>

</div></div></div>
