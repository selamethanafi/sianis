<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: cetak_denah_tempat_duduk.php
// Lokasi      		: application/views/panitiates/
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
<div id="isi"><h2>Modul Mencetak Label - <?php echo $this->config->item('nama_web');?></h2><br />
<?php echo form_open('pdf_kartu_tes/label');?>
<table width="100%" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="150" valign="top">Tahun Pelajaran</td><td width="10" valign="top">:</td><td><input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></td></tr>
<tr><td width="150" valign="top">Semester</td><td width="10" valign="top">:</td><td><input type="hidden" name="semester" value="<?php echo $semester;?>"><?php echo $semester;?></td></tr>
<tr><td width="150" valign="top">Nama Tes</td><td width="10" valign="top">:</td><td>
<select name="id_nama_tes" class="textfield-option">
<?php
foreach($daftar_tes->result_array() as $k)
{
echo "<option value='".$k["id_nama_tes"]."'>".$k["nama_tes"]."</option>";
}
?>
</select></td></tr>
<tr><td width="150" valign="top">Cetak Peserta di sebelah</td><td width="10" valign="top">:</td><td>
<select name="tunggal" class="textfield-option">

<?php
	echo '<option value="1">Kiri</option>';
	echo '<option value="2">Kanan</option>';
	echo '<option value="3">Kiri dan Kanan</option>';
?>
</select></td></tr>

<tr><td width="150" valign="top"></td><td width="10" valign="top"></td><td><input type="submit" value="Cetak Label" class="tombol"></td></tr>
</table>
</form>
</div>
