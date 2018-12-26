<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:16:20 WIB 
// Nama Berkas 		: mapel.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               admin@mantengaran.sch.id
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
if($aksi == 'tambah')
{
	?>
	<p><a href="<?php echo base_url(); ?>pengajaran/matapelajaran" class="btn btn-info" role="button"> <span class="glyphicon glyphicon-arrow-left"></span>Daftar Mapel</a></p>
	<?php echo form_open('pengajaran/matapelajaran/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pelajaran</label></div><div class="col-sm-9"><input type="text" name="mapel" class="form-control" required></div></div>
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
	</form>
	<?php

}
elseif($aksi == 'ubah')
{
	$tc = $this->db->query("SELECT * from tblkategoritutorial where id_kategori_tutorial='$id'");
	if(count($tc->result())==0)
		{
			header('Location: '.base_url().'pengajaran/matapelajaran/tampil');
		}
	foreach($tc->result() as $c)
	{
		$id_mapel = $c->id_kategori_tutorial;
		$namamapel = $c->nama_kategori;
	}
	?>
	<?php echo form_open('pengajaran/matapelajaran','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><input type="text" name="nama_kategori" value="<?php echo $namamapel;?>" class="form-control" required></div></div>
	<input type="hidden" name="id_kategori_tutorial" value="<?php echo $id_mapel;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN DATA</button></p>
	</form>
	<?php
}
else
{?>
<p><a href="<?php echo base_url();?>pengajaran/matapelajaran/tambah" class="btn btn-info" role="button"><span class="fa fa-plus"></span> <b>Mata Pelajaran</b></a></p> 
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Mapel</strong></td><td width="30"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
echo "<tr><td>".$nomor."</td><td>".$b->nama_kategori."</td><td><a href='".base_url()."pengajaran/matapelajaran/ubah/".$b->id_kategori_tutorial."' title='Edit'><span class=\"fa fa-edit\"></span></td></tr>";
$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	echo $paginator;
	}
}
?>
</div></div></div>
