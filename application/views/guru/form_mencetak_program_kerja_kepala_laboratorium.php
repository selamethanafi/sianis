<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_mencetak_program_kerja_kepala_laboratorium.php
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
?><div class="container-fluid"><h2>Mencetak Program Kerja Tugas Tambahan - <?php echo $this->config->item('nama_web');?></h2>
<?php echo form_open('guru/formmencetak/'.$noyangdicetak);?>
<?php 

echo '<input type="hidden" name="yangdicetak" value="Program Kerja Tugas Tambahan"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<table>
<?php
	echo '<tr><td>Tahun Pelajaran</td><td>:</td><td>
	<select name="thnajaran" class="textfield-option">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select><font color="#FF0000"><strong> Pilih tahun pelajaran</strong></td></tr>';
	echo '<tr><td>Semester</td><td>:</td><td>
	<select name="semester" class="textfield-option">';
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option><option value='2'>2</option>";
	echo '</select><font color="#FF0000"><strong> Pilih Semester</strong></td></tr>';
	echo '<tr><td>Ditandatangani kepala</td><td>: </td><td>';
	echo '<select name="ditandatangani" class="textfield-option">';
	echo '<option value="ya">ya</option>';
	echo '<option value="tidak">tidak</option>';
	echo '</select><font color="#FF0000"><strong> Pilih ditandatangani kepala?</strong></td></tr>';
	echo '<tr><td></td><td></td><td>';
	echo '<input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak Program Kerja Tugas Tambahan" class="tombol-merah">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/guru/formmencetak"><b>Batal</b></a></td></tr>';
?>
</table>
</form>
</div>
