<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: bos.php
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$xloc = base_url().''.$status.'/bos';
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
echo "<select name=\"thnajaran\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result_array() as $k)
{
	echo '<option value="'.$xloc.'/'.substr($k['thnajaran'],0,4).'">'.$k['thnajaran'].'</option>';
}
echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Formulir</label></div><div class="col-sm-9">';
echo "<select name=\"borang\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value=""></option>';
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/bos2c">BOS-2C</option>';
echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/bos02a">BOS-02A</option>';
echo '</select></div></div>';
?>
</form>

</div></div></dov>
