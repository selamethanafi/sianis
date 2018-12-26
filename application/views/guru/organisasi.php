<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : organisasi.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/organisasi/tambah" class="btn btn-info"><b>Tambah Data Organisasi</b></a></p>
<?php
if(count($queryorganisasi->result())>0)
{
	echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
	<tr align="center">
<td>No</td><td>NAMA ORGANISASI</td><td>KEDUDUKAN DALAM ORGANISASI</td><td>DALAM TAHUN S.D. TAHUN</td><td>TEMPAT</td><td>NAMA PIMPINAN ORGANISASI</td><td width="50" colspan="2">Aksi</td></tr>';

	$urut=1;
	foreach($queryorganisasi->result() as $t)
	{
	echo '<tr><td>'.$urut.'</td><td>'.$t->nama_organisasi.'</td><td>'.$t->kedudukan.'</td>';
	echo '<td>'.$t->tahun_awal.' s.d. '.$t->tahun_akhir.'</td><td>'.$t->tempat.'</td><td>'.$t->nama_pimpinan.'</td>';		

	echo "<td><a href='".base_url()."guru/organisasi/ubah/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td>
<td><a href='".base_url()."guru/organisasi/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";		
	$urut++;
	} 
	echo '</table></div>';
}
else
{
	echo '<div class="alert alert-warning">Belum ada data</div>';
}
?>

</div></div></div>
