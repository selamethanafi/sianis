<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: kirim_pesan.php
// Lokasi      		: application/views/shared
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
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
<?php
if($status =="Pengawas")
	{ echo form_open('pengawas/kirimpesan');
	}
elseif($status =="Kepala")
	{ echo form_open('kepala/kirimpesan');
	}

?>
<br /><br /><br />
<strong>Saran </strong>
<table cellspacing="1">
<tr><td width="150"><h3>Nama Guru</h3></td><td width="10">:</td><td><?php echo $namaguru; ?></td></tr>
<tr><td width="150"><h3>Subjek Pesan</h3></td><td width="10">:</td><td><input type="hidden" name="subjek" value="<?php echo $yangdicetak.' '.$tugastambahan;?>"><input type="hidden" name="kodeguru" value="<?php echo $kodeguru;?>"><?php echo $yangdicetak.' '.$tugastambahan;?></td></tr>
<tr><td width="150" valign="top"><h3>Saran</h3></td><td width="10" valign="top">:</td><td><textarea name="pesan" rows="4" cols="30" class="textfield"></textarea></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Kirim Saran" class="tombol"></td></tr>
</table></form>

