<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: ruang_tes.php
// Lokasi      		: application/views/panitiates/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">

<?php
$xloc = base_url().'panitiates/ruangtes';
$kelasx = '';
$ta = $this->db->query("select * from `m_ruang` where `id_ruang`='$id_ruang'");
foreach($ta->result() as $a)
{
	$kelasx = $a->ruang;
	$nox = $a->no_tengah;
	$ruang_tes_satu = $a->ruang_tes_satu;
	$ruang_tes_dua = $a->ruang_tes_dua;

}
echo '<form name="formx" method="post" action="'.$xloc.'/'.$id_ruang.'" class="form-horizontal" role="form">';?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Siswa Kelas</label></div><div class="col-sm-9">
<select name="noyangdicetak" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo "<option value='".$kelasx."'>".$kelasx."</option>";
	foreach($daftar_kelas->result() as $ka)
	{
		$kelase = $ka->ruang;
		$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `kelas`='$kelase' and `semester`='$semester' and `status`='Y'");
		$adatb = $tb->num_rows();
		if($adatb>0)
		{
			echo '<option value="'.$xloc.'/'.$ka->id_ruang.'">'.$ka->ruang.'</option>';
		}
	}
	?>
	</select></div></div>
<?php
	if (!empty($kelasx))
	{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut <b>1</b> s.d. </label></div><div class="col-sm-9"><select name="no_tengah" class="form-control">
	<?php
		echo '<option value='.$nox.'>'.$nox.'</option>';
	$urutan = 1;
	do
	{
		echo '<option value='.$urutan.'>'.$urutan.'</option>';
		$urutan++;
	}
	while ($urutan < $jumlah_siswa+1);
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">ditempatkan di Ruang</label></div><div class="col-sm-9">
	<select name="ruang_tes_satu" class="form-control">
	<?php
	echo '<option value='.$ruang_tes_satu.'>'.$ruang_tes_satu.'</option>';
	$urutan = 1;
	do
	{
		echo '<option value='.$urutan.'>'.$urutan.'</option>';
		$urutan++;
	}
	while ($urutan < $jumlah_kelas+1);
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Selebihnya ditempatkan di Ruang</label></div><div class="col-sm-9">
	<select name="ruang_tes_dua" class="form-control">
	<?php
	echo '<option value='.$ruang_tes_dua.'>'.$ruang_tes_dua.'</option>';
	$urutan = 1;
	do
	{
		echo '<option value='.$urutan.'>'.$urutan.'</option>';
		$urutan++;
	}
	while ($urutan < $jumlah_kelas+1);
	?>
	</select></div></div>
	<?php
	}
if (!empty($id_ruang))
	{
	?>
	<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
	<?php
	}
?>
</form>
<br />
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tr bgcolor="#FFF" align="center"><td width="30"><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Ruang I</strong></td><td><strong>Ruang II</strong></td></tr>
<?php
$nomor=1;
foreach($daftar_kelas->result() as $b)
{
		// jumlah siswa
		$ruang = $b->ruang;
		$tsiskel = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$ruang' and `semester` = '$semester' and status='Y'");
		$jmlsis = $tsiskel->num_rows();
		$pes2 = $jmlsis - $b->no_tengah;
		if ($jmlsis>0)
		{
echo "<tr><td>".$nomor."</td><td>".$b->ruang."</td><td align=\"center\"><b>".$b->ruang_tes_satu."</b> (".$b->no_tengah." Peserta) </td><td align=\"center\"><b>".$b->ruang_tes_dua."</b> (".$pes2." Peserta)</td></tr>";
$nomor++;
		}
}
?>
</table></div>
<p>
<?php echo form_open('panitiates/prosesnomortes','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Format penomoran</label></div><div class="col-sm-9">
	<select name="format" class="form-control">
		<option value="1">UN</option>
		<option value="">Bawaan Sistem</option>
	</select>
</div></div>
</p>
<p class="text-center"><input type="submit" value="Proses Nomor Tes" class="btn btn-primary"></p>
</form>
</div></div></div>
