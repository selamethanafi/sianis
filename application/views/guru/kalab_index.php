<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kalab_index.php
// Lokasi      : application/views/guru
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
if(empty($tugase))
	{
	$tugase = 'kalab';
	$namatugas = 'Kepala Laboratorium';
	}
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo 'Perangkat '.$namatugas;?></h3></div>
<div class="card-body">
<?php
$nomor=1;
if(count($query->result())>0)
{
	echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Jabatan</strong></td><td><strong>Program Kerja</strong></td><td><strong>Buku Agenda Harian</strong></td><td><strong>Pelaksanaan Kegiatan</strong></td><td><strong>Laporan Pelaksanaan Kegiatan</strong></td><td><strong>Analisis Pelaksanaan Kegiatan</strong></td><td><strong>Tindak Lanjut Pelaksanaan Kegiatan</strong></td></tr>';

	foreach($query->result() as $t)
	{
	if ($t->semester=='1')
		{
		$semestere = 'Gasal';
		}
		else
		{
		$semestere = 'Genap';
		}


	echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td>".$t->semester."</td><td>".$t->nama_tugas."</td><td align=center><a href='".base_url()."".$tugase."/proker/".$t->id_tambahan."' title='Menyunting Program Kerja Semester ".$t->semester." Tahun ".$t->thnajaran."'><span class=\"fa fa-edit\"></span></a></td><td align=center><a href='".base_url()."".$tugase."/harian/".$t->id_tambahan."' title='Menyunting Agenda Harian Semester ".$t->semester." Tahun ".$t->thnajaran."'><span class=\"fa fa-edit\"></span></a></td><td align=center><a href='".base_url()."".$tugase."/bpk/".$t->id_tambahan."' title='Menyunting Buku Pelaksanaan Kegiatan Semester ".$t->semester." Tahun ".$t->thnajaran."'><span class=\"fa fa-edit\"></span></a></td><td align=center><a href='".base_url()."".$tugase."/blpk/".$t->id_tambahan."' title='Menyunting Buku Laporan Pelaksanaan Kegiatan Semester ".$t->semester." Tahun ".$t->thnajaran."'><span class=\"fa fa-edit\"></span></a></td><td align=center><a href='".base_url()."".$tugase."/bapk/".$t->id_tambahan."' title='Menyunting Buku Analisis Pelaksanaan Kegiatan Semester ".$t->semester." Tahun ".$t->thnajaran."'><span class=\"fa fa-edit\"></span></a></td><td align=center><a href='".base_url()."".$tugase."/btlpk/".$t->id_tambahan."' title='Menyunting Buku Tindak Lanjut Pelaksanaan Kegiatan Semester ".$t->semester." Tahun ".$t->thnajaran."'><span class=\"fa fa-edit\"></span></a></td></tr>";
	$nomor++;
	}
echo '</table></div>';
}
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php }?>
</div></div></div>

