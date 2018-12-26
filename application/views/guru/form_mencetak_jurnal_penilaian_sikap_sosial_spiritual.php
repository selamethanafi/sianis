<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_mencetak_bph.php
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
<?php echo form_open('guru/formmencetak/'.$noyangdicetak,'class="form-horizontal" role="form"');?>
<?php 
echo '<input type="hidden" name="yangdicetak" value="'.$yangdicetak.'"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<table>
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</p></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="semester" type="hidden" value="'.$semester.'">'.$semester.'</p></div></div>';
	}
if (!empty($ditandatangani))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9"><p class="form-control-static">';
			echo '<input name="ditandatangani" type="hidden" value="'.$ditandatangani.'">';
			echo ''.$ditandatangani.'</p></div></div>';
	}
if ((empty($thnajaran)) or (empty($semester)) or (empty($ditandatangani)))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="semester" class="form-control">';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9"><p class="form-control-static">';
	echo '<select name="ditandatangani" class="form-control">';
	echo '<option value="ya">ya</option>';
	echo '<option value="tidak">tidak</option>';
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak Jurnal" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}
?>
</table>
</form>
</div></div></div>
