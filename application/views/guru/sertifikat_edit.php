<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: sertifikat_edit.php
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
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/sertifikat" class="btn btn-info"><b>Batal</b></a></p>
<?php echo form_open('guru/updatedatasertifikat','class="form-horizontal" role="form"');
foreach($query->result() as $t)
	{
	echo '
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><p class="form-control-static">'.$nip.'</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">STTPL / SERTFITIKAT / PIAGAM</label></div><div class="col-sm-9"><select name="jenis" class="form-control">
	<option value="'.$t->jenis.'">'.$t->jenis.'</option>
	<option value="STTPL">STTPL</option>
	<option value="Sertifikat">Sertifikat</option>
	<option value="Piagam">Piagam</option>
	</select>
	</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Instansi</label></div><div class="col-sm-9"><input type="text" name="instansi" value="'.$t->instansi.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Sertifikat / Piagam</label></div><div class="col-sm-3">
	<select name="harisurat" class="form-control">';
	$postedhari=substr($t->tanggalsertifikat,8,2);
	$postedbulan=substr($t->tanggalsertifikat,5,2);
	$postedtahun=substr($t->tanggalsertifikat,0,4);
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
	echo '<select name="bulansurat" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunsurat" class="form-control">';
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
';
echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Sertifikat / Piagam</label></div><div class="col-sm-9"><input type="text" name="nomor" value="'.$t->nomor.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><input type="text" name="kegiatan" value="'.$t->kegiatan.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kode Kegiatan</label></div><div class="col-sm-9"><select name="kode_penataran" class="form-control">
	<option value="'.$t->kode_penataran.'">'.$t->kode_penataran.'</option>
	<option value = "a. Pendalaman Materi">a. Pendalaman Materi</option>
	<option value = "b. Kurikulum (KTSP, KBK)">b. Kurikulum (KTSP, KBK)</option>
	<option value = "c. Inovasi Pembelajaran">c. Inovasi Pembelajaran</option>
	<option value = "d. Pengembangan Ekstrakurikuler PAI">d. Pengembangan Ekstrakurikuler PAI</option>
	<option value = "e. Penelitian (PTK)">e. Penelitian (PTK)</option>
	<option value = "f. Lainnya">f. Lainnya</option>
	</select>
	</div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penyelenggara</label></div><div class="col-sm-9"><select name="penyelenggara" class="form-control">
	<option value="'.$t->penyelenggara.'">'.$t->penyelenggara.'</option>
	<option value = "a. Kemenag Pusat (Pusdiklat)">a. Kemenag Pusat (Pusdiklat)</option>
	<option value = "b. Balai Diklat">b. Balai Diklat</option>
	<option value = "c. Perguruan Tinggi">c. Perguruan Tinggi</option>
	<option value = "d. Kemendiknas">d. Kemendiknas</option>
	<option value = "e. Lembaga Swasta">e. Lembaga Swasta</option>
	<option value = "f. Lainnya">f. Lainnya</option>
	</select>
	</div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Angkatan</label></div><div class="col-sm-9"><input type="text" name="angkatan" value="'.$t->angkatan.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Mulai</label></div><div class="col-sm-3">
	<select name="harimulai" class="form-control">';
	$postedhari=substr($t->tgl_mulai,8,2);
	$postedbulan=substr($t->tgl_mulai,5,2);
	$postedtahun=substr($t->tgl_mulai,0,4);
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
	echo '<select name="bulanmulai" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunmulai" class="form-control">';
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

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Selesai</label></div><div class="col-sm-3">
	<select name="hariselesai" class="form-control">';
	$postedhari=substr($t->tgl_selesai,8,2);
	$postedbulan=substr($t->tgl_selesai,5,2);
	$postedtahun=substr($t->tgl_selesai,0,4);

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
	echo '<select name="bulanselesai" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunselesai" class="form-control">';
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

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="tanggalpelaksanaan" value="'.$t->tanggalpelaksanaan.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tempat Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="tempat" value="'.$t->tempat.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jam Diklat</label></div><div class="col-sm-9"><input type="text" name="jamdiklat" value="'.$t->jamdiklat.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Termasuk Pendataan Personal MA</label></div><div class="col-sm-9"><select name="pendataan" class="form-control">
	<option value="'.$t->pendataan.'">'.$t->pendataan.'</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
</select></div></div>';
}	
?>
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<input type="hidden" name="id" value="<?php echo $id;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
</div></div></div>
