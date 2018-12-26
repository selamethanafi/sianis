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
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>
<div class="container-fluid">
<?php
echo '<table width="100%">
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="75" alt="logo lembaga"> </td><td align="center">'.$this->config->item('baris1').'<br>'.$this->config->item('baris2').'<br>'.$this->config->item('baris3').'<br>'.$this->config->item('baris4').'</TD><TR>
</table>';

