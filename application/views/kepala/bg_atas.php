<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 17 Jan 2016 09:22:49 WIB 
// Nama Berkas 		: bg_atas.php
// Lokasi      		: application/views/kepala/
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

/**
 * Sistem Informasi Madrasah Aliyah 
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
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
                <a class="navbar-brand" href="<?php echo base_url();?>guru">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Perangkat <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
				    	<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/perangkat" title="Melihat perangkat guru ">Perangkat Guru</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/perangkattambahan" title="Melihat perangkat guru mendapat tugas tambahan ">Perangkat Guru Tugas Tambahan</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/akreditasi" title="Melihat perangkat akreditasi ">Perangkat Akreditasi</a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SKP <b class="caret"></b></a>
			        <ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/perilaku" title="Melihat, menilai perilaku PNS">Penilaian SKP</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/periksaskp" title="Memeriksa skp">Pemeriksaan SKP</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/statusppk" title="Status Proses PPK">Status PPK</a></li>

					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala/bukuperilaku" title="Melihat, menilai perilaku PNS">Buku Perilaku PNS</a></li>

				</ul>
			</li>
		</ul>
      <ul class="nav navbar-nav ml-auto">
        <li><a href="<?php echo base_url();?>login/logout" data-confirm="Yakin hendak keluar?"> Keluar <span class="fa fa-sign-out-alt"></span></a></li>
      </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
</div>
<?php
}
?>

