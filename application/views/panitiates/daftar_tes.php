<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: daftar_tes.php
// Lokasi      		: application/views/panitiates/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if($aksi == 'ubah')
{
	$ta = $this->db->query("select * from `nama_tes` where `id_nama_tes`='$id'");
	if($ta->num_rows()>0)
	{
		foreach($ta->result() as $a)
		{
	 echo form_open('panitiates/simpannamates','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><input type="hidden" name="thnajaran" value="<?php echo $a->thnajaran;?>"><?php echo $a->thnajaran;?></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><input type="hidden" name="semester" value="<?php echo $a->semester;?>"><?php echo $a->semester;?></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Tes</label></div><div class="col-sm-9"><input type="text" name="namates" class="form-control" value="<?php echo $a->nama_tes;?>"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="pelaksanaan" class="form-control" value="<?php echo $a->pelaksanaan;?>"></div></div>
	<p class="text-center"><input type="hidden" name="id_nama_tes" value="<?php echo $id;?>"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
	</form>
<?php	
		}
	}
	else
	{
		echo '<div class="alert alert-warning">Galat! Data tes tidak ditemukan</div>';
	}
}
else
{
 echo form_open('panitiates/simpannamates','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><input type="hidden" name="semester" value="<?php echo $semester;?>"><?php echo $semester;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Tes</label></div><div class="col-sm-9"><input type="text" name="namates" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pelaksanaan</label></div><div class="col-sm-9"><input type="text" name="pelaksanaan" class="form-control"></div></div>
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
<?php
}?>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td width="30"><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Nama Tes</strong></td><td><strong>Pelaksanaan</strong></td><td align="center" width="60" colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
$ket='';
foreach($query->result() as $b)
{
	echo "<tr><td>".$nomor."</td><td>".$b->thnajaran."</td><td>".$b->semester."</td><td>".$b->nama_tes."</td><td>".$b->pelaksanaan."</td><td align=\"center\"><a href='".base_url()."panitiates/namates/ubah/".$b->id_nama_tes."' title='Ubah data tes'><span class='fa fa-edit'></span></a></td><td align=\"center\"><a href='".base_url()."panitiates/namates/hapus/".$b->id_nama_tes."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class='fa fa-trash-alt'></span></a></td></tr>";

$nomor++;
}
?>
</table></div>
</div></div></div>
