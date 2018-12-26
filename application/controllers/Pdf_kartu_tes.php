<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
     * APLICATION INFO  : PDF Report with FPDF 1.6
     * DATE CREATED     : 21 April 2012
	 * DEVELOPED BY     : Anton Sofyan, A.Md
          
     * CONTACT    
     *   - Email        : antonsofyan@yahoo.com
     *   - Blog         : http://antonsofyan.stikeskuningan.ac.id/
     *   - Facebook     : http://facebook.com/antonsofyan     
     *   - Office       : Gedung Lantai 2 UPT Laboratorium Komputer
                          Sekolah Tinggi Ilmu Kesehatan Kuningan (STIKKU)
     *   - Address      : Jalan Lingkar Kadugede No. 02 Kabupaten Kuningan - Propinsi Jawa Barat
     
     * POWERED BY       : CodeIgniter 2.1 & FPDF 1.6	 
	 */

class Pdf_kartu_tes extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model','ref');
		$tanda=$this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Panitia_Tes")
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
	    // Load library FPDF 
		$this->load->library('fpdf');
        /* buat konstanta dengan nama FPDF_FONTPATH, kemudian kita isi value-nya
           dengan alamat penyimpanan FONTS yang sudah kita definisikan sebelumnya.
           perhatikan baris $config['fonts_path']= 'system/fonts/'; 
           didalam file application/config/config.php
        */            
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	       
		$id_nama_tes = $this->input->post('id_nama_tes');
		$kelas=$this->input->post('kelas');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
		$data['kelas']=$kelas;
	        $this->load->model('Nilai_model');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)) and (!empty($kelas)))
        	{
			$this->load->view('pdf/kartu_tes', $data);
		}
		else
		{
			redirect('panitiates/cetakkartu');
		}
	}
	function kartu()
	{
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$id_nama_tes = $this->input->post('id_nama_tes');
		$kelas=$this->input->post('kelas');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
		$data['kelas']=$kelas;
	        $this->load->model('Nilai_model');
		$data['baris1kartu'] = $this->ref->ambil_nilai('baris1kartutes');
		$data['baris2kartu'] = $this->ref->ambil_nilai('baris2kartutes');
		$data['baris3kartu'] = $this->ref->ambil_nilai('baris3kartutes');
		$data['plt'] = $this->ref->ambil_nilai('plt');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)) and (!empty($kelas)))
        	{
			$this->load->view('pdf/kartu_tes_versi_2', $data);
		}
		else
		{
			redirect('panitiates/cetakkartu2');
		}
	}

	function nominasi()
	{
	    // Load library FPDF 
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$id_nama_tes = $this->input->post('id_nama_tes');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
	        $this->load->model('Nilai_model');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)))
		{
			$this->load->view('pdf/nominasi', $data);
		}
		else
		{
		redirect('panitiates/cetaknominasi');
		}
	}

	function sementara()
	{
	    // Load library FPDF 
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$id_nama_tes = $this->input->post('id_nama_tes');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
		$data['nis1']=$this->input->post('nis1');
		$data['nis2']=$this->input->post('nis2');
		$data['nis3']=$this->input->post('nis3');
		$data['nis4']=$this->input->post('nis4');
	        $this->load->model('Nilai_model');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)))
		{
			$this->load->view('pdf/kartu_tes_sementara', $data);
		}
		else
		{
			redirect('panitiates/kartusementara');
		}
	}

	function denahtempatduduk()
	{
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$id_nama_tes = $this->input->post('id_nama_tes');
		$ruang = $this->input->post('ruang');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$tunggal=$this->input->post('tunggal');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
		$data['ruang']=$ruang;
	        $this->load->model('Nilai_model');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)) and (!empty($ruang)))
		{
			if ($tunggal == 1)
			{
				$this->load->view('pdf/denah_tempat_duduk_kiri', $data);
			}
			elseif ($tunggal == 2)
			{
				$this->load->view('pdf/denah_tempat_duduk_kanan', $data);
			}
			elseif ($tunggal == 3)
			{
				$this->load->view('pdf/denah_tempat_duduk', $data);
			}
			else
			{
				redirect('panitiates/cetakdenahtempatduduk');
			}
		}
		else
		{
				redirect('panitiates/cetakdenahtempatduduk');
		}
	}

	function label()
	{
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$id_nama_tes = $this->input->post('id_nama_tes');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
		$data['tunggal']=$this->input->post('tunggal');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)))
		{
			$this->load->view('pdf/label', $data);
		}
		else
		{
			redirect('panitiates/cetaklabel');
		}
	}

	function tertentu()
	{
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$id_nama_tes = $this->input->post('id_nama_tes');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['id_nama_tes']=$id_nama_tes;
		$data['nis1']=$this->input->post('nis1');
		$data['nis2']=$this->input->post('nis2');
		$data['nis3']=$this->input->post('nis3');
		$data['nis4']=$this->input->post('nis4');
	        $this->load->model('Nilai_model');
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($id_nama_tes)))
		{
			$this->load->view('pdf/kartu_tes_tertentu', $data);
		}
		else
		{
			redirect('panitiates/kartutes');
		}
	}

	function jadwal()
	{
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$kelas = $this->input->post('kelas');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['kelas']= $kelas;
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($kelas)))
		{
			$this->load->view('pdf/kartu_jadwal_tes', $data);
		}
		else
		{
			redirect('panitiates/jadwal');
		}
	}

} // akhir controller

/* End of file welcome.php */
/* Location: ./application/controllers/pdf_kartu_tes.php */
