<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
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
<?php
$xloc = base_url().'guru/formmencetak';
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Perangkat hendak dicetak</label></div><div class="col-sm-9">';
echo "<select name=\"noyangdicetak\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$noyangdicetak.'">'.$yangdicetak.'</option>';
	echo '<option value="'.$xloc.'/1">Agenda Harian Tugas Tambahan</option>';
	echo '<option value="'.$xloc.'/2">Blanko Nilai</option>';
	echo '<option value="'.$xloc.'/3">Buku Analisis Pelaksanaan Kegiatan Tugas Tambahan</option>';
	echo '<option value="'.$xloc.'/4">Buku Informasi Penilaian</option>';
	echo '<option value="'.$xloc.'/5">Buku Kegiatan Laboratorium</option>';
	echo '<option value="'.$xloc.'/36">Buku Kegiatan Laboratorium Versi 2</option>';
	echo '<option value="'.$xloc.'/6">Buku Laporan Pelaksanaan Kegiatan Tugas Tambahan</option>';
	echo '<option value="'.$xloc.'/7">Buku Pelaksanaan Harian</option>';
	echo '<option value="'.$xloc.'/35">Buku Pelaksanaan Harian Versi 2</option>';
	echo '<option value="'.$xloc.'/8">Buku Pelaksanaan Harian Per Tanggal</option>';
	echo '<option value="'.$xloc.'/9">Buku Pelaksanaan Kegiatan Tugas Tambahan</option>';
	echo '<option value="'.$xloc.'/10">Buku Pengembalian Ulangan</option>';
	echo '<option value="'.$xloc.'/11">Buku Tindak Lanjut Pelaksanaan Kegiatan Tugas Tambahan</option>';
	echo '<option value="'.$xloc.'/12">Buku Tugas</option>';
	echo '<option value="'.$xloc.'/34">Buku Tugas Versi 2</option>';
	echo '<option value="'.$xloc.'/14">Daftar Buku Pegangan</option>';
	echo '<option value="'.$xloc.'/15">Daftar Hadir Siswa</option>';
	echo '<option value="'.$xloc.'/38">Daftar Hadir Siswa Versi 2</option>';
	echo '<option value="'.$xloc.'/16">Daftar Nilai Afektif</option>';
	echo '<option value="'.$xloc.'/17">Daftar Nilai Akhlak / Sikap Spiritual dan Sosial</option>';
	echo '<option value="'.$xloc.'/18">Daftar Nilai Kognitif</option>';
	echo '<option value="'.$xloc.'/19">Daftar Nilai Psikomotor</option>';
	echo '<option value="'.$xloc.'/20">Deskripsi Laporan Capaian Kompetensi</option>';
	echo '<option value="'.$xloc.'/32">Deskripsi Sikap Spiritual dan Sosial Antarmata Pelajaran</option>';
	echo '<option value="'.$xloc.'/21">Hambatan Belajar Siswa</option>';
	echo '<option value="'.$xloc.'/22">Jurnal Piket</option>';
	echo '<option value="'.$xloc.'/39">Jurnal Penilaian Sikap Sosial dan Sikap Spiritual</option>';
	echo '<option value="'.$xloc.'/23">Laporan Capaian Kompetensi</option>';
	echo '<option value="'.$xloc.'/24">Laporan Hasil Belajar</option>';
	echo '<option value="'.$xloc.'/31">Penilaian Diri Antarteman Siswa</option>';
	echo '<option value="'.$xloc.'/30">Penilaian Diri Siswa</option>';
	echo '<option value="'.$xloc.'/25">Penilaian Kinerja Guru</option>';
	echo '<option value="'.$xloc.'/26">Program Kerja Tugas Tambahan</option>';
	echo '<option value="'.$xloc.'/27">Rencana Pelaksanaan Harian</option>';
	echo '<option value="'.$xloc.'/28">Rencana Pelaksanaan Harian Per Tanggal</option>';
	echo '<option value="'.$xloc.'/29">Rencana Pelaksanaan Pembelajaran</option>';
	echo '</select></div></div>';
?>
</form>
</div></div></div>
