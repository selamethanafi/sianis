<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: impor_siswa.php
// Lokasi      		: application/views/tatausaha
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if($id == 'emiss')
{
?>
<?php echo form_open_multipart('tatausaha/proses_impor_siswa_emiss');?>
<div class="alert alert-info">
<p>format data</p>
<p>"NIS Lokal","NISN","Nomor Induk Kependudukan (NIK) Siswa","Nama Siswa","Tempat Lahir","Tanggal Lahir (dd/mm/yyyy)","Jenis Kelamin","Tingkat/Kelas","Jurusan","Kelas Paralel","Nomor Absen di Kelas","Rangking di Kelas","Status Siswa","Asal Sekolah","Hobi","Cita-Cita","Jumlah Saudara","Jenis Sekolah","Status Sekolah","Kabupaten/Kota Lokasi Sekolah","Nomor Peserta UN pada Jenjang Sebelumnya (SMP/MTs)","Alamat","Provinsi","Kab./Kota","Kecamatan","Desa/Kelurahan","Kode Pos","Jarak Tempat Tinggal Siswa Ke Madrasah","Transportasi dari Tempat Tinggal Siswa ke Madrasah","Tuna Rungu","Tuna Netra","Tuna Daksa","Tuna Grahita","Tuna Laras","Lamban Belajar","Sulit Belajar","Gangguan Komunikasi","Bakat Luar Biasa","No. Kartu Keluarga","Nama Lengkap Ayah","NIK/Nomor KTP Ayah","Pendidikan Ayah","Pekerjaan Ayah","Nama Lengkap Ibu","NIK/Nomor KTP Ibu","Pendidikan Ibu","Pekerjaan Ibu","Rata-Rata Penghasilan Orangtua per Bulan","Nomor KKS/KPS","Nomor Kartu PKH","Nomor Kartu Indonesia Pintar (KIP)","Agama Siswa","Total Nilai UN","Tanggal Kelulusan","Nama Wali","Tahun Lahir Wali","NIK/Nomor KTP Wali","Pendidikan Wali","Pekerjaan Wali","Penghasilan Wali","Status Tempat Tinggal Siswa","Bahasa Asing Yang Dipilih (Khusus Siswa Jurusan Bahasa)","Tanggal Diterima (dd/mm/yyyy)","Diterima di kelas X"</p>
</div>
<div class="form-group row row">
	<label for="berkas" class="col-sm-3 control-label">Berkas (format csv)</label>
		<div class="col-sm-9" ><input type="file" name="userfile" class="textfield"></div>
	</div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>
<?php
}
else
{?>
<?php echo form_open_multipart('tatausaha/proses_impor_siswa');?>
<div class="alert alert-info">
<p>format data</p>
<p>"nis","no_urut","nomor_pendaftaran","kelas","tglditerima"</p>
</div>
<div class="form-group row row">
	<label for="berkas" class="col-sm-3 control-label">Berkas (format csv)</label>
		<div class="col-sm-9" ><input type="file" name="userfile" class="textfield"></div>
	</div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>
<?php
}?>
</div></div></div>
