<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 16 Mei 2016 10:47:52 WIB 
// Nama Berkas 		: bg_atas.php
// Lokasi      		: application/views/bp/
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
		if(empty($temacss))
		{?>
		    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
		<?php
		}
		else
		{?>
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
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
<div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
              <a class="navbar-brand" href="<?php echo base_url();?>admin">Beranda</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
            	<ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Siswa <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url(); ?>bp/carisiswa">Pencarian Siswa</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>bp/siswakelas">Siswa tiap kelas</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>bp/unduhsiswakelas">Unduh Data Siswa Tiap Kelas</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>bp/penjurusan">Penjurusan / Mutasi / Kenaikan Kelas</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url(); ?>bp/penerimabsm">Daftar Penerima BSM/PIP</a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ketertiban <b class="caret"></b></a>
		       		<ul class="dropdown-menu">
				      <li><a class="dropdown-item" href="<?php echo base_url();?>bp/daftarkredit">Macam Pelanggaran</a></li>
				      <li><a class="dropdown-item" href="<?php echo base_url();?>bp/siswaizin">Siswa Mengajukan Izin</a></li>
				      <li><a class="dropdown-item dropdown-toggle" href="#">Ketidakhadiran Siswa <b class="caret"></b></a>
				         <ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>bp/ketidakhadiran">Pencatatan Ketidakhadiran #1</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/ketidakhadiransiswa">Pencatatan Ketidakhadiran #2</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/unduhketidakhadiran">Unduh Ketidakhadiran Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/unggahketidakhadiran">Unggah Ketidakhadiran Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/daftarabsen">Daftar Ketidakhadiran Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/rekapharian">Rekap Ketidakhadiran Harian</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/rekapkelas">Rekap Ketidakhadiran Per Kelas</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/kirimhadirrapor">Kirim Rekap Ketidakhadiran ke LHB</a></li>
				</ul>
			   </li>
			   <li><a class="dropdown-item dropdown-toggle" href="#">Pelanggaran Tata Tertib <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/kredit">Pencatatan Pelanggaran Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/kreditperkelas">Rekapitulasi Kredit Per Kelas</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/carisiswa">Rekapitulasi Kredit Pelanggaran Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/kreditharian">Daftar Pelanggaran tanggal tertentu</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>bp/carisiswa">Penanganan Pelanggaran</a></li>
				</ul>
			    </li>
			</ul>
		</li>
		<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laporan <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/carisiswa">Rekapitulasi Ketidakhadiran Siswa</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/rekapbulanan">Rekapitulasi Ketidakhadiran Siswa Per Bulan</a></li>
			</ul>
		</li>

		<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RAPOR <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/rujukan">Referensi Sikap Spiritual dan Sosial</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/sikap">Penilai Sikap Kurikulum 2013</a></li>		
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/akhlak">Penilaian Akhlak dan Kepribadian Mulia</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/nilaiakhlak">Kirim Penilaian Akhlak dan Kepribadian Mulia</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/nilaispiritualantarmapel">Kirim Penilaian Sikap Spiritual dan Sosial Antarmapel</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/kirimhadirrapor">Kirim Rekap Ketidakhadiran ke LHB</a></li>
			</ul>
		</li>
		<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SNMPTN <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/nisn">NISN</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/mapel">Daftar Mapel untuk PDSS</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/kkmmapel">Daftar KKM Mapel untuk PDSS</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/unduhnilai">Unduh Nilai</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/unduhsemuanilai">Unduh Semua Nilai </a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>bp/peringkatparalel">Peringkat Paralel Siswa</a></li>
			</ul>
		</li>
		</ul>
	       <ul class="nav navbar-nav ml-auto">
		        <li><a class="dropdown-item" href="<?php echo base_url();?>login/logout" data-confirm="Yakin hendak keluar?"> Keluar <span class="fa fa-sign-out-alt"></span></a></li>
      		</ul>
            </div><!-- /.navbar-collapse -->
        </nav>
</div>
