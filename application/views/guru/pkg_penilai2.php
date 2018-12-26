<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp_penunjang.php
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
<div class="card-header"><h3>Ubah Penilai PKG</h3></div>
<div class="card-body">
<?php
echo '<p><a href="'.base_url().'pkg" class="btn btn-info"><b> Kembali</b></a></p>';
echo form_open('pkg/penilai2','class="form-horizontal" role="form"');
$tc = $this->db->query("SELECT * FROM `p_pegawai` where `kd`='$nim'");
foreach($tc->result() as $c)
{
	$nip_pegawai = $c->nip;
}	
$kode_penilai = '';
$tanggal = '';
$ta = $this->db->query("SELECT * FROM `pkg_tim_penilai` where `kode_ternilai`='$nip_pegawai' and `tahun`='$tahun'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `pkg_tim_penilai` (`kode_ternilai`,`tahun`) values ('$nip_pegawai','$tahun')");
}
$ta = $this->db->query("SELECT * FROM `pkg_tim_penilai` where `kode_ternilai`='$nip_pegawai' and `tahun`='$tahun'");
foreach($ta->result() as $a)
{
	$nip_penilai = $a->kode_penilai;
	$nama_penilai  = $a->nama_penilai;
	$tanggal = $a->tanggal;
}
echo '<div class="form-group row row"><div class="col-sm-6"><label class="control-label"><strong>Tahun</strong></label></div><div class="col-sm-6"> <strong>'.$tahun.'</strong></div></div>
	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Nama Penilai</label></div><div class="col-sm-6"><input type="text" name="nama_penilai" value="'.$nama_penilai.'" placeholder="nama penilai" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">NIP Penilai</label></div><div class="col-sm-6"><input type="text" name="nip_penilai" value="'.$nip_penilai.'" placeholder="nip penilai"  class="form-control"><strong>Kalau penilai guru '.$sek_nama.', klik di<a href="'.base_url().'pkg/penilai/'.$tahun.'">sini</a></strong></div></div>

	<div class="form-group row row"><div class="col-sm-6"><label class="control-label"><strong>Tanggal Pelaksanaan PKG </strong></label></div><div class="col-sm-2"><select name="haripkg"  class="form-control">';
	$postedhari=substr($tanggal,8,2);
	$postedbulan=substr($tanggal,5,2);
	$postedtahun=substr($tanggal,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}	
	for($i=10;$i<=31;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="bulanpkg" class="form-control">';
	echo '<option value="'.$postedbulan.'">'.$postedbulan.'</option>';	
        for($i=1;$i<10;$i++)
	{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
	}
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select></div><div class="col-sm-2">';
	echo '<select name="tahunpkg" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
        $th=date("Y");
        $awal_th=$th-4;
        $akhir_th=$th;
        for($i=$awal_th;$i<=$akhir_th;$i++)
	{
       		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div></div><p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
</form>';
?>
</div></div></div>
