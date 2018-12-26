<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: profil.php
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
	<p><a href="<?php echo base_url(); ?>admin/profil" class="btn btn-info">Daftar Profil</a> <a href="<?php echo base_url(); ?>admin/katprofil" class="btn btn-info">Kategori Profil</a></p>
	<?php echo form_open('admin/profil','class="form-horizontal" role="form"');?>
<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control" required></div>
</div>
<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Kategori</label></div>
	<div class="col-sm-9">
		<select name="kategori" class="form-control">
		<?php
		foreach($kategori->result_array() as $k)
		{
			echo "<option value='".$k["id_kategori"]."'>".$k["nama_kategori"]."</option>";
		}?>
		</select>
	</div>
</div>
<div class="form-group row">
	<div class="col-sm-12"><label class="control-label">Isi</label></div>
	<div class="col-sm-12"><textarea name="isi" rows="10" class="form-control"></textarea></div>
</div>
<p class="text-center"><input type="submit" value="Simpan Profil" class="btn btn-primary"></p>
</form>

<?php
}
elseif($aksi == 'ubah')
{?>
	<p><a href="<?php echo base_url(); ?>admin/profil" class="btn btn-info"><b>Daftar Profil</b></a> <a href="<?php echo base_url(); ?>index.php/admin/tambahprofil" class="btn btn-info"><b>Tambah Profil</b></a> <a href="<?php echo base_url(); ?>index.php/admin/katprofil" class="btn btn-info"><b>Kategori Profil</b></a></p>
	<?php 
	if (empty($id))
	{
		header('Location: '.base_url().'admin/profil/tampil');
	}
	else
	{
		$det=$this->Admin_model->Edit_Profil($id);
		if(count($det->result())==0)
		{
			echo '<div class="alert alert-warninh">Profil yang dimaksud tidak ada</div>';
		}
		else
		{
			echo form_open_multipart('admin/profil','class="form-horizontal" role="form"');?>
			<?php
			foreach($det->result_array() as $k)
			{
				$judul=$k["judul_berita"];
				$isi=$k["isi"];
				$gambar=$k["gambar"];
				$id=$k["id_berita"];
			}
			?>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Judul</label></div>
				<div class="col-sm-9"><input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>" required></div>
			</div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kategori</label></div>
				<div class="col-sm-9">
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
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12"><label class="control-label">Isi</label></div>
				<div class="col-sm-12"><textarea name="isi" rows="15" class="form-control"><?php echo $isi; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><label class="control-label">Gambar Utama Profil</label></div>
				<div class="col-sm-9">
				<?php
				if(!empty($gambar))
				{
					echo '<img src="'.base_url().'images/profil/'.$gambar.'" class="img img-rounded" alt="gambar profil">';
				}
				else
				{
					echo '<img src="'.base_url().'images/berita/gbr-news.jpg" class="img img-rounded" alt="gambar profil">';
				}?>
				</div>
			</div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Gambar</label></div>
				<div class="col-sm-9"><input type="file" name="userfile" class="form-control-static"></div>
				<div class="col-sm-12"><p class="help-block">* Bila gambar tidak diganti, dikosongkan saja. Resolusi max 460x345 pix</p>
				</div>
			</div>
			<p class="text-center"><input type="submit" value="Simpan Profil" class="btn btn-primary"><input type="hidden" name="id_tutorial" value="<?php echo $id; ?>" /></p>
			</form>
			<?php
		}
	}

}
else
{?>
	<p><a href="<?php echo base_url(); ?>admin/profil/tambah" class="btn btn-info"><span class="fa fa-plus"></span>Profil</a> <a href="<?php echo base_url(); ?>admin/katprofil" class="btn btn-info">Kategori Profil</a></p>
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Judul Profil</strong></td><td><strong>Kategori</strong></td><td><strong>Tanggal</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
	<?php
	$nomor=$page+1;
	foreach($query->result() as $b)
	{
		echo '<tr><td>'.$nomor.'</td><td>'.$b->judul_berita.'</td><td>'.$b->nama_kategori.'</td><td align=\"center\">'.$b->tanggal.'</td><td align="center"><a href="'.base_url().'admin/profil/ubah/'.$b->id_berita.'" title="Ubah Profil"><span class="fa fa-edit"></span></a></td>';
		echo "<td align=\"center\"><a href=".base_url()."admin/profil/hapus/".$b->id_berita." onClick=\"return confirm('Anda yakin ingin menghapus profil ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
		$nomor++;
	}
	?>
	</table>
	<?php
}
if(!empty($paginator))
{
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
}
?>
</div></div></div>
