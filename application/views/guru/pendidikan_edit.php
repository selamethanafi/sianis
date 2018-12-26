<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pendidikan_edit.php
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
<p><a href="<?php echo base_url(); ?>guru/pendidikan" class="btn btn-info"><b>Batal </b></a></p>
<?php echo form_open('guru/updatedatapendidikan','class="form-horizontal" role="form"');?>
<?php
foreach($query->result() as $t)
	{
	echo '
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9">'.$nama.'</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9">'.$nip.'</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">';
	echo '<select name="tingkat" class="form-control">';
	//terpilih
	echo '<option value="'.$t->tingkat.'">'.$t->tingkat.'</option>';
	echo '<option value="SD">SD</option>
                <option value="SLTP">SLTP</option>
                <option value="SLTA">SLTA</option>
                <option value="DI">Diploma I</option>
                <option value="DII">Diploma II</option>
                <option value="DIII">Diploma III</option>
                <option value="DIV">Diploma IV</option>
                <option value="Sarjana Muda">Sarjana Muda</option>
                <option value="S1">Strata I</option>
                <option value="S2">Pasca Sarjana</option>
                <option value="S3">Doktoral</option>
                <option value="Akta IV">Akta IV</option>
		</select>
	</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Ijazah</label></div><div class="col-sm-3">';
	echo '<select name="harilahir" class="form-control">';
	$postedhari=substr($t->tanggalijazah,8,2);
	$postedbulan=substr($t->tanggalijazah,5,2);
	$postedtahun=substr($t->tanggalijazah,0,4);
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
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunlahir" class="form-control">';
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
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Lulus</label></div><div class="col-sm-9"><input type="text" size="5" name="tahunlulus" value="'.$t->tahunlulus.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Ijazah</label></div><div class="col-sm-9"><input type="text" class="form-control" name="nomorijazah" value="'.$t->nomorijazah.'"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kepemilikan Akta</label></div><div class="col-sm-9"><select name="akta" class="form-control">

                <option value="'.$t->akta.'">'.$t->akta.'</option>
                <option value="Tdk Memiliki">Tdk Memiliki</option>
		<option value="Akta I">Akta I</option>
                <option value="Akta II">Akta II</option>
                <option value="Akta III">Akta III</option>
                <option value="Akta IV">Akta IV</option></select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Fakultas</label></div><div class="col-sm-9"><select name="fakultas" class="form-control">
		<option value="'.$t->fakultas.'">'.$t->fakultas.'</option>
                <option value="Tarbiyah">Tarbiyah</option>
                <option value="Ushuludin">Ushuludin</option>
                <option value="Syariah">Syariah</option>
                <option value="Dakwah">Dakwah</option>
                <option value="Adab">Adab</option>
                <option value="Keguruan dan IP">Keguruan dan IP</option>
                <option value="MIPA">MIPA</option>
                <option value="Teknik">Teknik</option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="Bhs dan Sastra">Bhs dan Sastra</option>
                <option value="Hukum">Hukum</option>
                <option value="Sospol">Sospol</option>
                <option value="Pasca Sarjana">Pasca Sarjana</option>
                <option value="Lainnya">Lainnya</option>
</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jurusan</label></div><div class="col-sm-9"><select name="jurusan" class="form-control">
		<option value="'.$t->jurusan.'">'.$t->jurusan.'</option>
                <option value = "Administrasi">Administrasi</option>
		<option value = "Ahwls Syahsiyah">Ahwls Syahsiyah</option>
		<option value = "Akuntansi">Akuntansi</option>
		<option value = "Antropologi">Antropologi</option>
		<option value = "Aqidah Filsafat">Aqidah Filsafat</option>
		<option value = "Bhs Arab">Bhs Arab</option>
		<option value = "Bhs Asing Lainnya">Bhs Asing Lainnya</option>
		<option value = "Bhs Indonesia">Bhs Indonesia</option>
		<option value = "Bhs Inggris">Bhs Inggris</option>
		<option value = "Biologi">Biologi</option>
		<option value = "Dakwah">Dakwah</option>
		<option value = "Ekonomi">Ekonomi</option>
		<option value = "Elektronik">Elektronik</option>
		<option value = "Filsafat">Filsafat</option>
		<option value = "Fiqih">Fiqih</option>
		<option value = "Fisika">Fisika</option>
		<option value = "Geografi">Geografi</option>
		<option value = "Hukum">Hukum</option>
		<option value = "Hukum Islam">Hukum Islam</option>
		<option value = "Ilmu Agama">Ilmu Agama</option>
		<option value = "Ilmu Pendidikan">Ilmu Pendidikan</option>
		<option value = "Kepend. Islam">Kepend. Islam</option>
		<option value = "Kesenian">Kesenian</option>
		<option value = "Kimia">Kimia</option>
		<option value = "Komputer">Komputer</option>
		<option value = "Komunikasi">Komunikasi</option>
		<option value = "Manajemen">Manajemen</option>
		<option value = "Manajemen Pendidikan">Manajemen Pendidikan</option>
		<option value = "Manajemen Pendidikan Islam">Manajemen Pendidikan Islam</option>
		<option value = "Matematika">Matematika</option>
		<option value = "Muamalah">Muamalah</option>
		<option value = "PAI">PAI</option>
		<option value = "Penerangan Islam">Penerangan Islam</option>
		<option value = "Penjaskes">Penjaskes</option>
		<option value = "Penyiaran Agama Islam">Penyiaran Agama Islam</option>
		<option value = "Peradilan Agama">Peradilan Agama</option>
		<option value = "Perb. Agama">Perb. Agama</option>
		<option value = "Perb. Mhz dan Hkm">Perb. Mhz dan Hkm</option>
		<option value = "PGSD">PGSD</option>
		<option value = "PGSLP">PGSLP</option>
		<option value = "PGTK">PGTK</option>
		<option value = "PPKn / Pancasila">PPKn / Pancasila</option>
		<option value = "Psikologi">Psikologi</option>
		<option value = "Quran Hadits">Quran Hadits</option>
		<option value = "Sastra Arab">Sastra Arab</option>
		<option value = "Sejarah">Sejarah</option>
		<option value = "Sejarah Kebudayaan Islam">Sejarah Kebudayaan Islam</option>
		<option value = "Sosial dan Politik">Sosial dan Politik</option>
		<option value = "Sosiologi">Sosiologi</option>
		<option value = "Statistik">Statistik</option>
		<option value = "Studi Islam">Studi Islam</option>
		<option value = "Tadris IPA">Tadris IPA</option>
		<option value = "Tadris IPS">Tadris IPS</option>
		<option value = "Tafsir Hadits">Tafsir Hadits</option>
		<option value = "Tata Negara">Tata Negara</option>
		<option value = "Lainnya">Lainnya</option></select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelompok Program Studi</label></div><div class="col-sm-9"><select name="kelprodi" class="form-control">';
	if($t->kelprodi=='01')
	{
		$prodi = 'Rumpun Pendidikan Agama Islam (PAI)';
	}
	elseif($t->kelprodi=='02')
	{
		$prodi = 'Bahasa Indonesia';
	}
	elseif($t->kelprodi=='03')
	{
		$prodi = 'Bahasa Inggris';
	}
	elseif($t->kelprodi=='04')
	{
		$prodi = 'Bahasa Arab';
	}
	elseif($t->kelprodi=='05')
	{
		$prodi = 'Bahasa Asing Lainnya (Bahasa Jepang, Mandarain, Korea, Jerman, Belanda, Perancis, Rusia, dll)';
	}
	elseif($t->kelprodi=='06')
	{
		$prodi = 'Matematika/Statistika';
	}
	elseif($t->kelprodi=='07')
	{
		$prodi = 'IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)';
	}
	elseif($t->kelprodi=='08')
	{
		$prodi = 'Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)';
	}
	elseif($t->kelprodi=='09')
	{
		$prodi = 'Ilmu Komputer/Informatika/Teknologi Informasi';
	}
	elseif($t->kelprodi=='10')
	{
		$prodi = 'Pendidikan Jasmani, Olahraga dan Kesehatan';
	}
	elseif($t->kelprodi=='11')
	{
		$prodi = 'Manajemen Pendidikan / Ilmu Pendidikan';
	}
	elseif($t->kelprodi=='12')
	{
		$prodi = 'Hukum/Syari\'ah/Hukum Islam';
	}
	elseif($t->kelprodi=='13')
	{
		$prodi = 'PGSD/PGMI ';
	}
	elseif($t->kelprodi=='14')
	{
		$prodi = 'PGTK';
	}
	elseif($t->kelprodi=='15')
	{
		$prodi = 'Psikologi';
	}
	elseif($t->kelprodi=='16')
	{
		$prodi = 'Kesenian';
	}
	elseif($t->kelprodi=='17')
	{
		$prodi = 'Pendidikan Kewarganegaraan';
	}
	elseif($t->kelprodi=='18')
	{
		$prodi = 'Lainnya';
	}
	else
	{
		$prodi = '';
	}
	echo '<option value="'.$t->jurusan.'">'.$prodi.'</option>
	<option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
	<option value="02">Bahasa Indonesia </option>
	<option value="03">Bahasa Inggris </option>
	<option value="04">Bahasa Arab </option>
	<option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarain, Korea, Jerman, Belanda, Perancis, Rusia, dll) </option>
	<option value="06">Matematika/Statistika </option>
	<option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika) </option>
	<option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi) </option>
	<option value="09">Ilmu Komputer/Informatika/Teknologi Informasi </option>
	<option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan </option>
	<option value="11">Manajemen Pendidikan / Ilmu Pendidikan </option>
	<option value="12">Hukum/Syari\'ah/Hukum Islam </option>
	<option value="13">PGSD/PGMI </option>
	<option value="14">PGTK </option>
	<option value="15">Psikologi </option>
	<option value="16">Kesenian </option>
	<option value="17">Pendidikan Kewarganegaraan </option>
	<option value="18">Lainnya </option></select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gelar</label></div><div class="col-sm-9"><input type="text" class="form-control" name="gelar" value="'.$t->gelar.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis PT</label></div><div class="col-sm-9"><select name="jenis" class="form-control">
		<option value="'.$t->jenis.'">'.$t->jenis.'</option>
                <option value="PTAI">PTAI</option>
		<option value="PTU">PTU</option></select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kategori</label></div><div class="col-sm-9"><select name="kategori" class="form-control">
		<option value="'.$t->kategori.'">'.$t->kategori.'</option>
                <option value="Universitas">Universitas</option>
		<option value="Institut">Institut</option>
		<option value="Sekolah Tinggi">Sekolah Tinggi</option>
		<option value="Akademi">Akademi</option>
		</select></div></div>';

echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9"><select name="status" class="form-control">
		<option value="'.$t->status.'">'.$t->status.'</option>
                <option value="Negeri">Negeri</option>
		<option value="Swasta">Swasta</option></select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Sekolah</label></div><div class="col-sm-9"><input type="text" class="form-control" name="namasekolah" value="'.$t->namasekolah.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Alamat Sekolah / PT</label></div><div class="col-sm-9"><input type="text" class="form-control" name="alamatsekolah" value="'.$t->alamatsekolah.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kepala Sekolah / PT</label></div><div class="col-sm-9"><input type="text" class="form-control" name="namakepala" value="'.$t->namakepala.'"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">IP / Rata - rata</label></div><div class="col-sm-9"><input type="text" size="5" name="ip" value="'.$t->ip.'" class="form-control"></div></div>
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
</div></div></div>
