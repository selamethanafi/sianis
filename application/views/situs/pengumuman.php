<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 13:57:52 WIB 
// Nama Berkas 		: pengumuman.php
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
<img src="<?php echo base_url();?>images/icon-pengumuman.jpg" alt="" class="alignleft"><h1 class="regular brown bottom_line">Pengumuman Terbaru</h1><br />
<?php
foreach($query->result() as $pengumuman)
{
echo '<h4 class="regular brown bottom_line">'.$pengumuman->judul_pengumuman.'</h4>';
echo '<h6>Diposting pada tanggal : '.date_to_long_string($pengumuman->tanggal).' - oleh <b>'.$pengumuman->nama.'</b></h6>';
echo $pengumuman->isi.'<br />';
}

if(!empty($paginator))
{
?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div>

