<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rpp.php
// Lokasi      : application/views/guru/
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
<div class="container-fluid"><div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/rpp/tambah" class="btn btn-info"><b>Tambah RPP</b></a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>guru/rpp/salin" class="btn btn-info"><b>Salin RPP </b></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>guru/rpp/unduh" class="btn btn-info"><b>Unduh RPP</b></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>unggah/unggahperangkat" class="btn btn-info"><b>Unggah RPP</b></a></p>
<?php
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>Kode RPP.</strong></td><td><strong>No RPP.</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>Materi</strong></td><td><strong>Ubah</strong></td><td><strong>Hapus</strong></td></tr>
<?php
$nomor=$page+1;
if(count($ta->result())>0){
foreach($ta->result() as $a)
{
echo "<tr valign=\"top\">
	<td align='center'>".$a->id_guru_rpp_induk."</td>
	<td align='center'>".$a->no_rpp."</td>
	<td>".$a->kelas."</td>
	<td>".$a->mapel."</td>
	<td>".tanpa_paragraf($a->materi_pembelajaran)."</td>
	<td align=\"center\"><a href='".base_url()."guru/rpp/ubah/".$a->id_guru_rpp_induk."' title='Sunting RPP Induk'><span class=\"fa fa-edit\"></span></a></td>
<td align=\"center\"><a href='".base_url()."guru/rpp/hapus/".$a->id_guru_rpp_induk."' onClick=\"return confirm('Anda yakin ingin menghapus RPP ini?')\" title='Hapus Tutorial'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Anda belum pernah menulis RPP</td></tr>";
}
?>
</table></div>
<?php
if (!empty($paginator))
	{
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div></div>
</div>
