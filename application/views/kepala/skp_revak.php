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
$tahunsekarang=$tahun;
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
	echo '<p><a href="'.base_url().'kepala/periksaskp/'.$tahun.'/'.$nip.'" class="btn btn-info"><b> Kembali</b></a></p>';
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and `kode` = '$nip'");
$permanen = 1;
foreach($tz->result() as $z)
{
	$permanen = $z->kepala;
	$idskawal = $z->skawal;
}
		$gol1 = id_sk_jadi_golongan($idskawal) ;;
		$ref_ak = 0;
		$te = $this->db->query("select * from `skp_skor` where `golongan`='$gol1' and `kriteria`='b'");
		foreach($te->result() as $e)
		{
			$ref_ak = $e->skor;
		}
		$p100 = $ref_ak;
		$p75 = 0.75 * $p100;
		$p50 = 0.5 * $p100;
		$p25 = 0.25 * $p100;
		$p5 = 0.05 * $p100;
		$p2 = 0.2 * $p100;
		

if($permanen == 0)
{
	$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `id_skp_skor_guru` ='$id' and `nip`='$nip'");
	$adatb = $tb->num_rows();
	if($adatb>0)
	{
		echo form_open('kepala/updaterevak/'.$tahun.'/'.$nip,'class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">'.$tahunsekarang.'</strong></div></div>';
		foreach($tb->result() as $b)
		{
			$kuantitas = $b->kuantitas;
			$kualitas = $b->kualitas;
			$waktu = $b->waktu;
			$biaya = $b->biaya;
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
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->kegiatan.'</p></div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Angka kredit rujukan</label></div><div class="col-sm-9"><p class="form-control">'.$ak.'</p>';
echo 'Golongan '.$gol1.' 100% = '.$p100.' 75% = '.$p75.' 50% = '.$p50.' 25% = '.$p25.' 5% = '.$p5.' 2% = '.$p2; echo '</div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Target Angka kredit</label></div><div class="col-sm-9"><input type="text" name="ak_target" value="'.$b->ak_target.'" class="form-control"></div></div>';

			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ouput</label></div><div class="col-sm-9"><input type="number" min="1" name="kuantitas"  value="'.$b->kuantitas.'" class="form-control"> kali / buah</div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kualitas Output</label></div><div class="col-sm-9"><input type="number" min="1" name="kualitas" value="'.$b->kualitas.'" class="form-control"> %</div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9"><input type="number" min="1" max="31" name="waktu"  value="'.$b->waktu.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Satuan Waktu</label></div><div class="col-sm-9">
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
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Biaya</label></div><div class="col-sm-9">Rp<input type="number" min="0" name="biaya" value="'.$b->biaya.'" class="form-control"></div></div>';
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

