<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: cetak_ropeg_drh.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>DAFTAR RIWAYAT HIDUP PEGAWAI - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>

<?php
$warna="#FFF";
echo '<table width="870" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="600"></td><td>LAMPIRAN I-C KEPALA BADAN KEPEGAWAIAN NEGARA
NOMOR : 11 TAHUN 2002<BR>TANGGAL 17 JUNI 2002</TD><TR>
</table>';
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	$pangkatgol = '';
	$namapegawai = $t->nama;
	$nip = $t->nip;
	echo '<table width="880" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td align="center"><h2>DAFTAR RIWAYAT HIDUP</h2></TD><TR></table>';
//><input type="text" size="40" name="ibumertua" readonly="readonly" value="'.$t
	echo '
	<table width="880" cellpadding="2" cellspacing="1" class="widget-small">
	<tr><td colspan="4"><strong>I. KETERANGAN PERORANGAN</strong></td></tr>
	<tr><td width="20">1</td><td width="250">Nama Lengkap</td><td  width="5">:</td><td>'.$namapegawai.'</td></tr>
	<tr><td>2</td><td>NIP</td><td>:</td><td>'.$nip.'</td></tr>
	<tr><td>3</td><td>Pangkat dan Golongan</td><td>:</td><td>'.$pangkatgol.'</td></tr>';
//	<tr><td></td><td></td><td>:</td><td>'.$t->.'</td></tr>
	$str = $t->tanggallahir;	
	$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$jenkel='';
	if ($t->jenkel=='Lk')
		{$jenkel='Pria';}
	if ($t->jenkel=='Pr')
		{$jenkel='Wanita';}
	
	echo '<tr><td>4</td><td>Tempat, tanggal lahir</td><td>:</td><td>'.$t->tempat.', '.$tanggal.'</td></tr>
	<tr><td>5</td><td>Jenis Kelamin</td><td>:</td><td>'.$jenkel.'</td></tr>
	<tr><td>6</td><td>Agama</td><td>:</td><td>'.$t->agama.'</td></tr>
	<tr><td>7</td><td>Status Perkawinan</td><td>:</td><td>'.$t->status_perkawinan.'</td></tr>
	<tr><td>8</td><td>Alamat Rumah</td><td>:</td><td>'.$t->alamat.'</td></tr>
	<tr><td></td><td>a. Jalan</td><td>:</td><td>'.$t->jalan.'</td></tr>
	<tr><td></td><td>b. Kelurahan / Desa </td><td>:</td><td>'.$t->desa.'</td></tr>
	<tr><td></td><td>c. Kecamatan </td><td>:</td><td>'.$t->kecamatan.'</td></tr>
	<tr><td></td><td>d. Kabupaten / Kota </td><td>:</td><td>'.$t->kabupaten.'</td></tr>
	<tr><td></td><td>e. Provinsi </td><td>:</td><td>'.$t->provinsi.'</td></tr>
	<tr><td>9</td><td colspan="2">Keterangan Badan</td></tr>
	<tr><td></td><td>a. Tinggi Badan</td><td>:</td><td>'.$t->tb.' cm</td></tr>
	<tr><td></td><td>b. Berat Badan </td><td>:</td><td>'.$t->bb.' kg</td></tr>
	<tr><td></td><td>c. Rambut </td><td>:</td><td>'.$t->rambut.'</td></tr>
	<tr><td></td><td>d. Bentuk Muka</td><td>:</td><td>'.$t->bentuk_muka.'</td></tr>
	<tr><td></td><td>e. Warna Kulit </td><td>:</td><td>'.$t->warna_kulit.'</td></tr>
	<tr><td></td><td>f. Ciri Khas</td><td>:</td><td>'.$t->ciri_khas.'</td></tr>
	<tr><td></td><td>g. Cacat Tubuh</td><td>:</td><td>'.$t->cacat_tubuh.'</td></tr>
	<tr><td>10</td><td>Kegemaran</td><td>:</td><td>'.$t->kegemaran.'</td></tr></table>';
	}
	
}

echo '<STRONG>II. PENDIDIKAN</strong>
<table width="880" border="1" cellspacing="0" cellpadding="3" class="widget-small">
<tr  bgcolor="'.$warna.'" align="center">
<td>NO</td>
<td>TINGKAT</td>
<td>NAMA PENDIDIKAN</td>
<td>JURUSAN</td>
<td>STTB / TANDA LULUS / IJAZAH TAHUN</td>
<td>TEMPAT</td>
<td>NAMA KEPALA SEKOLAH / DIREKTUR / DEKAN / PROMOTOR</td>
</tr>
<tr align="center"  bgcolor="'.$warna.'">
<td>1</td>
<td>2</td>
<td>3</td>
<td>4</td>
<td>5</td>
<td>6</td>
<td>7</td>
</tr>';
if(count($querypendidikan->result())>0)
{
	$urut=1;
	foreach($querypendidikan->result() as $ta)
	{
		echo '<tr><td>'.$urut.'</td><td>'.$ta->tingkat.'</td><td>'.$ta->namasekolah.'</td><td>'.$ta->jurusan.'</td><td>'.$ta->nomorijazah.' / '.$ta->tahunlulus.'</td><td>'.$ta->alamatsekolah.'</td><td>'.$ta->namakepala.'</td></tr>';		
	$urut++;
	} 

}
echo '</table>';
echo '';
echo '<STRONG>III. KURSUS / LATIHAN DI DALAM LUAR NEGERI</strong>
<table width="880" border="1" cellspacing="0" cellpadding="3" class="widget-small">
<tr bgcolor="'.$warna.'" align="center"><td>NO</td><td>NAMA KURSUS / LATIHAN</td><td>LAMANYA / TGL / BLN / THN S.D. / TGL / BLN / THN</td><td>IJAZAH / TANDA LULUS / SURAT KETERANGAN TAHUN</td><td>TEMPAT</td><td>KETERANGAN</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td>
</tr>';
if(count($querydiklat->result())>0)
{
	$urut=1;
	foreach($querydiklat->result() as $ta)
	{
	$str = $ta->tgl_mulai;	
	$tanggal_awal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $ta->tgl_selesai;	
	$tanggal_akhir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';


		echo '<tr><td>'.$urut.'</td><td>'.$ta->kegiatan.'</td><td>'.$tanggal_awal.' s.d. '.$tanggal_akhir.'</td><td>'.$ta->nomor.'</td><td>'.$ta->tempat.'</td><td></td></tr>';		
	$urut++;
	} 

}
echo '</table>';
echo '<strong>III PEKERJAAN
1. Riwayat kepangkatan golongan penggajian</strong>
<table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center"><td>NO</td>
<td>PANGKAT</td><td>GOLONGAN RUANG PENGGAJIAN</td><td>BERLAKU TMT</td><td>GAJI POKOK</td>
<td>PEJABAT</td><td>NOMOR</td><td>TANGGAL</td><td>PERATURAN YANG DIJADIKAN DASAR</td>
</tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td>
</tr>';

if(count($querykepeg->result())>0)
{
	$urut=1;
	foreach($querykepeg->result() as $t)
	{
	$str = $t->tanggal;	
	$tanggal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$duit = $t->gapok;
	$str = $t->tmt;	
	$tmt = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	echo '<tr><td>'.$urut.'</td><td>'.$t->pangkat.'</td><td>'.substr($t->gol,2,10).'</td><td>'.$tmt.'</td><td>'.$duit.'</td><td>'.$t->pejabat.'</td><td>'.$t->nomorsurat.'</td><td>'.$tanggal.'</td><td></td></tr>';
	$urut=$urut+1;				} 
}
echo '</table>';
echo '<strong>2. Pengalaman Jabatan / Pekerjaan</strong>
<table width="880" border="1" cellspacing="0" cellpadding="3">
<tr  bgcolor="'.$warna.'" align="center"><TD>NO</TD>
<td>JABATAN / PEKERJAAN</td><td>MULAI DAN SAMPAI</td><td>GOLONGAN RUANG PENGGAJIAN</td><td>GAJI POKOK</td>
<td>PEJABAT</td><td>NOMOR</td><td>TANGGAL</td>
</tr><tr bgcolor="'.$warna.'" align="center">
<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
</tr>';

if(count($queryjabatan->result())>0)
{
	$urut=1;
	foreach($queryjabatan->result() as $t)
	{
	$str = $t->tgl_awal;	
	$tanggal_awal = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$duit = $t->gaji_pokok;
	$str = $t->tgl_akhir;	
	$tanggal_akhir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_sk;	
	$tanggal_sk = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';

	echo '<tr><td>'.$urut.'</td><td>'.$t->nama_jabatan.'</td><td>'.$tanggal_awal.' s.d. '.$tanggal_akhir.'</td><td>'.substr($t->golongan,2,10).'</td><td>'.$duit.'</td><td>'.$t->pejabat.'</td><td>'.$t->nomor.'</td><td>'.$tanggal_sk.'</td></tr>';
	$urut=$urut+1;				} 
}
echo '</table>';

echo '<strong>IV. TANDA JASA PENGHARGAAN</strong>
<table width="880" border="1" cellspacing="0" cellpadding="3">
<tr  bgcolor="'.$warna.'" align="center"><TD>NO</TD>
<td>NAMA BINTANG / SATYALENCANA PENGHARGAAN</td><td>TAHUN PEROLEHAN<td>NAMA NEGARA / INSTANSI YAN MEMBERI</td>
</tr><tr bgcolor="'.$warna.'" align="center">
<td>1</td><td>2</td><td>3</td><td>4</td>
</tr>';

if(count($querypenghargaan->result())>0)
{
	$urut=1;
	foreach($querypenghargaan->result() as $t)
	{
	echo '<tr><td>'.$urut.'</td><td>'.$t->nama_penghargaan.'</td><td>'.$t->tahun_perolehan.'</td><td>'.$t->pemberi_penghargaan.'</td></tr>';
	$urut=$urut+1;				} 
}
echo '</table>';

echo '<strong>V. PENGALAMAN KELUAR NEGERI</strong>
<table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center"><TD>NO</TD>
<td>NEGARA</td><td>TUJUAN KUNJUNGAN<td>LAMA</td><td>YANG MEMBIAYAI</td>
</tr><tr bgcolor="'.$warna.'" align="center">
<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
</tr>';

if(count($querykeluarnegeri->result())>0)
{
	$urut=1;
	foreach($querykeluarnegeri->result() as $t)
	{
	echo '<tr><td>'.$urut.'</td><td>'.$t->negara.'</td><td>'.$t->tujuan_kunjungan.'</td><td>'.$t->lama.'</td><td>'.$t->pembiaya.'</td></tr>';
	$urut=$urut+1;				} 
}
echo '</table>';
echo '<strong>VI. KETERANGAN KELUARGA
1. Istri / Suami</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>NO</td><td>NAMA</td><td>TEMPAT LAHIR</td><td>TANGGAL LAHIR</td>
<td>TANGGAL NIKAH</td><td>PEKERJAAN</td><td>KETERANGAN</td>
</tr><tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>';

if(count($queryistrisuami->result())>0)
{
	$nomor=1;
	foreach($queryistrisuami->result() as $t)
	{
		
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama.'</td><td>'.$t->tempat.'</td>
		<td>';
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_nikah;	
	$tanggalnikah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
	$str = $t->tanggal_pisah;	
	$tanggalpisah = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';


		echo ''.$tanggallahir.'</td><td>'.$tanggalnikah.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->keterangan.'</td></tr>';		
	$nomor++;
	} 

}
echo '</table>';
echo '<strong>2. Anak</strong> <table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center"><td>No</td>
<td>Nama</td><td>Jenis Kelamin</td>
<td>Tempat</td><td>tanggal lahir</td>
<td>Sekolah / Pekerjaan</td>
<td>Keterangan</td>
</tr><tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>';

if(count($queryanak->result())>0)
{
	$nomor=1;
	foreach($queryanak->result() as $t)
	{
		
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama.'</td>
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


		echo ''.$jenkel.'</td><td>'.$t->tempat.'</td><td>'.$tanggallahir.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->keterangan.'</td></tr>';		
	$nomor++;
	} 

}
echo '</table>';
echo '<strong>3. Bapak dan Ibu Kandung</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>No</td><td>Nama</td><td>tanggal lahir</td><td>Pekerjaan</td><td>Keterangan</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>';

if(count($queryortu->result())>0)
{
	$nomor=1;
	foreach($queryortu->result() as $t)
	{
		
	echo '<tr><td>'.$nomor.'</td>
<td>'.$t->nama.'</td>';
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo '<td>'.$tanggallahir.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->keterangan.'</td></tr>';		
	$nomor++;
	} 
}
echo '</table>';
echo '<strong>4. Bapak dan Ibu Mertua</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>No</td><td>Nama</td><td>tanggal lahir</td><td>Pekerjaan</td><td>Keterangan</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>';

if(count($querymertua->result())>0)
{
	$nomor=1;
	foreach($querymertua->result() as $t)
	{
		
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama.'</td>';
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo '<td>'.$tanggallahir.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->keterangan.'</td></tr>';		
	$nomor++;
	} 
}
echo '</table>';
echo '<strong>5. Saudara Kandung</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>No</td><td>Nama</td><td>Jenis Kelamin</td><td>tanggal lahir</td><td>Pekerjaan</td><td>Keterangan</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>';

if(count($querykakakadik->result())>0)
{
	$nomor=1;
	foreach($querykakakadik->result() as $t)
	{
		if ($t->jenkel=='Pr')
			{$jenkel='Perempuan';
			}
			else
			{$jenkel='Laki - laki';
			}
		
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama.'</td><td>'.$jenkel.'</td>';
	$str = $t->tanggallahir;	
	$tanggallahir = ''.substr($str,8,2).'/'.substr($str,5,2).'/'.substr($str,0,4).'';
		echo '<td>'.$tanggallahir.'</td><td>'.$t->pekerjaan.'</td><td>'.$t->keterangan.'</td></tr>';		
	$nomor++;
	} 
}
echo '</table>';

echo '<strong>VII. KETERANGAN ORGANISASI
1. Semasa Mengikuti pendidikan SLTA ke bawah</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>No</td><td>NAMA ORGANISASI</td><td>KEDUDUKAN DALAM ORGANISASI</td><td>DALAM TAHUN S.D. TAHUN</td><td>TEMPAT</td><td>NAMA PIMPINAN ORGANISASI</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>';

if(count($queryorgslta->result())>0)
{
	$nomor=1;
	foreach($queryorgslta->result() as $t)
	{
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama_organisasi.'</td><td>'.$t->kedudukan.'</td>';
		echo '<td>'.$t->tahun_awal.' s.d. '.$t->tahun_akhir.'</td><td>'.$t->tempat.'</td><td>'.$t->nama_pimpinan.'</td></tr>';		
	$nomor++;
	} 
}
echo '</table>';
echo '<strong>2. Semasa Mengikuti pendidikan pada perguruan tinggi</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>No</td><td>NAMA ORGANISASI</td><td>KEDUDUKAN DALAM ORGANISASI</td><td>DALAM TAHUN S.D. TAHUN</td><td>TEMPAT</td><td>NAMA PIMPINAN ORGANISASI</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>';

if(count($queryorgpt->result())>0)
{
	$nomor=1;
	foreach($queryorgpt->result() as $t)
	{
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama_organisasi.'</td><td>'.$t->kedudukan.'</td>';
		echo '<td>'.$t->tahun_awal.' s.d. '.$t->tahun_akhir.'</td><td>'.$t->tempat.'</td><td>'.$t->nama_pimpinan.'</td></tr>';		
	$nomor++;
	} 
}
echo '</table>';
echo '<strong>3. Sesudah selesai pendidikan dan atau selama menjadi pegawai</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td>No</td><td>NAMA ORGANISASI</td><td>KEDUDUKAN DALAM ORGANISASI</td><td>DALAM TAHUN S.D. TAHUN</td><td>TEMPAT</td><td>NAMA PIMPINAN ORGANISASI</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>';

if(count($queryorgpegawai->result())>0)
{
	$nomor=1;
	foreach($queryorgpegawai->result() as $t)
	{
	echo '<tr><td>'.$nomor.'</td><td>'.$t->nama_organisasi.'</td><td>'.$t->kedudukan.'</td>';
		echo '<td>'.$t->tahun_awal.' s.d. '.$t->tahun_akhir.'</td><td>'.$t->tempat.'</td><td>'.$t->nama_pimpinan.'</td></tr>';		
	$nomor++;
	} 
}
echo '</table>';
echo '<strong>VIII. KETERANGAN LAIN - LAIN</strong><table width="880" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna.'" align="center">
<td width="30">No</td><td>NAMA KETERANGAN</td><td>PEJABAT PEMBUAT</td><td>NOMOR</td><td>TANGGAL</td></tr>
<tr bgcolor="'.$warna.'" align="center"><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>';

echo '<tr><td>1</td><td>KETERANGAN BERKELAKUAN BAIK</td><td></td><td></td><td></td></tr>';		
echo '<tr><td>2</td><td>KETERANGAN BERBADAN SEHAT</td><td></td><td></td><td></td></tr>';		

echo '<tr><td width="30">3</td><td colspan="4">KETERANGAN LAIN YANG DIANGGAP PERLU
<table width="800" cellspacing="0" cellpadding="3">';
foreach($query->result() as $t)
	{
	echo '<tr><td></td><td>KARPEG</td><td>:</td><td>'.$t->karpeg.'</td></tr>
<tr><td></td><td>KARIS / KARSU </td><td>:</td><td>'.$t->karis_karsu.'</td></tr>
<tr><td></td><td>KPE </td><td>:</td><td>'.$t->kpe.'</td></tr>

	<tr><td></td><td>TASPEN </td><td>:</td><td>'.$t->taspen.'</td></tr>
<tr><td></td><td>ASKES </td><td>:</td><td>'.$t->askes.'</td></tr>
<tr><td></td><td>NUPTK </td><td>:</td><td>'.$t->nuptk.'</td></tr>
<tr><td></td><td>KTP/NIK</td><td>:</td><td>'.$t->nik.'</td></tr>
	<tr><td></td><td>NPWP </td><td>:</td><td>'.$t->npwp.'</td></tr>';
	}
echo '</table></td></tr></table>';		
?>

<table width="880" cellspacing="0" cellpadding="3">
<tr><td colspan="2">Demikian daftar riwayat hidup ini saya buat dengan sesungguhnya dan apabila di kemudian hari terdapat keterangan yang tidak benar saya bersedia dituntut di muka pengadilan serta bersedia menerima segala tindakan yang diambil pemerintah.</td></tr><tr>
<td width="600"></td><td><?php echo $this->config->item('lokasi');?>, ............................................<br />Yang Membuat,<br /><br /><br /><br />
<?php echo $namapegawai;?><br />NIP <?php echo  $nip;?></td></tr></table>
<a href="<?php echo base_url(); ?>tatausaha/cetakrekap"><b><?php echo $this->config->item('nama_web');?></b></div></a>

