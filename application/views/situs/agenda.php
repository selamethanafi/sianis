<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 14:47:26 WIB 
// Nama Berkas 		: agenda.php
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
	<h3>Agenda <?php echo $this->config->item('sek_tipe');?></h3>
			<?php
			foreach($query->result() as $agenda)
			{
				echo '
				<div class="card">
					<div class="card-header">'.$agenda->tema_agenda.'</div>
					<div class="card-body">';
						echo "<h5>Diposting pada tanggal : ".date_to_long_string($agenda->tgl_posting)." - oleh <b>Admin</b></h5></span><br>";
				echo "<b>Deskripsi</b> : ".$agenda->isi."</span><br>";
				echo "<b>Tanggal</b> : ".date_to_long_string($agenda->tgl_mulai)." sampai ".date_to_long_string($agenda->tgl_selesai)."</span><br>";
				echo "<span><b>Tempat</b> : ".$agenda->tempat."</span><br>";
				echo "<span><b>Waktu</b> : ".$agenda->jam."</span><br>";
				echo "<span><b>Keterangan</b> : ".$agenda->keterangan."</span>";
					echo '
					</div>
				</div>
				<hr>';
			}
			if(!empty($paginator))
			{
				?>
				<h5 class="text-center"><?php echo $paginator;?></h5>
				<?php
			}?>
</div>
