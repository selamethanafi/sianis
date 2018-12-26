<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : isi_index.php
// Lokasi      : application/views/guru
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
		}
	$file = file_get_contents($url_ard.'/api/teacher_id.php?teacher_nip='.$username_ard);
	$json = json_decode($file, true);
	$teacher_id = $json[0]['teacher_id'];
	if($teacher_id != 'tidak ada data')
	{
		$this->db->query("update `ard_login` set `teacher_id`='$teacher_id' where `username_ard`='$username_ard'");
	}
?>
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h3>Selamat Datang di Jembatan ARD</h3>masih dalam percobaan</div>
	<div class="card-body">
	<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>ard/login','yes','scrollbars=yes,width=1024,height=600')" class="btn btn-success"><strong>LOGIN ARD</strong></a>
	</div>
</div></div>
