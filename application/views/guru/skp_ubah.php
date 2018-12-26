<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp_tugas.php
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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$tahunsekarang=$tahunpenilaian;

	echo '<p><a href="'.base_url().'pkg/skp" class="btn btn-info"><b> Kembali</b></a></p>';
	$tahunsekarang=$tahunpenilaian;
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and `kode` = '$nip'");
$permanen = 1;
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	}
if($permanen == 0)
{
	$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `id_skp_skor_guru` ='$id' and `nip`='$nip'");
	$adatb = $tb->num_rows();
	if($adatb>0)
	{
		echo form_open('pkg/ubahskp','class="form-horizontal" role="form"');
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahu</label></div><div class="col-sm-9">'.$tahunsekarang.'</strong></div></div>';
		foreach($tb->result() as $b)
			{
			//cari nilai ak
			$kode = $b->kode;
			$ak = 0;
			if($kode == '01')
				{
					$ak = $b->ak_target;
				}
				else
				{
					$tc = $this->db->query("SELECT * FROM `skp_tabel_skor` where `kode` ='$kode'");		
					foreach($tc->result() as $c)
					{
					$ak = $c->ak;
					}
				}
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->kegiatan.'</p></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Angka kredit</label></div><div class="col-sm-9"><p class="form-control">'.$ak.'</p></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah</label></div><div class="col-sm-9"><input type="number" min="1" name="kuantitas"  value="'.$b->kuantitas.'" class="form-control"> kali / buah</div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kualitas</label></div><div class="col-sm-9"><input type="number" min="1" name="kualitas" value="'.$b->kualitas.'" class="form-control"> %</div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9"><input type="number" min="1" max="31" name="waktu"  value="'.$b->waktu.'" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Satuan Waktu</label></div><div class="col-sm-9">
<select name="satuanwaktu" class="form-control">';
			if($b->satuanwaktu == 'bl')
			{
				echo '<option value="bl">bulan</option><option value="hr">hr</option>';
			}
			else
			{
				echo '<option value="hr">hari</option>';
				echo '<option value="bl">bulan</option>';
			}
			echo '</select></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Biaya</label></div><div class="col-sm-9">Rp<input type="number" min="0" name="biaya" value="'.$b->biaya.'" class="form-control"></div></div>';
			echo '<p class="text-center"><input type="hidden" name="ak" value="'.$ak.'"><input type="hidden" name="id_skp_skor_guru" value="'.$id.'"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
			}
		echo '</form>';
	}
	else
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
	}
}
else
{
	echo '<div class="alert alert-info">Sudah terproses, batalkan dulu</div>';
}
?>

</div></div></div>

