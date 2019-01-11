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
class Guru extends CI_Controller 
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
		$kd = $this->session->userdata('username');
		$this->load->model('Situs_model');
		$ta = $this->db->query("select * from `p_pegawai` where `kd`='$kd'");
		$adata = $ta->num_rows();
		if($adata==0)
		{
			redirect('guru/buatdataumum');	
		}
		$tinbox = $this->Situs_model->Cek_Inbox($data["nim"]);
		$data["adapesan"] = $tinbox->num_rows();
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function ubahpassword()
	{
		$data = array();
		$username = $this->session->userdata('username');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Situs_model');
		$data["status"]= 'guru';
		$pesan = '';
		$data['judulhalaman'] = 'Ubah Password';
		$data['psw1'] = nopetik($this->input->post('psw1'));
		$data['psw2'] = nopetik($this->input->post('psw2'));
		$data['psw'] = nopetik($this->input->post('psw'));
		$psw1 = nopetik($this->input->post('psw1'));
		$psw2 = nopetik($this->input->post('psw2'));
		$psw = nopetik($this->input->post('psw'));
		$hasil = $this->Situs_model->Data_Login($username);
		$ada = $hasil->num_rows();
		$password = 0;
		if (count($hasil->result_array())>0)
		{
			foreach($hasil->result() as $dh)
			{
				$pswhash = $dh->psw;
			}
			if (password_verify($psw, $pswhash)) 
			{
			    $password = 1;
			}
		}

		if($psw1 != $psw2)
		{
			$pesan = '<div class="alert alert-danger">Password baru tidak sama</div>';
		}
		if($password == 1)
		{
			if($psw1 == $psw2)
			{
				$options = array('cost' => 8);
				$psw3 = password_hash($psw1, PASSWORD_BCRYPT, $options);
				$this->db->query("update `tbllogin` set `psw` = '$psw3' where `username`='$username'");
				$pesan = '<div class="alert alert-success">Password berhasil diperbarui</div>';
			}
		}
		if((!empty($psw)) or (!empty($psw1)) or (!empty($psw2)))
		{
			if($password == 0)
			{
				$pesan = '<div class="alert alert-warning">Password belum berhasil diperbarui, cek password saat ini.</div>';
			}	
		}
		$data['sukses'] = $pesan;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('shared/borang_ganti_password',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
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
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}
	function surel()
	{
		$data = array();
		$this->load->library(array('form_validation', 'email'));
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		$data['judulhalaman'] = 'Periksa Surel';
		$proses=$this->input->post('proses');
		$data['pesan_email'] = '';
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($proses == 'kirim')
		{
			$this->load->model('User_model');
			$email = $this->input->post('email');
			$ta = $this->User_model->Cek_Email($email,$data["nim"]);	
			$adata = $ta->num_rows();
			if($adata > 1)
			{
				$data['pesan_email'] = '<div class="alert alert-warning text-center">Email sudah digunakan, ganti</div>';
			}
			else
			{
				$idlink = md5($email.''.$this->config->item('awalttd').''.tanggal_hari_ini());
				$this->User_model->Update_Validasi_Email($email,$data["nim"],$idlink);	
				$subject = 'Validasi Email';
				$message = 'Yang terhormat '.$data['nama'].', <br /><br />Proses email Anda dengan mengklik tautan berikut.<br /><br /><a href="'.base_url().'user/validasi/'.$idlink.'">Validasi Surel</a><br /> <br /><br />Terima kasih<br />Tim Sianis';
				if ($this->User_model->sendEmail($this->input->post('email'),$subject,$message))
					{
					// successfully sent mail
					$data['pesan_email'] = '<div class="alert alert-success text-center">Sistem mengirim kode validasi ke alamat surel Anda. Silakan memeriksa surel Anda.</div>';
				}
				else
				{
					// error
					$data['pesan_email'] = '<div class="alert alert-danger text-center">Oops! Galat, gagal mengirim surel. Silakan mencoba lagi!</div>';
				}
			}

		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('shared/periksa_surel',$data);
		$this->load->view('shared/bawah');
	}

	function pembagiantugas($guru=null,$id_walikelas=null)
	{
		if(empty($guru))
		{
			$guru = 'wajib';
		}
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');	
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax["guru"] = $guru;
		$datax["kodeguru"] = $data["nim"];
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['thnajaran']=cari_thnajaran();
		$datax['semester']=cari_semester();
		$datax['mapel']=$this->input->post('mapel');
		$datax['ranah']=$this->input->post('ranah');
		$datax['kelas']=$this->input->post('kelas');
		$datax['kelompok'] = $this->input->post('kelompok');
		$datax['kkm'] = $this->input->post('kkm');
		$datax['jam'] = $this->input->post('jam');
		$datax['aksi'] = $this->uri->segment(3);
		$datax['id_mapel'] = $this->uri->segment(4);
		$pbk['thnajaran'] = cari_thnajaran();
		$pbk['semester'] = cari_semester();
		$pbk['kelas'] = $this->input->post('kelas');
		$pbk['mapel'] = $this->input->post('mapel');
		$pbk['program'] = kelas_jadi_program($this->input->post('kelas'));
		$pbk['tingkat'] = kelas_jadi_tingkat($this->input->post('kelas'));
		$pbk['kodeguru'] = $data["nim"];
		$pbk['kelompok'] = $this->input->post('kelompok');
		$pbk['pilihan'] = $this->input->post('pilihan');
		$kelompok = $this->input->post('kelompok');
		$pbk['ranah'] = $this->input->post('ranah');
		$pbk['no_urut_rapor'] = $this->input->post('no_urut_rapor');
		$pbk['kkm'] = $this->input->post('kkm');
		$pbk['jam'] = $this->input->post('jam');
		$pbk['jenis_deskripsi'] = $this->input->post('jenis_deskripsi');
		$thnajaran = $pbk['thnajaran'];
		$semester = $pbk['semester'];
		$kelas = $pbk['kelas'];
		$mapel = $pbk['mapel'];
		$kodeguru = $data["nim"];
		if ((!empty($kodeguru)) and (!empty($thnajaran)) and (!empty($semester)) and (!empty($mapel)) and (!empty($kelas)))
		{
			$this->load->model('Pengajaran_model');
			$cek = $this->Pengajaran_model->Cek_Mapel($thnajaran,$semester,$kelas,$mapel,$kodeguru,$kelompok);
			$ada = $cek->num_rows();
			$pbk = hilangkanpetik($pbk);
			$this->Pengajaran_model->Add_Mapel($pbk,$ada);
		}
		$data['id_walikelas'] = $id_walikelas;
		$data['judulhalaman'] = 'Pembagian Tugas Guru';
		$this->load->model('Pengajaran_model');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/pembagian_tugas',$datax);
		$this->load->view('shared/bawah');
	}
	function nilai()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$query=$this->Guru_model->Tampil_Semua_Mapel_Guru_Per_Tahun_Per_Semester($kodeguru,$thnajaran,$semester);
		$paginator='';
		$page = 0;
		$data['judulhalaman'] = 'Penilaian Semester Ini';
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai',$data_isi);
		$this->load->view('shared/bawah');
	}
	function ubahkkm()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah KKM';
		$id_mapel='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mapel='';
		}
		else
		{
    			$id_mapel = $this->uri->segment(3);
		}
		$data['galat'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['tmapel'] = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$data['adainfo'] = '';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/kkm_edit',$data);
		$this->load->view('shared/bawah');
	}
	function updatekkm()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["id_mapel"]=$this->input->post('id_mapel');
		$id_mapel=$this->input->post('id_mapel');
		$in["kkm"]=$this->input->post('kkm');
		$in["nkuis"]=$this->input->post('cacah_kuis');
		$in["ranah"]=$this->input->post('ranah');
		$in["cacah_ulangan_harian"]=$this->input->post('cacah_ulangan_harian');
		$in["cacah_tugas"]=$this->input->post('cacah_tugas');
		$in["bobot_ulangan_harian"]=$this->input->post('bobot_ulangan_harian');
		$in["bobot_praktik"]=$this->input->post('bobot_praktik');
		$in["bobot_portofolio"]=$this->input->post('bobot_portofolio');
		$in["bobot_projek"]=$this->input->post('bobot_projek');
		$in["bobot_tugas"]=$this->input->post('bobot_tugas');
		$in["bobot_mid"]=$this->input->post('bobot_mid');
		$in["bobot_semester"]=$this->input->post('bobot_semester');
		$in["bobot_kuis"]=$this->input->post('bobot_kuis');
		$in["jam"]=$this->input->post('jam');
		$in["adamid"]=$this->input->post('adamid');
		$in["kkm_uh1"]=$this->input->post('kkm_uh1');
		$in["kkm_uh2"]=$this->input->post('kkm_uh2');
		$in["kkm_uh3"]=$this->input->post('kkm_uh3');
		$in["kkm_uh4"]=$this->input->post('kkm_uh4');
		$in["kkm_mid"]=$this->input->post('kkm_mid');
		$in["kkm_uas"]=$this->input->post('kkm_uas');
		$in["kunciuh1"]=strtoupper($this->input->post('kunciuh1'));
		$in["kunciuh2"]=strtoupper($this->input->post('kunciuh2'));
		$in["kunciuh3"]=strtoupper($this->input->post('kunciuh3'));
		$in["kunciuh4"]=strtoupper($this->input->post('kunciuh4'));
		$in["kuncimid"]=strtoupper($this->input->post('kuncimid'));
		$in["kunciuas"]=strtoupper($this->input->post('kunciuas'));
		$in["nsoal_uh1"]=$this->input->post('nsoal_uh1');
		$in["nsoal_uh2"]=$this->input->post('nsoal_uh2');
		$in["nsoal_uh3"]=$this->input->post('nsoal_uh3');
		$in["nsoal_uh4"]=$this->input->post('nsoal_uh4');
		$in["nsoal_mid"]=$this->input->post('nsoal_mid');
		$in["nsoal_uas"]=$this->input->post('nsoal_uas');
		$in["skor_uh1"]=$this->input->post('skor_uh1');
		$in["skor_uh2"]=$this->input->post('skor_uh2');
		$in["skor_uh3"]=$this->input->post('skor_uh3');
		$in["skor_uh4"]=$this->input->post('skor_uh4');
		$in["skor_mid"]=$this->input->post('skor_mid');
		$in["skor_uas"]=$this->input->post('skor_uas');
		$in["kelompok"]=$this->input->post('kelompok');
		$in["kuncibuh1"]=strtoupper($this->input->post('kuncibuh1'));
		$in["kuncibuh2"]=strtoupper($this->input->post('kuncibuh2'));
		$in["kuncibuh3"]=strtoupper($this->input->post('kuncibuh3'));
		$in["kuncibuh4"]=strtoupper($this->input->post('kuncibuh4'));
		$in["kuncibmid"]=strtoupper($this->input->post('kuncibmid'));
		$in["kuncibuas"]=strtoupper($this->input->post('kuncibuas'));
		$in["nilai_maks_bagian_a_uh1"]=$this->input->post('nilai_maks_bagian_a_uh1');
		$in["nilai_maks_bagian_a_uh2"]=$this->input->post('nilai_maks_bagian_a_uh2');
		$in["nilai_maks_bagian_a_uh3"]=$this->input->post('nilai_maks_bagian_a_uh3');
		$in["nilai_maks_bagian_a_uh4"]=$this->input->post('nilai_maks_bagian_a_uh4');
		$in["nilai_maks_bagian_a_mid"]=$this->input->post('nilai_maks_bagian_a_mid');
		$in["nilai_maks_bagian_a_uas"]=$this->input->post('nilai_maks_bagian_a_uas');
		$in["nilai_maks_bagian_b_uh1"]=$this->input->post('nilai_maks_bagian_b_uh1');
		$in["nilai_maks_bagian_b_uh2"]=$this->input->post('nilai_maks_bagian_b_uh2');
		$in["nilai_maks_bagian_b_uh3"]=$this->input->post('nilai_maks_bagian_b_uh3');
		$in["nilai_maks_bagian_b_uh4"]=$this->input->post('nilai_maks_bagian_b_uh4');
		$in["nilai_maks_bagian_b_mid"]=$this->input->post('nilai_maks_bagian_b_mid');
		$in["nilai_maks_bagian_b_uas"]=$this->input->post('nilai_maks_bagian_b_uas');
		if($this->input->post('nsoal_b_uh1')>10)
			{
			$in["nsoal_b_uh1"]=10;
			}
			else
			{
			$in["nsoal_b_uh1"] = $this->input->post('nsoal_b_uh1');
			}
		if($this->input->post('nsoal_b_uas')>10)
			{
			$in["nsoal_b_uas"]=10;
			}
			else
			{
			$in["nsoal_b_uas"] = $this->input->post('nsoal_b_uas');
			}
		if($this->input->post('nsoal_b_uh2')>10)
			{
			$in["nsoal_b_uh2"]=10;
			}
			else
			{
			$in["nsoal_b_uh2"] = $this->input->post('nsoal_b_uh2');
			}
		if($this->input->post('nsoal_b_uh3')>10)
			{
			$in["nsoal_b_uh3"]=10;
			}
			else
			{
			$in["nsoal_b_uh3"] = $this->input->post('nsoal_b_uh3');
			}
		if($this->input->post('nsoal_b_uh4')>10)
			{
			$in["nsoal_b_uh4"]=10;
			}
			else
			{
			$in["nsoal_b_uh4"] = $this->input->post('nsoal_b_uh4');
			}
		if($this->input->post('nsoal_b_mid')>10)
			{
			$in["nsoal_b_mid"]=10;
			}
			else
			{
			$in["nsoal_b_mid"] = $this->input->post('nsoal_b_mid');
			}
			//$in["buh1"]=$this->input->post('bobot_ulangan_harian1');
			//$in["buh2"]=$this->input->post('bobot_ulangan_harian2');
			//$in["buh3"]=$this->input->post('bobot_ulangan_harian3');
			//$in["buh4"]=$this->input->post('bobot_ulangan_harian4');
		$this->load->model('Guru_model');
		$this->Guru_model->Update_KKM($in);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilai/".$id_mapel."'>";
	}
	function daftarnilai($id=null,$statuscetak=null,$ditandatangani=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Daftar Nilai Siswa';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$data["kodeguru"] = $kodeguru;
		$data['itemnilai']=$itemnilai;
		$data['jujug'] = $this->config->item('jujug');
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$subjects_value = $dtmapel->subjects_value;
				$data['kelas'] = $dtmapel->kelas;
				$data['kelas'] = $dtmapel->kelas;
				$data['mapel'] = $dtmapel->mapel;
				$data['thnajaran'] = $dtmapel->thnajaran;
				$data['semester'] = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$data['cacah_ulangan_harian'] = $dtmapel->cacah_ulangan_harian;
				$data['cacah_tugas'] = $dtmapel->cacah_tugas;
				$ranah = $dtmapel->ranah;
				$data['kd_mapel'] = $dtmapel->no_urut_rapor;
				$data['nbobot_ulangan_harian'] = $dtmapel->bobot_ulangan_harian;
				$data['nbobot_tugas'] = $dtmapel->bobot_tugas;
				$data['nbobot_mid'] = $dtmapel->bobot_mid;
				$data['nbobot_semester'] = $dtmapel->bobot_semester;
				$data['kkm_uh1'] = $dtmapel->kkm_uh1;
				$data['kkm_uh2'] = $dtmapel->kkm_uh2;
				$data['kkm_uh3'] = $dtmapel->kkm_uh3;
				$data['kkm_uh4'] = $dtmapel->kkm_uh4;
				$data['kkm_mid'] = $dtmapel->kkm_mid;
				$data['kkm_uas'] = $dtmapel->kkm_uas;
				$data['cacah_kuis'] = $dtmapel->nkuis;
				$data['nbobot_kuis'] = $dtmapel->bobot_kuis;
				$data['materi1'] = $dtmapel->materi1;
				$data['materi2'] = $dtmapel->materi2;
				$data['materi3'] = $dtmapel->materi3;
				$data['materi4'] = $dtmapel->materi4;
				$data['materi5'] = $dtmapel->materi5;
				$data['materi6'] = $dtmapel->materi6;
				$data['materi7'] = $dtmapel->materi7;
				$data['materi8'] = $dtmapel->materi8;
				$data['materi9'] = $dtmapel->materi9;
				$data['materi10'] = $dtmapel->materi10;
				$pilihan = $dtmapel->pilihan;
				//$data['nbuh1'] = $dtmapel->buh1;
				//$data['nbuh2'] = $dtmapel->buh2;
				//$data['nbuh3'] = $dtmapel->buh3;
				//$data['nbuh4'] = $dtmapel->buh4;
				$kurikulum = cari_kurikulum($dtmapel->thnajaran,$dtmapel->semester,$dtmapel->kelas);
				if($pilihan == 1)
				{
					$query=$this->Guru_model->Tampil_Semua_Nilai_Pilihan($dtmapel->kelas,$dtmapel->mapel,$dtmapel->semester,$dtmapel->thnajaran);
				}
				else
				{
					$query=$this->Guru_model->Tampil_Semua_Nilai($dtmapel->kelas,$dtmapel->mapel,$dtmapel->semester,$dtmapel->thnajaran);
				}

			}
			if(empty($subjects_value))
			{
				redirect('guruard/subjects_value/'.$id);	
			}
			$data['kurikulum'] = $kurikulum;
			$data['pilihan'] = $pilihan;
			$data['kkm'] = $kkm;
			$data['ranah'] = $ranah;
			$data['subjects_value'] = $subjects_value;
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
				}
				else
				{					if ($statuscetak=='cetak')
					{
						if ($ditandatangani == "ttd")
						{
							$data["ditandatangani"]="ya";
						}
						else
						{
							$data["ditandatangani"]="tidak";
						}					
					$this->load->view('guru/cetak_daftar_nilai',$data);
					}
					elseif ($statuscetak=='tambahsiswa')
					{
						$this->load->view('guru/bg_atas',$data);
						$this->load->view('guru/tambah_siswa_keterampilan',$data);
						$this->load->view('shared/bawah');
					}
					else
					{
						$this->load->model('Referensi_model','ref');
						$data['persentase_klasikal'] = $this->ref->ambil_nilai('persentase_klasikal');

						$this->load->view('guru/bg_atas',$data);
						if($kurikulum == '2018')
						{
							$data['school_id'] = $this->ref->ambil_nilai('school_id');
							$this->load->view('guru/daftar_nilai_2018',$data);
						}
						elseif($kurikulum == '2015')
						{
							$this->load->view('guru/daftar_nilai_2015',$data);
						}
						elseif($kurikulum == '2013')
						{
							$this->load->view('guru/daftar_nilai_2013',$data);
						}
						else
						{
							redirect ('guru');
						}
						$this->load->view('shared/bawah');
					}
				}
		}
		else
			{
			redirect ('guru');
			}
	}
	function perbaruidaftarsiswa()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$thnajaran=$this->input->post('thnajaran');
		$kelas=$this->input->post('kelas');
		$id_mapel=$this->input->post('id_mapel');
		$mapel=$this->input->post('mapel');
		$kd_mapel=$this->input->post('kd_mapel');
		$pilihan=$this->input->post('pilihan');
		$semester=$this->input->post('semester');
		$kurikulum=$this->input->post('kurikulum');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		if (empty($pilihan))
			{
				foreach($daftar_siswa->result() as $dsiswa)
				{
					$nis = $dsiswa->nis;
					$no_urut = $dsiswa->no_urut;
					$tada = $this->Guru_model->Cek_Nilai($thnajaran,$semester,$mapel,$nis);
					$ada = $tada->num_rows();
					$status=$dsiswa->status;
					$pbk['thnajaran'] = $thnajaran;
					$pbk['semester'] = $semester;
					$pbk['kelas'] = $kelas;
					$pbk['nis'] = $nis;
					$pbk['mapel'] = $mapel;
					$pbk['kd_mapel'] = $kd_mapel;
					$pbk['no_urut'] = $no_urut;
					$pbk['status'] = $status;
					$this->Guru_model->Add_Nilai($pbk,$ada);
				}
			}
		if ($pilihan == 1)
			{
				$cacah_siswa = $this->input->post('cacah_siswa');
				$this->Guru_model->Ubah_Status_Nilai($thnajaran,$semester,$mapel,$kelas);
				for($i=1;$i<=$cacah_siswa;$i++)
				{
					$pilihane = $this->input->post("pilihan_$i");
						$nis = $this->input->post("nis_$i");
						$no_urut = $this->input->post("no_urut_$i");
						$pbk['status'] = 'T';
						if ($pilihane == 1)
						{
							$pbk['status'] = 'Y';
						}
							$ada = $this->Guru_model->Cek_Nilai_Pilihan($thnajaran,$semester,$mapel,$nis);
							$ada = $ada->num_rows();
							$pbk['thnajaran'] = $thnajaran;
							$pbk['semester'] = $semester;
							$pbk['kelas'] = $kelas;
							$pbk['nis'] = $nis;
							$pbk['mapel'] = $mapel;
							$pbk['kd_mapel'] = $kd_mapel;
							$pbk['no_urut'] = $no_urut;
							$this->Guru_model->Add_Nilai_Pilihan($pbk,$ada);
//						$ada2 = $this->Guru_model->Cek_Nilai_Psikomotor($thnajaran,$semester,$mapel,$nis);
//						$ada2 = $ada2->num_rows();
//						$this->Guru_model->Add_Nilai_Psikomotor($pbk,$ada2);
				}
			}
			redirect('guru/daftarnilai/'.$id_mapel);
	}
	function nilaiharian($id=null,$itemnilai=null,$separuh=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Harian';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$data['jujug'] = $this->config->item('jujug');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
				$ranah = $dtmapel->ranah;
				$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
				$cacah_tugas = $dtmapel->cacah_tugas;
				$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
				$bobot_tugas = $dtmapel->bobot_tugas;
				$bobot_mid = $dtmapel->bobot_mid;
				$bobot_semester = $dtmapel->bobot_semester;
				$kkm_uh1 = $dtmapel->kkm_uh1;
				$kkm_uh2 = $dtmapel->kkm_uh2;
				$kkm_uh3 = $dtmapel->kkm_uh3;
				$kkm_uh4 = $dtmapel->kkm_uh4;
				$kkm_mid = $dtmapel->kkm_mid;
				$kkm_uas = $dtmapel->kkm_uas;
				$materi1 = $dtmapel->materi1;
				$materi2 = $dtmapel->materi2;
				$materi3 = $dtmapel->materi3;
				$materi4 = $dtmapel->materi4;
				$materi5 = $dtmapel->materi5;
				$materi6 = $dtmapel->materi6;
				$materi7 = $dtmapel->materi7;
				$materi8 = $dtmapel->materi8;
				$materi9 = $dtmapel->materi9;
				$materi10 = $dtmapel->materi10;
				$cacah_kuis = $dtmapel->nkuis;
				$bobot_kuis = $dtmapel->bobot_kuis;
				$pilihan = $dtmapel->pilihan;
			}
		$data['pilihan'] = $pilihan;
		$data['kkm']=$kkm;
		$data['ranah']=$ranah;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['ncacah_ulangan_harian']= $cacah_ulangan_harian;
		$data['ncacah_tugas'] = $cacah_tugas;
		$data['nbobot_ulangan_harian'] = $bobot_ulangan_harian;
//		$data['nbobot_ulangan_harian1'] = $bobot_ulangan_harian1;
//		$data['nbobot_ulangan_harian2'] = $bobot_ulangan_harian2;
//		$data['nbobot_ulangan_harian3'] = $bobot_ulangan_harian3;
//		$data['nbobot_ulangan_harian4'] = $bobot_ulangan_harian4;
//		$data['nbuh1'] = $buh1;
//		$data['nbuh2'] = $buh2;
//		$data['nbuh3'] = $buh3;
//		$data['nbuh4'] = $buh4;
		$data['nbobot_tugas'] = $bobot_tugas;
		$data['nbobot_mid'] = $bobot_mid;
		$data['nbobot_semester'] = $bobot_semester;
		$data['cacah_kuis'] = $cacah_kuis;
		$data['nbobot_kuis'] = $bobot_kuis;
		if ($kkm_uh1==0)
			{
			$data['kkm_uh1'] = $kkm;
			}
			else
			{
			$data['kkm_uh1'] = $kkm_uh1;
			}
		if ($kkm_uh2==0)
			{
			$data['kkm_uh2'] = $kkm;
			}
			else
			{
			$data['kkm_uh2'] = $kkm_uh2;
			}
		if ($kkm_uh3==0)
			{
			$data['kkm_uh3'] = $kkm;
			}
			else
			{
			$data['kkm_uh3'] = $kkm_uh3;
			}
		if ($kkm_uh4==0)
			{
			$data['kkm_uh4'] = $kkm;
			}
			else
			{
			$data['kkm_uh4'] = $kkm_uh4;
			}
		if ($kkm_mid==0)
			{
			$data['kkm_mid'] = $kkm;
			}
			else
			{
			$data['kkm_mid'] = $kkm_mid;
			}
		if ($kkm_uas==0)
			{
			$data['kkm_uas'] = $kkm;
			}
			else
			{
			$data['kkm_uas'] = $kkm_uas;
			}
		$data["materi1"] = $materi1;
		$data["materi2"] = $materi2;
		$data["materi3"] = $materi3;
		$data["materi4"] = $materi4;
		$data["materi5"] = $materi5;
		$data["materi6"] = $materi6;
		$data["materi7"] = $materi7;
		$data["materi8"] = $materi8;
		$data["materi9"] = $materi9;
		$data["materi10"] = $materi10;
		$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$cacahsiswa = $tot_hal->num_rows();
		if($itemnilai != 13)
		{
			if($cacahsiswa > 30)
			{
				if($pilihan == 1)
				{
					$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Pilihan_Separuh($kelas,$mapel,$semester,$thnajaran,$separuh);
				}
				else
				{
					$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Separuh($kelas,$mapel,$semester,$thnajaran,$separuh);
				}
			}
			else
			{
				if($pilihan == 1)
				{
					$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Pilihan($kelas,$mapel,$semester,$thnajaran,$separuh);
				}
				else
				{
					$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran,$separuh);
				}
			}
		}
		}
       		//$data['cacah_siswa'] = $tot_hal->num_rows();
		if ((empty($kkm)) or (empty($ranah)))
			{
			redirect("guru/ubahkkm/$id");
			}
			else
			{
			$data['separuh'] = $separuh;
			$this->load->view('guru/bg_atas',$data);
			if($cacahsiswa > 30)
			{
				if($itemnilai == 13)
				{
					$this->load->view('guru/nilai_harian_seluruh',$data);
				}
				else
				{
					$this->load->view('guru/nilai_harian_40',$data);
				}
			}
			else
			{
				if($itemnilai == 13)
				{

					$this->load->view('guru/nilai_harian_seluruh',$data);
				}
				else
				{
					$this->load->view('guru/nilai_harian',$data);
				}
			}

			$this->load->view('shared/bawah');
			}
	}
	function updatenilaiharian($id_mapel=null)
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$chat_id_grup_siswa = $this->ref->ambil_nilai('chat_id_grup_siswa');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Guru_model');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$nomor_materi = $this->input->post('nomor_materi');
		$itemnilai = $this->input->post('itemnilai');
		$kkm = $this->input->post('kkm_ulangan');
		$bisa = 0;
		$materi = '';
		if(($nomor_materi > 0) and ($nomor_materi <= 10))
		{
			$bisa = 1;
		}
		if($tmapel->num_rows()>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
				$cacah_tugas = $dtmapel->cacah_tugas;
				$ranah = $dtmapel->ranah;
				$kd_mapel = $dtmapel->no_urut_rapor;
				$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
				$bobot_tugas = $dtmapel->bobot_tugas;
				$bobot_mid = $dtmapel->bobot_mid;
				$bobot_semester = $dtmapel->bobot_semester;
				$cacah_kuis = $dtmapel->nkuis;
				$bobot_kuis = $dtmapel->bobot_kuis;
				$pilihan = $dtmapel->pilihan;
/*
				$bobot_ulangan_harian1 = $dtmapel->bobot_ulangan_harian1;
				$bobot_ulangan_harian2 = $dtmapel->bobot_ulangan_harian2;
				$bobot_ulangan_harian3 = $dtmapel->bobot_ulangan_harian3;
				$bobot_ulangan_harian4 = $dtmapel->bobot_ulangan_harian4;
*/
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;

				if($bisa == 1)
				{
					$materine = 'materi'.$nomor_materi;
					$materi = $dtmapel->$materine;
				}
			}
			$in2["id_mapel"] = $id_mapel;
			$in2["materi"] = $materi;
			$in2["nomor_materi"] = $nomor_materi;
			$namaitem = '';
			$jujug = $this->config->item('jujug');
			$this->Guru_model->Hapus_Capaian_Kompetensi($id_mapel,$nomor_materi);
			for($i=1;$i<=$cacah_siswa;$i++)
			{
				$in["kd"]=$this->input->post("kd_$i");
				$in["nilai_uh1"]=$this->input->post("nilai_uh1_$i");
				$in["nilai_uh2"]=$this->input->post("nilai_uh2_$i");
				$in["nilai_uh3"]=$this->input->post("nilai_uh3_$i");
				$in["nilai_uh4"]=$this->input->post("nilai_uh4_$i");
				$in["nilai_uh5"]=$this->input->post("nilai_uh5_$i");
				$in["nilai_uh6"]=$this->input->post("nilai_uh6_$i");
				$in["nilai_uh7"]=$this->input->post("nilai_uh7_$i");
				$in["nilai_uh8"]=$this->input->post("nilai_uh8_$i");
				$in["nilai_uh9"]=$this->input->post("nilai_uh9_$i");
				$in["nilai_uh10"]=$this->input->post("nilai_uh10_$i");
				$in["nilai_tu1"]=$this->input->post("nilai_tu1_$i");
				$in["nilai_tu2"]=$this->input->post("nilai_tu2_$i");
				$in["nilai_tu3"]=$this->input->post("nilai_tu3_$i");
				$in["nilai_tu4"]=$this->input->post("nilai_tu4_$i");
				$in["nilai_tu5"]=$this->input->post("nilai_tu5_$i");
				$in["nilai_tu6"]=$this->input->post("nilai_tu6_$i");
				$in["nilai_tu7"]=$this->input->post("nilai_tu7_$i");
				$in["nilai_tu8"]=$this->input->post("nilai_tu8_$i");
				$in["nilai_tu9"]=$this->input->post("nilai_tu9_$i");
				$in["nilai_tu10"]=$this->input->post("nilai_tu10_$i");
				$in["nilai_mid"]=$this->input->post("nilai_mid_$i");
				$in["nilai_uas"]=$this->input->post("nilai_uas_$i");
				$in["nilai_na"]=$this->input->post("nilai_na_$i");
				$in["nilai_nr"]=$this->input->post("nilai_nr_$i");
				$in["nilai_ku1"]=$this->input->post("nilai_ku1_$i");
				$in["nilai_ku2"]=$this->input->post("nilai_ku2_$i");
				$in["nilai_ku3"]=$this->input->post("nilai_ku3_$i");
				$in["nilai_ku4"]=$this->input->post("nilai_ku4_$i");
				$in["kog"]=$this->input->post("nilai_kog_$i");
				$in2["nis"]=$this->input->post("nis_$i");
				$in["nilai_ruh"]=0;
				$in["nilai_rtu"]=0;
				$in["nilai_rku"]=0;
				$in["nilai_nh"]=0;
				if ($cacah_ulangan_harian>0)
				{
				//$in["nilai_ruh"] =(($in["nilai_uh1"] * $bobot_ulangan_harian1) + ($in["nilai_uh2"] * $bobot_ulangan_harian2) + ($in["nilai_uh3"] * $bobot_ulangan_harian3) + ($in["nilai_uh4"] * $bobot_ulangan_harian4))/$cacah_ulangan_harian;
					$in["nilai_ruh"] =($in["nilai_uh1"] + $in["nilai_uh2"] + $in["nilai_uh3"] + $in["nilai_uh4"] + $in["nilai_uh5"]+ $in["nilai_uh6"]+ $in["nilai_uh7"]+ $in["nilai_uh8"]+ $in["nilai_uh9"]+ $in["nilai_uh10"])/$cacah_ulangan_harian;
				}
				if ($cacah_kuis>0)
				{
					$in["nilai_rku"] = ($in["nilai_ku1"] + $in["nilai_ku2"] + $in["nilai_ku3"] + $in["nilai_ku4"])/$cacah_kuis;
				}
				if ($cacah_tugas>0)
				{
					$in["nilai_rtu"] = ($in["nilai_tu1"] + $in["nilai_tu2"] + $in["nilai_tu3"] + $in["nilai_tu4"] + $in["nilai_tu5"] + $in["nilai_tu6"] + $in["nilai_tu7"] + $in["nilai_tu8"] + $in["nilai_tu9"] + $in["nilai_tu10"])/$cacah_tugas;
				}
				$nilai_na = 0;
				if (($bobot_kuis+$bobot_ulangan_harian+$bobot_tugas+$bobot_mid+$bobot_semester)>0 and ($bobot_kuis+$bobot_ulangan_harian+$bobot_tugas+$bobot_mid+$bobot_semester)<101)
				{
					$nilai_na = (($in["nilai_rku"]*$bobot_kuis)+($in["nilai_ruh"]*$bobot_ulangan_harian) + ($in["nilai_rtu"]*$bobot_tugas) + ($in["nilai_mid"]*$bobot_mid) + ($in["nilai_uas"]*$bobot_semester))/100;

				}
				$nilai_na = round($nilai_na,0);
				if($jujug == 'T')
				{
					$in['kog'] = $nilai_na;
				}
				$in['nilai_na'] = $nilai_na;
				if ($itemnilai=='4')
				{
					$namaitem = 'hasil penilaian tugas 1';
				}
				if ($itemnilai=='5')
				{
					$namaitem = 'hasil penilaian tugas 2';
				}
				if ($itemnilai=='6')
				{
					$namaitem = 'hasil penilaian tugas 3';
				}
				if ($itemnilai=='7')
				{
					$namaitem = 'hasil penilaian tugas 4';
				}
				if ($itemnilai=='14')
				{
					$namaitem = 'hasil penilaian kuis 1';
				}
				if ($itemnilai=='15')
				{
					$namaitem = 'hasil penilaian kuis 2';
				}
				if ($itemnilai=='16')
				{
					$namaitem = 'hasil penilaian kuis 3';
				}
				if ($itemnilai=='17')
				{
					$namaitem = 'hasil penilaian kuis 4';
				}
				if ($itemnilai=='1')
				{
					$nilai = $this->input->post("nilai_uh1_$i");
					$namaitem = 'hasil penilaian harian 1';
				}
				if ($itemnilai=='2')			
				{
					$nilai = $this->input->post("nilai_uh2_$i");
					$namaitem = 'hasil penilaian harian 2';
				}
				if ($itemnilai=='3')
				{
					$nilai = $this->input->post("nilai_uh3_$i");
					$namaitem = 'hasil penilaian harian 3';
				}
				if ($itemnilai=='11')
				{
					$nilai = $this->input->post("nilai_uh4_$i");
					$namaitem = 'hasil penilaian harian 4';
				}
				if ($itemnilai=='18')
				{
					$nilai = $this->input->post("nilai_uh5_$i");
					$namaitem = 'hasil penilaian harian 5';
				}
				if ($itemnilai=='19')
				{
					$nilai = $this->input->post("nilai_uh6_$i");
					$namaitem = 'hasil penilaian harian 6';
				}
				if ($itemnilai=='20')
				{
					$nilai = $this->input->post("nilai_uh7_$i");
					$namaitem = 'hasil penilaian harian 7';
				}
				if ($itemnilai=='21')
				{
					$nilai = $this->input->post("nilai_uh8_$i");
					$namaitem = 'hasil penilaian harian 8';
				}
				if ($itemnilai=='22')
				{
					$nilai = $this->input->post("nilai_uh9_$i");
					$namaitem = 'hasil penilaian harian 9';
				}
				if ($itemnilai=='23')
				{
					$nilai = $this->input->post("nilai_uh10_$i");
				}
				if ($itemnilai=='7')
				{
					$nilai = $this->input->post("nilai_mid_$i");
					$namaitem = 'hasil penilaian tengah semester';
				}
				if ($itemnilai=='8')
				{
					if($semester == '1')
					{
						$namaitem = 'hasil penilaian akhir semester';
					}
					else
					{
						$namaitem = 'hasil penilaian tahun';
					}
					$nilai = $this->input->post("nilai_uas_$i");
				}
				if((!empty($materi)) and (!empty($nomor_materi)))
				{ 
					if (($itemnilai==1) or ($itemnilai==2) or ($itemnilai==3) or ($itemnilai==11) or ($itemnilai==7) or ($itemnilai==8) or ($itemnilai==18) or ($itemnilai==19) or ($itemnilai==20) or ($itemnilai==21) or ($itemnilai==22) or ($itemnilai==23))
					{
						if($nilai < $kkm)
						{
							$in2["positif"] = 0;
						}
						else
						{
							$in2["positif"] = 1;
						}
						if($jenis_deskripsi == 1)
						{
							$in2["ket"] = deskripsi_nilai($nilai);
						}
						if($jenis_deskripsi == 6)
						{
							$in2["ket"] = deskripsi_nilai_2018($nilai,$kkm);
						}
						if (($jenis_deskripsi == 1) or ($jenis_deskripsi == 6))
						{
							$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
						}
					}
				}
				if($pilihan == 1)
				{
					$this->Guru_model->Update_Nilai_Pilihan($in);
				}
				else
				{
					$this->Guru_model->Update_Nilai($in);
				}

			} // end for i
				$nip=$this->Guru_model->get_NIP($data["nim"]);
				$kegiatanharian = 'menilai dan mengevaluasi proses dan hasil belajar mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tahun = tahunsaja(tanggal_hari_ini());
				$tanggalhariini = tanggal_hari_ini();
				$jam = jam_saja();
				$menit = menit_saja();
				$this->db->query("update `sieka_harian` set `jam_selesai` = '$jam', `menit_selesai`='$menit' where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");

			if($itemnilai == 13)
			{
				redirect('guru/statusketuntasan/'.$id_mapel.'/0/nilai');
			}
			else
			{
				$this->load->helper('telegram');
				$chat_id = $chat_id_grup_siswa;
				$pesanguru = $data['nama'].' memperbarui '.$namaitem.' mapel '.$mapel.' Kelas '.$kelas;
				if(!empty($chat_id))
				{
					//$kirimpesan = kirimtelegram($chat_id,$pesanguru,$token_bot);
				}
				redirect('guru/daftarnilai/'.$id_mapel);
			}
		} // kalau ditemukan data
		else
		{
			redirect('galat');
		}
	}
	function updatenilai()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$in["kd"]=$this->input->post('kd');
				$id_mapel=$this->input->post('id_mapel');
				$semester = $this->input->post('semester');
				$in["nilai_uh1"]=$this->input->post('nilai_uh1');
				$in["nilai_uh2"]=$this->input->post('nilai_uh2');
				$in["nilai_uh3"]=$this->input->post('nilai_uh3');
				$in["nilai_uh4"]=$this->input->post('nilai_uh4');
				$in["nilai_tu1"]=$this->input->post('nilai_tu1');
				$in["nilai_tu2"]=$this->input->post('nilai_tu2');
				$in["nilai_tu3"]=$this->input->post('nilai_tu3');
				$in["nilai_tu4"]=$this->input->post('nilai_tu4');
				$in["nilai_mid"]=$this->input->post('nilai_mid');
				$in["nilai_uas"]=$this->input->post('nilai_uas');
				$in["nilai_nr"]=$this->input->post('nilai_nr');
				$this->load->model('Guru_model');
				$this->Guru_model->Update_Nilai($in);
				redirect('guru/daftarnilai/'.$id_mapel.'/'.$semester);
	}
	function updaterapor($jenis=null)
	{
// 1, 2, 3, 5
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$id_mapel = $this->input->post('id_mapel');
		$semester = $this->input->post('semester');
		$kkm = $this->input->post('kkm');
		$ranah = $this->input->post('ranah');
		$dari = $this->input->post('dari');
		$datakunci = '';
		$this->load->model('Guru_model');
		if(($jenis=='1') or ($jenis=='2') or ($jenis=='3') or ($jenis=='5') or ($jenis=='6'))
		{
			for($i=1;$i<=$cacah_siswa;$i++)
			{
				$in["kd"]=$this->input->post("kd_$i");
				$in["rapor"]=$this->input->post("pilihan_$i");
				$kunci=$this->input->post("pilihan_$i");
				if($kunci == 1)
				{
					$in['kunci'] = 1;
					$this->Guru_model->Update_Nilai($in);
				}
			}
			redirect('guru/lck/'.$id_mapel);
		}
		else
		{
			for($i=1;$i<=$cacah_siswa;$i++)
			{
				$kunci=$this->input->post("pilihan_$i");
				if($kunci == 1)
				{
					$in['kunci'] = 1;
					$in["kd"]=$this->input->post("kd_$i");
					$in["keterangan"]=$this->input->post("keterangan_$i");
					$in["rapor"]=$this->input->post("pilihan_$i");
					$this->Guru_model->Update_Nilai($in);
				}
				else
				{
					$kd=$this->input->post("kd_$i");
					$keterangan=$this->input->post("keterangan_$i");
					$rapor=$this->input->post("pilihan_$i");
					$this->db->query("update `nilai` set `keterangan` = '$keterangan', `rapor`='$rapor' where `kd`='$kd'");
				}

			}
			redirect('guru/lck2/'.$id_mapel);
		}

	}
	function nilailama()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Siswa';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=12;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];
		$query=$this->Guru_model->Tampil_Semua_Mapel_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Semua_Mapel_Guru($kodeguru);
      		$config['base_url'] = base_url() . '/guru/nilailama';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai',$data_isi);
		$this->load->view('shared/bawah');
	}
/*
	function nilaiakhir()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Akhir';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$id_mapel = $this->uri->segment(3);
		$aksi = $this->uri->segment(4);
		$itemnilai = $this->uri->segment(5);
		$aksinilai = $this->uri->segment(5);
        	$data_isi = array('kodeguru' => $kodeguru,'id_mapel'=>$id_mapel,'aksi'=>$aksi,'aksinilai'=>$aksinilai,'itemnilai'=>$itemnilai);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_akhir',$data_isi);
		$this->load->view('shared/bawah');
	}

	function updatenilaiakhir()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$id_mapel=$this->input->post('id_mapel');
				$kkm=$this->input->post('kkm');
				$ranah=$this->input->post('ranah');
				$cacah_siswa=$this->input->post('cacah_siswa');
				for($i=1;$i<=$cacah_siswa;$i++)
				{
					$in["ket_akhir"] = 'Sudah kompeten';
					$in["kd"]=$this->input->post('kd_'.$i);
					$in["kog"]=$this->input->post('kog_'.$i);
					$in["psi"]=$this->input->post('psi_'.$i);
					$in["afe"]=$this->input->post('afe_'.$i);
					if ($ranah=='KPA') 
						{
						if (($in["kog"]<$kkm) or ($in["psi"]<$kkm))
							{$in["ket_akhir"] = 'Belum kompeten';
							}
						}
					if ($ranah=='PA')
						{
						if ($in["psi"]<$kkm)
							{$in["ket_akhir"] = 'Belum kompeten';
							}
						}
					if ($ranah=='KA')
						{
						if ($in["kog"]<$kkm)
							{$in["ket_akhir"] = 'Belum kompeten';
							}
						}
					if (($in["afe"]!='A') and ($in["afe"]!='B') and ($in["afe"]!='SB'))
							{$in["ket_akhir"] = 'Belum Kompeten';
							}					$this->load->model('Guru_model');
					$this->Guru_model->Update_Nilai($in);
				}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/nilaiakhir/$id_mapel'>";
	}
*/
	function ujian($tahun1=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Persiapan Nilai untuk Ujian Akhir Sekolah';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');
		$datax['kodeguru'] = $data["nim"];
		$tahun2 = $tahun1 + 1;
		if(($tahun1 ==0) or ($tahun1 <1))
		{
			$tahun1 = substr(cari_thnajaran(),0,4);
			$tahun2 = $tahun1 + 1;
		}
		$thnajaran = $tahun1.'/'.$tahun2;
		$datax['thnajaran'] = $thnajaran;
		$datax['semester'] = '2';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/ujian',$datax);
		$this->load->view('shared/bawah');
	}
	function haritatapmuka($aksi=null,$id_hari_tatap_muka=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hari tatap Muka';	
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$datax['thnajaran']=cari_thnajaran();
		$datax['semester']=cari_semester();
		$datax['is_new']=$this->input->post("is_new");
		$datax['id_mapel'] =$this->input->post("id_mapel");
		$datax['jam_ke'] =$this->input->post("jam_ke");
		$datax['id_hari'] =$this->input->post("id_hari");
		$datax['jam_mulai'] =$this->input->post("jam_mulai");
		$datax['jam_selesai'] =$this->input->post("jam_selesai");
		$datax['menit_mulai'] =$this->input->post("menit_mulai");
		$datax['menit_selesai'] =$this->input->post("menit_selesai");
		$datax['hari_tatap_muka'] =$this->input->post("hari_tatap_muka");
		$datax['rencana_jam_mulai'] =$this->input->post("rencana_jam_mulai");
		$datax['rencana_jam_selesai'] =$this->input->post("rencana_jam_selesai");
		$datax['rencana_menit_mulai'] =$this->input->post("rencana_menit_mulai");
		$datax['rencana_menit_selesai'] =$this->input->post("rencana_menit_selesai");
		$datax['rencana_hari_tatap_muka'] =$this->input->post("rencana_hari_tatap_muka");
		$datax['jtm'] =$this->input->post("jtm");
		$datax['kodeguru'] = $kodeguru;
		$datax['aksi']= $aksi;
		$datax['id_hari_tatap_muka']= $id_hari_tatap_muka;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/hari_tatap_muka',$datax);
		$this->load->view('shared/bawah');
	}
	function walikelas()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["judulhalaman"]= 'Tugas Tambahan: Walikelas';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=12;
		if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];
		$query=$this->Guru_model->Tampil_Wali_Kelas($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Wali_Kelas($kodeguru);
      		$config['base_url'] = base_url() . '/guru/wali';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/walikelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function daftarsiswa($id_walikelas=null,$akhlak=null,$aksi=null,$nosiswa=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["judulhalaman"] = 'Daftar Siswa';
		$data['aksi'] = $aksi;
		$kelas='';
		$thnajaran='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
			foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['id_walikelas']=$id_walikelas;
			$data['daftar_siswa']=$this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		if ($ada==0)
		{
			redirect('guru/walikelas');
		}
		else
		{

			if($akhlak == 'akhlak')
			{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_siswa_akhlak',$data);
			}
			elseif($akhlak == 'spiritual')
			{
				$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
				if(($kurikulum == '2015') or ($kurikulum == '2018'))
				{
				$data['kurikulum'] = $kurikulum;
				$data["judulhalaman"] = 'Penilaian Sikap Spiritual dan Sosial';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_siswa_spiritual_dan_sosial_2015',$data);
				}
				else
				{
		
				$data["judulhalaman"] = 'Penilaian Sikap Spiritual dan Sosial';				
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_siswa_spiritual_dan_sosial',$data);
				}
			}
			elseif($akhlak == 'proses')
			{
				$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
				if(($kurikulum == '2015') or ($kurikulum == '2018'))
				{
				$data['kurikulum'] = $kurikulum;
				$data["judulhalaman"] = 'Deskripsi Sikap Spiritual dan Sosial';				
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/proses_daftar_siswa_spiritual_dan_sosial_2015',$data);
				}
			}
			elseif($akhlak == 'peringkat')
			{
				$data['adamenu'] = '';
				$data["judulhalaman"] = 'Proses Peringkat';				
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/proses_peringkat',$data);
			}
			elseif($akhlak == 'peringkatlanjut')
			{
				$data["judulhalaman"] = 'Proses Peringkat';				
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/proses_peringkat_lanjut',$data);
			}

			elseif($akhlak == 'kunci')
			{
				$data["judulhalaman"] = 'Kunci Nilai Mata Pelajaran';				
				$data['kodeguru']= $kodeguru;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/nilai_siswa_setiap_mapel',$data);
			}

			else
			{
				$data['kurikulum']=cari_kurikulum($thnajaran,$semester,$kelas);
				$this->load->model('Referensi_model','ref');
				$data['ttd'] = $this->ref->ambil_nilai('tanda_tangan');

				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_siswa',$data);
			}
			$data['adainfo'] = '';
			$this->load->view('shared/bawah',$data);
		}
	}
	function detilsiswa($nis=null,$id_walikelas=null,$item=null,$penanganan=null)
	{
		$in=array();
		$data['nim']=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"] = 'LCK Sementara';
		$data['tekseditor'] = '';
		$this->load->model('Admin_model');
		$data['query']=$this->Admin_model->Tampil_Data_Siswa($nis);
		$data["nis"]=$nis;
		$data["id_walikelas"]=$id_walikelas;
		$data["id_pemberitahuan"]=$penanganan;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
			foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
				$kurikulum = $dtwali->kurikulum;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['kodeguru']=$kodeguru;
			$data['kurikulum'] = $kurikulum;
		}
		if ($item == 1)
		{
			$data['judulhalaman'] = 'Ketidakhadiran Siswa';
		}

		if ($item == 2)
		{
			$data['judulhalaman'] = 'Kredit Pelanggaran Siswa';
		}
		if ($item ==3)
		{
			$data['judulhalaman'] = 'Riwayat Pembayaran Keuangan';
		}
		if (($item ==1) or ($item ==2) or ($item ==3))
		{

			$this->load->view('guru/bg_atas',$data);
		}
		if (!empty($item))
		{
			if ($item == 1)
			{
				$this->load->view('guru/ketidakhadiran_siswa',$data);
			}
			elseif ($item == 2)
			{
			$this->load->view('guru/kredit_pelanggaran',$data);
			}
			else if ($item == 3)
			{
				$this->load->model('Keuangan_model');
				$data["querybayar"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa($nis);
				$this->load->view('guru/pembayaran',$data);
			}
			else if ($item == 4)
			{
				$data['judulhalaman'] = 'Rapor Akhir';
				$data['item']= $item;
				$data['penanganan'] = $penanganan;
				$data['yangdikunci'] = $this->uri->segment(7);
				$data['ubah'] = $this->uri->segment(8);
				$this->load->model('Nilai_model');
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/lhb',$data);
			}
			else if ($item == 5)
			{
				$data['judulhalaman'] = 'Rapor Akhir';
				$data['item']= $item;
				$data['adamenu'] ='';
				$data['penanganan'] = $penanganan;
				$data['yangdikunci'] = $this->uri->segment(7);
				$data['ubah'] = $this->uri->segment(8);
				$this->load->model('Nilai_model');
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/lck_pd',$data);
			}
			else if ($item == 6)
			{
				$data['item']= $item;
				$data['penanganan'] = $penanganan;
				$data['yangdikunci'] = $this->uri->segment(7);
				$data['ubah'] = $this->uri->segment(8);
				$this->load->model('Nilai_model');
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/lhb_sementara',$data);
			}
			else if ($item == 7)
			{
				$data['item']= $item;
				$data['adamenu'] ='';
				$this->load->model('Nilai_model');
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/lck_pd_sementara',$data);
			}
			else if ($item == 8)
			{
				$data['item']= $item;
				$this->load->model('Nilai_model');
				$data['adamenu'] ='';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/lck_pd_sementara_2015',$data);
			}
			else if ($item == 9)
			{
				$data['item']= $item;
				$data['adamenu'] ='';
				$data['penanganan'] = $penanganan;
				$data['yangdikunci'] = $this->uri->segment(7);
				$data['ubah'] = $this->uri->segment(8);
				$data['judulhalaman'] = 'Rapor Siswa';
				$this->load->model('Referensi_model','ref');
				$data['ttd'] = $this->ref->ambil_nilai('tanda_tangan');
				$this->load->model('Nilai_model');
				$this->load->view('guru/bg_atas',$data);
				if($kurikulum == '2015')
				{
					$this->load->view('guru/lck_pd_2015',$data);
				}
				else
				{
					$this->load->view('guru/lck_pd_2018',$data);
				}

			}
			else
			{
				$this->load->view('guru/detil_siswa',$data);
			}

		}
		else
		{
			$data['judulhalaman'] = 'Detil Siswa';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/detil_siswa',$data);
		}
		if (($item == 1) or ($item == 2) or ($item == 3))
		{
			$this->load->view('shared/bawah');
		}
	}
	function psikomotor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Psikomotor / Keterampilan';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=12;
		if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];
		$query=$this->Guru_model->Tampil_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru);
      		$config['base_url'] = base_url() . '/guru/psikomotor';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/psikomotor',$data_isi);
		$this->load->view('shared/bawah');
	}
	function aspekpsikomotor($id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Kriteria Penilaian Psikomotor / Keterampilan';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		if($this->Guru_model->Id_Mapel($id_mapel,$kodeguru)->num_rows()>0)
		{
			$data['tmapel'] = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
			$data['id_mapel']=$id_mapel;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/aspek_psikomotor',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function updateaspekpsikomotor($id_mapel=null)
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$this->load->model('Guru_model');
		if($this->Guru_model->Id_Mapel($id_mapel,$nim)->num_rows()>0)
		{
			$np=0;				
			$in["p1"]=$this->input->post('p1');
			$in["p2"]=$this->input->post('p2');
			$in["p3"]=$this->input->post('p3');
			$in["p4"]=$this->input->post('p4');
			$in["p5"]=$this->input->post('p5');
			$in["p6"]=$this->input->post('p6');
			$in["p7"]=$this->input->post('p7');
			$in["p8"]=$this->input->post('p8');
			$in["p9"]=$this->input->post('p9');
			$in["p10"]=$this->input->post('p10');
			$in["p11"]=$this->input->post('p11');
			$in["p12"]=$this->input->post('p12');
			$in["p13"]=$this->input->post('p13');
			$in["p14"]=$this->input->post('p14');
			$in["p15"]=$this->input->post('p15');
			$in["p16"]=$this->input->post('p16');
			$in["p17"]=$this->input->post('p17');
			$in["p18"]=$this->input->post('p18');
			if (!empty($in["p1"]))
				{$np=$np+1;}
			if (!empty($in["p2"]))
				{$np=$np+1;}
			if (!empty($in["p3"]))
				{$np=$np+1;}
			if (!empty($in["p4"]))
				{$np=$np+1;}
			if (!empty($in["p5"]))
				{$np=$np+1;}
			if (!empty($in["p6"]))
				{$np=$np+1;}
			if (!empty($in["p7"]))
				{$np=$np+1;}
			if (!empty($in["p8"]))
				{$np=$np+1;}
			if (!empty($in["p9"]))
				{$np=$np+1;}
			if (!empty($in["p10"]))
				{$np=$np+1;}
			if (!empty($in["p11"]))
				{$np=$np+1;}
			if (!empty($in["p12"]))
				{$np=$np+1;}
			if (!empty($in["p13"]))
				{$np=$np+1;}
			if (!empty($in["p14"]))
				{$np=$np+1;}
			if (!empty($in["p15"]))
				{$np=$np+1;}
			if (!empty($in["p16"]))
				{$np=$np+1;}
			if (!empty($in["p17"]))
				{$np=$np+1;}
			if (!empty($in["p18"]))
				{$np=$np+1;}
			$in["np"] = $np;
			$in['id_mapel']= $id_mapel;
			$in = hilangkanpetik($in);
			$this->Guru_model->Update_KKM($in);
			redirect('guru/daftarnilaipsikomotor/'.$id_mapel);
		}
		else
		{
			redirect('guru');
		}
	}
	function daftarnilaipsikomotor($id_mapel=null,$statuscetak=null,$id_psikomotor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Daftar Nilai Psikomotor';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$kurikulum = '';
		$jujug = $this->config->item('jujug');
		$data['jujug'] = $jujug;
    		$data['id_psikomotor'] = $id_psikomotor;			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kd_mapel = $dtmapel->no_urut_rapor;
				$keterampilan1 = $dtmapel->keterampilan1;
				$keterampilan2 = $dtmapel->keterampilan2;
				$kkm = $dtmapel->kkm;
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
				$pilihan = $dtmapel->pilihan;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['kd_mapel']=$kd_mapel;
			$data['itemnilai']=$itemnilai;
			$data['keterampilan1']=$keterampilan1;
			$data['keterampilan2']=$keterampilan2;
			$data['jenis_deskripsi'] = $jenis_deskripsi;
			$data['kurikulum']=cari_kurikulum($thnajaran,$semester,$kelas);
			$data['kkm'] = $kkm;
			if($pilihan == 1)
			{
				$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Pilihan($kelas,$mapel,$semester,$thnajaran);
			}
			else
			{
				$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			}

			$this->load->model('Nilai_model');
			$data["tkepala"] = $this->Nilai_model->Kepala($thnajaran,$semester);
			$data['ada']=$ada;
			if ($statuscetak=='cetak')
			{
				$this->load->view('guru/cetak_daftar_nilai_psikomotor',$data);
			}
			elseif ($statuscetak=='persiswa')
			{
				$data['judulhalaman'] = 'Daftar Nilai Psikomotor / Keterampilan Per Siswa';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_nilai_psikomotor_persiswa',$data);
				$this->load->view('shared/bawah');
			}
			else
			{	
				$data['adainfo'] = '';
				$data['proses'] = $statuscetak;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_nilai_psikomotor',$data);
				$this->load->view('shared/bawah');
			}
		}
		else
		{
			redirect('guru');
		}
	}
	function perbaruidaftarsiswapsikomotor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$thnajaran=$this->input->post('thnajaran');
		$kelas=$this->input->post('kelas');
		$id_mapel=$this->input->post('id_mapel');
		$kd_mapel=$this->input->post('kd_mapel');
		$mapel=$this->input->post('mapel');
		$semester=$this->input->post('semester');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
		{
			$nis = $dsiswa->nis;
			$no_urut = $dsiswa->no_urut;
			$status=$dsiswa->status;
			$ada = $this->Guru_model->Cek_Nilai_Psikomotor($thnajaran,$semester,$mapel,$nis);
			$ada = $ada->num_rows();
			$pbk['thnajaran'] = $thnajaran;
			$pbk['semester'] = $semester;
			$pbk['kelas'] = $kelas;
			$pbk['nis'] = $nis;
			$pbk['mapel'] = $mapel;
			$pbk['no_urut'] = $no_urut;
			$pbk['status'] = $status;
			$this->Guru_model->Add_Nilai_Psikomotor($pbk,$ada);
			$ada2 = $this->Guru_model->Cek_Nilai($thnajaran,$semester,$mapel,$nis);
			$ada2 = $ada2->num_rows();
			$pbk['kd_mapel'] = $kd_mapel;
			$this->Guru_model->Add_Nilai($pbk,$ada2);
		}
		redirect('guru/daftarnilaipsikomotor/'.$id_mapel);
	}
	function updatedatatambahan()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$data['nim'] = $nim;
		$data['judulhalaman'] = 'Tugas Tambahan';
		$status=$this->session->userdata('tanda');
		$ada=$this->input->post('ada');
		$this->load->model('Guru_model');
		$data["thnajaran"] = $this->input->post('thnajaran');
		$data["semester"] = $this->input->post('semester');
		$is_pns = $this->input->post('is_pns');
		$proses = $this->input->post('proses');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($nim);
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->model('Guru_model');
		$in["kodeguru"]=$this->input->post('kodeguru');
		$in["thnajaran"]=$this->input->post('thnajaran');
		$in["semester"]=$this->input->post('semester');
		$in["nama_tugas"]=$this->input->post('nama_tugas');
		$in["jtm"]=$this->input->post('jtm');
		$in["tpg"] = $this->input->post('tpg');
		$ada = $this->input->post('ada');
		if ($proses == '-')
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/tambahan',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$in = nopetik($in);
			if ($ada>0)
			{
				$this->Guru_model->Update_Data_Tambahan($in);
			}
			else
			{
				$this->Guru_model->Tambah_Data_Tambahan($in);
			}
			$hariinpassing = $this->input->post('hariinpassing');
			$bulaninpassing = $this->input->post('bulaninpassing');
			$tahuninpassing = $this->input->post('tahuninpassing');
			$in2["besar_tpg_pertama"] = $this->input->post('besar_tpg_pertama');
			$in2["tpg_pertama"] = $this->input->post('tpg_pertama');
			$in2["status_penerima_tpg"] = $this->input->post('status_penerima_tpg');
			$in2["status_tempat_tugas"] = $this->input->post('status_tempat_tugas');
			$in2['kd']=$nim;
			$in2['tmt_inpassing'] = "$tahuninpassing-$bulaninpassing-$hariinpassing";
			$in2["status_inpassing"]=$this->input->post('status_inpassing');
			$in2["madrasah_induk"]=$this->input->post('madrasah_induk');
			$in2 = nopetik($in2);
			$this->Guru_model->Update_Data_Umum($in2);
			redirect('perangkat/sertifikasi');
		}
	}
	function tutorial()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$nim=$this->session->userdata('nama');
		$time = time();
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$data['tautan'] = 'guru';
		$aksi = $this->uri->segment(3);
		$page=$this->uri->segment(4);
		$data['aksi'] = $aksi;
		$galat_upload = '';
      		$limit_ti=10;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$adaisi = hilangkanpetik($this->input->post('isi'));
		if(!empty($adaisi))
		{
			$id_tutorial = $this->input->post('id_tutorial');
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			if(empty($_FILES['userfile']['name']))
			{
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["judul_tutorial"]=$this->input->post('judul');
				$in["status"]=$this->input->post('status');
				$in["isi"]=$this->input->post('isi');
				$in["author"]=$nim;
				$in["id_kategori_tutorial"]=$this->input->post('kategori');
				if(empty($id_tutorial))
					{
	 				$in = hilangkanpetik($in);
					$this->Guru_model->Simpan_Tutorial($in);
					}
					else
					{
					$in['id_tutorial'] = $id_tutorial;
	 				$in = hilangkanpetik($in);
					$this->Guru_model->Update_Tutorial($in);
					}
			}
			else
			{
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["judul_tutorial"]=$this->input->post('judul');
				$in["status"]=$this->input->post('status');
				$in["isi"]=$this->input->post('isi');
				$in["author"]=$nim;
				$in["id_kategori_tutorial"]=$this->input->post('kategori');
				$file_ext = strrchr($_FILES['userfile']['name'], '.');
				$in["gambar"]= 'tutorial_'.$this->input->post('id_tutorial').''.$file_ext.'';
				$config["file_name"]= 'tutorial_'.$this->input->post('id_tutorial').''; //dengan eekstensi
				$config['upload_path'] = 'images/tutorial/';
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['max_size'] = '100000';
				$config['max_width'] = '1200';
				$config['max_height'] = '1200';						
				$this->load->library('upload', $config);
				if(empty($id_tutorial))
					{
	 				$in = hilangkanpetik($in);
					$this->Guru_model->Simpan_Tutorial($in);
					}
					else
					{
					$in['id_tutorial'] = $id_tutorial;
	 				$in = hilangkanpetik($in);
					$this->Guru_model->Update_Tutorial($in);
					}	
				if(!$this->upload->do_upload())
				{
					 $galat_upload = $this->upload->display_errors();
				}

			}
		}
		if($aksi == 'tambah')
			{
			$data['tekseditor'] = '';
			$data['judulhalaman'] = 'Tambah Materi Pelajaran';		   	
			$this->load->view('guru/bg_atas',$data);
			$datatambah["kategori"]=$this->Guru_model->Kat_Tutorial();
			$this->load->view('shared/tutorial',$datatambah);
			$this->load->view('shared/bawah');
			}
		elseif($aksi == 'tinjau')
			{
			$data["kategori"]=$this->Guru_model->Edit_Tutorial($page,$data["nama"]);
			$data["cur_kat"]=$this->Guru_model->Kat_Tutorial();
			$data['judulhalaman'] = 'Tinjau Materi Pelajaran';		   	
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/tutorial_tinjau',$data);
			$this->load->view('shared/bawah',$data);
			}
		elseif($aksi == 'hapus')
			{
			$this->Guru_model->Delete_Tutorial($page);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/tutorial'>";
			}
		elseif($aksi == 'ubah')
			{
			$data['tekseditor'] = '';
			$data['judulhalaman'] = 'Ubah Materi Pelajaran';		   	
			$dataedit["kategori"]=$this->Guru_model->Edit_Tutorial($page,$data["nama"]);
			$dataedit["cur_kat"]=$this->Guru_model->Kat_Tutorial();
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/tutorial',$dataedit);
			$this->load->view('shared/bawah');
			}
		else
			{
			$data['galat_upload'] = $galat_upload;
			$data['judulhalaman'] = 'Daftar Materi Pelajaran';
			$query=$this->Guru_model->Tampil_Tutorial($data["nama"],$limit_ti,$offset_ti);
			$tot_hal = $this->Guru_model->Total_Tutorial($data["nama"]);
      			$config['base_url'] = base_url() . 'guru/tutorial/tampil';
       			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
        		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/tutorial',$data_isi);
			$this->load->view('shared/bawah');
			}
	}
	function pengumuman()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["judulhalaman"]= 'Daftar Pengumuman';
		$nim = $this->session->userdata('username');
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi = $this->uri->segment(3);
		$judul_pengumuman=$this->input->post('judul');
		$isi = $this->input->post('isi');
		if((!empty($isi)) or (!empty($isi)))
			{
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$in["tanggal"] = mdate($tgl,$time);
			$in["judul_pengumuman"]=$this->input->post('judul');
			$in["isi"]=$this->input->post('isi');
			$in["penulis"]=$nim;
			$id_pengumuman=$this->input->post('id_pengumuman');
			if(empty($id_pengumuman))
				{
				$in = hilangkanpetik($in);
				$this->Guru_model->Simpan_Pengumuman($in);
				}
				else
				{
				$in['id_pengumuman']=$id_pengumuman;
				$in = hilangkanpetik($in);
				$this->Guru_model->Update_Pengumuman($in);
				}
			}
		if($aksi == 'tambah')
		{
   			$data['tekseditor'] = '';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pengumuman_tambah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'hapus')
		{
			$this->Guru_model->Delete_Pengumuman($page);
			redirect('guru/pengumuman/tampil');
		}
		elseif($aksi == 'edit')
		{
   			$data['tekseditor'] = '';
			$dataedit["kategori"]=$this->Guru_model->Edit_Pengumuman($page,$data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pengumuman_edit',$dataedit);
			$this->load->view('shared/bawah');
		}		else
		{
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Guru_model->Tampil_Pengumuman($data["nim"],$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Pengumuman($data["nim"]);
      		$config['base_url'] = base_url() . 'guru/pengumuman/tampil';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/pengumuman',$data_isi);
		$this->load->view('shared/bawah');
		}
	}
	function upload()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$pesan = '';
		$nim = $this->session->userdata('username');
		$this->load->model('Guru_model');
		$this->load->library('Pagination');
		$data['judulhalaman'] = 'Mengunggah Berkas';	
		$aksi = $this->uri->segment(3);
		$page=$this->uri->segment(4);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$id_file =$this->input->post('id_download');
			if(!empty($_FILES['userfile']['name']))
			{
				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$in["tgl_posting"] = mdate($tgl,$time);
				$in["judul_file"]=$this->input->post('judul');
				$in["author"]=$nim;
				$in["id_kat"]=$this->input->post('kategori');
				$acak=rand(00000000000,99999999999);
				$bersih=$_FILES['userfile']['name'];
				$nm=str_replace(" ","_","$bersih");
				$ubah=$acak.$nm; //tanpa ekstensi
				$in["nama_file"]=$ubah;
				$config['upload_path'] = 'unduhan/';
				$config['allowed_types'] = '*';
				$config["file_name"] =$ubah; //dengan eekstensi
				$config['max_size'] = '1000000';
				$config['max_width'] = '1200';
				$config['max_height'] = '1200';						
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload())
				{
					 $pesan = '<div class="alert alert-warning">'.$this->upload->display_errors().'</div>';
				}
				else {
				$in = hilangkanpetik($in);
				if(empty($id_file))
					{
					$this->Guru_model->Simpan_Upload($in);
					}
					else
					{
					$in['id_download'] = $id_file;
					$this->Guru_model->Update_Upload($in);
					}
				}
			}
			if(!empty($id_file))
				{
				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$in["tgl_posting"] = mdate($tgl,$time);
				$in["judul_file"]=$this->input->post('judul');
				$in["id_kat"]=$this->input->post('kategori');
				$in['id_download'] = $id_file;
				$this->Guru_model->Update_Upload($in);
				}
			if($aksi == 'unggah')
			{
			$datatambah["kategori"]=$this->Guru_model->Kat_Down();
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/upload_tambah',$datatambah);
			$this->load->view('shared/bawah');
			}
			elseif($aksi == 'hapus')
			{
				$id = $page;
				$this->load->model('Admin_model');
				$hapus=$this->Admin_model->Edit_Upload($id);
				foreach($hapus->result() as $t)
				{
					unlink("unduhan/$t->nama_file");
				}
				$this->Admin_model->Delete_Upload($id);
				redirect('guru/upload');
			}
			elseif($aksi == 'edit')
			{
				$this->load->model('Guru_model');
				$dataedit["kategori"]=$this->Guru_model->Edit_Upload($page,$data["nim"]);
				$dataedit["cur_kat"]=$this->Guru_model->Kat_Down();
				$dataedit["tanggal"] = mdate($datestring, $time);
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/upload_edit',$dataedit);
				$this->load->view('shared/bawah');
			}
			else
			{
			$query=$this->Guru_model->Tampil_File($data["nim"],$limit_ti,$offset_ti);
			$tot_hal = $this->Guru_model->Total_File($data["nim"]);
	      		$config['base_url'] = base_url() . '/guru/upload/daftar/';
	       		$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
			$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
			if(!empty($pesan))
			{
				$data['modul'] = 'Mengunggah Berkas';
				$data['tautan_balik'] = base_url().'guru/upload/daftar';
				$data['pesan'] = $pesan;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('shared/adagalat',$data);
				$this->load->view('shared/bawah');
			}
			else
			{	
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/upload',$data_isi);
				$this->load->view('shared/bawah');
			}
			}
	}
	function inbox()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pesan Masuk';
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
      		$config['base_url'] = base_url() . '/guru/inbox';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/inbox',$data_isi);
		$this->load->view('shared/bawah');
	}
	function detailinbox()
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
		$data['judulhalaman'] = 'Pesan Masuk';
		$data['tekseditor'] = '';
		$this->load->model('Guru_model');
		$data["detail"]=$this->Guru_model->Detail_Inbox($data["nim"],$id);
		$this->Guru_model->Update_Pesan($id);
		$data["id_inbox"] = $id;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/inbox_detil',$data);
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
		$data["nama"]=$this->session->userdata('nama');
		$status=$this->session->userdata('tanda');
		$in["username"]=$this->input->post('username');
		$in["tujuan"]=$this->input->post('tujuan');
		$in["subjek"]=$this->input->post('subjek');
		$pesanasli=$this->input->post('pesanasli');
		$pesan=$this->input->post('pesan');
		$pesan = preg_replace("/'/","`", $pesan);
		$pesan = preg_replace("/&nbsp;/","", $pesan);
		$in["pesan"]= "$pesanasli $pesan";
		$in["waktu"]=mdate($datestring,$time);
		$in["status_pesan"]="N";
		$id=$this->input->post('id_inbox');
		$this->load->model('Guru_model');
		$in = hilangkanpetik($in);
		$this->Guru_model->Balas_Pesan($in);
		$this->Guru_model->Update_Pesan_Lama($in["pesan"],$id);
		$this->load->model('Situs_model');
		//kirim sms ke siswa
		$tnohp = $this->Situs_model->Tampil_Data_Umum_Pegawai($nim);
		$nohpguru='';
		$namaguru = '';
		$jenkel ='';
		$id_sms_user = '';
		foreach($tnohp->result() as $dnohp)
		{
			$nohpguru = $dnohp->seluler;
			$namaguru = $dnohp->nama;
			$jenkel = $dnohp->jenkel;
			$id_sms_user = $dnohp->id_sms_user;
		}
		if ($jenkel=='Pr')
		{
			$pesanguru ='Pesan dari Ibu '.$data["nama"].', "'.strip_tags($pesan).'"';
		}
		elseif ($jenkel=='Lk')
		{
			$pesanguru ='Pesan dari Bapak '.$data["nama"].', "'.strip_tags($pesan).'"';
		}
		else 
		{
			$pesanguru ='Pesan dari '.$data["nama"].', "'.strip_tags($pesan).'"';
		}
		$this->load->model('Situs_model');
		$nomorseluler = $this->Situs_model->Nomor_Seluler_Siswa($in["tujuan"]);
		$chat_id = $this->Situs_model->Chat_ID_Siswa($in["tujuan"]);
		if(!empty($chat_id))
		{
			$kirimpesan = kirimtelegram($chat_id,$pesanguru,$token_bot);
		}
		elseif(!empty($nomorseluler))
		{
			$this->Situs_model->Kirim_SMS_Guru($nomorseluler,$pesanguru,$id_sms_user);
		}
		else
		{
		}
		redirect ('guru/inbox');
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/inbox'>";
	}
	function berita()
	{
		$data = array();
		$time = time();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$nim=$this->session->userdata('nama');
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$aksi=$this->uri->segment(3);
		$page=$this->uri->segment(4);
		$data['aksi'] = $aksi;
		$data['tautan'] = 'guru';
		$galat_upload = '';
		$isi=$this->input->post('isi');
		$id_berita=$this->input->post('id_berita');
		if(!empty($isi))
		{	
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			if(empty($_FILES['userfile']['name']))
			{
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["judul_berita"]=$this->input->post('judul');
				$in["isi"]=$this->input->post('isi');
				$in["author"]=$nim;
				$in["id_kategori"]=$this->input->post('kategori');
				if(empty($id_berita))
				{
					$this->Guru_model->Simpan_Berita($in);
				}
				else
				{
				$in["id_berita"]=$id_berita;
				$this->Guru_model->Update_Berita($in);
				}
			}
			else
			{
				$in["tanggal"] = mdate($tgl,$time);
				$in["waktu"] = mdate($jam,$time);
				$in["judul_berita"]=$this->input->post('judul');
				$in["isi"]=$this->input->post('isi');
				$in["author"]=$nim;
				$in["id_kategori"]=$this->input->post('kategori');
				$file_ext = strrchr($_FILES['userfile']['name'], '.');
				$config["file_name"]= 'berita_'.$id_berita.''.$file_ext; //dengan eekstensi
				$in["gambar"]=$_FILES['userfile']['name'];
				$config['upload_path'] = 'images/berita/';
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['max_size'] = '100000';
				$config['max_width'] = '1200';
				$config['max_height'] = '1200';						
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				if(empty($id_berita))
				{
					$in["id_berita"] = $id_berita;
					$this->Guru_model->Simpan_Berita($in);
				}
				else
				{
					if(!$this->upload->do_upload())
					{
						$in["id_berita"] = $id_berita;
						$this->Guru_model->Update_Berita($in);
						$galat_upload = $this->upload->display_errors();
					}
					else
					{
						$in["id_berita"] = $id_berita;
						$in["gambar"]= 'berita_'.$id_berita.''.$file_ext.'';
						$this->Guru_model->Update_Berita($in);
					}
				}
			}
		}
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Berita';
			$data['tekseditor'] = '';
			$datatambah["kategori"]=$this->Guru_model->Kat_Berita();
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/berita',$datatambah);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Berita';
			$data['tekseditor'] = '';
			$dataedit["det"]=$this->Guru_model->Edit_Berita($page,$data["nama"]);
			$dataedit["kategori"]=$this->Guru_model->Kat_Berita();
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/berita',$dataedit);
			$this->load->view('shared/bawah');
		}
		else
		{
			$data['galat_upload'] = $galat_upload;
	      		$limit_ti=15;
			if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
			$query=$this->Guru_model->Tampil_Semua_Berita($data["nama"],$limit_ti,$offset_ti);
			$tot_hal = $this->Guru_model->Total_Semua_Berita_User($data["nama"]);
      			$config['base_url'] = base_url() . '/guru/berita/tampil';
       			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
        		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
			$data['judulhalaman'] = 'Daftar Berita';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/berita',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function ketercapaiankkm()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Daftar Ketercapaian KKM';
		$kelas='';
		$thnajaran='';
		$id_walikelas='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_walikelas='';
		}
		else
		{
    			$id_walikelas = $this->uri->segment(3);
		}
			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
		foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_walikelas']=$id_walikelas;
		$data['daftar_siswa']=$this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		if ($ada==0)
			{
			redirect('guru/walikelas');
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/belum_kompeten',$data);
			$this->load->view('shared/bawah');
			}
	}
	function kehadiran()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Rekapitulasi Ketidakhadiran Siswa';
		$kelas='';
		$thnajaran='';
		$id_walikelas='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_walikelas='';
		}
		else
		{
    			$id_walikelas = $this->uri->segment(3);
		}
			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
		foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_walikelas']=$id_walikelas;
		$data['daftar_siswa']=$this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		if ($ada==0)
			{
			redirect('guru/walikelas');
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/kehadiran',$data);
			$this->load->view('shared/bawah');
			}
	}
	function kepribadian()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$kelas='';
		$thnajaran='';
		$id_walikelas='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_walikelas='';
		}
		else
		{
    			$id_walikelas = $this->uri->segment(3);
		}
		$nis='';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$nis='';
		}
		else
		{
    			$nis = $this->uri->segment(4);
		}
			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$data['nis']=$nis;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
		foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_walikelas']=$id_walikelas;
		$data['data_kehadiran']=$this->Guru_model->Tampil_Nilai_Kepribadian_Per_Kelas($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		if ($ada==0)
			{
			redirect('guru/walikelas');
			}
			else
			{
			$proses = $this->input->post('proses');
			if ($proses == 'overide')
				{
				$in["thnajaran"] = $this->input->post('thnajaran');
				$in["semester"] = $this->input->post('semester');
				$in["nis"] = $this->input->post('nis');
				$in["satu"] = $this->input->post('satu');
				$in["dua"] = $this->input->post('dua');
				$in["tiga"] = $this->input->post('tiga');
				$in["empat"] = $this->input->post('empat');
				$in["lima"] = $this->input->post('lima');
				$in["enam"] = $this->input->post('enam');
				$in["tujuh"] = $this->input->post('tujuh');
				$in["delapan"] = $this->input->post('delapan');
				$in["sembilan"] = $this->input->post('sembilan');
				$in["sepuluh"] = $this->input->post('sepuluh');
				$in["status"] = $this->input->post('status');
				$this->Guru_model->Overide_Kepribadian($in);
				$data['data_kehadiran']=$this->Guru_model->Tampil_Nilai_Kepribadian_Per_Kelas($thnajaran,$semester,$kelas);
				}
			$data['judulhalaman'] = 'Kepribadian Siswa';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/kepribadian',$data);
			$this->load->view('shared/bawah');
			}
	}
	function ropeg()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/ropeg',$data);
		$this->load->view('shared/bawah');
	}
	function ropegalamat()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
			$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/ropeg_alamat',$data);
			$this->load->view('shared/bawah');
	}
	function ropegpendidikan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data['query']=$this->Guru_model->Tampil_Riwayat_Pendidikan_Pegawai($data["nim"]); 
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/ropeg_pendidikan',$data);
		$this->load->view('shared/bawah');
	}
	function umum()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Data Pribadi Guru '.$data['nama'];
		$this->load->model('Guru_model');
		$data['tautan'] = 'guru';
		$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/detil_pegawai',$data);
		$this->load->view('shared/bawah');
	}
	function editdataumum()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah Data Pribadi '.$data['nama'];
		$this->load->model('Guru_model');
		$this->load->model('Model_select');
		$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$data['kd']=$data["nim"];
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/edit_detil_pegawai',$data);
//		$this->load->view('shared/bawah');
	}
	function buatdataumum()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$query=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$ada = $query->num_rows();
		if ($ada == 0)
		{
			$this->Guru_model->Buat_Data_Umum_Baru($data["nim"],$data["nama"],'Guru');
			redirect('guru/editdataumum');
		}
	}
	function updatedataumum()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["kodeguru"]=$nim;
		$in["kd"]=$this->input->post('kd');
		$in["status_tempat_tugas"] = $this->input->post('status_tempat_tugas');
		$in["kode_lptk"]=$this->input->post('kode_lptk');
		$in["jalur_sertifikasi"]=$this->input->post('jalur_sertifikasi');
		$in["jabatan"]=$this->input->post('jabatan');
		$in["jalan"]=$this->input->post('jalan');
		$in["pegid"]=$this->input->post('pegid');
		$in["kode_mapel_utama"]=$this->input->post('kode_mapel_utama');
		$in["nip"]=$this->input->post('nip');
		$in["npk"]=$this->input->post('npk');
		$in["efin"]=$this->input->post('efin');
		$in["nama"]=$this->input->post('nama');
		$in["tempat"]=$this->input->post('tempat');
		$harilahir = $this->input->post('harilahir');
		$bulanlahir = $this->input->post('bulanlahir');
		$tahunlahir = $this->input->post('tahunlahir');
		$tanggallahir = "$tahunlahir-$bulanlahir-$harilahir";
		$in["tanggallahir"]=$tanggallahir;
		$in["jenkel"]=$this->input->post('jenkel');
		$in["usiapensiun"]=$this->input->post('usiapensiun');
		$tahunpensiun = $in['usiapensiun']+$tahunlahir;
		$tanggalpensiun = "$tahunpensiun-$bulanlahir-$harilahir";
		$in["tanggalpensiun"]=$tanggalpensiun;
		$in["ayah"]=$this->input->post('ayah');
		$in["ibu"]=$this->input->post('ibu');
		$in["alamatortu"]=$this->input->post('alamatortu');
		$in["alamat"]=$this->input->post('alamat');
		$in["telpon"]=$this->input->post('telpon');
		$nohp=$this->input->post('seluler');
		if (strlen($nohp>9))
		{
			$in["seluler"]=seluler($nohp);
		}
		$in["bangsa"]=$this->input->post('bangsa');
		$in["agama"]=$this->input->post('agama');
		$in["ayahmertua"]=$this->input->post('ayahmertua');
		$in["ibumertua"]=$this->input->post('ibumertua');
		$in["alamatmertua"]=$this->input->post('alamatmertua');
		$in["nuptk"]=$this->input->post('nuptk');
		$in["nrg"]=$this->input->post('nrg');
		$in["npwp"]=$this->input->post('npwp');
		$haripertama = $this->input->post('haripertama');
		$bulanpertama = $this->input->post('bulanpertama');
		$tahunpertama = $this->input->post('tahunpertama');
		$kgb_pertama = "$tahunpertama-$bulanpertama-$haripertama";
		$harikgb = $this->input->post('harikgb');
		$bulankgb = $this->input->post('bulankgb');
		$tahunkgb = $this->input->post('tahunkgb');
		$tanggalkgb = "$tahunkgb-$bulankgb-$harikgb";
		$tahunkgbyad=substr($tanggalkgb,0,4)+2;
		$kgbyad = ''.$tahunkgbyad.''.substr($tanggalkgb,4,8).'';
		$in["kgb_pertama"]=$kgb_pertama;
		$in["kgb"]=$tanggalkgb;
		$in["kgb_yad"]=$kgbyad;
		//yyyy-mm-dd
		$tglkgbyad = substr($kgbyad,8,2);
		$blnkgbyad = substr($kgbyad,5,2);
		$thnkgbyad = substr($kgbyad,0,4);
		//2013-01-01 --> 2012-12-01
		if ($blnkgbyad==1)
		{
			$blnkgbyad = 12;
			$thnkgbyad = $thnkgbyad - 1;
		}
		else
		{
			$blnkgbyad = $blnkgbyad-1;
		}
		$in["kgb_sms"]= "$thnkgbyad-$blnkgbyad-$tglkgbyad";
		$in["nama_tanpa_gelar"]=$this->input->post('nama_tanpa_gelar');
		$gelar_depan=$this->input->post('gelar_depan');
		$gelar_belakang=$this->input->post('gelar_belakang');
		$gelar_depan_kustom=$this->input->post('gelar_depan_kustom');
		$gelar_belakang_kustom=$this->input->post('gelar_belakang_kustom');
		if(!empty($gelar_belakang_kustom))
		{
			$gelar_belakang = $gelar_belakang_kustom;
		}
		if(!empty($gelar_depan_kustom))
		{
			$gelar_depan = $gelar_depan_kustom;
		}

		$in["gelar_depan"]=$gelar_depan;
		$in["gelar_belakang"]=$gelar_belakang;

		$in["status_perkawinan"]=$this->input->post('status_perkawinan');
		$in["cacah_anak_kandung"]=$this->input->post('cacah_anak_kandung');
		$in["rt"]=$this->input->post('rt');
		$in["rw"]=$this->input->post('rw');
		$this->load->model('Model_select');
		$id_desa = hilangkanpetik($this->input->post('id_desa'));
		$datadesa = $this->Model_select->data_desa($id_desa);
		$id_kec = $datadesa[2];
		$datakec = $this->Model_select->data_kecamatan($id_kec);
		$id_kab = $datakec[2];
		$datakab = $this->Model_select->data_kabupaten($id_kab);
		$id_prov = $datakab[2];
		$dataprov = $this->Model_select->data_provinsi($id_prov);
		$provinsi = $this->Model_select->provinsi();
		$in["desa"] = $datadesa[1];
		$in["id_desa"] = $id_desa;
		$in["kecamatan"] = $datakec[1];
		$in["kabupaten"] = $datakab[1];
		$in["provinsi"] = $dataprov[1];
		$in["jenis_tempat_tinggal"]=$this->input->post('jenis_tempat_tinggal');
		$in["golongan_darah"]=$this->input->post('golongan_darah');
		$in["email"]=$this->input->post('email');
		$in["karpeg"]=$this->input->post('karpeg');
		$in["askes"]=$this->input->post('askes');
		$in["taspen"]=$this->input->post('taspen');
		$in["karis_karsu"]=$this->input->post('karis_karsu');
		$in["nama_ibu_kandung"]=$this->input->post('nama_ibu_kandung');
		$in["nik"]=$this->input->post('nik');
		$in["sudah_sertifikasi"]=$this->input->post('sudah_sertifikasi');
		$in["no_peserta_sertifikasi"]=$this->input->post('no_peserta_sertifikasi');
		$in["no_sertifikat"]=$this->input->post('no_sertifikat');
		$in["lulus_sertifikasi"]=$this->input->post('lulus_sertifikasi');
		$in["kode_mapel_sertifikasi"]=$this->input->post('kode_mapel_sertifikasi');
		$harilulus_sertifikasi = $this->input->post('harilulus_sertifikasi');
		$bulanlulus_sertifikasi = $this->input->post('bulanlulus_sertifikasi');
		$tahunlulus_sertifikasi = $this->input->post('tahunlulus_sertifikasi');
		$tgl_lulus_sertifikasi = "$tahunlulus_sertifikasi-$bulanlulus_sertifikasi-$harilulus_sertifikasi";
		$in["tgl_lulus_sertifikasi"]=$tgl_lulus_sertifikasi;
		$in["mapel_sertifikasi"]=$this->input->post('mapel_sertifikasi');
		$in["tugas_pokok"]=$this->input->post('tugas_pokok');
		$in["kodepos"]=$this->input->post('kodepos');
		$in["nip_lama"]=$this->input->post('nip_lama');
		$in["kpe"]=$this->input->post('kpe');
		$in["tb"]=$this->input->post('tb');
		$in["bb"]=$this->input->post('bb');
		$in["rambut"]=$this->input->post('rambut');
		$in["bentuk_muka"]=$this->input->post('bentuk_muka');
		$in["warna_kulit"]=$this->input->post('warna_kulit');
		$in["ciri_khas"]=$this->input->post('ciri_khas');
		$in["cacat_tubuh"]=$this->input->post('cacat_tubuh');
		$in["kegemaran"]=$this->input->post('kegemaran');
		$tgltmtguru = $this->input->post('tgl_tmt_guru');
		$bulantmtguru = $this->input->post('bulan_tmt_guru');
		$tahuntmtguru = $this->input->post('tahun_tmt_guru');
		$tmt_guru = "$tahuntmtguru-$bulantmtguru-$tgltmtguru";
		$in["tmt_guru"]=$tmt_guru;
		$tgltmtdi_sekolah = $this->input->post('tgl_tmt_di_sekolah');
		$bulantmtdi_sekolah = $this->input->post('bulan_tmt_di_sekolah');
		$tahuntmtdi_sekolah = $this->input->post('tahun_tmt_di_sekolah');
		$tmt_di_sekolah = "$tahuntmtdi_sekolah-$bulantmtdi_sekolah-$tgltmtdi_sekolah";
		$in["tmt_di_sekolah"]=$tmt_di_sekolah;
		$tgl_sertifikat = $this->input->post('hari_sertifikat');
		$bulan_sertifikat = $this->input->post('bulan_sertifikat');
		$tahun_sertifikat = $this->input->post('tahun_sertifikat');
		$in["tanggal_sertifikat"] = "$tahun_sertifikat-$bulan_sertifikat-$tgl_sertifikat";
		$in["bank"]=$this->input->post('bank');
		$in["nama_rekening_bank"]=$this->input->post('nama_rekening_bank');
		$in["nomor_rekening_bank"]=$this->input->post('nomor_rekening_bank');
		$in["nomor_sk_dirjen"]=$this->input->post('nomor_sk_dirjen');
		$this->load->model('Guru_model');
		$in = nopetik($in);
		$this->Guru_model->Update_Data_Umum($in);
		redirect('guru/umum');
	}
	function keluarga()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Daftar Anggota Keluarga';

		$data["terupdate"]='';
		$nip = $data["nim"];
		$usernamepegawai = $nip;
    		$aksi = $this->uri->segment(3);
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Anggota Keluarga';
			$data['kd'] = $data['nim'];
			$data['tautan']= 'guru'; 
			$this->load->model('Guru_model');
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/keluarga_tambah',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->model('Tatausaha_model');
			$data["usernamepegawai"] = $nip;
			$data['queryortu']=$this->Tatausaha_model->Tampil_Data_Ortu_Pegawai($nip);
			$data['querymertua']=$this->Tatausaha_model->Tampil_Data_Mertua_Pegawai($nip);
			$data['queryistrisuami']=$this->Tatausaha_model->Tampil_Data_Istri_Suami_Keluarga_Pegawai($nip);
			$data['queryanak']=$this->Tatausaha_model->Tampil_Data_Anak_Pegawai($nip);    
			$data['query']=$this->Tatausaha_model->Tampil_Data_Umum_Pegawai($nip); 
			$data["querypegawai"] = $this->Tatausaha_model->Total_Semua_Pegawai();    
			$data["namapegawai"] = $this->Tatausaha_model->get_Nama($usernamepegawai);    
			$data['querykeluarga']=$this->Tatausaha_model->Tampil_Data_Keluarga_Pegawai($usernamepegawai);
			$data['querykakakadik']=$this->Tatausaha_model->Tampil_Data_Kakak_Adik_Pegawai($usernamepegawai);
			$data['tautan'] = 'guru';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('shared/data_keluarga',$data);
			$this->load->view('shared/bawah');
		}
	}
	function pendidikan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
    		$aksi = $this->uri->segment(3);
 		$id = $this->uri->segment(4);

		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['nip'] = cari_nip_pegawai($kodeguru);
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Riwayat Pendidikan';
			$data['kd'] = $data['nim'];
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pendidikan_tambah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'hapus')
		{
			$this->Guru_model->Delete_Pendidikan($id,$data['nim']);
			redirect('guru/pendidikan');
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Riwayat Pendidikan';
			$data['query']=$this->Guru_model->Cek_Data_Pendidikan($data["nim"],$id);
			$data['kd']=$data["nim"]; 
			$data['id']=$id; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pendidikan_edit',$data);
			$this->load->view('shared/bawah');
		}

		else
		{
			$data['query']=$this->Guru_model->Tampil_Riwayat_Pendidikan_Pegawai($data["nim"]); 
			$data["judulhalaman"]= 'Riwayat Pendidikan';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pendidikan',$data);
			$this->load->view('shared/bawah');
		}
	}
	function kepegawaian($aksi=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Riwayat Kepegawaian';
		$this->load->model('Guru_model');
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Riwayat Kepegawaian';
			$data['kd'] = $data['nim'];
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/kepegawaian_tambah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'hapus')
		{
			$this->Guru_model->Delete_Kepegawaian($id,$data['nim']);
			redirect('guru/kepegawaian');
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Riwayat Kepegawaian';
			$data['query']=$this->Guru_model->Cek_Data_Kepegawaian($data["nim"],$id);
			$data['kd']=$data["nim"]; 
			$data['id']=$id; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/kepegawaian_edit',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$data["judulhalaman"]= 'Riwayat Kepegawaian';
			$data['query']=$this->Guru_model->Tampil_Data_Kepegawaian_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/kepegawaian',$data);
			$this->load->view('shared/bawah');
		}
	}
	function editkeluarga($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah Anggota Keluarga';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$query=$this->Guru_model->Cek_Data_Keluarga($data["nim"],$id);
		$ada = $query->num_rows();
		if ($ada >0)
		{
			$data['id']=$id;
			$data['query']=$query;
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/keluarga_edit',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru/keluarga');
		}
	}
	function updatedatakeluarga()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["id"] = $this->input->post('id');
		$in["urut"] = $this->input->post('urut');
		$in["nama"] = $this->input->post('nama');
		$in["jenkel"] = $this->input->post('jenkel');
		$in["tempat"] = $this->input->post('tempat');
		$harilahir = $this->input->post('harilahir');
		$bulanlahir = $this->input->post('bulanlahir');
		$tahunlahir = $this->input->post('tahunlahir');
		$in["tanggallahir"] = "$tahunlahir-$bulanlahir-$harilahir";
		$in["hubungan"] = $this->input->post('hubungan');
		$harinikah = $this->input->post('harinikah');
		$bulannikah = $this->input->post('bulannikah');
		$tahunnikah = $this->input->post('tahunnikah');
		$in["tanggal_nikah"] = "$tahunnikah-$bulannikah-$harinikah";
		$in["keterangan"] = $this->input->post('keterangan');
		$in["status"]='Y';
		$this->load->model('Guru_model');
		$this->Guru_model->Update_Data_Keluarga($in);
		redirect('guru/keluarga/');
	}
	function simpandatakeluarga()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["idpegawai"] = $nim;
		$in["nama"] = $this->input->post('nama');
		$in["urut"] = $this->input->post('urut');
		$in["jenkel"] = $this->input->post('jenkel');
		$in["tempat"] = $this->input->post('tempat');
		$harilahir = $this->input->post('harilahir');
		$bulanlahir = $this->input->post('bulanlahir');
		$tahunlahir = $this->input->post('tahunlahir');
		$in["tanggallahir"] = "$tahunlahir-$bulanlahir-$harilahir";
		$in["hubungan"] = $this->input->post('hubungan');
		$harinikah = $this->input->post('harinikah');
		$bulannikah = $this->input->post('bulannikah');
		$tahunnikah = $this->input->post('tahunnikah');
		$in["tanggal_nikah"] = "$tahunnikah-$bulannikah-$harinikah";
		$haripisah = $this->input->post('haripisah');
		$bulanpisah = $this->input->post('bulanpisah');
		$tahunpisah = $this->input->post('tahunpisah');
		$in["tanggal_pisah"] = "$tahunpisah-$bulanpisah-$haripisah";
		$in["keterangan"] = $this->input->post('keterangan');
		$in["pekerjaan"] = $this->input->post('pekerjaan');
		$in["status"]='Y';
		$this->load->model('Guru_model');
		$this->Guru_model->Simpan_Data_Keluarga($in);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/keluarga'>";
	}
	function simpandatapendidikan()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["idpegawai"] = $nim;
		$in["gelar"] = $this->input->post('gelar');
		$in["tingkat"] = $this->input->post('tingkat');
		$in["namasekolah"] = $this->input->post('namasekolah');
		$in["tahunlulus"] = $this->input->post('tahunlulus');
		$in["nomorijazah"] = $this->input->post('nomorijazah');
		$harilahir = $this->input->post('harilahir');
		$bulanlahir = $this->input->post('bulanlahir');
		$tahunlahir = $this->input->post('tahunlahir');
		$in["tanggalijazah"] = "$tahunlahir-$bulanlahir-$harilahir";
		$in["alamatsekolah"] = $this->input->post('alamatsekolah');
		$in["namakepala"] = $this->input->post('namakepala');
		$in["ip"] = $this->input->post('ip');
		$in["akta"] = $this->input->post('akta');
		$in["fakultas"] = $this->input->post('fakultas');
		$in["jurusan"] = $this->input->post('jurusan');
		$in["jenis"] = $this->input->post('jenis');
		$in["kategori"] = $this->input->post('kategori');
		$in["status"] = $this->input->post('status');
		$this->load->model('Guru_model');
		$this->Guru_model->Simpan_Data_pendidikan($in);
		redirect('guru/pendidikan');
	}
	function updatedatapendidikan()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["id"]=$this->input->post('id');
		$kd=$this->input->post('kd');
		$in["tingkat"] = $this->input->post('tingkat');
		$in["gelar"] = $this->input->post('gelar');
		$in["kelprodi"] = $this->input->post('kelprodi');
		$in["namasekolah"] = $this->input->post('namasekolah');
		$in["tahunlulus"] = $this->input->post('tahunlulus');
		$in["nomorijazah"] = $this->input->post('nomorijazah');
		$harilahir = $this->input->post('harilahir');
		$bulanlahir = $this->input->post('bulanlahir');
		$tahunlahir = $this->input->post('tahunlahir');
		$in["tanggalijazah"] ="$tahunlahir-$bulanlahir-$harilahir";
		$in["alamatsekolah"] = $this->input->post('alamatsekolah');
		$in["namakepala"] = $this->input->post('namakepala');
		$in["ip"] = $this->input->post('ip');
		$in["akta"] = $this->input->post('akta');
		$in["fakultas"] = $this->input->post('fakultas');
		$in["jurusan"] = $this->input->post('jurusan');
		$in["jenis"] = $this->input->post('jenis');
		$in["kategori"] = $this->input->post('kategori');
		$in["status"] = $this->input->post('status');
		$in["pendataan"] = $this->input->post('pendataan');
		$this->load->model('Guru_model');
		if ($nim==$kd)
		{
			$in = nopetik($in);
			$this->Guru_model->Update_Data_Pendidikan($in);
		}
		redirect('guru/pendidikan');
	}
	function updatedatakepegawaian()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["id"] = $this->input->post('id');
		$kd = $this->input->post('kd');
		$in["instansi"] = $this->input->post('instansi');
		$harilahir = $this->input->post('harisurat');
		$bulanlahir = $this->input->post('bulansurat');
		$tahunlahir = $this->input->post('tahunsurat');
		$in["tanggal"] = "$tahunlahir-$bulanlahir-$harilahir";
		$haritmt = $this->input->post('haritmt');
		$bulantmt = $this->input->post('bulantmt');
		$tahuntmt = $this->input->post('tahuntmt');
		$in["tmt"] = "$tahuntmt-$bulantmt-$haritmt";
		$in["uraian"] = $this->input->post('uraian');
		$in["nomorsurat"] = $this->input->post('nomorsurat');
		$in["gol"] = $this->input->post('gol');
		$golongan = substr($this->input->post('gol'),3,10);
		$in["tahun"] = $this->input->post('tahun');	
		$in["bulan"] = $this->input->post('bulan');
		$in["gapok"] = $this->input->post('gapok');
		$in["status_tugas"] = $this->input->post('status_tugas');
		$in["status_kepegawaian"] = $this->input->post('status_kepegawaian');
		$in["instansi_yang_mengangkat"] = $this->input->post('instansi_yang_mengangkat');
		$in["status_keaktifan"] = $this->input->post('status_keaktifan');
		$in["pendataan"] = $this->input->post('pendataan');
		$in["jenis_sk"] = $this->input->post('jenis_sk');
		$in["pangkat"] = golongan_jadi_pangkat($golongan);
		$in["jabatan"] = golongan_jadi_jabatan($golongan);
		$in["pejabat"] = $this->input->post('pejabat');
		$in["pak"] = $this->input->post('pak');
		$this->load->model('Guru_model');
		if ($nim==$kd)
		{
			$in = nopetik($in);
			$this->Guru_model->Update_Data_Kepegawaian($in);
		}
		$config['allowed_types'] ='jpg|png';
		$config['upload_path'] = 'images/berkas_guru_pegawai';
		$config['overwrite'] = TRUE;
		$idne = $this->config->item('awalttd').$this->input->post('id');
		$acak = 'sk_'.md5($idne);
		$file_ext = strrchr($_FILES['userfile']['name'], '.');
		$filename = $acak.''.$file_ext;
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$datay['modul'] = 'Unggah Berkas SK';
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
				$data['nim'] = $nim;
				$data['judulhalaman'] =' Galat, unggah berkas';
				$datay['pesan'] = $this->upload->display_errors();
				$datay['tautan_balik'] = ''.base_url().'guru/kepegawaian/ubah/'.$this->input->post('id');
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);
			}
			else 
			{
				$in['berkas'] = $filename;
				$this->Guru_model->Update_Data_Kepegawaian($in);
				redirect('guru/kepegawaian');
			}
		}
		else
		{
			redirect('guru/kepegawaian');
		}

	}
	function simpandatakepegawaian()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$kd = $this->input->post('kd');
				$in["idpegawai"] = $this->input->post('kd');
				$in["instansi"] = $this->input->post('instansi');
				$harilahir = $this->input->post('harisurat');
				$bulanlahir = $this->input->post('bulansurat');
				$tahunlahir = $this->input->post('tahunsurat');
				$in["tanggal"] = "$tahunlahir-$bulanlahir-$harilahir";
				$haritmt = $this->input->post('haritmt');
				$bulantmt = $this->input->post('bulantmt');
				$tahuntmt = $this->input->post('tahuntmt');
				$in["tmt"] = "$tahuntmt-$bulantmt-$haritmt";
				$in["uraian"] = $this->input->post('uraian');
				$in["nomorsurat"] = $this->input->post('nomorsurat');
				$in["gol"] = $this->input->post('gol');
				$in["gapok"] = $this->input->post('gapok');
				$in["tahun"] = $this->input->post('tahun');	
				$in["bulan"] = $this->input->post('bulan');
				$in["status_tugas"] = $this->input->post('status_tugas');
				$in["status_kepegawaian"] = $this->input->post('status_kepegawaian');
				$in["instansi_yang_mengangkat"] = $this->input->post('instansi_yang_mengangkat');
				$in["status_keaktifan"] = $this->input->post('status_keaktifan');
				$in["jenis_sk"] = $this->input->post('jenis_sk');
				$in["pangkat"] = $this->input->post('pangkat');
				$in["jabatan"] = $this->input->post('jabatan');
				$in["pendataan"] = $this->input->post('pendataan');				
				$in["pak"] = $this->input->post('pak');
				$in["pejabat"] = $this->input->post('pejabat');
				$this->load->model('Guru_model');
				if ($nim==$kd)
				{
					$in = nopetik($in);
					$this->Guru_model->Simpan_Data_Kepegawaian($in);
				}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/kepegawaian'>";
	}
	function sertifikat()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$aksi = $this->uri->segment(3);
    		$id = $this->uri->segment(4);
		$this->load->model('Guru_model');
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Diklat / Sertifikat / Piagam / STTPL';
			$data['kd']=$data["nim"]; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/sertifikat_tambah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'hapus')
		{
			$this->Guru_model->Delete_Sertifikat($id,$data['nim']);
			redirect('guru/sertifikat');
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Data Sertifikat';
			$data['query']=$this->Guru_model->Cek_Data_Sertifikat($data["nim"],$id);
			$data['kd']=$data["nim"]; 
			$data['id']=$id; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/sertifikat_edit',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$data["judulhalaman"]= 'Riwayat Diklat / Penataran / Seminar / IHT';
			$data['query']=$this->Guru_model->Tampil_Riwayat_Sertifikat_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/sertifikat',$data);
			$this->load->view('shared/bawah');
		}
	}
	function updatedatasertifikat()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["id"] = $this->input->post('id');
		$kd = $this->input->post('kd');
		$in["instansi"] = $this->input->post('instansi');
		$in["jenis"] = $this->input->post('jenis');
	 	$harilahir = $this->input->post('harisurat');
	 	$bulanlahir = $this->input->post('bulansurat');
	 	$tahunlahir = $this->input->post('tahunsurat');
		$in["tanggalsertifikat"] = "$tahunlahir-$bulanlahir-$harilahir";
		$in["nomor"] = $this->input->post('nomor');
		$in["tanggalpelaksanaan"] = $this->input->post('tanggalpelaksanaan');
		$in["tempat"] = $this->input->post('tempat');
		$in["kegiatan"] = $this->input->post('kegiatan');
		$in["jamdiklat"] = $this->input->post('jamdiklat');
		$in["kode_penataran"] = $this->input->post('kode_penataran');
		$in["penyelenggara"] = $this->input->post('penyelenggara');
		$in["pendataan"] = $this->input->post('pendataan');
		$in["angkatan"] = $this->input->post('angkatan');
		$harimulai = $this->input->post('harimulai');
		$bulanmulai = $this->input->post('bulanmulai');
		$tahunmulai = $this->input->post('tahunmulai');
		$in["tgl_mulai"] =  "$tahunmulai-$bulanmulai-$harimulai";
		$hariselesai = $this->input->post('hariselesai');
		$bulanselesai = $this->input->post('bulanselesai');
		$tahunselesai = $this->input->post('tahunselesai');
		$in["tgl_selesai"] = "$tahunselesai-$bulanselesai-$hariselesai";
		$this->load->model('Guru_model');
		if ($nim==$kd)
		{
			$in = nopetik($in);
			$this->Guru_model->Update_Data_Sertifikat($in);
		}
		redirect('guru/sertifikat');
	}
	function simpandatasertifikat()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$kd = $this->input->post('kd');
				$in["idpegawai"] = $this->input->post('kd');
				$in["instansi"] = $this->input->post('instansi');
				$in["jenis"] = $this->input->post('jenis');
	 			$harilahir = $this->input->post('harisurat');
	 			$bulanlahir = $this->input->post('bulansurat');
	 			$tahunlahir = $this->input->post('tahunsurat');
				$in["tanggalsertifikat"] = "$tahunlahir-$bulanlahir-$harilahir";
				$in["nomor"] = $this->input->post('nomor');
				$in["tanggalpelaksanaan"] = $this->input->post('tanggalpelaksanaan');
				$in["tempat"] = $this->input->post('tempat');
				$in["kegiatan"] = $this->input->post('kegiatan');
				$in["jamdiklat"] = $this->input->post('jamdiklat');
				$in["kode_penataran"] = $this->input->post('kode_penataran');
				$in["penyelenggara"] = $this->input->post('penyelenggara');
				$in["pendataan"] = $this->input->post('pendataan');
				$in["angkatan"] = $this->input->post('angkatan');
				$harimulai = $this->input->post('harimulai');
				$bulanmulai = $this->input->post('bulanmulai');
				$tahunmulai = $this->input->post('tahunmulai');
				$in["tgl_mulai"] =  "$tahunmulai-$bulanmulai-$harimulai";
				$hariselesai = $this->input->post('hariselesai');
				$bulanselesai = $this->input->post('bulanselesai');
				$tahunselesai = $this->input->post('tahunselesai');
				$in["tgl_selesai"] = "$tahunselesai-$bulanselesai-$hariselesai";
				$this->load->model('Guru_model');
				if ($nim==$kd)
				{
				$this->Guru_model->Simpan_Data_Sertifikat($in);
				}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/sertifikat'>";
	}
	function blankonilaipdf()
	{
		$data = array();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$thn1='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$thn1='';
		}
		else
		{
    			$thn1 = $this->uri->segment(3);
		}
		$thn2='';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$thn2='';
		}
		else
		{
    			$thn2 = $this->uri->segment(4);
		}
		$semester='';		
		if ($this->uri->segment(5) === FALSE)
		{
    			$semester='';
		}
		else
		{
    			$semester = $this->uri->segment(5);
		}
		$kodeguru='';		
		if ($this->uri->segment(6) === FALSE)
		{
    			$kodeguru='';
		}
		else
		{
    			$kodeguru = $this->uri->segment(6);
		}
		$pilihan='';		
		if ($this->uri->segment(7) === FALSE)
		{
    			$pilihan='';
		}
		else
		{
    			$pilihan = $this->uri->segment(7);
		}
	   	$thnajaran = ''.$thn1.'/'.$thn2.'';
		$this->load->model('Guru_model');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['pilihan']=$pilihan;
		$data['kodeguru']=$kodeguru;
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($pilihan)) and (!empty($kodeguru)))
        	{
			$this->load->view('pdf/blanko_nilai', $data);
		}
	}
	function daftarmapel()
	{
		$data = array();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
 				$this->load->model('Guru_model');
			$data['thnajaran']=$this->input->post('thnajaran');
			$data['semester']=$this->input->post('semester');
			$data['pilihan']=$this->input->post('pilihan');
			$data['kodeguru']=$this->input->post('kodeguru');
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$data['daftar_mapel']= $this->Guru_model->Tampilkan_Mapel_Guru($data['thnajaran'],$data['semester'],$data['kodeguru']);
			$this->load->view('guru/bg_atas',$data);
			if ((!empty($data['semester'])) and (!empty($data['thnajaran'])) and (!empty($data['pilihan'])) and (!empty($data['kodeguru'])))
	        	{
			$this->load->view('guru/daftar_mapel', $data);
			}
			else
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/cetakblankonilai'>";
			}
			$this->load->view('shared/bawah');
	}
	function pekerjaan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
			$data['query']=$this->Guru_model->Tampil_Data_Kepegawaian_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/ropeg_kepegawaian',$data);
			$this->load->view('shared/bawah');
	}
	function ropegnomor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
			$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/ropeg_nomor',$data);
			$this->load->view('shared/bawah');
	}
	function ropegkeluarga()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
			$data['query']=$this->Guru_model->Tampil_Data_Keluarga_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/ropeg_keluarga',$data);
			$this->load->view('shared/bawah');
	}
	function ropegdrh()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
			$data['querykeluarga']=$this->Guru_model->Tampil_Data_Keluarga_Pegawai($data["nim"]); 
			$data['querykepeg']=$this->Guru_model->Tampil_Data_Kepegawaian_Pegawai($data["nim"]);
			$data['querypendidikan']=$this->Guru_model->Tampil_Riwayat_Pendidikan_Pegawai($data["nim"]); 
			$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
			$this->load->model('Tatausaha_model');
			$data['queryistrisuami']=$this->Tatausaha_model->Tampil_Data_Istri_Suami_Keluarga_Pegawai($data["nim"]);
			$data['querydiklat']=$this->Tatausaha_model->Tampil_Data_Diklat_Pegawai($data["nim"]);
			$data['querykeluarnegeri']=$this->Tatausaha_model->Tampil_Data_Keluar_Negeri_Pegawai($data["nim"]);  
			$data['querypenghargaan']=$this->Tatausaha_model->Tampil_Data_Penghargaan_Pegawai($data["nim"]);    
			$data['querykakakadik']=$this->Tatausaha_model->Tampil_Data_Kakak_Adik_Pegawai($data["nim"]);
			$data['queryorgslta']=$this->Tatausaha_model->Tampil_Data_Organisasi_SLTA_Pegawai($data["nim"]);
			$data['queryorgpt']=$this->Tatausaha_model->Tampil_Data_Organisasi_PT_Pegawai($data["nim"]);
			$data['queryorgpegawai']=$this->Tatausaha_model->Tampil_Data_Organisasi_Pegawai_Pegawai($data["nim"]);
			$data['queryanak']=$this->Tatausaha_model->Tampil_Data_Anak_Pegawai($data["nim"]);    
			$data['queryortu']=$this->Tatausaha_model->Tampil_Data_Ortu_Pegawai($data["nim"]);
			$data['querymertua']=$this->Tatausaha_model->Tampil_Data_Mertua_Pegawai($data["nim"]);
			$data['queryjabatan']=$this->Guru_model->Tampil_Data_Jabatan_Pegawai($data["nim"]);  
			//$this->load->view('guru/bg_atas',$data);
			//
			$this->load->view('guru/ropeg_drh',$data);
			//$this->load->view('shared/bawah');
	}
	function jabatan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
    		$aksi = $this->uri->segment(3);
 		$id = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['nip'] = cari_nip_pegawai($kodeguru);
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Riwayat Jabatan';
			$data['kd'] = $data['nim'];
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/jabatan_tambah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'hapus')
		{
			$this->Guru_model->Delete_Jabatan($id,$data['nim']);
			redirect('guru/pendidikan');
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Riwayat Jabatan';
			$data['query']=$this->Guru_model->Cek_Data_Jabatan($data["nim"],$id);
			$data['kd']=$data["nim"]; 
			$data['id']=$id; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/jabatan_edit',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$data["judulhalaman"]= 'Riwayat Jabatan';
			$data['queryjabatan']=$this->Guru_model->Tampil_Riwayat_Jabatan_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/jabatan',$data);
			$this->load->view('shared/bawah');
		}
	}
	function simpandatajabatan()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$in["idpegawai"] = $this->input->post('kd');
				$in["nama_jabatan"] = $this->input->post('nama_jabatan');
				$in["golongan"] = $this->input->post('golongan');
				$in["gaji_pokok"] = $this->input->post('gaji_pokok');
				$in["pejabat"] = $this->input->post('pejabat');
				$hariawal = $this->input->post('hariawal');
				$bulanawal = $this->input->post('bulanawal');
				$tahunawal = $this->input->post('tahunawal');
				$in["tgl_awal"] = "$tahunawal-$bulanawal-$hariawal";
				$hariakhir = $this->input->post('hariakhir');
				$bulanakhir = $this->input->post('bulanakhir');
				$tahunakhir = $this->input->post('tahunakhir');
				$in["tgl_akhir"] = "$tahunakhir-$bulanakhir-$hariakhir";
				$in["nomor"] = $this->input->post('nomor');
				$harisk = $this->input->post('harisk');
				$bulansk = $this->input->post('bulansk');
				$tahunsk = $this->input->post('tahunsk');
				$in["tanggal_sk"] = "$tahunsk-$bulansk-$harisk";
				$this->load->model('Guru_model');
				$this->Guru_model->Simpan_Data_jabatan($in);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/jabatan'>";
	}
	function updatedatajabatan()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$in["id"]=$this->input->post('id');
				$kd=$this->input->post('kd');
				$in["idpegawai"] = $this->input->post('kd');
				$in["nama_jabatan"] = $this->input->post('nama_jabatan');
				$in["golongan"] = $this->input->post('golongan');
				$in["gaji_pokok"] = $this->input->post('gaji_pokok');
				$in["pejabat"] = $this->input->post('pejabat');
				$hariawal = $this->input->post('hariawal');
				$bulanawal = $this->input->post('bulanawal');
				$tahunawal = $this->input->post('tahunawal');
				$in["tgl_awal"] = "$tahunawal-$bulanawal-$hariawal";
				$hariakhir = $this->input->post('hariakhir');
				$bulanakhir = $this->input->post('bulanakhir');
				$tahunakhir = $this->input->post('tahunakhir');
				$in["tgl_akhir"] = "$tahunakhir-$bulanakhir-$hariakhir";
				$in["nomor"] = $this->input->post('nomor');
				$harisk = $this->input->post('harisk');
				$bulansk = $this->input->post('bulansk');
				$tahunsk = $this->input->post('tahunsk');
				$in["tanggal_sk"] = "$tahunsk-$bulansk-$harisk";
				$this->load->model('Guru_model');
				if ($nim==$kd)
				{
				$this->Guru_model->Update_Data_Jabatan($in);
				}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/jabatan'>";
	}
	function keluarnegeri()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$aksi = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Riwayat Perjalanan Keluar negeri';
			$this->load->model('Guru_model');
			$data['kd']=$data["nim"]; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/keluarnegeri_tambah',$data);
			$this->load->view('shared/bawah');

		}
		elseif($aksi == 'hapus')
		{
			$this->load->model('Guru_model');
			$this->Guru_model->Delete_Keluarnegeri($id,$data['nim']);
			redirect('guru/keluarnegeri');

		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Riwayat Perjalanan Keluar negeri';
			$this->load->model('Guru_model');
			$data['query']=$this->Guru_model->Cek_Data_Keluarnegeri($data["nim"],$id);
			$data['kd']=$data["nim"]; 
			$data['id']=$id; 
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/keluarnegeri_edit',$data);
			$this->load->view('shared/bawah');

		}
		else
		{
			$data["judulhalaman"]= 'Riwayat Perjalanan Keluar negeri';
			$this->load->model('Tatausaha_model');
			$data['querykeluarnegeri']=$this->Tatausaha_model->Tampil_Data_Keluar_Negeri_Pegawai($data["nim"]);  
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/keluarnegeri',$data);
			$this->load->view('shared/bawah');
		}
	}
	function simpandatakeluarnegeri()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["idpegawai"] = $this->input->post('kd');
		$in["negara"] = $this->input->post('negara');
		$in["tujuan_kunjungan"] = $this->input->post('tujuan_kunjungan');
		$in["lama"] = $this->input->post('lama');
		$in["pembiaya"] = $this->input->post('pembiaya');
		$this->load->model('Guru_model');
		$this->Guru_model->Simpan_Data_Keluarnegeri($in);
		redirect('guru/keluarnegeri');
	}
	function updatedatakeluarnegeri()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["id"]=$this->input->post('id');
		$kd=$this->input->post('kd');
		$in["idpegawai"] = $this->input->post('kd');
		$in["negara"] = $this->input->post('negara');
		$in["tujuan_kunjungan"] = $this->input->post('tujuan_kunjungan');
		$in["lama"] = $this->input->post('lama');
		$in["pembiaya"] = $this->input->post('pembiaya');
		$this->load->model('Guru_model');
		if ($nim==$kd)
		{
			$this->Guru_model->Update_Data_Keluarnegeri($in);
		}
		redirect('guru/keluarnegeri');
	}
	function organisasi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$aksi = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$data['kd']=$data["nim"]; 
		$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
		$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
		if($aksi == 'tambah')
		{
			$data["judulhalaman"]= 'Tambah Riwayat Organisasi';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/organisasi_tambah',$data);
			$this->load->view('shared/bawah');

		}
		elseif($aksi == 'hapus')
		{
			$this->Guru_model->Delete_Organisasi($id,$data['nim']);
			redirect('guru/organisasi');

		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"]= 'Ubah Riwayat Organisasi';
			$data['query']=$this->Guru_model->Cek_Data_Organisasi($data["nim"],$id);
			$data['id']=$id; 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/organisasi_edit',$data);
			$this->load->view('shared/bawah');

		}
		else
		{
			$this->load->model('Tatausaha_model');
			$data["judulhalaman"]= 'Riwayat Organisasi';
			$data['queryorganisasi']=$this->Tatausaha_model->Tampil_Data_Organisasi_Pegawai($data["nim"]);  
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/organisasi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function simpandataorganisasi()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$in["idpegawai"] = $this->input->post('kd');
				$in["tingkat"] = $this->input->post('tingkat');
				$in["nama_organisasi"] = $this->input->post('nama_organisasi');
				$in["tahun_awal"] = $this->input->post('tahun_awal');
				$in["tahun_akhir"] = $this->input->post('tahun_akhir');
				$in["tempat"] = $this->input->post('tempat');
				$in["kedudukan"] = $this->input->post('kedudukan');
				$in["nama_pimpinan"] = $this->input->post('nama_pimpinan');
				$this->load->model('Guru_model');
				$this->Guru_model->Simpan_Data_Organisasi($in);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/organisasi'>";
	}
	function updatedataorganisasi()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$in["id"]=$this->input->post('id');
				$in["idpegawai"] = $this->input->post('kd');
				$in["tingkat"] = $this->input->post('tingkat');
				$in["nama_organisasi"] = $this->input->post('nama_organisasi');
				$in["tahun_awal"] = $this->input->post('tahun_awal');
				$in["tahun_akhir"] = $this->input->post('tahun_akhir');
				$in["tempat"] = $this->input->post('tempat');
				$in["kedudukan"] = $this->input->post('kedudukan');
				$in["nama_pimpinan"] = $this->input->post('nama_pimpinan');
				$kd=$this->input->post('kd');
				$this->load->model('Guru_model');
				if ($nim==$kd)
				{
					$this->Guru_model->Update_Data_Organisasi($in);
				}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/organisasi'>";
	}
	function unduhdaftarnilai()
	{
		$data = array();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$thn1='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$thn1='';
			}
			else
			{
	    			$thn1 = $this->uri->segment(3);
			}
			$thn2='';		
			if ($this->uri->segment(4) === FALSE)
			{
	    			$thn2='';
			}
			else
			{
	    			$thn2 = $this->uri->segment(4);
			}			$semester='';		
			if ($this->uri->segment(5) === FALSE)
			{
	    			$semester='';
			}
			else
			{
	    			$semester = $this->uri->segment(5);
			}
			$kodeguru='';		
			if ($this->uri->segment(6) === FALSE)
			{
	    			$kodeguru='';
			}
			else
			{
	    			$kodeguru = $this->uri->segment(6);
			}
		   	$thnajaran = ''.$thn1.'/'.$thn2.'';
			$this->load->model('Guru_model');
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['kodeguru']=$kodeguru;
			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($pilihan)) and (!empty($kodeguru)))
	        	{
			$this->load->view('guru/unduh_daftar_nilai', $data);
			}			else
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/unduhnilai'>";
			}
	}
	function daftarnilaimapel()
	{
		$data = array();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
			$this->load->model('Nilai_model');
			$data['thnajaran']=$this->input->post('thnajaran');
			$data['semester']=$this->input->post('semester');
			$data['kodeguru']=$this->input->post('kodeguru');
//			$this->load->view('guru/coba_unduh_csv', $data);
			$array = array(
				array('Last Name', 'First Name', 'Gender'),
				array('Furtado', 'Nelly', 'female'),
				array('Twain', 'Shania', 'female'),
				array('Farmer', 'Mylene', 'female')
				);
			$this->load->helper('csv');
			array_to_csv($array, 'toto.csv');
	}
	function kbm()
	{
		$tahun = date("Y");
		$bulan = date("m");
		$tgl = date("d");
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["tanggalsekarang"]= "$tgl/$bulan/$tahun";
		$kelas='';
		$thnajaran='';
		$mapel='';
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
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$ranah = $dtmapel->ranah;
			}
		$data['kkm']=$kkm;
		$data['ranah']=$ranah;
		$thnajaran = $dtmapel->thnajaran;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['kode_guru']=$kodeguru;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
		}
		$data['ada']=$ada;
		if ((empty($kkm)) or (empty($ranah)))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/ubahkkm/$id'>";
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/kbm',$data);
			$this->load->view('shared/bawah');
			}
	}
	function hapuskbm()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$id ='';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$semester='';
				if ($this->uri->segment(3) === FALSE)
				{
		    			$id='';
				}
				else
				{
		    			$id = $this->uri->segment(3);
				}
				$pisah =explode("x",$id);
				$pisahtgl = $pisah[1];
				$tanggalkbm = ''.substr($pisahtgl,0,4).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,6,2).'';
				$id_mapel = $pisah[0];
				$this->load->model('Guru_model');
				$kodeguru = $data["nim"];	
				$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
				$data['id_mapel']=$id_mapel;
				$ada = $tmapel->num_rows();
				if ($ada>0)
				{
					foreach($tmapel->result() as $dtmapel)
					{
					$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$semester = $dtmapel->semester;
					$kkm = $dtmapel->kkm;
					$ranah = $dtmapel->ranah;
					}
				}
				$this->Guru_model->Hapus_Kehadiran_Siswa($tanggalkbm,$mapel,$kelas);
				$this->Guru_model->Hapus_Jurnal($tanggalkbm,$mapel,$kodeguru,$kelas);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/kbm/$id_mapel'>";
	}
	function hadirsemua()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$id ='';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$semester='';
				if ($this->uri->segment(3) === FALSE)
				{
		    			$id='';
				}
				else
				{
		    			$id = $this->uri->segment(3);
				}
				$pisah =explode("x",$id);
				$id_mapel = $pisah[0];
				$pisahtgl = $pisah[1];
				$tanggalkbm = ''.substr($pisahtgl,0,4).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,6,2).'';
				$this->load->model('Guru_model');
				$kodeguru = $data["nim"];	
				$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
				$data['id_mapel']=$id_mapel;
				$ada = $tmapel->num_rows();
				if ($ada>0)
				{
					foreach($tmapel->result() as $dtmapel)
					{
					$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$semester = $dtmapel->semester;
					$kkm = $dtmapel->kkm;
					$ranah = $dtmapel->ranah;
					}
				}
				$this->Guru_model->Hapus_Kehadiran_Siswa($tanggalkbm,$mapel,$kelas);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/kbm/$id_mapel'>";
	}
	function lihatkehadiran()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$id ='';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$semester='';
		$kkm='';
		$ranah='';
			if ($this->uri->segment(3) === FALSE)
				{
		    			$id='';
				}
				else
				{
		    			$id = $this->uri->segment(3);
				}
				$pisah =explode("x",$id);
				$id_mapel = $pisah[0];
				$pisahtgl = $pisah[1];
				$tanggalkbmx = ''.substr($pisahtgl,0,4).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,6,2).'';
				$tanggalkbm = ''.substr($pisahtgl,6,2).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,0,4).'';
				$data["tanggalkbm"] = $tanggalkbm;
				$data["tanggalkbmx"] = $tanggalkbmx;
				$this->load->model('Guru_model');
						$kodeguru = $data["nim"];	
				$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
				$data['id_mapel']=$id_mapel;
				$ada = $tmapel->num_rows();
				if ($ada>0)
				{
				foreach($tmapel->result() as $dtmapel)
					{
					$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$kkm = $dtmapel->kkm;
					$semester = $dtmapel->semester;				
					$ranah = $dtmapel->ranah;
					}
				}
				$data['kkm']=$kkm;
				$data['ranah']=$ranah;
				$data['kelas']=$kelas;
				$data['thnajaran']=$thnajaran;
				$data['mapel']=$mapel;
				$data['semester']=$semester;
				$data['id_mapel']=$id_mapel;
				$data['id']=$id;
				$data['query']=$this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		
//		if ((empty($kkm)) or (empty($ranah)))
		if ($ada==0)
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/ubahkkm/$id_mapel'>";
			}
			else
			{
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/daftar_hadir',$data);
		$this->load->view('shared/bawah');
			}
	}
	function ubahstatus($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');
		$kode_membolos = $this->ref->ambil_nilai('kode_membolos');
		$kode_terlambat = $this->ref->ambil_nilai('kode_terlambat');
		$kode_tanpa_keterangan = $this->ref->ambil_nilai('kode_tanpa_keterangan');
		$in=array();
		$pisah =explode("x",$id);
		$id_mapel = $pisah[0];
		$pisahtgl = $pisah[1];
		$tanggalabsen = ''.substr($pisahtgl,0,4).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,6,2).'';
		$alasan = $pisah[2];
		$nis = $pisah[3];
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
				$ranah = $dtmapel->ranah;
			}
		}
		if ((!empty($nis)) and (!empty($alasan)) and (!empty($tanggalabsen)))
		{
			$ada = $this->Guru_model->Cek_Daftar_Hadir($tanggalabsen,$mapel,$nis);
			$ada = $ada->num_rows();
			$pbk['thnajaran'] = $thnajaran;
			$pbk['semester'] = $semester;
			$pbk['kelas'] = $kelas;
			$pbk['nis'] = $nis;
			$pbk['mapel'] = $mapel;
			$pbk['tanggalsekarang'] = $tanggalabsen;
			$this->Guru_model->Add_Daftar_Hadir($pbk,$ada);
			$in=array();
			$in["thnajaran"] = $thnajaran;
			$in["semester"] = $semester;
			$in["nis"] = $nis;
			$in["tanggalabsen"] = $tanggalabsen;
			$in["alasan"] = $alasan;
			$in["keterangan"] = '';
			$in["kode_guru"] = $kodeguru;
			$param=array();
			$this->load->model('Bp_model');
			$query = $this->Bp_model->Cek_Data_Absensi_Siswa($nis,$tanggalabsen);
	       		$ada = $query->num_rows();
			$this->Bp_model->Simpan_Data_Absensi_Siswa($in,$ada);
			$in2=array();
			$in2["kelas"] = $kelas;
			$in2["nis"] = $nis;
			$in2["tanggalabsen"] = $tanggalabsen;
			$in2["alasan"] = $alasan;
			$in2["mapel"] = $mapel;
			$this->Bp_model->Simpan_Data_Absensi_Siswa_Kbm($in2);
			$poin = 0;
			if (($alasan=='A') or ($alasan=='T') or ($alasan=='B') or ($alasan=='L'))
			{
				if ($alasan=='T')
				{
					$kode = $kode_terlambat;
					$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
				}
				if ($alasan=='L')
				{
					$kode = $kode_terlambat_mapel;
					$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
				}
				if ($alasan=='A')
				{
					$kode = $kode_tanpa_keterangan;
					$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
				}
				if ($alasan=='B')
				{
					$kode = $kode_membolos;
					$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
				}
				foreach($querypoin->result() as $dpoin)
				{
					$poin = $dpoin->point;
				}
				$param["thnajaran"] = $thnajaran;
				$param["semester"] = $semester;
				$param["nis"] = $nis;
				$param["tanggal"] = $tanggalabsen;
				$param["kd_pelanggaran"] = $kode;
				$param["kodeguru"] = $kodeguru;
				$param["point"] = $poin;
				$tkredit= $this->Bp_model-> Cek_Kredit($nis,$kode,$tanggalabsen);
				$cacah = $tkredit->num_rows();
				if ($cacah==0)
				{
					$this->Bp_model->Simpan_Kredit($param);
				}
			}
			$dikembalikan = $pisah[0].'x'.$pisah[1];
			redirect('guru/lihatkehadiran/'.$dikembalikan);
		}
		else
		{
			$data["set_tipe"]=$this->ref->ambil_nilai('sek_tipe');
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/absensi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function jurnal($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$id ='';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$semester='';
		$kkm='';
		$ranah='';
		$pisah =explode("x",$id);
		$id_mapel = $pisah[0];
		$pisahtgl = $pisah[1];
		$tanggalkbmx = ''.substr($pisahtgl,0,4).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,6,2).'';
		$tanggalkbm = ''.substr($pisahtgl,6,2).'-'.substr($pisahtgl,4,2).'-'.substr($pisahtgl,0,4).'';
		$data["tanggalkbm"] = $tanggalkbm;
		$data["tanggalkbmx"] = $tanggalkbmx;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
				$ranah = $dtmapel->ranah;
			}
		}
		$tjurnal = $this->Guru_model->Tampil_Jurnal_Guru_Tanggal($kelas,$mapel,$kodeguru,$tanggalkbmx);
		$materi ='';
		$materi_selanjutnya = '';
		foreach($tjurnal->result() as $dtjurnal)
		{
			$materi =$dtjurnal->materi;
			$materi_selanjutnya = $dtjurnal->materi_selanjutnya;
			$tanggal_bph = $dtjurnal->tanggal_bph;
		}
		$data['materi'] =$materi;
		$data['materi_selanjutnya'] = $materi_selanjutnya;
		$data['kkm']=$kkm;
		$data['ranah']=$ranah;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id_mapel;
		$data['kodeguru']=$kodeguru;
		$data['tanggal_bph']=$tanggal_bph;
		if ($ada==0)
		{
			redirect('guru/ubahkkm/'.$id_mapel);
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/jurnal',$data);
			$this->load->view('shared/bawah');
		}
	}
	function simpanjurnal()
	{
		$in=array();
		$nim=$this->session->userdata('nama');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$in["tanggal"] = $this->input->post('tanggalkbm');
		$in["materi"] = $this->input->post('materi');
		$in["materi_selanjutnya"]=$this->input->post('materi_selanjutnya');
		$in["kelas"]=$this->input->post('kelas');
		$in["mapel"]=$this->input->post('mapel');
		$id_mapel=$this->input->post('id_mapel');
		$in["kodeguru"]=$this->input->post('kodeguru');
		$tanggalhadir2 =$this->input->post('tanggalhadir2');
		$bulanhadir2 =$this->input->post('bulanhadir2');
		$tahunhadir2 =$this->input->post('tahunhadir2');
		$tanggalbph = "$tahunhadir2-$bulanhadir2-$tanggalhadir2";
		$in['tanggal_bph'] = $tanggalbph;
		$this->Guru_model->Simpan_Jurnal($in);
		redirect('guru/kbm/'.$id_mapel);
	}
	function hasilanalisis($id=null,$itemnilai=null,$ditandatangani=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$ulangan = $itemnilai;		
		if(($itemnilai == 'uh1') or ($itemnilai == 'uh2') or ($itemnilai == 'uh3') or ($itemnilai == 'uh4') or ($itemnilai == 'mid') or ($itemnilai == 'uas'))
		{
			$this->load->model('Guru_model');
			$kodeguru = $data["nim"];	
			$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$data["kodeguru"]= $kodeguru;
			$ada = $tmapel->num_rows();
			$kkm_ulangan = '';
			$nsoal = 0;
			$nsoalb = 0;
			$skor = 0;
			$skorb= 0;
			if ($ada>0)
			{
				foreach($tmapel->result() as $dtmapel)
				{
					$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$semester = $dtmapel->semester;
					$kkm = $dtmapel->kkm;
					$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
					$cacah_tugas = $dtmapel->cacah_tugas;
					$ranah = $dtmapel->ranah;
					$no_urut_rapor = $dtmapel->no_urut_rapor;
					$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
					$bobot_tugas = $dtmapel->bobot_tugas;
					$bobot_mid = $dtmapel->bobot_mid;
					$bobot_semester = $dtmapel->bobot_semester;
					if ($ulangan=='uh1')
					{
						$kkm_ulangan = $dtmapel->kkm_uh1;
						$nsoal = $dtmapel->nsoal_uh1;
						$nsoalb = $dtmapel->nsoal_b_uh1;
						$skor = $dtmapel->skor_uh1;
						$skorb= $dtmapel->nilai_maks_bagian_b_uh1;
					}
					if ($ulangan=='uh3')
					{
						$kkm_ulangan = $dtmapel->kkm_uh3;
						$nsoal = $dtmapel->nsoal_uh3;
						$nsoalb = $dtmapel->nsoal_b_uh3;
						$skor = $dtmapel->skor_uh3;
						$skorb= $dtmapel->nilai_maks_bagian_b_uh3;
					}
					if ($ulangan=='uh4')
					{
						$kkm_ulangan = $dtmapel->kkm_uh4;
						$nsoal = $dtmapel->nsoal_uh4;
						$nsoalb = $dtmapel->nsoal_b_uh4;
						$skor = $dtmapel->skor_uh4;
						$skorb= $dtmapel->nilai_maks_bagian_b_uh4;
					}
					if ($ulangan=='uh2')
					{
						$kkm_ulangan = $dtmapel->kkm_uh2;
						$nsoal = $dtmapel->nsoal_uh2;
						$nsoalb = $dtmapel->nsoal_b_uh2;
						$skor = $dtmapel->skor_uh2;
						$skorb= $dtmapel->nilai_maks_bagian_b_uh2;
					}
					if ($ulangan=='mid')
					{
						$kkm_ulangan = $dtmapel->kkm_mid;
						$nsoal = $dtmapel->nsoal_mid;
						$nsoalb = $dtmapel->nsoal_b_mid;
						$skor = $dtmapel->skor_mid;
						$skorb= $dtmapel->nilai_maks_bagian_b_mid;
					}
					if ($ulangan=='uas')
					{
						$kkm_ulangan = $dtmapel->kkm_uas;
						$nsoal = $dtmapel->nsoal_uas;
						$nsoalb = $dtmapel->nsoal_b_uas;
						$skor = $dtmapel->skor_uas;
						$skorb= $dtmapel->nilai_maks_bagian_b_uas;
					}
				}
				$data['kkm']=$kkm;
				$data['ranah']=$ranah;
				$thnajaran = $dtmapel->thnajaran;
				$data['kelas']=$kelas;
				$data['thnajaran']=$thnajaran;
				$data['mapel']=$mapel;
				$data['semester']=$semester;
				$data['id_mapel']=$id;
				$data['itemnilai']=$itemnilai;
				$data['kd_mapel']=$no_urut_rapor;
				$data['cacah_ulangan_harian'] = $cacah_ulangan_harian;
				$data['cacah_tugas'] = $cacah_tugas;
				$data['nbobot_ulangan_harian'] = $bobot_ulangan_harian;
				$data['nbobot_tugas'] = $bobot_tugas;
				$data['nbobot_mid'] = $bobot_mid;
				$data['nbobot_semester'] = $bobot_semester;
				$data['nsoal'] = $nsoal;
				$data['nsoalb'] = $nsoalb;
				$data['skor'] = $skor;
				$data['skorb'] = $skorb;
				$data['kkm_ulangan'] = $kkm_ulangan;
				$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			}
			$data['ada']=$ada;
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			else
			{
				if ($ditandatangani == "ttd")
				{
					$data["ditandatangani"]="ya";
				}
				else
				{
					$data["ditandatangani"]="tidak";
				}
				$this->load->model('Referensi_model','ref');
				$data['baris1'] = $this->ref->ambil_nilai('baris1');
				$data['baris2'] = $this->ref->ambil_nilai('baris2');
				$data['baris3'] = $this->ref->ambil_nilai('baris3');
				$data['baris4'] = $this->ref->ambil_nilai('baris4');
				$data['persentase_klasikal'] = $this->ref->ambil_nilai('persentase_klasikal');
				$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
				$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
				$data['plt'] = $this->ref->ambil_nilai('plt');
				$this->load->view('guru/analisis_hasil',$data);
			}
		}
		else
		{
				$data['judulhalaman'] = 'Galat!  Hasil Penilaian tidak didukung';
				$datay['pesan'] = 'Galat!  Penilaian <strong>'.$itemnilai.'</strong> tidak didukung. Penilaian yang didukung penilaihan harian 1 s.d. 4, tengah semester dan akhir semester';
				$datay['tautan_balik'] = ''.base_url().'guru/daftarnilai/'.$id;
				$datay['modul'] = 'hasil analisis penilaian';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);

		}
	}
	function analisis($id=null,$ulangan=null,$id_analisis=null,$entry=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Analisis Ulangan Harian';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$kkm_ulangan = '';
		$nsoal = '';
		$skor = '';
		$skora = '';
		$skorb = '';
		$nsoalb = '';
		$data["id_analisis"] = $id_analisis;			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]);
		$data['ulangan']=$ulangan; 	 	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		$oke = 1;
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				if ($ulangan=='uh1')
					{
					$kkm_ulangan = $dtmapel->kkm_uh1;
					$nsoal = $dtmapel->nsoal_uh1;
					$skor = $dtmapel->skor_uh1;
					$skora = $dtmapel->nilai_maks_bagian_a_uh1;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh1;
					$nsoalb = $dtmapel->nsoal_b_uh1;
					$oke = 0;
					}
				if ($ulangan=='uh3')
					{
					$kkm_ulangan = $dtmapel->kkm_uh3;
					$nsoal = $dtmapel->nsoal_uh3;
					$skor = $dtmapel->skor_uh3;
					$skora = $dtmapel->nilai_maks_bagian_a_uh3;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh3;
					$nsoalb = $dtmapel->nsoal_b_uh3;
					$oke = 0;
					}
				if ($ulangan=='uh4')
					{
					$kkm_ulangan = $dtmapel->kkm_uh4;
					$nsoal = $dtmapel->nsoal_uh4;
					$skor = $dtmapel->skor_uh4;
					$skora = $dtmapel->nilai_maks_bagian_a_uh4;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh4;
					$nsoalb = $dtmapel->nsoal_b_uh4;
					}
				if ($ulangan=='uh2')
					{
					$kkm_ulangan = $dtmapel->kkm_uh2;
					$nsoal = $dtmapel->nsoal_uh2;
					$skor = $dtmapel->skor_uh2;
					$skora = $dtmapel->nilai_maks_bagian_a_uh2;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh2;
					$nsoalb = $dtmapel->nsoal_b_uh2;
					$oke = 0;
					}
				if ($ulangan=='mid')
					{
					$kkm_ulangan = $dtmapel->kkm_mid;
					$nsoal = $dtmapel->nsoal_mid;
					$skor = $dtmapel->skor_mid;
					$skora = $dtmapel->nilai_maks_bagian_a_mid;
					$skorb = $dtmapel->nilai_maks_bagian_b_mid;
					$nsoalb = $dtmapel->nsoal_b_mid;
					$oke = 0;
					}
				if ($ulangan=='uas')
					{
					$kkm_ulangan = $dtmapel->kkm_uas;
					$nsoal = $dtmapel->nsoal_uas;
					$skor = $dtmapel->skor_uas;
					$skora = $dtmapel->nilai_maks_bagian_a_uas;
					$skorb = $dtmapel->nilai_maks_bagian_b_uas;
					$nsoalb = $dtmapel->nsoal_b_uas;
					$oke = 0;
					}
			}
		$data['kkm']=$kkm;
		$thnajaran = $dtmapel->thnajaran;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['ulangan']=$ulangan;
		$data['nsoal'] = $nsoal;
		$data['skor'] = $skor;
		$data['skora'] = $skora;
		$data['skorb'] = $skorb;
		$data['nsoalb'] = $nsoalb;
		$data['kkm_ulangan'] = $kkm_ulangan;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Analisis($kelas,$mapel,$semester,$thnajaran,$ulangan);
		$this->load->model('Nilai_model');
		$data["tkepala"] = $this->Nilai_model->Kepala($thnajaran,$semester);
		}
		$data['ada']=$ada;
		$data['kodeguru'] = $kodeguru;
		if (!empty($id_analisis))
		{
			if ($id_analisis=='cetak')
				{
					$this->load->model('Referensi_model','ref');
					$data['baris1'] = $this->ref->ambil_nilai('baris1');
					$data['baris2'] = $this->ref->ambil_nilai('baris2');
					$data['baris3'] = $this->ref->ambil_nilai('baris3');
					$data['baris4'] = $this->ref->ambil_nilai('baris4');
					$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
					$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
					$data['plt'] = $this->ref->ambil_nilai('plt');
					$data["ditandatangani"] = $this->uri->segment(6);
				$this->load->view('guru/analisis_cetak',$data);
				}
			elseif ($id_analisis=='unduh')
				{
				$this->load->view('guru/mengunduh_analisis_ulangan',$data);
				}
			elseif ($id_analisis=='unggah')
				{
				$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/analisis_unggah',$data);
				$this->load->view('shared/bawah');
				}
			else if ($id_analisis=='kirim')
				{
					$id_mapel=$id;
					$skormaks = $nsoal * $skor;
					$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$ulangan' and `dipakai`='1' limit 0,1");
					if($ta->num_rows() > 0)
					{
						foreach($ta->result() as $a)
						{
							$skormaks = 0;
							for($i=1;$i<=50;$i++)
							{
								$iteme = 's'.$i;	
								$skormaks = $skormaks + $a->$iteme;
							}
						}
					}

					$nsoale = $nsoal;
					$kolom = 0;
					do
					{	
						$nil[$kolom]=0;
						$kolom++;
					}
					while ($kolom<$nsoale);
					$kolom = 0;
					do
					{	
						$nilb[$kolom]=0;
						$kolom++;
					}
					while ($kolom<$nsoale);
					$query_analisis=$this->Guru_model->Tampil_Semua_Nilai_Analisis($kelas,$mapel,$semester,$thnajaran,$ulangan);					if(count($query_analisis->result())>0)
					{
						foreach($query_analisis->result() as $t)
						{
						$kolom = 0;
						$nilaipersiswa= 0;
							do
							{	
							$nilaine=0;
							$nokol = $kolom + 1;
							$item = 'nilai_s'.$nokol.'';
							$nilaine = $t->$item;
							$nil[$kolom]=$nil[$kolom]+$nilaine;
							$nilaipersiswa= $nilaipersiswa + $nilaine;
							$kolom++;
							}
							while ($kolom<$nsoal);
							$nilaipersiswab= 0;
							if ($nsoalb>0)
							{
								$kolomb = 0;
							
								do
								{	
									$nilaineb=0;
									$nokolb = $kolomb + 1;
									$item = 'uraian_'.$nokolb.'';
									$nilaineb = $t->$item;
									$nilb[$kolomb]=$nilb[$kolomb]+$nilaineb;
									$nilaipersiswab= $nilaipersiswab + $nilaineb;
									$kolomb++;
								}
								while ($kolomb<$nsoalb);
							}
						$persentase =round($nilaipersiswa / $skormaks * $skora,2);
						$nilaiulangan = $persentase + $nilaipersiswab;
					
						$nis = $t->nis;
						$this->db->query("update `nilai` set `nilai_$ulangan`= '$nilaiulangan' where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis` = '$nis'");
						$this->db->query("update `analisis` set `terkunci`='1' where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis` = '$nis' and `ulangan`='$ulangan' ");
						}
			}
				$nip=$this->Guru_model->get_NIP($data["nim"]);
				$kegiatanharian = 'menganalisis hasil penilaian pembelajaran mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tahun = tahunsaja(tanggal_hari_ini());
				$tanggalhariini = tanggal_hari_ini();
				$jam = jam_saja();
				$menit = menit_saja();
				$this->db->query("update `sieka_harian` set `jam_selesai` = '$jam', `menit_selesai`='$menit' where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilai/$id_mapel'>";				}
			else
			{
			$data["entry"] = $entry;
			$data['query_analisis']=$this->Guru_model->Tampil_Satu_Nilai_Analisis($id_analisis);
			$this->load->view('guru/bg_atas',$data);			
			$this->load->view('guru/analisis_edit',$data);
			}		}
		elseif (($ada==0) or ($oke==1))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/nilai'>";
			}
		else
		{
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/analisis',$data);
		}
	}
	function analisisjawabansiswa($id=null,$ulangan=null,$id_analisis=null,$entry=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman']='Analisis Jawaban Siswa';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$data["id_analisis"] = $id_analisis;			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]);
		$data['ulangan']=$ulangan; 	 	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$kunci = '';
				if ($ulangan=='uh1')
					{
					$kkm_ulangan = $dtmapel->kkm_uh1;
					$nsoal = $dtmapel->nsoal_uh1;
					$nsoalb = $dtmapel->nsoal_b_uh1;
					$skor = $dtmapel->skor_uh1;
					$kunci = $dtmapel->kunciuh1;
					$kuncib = $dtmapel->kuncibuh1;
					$skora = $dtmapel->nilai_maks_bagian_a_uh1;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh1;
					}
				if ($ulangan=='uh3')
					{
					$kkm_ulangan = $dtmapel->kkm_uh3;
					$nsoal = $dtmapel->nsoal_uh3;
					$skor = $dtmapel->skor_uh3;
					$kunci = $dtmapel->kunciuh3;
					$kuncib = $dtmapel->kuncibuh3;
					$nsoalb = $dtmapel->nsoal_b_uh3;
					$skora = $dtmapel->nilai_maks_bagian_a_uh3;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh3;
					}
				if ($ulangan=='uh4')
					{
					$kkm_ulangan = $dtmapel->kkm_uh4;
					$nsoal = $dtmapel->nsoal_uh4;
					$skor = $dtmapel->skor_uh4;
					$kunci = $dtmapel->kunciuh4;
					$kuncib = $dtmapel->kuncibuh4;
					$nsoalb = $dtmapel->nsoal_b_uh4;
					$skora = $dtmapel->nilai_maks_bagian_a_uh4;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh4;
					}
				if ($ulangan=='uh2')
					{
					$kkm_ulangan = $dtmapel->kkm_uh2;
					$nsoal = $dtmapel->nsoal_uh2;
					$skor = $dtmapel->skor_uh2;
					$kunci = $dtmapel->kunciuh2;
					$kuncib = $dtmapel->kuncibuh2;
					$nsoalb = $dtmapel->nsoal_b_uh2;
					$skora = $dtmapel->nilai_maks_bagian_a_uh2;
					$skorb = $dtmapel->nilai_maks_bagian_b_uh2;
					}
				if ($ulangan=='mid')
					{
					$kkm_ulangan = $dtmapel->kkm_mid;
					$nsoal = $dtmapel->nsoal_mid;
					$skor = $dtmapel->skor_mid;
					$kunci = $dtmapel->kuncimid;
					$kuncib = $dtmapel->kuncibmid;
					$nsoalb = $dtmapel->nsoal_b_mid;
					$skora = $dtmapel->nilai_maks_bagian_a_mid;
					$skorb = $dtmapel->nilai_maks_bagian_b_mid;
					}
				if ($ulangan=='uas')
					{
					$kkm_ulangan = $dtmapel->kkm_uas;
					$nsoal = $dtmapel->nsoal_uas;
					$skor = $dtmapel->skor_uas;
					$kunci = $dtmapel->kunciuas;
					$kuncib = $dtmapel->kuncibuas;
					$nsoalb = $dtmapel->nsoal_b_uas;
					$skora = $dtmapel->nilai_maks_bagian_a_uas;
					$skorb = $dtmapel->nilai_maks_bagian_b_uas;
					}
			}
		$data['kkm']=$kkm;
		$thnajaran = $dtmapel->thnajaran;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['ulangan']=$ulangan;
		$data['nsoal'] = $nsoal;
		$data['nsoalb'] = $nsoalb;
		$data['skor'] = $skor;
		$data['skora'] = $skora;
		$data['skorb'] = $skorb;
		$data['kkm_ulangan'] = $kkm_ulangan;
		$data['kunci'] = $kunci;
		$data['kuncib'] = $kuncib;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Analisis($kelas,$mapel,$semester,$thnajaran,$ulangan);
		$this->load->model('Nilai_model');
		$data["tkepala"] = $this->Nilai_model->Kepala($thnajaran,$semester);
		}
		$data['ada']=$ada;
		$data['kodeguru'] = $kodeguru;
		$bonus = 0;
		if (!empty($id_analisis))
		{
			if ($id_analisis=='cetak')
				{
					$this->load->model('Referensi_model','ref');
					$data['baris1'] = $this->ref->ambil_nilai('baris1');
					$data['baris2'] = $this->ref->ambil_nilai('baris2');
					$data['baris3'] = $this->ref->ambil_nilai('baris3');
					$data['baris4'] = $this->ref->ambil_nilai('baris4');
					$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
					$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
					$data['plt'] = $this->ref->ambil_nilai('plt');
				$this->load->view('guru/analisis_jawaban_siswa_cetak',$data);
				}
			elseif ($id_analisis=='unduh')
				{
				$this->load->view('guru/analisis_jawaban_siswa_unduh_csv',$data);
				}
			elseif ($id_analisis=='kirim')
				{
				if(($entry>0) and ($entry<11))
					{
					$bonus = $entry;
					}
				//$this->load->view('guru/analisis_kirim_nilai_ke_daftar_nilai',$data);
				$query_analisis=$this->Guru_model->Tampil_Semua_Nilai_Analisis($kelas,$mapel,$semester,$thnajaran,$ulangan);
				$id_mapel=$id;
				$skor = 1;
				$skormaks = $nsoal * $skor;
				if(count($query_analisis->result())>0)
				{
					foreach($query_analisis->result() as $t)
					{
					$kolom = 0;
					$nilaipersiswa= 0;
					$skoruraian = $t->uraian_1 + $t->uraian_2 + $t->uraian_3 + $t->uraian_4 + $t->uraian_5 + $t->uraian_6 + $t->uraian_7 + $t->uraian_8 + $t->uraian_9 + $t->uraian_10;
					do
					{	
					$nilaine=0;
					$nokol = $kolom + 1;
					$item = 'nilai_s'.$nokol.'';
					$nilaine = $t->$item;
					$nilaipersiswa= $nilaipersiswa + $nilaine;
					$kolom++;
					}
					while ($kolom<$nsoal);
					$skorea = $nilaipersiswa / $skormaks * $skora;
					$nilaiulangan = $skorea + $skoruraian + $bonus;
					$nilaiulangan = round($nilaiulangan,2);
					$nis = $t->nis;
					$this->db->query("update `nilai` set `nilai_$ulangan`= '$nilaiulangan' where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis` = '$nis'");
					$this->db->query("update `analisis` set `terkunci`='1' where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='$semester' and `nis` = '$nis' and `ulangan`='$ulangan' ");
					}
				}
				$nip=$this->Guru_model->get_NIP($data["nim"]);
				$kegiatanharian = 'menganalisis hasil penilaian pembelajaran mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tahun = tahunsaja(tanggal_hari_ini());
				$tanggalhariini = tanggal_hari_ini();
				$jam = jam_saja();
				$menit = menit_saja();
				$this->db->query("update `sieka_harian` set `jam_selesai` = '$jam', `menit_selesai`='$menit' where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");
				redirect('guru/daftarnilai/'.$id_mapel);
				}
			elseif ($id_analisis=='unggah')
				{
				$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/analisis_jawaban_siswa_unggah',$data);
				$this->load->view('shared/bawah');
				}
			elseif ($id_analisis=='proses')
				{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/analisis_jawaban_siswa',$data);
				} 
			elseif ($id_analisis=='buka')
				{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/analisis_jawaban_siswa',$data);
				} 
			else
			{
				$data["entry"] = $entry;
				$data['js_cacah'] = 'ada';
				$this->load->view('guru/bg_atas',$data);
				$data['query_analisis']=$this->Guru_model->Tampil_Satu_Nilai_Analisis($id_analisis);
				$this->load->view('guru/analisis_jawaban_siswa_edit',$data);
			}
		}
		else
		{
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/analisis_jawaban_siswa',$data);
		}
		$this->load->view('shared/bawah',$data);
	}
	function perbaruidaftarsiswaanalisis()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$thnajaran=$this->input->post('thnajaran');
		$kelas=$this->input->post('kelas');
		$id_mapel=$this->input->post('id_mapel');
		$mapel=$this->input->post('mapel');
		$ulangan=$this->input->post('ulangan');
		$semester=$this->input->post('semester');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
			{
				$nis = $dsiswa->nis;
				$no_urut = $dsiswa->no_urut;
				$status=$dsiswa->status;
				$ada = $this->Guru_model->Cek_Nilai_Analisis($thnajaran,$semester,$mapel,$ulangan,$nis);
				$ada = $ada->num_rows();
				$pbk['thnajaran'] = $thnajaran;
				$pbk['semester'] = $semester;
				$pbk['kelas'] = $kelas;
				$pbk['nis'] = $nis;
				$pbk['mapel'] = $mapel;
				$pbk['ulangan'] = $ulangan;
				$pbk['no_urut'] = $no_urut;
				$pbk['status'] = $status;
				$this->Guru_model->Add_Nilai_Analisis($pbk,$ada);
				
			}//		$=$this->input->post('');
//		$=$this->input->post('');
//		$=$this->input->post('');
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/analisis/$id_mapel/$ulangan'>";
	}
	function updateanalisis()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$id_mapel=$this->input->post('id_mapel');
		$ulangan=$this->input->post('ulangan');
		$jmlsoal=$this->input->post('nsoal');
		$jmlsoalb=$this->input->post('nsoalb');
		$skora = $this->input->post('skora');
		$entry=$this->input->post('entry');
		$in["id_analisis"]=$this->input->post('id_analisis');	
		$kunci = $this->input->post('kunci');
		$kuncib = $this->input->post('kuncib');
		$id_analisis = $this->input->post('id_analisis');
		if ($entry == 'jawaban siswa')
		{
			$nomorb = 0;
			$skoruraian = 0;
			do
			{
				$nomorsoalb = $nomorb+1;
				$in["uraian_$nomorsoalb"] = $this->input->post("uraian_$nomorsoalb");
				$nomorb++;
			}
			while ($nomorb<$jmlsoalb);
			$kelompok = $this->input->post('kelompok');
			$in['kelompok'] = $kelompok;
			$in['jawaban']=strtoupper($this->input->post('jawabane'));
			$jawaban=strtoupper($this->input->post('jawabane'));
			$skore = 0;
			for($i=1;$i<=$jmlsoal;$i++)
			{
				$posisi = $i - 1;
				if (empty($kelompok))
				{
					$kuncine = substr($kunci,$posisi,1);
				}
				else
				{
					$kuncine = substr($kuncib,$posisi,1);
				}
				$jawabane = substr($jawaban,$posisi,1);
				$in2['id_analisis'] = $id_analisis;
				if ($kuncine == $jawabane)
				{
					$in2["nilai_s$i"]= 1;
				}
				else
				{
					$in2["nilai_s$i"]= 0;
				}
				$this->Guru_model->Update_Analisis_Jawaban($in2);
			}
		}
		elseif ($entry == 'sekaligus')
		{
			$nomor = 0;
			$nilai = explode(" ",$this->input->post("nilai_soal"));
			do
			{
				$nomorsoal = $nomor+1;
				if(!isset($nilai[$nomor]))
				{
					$nilai[$nomor] = 0;
				}
				$in["nilai_s$nomorsoal"] = $nilai[$nomor];
				$nomor++;
			}
			while ($nomor<$jmlsoal);
			$nomorb = 0;
			$nilaib = explode(" ",$this->input->post("uraian"));
			do
			{
				$nomorsoalb = $nomorb+1;
				$in["uraian_$nomorsoalb"] = $nilaib[$nomorb];
				$nomorb++;
			}
			while ($nomorb<$jmlsoalb);
		}
		else
		{
			$nomor = 0;
			do
			{
				$nomorsoal = $nomor+1;
				$in["nilai_s$nomorsoal"] = $this->input->post("nilai_s$nomorsoal");
				$nomor++;
			}
			while ($nomor<$jmlsoal);
			$nomorb = 0;
			do
			{
				$nomorsoalb = $nomorb+1;
				$in["uraian_$nomorsoalb"] = $this->input->post("uraian_$nomorsoalb");
				$nomorb++;
			}
			while ($nomorb<$jmlsoalb);
		}
		$this->Guru_model->Update_Analisis($in);
		if ($entry == 'jawaban siswa')
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/analisisjawabansiswa/$id_mapel/$ulangan'>";
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/analisis/$id_mapel/$ulangan'>";
		}
	}
	function nilaipsikomotor($id_mapel=null,$itemnilai=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Psikomotor / Keterampilan';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;	
				$pilihan = $dtmapel->pilihan;			
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['itemnilai']=$itemnilai;
			$data['pilihan'] = $pilihan;
			if($pilihan == 1)
			{
				$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Pilihan($kelas,$mapel,$semester,$thnajaran);
			}
			else
			{
				$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			}

			$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/nilai_psikomotor',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function updatenilaipsikomotor($id_mapel=null)
	{
		$in=array();
		$data['nim']=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			$cacah_siswa = $this->input->post('cacah_siswa');
			$cacahitem = $this->input->post('cacahitem');
			$itemnilai = $this->input->post('itemnilai');
			$jujug = $this->config->item('jujug');
			$data['jujug'] = $jujug;
			for($i=1;$i<=$cacah_siswa;$i++)
			{
				$in["kd"]=$this->input->post("kd_$i");
				$in["p1"]=$this->input->post("p1_$i");
				$in["p2"]=$this->input->post("p2_$i");
				$in["p3"]=$this->input->post("p3_$i");
				$in["p4"]=$this->input->post("p4_$i");
				$in["p5"]=$this->input->post("p5_$i");
				$in["p6"]=$this->input->post("p6_$i");
				$in["p7"]=$this->input->post("p7_$i");
				$in["p8"]=$this->input->post("p8_$i");
				$in["p9"]=$this->input->post("p9_$i");
				$in["p10"]=$this->input->post("p10_$i");
				$in["p11"]=$this->input->post("p11_$i");
				$in["p12"]=$this->input->post("p12_$i");
				$in["p13"]=$this->input->post("p13_$i");
				$in["p14"]=$this->input->post("p14_$i");
				$in["p15"]=$this->input->post("p15_$i");
				$in["p16"]=$this->input->post("p16_$i");
				$in["p17"]=$this->input->post("p17_$i");
				$in["p18"]=$this->input->post("p18_$i");
				$nilai = ($in["p1"]+$in["p2"]+$in["p3"]+$in["p4"]+$in["p5"]+$in["p6"]+$in["p7"]+$in["p8"]+$in["p9"]+$in["p10"]+$in["p11"]+$in["p12"]+$in["p13"]+$in["p14"]+$in["p15"]+$in["p16"]+$in["p17"]+$in["p18"])/$cacahitem;
				$nis = $this->input->post("nis_$i");
				if($jujug == 'Y')
				{
					$nilaiakhir = $this->input->post("p19_$i");
				}
				else
				{
					$nilaiakhir = $nilai;
				}
				$in['psi'] = $nilaiakhir;
				$this->Guru_model->Update_Nilai($in);
			}
			if (empty($cacah_siswa))
			{
				$data['judulhalaman'] = 'Galat memperbarui nilai psikomotor / keterampilan';
				$datay['pesan'] = 'Galat memperbarui nilai psikomotor / keterampilan. Cacah siswa kosong';
				$datay['tautan_balik'] = ''.base_url().'guru/nilaipsikomotor/'.$id_mapel.'/'.$itemnilai;
				$datay['modul'] = 'Menyimpan Nilai Psikomotor / Keterampilan';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);
			}
			elseif($itemnilai == 19)
			{
				redirect('guru/deskripsiketerampilan/'.$id_mapel);
			}
			else
			{
				redirect(base_url().'guru/daftarnilaipsikomotor/'.$id_mapel);
			}
		}
		else
		{
			redirect('guru');
		}
	}
	function imporpsikomotor($id=null,$itemnilai=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= "Unggah Nilai Psikomotor";
		$data["id_mapel"]=$id;
		$data["itemnilai"]=$itemnilai;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/form_impor_nilai_psikomotor',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function prosesunggahnilaipsikomotor($id_mapel=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$pbk["thnajaran"]=$this->input->post('thnajaran');
		$pbk["semester"]=$this->input->post('semester');
		$pbk["mapel"]=$this->input->post('mapel');
		$pbk["itemnilai"]=$this->input->post('itemnilai');
		$this->load->model('Guru_model');
		$this->load->library('csvimport');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvimport->get_array($filePath);	
		$n=0;
		if($this->input->post('itemnilai') == 'semua')
		{
			foreach($csvData as $field):
			$pbk['nis'] = $field["nis"];
			$pbk['nis'] = $field["nis"];
			$pbk['p1'] = $field["p1"];
			$pbk['p2'] = $field["p2"];
			$pbk['p3'] = $field["p3"];
			$pbk['p4'] = $field["p4"];
			$pbk['p5'] = $field["p5"];
			$pbk['p6'] = $field["p6"];
			$pbk['p7'] = $field["p7"];
			$pbk['p8'] = $field["p8"];
			$pbk['p9'] = $field["p9"];
			$pbk['p10'] = $field["p10"];
			$this->Guru_model->Ubah_Nilai_Psikomotor($pbk);
			$n++;
			endforeach;
		}
		else
		{
			foreach($csvData as $field):
			$pbk['nis'] = $field["nis"];
			$pbk['nilai'] = $field["nilai"];
			$this->Guru_model->Ubah_Nilai_Psikomotor($pbk);
			$n++;
			endforeach;
		}
		redirect('guru/daftarnilaipsikomotor/'.$id_mapel);
	}
	function imporremidial()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$itemnilai='';
			$id='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id='';
			}
			else
			{
	    			$id = $this->uri->segment(3);
			}
			if ($this->uri->segment(4) === FALSE)
			{
	    			$itemnilai='';
			}
			else
			{
	    			$itemnilai = $this->uri->segment(4);
			}
			$data["id_mapel"]=$id;
			$data["itemnilai"]=$itemnilai;
			$this->load->model('Guru_model');
			$kodeguru = $data["nim"];	
			$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
			$data['id_mapel']=$id;
			$ada = $tmapel->num_rows();
			if ($ada>0)
			{
			foreach($tmapel->result() as $dtmapel)
				{
						$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$kkm = $dtmapel->kkm;
					$semester = $dtmapel->semester;
					$ulangane = 'kkm_'.$itemnilai;
					$kkm_ulangan = $dtmapel->$ulangane;
					$kkm = $dtmapel->kkm;
				}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$data['kkm']=$kkm;
			$data['kkm_ulangan']=$kkm_ulangan;
			if ($kkm_ulangan == 0)
				{$data['kkm_ulangan'] = $kkm;}
			}
				$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/form_impor_nilai_remidial',$data);
			$this->load->view('shared/bawah');
	}
	function prosesunggahnilairemidial()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$pbk["thnajaran"]=$this->input->post('thnajaran');
			$pbk["semester"]=$this->input->post('semester');
			$pbk["mapel"]=$this->input->post('mapel');
			$pbk["kelas"]=$this->input->post('kelas');
			$kkm_ulangan=$this->input->post('kkm_ulangan');
			$id_mapel=$this->input->post('id_mapel');
			$pbk["itemnilai"]=$this->input->post('itemnilai');
			$this->load->model('Guru_model');
			$this->load->library('csvimport');
			$filePath = $_FILES["csvfile"]["tmp_name"];
			$csvData = $this->csvimport->get_array($filePath);	
			$n=0;
			foreach($csvData as $field):
			$pbk['nis'] = $field["nis"];
			$nilai = $field["nilai"];
			if ($nilai > $kkm_ulangan)
				{$nilai = $kkm_ulangan;}
			$pbk['nilai'] = $nilai;
			$nilaiaslik = $this->Guru_model->Nilai_Asli($pbk["thnajaran"],$pbk["semester"],$pbk["mapel"],$pbk["nis"],$pbk["itemnilai"]);
			//sudah kkm?
			if ($nilaiaslik<$kkm_ulangan)
			{
				if ($nilaiaslik<$pbk['nilai'])
					{
					$this->Guru_model->Ubah_Nilai($pbk);
					}
			}			$n++;
			endforeach;
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilai/".$id_mapel."'>";
	}
	function afektif()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Afektif';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=12;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];
		$query=$this->Guru_model->Tampil_Semua_Mapel_Afektif_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Semua_Mapel_Afektif_Guru($kodeguru);
      		$config['base_url'] = base_url() . 'guru/afektif';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/afektif',$data_isi);
		$this->load->view('shared/bawah');
	}
	function aspekafektif($id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Kriteria Penilaian Sikap';
		$this->load->model('Guru_model');
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$data["nim"]);
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			$kodeguru = $data["nim"];	
			$data['tmapel'] = $tmapel;
			$data['id_mapel']=$id_mapel;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/aspek_afektif',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function updateaspekafektif($id_mapel=null)
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$nim);
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			$np=0;				
			$in["s1"]=$this->input->post('p1');
			$in["s2"]=$this->input->post('p2');
			$in["s3"]=$this->input->post('p3');
			$in["s4"]=$this->input->post('p4');
			$in["s5"]=$this->input->post('p5');
			$in["s6"]=$this->input->post('p6');
			$in["s7"]=$this->input->post('p7');
			$in["s8"]=$this->input->post('p8');
			$in["s9"]=$this->input->post('p9');
			$in["s10"]=$this->input->post('p10');
			$in["s11"]=$this->input->post('p11');
			$in["s12"]=$this->input->post('p12');
			$in["s13"]=$this->input->post('p13');
			$in["s14"]=$this->input->post('p14');
			$in["s15"]=$this->input->post('p15');
			if (!empty($in["s1"]))
			{$np=$np+1;}
			if (!empty($in["s2"]))
			{$np=$np+1;}
			if (!empty($in["s3"]))
			{$np=$np+1;}
			if (!empty($in["s4"]))
			{$np=$np+1;}
			if (!empty($in["s5"]))
			{$np=$np+1;}
			if (!empty($in["s6"]))
			{$np=$np+1;}
			if (!empty($in["s7"]))
			{$np=$np+1;}
			if (!empty($in["s8"]))
			{$np=$np+1;}
			if (!empty($in["s9"]))
			{$np=$np+1;}
			if (!empty($in["s10"]))
			{$np=$np+1;}
			if (!empty($in["s11"]))
			{$np=$np+1;}
			if (!empty($in["s12"]))
			{$np=$np+1;}
			if (!empty($in["s13"]))
			{$np=$np+1;}
			if (!empty($in["s14"]))
			{$np=$np+1;}
			if (!empty($in["s15"]))
			{$np=$np+1;}
			$in["ns"] = $np;
			$in["id_mapel"] = $id_mapel;
			$in = hilangkanpetik($in);
			$this->Guru_model->Update_KKM($in);
			redirect('guru/daftarnilaiafektif/'.$id_mapel);
		}
		else
		{
			redirect('guru');
		}
	}
	function daftarnilaiafektif($id_mapel=null,$statuscetak=null,$id_afektif=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Nilai Afektif';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$pilihan = $dtmapel->pilihan;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id_mapel;
			$data['pilihan'] = $pilihan;
			$this->load->model('Nilai_model');
			$data["tkepala"] = $this->Nilai_model->Kepala($thnajaran,$semester);
			$data['ada']=$ada;
			$data['kurikulum']=cari_kurikulum($thnajaran,$semester,$kelas);
			$data['statuscetak'] = $statuscetak;
			if ($statuscetak=='cetak')
			{
				$this->load->view('guru/cetak_daftar_nilai_afektif',$data);
				}
			elseif ($statuscetak=='persiswa')
				{
				$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/daftar_nilai_afektif_persiswa',$data);
				$this->load->view('shared/bawah');
				}
				else
				{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_nilai_afektif',$data);
				$this->load->view('shared/bawah');
				}
		}
		else
		{
			redirect('guru');
		}
	}
	function nilaiafektif($id=null,$itemnilai=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Afektif / Sikap';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['kurikulum']=cari_kurikulum($thnajaran,$semester,$kelas);
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Afektif($kelas,$mapel,$semester,$thnajaran);
		$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_afektif',$data);
		$this->load->view('shared/bawah');
		}
		else
		{
			echo 'galat';
		}
	}
	function updatenilaiafektif()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$cacah_siswa = $this->input->post('cacah_siswa');
				$thnajaran = $this->input->post('thnajaran');
				$semester = $this->input->post('semester');
				$mapel = $this->input->post('mapel');
				$cacahitem = $this->input->post('cacahitem');
				$id_mapel = $this->input->post('id_mapel');
				$namat = $this->input->post('namat');
				$nbaik = $this->input->post('nbaik');
				$nmax = $this->input->post('nmax');
				for($i=1;$i<=$cacah_siswa;$i++)
					{
					$in["id_afektif"]=$this->input->post("id_afektif_$i");
					$in["p1"]=$this->input->post("p1_$i");
					$in["p2"]=$this->input->post("p2_$i");
					$in["p3"]=$this->input->post("p3_$i");
					$in["p4"]=$this->input->post("p4_$i");
					$in["p5"]=$this->input->post("p5_$i");
					$in["p6"]=$this->input->post("p6_$i");
					$in["p7"]=$this->input->post("p7_$i");
					$in["p8"]=$this->input->post("p8_$i");
					$in["p9"]=$this->input->post("p9_$i");
					$in["p10"]=$this->input->post("p10_$i");
					$in["p11"]=$this->input->post("p11_$i");
					$in["p12"]=$this->input->post("p12_$i");
					$in["p13"]=$this->input->post("p13_$i");
					$in["p14"]=$this->input->post("p14_$i");
					$in["p15"]=$this->input->post("p15_$i");
					$nis = $this->input->post("nis_$i");
					$this->load->model('Guru_model');
					$this->Guru_model->Update_Nilai_Afektif($in);
				}
				redirect('guru/daftarnilaiafektif/'.$id_mapel);
	}
	function unduhstatussiswa()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$mapel = $this->input->post('mapel');
		$itemnilai = $this->input->post('itemnilai');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$daftar_mapel = $this->Guru_model->Tampil_Mapel_Guru_Thnajaran_Semester($kodeguru,$thnajaran,$semester);
        	$data_isi = array('mapel'=>$mapel,'daftar_mapel'=>$daftar_mapel,'thnajaran' => $thnajaran,'semester'=>$semester, 'mapel'=>$mapel, 'itemnilai'=>$itemnilai,'kodeguru'=>$kodeguru);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/unduh_status_siswa',$data_isi);
		$this->load->view('shared/bawah');
	}
	function kpppp()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$data["usernamepegawai"] = $data["nim"];
			$data["thnajaran"] = cari_thnajaran();
			$data["semester"] = cari_semester();
			$this->load->view('guru/mencetak_kp4',$data);
	}
	function daftarnilaiakhlak($id=null,$kirim=null)
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Daftar Nilai Akhlak Mulia dan Kepribadian';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$kurikulum ='';
		$data['kirim']= $kirim;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_M_Akhlak($id,$kodeguru);
		$data['id_mapel']=$id;
		$data["kodeguru"] = $kodeguru;
		$data['id_m_akhlak']=$id;
		$data['itemnilai']=$itemnilai;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			
			foreach($tmapel->result() as $dtmapel)
			{
				$data['kelas'] = $dtmapel->kelas;
				$data['thnajaran'] = $dtmapel->thnajaran;
				$data['semester'] = $dtmapel->semester;
			}
			$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Akhlak($data['kelas'],$kodeguru,$data['semester'],$data['thnajaran']);
			$data['ada']=$ada;
			$data['kurikulum']=cari_kurikulum($data['thnajaran'],$data['semester'],$data['kelas']);
			if($data['kirim'] == 'kirimulang')
			{
				$this->load->model('Admin_model');
				$ta = $this->Admin_model->Cek_Walikelas($data['thnajaran'],$data['semester'],$data['kelas']);
				foreach($ta->result() as $a)
				{
					$kodewali = $a->kodeguru;
				}
				$ponselwali = cari_seluler_pegawai($kodewali);
				$chat_id = cari_chat_id_pegawai($kodewali);
				$inpes["DestinationNumber"]=$ponselwali;
				$pesan = cari_nama_pegawai($kodeguru).' mengirim ulang penilaian akhlak mulia / sikap spiritual dan sosial kelas '.$data['kelas'];
				$inpes["TextDecoded"] = $pesan;
				$inpes["id_sms_user"] = $this->config->item('id_sms_user');
				if(!empty($chat_id))
				{
					$this->load->helper('telegram');
					$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
				}
				elseif (!empty($ponselwali))
				{
					$this->Guru_model->Kirim_Pesan($inpes);
				}
				else
				{}

			}
			$data['adainfo'] = '';	
			if($data['kurikulum'] == '2015')
			{
				$data['judulhalaman'] = 'Penilaian Sikap Spiritual dan Sosial';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_nilai_akhlak_2015',$data);
			}
			else
			{
				$data['judulhalaman'] = 'Daftar Nilai Akhlak Mulia dan Kepribadian';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_nilai_akhlak',$data);
			}

		$this->load->view('shared/bawah');
		}
		else
			{
			redirect('guru/nilaiakhlak');
			}
	}
	function perbaruidaftarsiswaakhlak()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$kodewali =$this->input->post('kodewali');
		$thnajaran=$this->input->post('thnajaran');
		$kelas=$this->input->post('kelas');
		$id_mapel=$this->input->post('id_mapel');
		$semester=$this->input->post('semester');
		$cacahitem = $this->input->post('cacahitem');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		if($kodewali == '00')
		{
			$kodeguru = '00';
		}
		foreach($daftar_siswa->result() as $dsiswa)
		{
			$nis = $dsiswa->nis;
			$no_urut = $dsiswa->no_urut;
			$status=$dsiswa->status;
			$ada = $this->Guru_model->Cek_Nilai_Akhlak($thnajaran,$semester,$kodeguru,$nis);
			$ada = $ada->num_rows();
			$pbk['thnajaran'] = $thnajaran;
			$pbk['semester'] = $semester;
			$pbk['kelas'] = $kelas;
			$pbk['nis'] = $nis;
			$pbk['kodeguru'] = $kodeguru;
			$pbk['no_urut'] = $no_urut;
			$pbk['status'] = $status;
			$this->Guru_model->Add_Nilai_Akhlak($pbk,$ada,$cacahitem);
			$ada2 = $this->Guru_model->Cek_Nilai_Akhlak_Rekap($thnajaran,$semester,$nis);
			$ada2 = $ada2->num_rows();
			$this->Guru_model->Add_Nilai_Akhlak_Rekap($pbk,$ada2);
			
		}
		if($kodeguru == '00')
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarsiswa/$id_mapel/spiritual'>";
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilaiakhlak/$id_mapel'>";
		}
	}
	function ubahnilaiakhlak()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah Nilai';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		if ($this->uri->segment(4) === FALSE)
		{
    			$itemnilai='';
		}
		else
		{
    			$itemnilai = $this->uri->segment(4);
		}
			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_M_Akhlak($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;				
			}
		}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['kodeguru']=$kodeguru;
		$data['query']=$this->Guru_model->Tampil_Satu_Nilai_Akhlak_Siswa($itemnilai,$kodeguru);
		$kurikulum=cari_kurikulum($thnajaran,$semester,$kelas);
		$this->load->view('guru/bg_atas',$data);
		if($kurikulum == '2015')
		{
			$this->load->view('guru/nilai_akhlak_edit_2015',$data);
		}
		elseif($kurikulum == '2018')
		{
			$this->load->view('guru/nilai_akhlak_edit_2015',$data);
		}
		else

		{
			$this->load->view('guru/nilai_akhlak_edit',$data);
		}

		$this->load->view('shared/bawah');
	}
	function simpannilaiakhlak()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$id_mapel = $this->input->post('id_mapel');
				$kodeguru = $this->input->post('kodeguru');
				$in["id_nilai_akhlak"] = $this->input->post('id_nilai_akhlak');
				$in["satu"] = $this->input->post('satu');
				$in["dua"] = $this->input->post('dua');
				$in["tiga"] = $this->input->post('tiga');
				$in["empat"] = $this->input->post('empat');
				$in["lima"] = $this->input->post('lima');
				$in["enam"] = $this->input->post('enam');
				$in["tujuh"] = $this->input->post('tujuh');
				$in["delapan"] = $this->input->post('delapan');
				$in["sembilan"] = $this->input->post('sembilan');
				$in["sepuluh"] = $this->input->post('sepuluh');
				$in["i11"] = $this->input->post('i11');
				$in["i12"] = $this->input->post('i12');
				$in["i13"] = $this->input->post('i13');
				$in["i14"] = $this->input->post('i14');
				$in["i15"] = $this->input->post('i15');
				$in["kom1"] = $this->input->post('kom1');
				$in["kom2"] = $this->input->post('kom2');
				$in["kom3"] = $this->input->post('kom3');
				$in["kom4"] = $this->input->post('kom4');
				$in["kom5"] = $this->input->post('kom5');
				$in["kom6"] = $this->input->post('kom6');
				$in["kom7"] = $this->input->post('kom7');
				$in["kom8"] = $this->input->post('kom8');
				$in["kom9"] = $this->input->post('kom9');
				$in["kom10"] = $this->input->post('kom10');
				$this->load->model('Guru_model');
				$this->Guru_model->Simpan_Nilai_Akhlak($in);
				if($kodeguru == '00')
				{
					$in2["thnajaran"] = $this->input->post('thnajaran');
					$in2["semester"] = $this->input->post('semester');
					$in2["nis"] = $this->input->post('nis');
					$in2["i1"] = $this->input->post('satu');
					$in2["i2"] = $this->input->post('dua');
					$in2["i3"] = $this->input->post('tiga');
					$in2["i4"] = $this->input->post('empat');
					$in2["i5"] = $this->input->post('lima');
					$in2["i6"] = $this->input->post('enam');
					$in2["i7"] = $this->input->post('tujuh');
					$in2["i8"] = $this->input->post('delapan');
					$in2["i9"] = $this->input->post('sembilan');
					$in2["i10"] = $this->input->post('sepuluh');
					$in2["i11"] = $this->input->post('i11');
					$in2["i12"] = $this->input->post('i12');
					$in2["i13"] = $this->input->post('i13');
					$in2["i14"] = $this->input->post('i14');
					$in2["i15"] = $this->input->post('i15');
					$this->Guru_model->Update_Nilai_Akhlak_dari_Walikelas($in2);
					redirect('guru/daftarsiswa/'.$id_mapel.'/spiritual');
				}
				else
				{
					redirect('guru/daftarnilaiakhlak/'.$id_mapel);
				}

	}
	function daftarnilaiekstra()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		if ($this->uri->segment(4) === FALSE)
		{
    			$statuscetak='';
		}
		else
		{
    			$statuscetak= $this->uri->segment(4);
		}
		$this->load->model('Admin_model');
		$data['daftar_kelas']= $this->Admin_model->Tampil_Semua_Kelas();
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Ekstra($id,$kodeguru);
		$data['id_mapel']=$id;
		$data["kodeguru"] = $kodeguru;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$namaekstra = $dtmapel->namaekstra;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
			}
		$data['kelas']=$kelas;
		$data['kelase'] = $this->input->post('kelase');
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$namaekstra;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Ekstra($kelas,$namaekstra,$semester,$thnajaran);
		}
		$data['ada']=$ada;
		if ($statuscetak=='cetak')
			{
				$this->load->view('guru/cetak_daftar_nilai_ekstra',$data);
			}
				else
				{
				$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/daftar_nilai_ekstra',$data);
				$this->load->view('shared/bawah');
				}
	}
	function cetakdaftarnilaiekstra()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Daftar Nilai Ekstrakurikuler';
		$id = $this->uri->segment(3);
		if ($this->uri->segment(4) === FALSE)
		{
    			$id_kelas='';
		}
		else
		{
    			$id_kelas = $this->uri->segment(4);
		}		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Ekstra($id,$kodeguru);
		$data["kodeguru"] = $kodeguru;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$namaekstra = $dtmapel->namaekstra;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
			}
		$data['kelas']=$kelas;
		$data['id_kelas']=$id_kelas;
		$data['kelase'] = $this->input->post('kelase');
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$namaekstra;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Ekstra($kelas,$namaekstra,$semester,$thnajaran);
		$this->load->view('guru/cetak_daftar_nilai_ekstra',$data);
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/ekstrakurikuler'>";
		}
	}
	function nilaiekstrakurikuler()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Nilai Ekstrakurikuler';
		$id_pengampu_ekstra = $this->uri->segment(3);
    		$itemnilai = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Ekstra($id_pengampu_ekstra,$kodeguru);
		$data['id_mapel']=$id_pengampu_ekstra;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->namaekstra;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;				
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['itemnilai']=$itemnilai;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai_Ekstra($kelas,$mapel,$semester,$thnajaran);
		$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_ekstrakurikuler',$data);
		$this->load->view('shared/bawah');
	}
	function updatenilaiekstrakurikuler()
	{
		$in=array();
		$cacah_siswa = $this->input->post('cacah_siswa');
		$id_mapel = $this->input->post('id_mapel');
		$thn1 = $this->input->post('thn1');
		$semester = $this->input->post('semester');
		$cacah_ulangan_harian = $this->input->post('cacah_ulangan_harian');
		for($i=1;$i<=$cacah_siswa;$i++)
		{
			$in["id_siswa_ekstra"]=$this->input->post("kd_$i");
			$in["nilai"]=strtoupper($this->input->post("nilai_$i"));
			$in["keterangan"]=$this->input->post("keterangan_$i");
			$in["status"]='Y';								
			$this->load->model('Guru_model');
			$this->Guru_model->Update_Nilai_Ekstra($in);
		}
		redirect('guru/ekstrakurikuler/'.$thn1.'/'.$semester.'/'.$id_mapel);
	}
	function awalrph()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
//				$this->load->model('Guru_model');
//				$this->load->helper('datecalc_class');
			$in=array();
	/*
			$data["thnajaran"] = cari_thnajaran();
			$data["semester"] = cari_semester();
			$thnajaran = cari_thnajaran();
			$semester = cari_semester();
			$data['id_mapel']=$this->input->post('id_mapel');
			$kodeguru = $data["nim"];	
			$data["kodeguru"]=$kodeguru;
			$tanggalhadir =$this->input->post('tanggalhadir');
			$bulanhadir =$this->input->post('bulanhadir');
			$tahunhadir =$this->input->post('tahunhadir');
			$tanggalrph = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$akhirsemester = tanggalcetak($thnajaran,$semester);
			$batas = new T10DateCalc($akhirsemester);
			if ((!empty($thnajaran)) and(!empty($semester)) and (!empty($data['id_mapel'])) and (!empty($tanggalrph))) 
				{
				$mapel = id_mapel_jadi_mapel($data['id_mapel']);
				$kelas = id_mapel_jadi_kelas($data['id_mapel']);				$in['thnajaran']=$thnajaran;
				$in['semester']=$semester;
				$in['kodeguru']=$kodeguru;
				$in['tanggal']=$tanggalrph;
				$in['tanggal_bph']=$tanggalrph;
				$in['mapel'] = $mapel;
				$in['kelas'] = $kelas;
				$in['jamke']=$this->input->post('jamke');
				$jamke = $this->input->post('jamke');
				$sudahada = $this->Guru_model->Cek_Rph($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke);
				if ($sudahada==0)
					{
					$this->Guru_model->Tambah_Rph($in);
					}
				if ($sudahada==1);
					{
					$this->Guru_model->Update_Rph_Awal($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke);
					}
				$now = new T10DateCalc($tanggalrph);
				do
					{					$mdep = $now->nextWeek($tanggalrph);
					$selisih = $batas->compareDate($mdep);
					$in['tanggal']=$mdep;
					$in['tanggal_bph']=$mdep;
					$sudahada = $this->Guru_model->Cek_Rph($thnajaran,$semester,$mapel,$kelas,$mdep,$kodeguru,$jamke);
					if (($sudahada==0) and ($selisih<0))
						{
						$this->Guru_model->Tambah_Rph($in);
						}
					if ($sudahada>0)
						{
						$this->Guru_model->Update_Rph_Awal($thnajaran,$semester,$mapel,$kelas,$mdep,$kodeguru,$jamke);
						}
					$now = new T10DateCalc($mdep);
					}
				
				while ($selisih < 0);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rph'>";
				} // akhir menyimpan
				else
				{
*/
				$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/awal_rph',$data);
				$this->load->view('shared/bawah');
	}
	function unggahnilai()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]='Unggah Nilai';
			$itemnilai='';
			$id='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id='';
			}
			else
			{
	    			$id = $this->uri->segment(3);
			}
			if ($this->uri->segment(4) === FALSE)
			{
	    			$itemnilai='';
			}
			else
			{
	    			$itemnilai = $this->uri->segment(4);
			}
			if((empty($id)) and (empty($itemnilai)))
			{
				redirect('guru');
			}
			$data["id_mapel"]=$id;
			$data["itemnilai"]=$itemnilai;
			$data['sumber'] = $this->uri->segment(5);
			$this->load->model('Guru_model');
			$kodeguru = $data["nim"];	
			$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
			$data['id_mapel']=$id;
			$ada = $tmapel->num_rows();
			if ($ada>0)
			{
			foreach($tmapel->result() as $dtmapel)
				{
						$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$kkm = $dtmapel->kkm;
					$semester = $dtmapel->semester;
					$ulangane = 'kkm_'.$itemnilai;
					if (($ulangane == 'kkm_nr') or (substr($ulangane,0,6) == 'kkm_tu'))
						{$kkm_ulangan = $dtmapel->kkm;}
						else
						{
						$kkm_ulangan = $dtmapel->$ulangane;
						}
					$kkm = $dtmapel->kkm;
				}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$data['kkm']=$kkm;
			$data['kkm_ulangan']=$kkm_ulangan;
			if ($kkm_ulangan == 0)
				{$data['kkm_ulangan'] = $kkm;}
			}
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/form_impor_nilai',$data);
			$this->load->view('shared/bawah');
	}
	function prosesunggahnilai()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$pbk["thnajaran"]=$this->input->post('thnajaran');
		$pbk["semester"]=$this->input->post('semester');
		$pbk["mapel"]=$this->input->post('mapel');
		$pbk["kelas"]=$this->input->post('kelas');
		$kkm_ulangan=$this->input->post('kkm_ulangan');
		$id_mapel=$this->input->post('id_mapel');
		$pbk["itemnilai"]=$this->input->post('itemnilai');
		$itemnilai=$this->input->post('itemnilai');
		$sumber=$this->input->post('sumber');
		$this->load->model('Guru_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;
		$filename = berkas($this->input->post('thnajaran')).'_'.berkas($this->input->post('semester')).'_'.berkas($this->input->post('mapel')).'_'.berkas($this->input->post('kelas')).'_'.berkas($this->input->post('itemnilai')).'.csv';	
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$datay['modul'] = 'Unggah Nilai';
		$datay['tautan_balik'] = ''.base_url().'guru/unggahnilai/'.$id_mapel.'/'.$itemnilai;
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
				$data['judulhalaman'] =' Galat, unggah berkas';
				$datay['pesan'] = $this->upload->display_errors();
				$datay['tautan_balik'] = ''.base_url().'guru/unggahnilai/'.$id_mapel.'/'.$itemnilai.'/'.$sumber;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);

			}
			else 
			{
				$filePath = 'uploads/'.$filename;
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if($sumber == 'pemindai')
					{
						if(isset($field['Nomor_Peserta']))
						{
							$nopes = nopetik($field['Nomor_Peserta']);
							$nis = $this->Guru_model->Nopes_NIS($nopes);
							$pbk['nis'] = $nis;
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' Nomor Peserta';
							$pbk['nis'] = '';
						}
						if(isset($field['Score']))
						{
							$pbk['nilai'] = nopetik($field['Score']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' Score';
							$pbk['nilai'] = '';
						}
					}
					else
					{
						if(isset($field['nis']))
						{
							$pbk['nis'] = nopetik($field['nis']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' nis';
							$pbk['nis'] = '';
						}
						if(isset($field['nilai']))
						{
							$pbk['nilai'] = nopetik($field['nilai']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' nilai';
							$pbk['nilai'] = '';
						}
					}
					if ($adagalat==0)
					{
						$this->Guru_model->Ubah_Nilai($pbk);
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink($filePath);
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$data['judulhalaman'] =' Galat, unggah berkas';
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilai/".$id_mapel."'>";
				}
			}
		}
		else
		{
			redirect('guru');
		}
	}//akhir fungsi proses impor nilai
	function unggahnilaiafektif()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$itemnilai='';
			$id='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id='';
			}
			else
			{
	    			$id = $this->uri->segment(3);
			}
			$data["id_mapel"]=$id;
			$this->load->model('Guru_model');
			$kodeguru = $data["nim"];	
			$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
			$data['id_mapel']=$id;
			$ada = $tmapel->num_rows();
			if ($ada>0)
			{
			foreach($tmapel->result() as $dtmapel)
				{
					$kelas = $dtmapel->kelas;
					$mapel = $dtmapel->mapel;
					$thnajaran = $dtmapel->thnajaran;
					$semester = $dtmapel->semester;
				}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			}
				$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/form_impor_nilai_afektif',$data);
			$this->load->view('shared/bawah');
	}
	function prosesunggahnilaiafektif()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$pbk["thnajaran"]=$this->input->post('thnajaran');
			$pbk["semester"]=$this->input->post('semester');
			$pbk["mapel"]=$this->input->post('mapel');
			$pbk["kelas"]=$this->input->post('kelas');
			$id_mapel=$this->input->post('id_mapel');
			$namat = $this->input->post('namat');
			$nbaik = $this->input->post('nbaik');
			$cacahitem = $this->input->post('cacahitem');
			$this->load->model('Guru_model');
			$this->load->library('csvimport');
			$filePath = $_FILES["csvfile"]["tmp_name"];
			$csvData = $this->csvimport->get_array($filePath);	
			$n=0;
			foreach($csvData as $field):
				$pbk['nis'] = $field["nis"];
				$pbk['p1'] = $field["p1"];
				$pbk['p2'] = $field["p2"];
				$pbk['p3'] = $field["p3"];
				$pbk['p4'] = $field["p4"];
				$pbk['p5'] = $field["p5"];
				$pbk['p6'] = $field["p6"];
				$pbk['p7'] = $field["p7"];
				$pbk['p8'] = $field["p8"];
				$pbk['p9'] = $field["p9"];
				$pbk['p10'] = $field["p10"];
				$pbk['p11'] = $field["p11"];
				$pbk['p12'] = $field["p12"];
				$pbk['p13'] = $field["p13"];
				$pbk['p14'] = $field["p14"];
				$pbk['p15'] = $field["p15"];
				$nilai = ($field["p1"]+$field["p2"]+$field["p3"]+$field["p4"]+$field["p5"]+$field["p6"]+$field["p7"]+$field["p8"]+$field["p9"]+$field["p10"]+$field["p11"]+$field["p12"]+$field["p13"]+$field["p14"]+$field["p15"])/$cacahitem;				$predikat = '?';
				if ($nilai >= $namat )
					{$predikat = 'A';}
				if ($nilai < $namat )
					{$predikat = 'B';}
				if ($nilai < $nbaik )
					{$predikat = 'C';}
				$nis = $field["nis"];
				$this->Guru_model->Update_Nilai_Afektif_Impor($pbk);
				$this->Guru_model->Update_Nilai_Afektif_Rapor($pbk["thnajaran"],$pbk["semester"],$pbk["mapel"],$nis,$predikat);
				$n++;
			endforeach;
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilaiafektif/".$id_mapel."'>";
	}//akhir fungsi proses impor nilai afektif
	function rphlain()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['id_hari_tatap_muka']=$this->input->post('id_hari_tatap_muka');
		$data['ditandatangani']=$this->input->post('ditandatangani');
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$data['tanggalrph'] = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');	
		if ($diproses == 'oke')
			{
			$data['tanggalrphe'] = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bph_lain_edit',$data);
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rph_lain',$data);
			}
			$this->load->view('shared/bawah');
	}
	function tambahrphlain()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$this->load->model('Guru_model');
			$in=array();
			$thnajaran=$this->input->post('thnajaran');
			$semester=$this->input->post('semester');
			$id_mapel=$this->input->post('id_mapel');
			$kodeguru=$this->input->post('kodeguru');
			$id_rph = $this->input->post('id_rph');
			$tanggalrph = $this->input->post('tanggalrph');
			$tanggalhadir2 =$this->input->post('tanggalhadir2');
			$bulanhadir2 =$this->input->post('bulanhadir2');
			$tahunhadir2 =$this->input->post('tahunhadir2');
			$jamke =$this->input->post('jam_ke');
			$tanggalbph = "$tahunhadir2-$bulanhadir2-$tanggalhadir2";
			$lab = $this->input->post('lab');
			$alat_dan_bahan = $this->input->post('alat_dan_bahan');
			if ((!empty($thnajaran)) and(!empty($semester)) and (!empty($id_mapel)) and (!empty($tanggalrph))) 
				{
				$sk = $this->input->post('sk');
				$kd = $this->input->post('kd');
				$mapel = id_mapel_jadi_mapel($id_mapel);
				$kelas = id_mapel_jadi_kelas($id_mapel);
				$sudahada = $this->Guru_model->Cek_Rph($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke);
				$in['thnajaran']=$this->input->post('thnajaran');
				$in['semester']=$this->input->post('semester');
				$in['kodeguru']=$this->input->post('kodeguru');
				$in['rencana']=$this->input->post('rencana');
				$in['materi']=$this->input->post('materi');
				$in['materi_selanjutnya']=$this->input->post('materi_selanjutnya');
				$in['hambatan_siswa']=$this->input->post('hambatan_siswa');
				$in['keterangan']=$this->input->post('keterangan');
				$in['tanggal']=$tanggalrph;
				$in['tanggal_bph']=$tanggalbph;
				$in['mapel'] = $mapel;
				$in['kelas'] = $kelas;
				$in['jamke'] =$this->input->post('jam_ke');
				$in['sk'] = $sk;
				$in['kd'] = $kd;
				$in['lab'] = $lab;
				$in['alat_dan_bahan'] = $alat_dan_bahan;
				if ($sudahada==0)
					{
					$in = hilangkanpetik($in);
					$this->Guru_model->Tambah_Rph($in);
					}
					else
					{
					$in['id_rph']=$id_rph;
					$in = hilangkanpetik($in);
					$this->Guru_model->Update_Rph($in);
					}
						$this->load->view('guru/bg_atas',$data);
					$datax['thnajaran'] = $thnajaran;
				$datax['semester'] = $semester;
				$datax['kelas'] = $kelas;
				$datax['kodeguru'] = $kodeguru;
				$datax['mapel'] = $mapel;
				$datax['tanggalrph'] = $tanggalrph;
				$this->load->view('guru/rph_lihat',$datax);
				$this->load->view('shared/bawah');
				}
				else
				{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/rph_lain',$data);
				$this->load->view('shared/bawah');
				}
	}
	function rphtanggal()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$data['tanggalrph'] = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');
			if ($diproses == 'oke')
			{
			$data['tanggalrphe'] = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rph_tanggal_tampil',$data);
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rph_tanggal',$data);
			}
			$this->load->view('shared/bawah');
	}
	function daftarnilaiujian($id=null,$cacah=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Ujian Sekolah';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$data["kodeguru"] = $kodeguru;
		$ada = $tmapel->num_rows();
		if(is_numeric($cacah))
		{
			if($cacah < 1)
			{
				$cacah = 1;
			}
		}
		else
		{
			$cacah = 1;
		}
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$ranah = $dtmapel->ranah;
				$kkm = $dtmapel->kkm;
			}
		$data['ranah']=$ranah;
		$thnajaran = $dtmapel->thnajaran;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['kkm'] = $kkm;
		$data['cacah'] = $cacah;
		$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
		}
		$data['ada']=$ada;
		if (empty($ranah))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			else
			{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/daftar_nilai_ujian',$data);
				$this->load->view('shared/bawah');
			}
		if ($ada==0)
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru'>";
			}
	}
	function perbaruidaftarsiswaujian()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$thnajaran=$this->input->post('thnajaran');
		$id_mapel=$this->input->post('id_mapel');
		$mapel=$this->input->post('mapel');
		$kelas=$this->input->post('kelas');
		$semester=$this->input->post('semester');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
			{
				$nis = $dsiswa->nis;
				$no_urut = $dsiswa->no_urut;
				$status=$dsiswa->status;
				$ada = $this->Guru_model->Cek_Nilai_Ujian($thnajaran,$mapel,$nis);
				$ada = $ada->num_rows();
				$pbk['thnajaran'] = $thnajaran;
				$pbk['semester'] = $semester;
				$pbk['ruang'] = $kelas;
				$pbk['nis'] = $nis;
				$pbk['mapel'] = $mapel;
				$pbk['no_urut'] = $no_urut;
				$this->Guru_model->Add_Nilai_Ujian($pbk,$ada);
				
			}
		redirect('guru/daftarnilaiujian/'.$id_mapel);
	}
	function nilaiujian($id=null,$cacah=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Hasil Ujian Akhir Sekolah';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if(is_numeric($cacah))
		{
			if($cacah < 1)
			{
				$cacah = 1;
			}
		}
		else
		{
			$cacah = 1;
		}

		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$ranah = $dtmapel->ranah;
			}
		$data['ranah']=$ranah;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['id_mapel']=$id;
		$data['cacah']=$cacah;
		}
       		//$data['cacah_siswa'] = $tot_hal->num_rows();
		if (empty($ranah))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/ubahkkm/$id'>";
			}
			else
			{
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_ujian',$data);
		$this->load->view('shared/bawah');
			}
	}
	function updatenilaiujian($id_mapel=null,$cacah=null)
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
				$cacah_siswa = $this->input->post('cacah_siswa');
				for($i=1;$i<=$cacah_siswa;$i++)
				{
				$in["id_nilai_ujian"]=$this->input->post("kd_$i");
				$in["nilai"]=$this->input->post("nilai_$i");
				$in["praktik"]=$this->input->post("nilai_praktik_$i");
				$this->load->model('Guru_model');
				$this->Guru_model->Update_Nilai_Ujian($in);
				}
		redirect('guru/daftarnilaiujian/'.$id_mapel.'/'.$cacah);
	}
	function unduhnilaipesertaun()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$id='';		
				if ($this->uri->segment(3) === FALSE)
				{
	    			$id='';
				}
				else
				{
		    			$id = $this->uri->segment(3);
				}
				$data['id_mapel'] = $id;
				$this->load->library('excel');
				$this->load->view('shared/nilai_peserta_un_xls',$data);
	}
	function unduhnilaiakhir()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$id='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id='';
			}
			else
			{
	    			$id = $this->uri->segment(3);
			}
				$data['id_mapel'] = $id;
				$this->load->library('excel');
				$this->load->view('shared/nilai_akhir_peserta_un_xls',$data);
	}
	function editnilaiakhir()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Mengubah Nilai Akhir';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$idnilai='';
		$id_mapel='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mapel='';
		}
		else
		{
    			$id_mapel = $this->uri->segment(3);
		}
		if ($this->uri->segment(4) === FALSE)
		{
    			$id_nilai='';
		}
		else
		{
    			$id_nilai = $this->uri->segment(4);
		}
			
		$this->load->model('Guru_model');
$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$tnilai = $this->Guru_model->Id_Nilai($id_nilai);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$ranah = $dtmapel->ranah;
			}
		foreach($tnilai->result() as $dtnilai)
			{
				$kelas = $dtnilai->kelas;
				$mapel = $dtnilai->mapel;
				$thnajaran = $dtnilai->thnajaran;
				$semester = $dtnilai->semester;
				$nilaisiswa = $dtnilai->kog;
			}		$data['ranah']=$ranah;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id_mapel;
		$data['id_nilai']=$id_nilai;
		$data['nilaisiswa']=$nilaisiswa;
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_akhir_edit',$data);
		$this->load->view('shared/bawah');
	}
	function ubahnilaiakhir()
	{
		$in=array();
		$nim=$this->session->userdata('nama');
		$status=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
				$id_mapel=$this->input->post('id_mapel');
				$in["kd"]=$this->input->post('id_nilai');
				$in["kog"]=$this->input->post('nilaine');
				$this->Guru_model->Update_Nilai_Akhir($in);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilaiujian/".$id_mapel."'>";
	}
	function rpp()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'RPP';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		if (empty($aksi))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rpp/tampil'>";
			}
      		$limit_ti=5;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];	
		$ta = $this->Guru_model->Tampil_Rpp($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Rpp_Induk($kodeguru);
      		$config['base_url'] = base_url() . 'guru/rpp/tampil/';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('ta'=>$ta,'paginator'=>$paginator, 'page'=>$page,'kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_rpp_induk'=>$page);
		$in=array();
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['semester'] = $this->input->post('semester');
		$in['no_rpp'] = $this->input->post('no_rpp');
		$in['waktu'] = $this->input->post('waktu');
		$in['kelas'] = $this->input->post('kelas');
		$in['mapel'] = $this->input->post('mapel');
		$in['standar_kompetensi'] = $this->input->post('standar_kompetensi');
		$in['kompetensi_dasar'] = $this->input->post('kompetensi_dasar');
		$in['indikator_pencapaian_kompetensi'] = $this->input->post('indikator_pencapaian_kompetensi');
		$in['tujuan_pembelajaran'] = $this->input->post('tujuan_pembelajaran');
		$in['materi_pembelajaran'] = $this->input->post('materi_pembelajaran');
		$in['model_pembelajaran'] = $this->input->post('model_pembelajaran');
		$in['strategi_pembelajaran'] = $this->input->post('strategi_pembelajaran');
		$in['sumber_belajar'] = $this->input->post('sumber_belajar');
		$in['pendahuluan'] = $this->input->post('pendahuluan');
		$in['eksplorasi'] = $this->input->post('eksplorasi');
		$in['elaborasi'] = $this->input->post('elaborasi');
		$in['konfirmasi'] = $this->input->post('konfirmasi');
		$in['penutup'] = $this->input->post('penutup');
		$in['penilaian'] = $this->input->post('penilaian');
		$in['rencana'] = $this->input->post('rencana');
		$in['tugas'] = $this->input->post('tugas');
		$in['jenis'] = $this->input->post('jenis');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
			{
			$this->Guru_model->Tambah_Rpp($in);
			redirect('guru/rpp/tampil');
			} 
		if ($post_aksi == 'ubah_data')
			{
			$in['id_guru_rpp_induk'] = $this->input->post('id_guru_rpp_induk');
			$this->Guru_model->Update_Rpp($in);
			redirect('guru/rpp/tampil');
			}
		if ($aksi== 'hapus')
			{
			$this->Guru_model->Hapus_Rpp($page,$kodeguru);
			} 
		if ($aksi== 'unduh')
			{
			$this->load->view('guru/rpp_unduh_csv',$data_isi);
			}
 		if (($aksi== 'tambah') or ($aksi=='ubah'))
			{
			$data['tekseditor'] = '';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rpp_induk_tambah',$data_isi);
			$this->load->view('shared/bawah');
			}
		else if (($post_aksi=='salin_data') or ($aksi == 'salin'))
			{
			$id_guru_rpp_induk = $this->input->post('id_kopi');
	        	$data_isi = array('kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_rpp_induk'=>$id_guru_rpp_induk);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rpp_induk_tambah',$data_isi);			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rpp',$data_isi);
			$this->load->view('shared/bawah');
			}
	}
	function nilaiakhlak()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Akhlak Mulia dan Kepribadian';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=12;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];
		$query=$this->Guru_model->Tampil_Semua_Nilai_Akhlak_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Semua_Nilai_Akhlak_Guru($kodeguru);
      		$config['base_url'] = base_url() . 'guru/nilaiakhlak';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/akhlak',$data_isi);
		$this->load->view('shared/bawah');
	}
	function perangkat()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/perangkat',$data);
			$this->load->view('shared/bawah');
	}
	function bip()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Buku Informasi Penilaian';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
      		$limit_ti=10;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$kodeguru = $data["nim"];	
		$ta=$this->Guru_model->Tampil_Bip_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Bip($kodeguru);
		$daftar_tapel= $this->Guru_model->Tampilkan_Semua_Tahun();
	      	$config['base_url'] = base_url() . '/guru/bip/tampil/';
	       	$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$data_isi = array('paginator'=>$paginator, 'page'=>$page,'kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_bip'=>$page,'daftar_tapel'=>$daftar_tapel,'ta'=>$ta);		$in=array();
		$in['thnajaran'] = $this->input->post('thnajaran');
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['semester'] = $this->input->post('semester');
		$tanggalhadir =$this->input->post('tanggalhadir');
		$tanggalulangan =$this->input->post('tanggalulangan');
		$tanggalanalisis =$this->input->post('tanggalanalisis');
		$in['tanggal'] = tanggal_indonesia_ke_barat($tanggalhadir);
		$in['tanggal_ulangan'] = tanggal_indonesia_ke_barat($tanggalulangan);
		$in['tanggal_analisis'] = tanggal_indonesia_ke_barat($tanggalanalisis);
		$in['mapel'] = $this->input->post('mapel');
		$in['kelas'] = $this->input->post('kelas');
		$in['jenisulangan'] = $this->input->post('jenisulangan');
		$in['skkdmateri'] = $this->input->post('skkdmateri');
		$in['isiinformasi'] = $this->input->post('isiinformasi');
		$in['penerima'] = $this->input->post('penerima');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
		{
			$this->Guru_model->Tambah_Bip($in);
			$aksi = 'tampil';
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/bip/tampil'>";
		} 
		if ($post_aksi == 'ubah_data')
		{
			$in['id_guru_bip'] = $this->input->post('id_guru_bip');
			$this->Guru_model->Update_Bip($in);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/bip/tampil'>";
		}
		if ($aksi== 'hapus')
		{
			$this->Guru_model->Hapus_Bip($page,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/bip/tampil'>";
		} 
		if (($aksi== 'tambah') or ($aksi=='ubah'))
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bip_tambah',$data_isi);
			$this->load->view('shared/bawah');
		}
		else if (($post_aksi=='salin_data') or ($aksi == 'salin'))
		{
			$id_guru_bip = $this->input->post('id_kopi');
	        	$data_isi = array('kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_bip'=>$id_guru_bip,'daftar_tapel'=>$daftar_tapel);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bip_tambah',$data_isi);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bip',$data_isi);
			$this->load->view('shared/bawah');
		}
	}

	function ketuntasan($id=null,$itemnilai=null,$ditandatangani=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]='Ketuntasan';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data["kodeguru"]= $kodeguru;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$kkm_uh1 = $dtmapel->kkm_uh1;
				$kkm_uh2 = $dtmapel->kkm_uh2;
				$kkm_uh3 = $dtmapel->kkm_uh3;
				$kkm_uh4 = $dtmapel->kkm_uh4;
				$kkm_mid = $dtmapel->kkm_mid;
				$kkm_uas = $dtmapel->kkm_uas;
				$ranah = $dtmapel->ranah;
				$nsoal_uh1 = $dtmapel->nsoal_uh1;
				$nsoal_uh2 = $dtmapel->nsoal_uh2;
				$nsoal_uh3 = $dtmapel->nsoal_uh3;
				$nsoal_uh4 = $dtmapel->nsoal_uh4;
				$nsoal_mid = $dtmapel->nsoal_mid;
				$nsoal_uas = $dtmapel->nsoal_uas;
				$skor_uh1 = $dtmapel->skor_uh1;
				$skor_uh2 = $dtmapel->skor_uh2;
				$skor_uh3 = $dtmapel->skor_uh3;
				$skor_uh4 = $dtmapel->skor_uh4;
				$skor_mid = $dtmapel->skor_mid;
				$skor_uas = $dtmapel->skor_uas;
			}
			$data['ranah']=$ranah;
			$thnajaran = $dtmapel->thnajaran;
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			if ($itemnilai=='uh1')
			{
				$kkmulangan = $kkm_uh1;
				$skor = $skor_uh1;
				$nsoal = $nsoal_uh1;
			}
			if ($itemnilai=='uh2')
			{
				$kkmulangan = $kkm_uh2;
				$skor = $skor_uh2;
				$nsoal = $nsoal_uh2;
			}
			if ($itemnilai=='uh3')
			{
				$kkmulangan = $kkm_uh3;
				$skor = $skor_uh3;
				$nsoal = $nsoal_uh3;
			}
			if ($itemnilai=='uh4')
			{
				$kkmulangan = $kkm_uh4;
				$skor = $skor_uh4;
				$nsoal = $nsoal_uh4;
			}
			if ($itemnilai=='mid')
			{
				$kkmulangan = $kkm_mid;
				$skor = $skor_mid;
				$nsoal = $nsoal_mid;
			}
			if ($itemnilai=='uas')
			{
				$kkmulangan = $kkm_uas;
				$nsoal = $nsoal_uas;
				$skor = $skor_uas;
			}
			if ($kkmulangan==0)
			{
				$kkmulangan = $kkm;
			}
		}
		$data['kkm'] = $kkmulangan;
		$data['skor'] = $skor;
		$data['nsoal'] = $nsoal;
		$data['ada']=$ada;
		if ((empty($kkm)) or (empty($ranah)))
		{
			redirect('guru/ubahkkm/'.$id);
		}
		else
		{
			if ($ditandatangani == "ttd")
			{
				$data["ditandatangani"]="ya";
			}
			else
			{
				$data["ditandatangani"]="tidak";
			}
			$this->load->model('Referensi_model','ref');
			$data['baris1'] = $this->ref->ambil_nilai('baris1');
			$data['baris2'] = $this->ref->ambil_nilai('baris2');
			$data['baris3'] = $this->ref->ambil_nilai('baris3');
			$data['baris4'] = $this->ref->ambil_nilai('baris4');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['persentase_klasikal'] = $this->ref->ambil_nilai('persentase_klasikal');
			$this->load->view('shared/bg_atas_cetak',$data);					
			$this->load->view('guru/ketuntasan',$data);
		}
	}
	function tindaklanjut($id_mapel=null,$itemnilai=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['tmapel'] = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$data['kodeguru'] = $kodeguru;
		$data['itemnilai'] = $itemnilai;
		$data['judulhalaman'] = 'Program Remidial dan atau Pengayaan';
		$data['tekseditor'] = '';
	   	
		$in=array();
		$in['tindakan_satu'] = $this->input->post('tindakan_satu');
		$in['tindakan_dua'] = $this->input->post('tindakan_dua');
		$in['tindakan_pengayaan'] = $this->input->post('tindakan_pengayaan');
		$in['id_guru_tindak_lanjut'] = $this->input->post('id_guru_tindak_lanjut');
		$id_guru_tindak_lanjut = $this->input->post('id_guru_tindak_lanjut');
		$post_aksi = $this->input->post('post_aksi');
		$in['jam_mulai'] =$this->input->post("jam_mulai");
		$in['jam_selesai'] =$this->input->post("jam_selesai");
		$in['menit_mulai'] =$this->input->post("menit_mulai");
		$in['menit_selesai'] =$this->input->post("menit_selesai");

		$tanggalhadir =$this->input->post('tanggal');
		$in['tanggal'] = tanggal_indonesia_ke_barat($tanggalhadir);
		$tanggalhariini = tanggal_indonesia_ke_barat($tanggalhadir);
		if ($post_aksi=='ubah_data')
			{
			$in = nopetik($in);
			$this->Guru_model->Update_Data_Tindak_Lanjut($in);
			$nip=$this->Guru_model->get_NIP($data["nim"]);
			$tahun = tahunsaja(tanggal_indonesia_ke_barat($tanggalhadir));
			$bulan = bulansaja(tanggal_indonesia_ke_barat($tanggalhadir));
			$bulane = angka_jadi_bulan($bulan);
			$mapel = nopetik($this->input->post("mapel"));
			$kelas = nopetik($this->input->post("kelas"));
			$thnajaran = nopetik($this->input->post("thnajaran"));
			$semester = nopetik($this->input->post("semester"));
			$jam_mulai = nopetik($this->input->post("jam_mulai"));
			$jam_selesai = nopetik($this->input->post("jam_selesai"));
			$menit_mulai = nopetik($this->input->post("menit_mulai"));
			$menit_selesai = nopetik($this->input->post("menit_selesai"));

			$kegiatan = 'melaksanakan pembelajaran perbaikan dan pengayaan dengan memanfaatkan hasil penilaian dan evaluasi di bulan '.$bulane.' '.$tahun;
			$tc = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
			$id_bulanan = '';
			foreach($tc->result() as $c)
			{
				$id_bulanan = $c->id_bulanan;
			}
			if(!empty($id_bulanan))
			{
				$kegiatanharian = 'melaksanakan pembelajaran perbaikan dan pengayaan mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tb = $this->db->query("select * from `sieka_harian` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");
				if($tb->num_rows() == 0)
				{
					$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`) values ('$tahun','$nip', '$kegiatanharian', '$tanggalhariini', '$id_bulanan', '$jam_mulai', '$menit_mulai', '$jam_selesai', '$menit_selesai')");
				}
				else
				{
					$this->db->query("update `sieka_harian` set `jam_selesai` = '$jam', `menit_selesai`='$menit' where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");
				}
			}

			redirect('guru/daftarnilai/'.$id_guru_tindak_lanjut);
			}
			else
			{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/edit_data_tindak_lanjut',$data);
				$this->load->view('shared/bawah');
			}
	}
	function pengayaan($id=null,$itemnilai=null,$ditandatangani=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Program Pengayaan';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data["kodeguru"]= $kodeguru;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$kkm_uh1 = $dtmapel->kkm_uh1;
				$kkm_uh2 = $dtmapel->kkm_uh2;
				$kkm_uh3 = $dtmapel->kkm_uh3;
				$kkm_uh4 = $dtmapel->kkm_uh4;
				$kkm_mid = $dtmapel->kkm_mid;
				$kkm_uas = $dtmapel->kkm_uas;
				$ranah = $dtmapel->ranah;
			}
			$data['ranah']=$ranah;
			$thnajaran = $dtmapel->thnajaran;
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			if ($itemnilai=='uh1')
			{
				$kkmulangan = $kkm_uh1;
			}
			if ($itemnilai=='uh2')
			{
				$kkmulangan = $kkm_uh2;
			}
			if ($itemnilai=='uh3')
			{
				$kkmulangan = $kkm_uh3;
			}
			if ($itemnilai=='uh4')
			{
				$kkmulangan = $kkm_uh4;
			}
			if ($itemnilai=='mid')
			{
				$kkmulangan = $kkm_mid;
			}
			if ($itemnilai=='uas')
			{
				$kkmulangan = $kkm_uas;
			}
			if ($kkmulangan==0)
			{
				$kkmulangan = $kkm;
			}
		}
		$data['kkm'] = $kkmulangan;
		$data['ada']=$ada;
		if ((empty($kkm)) or (empty($ranah)))
		{
			redirect('guru/ubahkkm/'.$id);
		}
		else
		{
			if ($ditandatangani == "ttd")
			{
				$data["ditandatangani"]="ya";
			}
			else
			{
				$data["ditandatangani"]="tidak";
			}
			$this->load->model('Referensi_model','ref');
			$data['baris1'] = $this->ref->ambil_nilai('baris1');
			$data['baris2'] = $this->ref->ambil_nilai('baris2');
			$data['baris3'] = $this->ref->ambil_nilai('baris3');
			$data['baris4'] = $this->ref->ambil_nilai('baris4');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$this->load->view('shared/bg_atas_cetak',$data);		
			$this->load->view('guru/pengayaan',$data);
		}
	}
	function buku()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Daftar Buku Pegangan';
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		$kodeguru = $data["nim"];	
        	$data_isi = array('page'=>$page,'kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_buku_pegangan'=>$page);
		$in=array();
		$in['mapel'] = $this->input->post('mapel');
		$in['tingkat'] = $this->input->post('tingkat');
		$in['judul'] = $this->input->post('judul');
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['pengarang'] = $this->input->post('pengarang');
		$in['penerbit'] = $this->input->post('penerbit');
		$in['keterangan'] = $this->input->post('keterangan');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
			{
			$this->Guru_model->Tambah_Buku($in);
			} 
		if ($post_aksi == 'ubah_data')
			{
			$in['id_guru_buku_pegangan'] = $this->input->post('id_guru_buku_pegangan');
			$this->Guru_model->Update_Buku($in);
			}
		if ($aksi== 'hapus')
			{
			$this->Guru_model->Hapus_Buku($page,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/buku/tampil'>";
			} 
		
		$this->load->view('guru/bg_atas',$data);
				if (($aksi== 'tambah') or ($aksi=='ubah'))
			{
			$this->load->view('guru/buku_tambah',$data_isi);
			}
		else if (($post_aksi=='salin_data') or ($aksi == 'salin'))
			{
			$id_guru_bip = $this->input->post('id_kopi');
	        	$data_isi = array('kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_buku_pegangan'=>$id_guru_buku_pegangan,'daftar_tapel'=>$daftar_tapel);
			$this->load->view('guru/buku_tambah',$data_isi);
			}
			else
			{
			$this->load->view('guru/buku',$data_isi);
			}
		$this->load->view('shared/bawah');
	}
	function tugas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
	   	$data['judulhalaman'] = 'Daftar Tugas Siswa';
			$this->load->model('Guru_model');
			$in=array();
			$in['tugas'] = $this->input->post('tugas');
			$in['is_mandiri'] = $this->input->post('is_mandiri');
			$in['id_rph'] = $this->input->post('id_rph');
			$tanggaltugasselesai =$this->input->post('tanggaltugasselesai');
			$bulantugasselesai =$this->input->post('bulantugasselesai');
			$tahuntugasselesai =$this->input->post('tahuntugasselesai');
			$in['tanggalselesai'] = "$tahuntugasselesai-$bulantugasselesai-$tanggaltugasselesai";
			$post_aksi = $this->input->post('post_aksi');
			if ($post_aksi=='ubah_data')
				{
				$this->Guru_model->Update_Rph($in);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/tugas'>";
				}
			$data["thnajaran"] = cari_thnajaran();
			$data["semester"] = cari_semester();
			$thnajaran = cari_thnajaran();
			$semester = cari_semester();
			$data["kodeguru"] = $data["nim"];	
			$kodeguru = $data["nim"];
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->library('Pagination');	
			$page=$this->uri->segment(3);
			$aksi=$this->uri->segment(4);
			$id_rph=$this->uri->segment(5);
	      		$limit_ti=10;
			if(!$page):
				$offset_ti = 0;
				else:
				$offset_ti = $page;
				endif;
			$query=$this->Guru_model->Tampil_Bph_Guru($thnajaran,$semester,$kodeguru,$limit_ti,$offset_ti);
			$tot_hal = $this->Guru_model->Total_Bph_Guru($thnajaran,$semester,$kodeguru);
	      		$config['base_url'] = base_url() . '/guru/tugas';
	       		$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
	        	$data["ta"]=$query;
			$data["paginator"]=$paginator;
			$data["page"]=$page;
			$data['aksi']=$aksi;
			$data['id_rph'] = $id_rph;
			if (($aksi=='ubah') and (!empty($id_rph)))
				{
				$this->load->view('guru/bg_atase',$data);
				$this->load->view('guru/tugas',$data);
				}
				else
				{
				$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/tugas',$data);
				$this->load->view('shared/bawah');
				}
	}
	function nilairemidi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Remidi';
		$data['loncat'] = '';
		$sukses = '';
		$thn1=$this->uri->segment(3);
		if($thn1>0)
			{
			$thn2 = $thn1 + 1;
			}
			else
			{
			$thn2 = '';
			}
		$data['thnajaran']= $thn1.'/'.$thn2;
		$data['semester']=$this->uri->segment(4);
		$data['id_mapel']=$this->uri->segment(5);
		$data['itemnilai']=$this->uri->segment(6);
		$this->load->model('Guru_model');
		$diproses = $this->input->post('diproses');		
		if ($diproses=='nilai_remidi_oke')
			{
			$cacah_siswa = $this->input->post('cacah_siswa');
			for($i=1;$i<=$cacah_siswa;$i++)
				{
				$in["id_nilai_remidi"]=$this->input->post("kd_$i");
				$in["nilai"]=$this->input->post("nilai_remidi_$i");
				$this->Guru_model->Update_Nilai_Remidi($in);
				}
			$sukses = 'Nilai remidi berhasil disimpan';
			$data['thnajaran']= $this->input->post("post_thnajaran");
			$data['semester']= $this->input->post("post_semester");
			$data['id_mapel']= $this->input->post("post_id_mapel");
			$data['itemnilai']= $this->input->post("post_itemnilai");
			}
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['sukses'] = $sukses;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_remidi',$data);
		$this->load->view('shared/bawah');
	}
	function jawabansiswa()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$daftar_tapel= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['ulangan']=$this->input->post('ulangan');
		$data['aksi']=$this->input->post('aksi');
		if ($data['aksi']=='unduh')
			{
			$this->load->library('excel');
			$this->load->view('guru/analisis_butir_soal_xls',$data);
			}
        	$data_isi = array('kodeguru' => $kodeguru,'daftar_tapel'=>$daftar_tapel);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/analisis_butir_soal',$data_isi);
		$this->load->view('shared/bawah');
	}
	function prosesimporanalisis()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			$id_mapel=$this->input->post('id_mapel');
			$ulangan=$this->input->post('ulangan');
			$this->load->model('Guru_model');
			$this->load->library('csvimport');
			$filePath = $_FILES["csvfile"]["tmp_name"];
			$csvData = $this->csvimport->get_array($filePath);	
			$n=0;
			foreach($csvData as $field):
				$pbk['thnajaran'] = $field["thnajaran"];
				$pbk['semester'] = $field["semester"];
				$pbk['mapel'] = $field["mapel"];
				$pbk['ulangan'] = $field["ulangan"];
				$pbk['nis'] = $field["nis"];
				$urutan = 0;
				do
					{
					$nomorsoal = $urutan + 1;
					$pbk["nilai_s$nomorsoal"] = $field["s$nomorsoal"];
					$urutan++;
					}
				while($urutan<50);
				$this->Guru_model->Update_Analisis_Impor($pbk);
				$n++;
			endforeach;
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/analisis/".$id_mapel."/".$ulangan."'>";
	}//akhir fungsi proses impor nilai psiko
	function kirimnilairemidi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$diproses = $this->input->post('diproses');		
		if ($diproses=='nilai_remidi_oke')
			{
			$cacah_siswa = $this->input->post('cacah_siswa');
			for($i=1;$i<=$cacah_siswa;$i++)
				{
				$in["id_nilai_remidi"]=$this->input->post("kd_$i");
				$in["nilai"]=$this->input->post("nilai_remidi_$i");
				$this->Guru_model->Update_Nilai_Remidi($in);
				}
			}
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['itemnilai']=$this->input->post('itemnilai');
$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('guru/bg_atas',$data);
		
		$this->load->view('guru/nilai_remidi_kirim',$data);
		$this->load->view('shared/bawah');
	}
	function unggahnilairemidi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Unggah Nilai Program Pelaksanaan Remidi';
		$sukses = '';
		$thn1=$this->uri->segment(3);
		if($thn1>0)
		{
			$thn2 = $thn1 + 1;
		}
		else
		{
			$thn2 = '';
		}
		$data['thnajaran']= $thn1.'/'.$thn2;
		$data['semester']=$this->uri->segment(4);
		$data['id_mapel']=$this->uri->segment(5);
		$data['itemnilai']=$this->uri->segment(6);
		$this->load->model('Guru_model');
		$id_mapel = $this->input->post('id_mapel');		
		$diproses = $this->input->post('diproses');		
		if ($diproses=='nilai_remidi_oke')
		{
			$mapel = $this->input->post("post_mapel");
			$thnajaran = $this->input->post("post_thnajaran");
			$semester = $this->input->post("post_semester");
			$ulangan = $this->input->post("post_itemnilai");
			$this->load->library('csvimport');
			$filePath = $_FILES["csvfile"]["tmp_name"];
			$csvData = $this->csvimport->get_array($filePath);	
			$adagalat = 0;
			$pesan = '';
			$n = 0;
			foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
				if(isset($field['nis']))
				{
					$nis = nopetik($field['nis']);
				}
				else
				{
					$adagalat = 1;
					$pesan .= ' nis';
					$nis = '';
				}
				$kd='';
				$tnilai = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
				foreach($tnilai->result() as $dn)
				{
					$kd = $dn->kd;
				}
				if(isset($field['nilai']))
				{
					$nilai = nopetik($field['nilai']);
				}
				else
				{
					$adagalat = 1;
					$pesan .= ' nilai';
					$nilai = '';
				}
				if ($adagalat==0)
				{
					$this->Guru_model->Update_Nilai_Remidi_Unggah($kd,$ulangan,$nilai);
				}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
			endforeach;
			$datay['modul'] = 'Unggah Nilai Remidi';
			$datay['tautan_balik'] = ''.base_url().'guru/unggahnilairemidi';
			$datay['pesan'] = $pesan;
			if($adagalat==1)
			{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);
			}
			else
			{
				$thnajaran=$this->input->post('post_thnajaran');
				$semester=$this->input->post('post_semester');
				$id_mapel=$this->input->post('post_id_mapel');
				$itemnilai=$this->input->post('post_itemnilai');
				$thn1= substr($thnajaran,0,4);	
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/nilairemidi/".$thn1."/".$semester."/".$id_mapel."/".$itemnilai."'>";
			}
		}
		else
		{
			$data["kodeguru"] = $data["nim"];	
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/nilai_remidi_unggah',$data);
			$this->load->view('shared/bawah');
		}
	}
	function tugastanggal()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$data['tanggalrph'] = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');			if ($diproses == 'oke')
			{
			$data['tanggalrphe'] = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/tugas_tanggal_tampil',$data);
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/tugas_tanggal',$data);
			}
			$this->load->view('shared/bawah');
	}
	function lck()
	{
		$data["nim"]=$this->session->userdata('username');
		$kelas='';
		$thnajaran='';
		$mapel='';
		$id='';		
		$itemnilai='';
		$download_pdf = '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		if ($this->uri->segment(4) === FALSE)
		{
    			$itemnilai='';
		}
		else
		{
    			$itemnilai = $this->uri->segment(4);
		}
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			$this->load->view('deskripsi/bg_atas',$data);
			$this->load->view('guru/ubah_ketuntasan',$data);
			$this->load->view('deskripsi/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function lck2($id=null,$itemnilai = null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Laporan Hasil Belajar Siswa Tiap Mata Pelajaran';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$download_pdf = '';
		$jujug = $this->config->item('jujug');
		$data['jujug'] = $jujug;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
				$ranah = $dtmapel->ranah;
				$kkm_mid = $dtmapel->kkm_mid;
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
				$pilihan = $dtmapel->pilihan;
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['kkm']=$kkm;
		$data['kkm_mid']=$kkm_mid;
		$data['ranah']=$ranah;
		$data['jenis_deskripsi'] = $jenis_deskripsi;
		$data['pilihan'] = $pilihan;
		$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		$data['kurikulum'] = $kurikulum;
		$this->load->model('Nilai_model');
		$data["tkepala"] = $this->Nilai_model->Kepala($thnajaran,$semester);
		if ((empty($kkm)) or (empty($ranah)))
			{
			redirect('guru/ubahkkm/'.$id);
			}
			else
			{
				$this->load->view('guru/bg_atas',$data);
				if($kurikulum == '2013')
				{
					$this->load->view('guru/lck_2013',$data);
				}
				if($kurikulum == '2015')
				{
					$this->load->view('guru/lck_2015',$data);
				}
				if($kurikulum == '2018')
				{
					$this->load->view('guru/lck_2018',$data);
				}

				$this->load->view('shared/bawah');
			}
	}

	function updatelck()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$id_mapel = $this->input->post('id_mapel');
		$semester = $this->input->post('semester');
		$dari = $this->input->post('dari');
		$jenis_deskripsi = $this->input->post('jenis_deskripsi');
		for($i=1;$i<=$cacah_siswa;$i++)
		{
			$in["ket"]='Sudah kompeten';
			$in["kd"]=$this->input->post("kd_$i");
			$nis =$this->input->post("nis_$i");
			$materi1 = $this->input->post("materi1_$i"); 
			$materi2 = $this->input->post("materi2_$i"); 
			$materi3 = $this->input->post("materi3_$i"); 
			$materi4 = $this->input->post("materi4_$i"); 
			$materi5 = $this->input->post("materi5_$i"); 
			$materi6 = $this->input->post("materi6_$i"); 
			$skor1 = $this->input->post("skor1_$i"); 
			$skor2 = $this->input->post("skor2_$i"); 
			$skor3 = $this->input->post("skor3_$i"); 
			$skor4 = $this->input->post("skor4_$i"); 
			$skor5 = $this->input->post("skor5_$i"); 
			$skor6 = $this->input->post("skor6_$i"); 
			$awalan1 = $this->input->post("awalan1_$i"); 
			$awalan2 = $this->input->post("awalan2_$i"); 
			$awalan3 = $this->input->post("awalan3_$i"); 
			$awalan4 = $this->input->post("awalan4_$i"); 
			$awalan5 = $this->input->post("awalan5_$i"); 
			$awalan6 = $this->input->post("awalan6_$i");
			if(empty($skor1))
			{
				$skor1 = 0;
			}
			if(empty($skor2))
			{
				$skor2 = 0;
			}
			if(empty($skor3))
			{
				$skor3 = 0;
			}
			if(empty($skor4))
			{
				$skor4 = 0;
			}
			if(empty($skor5))
			{
				$skor5 = 0;
			}
			if(empty($skor6))
			{
				$skor6 = 0;
			}

			$this->load->model('Guru_model');
			if($jenis_deskripsi != '1')
			{
				$this->Guru_model->Hapus_Capaian_Kompetensi_Siswa($id_mapel,$nis);				
			}
			$in2["nis"]=$nis;
			$in2["id_mapel"] = $id_mapel;
/*					$in2["positif"] = $skor1;
					$in2["ket"] = $awalan1;
					$in2["materi"] = $materi1;
					$in2["nomor_materi"] = 1;
					$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
*/
		 	if (!empty($materi1))
			{
/*
					if ($skor1 == 0)
						{$awalan1 = 'belum memahami';
						}
					if (($skor1 == 1) and (empty($awalan1)))
						{$awalan = 'sudah memahami';
						}
*/
				$in2["positif"] = $skor1;
				$in2["ket"] = $awalan1;
				$in2["materi"] = $materi1;
				$in2["nomor_materi"] = 1;
				$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
			}
		 	if (!empty($materi2))
			{
/*
					if ($skor2 == 0)
						{$awalan2 = 'belum memahami';
						}
					if (($skor2 == 1) and (empty($awalan2)))
						{$awalan = 'sudah memahami';
						}
*/
				$in2["positif"] = $skor2;
				$in2["ket"] = $awalan2;
				$in2["materi"] = $materi2;
				$in2["nomor_materi"] = 2;
				$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
			}
		 	if (!empty($materi3))
			{
/*
					if ($skor3 == 0)
						{$awalan3 = 'belum memahami';
						}
					if (($skor3 == 1) and (empty($awalan3)))
						{$awalan = 'sudah memahami';
						}
*/
				$in2["positif"] = $skor3;
				$in2["ket"] = $awalan3;
				$in2["materi"] = $materi3;
				$in2["nomor_materi"] = 3;
				$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
			}
		 	if (!empty($materi4))
			{
/*
					if ($skor4 == 0)
						{$awalan4 = 'belum memahami';
						}
					if (($skor4 == 1) and (empty($awalan4)))
						{$awalan = 'sudah memahami';
						}
*/
				$in2["positif"] = $skor4;
				$in2["ket"] = $awalan4;
				$in2["materi"] = $materi4;
				$in2["nomor_materi"] = 4;
				$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
			}
		 	if (!empty($materi5))
			{
/*					if ($skor5 == 0)
						{$awalan5 = 'belum memahami';
						}
					if (($skor5 == 1) and (empty($awalan5)))
						{$awalan = 'sudah memahami';
						}
*/				$in2["positif"] = $skor5;
				$in2["ket"] = $awalan5;
				$in2["materi"] = $materi5;
				$in2["nomor_materi"] = 5;
				$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
			}
		 	if (!empty($materi6))
			{
/*
					if ($skor6 == 0)
						{$awalan6 = 'belum memahami';
						}
					if (($skor6 == 1) and (empty($awalan6)))
						{$awalan = 'sudah memahami';
						}
*/
				$in2["positif"] = $skor6;
				$in2["ket"] = $awalan6;
				$in2["materi"] = $materi6;
				$in2["nomor_materi"] = 6;
				$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
			}
/*
					if ($ranah=='KPA') 
						{
						if ($in["nilai_nr"]<$kkm)
							{$in["ket"] = 'Belum kompeten';
							}
						if ($in["psikomotor"]<$kkm)
							{$in["ket"] = 'Belum kompeten';
							}
						}
					if ($ranah=='PA')
						{
						if ($in["psikomotor"]<$kkm)
							{$in["ket"] = 'Belum kompeten';
							}
						}
					if ($ranah=='KA')
						{
						if ($in["nilai_nr"]<$kkm)
							{$in["ket"] = 'Belum kompeten';
							}
						}
				if (($in["afektif"]!='A') and ($in["afektif"]!='B') and ($in["afektif"]!='SB'))
							{$in["ket"] = 'Belum Kompeten';
							}
*/
			if (($jenis_deskripsi=='0') or ($jenis_deskripsi=='4'))
			{
				$in["keterangan"]=$this->input->post("keterangan_$i");
			}
			$in["rapor"]=$this->input->post("pilihan_$i");
			if($this->input->post("pilihan_$i") == 1 )
			{
				$in["kunci"] = 1;
			}
			$this->Guru_model->Update_Nilai($in);
		}
		redirect('deskripsi/pramapel/pengetahuan/'.$id_mapel.'/lck');
//				if($dari == 'lck')
//					{
//					echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/lck/$id_mapel'>";
//					}
//				elseif($dari == 'rapor')
//					{
//					echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rapor/$id_mapel'>";
//					}
//				else
//					{
//					echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/'>";
//					}
	}
	function simpanpenanganan()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$isi_berita = $this->input->post('isi_berita');
		$id = $this->input->post('id_pemberitahuan');
		$in["id"]=$id;
		$in["tindakan_walikelas"]=$isi_berita;
		$nis = $this->input->post('nis');
		$id_walikelas = $this->input->post('id_walikelas');
		$this->load->model('Guru_model');
		$this->Guru_model->Update_Penanganan($in);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/detilsiswa/".$nis."/".$id_walikelas."/2'>";
	}
	function piketguru()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$id_tapel = $this->uri->segment(4);
		$semester = $this->uri->segment(5);
		$id_pegawai = $this->uri->segment(6);
		$id_hari_tatap_muka = $this->uri->segment(7);
		$this->load->model('Guru_model');
		$data["kodegurupiket"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/piket_tugas_siswa_dari_guru',$data);
		$this->load->view('shared/bawah');
	}
	function rphkelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$in=array();
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data["id_mapel"] =$this->uri->segment(3);
		$data['judulhalaman'] = 'Rencana Pelaksanaan Harian';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/rph_kelas',$data);
		$this->load->view('shared/bawah');
	}
	function ketdiri()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$this->load->model('Guru_model');
			$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/ropeg_diri',$data);
			$this->load->view('shared/bawah');
	}
	function bankdeskripsi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Bank Deskripsi Rapor';
		$data_isi['aksi'] = $this->uri->segment(3, '');
		$data_isi['id_bank_deskripsi'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$data_isi["kodeguru"] = $data["nim"];
        	$data_isi["tingkat"] = $this->input->post('tingkat');
		$data_isi['mapel'] = $this->input->post('mapel');
		$data_isi['proses'] = $this->input->post('proses');
		$data_isi['deskripsi'] = $this->input->post('deskripsi');
		$data_isi['id_bank_deskripsine'] = $this->input->post('id_bank_deskripsi');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/deskripsi_bank',$data_isi);
		$this->load->view('shared/bawah');
	}
	function pesanmassalsiswa()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Mengirim SMS Massal';
		$this->load->model('Situs_model');
		$tnohp = $this->Situs_model->Tampil_Data_Umum_Pegawai($data['nim']);
		$id_sms_user = '';
		$seluler = '';
		foreach($tnohp->result() as $dnohp)
		{
			$id_sms_user = $dnohp->id_sms_user;
			$jenkel = $dnohp->jenkel;
			$seluler = $dnohp->seluler;
		}
		if ($jenkel=='Pr')
		{
			$pesanguru ='Pesan dari Ibu '.$data["nama"].', "';
		}
		elseif ($jenkel=='Lk')
		{
			$pesanguru ='Pesan dari Bapak '.$data["nama"].', "';
		}
		else 
		{
			$pesanguru ='Pesan dari '.$data["nama"].', "';
		}
		$data['id_sms_user'] = $id_sms_user;
		$data['seluler'] = $seluler;
		$proses = $this->input->post('proses');	
		if ($proses == 'oke')
		{
			$this->load->library('csvimport');
			$config['upload_path'] = 'uploads';
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
					$filePath = 'uploads/'.$_FILES['userfile']['name'];
					if ($this->csvimport->get_array($filePath))
					{
						$csvData = $this->csvimport->get_array($filePath);	
						$n=0;
						$this->load->model('Guru_model');
						foreach($csvData as $field):
							$inpes = array();
							$nohp = $field['Number'];
							if (substr($nohp,0,2)=='62')
							{
								$nohp = "+".$nohp;
							}
							$inpes["DestinationNumber"]=$nohp;
							$pesan = $pesanguru.''.$field['pesan'].'"';
							$inpes["TextDecoded"] = $pesan;
							$inpes["id_sms_user"] =$id_sms_user;
							if ((!empty($field['Number'])) and (!empty($field['pesan'])) and (!empty($id_sms_user)))
							{
								$this->Guru_model->Kirim_Pesan($inpes);
							}
							$n++;
						endforeach;
						unlink($filePath);
					}
				}
			}
		}
		$data['aksi']=$this->uri->segment(3,'');
		$data['kelas']=$this->uri->segment(4,'');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		if ($data['aksi'] != 'unduh')
		{
			$this->load->view('guru/bg_atas',$data);
		}
		$this->load->view('guru/form_kirim_sms_massal_siswa',$data);
		if ($data['aksi'] != 'unduh')
		{
			$this->load->view('shared/bawah');
		}
	}
	function prosesunggahjawaban()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
				$thnajaran = $this->input->post('thnajaran');
				$semester = $this->input->post('semester');
				$id_mapel = $this->input->post('id_mapel');
				$ulangan = $this->input->post('ulangan');
				$mapel = $this->input->post('mapel');
				$this->load->library('csvimport');
				$config['upload_path'] = 'uploads';
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
						$filePath = 'uploads/'.$_FILES['userfile']['name'];
							if ($this->csvimport->get_array($filePath))
								{
									$inpes = array();
								$inpes['thnajaran'] = $thnajaran;
 								$inpes['semester'] = $semester;
								$inpes['ulangan'] = $ulangan;
								$inpes['mapel'] = $mapel;
								$csvData = $this->csvimport->get_array($filePath);	
								$n=0;
								$this->load->model('Guru_model');
								foreach($csvData as $field):									$inpes["nis"]=$field['nis'];
									$inpes["jawaban"] = $field['jawaban'];
									$inpes["kelompok"] =$field['kelompok'];
									$this->Guru_model->Update_Jawaban($inpes);
									$n++;
								endforeach;
								unlink($filePath);
								}
						}
					}
			if ((empty($id_mapel)) or (empty($ulangan)))
				{
					redirect('guru/nilai');
				}
				else
				{
					redirect('guru/analisisjawabansiswa/'.$id_mapel.'/'.$ulangan.'/proses');
				}
	}
	function deskripsi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Menyunting Deskripsi Capaian Kompetensi';
		$datax['sukses'] = '';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax["kodeguru"] = $data["nim"];	
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester']= $this->uri->segment(4);
		$datax['id_mapel']=$this->uri->segment(5);
		$datax['jenis_deskripsi']=$this->uri->segment(6);
		$datax['diproses']=$this->input->post('diproses');
		if ($datax['diproses']=='oke') 
		{
			$datax['tahun1']=substr($this->input->post('thnajaranx'),0,4);
			$datax['semester']=$this->input->post('semesterx');
			$datax['jenis_deskripsi'] = $this->input->post('jenis_deskripsix');
			$datax['id_mapel']=$this->input->post('id_mapelx');
			if ($datax['jenis_deskripsi'] == 0)
			{
				$in["id_mapel"]=$this->input->post('id_mapelx');
				$in["jenis_deskripsi"]=$this->input->post('jenis_deskripsix');
				$this->Guru_model->Update_KKM($in);
				$datax['sukses'] = '<div class="alert alert-success">sukses</div>';
			}
			else
			{
				$in["id_mapel"]=$this->input->post('id_mapelx');
				$in["materi1"]=$this->input->post('materi1');
				$in["materi2"]=$this->input->post('materi2');
				$in["materi3"]=$this->input->post('materi3');
				$in["materi4"]=$this->input->post('materi4');
				$in["materi5"]=$this->input->post('materi5');
				$in["materi6"]=$this->input->post('materi6');
				$in["materi7"]=$this->input->post('materi7');
				$in["materi8"]=$this->input->post('materi8');
				$in["materi9"]=$this->input->post('materi9');
				$in["materi10"]=$this->input->post('materi10');
				$in["keterampilan1"]=$this->input->post('keterampilan1');
				$in["keterampilan2"]=$this->input->post('keterampilan2');
				$in["batas1"]=$this->input->post('batas1');
				$in["batas2"]=$this->input->post('batas2');
				$in["batas3"]=$this->input->post('batas3');
				$in["batas4"]=$this->input->post('batas4');
				$in["batas5"]=$this->input->post('batas5');
				$in["batas6"]=$this->input->post('batas6');
				$in["jenis_deskripsi"]= $this->input->post('jenis_deskripsix');
				$in = nopetik($in);
				$this->Guru_model->Update_KKM($in);
				$datax['sukses'] = '<div class="alert alert-success">Sukses</div>';
			}	
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/deskripsi',$datax);
		$this->load->view('shared/bawah');
	}
	function updatenilairapor()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$cacah_mapel = $this->input->post('cacah_mapel');
		$in["nis"]=$this->input->post("nis");
		$tautan=$this->input->post("tautan");
		for($i=1;$i<=$cacah_mapel;$i++)
		{
			$in["kd"]=$this->input->post("kd_$i");
			$in["kog"]=$this->input->post("kog_$i");
			$in["psi"]=$this->input->post("psi_$i");
			$in["kunci"]= 1;
			$this->Guru_model->Update_Nilai($in);
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/$tautan'>";
	}
	function prestasisiswa()
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman']= 'Daftar Prestasi dan Organisasi Siswa';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']=$this->input->post('semester');
		$datax['kelas']=$this->input->post('kelas');
		$datax['nis']=$this->input->post('nis');
		$datax['tipedata']=$this->input->post('tipedata');
		$datax['kegiatan']=nopetik($this->input->post('kegiatan'));
		$datax['keterangan']=nopetik($this->input->post('keterangan'));
		$datax['id_siswa_prestasi_ubah']=$this->input->post('id_siswa_prestasi_ubah');
		$datax['proses']=$this->input->post('proses');
		$datax['aksi']=$this->uri->segment(3);
		$datax['id_siswa_prestasi']=$this->uri->segment(4);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/prestasi_siswa',$datax);
		$this->load->view('shared/bawah');
	}

	function intake()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Rata - rata nilai Mata Pelajaran Untuk Penentuan KKM';
		$this->load->model('Guru_model');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax["thnajaran"] = $this->input->post('thnajaran');
		$datax["tingkat"]=$this->input->post('tingkat');
		$datax["semester"]=$this->input->post('semester');
		$datax["program"]=$this->input->post('program');
		$datax["mapel"]=$this->input->post('mapel');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/intake',$datax);
		$this->load->view('shared/bawah');
	}
	function ubahnilaiakhlakkolom()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah Nilai Akhlak Per Kolom';
		$id='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id='';
			}
			else
			{
	    			$id = $this->uri->segment(3);
			}
			if ($this->uri->segment(4) === FALSE)
			{
	    			$itemnilai='';
			}
			else
			{
	    			$itemnilai = $this->uri->segment(4);
			}
		
				$this->load->model('Guru_model');
			$kodeguru = $data["nim"];	
			$tmapel = $this->Guru_model->Id_M_Akhlak($id,$kodeguru);
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$data['kodeguru']=$kodeguru;
			$data['kelas']='';
			$data['thnajaran']='';
			$data['semester']='';
			$ada = $tmapel->num_rows();
			if ($ada>0)
			{
				foreach($tmapel->result() as $dtmapel)
				{
					$data['kelas'] = $dtmapel->kelas;
					$data['thnajaran'] = $dtmapel->thnajaran;
					$data['semester'] = $dtmapel->semester;				
				}
				$kurikulum = cari_kurikulum($data['thnajaran'],$data['semester'],$data['kelas']);
				$this->load->view('guru/bg_atas',$data);
				if($kurikulum == '2015')
				{
					$this->load->view('guru/nilai_akhlak_edit_kolom_2015',$data);
				}
				else
				{
					$this->load->view('guru/nilai_akhlak_edit_kolom',$data);
				}

				$this->load->view('shared/bawah');
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/nilaiakhlak'>";
			}
	}
	function simpannilaiakhlakkolom()
	{
		$data = array();
				$data["nim"]=$this->session->userdata('username');
			$data["nama"]=$this->session->userdata('nama');
			$data["status"]=$this->session->userdata('tanda');
				$id_mapel = $this->input->post('id_mapel');
				$cacah = $this->input->post('cacahsiswa');
				$itemnilai = $this->input->post('itemnilai');
				if($cacah>0)
				{
					$this->load->model('Guru_model');
					for($i=1;$i<=$cacah;$i++)
					{
						$in["id_nilai_akhlak"] = $this->input->post('id_nilai_akhlak_'.$i);
						$in[$itemnilai] = nopetik($this->input->post('skor_'.$i));
						$this->Guru_model->Simpan_Nilai_Akhlak($in);
					}
				}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/daftarnilaiakhlak/$id_mapel'>";			
	}
	function cetakpkg()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['thnpkg']=$this->input->post('thnpkg');
		if ((!empty($data["kodeguru"])) and (!empty($data['thnpkg'])))
			{
			$data['tautan'] = 'guru';
			$this->load->view('guru/mencetak_penilaian_kinerja_guru',$data);
			}
			else
			{
			$this->load->view('guru/bg_head',$data);
			$this->load->view('guru/form_mencetak_penilaian_kinerja_guru',$data);
			$this->load->view('shared/bawah');
			}
	}
	function tinjaututorial()
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
			$this->load->model('Guru_model');
			$data["kategori"]=$this->Guru_model->Edit_Tutorial($id,$data["nama"]);
			$data["cur_kat"]=$this->Guru_model->Kat_Tutorial();
				$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/tutorial_tinjau',$data);
			$this->load->view('shared/bawah');
	}
	function salindeskripsi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Salin Jenis Deskripsi';
		$data['sukses'] = '';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax['kodeguru'] = $data["nim"];	
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$thn1=$this->uri->segment(3);
		if($thn1>0)
		{
			$thn2 = $thn1 + 1;
		}
		else
		{
			$thn2 = '';
		}
		$data['thnajaran']= $thn1.'/'.$thn2;

			$datax['semester'] = $this->uri->segment(4);
			$datax['id_mapel'] = $this->uri->segment(5);
			$datax['id_mapeld'] = $this->uri->segment(6);
			$datax['abaikan'] = $this->uri->segment(7);
			$id_mapeldd =$this->input->post('id_mapeldd');
			if(!empty($id_mapeldd))
			{
					$in["id_mapel"]=$this->input->post('id_mapeldd');
					$in["materi1"]=$this->input->post('dmateri1');
					$in["materi2"]=$this->input->post('dmateri2');
					$in["materi3"]=$this->input->post('dmateri3');
					$in["materi4"]=$this->input->post('dmateri4');
					$in["materi5"]=$this->input->post('dmateri5');
					$in["materi6"]=$this->input->post('dmateri6');
					$in["keterampilan1"]=$this->input->post('dketerampilan1');
					$in["keterampilan2"]=$this->input->post('dketerampilan2');
					$in["jenis_deskripsi"]= $this->input->post('djenis_deskripsi');
					$semester = $this->input->post('semester');
					$id_mapel = $this->input->post('id_mapel');
					$id_mapeld = $this->input->post('id_mapeldd');
					$in = hilangkanpetik($in);
					$this->Guru_model->Update_KKM($in);
					$data['sukses'] ='sukses';
					$tahun1 = $this->input->post('tahun1');
					$tahun2 = $tahun1+1;
					$data['thnajaran']= $tahun1.'/'.$tahun2;
					$datax['semester'] = $semester;
					$datax['id_mapel'] = $id_mapel;
					$datax['id_mapeld'] = $this->input->post('id_mapeldd');

			}
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/salin_deskripsi',$datax);
			$this->load->view('shared/bawah');
	}
	function rph()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Rencana Harian';
		$tahun1 = $this->uri->segment(3);
		$semester = $this->uri->segment(4);
		if(empty($tahun1))
		{
			$tahun1 = substr(cari_thnajaran(),0,4);
		}
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$kodeguru = $data["nim"];
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->library('Pagination');	
		$page=$this->uri->segment(5);
		$id_rph=$this->uri->segment(6);
      		$limit_ti=10;
		if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
		$query=$this->Guru_model->Tampil_Bph2_Guru($thnajaran,$semester,$kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Bph2_Guru($thnajaran,$semester,$kodeguru);
      		$config['base_url'] = base_url() . 'guru/rph/'.$tahun1.'/'.$semester;
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data["query"]=$query;
		$data["paginator"]=$paginator;
		$data["page"]=$page;
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/rph2',$data);
		$this->load->view('shared/bawah');
	}
	function rphlain2()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Rencana Harian';
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['id_hari_tatap_muka']=$this->input->post('id_hari_tatap_muka');
		$data['ditandatangani']=$this->input->post('ditandatangani');
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$data['tanggalrph'] = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');
		$data['tekseditor'] = '';	
		if ($diproses == 'oke')
			{
			$data['tanggalrphe'] = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bph_lain_edit2',$data);
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rph_lain2',$data);
			}
			$this->load->view('shared/bawah');
	}
	function tambahrphlain2()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Rencana Harian';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$in=array();
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$id_mapel=$this->input->post('id_mapel');
		$kode_rpp=$this->input->post('kode_rpp');
		$id_rph = $this->input->post('id_rph');
		$tanggalrph = $this->input->post('tanggalrph');
		$tanggalhadir2 =$this->input->post('tanggalhadir2');
		$bulanhadir2 =$this->input->post('bulanhadir2');
		$tahunhadir2 =$this->input->post('tahunhadir2');
		$jamke =$this->input->post('jam_ke');
		$tanggalbph = "$tahunhadir2-$bulanhadir2-$tanggalhadir2";
		$lab = $this->input->post('lab');
		$alat_dan_bahan = $this->input->post('alat_dan_bahan');
		if ((!empty($thnajaran)) and(!empty($semester)) and (!empty($id_mapel)) and (!empty($tanggalrph))) 
				{
				$kode_rpp = $this->input->post('kode_rpp');
				$mapel = id_mapel_jadi_mapel($id_mapel);
				$kelas = id_mapel_jadi_kelas($id_mapel);
				$sudahada = $this->Guru_model->Cek_Rph2($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke);
				$in['thnajaran']=$this->input->post('thnajaran');
				$in['semester']=$this->input->post('semester');
				$in['kodeguru']=$this->input->post('kodeguru');
				$in['kode_rpp']=$kode_rpp;
				$in['hambatan_siswa']=$this->input->post('hambatan_siswa');
				$in['keterangan']=$this->input->post('keterangan');
				$in['tanggal']=$tanggalrph;
				$in['tanggal_bph']=$tanggalbph;
				$in['mapel'] = $mapel;
				$in['kelas'] = $kelas;
				$in['jamke'] =$this->input->post('jam_ke');
				$in['lab'] = $lab;
				$in['alat_dan_bahan'] = $alat_dan_bahan;
				if ($sudahada==0)
					{
					$in = hilangkanpetik($in);
					$this->Guru_model->Tambah_Rph2($in);
					}
					else
					{
					$in['id_rph']=$id_rph;
					$in = hilangkanpetik($in);
					$this->Guru_model->Update_Rph2($in);
					}
						$this->load->view('guru/bg_atas',$data);
				$datax['thnajaran'] = $thnajaran;
				$datax['semester'] = $semester;
				$datax['kelas'] = $kelas;
				$datax['kodeguru'] = $kodeguru;
				$datax['mapel'] = $mapel;
				$datax['tanggalrph'] = $tanggalrph;
				$this->load->view('guru/rph_lihat2',$datax);
				$this->load->view('shared/bawah');
				}
				else
				{
				$data['kodeguru'] = $kodeguru;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/rph_lain2',$data);
				$this->load->view('shared/bawah');
				}
	}
	function ubahrph()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah RPH';
		$data['tekseditor'] = '';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data['tahun1'] = $this->uri->segment(4);
		$data['semester'] = $this->uri->segment(5);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$trph = $this->Guru_model->Id_Rph2($id,$kodeguru);
		$data['id_rph']=$id;
		$data["kodeguru"]=$kodeguru;
		$ada = $trph->num_rows();
		if ($ada>0)
			{
			$data['thnajaranx'] = cari_thnajaran();
       			
			$this->load->view('guru/bg_atas',$data);
			if((!empty($data['tahun1'])) and (!empty($data['semester'])))
				{
				$this->load->view('guru/rph_edit_ganti_tahun2',$data);
				}
				else
				{
				$this->load->view('guru/rph_edit2',$data);
				}
			$this->load->view('shared/bawah');
			}
			else
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rph'>";
			}
	}
	function hapusrph2()
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
			$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($nim);	
			$this->Guru_model->Delete_Rph2($id,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rph'>";
	}
	function tambahrph()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
	   	
				$this->load->model('Guru_model');
			$in=array();
				$data["thnajaranx"] = cari_thnajaran();
			$data["semesterx"] = cari_semester();
			$data['thnajaran']=$this->input->post('thnajaran');
			$data['semester']=$this->input->post('semester');
			$data['id_mapel']=$this->input->post('id_mapel');
			$kodeguru=$this->input->post('kodeguru');
			$data["kodeguru"] = $data["nim"];	
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$thnajaran=$this->input->post('thnajaran');
			$semester=$this->input->post('semester');
			$id_rph = $this->input->post('id_rph');
			$id_kd = $this->input->post('id_kd');
				$tanggalhadir =$this->input->post('tanggalhadir');
				$bulanhadir =$this->input->post('bulanhadir');
				$tahunhadir =$this->input->post('tahunhadir');
				$tanggalrph = "$tahunhadir-$bulanhadir-$tanggalhadir";
				$tanggalhadir2 =$this->input->post('tanggalhadir2');
				$bulanhadir2 =$this->input->post('bulanhadir2');
				$tahunhadir2 =$this->input->post('tahunhadir2');
				$tanggalbph = "$tahunhadir2-$bulanhadir2-$tanggalhadir2";
				$lab = $this->input->post('lab');
				$alat_dan_bahan = $this->input->post('alat_dan_bahan');
			if ((!empty($thnajaran)) and(!empty($semester)) and (!empty($data['id_mapel'])) and (!empty($tanggalrph))) 
				{
				$sk = $this->input->post('sk');
				$kd = $this->input->post('kd');
				$mapel = id_mapel_jadi_mapel($data['id_mapel']);
				$kelas = id_mapel_jadi_kelas($data['id_mapel']);
				$jamke=$this->input->post('jamke');
				$sudahada = $this->Guru_model->Cek_Rph2($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke);				$in['thnajaran']=$this->input->post('thnajaran');
				$in['semester']=$this->input->post('semester');
				$in['kodeguru']=$this->input->post('kodeguru');
				$in['kode_rpp']=$this->input->post('kode_rpp');
				$in['jamke']=$this->input->post('jamke');
				$in['hambatan_siswa']=$this->input->post('hambatan_siswa');
				$in['solusi']=$this->input->post('solusi');
				$in['keterangan']=$this->input->post('keterangan');
				$in['tanggal']=$tanggalrph;
				$in['tanggal_bph']=$tanggalbph;
				$in['mapel'] = $mapel;
				$in['kelas'] = $kelas;
				$in['lab'] = $lab;
				$in['alat_dan_bahan'] = $alat_dan_bahan;
				if ($sudahada==0)
					{
					$in = hilangkanpetik($in);
					$this->Guru_model->Tambah_Rph2($in);
					}
					else
					{
					$in['id_rph']=$id_rph;
					$in = hilangkanpetik($in);
					$this->Guru_model->Update_Rph2($in);
					}
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rph'>";
				}
				else
				{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/rph'>";				}

	}
	function rphtanggal2()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Rencana / Pelaksanaan Harian PAda Tanggal Tertentu';
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$data['tanggalrph'] = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');
		if ($diproses == 'oke')
		{
			$data['tanggalrphe'] = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rph_tanggal_tampil2',$data);
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/rph_tanggal2',$data);
		}
		$this->load->view('shared/bawah');
	}
	function bpu()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Buku Pengembalian Ulangan';
		$this->load->model('Guru_model');
		$data_isi['id_mapel'] = $this->uri->segment(3);
		$data_isi['ulangan'] = $this->uri->segment(4);
		$data_isi['kodeguru'] = $data["nim"];
		$this->load->model('Referensi_model','ref');
		$data['baris1'] = $this->ref->ambil_nilai('baris1');
		$data['baris2'] = $this->ref->ambil_nilai('baris2');
		$data['baris3'] = $this->ref->ambil_nilai('baris3');
		$data['baris4'] = $this->ref->ambil_nilai('baris4');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
		$data['plt'] = $this->ref->ambil_nilai('plt');
		$this->load->view('shared/bg_atas_cetak',$data);
		$this->load->view('guru/bpu_versi_2',$data_isi);
	}
	function siswaabsen($nis=null)
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');
		$kode_membolos = $this->ref->ambil_nilai('kode_membolos');
		$kode_terlambat = $this->ref->ambil_nilai('kode_terlambat');
		$kode_tanpa_keterangan = $this->ref->ambil_nilai('kode_tanpa_keterangan');
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Pencatatan Ketidakhadiran Siswa';
		$data["thnajaran"]= cari_thnajaran();
		$data["semester"]= cari_semester();
		if(empty($nis))
		{
			redirect('guru/carisiswa');
		}
		$data['nis'] = $nis;
		$pesan = '';
		$data['nama_siswa']=$this->input->post('nama_siswa');
		$alasan=$this->input->post('alasan');
		$keterangan=$this->input->post('keterangan');
		$tanggalabsen = tanggal_indonesia_ke_barat($this->input->post('tanggaltidakmasuk'));
		$this->load->model('Bp_model');
		$tdatsis = $this->Bp_model->Detil_Siswa_Aktif($nis);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$namaguru = $this->session->userdata('nama');
		if ((!empty($nis)) and (!empty($alasan)) and (!empty($tanggalabsen)))
		{
			$in=array();
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$in["thnajaran"] = $thnajaran;
			$in["semester"] = $semester;
			$in["nis"] = $nis;
			$in["tanggalabsen"] = $tanggalabsen;
			$in["alasan"] = $alasan;
			$in["keterangan"] = $keterangan;
			$in["kode_guru"] = $kodeguru;
			$param=array();
			$query = $this->Bp_model->Cek_Data_Absensi_Siswa($nis,$tanggalabsen);
			$ada = $query->num_rows();
			$this->Bp_model->Simpan_Data_Absensi_Siswa($in,$ada);
			$poin = 0;
			$this->load->helper('telegram');
			if($ada == 0)
			{
				if ($alasan=='S')
				{
					$pesan = nis_ke_nama($nis).' '.$kelas.' tidak masuk karena sakit pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namaguru;
					if(!empty($chat_id_grup_guru))
					{
						$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
					}
				}
				if ($alasan=='I')
				{
					$pesan = nis_ke_nama($nis).' '.$kelas.' izin tidak masuk pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namaguru;
					if(!empty($chat_id_grup_guru))
					{
						$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
					}
				}
				if (($alasan=='A') or ($alasan=='T') or ($alasan=='B'))
				{
					if ($alasan=='T')
					{
						$kode = $kode_terlambat;
						$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
						$pesan = nis_ke_nama($nis).' '.$kelas.' terlambat pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namaguru;
					}
					if ($alasan=='A')
					{
						$kode = $kode_tanpa_keterangan;
						$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
						$pesan = nis_ke_nama($nis).' '.$kelas.' tidak masuk tanpa keterangan pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namaguru;
					}
					if ($alasan=='B')
					{
						$kode = $kode_membolos;
						$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
						$pesan = nis_ke_nama($nis).' '.$kelas.' membolos pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namaguru;
					}
					$poin = 0;
					foreach($querypoin->result() as $dpoin)
					{
						$poin = $dpoin->point;
					}
					$param["thnajaran"] = $thnajaran;
					$param["semester"] = $semester;
					$param["nis"] = $nis;
					$param["tanggal"] = $tanggalabsen;
					$param["kd_pelanggaran"] = $kode;
					$param["kodeguru"] = $kodeguru;
					$param["point"] = $poin;
					$tkredit= $this->Bp_model->Cek_Kredit($nis,$kode,$tanggalabsen);
					$cacah = $tkredit->num_rows();
					$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
					if ($cacah==0)
					{
						$this->Bp_model->Simpan_Kredit($param);
						//ke wali kelas
						$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
						$kodewalikelas = '';
						foreach($twalikelas->result() as $dwalikelas)
						{
							$kodewalikelas = $dwalikelas->kodeguru;
						}
						$id_sms_user = '';
						$ponselwali ='';
						$chat_id_walikelas = '';
						if(!empty($kodewalikelas))
						{
							$ponselwali = cari_seluler_pegawai($kodewalikelas);
							$chat_id_walikelas = cari_chat_id_pegawai($kodewalikelas);
						}
						if(!empty($chat_id_grup_guru))
						{
							$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
						}
						if(!empty($chat_id_walikelas))
						{
							$kirimpesan = kirimtelegram($chat_id_walikelas,$pesan,$token_bot);
						}
						elseif(!empty($ponselwali))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselwali','$pesan','$id_sms_user')");
						}
						else
						{
						}
						//orang tua
						$tortu = $this->db->query("select `nis`,`tayah`,`tibu`,`twali`,`hp`, `chat_id` from `datsis` where `nis`='$nis'");
						$tayah = '';
						$tibu = '';
						$twali = '';
						foreach($tortu->result() as $dortu)
						{
							$tayah = $dortu->tayah;
							$tibu = $dortu->tibu;
							$twali = $dortu->twali;
							$ponselsiswa = $dortu->hp;
							$chat_id_siswa = $dortu->chat_id;
						}
						$ortu = 0;
						if(!empty($chat_id_siswa))
						{
							$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
							$kirimpesan = kirimtelegram($chat_id_siswa,$pesansiswa,$token_bot);
						}
						elseif(!empty($ponselsiswa))
						{
							if($ponselsiswa == $tayah)
							{
								$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
								$ortu = 1;
							}
							else
							{
								$pesansiswa = 'Ananda '.$pesan;
							}
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselsiswa','$pesansiswa','$id_sms_user')");

						}
						else
						{}
						$pesan = 'Assalamu alaikum, wr.wb. '.$pesan;
						if((!empty($tayah)) and ($ortu==0))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tayah','$pesan','$id_sms_user')");
							$ortu = 1;
						}
						if((!empty($tibu)) and ($ortu==0))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tibu','$pesan','$id_sms_user')");
							$ortu = 1;
						}
						if(!empty($twali))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$twali','$pesan','$id_sms_user')");
						}
					}
				}
			}
			$data['nis'] = $nis;
			if ($ada>0)
			{
				$pesan = '<div class="alert alert-info">Ketidakhadiran '.date_to_long_string($tanggalabsen).' ini sudah dicatat!</div>';
			}
		}
		$data['pesan'] = $pesan;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/absensi',$data);
		$this->load->view('shared/bawah');

	}
	function siswakredit()
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');

		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$pesan2 = '';
		$data["nim"]=$this->session->userdata('username');
		$namaguru = $this->session->userdata('nama');
		$data['judulhalaman'] = 'Pencatatan Pelanggaran Siswa';	
		$data["thnajaran"]=$thnajaran;
		$data["semester"]=$semester;
		$nise=$this->uri->segment(3);
		if(empty($nise))
		{
			redirect('guru/carisiswa/siswakredit');
		}
		$nis = $nise;
		$tanggaltidakmasuk = $this->input->post('tanggaltidakmasuk');
		$kd_pelanggaran=$this->input->post('kd_pelanggaran');
		$tanggalabsen = tanggal_indonesia_ke_barat($tanggaltidakmasuk);
		$kunci=nopetik($this->input->post('nama'));
		$this->load->model('Bp_model');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tpkredit =$this->Bp_model->Cari_Point_Kredit($kd_pelanggaran);
		$poin=0;
		foreach($tpkredit->result() as $dpoint)
		{
			$poin=$dpoint->point;
		}
	
		if ((!empty($nis)) and (!empty($kd_pelanggaran)) and (!empty($tanggalabsen)))
		{
			$param=array();
			$param["thnajaran"] = $thnajaran;
			$param["semester"] = $semester;
			$param["nis"] = $nis;
			$param["tanggal"] = $tanggalabsen;
			$param["kd_pelanggaran"] = $kd_pelanggaran;
			$param["kodeguru"] = $kodeguru;
			$param["point"] = $poin;
			$tkredit= $this->Bp_model-> Cek_Kredit($nis,$kd_pelanggaran,$tanggalabsen);
			$cacah = $tkredit->num_rows();
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$tkred = $this->db->query("select * from m_kredit where kode = '$kd_pelanggaran'");
			$namapelanggaran ='';
			foreach($tkred->result() as $dkred)
			{
				$namapelanggaran = $dkred->nama_pelanggaran;
			}
			if ($cacah==0)
			{
				$this->Bp_model->Simpan_Kredit($param);
				$pesan = nis_ke_nama($nis).' melanggar tata tertib sekolah yakni '.$namapelanggaran.' pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namaguru;
				$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
				$kodewalikelas = '';
				foreach($twalikelas->result() as $dwalikelas)
				{
					$kodewalikelas = $dwalikelas->kodeguru;
				}
				$id_sms_user = '';
				$ponselwali ='';
				$chat_id_walikelas = '';
				if(!empty($kodewalikelas))
				{
					$ponselwali = cari_seluler_pegawai($kodewalikelas);
					$chat_id_walikelas = cari_chat_id_pegawai($kodewalikelas);
				}
				$this->load->helper('telegram');
				if(!empty($chat_id_grup_guru))
				{
					$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
				}
				if(!empty($chat_id_walikelas))
				{
					$kirimpesan = kirimtelegram($chat_id_walikelas,$pesan,$token_bot);
				}
				elseif(!empty($ponselwali))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselwali','$pesan','$id_sms_user')");
				}
				else
				{
				}
				//orang tua
				$tortu = $this->db->query("select `nis`,`tayah`,`tibu`,`twali`,`hp`, `chat_id` from `datsis` where `nis`='$nis'");
				$tayah = '';
				$tibu = '';
				$twali = '';
				foreach($tortu->result() as $dortu)
				{
					$tayah = $dortu->tayah;
					$tibu = $dortu->tibu;
					$twali = $dortu->twali;
					$ponselsiswa = $dortu->hp;
					$chat_id_siswa = $dortu->chat_id;
				}
				$ortu = 0;
				if(!empty($chat_id_siswa))
				{
					$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
					$kirimpesan = kirimtelegram($chat_id_siswa,$pesansiswa,$token_bot);
				}
				elseif(!empty($ponselsiswa))
				{
					if($ponselsiswa == $tayah)
					{
						$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
						$ortu = 1;
					}
					else
					{
						$pesansiswa = 'Ananda '.$pesan;
					}
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselsiswa','$pesansiswa','$id_sms_user')");

				}
				else
				{}
				$pesan = 'Assalamu alaikum, wr.wb. '.$pesan;
				if((!empty($tayah)) and ($ortu==0))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tayah','$pesan','$id_sms_user')");
					$ortu = 1;
				}
				if((!empty($tibu)) and ($ortu==0))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tibu','$pesan','$id_sms_user')");
					$ortu = 1;
				}
				if(!empty($twali))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$twali','$pesan','$id_sms_user')");
				}
			}
			if ($cacah>0)
			{
				$pesan2 = '<div class="alert alert-warning">Pelanggaran '.$namapelanggaran.' '.date_to_long_string($tanggalabsen).' ini sudah dicatat!</div>';
			}
		}
		$data['nis'] = $nis;
		$data['pesan'] = $pesan2;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/kredit',$data);
		$this->load->view('shared/bawah');
	}
	function mencetakperangkat($noyangdicetak=null,$tahun1=null,$semester=null,$ditandatangani=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Pencetakan Perangkat';	
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['noyangdicetak'] = $noyangdicetak;
		$data['kodeguru'] = $kodeguru;
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$data['ditandatangani']= $ditandatangani;
		$data['thnajaran'] = '';
		$tahun2 = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1+1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;
		}
		if($noyangdicetak=='1')
		{
			$data['yangdicetak'] = 'Agenda Harian Tugas Tambahan';
		}
		if($noyangdicetak=='2')
		{
			$data['yangdicetak'] = 'Blanko Nilai';
		}
		if($noyangdicetak=='3')
		{
			$data['yangdicetak'] = 'Buku Analisis Pelaksanaan Kegiatan Tugas Tambahan';
		}
		if($noyangdicetak=='4')
		{
			$data['yangdicetak'] = 'Buku Informasi Penilaian';
		}
		if($noyangdicetak=='5')
		{
			$data['yangdicetak'] = 'Buku Kegiatan Laboratorium';
		}
		if($noyangdicetak=='36')
		{
			$data['yangdicetak'] = 'Buku Kegiatan Laboratorium Versi 2';
		}
		if($noyangdicetak=='6')
		{
			$data['yangdicetak'] = 'Buku Laporan Pelaksanaan Kegiatan Tugas Tambahan';
		}
		if($noyangdicetak=='7')
		{
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian';
		}
		if($noyangdicetak=='35')
		{
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian Versi 2';
		}
		if($noyangdicetak=='8')
		{
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian Per Tanggal';
		}
		if($noyangdicetak=='9')
		{
			$data['yangdicetak'] = 'Buku Pelaksanaan Kegiatan Tugas Tambahan';
		}
		if($noyangdicetak=='10')
		{
			$data['yangdicetak'] = 'Buku Pengembalian Ulangan';
		}
		if($noyangdicetak=='11')
		{
			$data['yangdicetak'] = 'Buku Tindak Lanjut Pelaksanaan Kegiatan Tugas Tambahan';
		}
		if($noyangdicetak=='12')
		{
			$data['yangdicetak'] = 'Buku Tugas';
		}
		if($noyangdicetak=='34')
		{
			$data['yangdicetak'] = 'Buku Tugas Versi 2';
		}
		if($noyangdicetak=='13')
		{
			$data['yangdicetak'] = 'Catatan Hambatan Belajar Siswa';
		}
		if($noyangdicetak=='37')
		{
			$data['yangdicetak'] = 'Catatan Hambatan Belajar Siswa Versi 2';
		}
		if($noyangdicetak=='14')
		{
			$data['yangdicetak'] = 'Daftar Buku Pegangan';
		}
		if($noyangdicetak=='15')
		{
			$data['yangdicetak'] = 'Daftar Hadir Siswa';
		}
		if($noyangdicetak=='38')
		{
			$data['yangdicetak'] = 'Daftar Hadir Siswa Versi 2';
		}
		if($noyangdicetak=='16')
		{
			$data['yangdicetak'] = 'Daftar Nilai Afektif';
		}
		if($noyangdicetak=='17')
		{
			$data['yangdicetak'] = 'Daftar Nilai Akhlak / Sikap Spiritual dan Sosial';
		}
		if($noyangdicetak=='18')
		{
			$data['yangdicetak'] = 'Daftar Nilai Kognitif';
		}
		if($noyangdicetak=='19')
		{
			$data['yangdicetak'] = 'Daftar Nilai Psikomotor';
		}
		if($noyangdicetak=='20')
		{
			$data['yangdicetak'] = 'Deskripsi Laporan Capaian Kompetensi';
		}
		if($noyangdicetak=='32')
		{
			$data['yangdicetak'] = 'Deskripsi Sikap Spiritual dan Sosial Antarmata Pelajaran';
		}
		if($noyangdicetak=='21')
		{
			$data['yangdicetak'] = 'Hambatan Belajar Siswa';
		}
		if($noyangdicetak=='22')
		{
			$data['yangdicetak'] = 'Jurnal Piket';
		}
		if($noyangdicetak=='39')
		{
			$data['yangdicetak'] = 'Jurnal Penilaian Sikap Sosial dan Sikap Spiritual';
		}
		if($noyangdicetak=='23')
		{
			$data['yangdicetak'] = 'Laporan Capaian Kompetensi';
		}
		if($noyangdicetak=='24')
		{
			$data['yangdicetak'] = 'Laporan Hasil Belajar';
		}
		if($noyangdicetak=='31')
		{
			$data['yangdicetak'] = 'Penilaian Diri Antarteman Siswa';
		}
		if($noyangdicetak=='30')
		{
			$data['yangdicetak'] = 'Penilaian Diri Siswa';
		}
		if($noyangdicetak=='25')
		{
			$data['yangdicetak'] = 'Penilaian Kinerja Guru';
		}
		if($noyangdicetak=='26')
		{
			$data['yangdicetak'] = 'Program Kerja Tugas Tambahan';
		}
		if($noyangdicetak=='27')
		{
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian';
		}
		if($noyangdicetak=='28')
		{
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian Per Tanggal';
		}
		if($noyangdicetak=='29')
		{
			$data['yangdicetak'] = 'Rencana Pelaksanaan Pembelajaran';
		}
		if($noyangdicetak=='33')
		{
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian Versi Ringkas';
		}
		$data['noyangdicetak'] = $noyangdicetak;
		if(($noyangdicetak=='33') and (!empty($tahun1)) and (!empty($semester)) and (!empty($ditandatangani)))
		{
			$data['judulhalaman'] = 'Rencana Pelaksanaan Harian Versi Ringkas '.$data["nim"];			
			$this->load->view('shared/bg_atas_cetak_landscape',$data);
			$this->load->view('guru/mencetak_rph_ringkas',$data);
		}
		elseif(($noyangdicetak=='13') and (!empty($tahun1)) and (!empty($semester)) and (!empty($ditandatangani)))
		{
				$data['judulhalaman'] = 'Catatan Hambatan Belajar Siswa '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_catatan_hambatan',$data);
		}
		elseif(($noyangdicetak=='37') and (!empty($tahun1)) and (!empty($semester)) and (!empty($ditandatangani)))
		{
			$data['judulhalaman'] = 'Catatan Hambatan Belajar Siswa Versi 2 '.$data["nim"];
			$this->load->view('shared/bg_atas_cetak_landscape',$data);
			$this->load->view('guru/mencetak_catatan_hambatan_versi_2',$data);
		}

		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('gurubaru/form_mencetak',$data);
			$this->load->view('shared/bawah');
		}

	}
	function ubahnilaiakhlakwk()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah Nilai';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		if ($this->uri->segment(4) === FALSE)
		{
    			$itemnilai='';
		}
		else
		{
    			$itemnilai = $this->uri->segment(4);
		}
			
		$this->load->model('Guru_model');
		$kodeguru = '00';	
		$data['kodeguru']=$kodeguru;
		$data['id_walikelas'] = $id;
		$data['itemnilai'] = $itemnilai;
		$data['query']=$this->Guru_model->Tampil_Satu_Nilai_Akhlak_Siswa($itemnilai,$kodeguru);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_akhlak_edit_wk_2015',$data);
		$this->load->view('shared/bawah');
	}
	function tanggapanwalikelas()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Tanggapan Walikelas';
		$kelas='';
		$thnajaran='';
		$id_walikelas='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_walikelas='';
		}
		else
		{
    			$id_walikelas = $this->uri->segment(3);
		}
		$data['aksi'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
		foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_walikelas']=$id_walikelas;
		$data['daftar_siswa']=$this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		if ($ada==0)
			{
			redirect('guru/walikelas');
			}
			else
			{
				$cacahsiswa = $this->input->post('cacahsiswa');
				if($cacahsiswa>0)
				{
					for($i=1;$i<=$cacahsiswa;$i++)
					{
						$id_kepribadian = hilangkanpetik(strip_tags($this->input->post("id_kepribadian_$i")));
						$wali = hilangkanpetik(strip_tags($this->input->post("tanggapan_$i")));
						$this->Guru_model->Simpan_Tanggapan_Wali($id_kepribadian,$wali);
					}
				}
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/tanggapan_walikelas',$data);
			$this->load->view('shared/bawah');
			}
	}
	function jurnalsikap($nis=null,$aksi=null,$id=null)
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Jurnal Sikap Spiritual dan Sosial';	
		$data["thnajaran"]=$thnajaran;
		$data["semester"]=$semester;
		$tanggal = nopetik($this->input->post('tanggal'));
		$jenis = nopetik($this->input->post('jenis'));
		$kejadian = nopetik($this->input->post('kejadian'));
		$butir = nopetik($this->input->post('butir'));
		$tindak_lanjut = nopetik($this->input->post('tindak_lanjut'));
		$tanggal = tanggal_indonesia_ke_barat($tanggal);
		$kunci=nopetik($this->input->post('nama'));
		$this->load->model('Guru_model');
		$this->load->model('Bp_model');
		$kodeguru = $data["nim"];
		$data['nis'] = $nis;
		if($aksi=='hapus')
		{
			$this->db->query("delete from `siswa_kredit` where `id_siswa_kredit`='$id' and `kodeguru`='$kodeguru'");
		}
		if ((!empty($nis)) and (!empty($kejadian)) and (!empty($tanggal)))
		{
			$param=array();
			$jenis = $this->Bp_model->Cari_Jenis_Sikap($butir);
			$param["thnajaran"] = $thnajaran;
			$param["semester"] = $semester;
			$param["nis"] = $nis;
			$param["tanggal"] = $tanggal;
			$param["jenis"] = $jenis;
			$param["kd_pelanggaran"] = 'Z';
			$param["kodeguru"] = $kodeguru;
			$param["tindak_lanjut"] = $tindak_lanjut;
			$param["kejadian"] = $kejadian;
			$param["butir"] = $butir;
			$this->Bp_model->Simpan_Jurnal_Sikap($param);
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/jurnal_sikap',$data);
		$this->load->view('shared/bawah');
	}
	function carisiswa($aksi=null,$tokenmd5=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Pencarian Siswa';
		$this->load->model('Guru_model');
		$data['kodeguru'] = $data["nim"];
		$data['cariotomatis'] = '';
		if(($aksi == 'siswakredit') or ($aksi == 'jurnalsikap'))
		{
			$data['aksi']= $aksi;
		}
		elseif($aksi == 'token')
		{
			$this->Guru_model->Proses_Izin($token);
		}
		else
		{
			$data['aksi']= 'siswaabsen';
		}

		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/cari_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function token()
	{
		$tokenmd5 = $this->uri->segment(3);
		$this->db->query("update `siswa_proses_izin` set `valid`='1' where `tokenmd5`='$tokenmd5'");
		redirect('guru/carisiswa');
	}
	function pending()
	{
		$tokenmd5 = $this->uri->segment(3);
		$this->db->query("update `siswa_proses_izin` set `valid`='0' where `tokenmd5`='$tokenmd5'");
		redirect('guru/carisiswa');
	}
	function hapuskeluarga()
	{
		$nim=$this->session->userdata('username');
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
		$this->Guru_model->Delete_Keluarga($id,$nim);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/keluarga'>";
	}
	function salindeskripsiketerampilan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Salin Jenis Deskripsi / KD Keterampilan';
		$data['sukses'] = '';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax['kodeguru'] = $data["nim"];	
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$thn1=$this->uri->segment(3);
		if($thn1>0)
		{
			$thn2 = $thn1 + 1;
		}
		else
		{
			$thn2 = '';
		}
		$data['thnajaran']= $thn1.'/'.$thn2;
		$thntujuan=$this->uri->segment(6);
		if($thntujuan>0)
		{
			$thntujuan2 = $thntujuan + 1;
		}
		else
		{
			$thntujuan2 = '';
		}
		$data['thnajaran2']= $thntujuan.'/'.$thntujuan2;
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_mapel'] = $this->uri->segment(5);
		$datax['semestertujuan'] = $this->uri->segment(7);
		$datax['id_mapeld'] = $this->uri->segment(8);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/salin_deskripsi_keterampilan',$datax);
		$this->load->view('shared/bawah');
	}
	function updatenilaiharian2($id_mapel=null,$itemnilai=null,$nomor_materi=null,$cacah_siswa=null,$separuh=null)
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$id_mapel = $this->uri->segment(3);
		$itemnilai = $this->uri->segment(4);
		$kkm = $this->input->post('kkm_ulangan');
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$ada = $tmapel->num_rows();
		$materi = '';
		$namaitem = '';
		$jenis_deskripsi = '';
		$jujug = $this->config->item('jujug');
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
				$cacah_tugas = $dtmapel->cacah_tugas;
				$ranah = $dtmapel->ranah;
				$kd_mapel = $dtmapel->no_urut_rapor;
				$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
				$bobot_tugas = $dtmapel->bobot_tugas;
				$bobot_mid = $dtmapel->bobot_mid;
				$bobot_semester = $dtmapel->bobot_semester;
				$cacah_kuis = $dtmapel->nkuis;
				$bobot_kuis = $dtmapel->bobot_kuis;
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
				if($nomor_materi<11)
				{
					$materine = 'materi'.$nomor_materi;
					$materi = $dtmapel->$materine;
				}
			}
			$in2["id_mapel"] = $id_mapel;
			$in2["materi"] = $materi;
			$in2["nomor_materi"] = $nomor_materi;
			if(empty($separuh))
			{
				$this->Guru_model->Hapus_Capaian_Kompetensi($id_mapel,$nomor_materi);
			}
			for($i=1;$i<=$cacah_siswa;$i++)
			{
				$in["kd"]=$this->input->post("kd_$i");
				$in["nilai_uh1"]=$this->input->post("nilai_uh1_$i");
				$in["nilai_uh2"]=$this->input->post("nilai_uh2_$i");
				$in["nilai_uh3"]=$this->input->post("nilai_uh3_$i");
				$in["nilai_uh4"]=$this->input->post("nilai_uh4_$i");
				$in["nilai_uh5"]=$this->input->post("nilai_uh5_$i");
				$in["nilai_uh6"]=$this->input->post("nilai_uh6_$i");
				$in["nilai_uh7"]=$this->input->post("nilai_uh7_$i");
				$in["nilai_uh8"]=$this->input->post("nilai_uh8_$i");
				$in["nilai_uh9"]=$this->input->post("nilai_uh9_$i");
				$in["nilai_uh10"]=$this->input->post("nilai_uh10_$i");
				$in["nilai_tu1"]=$this->input->post("nilai_tu1_$i");
				$in["nilai_tu2"]=$this->input->post("nilai_tu2_$i");
				$in["nilai_tu3"]=$this->input->post("nilai_tu3_$i");
				$in["nilai_tu4"]=$this->input->post("nilai_tu4_$i");
				$in["nilai_tu5"]=$this->input->post("nilai_tu5_$i");
				$in["nilai_tu6"]=$this->input->post("nilai_tu6_$i");
				$in["nilai_tu7"]=$this->input->post("nilai_tu7_$i");
				$in["nilai_tu8"]=$this->input->post("nilai_tu8_$i");
				$in["nilai_tu9"]=$this->input->post("nilai_tu9_$i");
				$in["nilai_tu10"]=$this->input->post("nilai_tu10_$i");
				$in["nilai_mid"]=$this->input->post("nilai_mid_$i");
				$in["nilai_uas"]=$this->input->post("nilai_uas_$i");
				$in["nilai_na"]=$this->input->post("nilai_na_$i");
				$in["nilai_nr"]=$this->input->post("nilai_nr_$i");
				$in["nilai_ku1"]=$this->input->post("nilai_ku1_$i");
				$in["nilai_ku2"]=$this->input->post("nilai_ku2_$i");
				$in["nilai_ku3"]=$this->input->post("nilai_ku3_$i");
				$in["nilai_ku4"]=$this->input->post("nilai_ku4_$i");
				$in["kog"]=$this->input->post("nilai_kog_$i");
				$in["nilai_ruh"]=0;
				$in["nilai_rtu"]=0;
				$in["nilai_rku"]=0;
				$in["nilai_nh"]=0;
//				if($i == 43)
//				{
//					redirect('pindah/'.$i.'/'.$in["nilai_uh1"]);
//				}
				if ($cacah_ulangan_harian>0)
				{
					//$in["nilai_ruh"] =(($in["nilai_uh1"] * $bobot_ulangan_harian1) + ($in["nilai_uh2"] * $bobot_ulangan_harian2) + ($in["nilai_uh3"] * $bobot_ulangan_harian3) + ($in["nilai_uh4"] * $bobot_ulangan_harian4))/$cacah_ulangan_harian;
					$in["nilai_ruh"] =($in["nilai_uh1"] + $in["nilai_uh2"] + $in["nilai_uh3"] + $in["nilai_uh4"] + $in["nilai_uh5"]+ $in["nilai_uh6"]+ $in["nilai_uh7"]+ $in["nilai_uh8"]+ $in["nilai_uh9"]+ $in["nilai_uh10"])/$cacah_ulangan_harian;
				}
				if ($cacah_kuis>0)
				{
					$in["nilai_rku"] = ($in["nilai_ku1"] + $in["nilai_ku2"] + $in["nilai_ku3"] + $in["nilai_ku4"])/$cacah_kuis;
				}
				if ($cacah_tugas>0)
				{
					$in["nilai_rtu"] = ($in["nilai_tu1"] + $in["nilai_tu2"] + $in["nilai_tu3"] + $in["nilai_tu4"]+ $in["nilai_tu5"]+ $in["nilai_tu6"]+ $in["nilai_tu7"]+ $in["nilai_tu8"]+ $in["nilai_tu9"]+ $in["nilai_tu10"])/$cacah_tugas;
				}
				$nilai_na = 0;
				if (($bobot_kuis+$bobot_ulangan_harian+$bobot_tugas+$bobot_mid+$bobot_semester)>0 and ($bobot_kuis+$bobot_ulangan_harian+$bobot_tugas+$bobot_mid+$bobot_semester)<101)
				{
					$nilai_na = (($in["nilai_rku"]*$bobot_kuis)+($in["nilai_ruh"]*$bobot_ulangan_harian) + ($in["nilai_rtu"]*$bobot_tugas) + ($in["nilai_mid"]*$bobot_mid) + ($in["nilai_uas"]*$bobot_semester))/100;
				}
				$nilai_na = round($nilai_na,0);
				if($jujug == 'T')
				{
					$in['kog'] = $nilai_na;
				}
				$in['nilai_na'] = $nilai_na;
				if ($itemnilai=='4')
				{
					$namaitem = 'hasil penilaian tugas 1';
				}
				if ($itemnilai=='5')
				{
					$namaitem = 'hasil penilaian tugas 2';
				}
				if ($itemnilai=='6')
				{
					$namaitem = 'hasil penilaian tugas 3';
				}
				if ($itemnilai=='7')
				{
					$namaitem = 'hasil penilaian tugas 4';
				}
				if ($itemnilai=='14')
				{
					$namaitem = 'hasil penilaian kuis 1';
				}
				if ($itemnilai=='15')
				{
					$namaitem = 'hasil penilaian kuis 2';
				}
				if ($itemnilai=='16')
				{
					$namaitem = 'hasil penilaian kuis 3';
				}
				if ($itemnilai=='17')
				{
					$namaitem = 'hasil penilaian kuis 4';
				}
				if ($itemnilai=='1')
				{
					$nilai = $this->input->post("nilai_uh1_$i");
					$namaitem = 'hasil penilaian harian 1';
				}
				if ($itemnilai=='2')			
				{
					$nilai = $this->input->post("nilai_uh2_$i");
					$namaitem = 'hasil penilaian harian 2';
				}
				if ($itemnilai=='3')
				{
					$nilai = $this->input->post("nilai_uh3_$i");
					$namaitem = 'hasil penilaian harian 3';
				}
				if ($itemnilai=='11')
				{
					$nilai = $this->input->post("nilai_uh4_$i");
					$namaitem = 'hasil penilaian harian 4';
				}
				if ($itemnilai=='18')
				{
					$nilai = $this->input->post("nilai_uh5_$i");
					$namaitem = 'hasil penilaian harian 5';
				}
				if ($itemnilai=='19')
				{
					$nilai = $this->input->post("nilai_uh6_$i");
					$namaitem = 'hasil penilaian harian 6';
				}
				if ($itemnilai=='20')
				{
					$nilai = $this->input->post("nilai_uh7_$i");
					$namaitem = 'hasil penilaian harian 7';
				}
				if ($itemnilai=='21')
				{
					$nilai = $this->input->post("nilai_uh8_$i");
					$namaitem = 'hasil penilaian harian 8';
				}
				if ($itemnilai=='22')
				{
					$nilai = $this->input->post("nilai_uh9_$i");
					$namaitem = 'hasil penilaian harian 9';
				}
				if ($itemnilai=='23')
				{
					$nilai = $this->input->post("nilai_uh10_$i");
					$namaitem = 'hasil penilaian harian 10';
				}
				if ($itemnilai=='7')
				{
					$nilai = $this->input->post("nilai_midf_$i");
					$namaitem = 'hasil penilaian tengah semester';
				}
				if ($itemnilai=='8')
				{
					$nilai = $this->input->post("nilai_uas_$i");
					if($semester == 1)
					{
						$namaitem = 'hasil penilaian akhir semester';
					}
					else
					{
						$namaitem = 'hasil penilaian akhir tahun';
					}
				}
				if((!empty($materi)) and (!empty($nomor_materi)))
				{ 
					if (($itemnilai==1) or ($itemnilai==2) or ($itemnilai==3) or ($itemnilai==11) or ($itemnilai==7) or ($itemnilai==8) or ($itemnilai==18) or ($itemnilai==19) or ($itemnilai==20) or ($itemnilai==21) or ($itemnilai==22) or ($itemnilai==23))
					{
						if($nilai < $kkm)
						{
							$in2["positif"] = 0;
						}
						else
						{
							$in2["positif"] = 1;
						}
						if($jenis_deskripsi == 1)
						{
							$in2["ket"] = deskripsi_nilai($nilai);
						}
						if($jenis_deskripsi == 6)
						{
							$in2["ket"] = deskripsi_nilai_2018($nilai,$kkm);
						}
						if (($jenis_deskripsi == 1) or ($jenis_deskripsi == 6))
						{
							$in2["nis"]=$this->input->post("nis_$i");
							$this->Guru_model->Simpan_Capaian_Kompetensi($in2);
						}
					}
				}
				$this->Guru_model->Update_Nilai($in);
			}

				$nip=$this->Guru_model->get_NIP($data["nim"]);
				$kegiatanharian = 'menilai dan mengevaluasi proses dan hasil belajar mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
				$tahun = tahunsaja(tanggal_hari_ini());
				$tanggalhariini = tanggal_hari_ini();
				$jam = jam_saja();
				$menit = menit_saja();
				$this->db->query("update `sieka_harian` set `jam_selesai` = '$jam', `menit_selesai`='$menit' where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatanharian' and `tanggal`='$tanggalhariini'");

			if(empty($separuh))
			{
				redirect('guru/nilaiharian/'.$id_mapel.'/'.$itemnilai.'/1');
			}
			else
			{
				if($itemnilai == 13)
				{
					redirect('guru/statusketuntasan/'.$id_mapel);
				}
				else
				{
/*
				$this->load->helper('telegram');
				$chat_id = $this->config->item('chat_id_grup_siswa');
				$pesanguru = $data['nama'].' memperbarui '.$namaitem.' mapel '.$mapel.' Kelas '.$kelas;
				if(!empty($chat_id))
				{
					$kirimpesan = kirimtelegram($chat_id,$pesanguru,$token_bot);
				}
*/
				redirect('guru/daftarnilai/'.$id_mapel);
				}
			}
		} //akhir kalau ada
		else
		{
			echo 'galat, data tidak ditemukan';
		}
	}
	function rapor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$datax['semester']= $this->uri->segment(4);
		$tahun1 = $this->uri->segment(3);
		$tahun2 = $tahun1 + 1;
		$datax['thnajaran']= $tahun1.'/'.$tahun2;
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['nis']= $this->uri->segment(5);
		$datax['status_nilai']= $this->uri->segment(6);
		$kurikulum= $this->uri->segment(7);
		$datax['tautan']= 'guru';
		$datax['siswa'] = 'bukan';
		$namasiswa = berkas(nis_ke_nama($datax['nis']));
		$this->load->model('Referensi_model','ref');
		$datax['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$datax['lokasi'] = $this->ref->ambil_nilai('lokasi');
		$datax['plt'] = $this->ref->ambil_nilai('plt');
		$datax['sek_tipe'] = $this->ref->ambil_nilai('sek_tipe');
		$datax['sek_alamat'] = $this->ref->ambil_nilai('sek_alamat');
		$datax['tanda_tangan'] = $this->ref->ambil_nilai('tanda_tangan');
		$datax['fontsize'] = $this->ref->ambil_nilai('fontsize_rapor');
		$datax['judulhalaman'] = 'Rapor_'.$namasiswa.'_'.$tahun1.'_'.$tahun2.'_semester_'.$datax['semester'];
		if($kurikulum == '2018')
		{
			$this->load->view('shared/buku_rapor_html_2018',$datax);
		}
		elseif($kurikulum == '2015')
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
	function nilaipersiswa($nomor_urut=null,$id_mapel=null,$aksi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$kd = $this->session->userdata('username');
		$this->load->model('Guru_model','guru');
		$tmapel = $this->guru->Id_Mapel($id_mapel,$kd);
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			$data["kodeguru"] = $this->session->userdata('username');	
			$data['id_mapel'] = $id_mapel;
			$data['judulhalaman'] = 'Nilai Per Siswa';
			$data['nomor_urut'] = $nomor_urut;
			$data['aksi'] = $aksi;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/nilai_per_siswa',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}

	function updatenilaipersiswa($nomor_urut=null,$id_mapel=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		if ($tmapel->num_rows() >0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
				$cacah_tugas = $dtmapel->cacah_tugas;
				$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
				$bobot_tugas = $dtmapel->bobot_tugas;
				$bobot_mid = $dtmapel->bobot_mid;
				$bobot_semester = $dtmapel->bobot_semester;
				$cacah_kuis = $dtmapel->nkuis;
				$bobot_kuis = $dtmapel->bobot_kuis;
				$pilihan = $dtmapel->pilihan;
			}
			$in["kd"]=$this->input->post("kd");
			$nilai_uh1=$this->input->post("uh1");
			$nilai_uh2=$this->input->post("uh2");
			$nilai_uh3=$this->input->post("uh3");
			$nilai_uh4=$this->input->post("uh4");
			$nilai_uh5=$this->input->post("uh5");
			$nilai_uh6=$this->input->post("uh6");
			$nilai_uh7=$this->input->post("uh7");
			$nilai_uh8=$this->input->post("uh8");
			$nilai_uh9=$this->input->post("uh9");
			$nilai_uh10=$this->input->post("uh10");
			$nilai_tu1=$this->input->post("tu1");
			$nilai_tu2=$this->input->post("tu2");
			$nilai_tu3=$this->input->post("tu3");
			$nilai_tu4=$this->input->post("tu4");
			$nilai_tu5=$this->input->post("tu5");
			$nilai_tu6=$this->input->post("tu6");
			$nilai_tu7=$this->input->post("tu7");
			$nilai_tu8=$this->input->post("tu8");
			$nilai_tu9=$this->input->post("tu9");
			$nilai_tu10=$this->input->post("tu10");
			$nilai_mid=$this->input->post("mid");
			$nilai_uas=$this->input->post("uas");
			$nilai_ku1=$this->input->post("ku1");
			$nilai_ku2=$this->input->post("ku2");
			$nilai_ku3=$this->input->post("ku3");
			$nilai_ku4=$this->input->post("ku4");
			if($cacah_ulangan_harian > 0)
			{
				$ruh = ($nilai_uh1 + $nilai_uh2 + $nilai_uh3 + $nilai_uh4 + $nilai_uh5 + $nilai_uh6 + $nilai_uh7 + $nilai_uh8 + $nilai_uh9 + $nilai_uh10) / $cacah_ulangan_harian;
			}
			else
			{
				$ruh = 0;
			}
			if($cacah_kuis > 0)
			{
				$rku = ($nilai_ku1 + $nilai_ku2 + $nilai_ku3 + $nilai_ku4) / $cacah_kuis;
			}
			else
			{
				$rku = 0;
			}
			if($cacah_tugas > 0)
			{
				$rtu = ($nilai_tu1 + $nilai_tu2 + $nilai_tu3 + $nilai_tu4 + $nilai_tu5 + $nilai_tu6 + $nilai_tu7 + $nilai_tu8 + $nilai_tu9 + $nilai_tu10) / $cacah_tugas;
			}
			else
			{
				$rtu = 0;
			}
			$nilai_rapor = (($bobot_ulangan_harian * $ruh) + ($bobot_kuis * $rku ) + ($bobot_tugas * $rtu ) + ( $bobot_mid * $nilai_mid) + ( $bobot_semester * $nilai_uas)) / 100;
			$in["nilai_uh1"]=$nilai_uh1;
			$in["nilai_uh2"]=$nilai_uh2;
			$in["nilai_uh3"]=$nilai_uh3;
			$in["nilai_uh4"]=$nilai_uh4;
			$in["nilai_uh5"]=$nilai_uh5;
			$in["nilai_uh6"]=$nilai_uh6;
			$in["nilai_uh7"]=$nilai_uh7;
			$in["nilai_uh8"]=$nilai_uh8;
			$in["nilai_uh9"]=$nilai_uh9;
			$in["nilai_uh10"]=$nilai_uh10;
			$in["nilai_tu1"]=$nilai_tu1;
			$in["nilai_tu2"]=$nilai_tu2;
			$in["nilai_tu3"]=$nilai_tu3;
			$in["nilai_tu4"]=$nilai_tu4;
			$in["nilai_tu5"]=$nilai_tu5;
			$in["nilai_tu6"]=$nilai_tu6;
			$in["nilai_tu7"]=$nilai_tu7;
			$in["nilai_tu8"]=$nilai_tu8;
			$in["nilai_tu9"]=$nilai_tu9;
			$in["nilai_tu10"]=$nilai_tu10;

			$in["nilai_mid"]=$nilai_mid;
			$in["nilai_uas"]=$nilai_uas;
			$in["nilai_ku1"]=$nilai_ku1;
			$in["nilai_ku2"]=$nilai_ku2;
			$in["nilai_ku3"]=$nilai_ku3;
			$in["nilai_ku4"]=$nilai_ku4;
			$in["nilai_ruh"]=$ruh;
			$in["nilai_rku"]=$rku;
			$in["nilai_rtu"]=$rtu;
			$in["nilai_na"]=$nilai_rapor;
			if($this->config->item('jujug') == 'Y')
			{
				$in["kog"]=$this->input->post("kog");


			}
			if($this->config->item('jujug') == 'T')
			{
				$in["kog"]=$nilai_rapor;
			}
			if($pilihan == 1)
			{
				$this->Guru_model->Update_Nilai_Pilihan($in);
			}
			else
			{
				$this->Guru_model->Update_Nilai($in);
			}

		}
		redirect('guru/nilaipersiswa/'.$nomor_urut.'/'.$id_mapel);
	
	}
	function statusketuntasan($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Pemutakhiran Ketuntasan Siswa dan Deskripsi Capaian Kompetensi';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->session->userdata('username');	
		$tmapel = $this->guru->Id_Mapel($id_mapel,$kodeguru);
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
				$kkm = $dtmapel->kkm;
				$kelas = $dtmapel->kelas;
				$ranah = $dtmapel->ranah;
				$mapel = $dtmapel->mapel;
				$materi1 = $dtmapel->materi1;
				$materi2 = $dtmapel->materi2;
				$materi3 = $dtmapel->materi3;
				$materi4 = $dtmapel->materi4;
				$materi5 = $dtmapel->materi5;
				$materi6 = $dtmapel->materi6;
				$materi7 = $dtmapel->materi7;
				$materi8 = $dtmapel->materi8;
				$materi9 = $dtmapel->materi9;
				$materi10 = $dtmapel->materi10;
				$batas1 = $dtmapel->batas1;
				$batas2 = $dtmapel->batas2;
				$batas3 = $dtmapel->batas3;
				$batas4 = $dtmapel->batas4;
				$batas5 = $dtmapel->batas5;
				$batas6 = $dtmapel->batas6;
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
			}
			$data['adamenu'] = '';
			$datasiswakelas = $this->guru->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			$data['total_siswa'] = $datasiswakelas->num_rows();
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['ranah'] = $ranah;
			$data['mapel'] = $mapel;
			$data['kkm'] = $kkm;
			$data['id'] = $id;
			$data['id_mapel'] = $id_mapel;
			$data['materi1'] = $materi1;
			$data['materi2'] = $materi2;
			$data['materi3'] = $materi3;
			$data['materi4'] = $materi4;
			$data['materi5'] = $materi5;
			$data['materi6'] = $materi6;
			$data['materi7'] = $materi7;
			$data['materi8'] = $materi8;
			$data['materi9'] = $materi9;
			$data['materi10'] = $materi10;
			$data['batas1'] = $batas1;
			$data['batas2'] = $batas2;
			$data['batas3'] = $batas3;
			$data['batas4'] = $batas4;
			$data['batas5'] = $batas5;
			$data['batas6'] = $batas6;
			$data['jenis_deskripsi'] = $jenis_deskripsi;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/status_ketuntasan_jadi',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function deskripsisikap($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Deskripsi Sikap Siswa';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->session->userdata('username');	
		$tmapel = $this->guru->Id_Mapel($id_mapel,$kodeguru);
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
			}
			$data['adamenu'] = '';
			$datasiswakelas = $this->guru->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			$data['total_siswa'] = $datasiswakelas->num_rows();
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['ranah'] = $ranah;
			$data['mapel'] = $mapel;
			$data['id'] = $id;
			$data['id_mapel'] = $id_mapel;
			$this->load->view('guru/bg_atas_min',$data);
			$this->load->view('guru/deskripsi_sikap',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}
	function deskripsiketerampilan($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Deskripsi Keterampilan';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->session->userdata('username');	
		$tmapel = $this->guru->Id_Mapel($id_mapel,$kodeguru);
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
			}
			$data['adamenu'] = '';
			$datasiswakelas = $this->guru->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			$data['total_siswa'] = $datasiswakelas->num_rows();
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['ranah'] = $ranah;
			$data['mapel'] = $mapel;
			$data['jenis_deskripsi'] = $jenis_deskripsi;
			$data['id'] = $id;
			$data['id_mapel'] = $id_mapel;
			$data['kkm'] = $kkm;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/deskripsi_keterampilan',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}
	function perbaruidaftarsiswaafektif($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman']= 'Memperbarui Daftar Nilai Sikap';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->session->userdata('username');
		$tmapel = $this->guru->Id_Mapel($id_mapel,$kodeguru);
		$data['adamenu'] = '';
		if(empty($id))
		{
			$id = 0;
		}
		if ($tmapel->num_rows() >0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$data['thnajaran'] = $dtmapel->thnajaran;
				$data['semester'] =  $dtmapel->semester;
				$data['kelas'] = $dtmapel->kelas;
				$data['ranah'] = $dtmapel->ranah;
				$data['mapel'] = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester =  $dtmapel->semester;
				$kelas = $dtmapel->kelas;
				$data['id_mapel']=$id_mapel;
				$data['id']=$id;
				$daftar_siswa = $this->guru->Daftar_Siswa($thnajaran,$semester,$kelas);
				$data['total_siswa'] = $daftar_siswa->num_rows();
				$this->load->view('guru/bg_atas_min',$data);
				$this->load->view('guru/daftar_siswa_afektif_baru',$data);
				$this->load->view('shared/bawah');
			}

		}
		else
		{
			echo 'galat';
		}
	}
	function nilaiakhlakk13()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->session->userdata('username');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$ta = $this->db->query("select * from `m_akhlak_2015` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester'");
		foreach($ta->result() as $a)
		{
			$kelas = $a->kelas;
			$tb = $this->db->query("select * from `m_akhlak` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
			if($tb->num_rows() == 0)
			{
				$this->db->query("insert into `m_akhlak` (`kodeguru`,`thnajaran`,`semester`,`kelas`) values ('$kodeguru','$thnajaran','$semester','$kelas')");
			}
			
		}
		redirect('guru/nilaiakhlak');
	}
	function formmencetak()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Pencetakan Perangkat';	
		$noyangdicetak=$this->uri->segment(3);
		$this->load->model('Guru_model');
		$data["kodeguru"] = $data["nim"];	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnpkg']=$this->input->post('thnpkg');
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$this->load->model('Referensi_model','ref');
		$data['baris1'] = $this->ref->ambil_nilai('baris1');
		$data['baris2'] = $this->ref->ambil_nilai('baris2');
		$data['baris3'] = $this->ref->ambil_nilai('baris3');
		$data['baris4'] = $this->ref->ambil_nilai('baris4');
		$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
		$id_mapel=$this->input->post('id_mapel');
		$data['norpp']=$this->input->post('norpp');
		$data['mapel']=$this->input->post('mapel');
		$data['nomoraspek']=$this->input->post('nomoraspek');
		$data['ditandatangani']=$this->input->post('ditandatangani');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$kelas = id_mapel_jadi_kelas($data['id_mapel']);
		$data['kurikulum'] = cari_kurikulum($thnajaran,$semester,$kelas);
		$kodeguru = $data["nim"];
		$data['namatugas'] = cari_tugas_tambahan($thnajaran,$semester,$kodeguru);
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');
		$lab = 	$this->input->post('lab');
		if ($diproses != 'oke') 
			{
			$this->load->view('guru/bg_atas',$data);
		}
		if ($noyangdicetak == 2)
			{
			$data['noyangdicetak'] = 2;
			$data['yangdicetak'] = 'Blanko Nilai';
			$data['judulhalaman'] = 'Mencetak Blanko Nilai';	
			$this->load->view('guru/cetak_blanko_nilai',$data);
			}
		elseif ($noyangdicetak == 25)
			{
			$data['noyangdicetak'] = 25;
			$data['yangdicetak'] = 'Penilaian Kinerja Guru';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Penilaian Kinerja Guru '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_penilaian_kinerja_guru',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Penilaian Kinerja Guru';
				$this->load->view('guru/form_mencetak_penilaian_kinerja_guru',$data);
				}
			}
		elseif ($noyangdicetak == 11)
			{
			$data['noyangdicetak'] = 11;
			$data['yangdicetak'] = 'Buku Tindak Lanjut Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Tindak Lanjut Pelaksanaan Kegiatan Tugas Tambahan '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_tindak_lanjut_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Tindak Lanjut Pelaksanaan Kegiatan Tugas Tambahan';
				$this->load->view('guru/form_mencetak_tindak_lanjut_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 3)
			{
			$data['noyangdicetak'] = 3;
			$data['yangdicetak'] = 'Buku Analisis Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Analisis Pelaksanaan Kegiatan Tugas Tambahan '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_analisis_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Analisis Pelaksanaan Kegiatan Tugas Tambahan';
				$this->load->view('guru/form_mencetak_analisis_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 5)
			{
			$data['noyangdicetak'] = 5;
			$data['yangdicetak'] = 'Buku Kegiatan Laboratorium';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Kegiatan Laboratorium '.$data["nim"];
				$data['lab'] = $lab;
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_buku_kegiatan_laboratorium',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Kegiatan Laboratorium';
				$this->load->view('guru/form_mencetak_buku_kegiatan_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 36)
			{
			$data['noyangdicetak'] = 36;
			$data['yangdicetak'] = 'Buku Kegiatan Laboratorium Versi 2';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Kegiatan Laboratorium Versi 2 '.$data["nim"];
				$data['lab'] = $lab;
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_buku_kegiatan_laboratorium_versi_2',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Kegiatan Laboratorium Versi 2';
				$this->load->view('guru/form_mencetak_buku_kegiatan_laboratorium_versi_2',$data);
				}
			}
		elseif($noyangdicetak == 6)
			{
			$data['noyangdicetak'] = 6;
			$data['yangdicetak'] = 'Buku Laporan Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Laporan Pelaksanaan Kegiatan Tugas Tambahan '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_laporan_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Laporan Pelaksanaan Kegiatan Tugas Tambahan';
				$this->load->view('guru/form_mencetak_laporan_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 9)
			{
			$data['noyangdicetak'] = 9;
			$data['yangdicetak'] = 'Buku Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Pelaksanaan Kegiatan Tugas Tambahan '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Pelaksanaan Kegiatan Tugas Tambahan';
				$this->load->view('guru/form_mencetak_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif($noyangdicetak == 1)
			{
			$data['noyangdicetak'] = 1;
			$data['yangdicetak'] = 'Agenda Harian Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Agenda Harian Tugas Tambahan '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);				
				$this->load->view('guru/mencetak_agenda_harian_kepala_laboratorium',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Agenda Harian Tugas Tambahan';
				$this->load->view('guru/form_mencetak_agenda_harian_kepala_laboratorium',$data);
				}			}		elseif ($noyangdicetak == 26)
			{
			$data['noyangdicetak'] = 26;
			$data['yangdicetak'] = 'Program Kerja Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Program Kerja Tugas Tambahan '.$data["nim"];
				$this->load->view('guru/mencetak_program_kerja_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_program_kerja_kepala_laboratorium',$data);
				}			}
		elseif ($noyangdicetak == 13)
			{
			$data['noyangdicetak'] = 13;
			$data['yangdicetak'] = 'Catatan Hambatan Belajar Siswa';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Catatan Hambatan Belajar Siswa '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_catatan_hambatan',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Catatan Hambatan Belajar Siswa';
				$this->load->view('guru/form_mencetak_catatan_hambatan',$data);
				}			}
		elseif ($noyangdicetak == 37)
			{
			$data['noyangdicetak'] = 37;
			$data['yangdicetak'] = 'Catatan Hambatan Belajar Siswa Versi 2';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Catatan Hambatan Belajar Siswa Versi 2 '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_catatan_hambatan_versi_2',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Catatan Hambatan Belajar Siswa Versi 2';
				$this->load->view('guru/form_mencetak_catatan_hambatan_versi_2',$data);
				}
			}
		elseif ($noyangdicetak == 21)
			{
			$data['noyangdicetak'] = 21;
			$data['yangdicetak'] = 'Hambatan Belajar Siswa';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Hambatan Belajar Siswa '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_hambatan',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_hambatan',$data);
				}			}
		elseif ($noyangdicetak == 23)
			{
			$data['noyangdicetak'] = 23;
			$data['yangdicetak'] = 'Laporan Capaian Kompetensi';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Laporan Capaian Kompetensi '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_lck',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_lck',$data);
				}			}
		elseif ($noyangdicetak == 24)
			{
			$data['noyangdicetak'] = 24;
			$data['yangdicetak'] = 'Laporan Hasil Belajar';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Laporan Hasil Belajar '.$data["nim"];			
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_lhb_mapel',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_lhb_mapel',$data);
				}
			}
		elseif ($noyangdicetak == 20)
			{
			$data['noyangdicetak'] = 20;
			$data['yangdicetak'] = 'Deskripsi Laporan Capaian Kompetensi';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Deskripsi Laporan Capaian Kompetensi '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_deskripsi_lck',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_deskripsi_lck',$data);
				}
			}
		elseif ($noyangdicetak == 28)
			{
			$data['noyangdicetak'] = 28;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian Per Tanggal';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Rencana Pelaksanaan Harian Per Tanggal '.$data["nim"];
				$data['tanggalrph'] = $tahunhadir.'-'.$bulanhadir.'-'.$tanggalhadir;			
				$this->load->view('guru/mencetak_rph_tanggal',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rph_tanggal',$data);
				}			}
		elseif ($noyangdicetak == 27)
			{
			$data['noyangdicetak'] = 27;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Rencana Pelaksanaan Harian '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);						
				$this->load->view('guru/mencetak_rph',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rph',$data);

				}
			}
		elseif ($noyangdicetak == 33)
			{
			$data['noyangdicetak'] = 33;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian Versi Ringkas';
			$data['judulhalaman'] = 'Rencana Pelaksanaan Harian Versi Ringkas';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Rencana Pelaksanaan Harian Versi Ringkas '.$data["nim"];			
				$this->load->view('guru/mencetak_rph_ringkas',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rph_ringkas',$data);
				}
			}
		elseif ($noyangdicetak == 29)
			{
			$data['noyangdicetak'] = 29;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Pembelajaran';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Rencana Pelaksanaan Pembelajaran '.$data["nim"];
				$this->load->view('guru/mencetak_rencana_pelaksanaan_pembelajaran',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rencana_pelaksanaan_pembelajaran',$data);
				}
			}
		elseif ($noyangdicetak == 7)
			{
			$data['noyangdicetak'] = 7;
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Pelaksanaan Harian '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_bph',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Pelaksanaan Harian';
				$this->load->view('guru/form_mencetak_bph',$data);
				}
			}
		elseif ($noyangdicetak == 35)
			{
			$data['noyangdicetak'] = 35;
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian Versi 2';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Pelaksanaan Harian Versi 2 '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_bph2',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Pelaksanaan Harian Versi 2';
				$this->load->view('guru/form_mencetak_bph2',$data);
				}
			}
		elseif ($noyangdicetak == 10)
			{
			$data['noyangdicetak'] = 10;
			$data['yangdicetak'] = 'Buku Pengembalian Ulangan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Pengembalian Ulangan '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_bpu',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Pengembalian Ulangan';
				$this->load->view('guru/form_mencetak_bpu',$data);
				}			}
		elseif ($noyangdicetak == 15)
			{
			$data['noyangdicetak'] = 15;
			$data['yangdicetak'] = 'Daftar Hadir Siswa';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Hadir Siswa '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_kehadiran',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Hadir Siswa';
				$this->load->view('guru/form_mencetak_kehadiran',$data);
				}
			}
		elseif ($noyangdicetak == 38)
			{
			$data['noyangdicetak'] = 38;
			$data['yangdicetak'] = 'Daftar Hadir Siswa Versi 2';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Hadir Siswa Versi 2 '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_kehadiran_versi_2',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Hadir Siswa Versi 2';
				$this->load->view('guru/form_mencetak_kehadiran_versi_2',$data);
				}
			}
		elseif ($noyangdicetak == 22)
			{
			$data['noyangdicetak'] = 22;
			$data['yangdicetak'] = 'Jurnal Piket';
			if ($diproses == 'oke')
				{
					$datax["tanggalhadir"]=$tanggalhadir;
					$datax["bulanhadir"]=$bulanhadir;
					$datax["tahunhadir"]=$tahunhadir;
					$datax['thnajaran']=cari_thnajaran();
					$datax['semester']=cari_semester();
					$data['judulhalaman'] = 'Jurnal Piket '.$data["nim"];
					$this->load->view('shared/bg_atas_cetak',$data);
					$this->load->view('guru/mencetak_jurnal_piket',$datax);
				}
				else
				{

				$this->load->view('guru/form_mencetak_jurnal_piket',$data);
				}
			}
		elseif ($noyangdicetak == 17)
			{
			$data['noyangdicetak'] = 17;
			$data['yangdicetak'] = 'Daftar Nilai Akhlak / Sikap Spiritual dan Sosial';
			$id_mapel=$this->input->post('id_mapel');
			$kelas = id_mapel_jadi_kelas($id_mapel);
			$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
			$data['kelas'] = $kelas;
			$data['kurikulum'] = $kurikulum;

			if ($diproses == 'oke')
				{
					$data['judulhalaman'] = 'Daftar Nilai Akhlak / Sikap Spiritual dan Sosial '.$data["nim"];
					$this->load->view('shared/bg_atas_cetak_landscape',$data);
					$this->load->view('guru/mencetak_akhlak',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Daftar Nilai Akhlak / Sikap Spiritual dan Sosial';
				$this->load->view('guru/form_mencetak_akhlak',$data);
				}			}
		elseif ($noyangdicetak == 4)
			{
			$data['noyangdicetak'] = 4;
			$data['yangdicetak'] = 'Buku Informasi Penilaian';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Informasi Penilaian '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_informasi_penilaian',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Informasi Penilaian';
				$this->load->view('guru/form_mencetak_informasi_penilaian',$data);
				}			}
		elseif ($noyangdicetak == 14)
			{
			$data['noyangdicetak'] = 14;
			$data['yangdicetak'] = 'Daftar Buku Pegangan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Buku Pegangan '.$data["nim"];
				$data['judulhalaman'] = 'Buku Pegangan Guru dan Siswa';
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_daftar_buku_pegangan',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Pegangan';
				$this->load->view('guru/form_mencetak_buku_pegangan',$data);
				}			}
		elseif ($noyangdicetak == 12)
			{
			$data['noyangdicetak'] = 12;
			$data['yangdicetak'] = 'Buku Tugas';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Tugas '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_daftar_tugas',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Tugas';
				$this->load->view('guru/form_mencetak_daftar_tugas',$data);
				}			}
		elseif ($noyangdicetak == 19)
			{
			$data['noyangdicetak'] = 19;
			$data['yangdicetak'] = 'Daftar Nilai Psikomotor';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Nilai Psikomotor '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_daftar_nilai_psikomotor',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Nilai Psikomotor';
				$this->load->view('guru/form_mencetak_daftar_nilai_psikomotor',$data);
				}			}
		elseif ($noyangdicetak == 16)
			{
			$data['noyangdicetak'] = 16;
			$data['yangdicetak'] = 'Daftar Nilai Afektif';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Nilai Afektif '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_daftar_nilai_afektif',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Nilai Afektif';
				$this->load->view('guru/form_mencetak_daftar_nilai_afektif',$data);
				}			}
		elseif ($noyangdicetak == 18)
			{
			$data['noyangdicetak'] = 18;
			$data['yangdicetak'] = 'Daftar Nilai Kognitif';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Nilai Kognitif '.$this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]).' '.$id_mapel;
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_daftar_nilai_kognitif',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Nilai Kognitif';
				$this->load->view('guru/form_mencetak_daftar_nilai_kognitif',$data);
				}			}
			elseif ($noyangdicetak == 30)
			{
				$data['noyangdicetak'] = 30;
				$data['yangdicetak'] = 'Penilaian Diri Siswa';
				if ($diproses == 'oke')
				{
					$data['judulhalaman'] = 'Penilaian Diri Siswa '.$data["nim"];
					$this->load->view('shared/bg_atas_cetak_landscape',$data);
					$this->load->view('guru/mencetak_penilaian_diri_siswa',$data);

				}
				else
				{
					$this->load->view('guru/form_mencetak_penilaian_diri_siswa',$data);
				}
			}
			elseif ($noyangdicetak == 31)
			{
				$data['noyangdicetak'] = 31;
				$data['yangdicetak'] = 'Penilaian Antarteman';
				if ($diproses == 'oke')
				{
					$data['judulhalaman'] = 'Penilaian Antarteman '.$data["nim"];
					$this->load->view('shared/bg_atas_cetak_landscape',$data);
					$this->load->view('guru/mencetak_penilaian_antarteman',$data);
				}
				else
				{
					$this->load->view('guru/form_mencetak_penilaian_antarteman',$data);
				}
			}
			elseif ($noyangdicetak == 32)
			{
				$data['noyangdicetak'] = 32;
				$data['yangdicetak'] = 'Deskripsi Sikap Spiritual dan Sosial Antarmata Pelajaran';
				if ($diproses == 'oke')
					{
						$data['judulhalaman'] = 'Deskripsi Sikap Spiritual dan Sosial Antarmata Pelajaran '.$data["nim"];
						$this->load->view('shared/bg_atas_cetak',$data);
						$this->load->view('guru/mencetak_deskripsi_sikap_spiritual_dan_sosial_antarmata_pelajaran',$data);
					}
					else
					{
						$this->load->view('guru/form_mencetak_deskripsi_sikap_spiritual_dan_sosial_antar_mata_pelajaran',$data);
					}
			}
			elseif ($noyangdicetak == 34)
			{
			$data['noyangdicetak'] = 34;
			$data['yangdicetak'] = 'Buku Tugas Versi 2';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Buku Tugas Versi 2 '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak',$data);
				$this->load->view('guru/mencetak_daftar_tugas_v2',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Buku Tugas Versi 2';
				$this->load->view('guru/form_mencetak_daftar_tugas_v2',$data);
				}
			}
			elseif ($noyangdicetak == 39)
			{
			$data['noyangdicetak'] = 39;
			$data['yangdicetak'] = 'Jurnal Penilaian Sikap Spiritual dan Sosial';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Jurnal Penilaian Sikap Spiritual dan Sosial '.$data["nim"];
				$this->load->model('Referensi_model','ref');
				$data['baris1'] = $this->ref->ambil_nilai('baris1');
				$data['baris2'] = $this->ref->ambil_nilai('baris2');
				$data['baris3'] = $this->ref->ambil_nilai('baris3');
				$data['baris4'] = $this->ref->ambil_nilai('baris4');
				$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
				$data['plt'] = $this->ref->ambil_nilai('plt');
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/mencetak_jurnal_penilaian_sikap_sosial_spiritual',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Jurnal Penilaian Sikap Spiritual dan Sosial';
				$this->load->view('guru/form_mencetak_jurnal_penilaian_sikap_sosial_spiritual',$data);
				}
			}

			else
			{
			$data['noyangdicetak'] = '';
			$data['yangdicetak'] = '';
			$this->load->view('guru/form_mencetak',$data);
			}
			if ($diproses != 'oke') 
			{
			$this->load->view('shared/bawah');
			}

	}
	function deskripsimid($id=null,$aksi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$judulhalaman = 'Deskripsi Ulangan Tengah Semester';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$data['id_mapel']=$id;
		$data['aksi'] = $aksi;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
				$ranah = $dtmapel->ranah;
				$kkm_mid = $dtmapel->kkm_mid;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['kkm']=$kkm;
			$data['kkm_mid']=$kkm_mid;
			$data['ranah']=$ranah;
			$data['query']=$this->Guru_model->Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran);
			$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
       			$data['cacah_siswa'] = $tot_hal->num_rows();
			$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
			$data['kurikulum'] = $kurikulum;
			$data['ada']=$ada;
			$this->load->model('Nilai_model');
			$data["tkepala"] = $this->Nilai_model->Kepala($thnajaran,$semester);
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			else
			{
				if($kurikulum == '2015')
				{
					$judulhalaman = 'Deskripsi Penilaian Tengah Semester';
				}
				$data['judulhalaman'] = $judulhalaman;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/mid',$data);
				$this->load->view('shared/bawah');
			}
		}
		else
		{
			redirect('guru');
		}
	}
	function updatemid($id_mapel=null)
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$this->load->model('Guru_model');
		for($i=1;$i<=$cacah_siswa;$i++)
		{
			$in["kd"]=nopetik($this->input->post("kd_$i"));
			$in["keterangan"]=nopetik($this->input->post("keterangan_$i"));
			$this->Guru_model->Update_Nilai($in);
		}
		redirect('guru/deskripsimid/'.$id_mapel);
	}
	function lihatnilaiujian($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Hasil Ujian Akhir Sekolah';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$ranah = $dtmapel->ranah;
				$kkm = $dtmapel->kkm;
			}
		$data['ranah']=$ranah;
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['mapel']=$mapel;
		$data['id_mapel']=$id;
		$data['kkm'] = $kkm;
		}
       		//$data['cacah_siswa'] = $tot_hal->num_rows();
		if (empty($ranah))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."guru/ubahkkm/$id'>";
			}
			else
			{
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/nilai_ujian_daftar',$data);
		$this->load->view('shared/bawah');
			}
	}
	function unduhrapor($id_mapel=null)
	{
		$kodeguru=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['kkm'] = $kkm;
			$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
			$this->load->library('excel');
			$this->load->view('guru/unduh_rapor',$data);
		}
		else
		{
			redirect('guru');
		}
	}

/* akhir controller */
}
?>
