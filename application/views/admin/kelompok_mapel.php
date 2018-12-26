<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kelompok_mapel.php
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
if ((!empty($id_kelompok_mapel)) and ($aksi=='hapus'))
	{
	$this->db->query("delete from `m_kelompok_mapel` where `id_kelompok_mapel`='$id_kelompok_mapel'");
	}
if ((!empty($id_kelompok_mapel)) and ($aksi=='ubah'))
	{
	$tb = $this->db->query("select * from `m_kelompok_mapel` where `id_kelompok_mapel`='$id_kelompok_mapel'");
	if(count($tb->result())==0)
		{
		header('Location: '.base_url().'admin/kelompokmapel');
		}
		foreach($tb->result() as $b)
		{
		$no_urut = $b->no_urut;
		$kelompok_mapel = $b->kelompok_mapel;
		}
	echo form_open('admin/kelompokmapel','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelompok Mata Pelajaran</label></div>
		<div class="col-sm-9" ><input type="text" name="kelompok_mapel" value="<?php echo $kelompok_mapel;?>" class="form-control"></div>
	</div><div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Nomor Urut</label></div>
		<div class="col-sm-9" ><input type="text" name="no_urut" value="<?php echo $no_urut;?>" class="form-control"></div>
	</div>
	<input type="hidden" name="diproses" value="ubah"><input type="hidden" name="id_kelompok_mapel" value="<?php echo $id_kelompok_mapel;?>">
	<p class="text-center"><input type="submit" value="Ubah Kelompok Mapel" class="btn btn-primary"></p>
	</form>
<?php
}
else
{
	echo form_open('admin/kelompokmapel','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelompok Mata Pelajaran</label></div>
		<div class="col-sm-9" ><input name="kelompok_mapel" type="text" class="form-control"></div>
	</div>
<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Nomor Urut</label></div>
		<div class="col-sm-9" ><input name="no_urut" type="text" placeholder="nama kelompok mapel" class="form-control"></div>
	</div>
	<p class="text-center"><input type="hidden" name="diproses" value="tambah"><input type="submit" value="Tambah Kelompok Mapel" class="tombol"></p>
	</form>
<?php
}
$ta = $this->db->query("select * from m_kelompok_mapel order by no_urut ");
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Menu Kelompok Mata Pelajaran</strong></td><td width="60" colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($ta->result() as $a)
{
echo '<tr><td align="center">'.$a->no_urut.'</td><td>'.$a->kelompok_mapel.'</td><td align="center"><a href="'.base_url().'admin/kelompokmapel/'.$a->id_kelompok_mapel.'/ubah" title="ubah"><span class="fa fa-edit"></span></a></td><td align="center"><a href="'.base_url().'admin/kelompokmapel/'.$a->id_kelompok_mapel.'/hapus" data-confirm="Anda yakin ingin menghapus kelompok mapel '.$a->kelompok_mapel.', ini akan menghapus kelompok mapel di daftar mapel?" title="Hapus"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;
}
?>
</table>


</div></div></div>
