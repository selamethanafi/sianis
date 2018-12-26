<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: upload.php
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
echo $galat;
$kat = $this->db->query("select * from `tblkategoridownload` order by `nama_kategori_download`");
if($aksi == 'tambah')
{?>
	<p><a href="<?php echo base_url(); ?>admin/upload" class="btn btn-info">Daftar Berkas</a> <a href="<?php echo base_url(); ?>admin/katdownload" class="btn btn-info">Kategori Download</a></p>
	<?php echo form_open_multipart('admin/upload','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Judul File</label></div>
		<div class="col-sm-9" ><input type="text" name="judul" class="form-control"></div>
	</div><div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kategori File / Download</label></div>
		<div class="col-sm-9" ><select name="kategori" class="form-control">
		<?php
			foreach($kat->result_array() as $k)
			{
				echo "<option value='".$k["id_kategori_download"]."'>".$k["nama_kategori_download"]."</option>";
			}
			?>
			</select>
		</div>
	</div><div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Berkas</label></div>
		<div class="col-sm-9" ><p class="form-control"><input type="file" name="userfile"></p></div>
	</div>
	<p class="text-center"><input type="submit" value="Upload Berkas" class="btn btn-primary"></p>	
	</form>
	<p class="help-block">Nama file yang akan di-upload harap tidak mengandung karakter seperti ."`~* dan sebagainya. Ukuran berkas maksimal 5MB</></p>
<?php
}
elseif($aksi == 'ubah')
{
	$ta = $this->db->query("select * from `tbldownload` where `id_download` = '$page'");
	if($ta->num_rows()== 0)
	{
		echo '<div class="alert alert-info">Data tidak ditemukan</div>';
		echo '<p><a href="'.base_url().'admin/upload" class="btn btn-info">Kembali</a></p>';
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$id_kat = $a->id_kat;
			$judul_file = $a->judul_file;
			$nama_file = $a->nama_file;
			$tgl_posting = $a->tgl_posting;
			$author = $a->author;
		}
		$tb = $this->db->query("SELECT * FROM `tblkategoridownload` where `id_kategori_download`='$id_kat'");
		$nama_kategori = '';
		foreach($tb->result() as $b)
		{
			$nama_kategori = $b->nama_kategori_download;
		}
		echo form_open_multipart('admin/upload','class="form-horizontal" role="form"');?>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Judul File</label></div>
			<div class="col-sm-9" ><input type="text" name="judul_file" value="<?php echo $judul_file;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kategori File / Download</label></div>
		<div class="col-sm-9" ><select name="kategori" class="form-control">
		<?php
				echo "<option value='".$id_kat."'>".$nama_kategori."</option>";
			foreach($kat->result_array() as $k)
			{
				echo "<option value='".$k["id_kategori_download"]."'>".$k["nama_kategori_download"]."</option>";
			}
			?>
			</select>
		</div>
		</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Berkas</label></div>
		<div class="col-sm-9" ><p class="form-control"><input type="file" name="userfile"></p></div>
	</div>
	<p class="text-center"><input type="hidden" name="id_download" value="<?php echo $page; ?>" /><input type="submit" value="Upload Berkas" class="btn btn-primary"></p>	
	</form>
	<p class="help-block">Nama file yang akan di-upload harap tidak mengandung karakter seperti ."`~* dan sebagainya. Ukuran berkas maksimal 5MB</></p>
	<?php
}	}
else
{?>
	<p><a href="<?php echo base_url(); ?>admin/upload/tambah" class="btn btn-primary">Tambah File / Upload File</a> <a href="<?php echo base_url(); ?>admin/katdownload" class="btn btn-primary">Kategori Download</a></p>
	
	<?php
	$nomor=$page+1;
	if(count($query->result())>0)
	{?>
		<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td><strong>No.</strong></td><td><strong>Judul File</strong></td><td><strong>Kategori</strong></td><td><strong>File</strong></td><td><strong>Pemilik</strong></td><td><strong>Tgl. Upload</strong></td><td colspan="2"><strong>Aksi</strong></td></tr><?php
		foreach($query->result() as $t)
		{
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$t->judul_file.'</td><td>'.$t->nama_kategori_download.'</td><td><b><a href="'.$this->config->item('url_unduhan').'/'.$t->nama_file.'" target="_blank">[ Download ]</a></b></td><td>'.$t->author.'</td><td>'.tanggal($t->tgl_posting).'</td><td><a href="'.base_url().'admin/upload/ubah/'.$t->id_download.'" title="Ubah / Ganti Berkas"><span class="fa fa-edit"></span></a></td><td><a href="'.base_url().'admin/upload/hapus/'.$t->id_download.'" data-confirm="Anda yakin ingin menghapus file ini?" title="Hapus File"><span class="fa fa-trash-alt"></span></a></td></td></tr>';
		$nomor++;	
		}
		echo '</table>';	
	}
	else
	{
		echo '<div class="alert alert-info">Anda belum pernah mengupload file atau berkas</div>';
	}
	echo $paginator;
}
?>
</div></div></div>
