<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<?php
$golonganex = Pangkat_Sesudah($golongan);
$golonganex = preg_replace("/\//","_", $golonganex);
$golonganx = preg_replace("/\//","_", $golongan);
$xloc = base_url().'dupak/mencetak';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<?php
$ta = $this->db->query("SELECT * FROM `p_kepegawaian` where `idpegawai`='$username' and (`jenis_sk` = 'SK CPNS' or `jenis_sk` = 'SK PNS' or `jenis_sk` = 'SK KP')");
echo '<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Golongan Saat Pengajuan PAK</label></div><div class="col-sm-9">';
echo "<select name=\"golongan\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value ="'.$xloc.'/'.$golonganex.'">'.$golongan.'</option>';
foreach($ta->result() as $a)
{
	$golongan = substr($a->gol,3,10);
	$golongane = preg_replace("/\//","_", $golongan);
	echo '<option value ="'.$xloc.'/'.$golongane.'">'.$golongan.'</option>';
	}
echo '</select></div></div>';
if(!empty($golongan))
{
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Perangkat hendak dicetak</label></div><div class="col-sm-9">';
echo "<select name=\"noyangdicetak\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.$golonganex.'/1">DUPAK Lama</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/6">Surat Pernyataan Melaksanakan Kegiatan Proses Belajar Mengajar / Bimbingan</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/2">Dupak Baru</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/3">Surat Pernyataan Melaksanakan Tugas Pembelajaran / Bimbingan dan Tugas Tertentu</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/4">Surat Pernyataan Melakukan Kegiatan Pengembangan Keprofesian Berkelanjutan</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/5">Surat Pernyataan Melakukan Kegiatan Penunjang Tugas Guru</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/7">Rekap Pengembangan Diri dan Publikasi Ilmiah</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/8">Rekap Pengembangan Diri</option>';
	echo '<option value="'.$xloc.'/'.$golonganx.'/9">Rekap Publikasi Ilmiah</option>';
	echo '</select></div></div>';
}
?>
</form>
</div></div></div>
