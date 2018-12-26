<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: adagalat.php
// Terakhir diperbarui	: Sel 26 Jan 2016 08:09:31 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Ada Galat Proses <?php echo $modul;?></h2>
<?php 
echo '<p><a href="'.$tautan_balik.'" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a></p>';
?>
<div class="alert alert-danger">
<?php echo $pesan;?>
</div>
</div>
