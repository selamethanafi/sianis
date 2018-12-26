<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: telegram_helper.php
// Lokasi      		: application/helpers
// Terakhir diperbarui	: Sab 19 Agu 2017 17:21:11 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               selamet hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 selamet hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
// ------------------------------------------------------------------------
/**
 * Fungsi - Fungsi Helpers
 * 
 * @author		Selamet Hanafi
 */
// ------------------------------------------------------------------------
if ( ! function_exists('kirimtelegram'))
{
	function kirimtelegram($chat_id,$pesan,$token_bot) 
	{

		$CI =& get_instance();
		$website="https://api.telegram.org/bot".$token_bot;
		$params=[
			    'chat_id'=>$chat_id,
			    'text'=>$pesan,
			];
		$ch = curl_init($website . '/sendMessage');
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$debug['respon'] = json_decode($result, true);
		$respontelegram = $debug['respon']['ok'];
		if(!$respontelegram)
		{
			$respontelegram = NULL;
		}
		$CI->db->query("insert into `telegram` (`chat_id`,`pesan`, `terkirim`) values ('$chat_id','$pesan','$respontelegram')");
		return $respontelegram;
  	}
}
if ( ! function_exists('postsms'))
{
	function postsms($urlsms,$nohp,$pesan) 
	{
		$params=[
			    'nohp'=>$nohp,
			    'pesan'=>$pesan,
			];
		$ch = curl_init($urlsms);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
  	}
}
if ( ! function_exists('posttahunan'))
{
	function posttahunan($urlsieka,$tahun,$kegiatan,$target,$satuan,$target_penyelesaian) 
	{
		$params=[
			    'tahun'=>$tahun,'kegiatan'=>$kegiatan,'target'=>$target, 'satuan'=>$satuan, 'target_penyelesaian'=>$target_penyelesaian,
			];
		$ch = curl_init($urlsms);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
  	}
}

// ------------------------------------------------------------------------


/* End of file fungsi_helper.php */
/* Location: application/helpers/telegram_helper.php */
