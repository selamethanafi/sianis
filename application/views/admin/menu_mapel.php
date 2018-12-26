<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: menu_mapel.php
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
if ((!empty($id_kategori_tutorial)) and ($aksi=='ubah'))
	{
	$tb = $this->db->query("SELECT * FROM `tblkategoritutorial` where `id_kategori_tutorial`='$id_kategori_tutorial'");
	if(count($tb->result())==0)
		{
		header('Location: '.base_url().'admin/mapel');
		}
		foreach($tb->result() as $b)
		{
		$parent_id = $b->parent_id;
		$nama_mapel = $b->nama_kategori;
		}
	$tc = $this->db->query("select * from `m_kelompok_mapel` where `id_kelompok_mapel`='$parent_id'");
	$kelompok_mapel='';
	foreach($tc->result() as $c)
		{
		$kelompok_mapel = $c->kelompok_mapel;
		}


	echo form_open('admin/mapel','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9" ><input type="text" name="nama_kategori" value="<?php echo $nama_mapel;?>" placeholder= "nama mata pelajaran" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelompok Mata Pelajaran</label></div>
		<div class="col-sm-9" ><select name="parent_id" class="form-control">
		<option value="<?php echo $parent_id;?>"><?php echo $kelompok_mapel;?></option>
		<?php
		$td = $this->db->query("select * from `m_kelompok_mapel` order by no_urut");
		foreach($td->result() as $d)
			{
			echo '<option value="'.$d->id_kelompok_mapel.'">'.$d->kelompok_mapel.'</option>';
			}
		?>
		</select></div></div>
		<input type="hidden" name="diproses" value="ubah">
		<p class="text-center"><input type="hidden" name="id_kategori_tutorial" value="<?php echo $id_kategori_tutorial;?>"><input type="submit" value="Ubah Kelompok Mapel" class="btn btn-primary"></p>
	</form>
	<?php

}
else
{
echo form_open('admin/mapel','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9" ><input type="text" name="nama_kategori" placeholder= "nama mata pelajaran" class="form-control"></div>
	</div>
		<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelompok Mata Pelajaran</label></div>
		<div class="col-sm-9" ><select name="parent_id" class="form-control">
		<option value="">Pilih kelompok mapel</option>
		<?php
		$td = $this->db->query("select * from `m_kelompok_mapel` order by no_urut");
		foreach($td->result() as $d)
			{
			echo '<option value="'.$d->id_kelompok_mapel.'">'.$d->kelompok_mapel.'</option>';
			}
		?>
		</select></div>
		</div>
		<input type="hidden" name="diproses" value="tambah">
		<p class="text-center"><input type="submit" value="Tambah Menu Mapel" class="btn btn-primary"></p>
		</form>
		<?php
}
$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by parent_id");
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Menu Kelompok Mata Pelajaran</strong></td><td><strong>Menu Mata Pelajaran</strong></td><td width="60" colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($ta->result() as $a)
{
		$parent_id = $a->parent_id;
		$tb = $this->db->query("select * from `m_kelompok_mapel` where `id_kelompok_mapel`='$parent_id'");
		$kelompok_mapel ='';
		foreach($tb->result() as $b)
		{
			$kelompok_mapel = $b->kelompok_mapel;
		}

echo '<tr><td align="center">'.$nomor.'</td><td>'.$kelompok_mapel.'</td><td>'.$a->nama_kategori.'</td><td align="center"><a href="'.base_url().'admin/mapel/'.$a->id_kategori_tutorial.'/ubah" title="Ubah data"><span class="fa fa-edit"></span></a></td><td align="center"><a href="'.base_url().'admin/kelompokmapel/'.$a->id_kategori_tutorial.'/hapus" data-confirm="Anda yakin ingin menghapus '.$a->nama_kategori.' ini?" title="Hapus"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;
}
?>
</table>

</div></div></div>
