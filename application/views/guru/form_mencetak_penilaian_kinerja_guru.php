<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_mencetak_penilaian_kinerja_guru.php
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
<?php echo form_open('guru/cetakpkg','class="form-horizontal" role="form"');?>
<?php 
echo '<input type="hidden" name="yangdicetak" value="Penilaian Kinerja Guru"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<?php
if (!empty($thnpkg))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="thnpkg" type="hidden" value="'.$thnpkg.'">'.$thnpkg.'</p></div></div>';
	}
else
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<select name="thnpkg" class="form-control">';
	echo "<option value='".$thnpkg."'>".$thnpkg."</option>";
        $th=date("Y");
        $awal_th=$th;
        $akhir_th=$th-10;
	$i = $awal_th;
	do
	{
       	echo '<option value="'.$i.'">'.$i.'</option>';
	$i=$i-1;
	}
	while ($i>=$akhir_th);	
	echo '</select></div></div>';
	echo '<p class="text-center">';
	echo '<input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak Penilaian Kinerja Guru" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p></div></div>';
	}
?>
</table>
</form>
</div>
