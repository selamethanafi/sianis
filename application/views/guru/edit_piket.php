<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: edit_piket.php
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
foreach($tabel_piket->result() as $k)
{
$tanggalpiket=$k->tanggal;
}
if (empty($tanggalpiket))
{
	echo '<strong>Piket pada tanggal tersebut tidak ada</strong>';	
}
else
{
	foreach($tabel_piket->result() as $k)
	{
		echo form_open('piket/updatepiket','class="form-horizontal" role="form"');
		$tanggalpiket = date_to_long_string($k->tanggal);
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $k->thnajaran; ?></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $k->semester; ?></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $tanggalpiket; ?></div></div>
		<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Kejadian</label></div></div>
		<div class="form-group row row"><div class="col-sm-12"><textarea name="kejadian" rows="15" class="textfield"><?php echo $k->kejadian; ?></textarea></div></div>
		<p class="text-center"><input type="submit" value="Simpan Jurnal" class="btn btn-primary"><input type="hidden" name="id_piket" value="<?php echo $id_piket; ?>" /> <a href="<?php echo base_url();?>piket" class="btn btn-info">Batal</a></p>
		</form>
	<?php
	}
}
?>
</div></div></div>
