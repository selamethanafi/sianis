<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 14:04:56 WIB 
// Nama Berkas 		: kategori_download.php
// Lokasi      		: application/views/situs/
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
/**
 * Sistem Informasi Madrasah Aliyah 
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
?>
<div class="container-fluid">
<?php
$nomor=1;
	foreach ($judul_kat->result() as $jdl) {
	$judul=$jdl->nama_kategori_download;
	}
	?>
<div class="card">
<div class="card-header"><h2>Kategori <?php echo $judul;?></h2></div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr><td width="15%"><b>No</b></td><td width="60%"><b>Judul File</b></td><td width="25%"><b>Action</b></td></tr>
<?php 
$nomor = 1;
foreach ($query->result() as $dwn) {
echo '<tr><td>'.$nomor.'</td><td>'.$dwn->judul_file.'</td><td><a href="'.$this->config->item('url_unduhan').'/'.$dwn->nama_file.'"><span class="fa fa-download"></span> <span class="fa fa-download"></span> </a></td></tr>';
$nomor++;
} 
?>
</table></div>
<h5 class="text-center"><?php echo $paginator;?></h5>
</div></div></div>
