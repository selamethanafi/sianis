<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Siswa")
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
		$data['nama'] = $this->session->userdata('nama');
		$data['judulhalaman'] = 'Beranda Siswa';
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'Siswa';
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
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}
	function sandi()
	{
		$this->load->library('form_validation');
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$username = $this->session->userdata('username');
		$data["status"]= 'siswa';
		$data['judulhalaman'] = 'Ganti Password';
			$data['galat1'] = '';
			$data['galat2'] = '';
			$data['sukses'] = '';

		//set validation rules
		$this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Kata sandi lagi', 'trim|required|matches[password]');
		if ($this->form_validation->run() == FALSE)
	        {
			$data['galat1'] = form_error('password');
			$data['galat2'] = form_error('cpassword');
	        }
		else
		{
			//insert the user registration details into database
			$options = array('cost' => 8);
			$psw = $this->input->post('password');
			if(!empty($psw))
			{
				$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
			}
			$this->load->model('Admin_model');
			$this->Admin_model->Update_Password($username,$psw);
			$data['sukses'] = '<div class="alert alert-success">Password berhasil diperbarui</div>';
		}
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('shared/ganti_password',$data);
		$this->load->view('shared/bawah');
	}

	function nilai()
	{
		$data = array();
		$data['judulhalaman'] = 'Nilai Pengetahuan (Kognitif)';
		$data["nim"]=$this->session->userdata('username');
		$data['nis'] = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Pengetahuan / Kognitif';
		$this->load->model('Siswa_model');
		$this->load->library('Pagination');	
		$tahun1=$this->uri->segment(3);
		$semester=$this->uri->segment(4);
		$tahun1 = $tahun1 * 1;
		$semester = $semester * 1;
		if(empty($tahun1))
		{
			$data['thnajaran'] = cari_thnajaran();
		}
		else
		{
			$tahun2 = $tahun1 + 1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;	
		}
		$data['semester'] = $semester;		
		if(empty($semester))
		{
		$data['semester'] = cari_semester();
		}
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/nilai',$data);
		$this->load->view('shared/bawah');
	}

	function rapor()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['nis'] = $this->session->userdata('username');
		$data['judulhalaman'] = 'Rapor';
		$this->load->model('Siswa_model');
		$this->load->library('Pagination');	
		$tahun1=$this->uri->segment(3);
		$semester=$this->uri->segment(4);
		$tahun1 = $tahun1 * 1;
		$semester = $semester * 1;
		if(empty($tahun1))
		{
			$data['thnajaran'] = cari_thnajaran();
		}
		else
		{
			$tahun2 = $tahun1 + 1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;	
		}
		$data['semester'] = $semester;		
		if(empty($semester))
		{
		$data['semester'] = cari_semester();
		}
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/rapor',$data);
		$this->load->view('shared/bawah');
	}

	function kepribadian()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = '';
		$data["status"]=$this->session->userdata('tanda');
		$data["tanggal"] = mdate($datestring, $time);
		$this->load->model('Siswa_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/kepribadian');
		$this->load->view('shared/bawah');
	}
	function nilai_akhlak()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Akhlak Mulia dan Kepribadian';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Siswa_model');
		$query=$this->Siswa_model->Tampil_Nilai_Akhlak($data["nim"]);
		$data['query']=$query;
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/nilai_akhlak',$data);
		$this->load->view('shared/bawah');
	}
	function data()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Data Siswa';
		$this->load->model('Siswa_model');
		$edit=$this->uri->segment(3);
		$query=$this->Siswa_model->Tampil_Data_Siswa($data["nim"]);
		$data['daftar_ruang']=$this->Siswa_model->Tampilkan_Semua_Kelas();
		$data['tdaftar_jarak']=$this->Siswa_model->Daftar_Jarak();
		$data['query']=$query;
		$data['sunting']=$edit;
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/data_siswa',$data);
		$this->load->view('shared/bawah');
	}	
	function updatedata()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["hdpibu"] = $this->input->post('hdpibu');
		$in["nis"] = $this->input->post('nis');
		$in["nik"] = $this->input->post('nik');
		$in["nik_kk"] = $this->input->post('nik_kk');
		$in["nokk"] = $this->input->post('nokk');
		$in["nisn"] = $this->input->post('nisn');
		$in["kls"] = $this->input->post('kls');
		$tanggallahirayah = tanggal_indonesia_ke_barat($this->input->post('tanggallahirayah'));
		$in["tglayah"] = $tanggallahirayah;
		$tanggallahiribu = tanggal_indonesia_ke_barat($this->input->post('tanggallahiribu'));
		$in["tglibu"] = $tanggallahiribu;
		$tanggallahirwali = tanggal_indonesia_ke_barat($this->input->post('tanggallahirwali'));
		$in["tglwali"] = $tanggallahirwali;
		$in["jenkel"] = $this->input->post('jenkel');
		$in["agama"] = $this->input->post('agama');
		$in["wn"] = $this->input->post('wn');
		$in["yatim"] = $this->input->post('yatim');
		$in["anakke"] = $this->input->post('anakke');
		$in["kandung"] = $this->input->post('kandung');
		$in["tiri"] = $this->input->post('tiri');
		$in["angkat"] = $this->input->post('angkat');
		$in["bhs"] = $this->input->post('bhs');
		$in["jalan"] = $this->input->post('jalan');
		$in["rt"] = $this->input->post('rt');
		$in["rw"] = $this->input->post('rw');
		$in["dusun"] = $this->input->post('dusun');
		$in["desa"] = $this->input->post('desa');
		$in["kec"] = $this->input->post('kec');
		$in["kab"] = $this->input->post('kab');
		$in["prov"] = $this->input->post('prov');
		$in["jarak"] = $this->input->post('jarak');
		$in["jenrumah"] = $this->input->post('jenrumah');
		$in["tinggal"] = $this->input->post('tinggal');
		$in["transportasi"] = $this->input->post('transportasi');
		$in["bb"] = $this->input->post('bb');
		$in["tb"] = $this->input->post('tb');
		$in["sakit"] = $this->input->post('sakit');
		$in["jasmani"] = $this->input->post('jasmani');
		$in["nmayah"] = $this->input->post('nmayah');
		$in["alayah"] = $this->input->post('alayah');
		$in["tmpayah"] = $this->input->post('tmpayah');
		$in["agayah"] = $this->input->post('agayah');
		$in["wnayah"] = $this->input->post('wnayah');
		$in["payah"] = $this->input->post('payah');
		$in["dayah"] = $this->input->post('dayah');
		$in["sekayah"] = $this->input->post('sekayah');
		$in["hdpayah"] = $this->input->post('hdpayah');
		$in["thnayah"] = $this->input->post('thnayah');
		$in["nmibu"] = $this->input->post('nmibu');
		$in["alibu"] = $this->input->post('alibu');
		$in["tmpibu"] = $this->input->post('tmpibu');
		$in["agibu"] = $this->input->post('agibu');
		$in["wnibu"] = $this->input->post('wnibu');
		$in["pibu"] = $this->input->post('pibu');
		$in["dibu"] = $this->input->post('dibu');
		$in["sekibu"] = $this->input->post('sekibu');
		$in["hdpibu"] = $this->input->post('hdpibu');
		$in["thnibu"] = $this->input->post('thnibu');
		$in["nmwali"] = $this->input->post('nmwali');
		$in["awali"] = $this->input->post('awali');
		$in["tmpwali"] = $this->input->post('tmpwali');
		$in["agwali"] = $this->input->post('agwali');
		$in["wnwali"] = $this->input->post('wnwali');
		$in["pwali"] = $this->input->post('pwali');
		$in["telepon"] = $this->input->post('telepon');
		$hp=$this->input->post('hp');
		if (strlen($hp>9))
		{
			$hp = seluler($hp);
			$in["hp"]=$hp;
		}
		$in["dwali"] = $this->input->post('dwali');
		$in["sekwali"] = $this->input->post('sekwali');
		$in["goldarah"] = $this->input->post('goldarah');
		$in["lama"] = $this->input->post('lama');
		$in["kesenian"] = $this->input->post('kesenian');
		$in["olahraga"] = $this->input->post('olahraga');
		$in["organisasi"] = $this->input->post('organisasi');
		$in["lain"] = $this->input->post('lain');
		$in["jalan"] = $this->input->post('jalan');
		$in["cita_cita"] = $this->input->post('cita');
		$in["hobi"] = $this->input->post('hobi');
		$in["dortu"] = $this->input->post('dortu');
		$in["alamat"] = $in["dusun"];
		$in["cacah_spm"] = $this->input->post('cacah_spm');
		$in["cacah_mobil"] = $this->input->post('cacah_mobil');
		$in["lantai"] = $this->input->post('lantai');
		$in["dinding"] = $this->input->post('dinding');
		$in["ternak"] = $this->input->post('ternak');
		$in["elektronik"] = $this->input->post('elektronik');
		if ($in["dusun"]<>$in["desa"])
		{
			$in["alamat"] .= " ".$in["desa"];
		}
		if ($in["desa"]<>$in["kec"])
		{
			$in["alamat"] .= " ".$in["kec"];
		}
		$in["alamat"] = ucwords(strtolower($in["alamat"]));
		if ($in["hdpayah"]=="Ya") {$in["thnayah"]="";}
		if ($in["hdpibu"]=="Ya") {$in["thnibu"]=" ";}
		$this->load->model('Siswa_model');
		$in = nopetik($in);
		$this->Siswa_model->Update_Data($in);
		redirect('siswa/data');
	}
	function keuangan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Riwayat Pembayaran';
		$data["status"]=$this->session->userdata('tanda');
		$data["nis"] = $this->session->userdata('username');
		$this->load->model('Keuangan_model');
		$data["querybayar"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa($data['nis']);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/keuangan',$data);
		$this->load->view('shared/bawah');
	}

	function afektif()
	{
		$data['judulhalaman'] = 'Nilai Sikap';
		$data["nim"]=$this->session->userdata('username');
		$data['nis'] = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Sikap';
//		$this->load->model('Siswa_model');
		$tahun1=$this->uri->segment(3);
		$semester=$this->uri->segment(4);
		$tahun1 = $tahun1 * 1;
		$semester = $semester * 1;
		if(empty($tahun1))
		{
			$data['thnajaran'] = cari_thnajaran();
		}
		else
		{
			$tahun2 = $tahun1 + 1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;	
		}
		$data['semester'] = $semester;		
		if(empty($semester))
		{
		$data['semester'] = cari_semester();
		}
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/afektif',$data);
		$this->load->view('shared/bawah');
	}
	function ketidakhadiran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Ketidakhadiran';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Siswa_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Siswa_model->Tampil_Ketidakhadiran($data["nim"],$limit_ti,$offset_ti);
		$tot_hal = $this->Siswa_model->Total_Ketidakhadiran($data["nim"]);
      		$config['base_url'] = base_url() . 'siswa/ketidakhadiran';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/ketidakhadiran',$data_isi);
		$this->load->view('shared/bawah');
	}
	function angkakredit()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Angka Kredit Pelanggaran';
		$this->load->model('Siswa_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Siswa_model->Tampil_Angka_Kredit($data["nim"],$limit_ti,$offset_ti);
		$tot_hal = $this->Siswa_model->Total_Angka_Kredit($data["nim"]);
      		$config['base_url'] = base_url() . 'siswa/angkakredit';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/angka_kredit',$data_isi);
		$this->load->view('shared/bawah');
	}
	function ekstrakurikuler()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Ekstrakurikuler';
		$this->load->model('Siswa_model');
		$data["query"]=$this->Siswa_model->Tampil_Nilai_Ekstra($data["nim"]);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/ekstra',$data);
		$this->load->view('shared/bawah');
	}
	function hambatan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hambatan Siswa';
		$data["status"]=$this->session->userdata('tanda');
		$data['tekseditor'] = '';
		$this->load->model('Siswa_model');
		$nis = $this->session->userdata('username');
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		$data["tabel_mapel"] = $this->Siswa_model->Tampil_Mapel_Siswa($thnajaran,$semester,$kelas);
		$data["mapel"] = $this->input->post('mapel');
		$mapel = $this->input->post('mapel');
		$hambatan = $this->input->post('hambatan');
		$cekhambatan = $this->Siswa_model->Cek_Hambatan($thnajaran,$mapel,$nis);
		$data["query"] = $this->Siswa_model->Tampil_Hambatan($thnajaran,$nis);
		$data["hambatan"]='';
		foreach($cekhambatan->result() as $h)
			{
			$data["hambatan"] = $h->hambatan;
			}
		$sudahadahambatan = $cekhambatan->num_rows();
		$in = array();
		$in["thnajaran"] = $thnajaran;
		$in["mapel"] = $mapel;
		$in["nis"] = $nis;
		if (($sudahadahambatan==0) and (!empty($mapel)))
			{
			$this->Siswa_model->Buat_Hambatan($in);
			}
		if (!empty($hambatan))
			{
			$this->Siswa_model->Simpan_Hambatan($thnajaran,$mapel,$nis,$hambatan);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa/hambatan'>";
			}
			else
		{
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/hambatan',$data);
		$this->load->view('shared/bawah');
		}
	}
	function psikomotor($tahun1=null,$semester=null)
	{
		$data['judulhalaman'] = 'Nilai Keterampilan (Psikomotor)';
		$data["nim"]=$this->session->userdata('username');
		$data['nis'] = $this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai Keterampilan';
		$tahun1 = $tahun1 * 1;
		$semester = $semester * 1;
		if(empty($tahun1))
		{
			$data['thnajaran'] = cari_thnajaran();
		}
		else
		{
			$tahun2 = $tahun1 + 1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;	
		}
		$data['semester'] = $semester;		
		if(empty($semester))
		{
		$data['semester'] = cari_semester();
		}
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/psikomotor',$data);
		$this->load->view('shared/bawah');
	}

	function detilpsikomotor($kd=null)
	{
		$data['judulhalaman'] = 'Rincian Nilai Keterampilan (Psikomotor)';
		$data["nim"]=$this->session->userdata('username');
		$data["kd"]= $kd;
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/detil_nilai_psikomotor',$data);
		$this->load->view('shared/bawah');
	}

	function detilafektif()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Rincian Nilai Afektif';
		$this->load->model('Siswa_model');
		$id_afektif=$this->uri->segment(3);
		$data["query"]=$this->Siswa_model->Tampil_Detil_Nilai_Afektif($data["nim"],$id_afektif);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/detil_nilai_afektif',$data);
		$this->load->view('shared/bawah');
	}
	function inbox()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Kotak Masuk';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Guru_model->Tampil_Inbox($data["nim"],$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Inbox($data["nim"]);
      		$config['base_url'] = base_url() . 'siswa/inbox';
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
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/inbox_siswa',$data_isi);
		$this->load->view('shared/bawah');
	}
	function detailinbox()
	{
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
		$data['tekseditor'] = '';
		$data['judulhalaman'] = 'Membalas Inbox';
		$this->load->model('Guru_model');
		$data["detail"]=$this->Guru_model->Detail_Inbox($data["nim"],$id);
		$this->Guru_model->Update_Pesan($id);
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/detail_inbox',$data);
		$this->load->view('shared/bawah');
	}
	function balasinbox()
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$in=array();
		$this->load->helper('telegram');
		$datestring = "%d-%m-%Y | %h:%i:%a";
		$time = time();
		$nim=$this->session->userdata('username');
		$data['judulhalaman'] = '';
		$in["username"]=$this->input->post('username');
		$in["tujuan"]=$this->input->post('tujuan');
		$in["subjek"]=$this->input->post('subjek');
		$pesanasli=$this->input->post('pesanasli');
		$pesan=$this->input->post('pesan');
		$in["pesan"]= "$pesanasli $pesan";
		$in["waktu"]=mdate($datestring,$time);
		$in["status_pesan"]="N";
		$id=$this->input->post('id_inbox');
		$this->load->model('Guru_model');
		$this->Guru_model->Balas_Pesan($in);
		$this->Guru_model->Update_Pesan_Lama($in["pesan"],$id);
		//kirim sms
		$this->load->model('Situs_model');
		//cari nohp pengirim
		$tnohp = $this->Situs_model->Tampil_Data_Umum_Pegawai($in['tujuan']);
		$nohpguru='';
		$namaguru = '';
		$jenkel ='';
		$chat_id = '';
		foreach($tnohp->result() as $dnohp)
		{
			$nohpguru = $dnohp->seluler;
			$namaguru = $dnohp->nama;
			$jenkel = $dnohp->jenkel;
			$chat_id = $dnohp->chat_id;
		}
		$tpengirim = $this->Situs_model->Tampil_Data_Siswa($in['username']);
		foreach($tpengirim->result() as $dpeng)
		{
			$pengirim = $dpeng->nama;
			$kelas = $dpeng->kdkls;
		}
		$pesansiswa=strip_tags($this->input->post('pesan'));
		$pesansiswa = preg_replace("/'/","", $pesansiswa);
		$pesansiswa = preg_replace("/&nbsp;/","", $pesansiswa);
		$pesan = 'Pesan dari '.$pengirim.' kelas '.$kelas.' di portal, "'.strip_tags($pesansiswa).'"';
		if (!empty($chat_id))
		{
			$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
		}
		elseif (!empty($nohpguru))
		{
			$this->Situs_model->Kirim_SMS_Guru($nohpguru,$pesan,$this->config->item('id_sms_user'));
		}
		else
		{

		}
		?>
		<script type="text/javascript" language="javascript">
		alert("Pesan anda sudah terkirim.");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa/inbox'>";
	}
	function pesanguru()
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$data=array();
		$this->load->helper('telegram');
		$data["nim"]=$this->session->userdata('username');
		$data["namasiswa"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Kirim Pesan Kepada Guru';
		$data['tekseditor'] = '';
		$proses = $this->input->post('proses');
		if($proses == 'kirim')
		{
			$datestring = "%d-%m-%Y pukul %h:%i %a";
			$time = time();
			$input['username']=$this->input->post('nim');
			$input['subjek']=$this->input->post('subjek');
			$this->load->model('Situs_model');
			$usernameguru = $this->Situs_model->Kodeguru_Jadi_Username($this->input->post('tujuan'));
			$input['tujuan']=$usernameguru;
			$input['status_pesan']="N";
			$input['waktu']=mdate($datestring,$time);
			$input['pesan']=$this->input->post('pesan');
			$judul = $this->input->post('subjek');
			if ($input['subjek']=="")
			{
				$input['subjek']='tanpa subjek';
			}
			if($input['pesan']=="")
			{
			?>
				<script type="text/javascript">
				alert("Kolom judul pesan belum diisi ...!!!");			
				</script>
				<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa/pesanguru'>";
			}
			else
			{
				$this->load->model('Situs_model');
				//cari nohp pengirim

				$tnohp = $this->Situs_model->Tampil_Data_Umum_Pegawai($usernameguru);
				$nohpguru='';
				$namaguru = '';
				$jenkel ='';
				$chat_id = '';
				foreach($tnohp->result() as $dnohp)
				{
					$nohpguru = $dnohp->seluler;
					$namaguru = $dnohp->nama;
					$jenkel = $dnohp->jenkel;
					$chat_id = $dnohp->chat_id;
				}
				$tpengirim = $this->Situs_model->Tampil_Data_Siswa($input['username']);
				foreach($tpengirim->result() as $dpeng)
				{
					$pengirim = $dpeng->nama;
					$kelas = $dpeng->kdkls;
				}
				//strip_tags
				$pesansiswa = $input["pesan"];
				$pesansiswa = preg_replace("/'/","", $pesansiswa);
				$pesansiswa = preg_replace("/&nbsp;/","", $pesansiswa);
				$pesan = 'Pesan dari '.$pengirim.' kelas '.$kelas.' di portal, "'.strip_tags($pesansiswa).'"';
				$this->Situs_model->Simpan_Pesan_Admin($input);
				if (!empty($chat_id))
				{
					$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
				}
				elseif (!empty($nohpguru))
				{
					$this->Situs_model->Kirim_SMS_Guru($nohpguru,$pesan,$this->config->item('id_sms_user'));
				}
				else
				{

				}

				?>
				<script type="text/javascript" language="javascript">
				alert("Pesan anda sudah terkirim.");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa'>";
			}
		} // kalau ada kiriman
				$this->load->model('Situs_model');
		$data["daftar"]=$this->Situs_model->Total_Semua_Guru_Aktif();
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/pesan_guru',$data);
		$this->load->view('shared/bawah');
	}
	function hapusinbox()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$this->load->model('Guru_model');
		$this->Guru_model->Delete_Pesan($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa/inbox'>";
	}

	function mendaftarekstra()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mendaftar Ekstrakurikuler';
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$namaekstra = $this->input->post('nama_ekstra');
		$this->load->model('Admin_model');
		$data['daftar_nama_ekstra_wajib']= $this->Admin_model->Daftar_Nama_Ekstra_Pilihan();
		if (!empty($namaekstra))
		{
			$input = array();
			$input["nis"] = $data["nim"];
			$input["thnajaran"] = $data["thnajaran"];
			$input["semester"] = $data["semester"];
			$input["nama_ekstra"] = $namaekstra;
			$this->Admin_model->Simpan_Ekstra_Siswa($input);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."siswa/ekstrakurikuler'>";
		}
		else
		{
			$this->load->view('siswa/bg_atas',$data);
			$this->load->view('siswa/mendaftar_ekstra',$data);
			$this->load->view('shared/bawah');
		}
	}
	function statusnilai()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Status Nilai';
		$data["status"]=$this->session->userdata('tanda');
		$data['thnajaran'] = cari_thnajaran();
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/status_nilai',$data);
		$this->load->view('shared/bawah');
	}
	function analisis()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Analisis Ulangan';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Siswa_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
		$kirim = $this->input->post('kirim');
		if ($kirim =='oke')
		{
			$in = array();
			$in["thnajaran"]=$this->input->post('thnajaran');
			$in["kelas"]=$this->input->post('kelas');
			$in["mapel"]=$this->input->post('mapel');
			$in["ulangan"]=$this->input->post('ulangan');
			$in["semester"]=$this->input->post('semester');
			$in["nis"]=$this->input->post('nis');
			$in["jawaban"]=strtoupper($this->input->post('jawaban'));
			$in["uraian_1"]=$this->input->post('uraian_1');
			$in["uraian_2"]=$this->input->post('uraian_2');
			$in["uraian_3"]=$this->input->post('uraian_3');
			$in["uraian_4"]=$this->input->post('uraian_4');
			$in["uraian_5"]=$this->input->post('uraian_5');
			$in["uraian_6"]=$this->input->post('uraian_6');
			$in["uraian_7"]=$this->input->post('uraian_7');
			$in["uraian_8"]=$this->input->post('uraian_8');
			$in["uraian_9"]=$this->input->post('uraian_9');
			$in["uraian_10"]=$this->input->post('uraian_10');
			$this->Siswa_model->Simpan_Jawaban($in);
		}
		if ($page == 'detil')
		{
			$id_analisis = $this->uri->segment(4);
        		$data_isi = array('id_analisis' => $id_analisis);					
			$this->load->view('siswa/bg_atas',$data);
			$this->load->view('siswa/detil_analisis',$data_isi);
			$this->load->view('shared/bawah');
		}
		else
		{
	      		$limit_ti=15;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$query=$this->Siswa_model->Tampil_Analisis($data["nim"],$limit_ti,$offset_ti);
			$tot_hal = $this->Siswa_model->Total_Analisis($data["nim"]);
	      		$config['base_url'] = base_url() . 'siswa/analisis';
	       		$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
	        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
			$this->load->view('siswa/bg_atas',$data);
			$this->load->view('siswa/analisis',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function nilaiujiannasional()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hasil Ujian Nasional';
		$data["status"]=$this->session->userdata('tanda');
		$data['thnajaran'] = cari_thnajaran();
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/nilai_ujian_nasional',$data);
		$this->load->view('shared/bawah');
	}

	function penilaiandiri()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Penilaian Diri';
		$this->load->model('Siswa_model');
		$tahun1=$this->uri->segment(3);
		$semester=$this->uri->segment(4);
		$datax['aksi'] = $this->uri->segment(5);
		$tahun2 = $tahun1 + 1;
		$datax['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['semester'] = $semester;
		$datax['nis'] = $data["nim"];
		$cacah = $this->input->post('cacah');
		if($cacah>0)
		{
			$in['thnajaran'] = $tahun1.'/'.$tahun2;
			$in['semester'] = $semester;
			$in['nis'] = $data["nim"];
			$in['penilai'] = $data["nim"];
			for($i=1;$i<=$cacah;$i++)
			{
				$iteme = 'i'.$i;
				$in[$iteme] = hilangkanpetik($this->input->post('skor_'.$i));
			}
			$this->Siswa_model->Simpan_Penilaian_Diri($in);
		}
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/penilaian_diri',$datax);
		$this->load->view('shared/bawah');
	}
	function penilaianantarteman()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Penilaian Antarteman';
		$this->load->model('Siswa_model');
		$tahun1=$this->uri->segment(3);
		$semester=$this->uri->segment(4);
		$teman = $this->uri->segment(5);
		$datax['aksi'] = $this->uri->segment(6);
		$tahun2 = $tahun1 + 1;
		$datax['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['semester'] = $semester;
		$datax['teman'] = $teman;
		$datax['penilai'] = $data["nim"];
		$cacah = $this->input->post('cacah');
		if($cacah>0)
		{
			$in['thnajaran'] = $tahun1.'/'.$tahun2;
			$in['semester'] = $semester;
			$in['nis'] = $teman;
			$in['penilai'] = $data["nim"];
			for($i=1;$i<=$cacah;$i++)
			{
				$iteme = 'i'.$i;
				$in[$iteme] = hilangkanpetik($this->input->post('skor_'.$i));
			}
			$this->Siswa_model->Simpan_Penilaian_Antarteman($in);
		}
		$datax['tahun1'] = $tahun1;
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/penilaian_antarteman',$datax);
		$this->load->view('shared/bawah');
	}
	function hasilpenilaiandiri()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hasil Penilaian Diri';
		$this->load->model('Siswa_model');
		$tahun1=$this->uri->segment(3);
		$semester=$this->uri->segment(4);
		$tahun2 = $tahun1 + 1;
		$datax['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['semester'] = $semester;
		$datax['nis'] = $data["nim"];
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/hasil_penilaian_diri',$datax);
		$this->load->view('shared/bawah');
	}
	function unduhrapor()
	{
		$data["nim"]=$this->session->userdata('username');
		$nis = $this->session->userdata('username');
		$tahun=$this->uri->segment(3);
		$tahun2 = $tahun + 1;
		$thnajaran = $tahun.'/'.$tahun2;
		$semester=$this->uri->segment(4);
		$status_nilai=$this->uri->segment(5);
		$kurikulum=$this->uri->segment(6);
		$data['status_nilai']=$status_nilai;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['nis']=$nis;
		$data['ukuran_kertas'] = $this->config->item('ukuran_kertas');
		$data['siswa'] = 'ya';
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($nis)))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		        $this->load->model('Nilai_model');
			if($kurikulum == '2015')
			{
				if($this->config->item('versi_lck') == 1)
				{
					$this->load->view('pdf/buku_rapor_siswa_2015_man_2_sragen', $data);
				}
				else
				{
					$this->load->view('pdf/buku_rapor_siswa_2015', $data);
				}
			}
			else
			{
				if($this->config->item('versi_lck') == 1)
				{
					$this->load->view('pdf/buku_lck_siswa_legal_man_2_sragen', $data);
				}
				else
				{
					$this->load->view('pdf/buku_lck_siswa_legal', $data);
				}
			}

		}
	}
	function cetakrapor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$tahun1 = $this->uri->segment(3);
		$nis = $this->session->userdata('username');
		$semester= $this->uri->segment(4);
		$datax['status_nilai']= 'akhir';
		$datax['nis']= $nis;
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$datax['thnajaran']= $thnajaran;
		$datax['semester'] = $semester;
		$datax['kelas']= nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		$kurikulum= $this->uri->segment(5);
		$datax['tautan']= 'siswa';
		$namasiswa = berkas(nis_ke_nama($nis));
		$datax['judulhalaman'] = 'Rapor_'.$namasiswa.'_'.$tahun1.'_'.$tahun2.'_semester_'.$datax['semester'];
		$datax['siswa'] = 'ya';
		if($kurikulum == '2015')
		{
			$this->load->view('shared/buku_rapor_html_2015',$datax);
		}
		elseif($kurikulum == '2013')
		{
			$this->load->view('shared/buku_rapor_html_2013',$datax);
		}
		else
		{
			echo 'KTSP is expired';
		}

	}
	function telegram($aksi2=null)
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$this->load->helper(array('string','telegram'));
		$data = array();
		$data["nim"]= $this->session->userdata('username');
		$nis = $this->session->userdata('username');
		$data['judulhalaman'] = 'Akun Telegram';
		if($aksi2 =='kirimulang')
		{
			$this->db->query("update `datsis` set `chat_id_valid`='' where `nis`='$nis'");
		}
		$aksi =$this->input->post('aksi');
		if($aksi == 'kirimkonfirmasi')
		{
			$kode_reset = strtoupper(random_string('nozero','5'));
			$chat_id = $this->input->post('chat_id');
			$pesan = 'Kode konfirmasi '.$kode_reset;
			if(!empty($chat_id))
			{
				$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
			}
			$this->db->query("update `datsis` set `chat_id_valid`='$kode_reset' where `nis`='$nis'");
			$aksi = 'masukkankode';


		}
		if($aksi == 'postkode')
		{
			$chat_id = $this->input->post('chat_id');
			$chat_id_valid = $this->input->post('chat_id_valid');
			$ta = $this->db->query("select `nis`,`chat_id_valid` from `datsis` where `nis`='$nis' and `chat_id_valid` = '$chat_id_valid'");
			if($ta->num_rows()>0)
			{
			$this->db->query("update `datsis` set `chat_id_valid`='Y' where `nis`='$nis'");
			}
			$aksi = '';
		}
		$data['aksi'] = $aksi;
		$this->load->view('siswa/bg_atas',$data);
		$this->load->view('siswa/telegram',$data);
		$this->load->view('shared/bawah');
	}
}//akhir controller
?>
