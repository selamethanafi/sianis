<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: nilai_akhlak.php
// Lokasi      		: application/views/siswa/
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
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Tahun</strong></td><td><strong>Semester</strong><td><strong>Kedisiplinan</td></strong>
<td><strong>Kebersihan</td></strong>
<td><strong>Kesehatan</td></strong>
<td><strong>Tanggung jawab</td></strong>
<td><strong>Sopan santun</td></strong>
<td><strong>Percaya diri</td></strong>
<td><strong>Kompetitif</td></strong>
<td><strong>Hubungan Sosial</td></strong>
<td><strong>Kejujuran</td></strong>
<td><strong>Ibadah ritual</td></strong>
</tr>
<?php
$nomor=1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
echo "<tr><td>".$t->thnajaran."</td><td>".$t->semester."</td><td>".$t->satu."</td><td>".$t->dua."</td><td>".$t->tiga."</td><td>".$t->empat."</td><td>".$t->lima."</td><td>".$t->enam."</td><td>".$t->tujuh."</td><td>".$t->delapan."</td><td>".$t->sembilan."</td><td>".$t->sepuluh."</td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Belum Ada Nilai</td></tr>";
}
?>
</table>
</div></div></div>
