<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
?><div class="container-fluid"><h2>Modul ID Kegiatan Bulanan SiEka</h2>
<?php
if(($bulan == 'jan') or ($bulan == 'feb') or ($bulan == 'mar') or ($bulan == 'apr') or ($bulan == 'mei') or ($bulan == 'jun') or ($bulan == 'jul') or ($bulan == 'agu') or ($bulan == 'sep') or ($bulan == 'okt') or ($bulan == 'nov') or ($bulan == 'des'))
{
	if($bulan == 'jan')
	{
		$bulane = 'Januari';
	}
	if($bulan == 'feb')
	{
		$bulane = 'Februari';
	}
	if($bulan == 'mar')
	{
		$bulane = 'Maret';
	}
	if($bulan == 'apr')
	{
		$bulane = 'April';
	}
	if($bulan == 'mei')
	{
		$bulane = 'Mei';
	}
	if($bulan == 'jun')
	{
		$bulane = 'Juni';
	}
	if($bulan == 'jul')
	{
		$bulane = 'Juli';
	}
	if($bulan == 'agu')
	{
		$bulane = 'Agustus';
	}
	if($bulan == 'sep')
	{
		$bulane = 'September';
	}
	if($bulan == 'okt')
	{
		$bulane = 'Oktober';
	}
	if($bulan == 'nov')
	{
		$bulane = 'November';
	}
	if($bulan == 'des')
	{
		$bulane = 'Desember';
	}
	$ta = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahunpenilaian' and `nip`='$nip' and `kegiatan` like '%$bulane%'");
	echo form_open('sieka/simpanbulananid/'.$bulan,'class="form-horizontal" role="form"');
	echo '<table class="table table-striped table-hover table-bordered">
<tr><td align="center">Nomor</td><td>Kegiatan</td><td align="center">ID Bulanan</td></tr>';
$nomor = 1;
foreach($ta->result() as $a)
{
	echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->kegiatan.'</td><td align="center"><input type="text" name="id_bulanan_'.$nomor.'"  value="'.$a->id_bulanan.'" class="form-control"><input type="hidden" name="id_sieka_bulanan_'.$nomor.'"  value="'.$a->id_sieka_bulanan.'" class="form-control"></td></tr>';
	$nomor++;
}
echo '</table>';
		echo '<p class="text-center"><input type="hidden" value="'.$nomor.'" name="cacah"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
}
else
{
	echo 'Galat, bulan tidak dikenal';
}
?>
</div></div></div>
