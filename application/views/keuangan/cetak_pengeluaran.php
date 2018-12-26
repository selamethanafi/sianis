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
	echo '<h3><p class="text-center"><a href="'.base_url().'keuangan/pengeluaran">DAFTAR PENGELUARAN '.$tanggalhariini.'</a></p><h3>';

if(count($queryhariini->result())>0)
{
//><input type="text" size="40" name="ibumertua" readonly="readonly" value="'.$t
	echo '<div class="CSSTableGenerator">
	<table width="100%">
	<tr align="center"><td>Nomor</td><td>Jenis Pengeluaran</td><td>Sumber</td><td>Keperluan</td><td>Penerima</td><td>Besar</td></tr>';
	$nomor = 1;
	foreach($queryhariini->result() as $t)
	{
	echo '<tr><td>'.$nomor.'</td><td>'.$t->jenis.'</td><td>'.$t->sumber.'</td><td>'.$t->keterangan.'</td><td>'.$t->penerima.'<td align="right">'.number_format($t->besar).'</td></tr>';
	$jml = $jml+ $t->besar;
	}
	echo '</table></div>';
	
}
echo 'Jumlah = '.xduit($jml).', terbilang '.xduitf($jml);
?>
<br><br>
</div></body></html>
