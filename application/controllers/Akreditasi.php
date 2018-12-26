<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : akreditasi.php
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


class Akreditasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
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
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->model('Situs_model');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function indikator($tahun1=null,$semester=null,$id_mapel=null,$ulangan=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['sukses'] = '';
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Indikator Penilaian';
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$proses = $this->input->post('proses');
		if(($proses == 'baru') or ($proses == 'lama'))
		{
			$thnajaran = $this->input->post('post_thnajaran');
			$semester = $this->input->post('post_semester');
			$kelas = $this->input->post('post_kelas');
			$mapel = $this->input->post('post_mapel');
			$id_mapel = $this->input->post('post_id_mapel');
			$ulangan = $this->input->post('post_ulangan');
			$cacah_soal = $this->input->post('post_cacah_soal');
			$data['tahun1'] = substr($thnajaran,0,4);
			$data['semester'] = $semester;
			$data['id_mapel'] = $id_mapel;
			$data['mapel'] = $mapel;
			$data['ulangan'] = $ulangan;
			$data['cacah_soal'] = $cacah_soal;


			if($proses == 'baru')
			{
				$kumpulan_field = '`thnajaran`,`semester`,`kelas`,`mapel`,`ulangan`';
				$value_field = '\''.$thnajaran.'\',\''.$semester.'\',\''.$kelas.'\',\''.$mapel.'\',\''.$ulangan.'\'';
				for($i=1;$i<=$cacah_soal;$i++)
				{
					$adapost = $this->input->post('indikator_'.$i);
					if(isset($adapost))
					{
						if(empty($kumpulan_field))
						{
							$kumpulan_field .= '`i_'.$i.'`';
							$value_field .= '\''.nopetik($this->input->post('indikator_'.$i)).'\'';
						}
						else		
						{
							$kumpulan_field .= ',`i_'.$i.'`';
							$value_field .= ',\''.nopetik($this->input->post('indikator_'.$i)).'\'';
						}
					}
				}
				if((!empty($kumpulan_field)) and (!empty($value_field)))
				{
					$input = '('.$kumpulan_field.') values ('.$value_field.')';
					$this->load->model('Guru_model');
					$this->Guru_model->Simpan_Indikator($input);
					$data['sukses'] = 'sukses';
				}
				else
				{
					$data['sukses'] = 'tidak sukses';
				}
			}
			if($proses == 'lama')
			{
				$kumpulan_field = '';
				for($i=1;$i<=$cacah_soal;$i++)
				{
					$adapost = $this->input->post('indikator_'.$i);
					if(isset($adapost))
					{
						if(empty($kumpulan_field))
						{
							$kumpulan_field .= '`i_'.$i.'` = \''.nopetik($this->input->post('indikator_'.$i)).'\'';
						}
						else		
						{
							$kumpulan_field .= ', `i_'.$i.'` = \''.nopetik($this->input->post('indikator_'.$i)).'\'';
						}
					}
				}
				if(!empty($kumpulan_field))
				{
					$input = ''.$kumpulan_field.' where `thnajaran`=\''.$thnajaran.'\' and `semester`=\''.$semester.'\' and `kelas`=\''.$kelas.'\' and `mapel`=\''.$mapel.'\' and `ulangan`=\''.$ulangan.'\'';
					$this->load->model('Guru_model');
					$this->Guru_model->Perbarui_Indikator($input);
					$data['sukses'] = 'sukses';
				}
				else
				{
					$data['sukses'] = 'tidak sukses';
				}
			}
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/indikator',$data);
		$this->load->view('shared/bawah');
	}
	function simpanindikator()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$proses = $this->input->post('proses');
		$tautan = $this->input->post('tautan');
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$kelas = $this->input->post('kelas');
		$mapel = $this->input->post('mapel');
		$ulangan = $this->input->post('ulangan');
		$cacah_soal = $this->input->post('cacah_soal');
		if($proses == 'baru')
		{
			$kumpulan_field = '`thnajaran`,`semester`,`kelas`,`mapel`,`ulangan`';
			$value_field = '\''.$thnajaran.'\',\''.$semester.'\',\''.$kelas.'\',\''.$mapel.'\',\''.$ulangan.'\'';
			for($i=1;$i<=$cacah_soal;$i++)
			{
				$adapost = $this->input->post('indikator_'.$i);
				if(isset($adapost))
				{
					if(empty($kumpulan_field))
					{
						$kumpulan_field .= '`i_'.$i.'`';
						$value_field .= '\''.nopetik($this->input->post('indikator_'.$i)).'\'';
					}
					else		
					{
						$kumpulan_field .= ',`i_'.$i.'`';
						$value_field .= ',\''.nopetik($this->input->post('indikator_'.$i)).'\'';
					}
				}
			}
			if((!empty($kumpulan_field)) and (!empty($value_field)))
			{
				$input = '('.$kumpulan_field.') values ('.$value_field.')';
				$this->load->model('Guru_model');
				$this->Guru_model->Simpan_Indikator($input);
			}
		}
		if($proses == 'lama')
		{
			$kumpulan_field = '';
			for($i=1;$i<=$cacah_soal;$i++)
			{
				$adapost = $this->input->post('indikator_'.$i);
				if(isset($adapost))
				{
					if(empty($kumpulan_field))
					{
						$kumpulan_field .= '`i_'.$i.'` = \''.nopetik($this->input->post('indikator_'.$i)).'\'';
					}
					else		
					{
						$kumpulan_field .= ', `i_'.$i.'` = \''.nopetik($this->input->post('indikator_'.$i)).'\'';
					}
				}
			}
			if(!empty($kumpulan_field))
			{
				$input = ''.$kumpulan_field.' where `thnajaran`=\''.$thnajaran.'\' and `semester`=\''.$semester.'\' and `kelas`=\''.$kelas.'\' and `mapel`=\''.$mapel.'\' and `ulangan`=\''.$ulangan.'\'';
				$this->load->model('Guru_model');
				$this->Guru_model->Perbarui_Indikator($input);
			}
		}
		redirect($tautan);
	}
	function materi($tahun1=null,$semester=null,$id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['loncat']='';
		$data['sukses']='';
		$data['judulhalaman'] = 'Materi Pelajaran';
		$proses = $this->input->post('proses');
		if(($proses == 'baru') or ($proses=='lama'))
		{
			$id_mapel = $this->input->post('post_id_mapel');
			$cacah_materi = $this->input->post('cacah_materi');
			$kumpulan_field = '';
			$data['tahun1'] = $this->input->post('post_tahun1');
			$data['semester'] = $this->input->post('post_semester');
			$data['id_mapel'] = $this->input->post('post_id_mapel');
			for($i=1;$i<=$cacah_materi;$i++)
			{
				if(empty($kumpulan_field))
				{
					$kumpulan_field .= '`materi'.$i.'` = \''.nopetik($this->input->post('materi'.$i)).'\'';
				}
				else
				{
					$kumpulan_field .= ', `materi'.$i.'` = \''.nopetik($this->input->post('materi'.$i)).'\'';
				}
			}
			if(!empty($kumpulan_field))
			{
				$input = ''.$kumpulan_field.' where `id_mapel`=\''.$id_mapel.'\'';
				$this->load->model('Guru_model');
				$this->Guru_model->Simpan_Materi($input);
				$data['sukses'] = 'sukses';
			}
			else
			{
				$data['sukses'] = 'tidak sukses';
			}
		}
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/materi',$data);
		$this->load->view('shared/bawah');
	}
	function rancanganremidial($id=null,$itemnilai=null,$ditandatangani=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Rancangan Program Remidial';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$data['id_mapel']=$id;
		$data['itemnilai']=$itemnilai;
		$data["kodeguru"]= $kodeguru;
		$ada = $tmapel->num_rows();
		if($ada == 0)
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
				$this->load->model('Referensi_model');
				$data['baris1'] = $this->Referensi_model->ambil_nilai('baris1');
				$data['baris2'] = $this->Referensi_model->ambil_nilai('baris2');
				$data['baris3'] = $this->Referensi_model->ambil_nilai('baris3');
				$data['baris4'] = $this->Referensi_model->ambil_nilai('baris4');
				$data['lokasi'] = $this->Referensi_model->ambil_nilai('lokasi');
				$this->load->view('shared/bg_atas_cetak_landscape',$data);
				$this->load->view('guru/rancangan_program_remidial',$data);
			}
		}
	}
	function saran($id=null,$itemnilai=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$tmapel = $this->Guru_model->Id_Mapel($id,$kodeguru);
		$datax['id_mapel']=$id;
		$datax['itemnilai']=$itemnilai;
		$datax["kodeguru"]= $kodeguru;
		$datax['tersimpan'] = '';
		$cacah_siswa = hilangkanpetik($this->input->post('cacah_siswa'));
		$kumpulan_field = '';
		$itemkomentar = 'komentar_'.$itemnilai;
		if($cacah_siswa>0)
		{
			for($i=1;$i<=$cacah_siswa;$i++)
			{
				$id_komentar = hilangkanpetik($this->input->post('id_komentar_'.$i));
				$komentar = hilangkanpetik($this->input->post('komentar_'.$i));
				$this->Guru_model->Simpan_Saran($id_komentar,$itemkomentar,$komentar);
			}
			$datax['tersimpan'] = 'Tersimpan';
		}
		$data['judulhalaman'] = 'Komentar / Saran Atas Hasil Ulangan atau Tugas Siswa';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/saran',$datax);
		$this->load->view('shared/bawah');
	}

// akhir controller
}


?>
