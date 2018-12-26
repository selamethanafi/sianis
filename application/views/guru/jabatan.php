<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : jabatan.php
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
<p><a href="<?php echo base_url(); ?>guru/jabatan/tambah" class="btn btn-info"><b>Tambah Data Jabatan</b></a></p>
<table class="table table-striped table-hover table-bordered">
<?php
echo '<tr align="center"><TD>NO</TD>
<td>JABATAN / PEKERJAAN</td><td>MULAI DAN SAMPAI</td><td>GOLONGAN RUANG PENGGAJIAN</td><td>GAJI POKOK</td>
<td>PEJABAT</td><td>NOMOR</td><td>TANGGAL</td><td width="50" colspan="2">Aksi</td></tr>';
if(count($queryjabatan->result())>0)
{
	$urut=1;
	foreach($queryjabatan->result() as $t)
	{
	$tanggal_awal = tanggal($t->tgl_awal);
	$duit = $t->gaji_pokok;
	$tanggal_akhir = tanggal($t->tgl_akhir);
	$tanggal_sk = tanggal($t->tanggal_sk);
	echo '<tr><td align="center">'.$urut.'</td><td>'.$t->nama_jabatan.'</td><td>'.$tanggal_awal.' s.d. '.$tanggal_akhir.'</td><td>'.substr($t->golongan,2,10).'</td><td>'.$duit.'</td><td>'.$t->pejabat.'</td><td>'.$t->nomor.'</td><td>'.$tanggal_sk.'</td>';	echo "<td><a href='".base_url()."guru/jabatan/ubah/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td><td><a href='".base_url()."guru/jabatan/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td>
</tr>";
	$urut=$urut+1;				} 
}
echo '</table>';
?>

</div></div></div>
