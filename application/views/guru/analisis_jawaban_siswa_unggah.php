<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_jawaban_siswa_unggah.php
// Terakhir diperbarui	: Sel 02 Okt 2018 07:41:47 WIB 
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
<?php
$pkunci = strlen($kunci);
$pkuncib = strlen($kuncib);
?>
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">

<tr><td width="250"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Analisis</strong></td><td>: <strong><?php echo $ulangan;?></strong></td></tr>
<tr><td><strong>KKM Mapel</strong></td><td>: <strong><?php echo $kkm;?> </strong> </td></tr>
<tr><td><strong>Kunci Jawaban Kelompok A</strong></td><td>: <strong><?php echo $kunci.' '.$pkunci;?> </strong></td></tr>
<tr><td><strong>Kunci Jawaban Kelompok B</strong></td><td>: <strong><?php echo $kuncib.' '.$pkuncib;?> </strong></td></tr>
</table>
<?php
echo '<p>';
if ($pkunci <> $nsoal)
	{
	echo '<strong>Cacah kunci A tidak sama dengan cacah soal</strong>';
	}
if ($pkuncib <> $nsoal)
	{
	echo '<strong>Cacah kunci B tidak sama dengan cacah soal, abaikan bila tidak menggunakan kunci B</strong>';
	}

?>
</p>
<?php
echo '<div class="from-group">';
echo form_open_multipart('guru/prosesunggahjawaban');?>
<p class="text-danger">
format data<br >
"nis","nama","kelompok","jawaban"</p>
Berkas :<input type="file" name="userfile"></div>
<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>">
<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
<input type="hidden" name="kkm" value="<?php echo $kkm;?>">
<input type="submit" value="Kirim Berkas" class="btn btn-primary"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/analisisjawabansiswa/<?php echo $id_mapel;?>/<?php echo $ulangan;?>" class="btn btn-info"><b>Batal</b></a>
</form>
</div></div></div>

