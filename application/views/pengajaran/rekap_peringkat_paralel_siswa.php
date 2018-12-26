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
if ((!empty($thnajaran)) and (!empty($tingkat)) and (!empty($semester)) and (!empty($id_jurusan)))
{
	echo 'Tahun Pelajaran : '.$thnajaran.'<br >';
	echo 'Semester : '.$semester.'<br >';
	echo 'Tingkat : '.$tingkat.'<br >';
	$jurusan = '';
	$ta = $this->db->query("select * from `m_program` where `id` = '$id_jurusan'");
	foreach($ta->result() as $a)
	{
		$jurusan = $a->program;
	}
	echo 'Jurusan : '.$jurusan;
	$tperingkat = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and semester='$semester' and `program`='$jurusan' and `tingkat` = '$tingkat' order by jumlah_kognitif DESC");
	$peringkat = 1;
	foreach($tperingkat->result() as $d)
	{
		$nis = $d->nis;
		$this->db->query("update siswa_peringkat set peringkat_paralel='$peringkat' where thnajaran ='$thnajaran' and semester='$semester' and nis='$nis'");
		$peringkat++;
	}
	?>
<a href="<?php echo base_url().'/'.$tautan.'/peringkatparalel';?>"><h4>Peringkat Siswa Berdasarkan Jumlah Nilai Kognitif</h4></a>
	<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Jumlah Kognitif</strong></td><td><strong>Jumlah Psikomotor</strong></td><td><strong>Jumlah</strong></td><td><strong>Peringkat Kelas</strong></td></tr>

<?php
$nomor=1;
$tf = $this->db->query("select * from siswa_peringkat where thnajaran ='$thnajaran' and `tingkat` = '$tingkat' and `program`='$jurusan' and semester='$semester' order by jumlah_kognitif DESC");
foreach($tf->result() as $f)
{
		$nis=$f->nis;
		$nama = nis_ke_nama($nis);
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$nis."</td><td>".$nama."</td><td>".$f->kelas."</td><td align=\"center\">".$f->jumlah_kognitif."</td><td align=\"center\">".$f->jumlah_psikomotor."</td><td align=\"center\">".$f->jumlah."</td><td align=\"center\">".$f->peringkat_paralel."</td></tr>";

$nomor++;
}
?>
</table><br>
<?php
}
?>
</table>
