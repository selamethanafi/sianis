<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: nilai_ujian_nasional.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<?php echo form_open('tatausaha/nilaiunijazah','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="panel-body">
<?php
if ((empty($thnajaran)) or (empty($kelas)) or (empty($mapel)))
	{
	echo '<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9"><select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
		{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
	echo '</select></div></div>';
	echo '<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Kelas</label></div>
			<div class="col-sm-9"><select name="kelas" class="form-control">';
	$ta = $this->db->query("select * from m_ruang where ruang like 'XII-%' and status='1' order by ruang");
	echo "<option value=''></option>";
	foreach($ta->result() as $a)
		{
		echo "<option value='".$a->ruang."'>".$a->ruang."</option>";
		}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Unduh" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'tatausaha/nilaiakhir" class="btn btn-info"><b>Batal</b></a></p>';
	}
?>
</form>
</div></div></div>
</div>
