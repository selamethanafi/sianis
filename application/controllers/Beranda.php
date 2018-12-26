<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
	}
	
	function index()
	{

		$data=array();
/*
		$this->load->model('Situs_model');
		$tabel_berita_utama = $this->Situs_model->Berita_Utama();
		$id_berita_utama ='';
		foreach($tabel_berita_utama->result() as $beritautama)
		{
				$id_berita_utama=$beritautama->id_berita;
		}
		$data['pesan_galat'] = '';
		$data['nama_tamu'] = '';
		$data['nosel_tamu'] = '';
		$data['saran'] = '';
		$data["berita_utama"] = $this->Situs_model->Tampil_Berita_Utama($id_berita_utama);
		$data["kategori_profil"] = $this->Situs_model->Daftar_Kategori_Profil();
		$data["kategori_berita"] = $this->Situs_model->Daftar_Kategori_Berita();
		$data["kategori_download"] = $this->Situs_model->Daftar_Kategori_Download();
		$data["kategori_tutorial"] = $this->Situs_model->Daftar_Kategori_Materi();
		$data["slide_berita"] = $this->Situs_model->Slide_Berita();
		$data["tampil_tutorial_acak"] = $this->Situs_model->Tampil_Materi_Acak();
		$data["soal_polling"] = $this->Situs_model->Tampil_Polling();
		$data["berita_populer"] = $this->Situs_model->Berita_Populer();
		$data["tutorial_populer"] = $this->Situs_model->Tutorial_Populer();
		$data["tidakmasuk"] = $this->Situs_model->Tampil_Absensi_Terbatas();
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["tidakmasuk2"] = $this->Situs_model->Tampil_Absensi_Kemarin($thnajaran,$semester);
		$data["angkakredit"] = $this->Situs_model->Tampil_Angka_Kredit_Terbatas();
		$soal_poll = $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id_soal_poll;
			}
		//paging agenda
		$page=$this->uri->segment(4);
      	$limit_agenda=5;
		if(!$page):
		$offset_agenda = 0;
		else:
		$offset = $page;
		endif;	
		
		//paging pengumuman
		$page=$this->uri->segment(5);
      	$limit_pengumuman=4;
		if(!$page):
		$offset_pengumuman = 0;
		else:
		$offset = $page;
		endif;	
		$data["agenda"] = $this->Situs_model->Tampil_Agenda_Terbaru($limit_agenda,$offset_agenda);
		$data["pengumuman"] = $this->Situs_model->Tampil_Pengumuman_Terbaru($limit_pengumuman,$offset_pengumuman);
		$id_soal ='';
		$data["jawaban_polling"] = $this->Situs_model->Tampil_Soal_Polling($id_soal);
*/
//		$this->load->view('situs/bg_header',$data);
//		$this->load->view('situs/bg_menu',$data);
		$this->load->view('beranda/beranda',$data);
//		$this->load->view('situs/isi_index',$data);
//		$this->load->view('situs/bg_kanan',$data);
//		$this->load->view('situs/bg_footer');
	}
	function tampilan()
	{
		$page=$this->uri->segment(3);
		if($page == 2)
		{
			$this->load->view('beranda/beranda_2');
		}
		elseif($page == 4)
		{
			$this->load->view('beranda/beranda_4');
		}
		elseif($page == 3)
		{
			$this->load->view('beranda/beranda_3');
		}
		elseif($page == 1)
		{
			$this->load->view('beranda/beranda_1');
		}
		else
		{

			$this->load->view('beranda/beranda_1');
		}
	}

}
?>
