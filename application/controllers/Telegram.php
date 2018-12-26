<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Telegram extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('telegram');
		$this->load->database();

	}
	
	function index()
	{
/*
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$chat_id_grup_guru = '256939625';

		$pesan ='percobaan';
		$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
		echo $kirimpesan;
		$urlsms = 'https://sms.mantengaran.sch.id/action_post.php';
		$pesan = 'percobaan dari web';
		$nohp = '+6281212187658';
		$kirimpesan = postsms($urlsms,$nohp,$pesan);
		echo $kirimpesan;
*/
	}

}//akhir fungsi
?>
