<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 14:26:38 WIB 
// Nama Berkas 		: hasil_pencarian.php
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
echo '<img src="'.base_url().'images/hasil-cari.png" class="alignleft"><h1>Hasil Pencarian</h1><br />';
if($kata==null)
{
echo "Kolom keyword masih kosong!!!!!";
}
elseif ($jumlah==0)
	{
	echo "Pencarian dengan keyword <b>".$kata."</b>, tidak ditemukan!!!!</b>";
	}
else{
echo "Ditemukan <b>".$jumlah."</b> hasil pencarian dengan keyword <b>".$kata."</b><br><br>";
foreach($hasil->result_array() as $cari)
{
	if($pilihan=='tblberita'){
	$isi_berita = strip_tags(substr($cari['isi'],0,300));
	echo"<table class='widget' style='border: 1pt ridge #DDDDDD;' bgcolor='#EEFAFF' ><tr><td><h2><a href='".base_url()."index.php/situs/detailberita/".$cari['id_berita']."'>".$cari['judul_berita']."</a></h2>
<span>".$cari['tanggal']." -|- ".$cari['waktu']." WIB</span><p>
<span class=image><img src='".base_url()."images/berita/".$cari['gambar']."' width=40 border=0></span>".$isi_berita." <b>
.... <a href='".base_url()."index.php/situs/detailberita/".$cari['id_berita']."'>[Baca Selengkapnya]</a></b></td></tr></table><br>";
	}
	else if($pilihan=='tblprofil'){
	$isi_berita = strip_tags(substr($cari['isi'],0,300));
	echo"<table class='widget' style='border: 1pt ridge #DDDDDD;' bgcolor='#EEFAFF' ><tr><td><h2><a href='".base_url()."index.php/situs/detailprofil/".$cari['id_berita']."'>".$cari['judul_berita']."</a></h2>
<span>".$cari['tanggal']." -|- ".$cari['waktu']." WIB</span><p>
<span class=image><img src='".base_url()."images/profil/".$cari['gambar']."' width=40 border=0></span>".$isi_berita." <b>
.... <a href='".base_url()."index.php/situs/detailprofil/".$cari['id_berita']."'>[Baca Selengkapnya]</a></b></td></tr></table><br>";
	}

	else if($pilihan=='tblpengumuman'){
$isi=strip_tags(substr($cari['isi'],0,50));
$ptng_isi=nl2br($isi);
echo"<table style='border: 1pt ridge #DDDDDD;' bgcolor='#EEFAFF' class='widget' width='470' height='60'>
<tr><td><img src='".base_url()."tema/images/pict-pengumuman.jpg' class=image><h2>".$cari['judul_pengumuman']."</h2><span class='tanggalberita'><h3>Diposting pada tanggal ".$cari['tanggal']." - oleh <b>".$cari['penulis']."</b></h3></span>".$ptng_isi.".... <a href=".base_url()."index.php/situs/detailpengumuman/".$cari['id_pengumuman']." onclick=\"return hs.htmlExpand(this, { objectType: 'iframe' } )\"><b>[ Lihat ]</b></a></td></tr>
</table><table><tr><td height='2'></td></tr></table>";
	}
	else if($pilihan=='tblagenda'){
		$deskripsi = strip_tags(substr($cari['isi'],0,80));
		echo "<a href=".base_url()."index.php/situs/detailagenda/".$cari['id_agenda']." onclick=\"return hs.htmlExpand(this, { objectType: 'iframe' } )\"><h6>".$cari['tema_agenda']."</h6></a>";
		echo "<span>".$deskripsi."....</span>";
		echo "<hr>";
	}
	else{
$isi_tutorial = strip_tags(substr($cari['isi'],0,300));
echo"<table class='widget' style='border: 1pt ridge #DDDDDD;' bgcolor='#EEFAFF' ><tr><td><h2><a href='".base_url()."index.php/situs/detailmateri/".$cari['id_tutorial']."'>".$cari['judul_tutorial']."</a></h2>
<span>".$cari['tanggal']." -|- ".$cari['waktu']." WIB</span><p>
<span class=image><img src='".base_url()."images/tutorial/".$cari['gambar']."' width=75 border=0></span>".$isi_tutorial." <b>
.... <a href='".base_url()."index.php/situs/detailmateri/".$cari['id_tutorial']."'>[Baca Selengkapnya]</a></b></td></tr></table><br>";
	}
}

}
?>
</div>
