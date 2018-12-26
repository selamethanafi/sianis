<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: angka_kredit.php
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
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Semester</strong></td><td><strong>Tanggal</strong></td><td><strong>Pelanggaran</strong></td><td><strong>Keterangan</strong></td><td><strong>Kode Guru</strong></td></tr>
<?php
$nomor=$page+1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
	$kode = $t->kd_pelanggaran;
	$tkred = $this->db->query("select * from m_kredit where kode='$kode'");
	$pelanggaran = '????';
	foreach($tkred->result() as $dkred)
		{
		$pelanggaran = $dkred->nama_pelanggaran;
		}
	$str = $t->tanggal;	
	$tanggalabsen = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	
echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td align=\"center\">".$t->semester."</td>
<td>".$tanggalabsen."</td><td>".$pelanggaran."</td><td align=\"center\">".$t->point."</td><td align=\"center\">".$t->kodeguru."</td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
}
?>
</table></div>
<?php
if(!empty($paginator))
	{
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
	}
?>
</div></div></div>
