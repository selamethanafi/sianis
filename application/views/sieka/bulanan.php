<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
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
?><div class="container-fluid"><h2>Modul Kegiatan Bulanan SiEka</h2>
<?php
$ta = $this->db->query("select * from `skp_skor_guru` where `kegiatan` like '%Membimbing siswa dalam kegiatan ekstrakurikuler%' and `tahun`='$tahunpenilaian' and `nip`='$nip'");
if($ta->num_rows() > 0)
{
	$kegiatan = 'menyusun program pembimbingan ekstrakurikuler di bulan Januari '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Januari '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Februari '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Maret '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan April '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Mei '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'menyusun program pembimbingan ekstrakurikuler di bulan Juli '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Juli '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Agustus '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan September '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan Oktober '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}
	$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan November '.$tahunpenilaian;
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	if($ta->num_rows() == 0)
	{
		$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
	}



}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Januari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Februari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Maret '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan April '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Mei '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Juni '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Juli '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Agustus '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan September '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Oktober '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan November '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun kurikulum, silabus atau rencana pelaksanaan pembelajaran di bulan Desember '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Januari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Februari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Maret '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan April '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Mei '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Juni '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Juli '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Agustus '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan September '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Oktober '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan November '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan kegiatan pembelajaran di bulan Desember '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Januari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Februari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Maret '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan April '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Mei '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Juni '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Juli '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Agustus '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan September '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Oktober '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan November '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menyusun alat ukur/soal sesuai mata pelajaran di bulan Desember '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Januari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Februari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Maret '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan April '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Mei '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Juni '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Juli '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Agustus '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan September '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Oktober '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan November '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menilai dan mengevaluasi proses dan hasil belajar pada mata pelajaran yang diampunya di bulan Desember '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Januari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Februari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Maret '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan April '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Mei '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Juni '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Juli '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Agustus '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan September '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Oktober '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan November '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan Desember '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Januari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Februari '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Maret '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan April '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Mei '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Juni '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Juli '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Agustus '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan September '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Oktober '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan November '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan Desember '.$tahunpenilaian;
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `sieka_bulanan` (`tahun`,`nip`,`kegiatan`) values ('$tahunpenilaian', '$nip', '$kegiatan')");
}
echo '<p><a href="'.base_url().'sieka/bulananid/jan" class="btn btn-info">Jan</a> <a href="'.base_url().'sieka/bulananid/feb" class="btn btn-info">Feb</a>  <a href="'.base_url().'sieka/bulananid/mar" class="btn btn-info">Mar</a>  <a href="'.base_url().'sieka/bulananid/apr" class="btn btn-info">Apr</a>  <a href="'.base_url().'sieka/bulananid/mei" class="btn btn-info">Mei</a>  <a href="'.base_url().'sieka/bulananid/jun" class="btn btn-info">Jun</a>  <a href="'.base_url().'sieka/bulananid/jul" class="btn btn-info">Jul</a>  <a href="'.base_url().'sieka/bulananid/agu" class="btn btn-info">Agu</a>  <a href="'.base_url().'sieka/bulananid/sep" class="btn btn-info">Sep</a>  <a href="'.base_url().'sieka/bulananid/okt" class="btn btn-info">Okt</a>  <a href="'.base_url().'sieka/bulananid/nov" class="btn btn-info">Nov</a>  <a href="'.base_url().'sieka/bulananid/des" class="btn btn-info">Des</a></p>';
$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip'");
echo '<table class="table table-striped table-hover table-bordered">
<tr><td align="center">Nomor</td><td>Kegiatan</td><td align="center">ID Bulanan</td></tr>';
$nomor = 1;
foreach($ta->result() as $a)
{
	echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->kegiatan.'</td><td align="center">'.$a->id_bulanan.'</td></tr>';
	$nomor++;
}
echo '</table>';
?>
</div></div></div>
