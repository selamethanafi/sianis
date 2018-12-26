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
<meta lang="id" />
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
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
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
	<nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url();?>tatausaha">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
                        	<li class="nav-item">
                        	    <a class="nav-link" href="<?php echo base_url();?>tatausaha/ubahpassword">Ubah Password <span class="sr-only"></span></a>
                        	</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laman
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/saran/tampil">Kotak Saran / Aduan </a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Surat
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/kodesurat">Kode Surat </a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/suratmasuk">Surat Masuk</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/suratkeluar">Surat Keluar</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/daftarsurat">Daftar Surat Masuk / Keluar</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pegawai
					</a>
					<ul class="dropdown-menu">
			                        <li><a class="dropdown-item dropdown-toggle" href="#">Data Pegawai</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/umum">Pribadi</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/umumdrh">Pribadi (format DRH)</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/keluarga">Keluarga</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pendidikan">Pendidikan</a>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/kepegawaian">Kepegawaian</a>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/diklat">Diklat / Kursus / Workshop / Seminar </a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/organisasi">Pengalaman Organisasi</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/tandajasa">Tanda Jasa</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/penelitian">Penelitian</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakrekap">Cetak SimPeg Kemenag</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/rekap">SimPeg Kemenag</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/emiss/unduhdata">Unduh Data Pegawai</a></li>
							</ul>
						</li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/mutasi">Mutasi Pegawai</a></li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">SKBK/SKMT </a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/nomorskbkskmt">Nomor SKBK SKMT</a></li>				
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pemeriksaanberkas">Pemeriksaan Berkas Pencairan TP</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/formcetakskbk">Cetak SKBK / SKMT / SK Aktif / Identitas</a></li>
							</ul>
						</li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">KP4 </a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/kpppp">Data KP4</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/formcetakkpppp">Cetak KP4</a></li>
							</ul>
						</li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">PKG / SKP / Supervisi</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pkgtahun">Tahun PKG /SKP</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pkgtimpenilai">TIM Penilai PKG / SKP </a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pejabatpenilaippk">Pejabat Penilai Prestasi Kerja </a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakpkg">Penilaian Kinerja Guru</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pkg">Penilaian Kinerja Guru #2</a></li>

								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakpkgtambahan">PKG dengan tugas tambahan</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakskp">Sasaran Kinerja Pegawai / Penilaian Prestasi Kerja</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakppkpns/perilaku">Penilaian Perilaku PNS</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unduhrekapppk">Unduh Rekap PPK</a></li>
							</ul>
						</li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakdatainti">Cetak Daftar Pegawai</a></li>

					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa
					</a>
					<ul class="dropdown-menu">
			                        <li><a class="dropdown-item dropdown-toggle" href="#">PPDB</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>ambilppdb">Unduh Data dari Web PPDB</a></li>

								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/tambahsiswapindahan">Tambah Siswa Pindahan</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/tambahsiswa">Tambah Siswa</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/impor">Unggah data PDB</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/impor/emiss">Unggah data Emiss</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/siswabaru">Daftar PDB</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/entrynilaisiswapindahan">Nilai Siswa Pindahan</a></li>

							</ul>
						</li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">Ekstrakurikuler</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/daftarekstra">Daftar Ekstrakurikuler</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/pengampuekstra2">Pengampu Ekstra</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/ekstrawajib/proses">Proses Peserta Ekstra Wajib</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/imporekstra">Impor Nilai Ekstra</a></li>
							</ul>
						</li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">Unduh Data</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unduhsiswakelas">Unduh Daftar Siswa per Kelas</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pesertatesdaring/v2">Unduh Data Peserta CBT</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pesertatesdaring/v1">Unduh Data Peserta UBK</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pesertatesdaring/v7">Unduh Data Peserta UBK BeeSmart</a></li>

								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pesertatesdaring/v6">Unduh Data Peserta UAMBNBK</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pesertatesdaring/v3">Unduh Data Kelas UBK</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/pesertabimtik">Unduh Peserta Bimbingan TIK</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/anggotaperpustakaan">Anggota Perpustakaan (excel)</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/anggotaperpustakaan/csv">Anggota Perpustakaan (csv)</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/kartuosis">Data Kartu OSIS</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/aim">Unduh Data AIM</a></li>

							</ul>
						</li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">LCK &amp; Nilai &amp; SKHUN &amp; Data Ijazah </a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/cetakbukurapor">Cetak Rapor</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/nilaipesertaun">Nilai Peserta UN</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/skhuns">Cetak SKHUN Sementara</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/nilaiakhir">Daftar Nilai Ijazah</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/nilaiakhirmapel">Daftar Nilai Ijazah Per Mapel</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/nilaiunijazah">Daftar Nilai UN untuk Ijazah</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/nilaiuambn">Daftar Nilai UAMBN</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/cetakfoto">Foto Siswa Per Kelas</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/cetakfoto/labelrapor">Label Nama untuk Map Rapor</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/dataijazah">Data Untuk Ijazah</a></li>

							</ul>
						</li>
			                        <li><a class="dropdown-item dropdown-toggle" href="#">Siswa Per Kelas / Penjurusan / Mutasi Massal / Kelulusan</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/penjurusan">Penjurusan / Mutasi Kenaikan Kelas</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/imporsiswakelas">Impor Siswa Per Kelas</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/siswakelas">Daftar Siswa Per Kelas</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unduhsiswakelas">Unduh Daftar Siswa Per Kelas</a></li>
								<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/kelulusan">Kelulusan</a></li>

							</ul>
						</li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/imporsiswa">Ubah Status Siswa </a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/daftarsiswakeluar">Daftar Siswa Keluar</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/carisiswa">Pencarian Data Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/statistik">Statistik</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ARD
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/emiss/siswaard">Unduh Data Siswa ARD</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unggahidsiswaard">Unggah Kode Siswa ARD</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/kirimdaftarsiswakelas">Kirim Daftar Siswa Kelas</a></li>

					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EMISS
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/mapelemiss">Daftar Mata Pelajaran Emiss</a></li>

						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/emiss/personal">Unduh Data Emiss Personal</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/emiss/siswa">Unduh Data Siswa Emiss</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unggahidsiswaemiss">Unggah ID Siswa dari Emiss</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/emiss/siswacsv">Unduh Calon Peserta UN</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SIMPATIKA
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unggahdatasiswapadamu">Unggah Kode Siswa PADAMU</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/siswapadamu">Unduh Data Siswa Untuk Padamu</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>tatausaha/unduhdata">Unduh Data PTK PADAMU</a></li>
					</ul>
				</li>

				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BOS
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>tatausaha/bos">Borang BOS</a></li>
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

