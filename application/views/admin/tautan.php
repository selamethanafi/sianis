<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: tautan.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
if ($aksi=='tambah')
	{
?><p><a href="<?php echo base_url(); ?>admin/tautan" class="btn btn-info">Kembali ke Daftar Tautan</a></p>
	<?php
	echo form_open('admin/tautan','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">URL</label></div>
		<div class="col-sm-9" ><input type="text" name="url" placeholder="tautan" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Teks Tautan</label></div>
		<div class="col-sm-9" ><input  type="text" name="teks" placeholder="teks tautan muncul di halaman depan" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Nomor Urut</label></div>
		<div class="col-sm-9" ><input  type="text" name="no_urut" placeholder="nomor urut" class="form-control"></div>
	</div>
	<p class="text-center"><input type="submit" value="Simpan Tautan" class="btn btn-primary"></p>
	</form>

	<?php
	}
elseif ($aksi=='ubah')
	{
		?><p><a href="<?php echo base_url(); ?>admin/tautan" class="btn btn-info">Kembali ke Daftar Tautan</a></p>
	<?php
	$ta = $this->db->query("select * from tbltautan where id_tautan= '$id_tautan'");
	if(count($ta->result())>0)
	{

	echo form_open('admin/tautan','class="form-horizontal" role="form"');
	foreach($ta->result() as $a)
		{
		$url = $a->url;
		$teks = $a->teks;
		$no_urut = $a->no_urut;
		}
?>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">URL</label></div>
		<div class="col-sm-9" ><input  type="text" name="url" value="<?php echo $url;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Teks</label></div>
		<div class="col-sm-9" ><input  type="text" name="teks" value="<?php echo $teks;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Nomor Urut</label></div>
		<div class="col-sm-9" ><input  type="text" name="no_urut" value="<?php echo $no_urut;?>" class="form-control"></div>
	</div>
	<input type="hidden" name="id_tautan_ubah" value="<?php echo  $id_tautan;?>">
	<p class="text-center"><input type="submit" value="Simpan Tautan" class="btn btn-primary"></p>
	</form>

	<?php
	}
	else
	{
	echo '<div class="alert alert-warning"><h2>Data tidak ditemukan</h2></div>';
	}
}
else
{?>
<p><a href="<?php echo base_url(); ?>admin/tautan/tambah" class="btn btn-primary">Tambah Tautan</a></p>
<?php
$query = $this->db->query("select * from tbltautan order by no_urut");
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="50"><strong>No Urut</strong></td><td><strong>URL</strong></td><td><strong>Teks</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor = 1;
foreach($query->result() as $b)
{
echo '<tr>
	<td>'.$b->no_urut.'</td><td>'.$b->url.'</td>
	<td>'.$b->teks.'</td><td align="center" width= "50"><a href="'.base_url().'admin/tautan/ubah/'.$b->id_tautan.'" title="ubah"><span class="fa fa-edit"></span></a></td>
	<td align="center" width ="50"><a href="'.base_url().'admin/tautan/hapus/'.$b->id_tautan.'" data-confirm="Anda yakin ingin menghapus tautan '.$b->url.'?"  title="Hapus"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;
}
?>
</table>
<?php
}?>
</div></div></div>
