<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: Guru.php
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
class Gurutelegram extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
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
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}
/*
	function kirimnilai($tahun1=null,$semester=null,$id_mapel=null,$ranah=null,$item=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Mengirim Hasil Penilaian ke Siswa Lewat Telegram';
		$data['loncat'] = '';
		$data['tahun1']= $tahun1;
		if($tahun1>0)
		{
			$tahun2 = $tahun1 + 1;
		}
		else
		{
			$tahun2 = '';
		}
		$data['semester'] = $semester;
		$data['id_mapel'] = $id_mapel;
		$data['tahun2'] = $tahun2;
		$data['ranah'] = $ranah;
		$data['item'] = $item;
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('gurutelegram/kirim_telegram',$data);
		$this->load->view('shared/bawah');
	}
*/
	function bpu($id_mapel=null,$item=null,$aksi=null,$limit=null)
	{
		$data = array();
		$this->load->helper('telegram');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Mengirim Hasil Penilaian ke Siswa Lewat Telegram';
		$data['id_mapel'] = $id_mapel;
		$data['item'] = $item;
		$data['aksi'] = $aksi;
		if(empty($limit))
		{
			$limit = 0;
		}
		$data['limit'] = $limit;
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('gurutelegram/kirim_telegram_bpu',$data);
		$this->load->view('shared/bawah');
	}


/* akhir controller */
}
?>
