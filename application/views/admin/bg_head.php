<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 02 Jan 2019 19:45:13 WIB 
// Nama Berkas 		: bg_head.php
// Lokasi      		: application/views/admin/
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
              <a class="navbar-brand" href="<?php echo base_url();?>admin">Beranda</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
            	<ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengguna <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/pengguna"> Pengguna </a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/guru"> Guru</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/bk"> BK</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/pegawai"> Pegawai</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/kepala"> Kepala</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/siswa"> Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/terdaftar"> Terdaftar</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/gurubk"> Guru BK</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/unggahpengguna"> Unggah Pengguna</a></li>
				</ul>
			
			</li>
			 <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Situs Web <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/pengaturan">Pengaturan </a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/tampilansitus">Tema Tampilan Situs</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/slide">Gambar Slide</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/agenda">Agenda</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/berita">Berita</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/polling">Jajak Pendapat</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/tutorial">Materi Pelajaran</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/pengumuman">Pengumuman</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/inbox">Pesan</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/profil">Profil</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/upload">Unggah Berkas </a></li>
				</ul>
			</li>
			 <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Telegram <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/chatid">Pengguna Telegram</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/chatidsiswa">Siswa Pengguna Telegram</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/telegramhariini">Telegram Keluar Hari Ini</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/telegram">Telegram Keluar</a></li>
				</ul>
			</li>

			 <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aplikasi Rapor Digital <b class="caret"></b></a>
				<ul class="dropdown-menu">
<?php
/*
					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/entity__category_subjects">entity__category_subjects</a></li>
*/
?>
					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/walikelas">Unduh Kode Kelas</a></li>

					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/formnilai">Unggah Nilai</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/formwalikelas">Unggah Catatan Walikelas</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/kirimnilaiharian">Kirim Nilai Harian</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/kirimnilaiakhir">Kirim Nilai Akhir</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>sinkronard/catatanwalikelas">Kirim Catatan Walikelas</a></li>
				</ul>
			</li>
<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lain - Lain <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>admin/namasiswa">Pemutakhiran Nama Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>admin/tautan">Daftar Tautan Penting</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>admin/kelompokmapel">Daftar Menu Kelompok Mapel di Laman</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>admin/mapel">Daftar Menu Materi Mapel di Laman</a></li>
				</ul>
			</li>
		</ul>
      <ul class="nav navbar-nav ml-auto">
        <li><a class="dropdown-item" href="<?php echo base_url();?>login/logout" data-confirm="Yakin hendak keluar?"> Keluar <span class="fa fa-sign-out-alt"></span></a></li>
      </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
</div>
<?php
}
?>

