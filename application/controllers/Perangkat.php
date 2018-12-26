<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perangkat extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			$data["status"]=$this->session->userdata('tanda');
			if($data["status"] !="PA")
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
		$data['judulhalaman'] = '';
       		$data_isi = array('query' => $query);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/perangkat',$data_isi);
		$this->load->view('shared/bawah');
	}
	function bpu()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data["tanggal"] = mdate($datestring, $time);
		$this->load->model('Guru_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(4);
		$aksi=$this->uri->segment(3);
      		$limit_ti=10;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$ta=$this->Guru_model->Tampil_Bpu($kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->Guru_model->Total_Bpu($kodeguru);
		$daftar_tapel= $this->Guru_model->Tampilkan_Semua_Tahun();
      		$config['base_url'] = base_url() . '/index.php/perangkat/bpu/tampil/';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$data['tekseditor'] = '';
		$data_isi = array('paginator'=>$paginator, 'page'=>$page,'kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_bpu'=>$page,'daftar_tapel'=>$daftar_tapel,'ta'=>$ta);
		$in=array();
		$in['thnajaran'] = $this->input->post('thnajaran');
		$in['kodeguru'] = $this->input->post('kodeguru');
		$in['semester'] = $this->input->post('semester');
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$in['tanggal'] = $tahunhadir.'-'.$bulanhadir.'-'.$tanggalhadir;
		$in['mapel'] = $this->input->post('mapel');
		$in['kelas'] = $this->input->post('kelas');
		$in['jenisulangan'] = $this->input->post('jenisulangan');
		$in['skkdmateri'] = $this->input->post('skkdmateri');
		$tanggalhadir2 =$this->input->post('tanggalhadir2');
		$bulanhadir2 =$this->input->post('bulanhadir2');
		$tahunhadir2 =$this->input->post('tahunhadir2');
		$in['tanggalulangan'] = $tahunhadir2.'-'.$bulanhadir2.'-'.$tanggalhadir2;
		$in['wakil'] = $this->input->post('wakil');
		$post_aksi = $this->input->post('post_aksi');
		if ($post_aksi == 'tambah_data')
			{
			$this->Guru_model->Tambah_Bpu($in);
			$aksi = 'tampil';
			} 
		if ($post_aksi == 'ubah_data')
			{
			$in['id_guru_bpu'] = $this->input->post('id_guru_bpu');
			$this->Guru_model->Update_Bpu($in);
			}
		if ($aksi== 'hapus')
			{
			$this->Guru_model->Hapus_Bpu($page,$kodeguru);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/perangkat/bpu/tampil'>";

			} 
		

		if (($aksi== 'tambah') or ($aksi=='ubah'))
			{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bpu_tambah',$data_isi);
			$this->load->view('shared/bawah');
			}
		else if (($post_aksi=='salin_data') or ($aksi == 'salin'))
			{
			$id_guru_bpu = $this->input->post('id_kopi');
	        	$data_isi = array('kodeguru'=>$kodeguru,'aksi'=>$aksi,'id_guru_bpu'=>$id_guru_bpu,'daftar_tapel'=>$daftar_tapel);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/bpu_tambah',$data_isi);
			$this->load->view('shared/bawah');
			}
		else if (!empty($post_aksi))
			{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/perangkat/bpu/tampil'>";
			}

			else
			{
			$this->load->view('guru/bg_atas_a',$data);
			$this->load->view('guru/bpu',$data_isi);
			$this->load->view('shared/bawah');
			}
	}

	function tambahbpu()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['id_guru_tugas'] = $this->uri->segment(3);
		$this->load->model('Guru_model');
		$data["kodegurupiket"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$bulanhadir = $this->input->post('bulanhadir');
		$tahunhadir = $this->input->post('tahunhadir');
		$tanggalhadir = $this->input->post('tanggalhadir');
		$data['kodeguru'] = $this->input->post('kodeguru');
		$data['id_mapel'] = $this->input->post('id_mapel');
		$data['proses'] = $this->input->post('proses');
		$data['jamke'] = $this->input->post('jamke');
		$data['tugas'] = $this->input->post('tugas');
		$data['tekseditor'] = '';
		$data['tanggalrph'] = $tahunhadir."".$bulanhadir."".$tanggalhadir;
		$data['id_guru_tugas_ubah'] = $this->input->post('id_guru_tugas_ubah');
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/bpu_tambah',$data);
		$this->load->view('shared/bawah');
	}

	function ubahbpu()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['tekseditor'] = '';
			$this->load->model('Guru_model');
			$data["tabel_piket"]=$this->Guru_model->Edit_Piket($id);
			$data["tanggal"] = mdate($datestring, $time);
			$data["id_piket"] = $id;
			$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/bpu_edit',$data);
			$this->load->view('shared/bawah');
	}
	function updatebpu()
	{
		$in=array();
		$nim=$this->session->userdata('nama');
		$status=$this->session->userdata('tanda');
			$this->load->model('Guru_model');
			$in["id_piket"]=$this->input->post('id_piket');
			$in["kejadian"]=$this->input->post('kejadian');
			$this->Guru_model->Update_Piket($in);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/guru/piket'>";
	}
	function formmencetak()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data["tanggal"] = mdate($datestring, $time);
		$noyangdicetak=$this->uri->segment(3);
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnpkg']=$this->input->post('thnpkg');
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['norpp']=$this->input->post('norpp');
		$data['mapel']=$this->input->post('mapel');
		$data['nomoraspek']=$this->input->post('nomoraspek');
		$data['ditandatangani']=$this->input->post('ditandatangani');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['namatugas'] = cari_tugas_tambahan($thnajaran,$semester,$kodeguru);
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');
		$lab = 	$this->input->post('lab');
		if ($diproses != 'oke') 
			{
			$this->load->view('guru/bg_atas',$data);
		}
		if ($noyangdicetak == 2)
			{
			$data['noyangdicetak'] = 2;
			$data['yangdicetak'] = 'Blanko Nilai';
			$this->load->view('guru/cetak_blanko_nilai',$data);
			}
		elseif ($noyangdicetak == 25)
			{
			$data['noyangdicetak'] = 25;
			$data['yangdicetak'] = 'Penilaian Kinerja Guru';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_penilaian_kinerja_guru',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_penilaian_kinerja_guru',$data);
				}
			}
		elseif ($noyangdicetak == 11)
			{
			$data['noyangdicetak'] = 11;
			$data['yangdicetak'] = 'Buku Tindak Lanjut Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_tindak_lanjut_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_tindak_lanjut_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 3)
			{
			$data['noyangdicetak'] = 3;
			$data['yangdicetak'] = 'Buku Analisis Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_analisis_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_analisis_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 5)
			{
			$data['noyangdicetak'] = 5;
			$data['yangdicetak'] = 'Buku Kegiatan Laboratorium';
			if ($diproses == 'oke')
				{
				$data['lab'] = $lab;
				$this->load->view('guru/mencetak_buku_kegiatan_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_buku_kegiatan_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 36)
			{
			$data['noyangdicetak'] = 36;
			$data['yangdicetak'] = 'Buku Kegiatan Laboratorium Versi 2';
			if ($diproses == 'oke')
				{
				$data['lab'] = $lab;
				$this->load->view('guru/mencetak_buku_kegiatan_laboratorium_versi_2',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_buku_kegiatan_laboratorium_versi_2',$data);
				}
			}

		elseif($noyangdicetak == 6)
			{
			$data['noyangdicetak'] = 6;
			$data['yangdicetak'] = 'Buku Laporan Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_laporan_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_laporan_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif ($noyangdicetak == 9)
			{
			$data['noyangdicetak'] = 9;
			$data['yangdicetak'] = 'Buku Pelaksanaan Kegiatan Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_pelaksanaan_kegiatan_kepala_laboratorium',$data);
				}
			}
		elseif($noyangdicetak == 1)
			{
			$data['noyangdicetak'] = 1;
			$data['yangdicetak'] = 'Agenda Harian Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_agenda_harian_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_agenda_harian_kepala_laboratorium',$data);
				}

			}

		elseif ($noyangdicetak == 26)
			{
			$data['noyangdicetak'] = 26;
			$data['yangdicetak'] = 'Program Kerja Tugas Tambahan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_program_kerja_kepala_laboratorium',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_program_kerja_kepala_laboratorium',$data);
				}

			}
		elseif ($noyangdicetak == 13)
			{
			$data['noyangdicetak'] = 13;
			$data['yangdicetak'] = 'Catatan Hambatan Belajar Siswa';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_catatan_hambatan',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_catatan_hambatan',$data);
				}

			}
		elseif ($noyangdicetak == 37)
			{
			$data['noyangdicetak'] = 37;
			$data['yangdicetak'] = 'Catatan Hambatan Belajar Siswa Versi 2';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_catatan_hambatan_versi_2',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_catatan_hambatan_versi_2',$data);
				}

			}

		elseif ($noyangdicetak == 21)
			{
			$data['noyangdicetak'] = 21;
			$data['yangdicetak'] = 'Hambatan Belajar Siswa';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_hambatan',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_hambatan',$data);
				}

			}
		elseif ($noyangdicetak == 23)
			{
			$data['noyangdicetak'] = 23;
			$data['yangdicetak'] = 'Laporan Capaian Kompetensi';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_lck',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_lck',$data);
				}

			}
		elseif ($noyangdicetak == 24)
			{
			$data['noyangdicetak'] = 24;
			$data['yangdicetak'] = 'Laporan Hasil Belajar';
			if ($diproses == 'oke')
				{
			
				$this->load->view('guru/mencetak_lhb_mapel',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_lhb_mapel',$data);
				}

			}

		elseif ($noyangdicetak == 20)
			{
			$data['noyangdicetak'] = 20;
			$data['yangdicetak'] = 'Deskripsi Laporan Capaian Kompetensi';
			if ($diproses == 'oke')
				{
			
				$this->load->view('guru/mencetak_deskripsi_lck',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_deskripsi_lck',$data);
				}

			}
		elseif ($noyangdicetak == 28)
			{
			$data['noyangdicetak'] = 28;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian Per Tanggal';
			if ($diproses == 'oke')
				{
				$data['tanggalrph'] = $tahunhadir.'-'.$bulanhadir.'-'.$tanggalhadir;			
				$this->load->view('guru/mencetak_rph_tanggal',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rph_tanggal',$data);
				}

			}
		elseif ($noyangdicetak == 27)
			{
			$data['noyangdicetak'] = 27;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian';
			if ($diproses == 'oke')
				{
			
				$this->load->view('guru/mencetak_rph',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rph',$data);
				}

			}
		elseif ($noyangdicetak == 33)
			{
			$data['noyangdicetak'] = 33;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Harian Versi Ringkas';
			if ($diproses == 'oke')
				{
			
				$this->load->view('guru/mencetak_rph_ringkas',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rph_ringkas',$data);
				}

			}

		elseif ($noyangdicetak == 29)
			{
			$data['noyangdicetak'] = 29;
			$data['yangdicetak'] = 'Rencana Pelaksanaan Pembelajaran';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_rencana_pelaksanaan_pembelajaran',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_rencana_pelaksanaan_pembelajaran',$data);
				}

			}
		elseif ($noyangdicetak == 7)
			{
			$data['noyangdicetak'] = 7;
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_bph',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_bph',$data);
				}

			}
		elseif ($noyangdicetak == 35)
			{
			$data['noyangdicetak'] = 35;
			$data['yangdicetak'] = 'Buku Pelaksanaan Harian Versi 2';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_bph2',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_bph2',$data);
				}

			}

		elseif ($noyangdicetak == 10)
			{
			$data['noyangdicetak'] = 10;
			$data['yangdicetak'] = 'Buku Pengembalian Ulangan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_bpu',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_bpu',$data);
				}

			}
		elseif ($noyangdicetak == 15)
			{
			$data['noyangdicetak'] = 15;
			$data['yangdicetak'] = 'Daftar Hadir Siswa';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_kehadiran',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_kehadiran',$data);
				}

			}
		elseif ($noyangdicetak == 38)
			{
			$data['noyangdicetak'] = 38;
			$data['yangdicetak'] = 'Daftar Hadir Siswa Versi 2';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_kehadiran_versi_2',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_kehadiran_versi_2',$data);
				}

			}

		elseif ($noyangdicetak == 22)
			{
			$data['noyangdicetak'] = 22;
			$data['yangdicetak'] = 'Jurnal Piket';
			if ($diproses == 'oke')
				{
					$datax["tanggalhadir"]=$tanggalhadir;
					$datax["bulanhadir"]=$bulanhadir;
					$datax["tahunhadir"]=$tahunhadir;
					$datax['thnajaran']=cari_thnajaran();
					$datax['semester']=cari_semester();

					$this->load->view('guru/mencetak_jurnal_piket',$datax);
				}
				else
				{
				$this->load->view('guru/form_mencetak_jurnal_piket',$data);
				}

			}
		elseif ($noyangdicetak == 17)
			{
			$data['noyangdicetak'] = 17;
			$data['yangdicetak'] = 'Daftar Nilai Akhlak / Sikap Spiritual dan Sosial';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_akhlak',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_akhlak',$data);
				}

			}
		elseif ($noyangdicetak == 4)
			{
			$data['noyangdicetak'] = 4;
			$data['yangdicetak'] = 'Buku Informasi Penilaian';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_informasi_penilaian',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_informasi_penilaian',$data);
				}

			}
		elseif ($noyangdicetak == 14)
			{
			$data['noyangdicetak'] = 14;
			$data['yangdicetak'] = 'Daftar Buku Pegangan';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_daftar_buku_pegangan',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_buku_pegangan',$data);
				}

			}
		elseif ($noyangdicetak == 12)
			{
			$data['noyangdicetak'] = 12;
			$data['yangdicetak'] = 'Buku Tugas';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_daftar_tugas',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_daftar_tugas',$data);
				}

			}
		elseif ($noyangdicetak == 19)
			{
			$data['noyangdicetak'] = 19;
			$data['yangdicetak'] = 'Daftar Nilai Psikomotor';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_daftar_nilai_psikomotor',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_daftar_nilai_psikomotor',$data);
				}

			}
		elseif ($noyangdicetak == 16)
			{
			$data['noyangdicetak'] = 16;
			$data['yangdicetak'] = 'Daftar Nilai Afektif';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_daftar_nilai_afektif',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_daftar_nilai_afektif',$data);
				}

			}
		elseif ($noyangdicetak == 18)
			{
			$data['noyangdicetak'] = 18;
			$data['yangdicetak'] = 'Daftar Nilai Kognitif';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_daftar_nilai_kognitif',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_daftar_nilai_kognitif',$data);
				}

			}
			elseif ($noyangdicetak == 30)
			{
				$data['noyangdicetak'] = 30;
				$data['yangdicetak'] = 'Penilaian Diri Siswa';
				if ($diproses == 'oke')
				{
					$this->load->view('guru/mencetak_penilaian_diri_siswa',$data);
				}
				else
				{
					$this->load->view('guru/form_mencetak_penilaian_diri_siswa',$data);
				}
			}
			elseif ($noyangdicetak == 31)
			{
				$data['noyangdicetak'] = 31;
				$data['yangdicetak'] = 'Penilaian Antarteman';
				if ($diproses == 'oke')
				{
					$this->load->view('guru/mencetak_penilaian_antarteman',$data);
				}
				else
				{
					$this->load->view('guru/form_mencetak_penilaian_antarteman',$data);
				}
			}
			elseif ($noyangdicetak == 32)
			{
				$data['noyangdicetak'] = 32;
				$data['yangdicetak'] = 'Deskripsi Sikap Spiritual dan Sosial Antarmata Pelajaran';
				if ($diproses == 'oke')
					{
					$this->load->view('guru/mencetak_deskripsi_sikap_spiritual_dan_sosial_antarmata_pelajaran',$data);
					}
					else
					{
						$this->load->view('guru/form_mencetak_deskripsi_sikap_spiritual_dan_sosial_antar_mata_pelajaran',$data);
					}
			}
			elseif ($noyangdicetak == 34)
			{
			$data['noyangdicetak'] = 34;
			$data['yangdicetak'] = 'Buku Tugas Versi 2';
			if ($diproses == 'oke')
				{
				$this->load->view('guru/mencetak_daftar_tugas_v2',$data);
				}
				else
				{
				$this->load->view('guru/form_mencetak_daftar_tugas_v2',$data);
				}

			}

			else
			{
			$data['noyangdicetak'] = '';
			$data['yangdicetak'] = '';
			$this->load->view('guru/form_mencetak',$data);
			}
			if ($diproses != 'oke') 
			{
			$this->load->view('shared/bawah');
			}

	}
	function sertifikasi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Data Tambahan untuk SKBK / PKG';
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$tabel_tapel=$this->Guru_model->Tampilkan_Semua_Tahun();
        	$data_isi = array('kode_guru'=>$kodeguru);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/sertifikasi',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tambahan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Tugas Tambahan';
		$this->load->model('Guru_model');
		$data["thnajaran"] = $this->input->post('thnajaran');
		$data["semester"] = $this->input->post('semester');
		$data["pangkat"] = $this->input->post('pangkat');
		$data["golongan"] = $this->input->post('golongan');
		$data["jabatan"] = $this->input->post('jabatan');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/tambahan',$data);
		$this->load->view('shared/bawah');
	}
	function tambahanluar()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
			$data["tanggal"] = mdate($datestring, $time);
			$this->load->model('Guru_model');
			$data["thnajaran"] = cari_thnajaran();
			$data["semester"] = cari_semester();
			$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/tambahan_luar',$data);
			$this->load->view('shared/bawah');
	}

	function updatedatatambahanluar()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["kodeguru"]=nopetik($this->input->post('kodeguru'));
		$in["thnajaran"]=nopetik($this->input->post('thnajaran'));
		$in["semester"]=nopetik($this->input->post('semester'));
		$in["nama_tugas"]=nopetik($this->input->post('nama_tugas'));
		$in["nama_sekolah"]=nopetik($this->input->post('nama_sekolah'));
		$in["npsn"]=nopetik($this->input->post('npsn'));
		$in["jtm"]=nopetik($this->input->post('jtm'));
		$ada=nopetik($this->input->post('ada'));
//				$in[""]=$this->input->post('');
		$this->load->model('Guru_model');
		if ($ada>0)
		{
			$this->Guru_model->Update_Data_Tambahan_Luar($in);
		}
		else
		{
			$this->Guru_model->Tambah_Data_Tambahan_Luar($in);
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/perangkat/sertifikasi'>";
	}
	function supervisiguru($tahun1=null,$tahun2=null,$semester=null,$supervisor=null,$aksi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Data Supervisi Mengajar';
		$data["tanggal"] = tanggal_hari_ini();
		$data['semester'] = $semester;
		$data['thnajaran'] = $tahun1.'/'.$tahun2;
		$data['supervisor'] = $supervisor;
		$data['aksi'] = $aksi;
		$this->load->model('Referensi_model','ref');
		$data['nilai_akreditasi'] = $this->ref->ambil_nilai('nilai_akreditasi');
		$data['status_akreditasi'] = $this->ref->ambil_nilai('status_akreditasi');
		$data['tahun_akreditasi'] = $this->ref->ambil_nilai('tahun_akreditasi');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
		$this->load->model('Guru_model');
		if($aksi == 'simpan')
		{
			$id_data_supervisi = $this->input->post('id_data_supervisir');
			$in['tanggal_supervisi_mengajar']=nopetik(tanggal_indonesia_ke_barat($this->input->post('tanggal_supervisi_mengajar')));
			$in['tanggal_supervisi_perangkat']=nopetik(tanggal_indonesia_ke_barat($this->input->post('tanggal_supervisi_perangkat')));

			$id_mapel = nopetik($this->input->post('id_mapel'));
			$in['thnajaran'] = nopetik($this->input->post('thnajaran'));
			$in['semester'] = nopetik($this->input->post('semester'));
			$in['kelas'] = id_mapel_jadi_kelas($id_mapel);
			$in['jamke'] = nopetik($this->input->post('jamke'));
			$in['mapel'] = id_mapel_jadi_mapel($id_mapel);
			$in['jtm'] = nopetik($this->input->post('jtm'));
			$in['supervisor'] = nopetik($this->input->post('supervisor'));
			$in['username'] = $data['nim'];
			$in['id_data_supervisi'] = nopetik($this->input->post('id_data_supervisi'));
			$this->Guru_model->Update_Data_Supervisi_Mengajar($in);
//			redirect('perangkat/supervisiguru/'.$tahun1.'/'.$tahun2.'/'.$semester.'/'.$supervisor.'/cetak');
			redirect('perangkat/supervisi');
		}
		if(($aksi == 'cetak') or ($aksi == 'hasil') or ($aksi == 'cetak1'))
		{
			$this->load->view('guru/data_supervisi',$data);
		}
		elseif($aksi == 'hasil1')
		{
			$data['kodeguru'] = $this->session->userdata('username');
			$data['tautan_balik'] = 'perangkat/supervisi';
			$this->load->view('shared/mencetak_supervisi',$data);

		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/data_supervisi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function supervisi($page=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Supervisi';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/supervisi');
		$this->load->view('shared/bawah');
	}
	function supervisinilai($tahun1=null,$tahun2=null,$semester=null,$supervisor=null)
	{
		$this->load->model('Guru_model');
		$cacahmapel = $this->input->post('cacahperangkat');
		if($cacahmapel>0)
		{
			$this->load->model('Guru_model');
			for($i=1;$i<=$cacahmapel;$i++)
			{
				$in['id_supervisi_nilai'] = $this->input->post('kd_'.$i);
				$in['skor'] = $this->input->post('item_'.$i);
				$this->Guru_model->Update_Skor_Supervisi_Guru($in);
			}
		}
		$cacahtambahan = $this->input->post('cacahtambahan');
		if($cacahtambahan>0)
		{
			$this->load->model('Guru_model');
			for($i=1;$i<=$cacahtambahan;$i++)
			{
				$in['id_supervisi_nilai'] = $this->input->post('kd_tambahan_'.$i);
				$in['skor'] = $this->input->post('tambahan_'.$i);
				$this->Guru_model->Update_Skor_Supervisi_Tambahan($in);
			}
		}
		redirect('perangkat/supervisiguru/'.$tahun1.'/'.$tahun2.'/'.$semester.'/'.$supervisor.'/hasil1');
	}
	function supervisimengajarnilai($tahun1=null,$tahun2=null,$semester=null,$supervisor=null)
	{
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->session->userdata('username');
		$diproses=$this->input->post('diproses');
		$cacahmapel = $this->input->post('cacahperangkat');
		if($cacahmapel>0)
		{
			$this->load->model('Guru_model');
			for($i=1;$i<=$cacahmapel;$i++)
			{
				$in['id_supervisi_mengajar_nilai'] = $this->input->post('kd_'.$i);
				$in['skor'] = $this->input->post('item_'.$i);
				$this->Guru_model->Update_Skor_Supervisi_Guru_Mengajar($in);
			}
		}
		redirect('perangkat/supervisiguru/'.$tahun1.'/'.$tahun2.'/'.$semester.'/'.$supervisor.'/hasil');
	}
// akhir controller
}


?>
