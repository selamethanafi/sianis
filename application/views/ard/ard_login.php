<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2018 12:23:28 WIB 
// Nama Berkas 		: ard_login.php
// Lokasi      		: application/views/ard/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tb = $this->db->query("select * from `ard_login` where `username`='$nim'");
		foreach($tb->result() as $b)
		{
			$passwd = $b->password_ard;
			$username_ard = $b->username_ard;
			$teacher_id = $b->teacher_id;
		}
	$file = file_get_contents($url_ard_unduh.'/api/teacher_id.php?teacher_nip='.$username_ard);
	$json = json_decode($file, true);
	$teacher_id = $json[0]['teacher_id'];
	if($teacher_id != 'tidak ada data')
	{
		if(!empty($teacher_id))
		{
			$this->db->query("update `ard_login` set `teacher_id`='$teacher_id' where `username_ard`='$username_ard'");
		}
	}
		$tb = $this->db->query("select * from `ard_login` where `username`='$nim'");
		foreach($tb->result() as $b)
		{
			$passwd = $b->password_ard;
			$username_ard = $b->username_ard;
			$teacher_id = $b->teacher_id;
		}

?>
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h3>masih dalam percobaan</h3></div>
	<div class="card-body">

<form class="form-horizontal" role="form"  action="<?php echo $url_ard;?>/ma/portal/functions/login" method="post">Teacher ID <?php echo $teacher_id;?>
<input type="hidden" name="username" value="<?php echo $username_ard;?>"><input type="hidden" name="password" value="<?php echo $passwd;?>">
<input name="login" id="login" value="Masuk ke ARD" title="Klik disini untuk masuk ke ARD" type="submit" class="btn btn-primary">
</form>
		<div class="alert alert-info">Bila Teacher ID kosong silakan menghubungi Admin</div>

</div></div></div>
