<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : cetak_lck.php
// Lokasi      : application/views/tatausaha
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
if($item == 'labelrapor')
{
	echo form_open('pdf_report/cetakfoto/labelrapor','class="form-horizontal" role="form"');
}
else
{
	echo form_open('pdf_report/cetakfoto','class="form-horizontal" role="form"');
}

echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">';
foreach($daftar_tapel->result_array() as $k)
{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
}
echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">';
		echo "<option value='1'>1</option>";
		echo "<option value='2'>2</option>";
	echo '</select></div></div>';
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><select name="kelas" class="form-control">';
		foreach($daftar_kelas->result_array() as $ka)
		{
			echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
		}
		echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></div></div></form>';
?>
</div>
