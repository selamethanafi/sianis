<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 23:00:22 WIB 
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
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'nomor ijazah'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `leger_info` (`thnajaran`, `item`) values('$thnajaran', 'nomor ijazah')");
}
$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'lokasi'");
if($ta->num_rows() == 0)
{
	$lokasi = $this->config->item('lokasi');
	$this->db->query("insert into `leger_info` (`thnajaran`, `item`, `konten`) values('$thnajaran', 'lokasi', '$lokasi')");
}
$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'tanggal kelulusan'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `leger_info` (`thnajaran`, `item`) values('$thnajaran', 'tanggal kelulusan')");
}
$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'nomor skl'");
if($ta->num_rows() == 0)
{
	$this->db->query("insert into `leger_info` (`thnajaran`, `item`) values('$thnajaran', 'nomor skl')");
}



	echo form_open('tatausaha/dataijazah','class="form-horizontal" role="form"');
	$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'nomor ijazah'");
	foreach($ta->result() as $a)
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Ijazah</label></div><div class="col-sm-9"><td><input type="text" name="nomor_ijazah" value="<?php echo $a->konten;?>" placeholder="nomor ijazah tanpa tahun" class="form-control"></div></div>
		<?php
	}
	$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'lokasi'");
	foreach($ta->result() as $a)
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Lokasi / kota / kab</label></div><div class="col-sm-9"><td><input type="text" name="lokasi" value="<?php echo $a->konten;?>" placeholder="kabupaten / kota" class="form-control"></div></div>
		<?php
	}
	$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'tanggal kelulusan'");
	foreach($ta->result() as $a)
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal Ijazah</label></div><div class="col-sm-9"><td><input type="text" name="tanggal_kelulusan" value="<?php echo $a->konten;?>" placeholder="tanggal penandatanganan ijazah YYYY-MM-DD" class="form-control"></div></div>
		<?php
	}
	$ta = $this->db->query("select * from `leger_info` where `thnajaran`='$thnajaran' and `item` = 'nomor skl'");
	foreach($ta->result() as $a)
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor SKHUN Sementara</label></div><div class="col-sm-9"><td><input type="text" name="nomor_skl" value="<?php echo $a->konten;?>" placeholder="nomor SKHUN Sementara tanpa tahun" class="form-control"></div></div>
		<?php
	}

	?>
	<p class="text-center"><input type="hidden" name="proses" value="ubah"><p class="text-center"><button type="submit" class="btn btn-primary">Perbarui</button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>tatausaha" class="btn btn-info"><b>BATAL</b></a></div></div></form>
</div></div></div>
