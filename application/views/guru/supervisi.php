<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 12 Mei 2016 12:28:14 WIB 
// Nama Berkas 		: nilai.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">	<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$query = $this->db->query("SELECT * FROM `guru_data_supervisi` where `username`='$nim' order by `thnajaran` DESC, `semester` DESC");
$nomor=1;
if(count($query->result())>0)
{
	echo '<div class= "table-responsive"><table class="table table-hover table-bordered"><thead>
		<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Supervisor</strong></td><td colspan="4"><strong>Perangkat</strong></td><td colspan="4"><strong>Mengajar</strong></tr></thead><tbody>';	
	foreach($query->result() as $t)
	{
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$t->thnajaran.'</td><td align="center">'.$t->semester.'</td><td align="center">'.$t->supervisor.'</td>
	<td align="center"><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'" class="btn btn-success" title="ubah data supervisi oleh '.$t->supervisor.' tahun '.$t->thnajaran.' semester '.$t->semester.'">Data</a></td>
	<td><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'/cetak1" class="btn btn-success">Blanko</a></td>
	<td><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'/nilai1" class="btn btn-danger" title="ubah nilai supervisi perangkat oleh '.$t->supervisor.' tahun '.$t->thnajaran.' semester '.$t->semester.'">Nilai</a></td>
<td><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'/hasil1" class="btn btn-success">Hasil</a></td>
	<td align="center"><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'" class="btn btn-warning" title="ubah data supervisi oleh '.$t->supervisor.' tahun '.$t->thnajaran.' semester '.$t->semester.'">Data</a></td>
	<td><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'/cetak" class="btn btn-warning" title="cetak blanko supervisi mengajar oleh '.$t->supervisor.' tahun '.$t->thnajaran.' semester '.$t->semester.'">Blanko</a></td>
	<td><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'/nilai" class="btn btn-danger" title="ubah nilai supervisi mengajar oleh '.$t->supervisor.' tahun '.$t->thnajaran.' semester '.$t->semester.'">Nilai</a></td>
	<td><a href="'.base_url().'perangkat/supervisiguru/'.$t->thnajaran.'/'.$t->semester.'/'.$t->supervisor.'/hasil" class="btn btn-warning" title="cetak hasil supervisi mengajar oleh '.$t->supervisor.' tahun '.$t->thnajaran.' semester '.$t->semester.'">Hasil</a></td>';
		echo "</tr>";
	$nomor++;	
	}
	echo '</tbody></table></div>';
}
else
{
	echo '<div class="alert alert-info"><h4>Belum ada data</h4>Silakan membuka halaman pembagian tugas, buat pembagian tugas. Kalau sudah, kembali ke halaman ini</di>';
}
?>
</div></div></div>

