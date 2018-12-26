<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: form_mencetak_informasi_penilaian.php
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

echo '<input type="hidden" name="yangdicetak" value="Buku Informasi Penilaian"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</p></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="semester" type="hidden" value="'.$semester.'">'.$semester.'</p></div></div>';
	}
if (!empty($mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel</label></div><div class="col-sm-9">';
			echo '<input name="mapel" type="hidden" value="'.$mapel.'">';
			echo ''.$mapel.'</p></div></div>';
	}
if (!empty($ditandatangani))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9">';
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
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9">';
	echo '<select name="ditandatangani" class="form-control">';
	echo '<option value="ya">ya</option>';
	echo '<option value="tidak">tidak</option>';
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}
elseif (empty($mapel))
{
	$tmapel = $this->db->query("select distinct mapel from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel</label></div><div class="col-sm-9">';
	echo '<select name="mapel" class="form-control">';
	foreach($tmapel->result_array() as $dm)
		{
		echo '<option value="'.$dm['mapel'].'">'.$dm['mapel'].'</option>';
		}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak Informasi Penilaian" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}
?>
</form>
</div></div></div>
