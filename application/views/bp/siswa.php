<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 10:19:00 WIB 
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
<?php echo form_open('bp/carisiswa','class="form-horizontal" role="form"');?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div>
		<div class="col-sm-9"><input type="text" name="nama" class="form-control"></div></div>
<p class="text-center"><input type="submit" value="Cari Siswa" class="btn btn-primary"></p>
</div></div></form>
<table class="table table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS.</strong></td><td><strong>Nama</strong></td><td><strong>Status</strong></td><td><strong>Data Persyaratan BSM/PIP</strong></td><td><strong>Lihat Data Siswa</strong></td><td><strong>Rekapitulasi<br />Ketidakhadiran</strong></td><td><strong>Rekapitulasi<br />Pelanggaran</strong></td><td><strong>Penanganan<br />Pelanggaran</strong></td><td><strong>Konseling Individu</strong></td><td><strong>Mutasi</strong></td><td><strong>Absensi</strong></td></tr>
<?php
$nomor=1;
$ket='';
foreach($query->result() as $b)
{
		if ($b->ket=='Y')
			{
			$ket = 'Aktif';
			}
		if ($b->ket=='T')
			{
			$ket = 'Keluar';
			}
		if ($b->ket=='P')
			{
			$ket = 'Pindah';
			}
		if ($b->ket=='L')
			{
			$ket = 'Lulus';
			}
	echo '<tr><td>'.$nomor.'</td><td>'.$b->nis.'</td><td>'.$b->nama.'</td><td>'.$b->ket.'
 '.$ket.'</td><td align="center"><a href="'.base_url().'bp/datapenerimabsm/'.$b->nis.'" title="Data Persyaratan Penerima BSM"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'bp/detilsiswa/'.$b->nis.'" title="Detil Siswa"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'bp/rekapketidakhadiransiswa/'.$b->nis.'" title="Rekapitulasi Ketidakhadiran Siswa"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'bp/tampilkreditsiswa/'.$b->nis.'" title="Rekapitulasi Kredit Pelanggaran Siswa"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'bp/penanganan/'.$b->nis.'" title="Penanganan Pelanggaran Siswa"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'bp/konseling/'.$b->nis.'" title="Konseling Individu"><span class="fa fa-bullseye"></span></a></td><td align="center"><a href="'.base_url().'bp/mutasisiswa/'.$b->nis.'" title="Detil Siswa"><span class="fa fa-exchange-alt"></span></a></td><td align="center"><a href="'.base_url().'bp/absensi/'.$b->nis.'" title="Detil Siswa"><span class="fa fa-exchange-alt"></span></a></td></tr>';

$nomor++;
}
?>
</table>
</div></div></div>
