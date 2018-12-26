<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: form_mencetak.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$dapatdiakses = 0;
$diproses = '';
if($status =="Pengawas")
	{ echo form_open('pengawas/perangkat','class="form-horizontal" role="form"');
	$tautan = 'pengawas';
		$dapatdiakses = 1;}
elseif($status =="Kepala")
	{ echo form_open('kepala/perangkat','class="form-horizontal" role="form"');
	$tautan = 'kepala';
	$dapatdiakses = 1;}
else
	{
	echo "Galat, Anda tidak mempunyai wewenang mengakses halaman ini";
	}
if ($dapatdiakses == 1)
{
echo '<p><a href="'.base_url().''.strtolower($status).'/perangkat">Kembali</a></p>';
if($yangdicetak != 'Analisis')
	{
	$ulangan = 'xxxxx';
	}
if (!empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Ajaran</label></div><div class="col-sm-9">
	<input name="thnajaran" type="text" value="'.$thnajaran.'" readonly class="form-control"></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Ajaran</label></div><div class="col-sm-9">
	<input name="semester" type="text" value="'.$semester.'" readonly class="form-control"></div></div>';
	}

if (!empty($yangdicetak))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Perangkat Guru</label></div><div class="col-sm-9">
	<input name="yangdicetak" type="text" value="'.$yangdicetak.'" readonly class="form-control"></div></div>';
	}
if (!empty($kodeguru))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Guru</label></div><div class="col-sm-9">';
		echo '<input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
		echo cari_nama_pegawai($kodeguru).'</div></div>';
	}
if (!empty($id_mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9">';
		echo '<input name="id_mapel" type="hidden" value="'.$id_mapel.'">';
		echo ''.id_mapel_jadi_mapel($id_mapel).' '.id_mapel_jadi_kelas($id_mapel).'</div></div>';
	}

		if (($yangdicetak == 'Daftar Hadir Siswa') or ($yangdicetak == 'Daftar Nilai Afektif') or ($yangdicetak == 'Daftar Nilai Akhlak') or ($yangdicetak == 'Daftar Nilai Psikomotor') or ($yangdicetak == 'Deskripsi Laporan Capaian Kompetensi') or ($yangdicetak == 'Hambatan Belajar Siswa') or ($yangdicetak == 'Buku Informasi Penilaian') or ($yangdicetak == 'Buku Pelaksanaan Harian')  or ($yangdicetak == 'Buku Pengembalian Ulangan') or ($yangdicetak == 'Buku Tugas') or ($yangdicetak == 'Catatan Hambatan Belajar Siswa') or ($yangdicetak == 'Daftar Buku Pegangan') or ($yangdicetak == 'Laporan Capaian Kompetensi') or ($yangdicetak == 'Laporan Hasil Belajar') or ($yangdicetak == 'Daftar Nilai Kognitif'))
			{
			$diproses = 'oke';
			}
if ((empty($yangdicetak)) or (empty($thnajaran)) or (empty($semester)) or (empty($kodeguru)))
{
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Perangkat guru</label></div><div class="col-sm-9">';
	echo '<select name="yangdicetak" class="form-control">';
	echo '<option value="'.$yangdicetak.'">'.$yangdicetak.'</option>';
	echo '<option value="Analisis">Analisis</option>';
	echo '<option value="Buku Informasi Penilaian">Buku Informasi Penilaian</option>';
	echo '<option value="Buku Pelaksanaan Harian">Buku Pelaksanaan Harian</option>';
	echo '<option value="Buku Pengembalian Ulangan">Buku Pengembalian Ulangan</option>';
	echo '<option value="Buku Tugas">Buku Tugas</option>';
	echo '<option value="Catatan Hambatan Belajar Siswa">Catatan Hambatan Belajar Siswa</option>';
	echo '<option value="Daftar Buku Pegangan">Daftar Buku Pegangan</option>';
	echo '<option value="Daftar Hadir Siswa">Daftar Hadir Siswa</option>';
	echo '<option value="Daftar Nilai Afektif">Daftar Nilai Afektif</option>';
	echo '<option value="Daftar Nilai Akhlak">Daftar Nilai Akhlak</option>';
	echo '<option value="Daftar Nilai Kognitif">Daftar Nilai Kognitif</option>';
	echo '<option value="Daftar Nilai Psikomotor">Daftar Nilai Psikomotor</option>';
	echo '<option value="Deskripsi Laporan Capaian Kompetensi">Deskripsi Laporan Capaian Kompetensi</option>';
	echo '<option value="Hambatan Belajar Siswa">Hambatan Belajar Siswa</option>';
//	echo '<option value="Jurnal Piket">Jurnal Piket</option>';
	echo '<option value="Laporan Capaian Kompetensi">Laporan Capaian Kompetensi</option>';
	echo '<option value="Laporan Hasil Belajar">Laporan Hasil Belajar</option>';
//	echo '<option value="Penilaian Kinerja Guru">Penilaian Kinerja Guru</option>';
	echo '<option value="Rencana Pelaksanaan Harian">Rencana Pelaksanaan Harian</option>';

//	echo '<option value="Rencana Pelaksanaan Pembelajaran">Rencana Pelaksanaan Pembelajaran</option>';
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".cari_thnajaran()."'>".cari_thnajaran()."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
		if(cari_semester() == 1)
			{
			echo '<option value="1">1</option>';
			echo '<option value="2">2</option></select></div></div>';
			}
			else
			{
			echo '<option value="2">2</option>';
			echo '<option value="1">1</option></select></div></div>';
			}
		$tb = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by nama_tanpa_gelar");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Guru</label></div><div class="col-sm-9">';
		echo '<select name="kodeguru" class="form-control">';
			echo '<option value=""></option>';
		foreach($tb->result() as $b)
			{
			echo '<option value="'.$b->kode.'">'.$b->nama_tanpa_gelar.' ('.$b->nama.')</option>';
			}
		echo '</select></div></div>';
			echo  '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().''.strtolower($status).'/perangkat">Kembali</a></p>';

}
	elseif (empty($id_mapel))
		{
		if (($yangdicetak == 'Daftar Hadir Siswa') or ($yangdicetak == 'Daftar Nilai Afektif') or ($yangdicetak == 'Daftar Nilai Akhlak') or ($yangdicetak == 'Daftar Nilai Psikomotor') or ($yangdicetak == 'Deskripsi Laporan Capaian Kompetensi') or ($yangdicetak == 'Hambatan Belajar Siswa') or ($yangdicetak == 'Laporan Capaian Kompetensi') or ($yangdicetak == 'Rencana Pelaksanaan Harian') or ($yangdicetak == 'Buku Pelaksanaan Harian')  or ($yangdicetak == 'Analisis') or ($yangdicetak == 'Laporan Hasil Belajar') or ($yangdicetak == 'Daftar Nilai Kognitif'))
			{
			$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran / Kelas</label></div><div class="col-sm-9">';
		echo '<select name="id_mapel" class="form-control">';
		foreach($ta->result() as $a)
			{
			echo '<option value="'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
			}
			echo '</select></div></div>';
			}
		if($diproses == 'oke')
			{
			echo '<input name="diproses" type="hidden" value="oke">';
			}

	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().''.strtolower($status).'/perangkat" class="btn btn-info">Kembali</a></p>';

		}
	elseif (empty($ulangan))
		{
		$tc = $this->db->query("select distinct `ulangan`,`thnajaran`,`semester`,`mapel`,`kelas` from `analisis` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ulangan<div class="form-group row row"><div class="col-sm-3"><label class="control-label">';
		echo '<select name="ulangan" class="form-control">';
		foreach($tc->result() as $c)
			{
			echo '<option value="'.$c->ulangan.'">'.$c->ulangan.'</option>';
			}
			echo '</select><input name="diproses" type="hidden" value="oke">&nbsp;&nbsp;Kalau kosong berarti ybs belum membuat Analisis</div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"></td><td width="10" valign="middle"></td><td>';
	echo '<input type="submit" value="Lanjut" class="tombol">&nbsp;&nbsp;&nbsp;<a href="'.base_url().''.strtolower($status).'/perangkat">Kembali</a></div></div>';

		}
?>
</form>
<?php
if ($yangdicetak=="Analisis")
	{
	echo 'Daftar Analisis yang sudah dibuat oleh <strong>'.cari_nama_pegawai($kodeguru).'</strong><br />';
	$td = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	foreach($td->result() as $d)
		{
		$kelas = $d->kelas;
		$mapel = $d->mapel;
		$id_mapel = $d->id_mapel;
		//cari di tabel analisis
		$te = $this->db->query("select distinct `ulangan`,`thnajaran`,`semester`,`mapel`,`kelas` from `analisis` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
//		$te = $this->db->query("select `ulangan`,`thnajaran`,`semester`,`mapel`,`kelas` from `analisis` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");

		$ada = $te->num_rows();
		if($ada>0)
		{
		echo $mapel.'  '.$kelas.' ';
		foreach($te->result() as $e)
			{
			echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;';
			echo ''.$e->ulangan.'&nbsp;&nbsp;&nbsp;&nbsp;<a title="Lihat atau Cetak" href="'.base_url().''.$tautan.'/cetak/analisislengkap/'.$id_mapel.'/'.$e->ulangan.'" target="_blank">Analisis Lengkap</a>';
			echo '&nbsp;&nbsp;&nbsp;<a title="Lihat atau Cetak" href="'.base_url().''.$tautan.'/cetak/analisis/'.$id_mapel.'/'.$e->ulangan.'" target="_blank">Analisis</a>';
			echo '&nbsp;&nbsp;&nbsp;<a title="Lihat atau Cetak" href="'.base_url().''.$tautan.'/cetak/remidial/'.$id_mapel.'/'.$e->ulangan.'" target="_blank">Remidial</a>';
			echo '&nbsp;&nbsp;&nbsp;<a title="Lihat atau Cetak" href="'.base_url().''.$tautan.'/cetak/pengayaan/'.$id_mapel.'/'.$e->ulangan.'" target="_blank">Pengayaan</a>';
			}
		echo '<br /><br />';
		}
		}
	}
}
?>
</div></div></div>
