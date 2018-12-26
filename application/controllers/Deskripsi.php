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
class Deskripsi extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'fungsi'));
		$this->load->database();
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
		$data['nim']=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Deksripsi untuk Rapor';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('deskripsi/isi_index',$data);
		$this->load->view('shared/bawah');

	}
	function proses()
	{
		$nim=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($nim);	
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$tcacah = $this->Guru_model->Tampil_Semua_Mapel_Guru_Per_Tahun_Per_Semester($kodeguru,$thnajaran,$semester);
		$cacah = $tcacah->num_rows();
		$penilaian = $this->uri->segment(3);		
		$nomor = $this->uri->segment(4);
		$data['nim'] = $nim;
		$data['judulhalaman'] = 'Proses Deskripsi';
		$data['sumber'] = 'proses';
		if(empty($nomor))
		{
			$nomor = 0;
		}
		$data['tmapel'] = $this->Guru_model->Tampil_Semua_Mapel_Guru_Semester_Ini($kodeguru,$thnajaran,$semester,1,$nomor);
		if($nomor > $cacah)
		{
			if($penilaian == 'sikap')
			{
				redirect('deskripsi/praproses/keterampilan');
			}
			elseif($penilaian == 'keterampilan')
			{
				redirect('deskripsi/praproses/pengetahuan');
			}
			else
			{
				$data['asal'] = '';
				redirect('deskripsi/sukses');
			}
		}
		else
		{
			$this->load->view('deskripsi/bg_atas',$data);
			if($penilaian == 'keterampilan')
			{
				$nomor2 = $nomor+1;
				$data['nomor'] = $nomor2;
				$data['penilaian'] = $penilaian;
				$data['thnajaran'] = $thnajaran;
				$data['semester'] = $semester;
				$this->load->view('deskripsi/deskripsi_keterampilan',$data);
			}
			if($penilaian == 'pengetahuan')
			{
				$nomor2 = $nomor+1;
				$data['nomor'] = $nomor2;
				$data['penilaian'] = $penilaian;
				$data['thnajaran'] = $thnajaran;
				$data['semester'] = $semester;
				$this->load->view('deskripsi/deskripsi',$data);
			}
			if($penilaian == 'sikap')
			{
				$nomor2 = $nomor+1;
				$data['nomor'] = $nomor2;
				$data['penilaian'] = $penilaian;
				$data['thnajaran'] = $thnajaran;
				$data['semester'] = $semester;
				$this->load->view('deskripsi/deskripsi_afektif',$data);
			}
			$this->load->view('deskripsi/bawah');

		}
	}
	function mapel()
	{
		$nim=$this->session->userdata('username');
		$data['nim'] = $nim;
		$data['judulhalaman'] = 'Proses Deksripsi untuk Rapor';
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($nim);	
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$tcacah = $this->Guru_model->Tampil_Semua_Mapel_Guru_Per_Tahun_Per_Semester($kodeguru,$thnajaran,$semester);
		$cacah = $tcacah->num_rows();
		$penilaian = $this->uri->segment(3);		
		$id_mapel = $this->uri->segment(4);
		$asal = $this->uri->segment(5);
		$id = $this->uri->segment(6);
		if(empty($id))
		{
			$id = 0;
		}
		$data['id'] = $id;
		$data['tmapel'] = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['adamenu'] = '';
		$this->load->view('guru/bg_atas',$data);
		if($penilaian == 'keterampilan')
		{
			$data['sumber'] = $asal;
			$data['penilaian'] = $penilaian;
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$this->load->view('deskripsi/deskripsi_keterampilan',$data);
		}
		if($penilaian == 'pengetahuan')
		{
			$data['sumber'] = $asal;
			$data['penilaian'] = $penilaian;
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$this->load->view('deskripsi/deskripsi',$data);
		}
		if($penilaian == 'sikap')
		{
			$data['sumber'] = 'mapel';
			$data['penilaian'] = $penilaian;
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$this->load->view('deskripsi/deskripsi_afektif',$data);
		}
		$this->load->view('deskripsi/bawah');
	}
	function pramapel()
	{
		$penilaian = $this->uri->segment(3);		
		$id_mapel = $this->uri->segment(4);
		$sumber = $this->uri->segment(5);
		$data['judulhalaman'] = 'Proses Deksripsi untuk Rapor';
		$data['tautan'] = 'mapel';
		$data['sumber'] = $sumber;
		$data['penilaian'] = $penilaian;
		$data['id_mapel'] = $id_mapel;
		$data['judulhalaman'] = 'Proses Deksripsi untuk Rapor';
		$this->load->view('deskripsi/bg_atas',$data);
		$this->load->view('deskripsi/pra_deskripsi',$data);
		$this->load->view('deskripsi/bawah');
	}
	function praproses()
	{
		$penilaian = $this->uri->segment(3);		
		$nomor = $this->uri->segment(4);
		$data['tautan'] = 'proses';
		$data['penilaian'] = $penilaian;
		$data['nomor'] = $nomor;
		$data['judulhalaman'] = 'Proses Deksripsi untuk Rapor';
		$this->load->view('deskripsi/bg_atas',$data);
		$this->load->view('deskripsi/pra_proses',$data);
		$this->load->view('deskripsi/bawah');
	}

	function sukses()
	{
		$data['judulhalaman'] = 'Proses Deksripsi untuk Rapor';
		$data['asal'] = $this->uri->segment(3);
		$this->load->view('deskripsi/bg_atas',$data);
		$this->load->view('deskripsi/sukses',$data);
		$this->load->view('deskripsi/bawah');
	}
	function galat()
	{
		$alasan = $this->uri->segment(3);
		$id_mapel = $this->uri->segment(4);
		if($alasan == 'tidakperlu')
		{
			echo 'deskripsi keterampilan tidak perlu diproses. Kalau ini satu satunya tab penilaian, tutup saja jendela ini atau kembali ke daftar nilai keterampilan di <h1><a href="'.base_url().'guru/daftarnilaipsikomotor/'.$id_mapel.'">sini</a></h1>';
		}
		else
		{
			echo 'OOops, ada galat';
		}
	}
	function hapus()
	{
		$penilaian = $this->uri->segment(3);
		$this->load->model('Guru_model');
		$this->Guru_model->Hapus_Deskripsi($penilaian);			
		echo 'Berhasil, menghapus deskripsi, tutup saja jendela ini';
	}
/* akhir controller */
}
?>
