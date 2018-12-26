<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rekap_kelas.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Rab 01 Jul 2015 11:18:33 WIB 
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
<?php echo form_open('bp/rekapkelas','class="form-horizontal" role="form"');?>
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
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
	echo '<option value="'.$semester.'">'.$semester.'</option>';
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
	<p class="text-center"><button type="submit" class="btn btn-primary">TAMPILKAN DATA</button></p>
</div></div></form>

</div>
