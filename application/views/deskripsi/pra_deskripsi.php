<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: .php
// Lokasi      		: application/views/deskripsi/
// Terakhir diperbarui	: Min 06 Jan 2019 20:27:14 WIB 
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
echo 'mohon bersabar,  deskripsi sedang diproses. Klik kanan reload/refresh atau tekan tombol F5 kalau proses terhenti';
?>
<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>deskripsi/<?php echo $tautan;?>/<?php echo $penilaian;?>/<?php echo $id_mapel;?>/<?php echo $sumber;?>'; // the redirect goes here
},500);
			</script>
<?php
