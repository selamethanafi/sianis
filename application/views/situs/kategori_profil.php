<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 13:46:14 WIB 
// Nama Berkas 		: kategori_profil.php
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
<?php
$nomor=1;
if(count($judul_kategori->result()) == 0)
{
	?>
	<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h2>Profil tidak ditemukan</h2></div>
	<div class="card-body">
	<?php
}
else
{
	foreach ($judul_kategori->result_array() as $row) 
	{
		$nama_kategori=$row['nama_kategori'];
	}
	?>
		<div class="container-fluid">
		<div class="card">
		<div class="card-header"><h2><?php echo $nama_kategori;?></h2></div>
		<div class="card-body">
	<?php
	foreach ($query->result() as $row) 
	{
		$isi_berita = substr(strip_tags($row->isi),0,400);
		echo '<div class="well">';
		echo '<h3><a href="'.base_url().'situs/detailprofil/'.$row->id_berita.'">'.$row->judul_berita.'</a></h3>';
		echo '<span>Kategori <strong>'.$row->nama_kategori.'</strong> - '.tanggal($row->tanggal).' -|- '.$row->waktu.' WIB</span>
	<p>
		<span><img src="'.base_url().'images/profil/'.$row->gambar.'" width="75"  class="img img-rounded"></span>'.$isi_berita.' 		<strong>.... <a href="'.base_url().'situs/detailprofil/'.$row->id_berita.'" class="btn btn-success">[Baca Selengkapnya]</a></strong></p></div>';
	}
}
if(!empty($paginator))
	{
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
	}
?>

</div></div></div>
