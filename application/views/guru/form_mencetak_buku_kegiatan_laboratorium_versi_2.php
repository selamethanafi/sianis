<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : form_mencetak_agenda_harian_kerja_kepala_laboratorium.php
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

<?php echo form_open('guru/formmencetak/'.$noyangdicetak,'class="form-horizontal" role="form"');?>
<?php 
echo '<input type="hidden" name="yangdicetak" value="Buku Kegiatan Laboratorium Versi 2"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<?php
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option><option value='2'>2</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Laboratorium</strong></label></div><div class="col-sm-9">';
	echo '<select name="lab" class="form-control">';
	//cari id_mapel terpilih
	$td = $this->db->query("select * from `m_tugas_tambahan` where `nama_tugas_tambahan` like 'kepala laboratorium%' order by `nama_tugas_tambahan`");
	foreach($td->result() as $d)
		{
		$nkar = strlen($d->nama_tugas_tambahan);
		$kiri = $nkar - 6;
		echo '<option value = "'.substr($d->nama_tugas_tambahan,7,$kiri).'">'.substr($d->nama_tugas_tambahan,7,$kiri).'</option>';
		}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9">';
	echo '<select name="ditandatangani" class="form-control">';
	echo '<option value="ya">ya</option>';
	echo '<option value="tidak">tidak</option>';
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak Buku Kegiatan Laboratorium" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
</div></div></div>
