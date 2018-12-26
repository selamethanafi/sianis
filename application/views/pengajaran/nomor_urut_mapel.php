<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_per_ruang.php
// Lokasi      		: application/views/pengajaran/
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$xloc = base_url().'pengajaran/nomorurut';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	$tahun2 = $tahun1+1;
	$thnajaran = $tahun1.'/'.$tahun2;

if(!empty($tahun1))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/leger2">Tahun Pelajaran</a></label></div>
	<div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
}
if(!empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/leger2/'.$tahun1.'">Semester</a></label></div>
	<div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'">'.$semester.'</option>';
	echo '</select></div></div>';
}

if(empty($tahun1))
{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9">';
		echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="">pilih tahun pelajaran</option>';
		foreach($daftar_tapel->result() as $k)
		{
			echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
		}
		echo '</select></div></div>';
}
elseif(empty($semester))
{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div>
		<div class="col-sm-9">';
		echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="">semester</option>';
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1">1</option>';
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2">2</option>';
		echo '</select></div></div>';
}
if((!empty($tahun1)) and (!empty($semester)))
{?>
<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>pengajaran/nomorurut/<?php echo $tahun1;?>/<?php echo $semester;?>/1';
		},100);
			</script>
<?php
}
echo '</form>';

