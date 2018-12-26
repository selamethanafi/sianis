<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: profil.php
// Lokasi      		: application/views/admin
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
echo form_open('pengajaran/posttelegram','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kepada</label></div>
		<div class="col-sm-3"><input type="text" name="chat_id_guru" class="form-control" value="<?php echo $chat_id_guru;?>" readonly></div>
		<div class="col-sm-3"><input type="text" class="form-control" value="<?php echo $nama_guru;?>" readonly></div>
	</div>
	<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Kelas</label></div>
	<div class="col-sm-9"><input type="text" name="kelas" class="form-control" value="<?php echo $kelas;?>" readonly></div>
	</div>
	<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Mapel</label></div><div class="col-sm-9"><input type="text" name="mapel" class="form-control" value="<?php echo $mapel;?>" readonly></div>
	</div>
	<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Sistem</label></div><div class="col-sm-9"><input type="text" name="sistem" class="form-control" value="<?php echo $sistem;?>" readonly></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12"><label class="control-label">Isi</label></div>
	<div class="col-sm-12"><textarea name="isi" rows="2" class="form-control"><?php echo $isi;?></textarea></div>
	</div>
	<p class="text-center"><input type="submit" value="Kirim Telegram" class="btn btn-primary"></p>
</form>
</div></div></div>
