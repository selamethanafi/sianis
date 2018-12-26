<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: sertifikasi.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/sertifikat/tambah" class="btn btn-info"><b>Tambah Data</b></a></p>
<?php
if(count($query->result())>0)
{
	echo '<div class="table-responsive""><table class="table table-striped table-hover table-bordered"><tr align="center">
	<td>No</td>
	<td>Instansi</td>
	<td>Tanggal</td>
	<td>Nomor Sertifikat / Piagam</td>
	<td>Kegiatan</td>
	<td>Waktu Pelaksanaan</td>
	<td>Tempat</td>
	<td>Jam</td>
	<td>Berkas Sertifikat</td>
	<td colspan="2">Aksi</td>
	</tr>';
	$urut=1;
	foreach($query->result() as $t)
	{
	echo '<tr><td>'.$urut.'</td>
		<td>'.$t->instansi.'</td>
		<td>'.$t->tanggalsertifikat.'</td>
		<td>'.$t->jenis.'<br />'.$t->nomor.'</td>
		<td>'.$t->kegiatan.'</td>
		<td>'.$t->tanggalpelaksanaan.'</td>
		<td>'.$t->tempat.'</td><td>'.$t->jamdiklat.'</td><td><p class="text-center"><a href="'.base_url().'unggah/unggah/sertifikat/'.$t->id.'">Unggah</a></p>';
		if(!empty($t->berkas))
		{
			echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas.'"  width="200" class="img-fluid img-thumbnail" alt="berkas tidak ditemukan"></a></p><p class="text-center"><a href="'.base_url().'unggah/hapus/sertifikat/'.$t->id.'" data-confirm="Hapus berkas pindaian sertifikat '.$t->kegiatan.'?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
		}
		echo '</td>';
	echo "<td><a href='".base_url()."guru/sertifikat/ubah/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td><td><a href='".base_url()."guru/sertifikat/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td>
</td></tr>";
	$urut++;
	} 
	echo '</table></div>';
}
else
{
	echo 'Belum ada data';
}
?>
</div></div></div>
