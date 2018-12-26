<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 30 Mar 2018 14:26:56 WIB 
// Nama Berkas 		: isi_index.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="container-fluid">
	<div class="card">
		<div class="card-header"><h2>Selamat Datang di Beranda BK</h2></div>
		<div class="card-body">
			Selamat datang <b><?php echo $nama; ?></b><br />
			<p>
				Pilih tampilan klik di <a href="<?php echo base_url();?>bp/csstema" class="btn btn-info">sini</a>
			</p>
		</div>
	</div>
</div>
