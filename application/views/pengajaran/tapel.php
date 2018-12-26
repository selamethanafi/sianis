<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:02:53 WIB 
// Nama Berkas 		: tapel.php
// Lokasi      		: application/views/pengajaran/
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
if ($aksi== 'tambah')
{
	?>
	<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript">
		jQuery(function($){
			$("#tanggalawal").mask("99-99-9999")
			$("#tanggalakhir1").mask("99-99-9999")
			$("#tanggalawal2").mask("99-99-9999")
			$("#tanggalakhir2").mask("99-99-9999")
			$("#thnajaran").mask("9999/9999")
			});
	</script>
	<?php echo form_open('pengajaran/tapel','class="form-horizontal" role="form"');?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Ajaran</label></div><div class="col-sm-9"><input type="text" id="thnajaran" name="thnajaran" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Awal Tahun</label></div><div class="col-sm-9"><input type="text" id="tanggalawal" name="awal" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Akhir Semester 1 / Rapor</label></div><div class="col-sm-9"><input type="text" id="tanggalakhir1" name="akhir1" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Awal Semester 2</label></div><div class="col-sm-9"><input type="text" id="tanggalawal2" name="awal2" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Akhir Semester 2 / Rapor</label></div><div class="col-sm-9"><input type="text" id="tanggalakhir2" name="akhir2" class="form-control"></div></div>
		<input type="hidden" name="proses" value="tambah"><p class="text-center"><button type="submit" class="btn btn-primary">Simpan Tahun Pelajaran</button> <a href="<?php echo base_url(); ?>pengajaran/tapel/tampil" class="btn btn-info"><b>BATAL</b></a></p></form>
	<?php
}	
elseif ($aksi== 'ubah')
{
	$ta=$this->Pengajaran_model->Tampil_Edit_Tapel($page);
	$adata = $ta->num_rows();
	if($adata>0)
	{
		foreach($ta->result() as $c)
		{
			$id = $c->id;
			$thnajaran = $c->thnajaran;
			$awal = tanggal($c->awal);
			$awal2 = tanggal($c->awal2);
			$akhir1 = tanggal($c->akhir1);
			$akhir2 = tanggal($c->akhir2);
		}
		?>
		<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
		<script type="text/javascript">
		jQuery(function($){
			$("#tanggalawal").mask("99-99-9999")
			$("#tanggalakhir1").mask("99-99-9999")
			$("#tanggalawal2").mask("99-99-9999")
			$("#tanggalakhir2").mask("99-99-9999")
			$("#thnajaran").mask("9999/9999")
			});
		</script>
		<?php echo form_open('pengajaran/tapel','class="form-horizontal" role="form"');?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Ajaran</label></div><div class="col-sm-9"><input type="text" id="thnajaran" name="thnajaran" value="<?php echo $thnajaran;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Awal Tahun</label></div><div class="col-sm-9"><input type="text" id="tanggalawal" name="awal" value="<?php echo $awal;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Akhir Semester 1 / Rapor</label></div><div class="col-sm-9"><input type="text" id="tanggalakhir1" name="akhir1" value="<?php echo $akhir1;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Awal Semester 2 </label></div><div class="col-sm-9"><input type="text" id="tanggalawal2" name="awal2" value="<?php echo $awal2;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Akhir Semester 2 / Rapor</label></div><div class="col-sm-9"><input type="text" id="tanggalakhir2" name="akhir2" value="<?php echo $akhir2;?>" class="form-control"></div></div>
		<p class="text-center"><input type="hidden" name="proses" value="ubah"><input type="hidden" name="id" value="<?php echo $id;?>"><p class="text-center"><button type="submit" class="btn btn-primary">Perbarui</button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>pengajaran/tapel/tampil" class="btn btn-info"><b>BATAL</b></a></p></form>
		<?php
	}
	else
	{
		echo '<div class="alert alert-danger">Tahun pelajaran tidak ditemukan <a href="'.base_url().'pengajaran/tapel">Balik</a></div>';
	}
}	
else
{
?>
<p><a href="<?php echo base_url(); ?>pengajaran/tapel/tambah" class="btn btn-info"><span class="fa fa-plus"></span> <b>Tambah Tahun Pelajaran</b></a></p>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Awal Tahun</strong></td><td><strong>Akhir Semester 1</strong></td><td><strong>Awal Semester 2</strong></td><td><strong>Akhir Semester 2</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
$aktif = $b->aktif;
echo "<tr align=\"center\"><td>".$nomor."</td><td>".$b->thnajaran."</td><td>".date_to_long_string($b->awal)."</td><td>".date_to_long_string($b->akhir1)."</td><td>".date_to_long_string($b->awal2)."</td><td>".date_to_long_string($b->akhir2)."</td><td><a href='".base_url()."pengajaran/tapel/ubah/".$b->id."' title='Edit'><span class='fa fa-edit'></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	echo $paginator;}
}?>
</div></div></div>
