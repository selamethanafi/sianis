<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp_tugas.php
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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
echo '<p><a href="'.base_url().'sieka/tahunan" class="btn btn-info"><b> Kembali</b></a></p>';
$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `id_skp_skor_guru` ='$id' and `nip`='$nip'");
$adatb = $tb->num_rows();
if($adatb>0)
{
	echo form_open('sieka/simpantahunanid/'.$id,'class="form-horizontal" role="form"');
	foreach($tb->result() as $b)
	{
		if ((strpos($b->kegiatan, 'Melaksanakan Proses Pembelajaran') !== false) or (strpos($b->kegiatan,'Membimbing siswa dalam kegiatan ekstrakurikuler') !== false))
		{
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static">'.$b->kegiatan.'</p></div></div>';
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kode Klasifikasi Tahunan</label></div><div class="col-sm-9"><input type="text" name="id_tahunan"  value="'.$b->id_tahunan.'" class="form-control"></div></div>';
		echo '<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
		echo '</form>';
		}
		else
		{
			echo '<div class="alert alert-info">Sementara baru unsur PKG</div>';
		}
	}
}
else
{
		echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
}
?>

</div></div></div>

