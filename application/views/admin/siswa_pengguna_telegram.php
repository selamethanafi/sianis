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
if($aksi == 'edit')
{
	$pengguna = balikin($pengguna);
	$query=$this->db->query("select `nis`,`nama`,`chat_id` from `datsis` where `nis`='$pengguna'");
	$adaq = $query->num_rows();
	if($adaq == 0)
	{
		echo '<div class="alert alert-warning">Galat! Pengguna tidak ditemukan.</div>';
	}
	else
	{
		foreach($query->result() as $c)
		{

			$namasiswa = $c->nama;
			$chat_id = $c->chat_id;
		}
		echo form_open('admin/updateidsiswatelegram','class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Username</label></div><div class="col-sm-9"><input type="text" name="nis" class="form-control" value="'.$pengguna.'" required readonly></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Siswa</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control"  value="'.$namasiswa.'" readonly</div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">ID Telegram</label></div><div class="col-sm-9"><input type="text" name="chat_id" value="'.$chat_id.'" class="form-control"></div></div>
		<p class="text-center"><input type="hidden" name="hal" class="form-control" value="'.$hal.'"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button> <a href="'.base_url().'admin/chatid" class="btn btn-info">BATAL</a></p></form>';
	}
}

else
{
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>ID Telegram</strong></td><td width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$b->nama.'</td><td><a href="https://api.telegram.org/bot'.$this->config->item('token_bot').'/sendMessage?chat_id='.$b->chat_id.'&text=hallo" target="_blank">'.$b->chat_id.'</a></td><td align="center"><a href="'.base_url().'admin/chatidsiswa/edit/'.$b->nis.'/'.$page.'" title="Edit"><span class="fa fa-edit"></span></a></td></tr>';
	$nomor++;
}
?>
</table></div>
<?php
if (!empty($paginator))
	{echo $paginator;}
}
?>
</div></div></div>
