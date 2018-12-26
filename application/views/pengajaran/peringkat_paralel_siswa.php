<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 05:05:06 WIB 
// Nama Berkas 		: peringkat_paralel_siswa.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
if(($jenjang == 'MA/SMA') or ($jenjang == 'MTs/SMP') or ($jenjang == 'MI/SD'))
{

$tahun1 = substr($thnajaran,0,4);
$p1 = '';
$p2 = '';
$p3 = '';
$p4 = '';
if(empty($tahun1))
{
	$p1 = 'Pilih ';
}
if(empty($semester))
{
	$p2 = 'Pilih ';
}
if(empty($tingkat))
{
	$p3 = 'Pilih ';
}
if(empty($id_jurusan))
{
	$p4 = 'Pilih ';
}
$xloc = base_url().$tautan.'/peringkatparalel';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"><?php echo $p1;?> Tahun Pelajaran</label></div><div class="col-sm-9">
<?php
echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result() as $k)
{
	echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"><?php echo $p2;?> Semester</label></div><div class="col-sm-9">
<?php
echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"><?php echo $p3;?> Tingkat</label></div><div class="col-sm-9">
<?php 
echo "<select name=\"tingkat\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$tingkat.'">'.$tingkat.'</option>';
		if($jenjang == 'MA/SMA')
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/X">X</option><option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/XI">XI</option><option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/XII">XII</option>';
		}
		
		if($jenjang == 'MTs/SMP')
		{
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/VII">VII</option><option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/VIII">VIII</option><option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/IX">IX</option>';
		}
		if($jenjang == 'MI/SD')
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/I">I</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/II">II</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/III">III</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/IV">IV</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/V">V</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/VI">VI</option>';

		}

?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"><?php echo $p4;?> Jurusan</label></div><div class="col-sm-9">
<?php 
$jurusan = '';
$ta = $this->db->query("select * from `m_program` where `id` = '$id_jurusan'");
foreach($ta->result() as $a)
{
	$jurusan = $a->program;
}
echo "<select name=\"id_jurusan\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$tingkat.'/'.$id_jurusan.'">'.$jurusan.'</option>';
$ta = $this->db->query("select * from `m_program` order by `program`");
foreach($ta->result() as $a)
{
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$tingkat.'/'.$a->id.'">'.$a->program.'</option>';
}
?>
</select></div></div>
</form>
<?php
}
else
{
	echo '<div class="alert alert-danger">Peringatan: Jenjang sekolah tidak didukung, jenjang yang didukung, MI/SD, MTs/SMP, atau MA/SMA, silakan ubah jenjang lewat akun admin, menu Situs Web -&gt; Pengaturan</div>';

}
?>
</div></div></div>
