<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 25 Agu 2017 13:38:01 WIB 
// Nama Berkas 		: telegram.php
// Lokasi      		: application/views/siswa/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$ta = $this->db->query("select `nis`,`chat_id`,`chat_id_valid` from `datsis` where `nis`='$nim'");
$chat_id = '';
$chat_id_valid = '';
foreach($ta->result() as $a)
{
	$chat_id = $a->chat_id;
	$chat_id_valid = $a->chat_id_valid;
}
if(empty($chat_id))
{
	echo 'Akun telegram Anda masih kosong, silakan menghubungi admin.';
}
else
{
	if($aksi == 'masukkankode')
	{
		echo 'Masukkan kode konfirmasi<br />';
		echo '<form class="form-horizontal" role="form" action="'.base_url().'siswa/telegram" method="post">';
		echo '<input type="hidden" name="chat_id" value="'.$chat_id.'"><input type="hidden" name="aksi" value="postkode"><input type="text" name="chat_id_valid" placeholder="masukkan kode"> <input type="submit" value="Kirim" class="btn btn-warning"></form>';
	}
	else
	{
		if(empty($chat_id_valid))
		{
			echo 'Akun telegram Anda belum dikonfirmasi. Kirim kode konfirmasi?<br />';
			echo '<form class="form-horizontal" role="form" action="'.base_url().'siswa/telegram" method="post">';
			echo '<input type="hidden" name="chat_id" value="'.$chat_id.'"><input type="hidden" name="aksi" value="kirimkonfirmasi" value="'.$chat_id.'"><input type="submit" value="Kirim Kode Konfirmasi ke Telegram" class="btn btn-warning"></form>';
		}
		elseif($chat_id_valid != 'Y')
		{
			echo 'Akun telegram Anda belum dikonfirmasi. Kirim kode konfirmasi?<br />';
			echo '<form class="form-horizontal" role="form" action="'.base_url().'siswa/telegram" method="post">';
			echo '<input type="hidden" name="chat_id" value="'.$chat_id.'"><input type="hidden" name="aksi" value="kirimkonfirmasi" value="'.$chat_id.'"><input type="submit" value="Kirim Kode Konfirmasi ke Telegram" class="btn btn-warning"></form>';
		}
		else
		{
			echo 'Akun telegram Anda sudah terkonfirmasi, <a href="'.base_url().'siswa/telegram/kirimulang">konfirmasi ulang</a>?';
		}
	}
}
//399167174
?>
</div></div></div>

