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
echo '<p><a href="'.base_url().'kepala/periksaskp/'.$tahun.'/'.$nip.'" class="btn btn-info"><b> Kembali</b></a></p>';
$tahunsekarang=$tahun;
$idskawal = '';
$tf = $this->db->query("select * from `ppk_pns` where `kode`='$nip' and `tahun`='$tahun'");
		foreach($tf->result() as $f)
		{
			$idskawal = $f->skawal;
		}
		$gol1 = id_sk_jadi_golongan($idskawal) ;
$ref_ak = 0;
		$tc = $this->db->query("select * from `skp_skor` where `golongan`='$gol1' and `kriteria`='b'");
		foreach($tc->result() as $c)
		{
			$ref_ak = $c->skor;
		}
		$p100 = $ref_ak;
		$p75 = 0.75 * $p100;
		$p50 = 0.5 * $p100;
		$p25 = 0.25 * $p100;
		$p5 = 0.05 * $p100;
		$p2 = 0.02 * $p100;
		echo '<table class="table table-bordered"><tr align="center"><td>Golongan</td><td>AK 100%</td><td>AK 75%</td><td>AK 50%</td><td>AK 25%</td><td>AK 5%</td><td>AK 2%</td></tr>';
echo '<tr align="center"><td>'.$gol1.'</td><td>'.$p100.'</td><td>'.$p75.'</td><td>'.$p50.'</td><td>'.$p25.'</td><td>'.$p5.'</td><td>'.$p2.'</td></tr></table>';
	$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `id_skp_skor_guru` ='$id' and `nip`='$nip'");
	$adatb = $tb->num_rows();
	if($adatb>0)
	{
		echo form_open('kepala/simpanskp/'.$tahun.'/'.$nip.'/'.$id,'class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">'.$tahunsekarang.'</strong></div></div>';
		foreach($tb->result() as $b)
			{
			//cari nilai ak
			$kode = $b->kode;
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static">'.$kode.' '.$b->kegiatan.'</p></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Angka kredit Rujukan</label></div><div class="col-sm-9"><input type="text" name="ak"  value="'.$b->ak.'" class="form-control"></div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah</label></div><div class="col-sm-9"><input type="number" min="1" name="kuantitas"  value="'.$b->kuantitas.'" class="form-control"> kali / buah</div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kualitas</label></div><div class="col-sm-9"><input type="number" min="1" name="kualitas" value="'.$b->kualitas.'" class="form-control"> %</div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9"><input type="number" min="1" max="31" name="waktu"  value="'.$b->waktu.'" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Satuan Waktu</label></div><div class="col-sm-9">
<select name="satuanwaktu" class="form-control">';
			if(($b->satuanwaktu == 'bl') or ($b->satuanwaktu == 'Bl'))
			{
				echo '<option value="bl">bulan</option><option value="hr">hr</option>';
			}
			else
			{
				echo '<option value="hr">hari</option>';
				echo '<option value="bl">bulan</option>';
			}
			echo '</select></div></div>';
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Biaya</label></div><div class="col-sm-9">Rp<input type="number" min="0" name="biaya" value="'.$b->biaya.'" class="form-control"></div></div>';
			echo '<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
			}
		echo '</form>';
	}
	else
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
	}
?>

</div></div></div>

