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
	<div class="card-header"><h3>Selamat Datang di Jembatan SiEka</h3>masih dalam percobaan</div>
	<div class="card-body">
<?php
	$ta = $this->db->query("select * from `p_pegawai` where `kd`='$nim'");
	$nip = '';	
	$pns = 'NonPNS';	
	foreach($ta->result() as $a)
	{
		$nip = $a->nip;
		$pns = $a->status_kepegawaian;
	}
	if(($pns == 'PNS') or ($pns == 'CPNS'))
	{
		$tb = $this->db->query("select * from `sieka_user` where `nip`='$nip'");
		if($tb->num_rows() == 0)
		{
			$this->db->query("insert into `sieka_user` (`nip`) values ('$nip')");
		}
		$tb = $this->db->query("select * from `sieka_user` where `nip`='$nip'");
		foreach($tb->result() as $b)
		{
			$passwd = $b->passwd;
			$id_pns = $b->id_pns;
		}
			echo form_open('sieka/updatepassword','class="form-horizontal" role="form"');
			?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Password Sieka</label></div><div class="col-sm-9"><input type="text" name="passwd" value="<?php echo $passwd;?>" class="form-control" required></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">ID PNS</label></div><div class="col-sm-9"><input type="text" name="id_pns" value="<?php echo $id_pns;?>"class="form-control" required></div></div>

			<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
			</form>

			<?php

	}
	else
	{
		echo '<div class="alert alert-warning">Anda tidak perlu mengisi Sieka</div>';
	}
	?>
	
	</div>
</div></div>
