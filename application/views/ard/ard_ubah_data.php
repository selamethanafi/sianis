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
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3>masih dalam percobaan</div>
	<div class="card-body">
<?php
$tb = $this->db->query("select * from `ard_login` where `username`='$nim'");
	if($tb->num_rows() == 0)
	{
		$this->db->query("insert into `ard_login` (`username`) values ('$nim')");
	}
	$tb = $this->db->query("select * from `ard_login` where `username`='$nim'");
	foreach($tb->result() as $b)
	{
		$passwd = $b->password_ard;
		$id_pns = $b->username_ard;
		$teacher_id = $b->teacher_id;
	}
	echo form_open('ard/updatepassword','class="form-horizontal" role="form"');
	?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Username ARD</label></div><div class="col-sm-9"><input type="text" name="username_ard" value="<?php echo $id_pns;?>"class="form-control" required></div></div>

		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Password ARD</label></div><div class="col-sm-9"><input type="text" name="password_ard" value="<?php echo $passwd;?>" class="form-control" required></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Teacher ID</label></div><div class="col-sm-9"><?php echo $teacher_id;?></div></div>
		<div class="alert alert-info">Bila Teacher ID kosong silakan menghubungi Admin</div>
			<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
			</form>
	</div>
</div></div>
