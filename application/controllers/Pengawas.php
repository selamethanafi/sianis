<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengawas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		//$this->load->plugin();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Pengawas")
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
		$data["judulhalaman"]= 'Beranda Pengawas';
		$this->load->view('pengawas/bg_atas',$data);
		$this->load->view('pengawas/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'Pengawas';
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
		$this->load->view('pengawas/bg_atas',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}

	function perangkat()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]=$this->session->userdata('tanda');
		$data["judulhalaman"]= 'Perangkat Guru';
		$data['yangdicetak']=$this->input->post('yangdicetak');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['namaguru'] = cari_nama_pegawai($this->input->post('kodeguru'));
		$data['kelas'] = id_mapel_jadi_kelas($data['id_mapel']);
		$data['mapel'] = id_mapel_jadi_mapel($data['id_mapel']);
		$data['ulangan'] = $this->input->post('ulangan');
		$data['tugastambahan'] = $data['ulangan'].' '.$data['mapel'].' '.$data['kelas'].' '.$data['thnajaran'].' smt '.$data['semester'];
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');	
		if ($diproses != 'oke') 
		{
			$this->load->view('pengawas/bg_atas',$data);
			$this->load->view('shared/form_mencetak_perangkat',$data);
			$this->load->view('shared/bawah');

		}
		if ($diproses == 'oke') 
		{
			if ($data['yangdicetak'] == 'Penilaian Kinerja Guru')
			{
				$this->load->view('shared/mencetak_penilaian_kinerja_guru',$data);
			}
			elseif ($data['yangdicetak'] == 'Catatan Hambatan Belajar Siswa')
			{
				$this->load->view('shared/mencetak_catatan_hambatan',$data);
			}
			elseif ($data['yangdicetak'] == 'Hambatan Belajar Siswa')
			{
				$this->load->view('shared/mencetak_hambatan',$data);
			}
			elseif ($data['yangdicetak'] == 'Laporan Capaian Kompetensi')
			{
				$this->load->view('shared/mencetak_lck',$data);
			}
			elseif ($data['yangdicetak'] == 'Deskripsi Laporan Capaian Kompetensi')
			{
				$this->load->view('shared/mencetak_deskripsi_lck',$data);
			}
			elseif ($data['yangdicetak'] == 'Rencana Pelaksanaan Harian')
			{
				$this->load->view('shared/mencetak_rph',$data);
			}
			elseif ($data['yangdicetak'] == 'Rencana Pelaksanaan Pembelajaran')
			{
				$this->load->view('shared/mencetak_rencana_pelaksanaan_pembelajaran',$data);
			}
			elseif ($data['yangdicetak'] == 'Buku Pelaksanaan Harian')
			{
				$this->load->view('shared/mencetak_bph',$data);
			}
			elseif ($data['yangdicetak'] == 'Buku Pengembalian Ulangan')
			{
				$this->load->view('shared/mencetak_bpu',$data);
			}
			elseif ($data['yangdicetak'] == 'Daftar Hadir Siswa')
			{
				$this->load->view('shared/mencetak_kehadiran',$data);
			}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Akhlak')
			{
				$this->load->view('shared/mencetak_akhlak',$data);
			}
			elseif ($data['yangdicetak'] == 'Buku Informasi Penilaian')
			{
				$this->load->view('shared/mencetak_informasi_penilaian',$data);
			}
			elseif ($data['yangdicetak'] == 'Daftar Buku Pegangan')
			{
				$this->load->view('shared/mencetak_daftar_buku_pegangan',$data);
			}
			elseif ($data['yangdicetak'] == 'Buku Tugas')
			{
				$this->load->view('shared/mencetak_daftar_tugas',$data);
			}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Psikomotor')
			{
				$this->load->view('shared/mencetak_daftar_nilai_psikomotor',$data);
			}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Afektif')
			{
				$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
			}
			elseif ($data['yangdicetak'] == 'Jurnal Piket')
			{
				$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
			}
			elseif ($data['yangdicetak'] == 'Analisis')
			{
				$this->load->view('shared/mencetak_analisis_ulangan',$data);
			}
			else
			{
				$this->load->view('shared/form_mencetak_perangkat',$data);
			}
		}
	}
	function perangkattambahan()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();

		if($session!="")
		{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			if($data["status"]=="Pengawas"){
		$data["tanggal"] = mdate($datestring, $time);
		$data['yangdicetak']=$this->input->post('yangdicetak');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['namaguru'] = cari_nama_pegawai($this->input->post('kodeguru'));
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');	
		if ($diproses != 'oke') 
			{
			$this->load->view('pengawas/bg_atas',$data);

			$this->load->view('shared/form_mencetak_perangkat_tambahan',$data);
			$this->load->view('shared/bawah');

			}
		if ($diproses == 'oke') 
			{
			if ($data['yangdicetak'] == 'Agenda Harian')
				{
				$this->load->view('shared/mencetak_agenda_harian',$data);
				}
			elseif ($data['yangdicetak'] == 'Analisis Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_analisis_pelaksanaan_kegiatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Laporan Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_laporan_pelaksanaan_kegiatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Program Kerja')
				{
				$this->load->view('shared/mencetak_program_kerja',$data);
				}
			elseif ($data['yangdicetak'] == 'Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_pelaksanaan_kegiatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Tindak Lanjut Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_tindak_lanjut_pelaksanaan_kegiatan',$data);
				}
			else
				{
				$this->load->view('shared/form_mencetak_perangkat_tambahan',$data);
				}
			}
		}
					else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Pengawas...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	function kirimpesan()
	{
		if($session!=""){
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$datestring = "%d-%m-%Y | %h:%i:%a";
		$time = time();
		$input=array();
		$kodeguru=$this->input->post('kodeguru');
		$input['subjek']=$this->input->post('subjek');
		$input['status_pesan']="N";
		$input['waktu']=mdate($datestring,$time);
		$input['pesan']=$this->input->post('pesan');
		$input['username'] = 'pengawas';

		$judul = $this->input->post('subjek');
		if (!empty($input['subjek']))
			{
			//cari hp guru
			$this->load->model('Situs_model');
			$nohpguru = cari_seluler_pegawai($kodeguru);
			$username = cari_username_pegawai($kodeguru);
			$input['tujuan'] = $username;
			$pesan = 'Pesan '.$data['nama'].', "'.$this->input->post('pesan').'"';
			$this->Situs_model->Simpan_Pesan_Admin($input);
			}
		if (!empty($nohpguru))
			{
			$this->Situs_model->Kirim_SMS_Guru($nohpguru,$pesan,$this->config->item('id_sms_user'));
			}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/pengawas'>";
		}
		else{
		?>
			<script type="text/javascript">
			alert("Anda belum Log In...!!!");			
			</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/pengawas'>";
		}
		
	}
	function cetak()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = '';
		$perangkat = $this->uri->segment(3);
		$perangkat = strtolower($perangkat);
		if($perangkat == 'analisis')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_analisis',$data);
			}
		elseif($perangkat == 'analisislengkap')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_analisis_ulangan_lengkap',$data);
			}
		elseif($perangkat == 'remidial')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_rancangan_program_remidial',$data);
			}
		elseif($perangkat == 'pengayaan')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_pengayaan',$data);
			}
		elseif($perangkat == 'bukutugas')
			{
			$data['kodebukutugas']= $this->uri->segment(4);
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_daftar_tugas',$data);
			}
		elseif($perangkat == 'daftarhadirsiswa')
			{
			$data['kodebukutugas']= $this->uri->segment(4);
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_kehadiran',$data);
			}

		elseif($perangkat == 'bip')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_informasi_penilaian',$data);
			}
		elseif($perangkat == 'bpu')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_bpu',$data);
			}

		elseif($perangkat == 'rph')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_rph',$data);
			}
		elseif($perangkat == 'bph')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_bph',$data);
			}
		elseif($perangkat == 'chbs')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_catatan_hambatan',$data);
			}
		elseif($perangkat == 'daftarbukupegangan')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_daftar_buku_pegangan',$data);
			}

		elseif($perangkat == 'afe')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
			}
		elseif($perangkat == 'daftarnilaiakhlak')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_akhlak',$data);
			}
		elseif($perangkat == 'psi')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_daftar_nilai_psikomotor',$data);
			}
		elseif($perangkat == 'lck')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_lck',$data);
			}
		elseif($perangkat == 'dlck')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_deskripsi_lck',$data);
			}

		elseif($perangkat == 'lhb')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_lhb_mapel',$data);
			}
		elseif($perangkat == 'kog')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5));
			$data['sms'] = 1;
			$this->load->view('shared/mencetak_daftar_nilai_kognitif',$data);
			}

		else
			{
			redirect('kepala/perangkat');
			}
		//$this->load->view('shared/kirim_pesan',$data);
	}
	function supervisimengajar($kodeguru=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Supervisi Guru Mengajar';
		$this->load->model('Guru_model');
		$data["kodeguru"] = $kodeguru;
		$data['thnajaran']= cari_thnajaran();
		$data['semester']= cari_semester();
		$data['namaguru'] = cari_nama_pegawai($kodeguru);
		$data['loncat']= '';
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
		$this->load->view('pengawas/bg_atas',$data);
		$this->load->view('shared/supervisi_mengajar',$data);
		$this->load->view('shared/bawah');
	}
	function supervisi($kodeguru=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Supervisi Perangkat Guru';
		$this->load->model('Guru_model');
		$data["kodeguru"] = $kodeguru;
		$data['thnajaran']=cari_thnajaran();
		$data['semester']=cari_semester();
		$data['namaguru'] = cari_nama_pegawai($kodeguru);
		$data['loncat'] = '';
		$diproses=$this->input->post('diproses');
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
		$this->load->view('pengawas/bg_atas',$data);
		$this->load->view('shared/supervisi',$data);
		$this->load->view('shared/bawah');
	}

}//akhir fungsi
?>
