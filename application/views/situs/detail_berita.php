<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 15 Jan 2016  WIB 
// Nama Berkas 		: detail_berita.php
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
<!-- START CONTENT -->
		<?php
		foreach($detail->result() as $rows) 
		{
			$id_berita=$rows->id_berita;
			$rowstanggal = $rows->tanggal;
			$rowsauthor = $rows->author;
			$rowsid_kategori = $rows->id_kategori;
			$rowsnama_kategori = $rows->nama_kategori;
			$rowsjudul_berita = $rows->judul_berita;
			$rowscounter = $rows->counter;
			$rowsisi = $rows->isi;
			$rowsgambar = $rows->gambar;
		}
		?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header"><h2><?php echo $rows->judul_berita;?></h2></div>
		<div class="card-body">
			<div class="published"><?php echo date_to_long_string($rowstanggal);?></div>
			<div class="author"><a href="#"><?php echo $rowsauthor;?></a></div>
			<div class="category">Kategori Berita <a href="<?php echo base_url();?>situs/katberita/<?php echo $rowsid_kategori;?>"><?php echo $rowsnama_kategori;?></a></div>
			<div class="category">Tag: <a href="#"><?php echo $rowsjudul_berita;?></a></div>
			<div class="clear"></div>
			<div class="padding10"></div>
			<?php
			echo 'Share this article on : ';?>
			<script language="javascript">
document.write("<a href='https://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='https://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a> | <a href='https://www.reddit.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Reddit</a> | <a href='https://digg.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Digg</a>");
			</script>
			<?php

			$isian=$rowsisi;
			echo '<div class="well">';
			if(!empty($rowsgambar))
			{
			echo '<img src="'.base_url().'images/berita/'.$rowsgambar.'" alt="ikon berita" class="img img-rounded">';
			}
			echo $isian;
			echo"</div><p>Share this article on : ";
			?>
			<script language="javascript">
				document.write("<a href='https://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='https://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a> | <a href='https://www.reddit.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Reddit</a> | <a href='https://digg.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Digg</a>");
			</script></p>
			<?php
			//Menampilkan 5 Berita Acak
			echo"<p>Berita ini dibaca sebanyak<b> ".$rowscounter." kali</b></p><p><img src='".base_url()."images/icon-berita.png' alt=''>Baca Juga Berita Lainnya</p>";
			echo"<ul>";
				foreach($acak_berita->result_array() as $acak)
				{
					echo "<li><a href='".base_url()."index.php/situs/detailberita/".$acak['id_berita']."'>".$acak['judul_berita']."</a></li>";
				}
			echo"</ul>";
			?>
		       <h3>Pengguna Facebook</h3>
		       <div class="well">
			<div class="fb-comments" data-href="<?php echo base_url();?>detailberita/<?php echo $id_berita;?>" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
			</div>

		<!-- END CONTENT SIDE -->
		</div>
	</div>
</div>
		<?php
?>

<!-- END CONTENT -->
 
