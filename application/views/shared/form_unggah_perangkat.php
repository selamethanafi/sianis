<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 19 Jan 2015 21:01:19 WIB 
// Nama Berkas 		: form_unggah_perangkat.php
// Lokasi      		: application/views/shared/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="container-fluid"><h2>Unggah Perangkat Guru</h2>
<?php
if (!empty($yangdiunggah))
	{
	echo form_open_multipart('unggah/unggahperangkat','class="form-horizontal" role="form"');
	if (($yangdiunggah=='Rencana Pelaksanaan Harian') or ($yangdiunggah== 'Buku Pelaksanaan Harian'))
		{
		echo 'Format Data <p>"thnajaran","semester","kelas","kodeguru","mapel","tanggal","jamke","kode_rpp","kode_rpp2","tanggal_bph","hambatan_siswa","solusi","alat_dan_bahan","lab","keterangan"</p>';
		}
	echo '<div class="form-group row row"><div class="col-sm-3"><label>Perangkat yang hendak diunggah</label></div><div class="col-sm-9"><select name="yangdiunggah" class="form-control">';
	echo '<option value="'.$yangdiunggah.'">'.$yangdiunggah.'</option>';
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label>Berkas</label></div><div class="col-sm-9"><input type="file" name="csvfile"></div></div><input type="hidden" name="diproses" value="oke"><p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"> <a href="'.base_url().'unggah/unggahperangkat" class="btn btn-info">Batal</a></p></form><br />';
	}
else
	{
	echo form_open('unggah/unggahperangkat');
	echo '<div class="form-group row row"><div class="col-sm-3"><label>Perangkat yang hendak diunggah</label></div><div class="col-sm-9"><select name="yangdiunggah" class="form-control">';
	echo '<option value=""></option>';
	echo '<option value="Analisis ulangan">Analisis ulangan</option>';
/*
	echo '<option value="Agenda Harian Kepala Laboratorium">Agenda Harian Kepala Laboratorium</option>';
	echo '<option value="Blanko Nilai">Blanko Nilai</option>';
	echo '<option value="Buku Analisis Pelaksanaan Kegiatan Kepala Laboratorium">Buku Analisis Pelaksanaan Kegiatan Kepala Laboratorium</option>';
*/
	echo '<option value="Buku Informasi Penilaian">Buku Informasi Penilaian</option>';
/*
	echo '<option value="Buku Laporan Pelaksanaan Kegiatan Kepala Laboratorium">Buku Laporan Pelaksanaan Kegiatan Kepala Laboratorium</option>';
*/
	echo '<option value="Buku Pelaksanaan Harian">Buku Pelaksanaan Harian</option>';
	echo '<option value="Daftar Nilai Kognitif">Daftar Nilai Kognitif</option>';
/*
	echo '<option value="Buku Pelaksanaan Kegiatan Kepala Laboratorium">Buku Pelaksanaan Kegiatan Kepala Laboratorium</option>';
	echo '<option value="Buku Pengembalian Ulangan">Buku Pengembalian Ulangan</option>';
	echo '<option value="Buku Tindak Lanjut Pelaksanaan Kegiatan Kepala Laboratorium">Buku Tindak Lanjut Pelaksanaan Kegiatan Kepala Laboratorium</option>';
	echo '<option value="Buku Tugas">Buku Tugas</option>';
	echo '<option value="Catatan Hambatan Belajar Siswa">Catatan Hambatan Belajar Siswa</option>';
	echo '<option value="Daftar Buku Pegangan">Daftar Buku Pegangan</option>';
	echo '<option value="Daftar Hadir Siswa">Daftar Hadir Siswa</option>';
	echo '<option value="Daftar Nilai Afektif">Daftar Nilai Afektif</option>';
	echo '<option value="Daftar Nilai Akhlak">Daftar Nilai Akhlak</option>';
	echo '<option value="Daftar Nilai Psikomotor">Daftar Nilai Psikomotor</option>';
	echo '<option value="Deskripsi Laporan Capaian Kompetensi">Deskripsi Laporan Capaian Kompetensi</option>';
	echo '<option value="Hambatan Belajar Siswa">Hambatan Belajar Siswa</option>';
	echo '<option value="Jurnal Piket">Jurnal Piket</option>';
	echo '<option value="Laporan Capaian Kompetensi">Laporan Capaian Kompetensi</option>';
	echo '<option value="Penilaian Kinerja Guru">Penilaian Kinerja Guru</option>';
*/
	echo '<option value="Program Kerja Kepala Laboratorium">Program Kerja Kepala Laboratorium</option>';
	echo '<option value="Program Harian Kepala Laboratorium">Program Harian Kepala Laboratorium</option>';
	echo '<option value="Rencana Pelaksanaan Harian">Rencana Pelaksanaan Harian</option>';
	echo '<option value="Rencana Pelaksanaan Pembelajaran">Rencana Pelaksanaan Pembelajaran</option>';
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary"> <a href="'.base_url().'unggah/unggahperangkat" class="btn btn-info">Batal</a></p></form>';
	}
?>
</div>
