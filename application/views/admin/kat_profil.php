<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kat_profil.php
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
<p><a href="<?php echo base_url(); ?>admin/profil" class="btn btn-info"><b>Daftar Profil</b></a> <a href="<?php echo base_url(); ?>admin/katprofil/tambah" class="btn btn-primary"><b>Tambah Kategori Profil</b></a> <p>
<?php
if($aksi == 'tambah')
{
	echo form_open('admin/katprofil','class="form-horizontal" role="form"');
	?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kategori Profil</label></div>
		<div class="col-sm-9"><input type="text" name="nama_kategori" placeholder="nama kategori" class="form-control" required></div>
	</div>
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Data</button></p></form>
	<?php
}
elseif($aksi == 'ubah')
{
	echo form_open('admin/katprofil','class="form-horizontal" role="form"');
	?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kategori Profil</label></div>
		<div class="col-sm-9"><input type="text" name="nama_kategori" value="<?php echo $datakatprofil['nama_kategori'];?>" class="form-control" required></div>
	</div>
	<input type="hidden" name="id_kategori" value="<?php echo $datakatprofil['id_kategori'];?>">
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Data</button></p></form>
	<?php
}
else
{
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Judul Kategori Profil</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($kategori->result() as $b)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$b->nama_kategori.'</td><td width="50" align="center"><a href="'.base_url().'admin/katprofil/ubah/'.$b->id_kategori.'" title="Ubah data"><span class="fa fa-edit"></span></a></td><td width="50" align="center"><a href="'.base_url().'admin/katprofil/hapus/'.$b->id_kategori.'" data-confirm="Anda yakin ingin menghapus kategori '.$b->nama_kategori.'?"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;
}
?>
</table>

<?php
}?>
</div></div></div>

