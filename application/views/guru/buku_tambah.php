<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: buku_tambah.php
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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php 

if ($aksi == 'tambah')
{
	?>
	<form method="post" action="<?php echo base_url(); ?>guru/buku" class="form-horizontal" role="form">
	<?php
	$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><select name="mapel" class="form-control">';
	echo '<option value="">Pilih Mapel</option>';
	foreach ($ta->result() as $a)
	{
		echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
	}
	echo '</select></div></div>';
	$td = $this->db->query("select * from m_kelas order by kelas");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="tingkat" class="form-control">';
		echo '<option value="">Pilih Kelas</option>';
	foreach($td->result() as $d)
		{
		echo '<option value="'.$d->kelas.'">'.$d->kelas.'</option>';
		}
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul Buku</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pengarang</label></div><div class="col-sm-9"><input type="text" name="pengarang" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penerbit</label></div><div class="col-sm-9"><input type="text" name="penerbit" class="form-control"></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><select name="keterangan" class="form-control">';
	echo '<option value="1">Utama</option>';
	echo '<option value="0">Pendukung</option>';
	echo '</select></div></div>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'">
<input type="hidden" name="post_aksi" value="tambah_data">
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'guru/buku" class="btn btn-info"><b>Batal</b></a></p>';
}

if ($aksi == 'ubah')
{
echo '<h4>Ubah Data Buku Pegangan</h4>';
?><form method="post" action="<?php echo base_url(); ?>guru/buku" class="form-horizontal" role="form">
<?php
$tb = $this->db->query("SELECT * FROM `guru_buku_pegangan` where kodeguru='$kodeguru' and `id_guru_buku_pegangan`='$id_guru_buku_pegangan'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
		$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><select name="mapel" class="form-control">';
		echo '<option value="'.$b->mapel.'">'.$b->mapel.'</option>';
		foreach ($ta->result() as $a)
		{
		echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
		}
		echo '</select></div></div>';
		$td = $this->db->query("select * from m_kelas order by kelas");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="tingkat" class="form-control">';
		echo '<option value="'.$b->tingkat.'">'.$b->tingkat.'</option>';
	foreach($td->result() as $d)
		{
		echo '<option value="'.$d->kelas.'">'.$d->kelas.'</option>';
		}
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul Buku</label></div><div class="col-sm-9"><input type="text" name="judul" value="'.$b->judul.'" class="form-control"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pengarang</label></div><div class="col-sm-9"><input type="text" name="pengarang" value="'.$b->pengarang.'" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penerbit</label></div><div class="col-sm-9"><input type="text" name="penerbit" value="'.$b->penerbit.'" class="form-control"></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><select name="keterangan" class="form-control">';
	if ($b->keterangan == '1')
		{
		echo '<option value="1">Utama</option>';
		echo '<option value="0">Pendukung</option>';

		}
		else
		{
		echo '<option value="0">Pendukung</option>';
		echo '<option value="1">Utama</option>';

		}
	echo '</select></div></div>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="form-control"">
<input type="hidden" name="id_guru_buku_pegangan" value="'.$id_guru_buku_pegangan.'">
<input type="hidden" name="post_aksi" value="ubah_data" class="form-control">
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'guru/buku" class="btn btn-info"><b>Batal</b></a></p>
';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah

echo '</form>';
?>
</div></div></div>
