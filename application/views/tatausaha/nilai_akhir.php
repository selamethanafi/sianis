<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: nilai_akhir.php
// Lokasi      		: application/views/tatausaha
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php echo form_open('tatausaha/nilaiakhir','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="panel-body">
<?php
if ((empty($thnajaran)) or (empty($kelas)))
	{
	echo '<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">	
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
		{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">';
	$ta = $this->db->query("select * from m_ruang where ruang like 'XII-%' order by ruang");
	echo "<option value=''></option>";
	foreach($ta->result() as $a)
		{
		echo "<option value='".$a->ruang."'>".$a->ruang."</option>";
		}
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cetak / Nomor Urut</label></div><div class="col-sm-9"><select name="cacah" class="form-control">';
	echo "<option value=''>Semua</option>";
	echo "<option value='1'>1-5</option>";
	echo "<option value='2'>6-10</option>
<option value='3'>11-15</option>
<option value='4'>16-20</option>
<option value='5'>21-25</option>
<option value='6'>26-30</option>
<option value='7'>31-35</option>
<option value='8'>36-40</option>
<option value='9'>1-10</option>
<option value='10'>11-20</option>
<option value='11'>21-30</option>
<option value='12'>31-40</option></select></div></div>";
	echo '<p class="text-center"><input type="submit" value="Unduh" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'tatausaha/nilaiakhir" class="btn btn-info"><b>Batal</b></a></p>';
	}
?>
</div>
</form></div></div>
</div>
