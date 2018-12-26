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
class Ekstrakurikuler extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'fungsi'));
		$this->load->database();
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
		redirect('guru');
	}
	function borang()
	{
		$nim=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($nim);	
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$tcacah = $this->Guru_model->Cek_Guru_Ekstra($thnajaran,$semester,$kodeguru);
		$cacah = $tcacah->num_rows();
		if($cacah == 0)
		{
			redirect('guru/ekstrakurikuler');
		}
		else
		{
			$data['judulhalaman'] = 'Borang Unggah Nilai Ekstrakurikuler';
			$data['nim'] = $nim;
			$data['thnajaran'] = cari_thnajaran();
			$data['semester'] = cari_semester();
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/borang_unggah_nilai_ekstrakurikuler',$data);
			$this->load->view('shared/bawah');
		}
	}
	function proses()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;
		$filename = 'nilai_ekstra_'.$data["nim"].'.csv';	
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$datay['modul'] = 'Unggah Nilai Esktrakurikuler';
		$datay['tautan_balik'] = ''.base_url().'ekstrakurikuler/borang';
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
				$data['judulhalaman'] =' Galat, unggah berkas';
				$datay['pesan'] = $this->upload->display_errors();
				$datay['tautan_balik'] = ''.base_url().'ekstrakurikuler/borang';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);

			}
			else 
			{
				$thnajaran = cari_thnajaran();
				$semester = cari_semester();
				$pbk['thnajaran'] = $thnajaran;
				$pbk['semester'] = $semester;
				$filePath = 'uploads/'.$filename;
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if(isset($field['nis']))
					{
						$nis = nopetik($field['nis']);
						$pbk['nis'] = $nis;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' NIS';
						$pbk['nis'] = '';
					}
					if(isset($field['nilai']))
					{
						$pbk['nilai'] = nopetik($field['nilai']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' Nilai';
						$pbk['nilai'] = '';
					}
					if(isset($field['nama_ekstra']))
					{
						$nama_ekstra = nopetik($field['nama_ekstra']);
						$pbk['nama_ekstra'] = $nama_ekstra;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' Nama Ekstra';
						$pbk['nama_ekstra'] = '';
					}
					if(isset($field['deskripsi']))
					{
						$deskripsi = nopetik($field['deskripsi']);
						$pbk['keterangan'] = $deskripsi;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' Deskripsi';
						$pbk['keterangan'] = '';
					}

					if ($adagalat==0)
					{
						$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
						$tada = $this->Guru_model->Cek_Nilai_Ekstrakurikuler($thnajaran,$semester,$nama_ekstra,$nis);
						$adat = $tada->num_rows();
						if($adat == 0)
						{
							$this->Guru_model->Tambah_Nilai_Ekstrakurikuler($thnajaran,$semester,$kelas,$nama_ekstra,$nis);
						}
						$pbk['kelas'] = $kelas;
						$pbk['status'] = 'Y';
						$this->Guru_model->Ubah_Nilai_Ekstrakurikuler($pbk);
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
					redirect('guru/ekstrakurikuler');
				}
			}
		}
		else
		{
			redirect('guru');
		}
	}//akhir fungsi proses impor nilai

/* akhir controller */
}
?>
