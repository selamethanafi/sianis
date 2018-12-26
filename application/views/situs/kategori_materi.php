<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 15 Jan 2016 21:55:26 WIB
// Nama Berkas 		: kategori_materi.php
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
	foreach ($judul_kategori->result_array() as $row) {
	$nama_kategori=$row['nama_kategori'];
	}

	?>
	<h2>Materi mata pelajaran <?php echo $nama_kategori;?></h2>
	<?php
	foreach ($query->result() as $row) 
	{
		?>
		<div class="card">
			<div class="card-header"><h3><?php echo '<a href="'.base_url().'situs/detailmateri/'.$row->id_tutorial.'">'.$row->judul_tutorial.'</a></h2></div>';?>
			<div class="card-body">
				<?php
				$isi_tutorial = substr(strip_tags($row->isi),0,200);
				echo '
<span>Materi pelajaran <b>'.$row->nama_kategori.'</b> - '.tanggal($row->tanggal).' -|- '.$row->waktu.' WIB</span><span class="img img-rounded"><img src="'.base_url().'images/tutorial/'.$row->gambar.'" width="75" alt="ikon materi"></span> '.$isi_tutorial.' <b> .... <a href="'.base_url().'situs/detailmateri/'.$row->id_tutorial.'" class="btn btn-success">[Baca Selengkapnya]</a></b>';
			echo '</div>';
		echo '</div><hr>';
	}
	?>
	<h5 class="text-center"><?php echo $paginator;?></h5>
</div>
