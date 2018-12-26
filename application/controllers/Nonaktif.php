<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nonaktif extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	function index()
	{
	}
	function pkg()
	{
		$pkgbisa = $this->config->item('pkg');
		if($pkgbisa !='1')
		{
			echo 'PKG dinonaktifkan <a href="'.base_url().'login">Kembali</a>';
		}
		else
		{
			redirect('pkg');
		}
	}
}
?>
