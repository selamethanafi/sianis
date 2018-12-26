<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 14 Mei 2016 10:38:49 WIB 
// Nama Berkas 		: bg_atas.php
// Lokasi  		: application/views/guru/
// Author  		: Selamet Hanafi
// 		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//   MAN Tengaran
//   www.mantengaran.sch.id
//   admin@mantengaran.sch.id
//
// License:
//Copyright (C) 2014 MAN Tengaran
//Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9"  class="ie"lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"lang="en-US">
<![endif]-->
<!-- This doesn't work but i prefer to leave it here... maybe in the future the MS will support it... i hope... -->
<!--[if IE 10]>
<html id="ie10"  class="ie"lang="en-US">
<![endif]-->
<!--[if !IE]>
<html lang="en-US">
<![endif]-->
<!-- START HEAD -->
<head>
<meta charset="UTF-8" />
<!-- this line will appear only if the website is visited with an iPad -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
<title><?php echo $judulhalaman;?></title>
<?php
	$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
	<?php
	}
	else
	{
		$temacss = '';
		$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
		foreach($ta->result() as $a)
		{
			$temacss = $a->temacss;
		}
		if(!empty($temacss))
		{?>
		<link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
		}
		else
		{?>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
		<?php
		}

	}

 ?>
    <link rel="stylesheet" href="<?php echo base_url();?>css/teks.css">		
    <link href="/assets/css/bootstrap-4-navbar.css" rel="stylesheet">
    <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

</head>
<body>
<?php
if(!isset($adamenu))
{
?>

<div class="container-fluid">
 <!-- Static navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url();?>pengajaran">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>pengajaran/ubahpassword">Ubah Password <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Referensi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/tapel"> Tahun Pelajaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/jurusan"> Program/Jurusan/Minat</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/kelas"> Kelas</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/kepala"> Kepala</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/walikelas"> Wali Kelas</a></li>	
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/konversinilai"> Konversi Nilai</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/tahunpenilaianujiannasional"> Tahun Penilaian untuk Nilai Sekolah</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unggahlogolck"> Unggah Logo Latar LCK / LHB</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/penyesuaiankelassiswa"> Penyesuaian Kelas Siswa</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mata Pelajaran
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/matapelajaran"> Daftar Mata Pelajaran</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/matapelajaranujiannasional"> Daftar Mata Pelajaran Ujian Nasional</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/mapeluambn"> Daftar Mata Pelajaran UAMBN</a></li>

					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/mapelrapor"> Daftar Mata Pelajaran Rapor</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/mapelijazah"> Daftar Mata Pelajaran Ijazah</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Guru
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/mapelperruang">Pembagian Tugas Guru</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/gurutik">Pembagian Tugas Guru TIK</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/piket">Pembagian Tugas Guru Piket</a></li>
                            </ul>
                        </li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nilai
                            </a>
			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li><a class="dropdown-item dropdown-toggle" href="#">Rapor <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/belumkompeten">Kenaikan Kelas</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/peringkat">Proses Peringkat Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/peringkatparalel">Lihat Peringkat Paralel Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/melihatnilai">Nilai per Mapel</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/melihatnilaisiswa">Nilai Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/statusnilai">Pemutakhiran Ketuntasan Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/periksanilairapor">Memeriksa Nilai Rapor Tiap Guru</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/periksanilairapormapel">Memeriksa Nilai Rapor Tiap Mapel</a></li>

						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/sikapspiritual">Memeriksa Sikap Spritual dan Sikap Sosial Rapor</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/ratarapor">Rata rata Nilai Rapor</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/rataraporpermapel">Melihat Rata rata Nilai Rapor</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unduhnilai">Unduh Nilai</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unggahnilai">Unggah Nilai</a></li>

					</ul>
			    	</li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/statistik">Statistik UH/MID/UAS/UKK </a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/lihatnilai">Lihat Nilai</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/lihatsemuanilai">Lihat Nilai Siswa Kelas XII</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/hapusnilaisiswa">Hapus Nilai Siswa </a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/leger2">Unduh Leger Nilai </a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unduhnilairapor">Unduh Nilai</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/tampillegerijazah">Leger Nilai Ijazah</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mencetak Rapor / Mid  <b class="caret"></b></a>

			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/cetakmid">Mencetak Hasil UTS</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/cetakrapor">Rapor Ringkas</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/cetakbukurapor">Buku Rapor</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ujian Akhir  <b class="caret"></b></a>
			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li><a class="dropdown-item dropdown-toggle" href="#">Ujian <?php echo $this->config->item('sek_tipe');?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/entrynilaiuambn">Entry Hasil UAMBN</a></li>

						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/nilaium">Lihat Hasil Ujian Madrasah</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/nilaiuambn">Lihat Hasil UAMBN</a></li>	
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unduhnilaiuambn">Unduh Hasil UAMBN</a></li>	
					</ul>
				</li>
				<li><a class="dropdown-item dropdown-toggle" href="#">Ujian Nasional <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unggahnomorpesertaun">Unggah Nomor Peserta UN</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/unggahnilaiakhir">Unggah Nilai Akhir</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/siswabelumtuntas">Siswa Belum Tuntas </a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/ceknilaisiswa">Cek Nilai Siswa Tiap Kelas</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/nilaiun">Rekap Nilai Persiapan UN</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/nilaipesertaun">Unduh Nilai Peserta UN</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>pengajaran/nilaiujiannasional">Entry Hasil Ujian Nasional</a></li>
					</ul>
				</li>
			    </ul>
			</li>
                    </ul>
      <ul class="nav navbar-nav ml-auto">
        <li><a href="<?php echo base_url();?>login/logout" data-confirm="Yakin hendak keluar?"> Keluar <span class="fa fa-sign-out-alt"></span></a></li>
      </ul>

                </div>
            </nav>
</div>
<?php
}
?>
