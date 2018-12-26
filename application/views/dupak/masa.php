<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 23:00:22 WIB 
// Nama Berkas 		: tapel.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<link href="<?php echo base_url();?>assets/bootstrap_datepicker/css/datepicker.css" rel="stylesheet">
<div class="container-fluid">
<?php
$galat = 0;
$tmt = '';
$tahun = 0;
$bulan = 0;
$versi = '';
$golongan = preg_replace("/_/","/", $aksi);
$tc = $this->db->query("SELECT * FROM `dupak_masa` where `username`='$username' and `golongan` = '$golongan'");
$awal = 0;
foreach($tc->result() as $c)
{
	$versi = $c->versi;
	$awal = $c->awal;
	$akhir_penilaian = $c->akhir_penilaian;
	$awal_penilaian = $c->awal_penilaian;
	$tmt = $c->tmt;
	$tahun = $c->tahun;
	$bulan = $c->bulan;
	$tahun_baru = $c->tahun_baru;
	$bulan_baru = $c->bulan_baru;
	$tanggal = $c->tanggal;
}

if (($aksi== 'III_a') or ($aksi== 'III_b') or ($aksi== 'III_c') or ($aksi== 'III_d') or ($aksi== 'IV_a') or ($aksi== 'IV_b') or ($aksi== 'IV_c') or ($aksi== 'IV_d'))
{

	$ta = $this->db->query("SELECT * FROM `p_kepegawaian` where `idpegawai`='$username' and `gol` like '%$golongan%' and (`jenis_sk` = 'SK CPNS' or `jenis_sk` = 'SK PNS' or `jenis_sk` = 'SK KP')");
	if(($ta->num_rows()==0) and ($awal == 1))
	{
		echo '<h1>SK Golongan '.$golongan.' tidak ditemukan. <a href="'.base_url().'dupak/masa" class="btn btn-info"><b>BATAL</b></a></h1>';
		$galat = 1;
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$tmt = $a->tmt;
			$tahun = $a->tahun;
			$bulan = $a->bulan;
		}
	}
	if($versi == 0)
	{
		$versine = 'Sebelum 2014';
	}
	elseif($versi == 1)
	{
		$versine = 'Gabungan 2013 dan 2014';
	}
	elseif($versi == 2)
	{
		$versine = '2014 dan setelahnya';
	}
	else
	{
		$versine = '';
	}
	?>
		<div class="card">
		<div class="card-header"><h3><?php echo 'Tambah '.$judulhalaman;?></h3></div>
		<div class="card-body">
		<?php echo form_open('dupak/masa','class="form-horizontal" role="form"');?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Masa Penilaian</label></div><div class="col-sm-9"><div class="input-group"><input type="text" name="awal_penilaian" value="<?php echo tanggal($awal_penilaian);?>" id="tanggal_lahir" class="form-control"><span class="input-group-addon">s.d.</span><input type="text" name="akhir_penilaian" value="<?php echo tanggal($akhir_penilaian);?>" id="tanggal" class="form-control"></div></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">TMT Golongan</label></div><div class="col-sm-9">
		<?php
			echo '<input type="text" name="tmt" value="'.tanggal($tmt).'" id="tanggal1" class="form-control">';
		?>
		</div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Masa Kerja</label></div>
		<div class="col-sm-9"><div class="input-group"><input type="text" name="tahun" value="<?php echo $tahun;?>" class="form-control"><span class="input-group-addon">tahun</span><input type="text" name="bulan" value="<?php echo $bulan;?>" class="form-control" ><span class="input-group-addon">bulan</span></div></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Masa Kerja Baru</label></div>
		<div class="col-sm-9"><div class="input-group"><input type="text" name="tahun_baru" value="<?php echo $tahun_baru;?>" class="form-control"><span class="input-group-addon">tahun</span><input type="text" name="bulan_baru" value="<?php echo $bulan_baru;?>" class="form-control" ><span class="input-group-addon">bulan</span></div></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal (untuk penandatangan)</label></div><div class="col-sm-9">
		<?php
			echo '<input type="text" name="tanggal" value="'.tanggal($tanggal).'" id="tanggal2" class="form-control">';
		?>
		</div></div>
		<?php $golongan = preg_replace("/_/","/", $aksi);
		if($galat == 0)
		{
			if($awal == 1)
			{
			?>
				<input type="hidden" name="tahun" value="<?php echo $tahun;?>">
				<input type="hidden" name="bulan" value="<?php echo $bulan;?>">
			<?php
			}?>
		<input type="hidden" name="proses" value="<?php echo $golongan;?>"><p class="text-center"><button type="submit" class="btn btn-primary">Simpan Tahun Pelajaran</button> <a href="<?php echo base_url(); ?>dupak/masa" class="btn btn-info"><b>BATAL</b></a></p></form>
		<?php }
}	
else
{
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Masa Penilaian</strong></td><td><strong>Golongan</strong></td><td><strong>Masa Kerja</strong></td><td><strong>Ubah Data</strong></td><td><strong>Tahun Pelajaran</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
	$golongan = preg_replace("/\//","_", $b->golongan);
echo '<tr align="center"><td>'.$nomor.'</td><td>'.date_to_long_string($b->awal_penilaian).' s.d. '.date_to_long_string($b->akhir_penilaian).'</td><td>'.$b->golongan.'</td><td>'.$b->tahun.' tahun '.$b->bulan.' bulan</td><td><a href="'.base_url().'dupak/masa/'.$golongan.'">Ubah</a></td><td><a href="'.base_url().'dupak/tapel/'.$golongan.'">Masukkan</a></td></tr>';
$nomor++;
}
?>
</table></div>
<?php
}?>
<script src="<?php echo base_url();?>assets/bootstrap_datepicker/js/bootstrap-datepicker.js"></script>
</div>
