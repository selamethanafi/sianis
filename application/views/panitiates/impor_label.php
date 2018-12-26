<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: impor_siswa.php
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
<div id="isi"><h2>Modul Unduh Daftar Nominasi - <?php echo $this->config->item('nama_web');?></h2><br />
<?php echo form_open_multipart('panitiates/proses_impor_label');?>
format data<br>
"baris","awal","akhir"
<table width="100%" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="150" valign="top">Berkas</td><td width="10" valign="top">:</td><td><input type="file" name="csvfile"></td></tr>
<tr><td width="150" valign="top"></td><td width="10" valign="top"></td><td><input type="submit" value="Kirim Berkas" class="tombol"></td></tr>
</table></form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div>
