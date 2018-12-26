<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru
// Nama Berkas 		: detil_pegawai.php
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
if(count($query->result())>0)
{
	echo '<p><a href="'.base_url().'guru/editdataumum" class="btn btn-info" role="button"><span class="fa fa-edit"></span> <strong>Sunting Data</strong></a>';

	foreach($query->result() as $t)
	{
			if (!empty($t->foto))
			{
			$fotone = ''.base_url().'images/foto_guru_pegawai/'.$t->foto.'';
			echo '<p class="text-center"><img src="'.$fotone.'" height="200" alt="berkas foto pegawai tidak ditemukan" class="img-fluid img-thumbnail rounded"><br /><a href="'.base_url().'unggah/hapus/foto" data-confirm="Hapus berkas foto?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
			}
				echo '<p class="text-center"><a href="'.base_url().'unggah/unggah/foto">Unggah Foto</a></p>';
	if($t->guru == 'T')
	{
		echo '<div class="alert alert-warning">Status Anda Bukan Guru, silakan menghubungi Tatausaha untuk mengubah menjadi guru</div>';
	}
	echo '
	<table class="table table-striped table-hover table-bordered">
	<tr><td>Nama Lengkap</td><td>'.$t->nama.'</td></tr>
	<tr><td>Jabatan</td><td>'.$t->jabatan.'</td></tr>
	<tr><td>NIP </td><td>'.$t->nip.'<p><a href="'.base_url().'unggah/unggah/nip" class="btn btn-primary">Unggah NIP</a></p>';
	if(!empty($t->berkas_nip))
	{	echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_nip.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_nip.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas nip tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/nip" data-confirm="Hapus berkas pindaian NIP?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
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
	<tr><td>NIK / NO KTP  </td><td>'.$t->nik.'<p><a href="'.base_url().'unggah/unggah/ktp" class="btn btn-primary">Unggah KTP</a></p>';
	if(!empty($t->berkas_ktp))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_ktp.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_ktp.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas ktp tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/ktp" data-confirm="Hapus berkas pindaian KTP?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>NUPTK</td><td>'.$t->nuptk.'</td></tr>
	<tr><td>NPK</td><td>'.$t->npk.'</td></tr>
	<tr><td>Nomor Kartu Pegawai (PNS)</td><td>'.$t->karpeg.'<p><a href="'.base_url().'unggah/unggah/karpeg" class="btn btn-primary">Unggah Kartu Pegawai</a></p>';
	if(!empty($t->berkas_karpeg))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_karpeg.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_karpeg.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas karpeg tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/karpeg" data-confirm="Hapus berkas pindaian kartu pegawai?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>Nomor Kartu Pegawai Elektronik (PNS)</td><td>'.$t->kpe.'<p><br /><a href="'.base_url().'unggah/unggah/kpe" class="btn btn-primary">Unggah Kartu Pegawai Elektronik</a></p>';
	if(!empty($t->berkas_kpe))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_kpe.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_kpe.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas karpeg elektronik tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/kpe" data-confirm="Hapus berkas pindaian kartu pegawai elektronik?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>Nomor ASKES (PNS)</td><td>'.$t->askes.'<p><a href="'.base_url().'unggah/unggah/askes" class="btn btn-primary">Unggah Kartu Askes</a></p>';
	if(!empty($t->berkas_askes))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_askes.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_askes.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas kartu askes ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/askes" data-confirm="Hapus berkas pindaian kartu askes?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>Nomor Taspen (PNS)</td><td>'.$t->taspen.'<p><a href="'.base_url().'unggah/unggah/taspen" class="btn btn-primary">Unggah Taspen</a></p>';
	if(!empty($t->berkas_taspen))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_taspen.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_taspen.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas taspen tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/taspen" data-confirm="Hapus berkas pindaian peserta taspen?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>Nomor KARIS/KARSU (PNS)</td><td>'.$t->karis_karsu.'<p><a href="'.base_url().'unggah/unggah/karsu" class="btn btn-primary">Unggah Kartu Suami / Istri</a></p>';
	if(!empty($t->berkas_karsu))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_karsu.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_karsu.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas karsu/karis tidak ditemukan"></a><p><a href="'.base_url().'unggah/hapus/karsu" data-confirm="Hapus berkas pindaian kartu suami / istri?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>NPWP</td><td>'.$t->npwp.'<p><a href="'.base_url().'unggah/unggah/npwp" class="btn btn-primary">Unggah NPWP</a></p>';
	if(!empty($t->berkas_npwp))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_npwp.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_npwp.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas npwp tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/npwp" data-confirm="Hapus berkas pindaian NPWP?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>EFIN</td><td>'.$t->efin.'</td></tr>
	<tr><td>Nama Bank Pembayar Gaji</td><td>'.$t->bank.'</td></tr>
	<tr><td>Nomor Rekening Bank</td><td>'.$t->nomor_rekening_bank.'<p><a href="'.base_url().'unggah/unggah/rekening" class="btn btn-primary">Unggah Buku Rekening</a></p>';
	if(!empty($t->berkas_rekening))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_rekening.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_rekening.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas rekening tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/rekening" data-confirm="Hapus berkas pindaian buku rekening?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>Nama pada Rekening Bank</td><td>'.$t->nama_rekening_bank.'</td></tr>
	<tr><td>NRG</td><td>'.$t->nrg.'</td></tr>
	<tr><td>No Peserta Sertifikasi</td><td>'.$t->no_peserta_sertifikasi.'</td></tr>
	<tr><td>Peg ID (simpatika)</td><td>'.$t->pegid.'</td></tr>
	<tr><td>No Sertifikat</td><td>'.$t->no_sertifikat.'<p><br /><a href="'.base_url().'unggah/unggah/sertifikat_pendidik" class="btn btn-primary">Unggah Sertifikat Pendidik</a></p>';
	if(!empty($t->berkas_sertifikat_pendidik))
	{
		echo '<p><a href="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_sertifikat_pendidik.'" target="_blank"><img src="'.base_url().'images/berkas_guru_pegawai/'.$t->berkas_sertifikat_pendidik.'" class="img-fluid img-thumbnail rounded" width="200" alt="berkas sertifikat pendidik tidak ditemukan"></a></p><p><a href="'.base_url().'unggah/hapus/sertifikat_pendidik" data-confirm="Hapus berkas pindaian sertifikat pendidik?" class="btn btn-danger"><span class="fa fa-times"></span></a></p>';
	}
	echo '</td></tr>
	<tr><td>Tanggal Sertifikat</td><td>'.date_to_long_string($t->tanggal_sertifikat).'</td></tr>
	<tr><td>Tanggal Lulus Sertifikasi</td><td>'.date_to_long_string($t->tgl_lulus_sertifikasi).'</td></tr>
	<tr><td>Kode Mapel Sertifikasi</td><td>'.$t->kode_mapel_sertifikasi.'</td></tr>';
	$kode_mapel_utama = $t->kode_mapel_utama;
	$ta = $this->db->query("select * from `kode_mapel_utama` where `kode` = '$kode_mapel_utama'");
	$mapel = '';
	foreach($ta->result() as $a)
	{
		$mapel = $a->mapel;
	}
	echo '<tr><td>Kode Mapel Utama</td><td>'.$kode_mapel_utama.' '.$mapel.'</td></tr>
	<tr><td>Nomor SK Dirjen tentang NRG</td><td>'.$t->nomor_sk_dirjen.'</td></tr>';
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
	if ($t->guru=='Y')
	{
		if ($t->status_kepegawaian == 'NonPNS')
			{
		echo '<tr><td>Status Inpassing</td><td>';
			if ($t->status_inpassing =='0')
				{
				echo 'Belum';		
				}
				else
				{
				echo 'Sudah';
				}
			echo '</td></tr>';
			echo '<tr><td>TMT Inpassing</td><td>'.date_to_long_string($t->tmt_inpassing);

			}
	}
	echo '</table>';
	echo '<p class="text-center"><a href="'.base_url().'guru/editdataumum" class="btn btn-info" role="button"><span class="fa fa-edit"></span> <strong>Sunting Data</strong></a>';
	}
}
else
{
	echo '<div class="alert alert-warning">Belum ada data</div>';
	echo '<p class="text-center"><a href="'.base_url().'guru/buatdataumum" class="btn btn-info"><strong>BUAT DATA BARU</strong></a>';
}
?>
</div>
