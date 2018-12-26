<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 18 Agu 2018 07:33:55 WIB 
// Nama Berkas 		: Sieka.php
// Lokasi      		: application/controllers/
// Author      		: Selamet Hanafi
//	                  selamethanafi@yahoo.co.id
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
class Ard extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
		$this->load->model('Ard_model', 'ard');	
		$this->load->model('Referensi_model','ref');	
		if($tanda!="")
		{
			if($tanda !="PA")
			{
			redirect('login');
			}
		}
		else
		{
			redirect('login');
		}
	}
	function index()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$kd = $this->session->userdata('username');
		$this->load->model('Situs_model');
		$ta = $this->db->query("select * from `p_pegawai` where `kd`='$kd'");
		$adata = $ta->num_rows();
		if($adata==0)
		{
			redirect('guru/buatdataumum');	
		}
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['judulhalaman'] = 'Jembatan Sieka';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('ard/ard_index',$data);
		$this->load->view('shared/bawah');
	}
	function ubahdata()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$kd = $this->session->userdata('username');
		$this->load->model('Situs_model');
		$ta = $this->db->query("select * from `p_pegawai` where `kd`='$kd'");
		$adata = $ta->num_rows();
		if($adata==0)
		{
			redirect('guru/buatdataumum');	
		}
		$data['judulhalaman'] = 'Jembatan Aplikasi Rapor Digital';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('ard/ard_ubah_data',$data);
		$this->load->view('shared/bawah');
	}
	function updatepassword()
	{
		$nim=$this->session->userdata('username');
		$passwd = addslashes($this->input->post('password_ard'));
		$username_ard = addslashes($this->input->post('username_ard'));
		$this->db->query("update `ard_login` set `password_ard`='$passwd', `username_ard` = '$username_ard' where `username`='$nim'");
		redirect('ard/ard');

	}
	function ard()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Login ARD';
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('ard/ard_login_iframe',$data);
		$this->load->view('shared/bawah');
	}
	function login()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Login ARD';
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['adamenu'] = '';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('ard/ard_login',$data);
		$this->load->view('shared/bawah');
	}
/* akhir controller */
}
?>
