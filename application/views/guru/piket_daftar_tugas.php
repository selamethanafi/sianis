<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : piket_daftar_tugas.php
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
<p><a href="<?php echo base_url();?>piket/tambahtugas" class="btn btn-primary">Tambah Daftar Tugas</a></p>
<?php
$nomor=$page+1;
if(count($query->result())>0)
{
	?>
	<div class="table-responsive">
	<table class="table table-stripep table-hover table-bordered">
	<tr><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Tanggal</strong></td><td><strong>Jam ke-</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>Guru</strong></td><td><strong>Tugas</strong></td><td><strong>Aksi</strong></td></tr>
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
		echo '<tr><td>'.$nomor.'</td><td>'.$t->thnajaran.'</td><td>'.$t->semester.'</td><td>'.date_to_long_string($t->tanggal).'</td><td>'.$t->jamke.'</td><td>'.$t->kelas.'</td><td>'.$t->mapel.'</td><td>'.cari_nama_pegawai($t->kodeguru).'</td><td>'.$t->tugas.'</td><td><a href="'.base_url().'piket/tambahtugas/'.$t->id_guru_tugas.'"><span class="fa fa-edit"></span></a></td></tr>';
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
