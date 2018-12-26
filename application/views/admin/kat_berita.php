<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kat_berita.php
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
{
	?>
	<p><a href="<?php echo base_url(); ?>admin/katberita/tampil" class="btn btn-info"><b>Daftar Kategori Berita</b></a></p>
	<?php echo form_open('admin/katberita/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Kategori Berita</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control" required></div></div>
	<p class="text-center"><input type="hidden" name="proses" value="baru"><input type="submit" class="btn btn-primary" value="Simpan Kategori Berita"></p>
	</form>
<?php
}
elseif($aksi == 'ubah')
{
	if (empty($id))
	{
		header('Location: '.base_url().'admin/katberita/tampil2');
	}
	else
	{
		$det = $this->Admin_model->Edit_Kat_Berita($id);
		if(count($det->result())==0)
		{
			echo '<div class="alert alert-info">Kategori berita yang dimaksud tidak ada</div>';
		}
		else
		{
			echo '<p><a href="'.base_url().'admin/katberita/tampil"><b>Daftar Kategori Berita</b></a></p>';
			echo form_open('admin/katberita/tampil','class="form-horizontal" role="form"');
			foreach($det->result_array() as $k)
			{
				$nama_kategori=$k["nama_kategori"];
				$id_kategori=$k["id_kategori"];
			}
			?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Id Kategori Berita</label></div><div class="col-sm-9"><input type="text" name="id_kat" class="form-control" value="<?php echo $id_kategori; ?>" readonly="readonly"/></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Kategori Berita</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control" value="<?php echo $nama_kategori; ?>"/></div></div>
			<p class="text-center"><input type="hidden" name="proses" value="ubah"><input type="submit" class="btn btn-primary" value="Simpan Katebori Berita" /></p>
			</form>
			<?php
		}
	}
}
else
{
?>
	<p><a href="<?php echo base_url(); ?>admin/katberita/tambah" class="btn btn-info"><b>Tambah Kategori Berita</b></a></p>
	<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Judul Kategori Berita</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
	<?php
	$nomor=1;
	foreach($kategori->result_array() as $b)
	{
		echo "<tr><td>".$nomor."</td><td>".$b["nama_kategori"]."</td><td width='20'><a href='".base_url()."admin/katberita/ubah/".$b["id_kategori"]."' title='Edit'><span class=\"fa fa-edit\"></span></a></td>
		<td width='20'><a href='".base_url()."index.php/admin/katberita/hapus/".$b["id_kategori"]."' onClick=\"return confirm('Anda yakin ingin menghapus kategori ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		$nomor++;
	}
	?>
	</table></div>
<?php
}
?>
</div></div></div>
