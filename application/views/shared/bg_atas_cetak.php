<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bg_atas_cetak.php
// Lokasi      		: application/views/shared/
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/table.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>
<div class="potret">
<?php
echo '<table width="100%">
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="75" alt="logo lembaga"> </td><td align="center">';
if(!empty($baris1))
{
	echo $baris1;
}
if(!empty($baris2))
{
	echo '<br>'.$baris2;
}
if(!empty($baris3))
{
	echo '<br>'.$baris3;
}
if(!empty($baris4))
{
	echo '<br>'.$baris4;
}
if(!empty($baris5))
{
	echo '<br>'.$baris5;
}
echo '</TD><TR>
</table>';

