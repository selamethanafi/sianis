<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: rekap_peringkat_siswa.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>Daftar Peringkat Siswa - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<?php
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
if ($itemx!='a')
{
// jumlah kognitif saja
echo '<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td align="center"><a href="'.base_url().'index.php/pengajaran/peringkat"><h3>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif</h3></a></td></tr></table>';
$ta = $this->db->query("select * from m_ruang order by ruang ASC");
foreach($ta->result() as $a)
{
	$kelas = $a->ruang;
	$tb = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester' order by peringkat_kelas ASC limit 0,$item");
	if(count($tb->result())>0){
	echo 'Kelas : <strong>'.$a->ruang.'</strong><br>';
	echo '<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td width="60"><strong>NIS</strong></td><td width="260"><strong>Nama</strong></td><td width="80"><strong>Jumlah Kognitif</strong></td><td width="80"><strong>Jumlah Psikomotor</strong></td><td width="80"><strong>Jumlah</strong></td><td width="80"><strong>Peringkat Kelas</strong></td></tr>';
	$nomor = 1;
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		$nama = nis_ke_nama($nis);
		$nis=$b->nis;
		$nama = nis_ke_nama($nis);
		echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$b->jumlah_kognitif."</td><td align=\"center\">".$b->jumlah_psikomotor."</td><td align=\"center\">".$b->jumlah."</td><td align=\"center\">".$b->peringkat_kelas."</td></tr>";
	$nomor++;
	}
	echo '</table><br>';
	} // kalau ada siswa	
}
}
else
{
// jumlah kognitif + psikomotor
echo '<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td align="center"><a href="'.base_url().'index.php/pengajaran/peringkat"><h3>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif dan Psikomotor</h3></a></td></tr></table>';
$ta = $this->db->query("select * from m_ruang order by ruang ASC");
foreach($ta->result() as $a)
{
	$kelas = $a->ruang;
	$tb = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and kelas='$kelas' and semester='$semester' order by peringkat_kelas_kumulatif ASC limit 0,$item");
	if(count($tb->result())>0){
	echo 'Kelas : <strong>'.$a->ruang.'</strong><br>';
	echo '<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td width="60"><strong>NIS</strong></td><td width="260"><strong>Nama</strong></td><td width="80"><strong>Jumlah Kognitif</strong></td><td width="80"><strong>Jumlah Psikomotor</strong></td><td width="80"><strong>Jumlah</strong></td><td width="80"><strong>Peringkat Kelas</strong></td></tr>';
	$nomor = 1;
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		$nama = nis_ke_nama($nis);
		$nis=$b->nis;
		$nama = nis_ke_nama($nis);
		echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td align=\"center\">".$b->jumlah_kognitif."</td><td align=\"center\">".$b->jumlah_psikomotor."</td><td align=\"center\">".$b->jumlah."</td><td align=\"center\">".$b->peringkat_kelas_kumulatif."</td></tr>";
	$nomor++;
	}
	echo '</table><br>';
	} // kalau ada siswa	
}
}

