<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pengumuman.php
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
if($aksi == 'tambah')
{
	?>
	<p><a href="<?php echo base_url(); ?><?php echo$tautan;?>/pengumuman/tampil" class="btn btn-info"><b>Daftar Pengumuman</b></a></p>
	<?php echo form_open_multipart($tautan.'/pengumuman/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="10" class="form-control"></textarea></div></div>
	<p class="text-center"><input type="hidden" name="proses" value="baru"><input type="submit" value="Update Pengumuman" class="btn btn-primary"></p>
	</form>
	<?php

}
elseif($aksi == 'ubah')
{
	if (empty($id))
	{
		header('Location: '.base_url().''.$tautan.'/pengumuman');
	}
	else
	{
		$det=$this->Admin_model->Edit_Pengumuman_Admin($id);
		if(count($det->result())==0)
		{
			echo '<div class="alert alert-info">Pengumuman yang dimaksud tidak ada</div>';
		}
		else
		{
			echo '<p><a href="'.base_url().''.$tautan.'/pengumuman/tampil" class="btn btn-info"><b>Daftar Pengumuman</b></a></p>';
			echo form_open($tautan.'/pengumuman/tampil','class="form-horizontal" role="form"');
			foreach($det->result_array() as $k)
			{
				$judul=$k["judul_pengumuman"];
				$isi=$k["isi"];
				$id=$k["id_pengumuman"];
			}
			?>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>"></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="10" class="form-control"><?php echo $isi; ?></textarea></div></div>
			<p class="text-center"><input type="hidden" name="proses" value="ubah"><input type="submit" value="Update Pengumuman" class="btn btn-primary"><input type="hidden" name="id_pengumuman" value="<?php echo $id; ?>" /></p>
			</form>
			<?php
		 }
	}
}
else
{?>
	<p><a href="<?php echo base_url(); ?><?php echo $tautan;?>/pengumuman/tambah" class="btn btn-info"><b>Tambah Pengumuman</b></a></p>
	<?php
	$nomor=$page+1;
	if(count($query->result())>0)
	{?>
		<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered">
		<tr align="center"><td><strong>No.</strong></td><td><strong>Judul Pengumuman</strong></td><td><strong>Tanggal</strong></td><td><strong>Penulis</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
		<?php
		foreach($query->result() as $t)
		{
			echo "<tr><td align='center'>".$nomor."</td><td>".$t->judul_pengumuman."</td><td align=\"center\">".date_to_long_string($t->tanggal)."</td><td>".$t->nama."</td><td>
			<a href='".base_url()."".$tautan."/pengumuman/ubah/".$t->id_pengumuman."' title='Edit pengumuman'><span class=\"fa fa-edit\"></span></a></td>
			<td><a href='".base_url()."".$tautan."/pengumuman/hapus/".$t->id_pengumuman."' onClick=\"return confirm('Anda yakin ingin menghapus pengumuman ini?')\" title='Hapus Pengumuman'><span class=\"fa fa-trash-alt\"></span></a></td>
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
	else
	{
		echo '<div class="alert alert-info">Belum ada pengumuman</div>';
	}
}
?>
</div></div></div>
