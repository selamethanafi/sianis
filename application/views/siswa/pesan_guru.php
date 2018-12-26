<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: pesan_guru.php
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
<?php echo form_open('siswa/pesanguru','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pengirim</label></div><div class="col-sm-9"><input type="text" name="username" readonly="readonly" value="<?php echo $namasiswa; ?>" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kirim ke</label></div><div class="col-sm-9"><select name="tujuan" class="form-control" required>
<?php
	echo "<option value=''>Pilih guru</option>";
foreach($daftar->result_array() as $dsn)
{
	if(empty($dsn["nama_tanpa_gelar"]))
	{
		echo "<option value='".$dsn["kode"]."'>".$dsn["kode"]."</option>";
	}
	else
	{
		echo "<option value='".$dsn["kode"]."'>".$dsn["nama_tanpa_gelar"]."</option>";
	}

}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Subjek Pesan (wajib diisi)</label></div><div class="col-sm-9"><input type="text" name="subjek" class="form-control" required><input type="hidden" value="<?php echo $nim; ?>" name="nim"><input type="hidden" value="kirim" name="proses"></div></div>
<?php
{
echo'<div class="form-group row"><div class="col-sm-12"><label class="control-label">Isi Pesan</label></div></div>
<div class="form-group row"><div class="col-sm-12"><textarea name="pesan" rows="3" class="form-control"></textarea></div></div>';
echo'<p class="text-center"><input type="submit" value="Kirim Pesan" class="btn btn-primary"> <a href="'.base_url().'siswa/pesanguru" class="btn btn-info">Batal</a></p>';
}
?>
</form>
</div></div></div>
