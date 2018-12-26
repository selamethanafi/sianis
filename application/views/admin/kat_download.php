<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kat_download.php
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
if($aksi == 'tambah')
{?>
	<p><a href="<?php echo base_url(); ?>admin/katdownload" class="btn btn-info">Kembali ke Kategori Unduhan</a> </p>
	<?php echo form_open('admin/katdownload','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Nama Kategori Download</label></div>
		<div class="col-sm-9" ><input type="text" name="nama" placeholder="kategori unduhan" class="form-control" required></div>
	</div>
	<p class="text-center"><input type="submit" class="btn btn-primary" value="Simpan Kategori Download"></p>
	</form>
<?php
}
elseif($aksi == 'ubah')
{?>
	<p><a href="<?php echo base_url(); ?>admin/katdownload" class="btn btn-info">Kembali ke Kategori Unduhan</a> </p>
	<?php
	if (empty($id))
	{
		header('Location: '.base_url().'admin/agenda');
	}
	else
	{
		$det=$this->Admin_model->Edit_Kat_Download($id);
		if(count($det->result())==0)
		{
				echo '<div class="alert alert-info">Kategori unduhan yang dimaksud tidak ada</div>';
		}
		else
		{
			echo form_open('admin/katdownload','class="form-horizontal" role="form"');?>
			<?php
			foreach($det->result_array() as $k)
			{
				$nama_kategori=$k["nama_kategori_download"];
			}
			?>
			<input type="hidden" name="id_kat" value="<?php echo $id; ?>">
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Nama Kategori Download</label></div>
				<div class="col-sm-9" ><input type="text" name="nama" placeholder="kategori unduhan" value="<?php echo $nama_kategori; ?>" class="form-control" required></div>
			</div>
			<p class="text-center"><input type="submit" class="btn btn-primary" value="Simpan Kategori Unduhan" /></p>
			</form>
			<?php 
		}
	}
}
else
{?>
<p><a href="<?php echo base_url(); ?>admin/katdownload/tambah" class="btn btn-info">Tambah Kategori Unduhan</a> <a href="<?php echo base_url(); ?>admin/upload" class="btn btn-primary">Daftar Berkas</a></p>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Judul Kategori Download</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($kategori->result() as $b)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$b->nama_kategori_download.'</td><td width="50" align="center"><a href="'.base_url().'admin/katdownload/ubah/'.$b->id_kategori_download.'" title="ubah kategori"><span class="fa fa-edit"></span></a></td><td width="50" align="center"><a href="'.base_url().'admin/katdownload/hapus/'.$b->id_kategori_download.'" data-confirm="Anda yakin ingin menghapus kategori '.$b->nama_kategori_download.'?" title="Hapus"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;
}
?>
</table>
<?php
}
?>
</div></div></div>
