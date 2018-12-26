<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rpp_unduh_csv.php
// Lokasi      : application/views/guru/
// Author: Selamet Hanafi
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
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<?php 
if ($aksi == 'tambah')
{
	echo '<h4>Tambah RPP</h4>';
echo '<a href="'.base_url().'index.php/guru/rpp/tampil"><b>Batal</b></a>';
echo form_open('guru/rpp/tampil/','class="form-horizontal" role="form"');
echo '<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9"><p class="form-control-static">'.$kodeguru.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran </label></div><div class="col-sm-9">';
$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
echo '<select name="mapel" class="form-control">';
echo '<option value=""></option>';
foreach ($ta->result() as $a)
{
	echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
}
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
echo '<select name="semester" class="form-control">';
echo '<option value=""></option>';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas </label></div><div class="col-sm-9">';
echo '<select name="kelas" class="form-control">';
echo '<option value=""></option>';
echo '<option value="X">X</option>';
echo '<option value="XI">XI</option>';
echo '<option value="XII">XII</option>';
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alokasi Waktu</label></div><div class="col-sm-9"><input type="text" name="waktu" class="form-control"> Jam Pelajaran</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor RPP </label></div><div class="col-sm-9"><input type="text" name="no_rpp" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Standar Kompetensi  (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="standar_kompetensi" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Kompetensi Dasar (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="kompetensi_dasar" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Materi Pembelajaran  (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="materi_pembelajaran" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Rencana Pembelajaran (dibutuhkan RPH/BPH)</div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="rencana" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Perintah / Tugas  (dibutuhkan RPH/BPH), tambahkan keterangan / waktu / tanggal pengumpulan, bila tugas terstruktur.</div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="tugas" rows="15" class="form-control"></textarea></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Tugas  (dibutuhkan RPH/BPH)</label></div>';
	echo '<div class="col-sm-9"><select name="jenis" class="form-control">';
		echo '<option value="01">Mandiri Terstruktur</option>';
		echo '<option value="00">Mandiri Tak Terstruktur</option>';
		echo '<option value="10">Kelompok Tak Tak Terstruktur</option>';
		echo '<option value="11">Kelompok Terstruktur</option>';
	echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Indikator Pencapaian Kompetensi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="indikator_pencapaian_kompetensi" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Tujuan Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="tujuan_pembelajaran" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Model_Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="model_pembelajaran" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Strategi Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="strategi_pembelajaran" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Sumber Belajar</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="sumber_belajar" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Pendahuluan</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="pendahuluan" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Eksplorasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="eksplorasi" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Elaborasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="elaborasi" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Konfirmasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="konfirmasi" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Penutup</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="penutup" rows="15" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Penilaian</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="penilaian" rows="15" class="form-control"></textarea></div></div>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rpp/tampil" class="btn btn-info"><b>Batal</b></a></p>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'">
<input type="hidden" name="post_aksi" value="tambah_data">
</form>';
}

if ($aksi == 'ubah')
{
echo '<h4>Ubah RPP</h4>';
	echo form_open('guru/rpp/tampil','class="form-horizontal" role="form"');
	$tb = $this->db->query("SELECT * FROM `guru_rpp_induk` where kodeguru='$kodeguru' and id_guru_rpp_induk='$id_guru_rpp_induk'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9"><p class="form-control-static">'.$kodeguru.'</p></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';
			$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
			echo '<select name="mapel" class="form-control">';
			echo '<option value="'.$b->mapel.'">'.$b->mapel.'</option>';
			foreach ($ta->result() as $a)
			{
			echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
			}
			echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
echo '<select name="semester" class="form-control">';
echo '<option value="'.$b->semester.'">'.$b->semester.'</option>';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo '<select name="kelas" class="form-control">';
echo '<option value="'.$b->kelas.'">'.$b->kelas.'</option>';
echo '<option value="X">X</option>';
echo '<option value="XI">XI</option>';
echo '<option value="XII">XII</option>';
echo '</select></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alokasi Waktu</label></div><div class="col-sm-9"><input type="text" name="waktu" value="'.$b->waktu.'"  class="form-control"> Jam Pelajaran</div></div>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Nomor RPP </label></div>
	<div class="col-sm-9"><input type="text" name="no_rpp" value="'.$b->no_rpp.'" class="form-control"></div>
</div>
<div class="form-group row row">
	<div class="col-sm-12"><label class="control-label">Standar Kompetensi (dibutuhkan RPH/BPH)</label></div>
</div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="standar_kompetensi" rows="15" class="form-control">'.$b->standar_kompetensi.'</textarea>
</div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Kompetensi Dasar (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="kompetensi_dasar" rows="15" class="form-control">'.$b->kompetensi_dasar.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Rencana Pembelajaran (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="rencana" rows="15" class="form-control">'.$b->rencana.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Materi Pembelajaran (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="materi_pembelajaran" rows="15" class="form-control">'.$b->materi_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Perintah / Tugas  (dibutuhkan RPH/BPH), tambahkan keterangan / waktu / tanggal pengumpulan, bila tugas terstruktur.</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="tugas" rows="15" class="form-control">'.$b->tugas.'</textarea></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Tugas  (dibutuhkan RPH/BPH)';
	echo '</label></div><div class="col-sm-9"><select name="jenis" class="form-control">';
	if ($b->jenis=='01')
		{
		echo '<option value="01">Mandiri Terstruktur</option>';
		echo '<option value="00">Mandiri Tak Terstruktur</option>';
		echo '<option value="10">Kelompok Tak Tak Terstruktur</option>';
		echo '<option value="11">Kelompok Terstruktur</option>';
		}
	elseif ($b->jenis=='10')
		{
		echo '<option value="10">Kelompok Tak Tak Terstruktur</option>';
		echo '<option value="11">Kelompok Terstruktur</option>';
		echo '<option value="00">Mandiri Tak Terstruktur</option>';
		echo '<option value="01">Mandiri Terstruktur</option>';
		}
	elseif ($b->jenis=='11')
		{
		echo '<option value="11">Kelompok Terstruktur</option>';
		echo '<option value="10">Kelompok Tak Tak Terstruktur</option>';
		echo '<option value="00">Mandiri Tak Terstruktur</option>';
		echo '<option value="01">Mandiri Terstruktur</option>';
		}
	else
		{
		echo '<option value="00">Mandiri Tak Terstruktur</option>';
		echo '<option value="01">Mandiri Terstruktur</option>';
		echo '<option value="10">Kelompok Tak Tak Terstruktur</option>';
		echo '<option value="11">Kelompok Terstruktur</option>';
		}
	echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Indikator Pencapaian Kompetensi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="indikator_pencapaian_kompetensi" rows="15" class="form-control">'.$b->indikator_pencapaian_kompetensi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Tujuan Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="tujuan_pembelajaran" rows="15" class="form-control">'.$b->tujuan_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Model_Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="model_pembelajaran" rows="15" class="form-control">'.$b->model_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Strategi Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="strategi_pembelajaran" rows="15" class="form-control">'.$b->strategi_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Sumber Belajar</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="sumber_belajar" rows="15" class="form-control">'.$b->sumber_belajar.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Pendahuluan</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="pendahuluan" rows="15" class="form-control">'.$b->pendahuluan.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Eksplorasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="eksplorasi" rows="15" class="form-control">'.$b->eksplorasi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Elaborasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="elaborasi" rows="15" class="form-control">'.$b->elaborasi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Konfirmasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="konfirmasi" rows="15" class="form-control">'.$b->konfirmasi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Penutup</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="penutup" rows="15" class="form-control">'.$b->penutup.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Penilaian</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="penilaian" rows="15" class="form-control">'.$b->penilaian.'</textarea></div></div>
';

		} // data
	} //kalau ada / ditemukan
?>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url();?>guru/rpp/tampil" class="btn btn-info"><b>Batal</b></a></p>
<input type="hidden" name="kodeguru" value="<?php echo $kodeguru;?>">
<input type="hidden" name="id_bimtik_rpp" value="<?php echo $id_guru_rpp_induk;?>">
<input type="hidden" name="post_aksi" value="ubah_data"></form>
<?php
} // kalau ubah

if ($aksi == 'salin')
{
echo '<h4>Salin RPP</h4>';
echo form_open('guru/rpp/salin','class="form-horizontal" role="form"');
if (empty($id_guru_rpp_induk))
	{
	echo '<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9"><p class="form-control-static">'.$kodeguru.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">No RPP yang disalin</label></div><div class="col-sm-9">';
	$tc = $this->db->query("SELECT * FROM `guru_rpp_induk` where kodeguru='$kodeguru'");
	echo '<select name="id_kopi" class="form-control">';
	foreach ($tc->result() as $c)
		{
		echo '<option value="'.$c->id_guru_rpp_induk.'">'.$c->no_rpp.'</option>';
		}
	echo '</select></div></div>
	<p class="text-center"><input type="hidden" name="post_aksi" value="salin_data"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rpp/tampil" class="btn btn-info"><b>Batal</b></a></p>';
	}
$tb = $this->db->query("SELECT * FROM `guru_rpp_induk` where kodeguru='$kodeguru' and id_guru_rpp_induk='$id_guru_rpp_induk'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
 echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9"><p class="form-control-static">'.$kodeguru.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';
$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
echo '<select name="mapel" class="form-control">';
echo '<option value="'.$b->mapel.'">'.$b->mapel.'</option>';
foreach ($ta->result() as $a)
{
	echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
}
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
echo '<select name="semester"  class="form-control">';
echo '<option value="'.$b->semester.'">'.$b->semester.'</option>';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '</select></div></div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo '<select name="kelas"  class="form-control">';
echo '<option value="'.$b->kelas.'">'.$b->kelas.'</option>';
echo '<option value="X">X</option>';
echo '<option value="XI">XI</option>';
echo '<option value="XII">XII</option>';
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Alokasi Waktu</label></div><div class="col-sm-9"><input type="text" name="waktu" value="'.$b->waktu.'"  class="form-control"> Jam Pelajaran</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor RPP </label></div><div class="col-sm-9"><input type="text" name="no_rpp" value="'.$b->no_rpp.'" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Standar Kompetensi  (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="standar_kompetensi" rows="15"class="form-control">'.$b->standar_kompetensi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Kompetensi Dasar  (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="kompetensi_dasar" rows="15"class="form-control">'.$b->kompetensi_dasar.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Indikator Pencapaian Kompetensi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="indikator_pencapaian_kompetensi" rows="15" class="form-control">'.$b->indikator_pencapaian_kompetensi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Tujuan Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="tujuan_pembelajaran" rows="15" class="form-control">'.$b->tujuan_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Materi Pembelajaran  (dibutuhkan RPH/BPH)</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="materi_pembelajaran" rows="15" class="form-control">'.$b->materi_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Model_Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="model_pembelajaran" rows="15" class="form-control">'.$b->model_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Strategi Pembelajaran</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="strategi_pembelajaran" rows="15" class="form-control">'.$b->strategi_pembelajaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Sumber Belajar</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="sumber_belajar" rows="15" class="form-control">'.$b->sumber_belajar.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Pendahuluan</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="pendahuluan" rows="15" class="form-control">'.$b->pendahuluan.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Eksplorasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="eksplorasi" rows="15" class="form-control">'.$b->eksplorasi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Elaborasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="elaborasi" rows="15" class="form-control">'.$b->elaborasi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Konfirmasi</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="konfirmasi" rows="15" class="form-control">'.$b->konfirmasi.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Penutup</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="penutup" rows="15" class="form-control">'.$b->penutup.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Penilaian</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="penilaian" rows="15" class="form-control">'.$b->penilaian.'</textarea></div></div>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rpp/tampil" class="btn btn-info"><b>Batal</b></a></p>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'">
<input type="hidden" name="post_aksi" value="tambah_data">
</form>';
		} // data
	} //kalau ada / ditemukan

} // kalau salin
?>
</div></div></div>
