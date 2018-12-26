<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: ketidakhadiran_siswa.php
// Lokasi      		: application/views/bp
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
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggaltidakmasuk").mask("99-99-9999")
	});
</script>

<div class="container-fluid">
<?php echo form_open('bp/ketidakhadiransiswa','class="form-horizontal" role="form"');?>
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
if ((empty($tanggalhadir)) or (empty($bulanhadir)) or (empty($tahunhadir)))
	{$tanggalabsen='';
	$oke = 'tidak';}
	else
	{
	$tanggalabsen = $tahunhadir."-".$bulanhadir."-".$tanggalhadir;
	$oke = 'ya';
	}
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Tahun Pelajaran</div>
		<div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Semester</div>
		<div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	?>
	</select></div></div>
<?php

if (empty($tanggalabsen))
	{$tanggalabsen = date("d")."-".date("m")."-".date("Y");}
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label>Tanggal</div>
		<div class="col-sm-9">';
	echo '<input type="text" name="tanggaltidakmasuk" class="form-control" id="tanggaltidakmasuk" required></div></div>';
?>
</table><p class="text-center"><button type="submit" class="btn btn-primary">LANJUT</button></p></div></div></form>
</div>
