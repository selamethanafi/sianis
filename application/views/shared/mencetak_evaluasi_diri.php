<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 16 Jan 2015 08:43:21 WIB 
// Nama Berkas 		: mencetak_skp.php
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
<?php
$title = 'Evaluasi Diri';
$tb = $this->db->query("select * from `evaluasi_diri_tanggal` where `tahun`= '$tahun' and `nim`='$nim'");
foreach($tb->result() as $b)
{
	$tanggal = $b->tanggal;
}
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($nim);
$nipguru = cari_nip_pegawai($nim);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<style>
	@page {
	size: auto;
}
</style>
<title><?php echo $title;?></title>
</head>
<body>
<div class="potret">
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td colspan="4">Format 1<p><a href="<?php echo base_url();?><?php echo $tautan_balik;?>">Evaluasi Diri Guru untuk Pengembangan Keprofesian Berkelanjutan</a></p></td></tr>
<tr valign="top"><td width="100">Nama madrasah</td><td  width="300"><?php echo $sek_nama;?></td><td>NSS / NSM</td><td><?php echo $sek_nss.'/'.$sek_nsm;?></td></tr>
<tr valign="top"><td>Alamat</td><td><?php echo $sek_alamat;?></td><td>Nama Guru</td><td><?php echo $namapegawai;?></td></tr>
<tr valign="top"><td>Kecamatan</td><td><?php echo $sek_kec;?></td><td>NIP Guru</td><td><?php echo $nipguru;?></td></tr>
<tr valign="top"><td>Kabupaten / Kota</td><td><?php echo $sek_kab;?></td><td>Tahun Pelajaran</td><td><?php echo $thnajaran;?></td></tr>
<tr valign="top"><td>Provinsi</td><td><?php echo $sek_prov;?></td><td>Tanggal</td><td><?php echo date_to_long_string($tanggal);?></td></tr>
</table><br /><br />
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small" border="1">
<tr bgcolor="#8ed6d7"><td colspan="2">A. Kompetensi Inti</td><td width="400"  align="center">Evaluasi diri terhadap kompetensi terkait</td></tr>
<tr><td colspan="4">Pedogogik</td></tr>
<?php
$nomor = 1;
$tb = $this->db->query("select * from `evaluasi_diri_tanggal` where `tahun`= '$tahun' and `nim`='$nim'");
foreach($tb->result() as $b)
{
	$tanggal = $b->tanggal;
}

$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'A%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '<tr><td colspan="4">Kepribadian</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'B%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '<tr><td colspan="4">Sosial</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'C%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '<tr><td colspan="4">Profesional</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'D%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="4">Berbagai hal terkait dengan pemenuhan dan peningkatan kompetensi inti tersebut</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'E%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr bgcolor="#8ed6d7"><td colspan="4">B. Kompetensi menghasilkan Publikasi Ilmiah</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'F%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr bgcolor="#8ed6d7"><td colspan="4">C. Kompetensi menghasilkan Karya Inovatif</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'G%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr bgcolor="#8ed6d7"><td colspan="4">D. Kompetensi untuk penunjang pelaksanaan pembelajaran berkualitas (TIK, Bahasa Asing, dsb)</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'H%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr bgcolor="#8ed6d7"><td colspan="4">E. Kompetensi penunjang pelaksanaan tugas tambahan</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'I%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->evaluasi.'</td></tr>';
	$nomor++;
}
echo '</table><br />';
$lebartabel=670;

echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="100"></td><td valign="top" width="300"><br>Guru,<br><br><br></td><td valign="top" >'.$lokasi.', '.date_to_long_string($tanggal).'<br>Kepala '.$sek_nama.'</tr>
<tr><td valign="top" width="100"></td><td valign="top">'.$namapegawai.'<br>NIP '.$nipguru.'</td><td>'.$namakepala.'<br />NIP '.$nipkepala.'</td></tr></table><br />';
?>
</div>
</body>
</html>
