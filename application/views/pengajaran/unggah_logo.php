<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 28 Apr 2016 08:32:13 WIB 
// Nama Berkas 		: unggah_logo.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php
if(!empty($galat))
{
	echo '<div class="alert alert-warning">'.$galat.'</div>';
}
$lebar_logo = 8;
$tinggi_logo = 8;
$y_logo = 10;
$pilihan = '';
$te = $this->db->query("select * from `m_logo` limit 0,1");
foreach($te->result() as $e)
	{
	$lebar_logo = $e->lebar;
	$tinggi_logo = $e->tinggi;
	$y_logo = $e->posisi_y;
	$pilihan = $e->pilihan;
	$ttd = $e->ttd;
	}
echo form_open_multipart('pengajaran/unggahlogolck','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Posisi dari Tepi Atas</label></div><div class="col-sm-9">
	<input type="text" name="posisi_y" class="form-control" value="<?php echo $y_logo;?>"><p class="help-block"> cm (gambar sebagai siluet)</p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lebar gambar</label></div><div class="col-sm-9">
	<input type="text" name="lebar" class="form-control" value="<?php echo $lebar_logo;?>"><p class="help-block"> cm (gambar sebagai siluet)</p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tinggi gambar</label></div><div class="col-sm-9">
	<input type="text" name="tinggi" class="form-control" value="<?php echo $tinggi_logo;?>"><p class="help-block"> cm (gambar sebagai siluet)</p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gunakan gambar sebagai</label></div><div class="col-sm-9">
<select name ="pilihan" class="form-control">
<?php
if($pilihan == '1')
	{
	echo '<option value="1">Latar</option>';
	echo '<option value="2">Siluet</option>';
	echo '<option value="">Tidak digunakan</option>';
	}
elseif($pilihan == '2')
	{
	echo '<option value="2">Siluet</option>';
	echo '<option value="1">Latar</option>';
	echo '<option value="">Tidak digunakan</option>';
	}

else
	{
	echo '<option value="">Tidak digunakan</option>';
	echo '<option value="1">Latar</option>';
	echo '<option value="2">Siluet</option>';
	}

?>
<select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Rapor ditandatangani kepala</label></div><div class="col-sm-9">
<select name ="ttd" class="form-control">
<?php
if($ttd == '1')
	{
	echo '<option value="1">Ya</option>';
	echo '<option value="0">Tidak</option>';
	}
else
	{
	echo '<option value="0">Tidak</option>';
	echo '<option value="1">Ya</option>';
	}

?>
<select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Logo</label></div><div class="col-sm-9"><input type="file" name="userfile"><p class="help-block"><strong>harus dengan format JPG</strong></p></div></div></table>
<input type="hidden" name="upload" value="upload">
<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan &amp; Unggah Gambar</button></p>
</div></div></form>
<p><a href="<?php echo base_url();?>pengajaran/unggahlogolck" class="btn btn-info">Muat Ulang Gambar bila belum berubah</a></p>
<img src="<?php echo base_url().'images/latar.jpg';?>" width="800" alt="logo atau latar lck">
</div>
