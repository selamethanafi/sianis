<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp_tugas.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Jum 08 Jan 2016 14:03:25 WIB 
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
<p><a href="<?php echo base_url(); ?>pkg/skp" class="btn btn-info"><b>Kembali</b></a></p>
<?php
$tahunsekarang=$tahunpenilaian;
$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and `kode` = '$nip'");
$permanen = 1;
foreach($tz->result() as $z)
	{
	$permanen = $z->permanen;
	}
if($permanen == 0)
{

///cek sudah ada unsur utama
$tx=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahunsekarang' and `nip`='$nip' and `unsur`='B' and `kegiatan` like 'Melaksanakan Proses Pembelajaran%'");
if(count($tx->result())==0)
{
	echo 'Belum Ada Unsur Utama';

}
else
{
	foreach($tx->result() as $x)
	{
		$ak = $x->ak;

	}
	$kegiatan_lengkap = '';
	$ta= $this->db->query("select * from `skp_tabel_skor` where kode='$kode'");
	foreach($ta->result() as $a)
		{
			$satuan = $a->satuan;
			$kegiatan_lengkap = $a->kegiatan_lengkap;
		}
	if(!empty($kegiatane))
		{
		$kegiatan_lengkap = $kegiatane;
		}
	$cekkegiatan = $kegiatan_lengkap;
if($status=='baru')
	{

	//cari nilainya
	if ($waktu<12)
		{
		$ak_target = $ak * 2 / 100;
		$ak_target2 = $ak * 2 * $kuantitas / 100;
		$kegiatan_lengkap .= ' ( 2% x '.$ak.' )';
		}
		else
		{
		$ak_target = $ak * 5 / 100;
		$ak_target2 = $ak * 5 * $kuantitas / 100;
		$kegiatan_lengkap .= ' ( 5% x '.$ak.' )';
		}

	$tz = 	$this->db->query("select * from `skp_skor_guru` where `kode` = '$kode' and `nip` = '$nip' and `tahun`='$tahunsekarang'");
	$ada = $tz->num_rows();
	if($ada == 0)
		{
		if($waktu == 0)
			{
			$waktu = 1;
			}

	$this->db->query("INSERT INTO `skp_skor_guru` (`kode`,`unsur`, `kegiatan`, `ak`, `ak_target`, `kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`,  `nip`, `tahun`,`status`) VALUES ('$kode','Z', '$kegiatan_lengkap', '$ak_target', '$ak_target2', '$kuantitas', '$satuan', '100', '$waktu', '$satuanwaktu', '$biaya', '$nip', '$tahunsekarang','0')");
		}
		else
		{
		$this->db->query("update `skp_skor_ guru` set `kegiatan`='$kegiatan_lengkap', `ak`=' $ak_target',  `ak_target`= '$ak_target2', `kuantitas` = '$kuantitas', `satuan`='$satuan', `kualitas` = '100', `waktu` = '$waktu', `satuanwaktu` = '$satuanwaktu', `biaya`= '$biaya', `status`='0' where `kode` = '$kode' and `nip` = '$nip' and `tahun`='$tahunsekarang'");
		}
		header('Location: '.base_url().'pkg/skp'); //redirect browser to public main page
}
echo form_open('pkg/tambahskp/tugas','class="form-horizontal" role="form"');
$tb = $this->db->query("SELECT * FROM `skp_tabel_skor` where `unsur`='Z' order by kode");
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">'.$tahunsekarang.'</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9">
<select name="kode" class="form-control">';
foreach($tb->result() as $b)
{
	echo '<option value ="'.$b->kode.'">'.$b->kegiatan.'</option>';
}
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah</label></div><div class="col-sm-9">
<input type="number" min="1" name="kuantitas" value="1" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9">
<input type="number" min="1" max="31" name="waktu" value="12" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Satuan Waktu</label></div><div class="col-sm-9">
<select name="satuanwaktu" class="form-control"><option value="bl">bl</option><option value="hr">hr</option></select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Biaya</label></div><div class="col-sm-9"><input type="number" min="0" name="biaya" value="0" class="form-control"></div></div>
<p class="text-center"><input type="hidden" name="status"  value ="baru"><input type="submit" value="Simpan" class="btn btn-primary"></div></div>';
}
echo '</form>';
}
else
{
	echo '<div class="alert alert-warning">Sudah terproses, batalkan dulu</div>';
}
?>
</div></div></div>

