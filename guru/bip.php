<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: bip.php
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
<p><a href="<?php echo base_url();?>guru/bip/tambah" class="btn btn-primary"><b>Tambah Informasi</b></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/bip/salin" class="btn btn-info"><b>Salin Informasi</b></a></p>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No</strong></td><td><strong>Hari, Tanggal</strong></td><td><strong>Mapel</strong></td><td><strong>Kelas</strong></td><td><strong>Ulangan / SK / KD / Materi</strong></td><td><strong>Informasi</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
//$ta=$this->db->query("select * from `guru_bip` where kodeguru='$kodeguru' order by tanggal DESC LIMIT 0,15");
$nomor=$page+1;
if(count($ta->result())>0)
{
	foreach($ta->result() as $a)
	{
echo "<tr><td align='center'>".$nomor."</td><td>".tanggal_ke_hari($a->tanggal).", ".date_to_long_string($a->tanggal)."</td><td>".$a->mapel."</td><td>".$a->kelas."</td><td>".$a->jenisulangan."".$a->skkdmateri."</td><td>".tanpa_paragraf($a->isiinformasi)."</td><td>
<a href='".base_url()."guru/bip/ubah/".$a->id_guru_bip."' title='Sunting BIP '><span class=\"fa fa-edit\"></span></a></td>
<td><a href='".base_url()."guru/bip/hapus/".$a->id_guru_bip."' onClick=\"return confirm('Anda yakin ingin menghapus informasi penilaian ini?')\" title='Hapus Tutorial'<span class=\"fa fa-trash-alt\"></span></a></td>
</td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Anda belum pernah menulis BIP</td></tr>";
}
?>
</table>
<?php
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div>
