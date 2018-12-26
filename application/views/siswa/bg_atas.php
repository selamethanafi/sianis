<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 14 Mei 2016 10:38:49 WIB 
// Nama Berkas 		: bg_atas.php
// Lokasi      		: application/views/siswa/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 Sianis
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
                <a class="navbar-brand" href="<?php echo base_url();?>siswa">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
                        	<li class="nav-item">
                        	    <a class="nav-link" href="<?php echo base_url();?>siswa/sandi">Ubah Password <span class="sr-only"></span></a>
                        	</li>
                        	<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url();?>siswa/telegram">Telegram</a>
                        	</li>

				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nilai
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/rapor">Rapor / LHB / LCK</a></li>
					    	<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/nilai">Nilai Kognitif</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/psikomotor">Nilai Psikomotor</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/afektif">Nilai Afektif</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/hambatan">Hambatan Belajar</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/statusnilai">Status Nilai</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/analisis">Proses Penilaian Ulangan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/nilaiujiannasional">Nilai Ujian Nasional</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kepribadian
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/data">Data Pribadi</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/nilai_akhlak">Nilai Kepribadian</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/ketidakhadiran">Ketidakhadiran</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/angkakredit">Angka Kredit</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/ekstrakurikuler">Ekstrakurikuler</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/keuangan">Keuangan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/penilaiandiri">Penilaian Diri</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/penilaianantarteman">Penilaian Antarteman</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/hasilpenilaiandiri">Hasil Penilaian Diri</a></li>

					</ul>
				</li>
				<li class="nav-item dropdown">
		                	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pesan
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/inbox">Kotak Masuk</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>siswa/pesanguru">Mengirim Pesan ke Guru</a></li>
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

