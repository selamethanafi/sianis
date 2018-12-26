<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_hasil_mid.php
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
<?php echo form_open('pdf_report/mid','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo "<option value=''></option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">

	<?php
	echo "<option value='".$kelas."'>".$kelas."</option>";
	foreach($daftar_kelas->result_array() as $ka)
	{
	echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
	}
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala?</label></div><div class="col-sm-9">
	<select name="ditandatangani" class="form-control">

	<?php
	echo "<option value='Y'>Ya</option>";
	echo "<option value=''>Tidak</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kurikulum</label></div><div class="col-sm-9">
	<select name="kurikulum" class="form-control">

	<?php
	echo "<option value='2013'>2013</option>";
	echo "<option value=''>KTSP</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">No Urut Siswa</label></div><div class="col-sm-9">
	<select name="urutan" class="form-control">
	<?php
	echo "<option value='0'>1 - 5</option>";
	echo "<option value='5'>6 - 10</option>";
	echo "<option value='10'>11 - 15</option>";
	echo "<option value='15'>16 - 20</option>";
	echo "<option value='20'>21 - 25</option>";
	echo "<option value='25'>26 - 30</option>";
	echo "<option value='30'>31 - 35</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label></div><div class="col-sm-9"><input type="submit" value="Proses" class="btn btn-primary"></div></div>
</div></div></form>
</div>
