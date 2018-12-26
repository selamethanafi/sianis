<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="admin")
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
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Beranda Admin';
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'admin';
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
		$this->load->view('admin/bg_head',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}
	function tampilansitus()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'admin';
		$data['judulhalaman'] = 'Ganti Tema Tampilan';
		$data['pesan'] = '';
		$proses=$this->input->post('proses');
		if(!empty($proses))
		{
			$temacss=$this->input->post('temacss');
			$this->load->model('Guru_model');
			$in['user'] = '00';
			$in['temacss'] = $temacss;
			$this->Guru_model->Update_Tema($in);
			$data['pesan'] = '<div class="alert alert-success">Tema tampilan situs diperbarui</div>';
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/ganti_css',$data);
		$this->load->view('shared/bawah');
	}

function guru()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Pengguna Guru';
		$aksi =$this->uri->segment(3);
		$page=$this->uri->segment(4);
		if(empty($aksi))
		{
			$aksi = 'tampil';
		}
 $limit_ti=10;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Admin_model');
		$this->load->library('Pagination');
		$tampilsemuaguru=$this->Admin_model->Tampil_Semua_Guru($limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_Guru();
 $config['base_url'] = base_url() . 'admin/guru/tampil';
  $config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
  $data_isi = array('query' => $tampilsemuaguru,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/guru',$data_isi);
		$this->load->view('shared/bawah');
	}
	function siswa()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Login Pengguna Aktif';
		$page=$this->uri->segment(3);
 $limit_ti=10;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Admin_model');
		$this->load->library('Pagination');
		$query=$this->Admin_model->Tampil_Semua_Siswa_Aktif($limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_Siswa_Aktif();
 $config['base_url'] = base_url() . 'admin/siswa';
  $config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
  $data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/siswa',$data_isi);
		$this->load->view('shared/bawah');
	}
	function simpanuser()
	{
		$this->load->library('form_validation');
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Admin_model');
		$this->form_validation->set_rules('username', 'Nama Pengguna (username)', 'trim|required|alpha_dash|min_length[2]|max_length[30]|is_unique[tbllogin.username]');
		if ($this->form_validation->run() == FALSE)
	        {
			// fails
			$data_isi['aksi'] = 'tambah';
			$data['judulhalaman'] = 'Tambah Pengguna';
			$data_isi['galat1'] = form_error('username');
			$this->load->view('admin/bg_head',$data);
			$this->load->view('admin/pengguna',$data_isi);
			$this->load->view('shared/bawah');
	        }
		else
		{
			$username=nopetik($this->input->post('username'));
			$nama=nopetik($this->input->post('nama'));
			$psw=$this->input->post('pswd');
			$tipeuser=$this->input->post('tipeuser');
			$this->Admin_model->Simpan_Login_User($username,$nama,$tipeuser);
			$psw=$this->input->post('pswd');
			$options = array('cost' => 8);
			if(!empty($psw))
			{
				$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
			}
			$this->Admin_model->Update_User($username,$psw,$nama,$tipeuser,'','Y');
			if ($tipeuser == 'Pegawai')
			{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/pegawai'>";
			}
			elseif ($tipeuser == 'Siswa')
			{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/siswa'>";
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/pengguna'>";
			}
		}
	}
	function updateuser()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = '???';
		$this->load->model('Admin_model');
		$tgl = " %Y-%m-%d";
		$jam = "%h:%i:%a";
		$time = time();
		$username=nopetik($this->input->post('username'));
		$nama=nopetik($this->input->post('nama'));
		$idlink=nopetik($this->input->post('idlink'));
		$tipeuser=$this->input->post('tipeuser');
		$psw=$this->input->post('pswd');
		$aktif=$this->input->post('aktif');
		$options = array('cost' => 8);
		if(!empty($psw))
		{
			$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
		}
		$this->Admin_model->Update_User($username,$psw,$nama,$tipeuser,$idlink,$aktif);
		if($tipeuser == 'PA')
		{
			$config['upload_path'] = 'images/ttd/';
			$config['allowed_types'] ='bmp|jpg|jpeg';
			$config['file_name'] = md5($this->config->item('awalttd')."-".$username);
			$config['max_size'] = '100000';
			$config['max_width'] = '640';
			$config['max_height'] = '640';	
			$config['overwrite'] = TRUE;				
			$this->load->library('upload', $config);
			if(empty($_FILES['userfile']['name']))
				{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/guru'>";
			
				}
				else
				{
					if(!$this->upload->do_upload())
					{
				 	echo $this->upload->display_errors();
					}
					else {
					$file_ext = strrchr($_FILES['userfile']['name'], '.');
					$filettd= md5($this->config->item('awalttd')."-".$username).''.$file_ext.'';
					$this->Admin_model->Update_Ttd_Guru($username,$filettd);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/guru'>";
					}
				}
		}
		elseif($tipeuser == 'Siswa')
			{
			$this->db->query("update `datsis` set `chat_id`='$idlink' where `nis`='$username'");
			redirect('admin/siswa');
			}
		elseif($tipeuser == 'Pegawai')
			{
			redirect('admin/pegawai');
			}

		else
		{	redirect('admin/pengguna');
		}	
	}
	function pegawai()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Login Pegawai';
		$page=$this->uri->segment(3);
 $limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Admin_model');
		$this->load->library('Pagination');
		$tampilsemuapegawai=$this->Admin_model->Tampil_Semua_pegawai($limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_pegawai();
 $config['base_url'] = base_url() . 'admin/pegawai';
  $config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
  $data_isi = array('query' => $tampilsemuapegawai,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pegawai',$data_isi);
		$this->load->view('shared/bawah');
	}
	function editsiswa()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$this->load->model('Admin_model');
		$data['nim']=$this->session->userdata('username');
		$data['nama']=$this->session->userdata('nama');
		$data['status']=$this->session->userdata('tanda');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
	    		$id='';
		}
		else
		{
	    		$id = $this->uri->segment(3);
		}
		$data['tampilloginsiswa']=$this->Admin_model->Tampil_Login_siswa($id);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/edit_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function pengguna()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pengguna';
		$aksi =$this->uri->segment(3);
		$page=$this->uri->segment(4);
		$this->load->model('Admin_model');
		$data['galat1'] = '';
		if(empty($aksi))
		{
			$aksi = 'tampil';
		}
		if($aksi == 'tambah')
		{
			$data['judulhalaman'] = 'Tambah Pengguna';
		}
		elseif($aksi == 'edit')
		{
			$data['judulhalaman'] = 'Ubah Login Pengguna';
			$data['pengguna'] = $page;
		}


		else
		{
 	$limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$tampilsemuatu=$this->Admin_model->Tampil_Semua_User($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_User();
			$config['base_url'] = base_url() . 'admin/pengguna/tampil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
			$data_isi = array('query' => $tampilsemuatu,'paginator'=>$paginator, 'page'=>$page);
		}
		$data_isi['aksi'] = $aksi;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pengguna',$data_isi);
		$this->load->view('shared/bawah');
	}
	function hapuspengguna()
	{
		$in=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Konfirmasi Hapus Pengguna';
		$pengguna='';		
		if ($this->uri->segment(3) === FALSE)
		{
    		$pengguna='';
		}
		else
		{
    		$pengguna = balikin($this->uri->segment(3));
		}
		$namapengguna = $this->input->post('namapengguna');
		if(!empty($namapengguna))
			{
			$this->load->model('Admin_model');
			$this->Admin_model->Delete_User($namapengguna);
			$this->Admin_model->Delete_Data_Pengguna($namapengguna);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/pengguna'>";
			}
			else
			{
				$data_isi['pengguna'] = $pengguna;
				$this->load->view('admin/bg_head',$data);
				$this->load->view('admin/konfirmasi_hapus_pengguna',$data_isi);
				$this->load->view('shared/bawah');
			}
	}
	function hapusdatapengguna()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hapus Data Pengguna';
		$pengguna='';		
		if ($this->uri->segment(3) === FALSE)
		{
	    		$pengguna='';
		}
		else
		{
    		$pengguna = balikin($this->uri->segment(3));
		}
		if(!empty($pengguna))
			{
			$this->load->model('Admin_model');
			$this->Admin_model->Delete_Data_id_Pengguna($pengguna);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."admin/hapusdatapengguna'>";
			}
		else
			{
			$this->load->view('admin/bg_head',$data);
			$this->load->view('admin/hapus_pengguna','');
			$this->load->view('shared/bawah');
			}
	}
	function hapusloginsiswa()
	{
		$in=array();
		$data["nim"]=$this->session->userdata('username');
    		$pengguna = balikin($this->uri->segment(3));
		$this->load->model('Admin_model');
		$this->Admin_model->Delete_User_Siswa($pengguna);
		redirect('admin/siswa');
	}
	function terdaftar($pengguna=null,$chat_id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pengguna Terdaftar';
		$pengguna =balikin($pengguna);
		$this->load->helper('telegram');
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		if((!empty($chat_id)) and (!empty($token_bot)))
		{
			$pesan = 'Akun Anda di '.$this->config->item('sek_website').' telah diaktifkan';
			$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
		}
		$this->load->model('Admin_model');
		if(!empty($pengguna))
		{
			$this->Admin_model->Aktifkan_User($pengguna);
			redirect('admin/terdaftar');
		}
		$data_isi['tampilsemua'] =$this->Admin_model->Tampil_Semua_User_Terdaftar();
		
		$data_isi['pengguna'] = $pengguna;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pengguna_terdaftar',$data_isi);
		$this->load->view('shared/bawah');
	}
	function kepala()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pengguna Status Kepala';
		$this->load->model('Admin_model');
		$tampilsemuatu=$this->Admin_model->Total_Kepala();
		$data_isi = array('query' => $tampilsemuatu, 'page'=>'', 'aksi' => '');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pengguna',$data_isi);
		$this->load->view('shared/bawah');
	}
	function agenda()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$aksi=$this->uri->segment(3);
		$data['aksi'] = $aksi;
		$data['tautan'] = 'admin';
		$proses=$this->input->post('proses');
		$this->load->model('Admin_model');
		if($proses == 'kirim')
		{
			$tgl = " %Y-%m-%d";
			$time = time();
			$in["tgl_posting"] = mdate($tgl,$time);
			$in["tema_agenda"]=$this->input->post('judul');
			$in["isi"]=strip_tags($this->input->post('isi'));
			$t_mulai=$this->input->post('tgl_mulai');
			$b_mulai=$this->input->post('bln_mulai');
			$y_mulai=$this->input->post('thn_mulai');
			$in["tgl_mulai"]="".$y_mulai."-".$b_mulai."-".$t_mulai."";
			$t_selesai=$this->input->post('tgl_selesai');
			$b_selesai=$this->input->post('bln_selesai');
			$y_selesai=$this->input->post('thn_selesai');
			$in["tgl_selesai"]="".$y_selesai."-".$b_selesai."-".$t_selesai."";
			$in["tempat"]=$this->input->post('tempat');
			$in["jam"]=$this->input->post('jam');
			$in["keterangan"]=strip_tags($this->input->post('keterangan'));
			$in = nopetik($in);
			$this->Admin_model->Simpan_Agenda($in);
		}
		if($proses == 'ubah')
		{	$this->load->model('Admin_model');
			$in["id_agenda"]=$this->input->post('id_agenda');
			$in["tema_agenda"]=$this->input->post('judul');
			$in["isi"]=strip_tags($this->input->post('isi'));
			$t_mulai=$this->input->post('tgl_mulai');
			$b_mulai=$this->input->post('bln_mulai');
			$y_mulai=$this->input->post('thn_mulai');
			$in["tgl_mulai"]="".$y_mulai."-".$b_mulai."-".$t_mulai."";
			$t_selesai=$this->input->post('tgl_selesai');
			$b_selesai=$this->input->post('bln_selesai');
			$y_selesai=$this->input->post('thn_selesai');
			$in["tgl_selesai"]="".$y_selesai."-".$b_selesai."-".$t_selesai."";
			$in["tempat"]=$this->input->post('tempat');
			$in["jam"]=$this->input->post('jam');
			$in["keterangan"]=strip_tags($this->input->post('keterangan'));
			$in = nopetik($in);
			$this->Admin_model->Update_Agenda($in);
		}
		if(empty($aksi))
		{
			$data['aksi'] = 'tampil';
			$data["judulhalaman"]= 'Daftar Agenda';
		}
		$page=$this->uri->segment(4);
		if($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Daftar Agenda';
			$tgl = "%d-%m-%Y";
			$time = time();
			$data['tekseditor'] = '';
			$data["wkt_skr"] = mdate($tgl,$time);
			$data_isi = array('id'=>$page);
		}
		elseif($aksi == 'tambah')
		{
			$tgl = "%d-%m-%Y";
			$time = time();
			$data["judulhalaman"]= 'Tambah Agenda';
			$data['tekseditor'] = '';
			$data["wkt_skr"] = mdate($tgl,$time);
			$data_isi= '';
		}
		elseif($aksi == 'hapus')
		{
			$this->load->model('Admin_model');
			$this->Admin_model->Delete_Agenda($page);
			redirect('admin/agenda/tampil');

		}
		else
		{
			$data["judulhalaman"]= 'Daftar Agenda';
	 $limit_ti=15;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$query=$this->Admin_model->Tampil_Agenda($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Agenda();
 	$config['base_url'] = base_url() . 'admin/agenda/tampil';
  	$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
   $data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('shared/agenda',$data_isi);
		$this->load->view('shared/bawah');
	}
	function berita()
	{
		$data["nim"]=$this->session->userdata('username');
		$namauser=$this->session->userdata('nama');
		$aksi=$this->uri->segment(3);
		$page=$this->uri->segment(4);
		$data['aksi'] = $aksi;
		$data['tautan'] = 'admin';
		$this->load->model('Admin_model');
		$proses = $this->input->post('proses');
		$galat_upload = '';
		if($proses == 'baru')
		{
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$in=array();
			$in['judul_berita']=$this->input->post('judul');
			$in['id_kategori']=$this->input->post('kategori');
			$in['isi']=$this->input->post('isi');
			$in['author']=$namauser;		
			$in["tanggal"] = mdate($tgl,$time);
			$in["waktu"] = mdate($jam,$time);
			$in["counter"] = 0;
			$in = nopetik($in);
			$this->Admin_model->Simpan_Berita($in);
			redirect('admin/berita/tampil');
		}
		if($proses == 'ubah')
		{
			if(empty($_FILES['userfile']['name']))
			{
				$in["judul_berita"]=$this->input->post('judul');
				$in["isi"]=$this->input->post('isi');
				$in["id_berita"]=$this->input->post('id_berita');
				$in["id_kategori"]=$this->input->post('kategori');
				$in["penuh"]=$this->input->post('penuh');
				$in["author"]=$this->input->post('author');
				$in = nopetik($in);
				$this->Admin_model->Update_Berita($in);
				redirect('admin/berita/tampil');
				
			}
			else
			{
				$config['upload_path'] = 'images/berita/';
				$config['allowed_types'] ='bmp|gif|jpg|jpeg|png';
				$config['file_name'] = 'berita_'.$this->input->post('id_berita').'';
				$config['max_size'] = '100000';
				$config['max_width'] = '1200';
				$config['max_height'] = '1200';						
				$config['overwrite'] = TRUE;					
				$this->load->library('upload', $config);
				$in2["judul_berita"]=$this->input->post('judul');
				$in2["isi"]=$this->input->post('isi');
				$in2["id_berita"]=$this->input->post('id_berita');
				$file_ext = strrchr($_FILES['userfile']['name'], '.');
				$in2["id_kategori"]=$this->input->post('kategori');
				if(!$this->upload->do_upload())
				{
					$this->Admin_model->Update_Berita($in2);
					$galat_upload = $this->upload->display_errors();
				}
				else
				{
					$in2["gambar"]= 'berita_'.$this->input->post('id_berita').''.$file_ext.'';
					$this->Admin_model->Update_Berita($in2);
				}

			}
		}
		if(empty($aksi))
		{
			$data['aksi'] = 'tampil';
			$data["judulhalaman"]= 'Daftar Berita';
		}
		$page=$this->uri->segment(4);
		if($aksi == 'oke')
		{
			$this->Admin_model->Berita_Utama($page);
			redirect('admin/berita/tampil');
		}
		if($aksi == 'terbit')
		{
			$this->Admin_model->Berita_Tampil($page);
			redirect('admin/berita/tampil');
		}

		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Berita';
			$data['tekseditor'] = '';
			$data['det']=$this->Admin_model->Edit_Berita($page);
			$data['kategori']=$this->Admin_model->Kat_Berita();
			$data_isi = array('id'=>$page);
		}
		elseif($aksi == 'tambah')
		{
			$tgl = "%d-%m-%Y";
			$time = time();
			$data["judulhalaman"]= 'Tambah Berita';
			$data['tekseditor'] = '';
			$data["wkt_skr"] = mdate($tgl,$time);
			$data['kategori']=$this->Admin_model->Kat_Berita();
			$data_isi= '';
		}
		elseif($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Berita($page);
			redirect('admin/berita/tampil');

		}
		else
		{
			$data['galat_upload'] = $galat_upload;
			$data["judulhalaman"]= 'Daftar Berita';
	 $limit_ti=15;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$query=$this->Admin_model->Tampil_Berita($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Berita();
 	$config['base_url'] = base_url() . 'admin/berita/tampil';
  	$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
	        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		$data['galat_upload'] = $galat_upload;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('shared/berita',$data_isi);
		$this->load->view('shared/bawah');
	}
	function katberita()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$aksi=$this->uri->segment(3);
		$data['id']=$this->uri->segment(4);
		$this->load->model('Admin_model');
		$data['aksi'] = $aksi;
		$proses = $this->input->post('proses');
		if($proses == 'baru')
		{
			$in=array();
			$in['nama_kategori']=$this->input->post('nama');
			$in = nopetik($in);
			$this->Admin_model->Simpan_Kat_Berita($in);
		}
		if($proses == 'ubah')
		{
			$in=array();
			$in['id_kategori']=$this->input->post('id_kat');
			$in['nama_kategori']=$this->input->post('nama');
			$in = nopetik($in);
			$this->Admin_model->Update_Kat_Berita($in);
		}
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Kategori Berita';
		}
		elseif($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Kat_Berita($data['id']);
			$data["judulhalaman"]= 'Daftar Kategori Berita';
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Kategori Berita';
		}
		else
		{
			$data["judulhalaman"]= 'Daftar Kategori Berita';
			$data['aksi'] = 'tampil';
		}
		$data['kategori']=$this->Admin_model->Kat_Berita();
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/kat_berita',$data);
		$this->load->view('shared/bawah');
	}
	function pengumuman()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$aksi=$this->uri->segment(3);
		$page=$this->uri->segment(4);
		$proses = $this->input->post('proses');
		$data['aksi'] = $aksi;
		$data['tautan'] = 'admin';
		$this->load->model('Admin_model');
		if($proses == 'baru')
		{
			$tgl = " %Y-%m-%d";
			$time = time();
			$in["tanggal"] = mdate($tgl,$time);
			$in["judul_pengumuman"]=$this->input->post('judul');
			$in["isi"]=$this->input->post('isi');
			$in["penulis"]=$data['nim'];
			$in = nopetik($in);
			$this->Admin_model->Simpan_Pengumuman($in);
		}
		if($proses == 'ubah')
		{
			$in["judul_pengumuman"]=$this->input->post('judul');
			$in["isi"]=$this->input->post('isi');
			$in["id_pengumuman"]=$this->input->post('id_pengumuman');
			$this->load->model('Admin_model');
			$in = nopetik($in);
			$this->Admin_model->Update_Pengumuman($in);
		}
		if($aksi == 'tambah')
		{
			$data_isi = '';
			$data['tekseditor'] = '';
			$data["judulhalaman"]= 'Tambah Pengumuman';
		}
		elseif($aksi == 'hapus')
		{
			$this->Admin_model->Delete_Pengumuman($page);
			$data["judulhalaman"]= 'Daftar Pengumuman';
			redirect('admin/pengumuman/tampil');
		}
		elseif($aksi == 'ubah')
		{
			$data['tekseditor'] = '';
			$data_isi['id'] = $page;
			$data["judulhalaman"]= 'Ubah Pengumuman';
		}
		else
		{
			$data["judulhalaman"]= 'Daftar Pengumuman';
			$data['aksi'] = 'tampil';
	 $limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$query=$this->Admin_model->Tampil_Pengumuman($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Pengumuman();
	 $config['base_url'] = base_url() . 'admin/pengumuman/tampil';
	  $config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
	   		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('shared/pengumuman',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tutorial()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['tautan'] = 'admin';
		$this->load->model('Admin_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		$proses = $this->input->post('proses');
		$data['aksi'] = $aksi;
		$galat_upload = '';
		$this->load->model('Admin_model');
		if($proses == 'baru')
		{
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$in["status"]=$this->input->post('status');
			if(empty($_FILES['userfile']['name']))
			{
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["judul_tutorial"]=$this->input->post('judul');
				$in["isi"]=$this->input->post('isi');
				$in["author"]=$data['nama'];
				$in["id_kategori_tutorial"]=$this->input->post('kategori');
				$in["counter"]=0;
				$in = nopetik($in);
				$this->Admin_model->Simpan_Tutorial($in);
				redirect('admin/tutorial');
			}
			else
			{
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["judul_tutorial"]=$this->input->post('judul');
				$in["isi"]=$this->input->post('isi');
				$in["author"]=$data['nama'];
				$in["id_kategori_tutorial"]=$this->input->post('kategori');
				$in["counter"]=0;
				$in["gambar"]=$_FILES['userfile']['name'];
				$config['upload_path'] = 'images/tutorial/';
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['max_size'] = '10000';
				$config['max_width'] = '460';
				$config['max_height'] = '345';						
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload())
				{
					$in["gambar"]= '';
					$in = nopetik($in);
					$this->Admin_model->Simpan_Tutorial($in);
					$galat_upload = $this->upload->display_errors();

				}
				else 
				{
				$in = nopetik($in);
				$this->Admin_model->Simpan_Tutorial($in);
				redirect('admin/tutorial');
				}
			}
		}
		if($proses == 'ubah')
		{
			$in["status"]=$this->input->post('status');
			$config['upload_path'] = 'images/tutorial/';
			$config['allowed_types'] = '*';
			$config['max_width'] = '1200';
			$config['max_height'] = '1200';	
			$config['overwrite'] = TRUE;;						
			$config['file_name'] = 'materi_'.$this->input->post('id_tutorial').'';
			$this->load->library('upload', $config);
			if(empty($_FILES['userfile']['name']))
			{
				$in["judul_tutorial"]=$this->input->post('judul');
				$in["isi"]=$this->input->post('isi');
				$in["id_tutorial"]=$this->input->post('id_tutorial');
				$in["id_kategori_tutorial"]=$this->input->post('kategori');
				$in = nopetik($in);
				$this->Admin_model->Update_Tutorial($in);
			}
			else{
				$in2["judul_tutorial"]=$this->input->post('judul');
				$in2["isi"]=$this->input->post('isi');
				$in2["id_tutorial"]=$this->input->post('id_tutorial');
				$file_ext = strrchr($_FILES['userfile']['name'], '.');
				$in2["gambar"]= 'materi_'.$this->input->post('id_tutorial').''.$file_ext.'';
				$in2["id_kategori_tutorial"]=$this->input->post('kategori');

				if(!$this->upload->do_upload())
				{
					$in2["gambar"]= '';
					$in2 = nopetik($in2);
					$this->Admin_model->Update_Tutorial($in2);
					$galat_upload = $this->upload->display_errors();

				}
				else 
				{
					$in2 = nopetik($in2);
					$this->Admin_model->Update_Tutorial($in2);
				}
			}
		}
		if($aksi == 'tambah')
		{
			$data_isi = '';
			$data['tekseditor'] = '';
			$data['kategori']=$this->Admin_model->Kat_Tutorial();
			$data["judulhalaman"]= 'Tambah Materi Pelajaran';
		}
		elseif($aksi == 'hapus')
		{
			$this->Admin_model->Delete_Tutorial($page);
			$data["judulhalaman"]= 'Daftar Materi Pelajaran';
			redirect('admin/tutorial/tampil');
		}
		elseif($aksi == 'ubah')
		{
			$data['tekseditor'] = '';
			$data_isi['id'] = $page;
			$data["kategori"]=$this->Admin_model->Edit_Tutorial($page);
			$data["cur_kat"]=$this->Admin_model->Kat_Tutorial();
			$data["judulhalaman"]= 'Ubah Materi Pelajaran';
		}
		else
		{
			$data["judulhalaman"]= 'Daftar Materi Pelajaran';
	 $limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$query=$this->Admin_model->Tampil_Tutorial($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Tutorial();
	 $config['base_url'] = base_url() . 'admin/tutorial/tampil';
	  $config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
	        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		if($aksi == 'tinjau')
			{
			$data["kategori"]=$this->Admin_model->Edit_Tutorial($page);
			$data["cur_kat"]=$this->Admin_model->Kat_Tutorial();
			$this->load->view('admin/bg_head',$data);
			$this->load->view('shared/tutorial_tinjau',$data);
			$this->load->view('shared/bawah');
			}
		else
		{
			$data['galat_upload'] = $galat_upload;
			$this->load->view('admin/bg_head',$data);
			$this->load->view('shared/tutorial',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function carisiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Data Login Siswa';
		$kunci_nama=nopetik($this->input->post('nama'));
		$this->load->view('admin/bg_head',$data);
		$this->load->model('Admin_model');
		if(!empty($kunci_nama))
		{
		
			$data["kunci_nama"]=nopetik($this->input->post('nama'));
			$data['hasilpencarian']=$this->Admin_model->Cari_Siswa($kunci_nama);
			$this->load->view('admin/hasil_cari_siswa',$data);
		}
		else
		{
			$this->load->view('admin/cari_siswa',$data);
		}
		$this->load->view('shared/bawah');
	}
	function ijazah()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Penyesuaian Nomor Ijazah';
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/ijazah',$data);
		$this->load->view('shared/bawah');
	}
	function polling()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		$proses= nopetik($this->input->post('proses'));
		$this->load->model('Admin_model');
		if($proses == 'baru')
		{
			$in=array();
			$in['soal_poll']=$this->input->post('soal_poll');
			$in['status']=$this->input->post('status');
			$in = nopetik($in);
			$this->Admin_model->Simpan_Polling($in);
		}
		if($proses == 'ubah')
		{
			$in=array();
			$in['id_soal_poll']=$this->input->post('id_soal_poll');
			$in['soal_poll']=$this->input->post('soal_poll');
			$in['status']=$this->input->post('status');
			$in = nopetik($in);
			$this->Admin_model->Update_Polling($in);
		}

		$limit_ti=15;
		if(!$page):
			$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$data["judulhalaman"]= 'Daftar Jajak Pendapat';
		$this->load->library('Pagination');
		$query=$this->Admin_model->Polling($limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_Polling();
		$idsoal ='';
		foreach($tot_hal->result() as $t)
		{
			$idsoal = $t->id_soal_poll;
		}
		$tot_jwb = $this->Admin_model->Tampil_Jwb_Polling($idsoal);
		$config['base_url'] = base_url() . 'admin/polling/tampil';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		if($aksi == 'tambah')
		{
			$data_isi = '';
			$data['tekseditor'] = '';
			$data["judulhalaman"]= 'Tambah Jajak Pendapat';
		}
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Polling($page);
			$data["judulhalaman"]= 'Daftar Materi Pelajaran';
			redirect('admin/polling/tampil');
		}
		if($aksi == 'ubah')
		{
			$data['tekseditor'] = '';
			$data_isi['id'] = $page;
			$data["judulhalaman"]= 'Ubah Jajak Pendapat';
		}
		$data['aksi'] = $aksi;
		$data['page'] = $page;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/polling',$data_isi);
		$this->load->view('shared/bawah');
	}
	function jawabanpolling($id_poll=null,$aksi=null,$id_jawaban=null)
	{
		$this->load->model('Admin_model');
		$data['judulhalaman'] = 'Jawaban Polling';
		$data['nim']=$this->session->userdata('username');
		$data['id_poll'] = $id_poll;
		$data['id_jawaban'] = $id_jawaban;
		$data['aksi'] = $aksi;
		$jawaban=$this->input->post('jawaban');
		if(!empty($jawaban))
		{
			$in['jawaban'] =$this->input->post('jawaban');
			$in['id_soal_poll'] = $id_poll;
			$id_jawaban_post =$this->input->post('id_jawaban');
			if(!empty($id_jawaban_post))
			{
				$in['id_jawaban_poll'] =$id_jawaban_post;
				$in = nopetik($in);
				$this->Admin_model->Update_Jawaban_Polling($in);
			}
			else
			{
				$in = nopetik($in);
				$this->Admin_model->Simpan_Jawaban_Polling($in);
			}

		}
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Jawaban_Polling($id_jawaban);
		}
		$data['det']=$this->Admin_model->Edit_Polling($id_poll);
		$data['qjawabanpoll']=$this->Admin_model->Tampil_Jwb_Polling($id_poll);
		$data['tedit_jawaban_polling'] = $this->Admin_model->Edit_Jawaban_Polling($id_jawaban,$id_poll);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/jawaban_polling',$data);
		$this->load->view('shared/bawah');
	}
	function siswanonaktif()
	{
		$this->load->model('Admin_model');
		$data['nim']=$this->session->userdata('username');
		$data['judulhalaman'] = 'Menghapus Siswa Sudah Tidak Aktif di Daftar Kelas';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_kelas'] = $this->uri->segment(5);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/siswa_non_aktif',$datax);
		$this->load->view('shared/bawah');
	}
	function profil()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Profil Madrasah';
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		$data_isi = array();
		$data['aksi'] = $aksi;
		$this->load->model('Admin_model');
		$judul_berita= $this->input->post('judul');
		$id_berita = $this->input->post('id_tutorial'); 
		if(!empty($judul_berita))
		{
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$in=array();
			if(empty($_FILES['userfile']['name']))
			{
				$in['judul_berita']=$this->input->post('judul');
				$in['id_kategori']=$this->input->post('kategori');
				$in['isi']=$this->input->post('isi');
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["id_berita"]=$this->input->post('id_tutorial');
				$in["id_kategori"]=$this->input->post('kategori');
				$in = nopetik($in);
				if(!empty($id_berita))
				{
					$this->Admin_model->Update_Profil($in);
				}
				else
				{
					$this->Admin_model->Simpan_Profil($in);
				}
				redirect('admin/profil/tampil');
			}
			else
			{
				$in["id_berita"]=$this->input->post('id_tutorial');
				$in['judul_berita']=$this->input->post('judul');
				$in['id_kategori']=$this->input->post('kategori');
				$in['isi']=$this->input->post('isi');
				$in['gambar']=$_FILES['userfile']['name'];
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$config['upload_path'] = 'images/profil/';
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['file_name'] = 'profil_'.$this->input->post('id_tutorial').'';
				$config['max_size'] = '10000';
				$config['max_width'] = '460';
				$config['max_height'] = '345';
				$config['overwrite'] = TRUE;										
				$this->load->library('upload', $config);
				$file_ext = strrchr($_FILES['userfile']['name'], '.');
				$in["gambar"]= 'profil_'.$this->input->post('id_tutorial').''.$file_ext.'';
				if(!$this->upload->do_upload())
				{
					 echo $this->upload->display_errors();
				}
				else 
				{
					$in = nopetik($in);
					if(!empty($id_berita))
					{
						$this->Admin_model->Update_Profil($in);
					}
					else
					{
						$this->Admin_model->Simpan_Profil($in);
					}
					redirect('admin/profil/tampil');
				}
			}
		}
		else
		{
			if($aksi == 'tambah')
			{
				$data['tekseditor'] = '';
				$data['kategori']=$this->Admin_model->Kat_Profil();
				$data["judulhalaman"]= 'Tambah Profil';
			}
			elseif($aksi == 'ubah')
			{
				$data['tekseditor'] = '';
				$data['id'] = $page;
				$data['kategori']=$this->Admin_model->Kat_Profil();
				$data["judulhalaman"]= 'Ubah Profil';
			}
			elseif($aksi == 'hapus')
			{
				$id = $page;
				$this->Admin_model->Hapus_Profil($id);
				redirect('admin/profil/tampil');
			}
			else
			{
		      		$limit_ti=15;
				if(!$page):
				$offset_ti = 0;
				else:
				$offset_ti = $page;
				endif;
				$this->load->library('Pagination');
				$query=$this->Admin_model->Tampil_Profil($limit_ti,$offset_ti);
				$tot_hal = $this->Admin_model->Total_Profil();
		      		$config['base_url'] = base_url() . 'admin/profil/tampil';
		       		$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit_ti;
				$config['uri_segment'] = 4;
				$this->pagination->initialize($config);
				$paginator=$this->pagination->create_links();
		        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
			}
			$this->load->view('admin/bg_head',$data);
			$this->load->view('admin/profil',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function sk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Penyesuaian Data SK untuk tahun sebelum 2016';
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/sk');
		$this->load->view('shared/bawah');
	}
	function katprofil($aksi=null,$id_kategori=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Admin_model');
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Kat_profil($id_kategori);
			redirect('admin/katprofil');
		}
		$nama_kategori = $this->input->post('nama_kategori');
		$id_kategori_post = $this->input->post('id_kategori');
		if(!empty($nama_kategori))
		{
			$in['nama_kategori'] = $this->input->post('nama_kategori');
			$in['id_kategori'] = $this->input->post('id_kategori');

			if(!empty($id_kategori_post))
			{
				$in = nopetik($in);
				$this->Admin_model->Perbarui_Kat_Profil($in);
			}
			else
			{
				$in = nopetik($in);
				$this->Admin_model->Tambah_Kat_Profil($in);
			}

		}
		$data["judulhalaman"]= 'Kategori Profil';
		$data['kategori']=$this->Admin_model->Kat_profil();
		$data['datakatprofil'] = $this->Admin_model->Data_Kat_profil($id_kategori);
		$data['aksi'] = $aksi;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/kat_profil',$data);
		$this->load->view('shared/bawah');
	}
	function tautan($aksi=null,$id_tautan=null)
	{
		$data=array();
		$data['judulhalaman'] = 'Daftar Tautan';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['aksi']=$aksi;
		$data["id_tautan"]=$id_tautan;
		$in['url']=$this->input->post('url');
		$in['teks']=$this->input->post('teks');
		$in['no_urut']=$this->input->post('no_urut');
		$id_tautane=$this->input->post('id_tautan_ubah');
		$this->load->model('Admin_model');
		if ((!empty($in['url'])) and (!empty($in['teks'])) and (!empty($in['no_urut'])) and (empty($id_tautane)))
		{
			$in = nopetik($in);
			$this->Admin_model->Tambah_Tautan($in);				
		}
		if (($data['aksi']=='hapus') and (!empty($id_tautan)))
		{
			$this->Admin_model->Hapus_Tautan($id_tautan);
		}
		if ((!empty($in['url'])) and (!empty($in['teks'])) and (!empty($in['no_urut'])) and (!empty($id_tautane)))
		{
			$in['id_tautan'] = $id_tautane;
			$in = nopetik($in);
			$this->Admin_model->Perbarui_Tautan($in);				
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/tautan',$data);
		$this->load->view('shared/bawah');
	}
	function kelompokmapel()
	{
		$data['judulhalaman' ] = 'Menu Kelompok Mapel';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$in['kelompok_mapel'] =$this->input->post('kelompok_mapel');
		$in['no_urut'] =$this->input->post('no_urut');
		$diproses =$this->input->post('diproses');
		$data_isi['id_kelompok_mapel']=$this->uri->segment(3);
		$data_isi['aksi']=$this->uri->segment(4);
		if ($diproses=='tambah')
		{
			$this->load->model('Admin_model');
			$in = nopetik($in);
			$this->Admin_model->Tambah_Menu_Kelompok_Mapel($in);
		}
		if ($diproses=='ubah')
		{
			$in['id_kelompok_mapel'] =$this->input->post('id_kelompok_mapel');
			$this->load->model('Admin_model');
			$in = nopetik($in);
			$this->Admin_model->Ubah_Menu_Kelompok_Mapel($in);
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/kelompok_mapel',$data_isi);
		$this->load->view('shared/bawah');
	}
	function mapel()
	{
		$data['judulhalaman' ] = 'Menu Mata Pelajaran';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$in['parent_id'] =$this->input->post('parent_id');
		$in['nama_kategori'] =$this->input->post('nama_kategori');
		$diproses =$this->input->post('diproses');
		$data_isi['id_kategori_tutorial']=$this->uri->segment(3);
		$data_isi['aksi']=$this->uri->segment(4);
		if ($diproses=='tambah')
		{
			$this->load->model('Admin_model');
			$in = nopetik($in);
			$this->Admin_model->Simpan_Kat_Tutorial($in);
		}
		if ($diproses=='ubah')
		{
			$in['id_kategori_tutorial'] =$this->input->post('id_kategori_tutorial');
			$this->load->model('Admin_model');
			$in = nopetik($in);
			$this->Admin_model->Ubah_Menu_Mapel($in);
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/menu_mapel',$data_isi);
		$this->load->view('shared/bawah');
	}
	function inbox($aksi=null,$page=null)
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data['judulhalaman'] = 'Kotak Masuk';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["tanggal"] = mdate($datestring, $time);
		$this->load->model('Admin_model');
		$adabalas = $this->input->post('adabalas');
		if($aksi == 'hapus')
		{
			$this->Admin_model->Delete_Pesan($page);
		}
		if($adabalas == 'Y')
		{
				$in["username"]=$this->input->post('username');
				$in["tujuan"]=$this->input->post('tujuan');
				$in["subjek"]=$this->input->post('subjek');
				$in["pesan"]=$this->input->post('pesan');
				$in["waktu"]=mdate($datestring,$time);
				$in["status_pesan"]="N";
				$id=$this->input->post('id_inbox');
				$this->load->model('Admin_model');
				$in = nopetik($in);
				$this->Admin_model->Balas_Pesan($in);
				$this->Admin_model->Update_Pesan_Lama($in["pesan"],$id);
		}

		$this->load->library('Pagination');	
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Admin_model->Tampil_Inbox($data["nim"],$limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_Inbox($data["nim"]);
      		$config['base_url'] = base_url() . 'admin/inbox/tampil';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		if(!empty($page))
		{
			$str = $page;
			if($page > 0)
			{
				$sambung="9002".$page."";
				$coded = base64_encode($sambung);
				$str = preg_replace("/=/", "eqsmdng", $coded);
			}
			$data["detail"]=$this->Admin_model->Detail_Inbox($data["nim"],$str);
		}

		$data['tekseditor'] = '';
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'aksi'=>$aksi);
			$this->load->view('admin/bg_head',$data);
			$this->load->view('admin/inbox',$data_isi);
			$this->load->view('shared/bawah');
	}
	function upload($aksi=null,$page=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Unggah Berkas';
			$galat = '';
		$this->load->model('Admin_model');
		if($aksi == 'hapus')
		{
			$hapus=$this->Admin_model->Edit_Upload($page);
			foreach($hapus->result() as $t)
			{
				unlink("unduhan/$t->nama_file");
			}
			$this->Admin_model->Delete_Upload($page);
			redirect('admin/upload/tampil');
		}
		if(!empty($_FILES['userfile']['name']))
		{
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$in["tgl_posting"] = mdate($tgl,$time);
			$in["judul_file"]=$this->input->post('judul');
			$in["author"]=$data["nim"];
			$in["id_kat"]=$this->input->post('kategori');
			$acak=rand(00000000000,99999999999);
			$bersih=$_FILES['userfile']['name'];
			$nm=str_replace(" ","_","$bersih");
			$pisah=explode(".",$nm);
			$nama_murni=$pisah[0];
			$ubah=$acak.$nama_murni; //tanpa ekstensi
			$config["file_name"]=$ubah; //dengan eekstensi
			$in["nama_file"]=$acak.$nm;
			$config['upload_path'] = 'unduhan/';
			$config['allowed_types'] = 'sql|psd|pdf|xls|ppt|swf|Xhtml|zip|mid|midi|mp2|mp3|wav|bmp|gif|jpg|jpeg|png|txt|rtf|mpeg|mpg|avi|doc|docx|xlsx|pptx|ods';
			$config['max_size'] = '5000000';
			$config['max_width'] = '1200';
			$config['max_height'] = '800';						
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload())
			{
				 $galat = '<div class="alert alert-warning">'.$this->upload->display_errors().'</div>';
				//redirect('galat');
			}
			else
			{
				$id_download =$this->input->post('id_download');
				if(!empty($id_download))
				{
					$in["judul_file"]=$this->input->post('judul_file');
					$in["id_download"]=$this->input->post('id_download');
					$in["id_kat"]=$this->input->post('kategori');
					$in = nopetik($in);
					$this->Admin_model->Update_Upload($in);
				}
				else
				{
					$in = nopetik($in);
					$this->Admin_model->Simpan_Upload($in);
				}
			}
		}
		else
		{
				$in["judul_file"]=$this->input->post('judul_file');
				$in["id_download"]=$this->input->post('id_download');
				$in["id_kat"]=$this->input->post('kategori');
				$in = nopetik($in);
				$this->Admin_model->Update_Upload($in);
		}

      		$limit_ti=15;
		if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
		endif;

		$this->load->library('Pagination');
		$query=$this->Admin_model->Tampil_File($limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_File();
      		$config['base_url'] = base_url() . 'admin/upload/tampil';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'aksi'=>$aksi,'galat'=>$galat);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/upload',$data_isi);
		$this->load->view('shared/bawah');
	}
	function katdownload($aksi=null,$id=null)
	{
		$data=array();
		$data['judulhalaman'] = 'Kategori Unduhan';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Admin_model');
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Kat_Download($id);
			redirect('admin/katdownload');
		}
		$nama_kategori_download=$this->input->post('nama');
		if(!empty($nama_kategori_download))
		{
			$id_kat=$this->input->post('id_kat');
			$in['nama_kategori_download']=$this->input->post('nama');

			if(!empty($id_kat))
			{
				$in['id_kategori_download']=$id_kat;
				$in = nopetik($in);
				$this->Admin_model->Update_Kat_Download($in);
			}
			else
			{
				$in = nopetik($in);
				$this->Admin_model->Simpan_Kat_Download($in);
			}
		}
		$data['kategori']=$this->Admin_model->Kat_Down();
		$data['aksi'] = $aksi;
		$data['id'] = $id;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/kat_download',$data);
		$this->load->view('shared/bawah');
	}
	function telegram($aksi=null,$page=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Telegram Keluar';
		$this->load->model('Admin_model');
		$data['galat1'] = '';
		if(empty($aksi))
		{
			$aksi = 'tampil';
		}
		if($aksi == 'tambah')
		{
			$data['judulhalaman'] = 'Kirim Telegram';
		}
		elseif($aksi == 'hapus')
		{
			$waktune = balikin($page);
			$this->db->query("delete from `telegram` where `waktu`='$waktune'");
			redirect('admin/telegram');
		}

		else
		{
		 	$limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$tampilsemuatu=$this->Admin_model->Tampil_Semua_Telegram($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Telegram();
			$config['base_url'] = base_url() . 'admin/telegram/tampil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
			$data_isi = array('query' => $tampilsemuatu,'paginator'=>$paginator, 'page'=>$page);
		}
		$data_isi['aksi'] = $aksi;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/telegram',$data_isi);
		$this->load->view('shared/bawah');
	}
	function chatid($aksi=null,$page=null,$hal=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pengguna Telegram';
		$this->load->model('Admin_model');
		$data['galat1'] = '';
		$data['hal'] = $hal;
		if(empty($aksi))
		{
			$aksi = 'tampil';
			$data['page'] = $page;
		}
		if($aksi == 'edit')
		{
			$data['judulhalaman'] = 'Ubah ID Telegram';
			$data['pengguna'] = $page;
		}
		else
		{
		 	$limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$tampilsemuatu=$this->Admin_model->Tampil_Semua_Pengguna_Telegram($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Pengguna_Telegram();
			$config['base_url'] = base_url() . 'admin/chatid/tampil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
			$data_isi = array('query' => $tampilsemuatu,'paginator'=>$paginator, 'page'=>$page);
		}
		$data_isi['aksi'] = $aksi;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pengguna_telegram',$data_isi);
		$this->load->view('shared/bawah');
	}
	function updateidtelegram()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Admin_model');
		$in['chat_id']=nopetik($this->input->post('chat_id'));
		$in['nama']=nopetik($this->input->post('nama'));
		$in['nama_tanpa_gelar']=nopetik($this->input->post('nama_tanpa_gelar'));
		$in['kd']=$this->input->post('kd');
		$hal=$this->input->post('hal');
		$this->Admin_model->Update_ID_Telegram($in);
		redirect('admin/chatid/tampil/'.$hal);
	}
	function chatidsiswa($aksi=null,$page=null,$hal=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Siswa Pengguna Telegram';
		$this->load->model('Admin_model');
		$data['galat1'] = '';
		$data['hal'] = $hal;
		if(empty($aksi))
		{
			$aksi = 'tampil';
			$data['page'] = $page;
		}
		if($aksi == 'edit')
		{
			$data['judulhalaman'] = 'Ubah ID Telegram';
			$data['pengguna'] = $page;
		}
		else
		{
		 	$limit_ti=10;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$this->load->library('Pagination');
			$tampilsemuatu=$this->Admin_model->Tampil_Semua_Siswa_Pengguna_Telegram($limit_ti,$offset_ti);
			$tot_hal = $this->Admin_model->Total_Siswa_Pengguna_Telegram();
			$config['base_url'] = base_url() . 'admin/chatidsiswa/tampil';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
			$data_isi = array('query' => $tampilsemuatu,'paginator'=>$paginator, 'page'=>$page);
		}
		$data_isi['aksi'] = $aksi;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/siswa_pengguna_telegram',$data_isi);
		$this->load->view('shared/bawah');
	}
	function updateidsiswatelegram()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Admin_model');
		$in['chat_id']=nopetik($this->input->post('chat_id'));
		$in['nis']=nopetik($this->input->post('nis'));
		$hal=nopetik($this->input->post('hal'));
		$this->Admin_model->Update_ID_Siswa_Telegram($in);
		redirect('admin/chatidsiswa/tampil/'.$hal);
	}
	function telegramhariini($aksi=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Telegram Keluar Hari Ini';
		$this->load->model('Admin_model');
		$data['galat1'] = '';
		if($aksi == 'hapus')
		{
			$waktune = balikin($page);
			$this->db->query("delete from `telegram` where `waktu`='$waktune'");
			redirect('admin/telegramhariini');
		}
		$data['aksi'] = $aksi;
		$data['tanggal'] = date("Y-m-d");
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/telegram_hari_ini');
		$this->load->view('shared/bawah');
	}
	function tambalan()
	{
		$this->load->view('admin/tambalan');
	}
	function bk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Pengguna Guru BK';
		$aksi =$this->uri->segment(3);
		$page=$this->uri->segment(4);
		if(empty($aksi))
		{
			$aksi = 'tampil';
		}
		$limit_ti=10;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Admin_model');
		$this->load->library('Pagination');
		$tampilsemuaguru=$this->Admin_model->Tampil_Semua_Guru_Bk($limit_ti,$offset_ti);
		$tot_hal = $this->Admin_model->Total_Guru_Bk();
		$config['base_url'] = base_url() . 'admin/bk/tampil';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$data_isi = array('query' => $tampilsemuaguru,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pengguna_bk',$data_isi);
		$this->load->view('shared/bawah');
	}
	function gurubk($aksi=null,$username=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Guru BK';
		$data['aksi'] = $aksi;
		$data['username'] = $username;
		$user_bp = nopetik($this->input->post('user_bp'));
		$nip = nopetik($this->input->post('nip'));
		if((!empty($user_bp)) and (!empty($nip)))
		{
			$ta = $this->db->query("select * from `gurubk` where `user_bp`='$user_bp'");
			if($ta->num_rows() == 0)
			{
				$this->db->query("insert into `gurubk` (`user_bp`,`nip`) values ('$user_bp', '$nip')");
			}
			else
			{
				$this->db->query("update `gurubk` set `user_bp`='$user_bp', `nip` = '$nip'");
			}
		}
		if($aksi == 'hapus')
		{
			$username = balikin($username);
			$this->db->query("delete from `gurubk` where `user_bp`='$username'");
		}
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/guru_bk');
		$this->load->view('shared/bawah');
	}
	function pengaturan($nomor=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Pengaturan Web';
		$data['pesan'] = $this->session->flashdata('pesan_info');
		$data['nomor'] = $nomor;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/pengaturan',$data);
		$this->load->view('shared/bawah');
	}
	function simpanpengaturan($nomor=null)
	{
		$nomor = $nomor + 1;
		$cacah_item = $this->input->post('cacah_item');
		if($cacah_item>0)
		{
			$this->load->model('Admin_model');
			for($i=1;$i<=$cacah_item;$i++)
			{
				$id_referensi = nopetik($this->input->post("id_referensi_$i"));
				$nilai = nopetik($this->input->post("nilai_$i"));
				$this->db->query("update `m_referensi` set `nilai` = '$nilai' where `id_referensi` = '$id_referensi'");
			}
		}
		$this->session->set_flashdata('pesan_info', '<div class="alert alert-info">Pengaturan disimpan.</div>');
		redirect('admin/pengaturan/'.$nomor);
	}
	function kattutorial($page=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Mata Pelajaran';
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Admin_model');
		$this->load->library('Pagination');
		$kategori=$this->Admin_model->Tampil_Kat_Tutorial($limit_ti,$offset_ti);
		$tot_hal=$this->Admin_model->Total_Tutorial();
      		$config['base_url'] = base_url() . 'admin/kattutorial';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('kategori' => $kategori,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/kat_tutorial',$data_isi);
		$this->load->view('situs/bawah');
	}
	function tambahkattutorial()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Menambah Mata Pelajaran';
		$this->load->model('Admin_model');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/tambah_kat_tutorial',$data);
		$this->load->view('situs/bawah');
	}
	function simpankattutorial()
	{
		$this->load->model('Admin_model');
		$in['nama_kategori']=nopetik($this->input->post('nama'));
		$in = nopetik($in);
		$this->Admin_model->Simpan_Kat_Tutorial($in);
		redirect('admin/kattutorial');
	}
	function editkattutorial($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mengubah Mata Pelajaran';
		$this->load->model('Admin_model');
   		$data['id'] = $id;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/edit_kat_tutorial',$data);
		$this->load->view('situs/bawah');
	}
	function updatekattutorial()
	{
		$in=array();
		$this->load->model('Admin_model');
		$in=array();
		$in['id_kategori_tutorial']=nopetik($this->input->post('id_kat'));
		$in['nama_kategori']=nopetik($this->input->post('nama'));
		$in = nopetik($in);
		$this->Admin_model->Update_Kat_Tutorial($in);
		redirect('admin/kattutorial');
	}
	function hapuskattutorial($id=null)
	{
		$this->load->model('Admin_model');
		$this->Admin_model->Hapus_Kat_Tutorial($id);
		redirect('admin/kattutorial');
	}
	function unggahpengguna()
	{

		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mengunggah Pengguna';
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['file_name'] = 'pengguna.csv';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);

		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	echo $this->upload->display_errors();
			}
			else 
			{
				$this->load->model('Admin_model');
				$filePath = 'uploads/pengguna.csv';
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if(isset($field['username']))
					{
						$pbk['username'] = nopetik($field['username']);
						$username = nopetik($field['username']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' username';
						$pbk['username'] = '';
					}
					if(isset($field['nama']))
					{
						$pbk['nama'] = nopetik($field['nama']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nama';
						$pbk['nama'] = '';
					}
					if(isset($field['password']))
					{
						$options = array('cost' => 8);
						$psw = $field['password'];
						if(!empty($psw))
						{
							$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
							$pbk['psw'] = $psw;
						}
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' password';
						$pbk['psw'] = '';
					}
					if(isset($field['hak_akses']))
					{
						$hak_akses = nopetik($field['hak_akses']);
						if($field['hak_akses'] == 'guru')
						{
							$hak_akses = 'PA';
						}
						$pbk['status'] = $hak_akses;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' hak_akses';
						$pbk['hak_akses'] = '';
					}
					if ($adagalat==0)
					{
						$ada = $this->Admin_model->Cek_Baru($username);
						$ada = $ada->num_rows();
						if($ada == 0)
						{
							$pbk['aktif'] = 'Y';
							$this->Admin_model->Simpan_User_Baru($pbk);

						}
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink('uploads/pengguna.csv');
				$datay['modul'] = 'Unggah Pengguna';
				$datay['tautan_balik'] = ''.base_url().'admin/unggahpengguna';
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$this->load->view('admin/bg_head',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					redirect('admin/pengguna');
				}
			} //akhir kalau tidak error upload
		} // akhir kalau ada file terkirim
		else
		{
			$this->load->view('admin/bg_head',$data);
			$this->load->view('admin/unggah_pengguna');
			$this->load->view('shared/bawah');
		}
	}
	function pindahaspekafektif($id=null)
	{
		if($id<1)
		{
			$id = 0;
		}
		$datax['id']= $id;
		if($id>0)
		{
			$this->load->view('admin/pindah_aspek_afektif',$datax);
		}
		else
		{
			echo 'galat';
		}
	}
	function pindahaspekpsikomotor($id=null)
	{
		if($id<1)
		{
			$id = 0;
		}
		$datax['id']= $id;
		if($id>0)
		{
			$this->load->view('admin/pindah_aspek_psikomotor',$datax);
		}
		else
		{
			echo 'galat';
		}
	}
	function pindahnilaipsikomotor($id=null)
	{
		if($id<1)
		{
			$id = 0;
		}
		$datax['id']= $id;
		if($id>0)
		{
			$this->load->view('admin/pindah_nilai_psikomotor',$datax);
		}
		else
		{
			echo 'galat';
		}
	}
	function slide($nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Slide';
		$data['nomor'] = $nomor;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/slide',$data);
		$this->load->view('shared/bawah');
	}
	function simpanslide($nomor=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['modul'] = 'Unggah Slide';
		$data['judulhalaman'] = 'Unggah Slide';
		$data['tautan_balik'] = base_url().'admin/slide/'.$nomor;
		if(($nomor>0) and ($nomor<7))
		{
			$caption = hilangkanpetik($this->input->post('caption'));
			$subcaption = hilangkanpetik($this->input->post('subcaption'));
			$field = 'caption_slide_'.$nomor;
			$subfield = 'sub_caption_slide_'.$nomor;
			$this->db->query("update `m_referensi` set `nilai` = '$caption' where `opsi`='$field'");
			$this->db->query("update `m_referensi` set `nilai` = '$subcaption' where `opsi`='$subfield'");
			$config['upload_path'] = 'images';
			$config['allowed_types'] ='jpg';
			$config['file_name'] = $nomor;
			$config['overwrite'] = TRUE;				
			$this->load->library('upload', $config);
			
			if(empty($_FILES['userfile']['name']))
			{
				redirect('admin/slide');
			}
			else
			{
				if(!$this->upload->do_upload())
				{
				 	$data['pesan'] = $this->upload->display_errors();
					$this->load->view('admin/bg_head',$data);
					$this->load->view('shared/adagalat',$data);
					$this->load->view('shared/bawah');
				}
				else 
				{
					redirect('admin/slide');
				}
			}
		}
		else
		{
			redirect('admin');
		}
	}
	function teacher_id()
	{
		$this->load->model('Referensi_model','ref');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Teacher ID ARD';
		$this->load->view('admin/bg_head',$data);
		$this->load->view('admin/teacher_id',$data);
		$this->load->view('shared/bawah');
	}
	function kodemapel($category_subjects_id=null)
	{
		$this->load->model('Referensi_model','ref');
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$data['school_id'] = $this->ref->ambil_nilai('school_id');
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Kode Mapel ARD';
		$data['loncat'] = '';
		$data['category_subjects_id'] = $category_subjects_id;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('ard/category_subjects_id_admin',$data);
		$this->load->view('shared/bawah');
	}

}//akhir fungsi
?>
