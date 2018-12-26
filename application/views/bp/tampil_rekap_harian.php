<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 14:01:10 WIB 
// Nama Berkas 		: tampil_rekap_harian.php
// Lokasi      		: application/views/bp/
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
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h4><?php echo 'Data Ketidakhadiran siswa tanggal <strong>'.date_to_long_string($tanggalabsen).'</strong>';?></h4></div>
	<div class="card-body">

<?php
$thnajaran = cari_thnajaran();
$semester=cari_semester();
$adata = count($query->result());
if($adata >0)
{

echo '<table class="table table-hover table-striped table-bordered">
<tr align="center"><td>No</td><td>NIS</td><td>Nama</td><td>Kelas</td><td>Alasan</td><td>Kode Guru</td></tr>';
$nomor=1;
foreach($query->result() as $t)
{
	$nis = $t->nis;
	$nama = nis_ke_nama($nis);
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
echo "<tr><td align='center'>".$nomor."</td><td align='center'>".$t->nis."</td><td>".$nama."</td><td align='center'>".$kelas."</td><td align='center'>".$t->alasan."</td><td align='center'>".$t->kode_guru."</td></tr>";
$nomor++;	
}
echo '</table>';
}
else
{
echo '<div class="alert alert-warning"><strong>Tidak ada data tanggal ini '.date_to_long_string($tanggalabsen).' atau semua siswa masuk</div>';
}
?>
<p class="text-center"><a href="<?php echo base_url();?>bp/rekapharian" class="btn btn-info"><strong>Kembali</strong></a></p>
</div></div>
</div>
