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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if($aksi == 'kirim')
{
}
else
{
	?>
	<a href="<?php echo base_url(); ?>admin/telegram/kirim" class="btn btn-info"> <span class="fa fa-plus"></span><b> Kirim Telegram</b></a><p></p>
	<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>ID Telegram</strong></td><td><strong>Pesan</strong></td><td><strong>Waktu</strong></td><td><strong>Status</strong></td><td width="50"><strong>Aksi</strong></td></tr>
	<?php
	$nomor=$page+1;
	foreach($query->result() as $b)
	{
		$chat_id = $b->chat_id;
		$chat_user = '';
		if($chat_id == $this->config->item('chat_id_grup_guru'))
		{
			$chat_user = 'Grup Guru';
		}
		if(empty($chat_user))
		{
			if($chat_id == $this->config->item('chat_id_grup_siswa'))
			{
				$chat_user = 'Grup Siswa';
			}
		}
		if(empty($chat_user))
		{
			$ta = $this->db->query("select `nama`,`chat_id` from `p_pegawai` where `chat_id` = '$chat_id'");
			foreach($ta->result() as $a)
			{
				$chat_user = $a->nama;
			}
		}
		if(empty($chat_user))
		{
			$ta = $this->db->query("select `nama`,`idlink` from `tbllogin` where `idlink` = '$chat_id'");
			foreach($ta->result() as $a)
			{
				$chat_user = $a->nama;
			}
		}

		if(empty($chat_user))
		{
			$ta = $this->db->query("select `nama`,`chat_id` from `datsis` where `chat_id` = '$chat_id'");
			foreach($ta->result() as $a)
			{
				$chat_user = $a->nama;
			}
		}
		if(empty($chat_user))
		{
			$chat_user = $chat_id;
		}
			$terkirim = '<p class="text-danger">gagal terkirim</p>';
		if($b->terkirim == 1)
		{
			$terkirim = '<p class="text-success">terkirim</p>';
		}
        	$link_hapus = anchor('admin/telegram/hapus/'.cegah($b->waktu),'<span class="fa fa-trash-alt"></span>', array('title' => 'Hapus', 'data-confirm' => 'Anda yakin akan menghapus data ini?'));
		echo "<tr><td>".$nomor."</td><td>".$chat_user."</td><td>".$b->pesan."</td><td>".tanggal($b->waktu)."</td>";
		echo "<td align=\"center\">".$terkirim."</a></td><td align=\"center\">".$link_hapus."</a></td></tr>";
		$nomor++;
	}
	?>
	</table></div>
	<?php
	if (!empty($paginator))
	{
		echo $paginator;
	}
}
?>
</div></div></div>
