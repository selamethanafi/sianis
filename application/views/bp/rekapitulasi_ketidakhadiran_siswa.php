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
?><div class="container-fluid">
<?php
$xloc = base_url().'bp/rekapketidakhadiransiswa/'.$nis;
?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' - '.nis_ke_nama($nis);?></h3></div>
<div class="card-body">
<?php
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	if(!empty($tahun1))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
		?>
		<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
		echo '</select></div></div>';
	}
	if(!empty($semester))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'bp/rekapketidakhadiransiswa/'.$tahun1.'" title="ganti semester">Semester</a></label></div><div class="col-sm-9">';
		?>
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
		echo '</select></div></div>';
	}
	if(empty($tahun1))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
		?>
		<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value="'.$xloc.'"></option>';
		foreach($daftar_tapel->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';
		}
		echo '</select></div></div>';
	}
	else
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'bp/rekapketidakhadiransiswa/'.$nis.'" title="ganti tahun">Semester</a></label></div><div class="col-sm-9">';
		?>
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo '<option value=""></option>';
		echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
		echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		echo '</select></div></div>';
	}
?>
</form>
</div></div></div>
