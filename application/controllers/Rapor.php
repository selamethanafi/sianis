<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rapor extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
	}
	function index()
	{
	}
	function unduh($token=null,$tahun=null,$semester=null,$nis=null,$kurikulum=null,$tanda_tangan=null)
	{
		$ttd = md5($this->config->item('awalttd'));
		if($token == $ttd)
		{
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		        $this->load->model('Nilai_model');
			$tahun2 = $tahun + 1;
			$thnajaran = $tahun.'/'.$tahun2;
			$data['status_nilai']='akhir';
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['nis']=$nis;
			$data['kurikulum'] = $kurikulum;
			$data['ukuran_kertas'] = $this->config->item('ukuran_kertas');
			$data['siswa'] = 'bukan';
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['plt'] = $this->ref->ambil_nilai('plt');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_alamat_pendek'] = $this->ref->ambil_nilai('sek_alamat_pendek');
			$data['sek_tipe'] = $this->ref->ambil_nilai('sek_tipe');
			$data['ttd'] = $tanda_tangan;

			if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($nis)))
	        	{
				if($kurikulum == '2018')
				{
					$this->load->view('pdf/buku_rapor_siswa_2018', $data);
				}
				elseif($kurikulum == '2015')
				{
					$this->load->view('pdf/buku_rapor_siswa_2015_man_2_sragen', $data);
				}
				else
				{
					$this->load->view('pdf/buku_lck_siswa_legal_man_2_sragen', $data);
				}
			}

		}
	}
	function ijazah($token=null,$tahun1=null,$tahun2=null,$nis=null)
	{
		$ttd = md5($this->config->item('awalttd'));
		if($token == $ttd)
		{
			$this->load->model('Helper_model','helper');
			$data['datasiswa'] = $this->helper->data_siswa($nis);
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
	}

}
?>
