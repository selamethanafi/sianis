<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: sukses.php
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
echo 'SELESAI';
if($asal == 'mapel')
{
	echo '<br />Tutup jendela ini. Tombol ctrl w bisa digunakan untuk menutup';
}
else
{
	?>
	<script>setTimeout(function () {
	   window.location.href= '<?php echo base_url();?>guru/nilai'; // the redirect goes here
	},1000);
		</script>
<?php
}
