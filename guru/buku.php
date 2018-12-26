<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: buku.php
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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/buku/tambah" class="btn btn-info">Tambah Buku</a></p>
<?php
$ta = $this->db->query("select * from `guru_buku_pegangan` where `kodeguru`='$kodeguru'");
?>
<?php
$nomor=1;
if(count($ta->result())>0)
{
	?>
	<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Kelas</strong></td><td><strong>Judul, Pengarang, dan Penerbit</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
	<?php
	foreach($ta->result() as $a)
	{
		$judul = '';
		if (!empty($a->judul))
		{
		$judul .= $a->judul;
		}
		if (!empty($a->pengarang))
		{
		$judul .= ", <strong>".$a->pengarang."</strong>";
		}
		if (!empty($a->penerbit))
		{
		$judul .= ", ".$a->penerbit;
		}
		if ($a->keterangan == '1')
		{
		$keterangan = 'Utama';
		}
		else
		{
		$keterangan = 'Pendukung';
		}
		echo "<tr><td align='center'>".$nomor."</td><td>".$a->mapel."</td><td>".$a->tingkat."</td><td>".$judul."</td><td>".$keterangan."</td><td>
<a href='".base_url()."guru/buku/ubah/".$a->id_guru_buku_pegangan."' title='Sunting buku pegangan '><span class=\"fa fa-edit\"></span></a></td>
<td><a href='".base_url()."guru/buku/hapus/".$a->id_guru_buku_pegangan."' onClick=\"return confirm('Anda yakin ingin menghapus buku ini?')\" title='Hapus Tutorial'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;	
	}
	echo '</table></div>';
}
else
{
echo '<div class="alert alert-warning">Anda belum pernah menulis daftar buku pegangan</div>';
}
?>
</div></div></div>
