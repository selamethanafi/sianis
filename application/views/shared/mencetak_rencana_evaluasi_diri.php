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
$title = 'Rencana Evaluasi Diri';
$tb = $this->db->query("select * from `evaluasi_diri_tanggal` where `tahun`= '$tahun' and `nim`='$nim'");
foreach($tb->result() as $b)
{
	$tanggal = $b->tanggal;
}
$namapegawai = cari_nama_pegawai($nim);
$nipguru = cari_nip_pegawai($nim);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
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
<div class="landscape">
<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td colspan="10">Format 2<p><a href="<?php echo base_url();?><?php echo $tautan_balik;?>">Rencana Pengembangan Keprofesian Berkelanjutan Individu Guru (diisi oleh  Guru dan Koordinator)</a></p></td></tr>
<tr valign="top"><td width="100">Nama madrasah</td><td  width="500"><?php echo $sek_nama;?></td><td>NSS / NSM</td><td><?php echo $sek_nss.'/'.$sek_nsm;?></td></tr>
<tr valign="top"><td>Alamat</td><td><?php echo $sek_alamat;?></td><td>Nama Guru</td><td><?php echo $namapegawai;?></td></tr>
<tr valign="top"><td>Kecamatan</td><td><?php echo $sek_kec;?></td><td>NIP Guru</td><td><?php echo $nipguru;?></td></tr>
<tr valign="top"><td>Kabupaten / Kota</td><td><?php echo $sek_kab;?></td><td>Tahun Pelajaran</td><td><?php echo $thnajaran;?></td></tr>
<tr valign="top"><td>Provinsi</td><td><?php echo $sek_prov;?></td><td>Tanggal</td><td><?php echo date_to_long_string($tanggal);?></td></tr>
</table><br /><br />
<table class="table table-striped table-hover table-bordered"><tr><td colspan="2" rowspan="3" width="300">A. Kompetensi</td><td rowspan="3">Rencana Pengembangan Keprofesian Berkelanjutan yang akan dilakukan Guru untuk peningkatan kompetensi terkait</td><td colspan="7">Strategi Pengembangan Keprofesian Berkelanjutan</td></tr><tr align="center"><td rowspan="2">1</td><td rowspan="2">2</td><td rowspan="2">3</td><td rowspan="2">4</td><td colspan="2">5</td><td rowspan="2">6</td><tr><td>a</td><td>b</td></tr>
<tr><td colspan="10">Pedogogik</td></tr>
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
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
echo '<tr><td colspan="10">Kepribadian</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'B%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
echo '<tr><td colspan="10">Sosial</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'C%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
echo '<tr><td colspan="10">Profesional</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'D%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10">Berbagai hal terkait dengan pemenuhan dan peningkatan kompetensi inti tersebut</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'E%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10">B. Kompetensi menghasilkan Publikasi Ilmiah</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'F%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr bgcolor="#8ed6d7"><td colspan="10">C. Kompetensi menghasilkan Karya Inovatif</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'G%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr bgcolor="#8ed6d7"><td colspan="10">D. Kompetensi untuk penunjang pelaksanaan pembelajaran berkualitas (TIK, Bahasa Asing, dsb)</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'H%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
$nomor = 1;
echo '<tr><td colspan="10">E. Kompetensi penunjang pelaksanaan tugas tambahan</td></tr>';
$ta = $this->db->query("select * from `evaluasi_diri` where `tahun`= '$tahun' and `nim`='$nim' and `kode` like 'I%' order by `kode`");
foreach($ta->result() as $a)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$a->kompetensi_inti.'</td><td>'.$a->rencana.'</td>';
	if ($a->oleh == 1)
	{
		echo '<td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 2)
	{
		echo '<td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 3)
	{
		echo '<td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 4)
	{
		echo '<td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td><td></td>';
	}
	elseif ($a->oleh == 5)
	{
		echo '<td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td><td></td>';
	}
	elseif ($a->oleh == 6)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
		echo '<td></td>';
	}
	elseif ($a->oleh == 7)
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td align="center"><span class="fa fa-check"></span></td>';
	}
	else
	{
		echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	echo '</tr>';
	$nomor++;
}
echo '</table><br />';
$lebartabel=670;

echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="100"></td><td valign="top" width="300">Guru,<br><br><br></td><td valign="top" >Koordinator PKB</td></tr>
<tr><td valign="top" width="100"></td><td valign="top">'.$namapegawai.'<br>NIP '.$nipguru.'</td><td>'.$koordinator_pkb.'<br />NIP '.$nip_koordinator_pkb.'</td></tr></table><br />';
?>
</div>
</body>
</html>
