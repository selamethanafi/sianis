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
<div class="container-fluid">
<?php
echo '<h2>Golongan '.$golongan.'</h2>';
if ($aksi== 'tambah')
{
	$golongan = preg_replace("/\//","_", $golongan);
	echo form_open('dupak/tapel/'.$golongan,'class="form-horizontal" role="form"');?>
		<div class="card">
		<div class="card-header"><h3><?php echo 'Tambah '.$judulhalaman;?></h3></div>
		<div class="card-body">
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><select name="thnajaran" class="form-control"><option value=""></option>
		<?php
		$tanggalhariini = tanggal_hari_ini();
			echo '<option value="'.substr($tanggalhariini,0,4).'">'.substr($tanggalhariini,0,4).'</option>';
		foreach($daftar_tapel->result() as $b)
		{
			echo '<option value="'.substr($b->thnajaran,0,4).'">'.substr($b->thnajaran,0,4).'</option>';
		}?></select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah Semester</label></div><div class="col-sm-9"><select name="semester" class="form-control" required><option value=""></option><option value="1">1</option><option value="2">2</option></select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Versi Dupak</label></div><div class="col-sm-9"><select name="versi" class="form-control" required><option value=""></option><option value="0">Sebelum 2014</option><option value="1">Gabungan 2013 dan 2014</option><option value="2">2014 dan sesudahnya</option></select></div></div>
<p class="text-center"><input type="hidden" name="proses" value="tambah"><p class="text-center"><button type="submit" class="btn btn-primary">Tambah Tahun Pelajaran</button> <a href="<?php echo base_url(); ?>dupak/masa" class="btn btn-info"><b>BATAL</b></a></p></form>
	<?php
}	

else
{
$golongan = preg_replace("/\//","_", $golongan);
$golongane = preg_replace("/_/","/", $golongan);
?>
<p><a href="<?php echo base_url(); ?>dupak/tapel/<?php echo $golongan;?>/tambah" class="btn btn-info"><b>Tambah Tahun</b></a> <a href="<?php echo base_url(); ?>dupak/masa" class="btn btn-info"><b>Ke Masa Penilaian</b></a></p>
<h3>Daftar tahun pelajaran yang dihitung masa kreditnya</h3>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tahun Penilaian</strong></td><td><strong>Cacah Semester</strong></td><td><strong>Versi Dupak</strong></td><td><strong>Hapus</strong></td></tr>
<?php
$nomor=1;
$v2013 = 0;
$v20132014 = 0;
$v2014 = 0;
foreach($query->result() as $b)
{
	if($b->versi == '0')
	{
		$versine = 'Sebelum 2014';
		$v2013 = 1;
	}
	elseif($b->versi == '1')
	{
		$versine = 'Gabungan 2013 dan 2014';
		$v20132014 = 1;
	}

	elseif($b->versi == '2')
	{
		$versine = '2014 dan sesudahnya';
		$v2014 = 1;
	}
	else
	{
		$versine = '?';
	}
	$cacah = $b->semester;
	$tahun = $b->tahun;
	$golongane = $b->golongan;
	$this->db->query("update `skp_skor_guru` set `golongan`='$golongane', `cacah` = '$cacah' where `nip`='$nip' and `tahun`='$tahun'");
echo "<tr align=\"center\"><td>".$nomor."</td><td>".$b->tahun."</td><td>".$b->semester."</td><td>".$versine."</td><td><a href='".base_url()."dupak/tapel/".$golongan."/hapus/".$b->id_dupak_tahun."' title='Hapus'><span class='fa fa-trash-alt'></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
Kalau tahun pelajaran sudah dimasukkan dilanjut menghitung Dupak dengan mengklik tombol berikut. <?php
	if($v2013 == 1)
	{?>
		<a href="<?php echo base_url();?>dupak/cetak/<?php echo $golongan;?>/lama" class="btn btn-success">LANJUT KE DUPAK LAMA</a>
	<?php
	}
	if($v20132014 == 1)
	{?>

		<a href="<?php echo base_url();?>dupak/olah/<?php echo $golongan;?>/gabungan/proses" class="btn btn-primary">LANJUT KE DUPAK GABUNGAN</a>
	<?php
	}
	if($v2014 == 1)
	{
		$tc = $this->db->query("SELECT * FROM `dupak_masa` where `username`='$nim' and `golongan` = '$golongane'");
		$awal = 0;
		foreach($tc->result() as $c)
		{
			$akhir_penilaian = $c->akhir_penilaian;
		}
		if((substr($akhir_penilaian,5,2) == '06') or (substr($akhir_penilaian,5,2) == '12'))
		{
		?>

		<a href="<?php echo base_url();?>dupak/olah/<?php echo $golongan;?>/baru/proses" class="btn btn-primary">LANJUT KE DUPAK SEPENUHNYA BARU</a>
	<?php
		}
		else
		{
			echo '<div class="alert alert-danger">Silakan memeriksa tanggal akhir masa penilaian.</div>';
		}
	}
}?>
</div>
