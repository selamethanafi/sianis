<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : form_mencetak_penilaian_diri_siswa.php
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
<?php
$namamodul = 'Penilaian Antarteman';
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo 'Mencetak '.$namamodul;?></h3></div>
<div class="card-body">
<?php echo form_open('guru/formmencetak/'.$noyangdicetak,'class="form-horizontal" role="form"');?>
<?php 
echo '<input type="hidden" name="yangdicetak" value="'.$namamodul.'"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
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
if (!empty($id_mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9"><p class="form-control-static">';
			echo '<input name="id_mapel" type="hidden" value="'.$id_mapel.'">';
			$mapel = id_mapel_jadi_mapel($id_mapel);
			$kelas = id_mapel_jadi_kelas($id_mapel);
			echo ''.$mapel.' '.$kelas.'</p></div></div>';

	}
if ((empty($thnajaran)) or (empty($semester)))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';

		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></div></div>';
	echo '<p class="text-center">';
	echo '<input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran / Kelas</label></div><div class="col-sm-9">';
	echo '<select name="id_mapel" class="form-control">';
	foreach($ta->result() as $a)
		{
		echo '<option value="'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
		}
	echo '</select></div></div>';
	echo '<p class="text-center">';
	echo '<input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak '.$namamodul.'" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}
?>
</form>
</div></div></div>
