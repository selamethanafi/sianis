<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_edit.php
// Terakhir diperbarui	: Jum 13 Mei 2016 21:53:22 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?> - Nilai Per Siswa </h2>
<a href="<?php echo base_url(); ?>guru/analisis/<?php echo $id_mapel;?>/<?php echo $ulangan;?>"><span class="glyphicon glyphicon-arrow-left"></span><b> Kembali</b></a>
<form class="form-horizontal" role="form">
    <div class="form-group row row">
	<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
	<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?></p></div>
	<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $mapel;?></p></div>
	<div class="col-sm-3"><label for="ulangan" class="control-label">Ulangan</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $ulangan;?></p></div>
	<div class="col-sm-3"><label for="kkmmapel" class="control-label">KKM Mapel</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $kkm;?></p></div>
	<div class="col-sm-3"><label for="kkmulangan" class="control-label">KKM Ulangan / Cacah Soal / Skor</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $kkm_ulangan;?>  / <?php echo $nsoal;?> / <?php echo $skor;?></p></div>
    </div>
</form>

<?php
$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$ulangan' and `dipakai`='1'");
$adata = $ta->num_rows();
foreach($ta->result() as $a)
{
}
$tanalisis = $this->db->query("select * from analisis where id_analisis='$id_analisis'");
foreach($tanalisis->result() as $d)
{
$nis = $d->nis;
$namasiswa = nis_ke_nama($nis);
$tnilai = $this->db->query("select * from `nilai` where `nis`='$nis' and `mapel`='$mapel' and `thnajaran`='$thnajaran' and `semester`='$semester'");
$itemnilai = 'nilai_'.$ulangan;
$nilaine = '';
foreach($tnilai->result() as $dn)
{
	$nilaine = $dn->$itemnilai;
}
echo '<div class="alert alert-info"><strong>'.$namasiswa.'</strong>, di daftar nilai sudah mendapat nilai<h2>'.$nilaine.'</h2></div>';
echo form_open('guru/updateanalisis','class="form-horizontal" role="form"');
if (empty($entry))
{
	$nomor = 0;
	$kolom = 1;
	echo '<div class="table-responsive">
<table class="table table-striped table-bordered"><tr>';
	if($adata>0)
	{
		echo '<td colspan="3">Bagian A Soal Nomor</td></tr><tr><td>Nomor</td><td>Skor Maks</td><td>Skor</td></tr>';
	}
	else
	{
		echo '<td colspan="3">Bagian A Soal Nomor</td></tr><tr><td>Nomor</td><td>Skor</td></tr>';
	}

	do
	{
	$nomorsoal = $nomor+1;
	$itemenilai = "nilai_s".$nomorsoal;
	if($adata>0)
	{
		$itemskor = "s".$nomorsoal;
	}
	$nilaianalisis = $d->$itemenilai;
	echo '<tr><td>'.$nomorsoal.'</td>';
	if($adata>0)
	{
		echo '<td>'.$a->$itemskor.'</td>';
	}
	echo '<td colspan="2">';
	if($adata>0)
	{
		echo '<input type="number" class="form-control" name="nilai_s'.$nomorsoal.'" value="'.$nilaianalisis.'" max="'.$a->$itemskor.'"></td></tr>';
	}
	else
	{
		echo '<input type="number" class="form-control" name="nilai_s'.$nomorsoal.'" value="'.$nilaianalisis.'" max="'.$skor.'"></td></tr>';
	}

	$nomor++;
	}
	while ($nomor<$nsoal);
	if ($nsoalb>0)
	{
		$nomorb = 0;
		echo '<tr><td colspan="3">Bagian B Soal Nomor</td></tr></tr><td>Nomor</td><td colspan="2">Skor</td></tr>';
		do
		{
		$nomorsoalb = $nomorb+1;
		$itemenilaib = "uraian_".$nomorsoalb;
		$nilaianalisisb = $d->$itemenilaib;
	
		echo '<tr><td>'.$nomorsoalb.'</td><td colspan="2"><input type="number" class="form-control" name="uraian_'.$nomorsoalb.'" value="'.$nilaianalisisb.'"></td></tr>';
		$nomorb++;
		}
		while ($nomorb<$nsoalb);
	}
	echo '</table></div>';
}
else
{
	$nomor = 0;
	$nilaianalisis = '';
	echo 'Skor Bagian A Siswa berurutan, pisahkan dengan spasi : ';
	do
	{
	$nomorsoal = $nomor+1;
	$itemenilai = "nilai_s".$nomorsoal;
	if ($nomorsoal == 1)
		{

		$nilaianalisis .= $d->$itemenilai;
		}
		else
		{
		$nilaianalisis .= " ".$d->$itemenilai;
		}
	$nomor++;
	}
	while ($nomor<$nsoal);	
	echo '<input type="text" size="70" name="nilai_soal" value="'.$nilaianalisis.'">';
	if ($nsoalb>0)
	{
		$nomorb = 0;
		$nilaianalisisb = '';
		echo 'Skor Bagian B Siswa berurutan, pisahkan dengan spasi : ';
		do
		{	
		$nomorsoalb = $nomorb+1;
		$itemenilai = "uraian_".$nomorsoalb;
			if ($nomorsoalb == 1)
			{
				$nilaianalisisb .= $d->$itemenilai;
			}
			else
			{
			$nilaianalisisb .= " ".$d->$itemenilai;
			}
		$nomorb++;
		}
		while ($nomorb<$nsoalb);	
	echo '<input type="text" size="70" name="uraian" value="'.$nilaianalisisb.'">';
	}


}
}
?>
<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="entry" value="<?php echo $entry;?>">
<input type="hidden" name="id_analisis" value="<?php echo $id_analisis;?>">
<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
<input type="hidden" name="nsoal" value="<?php echo $nsoal;?>">
<input type="hidden" name="nsoalb" value="<?php echo $nsoalb;?>">
<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN DATA</button></p>
</form>
</div>
</BODY></HTML>

