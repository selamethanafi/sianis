<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 14:50:14 WIB 
// Nama Berkas 		: kategori_berita.php
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
	$nama_kategori = 'Tak berkategori';
	foreach ($judul_kategori->result_array() as $row) {
	$nama_kategori=$row['nama_kategori'];
	}
	?>
	<div class="card">
		<div class="card-header"><h2>Berita <?php echo $nama_kategori;?></h2></div>
		<div class="card-body">
			<?php
			foreach ($query->result() as $row) 
			{
			?>
			<div class="col-sm-12">
				<h3><a href="<?php echo base_url().'situs/detailberita/'.$row->id_berita;?>"><?php echo $row->judul_berita;?></a></h3>
				<p class="text-info">Ditulis <?php echo date_to_long_string($row->tanggal);?></p>
				<div class="well">

					<?php
					$isi_berita = substr(strip_tags($row->isi),0,400);
echo '<img src="'.base_url().'images/berita/'.$row->gambar.'" class="img img-rounded" alt="ikon berita">'.$isi_berita.' <strong> .... <a href="'.base_url().'situs/detailberita/'.$row->id_berita.'" class="btn btn-success">[Baca Selengkapnya]</a></strong>';
					?>
				</div>
			</div>
			<?php
			}
		echo '</div>';
		?>
	</div>
	<?php
	if(!empty($paginator))
	{
		?>
		<h5><?php echo $paginator;?></h5>
	<?php }?>
</div>
