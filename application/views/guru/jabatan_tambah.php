<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : jabatan_tambah.php
// Lokasi      : application/views/guru
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
<p><a href="<?php echo base_url(); ?>guru/jabatan" class="btn btn-info"><b>Batal </b></a></p>
<?php echo form_open('guru/simpandatajabatan','class="form-horizontal" role="form"');
echo '
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><p class="form-control-static">'.$nip.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jabatan / Pekerjaan</label></div><div class="col-sm-9"><input type="text" size="25" name="nama_jabatan" placaeholder="nama jabatan" class="form-control" required ></div></div>

	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal menjabat</label></div><div class="col-sm-3">';
	echo '<select name="hariawal" class="form-control" >';
		echo '<option value=""></option>';
	for($i=0;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanawal" class="form-control" >';
		echo '<option value=""></option>';
        for($i=0;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunawal" class="form-control" >';
        $th=date("Y");
        $awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
       	echo '<option value=""></option>';
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Menjabat s.d.</label></div>
<div class="col-sm-3">';
	echo '<select name="hariakhir" class="form-control" >';
		echo '<option value=""></option>';
	for($i=0;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanakhir" class="form-control" >';
		echo '<option value=""></option>';
        for($i=0;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunakhir" class="form-control" >';
        $th=date("Y")+5;
        $awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
       	echo '<option value=""></option>';
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);
	echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Golongan</label></div><div class="col-sm-9"><select name="golongan" class="form-control" >
		<option value=""></option>
                <option value="a. I/a">a. I/a</option>
                <option value="b. I/b">b. I/b</option>
                <option value="c. I/c">c. I/c</option>
                <option value="d. I/d">d. I/d</option>
                <option value="e. II/a">e. II/a</option>
                <option value="f. II/b">f. II/b</option>
                <option value="g. II/c">g. II/c</option>
                <option value="h. II/d">h. II/d</option>
                <option value="i. III/a">i. III/a</option>
                <option value="j. III/b">j. III/b</option>
                <option value="k. III/c">k. III/c</option>
                <option value="l. III/d">l. III/d</option>
                <option value="m. IV/a">m. IV/a</option>
                <option value="n. IV/b">n. IV/b</option>
                <option value="o. IV/c">o. IV/c</option>
                <option value="p. IV/d">p. IV/d</option>
                <option value="q. IV/E">q. IV/E</option>
</select></div></div>	';

echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Gaji Pokok</label></div><div class="col-sm-9"><input type="text" name="gaji_pokok" value="" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pejabat Pembuat SK</label></div><div class="col-sm-9"><input type="text" name="pejabat" class="form-control" ></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor SK</label></div><div class="col-sm-9"><input type="text" name="nomor" class="form-control" ></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal SK </label></div><div class="col-sm-3">';
	echo '<select name="harisk" class="form-control" >';
		echo '<option value=""></option>';
	for($i=0;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulansk" class="form-control" >';
		echo '<option value=""></option>';
        for($i=0;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunsk" class="form-control" >';
        $th=date("Y");
        $awal_th=$th;
        $akhir_th=$th-50;
	$i = $awal_th;
       	echo '<option value=""></option>';
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);
	echo '</select></div></div>';

?>
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
</div></div></div>
