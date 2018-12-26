<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan: Sen 16 Mei 2016 10:48:05 WIB 
// Nama Berkas : detil-siswa.php
// Lokasi: application/views/bp/
// Author: Selamet Hanafi
// selamethanafi@yahoo.co.id
//
// (c) Copyright:
// Selamet Hanafi
// sianis.web.id
// selamet.hanafi@gmail.com
//
// License:
//Copyright (C) 2014 Selamet Hanafi
//Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<p class="text-left"><a href="<?php echo base_url();?>bp/carisiswa" class="btn btn-info"><strong>Cari Siswa</strong></a></p>
<table class="table">
<?php
if(count($query->result())>0)
{
foreach($query->result() as $t)
{
?>
<tr><td colspan="2"><h3>DATA PRIBADI SISWA</h3></td></tr>
<tr>
	<td>Nomor Peserta UN SLTP</td>
	<td><?php echo $t->skhun;?></td>
</tr>
<tr>
	<td>Nomor Induk Siswa</td>
	<td><?php echo $t->nis;?></td>
</tr>
<tr>
	<td>NIS Nasional</td>
	<td><?php echo $t->nisn;?></td>
</tr>
<tr>
	<td>Password</td>
	<td><?php echo $t->sandi;?></td>
</tr>
<tr>
	<td>Nama</td>
	<td><?php echo $t->nama;?>
	<?php
	if ($t->ijazah<>'Ya')
	{echo '<strong><font color="#FF0000">NAMA BELUM SESUAI IJAZAH!</strong>';}
	?>
	</td>
</tr>
<tr>
	<td>Tempat Lahir</td>
	<td><?php echo $t->tmpt;?></td>
</tr>
<tr>
	<td>Tanggal lahir</td>
	<td><?php echo $t->tgllhr;?></td>
</tr>
<tr>
	<td>Agama</td>
	<td><?php echo $t->agama;?></td>
</tr>
<tr>
	<td>Jenis Kelamin</td>
	<td><?php echo $t->jenkel;?></td>
</tr>
<tr>
	<td>Kelas</td>
	<td><?php echo $t->kdkls;?></td>
</tr>
<tr>
	<td>Kewarganegaraan</td>
	<td><?php echo $t->wn;?></td>
</tr>
<tr>
	<td>Anak Yatim-Piatu</td>
	<td><?php echo $t->yatim;?></td>
</tr>
<tr>
	<td>Anak ke</td>
	<td><?php echo $t->anakke;?></td>
</tr>
<tr>
	<td>Jumlah Saudara Kandung</td>
	<td><?php echo $t->kandung;?></td>
</tr>
<tr>
	<td>Jumlah Saudara Tiri</td>
	<td><?php echo $t->tiri;?></td>
</tr>
<tr>
	<td>Jumlah Saudara Angkat</td>
	<td><?php echo $t->angkat;?></td>
</tr>
<tr>
	<td>Bahasa Sehari-hari</td>
	<td><?php echo $t->bhs;?></td>
</tr>
<tr>
	<td><h3>TEMPAT TINGGAL</h3></td>
</tr>
<tr>
	<td>Alamat</td>
	<td>Jalan <?php echo $t->jalan;?></td>
</tr>
<tr>
	<td></td>
	<td>RT <?php echo $t->rt;?> RW <?php echo $t->rw;?> Dusun <?php echo $t->dusun;?></td>
</tr>
<tr>
	<td></td>
	<td>Desa <?php echo $t->desa;?> Kec. <?php echo $t->kec;?></td>
</tr>
<tr>
	<td></td>
	<td>Kab. <?php echo $t->kab;?> Prov. <?php echo $t->prov;?>
	</td>
</tr>
<tr>
	<td></td>
	<td><?php echo $t->alamat;?></td>
</tr>
<tr>
	<td>Jarak ke sekolah</td>
	<td><?php echo $t->jarak;?> km</td>
</tr>
<tr>
	<td>Jenis Tempat Tinggal</td>
	<td><?php echo $t->jenrumah;?></td>
</tr>
<tr>
	<td>Tinggal dengan</td>
	<td><?php echo $t->tinggal;?></td>
</tr>
<tr>
	<td>Jenis Transportasi</td>
	<td><?php echo $t->transportasi;?></td>
</tr>
<tr>
	<td>Nomor Telepon</td>
	<td><?php echo $t->telepon;?> / HP : <?php echo $t->hp;?></td>
</tr>
<tr>
	<td colspan="2"><h3>KESEHATAN</h3></td>
</tr>
<tr>
	<td>Berat Badan</td>
	<td><?php echo $t->bb;?> kg</td>
</tr>
<tr>
	<td>Tinggi Badan</td>
	<td><?php echo $t->tb;?> cm</td>
</tr>
<tr>
	<td>Golongan Darah</td>
	<td><?php echo $t->goldarah;?></td>
</tr>
<tr>
	<td>Sakit yang pernah diderita</td>
	<td><?php echo $t->sakit;?></td>
</tr>
<tr>
	<td>Kebutuhan Jasmani</td>
	<td><?php echo $t->jasmani;?></td>
</tr>
<tr>
	<td colspan="2"><h3>SEKOLAH SEBELUM MASUK <?php echo $this->config->item('sek_nama');?></h3></td>
</tr>
<tr>
	<td>SLTP</td>
	<td><?php echo $t->sltp;?></td>
</tr>
<tr>
	<td>No STTB SLTP</td>
	<td><?php echo $t->nosttb;?></td>
</tr>
<tr>
	<td>No Peserta UN SLTP</td>
	<td><?php echo $t->skhun;?></td>
</tr>
<tr>
	<td>Tanggal STTB</td>
	<td><?php echo $t->tglsttb;?></td>
</tr>
<tr>
	<td>Lama Belajar di SLTP</td>
	<td><?php echo $t->lama;?> Tahun</td>
</tr>
<tr>
	<td>Pindahan dari</td>
	<td><?php echo $t->pinsek;?></td>
</tr>
<tr>
	<td>Alasan pindah</td>
	<td><?php echo $t->alasan;?></td>
</tr>
<tr>
	<td>Diterima di kelas</td>
	<td><?php echo $t->kls;?></td>
</tr>
<tr>
	<td>Tanggal di terima</td>
	<td><?php echo $t->tglditerima;?></td>
</tr>
<tr>
	<td colspan="2"><h3>DATA KELUARGA SISWA</h3></td>
</tr>
<tr>
	<td colspan="2"><h3>DATA AYAH SISWA</h3></td>
</tr>
<tr>
	<td>Nama</td>
	<td><?php echo $t->nmayah;?></td>
</tr>
<tr>
	<td>Alamat</td>
	<td><?php echo $t->alayah;?></td>
</tr>
<tr>
	<td>Tempat Lahir</td>
	<td><?php echo $t->tmpayah;?></td>
</tr>
<tr>
	<td>Tanggal Lahir</td>
	<td><?php echo $t->tglayah;?></td>
</tr>
<tr>
	<td>Agama</td>
	<td><?php echo $t->agayah;?></td>
</tr>
<tr>
	<td>Kewarganegaraan</td>
	<td><?php echo $t->wnayah;?></td>
</tr>
<tr>
	<td>Pekerjaan</td>
	<td><?php echo $t->payah;?> </td>
</tr>
<tr>
	<td>Penghasilan</td>
	<td>Rp <?php echo $t->dayah;?></td>
</tr>
<tr>
	<td>Pendidikan</td>
	<td><?php echo $t->sekayah;?></td>
</tr>
<tr>
	<td>Masih hidup</td>
	<td><?php echo $t->hdpayah;?></td>
</tr>
<tr>
	<td>Jika tidak, meninggal tahun</td>
	<td><?php echo $t->thnayah;?></td>
</tr>
<tr>
	<td colspan="2"><h3>DATA IBU SISWA</h3></td>
</tr>
<tr>
	<td>Nama</td>
	<td><?php echo $t->nmibu;?></td>
</tr>
<tr>
	<td>Alamat</td>
	<td><?php echo $t->alibu;?></td>
</tr>
<tr>
	<td>Tempat Lahir</td>
	<td><?php echo $t->tmpibu;?></td>
</tr>
<tr>
	<td>Tanggal Lahir</td>
	<td><?php echo $t->tglibu;?></td>
</tr>
<tr>
	<td>Agama</td>
	<td><?php echo $t->agibu;?></td>
</tr>
<tr>
	<td>Kewarganegaraan</td>
	<td><?php echo $t->wnibu;?></td>
</tr>
<tr>
	<td>Pekerjaan</td>
	<td><?php echo $t->pibu;?></td>
</tr>
<tr>
	<td>Penghasilan</td>
	<td>Rp <?php echo $t->dibu;?></td>
</tr>
<tr>
	<td>Pendidikan</td>
	<td><?php echo $t->sekibu;?></td>
</tr>
<tr>
	<td>Masih hidup</td>
	<td><?php echo $t->hdpibu;?></td>
</tr>
<tr>
	<td>Jika tidak, meninggal tahun</td>
	<td><?php echo $t->thnibu;?></td>
</tr>
<?php
$dnmwali = $t->nmwali;
if (! empty($dnmwali))
{
	?>
	<tr>
	<td colspan="2"><h3>DATA WALI SISWA</h3></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><?php echo $t->nmwali;?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><?php echo $t->awali;?></td>
	</tr>
	<tr>
		<td>Tempat Lahir</td>
		<td><?php echo $t->tmpwali;?></td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td> <?php echo $t->tglwali;?></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td><?php echo $t->agwali;?></td>
	</tr>
	<tr>
		<td>Kewarganegaraan</td>
		<td><?php echo $t->wnwali;?></td>
	</tr>
	<tr>
		<td>Telepon</td>
		<td><?php echo $t->twali;?></td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td><?php echo $t->pwali;?></td>
	</tr>
	<tr>
		<td>Penghasilan</td>
		<td>Rp <?php echo $t->dwali;?></td>
	</tr>
	<tr>
		<td>Pendidikan</td>
		<td><?php echo $t->sekwali;?></td>
	</tr>
	<?php
}
?>
<tr>
	<td colspan="2"><h3>KEGEMARAN SISWA</h3></td>
</tr>
<tr>
	<td>Cita - cita</td>
	<td><?php echo $t->cita_cita;?></td>
</tr>
<tr>
	<td>Hobi utama</td>
	<td><?php echo $t->hobi;?></td>
</tr>
<tr>
	<td>Kesenian</td>
	<td><?php echo $t->kesenian;?></td>
</tr>
<tr>
	<td>Olahraga</td>
	<td><?php echo $t->olahraga;?></td>
</tr>
<tr>
	<td>Organisasi</td>
	<td><?php echo $t->organisasi;?></td>
</tr>
<tr>
	<td>Lain - lain</td>
	<td><?php echo $t->lain;?></td>
</tr>
<tr>
	<td colspan="2"><h3>PERKEMBANGAN SISWA</h3></td>
</tr>
<tr>
	<td>Beasiswa</td>
	<td><?php echo $t->beasiswa;?></td>
</tr>
<tr>
	<td>Meninggalkan Madrasah</td>
	<td><?php echo $t->tanggalkeluar;?></td>
</tr>
<tr>
	<td>Alasan Meninggalkan Madrasah</td>
	<td><?php echo $t->alasankeluar;?></td>
</tr>
<tr>
	<td>Tanggal STTB</td>
	<td><?php echo $t->tamatbelajar;?></td>
</tr>
<tr>
	<td>Nomor STTB</td>
	<td><?php echo $t->nosttbma;?></td>
</tr>
<tr>
	<td colspan="2"><h3>INFORMASI SETELAH SELESAI SEKOLAH</h3></td>
</tr>
<tr>
	<td>Melanjutkan di</td>
	<td><?php echo $t->melanjutkan;?></td>
</tr>
<tr>
	<td>Mulai bekerja</td>
	<td><?php echo $t->tanggalbekerja;?></td>
</tr>
<tr>
	<td>Bekerja di</td>
	<td><?php echo $t->namaperusahaan;?></td>
</tr>
<tr>
	<td>Penghasilan</td>
	<td><?php echo $t->penghasilan;?></td>
</tr>
</table>

<?php


}
}
?>
</div>
