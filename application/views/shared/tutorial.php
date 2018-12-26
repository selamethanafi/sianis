<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: tutorial.php
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
if(!empty($galat_upload))
{
	echo '<div class="alert alert-warning">Galat saat menggunggah. '.$galat_upload.'</div>';
}
if($aksi == 'ubah')
{
	?>
	<p><a href="<?php echo base_url(); echo $tautan;?>/tutorial/tampil" class="btn btn-info"><b>Daftar Materi Pelajaran</b></a> &nbsp;
	<?php
	if($tautan == 'admin')
	{
		?>
		<a href="<?php echo base_url();?>admin/kattutorial/tampil" class="btn btn-info"><b>Daftar Kelompok Mata Pelajaran</b></a>
		<?php
	}
	echo '</p>';
	$ada = $kategori->num_rows();
	if($ada>0)
	{
		echo form_open_multipart($tautan.'/tutorial/tampil','class="form-horizontal" role="form"');
		foreach($kategori->result_array() as $k)
		{
			$judul=$k["judul_tutorial"];
			$isi=$k["isi"];
			$gambar=$k["gambar"];
			$id=$k["id_tutorial"];
			$statusterbit = $k["status"];
		}
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>"></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kategori</label></div><div class="col-sm-9">
		<select name="kategori" class="form-control">
		<?php
		foreach($cur_kat->result_array() as $k)
		{
			if($k["id_kategori_tutorial"]==$id)
			{
				echo "<option value='".$k["id_kategori_tutorial"]."' selected>".$k["nama_kategori"]."</option>";
			}
			else
			{
				echo "<option value='".$k["id_kategori_tutorial"]."'>".$k["nama_kategori"]."</option>";
			}
		}
		?>
		</select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="10" class="form-control"><?php echo $isi; ?></textarea></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label"></label></div><div class="col-sm-9"><img src="<?php echo base_url(); ?>images/tutorial/<?php echo $gambar;  ?>" /></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Gambar</label></div><div class="col-sm-9"><input type="file" name="userfile"> <p class="help-block">* Bila gambar tidak diganti, silahkan dikosongkan saja. Resolusi max 1200x1200 pix</p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9">
		<select name="status" class="form-control">
			<?php
			if(empty($statusterbit))
			{
				echo '<option value="">Draf</option><option value="1">Terbitkan</option>';
			}
			else
			{
				echo '<option value="1">Terbit</option><option value="">Draf</option>';
			}
			?>
		</select></div></div>
		<p class="text-center"><input type="hidden" name="proses" value="ubah"><input type="submit" value="Simpan Materi Pelajaran" class="btn btn-primary"><input type="hidden" name="id_tutorial" value="<?php echo $id; ?>" /></p>
		</form>
		<?php
	}
	else
	{
		echo '<div class="alert alert-danger">Galat! Materi pelajaran tidak ditemukan</div>';
	}
}
elseif($aksi == 'tambah')
{
	?>
	<p><a href="<?php echo base_url(); ?><?php echo $tautan;?>/tutorial/tampil" class="btn btn-info"><b>Daftar Materi Pelajaran</b></a>
	<?php
	if($tautan == 'admin')
	{
		?>
		<a href="<?php echo base_url(); ?><?php echo $tautan;?>/kattutorial/tampil" class="btn btn-info"><b>Kategori Materi Pelajaran</b></a>
		<?php
	}
	?>
	</p>
	<?php echo form_open($tautan.'/tutorial/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kategori</label></div><div class="col-sm-9">
	<select name="kategori" class="form-control">
	<?php
	foreach($kategori->result_array() as $k)
	{
		echo "<option value='".$k["id_kategori_tutorial"]."'>".$k["nama_kategori"]."</option>";
	}
	?>
	</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="10" class="form-control"></textarea></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9">
	<select name="status" class="form-control">
		<option value="">Draf</option>
		<option value="1">Terbitkan</option>
	</select></div></div>

	<p class="text-center"><input type="hidden" name="proses" value="baru"><input type="submit" value="Simpan Materi Pelajaran" class="btn btn-primary"></p>
	</form>
	<?php
}
else
{
	?>
	<a href="<?php echo base_url();?><?php echo $tautan;?>/tutorial/tambah" class="btn btn-info"><b>Tambah Materi Pelajaran</b></a>&nbsp;&nbsp;&nbsp;
	<?php
	if($tautan == 'admin')
	{
		?>
		<a href="<?php echo base_url(); ?><?php echo $tautan;?>/kattutorial/tampil" class="btn btn-info"><b>Kategori Materi Pelajaran</b></a>
		<?php
	}
	echo '</p>';
	if(count($query->result())>0)
	{
		?>
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td><strong>No.</strong></td><td><strong>Judul Materi</strong></td><td><strong>Kategori</strong></td><td><strong>Penulis</strong></td><td><strong>Tanggal</strong></td><td><strong>Status</strong></td><td colspan="3"><strong>Aksi</strong></td></tr>
		<?php
		$nomor=$page+1;
		foreach($query->result() as $t)
		{

			echo "<tr><td align='center'>".$nomor."</td><td>".$t->judul_tutorial."</td><td>".$t->nama_kategori."</td><td>".$t->author."</td><td>".tanggal($t->tanggal)."</td>";
			if($t->status == '1')
			{echo '<td>Terbit</td>';}
			else
			{echo '<td>Rancangan</td>';}
			echo "<td><a href='".base_url()."".$tautan."/tutorial/tinjau/".$t->id_tutorial."' target='_blank' title='Tinjau Tutorial'><span class=\"fa fa-bullseye\"></span></a></td><td>
			<a href='".base_url()."".$tautan."/tutorial/ubah/".$t->id_tutorial."' title='Ubah Materi Pelajaran'><span class=\"fa fa-edit\"></span></a></td>
			<td><a href='".base_url()."".$tautan."/tutorial/hapus/".$t->id_tutorial."' onClick=\"return confirm('Anda yakin ingin menghapus tutorial ini?')\" title='Hapus materi pelajaran'><span class=\"fa fa-trash-alt\"></span></a></td>
			</td></tr>";
		$nomor++;	
		}
		echo '</table></div>';
		if(!empty($paginator))
		{
			?>
				<div class="col-md-12 text-center">
			<?php echo $paginator;?></div>
			<?php
		}
	}
	else{
		echo '<div class="alert alert-info">Belum ada Materi Pelajaran</div>';
	}
}
?>
</div></div></div>
