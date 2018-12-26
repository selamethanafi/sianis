<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : piket.php
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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url();?>piket/ubahpiket/<?php echo $id_piket;?>" class="btn btn-info">Mengisi Jurnal Hari Ini</a></p>
<?php
$nomor=$page+1;
if(count($query->result())>0)
{
	?>
	<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered">
	<tr><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Tanggal</strong></td><td><strong>Kejadian / Catatan</strong></td><td><strong>Lihat / Ubah</strong></td></tr>
	<?php
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
		$tanggalpiket = tanggal($t->tanggal);
		echo "<tr><td align='center'>".$nomor."</td><td>".$t->thnajaran."</td><td align=\"center\">".$t->semester."</td>
<td>".$tanggalpiket."</td><td>".tanpa_paragraf($t->kejadian)."</td><td><a href='".base_url()."piket/ubahpiket/".$t->id_piket."' ><span class=\"fa fa-edit\"></span></a></td>
</tr>";
		$nomor++;	
	}
	echo '</table></div>';
}
else
{
	echo '<div class="alert alert-warning">Belum ada data </div>';
}
?>
<?php
if (!empty($paginator))
	{
	?>
	<h5><?php echo $paginator;?></h5>
	<?php }?>
</div></div></div>
