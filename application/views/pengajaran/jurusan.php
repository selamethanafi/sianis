<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 03:16:05 WIB 
// Nama Berkas 		: jurusan.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2014 selamet hanafi
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
	<a href="<?php echo base_url(); ?>pengajaran/jurusan" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>Daftar Jurusan / Program / Minat </b></a><p></p>
	<?php echo form_open('pengajaran/simpanjurusan','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Jurusan / Program / Minat</label></div>
		<div class="col-sm-9"><input type="text" name="program" class="form-control" required></div></div>
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data Jurusan / Program / Minat</button></p>
	</form>
	<?php

}
elseif($aksi == 'ubah')
{
	?>
	<a href="<?php echo base_url(); ?>pengajaran/jurusan" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>Daftar Jurusan / Program / Minat </b></a><p></p>
	<?php
	$ta = $this->db->query("select * from `m_program` where `id`='$id'");
	if(count($ta->result())==0)
		{
		header('Location: '.base_url().'pengajaran/jurusan');
		}
	foreach($ta->result() as $a)
	{
		$id = $a->id;
		$program = $a->program;
		$category_majors_id = $a->category_majors_id;
	}
	?>
	<?php echo form_open('pengajaran/simpanjurusan','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jurusan / Program / Minat</label></div><div class="col-sm-9"><input type="text" name="program" value="<?php echo $program;?>" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kode dari ARD</label></div><div class="col-sm-9"><select name="category_majors_id" class="form-control" required>
		<option value="<?php echo $category_majors_id;?>"><?php echo $category_majors_id;?></option>
		<option value=""></option>
		<option value="0">0 NON JURUSAN</option>
		<option value="1">1 IPA</option>
		<option value="2">2 IPS</option>
		<option value="3">3 BAHASA</option>
		<option value="4">4 KEAGAMAAN</option>
	</select>
</div></div>
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data Jurusan / Program / Minat</button></p>
	</form>
	<?php
}
else
{
?>
<a href="<?php echo base_url(); ?>pengajaran/jurusan/tambah" class="btn btn-info"><span class="fa fa-plus"></span> <b>Jurusan / Program / Minat</b></a><p></p>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Program / Jurusan / Peminatan</strong></td><td>Kode dari ARD</td><td width="30"><strong>Aksi</strong></td></tr>
<?php
$query = $this->db->query("select * from m_program order by program");
$nomor=1;
foreach($query->result() as $b)
{
echo "<tr><td align=\"center\">".$nomor."</td><td>".$b->program."</td><td>".$b->category_majors_id."</td><td align=\"center\"><a href='".base_url()."pengajaran/jurusan/ubah/".$b->id."' title='Ubah Data'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
<?php
}
?>
</div></div></div>
