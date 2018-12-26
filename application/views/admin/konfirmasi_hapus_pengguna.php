<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: konfirmasi_hapus_pengguna.php
// Lokasi      		: application/views/admin
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
$query = $this->db->query("select * from `tbllogin` where `username`='$pengguna'");
$ada = $query->num_rows();
if($ada == 0 )
{
	echo 'Galat, pengguna tidak ditemukan';
}
else
{
	echo '<h2>'.$pengguna.'</h2>';
	foreach($query->result() as $q)
	{
		$status = $q->status;
	}
	if(($status == 'PA') or ($status == 'Pegawai'))
	{
		$query2 = $this->db->query("select * from `p_pegawai` where `kd`='$pengguna'");
		foreach($query2->result() as $t)
		{
			if (!empty($t->foto))
			{
			$fotone = ''.base_url().'images/foto_guru_pegawai/'.$t->foto.'';
			echo '<center><img src="'.$fotone.'" width="150" height="200"></center>';
			}

			echo '
			<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
			<tr><td colspan="3"><strong>Identitas Pegawai</strong></td></tr>
			<tr><td width="25%">Kode</td><td width="1%">:</td><td>'.$t->kode.'</td></tr>
			<tr><td>Nama Lengkap</td><td width="1%">:</td><td>'.$t->nama.'</td></tr>
			<tr><td>Jabatan</td><td width="1%">:</td><td>'.$t->jabatan.'</td></tr>
			<tr><td>NIP / NIK  </td><td width="1%">:</td><td>'.$t->nip.'</td></tr>
			<tr><td>NIP Lama  </td><td width="1%">:</td><td>'.$t->nip_lama.'</td></tr>
			<tr><td>Nama (tanpa gelar) </td><td width="1%">:</td><td>'.$t->nama_tanpa_gelar.'</td></tr>
			<tr><td>Gelar Akademik Depan</td><td width="1%">:</td>'.$t->gelar_depan.'</td></tr>
			<tr><td>Gelar Akademik Belakang</td><td width="1%">:</td><td>'.$t->gelar_belakang.'</td></tr>
			<tr><td>Tempat, tanggal lahir </td><td width="1%">:</td><td>'.$t->tempat.', '.date_to_long_string($t->tanggallahir).'</td></tr><tr><td>Jenis Kelamin </td><td width="1%">:</td><td>';
			if ($t->jenkel=='Lk')
			{
				echo 'Laki - Laki';
			}
			else
			{
				echo 'Perempuan';
			}
			echo'</td></tr>
			<tr><td>Agama </td><td width="1%">:</td><td>'.$t->agama.'</td></tr>
			<tr><td>Status Perkawinan</td><td width="1%">:</td><td>'.$t->status_perkawinan.'</td></tr>
			<tr><td>Cacah Anak Kandung</td><td width="1%">:</td><td>'.$t->cacah_anak_kandung.'</td></tr>
			<tr><td>Alamat Rumah </td><td width="1%">:</td><td>'.$t->alamat.'</td></tr>
			<tr><td>RT / RW </td><td width="1%">:</td><td>'.$t->rt.' / '.$t->rw.'</td></tr>
			<tr><td>Provinsi </td><td width="1%">:</td><td>'.$t->provinsi.'</td></tr>
			<tr><td>Kabupaten / Kota </td><td width="1%">:</td><td>'.$t->kabupaten.'</td></tr>
			<tr><td>Kecamatan </td><td width="1%">:</td><td>'.$t->kecamatan.'</td></tr>
			<tr><td>Kelurahan </td><td width="1%">:</td><td>'.$t->desa.'</td></tr>
			<tr><td>Kategori Tempat Tinggal</td><td width="1%">:</td><td>'.$t->jenis_tempat_tinggal.'</td></tr>
			<tr><td>Golongan Darah</td><td width="1%">:</td><td>'.$t->golongan_darah.'</td></tr>
			<tr><td>Telpon Rumah / HP</td><td width="1%">:</td><td>'.$t->telpon.' / '.$t->seluler.'</td></tr>
			<tr><td>Alamat Email</td><td width="1%">:</td><td>'.$t->email.'</td></tr>
			<tr><td>NIK / NO KTP  </td><td width="1%">:</td><td>'.$t->nik.'</td></tr>
			<tr><td>NUPTK</td><td width="1%">:</td><td>'.$t->nuptk.'</td></tr>
			<tr><td>Nomor Kartu Pegawai (PNS)</td><td width="1%">:</td><td>'.$t->karpeg.'</td></tr>
			<tr><td>Nomor Kartu Pegawai Elektronik (PNS)</td><td width="1%">:</td><td>'.$t->kpe.'</td></tr>
			<tr><td>Nomor ASKES (PNS)</td><td width="1%">:</td><td>'.$t->askes.'</td></tr>
			<tr><td>Nomor Taspen (PNS)</td><td width="1%">:</td><td>'.$t->taspen.'</td></tr>
			<tr><td>Nomor KARIS/KARSU (PNS)</td><td width="1%">:</td><td>'.$t->karis_karsu.'</td></tr>
			<tr><td>NPWP</td><td width="1%">:</td><td>'.$t->npwp.'</td></tr>
			<tr><td>Nama Bank Pembayar Gaji</td><td width="1%">:</td><td>'.$t->bank.'</td></tr>
			<tr><td>Nomor Rekening Bank</td><td width="1%">:</td><td>'.$t->nomor_rekening_bank.'</td></tr>
			<tr><td>Nama pada Rekening Bank</td><td width="1%">:</td><td>'.$t->nama_rekening_bank.'</td></tr>
			<tr><td>NPWP</td><td width="1%">:</td><td>'.$t->npwp.'</td></tr>
			<tr><td>NRG</td><td width="1%">:</td><td>'.$t->nrg.'</td></tr>
			<tr><td>No Peserta Sertifikasi</td><td width="1%">:</td><td>'.$t->no_peserta_sertifikasi.'</td></tr>
			<tr><td>No Sertifikat</td><td width="1%">:</td><td>'.$t->no_sertifikat.'</td></tr>
			<tr><td>Tanggal Sertifikat</td><td width="1%">:</td><td>'.date_to_long_string($t->tanggal_sertifikat).'</td></tr>
			<tr><td>Tanggal Lulus Sertifikasi</td><td width="1%">:</td><td>'.date_to_long_string($t->tgl_lulus_sertifikasi).'</td></tr>
			<tr><td>Kode Mapel Sertifikasi</td><td width="1%">:</td><td>'.$t->kode_mapel_sertifikasi.'</td></tr>
			<tr><td>Nomor SK Dirjen tentang NRG</td><td width="1%">:</td><td>'.$t->nomor_sk_dirjen.'</td></tr>';
			//kgb pertama
			echo '
			<tr><td>Kenaikan Gaji Berkala</td><td width="1%">:</td><td>'.date_to_long_string($t->kgb_pertama).'</td></tr>';
			//kgb terakhir
			echo '<tr><td>Kenaikan Gaji Berkala Terakhir</td><td width="1%">:</td><td>'.date_to_long_string($t->kgb).'</td></tr>';	
			echo '<tr><td>Usia pensiun</td><td width="1%">:</td><td>'.$t->usiapensiun.'</td></tr>
			<tr><td>Tanggal Pensiun</td><td width="1%">:</td><td>'.date_to_long_string($t->tanggalpensiun).'</td></tr>
			<tr><td>Bangsa</td><td width="1%">:</td><td>'.$t->bangsa.'</td></tr>
			<tr><td>Nama Ayah</td><td width="1%">:</td><td>'.$t->ayah.'</td></tr>
			<tr><td>Nama Ibu</td><td width="1%">:</td><td>'.$t->ibu.'</td></tr>
			<tr><td>Alamat Orang Tua</td><td width="1%">:</td><td>'.$t->alamatortu.'</td></tr>
			<tr><td>Nama Ayah Mertua</td><td width="1%">:</td><td>'.$t->ayahmertua.'</td></tr>
			<tr><td>Nama Ibu Mertua</td><td width="1%">:</td><td>'.$t->ibumertua.'</td></tr>
			<tr><td>Alamat mertua</td><td width="1%">:</td><td>'.$t->alamatmertua.'</td></tr>';
			if ($t->guru=='Y')
			{
				if ($t->status_kepegawaian == 'NonPNS')
				{
					echo '<tr><td>Status Inpassing</td><td width="1%">:</td><td>';
					if ($t->status_inpassing =='0')
					{
						echo 'Belum';		
					}
					else
					{
						echo 'Sudah';
					}
					echo '</td></tr>';
					echo '<tr><td>TMT Inpassing</td><td width="1%">:</td><td>'.date_to_long_string($t->tmt_inpassing);
				}
			}
			echo '</table>';
		}
	}
	else
	{
		echo '<h2>'.$pengguna.'</h2>';
	}
	echo form_open('admin/hapuspengguna');
echo '<input type="hidden" name="namapengguna" value="'.$pengguna.'"><p class="text-center"><button type="submit" class="btn btn-primary">HAPUS PENGGUNA</button> <a href="'.base_url().'admin/pengguna" class="btn btn-info"><b>Batal</b></a>';
echo '</form>';
}
?>
</div></div></div>
