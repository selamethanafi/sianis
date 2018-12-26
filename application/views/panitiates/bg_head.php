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
                <a class="navbar-brand" href="<?php echo base_url();?>panitiates">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
                        	<li class="nav-item">
                        	    <a class="nav-link" href="<?php echo base_url();?>panitiates/ubahpassword">Ubah Password <span class="sr-only"></span></a>
                        	</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/siswa">Pencarian Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/siswakelas">Daftar Siswa</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengaturan Tes
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/namates">Nama Tes</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/unduhsiswa">Unduh Daftar Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/imporsiswa">Unggah Daftar Siswa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/imporlabel">Unggah Data Label</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/urutankelas">Urutan Kelas</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/ruangtes">Pengaturan Ruang Tes</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/denahtempatduduk">Pengaturan Tempat Duduk</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/unggahjadwal">Unggah Gambar Jadwal Tes</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pencetakan
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/cetakkartu">Kartu Per Kelas</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/cetakkartu2">Kartu Daring Per Kelas</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/kartutes">Kartu Perorangan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/jadwal">Jadwal Ulangan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/cetaknominasi">Nominasi</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/cetakdenahtempatduduk">Denah Tempat Duduk</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/cetaklabel">Label Amplop / Tas / Map</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/kartusementara">Kartu Sementara</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>panitiates/kartuubk">Kartu Tes Daring</a></li>
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

