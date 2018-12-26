<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mendaftar_ekstra.php
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
<?php echo form_open('siswa/mendaftarekstra','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="thnajaran" readonly="readonly" value="<?php echo $thnajaran; ?>" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><input type="text" name="semester" readonly="readonly" value="<?php echo $semester; ?>" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div><div class="col-sm-9"><select name="nama_ekstra" class="form-control">
	<?php
	echo "<option value=''></option>";
	foreach($daftar_nama_ekstra_wajib->result_array() as $dsn)
	{
		echo "<option value='".$dsn["namaekstra"]."'>".$dsn["namaekstra"]."</option>";
	}
	?>
	</select></div></div>
<p class="text-center"><input type="submit" value="Daftar" class="btn btn-primary"></p>
</form>
</div></div></div>
