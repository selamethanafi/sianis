<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/pegawai/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if ($aksi == 'tambah')
{
	?>
	<p><a href="<?php echo base_url(); ?>skptu/macam" class="btn btn-info"><b>Kembali ke Daftar Kegiatan</b></a></p>
	<?php echo form_open('skptu/macam','class="form-horizontal" role="form"');?>
	<div class="form-group"><div class="col-sm-3"><label class="control-label">Kegiatan Tugas Jabatan</label></div><div class="col-sm-9"><input type="text" name="kegiatan" class="form-control" required></div></div>
<div class="form-group"><div class="col-sm-3"><label class="control-label">Satuan</label></div><div class="col-sm-9"><select name="satuan" class="form-control" required><option value=""></option><option value="dokumen">dokumen</option><option value="laporan">laporan</option></select></div></div>
<p class="text-center"><input type="submit" value="Simpan Kegiatan" class="btn btn-primary"></p></form>
	<?php
}
elseif ($aksi == 'ubah')
{
	$tb = $this->db->query("select * from `skp_pegawai` where `kodepegawai` = '$kodeguru' and `id_skp_pegawai`='$id'");
	if($tb->num_rows() >0)
	{
		foreach($tb->result() as $b)
		{
			$kegiatan = $b->kegiatan;
			$satuan = $b->satuan;
		}
		?>
		<p><a href="<?php echo base_url(); ?>skptu/macam" class="btn btn-info"><b>Kembali ke Daftar Kegiatan</b></a></p>
		<?php echo form_open('skptu/macam','class="form-horizontal" role="form"');?>
		<div class="form-group"><div class="col-sm-3"><label class="control-label">Kegiatan Tugas Jabatan</label></div><div class="col-sm-9"><input type="text" name="kegiatan" value="<?php echo $kegiatan;?>" class="form-control" required></div></div>
<div class="form-group"><div class="col-sm-3"><label class="control-label">Satuan</label></div><div class="col-sm-9"><select name="satuan" class="form-control" required><option value="<?php echo $satuan;?>"><?php echo $satuan;?></option><option value="dokumen">dokumen</option><option value="kegiatan">kegiatan</option><option value="laporan">laporan</option></select></div></div>
		<p class="text-center"><input type="hidden" name="id_skp" value="<?php echo $id;?>"><input type="submit" value="Simpan Kegiatan" class="btn btn-primary"></p></form>
		<?php
	}
	else
	{
		echo '<div class="alert alert-info">Data tidak ditemukan, <a href="'.base_url().'skptu/macam" class="btn btn-primary"><b>Kembali</b></a></div>';
	}
}
else
{
	echo '<p><a href="'.base_url().'skptu/macam/tambah" class="btn btn-primary"><b>Tambah Kegiatan</b></a></p> ';
	if($query->num_rows() > 0)
	{
		echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td>Nomor</td><td>Kegiatan Tugas Jabatan</td><td>Satuan</td><td>Ubah</td></tr>';
		$nomor = 1;
		foreach($query->result() as $a)
		{
			echo '<tr><td align="center">'.$nomor.'<td>'.$a->kegiatan.'</td><td>'.$a->satuan.'</td><td align="center"><a href="'.base_url().'skptu/macam/ubah/'.$a->id_skp_pegawai.'"><span class="glyphicon glyphicon-edit"></span></a></td></tr>';
			$nomor++;
		}
		echo '</table>';
	}
	else
	{
		echo '<div class="alert alert-info">Belum ada data kegiatan</div>';
	}
}
?>


</div></div></div>
