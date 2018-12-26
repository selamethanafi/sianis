<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 05 Jan 2016 11:00:42 WIB 
// Lokasi      		: application/views/guru/
// Nama Berkas 		: cetak_blanko_nilai.php
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
<?php echo form_open('pdf_blanko_nilai','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
foreach($daftar_tapel->result_array() as $k)
{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">
<?php
echo '<option value="'.$semester.'">'.$semester.'</option>';
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Psikomotor Afektif terpisah?</label></div><div class="col-sm-9">
<select name="pilihan" class="form-control">
<?php
if(!isset($pilihan))
	{
	$pilihan = '';
	}
if ($pilihan=='1')
	{
 		echo "<option value='1'>Psikomotor dan Afektif 1 halaman</option>";
		echo '<option value=""></option>';
		echo "<option value='2'>Psikomotor dan Afektif terpisah (2 halaman)</option>";
	}
elseif ($pilihan=='2')
	{
	echo "<option value='2'>Psikomotor dan Afektif terpisah (2 halaman)</option>";
	echo '<option value=""></option>';
 	echo "<option value='1'>Psikomotor dan Afektif 1 halaman</option>";
	}
else
	{
	echo '<option value=""></option>';
 	echo "<option value='1'>Psikomotor dan Afektif 1 halaman</option>";
	echo "<option value='2'>Psikomotor dan Afektif terpisah (2 halaman)</option>";
	}	

	?>
	</select></div></div>
	<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"><input type="hidden" name="kodeguru" value="<?php echo $kodeguru;?>"></div></div>
</form>
</table>

</div>
