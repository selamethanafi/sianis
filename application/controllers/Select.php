<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
Class Select extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url'));
		$this->load->model('Model_select');
	}
	function index()
	{
		$data['provinsi']=$this->Model_select->provinsi();
		$this->load->view('view_select',$data);
	}
	function ambil_data()
	{
		$modul=$this->input->post('modul');
		$id=$this->input->post('id');
		if($modul=="kabupaten")
		{
			echo $this->Model_select->kabupaten($id);
		}
		else if($modul=="kecamatan")
		{
			echo $this->Model_select->kecamatan($id);
		}
		else if($modul=="kelurahan")
		{
			echo $this->Model_select->kelurahan($id);
		}
	}
}

