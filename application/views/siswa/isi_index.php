<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: isi_index.php
// Lokasi      		: application/views/siswa/
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
<div class="container-fluid">
<div class="panel panel-default">
	<div class="panel-heading"><h3>Selamat Datang di Beranda Siswa</h3>Assalamu alaikum wr.wb., <b><?php echo $nama; ?></b></h3></div>
	<div class="panel-body">
<ul>
<li class="li-class"><b>Beranda</b><br>- Tampilan utama </li>
<li class="li-class"><b>Nilai</b><br>- Melihat Nilai Anda </li>
<li class="li-class"><b>Kepribadian</b><br>- Melihat Penilaiaan Akhlak Mulia</li>
<li class="li-class"><b>Pesan</b><br>- Melihat dan mengirim pesan ke guru</li>
<li class="li-class"><b>Cabut</b><br>- Keluar dari beranda dan akhiri session</li>
</ul>
<p>
Pilih tampilan klik di <a href="<?php echo base_url();?>siswa/csstema">sini</a>
</p>

</div></div></div>


