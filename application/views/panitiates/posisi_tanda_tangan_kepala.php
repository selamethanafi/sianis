<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 26 Nov 2015 16:47:34 WIB 
// Nama Berkas 		: posisi_tanda_tangan_kepala.php
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
<div id="isi"><h2>Modul Posisi Tanda Tangan Kepala di Kartu Tes - <?php echo $this->config->item('nama_web');?></h2><br />
<?php
$kartu_x = 0;
$kartu_y = 0;
$kartu_tinggi = 0;
$kartu_lebar = 0;
$tkepala =  $this->db->query("select * from `m_kepala` where `thnajaran`='$thnajaran' and `semester`='$semester'");
foreach($tkepala->result() as $t)
	{
	$kartu_x = $t->kartu_y;
	$kartu_y = $t->kartu_y;	
	$kartu_tinggi = $t->kartu_tinggi;
	$kartu_lebar = $t->kartu_lebar;

	}
echo form_open('pengajaran/posisitandatangan');?>
<table width="100%" style="border: 1pt ridge #cccccc;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="150" valign="top">Tahun Pelajaran</td><td width="10" valign="top">:</td><td><input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></td></tr>
<tr><td width="150" valign="top">Semester</td><td width="10" valign="top">:</td><td><input type="hidden" name="semester" value="<?php echo $semester;?>"><?php echo $semester;?></td></tr>
<tr><td width="150" valign="top">NIS</td><td width="10" valign="top">:</td><td>
<input type="text" name="nis1" size="10"></td></tr>
<tr><td width="150" valign="top">NIS</td><td width="10" valign="top">:</td><td>
<input type="text" name="nis2" size="10"></td></tr>
<tr><td width="150" valign="top">NIS</td><td width="10" valign="top">:</td><td>
<input type="text" name="nis3" size="10"></td></tr>
<tr><td width="150" valign="top">NIS</td><td width="10" valign="top">:</td><td>
<input type="text" name="nis4" size="10"></td></tr>

<tr><td width="150" valign="top"></td><td width="10" valign="top"></td><td><input type="submit" value="Cetak Kartu" class="tombol"></td></tr>
</table>
</form>
</div>
