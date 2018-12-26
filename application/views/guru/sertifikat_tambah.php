<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : sertifikat_tambah.php
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
<p><a href="<?php echo base_url(); ?>guru/sertifikat" class="btn btn-info"><b>Batal</b></a></p>
<?php echo form_open('guru/simpandatasertifikat','class="form-horizontal" role="form"');
echo '
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><p class="form-control-static">'.$nip.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">STTPL / SERTFITIKAT / PIAGAM</label></div><div class="col-sm-9"><select name="jenis" class="form-control">
	<option value="STTPL">STTPL</option>
	<option value="Sertifikat">Sertifikat</option>
	<option value="Piagam">Piagam</option>
	</select>
	</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Instansi</label></div><div class="col-sm-9"><input type="text" name="instansi" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Sertifikat / Piagam</label></div><div class="col-sm-3">
	<select name="harisurat" class="form-control">';
	echo '<option value=""></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulansurat" class="form-control">';
	echo '<option value=""></option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunsurat" class="form-control">';
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
';
echo '
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Sertifikat / Piagam</label></div><div class="col-sm-9"><input type="text" name="nomor" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><input type="text" name="kegiatan" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode Kegiatan</label></div><div class="col-sm-9"><select name="kode_penataran" class="form-control">
	<option value=""></option>
	<option value = "a. Pendalaman Materi">a. Pendalaman Materi</option>
	<option value = "b. Kurikulum (KTSP, KBK)">b. Kurikulum (KTSP, KBK)</option>
	<option value = "c. Inovasi Pembelajaran">c. Inovasi Pembelajaran</option>
	<option value = "d. Pengembangan Ekstrakurikuler PAI">d. Pengembangan Ekstrakurikuler PAI</option>
	<option value = "e. Penelitian (PTK)">e. Penelitian (PTK)</option>
	<option value = "f. Lainnya">f. Lainnya</option>
	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penyelenggara</label></div><div class="col-sm-9"><select name="penyelenggara" class="form-control">
	<option value=""></option>
	<option value = "a. Kemenag Pusat (Pusdiklat)">a. Kemenag Pusat (Pusdiklat)</option>
	<option value = "b. Balai Diklat">b. Balai Diklat</option>
	<option value = "c. Perguruan Tinggi">c. Perguruan Tinggi</option>
	<option value = "d. Kemendiknas">d. Kemendiknas</option>
	<option value = "e. Lembaga Swasta">e. Lembaga Swasta</option>
	<option value = "f. Lainnya">f. Lainnya</option>
	</select>
	</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Angkatan</label></div><div class="col-sm-9"><input type="text" name="angkatan" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Mulai</label></div><div class="col-sm-3">
	<select name="harimulai" class="form-control">';
	echo '<option value=""></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanmulai" class="form-control">';
	echo '<option value=""></option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunmulai" class="form-control">';
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

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Selesai</label></div><div class="col-sm-3">
	<select name="hariselesai" class="form-control">';
	echo '<option value=""></option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanselesai" class="form-control">';
	echo '<option value=""></option>';	
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunselesai" class="form-control">';
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

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="tanggalpelaksanaan" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="tempat" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jam Diklat</label></div><div class="col-sm-9"><input type="text" name="jamdiklat" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Termasuk Pendataan Personal MA</label></div><div class="col-sm-9"><select name="pendataan" class="form-control">
		<option value=""></option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
</select></div></div>

	</table>';
	
?>
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
<div class="clear padding40"></div>
</div>
</div>
