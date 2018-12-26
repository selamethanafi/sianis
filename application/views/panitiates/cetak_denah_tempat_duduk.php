<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: cetak_denah_tempat_duduk.php
// Lokasi      		: application/views/panitiates/
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
<?php echo form_open('pdf_kartu_tes/denahtempatduduk','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><input type="text" name="thnajaran" value="<?php echo $thnajaran;?>" class="form-control" readonly></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><input type="text" name="semester" value="<?php echo $semester;?>" class="form-control" readonly></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Tes</label></div><div class="col-sm-9">
<select name="id_nama_tes" class="form-control">
<?php
foreach($daftar_tes->result_array() as $k)
{
echo "<option value='".$k["id_nama_tes"]."'>".$k["nama_tes"]."</option>";
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ruang Tes</label></div><div class="col-sm-9">
<select name="ruang" class="form-control">

<?php

$jumlah_kelas = count($daftar_kelas->result());
	$urutan = 1;
	do
	{
		echo '<option value='.$urutan.'>'.$urutan.'</option>';
		$urutan++;
	}
	while ($urutan < $jumlah_kelas+1);
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cetak Peserta di sebelah</label></div><div class="col-sm-9">
<select name="tunggal" class="form-control">

<?php
	echo '<option value="1">Kiri</option>';
	echo '<option value="2">Kanan</option>';
	echo '<option value="3">Kiri dan Kanan</option>';
?>
</select></div></div>
<p class="text-center"><input type="submit" value="Cetak Denah" class="tombol"></p>
</form>
</div></div></div>
