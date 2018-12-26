<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : skp_pkg.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3>Daftar Usulan PAK</h3></div>
<div class="card-body">
<?php
echo '<p><a href="'.base_url().'dupak/masa" class="btn btn-info"><b>Kembali</b></a></p>';
$ta = $this->db->query("SELECT * FROM `p_kepegawaian` where `idpegawai`='$username' and (`jenis_sk` = 'SK CPNS' or `jenis_sk` = 'SK PNS' or `jenis_sk` = 'SK KP')");
echo form_open('dupak/awal','class="form-horizontal" role="form"');
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Golongan Saat Pengajuan PAK</label></div><div class="col-sm-9"><select name="golongan" class="form-control">';
foreach($ta->result() as $a)
{
	$golongan = substr($a->gol,3,10);
	echo '<option value ="'.$golongan.'">'.$golongan.'</option>';
	}
echo '</select></div></div>
<input type="hidden" name="proses"  value ="awal"><p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
</form>';
echo '</div></div></div>';
?>

