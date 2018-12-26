<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Piket extends CI_Controller {

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
		$data = array();
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$tanggalsekarang = tanggal_hari_ini();
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=10;
		if(!$page):
			$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$piket_hari_ini = $this->Guru_model->Cari_Tanggal_Piket($tanggalsekarang);
		$sudah_ada_piket = $piket_hari_ini->num_rows();
		if ($sudah_ada_piket == 0)
		{
			$tanggalbaru = array();
			$tanggalbaru["thnajaran"] = $thnajaran;
			$tanggalbaru["semester"] = $semester ;
			$tanggalbaru["tanggal"] = $tanggalsekarang;
			$this->Guru_model->Tambah_Piket($tanggalbaru);
		}
		$piket_hari_ini = $this->Guru_model->Cari_Tanggal_Piket($tanggalsekarang);
		foreach($piket_hari_ini->result() as $tp)
		{
			$id_piket = $tp->id_piket;
		}
		$query=$this->Guru_model->Tampil_Piket($thnajaran,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Piket($thnajaran);
		$config['base_url'] = base_url() . 'piket/index';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
	   	$data['tekseditor'] = '';
		$data['judulhalaman'] = 'Mengisi Jurnal Piket';
       		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'thnajaran'=>$thnajaran, 'semester'=>$semester, 'id_piket' => $id_piket);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/piket',$data_isi);
		$this->load->view('situs/bawah');
	}
	function daftartugas()
	{
		$data = array();
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Mengisi Tugas Siswa dari guru berhalangan';
		$tanggalsekarang = tanggal_hari_ini();
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=10;
		if(!$page):
			$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Guru_model->Tampil_Daftar_Tugas_Siswa($thnajaran,$semester,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Daftar_Tugas_Siswa($thnajaran,$semester);
		$config['base_url'] = base_url() . 'piket/daftartugas';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
	   	$data['tekseditor'] = '';
       		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'thnajaran'=>$thnajaran, 'semester'=>$semester);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/piket_daftar_tugas',$data_isi);
		$this->load->view('situs/bawah');
	}

	function tambahtugas()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['tekseditor'] = '';
		$data["judulhalaman"]= 'Mengisi Tugas dari Guru Berhalangan Hadir';
		$data['id_guru_tugas'] = $this->uri->segment(3);
		$this->load->model('Guru_model');
		$data["kodegurupiket"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$bulanhadir = $this->input->post('bulanhadir');
		$tahunhadir = $this->input->post('tahunhadir');
		$tanggalhadir = $this->input->post('tanggalhadir');
		$data['kodeguru'] = $this->input->post('kodeguru');
		$data['id_mapel'] = $this->input->post('id_mapel');
		$data['proses'] = $this->input->post('proses');
		$data['jamke'] = $this->input->post('jamke');
		$data['tugas'] = $this->input->post('tugas');
		$data['tanggalrph'] = $tahunhadir."".$bulanhadir."".$tanggalhadir;
		$data['id_guru_tugas_ubah'] = $this->input->post('id_guru_tugas_ubah');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/piket_tugas_siswa_dari_guru',$data);
		$this->load->view('situs/bawah');
	}

	function ubahpiket()
	{
		$data = array();
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
	   	$data['tekseditor'] = '';
		$data['judulhalaman'] = 'Mengisi Jurnal Piket';
		$this->load->model('Guru_model');
		$data["tabel_piket"]=$this->Guru_model->Edit_Piket($id);
		$data["id_piket"] = $id;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/edit_piket',$data);
		$this->load->view('situs/bawah');
	}
	function updatepiket()
	{
		$in=array();
		$this->load->model('Guru_model');
		$in["id_piket"]=$this->input->post('id_piket');
		$in["kejadian"]=$this->input->post('kejadian');
		$this->Guru_model->Update_Piket($in);
		redirect('piket');
	}


// akhir controller
}


?>
