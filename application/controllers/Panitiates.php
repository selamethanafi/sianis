<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panitiates extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
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
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Beranda Panitia Tes';
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'panitiates';
		$data['judulhalaman'] = 'Ganti Tema Tampilan';
		$proses=$this->input->post('proses');
		if(!empty($proses))
		{
			$temacss=$this->input->post('temacss');
			$this->load->model('Guru_model');
			$in['user'] = $data["nim"];
			$in['temacss'] = $temacss;
			$this->Guru_model->Update_Tema($in);
		}
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}

	function siswakelas()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Daftar Siswa Per Kelas';
		$page=$this->uri->segment(3);
		$limit_ti=14;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Admin_model');
		$this->load->library('Pagination');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
       		$data_isi['daftarkelas'] = $querykelas ;
		$data['kelas'] = $this->input->post('kelas');
		$data['thnajaran'] = $this->input->post('thnajaran');
		$data['semester'] = $this->input->post('semester');
		$querysiswa=$this->Admin_model->Tampil_Siswa_Kelas($data['thnajaran'],$data['semester'],$data['kelas']);
       		$data_isi['daftarsiswa'] = $querysiswa ;
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/siswa_kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function siswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Pencarian Data Siswa';
		$kunci=$this->input->post('nama');
		$this->load->model('Bp_model');
		$data['kunci']=$kunci;
		$data["query"]=$this->Bp_model->Cari_Siswa($kunci);
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/siswa',$data);
		$this->load->view('shared/bawah');
	}
	function namates()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Nama Tes';
		$data['aksi']=$this->uri->segment(3);
		$data['id']=$this->uri->segment(4);
		$this->load->model('Panitia_model');
		if($data['aksi'] == 'hapus')
		{
			$this->Panitia_model->Hapus_Tes($data['id']);
			redirect('panitiates/namates');
		}
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$data["query"]=$this->Panitia_model->Daftar_Tes($data['thnajaran']);
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/daftar_tes',$data);
		$this->load->view('shared/bawah');
	}
	function simpannamates()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Panitia_model');
		$inpute["thnajaran"]=$this->input->post('thnajaran');
		$inpute["nama_tes"]=$this->input->post('namates');
		$inpute["semester"]=$this->input->post('semester');
		$inpute["pelaksanaan"]=$this->input->post('pelaksanaan');
		$id_nama_tes=$this->input->post('id_nama_tes');
		$this->Panitia_model->Simpan_Nama_Tes($inpute,$id_nama_tes);
		redirect('panitiates/namates');
	}
	function unduhsiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$this->load->view('panitiates/daftar_siswa',$data);
	}
	function imporsiswa()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Impor Daftar Nominasi Peserta Tes';
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/impor_siswa');
		$this->load->view('shared/bawah');
	}
	function proses_impor_siswa()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Panitia_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$this->Panitia_model->Hapus_Tabel_Siswa_Nomor_Tes();
		$this->Panitia_model->Hapus_Tabel_Denah_Tempat_Duduk();
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		$adagalat = 0;
		$pesan = '';
		foreach($csvData as $field):
		$baris = $n+1;
		$pesan .= 'Baris '.$baris.' Kolom';
			if(isset($field['no_peserta']))
			{
			$pbk['no_peserta'] = nopetik($field['no_peserta']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' no_peserta';
			$pbk['no_peserta'] = '';
			}
			if(isset($field['ruang']))
			{
			$pbk['ruang'] = nopetik($field['ruang']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' ruang';
			$pbk['ruang'] = '';
			}
			if(isset($field['kelas']))
			{
			$pbk['kelas'] = nopetik($field['kelas']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' kelas';
			$pbk['kelas'] = '';
			}
			$pbk['kelas'] = $field["kelas"];
			if(isset($field['nis']))
			{
			$pbk['nis'] = nopetik($field['nis']);

			}
			else
			{
			$adagalat = 1;
			$pesan .= ' nis';
			$pbk['nis'] = '';
			}
			if(isset($field['no_unik']))
			{
			$pbk['no_unik'] = nopetik($field['no_unik']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' no_unik';
			$pbk['no_unik'] = '';
			}
			if(isset($field['kolom']))
			{
			$kolom = nopetik($field['kolom']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' kolom';
			$kolom = '';
			}
			if(isset($field['baris']))
			{
			$baris = nopetik($field['baris']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' baris';
			$baris = '';
			}
			if(isset($field['kiri_kanan']))
			{
			$kiri_kanan = nopetik($field['kiri_kanan']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' kiri_kanan';
			$kiri_kanan = '';
			}
			if ($adagalat==0)
				{
				$this->Panitia_model->Tambah_Nominasi($pbk);
				$nis = $pbk['nis'];
				$ruang = $pbk['ruang'];
				//cek sudah ruang da nbaris
				$cek = $this->Panitia_model->Cek_Baris($ruang,$baris);
				$ada = $cek->num_rows();
				if($ada == 0)
					{
					$pbk2['ruang'] = $ruang;
					$pbk2['baris'] = $baris;
					$this->Panitia_model->Tambah_Baris($pbk2);
					}
				$this->Panitia_model->Update_Baris($nis,$ruang,$baris,$kolom,$kiri_kanan);				

				}
			$pesan .= ' TIDAK ADA<br />';
			$n++;
		endforeach;
		$datay['modul'] = 'Unggah Data Nominasi Peserta Tes';
		$datay['tautan_balik'] = ''.base_url().'panitiates/imporsiswa';
		$datay['pesan'] = $pesan;
		if($adagalat==1)
			{
			$data['judulhalaman'] = 'Unggah Data Nominasi Peserta Tes';
			$this->load->view('panitiates/bg_head',$data);
			$this->load->view('shared/adagalat',$datay);
			$this->load->view('shared/bawah',$data);
			}
			else
			{
			redirect('panitiates/cetakkartu/');
			}

		//kalau berhasil
	}
	function ruangtes()
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Pengaturan Ruang Tes';
		$id_ruang =$this->uri->segment(3);
		$this->load->model('Admin_model');
		$daftar_kelas = $this->Admin_model->Tampil_Semua_Kelas();
		$data["jumlah_kelas"] =  $daftar_kelas->num_rows();
		$data["daftar_kelas"] = $daftar_kelas;
		$kelas = '';
		$ta = $this->db->query("select * from `m_ruang` where `id_ruang`='$id_ruang'");
		foreach($ta->result() as $a)
		{
			$kelas = $a->ruang;
		}
		$data['id_ruang'] = $id_ruang;
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$data["no_tengah"]=$this->input->post('no_tengah');
		$no_tengah =$this->input->post('no_tengah');
		$ruang_tes_satu = $this->input->post('ruang_tes_satu');
		$ruang_tes_dua = $this->input->post('ruang_tes_dua');
		if (!empty($kelas))
		{
			$this->load->model('Bp_model');
			$jmlsiswa = $this->Bp_model->Tampil_Siswa_Kelas($thnajaran,$semester,$kelas);
			$data["jumlah_siswa"] = $jmlsiswa->num_rows();
		}
		if ((!empty($kelas)) and (!empty($no_tengah)) and (!empty($ruang_tes_satu)) and (!empty($ruang_tes_dua)))
		{
			$pbk=array();
			$pbk["ruang"] = $kelas;
			$pbk["no_tengah"] = $no_tengah;
			$pbk["ruang_tes_satu"] = $ruang_tes_satu;
			$pbk["ruang_tes_dua"] = $ruang_tes_dua;
			$this->Admin_model->Simpan_Ruang_Tes_Siswa($pbk);
			redirect('panitiates/ruangtes');
		}
		else
		{
			$this->load->view('panitiates/bg_head',$data);
			$this->load->view('panitiates/ruang_tes',$data);
			$this->load->view('shared/bawah');
		}
	}
	function prosesnomortes()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Proses Nomor Peserta Tes';
		$this->load->model('Panitia_model');
		$data["semester"] = cari_semester();
		$data["thnajaran"] = cari_thnajaran();
		$data["format"]=$this->input->post('format');
		$this->Panitia_model->Hapus_Tabel_Siswa_Nomor_Tes();
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/proses_nomor_tes',$data);
		$this->load->view('shared/bawah');
	}
	function cetakkartu()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mencetak Kartu Tes';
		$thnajaran = cari_thnajaran();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($thnajaran);
		$this->load->model('Admin_model');
       		$data['daftar_kelas'] = $this->Admin_model->Tampil_Semua_Kelas();
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_kartu',$data);
		$this->load->view('shared/bawah');
	}
	function cetakkartu2()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mencetak Kartu Tes Daring';
		$thnajaran = cari_thnajaran();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($thnajaran);
		$this->load->model('Admin_model');
       		$data['daftar_kelas'] = $this->Admin_model->Tampil_Semua_Kelas();
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_kartu_2',$data);
		$this->load->view('shared/bawah');
	}

	function cetaknominasi()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mencetak Nominasi Peserta Tes';
		$this->load->model('Admin_model');
       		$data['daftar_kelas'] = $this->Admin_model->Tampil_Semua_Kelas();
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($data['thnajaran']);
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_nominasi',$data);
		$this->load->view('shared/bawah');
	}
	function kartusementara()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mencetak Kartu Sementara';
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($thnajaran);
		$this->load->model('Admin_model');
       		$data['daftar_kelas'] = $this->Admin_model->Tampil_Semua_Kelas();
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_kartu_sementara',$data);
		$this->load->view('shared/bawah');
	}
	function cetakdenahtempatduduk()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mencetak Denah Tempat Duduk';
		$this->load->model('Admin_model');
       		$data['daftar_kelas'] = $this->Admin_model->Tampil_Semua_Kelas();
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($data['thnajaran']);
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_denah_tempat_duduk',$data);
		$this->load->view('shared/bawah');
	}
	function cetaklabel()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes();
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_label');
		$this->load->view('shared/bawah');
	}
	function imporlabel()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$this->load->model('Panitia_model');
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/impor_label');
		$this->load->view('shared/bawah');
	}
	function proses_impor_label()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$this->load->model('Panitia_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$this->Panitia_model->Hapus_Tabel_Label();
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		$adagalat = 0;
		$pesan = '';
		foreach($csvData as $field):
		$baris = $n+1;
		$pesan .= 'Baris '.$baris.' Kolom';
			if(isset($field['ruang']))
			{
			$pbk['ruang'] = nopetik($field['ruang']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' ruang';
			$pbk['ruang'] = '';
			}
			if(isset($field['awal']))
			{
			$pbk['awal'] = nopetik($field['awal']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' awal';
			$pbk['awal'] = '';
			}

			if(isset($field['akhir']))
			{
			$pbk['akhir'] = nopetik($field['akhir']);

			}
			else
			{
			$adagalat = 1;
			$pesan .= ' akhir';
			$pbk['akhir'] = '';
			}
			if ($adagalat==0)
				{
				$this->Panitia_model->Tambah_Label($pbk);
				}
			$pesan .= ' TIDAK ADA<br />';
			$n++;
		endforeach;
		$datay['modul'] = 'Unggah Data Untuk Label';
		$datay['tautan_balik'] = ''.base_url().'panitia/imporlabel';
		$datay['pesan'] = $pesan;
		if($adagalat==1)
			{
			$this->load->view('panitiates/bg_head',$data);
			$this->load->view('shared/adagalat',$datay);
			$this->load->view('shared/bawah',$data);
			}
			else
			{
			redirect('panitiates/cetaklabel/');
			}
		//kalau berhasil
	}
	function kartutes()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$this->load->model('Panitia_model');
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($thnajaran);
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_kartu_tes',$data);
		$this->load->view('shared/bawah');
	}
	function tandatangan()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/posisi_tanda_tangan_kepala',$data);
		$this->load->view('shared/bawah');
	}
	function urutankelas()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Proses Nomor Peserta Tes';
		$this->load->model('Panitia_model');
		$data["semester"] = cari_semester();
		$data["thnajaran"] = cari_thnajaran();
		$cacahkelas=$this->input->post('cacahkelas');
		if($cacahkelas>0)
		{
			for($i=1;$i<=$cacahkelas;$i++)
			{
			$no_urut=$this->input->post('no_urut_'.$i);
			$id_walikelas=$this->input->post('id_walikelas_'.$i);
			$this->Panitia_model->Perbarui_No_Urut($no_urut,$id_walikelas);
			}
			$data['info'] = '<div class="alert alert-info">Berhasil memperbarui momor urut kelas</div>';
		}
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/urut_kelas',$data);
		$this->load->view('shared/bawah');
	}
	function denahtempatduduk()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Mengatur Tempat Duduk';
		$this->load->model('Panitia_model');
		$cacahpeserta=$this->input->post('cacahpeserta');
		if($cacahpeserta>0)
		{
			$ruang=$this->input->post('ruang');
			for($i=1;$i<=$cacahpeserta;$i++)
			{
				$nis=$this->input->post('nis_'.$i);
				$baris=$this->input->post('baris_'.$i);
				$kolom=$this->input->post('kolom_'.$i);
				$kiri_kanan=$this->input->post('posisi_'.$i);
				$this->Panitia_model->Update_Baris($nis,$ruang,$baris,$kolom,$kiri_kanan);				
			}
			$data['info'] = '<div class="alert alert-info">Berhasil memperbarui momor urut kelas</div>';
		}

		$this->load->model('Admin_model');
       		$data['daftar_kelas'] = $this->Admin_model->Tampil_Semua_Kelas();
		$data["jumlah_kelas"] =  $data['daftar_kelas']->num_rows();
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$data["daftar_tes"]=$this->Panitia_model->Daftar_Tes($data['thnajaran']);
		$data['ruang'] = $this->uri->segment(3);
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/atur_denah_tempat_duduk',$data);
		$this->load->view('shared/bawah');
	}
	function unggahjadwal()
	{
		$data["nim"]=$this->session->userdata('username');
		$pesan = '';
		$data['judulhalaman'] = 'Mengunggah Jadwal Ulangan';
		$config['upload_path'] = 'images/';
		$config['allowed_types'] ='png';
		$tingkat = $this->input->post('tingkat');
		$namaberkas = 'jadwal_ulangan_kelas_'.$tingkat;
		$config['file_name'] = $namaberkas;
		$config['max_size'] = '100000';
		$config['max_width'] = '1200';
		$config['max_height'] = '800';	
		$config['overwrite'] = TRUE;					
		$this->load->library('upload', $config);
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	$data['pesan'] = '<div class="alert alert-warning">Galat, '.$this->upload->display_errors().'</div>';
				$data['modul'] = 'Mengunggah Jadwal Ulangan';
				$data['tautan_balik'] = base_url().'panitiates/unggahjadwal';
				$this->load->view('panitiates/bg_head',$data);
				$this->load->view('shared/adagalat',$data);
				$this->load->view('shared/bawah');
			}
			else
			{
			$this->load->view('panitiates/bg_head',$data);
			$this->load->view('panitiates/unggah_jadwal',$data);
			$this->load->view('shared/bawah');
			}
		}
		else
		{
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/unggah_jadwal',$data);
		$this->load->view('shared/bawah');
		}
	}
	function jadwal()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mencetak Jadwal Tes';
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/cetak_jadwal',$data);
		$this->load->view('shared/bawah');
	}
	function kartuubk($tahun1=null,$semester=null,$id_tes=null,$id_kelas=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Kartu UBK';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$this->load->model('Panitia_model');
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['id_kelas'] = $id_kelas;
		if(empty($tahun1))
		{
			$thnajaran = cari_thnajaran();
			$tahun1 = substr($thnajaran,0,4);
		}
		else
		{
			$tahun2 = $tahun1 + 1;
			$thnajaran = $tahun1.'/'.$tahun2;
	
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_tes'] = $id_tes;
		$datax['daftar_tes']=$this->Panitia_model->Daftar_Tes($thnajaran);
		$datax['thnajaran'] = $thnajaran;
		if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_kelas)) and (!empty($id_tes)))
		{
			$this->load->view('panitiates/kartu_ubk',$datax);
		}
		else
		{
			$this->load->view('panitiates/bg_head',$data);
			$this->load->view('panitiates/mencetak_kartu_ubk',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function unggahnomorun()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Unggah Nomor UNBK';
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/unggah_nomor_un');
		$this->load->view('shared/bawah');
	}
	function tampilnomorun()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Data Nomor Peserta UNBK';
		$data['thnajaran'] = cari_thnajaran();
		$this->load->view('panitiates/bg_head',$data);
		$this->load->view('panitiates/tampil_nomor_un');
		$this->load->view('shared/bawah');
	}
	function proses_nomor_un()
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->model('Panitia_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$thnajaran = cari_thnajaran();
		$this->db->query("delete from `siswa_nomor_tes_un` where `thnajaran`= '$thnajaran'");
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		$adagalat = 0;
		$pesan = '';
		foreach($csvData as $field):
		$baris = $n+1;
		$pesan .= 'Baris '.$baris.' Kolom';
			if(isset($field['nomor_un']))
			{
			$pbk['no_peserta'] = nopetik($field['nomor_un']);
			}
			else
			{
			$adagalat = 1;
			$pesan .= ' nomor_un';
			$pbk['no_peserta'] = '';
			}
			if(isset($field['nis']))
			{
			$pbk['nis'] = nopetik($field['nis']);

			}
			else
			{
			$adagalat = 1;
			$pesan .= ' nis';
			$pbk['nis'] = '';
			}
			$pbk['thnajaran'] = $thnajaran;
			if ($adagalat==0)
				{
				$this->Panitia_model->Tambah_Nominasi_UN($pbk);
				}
			$pesan .= ' TIDAK ADA<br />';
			$n++;
		endforeach;
		$datay['modul'] = 'Unggah Data Nominasi Peserta Tes';
		$datay['tautan_balik'] = ''.base_url().'panitiates/unggahnomorun';
		$datay['pesan'] = $pesan;
		if($adagalat==1)
			{
			$data['judulhalaman'] = 'Unggah Nomor UN';
			$this->load->view('panitiates/bg_head',$data);
			$this->load->view('shared/adagalat',$datay);
			$this->load->view('shared/bawah',$data);
			}
			else
			{
			redirect('panitiates/tampilnomorun');
			}

		//kalau berhasil
	}

}//akhir fungsi
?>
