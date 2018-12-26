<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: hambatan.php
// Lokasi      		: application/views/siswa/
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
<?php echo form_open('siswa/hambatan','class="form-horizontal" role="form"');
//echo 'mapel '.$mapel;
if (empty($mapel))
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
<select name="mapel" class="form-control">
<?php
foreach($tabel_mapel->result_array() as $k)
{
echo "<option value='".$k["mapel"]."'>".$k["mapel"]."</option>";
}
?>
</select>
</div></div>
<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary"></p>
<?php
}
else
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
<select name="mapel" class="form-control">
<?php
echo "<option value='".$mapel."'>".$mapel."</option>";
?>
</select>
</div></div>
<div class="form-group row"><div class="col-sm-12"><label class="control-label">Hambatan</label></div></div>
<div class="form-group row"><div class="col-sm-12"><textarea name="hambatan" cols="65" rows="15" class="textfield"><?php echo $hambatan;?></textarea></div></div>
<p class="text-center"><input type="submit" value="Simpan Hambatan" class="btn btn-primary"></p>
<?php
}?>
</form>
<br>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Mapel</strong></td><td><strong>Hambatan</strong></td></div></div>
<?php
$nomor=1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td>".$t->mapel."</td><td>".get_emoticons($t->hambatan)."</td></tr>";
$nomor++;	
}
}
?>
</table></div>
</div></div></div>
