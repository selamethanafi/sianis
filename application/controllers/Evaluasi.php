<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Evaluasi extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		if($this->config->item('pkg') !='1')
		{
			redirect('nonaktif/pkg');

		}
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
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Evaluasi Diri Guru';
		$data["status"]=$this->session->userdata('tanda');
		$data["alert"]= $this->session->flashdata('pesan_info');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$datax["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$datax["tahun"] = date("Y");
		$nippegawai = cari_nip_pegawai($datax["kodeguru"]);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/evaluasi_diri_index',$datax);
		$this->load->view('shared/bawah');
	}
	function evaluasi($tahun=null,$aksi=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Evaluasi Diri Guru';
		$data["status"]=$this->session->userdata('tanda');
		$data["alert"]= $this->session->flashdata('pesan_info');
		$this->load->helper(array('fungsi','pkg'));
		$data["tahun"] = $tahun;

		if($aksi == 'ubah')
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/evaluasi_diri_index_ubah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'cetak')
		{
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['sek_alamat'] = $this->ref->ambil_nilai('sek_alamat');
			$data['sek_kec'] = $this->ref->ambil_nilai('sek_kec');
			$data['sek_kab'] = $this->ref->ambil_nilai('sek_kab');
			$data['sek_prov'] = $this->ref->ambil_nilai('sek_prov');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_nsm'] = $this->ref->ambil_nilai('sek_nsm');
			$data['sek_nss'] = $this->ref->ambil_nilai('sek_nss');
			$data["thnajaran"] = cari_thnajaran();
			$data['semester'] = cari_semester();
			$data['tautan_balik'] = 'evaluasi/evaluasi/'.$tahun;
			$this->load->view('shared/mencetak_evaluasi_diri',$data);
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/evaluasi_diri_index',$data);
			$this->load->view('shared/bawah');
		}

	}
	function rencana($tahun=null,$aksi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Rencana Pengembangan Keprofesian Berkelanjutan Individu Guru';
		if(empty($tahun))
		{
			$tahun = date("Y");
		}
		$data["tahun"] = $tahun;
		if($aksi == 'ubah')
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/evaluasi_diri_rencana_ubah',$data);
			$this->load->view('shared/bawah');
		}
		elseif($aksi == 'cetak')
		{
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['sek_alamat'] = $this->ref->ambil_nilai('sek_alamat');
			$data['sek_kec'] = $this->ref->ambil_nilai('sek_kec');
			$data['sek_kab'] = $this->ref->ambil_nilai('sek_kab');
			$data['sek_prov'] = $this->ref->ambil_nilai('sek_prov');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['sek_nsm'] = $this->ref->ambil_nilai('sek_nsm');
			$data['sek_nss'] = $this->ref->ambil_nilai('sek_nss');
			$data['koordinator_pkb'] = $this->ref->ambil_nilai('koordinator_pkb');
			$data['nip_koordinator_pkb'] = $this->ref->ambil_nilai('nip_koordinator_pkb');
			$data["thnajaran"] = cari_thnajaran();
			$data['semester'] = cari_semester();
			$data['tautan_balik'] = 'evaluasi/rencana/'.$tahun;
			$this->load->view('shared/mencetak_rencana_evaluasi_diri',$data);
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/evaluasi_diri_rencana',$data);
			$this->load->view('shared/bawah');
		}

	}
	function simpanrencana($tahun=null)
	{
		$nim=$this->session->userdata('username');
		$cacah_indikator = $this->input->post('cacah_indikator');
		for($i=1;$i<=$cacah_indikator;$i++)
		{
			$rencana=hilangkanpetik($this->input->post("rencana_$i"));
			$kode=hilangkanpetik($this->input->post("kode_$i"));
			$oleh =hilangkanpetik($this->input->post("oleh_$i"));
			$this->db->query("update `evaluasi_diri` set `rencana`='$rencana', `oleh`='$oleh' where `nim`='$nim' and `tahun`='$tahun' and `kode`='$kode'");
		}
		redirect('evaluasi/rencana/'.$tahun);
	}
	function simpanevaluasi($tahun=null)
	{
		$nim=$this->session->userdata('username');
		$cacah_indikator = $this->input->post('cacah_indikator');
		$tanggal = tanggal_indonesia_ke_barat($this->input->post("tanggal"));
		for($i=1;$i<=$cacah_indikator;$i++)
		{
			$evaluasi=hilangkanpetik($this->input->post("evaluasi_$i"));
			$kode=hilangkanpetik($this->input->post("kode_$i"));
			$this->db->query("update `evaluasi_diri` set `evaluasi`='$evaluasi' where `nim`='$nim' and `tahun`='$tahun' and `kode`='$kode'");
		}
		$this->db->query("update `evaluasi_diri_tanggal` set `tanggal`='$tanggal' where `nim`='$nim' and `tahun`='$tahun'");
		redirect('evaluasi/evaluasi/'.$tahun);
	}

// akhir controller
}


?>
