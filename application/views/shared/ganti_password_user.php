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
<style>
body{
	background-image:url(/images/bg-body.jpg);
	background-repeat:repeat-x;
	background-attachment:fixed;
	background-position:bottom;
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
}
h2{
	font-size:15px;
	padding:0px;
	margin:0px;
	font-weight:bold;
	color:#666666;
}
h3{
	font-size:12px;
	padding:0px;
	margin:0px;
	font-weight:normal;
	color:#666666;
}
.tombol{
background-color:#EEFAFF;
border:1px solid #DDDDDD;
font-size:11px;
color:#666666;
font-weight:bold;
}
.textfield{
background-color:#EEFAFF;
-moz-border-radius:4px;
-khtml-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius:4px;
font-size:12px;
font-family:Arial;
}
</style>
<h2>Ganti Password</h2><br />

<form method="post" action="<?php echo base_url(); ?>index.php/situs/updatepassworduser">
<table cellspacing="5">
<tr><td width="150"><h3>Nomor Seluler</h3></td><td width="10">:</td><td><input type="text" name="noseluler" readonly="readonly" value="<?php echo $noseluler; ?>" class="textfield" size="30"></td></tr>
<tr><td width="150"><h3>Password Baru</h3></td><td width="10">:</td><td><input type="password" name="pwd" class="textfield" size="30"></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Ganti Password" class="tombol"></td></tr>
</table></form>
