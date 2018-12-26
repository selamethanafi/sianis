<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: form_mencetak_penilaian_kinerja_guru.php
// Lokasi      		: application/views/guru/
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
echo form_open('tatausaha/cetakpkg','class="form-horizontal" role="form"');
$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' and `guru`='Y' order by nama_tanpa_gelar");
echo '<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div>
	<div class="col-sm-9">
		<select name="thnpkg" class="form-control">';
		echo "<option value='".$thnpkg."'>".$thnpkg."</option>";
	foreach($tapel->result() as $d)
	{
	       	echo '<option value="'.substr($d->thnajaran,0,4).'">'.substr($d->thnajaran,0,4).'</option>';
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Guru</label></div><div class="col-sm-9">
	<select name="kodeguru" class="form-control">';
	echo "<option value=''> pilih guru</option>";
	foreach($ta->result() as $a)
	{
       	echo '<option value="'.$a->kd.'">'.$a->nama_tanpa_gelar.' '.$a->nama.'</option>';
	}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Cetak Hasil PKG" class="btn btn-primary"></p>';
?>
</form>
</div></div></div>
