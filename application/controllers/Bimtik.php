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
class Bimtik extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$this->load->model('Bimtik_model','bimtik');
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
		//$temail = $this->Situs_model->Ada_Email($data["nim"]);
		//$tvalidemail = $this->Situs_model->Valid_Email($data["nim"]);
		$data["adapesan"] = $tinbox->num_rows();
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function pembagiantugas()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$datax["kodeguru"] = $data["nim"];	
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['thnajaran']=cari_thnajaran();
		$datax['semester']=cari_semester();
		$datax['ranah']=$this->input->post('ranah');
		$datax['kelas']=$this->input->post('kelas');
		$datax['kkm'] = $this->input->post('kkm');
		$datax['jam'] = $this->input->post('jam');
		$datax['aksi'] = $this->uri->segment(3);
		$datax['id_mapel'] = $this->uri->segment(4);
		$pbk['thnajaran'] = cari_thnajaran();
		$pbk['semester'] = cari_semester();
		$pbk['kelas'] = $this->input->post('kelas');
		$pbk['program'] = kelas_jadi_program($this->input->post('kelas'));
		$pbk['tingkat'] = kelas_jadi_tingkat($this->input->post('kelas'));
		$pbk['kodeguru'] = $data["nim"];
		$pbk['ranah'] = $this->input->post('ranah');
		$pbk['kkm'] = $this->input->post('kkm');
		$pbk['jam'] = $this->input->post('jam');
		$thnajaran = $pbk['thnajaran'];
		$semester = $pbk['semester'];
		$kelas = $pbk['kelas'];
		$kodeguru = $pbk['kodeguru'];
		if ((!empty($kodeguru)) and (!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
		{
//
			$cek = $this->bimtik->Cek_Mapel($thnajaran,$semester,$kelas,$kodeguru);
			$ada = $cek->num_rows();
			$pbk = hilangkanpetik($pbk);
			$this->bimtik->Add_Mapel($pbk,$ada);
		}
		$data['judulhalaman'] = 'Pembagian Tugas Guru Bimbingan TIK';
		$this->load->model('Pengajaran_model');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/pembagian_tugas',$datax);
		$this->load->view('shared/bawah');
	}
	function nilai()
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
		$query=$this->bimtik->Tampil_Semua_Mapel_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->bimtik->Total_Semua_Mapel_Guru($kodeguru);
      		$config['base_url'] = base_url() . 'bimtik/nilai';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/nilai',$data_isi);
		$this->load->view('shared/bawah');
	}
	function ubahkkm($id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah KKM';
		$data['galat'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['tmapel'] = $this->bimtik->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$data['adainfo'] = '';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/kkm_edit',$data);
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
		//$buh1=$this->input->post('bobot_ulangan_harian1');
//		$buh2=$this->input->post('bobot_ulangan_harian2');
//		$buh3=$this->input->post('bobot_ulangan_harian3');
//		$buh4=$this->input->post('cacah_ulangan_harian4');
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

		$this->bimtik->Update_KKM($in);
		redirect('bimtik/daftarnilai/'.$id_mapel);
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
		$tmapel = $this->bimtik->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$data["kodeguru"] = $kodeguru;
		$data['itemnilai']=$itemnilai;
		$data['jujug'] = $this->config->item('jujug');
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$data['kelas'] = $dtmapel->kelas;
				$data['thnajaran'] = $dtmapel->thnajaran;
				$data['semester'] = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$data['cacah_ulangan_harian'] = $dtmapel->cacah_ulangan_harian;
				$data['cacah_tugas'] = $dtmapel->cacah_tugas;
				$ranah = $dtmapel->ranah;
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

				//$data['nbuh1'] = $dtmapel->buh1;
				//$data['nbuh2'] = $dtmapel->buh2;
				//$data['nbuh3'] = $dtmapel->buh3;
				//$data['nbuh4'] = $dtmapel->buh4;
				$data['kurikulum'] = cari_kurikulum($dtmapel->thnajaran,$dtmapel->semester,$dtmapel->kelas);
				$query=$this->bimtik->Tampil_Semua_Nilai($dtmapel->kelas,$dtmapel->semester,$dtmapel->thnajaran);
			}
			$data['kkm'] = $kkm;
			$data['ranah'] = $ranah;
			if ((empty($kkm)) or (empty($ranah)))
				{
					redirect('bimtik/ubahkkm/'.$id);
				}
				else
				{
					if ($statuscetak=='cetak')
					{
						if ($ditandatangani == "ttd")
						{
							$data["ditandatangani"]="ya";
						}
						else
						{
							$data["ditandatangani"]="tidak";
						}					
					$this->load->view('bimtik/cetak_daftar_nilai',$data);
					}
					else
					{
						$this->load->view('guru/bg_atas',$data);
						$this->load->view('bimtik/daftar_nilai',$data);
						$this->load->view('shared/bawah');
					}
				}		}
		else
			{
			redirect('guru');
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
		$datax['diproses']=$this->input->post('diproses');
		if ($datax['diproses']=='oke') 
		{
			$datax['tahun1']=substr($this->input->post('thnajaranx'),0,4);
			$datax['semester']=$this->input->post('semesterx');
			$datax['jenis_deskripsi'] = $this->input->post('jenis_deskripsix');
			$datax['id_mapel']=$this->input->post('id_mapelx');
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
			$in["sk"]=$this->input->post('sk');
			$in["jenis_deskripsi"]= 6;
			$in = nopetik($in);
			$this->bimtik->Update_KKM($in);
			$datax['sukses'] = '<div class="alert alert-success">Sukses</div>';
		}	
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/deskripsi',$datax);
		$this->load->view('shared/bawah');
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
		$pilihan=$this->input->post('pilihan');
		$semester=$this->input->post('semester');
		$kurikulum=$this->input->post('kurikulum');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
		{
			$nis = $dsiswa->nis;
			$no_urut = $dsiswa->no_urut;
			$ada = $this->bimtik->Cek_Nilai($thnajaran,$semester,$nis);
			$ada = $ada->num_rows();
			$status=$dsiswa->status;
			$pbk['thnajaran'] = $thnajaran;
			$pbk['semester'] = $semester;
			$pbk['kelas'] = $kelas;
			$pbk['nis'] = $nis;
			$pbk['no_urut'] = $no_urut;
			$pbk['status'] = $status;
			$this->bimtik->Add_Nilai($pbk,$ada);
		}
		redirect('bimtik/daftarnilai/'.$id_mapel);
	}
	function nilaiharian($id=null,$itemnilai=null,$separuh=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Harian';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$data['jujug'] = $this->config->item('jujug');
		$separuh = $this->uri->segment(5);
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->bimtik->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
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
			}
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
		if($cacahsiswa > 30)
		{
			$data['query']=$this->bimtik->Tampil_Semua_Nilai_Separuh($kelas,$semester,$thnajaran,$separuh);
		}
		else
		{
			$data['query']=$this->bimtik->Tampil_Semua_Nilai($kelas,$semester,$thnajaran);

		}
		}
       		//$data['cacah_siswa'] = $tot_hal->num_rows();
		if ((empty($kkm)) or (empty($ranah)))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."bimtik/ubahkkm/$id'>";
			}
			else
			{
			$data['separuh'] = $separuh;
			$this->load->view('guru/bg_atas',$data);
			if($cacahsiswa > 30)
			{
				$this->load->view('bimtik/nilai_harian_40',$data);
			}
			else
			{
				$this->load->view('bimtik/nilai_harian',$data);
			}

			$this->load->view('shared/bawah');
			}
	}
	function updatenilaiharian2()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$id_mapel = $this->uri->segment(3);
		$itemnilai = $this->uri->segment(4);
		$kkm = $this->input->post('kkm_ulangan');
		$jenis_deskripsi = $this->uri->segment(5);
		$nomor_materi = $this->uri->segment(6);
		$cacah_siswa = $this->uri->segment(7);
		$separuh = $this->uri->segment(8);
		$tmapel = $this->bimtik->Id_Mapel($id_mapel,$kodeguru);
		$ada = $tmapel->num_rows();
		$materi = '';
		$jujug = $this->config->item('jujug');
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
				$cacah_tugas = $dtmapel->cacah_tugas;
				$ranah = $dtmapel->ranah;
				$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
				$bobot_tugas = $dtmapel->bobot_tugas;
				$bobot_mid = $dtmapel->bobot_mid;
				$bobot_semester = $dtmapel->bobot_semester;
				$cacah_kuis = $dtmapel->nkuis;
				$bobot_kuis = $dtmapel->bobot_kuis;
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
				$this->bimtik->Hapus_Capaian_Kompetensi($id_mapel,$nomor_materi);
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
				$nilai_ruh = 0;
				$nilai_rtu = 0;
				if ($cacah_ulangan_harian>0)
				{
					$nilai_ruh =($in["nilai_uh1"] + $in["nilai_uh2"] + $in["nilai_uh3"] + $in["nilai_uh4"] + $in["nilai_uh5"]+ $in["nilai_uh6"]+ $in["nilai_uh7"]+ $in["nilai_uh8"]+ $in["nilai_uh9"]+ $in["nilai_uh10"])/$cacah_ulangan_harian;
					$nilai_rtu =($in["nilai_tu1"] + $in["nilai_tu2"] + $in["nilai_tu3"] + $in["nilai_tu4"] + $in["nilai_tu5"]+ $in["nilai_tu6"]+ $in["nilai_tu7"]+ $in["nilai_tu8"]+ $in["nilai_tu9"]+ $in["nilai_tu10"])/$cacah_ulangan_harian;
				}
				$nilai_nr = ($nilai_ruh + $nilai_rtu) / 2;
				$in['nilai_na'] = round($nilai_ruh,2);
				$in['nilai_tu'] = round($nilai_rtu,2);
				$in['nilai_nr'] = round($nilai_nr,0);

				if ($itemnilai=='1')
				{
					$nilai1 = $this->input->post("nilai_uh1_$i");
					$nilai2 = $this->input->post("nilai_tu1_$i");
				}
				if ($itemnilai=='2')			
				{
					$nilai1 = $this->input->post("nilai_uh2_$i");
					$nilai2 = $this->input->post("nilai_tu2_$i");
				}
				if ($itemnilai=='3')
				{
					$nilai1 = $this->input->post("nilai_uh3_$i");
					$nilai2 = $this->input->post("nilai_tu3_$i");
				}
				if ($itemnilai=='4')
				{
					$nilai1 = $this->input->post("nilai_uh4_$i");
					$nilai2 = $this->input->post("nilai_tu4_$i");
				}
				if ($itemnilai=='5')
				{
					$nilai1 = $this->input->post("nilai_uh5_$i");
					$nilai2 = $this->input->post("nilai_tu5_$i");
				}
				if ($itemnilai=='6')
				{
					$nilai1 = $this->input->post("nilai_uh6_$i");
					$nilai2 = $this->input->post("nilai_tu6_$i");
				}
				if ($itemnilai=='7')
				{
					$nilai1 = $this->input->post("nilai_uh7_$i");
					$nilai2 = $this->input->post("nilai_tu7_$i");
				}
				if ($itemnilai=='8')
				{
					$nilai1 = $this->input->post("nilai_uh8_$i");
					$nilai2 = $this->input->post("nilai_tu8_$i");
				}
				if ($itemnilai=='9')
				{
					$nilai1 = $this->input->post("nilai_uh9_$i");
					$nilai2 = $this->input->post("nilai_tu9_$i");
				}
				if ($itemnilai=='10')
				{
					$nilai1 = $this->input->post("nilai_uh10_$i");
					$nilai2 = $this->input->post("nilai_tu10_$i");
				}
				$nilai = ($nilai1 + $nilai2) / 2;
				if((!empty($materi)) and (!empty($nomor_materi)))
				{ 
					if (($itemnilai==1) or ($itemnilai==2) or ($itemnilai==3) or ($itemnilai==4) or ($itemnilai==5) or ($itemnilai==6) or ($itemnilai==7) or ($itemnilai==8) or ($itemnilai==9) or ($itemnilai==10))
					{
						if($nilai < $kkm)
						{
							$in2["positif"] = 0;
						}
						else
						{
							$in2["positif"] = 1;
						}
						if($jenis_deskripsi == 6)
						{
							$in2["ket"] = deskripsi_nilai_2015($nilai,$kkm);
						}
						$in2["nis"]=$this->input->post("nis_$i");
						$this->bimtik->Simpan_Capaian_Kompetensi($in2);
					}
				}
				$this->bimtik->Update_Nilai($in);
			}
			if(empty($separuh))
			{
				redirect('bimtik/nilaiharian/'.$id_mapel.'/'.$itemnilai.'/1');
			}
			else
			{
				if($itemnilai == 13)
				{
					redirect('bimtik/statusketuntasan/'.$id_mapel);
				}
				else
				{
				redirect('bimtik/daftarnilai/'.$id_mapel.'/cacah/'.$cacah_siswa);
				}
			}
		} //akhir kalau ada
		else
		{
			echo 'galat, data tidak ditemukan';
		}
	}
	function statusketuntasan($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Pemutakhiran Ketuntasan Siswa dan Deskripsi Capaian Kompetensi';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$tmapel = $this->bimtik->Id_Mapel($id_mapel,$kodeguru);
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
			$datasiswakelas = $this->bimtik->Tampil_Semua_Nilai($kelas,$semester,$thnajaran);
			$data['total_siswa'] = $datasiswakelas->num_rows();
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['ranah'] = $ranah;
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
			$this->load->view('bimtik/status_ketuntasan',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}
	function lck2($id=null,$itemnilai=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Laporan Hasil Bimbingan Belajar Siswa';
		$kelas='';
		$thnajaran='';
		$download_pdf = '';
		$jujug = $this->config->item('jujug');
		$data['jujug'] = $jujug;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->bimtik->Id_Mapel($id,$kodeguru);
		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
				$ranah = $dtmapel->ranah;
				$kkm_mid = $dtmapel->kkm_mid;
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['kkm']=$kkm;
		$data['kkm_mid']=$kkm_mid;
		$data['ranah']=$ranah;
		$data['query']=$this->bimtik->Tampil_Semua_Nilai($kelas,$semester,$thnajaran);
		$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
       		$data['cacah_siswa'] = $tot_hal->num_rows();
		$data['kurikulum'] = cari_kurikulum($thnajaran,$semester,$kelas);
		}
		$data['ada']=$ada;
		if (empty($kkm))
		{
			redirect('bimtik/ubahkkm/'.$id);
			}
			else
			{
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('bimtik/lck',$data);
				$this->load->view('shared/bawah');
			}
	}
	function psikomotor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian BK TIK Psikomotor / Keterampilan';
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
		$query=$this->bimtik->Tampil_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->bimtik->Total_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru);
      		$config['base_url'] = base_url() . 'bimtik/psikomotor';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/psikomotor',$data_isi);
		$this->load->view('shared/bawah');
	}
	function aspekpsikomotor()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Kriteria Penilaian Bimbingan TIK Psikomotor / Keterampilan';
		$id_mapel='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mapel='';
		}
		else
		{
    			$id_mapel = $this->uri->segment(3);
		}
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$data['tmapel'] = $this->bimtik->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/aspek_psikomotor',$data);
		$this->load->view('shared/bawah');
	}
	function updateaspekpsikomotor()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$id_mapel=$this->input->post('id_mapel');
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
		$in["id_aspek_psikomotor"]=$this->input->post('id_aspek_psikomotor');
		$this->bimtik->Update_Aspek_Psikomotor($in);
		redirect('bimtik/daftarnilaipsikomotor/'.$id_mapel);
	}
	function daftarnilaipsikomotor($id=null,$statuscetak=null,$id_psikomotor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Daftar Nilai Psikomotor';
		$kelas='';
		$thnajaran='';
		$kurikulum = '';
		$itemnilai='';
		$jujug = $this->config->item('jujug');
		$data['jujug'] = $jujug;
    		$data['id_psikomotor'] = $id_psikomotor;			
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
//		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 	
		$tmapel = $this->bimtik->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$keterampilan1 = $dtmapel->keterampilan1;
				$keterampilan2 = $dtmapel->keterampilan2;
				$kkm = $dtmapel->kkm;
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$data['keterampilan1']=$keterampilan1;
			$data['keterampilan2']=$keterampilan2;
			$data['jenis_deskripsi'] = $jenis_deskripsi;
			$data['kurikulum']=cari_kurikulum($thnajaran,$semester,$kelas);
			$data['kkm'] = $kkm;
			$data['query']=$this->bimtik->Tampil_Semua_Nilai_Psikomotor($kelas,$semester,$thnajaran);
			$this->load->model('Nilai_model');
			$data['ada']=$ada;
			if ($statuscetak=='cetak')
			{
				$this->load->view('bimtik/cetak_daftar_nilai_psikomotor',$data);
			}
			elseif ($statuscetak=='persiswa')
			{
				$data['judulhalaman'] = 'Daftar Nilai Psikomotor / Keterampilan Per Siswa';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('bimtik/daftar_nilai_psikomotor_persiswa',$data);
				$this->load->view('shared/bawah');
			}
			else
			{	
				$data['adainfo'] = '';
				$data['proses'] = $statuscetak;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('bimtik/daftar_nilai_psikomotor',$data);
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
		$semester=$this->input->post('semester');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
		{
			$nis = $dsiswa->nis;
			$no_urut = $dsiswa->no_urut;
			$status=$dsiswa->status;
			$ada = $this->bimtik->Cek_Nilai_Psikomotor($thnajaran,$semester,$nis);
			$ada = $ada->num_rows();
			$pbk['thnajaran'] = $thnajaran;
			$pbk['semester'] = $semester;
			$pbk['kelas'] = $kelas;
			$pbk['nis'] = $nis;
			$pbk['no_urut'] = $no_urut;
			$pbk['status'] = $status;
			$this->bimtik->Add_Nilai_Psikomotor($pbk,$ada);
//			$ada2 = $this->bimtik->Cek_Nilai($thnajaran,$semester,$nis);
//			$ada2 = $ada2->num_rows();
//			$this->bimtik->Add_Nilai($pbk,$ada2);
		}
		redirect('bimtik/daftarnilaipsikomotor/'.$id_mapel);
	}
	function nilaipsikomotor($id=null,$itemnilai=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Psikomotor / Keterampilan';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->bimtik->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
		foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
				$kkm = $dtmapel->kkm;
				$semester = $dtmapel->semester;				
			}
		$data['kelas']=$kelas;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data['query']=$this->bimtik->Tampil_Semua_Nilai_Psikomotor($kelas,$semester,$thnajaran);
		$tot_hal = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/nilai_psikomotor',$data);
		$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function updatenilaipsikomotor()
	{
		$in=array();
		$data['nim']=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$cacahitem = $this->input->post('cacahitem');
		$itemnilai = $this->input->post('itemnilai');
		$id_mapel = $this->input->post('id_mapel');
		$jujug = $this->config->item('jujug');
		$data['jujug'] = $jujug;
		for($i=1;$i<=$cacah_siswa;$i++)
		{
			$in["id_psikomotor"]=$this->input->post("id_psikomotor_$i");
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
			$in['nilai'] = $nilai;
			if($jujug == 'Y')
			{
				$nilaiakhir = $this->input->post("p19_$i");
			}
			else
			{
				$nilaiakhir = $nilai;
				$this->bimtik->Update_Nilai_Psikomotor_Rapor($thnajaran,$semester,$nis,$nilai,$nilaiakhir);
			}
			$in['nilai_akhir'] = $nilaiakhir;
			$this->bimtik->Update_Nilai_Psikomotor($in);
			if($itemnilai == 19)
			{
				$this->bimtik->Update_Nilai_Psikomotor_Rapor($thnajaran,$semester,$nis,$nilai,$nilaiakhir);
			}
		}
		if (empty($cacah_siswa))
		{
			$data['judulhalaman'] = 'Galat memperbarui nilai psikomotor / keterampilan';
			$datay['pesan'] = 'Galat memperbarui nilai psikomotor / keterampilan. Cacah siswa kosong';
			$datay['tautan_balik'] = ''.base_url().'guru/nilaipsikomotor/'.$id_mapel.'/'.$itemnilai;
			$datay['modul'] = 'Menyimpan Nilai Psikomotor / Keterampilan';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/adagalat',$datay);
			$this->load->view('shared/bawah',$data);
		}
		elseif($itemnilai == 19)
		{
			redirect('bimtik/deskripsiketerampilan/'.$id_mapel);
		}
		else
 
		{
			redirect(base_url().'bimtik/daftarnilaipsikomotor/'.$id_mapel);
		}
	}
	function deskripsiketerampilan($id_mapel=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Deskripsi Keterampilan';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$tmapel = $this->bimtik->Id_Mapel($id_mapel,$kodeguru);
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
				$jenis_deskripsi = $dtmapel->jenis_deskripsi;
				$kkm = $dtmapel->kkm;
			}
			$data['adamenu'] = '';
			$datasiswakelas = $this->bimtik->Tampil_Semua_Nilai($kelas,$semester,$thnajaran);
			$data['total_siswa'] = $datasiswakelas->num_rows();
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['kelas'] = $kelas;
			$data['ranah'] = $ranah;
			$data['jenis_deskripsi'] = $jenis_deskripsi;
			$data['id'] = $id;
			$data['id_mapel'] = $id_mapel;
			$data['kkm'] = $kkm;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/deskripsi_keterampilan',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}
	function salindeskripsi($thn1=null)
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
					$in["sk"]=$this->input->post('dsk');
					$in["keterampilan1"]=$this->input->post('dketerampilan1');
					$in["keterampilan2"]=$this->input->post('dketerampilan2');
					$in["jenis_deskripsi"]= $this->input->post('djenis_deskripsi');
					$semester = $this->input->post('semester');
					$id_mapel = $this->input->post('id_mapel');
					$id_mapeld = $this->input->post('id_mapeldd');
					$in = hilangkanpetik($in);
					$this->bimtik->Update_KKM($in);
					$data['sukses'] ='sukses';
					$tahun1 = $this->input->post('tahun1');
					$tahun2 = $tahun1+1;
					$data['thnajaran']= $tahun1.'/'.$tahun2;
					$datax['semester'] = $semester;
					$datax['id_mapel'] = $id_mapel;
					$datax['id_mapeld'] = $this->input->post('id_mapeldd');

			}
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/salin_deskripsi',$datax);
			$this->load->view('shared/bawah');
	}
	function salindeskripsiketerampilan($thn1=null)
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
		$this->load->view('bimtik/salin_deskripsi_keterampilan',$datax);
		$this->load->view('shared/bawah');
	}
	function unggahnilai($id=null,$itemnilai=null,$sumber=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]='Unggah Nilai';
		if((empty($id)) and (empty($itemnilai)))
		{
			redirect('bimtik');
		}
		$data["id_mapel"]=$id;
		$data["itemnilai"]=$itemnilai;
		$data['sumber'] = $sumber;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->bimtik->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
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
			$data['semester']=$semester;
			$data['id_mapel']=$id;
			$data['itemnilai']=$itemnilai;
			$data['kkm']=$kkm;
			$data['kkm_ulangan']=$kkm_ulangan;
			if ($kkm_ulangan == 0)
				{$data['kkm_ulangan'] = $kkm;}
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/form_impor_nilai',$data);
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
		$pbk["kelas"]=$this->input->post('kelas');
		$kkm_ulangan=$this->input->post('kkm_ulangan');
		$id_mapel=$this->input->post('id_mapel');
		$pbk["itemnilai"]=$this->input->post('itemnilai');
		$itemnilai=$this->input->post('itemnilai');
		$sumber=$this->input->post('sumber');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;
		$filename = berkas($this->input->post('thnajaran')).'_'.berkas($this->input->post('semester')).'_'.berkas($this->input->post('mapel')).'_'.berkas($this->input->post('kelas')).'_'.berkas($this->input->post('itemnilai')).'.csv';	
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$datay['modul'] = 'Unggah Nilai';
		$datay['tautan_balik'] = ''.base_url().'bimtik/unggahnilai/'.$id_mapel.'/'.$itemnilai;
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
				$data['judulhalaman'] =' Galat, unggah berkas';
				$datay['pesan'] = $this->upload->display_errors();
				$datay['tautan_balik'] = ''.base_url().'bimtik/unggahnilai/'.$id_mapel.'/'.$itemnilai.'/'.$sumber;
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
						$this->bimtik->Ubah_Nilai($pbk);
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
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."bimtik/daftarnilai/".$id_mapel."'>";
				}
			}
		}
		else
		{
			redirect('bimtik');
		}
	}//akhir fungsi proses impor nilai
	function updatenilaiharian()
	{
		$this->load->model('Guru_model');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$id_mapel = $this->input->post('id_mapel');
		$cacah_ulangan_harian = $this->input->post('cacah_ulangan_harian');
		$cacah_tugas = $this->input->post('cacah_tugas');
		$bobot_tugas = $this->input->post('bobot_tugas');
		$bobot_ulangan_harian = 100;
		$semester = $this->input->post('semester');
		$materi = $this->input->post('materi');
		$nomor_materi = $this->input->post('nomor_materi');
		$itemnilai = $this->input->post('itemnilai');
		$kkm = $this->input->post('kkm_ulangan');
		$jenis_deskripsi = 6;
		$in2["id_mapel"] = $id_mapel;
		$in2["materi"] = $materi;
		$in2["nomor_materi"] = $nomor_materi;
		$this->bimtik->Hapus_Capaian_Kompetensi($id_mapel,$nomor_materi);
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
			$nilai_ruh = 0;
			$nilai_rtu = 0;
			if ($cacah_ulangan_harian>0)
			{
				$nilai_ruh =($in["nilai_uh1"] + $in["nilai_uh2"] + $in["nilai_uh3"] + $in["nilai_uh4"] + $in["nilai_uh5"]+ $in["nilai_uh6"]+ $in["nilai_uh7"]+ $in["nilai_uh8"]+ $in["nilai_uh9"]+ $in["nilai_uh10"])/$cacah_ulangan_harian;
				$nilai_rtu =($in["nilai_tu1"] + $in["nilai_tu2"] + $in["nilai_tu3"] + $in["nilai_tu4"] + $in["nilai_tu5"]+ $in["nilai_tu6"]+ $in["nilai_tu7"]+ $in["nilai_tu8"]+ $in["nilai_tu9"]+ $in["nilai_tu10"])/$cacah_ulangan_harian;

			}
			$nilai_nr = ($nilai_ruh + $nilai_rtu) / 2;
			$in['nilai_na'] = round($nilai_ruh,2);
			$in['nilai_tu'] = round($nilai_rtu,2);
			$in['nilai_nr'] = round($nilai_nr,0);
			if ($itemnilai=='1')
			{
				$nilai1 = $this->input->post("nilai_uh1_$i");
				$nilai2 = $this->input->post("nilai_tu1_$i");
			}
			if ($itemnilai=='2')			
			{
				$nilai1 = $this->input->post("nilai_uh2_$i");
				$nilai2 = $this->input->post("nilai_tu2_$i");
			}
			if ($itemnilai=='3')
			{
				$nilai1 = $this->input->post("nilai_uh3_$i");
				$nilai2 = $this->input->post("nilai_tu3_$i");
			}
			if ($itemnilai=='4')
			{
				$nilai1 = $this->input->post("nilai_uh4_$i");
				$nilai2 = $this->input->post("nilai_tu4_$i");
			}
			if ($itemnilai=='5')
			{
				$nilai1 = $this->input->post("nilai_uh5_$i");
				$nilai2 = $this->input->post("nilai_tu5_$i");
			}
			if ($itemnilai=='6')
			{
				$nilai1 = $this->input->post("nilai_uh6_$i");
				$nilai2 = $this->input->post("nilai_tu6_$i");
			}
			if ($itemnilai=='7')
			{
				$nilai1 = $this->input->post("nilai_uh7_$i");
				$nilai2 = $this->input->post("nilai_tu7_$i");
			}
			if ($itemnilai=='8')
			{
				$nilai1 = $this->input->post("nilai_uh8_$i");
				$nilai2 = $this->input->post("nilai_tu8_$i");
			}
			if ($itemnilai=='9')
			{
				$nilai1 = $this->input->post("nilai_uh9_$i");
				$nilai2 = $this->input->post("nilai_tu9_$i");
			}
			if ($itemnilai=='10')
			{
				$nilai1 = $this->input->post("nilai_uh10_$i");
				$nilai2 = $this->input->post("nilai_tu10_$i");
			}
			if((!empty($materi)) and (!empty($nomor_materi)))
			{ 
				if (($itemnilai==1) or ($itemnilai==2) or ($itemnilai==3) or ($itemnilai==4) or ($itemnilai==5) or ($itemnilai==6) or ($itemnilai==7) or ($itemnilai==8) or ($itemnilai==9) or ($itemnilai==10))
				{
					if($nilai_nr < $kkm)
					{
						$in2["positif"] = 0;
					}
					else
					{
						$in2["positif"] = 1;
					}
					$in2["nis"]=$this->input->post("nis_$i");
					$in2["ket"] = deskripsi_nilai_2015($nilai_nr,$kkm);
					$this->bimtik->Simpan_Capaian_Kompetensi($in2);
				}
			}
			$this->bimtik->Update_Nilai($in);
		}
		redirect('bimtik/daftarnilai/'.$id_mapel);
	}
	function cetaklck($tahun1=null,$semester=null,$id_kelas=null,$nis=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Rapor';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax["kodeguru"] = $data["nim"];	
		$this->load->model('Pengajaran_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_kelas'] = $id_kelas;
		$datax['nis'] = $nis;
		if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_kelas)) and (!empty($nis)))
		{
			define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->library('fpdf');
			$this->load->view('pdf/rapor_siswa_tik', $datax);
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/mencetak_rapor',$datax);
			$this->load->view('shared/bawah');
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
		$data["kodeguru"] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['id_mapel'] = $id_mapel;
		$data['judulhalaman'] = 'Nilai Per Siswa';
		$data['nomor_urut'] = $nomor_urut;
		$data['aksi'] = $aksi;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/nilai_per_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function updatenilaipersiswa($nomor_urut=null,$id_mapel=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$tmapel = $this->bimtik->Id_Mapel($id_mapel,$kodeguru);
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
			$nilai_mid=$this->input->post("tu5");
			$nilai_uas=$this->input->post("tu6");
			$nilai_ku1=$this->input->post("tu7");
			$nilai_ku2=$this->input->post("tu8");
			$nilai_ku3=$this->input->post("tu9");
			$nilai_ku4=$this->input->post("tu10");
			if($cacah_ulangan_harian > 0)
			{
				$ruh = ($nilai_uh1 + $nilai_uh2 + $nilai_uh3 + $nilai_uh4 + $nilai_uh5 + $nilai_uh6 + $nilai_uh7 + $nilai_uh8 + $nilai_uh9 + $nilai_uh10) / $cacah_ulangan_harian;
				$rtu = ($nilai_tu1 + $nilai_tu2 + $nilai_tu3 + $nilai_tu4) / $cacah_ulangan_harian;
			}
			else
			{
				$ruh = 0;
				$rtu = 0;
			}
			$nilai_rapor = ($ruh + $rtu ) / 2;
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
			$in["nilai_na"]=$ruh;
			$in["nilai_tu"]=$rtu;
			$in["nilai_nr"]=$nilai_rapor;
			$this->bimtik->Update_Nilai($in);
		}
		redirect('bimtik/nilaipersiswa/'.$nomor_urut.'/'.$id_mapel);
	
	}
	function hapus()
	{
		$penilaian = $this->uri->segment(3);
		$this->bimtik->Hapus_Deskripsi($penilaian);			
		echo 'Berhasil, menghapus deskripsi, tutup saja jendela ini';
	}
	function rpp()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'RPP BK TIK';
		$data['tekseditor'] = '';
		$this->load->model('Guru_model','guru');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
		if (empty($aksi))
			{
			redirect('guru/rpp/tampil');
			}
      		$limit_ti=5;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$kodeguru = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$ta = $this->bimtik->Tampil_Rpp($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->bimtik->Total_Rpp_Induk($kodeguru);
      		$config['base_url'] = base_url() . 'bimtik/rpp/tampil/';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('ta'=>$ta,'paginator'=>$paginator, 'page'=>$page,'kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_bimtik_rpp'=>$page);
		$in=array();
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['semester'] = $this->input->post('semester');
		$in['no_rpp'] = $this->input->post('no_rpp');
		$in['waktu'] = $this->input->post('waktu');
		$in['kelas'] = $this->input->post('kelas');
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
			$this->bimtik->Tambah_Rpp($in);
			redirect('bimtik/rpp/tampil');
			} 
		if ($post_aksi == 'ubah_data')
			{
			$in['id_bimtik_rpp'] = $this->input->post('id_bimtik_rpp');
			$this->bimtik->Update_Rpp($in);
			redirect('bimtik/rpp/tampil');
			}
		if ($aksi== 'hapus')
			{
			$this->bimtik->Hapus_Rpp($page,$kodeguru);
			redirect('bimtik/rpp/tampil');
			} 
		if ($aksi== 'unduh')
			{
			$this->load->view('bimtik/rpp_unduh_csv',$data_isi);
			}
		if (($aksi== 'tambah') or ($aksi=='ubah'))
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/rpp_induk_tambah',$data_isi);
			$this->load->view('shared/bawah');
			}
		else if (($post_aksi=='salin_data') or ($aksi == 'salin'))
			{
			$id_guru_rpp_induk = $this->input->post('id_kopi');
	        	$data_isi = array('kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_bimtik_rpp'=>$id_bimtik_rpp);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/rpp_induk_tambah',$data_isi);			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/rpp',$data_isi);
			$this->load->view('shared/bawah');
			}
	}
	function rph()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Rencana Harian BK TIK';
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
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data["kodeguru"] = $kodeguru;
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$this->load->library('Pagination');	
		$page=$this->uri->segment(5);
		$id_rph=$this->uri->segment(6);
      		$limit_ti=10;
		if(!$page):
			$offset_ti = 0;
			else:
			$offset_ti = $page;
			endif;
		$query=$this->bimtik->Tampil_Bph2_Guru($thnajaran,$semester,$kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->bimtik->Total_Bph2_Guru($thnajaran,$semester,$kodeguru);
      		$config['base_url'] = base_url() . 'bimtik/rph/'.$tahun1.'/'.$semester;
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
		$this->load->view('bimtik/rph2',$data);
		$this->load->view('shared/bawah');
	}
	function rphlain2()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Rencana Harian BK TIK';
		$this->load->model('Guru_model','guru');
		$data["kodeguru"] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
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
			$this->load->view('bimtik/bph_lain_edit2',$data);
			}
			else
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/rph_lain2',$data);
			}
			$this->load->view('shared/bawah');
	}
	function haritatapmuka()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hari tatap Muka BK TIK';	
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$datax['thnajaran']=cari_thnajaran();
		$datax['semester']=cari_semester();
		$datax['is_new']=$this->input->post("is_new");
		$datax['id_mapel'] =$this->input->post("id_mapel");
		$datax['jam_ke'] =$this->input->post("jam_ke");
		$datax['id_hari'] =$this->input->post("id_hari");
		$datax['hari_tatap_muka'] =$this->input->post("hari_tatap_muka");
		$datax['jtm'] =$this->input->post("jtm");
		$datax['kodeguru'] = $kodeguru;
		$datax['aksi']= $this->uri->segment(3);
		$datax['id_hari_tatap_muka']= $this->uri->segment(4);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('bimtik/hari_tatap_muka',$datax);
		$this->load->view('shared/bawah');
	}
	function tambahrphlain2()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Rencana Harian BK TIK';
		$this->load->model('Guru_model','guru');
		$kodeguru = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$in=array();
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$kelas=$this->input->post('kelas');
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
		if ((!empty($thnajaran)) and(!empty($semester)) and (!empty($kelas)) and (!empty($tanggalrph))) 
		{
			$kode_rpp = $this->input->post('kode_rpp');
			$sudahada = $this->bimtik->Cek_Rph2($thnajaran,$semester,$kelas,$tanggalrph,$kodeguru,$jamke);
			$in['thnajaran']=$this->input->post('thnajaran');
			$in['semester']=$this->input->post('semester');
			$in['kodeguru']=$this->input->post('kodeguru');
			$in['kode_rpp']=$kode_rpp;
			$in['hambatan_siswa']=$this->input->post('hambatan_siswa');
			$in['keterangan']=$this->input->post('keterangan');
			$in['tanggal']=$tanggalrph;
			$in['tanggal_bph']=$tanggalbph;
			$in['kelas'] = $kelas;
			$in['jamke'] =$this->input->post('jam_ke');
			$in['lab'] = $lab;
			$in['alat_dan_bahan'] = $alat_dan_bahan;
			if ($sudahada==0)
			{
				$in = hilangkanpetik($in);
				$this->bimtik->Tambah_Rph2($in);
			}
			else
			{
				$in['id_rph']=$id_rph;
				$in = hilangkanpetik($in);
				$this->bimtik->Update_Rph2($in);
			}
			$this->load->view('guru/bg_atas',$data);
			$datax['thnajaran'] = $thnajaran;
			$datax['semester'] = $semester;
			$datax['kelas'] = $kelas;
			$datax['kodeguru'] = $kodeguru;
			$datax['tanggalrph'] = $tanggalrph;
			$this->load->view('bimtik/rph_lihat2',$datax);
			$this->load->view('shared/bawah');
		}
		else
		{
			$data['kodeguru'] = $kodeguru;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('bimtik/rph_lain2',$data);
			$this->load->view('shared/bawah');
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
		$this->bimtik->Delete_Rph2($id,$kodeguru);
		redirect('bimtik/rph');
	}
	function ubahrph($id=null,$tahun1=null,$semester=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah RPH BK TIK';
		$data['tekseditor'] = '';
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$trph = $this->bimtik->Id_Rph2($id,$kodeguru);
		$data['id_rph']=$id;
		$data["kodeguru"]=$kodeguru;
		$ada = $trph->num_rows();
		if ($ada>0)
		{
			$data['thnajaranx'] = cari_thnajaran();
			$this->load->view('guru/bg_atas',$data);
			if((!empty($tahun1)) and (!empty($semester)))
			{
				$this->load->view('bimtik/rph_edit_ganti_tahun2',$data);
			}
			else
			{
				$this->load->view('bimtik/rph_edit2',$data);
			}
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('bimtik/rph');
		}
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
		$data['kelas']=$this->input->post('kelas');
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
		if ((!empty($thnajaran)) and(!empty($semester)) and (!empty($data['kelas'])) and (!empty($tanggalrph))) 
		{
			$sk = $this->input->post('sk');
			$kd = $this->input->post('kd');
			$kelas = id_mapel_jadi_mapel($data['kelas']);
			$jamke=$this->input->post('jamke');
			$sudahada = $this->bimtik->Cek_Rph2($thnajaran,$semester,$data['kelas'],$tanggalrph,$kodeguru,$jamke);
			$in['thnajaran']=$this->input->post('thnajaran');
			$in['semester']=$this->input->post('semester');
			$in['kodeguru']=$this->input->post('kodeguru');
			$in['kode_rpp']=$this->input->post('kode_rpp');
			$in['jamke']=$this->input->post('jamke');
			$in['hambatan_siswa']=$this->input->post('hambatan_siswa');
			$in['solusi']=$this->input->post('solusi');
			$in['keterangan']=$this->input->post('keterangan');
			$in['tanggal']=$tanggalrph;
			$in['tanggal_bph']=$tanggalbph;
			$in['kelas'] = $data['kelas'];
			$in['lab'] = $lab;
			$in['alat_dan_bahan'] = $alat_dan_bahan;
			if ($sudahada==0)
			{
				$in = hilangkanpetik($in);
				$this->bimtik->Tambah_Rph2($in);
			}
			else
			{
				$in['id_rph']=$id_rph;
				$in = hilangkanpetik($in);
				$this->bimtik->Update_Rph2($in);
			}
			redirect('bimtik/rph');
		}
		else
		{
			redirect('bimtik/rph');
		}
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
			$data['yangdicetak'] = 'Daftar Nilai Keterampilan';
			if ($diproses == 'oke')
				{
				$data['judulhalaman'] = 'Daftar Nilai Keterampilan Bimbingan TIK '.$data["nim"];
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('bimtik/mencetak_daftar_nilai_psikomotor',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Nilai Keterampilan Bimbingan TIK';
				$this->load->view('bimtik/form_mencetak_daftar_nilai_psikomotor',$data);
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
				$this->load->view('bimtik/mencetak_daftar_nilai_kognitif',$data);
				}
				else
				{
				$data['judulhalaman'] = 'Mencetak Daftar Nilai Kognitif';
				$this->load->view('bimtik/form_mencetak_daftar_nilai_kognitif',$data);
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
			$this->load->view('bimtik/form_mencetak',$data);
			}
			if ($diproses != 'oke') 
			{
			$this->load->view('shared/bawah');
			}

	}

/* akhir controller */
}
?>
