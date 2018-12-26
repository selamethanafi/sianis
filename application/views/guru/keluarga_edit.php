<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : keluarga_edit.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/keluarga" class="btn btn-info"><b>Batal </b></a></p>
<?php echo form_open('guru/updatedatakeluarga','class="form-horizontal" role="form"');
foreach($query->result() as $t)
	{
	echo '
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><p class="form-control-static">'.$nip.'</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nama" value="'.$t->nama.'" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><input type="text" name="tempat" value="'.$t->tempat.'" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal lahir</label></div><div class="col-sm-3"><select name="harilahir" class="form-control">';
	$postedhari=substr($t->tanggallahir,8,2);
	$postedbulan=substr($t->tanggallahir,5,2);
	$postedtahun=substr($t->tanggallahir,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanlahir" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunlahir" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
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
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Kelamin</label></div><div class="col-sm-9"><select name="jenkel" class="form-control">';
		if ($t->jenkel=='')
			{echo '<option value="Pr">Perempuan</option><option value="Lk">Laki - laki</option>';}

		if ($t->jenkel=='Pr')
			{echo '<option value="Pr">Perempuan</option><option value="Lk">Laki - laki</option>';}
		if ($t->jenkel=='Lk')
			{echo '<option value="Lk">Laki - laki</option><option value="Pr">Perempuan</option>';}	

		echo '</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hubungan</label></div><div class="col-sm-9"><select name="hubungan" class="form-control">
                <option value="'.$t->hubungan.'">'.$t->hubungan.'</option>
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
		</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Menikah</label></div><div class="col-sm-3"><select name="harinikah" class="form-control">';
	$postedhari=substr($t->tanggal_nikah,8,2);
	$postedbulan=substr($t->tanggal_nikah,5,2);
	$postedtahun=substr($t->tanggal_nikah,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';

	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulannikah" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunnikah" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';
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

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Pisah</label></div><div class="col-sm-3"><select name="haripisah" class="form-control">';
	$postedhari=substr($t->tanggal_pisah,8,2);
	$postedbulan=substr($t->tanggal_pisah,5,2);
	$postedtahun=substr($t->tanggal_pisah,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';

	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanpisah" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunpisah" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';
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
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pekerjaan</label></div><div class="col-sm-9"><input type="text" name="pekerjaan" value="'.$t->pekerjaan.'" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><input type="text" name="keterangan" value="'.$t->keterangan.'" class="form-control"></div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="urut" value="'.$t->urut.'" class="form-control"></div></div>';
	}
?>
<input type="hidden" name="id" value="<?php echo $id;?>">
<p class="text-center"><input type="submit" value="Perbarui Data" class="btn btn-primary"></p>
</form>
</div></div></div>
