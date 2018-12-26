<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: ekstrakurikuler.php
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
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('guru/ekstrakurikuler' ,'class="form-horizontal" role="form"');
	if ((!empty($thnajaran)) or (!empty($semester)))
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
			<select name="thnajaran" class="form-control">';
			echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
			echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
			<select name="semester" class="form-control">';
			echo "<option value='".$semester."'>".$semester."</option>";
			echo "<option value='1'>1</option><option value='2'>2</option>";
			echo '</select></div></div>';
	}
if (!empty($id_pengampu_ekstra))
	{
	$tpengampu1 = $this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra = '$id_pengampu_ekstra'");
	foreach($tpengampu1->result() as $dp1)
		{
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div><div class="col-sm-9"><input name="id_pengampu_ekstra" type="hidden" value="'.$id_pengampu_ekstra.'"><input name="namaekstra" type="hidden" value="'.$dp1->namaekstra.'">'.$dp1->namaekstra.' kelas '.$dp1->kelas.'</div></div>';
		}
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
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option><option value='2'>2</option>";
	echo '</select></div></div>';
	}

elseif (empty($id_pengampu_ekstra))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div><div class="col-sm-9">';
	$tpengampu = $this->db->query("select * from m_pengampu_ekstra where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru'");

	echo '<select name="id_pengampu_ekstra" class="form-control">';
	echo '<option value=""></option>';
	foreach($tpengampu->result() as $dp)
		{
		echo '<option value="'.$dp->id_pengampu_ekstra.'">'.$dp->namaekstra.'</option>';
		}
	echo '</select></div></div>';
	}
else
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="id_ruang" class="form-control">';
	echo "<option value='".$kelase."'>".$kelase."</option>";
	echo "<option value='semua'>semua</option>";
	$tkel = $this->db->query("select * from m_ruang order by ruang ");
	foreach($tkel->result() as $dk)
		{
		echo "<option value='".$dk->id_ruang."'>".$dk->ruang."</option>";
		}
	echo '</select></div></div>';
	}
?>

<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary" role="button"> <a href="<?php echo base_url(); ?>guru/ekstrakurikuler/" class="btn btn-info"><b>Kelas Lain</b></a></p>
</form>
<?php
if (!empty($kelase))
{


}
?>
</div></div></div>
