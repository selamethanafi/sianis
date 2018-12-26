<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: menilai_pkg.php
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
<div class="card-header"><h3><?php echo $judulhalaman.' '.$tahunpenilaian;?></h3></div>
<div class="card-body">
<?php
$ta = $this->db->query("SELECT * FROM `pkg_tim_penilai` where `kode_penilai` = '$nim' and `tahun` = '$tahunpenilaian'");
if($ta->num_rows()>0)
{
	$nomor = 1;
	echo '<div class="alert alert-info">Untuk menilai, silakan klik nama guru</div>';
	echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>Nama Guru</td></tr>';
	foreach($ta->result() as $a)
	{
		$kode_ternilai = $a->kode_ternilai;
		$nama_guru = cari_nama_pegawai($kode_ternilai);
		echo '<tr><td>'.$nomor.'</td><td><a href="'.base_url().'pkg/menilai/'.$kode_ternilai.'">'.$nama_guru.'</a></td></tr>';
		$nomor++;
	}
	echo '</table>';
}
else
{
	echo 'Belum ada data atau bukan anggota tim penilai PKG';
}
?>
</div></div></div>
