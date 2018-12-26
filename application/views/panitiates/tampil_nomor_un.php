<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: impor_siswa.php
// Lokasi      		: application/views/panitiates/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$ta = $this->db->query("select * from `siswa_nomor_tes_un` where `thnajaran` = '$thnajaran'");
echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td>Nomor</td><td>Nomor UN</td><td>Nama Siswa</td></tr>';
$nomor = 1;
foreach($ta->result() as $a)
{
	$nis = $a->nis;
	$namasiswa = nis_ke_nama($nis);
	echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$a->no_peserta.'</td><td>'.$namasiswa.'</td></tr>';
	$nomor++;
}
echo '</table>';
?>
</div></div></div>
