<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: ekstra.php
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
<p><a href="<?php echo base_url(); ?>siswa/mendaftarekstra" class="btn btn-info"><b>Mendaftar Ekstrakurikuler</b></a></p>
Bila hendak mengundurkan diri dari ektrakurikuler pilihan, silakan menghubungi pengampu ekstra.
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Semester</strong></td><td><strong>Nama Ekstrakurikuler</strong></td><td><strong>Predikat</strong></td><td><strong>Keterangan</strong></td></tr>
<?php
$nomor=1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td>".$t->semester."</td>
<td>".$t->nama_ekstra."</td><td align=\"center\">".$t->nilai."</td><td align=\"center\">".$t->keterangan."</td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
}
?>
</table></div>
</div></div></div>
