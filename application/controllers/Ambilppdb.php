<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 05 Jan 2016 09:55:58 WIB 
// Nama Berkas 		: tatausaha.php
// Lokasi      		: application/views/controllers
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

class Ambilppdb extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Tatausaha")
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
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Ambil Data dari Web PPDB';
		$data['nomor' ] = 1;
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Nis_Terakhir();
		$data["nisterakhir"] ='';
		foreach ($query->result() as $c)
		{
			$data["nisterakhir"]=$c->nis + 1;
		}
		$this->load->model('Referensi_model','ref');
		$data['url_ppdb'] = $this->ref->ambil_nilai('url_ppdb');

		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/ambil_data_ppdb_konfirmasi',$data);
		$this->load->view('shared/bawah');
	}
	function unduh($nomor=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Ambil Data dari Web PPDB';
		$data['adamenu'] = '';
		$this->load->model('Admin_model');
		$this->load->model('Tatausaha_model');
		$query=$this->Admin_model->Nis_Terakhir();
		$data["nisterakhir"] ='';
		$data['thnajaran' ] = cari_thnajaran();
		foreach ($query->result() as $c)
		{
			$data["nisterakhir"]=$c->nis + 1;
		}
		if(empty($nomor))
		{
			$nomor = 1;
		}
		$data['nomor' ] = $nomor;
		$this->load->model('Referensi_model','ref');
		$data['url_ppdb'] = $this->ref->ambil_nilai('url_ppdb');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/ambil_data_ppdb',$data);
		$this->load->view('shared/bawah');
	}
	function unduhlagi($nomor=null)
	{
		$this->load->model('Referensi_model','ref');
		$url_ppdb = $this->ref->ambil_nilai('url_ppdb');

		if(empty($url_ppdb))
		{
			redirect('tatausaha/siswabaru');
		}
		$data['url_ppdb'] = $this->ref->ambil_nilai('url_ppdb');
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Ambil Data dari Web PPDB';
		$data['adamenu'] = '';
		$this->load->model('Tatausaha_model');
		$data['nomor' ] = $nomor;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/ambil_lagi_data_ppdb',$data);
		$this->load->view('shared/bawah');
	}
}//akhir fungsi

?>
