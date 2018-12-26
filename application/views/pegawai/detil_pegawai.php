<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru
// Nama Berkas 		: detil_pegawai.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container"><h3><?php echo $judulhalaman;?></h3>
<?php
if(count($query->result())>0)
{
	echo '<p><a href="'.base_url().'pegawai/editdataumum" class="btn btn-info" role="button"><span class="glyphicon glyphicon-edit"></span> <strong>Sunting Data</strong></a>';

	foreach($query->result() as $t)
	{
			if (!empty($t->foto))
			{
			$fotone = ''.base_url().'images/foto_guru_pegawai/'.$t->foto.'';
			echo '<p class="text-center"><img src="'.$fotone.'" height="200" alt="berkas foto pegawai tidak ditemukan" class="img-rounded"></p>';
			}
	if($t->guru != 'T')
	{
		echo '<div class="alert alert-warning">Status Anda Bukan Tenaga Kependidikan, silakan menghubungi Tatausaha untuk mengubah menjadi tenaga kependidikan</div>';
	}
	echo '
	<table class="table table-striped table-hover table-bordered">
	<tr><td>Nama Lengkap</td><td>'.$t->nama.'</td></tr>
	<tr><td>Jabatan</td><td>'.$t->jabatan.'</td></tr>
	<tr><td>NIP / NIK  </td><td>'.$t->nip.'</td></tr>
	<tr><td>NIP Lama  </td><td>'.$t->nip_lama.'</td></tr>
	<tr><td>Nama (tanpa gelar) </td><td>'.$t->nama_tanpa_gelar.'</td></tr>
	<tr><td>Gelar Akademik Depan</td><td>'.$t->gelar_depan.'</td></tr>
	<tr><td>Gelar Akademik Belakang</td><td>'.$t->gelar_belakang.'</td></tr>
	<tr><td>Tempat, tanggal lahir </td><td>'.$t->tempat.', '.date_to_long_string($t->tanggallahir).'</td></tr><tr><td>Jenis Kelamin </td><td>';
	if ($t->jenkel=='Lk')
			{
			echo 'Laki - Laki';
			}
			else
			{
			echo 'Perempuan';
			}
	echo'</td></tr>
	<tr><td>Agama </td><td>'.$t->agama.'</td></tr>
	<tr><td>Status Perkawinan</td><td>'.$t->status_perkawinan.'</td></tr>
	<tr><td>Cacah Anak Kandung</td><td>'.$t->cacah_anak_kandung.'</td></tr>
	<tr><td>Alamat Rumah </td><td>'.$t->alamat.'</td></tr>
	<tr><td>RT / RW </td><td>'.$t->rt.' / '.$t->rw.'</td></tr>
	<tr><td>Provinsi </td><td>'.$t->provinsi.'</td></tr>
	<tr><td>Kabupaten / Kota </td><td>'.$t->kabupaten.'</td></tr>
	<tr><td>Kecamatan </td><td>'.$t->kecamatan.'</td></tr>
	<tr><td>Kelurahan </td><td>'.$t->desa.'</td></tr>
	<tr><td>Kategori Tempat Tinggal</td><td>'.$t->jenis_tempat_tinggal.'</td></tr>
	<tr><td>Golongan Darah</td><td>'.$t->golongan_darah.'</td></tr>
	<tr><td>Telpon Rumah / HP</td><td>'.$t->telpon.' / '.$t->seluler.'</td></tr>
	<tr><td>Alamat Email</td><td>'.$t->email.'</td></tr>
	<tr><td>NIK / NO KTP  </td><td>'.$t->nik.'</td></tr>
	<tr><td>NUPTK</td><td>'.$t->nuptk.'</td></tr>
	<tr><td>Nomor Kartu Pegawai (PNS)</td><td>'.$t->karpeg.'</td></tr>
	<tr><td>Nomor Kartu Pegawai Elektronik (PNS)</td><td>'.$t->kpe.'</td></tr>
	<tr><td>Nomor ASKES (PNS)</td><td>'.$t->askes.'</td></tr>
	<tr><td>Nomor Taspen (PNS)</td><td>'.$t->taspen.'</td></tr>
	<tr><td>Nomor KARIS/KARSU (PNS)</td><td>'.$t->karis_karsu.'</td></tr>
	<tr><td>NPWP</td><td>'.$t->npwp.'</td></tr>
	<tr><td>EFIN</td><td>'.$t->efin.'</td></tr>
	<tr><td>Peg ID (simpatika)</td><td>'.$t->pegid.'</td></tr>';
		//kgb pertama
	echo '
	<tr><td>Kenaikan Gaji Berkala</td><td>'.date_to_long_string($t->kgb_pertama).'</td></tr>';
	//kgb terakhir
	echo '<tr><td>Kenaikan Gaji Berkala Terakhir</td><td>'.date_to_long_string($t->kgb).'</td></tr>';
	echo '<tr><td>Usia pensiun</td><td>'.$t->usiapensiun.'</td></tr>
	<tr><td>Tanggal Pensiun</td><td>'.date_to_long_string($t->tanggalpensiun).'</td></tr>
	<tr><td>Bangsa</td><td>'.$t->bangsa.'</td></tr>
	<tr><td>Nama Ayah</td><td>'.$t->ayah.'</td></tr>
	<tr><td>Nama Ibu</td><td>'.$t->ibu.'</td></tr>
	<tr><td>Alamat Orang Tua</td><td>'.$t->alamatortu.'</td></tr>
	<tr><td>Nama Ayah Mertua</td><td>'.$t->ayahmertua.'</td></tr>
	<tr><td>Nama Ibu Mertua</td><td>'.$t->ibumertua.'</td></tr>
	<tr><td>Alamat mertua</td><td>'.$t->alamatmertua.'</td></tr>';
	echo '</table>';
	echo '<p class="text-center"><a href="'.base_url().'pegawai/editdataumum" class="btn btn-info" role="button"><span class="glyphicon glyphicon-edit"></span> <strong>Sunting Data</strong></a>';
	}
}
else
{
	echo '<div class="alert alert-warning">Belum ada data</div>';
	echo '<p class="text-center"><a href="'.base_url().'pegawai/buatdataumum" class="btn btn-info"><strong>BUAT DATA BARU</strong></a>';
}
?>
</div>
