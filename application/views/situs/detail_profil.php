<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 15 Jan 2016  WIB 
// Nama Berkas 		: detail_profil.php
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
foreach($detail->result() as $d) 
{
	$d_id_berita=$d->id_berita;
	$d_tanggal = $d->tanggal;
	$d_author = 'Admin';
	$d_id_kategori = $d->id_kategori;
	$d_nama_kategori = $d->nama_kategori;
	$d_judul_berita = $d->judul_berita;
	$d_counter = $d->counter;
	$d_isi = $d->isi;
	$d_gambar = $d->gambar;
}
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $d_judul_berita;?></h3></div>
<div class="card-body">
<div class="published active_here">Tanggal : <?php echo date_to_long_string($d_tanggal);?></div>
<div class="author">Penulis : <a href="#"><?php echo $d_author;?></a></div>
<div class="category">Kategori Profil : <a href="<?php echo base_url();?>situs/katprofil/<?php echo $d_id_kategori;?>"><?php echo $d_nama_kategori;?></a></div>
<div class="category">Tag: <a href="#"><?php echo $d_judul_berita;?></a></div>
<div class="clear"></div>
<?php
echo 'Share this article on : ';?>
<script language="javascript">
document.write("<a href='https://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='https://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a> | <a href='https://www.reddit.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Reddit</a> | <a href='https://digg.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Digg</a>");
</script>
<?php
$isian=$d_isi;
echo '<div class="well">';
echo '<img src="'.base_url().'images/profil/'.$d_gambar.'" alt="ikon profil" class="img img-rounded">';
echo $isian;
echo '</div>';
echo"<p>Share this article on : ";
?>
<script language="javascript">
		document.write("<a href='https://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='https://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a> | <a href='https://www.reddit.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Reddit</a> | <a href='https://digg.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Digg</a>");
</script></p>
<?php
//Menampilkan 5 Berita Acak
echo"<p>Profil ini dibaca sebanyak<b> ".$d_counter." kali</b></p><p><img src='".base_url()."images/icon-berita.png' alt=''>Baca Juga Berita Lainnya</p>";
					echo"<ul>";
					foreach($acak_profil->result_array() as $acak)
					{
						echo "<li><a href='".base_url()."index.php/situs/detailprofil/".$acak['id_berita']."'>".$acak['judul_berita']."</a></li>";
					}
					echo"</ul>";

				?>
       <h3>Pengguna Facebook</h3>
       <div class="well">
		<div class="fb-comments" data-href="<?php echo base_url();?>detailprofil/<?php echo $d_id_berita;?>" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
	</div>

</div></div></div>
<!-- END CONTENT -->
 
