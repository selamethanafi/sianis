<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : bg_bawah.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>

<div id="footer">
<div id="menubawah">
Control Panel Guru - Copyright &copy; <?php echo $this->config->item('sek_nama');?> <br />
Design by <a href="http://gedelumbung.co.cc" target="_blank">DLMBG</a> Maintened by <?php echo $this->config->item('maintainer');?>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
echo" || Anda berkunjung dengan IP Address $ip";
?><br /><br /><br />
</div></div>
</BODY>
</html>
