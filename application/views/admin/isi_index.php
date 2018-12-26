<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: isi_index.php
// Lokasi      		: application/views/admin
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
	<div class="card-header"><h2><?php echo $judulhalaman;?></h2></div>
	<div class="card-body">
		<h2>Selamat Datang di Control Panel Admin - <?php echo $this->config->item('sek_nama');?></h2><br />
Selamat datang <b><?php echo $nama; ?></b>, anda Log In dengan username <b><?php echo $nim; ?></b> dan hak akses <b>admin</b>
<br /><br />
<p>
	Pilih tampilan klik di <a href="<?php echo base_url();?>admin/csstema" class="btn btn-info">sini</a>
</p>

	</div>
</div></div>
