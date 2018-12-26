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
class Guruard extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
		$this->load->model('Referensi_model','ref');
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
	function subjects_value($id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');	
		$data['judulhalaman'] = 'Kode Mapel dari ARD';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			$post_subjects_value = $this->input->post('post_subjects_value');
			if(!empty($post_subjects_value))
			{
				$this->db->query("update `m_mapel` set `subjects_value`='$post_subjects_value' where `kodeguru`='$kodeguru' and `id_mapel`='$id_mapel'");
				redirect('guru/daftarnilai/'.$id_mapel);
			}
			foreach($tmapel->result() as $dtmapel)
			{
				$data['subjects_value'] = $dtmapel->subjects_value;
			}
			$data['judulhalaman'] = 'Kode Mata Pelajaran dari ARD';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/subjects_value',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function kirimnilai($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Kirim Daftar Nilai Siswa ke ARD';
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
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$data['subjects_value'] = $subjects_value;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/kirim_daftar_nilai_ke_ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect ('guru');
		}
	}
	function unggahkodenilai($id_mapel=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->Guru_model->Id_Mapel($id_mapel,$kodeguru);
		$ada = $tmapel->num_rows();
		if ($ada ==0)
		{
			redirect('guru');
		}
		else
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
			$data["judulhalaman"]= 'Unggah Kode Nilai dari ARD';
			$this->load->library('csvimport');
			$config['allowed_types'] ='csv';
			$config['upload_path'] = 'uploads';
			$filename = $id_mapel.'.csv';	
			$config['file_name'] = $filename;
			$config['overwrite'] = TRUE;	
			$this->load->library('upload', $config);
			$pesan = '';
			$prov = $this->ref->ambil_nilai('kode_un_prov');
			$kab = $this->ref->ambil_nilai('kode_un_kab');
			$sek = $this->ref->ambil_nilai('kode_un_sekolah');
			$kode_awal_un = $prov.$kab.$sek;
			if(!empty($_FILES['userfile']['name']))
			{
				if(!$this->upload->do_upload())
				{
				 	$data['pesan'] = $this->upload->display_errors();
					$data['modul'] = 'Unggah Kode Nilai dari ARD';
					$data['tautan_balik'] = base_url().'guruard/unggahkodenilai/'.$id_mapel;
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('shared/adagalat',$data);
					$this->load->view('shared/bawah');
				}
				else 
				{
					$filePath = 'uploads/'.$filename;
					if ($this->csvimport->get_array($filePath))
					{
						$csvData = $this->csvimport->get_array($filePath);	
						$adagalat = 0;
						$n=0;
						foreach($csvData as $field):
						$baris = $n+1;
						$pesan .= 'Baris '.$baris.' Kolom';
						$pnisn = 1;
						if(isset($field['student_id']))
						{
							$student_id = hilangkanpetik($field['student_id']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' student_id';
							$student_id = '';
						}
						if(isset($field['student_value']))
						{
							$student_value = hilangkanpetik($field['student_value']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' student_value';
							$student_value = '';
						}
						if ($adagalat==0)
						{
							$nis = '';
							$ta = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `id_ard_siswa` = '$student_id'");
							foreach($ta->result() as $a)
							{
								$nis = $a->nis;
							}
							$this->db->query("update `nilai` set `student_value`='$student_value' where `nis`='$nis' and `mapel`='$mapel' and `thnajaran`='$thnajaran' and `semester`='$semester'");
						}
						$pesan .= ' TIDAK ADA<br />';
						$n++;
						endforeach;
						unlink($filePath);
						if($adagalat==1)
						{
							$datay['modul'] = 'Unggah Kode Nilai dari ARD';
							$datay['tautan_balik'] = ''.base_url().'guruard/unggahkodenilai/'.$id_mapel;
							$datay['pesan'] = $pesan;
							$this->load->view('guru/bg_atas',$data);
							$this->load->view('guru/adagalat',$datay);
							$this->load->view('shared/bawah',$data);
						}
						else
						{
							redirect('guruard/kirimnilai/'.$id_mapel);
						}
					}
				}
			}
			else
			{
				$data['id_mapel'] = $id_mapel;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('ard/ungggah_kode_nilai_dari_ard',$data);
				$this->load->view('shared/bawah');
			}
		}
	}
	function unduhkodenilai($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Mengunduh Kode Nilai Siswa ke ARD';
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
				$ranah = $dtmapel->ranah;
				$pilihan = $dtmapel->pilihan;
				$kurikulum = cari_kurikulum($dtmapel->thnajaran,$dtmapel->semester,$dtmapel->kelas);
			}
			if(empty($subjects_value))
			{
				redirect('guruard/subjects_value/'.$id);	
			}
			$data['kurikulum'] = $kurikulum;
			$data['pilihan'] = $pilihan;
			$data['kkm'] = $kkm;
			$data['ranah'] = $ranah;
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
			$data['subjects_value'] = $subjects_value;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/unduh_kode_nilai_dari_ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect ('guru');
		}
	}
	function kirimnilaiakhir($id=null,$nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Kirim Daftar Nilai Siswa ke ARD';
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
			}
			if(empty($subjects_value))
			{
				redirect('guruard/subjects_value/'.$id);	
			}
			$data['kurikulum'] = $kurikulum;
			$data['pilihan'] = $pilihan;
			$data['kkm'] = $kkm;
			$data['ranah'] = $ranah;
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['nomor'] = $nomor;
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$data['subjects_value'] = $subjects_value;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/kirim_daftar_nilai_akhir_ke_ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect ('guru');
		}
	}
	function fkirimnilaiakhir($id=null,$nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Kirim Daftar Nilai Siswa ke ARD';
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
			}
			if(empty($subjects_value))
			{
				redirect('guruard/subjects_value/'.$id);	
			}
			$data['kurikulum'] = $kurikulum;
			$data['pilihan'] = $pilihan;
			$data['kkm'] = $kkm;
			$data['ranah'] = $ranah;
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('guru/ubahkkm/'.$id);
			}
			$data['adamenu'] = '';
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['nomor'] = $nomor;
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$data['subjects_value'] = $subjects_value;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/frame_kirim_daftar_nilai_akhir_ke_ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect ('guru');
		}
	}
	function ard($hal=null,$id_walikelas=null,$nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Tanggapan Walikelas';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];	
		$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
		$data['id_walikelas']=$id_walikelas;
		$data['hal'] = $hal;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
			foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['id_walikelas']=$id_walikelas;
			$data['nomor'] = $nomor;
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function tanggapanwalikelas($id_walikelas=null,$nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Tanggapan Walikelas';
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
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['id_walikelas']=$id_walikelas;
			$data['adamenu'] = '';
			$data['nomor'] = $nomor;
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('ard/ftanggapan_walikelas',$data);
			$this->load->view('shared/bawah');
		}
	}

/* akhir controller */
}
?>
