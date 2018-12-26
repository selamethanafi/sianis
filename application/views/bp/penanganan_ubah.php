<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: penanganan_ubah.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Rab 01 Jul 2015 11:18:33 WIB 
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

<?php
if (!empty($id))
	{
	$ta = $this->db->query("select * from `pemberitahuan` where `id`= '$id'");
	if(count($ta->result())>0)
		{
		foreach($ta->result() as $a)
			{
			$thnajaran = $a->thnajaran;
			$nis = $a->nis;
			echo form_open('bp/simpanpenanganan','class="form-horizontal" role="form"');?>
			<div class="card">
			<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
			<div class="card-body">
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><?php echo $thnajaran;?></div></div>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS</label></div><div class="col-sm-9"><?php echo $nis;?></div></div>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9"><?php echo nis_ke_nama($nis);?></div></div>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penanganan ke - </label></div><div class="col-sm-9"><?php echo $a->ke;?></div></div>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tindakan Walikelas</label></div><div class="col-sm-9"><?php echo $a->tindakan_walikelas;?></div></div>
				<div class="form-group row"><div class="col-sm-12"><label class="control-label">Tindakan BP </label></div></div>
				<div class="form-group row"><div class="col-sm-12"><textarea name="tindakan_bp" rows="5" class="form-control"><?php echo $a->tindakan_bp;?></textarea></div></div>
				<div class="form-group row"><div class="col-sm-12"><label class="control-label">Tindakan Kesiswaan</label></div></div>
				<div class="form-group row"><div class="col-sm-12"><textarea name="tindakan_kesiswaan" rows="5" class="form-control"><?php echo $a->tindakan_kesiswaan;?></textarea></div></div>
				<input type="hidden" name="nis" value="<?php echo $nis;?>"><input type="hidden" name="id" value="<?php echo $id;?>">
				<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN PENANGANAN</button></p></div></div></form>
			<?php
			}
		}
	}
else
{
echo '<div class="alert alert-warning">Data tidak ditemukan, belum ada data atau siswa yang dimaksud selalu tertib</div>';
}
?>

</div>

