<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pengguna.php
// Lokasi      		: application/views/admin
// Terakhir diperbarui	: Sen 11 Apr 2016 05:24:39 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<a href="<?php echo base_url(); ?>admin/pengguna/tambah" class="btn btn-info"> <span class="fa fa-plus"></span><b> Pengguna</b></a><p></p>

<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Nama Pengguna</strong></td><td><strong>Hak Akses Pengguna</strong></td><td><strong>Next Login</strong></td><td><strong>Chat ID</strong></td><td colspan="2" width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($tampilsemua->result() as $b)
{
if ($b->nama=='Administrator')
	{
	echo "<tr><td>".$nomor."</td><td>".$b->nama."</td><td>".$b->username."</td><td>".$b->status."</td><td></td><td></td><td align=\"center\"></td></tr>";
	}
	else
	{
		if($b->status == 'PA')
		{
			$chat_id = '';
			$username = $b->username;
			$ta = $this->db->query("select `kd`,`chat_id` from `p_pegawai` where `kd`='$username'");
			foreach($ta->result() as $a)
			{
				$chat_id = $a->chat_id;
			}
			$link_aktif = anchor('admin/terdaftar/'.cegah($b->username).'/'.$chat_id,'<span class="fa fa-edit"></span>', array('title' => 'Aktifkan', 'data-confirm' => 'Anda yakin akan mengaktifkan '.$b->username.'?'));
			$link_hapus = anchor('admin/hapuspengguna/'.cegah($b->username),'<span class="fa fa-trash-alt"></span>', array('title' => 'Hapus akun', 'data-confirm' => 'Anda yakin akan menghapus '.$b->username.'?'));
			echo '<tr><td>'.$nomor.'</td><td>'.$b->nama.'</td><td>'.$b->username.'</td><td>Guru</td><td align="center">'.$b->next_login.'</td><td align="center"><a href="https://api.telegram.org/bot'.$this->config->item('token_bot').'/sendMessage?chat_id='.$chat_id.'&text=halo" target="_blank" title="kirim pesan via telegram">'.$chat_id.'</a></td><td align="center">'.$link_aktif.'</td><td align="center">'.$link_hapus.'</td></tr>';
		}
		elseif($b->status == 'BP')
		{
			$chat_id = $b->idlink;
			$link_aktif = anchor('admin/terdaftar/'.cegah($b->username).'/'.$chat_id,'<span class="fa fa-edit"></span>', array('title' => 'Aktifkan', 'data-confirm' => 'Anda yakin akan mengaktifkan '.$b->username.'?'));
			$link_hapus = anchor('admin/hapuspengguna/'.cegah($b->username),'<span class="fa fa-trash-alt"></span>', array('title' => 'Hapus akun', 'data-confirm' => 'Anda yakin akan menghapus '.$b->username.'?'));
			echo '<tr><td>'.$nomor.'</td><td>'.$b->nama.'</td><td>'.$b->username.'</td><td>BK</td><td align="center">'.$b->next_login.'</td><td align="center"><a href="https://api.telegram.org/bot'.$this->config->item('token_bot').'/sendMessage?chat_id='.$chat_id.'&text=halo" target="_blank" title="kirim pesan via telegram">'.$chat_id.'</span></a></td><td align="center">'.$link_aktif.'</td><td align="center">'.$link_hapus.'</td></tr>';
		}
		else
		{
			$link_aktif = anchor('admin/terdaftar/'.cegah($b->username),'<span class="fa fa-edit"></span>', array('title' => 'Aktifkan', 'data-confirm' => 'Anda yakin akan mengaktifkan '.$b->username.'?'));
			$link_hapus = anchor('admin/hapuspengguna/'.cegah($b->username),'<span class="fa fa-trash-alt"></span>', array('title' => 'Hapus akun', 'data-confirm' => 'Anda yakin akan menghapus '.$b->username.'?'));
			echo '<tr><td>'.$nomor.'</td><td>'.$b->nama.'</td><td>'.$b->username.'</td><td>'.$b->status.'</td><td align="center">'.$b->next_login.'</td><td align="center"></td><td align="center">'.$link_aktif.'</td><td align="center">'.$link_hapus.'</td></tr>';
		}
	}

$nomor++;
}
?>
</table></div>
</div>
