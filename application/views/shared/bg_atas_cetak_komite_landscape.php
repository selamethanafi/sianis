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
<div class="landscape">
<?php
echo '<table width="100%">
<tr><td align="center">';
if(!empty($baris1))
{
	echo $baris1.'<br>';
}
if(!empty($baris2))
{
	echo $baris2.'<br>';
}
if(!empty($baris3))
{
	echo $baris3.'<br>';
}
if(!empty($baris4))
{
	echo $baris4;
}
echo '</td></tr>
</table>';

