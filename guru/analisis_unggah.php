<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_unggah.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Modul Unggah Analisis Ulangan</h2>
<a href="<?php echo base_url(); ?>index.php/guru/analisis/<?php echo $id_mapel;?>/<?php echo $ulangan;?>"><b> Kembali</b></a>

<table>
<tr><td><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Ulangan</strong></td><td>: <strong><?php echo $ulangan;?></strong></td></tr>
</table>

<?php echo form_open_multipart('guru/prosesimporanalisis');?>
<table>
<tr><td>Berkas</td><td>:</td><td><input type="file" name="csvfile"></td></tr>
<tr><td></td><td></td><td>
<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>">
<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
<input type="submit" value="Kirim Berkas" class="tombol"></td></tr>
</table></form>
</div>
