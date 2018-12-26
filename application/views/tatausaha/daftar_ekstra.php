<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: daftar_ekstra.php
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
if($aksi == 'tambah')
{
	?>
	<a href="<?php echo base_url(); ?>tatausaha/daftarekstra" class="btn btn-info" role="button"><span class="fa fa-arrow-left"></span> <b>Daftar Ekstra</b></a>
	<?php echo form_open('tatausaha/daftarekstra','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div>
		<div class="col-sm-9"><input type="text" name="namaekstra" class="form-control" required></div>
	</div>
	<p class="text-center"><input type="submit" value="Simpan Ekstra" class="btn btn-primary"></p>
	</form>
	<?php

}
elseif($aksi == 'ubah')
{
	if($adadata == 0)
	{
		echo '<div class="alert alert-danger">Galat! data tidak ditemukan</div>';
	}
	else
	{
/*
		$server_pusate = $url_ard_unduh;
		$server_pusat = $url_ard_unduh;
		$port_host = 80;
		if(strpos($server_pusat, 'https://') !== false)
		{
			$server_pusate = 'ssl://'.str_replace('https://','',$server_pusat);
			$port_host = '443';
		}
		if(strpos($server_pusat, 'http://') !== false)
		{
			$server_pusate = str_replace('http://','',$server_pusat);
			$port_host = '80';
		}
		if($socket =@ fsockopen($server_pusate, $port_host, $errno, $errstr, 30))
		{
			$online = 1;
			fclose($socket);
		}
		else 
		{
			$online = 0;
			echo 'Server ARD Unduh tidak menyala';
		}
		$school_id = 'tidak ada data';
		if($online == 1)
		{
			$file = file_get_contents($url_ard_unduh.'/api/sekolah.php');
			$json = json_decode($file, true);
			$school_id = $json[0]['school_id'];
		}
		$school_extracurricular_id = '';
		$school_extracurricular_id_ = '';
*/
		?>


		<a href="<?php echo base_url(); ?>tatausaha/daftarekstra" class="btn btn-info" role="button"><span class="fa fa-arrow-left"></span> <b>Daftar Ekstra</b></a>
		<?php
		echo form_open('tatausaha/daftarekstra','class="form-horizontal" role="form"');
		foreach($det->result_array() as $k)
		{
			$namaekstra=$k["namaekstra"];
			$id = $k["id_ekstra"];
			$school_extracurricular_id = $k['school_extracurricular_id'];
		}
/*
		if($school_id == 'ada')
		{
			$namaekstrae = $k['namaekstra'];
			$namaekstrae = preg_replace("/ /","+", $namaekstrae);
			$file = file_get_contents($url_ard_unduh.'/api/ekstrakurikuler.php?school_extracurricular_name='.$namaekstrae);
			$json = json_decode($file, true);
			$school_extracurricular_id = $json[0]['school_extracurricular_id'];
		}
		if(($online == 1) and ($school_id == 'ada'))
		{
			$school_extracurricular_id_ = $school_extracurricular_id;
		}
		else
		{
			$school_extracurricular_id_ = $school_extracurricular_id_tersimpan;
		}

		echo 'Server = '.$online.' Mysql = '.$school_id;
*/
		?>
		<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Nama Ekstra</label></div><div class="col-sm-9"><input type="text" name="namaekstra" class="form-control"  value="<?php echo $namaekstra; ?>"></div></div>
		<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kode Ekstra dari ARD</label></div><div class="col-sm-9"><input type="text" name="school_extracurricular_id" class="form-control"  value="<?php echo $school_extracurricular_id; ?>"></div></div>
		<p class="text-center"><input type="submit" value="Simpan Ekstra" class="btn btn-primary" role="button"><input type="hidden" name="id_ekstra" value="<?php echo $id; ?>"></p>
		</form>
		<?php
	}
}
else
{

?>
	<p><a href="<?php echo base_url(); ?>tatausaha/daftarekstra/tambah" class="btn btn-info" role="button"><span class="fa fa-plus"></span> <b>Ekstrakurikuler</b></a></p>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama Ekstrakurikuler</strong></td><td><strong>Kode Ekstra dari ARD</strong></td><td><strong>Ubah</strong></td><td><strong>Hapus</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
	$id_ekstra = $b->id_ekstra;
echo "<tr><td align=\"center\">".$nomor;
	echo "</td><td>".$b->namaekstra."</td><td>".$b->school_extracurricular_id."</td><td align=\"center\"><a href='".base_url()."tatausaha/daftarekstra/ubah/".$b->id_ekstra."' title='Edit'><span class=\"fa fa-edit\"></span></td><td align=\"center\" ><a href='".base_url()."index.php/tatausaha/daftarekstra/hapus/".$b->id_ekstra."' onClick=\"return confirm('Anda yakin ingin menghapus ".$b->namaekstra."?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";

$nomor++;
}
?>
</table>
<?php
}
?>
</div>
