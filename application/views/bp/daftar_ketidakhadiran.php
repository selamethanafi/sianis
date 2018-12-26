<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: daftar_ketidakhadiran.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 10:13:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
if(count($query->result())>0)
{
echo '
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td>No</td><td>NIS</td><td>Nama</td><td>Kelas</td><td>Tanggal Tidak Hadir</td><td>Alasan</td><td>Kode Guru</td></tr>';
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
	$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
	foreach($tdatsis->result_array() as $ddatsis)
		{
		$nama = $ddatsis['nama'];
		$kelas = $ddatsis['kdkls'];
		}
	$str = $t->tanggal;	
	$tanggalabsen = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$t->nis."</td><td>".$nama."</td><td align='center'>".$kelas."</td><td align='center'>".$tanggalabsen."</td><td align='center'>".$alasane."</td><td align='center'>".$t->kode_guru."</td></tr>";
$nomor++;	
}
echo '</table>';
}
else
{
echo '<strong>Tidak ada data </strong>';
}
if (!empty($paginator))
	{
	?>
	<?php echo $paginator;?>
	<?php }?>
</div>
