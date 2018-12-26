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

class Pdf_blanko_nilai extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
	}

	public function index()
	{
	    // Load library FPDF 
		$session=$this->session->userdata('tanda');
		if($session!="")
		{
			$data = array();
			$data["nim"]=$this->session->userdata('username');
			$data["nama"]=$this->session->userdata('nama');
			$data["status"]=$this->session->userdata('tanda');
			if (($data["status"]=="Pengajaran") or ($data["status"]=="PA"))
			{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		        $this->load->model('Nilai_model');
			$thnajaran = $this->input->post('thnajaran');
			$semester=$this->input->post('semester');
			$pilihan=$this->input->post('pilihan');
			$kodeguru=$this->input->post('kodeguru');
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['pilihan']=$pilihan;
			$data['kodeguru']=$kodeguru;
			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($pilihan)) and (!empty($kodeguru)))
	        		{
				$this->load->view('pdf/blanko_nilai', $data);
				}
				else
				{
					if ($data["status"]=="Pengajaran")
					{redirect('pengajaran/cetakblankonilai');}
					else if ($data["status"]=="PA")
					{redirect('guru/formmencetak/2');}
					else
					{redirect(base_url());}
				}
			}
			else
			{
					if ($data["status"]=="Pengajaran")
					{redirect('pengajaran/cetakblankonilai');}
					else if ($data["status"]=="PA")
					{redirect('guru/formmencetak/2');}
					else
					{redirect(base_url());}

			}
		}
		else
		{
		//kalau belum login
		redirect(base_url());
		}
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
