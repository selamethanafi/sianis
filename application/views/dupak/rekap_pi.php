<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bg_atas_cetak.php
// Lokasi      		: application/views/shared/
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>
<div class="landscape">
<br />
<p class="text-center">REKAPITULASI KEGIATAN PUBLIKASI ILMIAH</p>
<table class="table table-striped table-bordered">
<tr align="center"><td>NO</td><td>NAMA KEGIATAN</td><td>MATERI PD/KOMPETENSI</td><td>PERAN GURU</td><td>WAKTU/JAM</td><td>NAMA FASILITATOR</td><td>TEMPAT KEGIATAN</td><td>INSTITUSI PENYELENGGARA</td></tr>
<?php

$golongann = Pangkat_Sesudah($golongan);
$ta = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `golongan`='$golongann'");
if($ta->num_rows() == 0)
{
	echo '<tr><td colspan="8">TIDAK ADA DATA PUBPLIKASI ILMIAH</td></tr>';
}
else
{
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$kode = $a->kode;
		$tipepd = $this->dupak->Tipe_Pd($kode);
		$tf = $this->db->query("SELECT * FROM `dupak_dupak` where `username`='$nim' and `kode`='$kode'");
		if($tipepd == 'pi')
		{
			if($tf->num_rows()>0)
			{
				echo '<tr><td align="center">'.$nomor.'</td><td>'.$a->nama_kegiatan.'</td><td>'.$a->materi.'</td><td>'.$a->peran.'</td><td>'.$a->jam.'<td>'.$a->fasilitator.'</td><td>'.$a->tempat.'</td><td>'.$a->penyelenggara.'</td></tr>';
				$nomor++;
			}
			else
			{
				$id_dupak_pd = $a->id_dupak_pd;
				$this->db->query("delete from `dupak_pd` where `id_dupak_pd` = '$id_dupak_pd'");
				echo '<tr><td align="center"></td><td>'.$kode.' '.$a->nama_kegiatan.'</td><td>'.$a->materi.'</td><td>'.$a->peran.'</td><td>'.$a->jam.'<td>'.$a->fasilitator.'</td><td>'.$a->tempat.'</td><td>'.$a->penyelenggara.'</td></tr>';
			}
		}
	}
}
?>


</table>
<?php
$datamasa = $this->dupak->datamasa($nim,$golongann);
		echo '<table width="100%">
		<tr><td width="10%"></td><td></td><td  width="40%">'.$lokasi.', '.date_to_long_string($datamasa['akhir_penilaian']).'</td></tr>
		<tr><td></td><td></td><td><br /><br /><br />'.$dataguru['nama'].'<br />NIP '.$dataguru['nip'].'</td></tr>
		</table>';
?>
</div>
</body>
</html>
