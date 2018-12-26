<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kepegawaian.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/kepegawaian/tambah" class="btn btn-info"><b>Tambah Data Kepegawaian</b></a></p>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<?php
echo '<tr align="center">
<td>No</td>
<td>SK</td>
<td>Penjabat / Instansi</td>
<td>Tanggal</td>
<td>Nomor Surat</td>
<td>Uraian/ Angka Kredit</td>
<td>Pangkat / Gol/ruang / Jabatan</td>
<td>Gaji Pokok</td>
<td>TMT</td>
<td>Masa Kerja</td>
<td>Berkas SK</td>
<td colspan="2">Aksi</td>
</tr>';

if(count($query->result())>0)
{
	$urut=1;
	foreach($query->result() as $t)
	{
	$duit = $t->gapok;
	echo '<tr><td>'.$urut.'</td><td>'.$t->jenis_sk.'</td><td>'.$t->pejabat.' / '.$t->instansi.'</td><td>';echo $t->tanggal;echo '</td><td>'.$t->nomorsurat.'</td><td>'.$t->uraian.' / '.$t->pak.'</td><td>'.$t->pangkat.' / '.substr($t->gol,2,10).' / '.$t->jabatan.'</td><td>'.$duit.'</td><td>'.$t->tmt.'</td><td>'.$t->tahun.' / '.$t->bulan.'</td><td><p class="text-center"><a href="'.base_url().'unggah/unggah/kepegawaian/'.$t->id.'">Unggah</a></p>';
		if(!empty($t->berkas))
		{
			echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas.'"  width="200" class="img-fluid img-thumbnail" alt="berkas tidak ditemukan"></a></p><p class="text-center"><a href="'.base_url().'unggah/hapus/kepegawaian/'.$t->id.'" data-confirm="Hapus berkas pindaian kepegawaian '.$t->uraian.'?" class="btn btn-danger"><span class="fa fa-times"</span></a></p>';
		}
		echo '</td>';
	echo "<td><a href='".base_url()."guru/kepegawaian/ubah/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td><td><a href='".base_url()."guru/kepegawaian/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
	$urut=$urut+1;				} 
	echo '</table></div>';
}
else
{
	echo 'Belum ada data';
	echo '<p class="text-center"><a href="'.base_url().'guru/buatdataumum" title="Sunting data umum">Sunting Data</a></p>';
}
?>
</div></div></div>
