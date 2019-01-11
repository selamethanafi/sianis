<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$pesan = 'Masa tunggu login di '.$this->config->item('sek_website').' hari ini ini berakhir. Segera login.';
$ta = $this->db->query("select * from `tbllogin` where `next_login` like '$tanggal%'");
foreach($ta->result() as $a)
{
	$username = $a->username;
	$tb = $this->db->query("select `kd`,`chat_id` from `p_pegawai` where `kd`='$username'");
	foreach($tb->result() as $b)
	{
		$chat_id = $b->chat_id;
		if(!empty($chat_id))
		{
			$kirimpesan = kirimtelegram($chat_id,$pesan,$this->config->item('token_bot'));
		}
	}
}

