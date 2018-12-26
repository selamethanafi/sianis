<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Sistem Informasi Madrasah Aliyah 
 *
 * Copyright (C) 2014  Selamet Hanafi (selamethanafi@yahoo.co.id)
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
<!--[if lt IE 7 ]><html class="ie ie6" lang="id"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="id"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="id"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="id"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Lupa Password - Madrasah Aliyah Negeri Tengaran Kabupaten Semarang</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="index,follow" />
<link rel="shortcut icon" href="/images/favicon.ico" /> 
<link rel="stylesheet" href="/css/brownie.css" type="text/css" />
</head>
<body>
<div class="container-fluid">
<h2>Lupa Kata Sandi</h2><br />
Pesan singkat akan segera terkirim tidak lebih dari 5 menit. Bila lebih dari 5 menit, layanan sms mungkin sedang mati. Silakan hubungi admin.<br />
<strong>Kode yang dimasukkan salah atau sudah tidak ada</strong>.
<form method="post" action="<?php echo base_url(); ?>index.php/situs/kirimsandi">
<table cellspacing="5">
<tr><td width="150"><h3>Kode pemulihan kata sandi</h3></td><td width="10">:</td><td><input type="text" name="kode_reset" class="textfield" size="30"></td></tr>

<tr><td></td><td></td><td><input type="submit" value="Proses" class="tombol-merah"></td></tr>
</table></form>
</div>
</html>
