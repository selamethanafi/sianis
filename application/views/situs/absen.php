<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 14:44:17 WIB 
// Nama Berkas 		: absen.php
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
	<div class="card">
		<div class="card-header">DAFTAR KETIDAKHADIRAN SISWA</div>
		<div class="card-body">
			<?php
			if(count($query->result())>0)
			{
				echo '
				<table class="table table-striped table-hover table-bordered">
				<thead><tr><td>Nama</td><td>Kelas</td><td>Tanggal Tidak Hadir</td><td>Alasan</td></tr></thead>';
				$nomor=1;
				foreach($query->result() as $t)
				{
					if ($t->alasan=='S')
					{
						$alasane = 'Sakit';
					}
					if ($t->alasan=='I')
					{
						$alasane = 'Izin';
					}
					if ($t->alasan=='A')
					{
						$alasane = 'Tanpa Keterangan';
					}
					if ($t->alasan=='T')
					{
						$alasane = 'Terlambat';
					}
					if ($t->alasan=='B')
					{
						$alasane = 'Membolos';
					}
					if ($t->alasan=='M')
					{
						$alasane = 'Meninggalkan Sekolah';
					}
					$nis = $t->nis;
					$semester = $t->semester;
					$thnajaran = $t->thnajaran;
					$namasiswa = nis_ke_nama($nis);
					$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
					$tanggalabsen = date_to_long_string($t->tanggal);
					echo '<tr><td align="left">'.$nis.'</td><td>'.$kelas.'</td><td>'.$tanggalabsen.'</td><td>'.$alasane.'</td></tr>';
					$nomor++;	
				}
				echo '</table>';
			}
			else
			{
				echo 'Tidak ada data';
			}
			?>
			<h5 class="text-center"><?php echo $paginator;?></h5>
		</div>
	</div>
</div>
