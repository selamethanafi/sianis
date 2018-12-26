<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : bip_tambah.php
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
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
	$daftar_tapel = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
if ($aksi == 'tambah')
{
	?>
	<h4>Tambah Program Kerja</h4>
	<form method="post" action="<?php echo base_url(); ?><?php echo $tugase;?>/proker/<?php echo $id;?>" class="form-horizontal" role="form">

	<?php
	if (empty($thnajaran))
		{
		$thnajaran = cari_thnajaran();
		}
	if (empty($semester))
		{
		$semester = cari_semester();
		}

	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="nourut" class="form-control"  > </div></div>

	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div><div class="col-sm-9"><textarea name="nama_kegiatan" rows="5" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tujuan</label></div><div class="col-sm-9"><textarea name="tujuan" rows="5" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sasaran</label></div><div class="col-sm-9"><textarea name="sasaran" rows="5" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9"><textarea name="waktu" rows="5" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sumber Dana</label></div><div class="col-sm-9"><textarea name="sumberdana" rows="5" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hasil yang hendak dicapai</label></div><div class="col-sm-9"><textarea name="hasil" rows="5" class="form-control"></textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><textarea name="keterangan" rows="5" class="form-control"></textarea></div></div>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="form-control">
<input type="hidden" name="post_aksi" value="tambah_data" class="form-control">
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().''.$tugase.'/proker/'.$id.'"  class="btn btn-info"><b>Batal</b></a></p>';
}

if ($aksi == 'ubah')
{
echo '<h4>Ubah Program Kerja</h4>';
?><form method="post" action="<?php echo base_url(); ?><?php echo $tugase;?>/proker/<?php echo $id;?>" class="form-horizontal" role="form">
<?php
$tb = $this->db->query("SELECT * FROM `kalab_proker` where kodeguru='$kodeguru' and id='$id_proker'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
 echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$b->thnajaran."'>".$b->thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo "<option value='".$b->semester."'>".$b->semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="nourut" class="form-control" `value="'.$b->nourut.'"> </div></div>';

	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div><div class="col-sm-9"><textarea name="namakegiatan" class="form-control">'.$b->namakegiatan.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tujuan</label></div><div class="col-sm-9"><textarea name="tujuan" rows="5" class="form-control">'.$b->tujuan.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sasaran</label></div><div class="col-sm-9"><textarea name="sasaran" rows="5" class="form-control">'.$b->sasaran.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9"><textarea name="waktu" rows="5" class="form-control">'.$b->waktu.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sumber Dana</label></div><div class="col-sm-9"><textarea name="sumberdana" rows="5" class="form-control">'.$b->sumberdana.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hasil yang hendak dicapai</label></div><div class="col-sm-9"><textarea name="hasil" rows="5" class="form-control">'.$b->hasil.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><textarea name="keterangan" rows="5" class="form-control">'.$b->keterangan.'</textarea></div></div>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="form-control">
<input type="hidden" name="id_proker" value="'.$id_proker.'" class="form-control">
<input type="hidden" name="post_aksi" value="ubah_data" class="form-control">
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().''.$tugase.'/proker/'.$id.'" class="btn btn-info"><b>Batal</b></a></p>';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah

echo '</form>';
?>
</div></div></div>
