<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 30 Des 2015 14:56:38 WIB 
// Nama Berkas 		: hasil_polling.php
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
<div class="card-header"><h2>Hasil Polling Sementara</h2></div>
<div class="card-body">

Terimakasih atas partisipasi Anda untuk mengikuti polling kami bulan ini. Tunggu polling-polling selanjutnya di website <?php echo $this->config->item('nama_web');?>.</p>
<?php
foreach($soal_polling->result_array() as $tmpl_soal){
echo "<h2>".$tmpl_soal['soal_poll']."</h2>";
}
$jum = 0;
foreach($jawaban_polling->result_array() as $tmpl_jwb){
$jum += $tmpl_jwb['counter'];
}
echo '<table style="border: 1pt ridge #DDDDDD;" bgcolor="#EEFAFF" width="100%" class="widget">';
foreach($jawaban_polling->result_array() as $tmpl_jwb){
if ($jum >0)
{
$pr = sprintf("%2.1f",(($tmpl_jwb['counter']/$jum)*100));
}
else
{$pr = 0;}
$gbr = $pr * 1;
echo "<tr><td width='100'>&#8226; <b>".$tmpl_jwb['jawaban']."</b></td><td width='300'><img src='".base_url()."images/vote.jpg' width='".$gbr."' height='20'></td><td width='70'>".$pr." %<br></td></tr>";
}
echo '</table>';
echo "Hasil berdasarkan dari ".$jum." orang responden.";
?>
</div></div></div>
