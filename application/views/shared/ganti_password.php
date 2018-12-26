<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : isi_index.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<span><?php echo $sukses; ?></span>
<?php
echo form_open($status.'/sandi','class="form-horizontal" role="form"');
?>
	<div class="form-group row row">
		<div class="col-sm-3" ><label class="control-label">Kata Sandi</label></div>
		<div class="col-sm-9" >	<input class="form-control" name="password" placeholder="Kata Sandi" type="password" />
					<span class="text-danger"><?php echo $galat1; ?></span>
		</div>
	</div>
	<div class="form-group row row"><div class="col-sm-3" ><label for="subject">Kata Sandi (lagi)</label></div>
		<div class="col-sm-9" >	<input class="form-control" name="cpassword" placeholder="Tulis kata sandi lagi" type="password" />
					<span class="text-danger"><?php echo $galat2; ?></span>
				</div>
	</div>
	<p class="text-center"><button type="submit" class="btn btn-primary">Ganti Password</button></p>
<?php
echo form_close();
?>

</div>
