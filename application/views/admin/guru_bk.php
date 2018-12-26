<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pengguna.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Sen 11 Apr 2016 05:24:39 WIB 
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
if($aksi == 'tambah')
{
	echo form_open('admin/gurubk','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pengguna BK</label></div><div class="col-sm-9"><select name="user_bp" class="form-control" required>
	<?php
	echo '<option value=""></option>';
	$tc = $this->db->query("select * from `tbllogin` where `status`='BP'");
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$c->username.'">'.$c->nama.'</option>';
	}?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><select name="nip" class="form-control" required>
	<?php
	echo '<option value=""></option>';
	$td = $this->db->query("select `nip`,`nama`,`nama_tanpa_gelar` from `p_pegawai` where `status`='Y' and `guru`='Y' order by `nama_tanpa_gelar`");
	foreach($td->result() as $d)
	{
		echo '<option value="'.$d->nip.'">'.$d->nama_tanpa_gelar.' '.$d->nip.'</option>';
	}?>
	</select></div></div>
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
	</form>
	<?php	
}
elseif($aksi == 'edit')
{
	$pengguna = balikin($username);
	$query=$tc = $this->db->query("select * from `gurubk` where `user_bp`='$pengguna'");
	$adaq = $query->num_rows();
	if($adaq == 0)
	{
		echo '<div class="alert alert-warning">Galat! Pengguna tidak ditemukan.</div>';
	}
	else
	{
		foreach($query->result() as $c)
		{
			$nip = $c->nip;
		}		
		$namaguru = '';
		$td = $this->db->query("select `nip`,`nama`,`nama_tanpa_gelar` from `p_pegawai` where `nip`='$nip'");
		foreach($td->result() as $d)
		{
			$namaguru = $d->nama_tanpa_gelar;
		}
		echo form_open('admin/gurubk','class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pengguna BK</label></div><div class="col-sm-9"><select name="user_bp" class="form-control" required>';
		echo '<option value="'.$pengguna.'">'.$pengguna.'</option>';
		$tc = $this->db->query("select * from `tbllogin` where `status`='BP'");
		foreach($tc->result() as $c)
		{
			echo '<option value="'.$c->username.'">'.$c->nama.'</option>';
		}?>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><select name="nip" class="form-control" required>
		<?php
		echo '<option value="'.$nip.'">'.$namaguru.' '.$nip.'</option>';
		$td = $this->db->query("select `nip`,`nama`,`nama_tanpa_gelar` from `p_pegawai` where `status`='Y' and `guru`='Y' order by `nama_tanpa_gelar`");
		foreach($td->result() as $d)
		{
			echo '<option value="'.$d->nip.'">'.$d->nama_tanpa_gelar.' '.$d->nip.'</option>';
		}?>
		</select></div></div>
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
		</form>
		<?php
	}
}

else
{
$query = $this->db->query("select * from `gurubk`");
?>
<a href="<?php echo base_url(); ?>admin/gurubk/tambah" class="btn btn-info"> <span class="fa fa-plus"></span><b> Tambah Guru BK</b></a><p></p>

<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>User BK</strong></td><td><strong>Nama</strong></td><td><strong>NIP</strong></td><td colspan="2" width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor = 1;
foreach($query->result() as $b)
{
	$username = $b->user_bp;
	$nip = $b->nip;
	$ta = $this->db->query("select `nip`,`nama` from `p_pegawai` where `nip`='$nip'");
	$namaguru = '';
	foreach($ta->result() as $a)
	{
		$namaguru = $a->nama;
	}
	echo '<tr><td>'.$nomor.'</td><td>'.$username.'</td><td>'.$namaguru.'</td><td>'.$nip.'</td><td align="center"><a href="'.base_url().'admin/gurubk/edit/'.cegah($username).'" title="Edit"><span class="fa fa-edit"></span></a></td><td align="center"><a href="'.base_url().'admin/gurubk/hapus/'.cegah($username).'" data-confirm="yakin hendak menghapus '.$username.' sebagai guru BK?"><span class="fa fa-trash-alt"></span></a></td></tr>';
	$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
<?php
}
?>
</div></div></div>
