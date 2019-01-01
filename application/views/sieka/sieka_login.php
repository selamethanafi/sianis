<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: sieka_login.php
// Lokasi      		: application/views/sieka/
// Terakhir diperbarui	: Sel 01 Jan 2019 11:02:24 WIB 
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
<?php
		$tb = $this->db->query("select * from `sieka_user` where `nip`='$nip'");
		foreach($tb->result() as $b)
		{
			$passwd = $b->passwd;
		}
?>
<form class="form-horizontal" role="form"  action="http://sieka.kemenag.go.id/kinerja/res-php/login.php" method="post">
<input type="hidden" name="username" value="<?php echo $nip;?>"><input type="hidden" name="password" value="<?php echo $passwd;?>">
<input name="login" id="login" value="login ke Sieka" title="Klik disini untuk log in" type="submit" class="btn btn-primary">
</form>

