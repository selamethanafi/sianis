<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// vDimutakhirkan	: Jum 18 Mei 2018 03:15:13 WIB 
// Nama Berkas 		: pengajaran.php
// Lokasi      		: application/controllers/
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


class Pengajaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Pengajaran")
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
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Beranda Pengajaran';
		$this->load->view('pengajaran/bg_head',$data);			
		$this->load->view('pengajaran/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data["status"]= 'pengajaran';
		$data['judulhalaman'] = 'Ganti Tema Tampilan';
		$proses=$this->input->post('proses');
		if(!empty($proses))
		{
			$temacss=$this->input->post('temacss');
			$this->load->model('Guru_model');
			$in['user'] = $data["nim"];
			$in['temacss'] = $temacss;
			$this->Guru_model->Update_Tema($in);
		}
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}
	function walikelas($id_walikelas=null)
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Pembagian Tugas Walikelas';
		$this->load->model('Pengajaran_model');
		$data_isi['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$data_isi['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
		$data_isi['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$data_isi['semester']=hilangkanpetik($this->input->post('semester'));
		$data_isi['kode_guru']=hilangkanpetik($this->input->post('kode_guru'));
		$data_isi['kelas']=hilangkanpetik($this->input->post('kelas'));
		$data_isi['kode_rombel']=hilangkanpetik($this->input->post('kode_rombel'));
		$data_isi['kurikulum']=hilangkanpetik($this->input->post('kurikulum'));
		$data_isi['id_walikelas'] = $id_walikelas;
		$this->load->model('Referensi_model','ref');
		$data_isi['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/walikelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function mapelrapor()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Kerangka Rapor';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$data['aksi'] = $this->uri->segment(3);
		$data['tahun1'] = $this->uri->segment(4);
		$data['semester'] = $this->uri->segment(5);
		$data['id_kelas'] = $this->uri->segment(6);
		$id_mapel_rapor = $this->uri->segment(7);
		if($data['aksi'] == 'hapus')
			{
			$this->Pengajaran_model->Hapus_Mapel_Rapor($id_mapel_rapor);
			redirect('pengajaran/mapelrapor/tampil/'.$data['tahun1'].'/'.$data['semester'].'/'.$data['id_kelas']);
			}
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($data['id_kelas']);
		$thnajaran = '';
		if(!empty($data['tahun1']))
			{
				$tahun2 = $data['tahun1'] + 1;
				$thnajaran = $data['tahun1'].'/'.$tahun2;
			}
		$proses = $this->input->post('proses');
		if(($proses == "tambah") or ($proses == "ubah"))
		{
			$id_mapel_rapor = $this->input->post('id_mapel_rapor');
			$pbx["id_mapel_rapor"]=$this->input->post('id_mapel_rapor');
			$pbx['thnajaran']=$this->input->post('thnajaran');
			$pbx['komponen']=$this->input->post('komponen');
			$pbx['semester']=$this->input->post('semester');
			$pbx['nama_mapel'] = $this->input->post('nama_mapel');
			$pbx['nama_mapel_portal']=$this->input->post('nama_mapel_portal');
			$pbx['no_urut']=$this->input->post('no_urut');
			$pbx['kelas'] =$this->input->post('kelas');
			$pbx['pilihan'] =$this->input->post('pilihan');
			if(!empty($id_mapel_rapor))
			{
				$pbx= hilangkanpetik($pbx);
				$this->Pengajaran_model->Update_Mapel_Rapor($pbx);
				$datax["id_mapel_rapor"]=$id_mapel_rapor;
			}
			else
			{
				$pbx= hilangkanpetik($pbx);
				$this->Pengajaran_model->Tambah_Mapel_Rapor($pbx);
			}
		}
		if($proses == 'salin')
		{
			$datax['thnajaranx']=$this->input->post('thnajaranx');
			$datax['semesterx']=$this->input->post('semesterx');
			$datax['kelasx'] =$this->input->post('kelasx');
			$datax['thnajaran'] = $thnajaran;
			$datax['semester'] = $this->uri->segment(5);
			$datax['kelas'] = $kelas;
			$this->load->view('pengajaran/proses_salin_mapel_rapor',$datax);
		}
		else
		{
		if($data['aksi'] == 'tambah')
			{
			$data['kelas'] = $kelas;
			$data['judulhalaman'] = 'Tambah Mapel Rapor';
			}
		if($data['aksi'] == 'ubah')
			{
			$data['judulhalaman'] = 'Ubah Mapel Rapor';
			}
		$datax['id_mapel_rapor' ] = $id_mapel_rapor;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Rapor_Thnajaran_Ruang($thnajaran,$kelas);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mapel_rapor',$datax);
		$this->load->view('shared/bawah');
		}
	}
	function hapusmapelrapor()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$this->load->model('Pengajaran_model');
		$this->Pengajaran_model->Hapus_Mapel_Rapor($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/mapelrapor'>";
	}
	function tapel()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Tahun Pelajaran';
		$this->load->model('Pengajaran_model');
		$proses = $this->input->post('proses');
		if($proses == 'tambah')
		{
			$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
			$datax['awal']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('awal')));
			$datax['awal2']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('awal2')));
			$datax['akhir1']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('akhir1')));
			$datax['akhir2']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('akhir2')));
			$this->Pengajaran_model->Simpan_Tapel($datax);
		}
		if($proses = 'ubah')
		{
			$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
			$datax['awal']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('awal')));
			$datax['awal2']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('awal2')));
			$datax['akhir1']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('akhir1')));
			$datax['akhir2']=hilangkanpetik(tanggal_indonesia_ke_barat($this->input->post('akhir2')));
			$datax['id']=hilangkanpetik($this->input->post('id'));
			$this->Pengajaran_model->Update_Tapel($datax);
		}

		$this->load->library('Pagination');	
		$aksi = $this->uri->segment(3);
		if(empty($aksi))
			{
			$aksi = 'tampil';
			}
		$page=$this->uri->segment(4);
      		$limit_ti=5;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Pengajaran_model->Tampil_Semua_Tahun($limit_ti,$offset_ti);
		$tot_hal = $this->Pengajaran_model->Total_Tahun();
      		$config['base_url'] = base_url() . '/pengajaran/tapel/tampil';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'aksi'=>$aksi);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/tapel',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tapelaktif()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
			$id='';
		}
		else
		{
			$id = $this->uri->segment(3);
		}
		$this->Pengajaran_model->Update_Thnajaran_Aktif($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/tapel'>";
	}
	function kelas($aksi=null,$page=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->model('Referensi_model','ref');
		$data['jenjang'] = $this->ref->ambil_nilai('jenjang');
		$this->load->library('Pagination');	
		$data['galat'] = '';

		if($aksi == 'hapus')
		{
			//$this->Pengajaran_model->Hapus_Kelas($page);
			redirect('pengajaran/kelas');
		}
		elseif($aksi == 'tambah')
		{
			$data['judulhalaman'] = 'Tambah Kelas';
			$data_isi["daftartingkat"]=$this->Pengajaran_model->Total_Kelas();
			$data_isi["daftarprogram"]=$this->Pengajaran_model->Total_Program();
		}
		elseif($aksi == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Nama Kelas';
			$data_isi["tampileditkelas"]=$this->Pengajaran_model->Tampil_Edit_Kelas($page);
			$data_isi["daftartingkat"]=$this->Pengajaran_model->Total_Kelas();
			$data_isi["daftarprogram"]=$this->Pengajaran_model->Total_Program();
		}
		else
		{
			$tb =  $this->db->query("select * from `m_ruang`");
			foreach($tb->result() as $b)
			{
				$program = $b->program;
				$category_majors_id = 0;
				$ta = $this->db->query("select * from `m_program` where `program`='$program'");
				foreach($ta->result() as $a)
				{
					$category_majors_id = $a->category_majors_id;
				}
				$id_ruang = $b->id_ruang;
				$namakelas = substr($b->ruang,-1);
				if(!is_numeric($namakelas))
				{
					$namakelas = 1;
				}
				$this->db->query("update `m_ruang` set `category_majors_id` = '$category_majors_id', `school_class_name`='$namakelas' where `id_ruang`='$id_ruang'");
			}
			$aksi = 'tampil';
			$data['judulhalaman'] = 'Daftar Kelas';
	      		$limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$query=$this->Pengajaran_model->Tampil_Semua_Kelas($limit_ti,$offset_ti);
			$tot_hal = $this->Pengajaran_model->Tampilkan_Semua_Kelas();
	      		$config['base_url'] = base_url() . 'pengajaran/kelas/tampil';
	       		$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
	        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		$data['aksi'] = $aksi;
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function simpankelas()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['ruang']=hilangkanpetik($this->input->post('ruang'));
		$datax['tingkat']=hilangkanpetik($this->input->post('tingkat'));
		$datax['program']=hilangkanpetik($this->input->post('program'));
		$datax['id_ruang']=hilangkanpetik($this->input->post('id_ruang'));
		$ruang=hilangkanpetik($this->input->post('ruang'));
		if((substr($ruang,0,2) == 'X-') or (substr($ruang,0,3) == 'XI-') or (substr($ruang,0,4) == 'XII-'))
		{
			if(empty($datax['id_ruang']))
			{
				$this->Pengajaran_model->Simpan_Kelas($datax);
			}
			else
			{
				$this->Pengajaran_model->Update_Kelas($datax);
			}
			redirect('pengajaran/kelas');
		}
		else
		{
			$data['galat'] = '<div class="alert alert-warning">Penamaan kelas harus dimulai dengan <strong>X-</strong> atau <strong>XI-</strong> atau <strong>XII-</strong></div>';
			$datax["daftartingkat"]=$this->Pengajaran_model->Total_Kelas();
			$datax["daftarprogram"]=$this->Pengajaran_model->Total_Program();
			if(empty($datax['id_ruang']))
			{
				$data['judulhalaman'] = 'Tambah Kelas';
				$data['aksi'] = 'tambah';
			}
			else
			{
				$data['judulhalaman'] = 'Ubah Kelas';
				$data['aksi'] = 'ubah';
				$datax['tampileditkelas']=$this->Pengajaran_model->Tampil_Edit_Kelas($datax['id_ruang']);
			}
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/kelas',$datax);
			$this->load->view('shared/bawah');



		}
	}
	function matapelajaran()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Mata Pelajaran';
		$this->load->model('Pengajaran_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		$data['aksi'] = $aksi;
		$id_kategori_tutorial=hilangkanpetik($this->input->post('id_kategori_tutorial'));
		$mapel = hilangkanpetik($this->input->post('mapel'));
		if(!empty($id_kategori_tutorial))
			{
			$datax['nama_kategori']=hilangkanpetik($this->input->post('nama_kategori'));
			$datax['id_kategori_tutorial']=hilangkanpetik($this->input->post('id_kategori_tutorial'));
			$this->Pengajaran_model->Update_Mapel($datax);
			}
			else
			{
			if(!empty($mapel))
				{
					$datax['nama_kategori']=hilangkanpetik($this->input->post('mapel'));
					$this->Pengajaran_model->Simpan_Mapel($datax);
				}
			}

		if($aksi == 'tambah')
		{
			$data['judulhalaman'] = 'Tambah Mapel';
			$data_isi["tingkat"]=$this->Pengajaran_model->Total_Kelas();
			$data_isi["program"]=$this->Pengajaran_model->Total_Program();
		}
		elseif($aksi == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Nama Mata Pelajaran';
			$data_isi['id'] = $page;

		}
		else
		{
	   		$limit_ti=15;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$query=$this->Pengajaran_model->Tampil_Semua_Mapel($limit_ti,$offset_ti);
			$tot_hal = $this->Pengajaran_model->Total_Mapel();
      			$config['base_url'] = base_url() . 'pengajaran/matapelajaran/tampil';
       			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
        		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mapel',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tambahmapelperkelas()
	{
		$data = array();
		$this->load->model('Pengajaran_model');
		$data['nim']=$tanda = $this->session->userdata('username');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/impor_mapel',$data);
		$this->load->view('shared/bawah');
	}
	function simpanmapelperkelas()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['mapel']=$this->input->post('mapel');
		$datax['tingkat']=$this->input->post('tingkat');
		$datax['program']=$this->input->post('program');
		$tingkat =$this->input->post('tingkat');
		$program=$this->input->post('program');
		$datax = hilangkanpetik($datax);
		$this->Pengajaran_model->Simpan_Mapel_Per_Kelas($datax);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/tambahmapelperkelas/".$id_tingkat."/".$id_program."'>";
	}
	function proses_impor_daftar_mapel()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		foreach($csvData as $field):
			$pbk['thnajaran'] = $field['thnajaran'];
			$pbk['semester'] = $field['semester'];
			$pbk['kelas'] = $field['kelas'];
			$pbk['mapel'] = $field['mapel'];
			$pbk['program'] = $field['program'];
			$pbk['tingkat'] = $field['tingkat'];
			$pbk['kodeguru'] = $field['kodeguru'];
			$pbk['kkm'] = $field['kkm'];
			$pbk['kelompok'] = $field['kelompok'];
			$pbk['ranah'] = $field['ranah'];
			$pbk['no_urut_rapor'] = $field['no_urut_rapor'];
			$pbk['jam'] = $field['jam'];
			$pbk['kurikulum'] = $field['kurikulum'];
			$thnajaran = $pbk['thnajaran'];
			$semester = $pbk['semester'];
			$kelas = $pbk['kelas'];
			$mapel = $pbk['mapel'];
			$kodeguru = $pbk['kodeguru'];
			$no_urut_rapor = $field['no_urut_rapor'];
			$cek = $this->Pengajaran_model->Cek_Mapel($thnajaran,$semester,$kelas,$mapel,$kodeguru);
			$ada = $cek->num_rows();
			$this->Pengajaran_model->Add_Mapel($pbk,$ada);
			$this->Pengajaran_model->Perbarui_Nomor_Urut($thnajaran,$mapel,$no_urut_rapor,$kelas);
			$n++;
		endforeach;
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/matapelajaran'>";
	}
	function nilai()
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data_isi ='';
		$page=$this->uri->segment(3);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/nilai',$data_isi);
		$this->load->view('shared/bawah');
	}

	function proses_impor_nilai_siswa()
	{
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		foreach($csvData as $field):
			$pbk['thnajaran'] = $field['thnajaran'];
			$pbk['semester'] = $field['semester'];
			$pbk['kelas'] = $field['kelas'];
			$pbk['nis'] = $field['nis'];
			$pbk['nama'] = $field['nama'];
			$pbk['mapel'] = $field['mapel'];
			$pbk['nilai_uh1'] = $field['nilai_uh1'];
			$pbk['nilai_uh2'] = $field['nilai_uh2'];
			$pbk['nilai_uh3'] = $field['nilai_uh3'];
			$pbk['nilai_uh4'] = $field['nilai_uh4'];
			$pbk['nilai_ruh'] = $field['nilai_ruh'];
			$pbk['nilai_tu1'] = $field['nilai_tu1'];
			$pbk['nilai_tu2'] = $field['nilai_tu2'];
			$pbk['nilai_tu3'] = $field['nilai_tu3'];
			$pbk['nilai_tu4'] = $field['nilai_tu4'];
			$pbk['nilai_rtu'] = $field['nilai_rtu'];
			$pbk['nilai_nh'] = $field['nilai_nh'];
			$pbk['nilai_mid'] = $field['nilai_mid'];
			$pbk['nilai_uas'] = $field['nilai_uas'];
			$pbk['nilai_na'] = $field['nilai_na'];
			$pbk['nilai_nh'] = $field['nilai_nh'];
			$pbk['nilai_nr'] = $field['nilai_nr'];
			$pbk['nilai_psi'] = $field['psikomotor'];
			$pbk['nilai_afe'] = $field['afektif'];
			$pbk['status'] = $field['status'];
			$pbk['no_urut'] = $field['no_urut'];
			$pbk['ket'] = $field['ket'];
			$pbk['keterangan'] = $field['keterangan'];
			$thnajaran = $pbk['thnajaran'];
			$semester = $pbk['semester'];
			$mapel = $pbk['mapel'];
			$nis = $pbk['nis'];
			$ada = $this->Pengajaran_model->Cek_Nilai($thnajaran,$semester,$mapel,$nis);
			$ada = $ada->num_rows();
			$this->Pengajaran_model->Add_Nilai($pbk,$ada);
			$n++;
		endforeach;
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/nilai'>";
	}
	function mapelperruang()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Pembagian Tugas Guru';
		$aksi=$this->uri->segment(3);
		$tahun1 = $this->uri->segment(4);
		$semester = $this->uri->segment(5);
		$id_kelas = $this->uri->segment(6);
		$id_mapel = $this->uri->segment(7);
		$data['aksi'] = $aksi;
		$this->load->model('Pengajaran_model');
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_kelas);
		$thnajaran = '';
		if($aksi == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Pembagian Tugas Guru';
			$data['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
			$data['id_mapel'] = $id_mapel;
		}
		if($aksi == 'tambah')
		{
			$data['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
			$data['id_kelas']= $id_kelas;
			$data['kelas'] = $kelas;
			$data['judulhalaman'] = 'Tambah Pembagian Tugas Guru';
		}

		if($aksi == 'hapus')
		{
			$this->Pengajaran_model->Hapus_Mapel_Kelas($id_mapel);
			redirect('pengajaran/mapelperruang/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas);
		}

		if(!empty($tahun1))
		{
			$tahun2 = $tahun1 + 1;
			$thnajaran = $tahun1.'/'.$tahun2;
		}

		$datax['id_kelas']= $id_kelas;
		$datax['thnajaran']=$thnajaran;
		$datax['semester']= $semester;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mapel_per_ruang',$datax);
		$this->load->view('shared/bawah');
	}
	function urutanmapel()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$thnajaran=hilangkanpetik($this->input->post('thnajaran'));
		$kelas=hilangkanpetik($this->input->post('kelas'));
		$semester=hilangkanpetik($this->input->post('semester'));
		if ((!empty($thnajaran)) and (!empty($kelas)) and (!empty($semester)))
		{
			$daftar_mapel_per_tahun = $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Semester_Ruang($thnajaran,$semester,$kelas);
			foreach($daftar_mapel_per_tahun->result() as $ddaftar_mapel_per_tahun) 
			{
				$no_urut_rapor = $ddaftar_mapel_per_tahun->no_urut_rapor;
				$mapel = $ddaftar_mapel_per_tahun->mapel;
				$this->Pengajaran_model->Perbarui_Nomor_Urut($thnajaran,$semester,$mapel,$no_urut_rapor,$kelas);
			}
		}
		$datax["thnajaran"]=$thnajaran;
		$datax["kelas"]=$kelas;
		$datax["semester"]=$semester;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/urutan_mapel',$datax);
		$this->load->view('shared/bawah');
	}
	function cetakrapor()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Rapor';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['kelas'],$datax['thnajaran']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['thnajaran'],$datax['kelas']);
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_kelas'] = $this->uri->segment(5);
		$datax['status_nilai'] = $this->uri->segment(6);
		$datax['nis'] = $this->uri->segment(7);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mencetak_rapor',$datax);
		$this->load->view('shared/bawah');
	}
	function belumkompeten($tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data["judulhalaman"]= 'Siswa Belum Tuntas';
		$this->load->model('Pengajaran_model');
		$datax['id_walikelas']= $id_walikelas;
		if($tahun1 > 0)
		{
			$tahun2 = $tahun1 + 1;
		}
		else
		{
			$tahun2 = '';
		}
		$thnajaran = $tahun1.'/'.$tahun2;
		$datax['thnajaran']= $tahun1.'/'.$tahun2;
		$datax['tahun1']= $tahun1;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['semester']= $semester;
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$data['kelas']= $kelas;
		$data['daftar_siswa'] = $this->Pengajaran_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$datax['daftar_walikelas']= $this->Pengajaran_model->Tampil_Walikelas($thnajaran,$semester);
		$data['loncat'] = '';
		$datax['daftar_siswa']= $this->Pengajaran_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/belum_kompeten',$datax);
		$this->load->view('shared/bawah');
	}
	function cetakblankonilai()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
//			$this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['kelas'],$datax['thnajaran']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
//			$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['thnajaran'],$datax['kelas']);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/cetak_blanko_nilai',$datax);
		$this->load->view('shared/bawah');
	}
	function hapusmapelkelas()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$this->load->model('Pengajaran_model');
		$this->Pengajaran_model->Hapus_Mapel_Kelas($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/mapelperruang'>";
	}

	function guru()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/guru');
		$this->load->view('shared/bawah');
	}
	function jamtatapmuka()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['kodeguru']=$this->input->post('kodeguru');
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']=$this->input->post('semester');
		$datax['jam']=$this->input->post('jam');
		$datax['id_mapel']=$this->input->post('id_mapel');
		$datax['mapel']=$this->input->post('nmmapel');
		if(!empty($datax['id_mapel']))
		{
			$datax = hilangkanpetik($datax);
			$this->Pengajaran_model->Update_Jam_Tatap_Muka($datax);
		}
		$this->Pengajaran_model->Tampil_Mapel_Guru_Thnajaran_Semester($datax['kodeguru'],$datax['thnajaran'],$datax['semester']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Semester_Guru($datax['thnajaran'],$datax['semester'],$datax['kodeguru']);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/jam_tatap_muka',$datax);
		$this->load->view('shared/bawah');
	}
	function editjamtatapmuka()
	{
		$data = array();
		$this->load->model('Pengajaran_model');
		$data['nim']=$tanda = $this->session->userdata('username');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data['tampillogintapel']=$this->Pengajaran_model->Tampil_Edit_Mapel_Kelas($id);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/edit_jam_tatap_muka',$data);
		$this->load->view('shared/bawah');
	}
	function cetakmid()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Hasil Ulangan Tengah Semester';
		$this->load->model('Pengajaran_model');
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['kelas'],$datax['thnajaran']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['thnajaran'],$datax['kelas']);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mencetak_hasil_mid',$datax);
		$this->load->view('shared/bawah');
	}
	function statistik()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Statistik / Daya serap';
		$this->load->model('Pengajaran_model');
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['ulangan']=hilangkanpetik($this->input->post('ulangan'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['kelas'],$datax['thnajaran']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['thnajaran'],$datax['kelas']);
		if ((!empty($datax['thnajaran'])) and (!empty($datax['semester'])) and(!empty($datax['kelas'])) and (!empty($datax['ulangan'])))
		{	
			$this->load->view('shared/bg_atas_cetak',$data);
			$this->load->view('pengajaran/cetak_statistik',$datax);
			$this->load->view('shared/bg_bawah_cetak');
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/statistik',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function periksa()
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$dataisi = array();
		$item=$this->uri->segment(3);
		$dataisi['item'] = $item;
		$dataisi['thnajaran'] = cari_thnajaran();
		$dataisi['semester'] = cari_semester();
		$this->load->view('pengajaran/bg_head',$data);
		if ($item == 'nilai')
		{
			$this->load->view('pengajaran/periksa_nilai',$dataisi);
		}
		elseif ($item == 'ekstra')
		{
			$this->load->view('pengajaran/periksa_ekstra',$dataisi);
		}
		elseif ($item == 'akhlak')
		{
			$this->load->view('pengajaran/periksa_akhlak',$dataisi);
		}
		else
		{
			$this->load->view('pengajaran/periksa',$dataisi);
		}
		$this->load->view('shared/bawah');
	}

	function peringkat()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Peringkat Siswa';
		$item=$this->uri->segment(3);
		$itemx=$this->uri->segment(4);
		$this->load->model('Pengajaran_model');
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['kelas'],$datax['thnajaran']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['thnajaran'],$datax['kelas']);
		if (empty($item))
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/peringkat_siswa',$datax);
			$this->load->view('shared/bawah');
		}
		else
		{
			$dataxx["item"] = $item;
			$dataxx["itemx"] = $itemx;
			$dataxx["tahun1"] = $this->uri->segment(5);
			$dataxx["semester"] = $this->uri->segment(6);
			$this->load->view('pengajaran/rekap_peringkat_siswa',$dataxx);
		}
	}
	function unduhmapel()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Semester($datax['thnajaran'],$datax['semester']);
		if ((empty($datax['semester'])) or (empty($datax['thnajaran'])))
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/unduh_mapel',$datax);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('pengajaran/unduh_mapel_csv',$datax);
		}
	}

	function siswabelumtuntas()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Siswa Belum Tuntas';
		$this->load->model('Pengajaran_model');
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$this->Pengajaran_model->Tampil_Mapel_Thnajaran_Ruang($datax['kelas'],$datax['thnajaran']);
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->db->query("select * from m_ruang where ruang like 'XII-%' order by ruang");
		$datax['semester']=2;
//			$datax['daftar_mapel']= $this->Pengajaran_model->Tampil_Mapel_Thnajaran_Semester_Ruang($datax['thnajaran'],$datax['semester'],$datax['kelas']);
		$datax['daftar_siswa']= $this->Pengajaran_model->Daftar_Siswa($datax['thnajaran'],$datax['semester'],$datax['kelas']);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/peserta_un_belum_kompeten',$datax);
		$this->load->view('shared/bawah');
	}
	function ubahnilairapor()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['nis']=hilangkanpetik($this->input->post('nis'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['cacahmapel']=hilangkanpetik($this->input->post('cacahmapel'));
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$cacahmapel = $datax['cacahmapel'];
		if (!empty($cacahmapel))
		{
			for($i=1;$i<=$cacahmapel;$i++)
			{
				$in["kd"]=hilangkanpetik($this->input->post("kd_$i"));
				$in["nilai_nr"]=hilangkanpetik($this->input->post("nilai_nr_$i"));
				$this->load->model('Guru_model');
				$this->Guru_model->Update_Nilai($in);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/ubahnilairapor'>";
			}
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/ubah_nilai_rapor',$datax);
			//$this->load->view('shared/bawah');
		}
	}
	function unduhnilairapor($tahun1=null,$semester=null,$id_kelas=null,$id_mapel=null,$format=null)
	{
		$data = array();
		$data['judulhalaman'] = 'Unduh Nilai Rapor';
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$data['loncat'] = '';
		$datax['tahun1']=$tahun1;
		$datax['semester']=$semester;
		$datax['id_kelas']=$id_kelas;
		$datax['id_mapel']=$id_mapel;
		$datax['format']=$format;
		if (($datax['format']=='csv') or ($datax['format']=='xls'))
		{
			$this->load->library('excel');
			$this->load->view('pengajaran/unduh_nilai',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/unduh_nilai',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function piket()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Pembagian Tugas Guru Piket';
		$this->load->model('Pengajaran_model');
		$kode_guru = hilangkanpetik($this->input->post('kode_guru'));
		$haripiket = hilangkanpetik($this->input->post('hari'));
		$thnajaran=cari_thnajaran();
		$semester=cari_semester();
		$datax['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
		$datax['thnajaran']= $thnajaran;
		$datax['semester']= $semester;
		$urutan_hari = 1;
		if ($haripiket == 'Monday')
		{
			$urutan_hari = 1;
		}
		if ($haripiket == 'Tuesday')
		{
			$urutan_hari = 2;
		}
		if ($haripiket == 'Wednesday')
		{
			$urutan_hari = 3;
		}
		if ($haripiket == 'Thursday')
		{
			$urutan_hari = 4;
		}
		if ($haripiket == 'Friday')
		{
			$urutan_hari = 5;
		}
		if ($haripiket == 'Saturday')
		{
			$urutan_hari = 6;
		}
		$in["kodeguru"]= $kode_guru;
		$in["thnajaran"]= $thnajaran;
		$in["semester"] = $semester;
		$in["hari"] = $haripiket;
		$in["urutan_hari"] = $urutan_hari;
		if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kode_guru)) and (!empty($haripiket)))
		{
			$cek = $this->Pengajaran_model->Cek_Piket($thnajaran,$semester,$kode_guru);
			$ada = $cek->num_rows();
			$in = hilangkanpetik($in);
			$this->Pengajaran_model->Add_Piket($in,$ada);
		}
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/piket',$datax);
		$this->load->view('shared/bawah');
	}
	function lihatnilai()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data["judulhalaman"] = 'Daftar Nilai Mata Pelajaran';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']=$this->input->post('semester');
		$datax['kelas']=$this->input->post('kelas');
		$datax['mapel']=$this->input->post('mapel');
		$datax = hilangkanpetik($datax);
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/lihat_nilai',$datax);
		$this->load->view('shared/bawah');
	}
	function perbaruidaftarsiswa()
	{

		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Guru_model');
		$thnajaran=hilangkanpetik($this->input->post('thnajaran'));
		$kelas=hilangkanpetik($this->input->post('kelas'));
		$mapel=hilangkanpetik($this->input->post('mapel'));
		$kd_mapel=hilangkanpetik($this->input->post('kd_mapel'));
		$semester=hilangkanpetik($this->input->post('semester'));
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
		{
			$nama = $dsiswa->nama;
			$nis = $dsiswa->nis;
			$no_urut = $dsiswa->no_urut;
			$status=$dsiswa->status;
			$status2=$dsiswa->status2;
			$ada = $this->Guru_model->Cek_Nilai($thnajaran,$semester,$mapel,$nis);
			$ada = $ada->num_rows();
			$pbk['thnajaran'] = $thnajaran;
			$pbk['semester'] = $semester;
			$pbk['kelas'] = $kelas;
			$pbk['nis'] = $nis;
			$pbk['nama'] = $nama;
			$pbk['mapel'] = $mapel;
			$pbk['kd_mapel'] = $kd_mapel;
			$pbk['no_urut'] = $no_urut;
			$pbk['status'] = $status;
			$pbk = hilangkanpetik($pbk);
			$this->Guru_model->Add_Nilai($pbk,$ada);
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/lihatnilai'>";
	}
	function nilaipesertaun($tahun1=null,$tahun2=null,$id_walikelas=null,$halaman=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Peserta UN';
		$data['loncat'] = '';
		if(empty($tahun1))
		{
			$datax["thnajaran"] = cari_thnajaran();
		}
		else
		{
			$datax["thnajaran"] = $tahun1.'/'.$tahun2;
		}
		$datax["status"]='pengajaran';
		if ((!empty($datax["thnajaran"])) and (!empty($id_walikelas)))  
		{
			$datax['id_walikelas'] = $id_walikelas;
			$datax['halaman'] = $halaman;
			$this->load->view('shared/nilai_data_sma_tampil',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('shared/nilai_peserta_un',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function ceknilaipesertaun()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Guru_model');
		$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax["thnajaran"] = hilangkanpetik($this->input->post('thnajaran'));
		$datax["semester"] = hilangkanpetik($this->input->post('semester'));
		$datax["kelas"] = hilangkanpetik($this->input->post('kelas'));
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/cek_nilai_peserta_un',$datax);
		$this->load->view('shared/bawah');
	}
	function ceknilaisiswa()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Pemeriksaan Nilai Siswa Kelas XII';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']= hilangkanpetik($this->input->post('semester'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/cek_nilai_siswa',$datax);
		$this->load->view('shared/bawah');
	}
	function unggahnilaiakhir()
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data_isi ='';
		$page=$this->uri->segment(3);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/nilai_akhir',$data_isi);
		$this->load->view('shared/bawah');
	}
	function proses_impor_nilai_akhir_siswa()
	{
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		foreach($csvData as $field):
			$pbk['thnajaran'] = $field['thnajaran'];
			$pbk['semester'] = $field['semester'];
			$pbk['nis'] = $field['nis'];
			$pbk['mapel'] = $field['mapel'];
			$pbk['kog'] = $field['Pengetahuan'];
			$pbk['psi'] = $field['Praktik'];
			$pbk['nilai_afe'] = $field['Sikap'];
			$pbk['keterangan'] = $field['keterangan'];
			$thnajaran = $pbk['thnajaran'];
			$semester = $pbk['semester'];
			$mapel = $pbk['mapel'];
			$nis = $pbk['nis'];
			$this->Pengajaran_model->Add_Nilai_Akhir($pbk);
			if ($semester=='US')
			{
				$this->Pengajaran_model->Add_Nilai_Ujian($pbk);
			}	
			$n++;
		endforeach;
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/unggahnilaiakhir'>";
		
	}
	function nilaiun()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Siswa Kelas XII Per Mata Pelajaran';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=cari_thnajaran();
		$datax['semester']= cari_semester();
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['mapel']=hilangkanpetik($this->input->post('mapel'));
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/lihat_nilai_peserta_un',$datax);
		$this->load->view('shared/bawah');
	}
	function nilaium()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Nilai Ujian '.$this->config->item('sek_tipe');
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']= '2';
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['mapel']=hilangkanpetik($this->input->post('mapel'));
		$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/lihat_nilai_ujian_sekolah',$datax);
		$this->load->view('shared/bawah');
	}
	function unduhnilaium()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		if (!empty($datax['kelas']))
		{
			$this->load->library('excel');
			$this->load->view('shared/unduh_nilai_um_xls',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/unduh_nilai_um',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function pembagiantugas()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['kode_guru']=hilangkanpetik($this->input->post('kode_guru'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['mapel']=hilangkanpetik($this->input->post('mapel'));
		$datax['ranah']=hilangkanpetik($this->input->post('ranah'));
		$datax['kelompok']=hilangkanpetik($this->input->post('kelompok'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['kelompok'] = hilangkanpetik($this->input->post('kelompok'));
		$datax['ranah'] = hilangkanpetik($this->input->post('ranah'));
		$datax['no_urut_rapor'] = hilangkanpetik($this->input->post('no_urut_rapor'));
		$datax['kkm'] = hilangkanpetik($this->input->post('kkm'));
		$datax['jam'] = hilangkanpetik($this->input->post('jam'));
		$pbk['thnajaran'] = hilangkanpetik($this->input->post('thnajaran'));
		$pbk['semester'] = hilangkanpetik($this->input->post('semester'));
		$pbk['kelas'] = hilangkanpetik($this->input->post('kelas'));
		$pbk['mapel'] = hilangkanpetik($this->input->post('mapel'));
		$pbk['program'] = kelas_jadi_program(hilangkanpetik($this->input->post('kelas')));
		$pbk['tingkat'] = kelas_jadi_tingkat(hilangkanpetik($this->input->post('kelas')));
		$pbk['kodeguru'] = hilangkanpetik($this->input->post('kode_guru'));
		$pbk['kelompok'] = hilangkanpetik($this->input->post('kelompok'));
		$pbk['ranah'] = hilangkanpetik($this->input->post('ranah'));
		$pbk['no_urut_rapor'] = hilangkanpetik($this->input->post('no_urut_rapor'));
		$pbk['kkm'] = hilangkanpetik($this->input->post('kkm'));
		$pbk['jam'] = hilangkanpetik($this->input->post('jam'));
		$thnajaran = $pbk['thnajaran'];
		$semester = $pbk['semester'];
		$kelas = $pbk['kelas'];
		$mapel = $pbk['mapel'];
		$kodeguru = $pbk['kodeguru'];
		$kelompok = $pbk['kelompok'];
		$id_kelas = hilangkanpetik($this->input->post('id_kelas'));
		if ((!empty($kodeguru)) and (!empty($thnajaran)) and (!empty($semester)) and (!empty($mapel)) and (!empty($kelas)))
		{
			$cek = $this->Pengajaran_model->Cek_Mapel($thnajaran,$semester,$kelas,$mapel,$kodeguru);
			$ada = $cek->num_rows();
			$this->Pengajaran_model->Add_Mapel($pbk,$ada);
		}
		$tahun1 = substr($thnajaran,0,4);
		redirect('pengajaran/mapelperruang/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas);
	}
	function nilaiuambn()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Nilai UAMBN';
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']='2';
		$this->load->model('Pengajaran_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/nilai_uambn',$datax);
		$this->load->view('shared/bawah');
	}
	function nilaiujiannasional($tahun=null,$nis=null)
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Entry Nilai Ujian Nasional';
		$data_isi["keterangan"] = '';
		$data_isi['nis']= $nis;
		if(empty($tahun))
		{
			$thnajaran = cari_thnajaran();
			$tahun = substr($thnajaran,0,4);
		}
		else
		{
			$tahun2 = $tahun + 1;
			$thnajaran = $tahun.'/'.$tahun2;
		}
		$cacah_mapel =hilangkanpetik($this->input->post('cacah_mapel'));
		if ($cacah_mapel>0)
		{
			$this->load->model('Pengajaran_model');
			$nis =hilangkanpetik($this->input->post('nis'));
			for($i=1;$i<=$cacah_mapel;$i++)
			{
				$un =hilangkanpetik($this->input->post("un_$i"));
				$ns =hilangkanpetik($this->input->post("ns_$i"));
				$na =hilangkanpetik($this->input->post("na_$i"));
				$this->Pengajaran_model->Simpan_Nilai_Un($nis,$un,$ns,$na,$i);
			}
			$data_isi["keterangan"] = '<div class="alert alert-info"><p class="text-success">tersimpan</p></div>';
		}
		$data_isi['thnajaran'] = $thnajaran;
		$data_isi['semester'] = '2';
		$data_isi['tahun'] = $tahun;
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$data_isi['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		if($tahun == 2017)
		{
			$this->load->view('pengajaran/nilai_ujian_nasional_2018',$data_isi);
		}
		elseif(($tahun == 2015) or ($tahun == 2016))
		{
			$this->load->view('pengajaran/nilai_ujian_nasional_2017',$data_isi);
		}
		else
		{
			$this->load->view('pengajaran/nilai_ujian_nasional',$data_isi);
		}
		$this->load->view('shared/bawah');
	}
	function melihatnilaisiswa($tahun1=null,$semester=null,$id_kelas=null,$nis=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Siswa Per Semester';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_kelas'] = $id_kelas;
		$datax['nis']= $nis;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/melihat_nilai_siswa',$datax);
		$this->load->view('shared/bawah');
	}
/*
	function statusnilai()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['mapel']=hilangkanpetik($this->input->post('mapel'));
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/status_nilai',$datax);
		$this->load->view('shared/bawah');
	}
*/
	function jurusan()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['aksi'] = $this->uri->segment(3);
		$data['id'] = $this->uri->segment(4);
		if($data['aksi'] == 'tambah')
		{
			$data['judulhalaman'] = 'Tambah Jurusan / Program Studi / Peminatan';
		}
		elseif($data['aksi'] == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Jurusan / Program Studi / Peminatan';
		}
		else
		{
			$data['judulhalaman'] = 'Jurusan / Program Studi / Peminatan';
		}
		$this->load->model('Pengajaran_model');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/jurusan');
		$this->load->view('shared/bawah');
	}
	function simpanjurusan()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['program']=hilangkanpetik($this->input->post('program'));
		$datax['id']=hilangkanpetik($this->input->post('id'));
		$datax['category_majors_id']=hilangkanpetik($this->input->post('category_majors_id'));
		if ((!empty($datax['program'])) and (empty($datax['id'])))
		{
			$this->Pengajaran_model->Simpan_Jurusan($datax);
		}
		if ((!empty($datax['program'])) and (!empty($datax['id'])))
		{
			$this->Pengajaran_model->Update_Jurusan($datax);
		}
		redirect('pengajaran/jurusan');
	}
	function cetaklck()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak LCK Ringkas';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_kelas'] = $this->uri->segment(5);
		$datax['status_nilai'] = $this->uri->segment(6);
		$datax['abaikan'] = $this->uri->segment(7);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/cetak_lck',$datax);
		$this->load->view('shared/bawah');
	}
	function konversinilai()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Konversi Nilai';
		$this->load->model('Pengajaran_model');
		$data_isi['id_predikat']=$this->uri->segment(3);
		$in['id_predikat'] =hilangkanpetik($this->input->post('id_predikat'));
		$in['batas'] =hilangkanpetik($this->input->post('batas'));
		$in['konversi'] =hilangkanpetik($this->input->post('konversi'));
		$in['predikat'] =hilangkanpetik($this->input->post('predikat'));
		$in['predikat_2015'] =hilangkanpetik($this->input->post('predikat_2015'));
		$in['positif'] = hilangkanpetik($this->input->post('positif'));
		$in['keterangan'] =hilangkanpetik($this->input->post('keterangan'));
		$in['keterangan2'] =hilangkanpetik($this->input->post('keterangan2'));
		$diproses =hilangkanpetik($this->input->post('diproses'));
		if ($diproses == 'simpan')
		{
			$this->load->model('Pengajaran_model');
			$this->Pengajaran_model->Simpan_Konversi($in);
		}
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/konversi_nilai',$data_isi);
		$this->load->view('shared/bawah');
	}
	function kepala()
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$page=$this->uri->segment(4);
		$aksi = $this->uri->segment(3);
		$this->load->model('Admin_model');
		$proses = $this->input->post('proses');
		if(($proses == 'baru') or ($proses == 'lama'))
		{
			$thnajaran=hilangkanpetik($this->input->post('thnajaran'));
			$id_kepala=hilangkanpetik($this->input->post('id_kepala'));
			$kodeguru=hilangkanpetik($this->input->post('kodeguru'));
			$semester=hilangkanpetik($this->input->post('semester'));
			$namaguru = cari_nama_pegawai($kodeguru);
			$nipguru = cari_nip_pegawai($kodeguru);
			$in['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
			$in['kodeguru']=hilangkanpetik($this->input->post('kodeguru'));
			$in['semester']=hilangkanpetik($this->input->post('semester'));
			$in['posisi_x']=hilangkanpetik($this->input->post('posisi_x'));
			$in['posisi_y']=hilangkanpetik($this->input->post('posisi_y'));
			$in['lebar']=hilangkanpetik($this->input->post('lebar'));
			$in['tinggi']=hilangkanpetik($this->input->post('tinggi'));
			$in['px_uts']=hilangkanpetik($this->input->post('px_uts'));
			$in['py_uts']=hilangkanpetik($this->input->post('py_uts'));
			$in['l_uts']=hilangkanpetik($this->input->post('l_uts'));
			$in['t_uts']=hilangkanpetik($this->input->post('t_uts'));
			$in['px_kartu']=hilangkanpetik($this->input->post('px_kartu'));
			$in['py_kartu']=hilangkanpetik($this->input->post('py_kartu'));
			$in['l_kartu']=hilangkanpetik($this->input->post('l_kartu'));
			$in['t_kartu']=hilangkanpetik($this->input->post('t_kartu'));
			$in['px_rapor']=hilangkanpetik($this->input->post('px_rapor'));
			$in['py_rapor']=hilangkanpetik($this->input->post('py_rapor'));
			$in['l_rapor']=hilangkanpetik($this->input->post('l_rapor'));
			$in['t_rapor']=hilangkanpetik($this->input->post('t_rapor'));
			if($proses == 'lama')
			{
				$in['nama']=nopetik($this->input->post('nama'));
				$in['nip']=hilangkanpetik($this->input->post('nip'));
			}
			if($proses == 'baru')
			{
				$in['nama']= nopetik($namaguru);
				$in['nip']=hilangkanpetik($nipguru);
			}

			if(empty($id_kepala))
			{
				$this->Admin_model->Simpan_Kepala($in);
			}
			else
			{
				$in['id_kepala']= $id_kepala;
				$this->Admin_model->Perbarui_Kepala($in);
			}

		}
		if($aksi == 'tambah')
		{
			$data['daftar_tapel']= $this->Admin_model->Tampil_Semua_Tahun();
			$data['daftar_guru']= $this->Admin_model->Semua_Guru();

			$data['judulhalaman'] = 'Tambah Penjabat Kepala';
			$data_isi['aksi'] = $aksi;
		}
		elseif($aksi == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Penjabat Kepala';
			$data_isi['aksi'] = $aksi;
			$data_isi['id'] = $page;
			$data_isi['daftar_guru']= $this->Admin_model->Pegawai_Guru();
		}
		else
		{
			$data['judulhalaman'] = 'Penjabat Kepala';
			$limit_ti=14;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->model('Admin_model');
			$this->load->library('Pagination');
			$query=$this->Admin_model->Tampil_Semua_Kepala($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Semua_Kepala();
			$config['base_url'] = base_url() . 'pengajaran/kepala/tampil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
       			$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'aksi'=>'');
		}
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/kepala',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tambahkepala()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Admin_model');
		$data['daftar_tapel']= $this->Admin_model->Tampil_Semua_Tahun();
		$data['daftar_guru']= $this->Admin_model->Semua_Guru();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/tambah_kepala');
		$this->load->view('shared/bawah');
	}
	function editkepala()
	{
		$data = array();
		$this->load->model('Admin_model');
		$data['nim']=$tanda = $this->session->userdata('username');
		$data['nama']=$this->session->userdata('nama');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data['id']=$id;
		$data['daftar_guru']= $this->Admin_model->Pegawai_Guru();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/edit_kepala',$data);
		$this->load->view('shared/bawah');
	}
	function tahunpenilaianujiannasional()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Tahun Penilaian Nilai Sekolah';
		$this->load->model('Referensi_model','ref');
		$data['jenjang'] = $this->ref->ambil_nilai('jenjang');

		$data_isi['aksi']=$this->uri->segment(3);
		$data_isi['id']=$this->uri->segment(4);
		$data_isi['thnajaranpenilaian']=hilangkanpetik($this->input->post('thnajaranpenilaian'));
		$data_isi['semesterpenilaian']=hilangkanpetik($this->input->post('semesterpenilaian'));
		$data_isi['tingkat']=hilangkanpetik($this->input->post('tingkat'));
		$data_isi['proses']=hilangkanpetik($this->input->post('proses'));
		$this->load->model('Pengajaran_model');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/tahunpenilaian',$data_isi);
		$this->load->view('shared/bawah');
	}
	function matapelajaranujiannasional()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$aksi =$this->uri->segment(3);
		$id=$this->uri->segment(4);
		$data['aksi'] = $aksi;
		$data['id'] = $id;
		$data['judulhalaman'] = 'Mata Pelajaran Ujian Nasional';
		if($aksi == 'tambah')
		{
			$data['judulhalaman'] = 'Tambah Mapel UN';
			$data_isi['aksi'] = $aksi;
		}
		elseif($aksi == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Penjabat Kepala';
			$data_isi['aksi'] = $aksi;

		}
		else
		{
			$data_isi['mapel']=hilangkanpetik($this->input->post('mapel'));
			$data_isi['nmapel']=hilangkanpetik($this->input->post('nmapel'));
			$data_isi['program']=hilangkanpetik($this->input->post('program'));
			$data_isi['no_urut']=hilangkanpetik($this->input->post('no_urut'));
			$data_isi['proses']=hilangkanpetik($this->input->post('proses'));
			$data_isi['pilihan']=hilangkanpetik($this->input->post('pilihan'));
		}
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mapel_un',$data_isi);
		$this->load->view('shared/bawah');
	}
	function hapuskelas()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$this->load->model('Pengajaran_model');
		$this->Pengajaran_model->Hapus_Kelas($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/kelas'>";
	}
	function proses_ubah_daftar_mapel()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		foreach($csvData as $field):
			$pbk['id_mapel'] = $field['id_mapel'];
			$pbk['thnajaran'] = $field['thnajaran'];
			$pbk['semester'] = $field['semester'];
			$pbk['kelas'] = $field['kelas'];
			$pbk['mapel'] = $field['mapel'];
			$pbk['program'] = $field['program'];
			$pbk['tingkat'] = $field['tingkat'];
			$pbk['kodeguru'] = $field['kodeguru'];
			$pbk['kkm'] = $field['kkm'];
			$pbk['kelompok'] = $field['kelompok'];
			$pbk['ranah'] = $field['ranah'];
			$pbk['no_urut_rapor'] = $field['no_urut_rapor'];
			$pbk['jam'] = $field['jam'];
			$pbk['kurikulum'] = $field['kurikulum'];
			$thnajaran = $pbk['thnajaran'];
			$semester = $pbk['semester'];
			$kelas = $pbk['kelas'];
			$mapel = $pbk['mapel'];
			$kodeguru = $pbk['kodeguru'];
			$no_urut_rapor = $field['no_urut_rapor'];
			$this->Pengajaran_model->Ubah_Mapel($pbk);
			$this->Pengajaran_model->Perbarui_Nomor_Urut($thnajaran,$mapel,$no_urut_rapor,$kelas);
			$n++;
		endforeach;
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran/mapelperruang'>";
	}
	function unggahnomorpesertaun()
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Unggah Nomor Peserta UN';
		$page=$this->uri->segment(3);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/unggah_nomor_peserta_un');
		$this->load->view('shared/bawah');
	}
	function proses_impor_siswa()
	{
		$input=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Panitia_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		foreach($csvData as $field):
			$this->Panitia_model->Hapus_Nominasi_UN($field["nis"]);
			$pbk['thnajaran'] = $field["thnajaran"];
			$pbk['no_peserta'] = $field["no_peserta"];
			$pbk['ruang'] = $field["ruang"];
			$pbk['kelas'] = $field["kelas"];
			$pbk['nis'] = $field["nis"];
			$pbk['no_unik'] = $field["no_unik"];
			$this->Panitia_model->Tambah_Nominasi_UN($pbk);
			$n++;
		endforeach;
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengajaran'>";
	}
	function mapeluambn()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Mata Pelajaran UAMBN';
		$this->load->model('Pengajaran_model');
		$data_isi['aksi'] =$this->uri->segment(3);
		$data_isi['id']=$this->uri->segment(4);
		$data_isi['mapel']=hilangkanpetik($this->input->post('mapel'));
		$data_isi['nmapel']=hilangkanpetik($this->input->post('nmapel'));
		$data_isi['program']=hilangkanpetik($this->input->post('program'));
		$data_isi['no_urut']=hilangkanpetik($this->input->post('no_urut'));
		$data_isi['proses']=hilangkanpetik($this->input->post('proses'));
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mapel_uambn',$data_isi);
		$this->load->view('shared/bawah');
	}
function unduhnilaiuambn()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Nilai UAMBN';
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['semester']='2';
		$this->load->model('Pengajaran_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/nilai_uambn_unduh',$datax);
		$this->load->view('shared/bawah');
	}
	function hapusnilaisiswa()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Penghapusan Nilai Siswa';
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']=$this->input->post('semester');
		$datax['mapel']= $this->input->post('mapel');
		$datax['nis']= $this->input->post('nis');
		$datax['konfirmasi'] = $this->input->post('konfirmasi');
		$datax['namasiswa'] = $this->input->post('namasiswa');
		$datax = hilangkanpetik($datax);
		$this->load->model('Pengajaran_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/hapus_nilai_siswa',$datax);
		$this->load->view('shared/bawah');
	}
/*
	function cetakbukurapor($sekarang=null,$id_ruang=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Buku Rapor';
		$this->load->model('Pengajaran_model');
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['nis']=hilangkanpetik($this->input->post('nis'));
		$datax['abaikan']=hilangkanpetik($this->input->post('abaikan'));
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['sekarang'] = $sekarang;
		$datax['id_ruang'] = $id_ruang;
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mencetak_buku_rapor',$datax);
		$this->load->view('shared/bawah');
	}
*/
	function prosesnilaiakhir()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['kelas']=$this->input->post('kelas');
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']=$this->input->post('semester');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$this->load->view('pengajaran/bg_head',$data);
		$datax = hilangkanpetik($datax);
		$this->load->view('pengajaran/proses_nilai_akhir',$datax);
		$this->load->view('shared/bawah');
	}
	function cetakbukurapor($page=null,$tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Buku Rapor';
		$this->load->model('Pengajaran_model');
		$datax['semester']=$semester;
		$datax['tahun1']=$tahun1;
		$datax['id_walikelas'] = $id_walikelas;
		$datax['page'] = $page;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['usere'] = 'pengajaran';
		$data['loncat'] = '';
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('shared/mencetak_buku_lck',$datax);
		$this->load->view('shared/bawah');
	}
	function lihatsemuanilai()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Siswa kelas XII';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['mapel']=hilangkanpetik($this->input->post('mapel'));
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/lihat_semua_nilai',$datax);
		$this->load->view('shared/bawah');
	}
	function daftarpenyerahanhasilbelajar()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$kelas=hilangkanpetik($this->input->post('kelas'));
		$thnajaran=hilangkanpetik($this->input->post('thnajaran'));
		$semester=$this->input->post('semester');
//			$semester='1';
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['tautan_balik'] = 'pengajaran';
		$data['kelas']=$kelas;
		$data['semester']=$semester;
		$data['thnajaran']=$thnajaran;
		if(!empty($thnajaran)) 
//and (!empty($semester)) and (!empty($kelas)))
		{
			$this->load->view('shared/daftar_penyerahan_hasil_belajar',$data);
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('shared/mencetak_daftar_penyerahan_hasil_belajar',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function kriteriakelulusan()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['mapel']=hilangkanpetik($this->input->post('mapel'));
		if ((!empty($datax['thnajaran'])) and(!empty($datax['kelas'])) and (!empty($datax['mapel'])))
		{
			$this->load->view('pengajaran/kriteria_kelulusan_cetak',$datax);
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/kriteria_kelulusan',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function leger()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Leger';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		if ((!empty($datax['thnajaran'])) and(!empty($datax['kelas'])) and (!empty($datax['semester'])))
		{
			$this->load->library('excel');
			$this->load->view('shared/leger_xls',$datax);
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/leger',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function salinnilai()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$datax['id_tapel'] =$this->uri->segment(3);
		$datax['semester'] =$this->uri->segment(4);
		$datax['kodeguru'] =$this->uri->segment(5);
		$datax['id_mapel'] =$this->uri->segment(6);
		$datax['id_mapelx'] =$this->uri->segment(7);
		$datax['itemnilai'] =$this->uri->segment(8);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/salin_nilai',$datax);
		$this->load->view('shared/bawah');
	}
	function unggahlogolck()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Unggah Gambar Latar LCK';
		$nim = $tanda = $this->session->userdata('username');
		$in["posisi_y"] = $this->input->post('posisi_y');
		$in["lebar"]=$this->input->post('lebar');
		$in["tinggi"]=$this->input->post('tinggi');
		$in["pilihan"]=$this->input->post('pilihan');
		$in["ttd"]=$this->input->post('ttd');
		$upload = $this->input->post('upload');
		$this->load->model('Pengajaran_model');
		$in = hilangkanpetik($in);
		if($upload == 'upload')
		{
			$this->Pengajaran_model->Update_Logo($in);
		}
		$data['galat'] = '';
		if(!empty($_FILES['userfile']['name']))
		{
			$config['upload_path'] = 'images/';
			$config['allowed_types'] = 'jpg';
			$config["file_name"] = 'latar.jpg'; //dengan eekstensi
			$config['max_size'] = '1000000';
			$config['max_width'] = '2400';
			$config['max_height'] = '2400';						
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload())
			{
				$data['galat'] = $this->upload->display_errors();
			}
		}

		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/unggah_logo','');
		$this->load->view('shared/bawah');
	}
	function penyesuaiankelassiswa()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Menghapus record nilai Siswa';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_kelas'] = $this->uri->segment(5);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/penyesuaian_kelas_siswa',$datax);
		$this->load->view('shared/bawah');
	}
	function rapor2()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$datax['semester']= $this->uri->segment(4);
		$tahun1 = $this->uri->segment(3);
		$tahun2 = $tahun1 + 1;
		$datax['thnajaran']= $tahun1.'/'.$tahun2;
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['nis']= $this->uri->segment(5);
		$datax['status_nilai']= $this->uri->segment(6);
		$kurikulum= $this->uri->segment(7);
		$datax['tautan']= 'pengajaran';
		$namasiswa = berkas(nis_ke_nama($datax['nis']));
		$datax['siswa'] = 'bukan';
		$datax['judulhalaman'] = 'Rapor_'.$namasiswa.'_'.$tahun1.'_'.$tahun2.'_semester_'.$datax['semester'];
		if($kurikulum == '2015')
		{
			$this->load->view('shared/buku_rapor_html_20151',$datax);
		}
		elseif($kurikulum == '2013')
		{
			$this->load->view('shared/buku_rapor_html_20131',$datax);
		}
		else
		{
			echo 'KTSP is expired';
		}

	}
	function mapelijazah($aksi=null,$tahun1=null,$id_kelas=null,$id=null)
	{
		$data['aksi'] = $aksi;
		$data['tahun1'] = $tahun1;
		$data['id_kelas'] = $id_kelas;
		$id_mapel_rapor = $id;
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Mata Pelajaran Muncul di Ijazah';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$data['aksi'] = $aksi;
		$data['tahun1'] = $tahun1;
		$thnajaran = '';
		if(!empty($data['tahun1']))
		{
			$tahun2 = $data['tahun1'] + 1;
			$thnajaran = $data['tahun1'].'/'.$tahun2;
		}
		if($data['aksi'] == 'hapus')
		{
			$this->Pengajaran_model->Hapus_Mapel_Ijazah($id);
			redirect('pengajaran/mapelijazah/tampil/'.$data['tahun1'].'/'.$data['id_kelas']);
		}
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($data['id_kelas']);
		$proses = $this->input->post('proses');
		if(($proses == "tambah") or ($proses == "ubah"))
		{
			$id = $this->input->post('id');
			$pbx["id"]=$this->input->post('id');
			$pbx['thnajaran']=$this->input->post('thnajaran');
			$pbx['komponen']=$this->input->post('komponen');
			$pbx['teks_mapel'] = $this->input->post('nama_mapel');
			$pbx['mapel']=$this->input->post('nama_mapel_portal');
			$pbx['no_urut']=$this->input->post('no_urut');
			$pbx['kelas'] =$this->input->post('kelas');
			if(!empty($id))
			{
				$pbx= hilangkanpetik($pbx);
				$this->Pengajaran_model->Update_Mapel_Ijazah($pbx);
				$datax["id"]=$id;
			}
			else
			{
				$pbx= hilangkanpetik($pbx);
				$this->Pengajaran_model->Tambah_Mapel_Ijazah($pbx);

			}
			redirect('pengajaran/mapelijazah/tampil/'.$tahun1.'/'.$id_kelas);
		}
		if($proses == 'salin')
		{
			$datax['thnajaran']=$this->input->post('thnajaran');
			$datax['kelas'] =$this->input->post('kelas');
			$datax['thnajaranx']=$this->input->post('thnajaranx');
			$datax['kelasx'] =$this->input->post('kelasx');
			$datax['thnajaran'] = $thnajaran;
			$this->load->view('pengajaran/proses_salin_mapel_ijazah',$datax);
		}
		if($data['aksi'] == 'tambah')
		{
			$data['kelas'] = $kelas;
			$data['judulhalaman'] = 'Tambah Mapel Ijazah';
		}
		if($data['aksi'] == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Mapel Ijazah';
		}
		$datax['id' ] = $id;
		$datax['thnajaran' ] = $thnajaran;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_mapel']= $this->Pengajaran_model->Mapel_Ijazah($thnajaran);
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/mapel_ijazah',$datax);
		$this->load->view('shared/bawah');
	}
	function legerijazah($tahun1=null,$tahun2=null,$id=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Leger Nilai untuk Ijazah';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$this->load->model('Helper_model','helper');
		if(empty($id))
		{
			$id = 0;
		}
		$datax['id' ] = $id;
		$datax['thnajaran'] = $tahun1.'/'.$tahun2;
		$thnajaran = $tahun1.'/'.$tahun2;
		$data['tahun1'] = $tahun1;
		$data['tahun2'] = $tahun2;
		$daftar_siswa_kelas_xii = $this->Pengajaran_model->Daftar_Siswa_Kelas_XII($thnajaran);
		$data['total_siswa'] = $daftar_siswa_kelas_xii->num_rows();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/leger_ijazah',$datax);
		$this->load->view('shared/bawah');
	}
	function tampillegerijazah($tahun1=null,$tahun2=null,$id_kelas=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Leger Nilai untuk Ijazah';
		$data['loncat'] = '';
		$data['tahun1'] = $tahun1;
		$data['tahun2'] = $tahun2;
		$data['id_kelas'] = $id_kelas;
		$this->load->model('Pengajaran_model');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/leger_ijazah_tampil');
		$this->load->view('shared/bawah');
	}
	function legerijazahnamasaja($id=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Data Awal Leger Nilai untuk Ijazah';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		if(empty($id))
		{
			$id = 0;
		}
		$datax['id' ] = $id;
		$thnajaran = cari_thnajaran();
		$datax['thnajaran' ] = $thnajaran;
		$daftar_siswa_kelas_xii = $this->Pengajaran_model->Daftar_Siswa_Kelas_XII($thnajaran);
		$data['total_siswa'] = $daftar_siswa_kelas_xii->num_rows();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/leger_ijazah_nama_saja',$datax);
		$this->load->view('shared/bawah');
	}
	function transfernilaipsikomotor($id=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Transfer Nilai Psikomotor';
		$data['loncat'] = '';
		$data['adamenu'] = '';
		if(empty($id))
		{
			$id = 0;
		}
		$datax['id' ] = $id;
		$this->load->view('shared/bg_head_min',$data);
		$this->load->view('pengajaran/transfer_nilai_psikomotor',$datax);
	}
	function gurutik()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Pembagian Tugas Guru TIK';
		$aksi=$this->uri->segment(3);
		$tahun1 = $this->uri->segment(4);
		$semester = $this->uri->segment(5);
		$id_kelas = $this->uri->segment(6);
		$id_mapel = $this->uri->segment(7);
		$data['aksi'] = $aksi;
		$this->load->model('Pengajaran_model');
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_kelas);
		$thnajaran = '';
		if($aksi == 'ubah')
		{
			$data['judulhalaman'] = 'Ubah Pembagian Tugas Guru';
			$data['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
			$data['id_mapel'] = $id_mapel;
		}
		if($aksi == 'tambah')
		{
			$data['daftar_guru']= $this->Pengajaran_model->Semua_Guru();
			$data['id_kelas']= $id_kelas;
			$data['kelas'] = $kelas;
			$data['judulhalaman'] = 'Tambah Pembagian Tugas Guru';
		}

		if($aksi == 'hapus')
		{
			$this->Pengajaran_model->Hapus_Bimtik_Mapel($id_mapel);
			redirect('pengajaran/gurutik/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas);
		}

		if(!empty($tahun1))
		{
			$tahun2 = $tahun1 + 1;
			$thnajaran = $tahun1.'/'.$tahun2;
		}

		$datax['id_kelas']= $id_kelas;
		$datax['thnajaran']=$thnajaran;
		$datax['semester']= $semester;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/guru_tik',$datax);
		$this->load->view('shared/bawah');
	}
	function pembagiantugasbktik()
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$this->load->model('Pengajaran_model');
		$thnajaran = hilangkanpetik($this->input->post('thnajaran'));
		$semester = hilangkanpetik($this->input->post('semester'));
		$kelas = hilangkanpetik($this->input->post('kelas'));
		$kodeguru = hilangkanpetik($this->input->post('kode_guru'));

		if ((!empty($kodeguru)) and (!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
		{
			$pbk['thnajaran'] = hilangkanpetik($this->input->post('thnajaran'));
			$pbk['semester'] = hilangkanpetik($this->input->post('semester'));
			$pbk['kelas'] = hilangkanpetik($this->input->post('kelas'));
			$pbk['kodeguru'] = hilangkanpetik($this->input->post('kode_guru'));
			$pbk['kkm'] = hilangkanpetik($this->input->post('kkm'));
			$pbk['jam'] = hilangkanpetik($this->input->post('jam'));
			$pbk['ranah'] = hilangkanpetik($this->input->post('ranah'));
			$cek = $this->Pengajaran_model->Cek_Bimtik_Mapel($thnajaran,$semester,$kelas,$kodeguru);
			$ada = $cek->num_rows();
			$this->Pengajaran_model->Add_Bimtik_Mapel($pbk,$ada);
		}
		$tahun1 = substr($thnajaran,0,4);
		redirect('pengajaran/gurutik/tampil/'.$tahun1.'/'.$semester);
	}
	function leger2($tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Lihat Leger';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['tahun1']= $tahun1;
		$datax['id_walikelas']= $id_walikelas;
		$datax['semester']= $semester;
		if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_walikelas)))
		{
			$this->load->view('shared/bg_atas_cetak_landscape',$data);
			$this->load->view('pengajaran/leger_html_tampil',$datax);
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/leger_html',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function nomorurut($tahun1=null,$semester=null,$id=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Lihat Leger';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['tahun1']= $tahun1;
		$datax['semester']= $semester;
		if($id<1)
		{
			$id = 0;
		}
		$datax['id']= $id;

		if($id>0)
		{
			$this->load->view('pengajaran/proses_nomor_urut_mapel',$datax);
		}
		else
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/nomor_urut_mapel',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function peringkatparalel($tahun1=null,$semester=null,$tingkat=null,$id_jurusan=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Peringkat Paralel Siswa';
		$data['loncat'] = '';
		$thnajaran = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1 + 1;
			$thnajaran = $tahun1.'/'.$tahun2;
		}
		$this->load->model('Referensi_model','ref');
		$datax['jenjang'] = $this->ref->ambil_nilai('jenjang');
		$this->load->model('Pengajaran_model');
		$datax['tingkat']= $tingkat;
		$datax['tautan'] = 'pengajaran';
		$datax['tahun1']= $tahun1;
		$datax['thnajaran']=$thnajaran;
		$datax['id_jurusan']=$id_jurusan;
		$datax['semester']=$semester;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		if (empty($id_jurusan))
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/peringkat_paralel_siswa',$datax);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('pengajaran/rekap_peringkat_paralel_siswa',$datax);
		}
	}
	function ratarapor($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Rata - rata rapor';
		if(empty($id))
		{
			$id = 0;
		}
		$data['id'] = $id;
		$data['adamenu'] = '';
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/leger_ijazah_2018',$data);
		$this->load->view('shared/bawah');
	}
	function periksanilairapor($tahun1=null, $semester=null, $kodeguru=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Memeriksa Nilai Rapor';
		$this->load->model('Pengajaran_model');
		$data['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$data['kodeguru'] = $kodeguru;
		$data['loncat'] = '';
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/memeriksa_rapor',$data);
		$this->load->view('shared/bawah');
	}
	function periksanilairapormapel($tahun1=null, $semester=null, $id_walikelas=null,$limit=null,$aksi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Memeriksa Nilai Rapor';
		$this->load->model('Pengajaran_model');
		$data['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$data['id_walikelas'] = $id_walikelas;
		$data['limit'] = $limit;
		$data['aksi'] = $aksi;
		$data['loncat'] = '';
		$this->load->model('Referensi_model','ref');
		$data['token_bot'] = $this->ref->ambil_nilai('token_bot');
		$data['id_admin'] = $this->ref->ambil_nilai('chat_id_admin');
		$data['url_sms_post'] = $this->ref->ambil_nilai('url_sms_post');
		$this->load->helper('telegram');
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/memeriksa_rapor_mapel',$data);
		$this->load->view('shared/bawah');
	}

	function rataraporpermapel($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Rata - rata nilai rapor';
		if(empty($id))
		{
			$id = 0;
		}
		$data['id'] = $id;
		$data['id_mapel'] = $id_mapel;
		$data['loncat'] = '';
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/rata_rata_rapor_per_mapel',$data);
		$this->load->view('shared/bawah');
	}
	function entrynilaiuambn($tahun=null,$nis=null)
	{
		$data=array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Entry Nilai UAMBN';
		$data_isi["keterangan"] = '';
		$data_isi['nis']= $nis;
		if(empty($tahun))
		{
			$thnajaran = cari_thnajaran();
			$tahun = substr($thnajaran,0,4);
		}
		else
		{
			$tahun2 = $tahun + 1;
			$thnajaran = $tahun.'/'.$tahun2;
		}
		$cacah_mapel =hilangkanpetik($this->input->post('cacah_mapel'));
		if ($cacah_mapel>0)
		{
			$this->load->model('Pengajaran_model');
			$nis =hilangkanpetik($this->input->post('nis'));
			$pesan = nis_ke_nama($nis).'<table class="table table-bordered"><tr><td>Mapel</td><td>Tertulis</td><td>Praktik</td></tr>';
			for($i=1;$i<=$cacah_mapel;$i++)
			{
				$tulis =hilangkanpetik($this->input->post("tulis_$i"));
				$praktik =hilangkanpetik($this->input->post("praktik_$i"));
				$mapel =hilangkanpetik($this->input->post("mapel_$i"));
				$this->Pengajaran_model->Simpan_Nilai_UAMBN($nis,$tulis,$praktik,$mapel);
				$pesan .= '<td>'.$mapel.'</td><td>'.$tulis.'</td><td>'.$praktik.'</td></tr>';
			}
			$pesan .= '</table>';
			$data_isi["keterangan"] = '<div class="alert alert-info"><p>tersimpan</p></div>'.$pesan;
		}
		$data_isi['thnajaran'] = $thnajaran;
		$data_isi['semester'] = '2';
		$data_isi['tahun'] = $tahun;
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$data_isi['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/nilai_uambn_entry',$data_isi);
		$this->load->view('shared/bawah');
	}
	function sikapspiritual($tahun1=null, $semester=null, $id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Memeriksa Sikap Sosial dan Spritual';
		$this->load->model('Pengajaran_model');
		$data['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$data['id_walikelas'] = $id_walikelas;
		$data['loncat'] = '';
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/memeriksa_sikap_spritual',$data);
		$this->load->view('shared/bawah');
	}
	function deskripsiketerampilan($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Deskripsi Keterampilan';
		$this->load->model('Guru_model','guru');
		$tmapel = $this->guru->Id_Mapel_Saja($id_mapel);
		if(empty($id))
		{
			$id = 0;
		}
		if ($tmapel->num_rows() >0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$thnajaran = $dtmapel->thnajaran;
				$semester =  $dtmapel->semester;
				$kelas = $dtmapel->kelas;
				$ranah = $dtmapel->bobot_mid;
				$mapel = $dtmapel->mapel;
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
				$kkm = $dtmapel->kkm;
				$kodeguru = $dtmapel->kodeguru;
			}
			$data['adamenu'] = '';
			$datasiswakelas = $this->guru->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			$data['total_siswa'] = $datasiswakelas->num_rows();
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['ranah'] = $ranah;
			$data['mapel'] = $mapel;
			$data['kodeguru'] = $kodeguru;
			$data['jenis_deskripsi'] = $jenis_deskripsi;
			$data['id'] = $id;
			$data['id_mapel'] = $id_mapel;
			$data['kkm'] = $kkm;
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/deskripsi_keterampilan',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}
	function telegram($id_mapel=null,$persenkunci=null,$persenbelumtuntas=null,$persentuntas=null,$tidaksesuai=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Kirim Telegram';
		$this->load->model('Guru_model','guru');
		$tmapel = $this->guru->Id_Mapel_Saja($id_mapel);

		if ($tmapel->num_rows() >0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$thnajaran = $dtmapel->thnajaran;
				$semester =  $dtmapel->semester;
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$kodeguru = $dtmapel->kodeguru;
			}
			$data['adamenu'] = '';
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['mapel'] = $mapel;
			$data['kodeguru'] = $kodeguru;
			$data['id_mapel'] = $id_mapel;
			$data['chat_id_guru'] = cari_chat_id_pegawai($kodeguru);
			$data['nama_guru'] = cari_nama_pegawai($kodeguru);
			$data['sistem'] = 'terkunci '.$persenkunci.'%, tuntas '.$persentuntas.' siswa, belum tuntas '.$persenbelumtuntas.' siswa';
			$data['isi'] = '';
			if($persenkunci == 100)
			{
				$data['isi'] = 'Terima kasih. Sudah sesuai Sianis.';
			}
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/kirim_telegram',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}
	function posttelegram()
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$this->load->helper('telegram');
		$isi=hilangkanpetik($this->input->post('isi'));
		$mapel=hilangkanpetik($this->input->post('mapel'));
		$kelas=hilangkanpetik($this->input->post('kelas'));
		$sistem=hilangkanpetik($this->input->post('sistem'));
		$chat_id_guru=hilangkanpetik($this->input->post('chat_id_guru'));
		$pesan = 'Mapel '.$mapel.' Kelas '.$kelas.' '.$sistem.'. '.$isi;
		$kirimpesan = kirimtelegram($chat_id_guru,$pesan,$token_bot);
		if($kirimpesan == 1)
		{
			echo 'Terkirim';
		}
		else
		{
			echo 'Galat, tidak terkirim';
		}
	}
/*
	function peringkatotomatis($id_walikelas=null,$siswa=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Peringkat Siswa';
		$data['thnajaran']=cari_thnajaran();
		$data['semester']=cari_semester();
		$data['id_walikelas']= $id_walikelas;
		$data['siswa']= $siswa;
		$data['adamenu'] = '';
		$this->load->view('pengajaran/bg_head',$data);
		$this->load->view('pengajaran/proses_peringkat',$data);
		$this->load->view('shared/bawah');


	}
*/

}//akhir fungsi

?>
