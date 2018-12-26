<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: tahun_penilaian.php
// Lokasi      		: application/views/tatausaha/
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
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggalawal").mask("99-99-9999")
	$("#tanggalakhir").mask("99-99-9999")
	$("#tanggalybs").mask("99-99-9999")
	$("#tanggalpenilai").mask("99-99-9999")
	$("#tanggalatasan").mask("99-99-9999")
	$("#tskp").mask("99-99-9999")
	$("#tpenilaian").mask("99-99-9999")
	});
</script>

<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$halaman = $page;
if ($aksi == 'tambah')
	{
	?>
	<a href="<?php echo base_url(); ?>tatausaha/pkgtahun" class="btn btn-info"><b>Daftar Tahun Penilaian</b></a>
	<?php echo form_open('tatausaha/pkgtahun','class="form-horizontal" role="form"');?>
	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-6"><input type="text" name="tahun" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Awal Penilaian (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="awal" id="tanggalawal" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Akhir Penilaian (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="akhir" id="tanggalakhir" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Penyusunan SKP (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tskp" id="tskp" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Penilaian SKP (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tpenilaian" id="tpenilaian" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Aktif Penilaian</label></div><div class="col-sm-6"><input type="text" name="aktif" value="0" class="form-control" size="1"> 1 = aktif, 0 = tidak aktif</div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Diterima Pejabat Penilai (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tpejabat" id="tanggalpenilai" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Diterima Yang bersangkutan (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tybs" id="tanggalybs" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Diterima Atasan Pejabat Penilai (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" id="tanggalatasan" name="tatasanpejabat" class="form-control"></div></div>
<p class="text-center"><input type="submit" value="Simpan Data Tahun Penilaian" class="btn btn-primary"></p></form>
	<?php
	}
elseif ($aksi == 'ubah')
	{
	if (empty($id))
		{
		echo 'Galat, data tidak ditemukan, karena kode kosong <a href="'.base_url().'index.php/tatausaha/pkgtahun"><b>Kembali</b></a>';

		}
		else
		{
		$ta=$this->db->query("SELECT * from pkg_masa where id_masa='$id'");
		if(count($ta->result()) == 0)
			{

			echo 'Galat, data tidak ditemukan <a href="'.base_url().'index.php/tatausaha/pkgtahun"><b>Kembali</b></a>';
			}
			else
			{
				foreach($ta->result() as $a)
				{
				$tahun = $a->tahun;
				$awal = tanggal($a->awal);
				$aktif = $a->aktif;
				$akhir = tanggal($a->akhir);
				$tskp = tanggal($a->tskp);
				$tpenilaian = tanggal($a->tpenilaian);
				$tpejabat = tanggal($a->tpejabat);
				$tybs = tanggal($a->tybs);
				$tatasanpejabat = tanggal($a->tatasanpejabat);
				}
			?>
			<a href="<?php echo base_url(); ?>tatausaha/pkgtahun" class="btn btn-info"><b>Daftar Tahun Penilaian</b></a>
			<h3>Ubah Data </h3>
	<?php echo form_open('tatausaha/pkgtahun','class="form-horizontal" role="form"');?>
	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-6"><input type="text" name="tahun" class="form-control" value="<?php echo $tahun;?>"></div></div>
	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Awal Penilaian (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" value="<?php echo $awal;?>" name="awal" class="form-control" id="tanggalawal"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Akhir Penilaian (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="akhir" id="tanggalakhir" class="form-control" value="<?php echo $akhir;?>"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Penyusunan SKP (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tskp" id="tskp" value="<?php echo $tskp;?>" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Penilaian SKP (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tpenilaian" id="tpenilaian" value="<?php echo $tpenilaian;?>" class="form-control"></div></div>

	<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Aktif Penilaian</label></div><div class="col-sm-6"><input type="text" name="aktif" class="form-control" size="1" value="<?php echo $aktif;?>"> 1 = aktif, 0 = tidak aktif</div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Diterima Pejabat Penilai (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tpejabat" id="tanggalpenilai" class="form-control" value="<?php echo $tpejabat;?>"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Diterima Yang bersangkutan (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" name="tybs" id="tanggalybs" class="form-control" value="<?php echo $tybs;?>"></div></div>
<div class="form-group row row"><div class="col-sm-6"><label class="control-label">Tanggal Diterima Atasan Pejabat Penilai (tanggal-bulan-tahun)</label></div><div class="col-sm-6"><input type="text" id="tanggalatasan" name="tatasanpejabat" class="form-control" value="<?php echo $tatasanpejabat;?>"></div></div>
<p class="text-center"><input type="hidden" name="id_masa" class="form-control" value="<?php echo $id;?>"><input type="submit" value="Simpan Data Tahun Penilaian" class="btn btn-primary"></p></form>
	<?php
			}
		}
	}

else
{

if (empty($page))
	{
	$halaman = 0;
	}
?>
<p><a href="<?php echo base_url(); ?>tatausaha/pkgtahun/<?php echo $halaman;?>/tambah" class="btn btn-info"><b>Tambah Tahun Penilaian</b></a></p>
<?php }?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Penilaian</strong></td><td><strong>Awal Penilaian</strong></td><td><strong>Akhir Penilaian</strong></td><td><strong>Penyusunan SKP</strong></td><td><strong>Penilaian SKP</strong></td><td><strong>Diterima Pejabat Penilai</strong></td><td><strong>Diterima Ybs</strong></td><td><strong>Diterima Atasan Pejabat Penilai</strong></td><td><strong>Aktif</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
$aktif = $b->aktif;
echo "<tr align=\"center\"><td>".$nomor."</td><td>".$b->tahun."</td><td>".date_to_long_string($b->awal)."</td><td>".date_to_long_string($b->akhir)."</td><td>".date_to_long_string($b->tskp)."</td><td>".date_to_long_string($b->tpenilaian)."</td><td>".date_to_long_string($b->tpejabat)."</td><td>".date_to_long_string($b->tybs)."</td><td>".date_to_long_string($b->tatasanpejabat)."</td><td>".$b->aktif."</td><td><a href='".base_url()."index.php/tatausaha/pkgtahun/".$halaman."/ubah/".$b->id_masa."' title='Edit'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
?>
</table>
<?php
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
</div></div></div>
