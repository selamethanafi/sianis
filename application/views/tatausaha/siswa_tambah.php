<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 19:26:12 WIB 
// Nama Berkas 		: siswa_baru_pindahan.php
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
<div class="container-fluid"><h2>Modul Tambah Siswa </h2>
<?php
$bisa = 0;

if(empty($nis))
{
	echo form_open('tatausaha/tambahsiswa','class="form-horizontal" role="form"');
	?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk</label></div>
	<div class="col-sm-9"><input type="text" name="nis" value="" class="form-control"></div></div>
	<p class="text-center"><button type="submit"class="btn btn-primary">CEK NIS</button></p>
	</form>
	<?php
}
else
{
	$tdatsis = $this->db->query("select `nis` from `datsis` where `nis`='$nis'");
	$ada = $tdatsis->num_rows();
	if(($ada > 0) and ($proses != 'oke'))
	{
		echo '<div class="alert alert-danger">Nomor Induk '.$nis.' telah terdaftar atas nama '.nis_ke_nama($nis).'</div>';
		echo '<p class="text-center"><a href="'.base_url().'tatausaha/tambahsiswa" class="btn btn-info">CEK NIS LAIN</a></p>';
	}
	if($ada == 0)
	{
	echo form_open('tatausaha/tambahsiswa','class="form-horizontal" role="form"');
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk</label></div><div class="col-sm-9"><input type="hidden" name="proses" value="oke"><input type="hidden" name="nis" value="'.$nis.'">'.$nis.'</div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9"><input type="text" name="namasiswa" placeholder="nama siswa" class="form-control"></div></div>';
	echo '<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN DATA</button> <a href="'.base_url().'tatausaha/tambahsiswa" class="btn btn-info">Batal 1</a></p>';
	}
	if(($ada > 0) and ($proses == 'oke'))
	{
	echo '<tr><td width="200">Nomor Induk</td><td width="5">:</label><div class="col-sm-9">'.$nis.'</div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Siswa</td><td width="5">:</label><div class="col-sm-9">'.nis_ke_nama($nis).'</div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"></td><td width="5"></label><div class="col-sm-9">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/tatausaha/mutasisiswa/'.$nis.'">Mutasi Siswa</a></div></div>';
	}

}
?>

</form>

</div>

