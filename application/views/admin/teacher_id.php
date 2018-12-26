<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : teacher_id.php
// Lokasi      : application/views/admin
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$ta = $this->db->query("select * from `ard_login`");
foreach($ta->result() as $a)
{
	$user_ard = $a->username_ard;
	$file = file_get_contents($url_ard_api.'/api/teacher_id.php?teacher_nip='.$user_ard);
	$json = json_decode($file, true);
	$teacher_id = $json[0]['teacher_id'];
	if($teacher_id != 'tidak ada data')
	{
		$this->db->query("update `ard_login` set `teacher_id`='$teacher_id' where `username_ard`='$user_ard'");
	}
}
$ta = $this->db->query("select * from `ard_login`");
foreach($ta->result() as $a)
{
	echo $a->username_ard.' '.$a->teacher_id.'<br />';
}
?>
</div></div></div>
