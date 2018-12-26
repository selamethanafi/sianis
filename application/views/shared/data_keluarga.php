<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 10 Nov 2014 04:24:41 WIB 
// Nama Berkas 		: data_keluarga.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="card-body"><p>
 <a href="<?php echo base_url().''.$tautan; ?>/keluarga/tambah" class="btn btn-info"><b>Tambah</b></a></p>
<?php
if($tautan == 'tatausaha')
{
	echo '<p><a href="'.base_url().''.$tautan.'/umum" class="btn btn-info"><b>Data Pegawai</b></a> <a href="'.base_url().''.$tautan.'/keluarga" class="btn btn-info"><b>Pegawai Lain</b></a></p>';
	if (!empty($usernamepegawai))
	{
	echo '<p><a href="'.base_url().''.$tautan.'/tambahkeluarga/'.$usernamepegawai.'" class="btn btn-info"><b>Tambah Anggota Keluarga</b></a> <a href="'.base_url().''.$tautan.'/".$tautan."/datapendidikan/'.$usernamepegawai.'" class="btn btn-info"><b>Pendidikan</b></a>
	<a href="'.base_url().''.$tautan.'/datakepegawaian/'.$usernamepegawai.'" class="btn btn-info"><b>Kepegawaian</b></a>
	<a href="'.base_url().''.$tautan.'/dataorganisasi/'.$usernamepegawai.'" class="btn btn-info"><b>Organisasi</b></a>
	<a href="'.base_url().''.$tautan.'/datadiklat/'.$usernamepegawai.'" class="btn btn-info"><b>Diklat / Kursus / Workshop</b></a></p>';
	}
}
?>

<?php
if (!empty($usernamepegawai))
	{
		$akta_nikah = '';
		$akta_cerai = '';
		$kk = '';
		foreach($query->result() as $t)
		{
			$akta_nikah = $t->berkas_akta_nikah;
			$akta_cerai = $t->berkas_akta_cerai;
			$kk = $t->berkas_kartu_keluarga;
		}
	echo '
		 <div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div>
			<div class="col-sm-9" ><p class="form-control-static">'.$namapegawai.'</p></div>
			<div class="col-sm-3"><label class="control-label">Kartu Keluarga</label></div>
			<div class="col-sm-9" >';
				if(!empty($kk))
				{
					echo '<a href="'.base_url().'images/berkas_guru_pegawai/'.$kk.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$kk.'"  width="200" class="img-fluid img-thumbnail" alt="berkas kartu keluarga tidak ditemukan"><br /><a href="'.base_url().'unggah/hapus/kartu_keluarga" data-confirm="Hapus berkas pindaian kartu keluarga?" class="btn btn-danger"><span class="fa fa-times"></span></a>';
				}
			echo '<br /><a href="'.base_url().'unggah/unggah/kartu_keluarga">Unggah Kartu Keluarga</a></div>
			<div class="col-sm-3"><label class="control-label">Akta Nikah</label></div>
			<div class="col-sm-9" >';

				if(!empty($akta_nikah))
				{
					echo '<br /><a href="'.base_url().'images/berkas_guru_pegawai/'.$akta_nikah.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$akta_nikah.'"  width="200" class="img-fluid img-thumbnail" alt="berkas akta nikah tidak ditemukan"><br /><a href="'.base_url().'unggah/hapus/akta_nikah" data-confirm="Hapus berkas pindaian akta nikah?" class="btn btn-danger"><span class="fa fa-times"></span></a>';
				}
			echo '<br /><a href="'.base_url().'unggah/unggah/akta_nikah">Unggah Akta Nikah</a></div>
			<div class="col-sm-3"><label class="control-label">Akta Cerai</label></div>
			<div class="col-sm-9" >';
				if(!empty($akta_cerai))
				{
					echo '<a href="'.base_url().'images/berkas_guru_pegawai/'.$akta_cerai.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$akta_cerai.'"  width="200" class="img-fluid img-thumbnail" alt="berkas akta cerai tidak ditemukan"><br /><a href="'.base_url().'unggah/hapus/akta_cerai" data-confirm="Hapus berkas pindaian akta cerai?" class="btn btn-danger"><span class="fa fa-times"></span></a>';
				}
			echo '<br /><a href="'.base_url().'unggah/unggah/akta_cerai">Unggah Akta Cerai</a></div>

		</div>';
echo '<h4>Data Keluarga</h4><div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center">
<td>No</td>
<td>Nama</td>
<td>Hubungan</td>
<td>Jenis Kelamin</td>
<td>Tempat, tanggal lahir</td>
<td>Berkas Akta Kelahiran<br /> ASKES </td>
<td width="50" colspan="2">Aksi</td>
</tr>';

if(count($querykeluarga->result())>0)
{
	$nomor=1;
	foreach($querykeluarga->result() as $t)
	{
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama.'</td><td>'.$t->hubungan.'</td>
		<td>';
		if ($t->jenkel=='Pr')
			{$jenkel='Perempuan';
			}
			else
			{$jenkel='Laki - laki';
			}

		echo $jenkel.'</td><td>'.$t->tempat.', ';echo tanggal($t->tanggallahir);echo '</td><td align="center">';
		if(!empty($t->akta_kelahiran))
		{
			echo '<br /><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->akta_kelahiran.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->akta_kelahiran.'"  width="200" class="img-fluid img-thumbnail rounded" alt="berkas tidak ditemukan"></a><br /><a href="'.base_url().'unggah/hapus/akta_kelahiran/'.$t->id.'" data-confirm="Hapus berkas pindaian akta kelahiran '.$t->nama.'?" class="btn btn-danger"><span class="fa fa-times"</span></a>';
		}
		echo '<br /><a href="'.base_url().'unggah/unggah/akta_kelahiran/'.$t->id.'">Unggah Akta Kelahiran</a>';
		if(!empty($t->kis))
		{
			echo '<br /><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->kis.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->kis.'"  width="200" class="img-fluid img-thumbnail rounded" alt="berkas tidak ditemukan atau bukan berkas gambar"></a><br /><a href="'.base_url().'unggah/hapus/askes_keluarga/'.$t->id.'" data-confirm="Hapus berkas pindaian kartu asuransi kesehatan '.$t->nama.'?" class="btn btn-danger"><span class="fa fa-times"</span></a>';
		}
		echo '<br /><a href="'.base_url().'unggah/unggah/askes_keluarga/'.$t->id.'">Unggah Kartu Askes</a>';
		echo '</td>';
		echo "<td align=\"center\"><a href='".base_url()."".$tautan."/editkeluarga/".$t->id."' title='Ubah data'><span class=\"fa fa-edit\"></span></a></td>
<td align=\"center\"><a href='".base_url()."".$tautan."/hapuskeluarga/".$t->id."/".$usernamepegawai."' onClick=\"return confirm('Anda yakin ingin menghapus ".$t->nama." ?')\" title='Hapus Data'><span class=\"fa fa-trash-alt\"></span></a>
</td></tr>";		
	$nomor++;
	} 
	echo '</table></div>';
}

echo '<h4>Istri / Suami</h4><div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center">
<td>Nama</td>
<td>Hubungan</td>
<td>Jenis Kelamin</td>
<td>Pekerjaan</td><td>Keterangan</td>
<td>Tempat</td><td>tanggal lahir</td><td>Tanggal Menikah</td><td>Tanggal Pisah</td><td width="30">Ubah</td>
</tr>';

if(count($queryistrisuami->result())>0)
{
	$nomor=1;
	foreach($queryistrisuami->result() as $t)
	{
		
	echo '<tr><td>'.$t->nama.'</td><td>'.$t->hubungan.'</td>
		<td>';
		if ($t->jenkel=='Pr')
			{$jenkel='Perempuan';
			}
			else
			{$jenkel='Laki - laki';
			}
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_nikah;	
	$tanggalnikah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_pisah;	
	$tanggalpisah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';


		echo ''.$jenkel.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->keterangan.'</td><td>'.$t->tempat.'</td><td>'.$tanggallahir.'</td><td>'.$tanggalnikah.'</td><td>'.$tanggalpisah.'</td><td  align="center"><a href="'.base_url().''.$tautan.'/editkeluarga/'.$t->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';		
	$nomor++;
	} 

}
echo '</table></div>';
echo '<h4>Anak</h4><div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center">
<td>Nama</td><td>Jenis Kelamin</td>
<td>Pekerjaan</td>
<td>Tempat</td><td>tanggal lahir</td>
<td>Hubungan</td>
<td>Keterangan</td><td width="30">Ubah</td>
</tr>';

if(count($queryanak->result())>0)
{
	$nomor=1;
	foreach($queryanak->result() as $t)
	{
		
	echo '<tr><td>'.$t->nama.'</td>
		<td>';
		if ($t->jenkel=='Pr')
			{$jenkel='Perempuan';
			}
			else
			{$jenkel='Laki - laki';
			}
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_nikah;	
	$tanggalnikah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_pisah;	
	$tanggalpisah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';


		echo ''.$jenkel.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->tempat.'</td><td>'.$tanggallahir.'</td><td>'.$t->hubungan.'</td><td>'.$t->keterangan.'</td><td align="center"><a href="'.base_url().''.$tautan.'/editkeluarga/'.$t->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';		
	$nomor++;
	} 

}
echo '</table></div>';
echo '<h4>Orang Tua</h4><div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center">
<td>Nama</td>
<td>Pekerjaan</td>
<td>tanggal lahir</td>
<td>Keterangan</td><td width="30">Ubah</td>
</tr>';

if(count($queryortu->result())>0)
{
	$nomor=1;
	foreach($queryortu->result() as $t)
	{
		
	echo '<tr>
<td>'.$t->nama.'</td>
<td>'.$t->pekerjaan.'</td>';
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo '<td>'.$tanggallahir.'</td><td>'.$t->keterangan.'</td><td align="center"><a href="'.base_url().''.$tautan.'/editkeluarga/'.$t->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';		
	$nomor++;
	} 
}
echo '</table></div>';
echo '<h4>Mertua</h4><div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center">
<td>Nama</td>
<td>Pekerjaan</td>
<td>tanggal lahir</td>
<td>Keterangan</td><td width="30">Ubah</td>
</tr>';
if(count($querymertua->result())>0)
{
	$nomor=1;
	foreach($querymertua->result() as $t)
	{
		
	echo '<tr><td>'.$t->nama.'</td><td>'.$t->pekerjaan.'</td>';
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo '<td>'.$tanggallahir.'</td><td>'.$t->keterangan.'</td><td align="center"><a href="'.base_url().''.$tautan.'/editkeluarga/'.$t->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';		
	$nomor++;
	} 
}
echo '</table></div>';
echo '<h4>Saudara</h4>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center">
<td>Nama</td><td>Jenis Kelamin</td>
<td>Pekerjaan</td>
<td>Tempat</td><td>tanggal lahir</td>
<td>Hubungan</td>
<td>Keterangan</td><td width="30">Ubah</td>
</tr>';

if(count($querykakakadik->result())>0)
{
	$nomor=1;
	foreach($querykakakadik->result() as $t)
	{
		
			
	echo '<tr><td>'.$t->nama.'</td>
		<td>';
		if ($t->jenkel=='Pr')
			{$jenkel='Perempuan';
			}
			else
			{$jenkel='Laki - laki';
			}
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_nikah;	
	$tanggalnikah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_pisah;	
	$tanggalpisah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';


		echo ''.$jenkel.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->tempat.'</td><td>'.$tanggallahir.'</td><td>'.$t->hubungan.'</td><td>'.$t->keterangan.'</td><td align="center"><a href="'.base_url().''.$tautan.'/editkeluarga/'.$t->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';		
	$nomor++;

	} 
}
echo '</table></div>';



}
else
{
echo 'kosong';
}
?>
</div></div></div>
