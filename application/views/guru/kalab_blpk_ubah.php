<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kalab_blpk_ubah.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="card-header"><h3><?php echo 'Ubah Laporan Kegiatan '.$namatugas;?></h3></div>
<div class="card-body">
<?php 
$daftar_tapel = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
?>
<form method="post" action="<?php echo base_url(); ?><?php echo $tugase;?>/blpk/<?php echo $id;?>" class="form-horizontal" role="form">
<?php
$tb = $this->db->query("SELECT * FROM `kalab_harian` where kodeguru='$kodeguru' and id_kalab_harian='$id_proker'");
if(count($tb->result())>0)
{
	foreach($tb->result() as $b)
	{
	 echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9">'.$kodeguru.'</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$b->thnajaran."'>".$b->thnajaran."</option>";
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo "<option value='".$b->semester."'>".$b->semester."</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9"><p class="form-control-static">';
	echo ''.date_to_long_string($b->tanggal).'</p></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->namakegiatan.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->tempat.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu/pukul</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->waktu.'</p></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->keterangan.'</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Terlaksana</label></div><div class="col-sm-9"><input type="text" name="terlaksana" class="form-control" value="'.$b->terlaksana.'"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Persentase</label></div><div class="col-sm-9"><input type="text" name="persentase" class="form-control" value="'.$b->persentase.'"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="keterangan_pelaksanaan" class="form-control" value="'.$b->keterangan_pelaksanaan.'"> </div></div>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="form-control">
<input type="hidden" name="id_kalab_harian" value="'.$id_proker.'" class="form-control">
<input type="hidden" name="post_aksi" value="ubah_data" class="form-control"><p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().''.$tugase.'/blpk/'.$id.'" class="btn btn-primary"><b>Batal</b></a></p>';
		} // data
	} //kalau ada / ditemukan
	else
{
	echo '<div class="alert alert-warning"><strong>Galat, data tidak ditemukan</strong></div>';
	echo 'Kalau Halaman ini tidak berpindah, klik  <a href="'.base_url().''.$tugase.'/blpk/'.$id.'" class="btn btn-info">di sini</a>';

}
echo '</form></div>';
?>
