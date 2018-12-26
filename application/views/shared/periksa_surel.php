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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php echo $pesan_email; ?>
<?php
$ta = $this->db->query("select * from `tbllogin` where `username`='$nim'");
foreach($ta->result() as $a)
{

	$email = $a->email;
}
echo form_open($status.'/surel','class="form-horizontal" role="form"');
?>
	<div class="form-group row row">
		<div class="col-sm-3" ><label for="email" class="control-label" >Email Anda</label></div>
		<div class="col-sm-9" >
		<input class="form-control" name="email" placeholder="Email Anda" type="text" value="<?php echo $email; ?>" />
		<span class="text-danger"><?php echo form_error('email'); ?></span>
		</div>
	</div>
	<input type="hidden" name="proses" value="kirim">
	<p class="text-center"><button type="submit" class="btn btn-primary">Kirim Validasi Email</button></p>
<?php
echo form_close();
?>

</div>
