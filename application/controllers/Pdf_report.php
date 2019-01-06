<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
     * APLICATION INFO  : PDF Report with FPDF 1.6
*/
//============================================================+
// Nama Berkas 		: Pdf_report.php
// Lokasi      		: application/controllers
// Terakhir diperbarui	: Rab 02 Jan 2019 20:01:54 WIB 
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+

class Pdf_report extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();


		$tanda = $this->session->userdata('tanda');
		if(empty($tanda))
		{
			redirect(base_url());
		}
	}

	public function index()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->library('fpdf');
			define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		        $this->load->model('Nilai_model');
			$thnajaran = $this->input->post('thnajaran');
			$kelas = $this->input->post('kelas');
			$nis=$this->input->post('nis');
			$semester=$this->input->post('semester');
			$data['kelas'] = $kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['status']=$this->input->post('status');
			$status=$this->input->post('status');
			$data['nis']=$nis;
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($status)))
	        	{
				$this->load->view('pdf/rapor_siswa', $data);
			}
			else
			{
				redirect(base_url().strtolower($usere).'/cetakrapor');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function mid()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		if($data["status"]=="Pengajaran")
		{
			$usere = 'pengajaran';
		    // Load library FPDF 
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$thnajaran=$this->input->post('thnajaran');
			$semester=$this->input->post('semester');
			$data['ditandatangani'] = $this->input->post('ditandatangani');
			$kurikulum = $this->input->post('kurikulum');
			$kelas=$this->input->post('kelas');
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['kelas']=$kelas;
			$data['urutan']=$this->input->post('urutan');
		        $this->load->model('Nilai_model');
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($kelas)))
       			{
				$data = hilangkanpetik($data);
				if (($kurikulum=='2013') or ($kurikulum=='2015'))
				{
					$this->load->view('pdf/mid_pdf_2013', $data);
				}
				else
				{
					$this->load->view('pdf/mid_pdf', $data);
				}
			}
			else
			{
				redirect(base_url().strtolower($usere).'/cetakmid');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function lck($item=null,$id_thnajaran=null,$id_ruang=null,$ttd=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
		    // Load library FPDF 
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$data['thnajaran']=id_thnajaran_jadi_thnajaran($id_thnajaran);
			$data['kelas']=id_ruang_jadi_ruang($id_ruang);
			$data['ttd'] = $ttd;
			$ukuran_kertas = $this->config->item('ukuran_kertas');
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');
			if((!empty($item)) and (!empty($id_thnajaran)) and (!empty($id_ruang)))
			{
				if ($item == '2')
				{
					if($ukuran_kertas == 'Legal')
					{
						$this->load->view('pdf/lck_identitas_sekolah_legal', $data);
					}
					else
					{
						$this->load->view('pdf/lck_identitas_sekolah', $data);
					}
				}
				elseif ($item == '4')
				{
				        $this->load->model('Nilai_model');
					if($ukuran_kertas == 'Legal')
					{
						$this->load->view('pdf/lck_legal', $data);
					}
					else
					{
						$this->load->view('pdf/lck', $data);
					}
				}
				elseif ($item == '1')
				{
					$data['semester']= '1';
					if($ukuran_kertas == 'Legal')
					{
						$this->load->view('pdf/lck_sampul_legal', $data);
					}
					else
					{
					}
				}
				elseif ($item == '3')
				{
					$data['semester']= '1';
					$this->load->view('pdf/lck_identitas_siswa_legal', $data);
				}
				elseif ($item == '5')
				{
					$data['semester']= '1';
					$this->load->view('pdf/masuk_lck', $data);
				}
				elseif ($item == '6')
				{
					$data['semester']= '2';
					$this->load->view('pdf/keluar_lck', $data);
				}
				elseif ($item == '7')
				{
					$data['semester']= '2';
					$this->load->view('pdf/lck_prestasi_legal', $data);
				}
				elseif ($item == '8')
				{
					$data['semester']= '2';
					if($ukuran_kertas == 'Legal')
					{
						$this->load->view('pdf/lck_organisasi_legal', $data);
					}
					else
					{
						$this->load->view('pdf/lck_organisasi', $data);
					}
				}
				else
				{
					redirect(base_url().strtolower($usere).'/cetaklck');
				}
			}
			else
			{
				redirect(base_url().strtolower($usere).'/cetaklck');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function cetakppkpns()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		if($data["status"]=="Tatausaha")
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$tahun=$this->input->post('tahun');
			$kode=$this->input->post('kode');
			$rekap=$this->input->post('rekap');

			$dicetak = $this->input->post('dicetak');
			if ((!empty($tahun)) and (!empty($kode)) and (empty($dicetak)))
       			{
				$data['kode'] = $kode;
				$data['tahun'] = $tahun;
				$this->load->view('pdf/ppkpns_pdf', $data);
			}
			if ((!empty($tahun)) and (!empty($kode)) and ($dicetak=='perilaku'))
       			{
				$data['rekap'] = $rekap;
				$data['nip'] = $kode;
				$data['tahun'] = $tahun;
				$data['nomor'] =$this->input->post('nomor');
				$data['awal']=$this->input->post('awal');
				$data['akhir']=$this->input->post('akhir');
				$data['tautanbalik'] = 'tatausaha/cetakppkpns/perilaku';
				$this->load->view('shared/mencetak_perilakupns', $data);
			}
			if ((empty($tahun)) or (empty($kode)))
			{
				if (empty($dicetak))
				{
					redirect(base_url().'tatausaha/cetakppkpns');
				}
				else
				{
					redirect(base_url().'tatausaha/cetakppkpns/perilaku');
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function cetakskp($tahun=null,$nip=null,$dicetak=null,$rekap=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Referensi_model','ref');
		$datax['unit_kerja'] = $this->ref->ambil_nilai('unit_kerja');
		$datax['lokasi'] = $this->ref->ambil_nilai('lokasi');

		if(($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->model('Guru_model');
			$this->load->model('Helper_model', 'helper');
			$kode = $this->helper->cari_kode_dari_nip_pegawai($nip);
			if ((!empty($tahun)) and (!empty($kode)))
			{
				$datax["kodeguru"] = $kode;
				$datax['tahunpenilaian']=$tahun;
				$datax['dicetak']=$dicetak;
				$datax['nip'] = $nip;
				if($dicetak == 'ppk')
				{
					$data['kode'] = $kode;
					$data['nip'] = $nip;
					$data['tahun'] = $tahun;
					$this->load->view('pdf/ppkpns_pdf', $data);
				}
				if ($dicetak=='perilaku')
       				{
					$datax['rekap'] = $rekap;
					$datax['awal'] = '';
					$datax['akhir'] = '';
					$this->load->view('pdf/mencetak_perilakupns', $datax);
				}
				if($dicetak == 'borang')
				{
					$this->load->view('pdf/mencetak_borang_skp',$datax);
				}
				if($dicetak == 'penilaian')
				{
					$this->load->view('pdf/mencetak_skp',$datax);
				}
				if($dicetak == 'sampul')
				{
					$this->load->view('pdf/sampul_ppkpns_pdf',$datax);
				}
				if($dicetak == 'semua')
				{
					$this->load->view('pdf/semua_ppkpns_pdf',$datax);
				}

			}
			if ((empty($tahun)) or (empty($kode)))
			{
				if (empty($dicetak))
				{
					redirect(base_url().'tatausaha/cetakppkpns');
				}
				else
				{
					redirect(base_url().'tatausaha/cetakppkpns/perilaku');
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	//bukurapor
	function bukurapor()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		        $this->load->model('Nilai_model');
			$tahun=$this->uri->segment(3);
			$tahun2 = $tahun+1;
			$thnajaran = $tahun.'/'.$tahun2;
			$semester=$this->uri->segment(4);
			$nis=$this->uri->segment(5);
			$abaikan=$this->uri->segment(6);
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['nis']=$nis;
			$data['abaikan']=$abaikan;
			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($nis)))
	        	{
				$this->load->view('pdf/buku_rapor_siswa', $data);
			}
			else
			{
				echo 'galat di tahun pelajaran atau semester atau nis';
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function sampul()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA") or ($data["status"]=="Siswa"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$lhb=$this->uri->segment(3);
			$nis=$this->uri->segment(4);
			$data['lhb']=$lhb;
			$data['nis']=$nis;
			if ((!empty($lhb)) and (!empty($nis)))
	        	{
				$this->load->view('pdf/sampul_lhb', $data);
			}
			else
			{
				redirect(base_url().strtolower($usere).'/cetakbukurapor');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function bukulck($tahun=null,$semester=null,$nis=null,$status_nilai=null,$kurikulum=null,$ttd=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA") or ($data["status"]=="Siswa"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		        $this->load->model('Nilai_model');
			$tahun2 = $tahun + 1;
			$thnajaran = $tahun.'/'.$tahun2;
			$data['status_nilai']=$status_nilai;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['nis']=$nis;
			$data['ukuran_kertas'] = 'A4';
			$data['siswa'] = 'bukan';
			$data['ttd'] = $ttd;
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');
			$data['sek_tipe'] = $this->ref->ambil_nilai('sek_tipe');
			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($nis)))
	        	{
				if($kurikulum == '2015')
				{
					//$this->load->view('pdf/buku_rapor_siswa_2015_man_2_sragen', $data);
					echo 'Sementara dinonaktifkan, hubungi Admin';
				}
				elseif($kurikulum == '2018')
				{
					$this->load->model('Referensi_model','ref');
					$datax['ttd'] = $this->ref->ambil_nilai('tanda_tangan');
					$this->load->view('pdf/buku_rapor_siswa_2018', $data);
				}

				else
				{
//					$this->load->view('pdf/buku_lck_siswa_legal_man_2_sragen', $data);
					echo 'Sementara dinonaktifkan, hubungi Admin';
				}
			}
			else
			{
				echo 'galat tahun pelajaran, semester, atau nis';
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function masuk()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->model('Helper_model','helper');
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$lhb=$this->uri->segment(3);
			$nis=$this->uri->segment(4);
			$data['lhb']=$lhb;
			$data['nis']=$nis;
			$datasiswa = $this->helper->data_siswa($nis);
			$kelasawal = $datasiswa['kls'];
			$datakelas = $this->helper->nis_kelas_jadi_thnajaran_semester($nis,$kelasawal);
			$thnajaranawal = $datakelas['thnajaran'];
			$semesterawal = $datakelas['semester'];
			$data['thnajaran'] = $thnajaranawal;
			$data['semester'] = $semesterawal;
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');
			
			if ((!empty($lhb)) and (!empty($nis)))
		        {
				$this->load->view('pdf/masuk_'.$lhb, $data);
			}
			else
			{
				redirect(base_url().strtolower($usere).'/cetakbukurapor');
			}
		}
		else{
			redirect(base_url());
		}
	}
	function keluar()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		$this->load->model('Helper_model','helper');
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$lhb=$this->uri->segment(3);
			$nis=$this->uri->segment(4);
			$datasiswa = $this->helper->data_siswa($nis);
			$data['lhb']=$lhb;
			$data['nis']=$nis;
			$thnajaran = $datasiswa['thnajaran'];
			$semester = $datasiswa['semester'];
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$data['ttd'] = '';
			$data['kelas'] = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');

			if ((!empty($lhb)) and (!empty($nis)))
		       	{
				
				$this->load->view('pdf/keluar_'.$lhb, $data);

			}
			else
			{
				 redirect(base_url().strtolower($usere).'/cetakbukurapor');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function prestasi()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$lhb=$this->uri->segment(3);
			$nis=$this->uri->segment(4);
			$data['lhb']=$lhb;
			$data['nis']=$nis;
			$data['thnajaran'] = $this->uri->segment(5);
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');

			if ((!empty($lhb)) and (!empty($nis)))
		        {
				$this->load->view('pdf/prestasi_lhb', $data);
			}
			else
			{
				 redirect(base_url().strtolower($usere).'/cetakbukurapor');
			}
		}
		else{
			redirect(base_url());
		}
	}
	function cetakfoto()
	{
		$url = base_url();
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usere = $data["status"];
		$item=$this->uri->segment(3);
		if ($data['status']=='PA')
		{
			$usere = 'guru';
		}
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha") or ($data["status"]=="PA"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$data['thnajaran'] = $this->input->post('thnajaran');
			$data['kelas'] = $this->input->post('kelas');
			$data['semester']=$this->input->post('semester');
			if($item == 'labelrapor')
			{
				$this->load->view('pdf/cetak_label_nama_siswa_per_kelas', $data);
			}
			else
			{
				$this->load->view('pdf/cetak_foto_siswa_per_kelas', $data);
			}
		}
		else
		{
			$url = base_url();
			redirect($url);
		}
	}
	function pkg($tahun=null,$nip=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		if(($status=="Tatausaha") or ($status=="PA"))
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['sek_telepon'] = $this->ref->ambil_nilai('sek_telepon');
			$data['sek_desa'] = $this->ref->ambil_nilai('sek_desa');
			$data['sek_kec'] = $this->ref->ambil_nilai('sek_kec');
			$data['sek_kab'] = $this->ref->ambil_nilai('sek_kab');
			$data['sek_prov'] = $this->ref->ambil_nilai('sek_prov');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');

			$this->load->model('Guru_model');
			if($status == 'PA')
			{
				$nip = $this->Guru_model->get_NIP($data["nim"]);
			}
			if ((!empty($tahun)) and (!empty($nip)))
			{
				$data['nip'] = $nip;
				$data['tahun'] = $tahun;
				$data['thnpkg'] = $tahun;
				$this->load->view('pdf/pkg_pdf', $data);
			}
			else
			{
				if ($status == 'PA')
				{
					redirect('guru/pkg');
				}
				else
				{
					redirect('tatausaha/cetakpkg');
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function ijazah($tahun1=null,$tahun2=null,$nis=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Helper_model','helper');
		$data['datasiswa'] = $this->helper->data_siswa($nis);
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha"))
		{
			$usere = $this->session->userdata('tanda');
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');

			if($tahun1 == '2017')
			{
				$data['tahun1'] = $tahun1;
				$data['tahun2'] = $tahun2;
				$data['nis'] = $nis;
				$thnajaran = $tahun1.'/'.$tahun2;
				$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,2);
				$jurusan = kelas_jadi_program($kelas);
				$berkas = 'ijazah_2018_'.berkas($jurusan);
				$this->load->view('pdf/ijazah_2018', $data);
			}
			elseif($tahun1 == '2016')
			{
				$data['tahun1'] = $tahun1;
				$data['tahun2'] = $tahun2;
				$data['nis'] = $nis;
				$this->load->view('pdf/ijazah_2016_2017', $data);
			}
			else
			{
				$this->load->view('pdf/ijazah', $data);
			}
		}
		else
		{
			redirect(base_url().strtolower($usere).'/carisiswa');
		}
	}
	function skl($tahun1=null,$tahun2=null,$nis=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Helper_model','helper');
		$data['datasiswa'] = $this->helper->data_siswa($nis);
		if(($data["status"]=="Pengajaran") or ($data["status"]=="Tatausaha"))
		{
			$usere = $this->session->userdata('tanda');
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$data['tahun1'] = $tahun1;
			$data['tahun2'] = $tahun2;
			$data['nis'] = $nis;
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');
			$this->load->view('pdf/skl', $data);
		}
		else
		{
			redirect(base_url().strtolower($usere).'/carisiswa');
		}
	}

//akhir controllers
}

/* End of file pdf_report.php */
/* Location: ./application/controllers/pdf_report.php */
