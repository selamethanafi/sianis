<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pendidikan.php
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
<p><a href="<?php echo base_url(); ?>guru/pendidikan/tambah" class="btn btn-info"><b>Tambah Data Pendidikan</b></a></p>
<table class="table table-bordered table-hover table-striped">
<?php
echo '<tr align="center">
<td width="20">No</td>
<td>Sekolah</td>
<td>Tempat</td>
<td>Tahun Lulus</td>
<td>Tanggal Ijazah</td>
<td>Nomor Ijazah</td><td>Gelar</td>
<td>Kelompok Program Studi</td>
<td>Berkas Ijazah</td>
<td width="50" colspan="2">Aksi</td>
</tr>';

if(count($query->result())>0)
{
	$urut=1;
	foreach($query->result() as $t)
	{
	echo '<tr><td>'.$urut.'</td><td>'.$t->tingkat.'</td><td>'.$t->namasekolah.'</td>
		<td align="center">'.$t->tahunlulus.'</td>
		<td align="center">';echo date_to_long_string($t->tanggalijazah);echo '</td><td align="center">'.$t->nomorijazah.'</td><td align="center">'.$t->gelar.'</td>';

	if($t->kelprodi=='01')
	{
		$prodi = 'Rumpun Pendidikan Agama Islam (PAI)';
	}
	elseif($t->kelprodi=='02')
	{
		$prodi = 'Bahasa Indonesia';
	}
	elseif($t->kelprodi=='03')
	{
		$prodi = 'Bahasa Inggris';
	}
	elseif($t->kelprodi=='04')
	{
		$prodi = 'Bahasa Arab';
	}
	elseif($t->kelprodi=='05')
	{
		$prodi = 'Bahasa Asing Lainnya (Bahasa Jepang, Mandarain, Korea, Jerman, Belanda, Perancis, Rusia, dll)';
	}
	elseif($t->kelprodi=='06')
	{
		$prodi = 'Matematika/Statistika';
	}
	elseif($t->kelprodi=='07')
	{
		$prodi = 'IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)';
	}
	elseif($t->kelprodi=='08')
	{
		$prodi = 'Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)';
	}
	elseif($t->kelprodi=='09')
	{
		$prodi = 'Ilmu Komputer/Informatika/Teknologi Informasi';
	}
	elseif($t->kelprodi=='10')
	{
		$prodi = 'Pendidikan Jasmani, Olahraga dan Kesehatan';
	}
	elseif($t->kelprodi=='11')
	{
		$prodi = 'Manajemen Pendidikan / Ilmu Pendidikan';
	}
	elseif($t->kelprodi=='12')
	{
		$prodi = 'Hukum/Syari\'ah/Hukum Islam';
	}
	elseif($t->kelprodi=='13')
	{
		$prodi = 'PGSD/PGMI ';
	}
	elseif($t->kelprodi=='14')
	{
		$prodi = 'PGTK';
	}
	elseif($t->kelprodi=='15')
	{
		$prodi = 'Psikologi';
	}
	elseif($t->kelprodi=='16')
	{
		$prodi = 'Kesenian';
	}
	elseif($t->kelprodi=='17')
	{
		$prodi = 'Pendidikan Kewarganegaraan';
	}
	elseif($t->kelprodi=='18')
	{
		$prodi = 'Lainnya';
	}
	else
	{
		$prodi = '';
	}

	echo '<td>'.$prodi.'</td>';
		echo '<td><p><a href="'.base_url().'unggah/unggah/pendidikan/'.$t->id.'" class="btn btn-primary">Unggah berkas ijazah</a></p>';
		if(!empty($t->berkas))
		{
			echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas.'"  width="200" class="img-fluid img-thumbnail" alt="berkas tidak ditemukan"></a><p><a href="'.base_url().'unggah/hapus/pendidikan/'.$t->id.'" data-confirm="Hapus berkas pindaian ijazah '.$t->namasekolah.'?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
		}
		echo '</td>';
	echo "<td align=\"center\"><a href='".base_url()."guru/pendidikan/ubah/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td>
<td align=\"center\"><a href='".base_url()."guru/pendidikan/hapus/".$t->id."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";		
	$urut++;
	} 
	echo '</table>';
}
?>
</div></div></div>
