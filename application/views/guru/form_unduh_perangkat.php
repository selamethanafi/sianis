<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_unduh_perangkat.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$yangdiunduh = '';
if($item == 1)
{
	$yangdiunduh='Analisis Ulangan</option>';
}
if($item == 2)
{
	$yangdiunduh='Buku Informasi Penilaian</option>';
}
if($item == 3)
{
	$yangdiunduh='Buku Pelaksanaan Harian</option>';
}
if($item == 4)
{
	$yangdiunduh='Buku Tugas</option>';
}
if($item == 5)
{
	$yangdiunduh='Daftar Buku Pegangan</option>';
}
if($item == 6)
{
	$yangdiunduh='Daftar Hadir Siswa</option>';
}
if($item == 7)
{
	$yangdiunduh='Daftar Nilai Akhlak</option>';
}
if($item == 8)
{
	$yangdiunduh='Daftar Nilai Kognitif</option>';
}
if($item == 9)
{
	$yangdiunduh='Hambatan Belajar Siswa</option>';
}
if($item == 10)
{
	$yangdiunduh='Jurnal Piket</option>';
}
if($item == 11)
{
	$yangdiunduh='Program Kerja Kepala Laboratorium</option>';
}
if($item == 12)
{
	$yangdiunduh='Program Harian Kepala Laboratorium</option>';
}
if($item == 13)
{
	$yangdiunduh='Rencana Pelaksanaan Harian</option>';
}
if($item == 14)
{
	$yangdiunduh='Rencana Pelaksanaan Pembelajaran</option>';
}
$xloc = base_url().'unggah/unduhperangkat';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($item))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat" title="ganti perangkat">Perangkat hendak diunduh</a></label></div><div class="col-sm-9">';
	?>
	<select name="item" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$item.'">'.$yangdiunduh.'</option>';
	echo '</select></div></div>';
}
if(!empty($tahun1))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat/'.$item.'" title="ganti tahun">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	?>
	<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$item.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
}
if(!empty($semester))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat/'.$item.'/'.$tahun1.'" title="ganti tahun">Semester</a></label></div><div class="col-sm-9">';
	?>
	<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$item.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '</select></div></div>';
}
if(!empty($id_mapel))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat/'.$item.'/'.$tahun1.'/'.$semester.'" title="ganti tahun">Mata Pelajaran Kelas</a></label></div><div class="col-sm-9">';
	$tb = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	?>
	<select name="id_mapel" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$xloc.'/'.$item.'/'.$tahun1.'/'.$semester.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select></div></div>';
}

if(empty($item))
{
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Perangkat hendak diunduh</label></div><div class="col-sm-9">';
	?>
	<select name="item" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$item.'">'.$yangdiunduh.'</option>';
	echo '<option value="'.$xloc.'/1">Analisis Ulangan</option>';
	echo '<option value="'.$xloc.'/2">Buku Informasi Penilaian</option>';
	echo '<option value="'.$xloc.'/3">Buku Pelaksanaan Harian</option>';
	echo '<option value="'.$xloc.'/4">Buku Tugas</option>';
	echo '<option value="'.$xloc.'/5">Daftar Buku Pegangan</option>';
	echo '<option value="'.$xloc.'/6">Daftar Hadir Siswa</option>';
	echo '<option value="'.$xloc.'/7">Daftar Nilai Akhlak</option>';
	echo '<option value="'.$xloc.'/8">Daftar Nilai Kognitif</option>';
	echo '<option value="'.$xloc.'/9">Hambatan Belajar Siswa</option>';
	echo '<option value="'.$xloc.'/10">Jurnal Piket</option>';
	echo '<option value="'.$xloc.'/11">Program Kerja Kepala Laboratorium</option>';
	echo '<option value="'.$xloc.'/12">Program Harian Kepala Laboratorium</option>';
	echo '<option value="'.$xloc.'/13">Rencana Pelaksanaan Harian</option>';
	echo '<option value="'.$xloc.'/14">Rencana Pelaksanaan Pembelajaran</option>';

	echo '</select></div></div>';
}
elseif(empty($tahun1))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat/'.$item.'" title="ganti tahun">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	?>
	<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$item.'"></option>';
	foreach($daftar_tapel->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$item.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($semester))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat/'.$item.'/'.$tahun1.'" title="ganti tahun">Semester</a></label></div><div class="col-sm-9">';
	?>
	<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.$item.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$item.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}
elseif(empty($id_mapel))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'unggah/unduhperangkat/'.$item.'/'.$tahun1.'/'.$semester.'" title="ganti tahun">Mata Pelajaran Kelas</a></label></div><div class="col-sm-9">';
	$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' order by `mapel`,`kelas`");
	?>
	<select name="item" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value=""></option>';
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$xloc.'/'.$item.'/'.$tahun1.'/'.$semester.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select></div></div>';
}
else
{

}
?>
</form>
</div></div></div>
