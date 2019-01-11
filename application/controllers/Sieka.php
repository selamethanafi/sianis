<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 18 Agu 2018 07:33:55 WIB 
// Nama Berkas 		: Sieka.php
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
class Sieka extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
		$this->load->model('Guru_model', 'sieka');		
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
		$data['judulhalaman'] = 'Jembatan Sieka';
		$data['base_url'] = substr(base_url(),0,5);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/sieka_index',$data);
		$this->load->view('shared/bawah');
	}
	function ubahdata()
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
		$data['judulhalaman'] = 'Jembatan Sieka';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/sieka_ubah_data',$data);
		$this->load->view('shared/bawah');
	}
	function updatepassword()
	{
		$data["nim"]=$this->session->userdata('username');
		$nip=$this->sieka->get_NIP($data["nim"]);
		$passwd = addslashes($this->input->post('passwd'));
		$id_pns = hilangkanpetik($this->input->post('id_pns'));
		$this->db->query("update `sieka_user` set `passwd`='$passwd', `id_pns`='$id_pns' where `nip`='$nip'");
		redirect('sieka');

	}
	function login()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Login Sieka';
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$this->load->view('sieka/sieka_login',$data);
	}
	function login2()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Login Sieka';
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$this->load->view('sieka/sieka_login',$data);
	}

	function tahunan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah data ID kegiatan tahunan';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper('pkg');
		$this->load->model('Situs_model');
		$this->load->model('sieka');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/tahunan',$data);
		$this->load->view('shared/bawah');
	}
	function tahunanid($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah data ID kegiatan tahunan';
		$data["nama"]=$this->session->userdata('nama');
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$data["id"] = $id;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/tahunan_id',$data);
		$this->load->view('shared/bawah');
	}
	function simpantahunanid($id)
	{
		$data["nim"]=$this->session->userdata('username');
		$nip=$this->sieka->get_NIP($data["nim"]);
		$id_tahunan = hilangkanpetik($this->input->post('id_tahunan'));
		$this->db->query("update `skp_skor_guru` set `id_tahunan`='$id_tahunan' where `nip`='$nip' and `id_skp_skor_guru`='$id'");
		redirect('sieka/tahunan');

	}
	function bulanan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Kegiatan bulanan';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper('pkg');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/bulanan',$data);
		$this->load->view('shared/bawah');
	}
	function bulananid($bulan=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah data ID kegiatan Bulanan';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper('pkg');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$data['bulan']= $bulan;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/bulanan_id',$data);
		$this->load->view('shared/bawah');
	}
	function simpanbulananid()
	{
		$data["nim"]=$this->session->userdata('username');
		$nip=$this->sieka->get_NIP($data["nim"]);
		$cacah = hilangkanpetik($this->input->post("cacah"));
		for($i=1;$i<$cacah;$i++)
		{
			$id_sieka_bulanan = hilangkanpetik($this->input->post("id_sieka_bulanan_$i"));
			$id_bulanan = hilangkanpetik($this->input->post("id_bulanan_$i"));
			$this->db->query("update `sieka_bulanan` set `id_bulanan` = '$id_bulanan' where `nip`='$nip' and `id_sieka_bulanan`='$id_sieka_bulanan'");
		}
		redirect('sieka/bulanan');

	}
	function harian($thn=null,$bln=null,$tgl=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Daftar Kegiatan Harian';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper('pkg');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$data['thn'] = $thn;
		$data['bln'] = $bln;
		$data['tgl'] = $tgl;
		$data['loncat'] = '';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/harian',$data);
		$this->load->view('shared/bawah');
	}
	function kirim($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Kirim Kegiatan Harian';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper('pkg');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$data['id'] = $id;
		$data['adamenu'] = '';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/harian_kirim',$data);
		$this->load->view('shared/bawah');
	}
	function tampil()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$kd = $this->session->userdata('username');
		$data['judulhalaman'] = 'Lihat Sieka';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/sieka_tampil',$data);
		$this->load->view('shared/bawah');
	}
	function unduhskp($tahun=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['nip'] = $this->sieka->get_NIP($data["nim"]);
		$data['tahun']= $tahun;
		$this->load->library('excel');
		$this->load->view('guru/unduh_borang_skp',$data);
	}
	function hapus($id=null)
	{
		$nim=$this->session->userdata('username');
		$nip=$this->sieka->get_NIP($nim);
		$this->db->query("delete from `sieka_harian` where `nip`='$nip' and `id_sieka_harian`='$id'");
		redirect('sieka/harian');

	}
	function funggahkodebulanan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Kegiatan bulanan';
		$data["nama"]=$this->session->userdata('nama');
		$data['nip']=$this->sieka->get_NIP($data["nim"]);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('sieka/form_unggah_kode_bulanan',$data);
		$this->load->view('shared/bawah');
	}
	function prosesunggahkodebulanan()
	{
		$data["nim"]=$this->session->userdata('username');
		$nim = $this->session->userdata('username');
		$nip=$this->sieka->get_NIP($nim);
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
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if(isset($field['id_bulanan']))
					{
						$id_bulanan = nopetik($field['id_bulanan']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' id_bulanan';
						$id_bulanan = '';
					}
					if(isset($field['kegiatan']))
					{
						$kegiatan = nopetik($field['kegiatan']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' kegiatan';
						$kegiatan = '';
					}
					if(isset($field['tahun']))
					{
						$tahun = nopetik($field['tahun']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' tahun';
						$tahun = '';
					}

					if ($adagalat==0)
					{
						$this->db->query("update `sieka_bulanan` set `id_bulanan` = '$id_bulanan' where `kegiatan`='$kegiatan' and `tahun`='$tahun' and `nip`='$nip'");
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink($filePath);
				$datay['modul'] = 'Unggah ID Kegiatan Bulanan';
				$datay['tautan_balik'] = ''.base_url().'sieka/funggahkodebulanan';
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$this->load->view('guru/bg_head',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					redirect('sieka/bulanan');
				}
			} //akhir kalau tidak error upload
		} // akhir kalau ada file terkirim
	}//kalau tatausaha

/* akhir controller */
}
?>
