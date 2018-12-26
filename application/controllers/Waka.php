<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : waka.php
// Lokasi      : application/controllers/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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


class Waka extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
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
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Tugas Tambahan';
		$in=array();
		$data["tanggal"] = mdate($datestring, $time);
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=10;
		if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
		$query=$this->Guru_model->Tampil_Waka_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Waka_Guru($thnajaran,$semester,$kodeguru);
      		$config['base_url'] = base_url() . '/index.php/waka';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 2;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data["query"]=$query;
		$data["paginator"]=$paginator;
		$data["page"]=$page;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/kalab_index',$data);
		$this->load->view('shared/bawah');
	}

	function proker()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Program Kerja';
		$data['tekseditor'] = '';
		$aksi=$this->uri->segment(4);
		$data['id_proker'] =$this->uri->segment(5);
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$in['nourut'] = $this->input->post('nourut');	
		$in['thnajaran'] = $this->input->post('thnajaran');
		$in['semester'] = $this->input->post('semester');
		$in['namakegiatan'] = $this->input->post('namakegiatan');
		$in['tujuan'] = $this->input->post('tujuan');
		$in['sasaran'] = $this->input->post('sasaran');
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['hasil'] = $this->input->post('hasil');
		$in['waktu'] = $this->input->post('waktu');
		$in['sumberdana'] = $this->input->post('sumberdana');
		$in['keterangan'] = $this->input->post('keterangan');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
		{
			$this->Guru_model->Tambah_Proker_Kalab($in);
		} 
		if ($post_aksi == 'ubah_data')
		{
			$in['id'] = $this->input->post('id_proker');
			$this->Guru_model->Update_Proker_Kalab($in);
		} 
		if ($aksi == 'hapus')
		{
			$id_proker = $this->uri->segment(5);
			$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
			$this->Guru_model->Hapus_Proker_Kalab($id_proker,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/waka/proker/".$id."'>";
		} 
		$data['id'] = $id;		
		$data['aksi']= $aksi;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		if (($aksi=='tambah') or ($aksi=='ubah'))
		{
			$this->load->view('guru/kalab_proker_tambah',$data);
		}
		else
		{				
			$this->load->view('guru/kalab_proker',$data);
		}
		$this->load->view('shared/bawah');
	}
	function harian()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Agenda Harian';
		$aksi=$this->uri->segment(4);
		$data['id_proker'] =$this->uri->segment(5);
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$in['thnajaran'] = $this->input->post('thnajaran');
		$in['semester'] = $this->input->post('semester');
		$in['namakegiatan'] = $this->input->post('namakegiatan');
		$in['tempat'] = $this->input->post('tempat');
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['waktu'] = $this->input->post('waktu');
		$in['keterangan'] = $this->input->post('keterangan');
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$in['tanggal'] = $tahunhadir."-".$bulanhadir."-".$tanggalhadir;
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
		{
			$this->Guru_model->Tambah_Agenda_Kalab($in);
		} 
		if ($post_aksi == 'ubah_data')
		{
			$in['id_kalab_harian'] = $this->input->post('id_kalab_harian');
			$this->Guru_model->Update_Agenda_Kalab($in);
		} 
		if ($aksi == 'hapus')
		{
			$id_proker = $this->uri->segment(5);
			$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
			$this->Guru_model->Hapus_Agenda_Kalab($id_proker,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/waka/harian/".$id."'>";
		} 
		$data['id'] = $id;		
		$data['aksi']= $aksi;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		if (($aksi=='tambah') or ($aksi=='ubah'))
		{
			$this->load->view('guru/kalab_harian_tambah',$data);
		}
		else
		{				
			$this->load->view('guru/kalab_harian',$data);
		}
		$this->load->view('shared/bawah');
	}
	function bpk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Buku Pelaksanaan Kegiatan';
		$aksi=$this->uri->segment(4);
		$data['id_proker'] =$this->uri->segment(5);
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$in['thnajaran'] = $this->input->post('thnajaran');
		$in['semester'] = $this->input->post('semester');
		$in['namakegiatan'] = $this->input->post('namakegiatan');
		$in['tempat'] = $this->input->post('tempat');
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['waktu'] = $this->input->post('waktu');
		$in['keterangan'] = $this->input->post('keterangan');
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$in['tanggal'] = $tahunhadir."-".$bulanhadir."-".$tanggalhadir;
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
		{
			$this->Guru_model->Tambah_Agenda_Kalab($in);
		} 
		if ($post_aksi == 'ubah_data')
		{
			$in['id_kalab_harian'] = $this->input->post('id_kalab_harian');
			$this->Guru_model->Update_Agenda_Kalab($in);
		} 
		if ($aksi == 'hapus')
		{
			$id_proker = $this->uri->segment(5);
			$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
			$this->Guru_model->Hapus_Agenda_Kalab($id_proker,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/waka/bpk/".$id."'>";
		} 
		$data['id'] = $id;		
		$data['aksi']= $aksi;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		if (($aksi=='tambah') or ($aksi=='ubah'))
		{
			$this->load->view('guru/kalab_bpk_tambah',$data);
		}
		else
		{				
			$this->load->view('guru/kalab_bpk',$data);
		}
		$this->load->view('shared/bawah');
	}
	function blpk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Buku Pelaksanaan Kegiatan';
		$aksi=$this->uri->segment(4);
		$data['id_proker'] =$this->uri->segment(5);
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$in['keterangan_pelaksanaan'] = $this->input->post('keterangan_pelaksanaan');
		$in['persentase'] = $this->input->post('persentase');
		$in['terlaksana'] = $this->input->post('terlaksana');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'ubah_data')
		{
			$in['id_kalab_harian'] = $this->input->post('id_kalab_harian');
			$this->Guru_model->Update_Agenda_Kalab($in);
		} 
		$data['id'] = $id;		
		$data['aksi']= $aksi;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		if ($aksi=='ubah')
		{
			$this->load->view('guru/kalab_blpk_ubah',$data);
		}
		else
		{				
			$this->load->view('guru/kalab_blpk',$data);
		}
		$this->load->view('shared/bawah');
	}
	function bapk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]='Analisis Pelaksanaan Kegiatan';
		$data['tekseditor'] = '';
		$aksi=$this->uri->segment(4);
		$data['id_proker'] =$this->uri->segment(5);
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$in['keterangan_analisis'] = $this->input->post('keterangan_analisis');
		$in['dukungan'] = $this->input->post('dukungan');
		$in['hambatan'] = $this->input->post('hambatan');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'ubah_data')
		{
			$in['id_kalab_harian'] = $this->input->post('id_kalab_harian');
			$this->Guru_model->Update_Agenda_Kalab($in);
		} 
		$data['id'] = $id;		
		$data['aksi']= $aksi;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		if ($aksi=='ubah')
		{
			$this->load->view('guru/kalab_bapk_ubah',$data);
		}
		else
		{				
		$this->load->view('guru/kalab_bapk',$data);
		}
		$this->load->view('shared/bawah');
	}
	function btlpk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Tindak Lanjut Pelaksanaan Kegiatan';
		$aksi=$this->uri->segment(4);
		$data['id_proker'] =$this->uri->segment(5);
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$in['keterangan_tindak_lanjut'] = $this->input->post('keterangan_tindak_lanjut');
		$in['solusi'] = $this->input->post('solusi');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'ubah_data')
		{
			$in['id_kalab_harian'] = $this->input->post('id_kalab_harian');
			$this->Guru_model->Update_Agenda_Kalab($in);
		} 
		$data['id'] = $id;		
		$data['aksi']= $aksi;
		$data['tugase'] = 'waka';
		$data['namatugas'] = 'Wakil Kepala Madrasah';
		$this->load->view('guru/bg_atas',$data);
		if ($aksi=='ubah')
		{
			$this->load->view('guru/kalab_btlpk_ubah',$data);
		}
		else
		{				
			$this->load->view('guru/kalab_btlpk',$data);
		}
		$this->load->view('shared/bawah');
	}

// akhir controller
}


?>
