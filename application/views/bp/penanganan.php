<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:51:29 WIB 
// Nama Berkas 		: penanganan.php
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
<?php
echo '<p><a href="'.base_url().'bp/penanganan" class="btn btn-info">Siswa Lainnya</a></p>';
	?>
	<div class="card">
	<div class="card-header"><h3><?php echo nis_ke_nama($nis);?></h3></div>
	<div class="card-body">
	<?php
	$tb = $this->db->query("select * from `pemberitahuan` where `nis`='$nis'");
	if(count($tb->result())>0)
		{
		
		echo '<div class="table-responsive">
<table class="table table-hover table-bordered"><tr align="center"><td><strong>Tahun Ajaran</strong></td><td><strong>Pemberitahuan Ke-</strong></td><td><strong>Penanganan Walikelas</strong></td><td><strong>Penanganan BP</strong></td><td><strong>Penanganan Kesiswaan</strong</td><td><strong>Aksi</strong</td></tr>';
		$nomor = 1;
		foreach ($tb->result() as $b)
			{
				echo "<tr align=\"center\"><td>".$b->thnajaran."</td><td>".$b->ke."</td><td align=\"left\">".$b->tindakan_walikelas."</td><td align=\"left\">".$b->tindakan_bp."</td><td align=\"left\">".$b->tindakan_kesiswaan."</td><td><a href='".base_url()."bp/ubahpenanganan/".$b->id."' title='Ubah Data Penanganan Siswa'><span class=\"fa fa-edit\"></span></a></td></tr>";
			}
		echo '</table></div>';
		}
	else
	{
	echo '<div class="alert alert-info">Angka kredit siswa ini belum memenuhi batas penanganan atau tidak ada data pelanggaran</div>';
	}
	echo '</div></div>';
?>

</div>
