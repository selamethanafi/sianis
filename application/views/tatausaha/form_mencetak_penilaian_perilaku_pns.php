<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: form_mencetak_penilaian_prestasi_kerja.php
// Lokasi      		: application/views/tatausaha/
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
<?php echo form_open('pdf_report/cetakppkpns','class="form-horizontal" role="form"');
$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' and `status_kepegawaian` like '%PNS%' order by nama_tanpa_gelar");
$tb = $this->db->query("select * from `pkg_masa` order by `tahun` DESC");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-9">
	<select name="tahun" class="form-control">';
       	echo '<option value="'.$tahunpenilaian.'">'.$tahunpenilaian.'</option>';
	foreach($tb->result() as $b)
	{
       	echo '<option value="'.$b->tahun.'">'.$b->tahun.'</option>';
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pegawai / Guru</label></div><div class="col-sm-9">
	<select name="kode" class="form-control">';
	echo "<option value=''> pilih guru / pegawai</option>";
	foreach($ta->result() as $a)
	{
       	echo '<option value="'.$a->nip.'">'.$a->nama_tanpa_gelar.' '.$a->nama.'</option>';
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Per Bulan atau Rekapitulasi</label></div><div class="col-sm-9">
	<select name="rekap" class="form-control">';
       	echo '<option value="rekap">Rekap</option>';
	echo '<option value="">Bulan</option>';
	echo '</select></div></div>';

	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Dari Bulan</label></div><div class="col-sm-9">
	<select name="awal" class="form-control">';
       	echo '<option value="0">Januari</option>';
       	echo '<option value="1">Februari</option>';
       	echo '<option value="2">Maret</option>';
       	echo '<option value="3">April</option>';
       	echo '<option value="4">Mei</option>';
       	echo '<option value="5">Juni</option>';
       	echo '<option value="6">Juli</option>';
       	echo '<option value="7">Agustus</option>';
       	echo '<option value="8">September</option>';
       	echo '<option value="9">Oktober</option>';
       	echo '<option value="10">November</option>';
       	echo '<option value="11">Desember</option>';
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Sampai Bulan</label></div><div class="col-sm-9">
	<select name="akhir" class="form-control">';
       	echo '<option value="1">Januari</option>';
       	echo '<option value="2">Februari</option>';
       	echo '<option value="3">Maret</option>';
       	echo '<option value="4">April</option>';
       	echo '<option value="5">Mei</option>';
       	echo '<option value="6">Juni</option>';
       	echo '<option value="7">Juli</option>';
       	echo '<option value="8">Agustus</option>';
       	echo '<option value="9">September</option>';
       	echo '<option value="10">Oktober</option>';
       	echo '<option value="11">November</option>';
       	echo '<option value="12">Desember</option>';
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9">
	<select name="nomor" class="form-control">';
       	echo '<option value="1">1</option>';
       	echo '<option value="2">2</option>';
       	echo '<option value="3">3</option>';
       	echo '<option value="4">4</option>';
       	echo '<option value="5">5</option>';
       	echo '<option value="6">6</option>';
       	echo '<option value="7">7</option>';
       	echo '<option value="8">8</option>';
       	echo '<option value="9">9</option>';
       	echo '<option value="10">10</option>';
       	echo '<option value="11">11</option>';
       	echo '<option value="12">12</option>';
	echo '</select></div></div>';

	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary"><input type="hidden" name="dicetak" value="perilaku"></p>';
?>
</form>
</div></div></div>
