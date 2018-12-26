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
class Walikelas extends CI_Controller 
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
				$data["status"]=$this->session->userdata('tanda');
			if($data["status"] !="PA")
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
		$this->load->model('Situs_model');
		$tinbox = $this->Situs_model->Cek_Inbox($data["nim"]);
		//$temail = $this->Situs_model->Ada_Email($data["nim"]);
		//$tvalidemail = $this->Situs_model->Valid_Email($data["nim"]);
		$data["adapesan"] = $tinbox->num_rows();
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function bukakunci($id_walikelas=null,$id_mapel=null,$aksi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Buka Kunci Nilai Pengetahuan';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
			if($aksi == 'proses')
			{
				$cacah_siswa= $this->input->post("cacah_siswa");
				for($i=1;$i<=$cacah_siswa;$i++)
				{
					$in["kd"]=$this->input->post("kd_$i");
					$kunci = '0';
					$rapor = '0';
					if($this->input->post("pilihan_$i") == 1 )
					{
						$kunci = 1;
						$rapor = 1;
					}
					$in['kunci'] = $kunci;
					$in['rapor'] = $rapor;
					$this->Guru_model->Update_Nilai($in);
				}
				redirect('walikelas/bukakunci/'.$id_walikelas.'/'.$id_mapel);
			}
			else
			{
				$data['twali'] = $twali;
				$data['kodeguru'] = $kodeguru;
				$data['id_mapel'] = $id_mapel;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/buka_kunci',$data);
				$this->load->view('shared/bawah');
			}
		}
		else
		{
			redirect('guru/walikelas');
		}
	}
/* akhir controller */
}
?>
