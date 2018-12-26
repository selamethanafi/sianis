<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:16:09 WIB 
// Nama Berkas 		: bg_menu.php
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
<div id="menu-bar">
	<div id="menu-tengah">
		<div id="smoothmenu1" class="ddsmoothmenu">
			<ul>
			<li><a href="<?php echo base_url(); ?>index.php/panitiates">Beranda</a></li>
			</ul>
			<ul>
			<li><a href="#">Siswa <img src="<?php echo base_url(); ?>tema/images/down.gif" border="0"></a>
				<ul>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/siswa">&#8226;  Pencarian Siswa</a>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/siswakelas">&#8226;  Daftar Siswa</a>
				</ul>
			</li>
			<li><a href="#">Pengaturan Tes <img src="<?php echo base_url(); ?>tema/images/down.gif" border="0"></a>
				<ul>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/namates">&#8226;  Nama Tes</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/unduhsiswa">&#8226;  Unduh Daftar Siswa</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/imporsiswa">&#8226;  Unggah Daftar Siswa</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/imporlabel">&#8226;  Unggah Data Label</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/ruangtes">&#8226;  Pengaturan Ruang Tes</a></li>
				</ul>
			</li>
			<li><a href="#">Pencetakan <img src="<?php echo base_url(); ?>tema/images/down.gif" border="0"></a>
				<ul>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/cetakkartu">&#8226;  Kartu Per Kelas</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/kartutes">&#8226;  Kartu Perorangan</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/cetaknominasi">&#8226;  Nominasi</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/denahtempatduduk">&#8226;  Denah Tempat Duduk</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/panitiates/cetaklabel">&#8226;  Label Amplop / Tas / Map</a></li>

				<li><a href="<?php echo base_url(); ?>index.php/panitiates/kartusementara">&#8226;  Kartu Sementara</a></li>
				</ul>
			</li>

			<li><a href="<?php echo base_url(); ?>index.php/situs/logout">Logout</a></li>
			</ul>
<br style="clear: left" />
</div>
</div>
</div>
<br />
