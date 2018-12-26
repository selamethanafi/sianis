<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: keluarga_tambah.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url().''.$tautan; ?>/keluarga" class="btn btn-primary"><b>Batal / Kembali ke Data Keluarga </b></a></p>
<?php echo form_open($tautan.'/simpandatakeluarga','class="form-horizontal" role="form"');
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9">'.$nama.'</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9">'.$nip.'</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat lahir</label></div><div class="col-sm-9"><input type="text" name="tempat" class="form-control" required></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div><div class="col-sm-9">
 <select name="harilahir">';
		echo '<option value=""></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select>';
	echo '<select name="bulanlahir" >';
	echo '<option value=""></option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunlahir" >';
	echo '<option value=""></option>';	
        $th=date("Y");
        $awal_th=$th;
        $akhir_th=$th-100;
	$i = $awal_th;
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);	

	echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div><div class="col-sm-9"><select name="jenkel" >';
			echo '<option value=""></option><option value=""></option>';
			echo '<option value="Pr">Perempuan</option><option value="Lk">Laki - laki</option>';
			echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hubungan</label></div><div class="col-sm-9">
	<td><select name="hubungan" >
                <option value=""></option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Anak kandung">Anak kandung</option>
                <option value="Anak tiri">Anak tiri</option>
                <option value="Anak angkat">Anak angkat</option>
                <option value="Ayah Kandung">Ayah Kandung</option>
                <option value="Ibu Kandung">Ibu Kandung</option>
                <option value="Ayah Mertua">Ayah Mertua</option>
                <option value="Ibu Mertua">Ibu Mertua</option>
                <option value="Kakak">Kakak</option>
                <option value="Adik">Adik</option>
		</select>              </div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Menikah</label></div><div class="col-sm-9">
	<select name="harinikah">';
		echo '<option value=""></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select>';
	echo '<select name="bulannikah" >';
		echo '<option value=""></option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunnikah" >';
		echo '<option value=""></option>';
        $th=date("Y");
        $awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);	

	echo '</select></div></div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Pisah</label></div><div class="col-sm-9">
	<select name="haripisah">';
		echo '<option value=""></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select>';
	echo '<select name="bulanpisah" >';
		echo '<option value=""></option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	echo '<select name="tahunpisah" >';
		echo '<option value=""></option>';
        $th=date("Y");
        $awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);	

	echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9">
	<td><input type="text" name="pekerjaan" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9">
	<td><input type="text" name="keterangan" class="form-control"></div></div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9">
	<td><input type="text" name="urut" class="form-control"></div></div>';
?>
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
</div></div></div>
