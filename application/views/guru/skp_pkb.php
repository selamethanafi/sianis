<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp_pkb.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Jum 08 Jan 2016 14:03:16 WIB 
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
<div class="card-header"><h3> Tambah / Ubah Unsur PKB</h3></div>
<div class="card-body">
<?php
$tahunsekarang=$tahunpenilaian;
$tanggalsekarang = tanggal_hari_ini();
$tahunsaja = tahunsaja($tanggalsekarang);
$bulansaja = bulansaja($tanggalsekarang);
/*
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
//else
//{
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
if($status=='baru')
	{
	//cari nilainya
	$ta= $this->db->query("select * from `skp_tabel_skor` where kode='$kode'");
	foreach($ta->result() as $a)
		{
			$ak = $a->ak;
			$satuan = $a->satuan;
			$kegiatan_lengkap = $a->kegiatan_lengkap;
			$ak_target = $kuantitas * $a->ak;
		}
	if(!empty($kegiatane))
		{
		$kegiatan_lengkap = $kegiatane;
		}
		if($waktu == 0)
			{
			$waktu = 1;
			}
	$tz = 	$this->db->query("select * from `skp_skor_guru` where `kode` = '$kode' and `nip` = '$nip' and `tahun`='$tahunsekarang'");
	$ada = $tz->num_rows();
	if($ada == 0)
		{

		$this->db->query("INSERT INTO `skp_skor_guru` (`kode`,`unsur`, `kegiatan`, `ak`, `ak_target`,`kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `tahun`,`status`) VALUES ('$kode','C', '$kegiatan_lengkap', '$ak', '$ak_target', '$kuantitas', '$satuan', '100', '$waktu', '$satuanwaktu', '$biaya', '$nip', '$tahunsekarang','0')");
		}
		else
		{
		$this->db->query("update `skp_skor_guru` set `kegiatan`='$kegiatan_lengkap', `ak`=' $ak',  `ak_target`= '$ak_target', `kuantitas` = '$kuantitas', `satuan`='$satuan', `kualitas` = '100', `waktu` = '$waktu', `satuanwaktu` = '$satuanwaktu', `biaya`= '$biaya', `status`='0' where `kode` = '$kode' and `nip` = '$nip' and `tahun`='$tahunsekarang'");
		}
		header('Location: '.base_url().'pkg/skp'); //redirect browser to public main page
	}
echo form_open('pkg/tambahskp/pkb','class="form-horizontal" role="form"');
$tb = $this->db->query("SELECT * FROM `skp_tabel_skor` where `unsur`='C' order by kode");
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</strong></label></div><div class="col-sm-9"> <strong>'.$tahunsekarang.'</strong></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9">
<select name="kode" class="form-control">';
foreach($tb->result() as $b)
{
	echo '<option value ="'.$b->kode.'">'.$b->kegiatan.' ('.$b->ak.')</option>';
}
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah ( kali / buah )</label></div><div class="col-sm-9">
<input type="number" min="1" name="kuantitas"  value="1" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9">
<input type="number" min="1" name="waktu"  value="12" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Satuan Waktu</label></div><div class="col-sm-9">
<select name="satuanwaktu" class="form-control"><option value="bl">bulan</option><option value="hr">hari</option></select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Biaya (Rp)</label></div><div class="col-sm-9"><input type="number" min="0" name="biaya"  value="0" class="form-control"></div></div>
<p class="text-center"><input type="hidden" name="status"  value ="baru"><input type="submit" value="Simpan" class="btn btn-primary"></p></form>';
}
else
{
	echo 'Sudah terproses, batalkan dulu';
}
//}  //akhir filter tahun
?>
</div></div></div>

