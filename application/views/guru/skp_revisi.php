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
$tanggalsekarang = tanggal_hari_ini();
$tahunsaja = tahunsaja($tanggalsekarang);
$bulansaja = bulansaja($tanggalsekarang);
if($tahunsaja != $tahunsekarang)
{
	echo 'SKP harus dibuat pada tahun berjalan';
}
// harus juga dibulan januari
/*
elseif($bulansaja != '01')
{
	echo 'SKP harus dibuat pada bulan Januari';
}
*/
else
{
	echo '<p><a href="'.base_url().'pkg/skp" class="btn btn-info"><b> Kembali</b></a></p>';
	$tahunsekarang=$tahunpenilaian;
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and `kode` = '$nip'");
$permanen = 1;
foreach($tz->result() as $z)
	{
	$permanen = $z->kepala;
	}
if($permanen == 0)
{
	$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `id_skp_skor_guru` ='$id' and `nip`='$nip'");
	$adatb = $tb->num_rows();
	if($adatb>0)
	{
		$tc = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id' and `nip`='$nip'");
		$adatc = $tc->num_rows();
		echo form_open('pkg/revisiskp','class="form-horizontal" role="form"');
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">'.$tahunsekarang.'</strong></div></div>';
		foreach($tb->result() as $b)
			{
			$kuantitas = $b->kuantitas;
			$kualitas = $b->kualitas;
			$waktu = $b->waktu;
			$biaya = $b->biaya;
			if($adatc == 0)
			{
				$this->db->query("insert into `skp_skor_guru_revisi` (`tahun`, `nip`, `id_skp_skor_guru_revisi`) values ('$tahunsekarang', '$nip', '$id')");
			}	
			$td = $this->db->query("SELECT * FROM `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` ='$id' and `nip`='$nip'");
			foreach($td->result() as $d)
			{
				$rkuantitas = $d->kuantitas;
				$rkualitas = $d->kualitas;
				$rwaktu = $d->waktu;
				$rbiaya = $d->biaya;
			}
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
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah</label></div><div class="col-sm-3"><p class="form-control-static">'.$b->kuantitas.'</p></div><div class="col-sm-3"><label class="control-label">Revisi</label></div><div class="col-sm-3"><input type="number" min="1" name="kuantitas"  value="'.$rkuantitas.'" class="form-control"> kali / buah</div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kualitas</label></div><div class="col-sm-3"><p class="form-control-static">'.$b->kualitas.'</p></div><div class="col-sm-3"><label class="control-label">Revisi</label></div><div class="col-sm-3"><input type="number" min="1" name="kualitas" value="'.$rkualitas.'" class="form-control"> %</div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-3"><p class="form-control-static">'.$b->waktu.'</p></div><div class="col-sm-3"><label class="control-label">Revisi</label></div><div class="col-sm-3"><input type="number" min="1" max="31" name="waktu"  value="'.$rwaktu.'" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Satuan Waktu</label></div><div class="col-sm-9">
<select name="satuanwaktu" class="form-control">';
			if($b->satuanwaktu == 'Bl')
			{
				echo '<option value="Bl">bulan</option><option value="hr">hari</option>';
			}
			else
			{
				echo '<option value="hr">hari</option>';
				echo '<option value="Bl">bulan</option>';
			}
			echo '</select></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Biaya</label></div><div class="col-sm-9">Rp<input type="number" min="0" name="biaya" value="'.$b->biaya.'" class="form-control"></div></div>';
			echo '<p class="text-center"><input type="hidden" name="ak" value="'.$ak.'"><input type="hidden" name="id_skp_skor_guru" value="'.$id.'"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'pkg/hapusrevisiskp/'.$id.'" data-confirm="Anda yakin ingin menghapus data ini REVISI CAPAIAN '.$b->kegiatan.'" title="Hapus Data REVISI CAPAIAN '.$b->kegiatan.'" class="btn btn-danger"><span class="fa fa-trash-alt"></span> HAPUS</a></p>';
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
} //akhir tahun
?>

</div></div></div>

