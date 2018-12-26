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
$xloc = base_url().'pkg/penilai';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-6">';
echo "<select name=\"tahun\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
	echo '<option value="'.$xloc.'/'.$tahun.'">'.$tahun.'</option>';
foreach($ta->result() as $a)
{
	echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.substr($a->thnajaran,0,4).'</option>';
}
echo '</select></div></div>';
echo '</form>';
echo form_open('pkg/penilai/'.$tahun,'class="form-horizontal" role="form"');
$tc = $this->db->query("SELECT * FROM `p_pegawai` where `kd`='$nim'");
foreach($tc->result() as $c)
{
	$nip_pegawai = $c->nip;
}	
$nip_penilai = '';
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
	$tanggal = $a->tanggal;
}
if(empty($nip_penilai))
{
	$nip_penilai = 'x';
}
$tb = $this->db->query("SELECT * FROM `p_pegawai` where `nip`='$nip_penilai'");
foreach($tb->result() as $b)
{
	$nama_penilai = $b->nama_tanpa_gelar;
}
echo '<div class="form-group row row"><div class="col-sm-6"><label class="control-label"><strong>Penilai</strong></label></div><div class="col-sm-6">
<select name="nip_penilai" class="form-control">';
echo '<option value ="'.$nip_penilai.'">'.$nama_penilai.'</option>';
$tc = $this->db->query("SELECT * FROM `p_pegawai` where `status`='Y' and `guru`='Y' and `kd` != '$nim' order by `nama_tanpa_gelar`");
foreach($tc->result() as $c)
{
	if(!empty($c->nip))
	{
		echo '<option value ="'.$c->nip.'">'.$c->nama_tanpa_gelar.'</option>';
	}
}
echo '</select><strong>Kalau penilai bukan guru '.$sek_nama.', klik di<a href="'.base_url().'pkg/penilai2/'.$tahun.'">sini</a></strong></div></div>
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
        $awal_th=$th-6;
        $akhir_th=$th;
        for($i=$awal_th;$i<=$akhir_th;$i++)
	{
       		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</select></div></div>';
	$tzz = $this->db->query("select * from `ppk_pns` where tahun = '$tahun' and kode = '$nip_pegawai'");
	if($tzz->num_rows() == 0)
	{
		$this->db->query("insert into `ppk_pns` (`tahun`, `kode`) values ('$tahun', '$nip_pegawai')");
	}
	$idskakhir = '';
	foreach($tzz->result() as $zz)
	{
		$idskakhir = $zz->skakhir;
	}
	$tkp = $this->db->query("select * from `p_kepegawaian` where `id` = '$idskakhir'");
	foreach($tkp->result() as $dkp)
	{
		$uraian = $dkp->uraian;
		$tmt = $dkp->tmt; 
	}

	$golongan = id_sk_jadi_golongan($idskakhir) ;
	$pangkat = golongan_jadi_pangkat($golongan);
	$jabatan = golongan_jadi_jabatan($golongan);
	$pangkatgolongan = $pangkat.', '.$golongan;

	echo '<div class="form-group row row"><div class="col-sm-6"><label class="control-label">SK yang berlaku di akhir penilaian SKP</label></div><div class="col-sm-6">
	<select name="idskakhir" class="form-control">';
	echo '<option value="'.$idskakhir.'">'.$uraian.'  '.tanggal($tmt).' - '.$pangkatgolongan.'</option>';
	foreach($query->result() as $l)
	{
	echo "<option value='".$l->id."'>".$l->uraian." ".tanggal($l->tmt)." - ".$l->pangkat.", ".substr($l->gol,3,20)."</option>";
	}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
</form>';
?>
</div></div></div>
