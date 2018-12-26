<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 14 Mei 2016 10:38:49 WIB 
// Nama Berkas 		: bg_atas.php
// Lokasi      		: application/views/pegawai/
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
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

</head>
<body>
<?php
if(!isset($adamenu))
{
?>

<div class="container">
	<nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="<?php echo base_url();?>guru">Beranda</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
            	<ul class="nav navbar-nav">
		<li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">PRIBADI <b class="caret"></b></a>
		        <ul class="dropdown-menu">
			     <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
			         <ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>pegawai/umum">Pribadi</a><li>
					<li><a href="<?php echo base_url();?>pegawai/keluarga">Keluarga</a></li>
					<li><a href="<?php echo base_url();?>pegawai/pendidikan">Pendidikan</a></li>
					<li><a href="<?php echo base_url();?>pegawai/jabatan">Jabatan</a></li>
					<li><a href="<?php echo base_url();?>pegawai/kepegawaian">Kepegawaian</a></li>
					<li><a href="<?php echo base_url();?>pegawai/sertifikat">Diklat</a></li>
					<li><a href="<?php echo base_url();?>pegawai/organisasi">Organisasi</a></li>
					<li><a href="<?php echo base_url();?>pegawai/penelitian">Penelitian</a></li>
					<li><a href="<?php echo base_url();?>pegawai/tandajasa">Tanda Jasa</a></li>
					<li><a href="<?php echo base_url();?>pegawai/keluarnegeri">Pengalaman Ke Luar Negeri </a></li>
				</ul>
			   </li>
			   <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">SimPeg Kemenag <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>pegawai/ropegdrh">Cetak SimPEG Kemenag</a></li>
					<li><a href="<?php echo base_url();?>pegawai/ropegdrh">Daftar Riwayat Hidup</a></li>
					<li><a href="<?php echo base_url();?>pegawai/ropegalamat">Alamat</a></li>
					<li><a href="<?php echo base_url();?>pegawai/ketdiri">Keterangan Diri</a></li>
					<li><a href="<?php echo base_url();?>pegawai/ropegpendidikan">Pendidikan</a></li>
					<li><a href="<?php echo base_url();?>pegawai/pekerjaan">Pangkat Golong Jabatan</a></li>
					<li><a href="<?php echo base_url();?>pegawai/ropegnomor">Nomor nomor Kepegawaian</a></li>
					<li><a href="<?php echo base_url();?>pegawai/ropegkeluarga">Data Keluarga</a></li>
				</ul>
			    </li>
			    <li><a href="<?php echo base_url();?>pegawai/kpppp">KP4</a></li>
			</ul>
		</li>
		<li>
	    	<a href="<?php echo base_url();?>skptu/macam"  title="Menulis, mengubah, menghapus macam kegiatan skp">Daftar Kegiatan SKP </a></li>
		<li><a href="<?php echo base_url();?>skptu"  title="Menulis, mengubah, menghapus skp">SKP </a></li>
		<li><a href="<?php echo base_url();?>skptu/harian"  title="Menulis, mengubah, menghapus macam kegiatan skp">Harian</a></li>
		<li class="dropdown">
		     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
			<ul class="dropdown-menu">
                	<li><?php echo anchor('skptu/lkh', '<span class="glyphicon glyphicon-user"></span>Rekap Kegiatan Harian');?></li>
                	<li><?php echo anchor('skptu/lkb', '<span class="glyphicon glyphicon-user"></span>Laporan Bulanan');?></li>
                	<li><?php echo anchor('skptu/cetaktahunan', '<span class="glyphicon glyphicon-user"></span>Laporan Tahunan');?></li>
			</ul>
		</li>


		<li class="dropdown">
		     <a href="#" class="dropdown-toggle" data-toggle="dropdown">PORTAL <b class="caret"></b></a>
			<ul class="dropdown-menu">
			    <li><a href="<?php echo base_url();?>pegawai/berita"  title="Menulis, mengubah, menghapus berita di portal">Berita </a></li>
		  	    <li><a href="<?php echo base_url();?>pegawai/pengumuman"  title="Menulis, mengubah, menghapus pengumuan di portal">Pengumuman</a></li>
		  	    <li><a href="<?php echo base_url();?>pegawai/tutorial"  title="Menulis, mengubah, menghapus materi pelajaran di portal">Materi Pelajaran</a></li>
		  	    <li><a href="<?php echo base_url();?>pegawai/upload"  title="Mengunggah, mengubah data unggahan">Unggah</a></li>
		  	    <li><a href="<?php echo base_url();?>pegawai/inbox"  title="Melihat, mengirim, menjawab pesan">Pesan</a></li>
		  	    <li><a href="<?php echo base_url();?>pegawai/pesanmassalsiswa"  title="Mengirim pesan massal ke siswa">Kirim Pesan Massal Siswa</a></li>
  			    <li><a href="<?php echo base_url(); ?>situs/pesanadmin" title="Mengirim pesan ke Admin" onclick="return hs.htmlExpand(this, { objectType: 'iframe' } )">Kirim Pesan ke Admin</a></li>
			</ul>
		</li>
		<li><a href="<?php echo base_url(); ?>">Laman</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		      <li><a href="<?php echo base_url();?>login/logout"><span class="glyphicon glyphicon-log-out"></span> Keluar </a></li>
		      <li><span class="glyphicon"></span></li>
		</ul>		
            </div><!-- /.navbar-collapse -->
        </nav>
</div>
<?php
}
?>
