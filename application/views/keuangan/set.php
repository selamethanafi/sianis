<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : set.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$xloc = base_url().'keuangan/set';
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
?>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
<?php
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result() as $a)
{
	echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';
}
?>
</select></div></div></form>

<?php echo form_open('keuangan/set/'.$tahun1,'class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tingkat</label></div><div class="col-sm-9">
<select name="tingkat" class="form-control">
<?php
	echo '<option value=""></option>';
foreach($querytingkat->result() as $bc)
{
	echo '<option value="'.$bc->kelas.'">'.$bc->kelas.'</option>';
}
?>
</select></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pembayaran</label></div><div class="col-sm-9">
<select name="macam_pembayaran" class="form-control">
<?php
	echo '<option value=""></option>';
foreach($querymacamaktif->result() as $bb)
{
	echo '<option value="'.$bb->nama.'">'.$bb->nama.'</option>';
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar</label></div><div class="col-sm-9">
<input name="besar" class="form-control" type="number"></div></div><input name="thnajaran" type="hidden" value="<?php echo $thnajaran;?>">
<p class="text-center"><input type="submit" value="Simpan Nilai Pembayaran" class="btn btn-primary">
</form>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td><strong>Macam Pembayaran</strong></td><td><strong>Tingkat</strong></td><td><strong>Besar</strong></td><td><strong>Aksi</strong></td></tr>
<?php

$nomor=1;
foreach($daftar_set->result() as $bd)
{
		echo '<tr><td>'.$bd->macam_pembayaran.'</td><td>'.$bd->tingkat.'</td><td align="right">'.number_format($bd->besar).'</td><td></td></tr>';

$nomor++;
}
?>
</table></div>
</div></div></div>
