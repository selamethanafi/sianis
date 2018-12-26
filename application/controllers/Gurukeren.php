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
class Gurukeren extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'fungsi'));
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
	function skor($id_mapel=null,$itemnilai=null,$aksi=null)
	{
		if((empty($id_mapel)) or (empty($itemnilai)))
		{
			redirect('guru');
		}
		if(($itemnilai == 'uh1') or ($itemnilai == 'uh2') or ($itemnilai == 'uh3') or ($itemnilai == 'uh4') or ($itemnilai == 'uh5') or ($itemnilai == 'uh6') or ($itemnilai == 'uh7') or ($itemnilai == 'uh8') or ($itemnilai == 'uh9') or ($itemnilai == 'uh10') or ($itemnilai == 'mid') )
		{
			
			$cacah = $this->input->post('cacah');
			if($cacah>0)
			{
				$str = '';
				for($i=1;$i<=$cacah;$i++)
				{
					if(empty($str))
					{
						$iteme = 's'.$i;
						$nilai = $this->input->post("s_$i");
						$str .= "`$iteme` = '$nilai'";
					}
					else
					{
						$iteme = 's'.$i;
						$nilai = $this->input->post("s_$i");
						$str .= ", `$iteme` = '$nilai'";
					}
				}
				$this->db->query("update `analisis_skor` set $str where `id_mapel` = '$id_mapel' and `itemnilai` = '$itemnilai'");
				redirect('guru/analisis/'.$id_mapel.'/'.$itemnilai);
			}

			if($aksi == 'tidakdipakai')
			{
				$this->db->query("update `analisis_skor` set `dipakai`='0' where `id_mapel`='$id_mapel'");
				redirect('guru/analisis/'.$id_mapel.'/'.$itemnilai);
			}
			$in=array();
			$data['nim']=$this->session->userdata('username');
			$data['id_mapel'] = $id_mapel;
			$data['itemnilai'] = $itemnilai;
			$data['judulhalaman'] = 'Skor Penilaian / Ulangan';
			$this->load->model('Guru_model');
			$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/analisis_skor',$data);
			$this->load->view('shared/bawah');
		}
	}
	function dayabeda($id_mapel=null,$ulangan=null,$id=null)
	{
		define('dayabeda',$id_mapel);
		$data["nim"]=$this->session->userdata('username');
		$data["id_mapel"] = $id_mapel;
		$id = $id * 1;
		if($id < 1)
		{
			$id = 1;
		}
		$data["id"] = $id;
		$data["ulangan"] = $ulangan;

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
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['dataguru']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]);
		$data['ulangan']=$ulangan; 	 	
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
			$data['nsoal'] = $nsoal;
			$data['skor'] = $skor;
			$data['skora'] = $skora;
			$data['skorb'] = $skorb;
			$data['nsoalb'] = $nsoalb;
			$data['kkm_ulangan'] = $kkm_ulangan;
			$data['kodeguru'] = $kodeguru;
			$data['judulhalaman'] = 'Memproses Daya Beda';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/analisis_daya_beda',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function perbaruidaftarsiswaakhlak($id_m_akhlak=null,$cacahitem=null,$id=null)
	{
		$data = array();
		$data['judulhalaman'] = 'Pemutakhiran Daftar Siswa';
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$tmapel = $this->Guru_model->Id_M_Akhlak($id_m_akhlak,$kodeguru);
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
			}
			$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
			$data['total_siswa'] = $daftar_siswa->num_rows();
			$data['kelas'] = $kelas;
			$data['thnajaran'] = $dtmapel->thnajaran;
			$data['semester'] = $dtmapel->semester;
			$data['id'] = $id;
			$data['id_m_akhlak'] = $id_m_akhlak;
			$data['kodeguru'] = $kodeguru;
			$data['cacahitem'] = $cacahitem;
			$this->load->view('guru/bg_atas_min',$data);
			$this->load->view('guru/daftar_siswa_akhlak_baru',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}

/* akhir controller */
}
?>
