<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : mencetak_program_kerja_kepala_laboratorium.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
$pakB02 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'B02');
$pak01 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'01');
$pak02 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'02');
$pak03 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'03');
$pak04 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'04');
$pak05 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'05');
$pak07 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'07');
$pak08 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'08');
$pak09 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'09');
$pak10 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'10');
$pakT01 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'T01');
$pakT02 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'T02');
$pakT03 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'T03');
$pakT04 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'T04');
$pakT05 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'T05');
$pakT07 = $this->dupak->Cari_Ak_Dupak($nim,$golongann,'T07');
for($i=11;$i<=80;$i++)
{
	$kodenya = 'pak'.$i;
	$$kodenya = $this->dupak->Cari_Ak_Dupak($nim,$golongann,$i);
}
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
<div class="container-fluid">
<table width="100%">
<tr><td></td><td width="15%">LAMPIRAN I :</td><td width="40%" colspan="2">PERATURAN BERSAMA</td></tr>
<tr><td></td><td></td><td colspan="2">MENTERI PENDIDIKAN NASIONAL DAN</td></tr>
<tr><td></td><td></td><td colspan="2">KEPALA BADAN KEPEGAWAIAN NEGARA</td></tr>
<tr><td></td><td></td><td>NOMOR</td><td>: 03/V/PB/2010</td></tr>
<tr><td></td><td></td><td>NOMOR</td><td>: 14 Tahun 2010 </td></tr>
<tr><td></td><td></td><td>TANGGAL</td><td>:  6 Mei 2010</td></tr>
</table><br />
<p class="text-center">DAFTAR USUL<br />PENETAPAN ANGKA KREDIT GURU</p>
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
	$nipkepala = cari_nip_kepala_baru($thnajaran,$semester);
	$usernamekepala = $this->dupak->nip_jadi_username($nipkepala);
	$datapangkatkepala = $this->dupak->datapangkatterakhir($usernamekepala);
echo '<table width="100%">
	<tr><td width="50%">Instansi '.$this->config->item('sek_nama').' '.$this->config->item('sek_kab').'</td>
	<td>Masa Penilaian : '.date_to_long_string($datamasa['awal_penilaian']).' s.d '.date_to_long_string($datamasa['akhir_penilaian']).'</td></tr></table>';
?>
<table class="table table-black-bordered">
<tr><td>No</td><td colspan="3">KETERANGAN PERORANGAN</td></tr>
<tr><td>1</td><td width="45%" colspan="2">Nama</td><td><?php echo $dataguru['nama'];?></td></tr>
<tr><td>2</td><td colspan="2">NIP</td><td><?php echo $dataguru['nip'];?></td></tr>
<tr><td>3</td><td colspan="2">NUPTK / NPK</td><td> <?php
if(empty($dataguru['nuptk']))
{
	echo '-';
}
else
{ echo $dataguru['nuptk'];
}
?> / <?php echo $dataguru['npk'];?></td></tr>
<tr><td>4</td><td colspan="2">Nomor Seri Kartu Pegawai</td><td> <?php echo $dataguru['karpeg'];?></td></tr>
<tr><td>5</td><td colspan="2">Tempat dan Tanggal Lahir </td><td> <?php echo $dataguru['tempat'];?>, <?php echo date_to_long_string($dataguru['tanggallahir']);?></td></tr>
<tr><td>6</td><td colspan="2">Jenis Kelamin</td><td> <?php
if($dataguru['jenkel'] == 'Lk')
{
	echo 'Laki - laki';
}
else
{
	echo 'Perempuan';
}
?></td></tr>
<tr><td>7</td><td colspan="2">Pendidikan yang diperhitungkan Angka Kreditnya</td><td> <?php echo $datapak['pendidikan'];?></td></tr>
<tr><td>8</td><td colspan="2">Pangkat/Golongan Ruang/TMT</td><td> <?php echo $datapak['pangkat'];?> / <?php echo $datapak['golongan'];?> / <?php echo tanggal($datapak['tmt']);?></td></tr>
<tr><td>9</td><td colspan="2">Jabatan</td><td> <?php echo $datapak['jabatan'];?></td></tr>
<tr><td rowspan="2">10</td><td rowspan="2">Masa Kerja Golongan</td><td>Lama</td><td><?php echo $datamasa['tahun'];?> tahun <?php echo $datamasa['bulan'];?> bulan</td></tr>
<tr><td>Baru</td><td><?php echo $datamasa['tahun_baru'];?> tahun <?php echo $datamasa['bulan_baru'];?> bulan</td></tr>
<tr><td>11</td><td colspan="2">Jenis Guru</td><td>Guru mata pelajaran</td></tr>
<tr><td>12</td><td colspan="2">Unit Kerja</td><td><?php echo $unit_kerja;?></td></tr>
</table>
<?php
$jakutama = 0;
$jakutamalama = 0;
$jakutamabaru = 0;
$jakpenunjang = 0;
$jakpenunjanglama = 0;
$jakpenunjangbaru = 0;
?>
<table class="table table-black-bordered">
<tr><td colspan="12"  align="center">UNSUR YANG DINILAI</td></tr>
<tr><td rowspan="3" align="center">No</td><td rowspan="3" colspan="5" align="center">UNSUR, SUBUNSUR DAN BUTIR KEGIATAN</td><td colspan="6" align="center">ANGKA KREDIT MENURUT</td></tr>
<tr><td colspan="3" align="center">INSTANSI PENGUSUL</td><td colspan="3" align="center">TIM PENILAI</td></tr>
<tr><td width="50">LAMA</td><td width="50">BARU</td><td width="50">JUMLAH</td><td width="50">LAMA</td><td width="50">BARU</td><td width="50">JUMLAH</td></tr>
<tr><td align="center" width="5">I</td><td colspan="5"><strong>UNSUR UTAMA</strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td align="center" width="5">1</td><td colspan="4"><strong>PENDIDIKAN</strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>A</td><td colspan="3">Mengikuti pendidikan dan memperoleh gelar/ijazah/akta</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">1</td><td colspan="2">Doktor (S-3)</td><td align="center"><?php echo $pak01['lama'];?></td><td align="center"><?php echo $pak01['ak_item'];?></td><td align="center"><?php echo $pak01['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak01['jumlah'];
$jakutamalama = $jakutamalama + $pak01['lama'];
$jakutamabaru = $jakutamabaru + $pak01['ak_item'];
?>
<tr><td></td><td></td><td> </td><td>2</td><td colspan="2">Magister (S-2)</td><td align="center"><?php echo $pak02['lama'];?></td><td align="center"><?php echo $pak02['ak_item'];?></td><td align="center"><?php echo $pak02['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak02['jumlah'];
$jakutamalama = $jakutamalama + $pak02['lama'];
$jakutamabaru = $jakutamabaru + $pak02['ak_item'];
?>
<tr><td></td><td></td><td> </td><td>3</td><td colspan="2">Sarjana (S-1)</td><td align="center"><?php echo $pak03['lama'];?></td><td align="center"><?php echo $pak03['ak_item'];?></td><td align="center"><?php echo $pak03['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak03['jumlah'];
$jakutamalama = $jakutamalama + $pak03['lama'];
$jakutamabaru = $jakutamabaru + $pak03['ak_item'];
?>
<tr><td></td><td></td><td>B</td><td colspan="3">Mengikuti pendidikan dan memperoleh gelar/ijazah/akta</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">-</td><td colspan="2">Pelatihan prajabatan fungsional bagi guru calon pegawai negeri sipil/program induksi.</td><td align="center"><?php echo $pak04['lama'];?></td><td align="center"><?php echo $pak04['ak_item'];?></td><td align="center"><?php echo $pak04['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak04['jumlah'];
$jakutamalama = $jakutamalama + $pak04['lama'];
$jakutamabaru = $jakutamabaru + $pak04['ak_item'];
?>
<tr><td></td><td align="center" width="5">2</td><td colspan="4"><strong>PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU</strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>A</td><td colspan="3">Melaksanakan proses pembelajaran</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">-</td><td colspan="2">Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, melaksanakan tindak lanjut hasil penilaian</td><td align="center"><?php echo $pak05['lama'];?></td><td align="center"><?php echo round($pak05['ak_item'],2);?></td><td align="center"><?php echo round($pak05['jumlah'],2);?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak05['jumlah'];
$jakutamalama = $jakutamalama + $pak05['lama'];
$jakutamabaru = $jakutamabaru + $pak05['ak_item'];
?>
<tr><td></td><td></td><td>B</td><td colspan="3">Melaksanakan proses bimbingan</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">-</td><td colspan="2">Merencanakan dan melaksanakan pembimbingan, mengevaluasi dan menilai hasil bimbingan, menganalisis hasil bimbingan, melaksanakan tindak lanjut hasil pembimbingan.</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>C</td><td colspan="3">Melaksanakan tugas lain yang relevan dengan fungsi sekolah / madrasah.</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">1</td><td colspan="2">Menjadi Kepala Sekolah/Madrasah per tahun</td><td align="center"><?php echo $pak07['lama'];?></td><td align="center"><?php echo $pak07['ak_item'];?></td><td align="center"><?php echo $pak07['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak07['jumlah'];
$jakutamalama = $jakutamalama + $pak07['lama'];
$jakutamabaru = $jakutamabaru + $pak07['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">2</td><td colspan="2">Menjadi Wakil Kepala Sekolah/Madrasah per tahun</td><td align="center"><?php echo $pak08['lama'];?></td><td align="center"><?php echo $pak08['ak_item'];?></td><td align="center"><?php echo $pak08['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak08['jumlah'];
$jakutamalama = $jakutamalama + $pak08['lama'];
$jakutamabaru = $jakutamabaru + $pak08['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">3</td><td colspan="2">Menjadi ketua program keahlian/program studi atau yang sejenisnya</td><td align="center"><?php echo $pak09['lama'];?></td><td align="center"><?php echo $pak09['ak_item'];?></td><td align="center"><?php echo $pak09['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak09['jumlah'];
$jakutamalama = $jakutamalama + $pak09['lama'];
$jakutamabaru = $jakutamabaru + $pak09['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">4</td><td colspan="2">Menjadi kepala perpustakaan</td><td align="center"><?php echo $pak10['lama'];?></td><td align="center"><?php echo $pak10['ak_item'];?></td><td align="center"><?php echo $pak10['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak10['jumlah'];
$jakutamalama = $jakutamalama + $pak10['lama'];
$jakutamabaru = $jakutamabaru + $pak10['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">5</td><td colspan="2">Menjadi kepala laboratorium, bengkel, unit produksi atau yang sejenisnya</td><td align="center"><?php echo $pak11['lama'];?></td><td align="center"><?php echo $pak11['ak_item'];?></td><td align="center"><?php echo $pak11['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak11['jumlah'];
$jakutamalama = $jakutamalama + $pak11['lama'];
$jakutamabaru = $jakutamabaru + $pak11['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">6</td><td colspan="2">Menjadi pembimbing khusus pada satuan pendidikan yang menyelenggarakan pendidikan inklusi, pendidikan terpadu atau yang sejenisnya</td><td align="center"><?php echo $pakT01['lama'];?></td><td align="center"><?php echo $pakT01['ak_item'];?></td><td align="center"><?php echo $pakT01['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pakT01['jumlah'];
$jakutamalama = $jakutamalama + $pakT01['lama'];
$jakutamabaru = $jakutamabaru + $pakT01['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">7</td><td colspan="2">Menjadi wali kelas</td><td align="center"><?php echo $pakT02['lama'];?></td><td align="center"><?php echo $pakT02['ak_item'];?></td><td align="center"><?php echo $pakT02['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pakT02['jumlah'];
$jakutamalama = $jakutamalama + $pakT02['lama'];
$jakutamabaru = $jakutamabaru + $pakT02['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">8</td><td colspan="2">Menyusun kurikulum pada satuan pendidikannya</td><td align="center"><?php echo $pakT03['lama'];?></td><td align="center"><?php echo $pakT03['ak_item'];?></td><td align="center"><?php echo $pakT03['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pakT03['jumlah'];
$jakutamalama = $jakutamalama + $pakT03['lama'];
$jakutamabaru = $jakutamabaru + $pakT03['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5">9</td><td colspan="2">Menjadi pengawas penilaian dan evaluasi terhadap proses dan hasil belajar</td><td align="center"><?php echo $pakT04['lama'];?></td><td align="center"><?php echo $pakT04['ak_item'];?></td><td align="center"><?php echo $pakT04['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pakT04['jumlah'];
$jakutamalama = $jakutamalama + $pakT04['lama'];
$jakutamabaru = $jakutamabaru + $pakT04['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">10</td><td colspan="2">Membimbing guru pemula dalam program induksi</td><td align="center"><?php echo $pakT05['lama'];?></td><td align="center"><?php echo $pakT05['ak_item'];?></td><td align="center"><?php echo $pakT05['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pakT05['jumlah'];
$jakutamalama = $jakutamalama + $pakT05['lama'];
$jakutamabaru = $jakutamabaru + $pakT05['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5">11</td><td colspan="2">Membimbing siswa dalam kegiatan ekstrakurikuler</td><td align="center"><?php echo $pakT07['lama'];?></td><td align="center"><?php echo $pakT07['ak_item'];?></td><td align="center"><?php echo $pakT07['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pakT07['jumlah'];
$jakutamalama = $jakutamalama + $pakT07['lama'];
$jakutamabaru = $jakutamabaru + $pakT07['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5">12</td><td colspan="2">Menjadi pembimbing pada penyusunan publikasi ilmiah dan karya inovatif</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">13</td><td colspan="2">Melaksanakan pembimbingan pada kelas yang menjadi tanggungjawabnya (khusus Guru Kelas)</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td align="center" width="5">3</td><td colspan="4"><strong>PENGEMBANGAN KEPROFESIAN BERKELANJUTAN (PKB)</strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>A</td><td colspan="3">Melaksanakan pengembangan diri</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">1</td><td colspan="2">Mengikuti diklat fungsional</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Lamanya lebih dari 960 jam</td><td align="center"><?php echo $pak19['lama'];?></td><td align="center"><?php echo $pak19['ak_item'];?></td><td align="center"><?php echo $pak19['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak19['jumlah'];
$jakutamalama = $jakutamalama + $pak19['lama'];
$jakutamabaru = $jakutamabaru + $pak19['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Lamanya antara 641 s.d  960 jam</td><td align="center"><?php echo $pak20['lama'];?></td><td align="center"><?php echo $pak20['ak_item'];?></td><td align="center"><?php echo $pak20['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak20['jumlah'];
$jakutamalama = $jakutamalama + $pak20['lama'];
$jakutamabaru = $jakutamabaru + $pak20['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">c</td><td>Lamanya antara 481 s.d  640 jam</td><td align="center"><?php echo $pak21['lama'];?></td><td align="center"><?php echo $pak21['ak_item'];?></td><td align="center"><?php echo $pak21['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak21['jumlah'];
$jakutamalama = $jakutamalama + $pak21['lama'];
$jakutamabaru = $jakutamabaru + $pak21['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">d</td><td>Lamanya antara 181 s.d  480 jam</td><td align="center"><?php echo $pak22['lama'];?></td><td align="center"><?php echo $pak22['ak_item'];?></td><td align="center"><?php echo $pak22['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak22['jumlah'];
$jakutamalama = $jakutamalama + $pak22['lama'];
$jakutamabaru = $jakutamabaru + $pak22['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">e</td><td>Lamanya antara 81 s.d  180 jam</td><td align="center"><?php echo $pak23['lama'];?></td><td align="center"><?php echo $pak23['ak_item'];?></td><td align="center"><?php echo $pak23['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak23['jumlah'];
$jakutamalama = $jakutamalama + $pak23['lama'];
$jakutamabaru = $jakutamabaru + $pak23['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">f</td><td>Lamanya antara 30 s.d  80 jam</td><td align="center"><?php echo $pak24['lama'];?></td><td align="center"><?php echo $pak24['ak_item'];?></td><td align="center"><?php echo $pak24['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak24['jumlah'];
$jakutamalama = $jakutamalama + $pak24['lama'];
$jakutamabaru = $jakutamabaru + $pak24['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">2</td><td colspan="2">Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru </td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Lokakarya atau kegiatan bersama (seperti kelompok kerja guru) untuk penyusunan perangkat kurikulum dan atau pembelajaran</td><td align="center"><?php echo $pak25['lama'];?></td><td align="center"><?php echo $pak25['ak_item'];?></td><td align="center"><?php echo $pak25['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak25['jumlah'];
$jakutamalama = $jakutamalama + $pak25['lama'];
$jakutamabaru = $jakutamabaru + $pak25['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Keikutsertaan pada kegiatan ilmiah (seminar, koloqium dan diskusi panel)</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1) Menjadi pembahas pada kegiatan ilmiah</td><td align="center"><?php echo $pak26['lama'];?></td><td align="center"><?php echo $pak26['ak_item'];?></td><td align="center"><?php echo $pak26['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak26['jumlah'];
$jakutamalama = $jakutamalama + $pak26['lama'];
$jakutamabaru = $jakutamabaru + $pak26['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2) Menjadi peserta pada kegiatan ilmiah</td><td align="center"><?php echo $pak27['lama'];?></td><td align="center"><?php echo $pak27['ak_item'];?></td><td align="center"><?php echo $pak27['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak27['jumlah'];
$jakutamalama = $jakutamalama + $pak27['lama'];
$jakutamabaru = $jakutamabaru + $pak27['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">c</td><td>Kegiatan kolektif lainnya yang sesuai dengan tugas dan kewajiban guru</td><td align="center"><?php echo $pak28['lama'];?></td><td align="center"><?php echo $pak28['ak_item'];?></td><td align="center"><?php echo $pak28['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak28['jumlah'];
$jakutamalama = $jakutamalama + $pak28['lama'];
$jakutamabaru = $jakutamabaru + $pak28['ak_item'];
?>
<tr><td></td><td></td><td>B</td><td colspan="3">Melaksanakan publikasi ilmiah</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">1</td><td colspan="2">Presentasi pada forum ilmiah.</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Menjadi pemrasaran/nara sumber pada seminar atau lokakarya ilmiah</td><td align="center"><?php echo $pak29['lama'];?></td><td align="center"><?php echo $pak29['ak_item'];?></td><td align="center"><?php echo $pak29['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak29['jumlah'];
$jakutamalama = $jakutamalama + $pak29['lama'];
$jakutamabaru = $jakutamabaru + $pak29['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Menjadi pemrasaran/nara sumber pada koloqium atau diskusi ilmiah</td><td align="center"><?php echo $pak30['lama'];?></td><td align="center"><?php echo $pak30['ak_item'];?></td><td align="center"><?php echo $pak30['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak30['jumlah'];
$jakutamalama = $jakutamalama + $pak30['lama'];
$jakutamabaru = $jakutamabaru + $pak30['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">2</td><td colspan="2">Melaksanakan publikasi Ilmiah  hasil penelitian atau  gagasan ilmu pada bidang pendidikan formal.</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Membuat karya tulis berupa  laporan hasil penelitian pada bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan dalam bentuk buku ber ISBN dan diedarkan secara nasional atau telah lulus dari penilaian BNSP</td><td align="center"><?php echo $pak31['lama'];?></td><td align="center"><?php echo $pak31['ak_item'];?></td><td align="center"><?php echo $pak31['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak31['jumlah'];
$jakutamalama = $jakutamalama + $pak31['lama'];
$jakutamabaru = $jakutamabaru + $pak31['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Membuat karya tulis berupa  laporan hasil penelitian pada bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan dalam majalah/jurnal ilmiah tingkat nasional yang terakreditasi</td><td align="center"><?php echo $pak32['lama'];?></td><td align="center"><?php echo $pak32['ak_item'];?></td><td align="center"><?php echo $pak32['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak32['jumlah'];
$jakutamalama = $jakutamalama + $pak32['lama'];
$jakutamabaru = $jakutamabaru + $pak32['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">c</td><td>Membuat karya tulis berupa  laporan hasil penelitian pada bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan dalam majalah/jurnal ilmiah tingkat provinsi</td><td align="center"><?php echo $pak33['lama'];?></td><td align="center"><?php echo $pak33['ak_item'];?></td><td align="center"><?php echo $pak33['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak33['jumlah'];
$jakutamalama = $jakutamalama + $pak33['lama'];
$jakutamabaru = $jakutamabaru + $pak33['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">d</td><td>Membuat karya tulis berupa  laporan hasil penelitian pada bidang pendidikan di sekolahnya, diterbitkan/ dipublikasikan dalam majalah ilmiah tingkat kabupaten/ kota</td><td align="center"><?php echo $pak34['lama'];?></td><td align="center"><?php echo $pak34['ak_item'];?></td><td align="center"><?php echo $pak34['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak34['jumlah'];
$jakutamalama = $jakutamalama + $pak34['lama'];
$jakutamabaru = $jakutamabaru + $pak34['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">e</td><td>Membuat karya tulis berupa  laporan hasil penelitian pada bidang pendidikan di sekolahnya, diseminarkan di sekolahnya, disimpan di perpustakaan</td><td align="center"><?php echo $pak35['lama'];?></td><td align="center"><?php echo $pak35['ak_item'];?></td><td align="center"><?php echo $pak35['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak35['jumlah'];
$jakutamalama = $jakutamalama + $pak35['lama'];
$jakutamabaru = $jakutamabaru + $pak35['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">f</td><td>Membuat makalah  berupa  tinjauan  ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikannya, tidak diterbitkan,  disimpan di perpustakaan</td><td align="center"><?php echo $pak36['lama'];?></td><td align="center"><?php echo $pak36['ak_item'];?></td><td align="center"><?php echo $pak36['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak36['jumlah'];
$jakutamalama = $jakutamalama + $pak36['lama'];
$jakutamabaru = $jakutamabaru + $pak36['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">g</td><td>Membuat Tulisan Ilmiah Populer di bidang pendidikan formal dan pembelajaran pada satuan pendidikannya</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td width="5"></td><td width="5"></td><td>1)  Membuat Artikel Ilmiah Populer di bidang pendidikan formal dan pembelajaran pada satuan pendidikannya dimuat di media masa  tingkat nasional</td><td align="center"><?php echo $pak37['lama'];?></td><td align="center"><?php echo $pak37['ak_item'];?></td><td align="center"><?php echo $pak37['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak37['jumlah'];
$jakutamalama = $jakutamalama + $pak37['lama'];
$jakutamabaru = $jakutamabaru + $pak37['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2)  Membuat Artikel Ilmiah Populer di bidang  pendidikan formal dan pembelajaran pada satuan pendidikannya dimuat di media masa tingkat provinsi (koran daerah)</td><td align="center"><?php echo $pak38['lama'];?></td><td align="center"><?php echo $pak38['ak_item'];?></td><td align="center"><?php echo $pak38['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak38['jumlah'];
$jakutamalama = $jakutamalama + $pak38['lama'];
$jakutamabaru = $jakutamabaru + $pak38['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">h</td><td>Membuat  Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikannya</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1)  Membuat  Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada  satuan pendidikannya dan dimuat di jurnal  tingkat nasional yang terakreditasi</td><td align="center"><?php echo $pak39['lama'];?></td><td align="center"><?php echo $pak39['ak_item'];?></td><td align="center"><?php echo $pak39['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak39['jumlah'];
$jakutamalama = $jakutamalama + $pak39['lama'];
$jakutamabaru = $jakutamabaru + $pak39['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2)  Membuat  Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikannya dan dimuat di jurnal  tingkat nasional yang tidak terakreditasi / tingkat provinsi</td><td align="center"><?php echo $pak40['lama'];?></td><td align="center"><?php echo $pak40['ak_item'];?></td><td align="center"><?php echo $pak40['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak40['jumlah'];
$jakutamalama = $jakutamalama + $pak40['lama'];
$jakutamabaru = $jakutamabaru + $pak40['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>3)  Membuat Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada  satuan pendidikannya dan dimuat di jurnal tingkat lokal (kabupaten/kota/sekolah/ madrasah dstnya)</td><td align="center"><?php echo $pak41['lama'];?></td><td align="center"><?php echo $pak41['ak_item'];?></td><td align="center"><?php echo $pak41['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak41['jumlah'];
$jakutamalama = $jakutamalama + $pak41['lama'];
$jakutamabaru = $jakutamabaru + $pak41['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">3</td><td colspan="2">Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Membuat buku pelajaran per tingkat/buku pendidikan per judul:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1)  Buku  pelajaran yang lolos penilaian oleh BSNP</td><td align="center"><?php echo $pak42['lama'];?></td><td align="center"><?php echo $pak42['ak_item'];?></td><td align="center"><?php echo $pak42['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak42['jumlah'];
$jakutamalama = $jakutamalama + $pak42['lama'];
$jakutamabaru = $jakutamabaru + $pak42['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2)  Buku  pelajaran yang dicetak oleh penerbit  dan ber ISBN</td><td align="center"><?php echo $pak41['lama'];?></td><td align="center"><?php echo $pak43['ak_item'];?></td><td align="center"><?php echo $pak43['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak43['jumlah'];
$jakutamalama = $jakutamalama + $pak43['lama'];
$jakutamabaru = $jakutamabaru + $pak43['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>3)  Buku pelajaran dicetak oleh penerbit  tetapi  belum ber-ISBN</td><td align="center"><?php echo $pak44['lama'];?></td><td align="center"><?php echo $pak44['ak_item'];?></td><td align="center"><?php echo $pak44['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak44['jumlah'];
$jakutamalama = $jakutamalama + $pak44['lama'];
$jakutamabaru = $jakutamabaru + $pak44['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Membuat modul/diktat  pembelajaran per semester:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1)  Digunakan di tingkat  Provinsi dengan pengesahan dari Dinas Pendidikan Provinsi</td><td align="center"><?php echo $pak45['lama'];?></td><td align="center"><?php echo $pak45['ak_item'];?></td><td align="center"><?php echo $pak45['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak45['jumlah'];
$jakutamalama = $jakutamalama + $pak45['lama'];
$jakutamabaru = $jakutamabaru + $pak45['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2)  Digunakan di tingkat  kota/kabupaten dengan pengesahan dari Dinas Pendidikan Kota/Kabupaten</td><td align="center"><?php echo $pak46['lama'];?></td><td align="center"><?php echo $pak46['ak_item'];?></td><td align="center"><?php echo $pak46['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak46['jumlah'];
$jakutamalama = $jakutamalama + $pak46['lama'];
$jakutamabaru = $jakutamabaru + $pak46['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>3)  Digunakan di tingkat sekolah/madrasah setempat</td><td align="center"><?php echo $pak47['lama'];?></td><td align="center"><?php echo $pak47['ak_item'];?></td><td align="center"><?php echo $pak47['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak47['jumlah'];
$jakutamalama = $jakutamalama + $pak47['lama'];
$jakutamabaru = $jakutamabaru + $pak47['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">c</td><td>Membuat buku dalam bidang pendidikan:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1)  Buku dalam bidang pendidikan  dicetak oleh penerbit dan ber-ISBN</td><td align="center"><?php echo $pak48['lama'];?></td><td align="center"><?php echo $pak48['ak_item'];?></td><td align="center"><?php echo $pak48['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak48['jumlah'];
$jakutamalama = $jakutamalama + $pak48['lama'];
$jakutamabaru = $jakutamabaru + $pak48['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2)  Buku dalam bidang pendidikan dicetak oleh penerbit  tetapi  belum ber-ISBN</td><td align="center"><?php echo $pak49['lama'];?></td><td align="center"><?php echo $pak49['ak_item'];?></td><td align="center"><?php echo $pak49['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak49['jumlah'];
$jakutamalama = $jakutamalama + $pak49['lama'];
$jakutamabaru = $jakutamabaru + $pak49['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">d</td><td>Membuat karya hasil terjemahan yang dinyatakan oleh kepala sekolah/madrasah tiap karya</td><td align="center"><?php echo $pak50['lama'];?></td><td align="center"><?php echo $pak50['ak_item'];?></td><td align="center"><?php echo $pak50['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak50['jumlah'];
$jakutamalama = $jakutamalama + $pak50['lama'];
$jakutamabaru = $jakutamabaru + $pak50['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">e</td><td>Membuat buku pedoman guru</td><td align="center"><?php echo $pak51['lama'];?></td><td align="center"><?php echo $pak51['ak_item'];?></td><td align="center"><?php echo $pak51['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak51['jumlah'];
$jakutamalama = $jakutamalama + $pak51['lama'];
$jakutamabaru = $jakutamabaru + $pak51['ak_item'];
?>
<tr><td></td><td></td><td>C</td><td colspan="3">Melaksanakan karya inovatif.</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">1</td><td colspan="2">Menemukan teknologi tepat guna</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Kategori kompleks</td><td align="center"><?php echo $pak52['lama'];?></td><td align="center"><?php echo $pak52['ak_item'];?></td><td align="center"><?php echo $pak52['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak52['jumlah'];
$jakutamalama = $jakutamalama + $pak52['lama'];
$jakutamabaru = $jakutamabaru + $pak52['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Kategori sederhana</td><td align="center"><?php echo $pak53['lama'];?></td><td align="center"><?php echo $pak53['ak_item'];?></td><td align="center"><?php echo $pak53['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak53['jumlah'];
$jakutamalama = $jakutamalama + $pak53['lama'];
$jakutamabaru = $jakutamabaru + $pak53['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">2</td><td colspan="2">Menemukan / menciptakan karya seni</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Kategori kompleks</td><td align="center"><?php echo $pak54['lama'];?></td><td align="center"><?php echo $pak54['ak_item'];?></td><td align="center"><?php echo $pak54['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak54['jumlah'];
$jakutamalama = $jakutamalama + $pak54['lama'];
$jakutamabaru = $jakutamabaru + $pak54['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Kategori sederhana</td><td align="center"><?php echo $pak55['lama'];?></td><td align="center"><?php echo $pak55['ak_item'];?></td><td align="center"><?php echo $pak55['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak55['jumlah'];
$jakutamalama = $jakutamalama + $pak55['lama'];
$jakutamabaru = $jakutamabaru + $pak55['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5">3</td><td colspan="2">Membuat/modifikasi alat pelajaran/peraga/praktikum:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Membuat alat pelajaran:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1) Kategori kompleks</td><td align="center"><?php echo $pak56['lama'];?></td><td align="center"><?php echo $pak56['ak_item'];?></td><td align="center"><?php echo $pak56['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak56['jumlah'];
$jakutamalama = $jakutamalama + $pak56['lama'];
$jakutamabaru = $jakutamabaru + $pak56['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2) Kategori sederhana</td><td align="center"><?php echo $pak57['lama'];?></td><td align="center"><?php echo $pak57['ak_item'];?></td><td align="center"><?php echo $pak57['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak57['jumlah'];
$jakutamalama = $jakutamalama + $pak57['lama'];
$jakutamabaru = $jakutamabaru + $pak57['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Membuat alat peraga:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1) Kategori kompleks</td><td align="center"><?php echo $pak58['lama'];?></td><td align="center"><?php echo $pak58['ak_item'];?></td><td align="center"><?php echo $pak58['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak58['jumlah'];
$jakutamalama = $jakutamalama + $pak58['lama'];
$jakutamabaru = $jakutamabaru + $pak58['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2) Kategori sederhana</td><td align="center"><?php echo $pak59['lama'];?></td><td align="center"><?php echo $pak59['ak_item'];?></td><td align="center"><?php echo $pak59['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak59['jumlah'];
$jakutamalama = $jakutamalama + $pak59['lama'];
$jakutamabaru = $jakutamabaru + $pak59['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">c</td><td>Membuat alat praktikum:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>1) Kategori kompleks</td><td align="center"><?php echo $pak60['lama'];?></td><td align="center"><?php echo $pak60['ak_item'];?></td><td align="center"><?php echo $pak60['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak60['jumlah'];
$jakutamalama = $jakutamalama + $pak60['lama'];
$jakutamabaru = $jakutamabaru + $pak60['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5"></td><td>2) Kategori sederhana</td><td align="center"><?php echo $pak61['lama'];?></td><td align="center"><?php echo $pak61['ak_item'];?></td><td align="center"><?php echo $pak61['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak61['jumlah'];
$jakutamalama = $jakutamalama + $pak61['lama'];
$jakutamabaru = $jakutamabaru + $pak61['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">4</td><td colspan="2">Mengikuti Pengembangan Penyusunan Standar, Pedoman, Soal dan sejenisnya</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">a</td><td>Mengikuti Kegiatan  Penyusunan Standar/ Pedoman/ Soal dan sejenisnya pada tingkat nasional</td><td align="center"><?php echo $pak62['lama'];?></td><td align="center"><?php echo $pak62['ak_item'];?></td><td align="center"><?php echo $pak62['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak62['jumlah'];
$jakutamalama = $jakutamalama + $pak62['lama'];
$jakutamabaru = $jakutamabaru + $pak62['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"></td><td width="5">b</td><td>Mengikuti Kegiatan  Penyusunan Standar/ Pedoman/Soal dan sejenisnya pada tingkat provinsi</td><td align="center"><?php echo $pak63['lama'];?></td><td align="center"><?php echo $pak63['ak_item'];?></td><td align="center"><?php echo $pak63['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakutama = $jakutama + $pak63['jumlah'];
$jakutamalama = $jakutamalama + $pak63['lama'];
$jakutamabaru = $jakutamabaru + $pak63['ak_item'];
?>
<tr><td colspan="6" align="right"><strong>Jumlah Angka Kredit Unsur Utama</strong></td><td align="center"><?php echo round($jakutamalama,2);?></td><td align="center"><?php echo round($jakutamabaru,2);?></td><td align="center"><?php echo round($jakutama,3);?></td><td></td><td></td><td></td></tr>
<tr><td align="center" width="5">II</td><td colspan="5"><strong>UNSUR PENUNJANG</strong></td><td align="center"><?php echo $pakB02['lama'];?></td><td align="center"><?php echo $pakB02['ak_item'];?></td><td align="center"><?php echo $pakB02['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pakB02['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pakB02['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pakB02['ak_item'];
?>

<tr><td></td><td align="center" width="5">A</td><td colspan="4">Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampunya. <strong></strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>1</td><td colspan="3">Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampunya:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">a</td><td colspan="2">Doktor (S-3)</td><td align="center"><?php echo $pak64['lama'];?></td><td align="center"><?php echo $pak64['ak_item'];?></td><td align="center"><?php echo $pak64['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak64['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak64['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak64['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">b</td><td colspan="2">Pascasarjana (S-2)</td><td align="center"><?php echo $pak65['lama'];?></td><td align="center"><?php echo $pak65['ak_item'];?></td><td align="center"><?php echo $pak65['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak65['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak65['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak65['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">c</td><td colspan="2">Sarjana (S-1) / Diploma IV</td><td align="center"><?php echo $pak66['lama'];?></td><td align="center"><?php echo $pak66['ak_item'];?></td><td align="center"><?php echo $pak66['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak66['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak66['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak66['ak_item'];
?>

<tr><td></td><td align="center" width="5">B</td><td colspan="4">Melaksanakan kegiatan yang mendukung tugas guru<strong></strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>1</td><td colspan="3">Melaksanakan kegiatan yang mendukung tugas guru:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">a</td><td colspan="2">Membimbing siswa dalam praktik kerja nyata / praktik industri / ekstrakurikuler dan yang sejenisnya</td><td align="center"><?php echo $pak67['lama'];?></td><td align="center"><?php echo $pak67['ak_item'];?></td><td align="center"><?php echo $pak67['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak67['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak67['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak67['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">b</td><td colspan="2">Sebagai pengawas ujian penilaian dan evaluasi terhadap proses dan hasil belajar tingkat:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"> </td><td colspan="2">1)  sekolah</td><td align="center"><?php echo $pak68['lama'];?></td><td align="center"><?php echo $pak68['ak_item'];?></td><td align="center"><?php echo $pak68['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak68['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak68['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak68['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"> </td><td colspan="2">2)  nasional</td><td align="center"><?php echo $pak69['lama'];?></td><td align="center"><?php echo $pak69['ak_item'];?></td><td align="center"><?php echo $pak69['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak69['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak69['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak69['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">c</td><td colspan="2">Menjadi anggota organisasi profesi, sebagai:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td colspan="2">1)  Pengurus aktif</td><td align="center"><?php echo $pak70['lama'];?></td><td align="center"><?php echo $pak70['ak_item'];?></td><td align="center"><?php echo $pak70['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak70['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak70['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak70['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"> </td><td colspan="2">2)  Anggota aktif</td><td align="center"><?php echo $pak71['lama'];?></td><td align="center"><?php echo $pak71['ak_item'];?></td><td align="center"><?php echo $pak71['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak71['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak71['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak71['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">d</td><td colspan="2">Menjadi anggota kegiatan kepramukaan, sebagai:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5"></td><td colspan="2">1)  Pengurus aktif</td><td align="center"><?php echo $pak72['lama'];?></td><td align="center"><?php echo $pak72['ak_item'];?></td><td align="center"><?php echo $pak72['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak72['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak72['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak72['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5"> </td><td colspan="2">2)  Anggota aktif</td><td align="center"><?php echo $pak73['lama'];?></td><td align="center"><?php echo $pak73['ak_item'];?></td><td align="center"><?php echo $pak73['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak73['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak73['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak73['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">e</td><td colspan="2">Menjadi tim penilai angka kredit</td><td align="center"><?php echo $pak74['lama'];?></td><td align="center"><?php echo $pak74['ak_item'];?></td><td align="center"><?php echo $pak74['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak74['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak74['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak74['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5">f</td><td colspan="2">Menjadi tutor/pelatih/instruktur</td><td align="center"><?php echo $pak75['lama'];?></td><td align="center"><?php echo $pak75['ak_item'];?></td><td align="center"><?php echo $pak75['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak75['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak75['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak75['ak_item'];
?>
<tr><td></td><td align="center" width="5">C</td><td colspan="4">Perolehan penghargaan/tanda jasa<strong></strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>1</td><td colspan="3">Memperoleh Penghargaan/tanda jasa Satya Lancana Karya Satya</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td> </td><td width="5">1</td><td colspan="2">30 (tiga puluh) tahun</td><td align="center"><?php echo $pak76['lama'];?></td><td align="center"><?php echo $pak76['ak_item'];?></td><td align="center"><?php echo $pak76['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak76['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak76['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak76['ak_item'];
?>

<tr><td></td><td></td><td> </td><td width="5">2</td><td colspan="2">20 (dua puluh) tahun</td><td align="center"><?php echo $pak77['lama'];?></td><td align="center"><?php echo $pak77['ak_item'];?></td><td align="center"><?php echo $pak77['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak77['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak77['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak77['ak_item'];
?>
<tr><td></td><td></td><td> </td><td width="5">3</td><td colspan="2">10 (sepuluh) tahun</td><td align="center"><?php echo $pak78['lama'];?></td><td align="center"><?php echo $pak78['ak_item'];?></td><td align="center"><?php echo $pak78['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak78['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak78['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak78['ak_item'];
?>

<tr><td></td><td></td><td>2</td><td colspan="3">Memperoleh Penghargaan/tanda jasa</td><td align="center"><?php echo $pak79['lama'];?></td><td align="center"><?php echo $pak79['ak_item'];?></td><td align="center"><?php echo $pak79['jumlah'];?></td><td></td><td></td><td></td></tr>
<?php
$jakpenunjang = $jakpenunjang + $pak79['jumlah'];
$jakpenunjanglama = $jakpenunjanglama + $pak79['lama'];
$jakpenunjangbaru = $jakpenunjangbaru + $pak79['ak_item'];
$jaksemua = $jakutama + $jakpenunjang;
$jaksemualama = $jakutamalama + $jakpenunjanglama;
$jaksemuabaru = $jakutamabaru + $jakpenunjangbaru;
?>
<tr><td colspan="6" align="right"><strong>Jumlah Angka Kredit Unsur Penunjang</strong></td><td align="center"><?php echo round($jakpenunjanglama,2);?></td><td align="center"><?php echo round($jakpenunjangbaru,2);?></td><td align="center"><?php echo round($jakpenunjang,3);?></td><td></td><td></td><td></td></tr>
<tr><td colspan="6" align="right"><strong>Jumlah Angka Kredit Unsur Utama dan Unsur Penunjang</strong></td><td align="center"><?php echo round($jaksemualama,2);?></td><td align="center"><?php echo round($jaksemuabaru,2);?></td><td align="center"><?php echo round($jaksemua,3);?></td><td></td><td></td><td></td></tr>

<tr><td align="center" width="5">III</td><td colspan="5"><strong>LAMPIRAN PENDUKUNG DUPAK</strong></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td></td><td align="center" width="5">1</td><td colspan="4">Surat Pernyataan melakukan kegiatan pembelajaran/ pembimbingan dan tugas tambahan dan/atau tugas lain yang relevan dengan fungsi sekolah/madrasah</td><td colspan="6"></td></tr>
<tr><td></td><td align="center" width="5">2</td><td colspan="4">Surat Pernyataan melakukan kegiatan pengembangan keprofesian berkelanjutan</td><td colspan="6"></td></tr>
<tr><td></td><td align="center" width="5">3</td><td colspan="4">Surat Pernyataan melakukan kegiatan penunjang tugas guru</td><td colspan="6"></td></tr>
<tr><td align="center" width="5">IV</td><td colspan="11"><strong>CATATAN PEJABAT PENGUSUL </strong></td></tr>
<tr><td align="center" width="5"></td><td colspan="5"></td><td colspan="6"><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lokasi.',  '.date_to_long_string($datamasa['tanggal']);?><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala madrasah<br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo cari_kepala_baru($thnajaran,$semester).'<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP '.cari_nip_kepala_baru($thnajaran,$semester);?><br /><br /><br /><br /></td></tr>
<tr><td align="center" width="5">V</td><td colspan="11"><strong>CATATAN ANGGOTA TIM PENILAI</strong></td></tr>
<tr><td align="center" width="5"></td><td colspan="5"></td><td colspan="6"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..............................................<br /><br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..............................................<br /><br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP<br /><br /></td></tr>

<tr><td align="center" width="5">VI</td><td colspan="11"><strong>CATATAN KETUA TIM PENILAI</strong></td></tr>
<tr><td align="center" width="5"></td><td colspan="5"></td><td colspan="6"><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;..............................................<br /><br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP<br /><br /><br /><br /><br /></td></tr>

</table>
