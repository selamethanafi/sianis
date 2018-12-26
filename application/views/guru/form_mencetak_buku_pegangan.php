<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_mencetak_buku_pegangan.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('guru/formmencetak/'.$noyangdicetak,'class="form-horizontal" role="form"');?>
<?php 
echo '<input type="hidden" name="yangdicetak" value="Daftar Buku Pegangan"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9">';
	echo '<select name="ditandatangani" class="form-control">';
	echo '<option value="ya">ya</option>';
	echo '<option value="tidak">tidak</option>';
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak Daftar Buku Pegangan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
</div></div></div>
