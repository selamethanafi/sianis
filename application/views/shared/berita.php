<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: berita.php
// Lokasi      		: application/views/shared
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
if($aksi == "tambah")
{
?>
	<p><a href="<?php echo base_url(); ?><?php echo $tautan; ?>/berita" class="btn btn-info"><b>Daftar Berita</b></a> 
	<?php
	if($tautan == 'admin')
		{
			?>
			<a href="<?php echo base_url(); ?><?php echo $tautan; ?>/katberita" class="btn btn-info"><b>Kategori Berita</b></a>
			<?php
		}
	echo '</p>';
	echo form_open($tautan.'/berita/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kategori</label></div><div class="col-sm-9">
	<select name="kategori" class="form-control">
	<?php
	foreach($kategori->result_array() as $k)
	{
		echo "<option value='".$k["id_kategori"]."'>".$k["nama_kategori"]."</option>";
	}
	?>
	</select>
	</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="10" class="form-control"></textarea></div></div>
	<p class="text-center"><input type="hidden" name="proses" value="baru"><input type="submit" value="Simpan Berita" class="btn btn-primary"></p>
	</form>
<?php
}
elseif($aksi == "ubah")
{
	?>
	<p><a href="<?php echo base_url(); echo $tautan.'/';?>berita/tampil" class="btn btn-info"><b>Daftar Berita</b></a>&nbsp;&nbsp;&nbsp;
	<?php
	if($tautan == 'admin')
		{
			?>
			<a href="<?php echo base_url(); ?><?php echo $tautan; ?>/katberita" class="btn btn-info"><b>Kategori Berita</b></a>
			<?php
		}
	echo '</p>';
	echo form_open_multipart($tautan.'/berita/tampil','class="form-horizontal" role="form"');
	if($det->num_rows() > 0)
	{
		foreach($det->result_array() as $k)
		{
			$judul=$k["judul_berita"];
			$isi=$k["isi"];
			$gambar=$k["gambar"];
			$id=$k["id_berita"];
			$author = $k['author'];
			$penuh = $k['penuh'];
		}
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kategori</label></div><div class="col-sm-9">
		<?php
		foreach($det->result_array() as $k)
		{
			$id_sel=$k["id_kategori"];
		}
		?>
		<select name="kategori" class="form-control">
		<?php
		foreach($kategori->result_array() as $k)
		{
			if($k["id_kategori"]==$id_sel)
			{
					echo "<option value='".$k["id_kategori"]."' selected>".$k["nama_kategori"]."</option>";
			}
			else
			{
				echo "<option value='".$k["id_kategori"]."'>".$k["nama_kategori"]."</option>";
			}
		}
		?>
		</select>
		</div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="15" class="form-control"><?php echo $isi; ?></textarea></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label"></label></div><div class="col-sm-9"><img src="<?php echo base_url(); ?>images/berita/<?php echo $gambar;  ?>" /></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gambar</label></div><div class="col-sm-9"><input type="file" name="userfile" > <p class="help-block">* Bila gambar tidak diganti, silahkan dikosongkan saja. Resolusi max 460x345 pix</p></div></div>
		<?php
		if($tautan == 'admin')
		{
			?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tampil Penuh</label></div><div class="col-sm-9"><select name="penuh" class="form-control">
			<?php
				if($penuh == '1')
				{
					echo '<option value="1">Ya</option><option value="">Tidak</option>';
				}
				else
				{
					echo '<option value="">Tidak</option><option value="1">Ya</option>';
				}
				echo '</select></div></div>';
		}

		?>
		<p class="text-center"><input type="submit" value="Simpan Berita" class="btn btn-primary"><input type="hidden" name="id_berita" value="<?php echo $id; ?>" /><input type="hidden" name="proses" value="ubah"/><input type="hidden" name="author" value="<?php echo $author; ?>" /></p>
		</form>
		<?php
	}
	else
	{
		echo '<div class="alert alert-danger">Data berita tidak ditemukan</div>';
	}
}
else
{
?>
	<p><a href="<?php echo base_url(); ?><?php echo $tautan; ?>/berita/tambah" class="btn btn-info"><b>Tambah Berita</b></a>&nbsp;&nbsp;&nbsp;
	<?php
	if($tautan == 'admin')
		{
			?>
			<a href="<?php echo base_url(); ?><?php echo $tautan; ?>/katberita" class="btn btn-info"><b>Kategori Berita</b></a>
			<?php
		}
	echo '</p>';
	?>
	<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Judul Berita</strong></td><td><strong>Kategori</strong></td><td><strong>Penulis</strong><td><strong>Tanggal</strong></td><td><strong>Status Terbit</strong></td>
	<?php

	if($tautan == 'admin')
	{
		echo '<td colspan="5"><strong>Aksi</strong>';
	}
	else
	{
		echo '<td><strong>Aksi</strong>';
	}
	echo '</td></tr>';
	$nomor=$page+1;
	foreach($query->result() as $b)
	{
		echo "<tr><td>".$nomor."</td><td>".$b->judul_berita."</td><td>".$b->nama_kategori."</td><td>".$b->author."</td><td>".tanggal($b->tanggal)."</td>";
		if($b->terbit == '1')
		{
			echo '<td>Terbit</td>';
		}
		else
		{
			echo '<td>Draft</td>';
		}
		if($tautan == 'admin')
		{
			if($b->terbit == '1')
			{
				echo "<td width=\"30\"><a href='".base_url()."".$tautan."/berita/urung/".$b->id_berita."' title='Urung Terbitkan Berita'><span class=\"fa fa-download\"></span></a></td>";
			}
			else
			{
				echo "<td width=\"30\"><a href='".base_url()."".$tautan."/berita/terbit/".$b->id_berita."' title='Terbitkan Berita'><span class=\"fa fa-upload\"></span></a></td>";

			}

			if($b->terbit == '1')
			{
				echo "<td width=\"30\"><a href='".base_url()."".$tautan."/berita/oke/".$b->id_berita."' title='Berita Utama'><span class=\"fa fa-star\"></span></a></td>";
			}
			else
			{
				echo '<td></td>';
			}
			echo "<td width=\"30\"><a href='".base_url()."".$tautan."/berita/ubah/".$b->id_berita."' title='ubah berita'><span class=\"fa fa-edit\"></span></a></td>
		<td width=\"30\"><a href='".base_url()."".$tautan."/berita/hapus/".$b->id_berita."' onClick=\"return confirm('Anda yakin ingin menghapus berita ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		}
		else
		{

			if($b->terbit == '1')
			{
				echo "<td></td>";
			}
			else
			{
				echo "<td width=\"30\"><a href='".base_url()."".$tautan."/berita/ubah/".$b->id_berita."' title='ubah berita'><span class=\"fa fa-edit\"></span></a></td>";

			}

		}
		$nomor++;
	}
	?>
	</table></div>
<?php
if(!empty($paginator))
	{?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php
	}
}
?>
</div></div></div>
