<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bg_atas_cetak.php
// Lokasi      		: application/views/shared/
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>
<div class="potret">
<table width="100%">
<tr><td></td><td width="15%">LAMPIRAN II :</td><td width="40%" colspan="2">PERATURAN BERSAMA</td></tr>
<tr><td></td><td></td><td colspan="2">MENTERI PENDIDIKAN NASIONAL DAN</td></tr>
<tr><td></td><td></td><td colspan="2">KEPALA BADAN KEPEGAWAIAN NEGARA</td></tr>
<tr><td></td><td></td><td>NOMOR</td><td>: 03/V/PB/2010</td></tr>
<tr><td></td><td></td><td>NOMOR</td><td>: 14 Tahun 2010 </td></tr>
<tr><td></td><td></td><td>TANGGAL</td><td>:  6 Mei 2010</td></tr>
</table>
<br />
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
?>
<p class="text-center">SURAT PERNYATAAN<br />
MELAKSANAKAN TUGAS PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU</p>
<table width="100%">
<tr><td colspan="3">Yang bertanda tangan di bawah ini :</td></tr>
<tr><td width="5%"><td width="30%">Nama</td><td>: <?php echo cari_kepala_baru($thnajaran,$semester);?></td></tr>
<tr><td></td><td>NIP</td><td>: <?php echo cari_nip_kepala_baru($thnajaran,$semester);?></td></tr>
<?php
	$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
	$usernamekepala = $this->dupak->nip_jadi_username($nipkepala);
	$datapangkatkepala = $this->dupak->datapangkatterakhir($usernamekepala);
?>
<tr><td></td><td>Pangkat / Golongan Ruang / TMT</td><td>: <?php echo $datapangkatkepala['pangkat'].' / '.$datapangkatkepala['gol'].' / '.$datapangkatkepala['tmt'];?></td></tr>
<tr><td></td><td>Jabatan</td><td>: Kepala Madrasah</td></tr>
<tr><td></td><td>Unit Kerja</td><td>: <?php echo $unit_kerja;?></td></tr>
<tr><td colspan="3">Menyatakan bahwa :</td></tr>
<tr><td width="5%"><td width="30%">Nama</td><td>: <?php echo $dataguru['nama'];?></td></tr>
<tr><td></td><td>NIP</td><td>: <?php echo $dataguru['nip'];?></td></tr>
<tr><td></td><td>NUPTK / NPK</td><td>: <?php 
$nip = $dataguru['nip'];
if(empty($dataguru['nuptk']))
{
	echo '-';
}
else
{
	echo $dataguru['nuptk'];
}

echo ' / '.$dataguru['npk'];?></td></tr>
<tr><td></td><td>Pangkat / Golongan Ruang / TMT</td><td>: <?php echo $datapangkat['pangkat'].' / '.$datapangkat['gol'].' / '.$datapangkat['tmt'];?></td></tr>

<tr><td></td><td>Jabatan</td><td>: <?php echo $datapangkat['jabatan'];?></td></tr>
<tr><td colspan="3">Telah melakukan kegiatan pembelajaran/pembimbingan dan tugas tertentu, sebagai berikut :</td></tr>
</table>
<table width="100%" border="1">
<tr><td align="center" rowspan="2" width="25">No</td><td align="center" colspan="2" rowspan="2">U R A I A N</td><td colspan="2" align="center">HASIL PENILAIAN KINERJA </td></tr>
<tr><td align="center" width="100">NILAI</td><td width="100" align="center">KATEGORI</td></tr>
<tr><td></td><td colspan="2">Pembelajaran/Bimbingan dan Tugas Tertentu</td><td></td><td></td></tr>
<tr><td width="25" align="center">A.</td><td colspan="2">Melaksanakan proses pembelajaran</td><td></td><td></td></tr>
<tr><td></td><td width="25" align="center">-</td><td>Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, melaksanakan tindak lanjut hasil penilaian</td><td></td><td></td></tr>
<?php
$golongann = Pangkat_Sesudah($golongan);
$ta = $this->db->query("SELECT * FROM `dupak_tapel` where `username` = '$username' and `versi`='0' and `golongan`='$golongann'");
$adata = $ta->num_rows();
$nomor = 1;
if($adata>0)
{
	$ak = $this->dupak->Ak_Pbm($nim);
	echo '<tr><td></td><td align="center">'.$nomor.'</td><td>Tahun 2013</td><td align="center">'.$ak.'</td><td></td></tr>';
	$nomor++;
}
$ta = $this->db->query("SELECT * FROM `dupak_tapel` where `username` = '$username' and `versi` !='0' and `golongan`='$golongann'");
$adata = $ta->num_rows();
foreach($ta->result() as $a)
{
	$tahun = $a->tahun;
	$tb = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongann' and `nip` = '$nip' and `kode`='00' and `tahun` = '$tahun'");
	foreach($tb->result() as $b)
	{
		echo '<tr><td></td><td width="25" align="center">'.$nomor.'</td><td>Tahun '.$tahun.'</td><td align="center">'.$b->ak_r.'</td><td align="center">Baik</td></tr>';
		$nomor++;
	}
}
?>
<tr><td width="25" align="center">B</td><td colspan="2">Melaksanakan proses bimbingan</td><td></td><td></td></tr>
<tr><td></td><td width="25" align="center">-</td><td>Merencanakan dan melaksanakan pembimbingan, mengevaluasi dan menilai hasil bimbingan, menganalisis hasil bimbingan, melaksanakan tindak lanjut hasil pembimbingan </td><td></td><td></td></tr>
<tr><td width="25" align="center">C</td><td colspan="2">Melaksanakan tugas lain yang relevan dengan fungsi sekolah/madrasah</td><td></td><td></td></tr>
<?php
$golongann = Pangkat_Sesudah($golongan);
$tc = $this->db->query("SELECT * FROM `dupak_dupak` where `username` = '$username' and `golongan`='$golongann' and (`no_urut`='11' or `kode` like 'T0%' or `kode`='08' or `kode`='09' or `kode`='10')");
$nomor = 1;
foreach($tc->result() as $c)
{
	$kode = $c->kode; 
	$kategori = '';
	if(($kode == '08') or ($kode == '09') or ($kode == '10') or ($kode == '11'))
	{
		$kategori = 'Baik';
	}
	echo '<tr><td></td><td width="25" align="center">'.$nomor.'</td><td>'.$this->dupak->Cari_Kegiatan_Berdasar_Kode($kode).'</td><td align="center">'.$c->ak_item.'</td><td align="center">'.$kategori.'</td></tr>';
	$nomor++;
}
?>
</table>
Demikian pernyataan ini dibuat dengan melampirkan hasil penilaian kinerja dan bukti fisik masing - masing,untuk dapat dipergunakan sebagaimana mestinya.<br />
<?php
$datamasa = $this->dupak->datamasa($nim,$golongann);
		echo '<table width="100%">
		<tr><td width="10%"></td><td></td><td  width="40%">'.$lokasi.', '.date_to_long_string($datamasa['tanggal']).'</td></tr>
		<tr><td></td><td></td><td>Kepala madrasah,<br /><br /><br /></td></tr>
		<tr><td></td><td></td><td>'.cari_kepala_baru($thnajaran,$semester).'<br />NIP '.cari_nip_kepala_baru($thnajaran,$semester).'</td></tr>
		</table>';
?>
</div>
</body>
</html>
