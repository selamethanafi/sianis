<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kepegawaian_edit.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/kepegawaian" class="btn btn-info"><b>Kembali ke Data Kepegawaian</b></a></p>
<?php echo form_open('guru/updatedatakepegawaian','class="form-horizontal" role="form"');
foreach($query->result() as $t)
	{
	echo '
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9">'.$nama.'</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9">'.$nip.'</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Kepegawaian</label></div><div class="col-sm-9"><select name="jenis_sk" class="form-control">
		<option value="'.$t->jenis_sk.'">'.$t->jenis_sk.'</option>
                <option value="SK CPNS">SK CPNS</option>
                <option value="SK PNS">SK PNS</option>
                <option value="SK KP">SK KP</option>
                <option value="SK PMK">SK PMK</option>
		<option value="SK KGB">SK KGB</option>
		</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">TMT</label></div><div class="col-sm-3">';
	$postedhari=substr($t->tmt,8,2);
	$postedbulan=substr($t->tmt,5,2);
	$postedtahun=substr($t->tmt,0,4);
	echo '<select name="haritmt" class="form-control">';
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
	echo '<select name="bulantmt" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';
        for($i=1;$i<10;$i++)
	{
	echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahuntmt" class="form-control">';
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

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Tugas</label></div><div class="col-sm-9"><select name="status_tugas" class="form-control">
		<option value="'.$t->status_tugas.'">'.$t->status_tugas.'</option>
                <option value="1. Guru">1. Guru</option>
                <option value="2. Non Guru">2. Non Guru</option></select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status Kepegawaian</label></div><div class="col-sm-9"><select name="status_kepegawaian" class="form-control">
		<option value="'.$t->status_kepegawaian.'">'.$t->status_kepegawaian.'</option>
                <option value="a. Calon PNS">a. Calon PNS</option>
                <option value="b. PNS">b. PNS</option>
                <option value="c. Diperbantukan">c. Diperbantukan</option>
                <option value="d. Dipekerjakan">d. Dipekerjakan</option>
                <option value="e. Tetap">e. Tetap</option>
                <option value="f. Tidak tetap/Honor">f. Tidak tetap/Honor"</option></select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Instansi yang mengangkat</label></div><div class="col-sm-9"><select name="instansi_yang_mengangkat" class="form-control">
		<option value="'.$t->instansi_yang_mengangkat.'">'.$t->instansi_yang_mengangkat.'</option>
                <option value="a. Satuan Pendidikan">a. Satuan Pendidikan</option>
                <option value="b. Yayasan Penyelenggara Pendidian">b. Yayasan Penyelenggara Pendidian</option>
                <option value="c. Kementerian Agama">c. Kementerian Agama</option>
                <option value="d. Kementerian Lainnya">d. Kementerian Lainnya</option>
                <option value="e. Pemda">e. Pemda</option></select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status keaktifan</label></div><div class="col-sm-9"><select name="status_keaktifan" class="form-control">
		<option value="'.$t->status_keaktifan.'">'.$t->status_keaktifan.'</option>
                <option value="a. Aktif">a. Aktif</option>
                <option value="b. Cuti tanggungan negara">b. Cuti tanggungan negara</option>
                <option value="c. Tugas belajar">c. Tugas belajar</option>
                <option value="d. Cuti besar">d. Cuti besar</option>
                <option value="e. Masa Persiapan Pensiun (MPP)">e. Masa Persiapan Pensiun (MPP)</option>
                <option value="f. Pensiun">f. Pensiun</option>
                <option value="g. Pensiun">g. Pensiun</option>
                <option value="h. Pemberhentian dengan hormat">h. Pemberhentian dengan hormat</option>
		<option value="i. Pemberhentian dengan tidak hormat">i. Pemberhentian dengan tidak hormat</option>
                <option value="j. Meninggal dunia">j. Meninggal dunia</option>
                <option value="k. Tidak aktif lainnya">k. Tidak aktif lainnya</option></select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pangkat / Golongan / Jabatan </label></div><div class="col-sm-3"><p class="form-control-static">'.$t->pangkat.'</p></div><div class="col-sm-2"><select name="gol" class="form-control">
		<option value="'.$t->gol.'">'.$t->gol.'</option>
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
</select></div><div class="col-sm-3"><p class="form-control-static">'.$t->jabatan.'</p></div></div>	

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Instansi</label></div><div class="col-sm-9"><input type="text" name="instansi" value="'.$t->instansi.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pejabat</label></div><div class="col-sm-9"><input type="text" name="pejabat" value="'.$t->pejabat.'" class="form-control"></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Surat</label></div><div class="col-sm-3">
	<select name="harisurat" class="form-control">';
	$postedhari=substr($t->tanggal,8,2);
	$postedbulan=substr($t->tanggal,5,2);
	$postedtahun=substr($t->tanggal,0,4);
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
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Surat</label></div><div class="col-sm-9"><input type="text" name="nomorsurat" value="'.$t->nomorsurat.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Uraian</label></div><div class="col-sm-9"><input type="text" name="uraian" value="'.$t->uraian.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gaji Pokok</label></div><div class="col-sm-9"><input type="text" name="gapok" value="'.$t->gapok.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Masa Kerja</label></div><div class="col-sm-1"><input type="text" name="tahun" value="'.$t->tahun.'" class="form-control"></div><div class="col-sm-1"><p class="form-control-static">tahun</p></div><div class="col-sm-1"><input type="text" name="bulan" value="'.$t->bulan.'" class="form-control"></div><div class="col-sm-1"><p class="form-control-static">bulan</p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai PAK</label></div><div class="col-sm-9"><input type="text" name="pak" value="'.$t->pak.'" class="form-control"></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Termasuk Pendataan Personal MA</label></div><div class="col-sm-9"><select name="pendataan" class="form-control">
		<option value="'.$t->pendataan.'">'.$t->pendataan.'</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
</select></div></div>';
}	
?>
<input type="hidden" name="id" value="<?php echo $id;?>">
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>

</div>
