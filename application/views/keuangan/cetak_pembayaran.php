<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : cetak_pembayaran.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
?>
<?php
	$jml = 0;
	echo '<h3><p class="text-center"><a href="'.base_url().'keuangan/pembayaran">DAFTAR PENERIMAAN '.$tanggalhariini.'</a></p><h3>';

if(count($queryhariini->result())>0)
{
//><input type="text" size="40" name="ibumertua" readonly="readonly" value="'.$t
	echo '<div class="CSSTableGenerator">
	<table width="100%">
	<tr><td>NIS</td><td>Nama Lengkap</td><td>Pembayaran</td><td>Besar</td><td>Keterangan</td></tr>';

	foreach($queryhariini->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);
	echo '<tr><td>'.$nis.'</td><td>'.$namasiswa.'</td><td>'.$t->macam_pembayaran.'</td><td align="right">'.number_format($t->besar).'</td><td>'.$t->keterangan.'</td></tr>';
	$jml = $jml+ $t->besar;
	}
	echo '</table></div>';
	
}
echo 'Jumlah = '.xduit($jml).', terbilang '.xduitf($jml);
?>
<br><br>
</div></body></html>
