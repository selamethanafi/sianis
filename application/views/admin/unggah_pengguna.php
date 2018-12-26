<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: impor_siswa.php
// Lokasi      		: application/views/tatausaha
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
echo form_open_multipart('admin/unggahpengguna');?>
<div class="alert alert-info">
<p>format data</p>
<p>"username","nama","password","hak_akses"</p>
</div>
<div class="form-group row">
	<label for="berkas" class="col-sm-3 control-label">Berkas (format csv)</label>
		<div class="col-sm-9" ><input type="file" name="userfile" class="textfield"></div>
	</div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>
</div></div></div>
