<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: nilai_ujian_nasional.php
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
<tr align="center"><td><strong>No.</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Nilai Ujian Nasional</strong></td><td><strong>Nilai Sekolah</strong></td><td><strong>Nilai Akhir</td></tr>
<?php
$query = $this->db->query("select * from nilai_un where nis='$nim' order by no_urut ASC");
$nomor=1;
if(count($query->result())>0)
{
		$jun = 0;
		$jns = 0;
		$jna = 0;
	foreach($query->result() as $t)
	{

		$jun = $jun + $t->un;
		$jns = $jns + $t->ns;
		$jna = $jna + $t->na;
		echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td><td align='center'>".$t->un."</td><td align='center'>".$t->ns."</td><td align='center'>".$t->na."</td></tr>";
		$nomor++;
	}	
		echo "<tr><td align='center'></td><td>Jumlah</td><td align='center'>".$jun."</td><td align='center'>".$jns."</td><td align='center'>".$jna."</td></tr>";
		$rata = $jna / 6;
		$rata = round($rata,1);
		echo "<tr><td align='center'></td><td>Rata - rata nilai akhir</td><td align='center'></td><td align='center'></td><td align='center'>".$rata."</td></tr>";


}
else{
echo "<tr><td colspan='5'>Belum Ada Nilai</td></tr>";
}
?>
</table></div>
</div></div></div>
