<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Situs extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','string', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model');
	}
	
	function index()
	{
		$data=array();
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
		$id_soal = '';
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
		$data["jawaban_polling"] = $this->Situs_model->Tampil_Soal_Polling($id_soal);
		$data['gambarslide'] = '';
		$this->load->view('situs/kepala_utama',$data);
		$this->load->view('situs/utama',$data);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}
	function detailberita($id_berita=null)
	{
		$data=array();
		$this->load->model('Situs_model');
		$data["detail"]=$this->Situs_model->Detail_Berita($id_berita);
		$data["acak_berita"] = $this->Situs_model->Berita_Acak($id_berita);
		$data["tutorial_populer"] = $this->Situs_model->Tutorial_Populer();
		$this->Situs_model->Update_Counter_Berita($id_berita);
		$data['beritaaktif'] = '';
		$this->load->view('situs/kepala',$data);
		if($data["detail"]->num_rows()>0)
			{
			$this->load->view('situs/detail_berita',$data);
			}
			else
			{
			$datax["pesan_404"] = 'Mohon maaf, berita tidak ditemukan';
			$this->load->view('shared/404',$datax);
			}
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);
	}

	function detailmateri($id_tutorial=null)
	{
		$data=array();
		$this->load->model('Situs_model');
		$page=$this->uri->segment(4);
		$data["detail"]=$this->Situs_model->Detail_Tutorial($id_tutorial);
		$this->Situs_model->Update_Counter_Tutorial($id_tutorial);
		$data["acak_tutorial"] = $this->Situs_model->Tutorial_Acak($id_tutorial);
		$this->load->view('situs/kepala');
		if($data["detail"]->num_rows()>0)
			{
			$this->load->view('situs/detail_materi',$data);
			}
			else
			{
			$datax["pesan_404"] = 'Mohon maaf, materi pelajaran tidak ditemukan';
			$this->load->view('shared/404',$datax);
			}
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}
	function katberita()
	{
		$id_kategori='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_kategori='';
		}
		else
		{
    			$id_kategori = $this->uri->segment(3);
		}
		$data2=array();
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$judul_kategori = $this->Situs_model->Daftar_Kategori_Berita();
     		$page=$this->uri->segment(4);
      		$limit=6;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;	
        	$query = $this->Situs_model->Kategori_Berita($id_kategori,$offset,$limit);
		$tot_hal = $this->Situs_model->Total_Berita($id_kategori);
      	 	$config['base_url'] = base_url() . '/situs/katberita/'.$id_kategori;
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
	    	$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
        	$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data2 = array('query' => $query,'judul_kategori'=>$judul_kategori,'paginator'=>$paginator);
		$this->load->view('situs/kepala');
		if($tot_hal->num_rows()>0)
			{
			$this->load->view('situs/kategori_berita',$data2);
			}
			else
			{
			$datax["pesan_404"] = 'Mohon maaf, kategori berita tidak ditemukan';
			$this->load->view('shared/404',$datax);
			}
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}

	function katmateri()
	{
		$id_kategori='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_kategori='';
		}
		else
		{
    			$id_kategori = $this->uri->segment(3);
		}
		$data2=array();
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$judul_kategori = $this->Situs_model->Judul_Kategori_Tutorial($id_kategori);
     		$page=$this->uri->segment(4);
      		$limit=5;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;	
        	$query = $this->Situs_model->Kategori_Tutorial($id_kategori,$offset,$limit);
		$tot_hal = $this->Situs_model->Total_Tutorial($id_kategori);
      	 	$config['base_url'] = base_url() . '/situs/katmateri/'.$id_kategori;
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
	    	$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
        	$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data2 = array('query' => $query,'judul_kategori'=>$judul_kategori,'paginator'=>$paginator);
		$this->load->view('situs/kepala');
		if($tot_hal->num_rows()>0)
			{
			$this->load->view('situs/kategori_materi',$data2);
			}
			else
			{
			$datax["pesan_404"] = 'Mohon maaf, kategori materi pelajaran tidak ditemukan';
			$this->load->view('shared/404',$datax);
			}
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}
	function pencarian()
	{
		$kata=strip_tags($this->input->post('katakunci'));
		$tabel=$this->input->post('pencarian');
		$this->load->model('Situs_model');
		$data["soal_polling"] = $this->Situs_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		$id_soal = '';
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id_soal_poll;
			}
		
      		$limit_agenda=5;
		$offset_agenda = 0;
		$tabel = 'tbl'.$tabel;
		$data["pilihan"] = $tabel;
		$data["kata"] = $kata;
		$hasil = $this->Situs_model->Pencarian($kata,$tabel);
		$data["jumlah"] = $hasil->num_rows();
		$data["hasil"] = $hasil;
		$this->load->view('situs/kepala');
		$this->load->view('situs/hasil_pencarian',$data);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}
	function hasilpolling()
	{
		$pilih=hilangkanpetik($this->input->post('polling'));
		$id_soal=hilangkanpetik($this->input->post('id_soal'));
		setcookie("poling", "sudah poling", time() + 3600 * 24);
		if (isset($_COOKIE["poling"])) {
   		?>
			<script type="text/javascript">
				alert("Maaf, anda sudah mengisi polling ini!!! Setiap hari, hanya bisa mengisi satu kali. Silahkan vote kembali besok.");
			</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/lihathasil'>";
 		}
 		else{
		$this->load->model('Situs_model');
		$this->Situs_model->Update_Polling($pilih);
		$data["soal_polling"] = $this->Situs_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		$id_soal = '';
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id_soal_poll;
			}
		$data["jawaban_polling"] = $this->Situs_model->Tampil_Soal_Polling($id_soal);
		$this->load->view('situs/kepala');
		$this->load->view('situs/hasil_polling',$data);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

		}
	}
	function lihathasil()
	{
		$id_soal=hilangkanpetik($this->input->post('id_soal'));
		$this->load->model('Situs_model');
		$data["soal_polling"] = $this->Situs_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		$id_soal = '';
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id_soal_poll;
			}
		$data["jawaban_polling"] = $this->Situs_model->Tampil_Soal_Polling($id_soal);
		$this->load->view('situs/kepala');
		$this->load->view('situs/hasil_polling',$data);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);


	}
	function agenda($page=null)
	{
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		//paging agenda
      		$limit_agenda=5;
		if(!$page):
		$offset_agenda = 0;
		else:
		$offset_agenda = $page;
		endif;	
		$tot_hal = $this->Situs_model->Total_Agenda();
		$query = $this->Situs_model->Tampil_Agenda_Terbaru($limit_agenda,$offset_agenda);
      	 	$config['base_url'] = base_url() . '/situs/agenda/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit_agenda;
		$config['uri_segment'] = 3;
	    	$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
        	$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data2 = array('query' => $query,'paginator'=>$paginator);
		$this->load->view('situs/kepala');
		$this->load->view('situs/agenda',$data2);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

		
	}
	function pengumuman()
	{
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$data["soal_polling"] = $this->Situs_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		$id_soal = '';
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id_soal_poll;
			}
		$data["jawaban_polling"] = $this->Situs_model->Tampil_Soal_Polling($id_soal);

		//paging pengumuman
		$page=$this->uri->segment(3);
      		$limit_umum=5;
		if(!$page):
		$offset_umum = 0;
		else:
		$offset_umum = $page;
		endif;	
		$tot_hal = $this->Situs_model->Total_Pengumuman();
		$data["agenda"] = $this->Situs_model->Tampil_Agenda_Terbaru(5,0);
		$query = $this->Situs_model->Tampil_Pengumuman_Terbaru($limit_umum,$offset_umum);
      	 	$config['base_url'] = base_url() . '/situs/pengumuman/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit_umum;
		$config['uri_segment'] = 3;
	    	$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
        	$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data2 = array('query' => $query,'paginator'=>$paginator);
		$this->load->view('situs/kepala');
		$this->load->view('situs/pengumuman',$data2);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}

	function katdownload()
	{
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$id_kat='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_kat='';
		}
		else
		{
    			$id_kat = $this->uri->segment(3);
		}
		$page=$this->uri->segment(4);
	      	$limit_down=6;
		if(!$page):
		$offset_down = 0;
		else:
		$offset_down = $page;
		endif;
		$data["hal"] = $page;
		$judul_kat = $this->Situs_model->Judul_Kat_Down($id_kat);
		$tot_hal = $this->Situs_model->Total_Kat_Down($id_kat);
		$query = $this->Situs_model->Kategori_Download($id_kat,$offset_down,$limit_down);
      	 	$config['base_url'] = base_url() . '/situs/katdownload/'.$id_kat;
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit_down;
			$config['uri_segment'] = 4;
	    	$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$data2 = array('query' => $query,'paginator'=>$paginator, 'tot_hal'=>$tot_hal, 'judul_kat'=>$judul_kat);	
		$this->load->view('situs/kepala');
		if($tot_hal->num_rows()>0)
			{
			$this->load->view('situs/kategori_download',$data2);
			}
			else
			{
			$datax["pesan_404"] = 'Mohon maaf, kategori unduhan tidak ditemukan';
			$this->load->view('shared/404',$datax);
			}
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}
	function updatepassword()
	{
		$username=hilangkanpetik($this->input->post('username'));
		$psw=hilangkanpetik($this->input->post('pwd'));
		$psw_lama=hilangkanpetik($this->input->post('pwd_lama'));
		$this->load->model('Situs_model');
		$hasil = $this->Situs_model->Data_Login($username,$psw_lama);
		if(count($hasil->result()) <= 0)
		{
			?>
			<script type="text/javascript">
				alert('Password lama yang anda masukkan SALAH..!!!');
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/passwordmhs'>";
		}
		else if($psw!="" AND $psw_lama!="")
		{
			$this->Situs_model->Update_Password($username,$psw);
			echo "<font size='2' face='arial'>Sukses memperbarui password.<br> Password baru Anda : <b>".$psw."</b><br>
			Dengan username : <b>".$username."</b><br>";
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/passwordmhs'>";
		}
	}
	function updatepasswordguru()
	{
		$username=hilangkanpetik($this->input->post('username'));
		$psw=hilangkanpetik($this->input->post('pwd'));
		$psw_lama=hilangkanpetik($this->input->post('pwd_lama'));
		$this->load->model('Situs_model');
		$hasil = $this->Situs_model->Data_Login($username,$psw_lama);
		if(count($hasil->result()) <= 0)
		{
			?>
			<script type="text/javascript">
				alert('Password lama yang anda masukkan SALAH..!!!');
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/passwordguru'>";
		}
		else if($psw!="" AND $psw_lama!="")
		{
			$this->Situs_model->Update_Password($username,$psw);
			echo "<font size='2' face='arial'>Sukses memperbarui password.<br> Password baru Anda : <b>".$psw."</b><br>
			Dengan username : <b>".$username."</b><br>";
			echo '<a href="'.base_url().'guru">Lanjut</a>';
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/passwordguru'>";
		}
	}

	function kirimpesanadmin()
	{
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$datestring = "%d-%m-%Y | %h:%i:%a";
			$time = time();
			$input=array();
			$input['username']=hilangkanpetik($this->input->post('nim'));
			$input['subjek']=hilangkanpetik($this->input->post('subjek'));
			$input['tujuan']="admin";
			$input['status_pesan']="N";
			$input['waktu']=mdate($datestring,$time);
			$input['pesan']=hilangkanpetik($this->input->post('pesan'));
			$pesan = hilangkanpetik($this->input->post('pesan'));
			$judul = hilangkanpetik($this->input->post('subjek'));
			if ($input['subjek']=="")
			{
				$input['subjek']='tanpa subjek';
			}
			if($input['pesan']=="")
			{
				?>
				<script type="text/javascript">
				alert("Kolom pesan belum diisi ...!!!");			
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/pesanadmin'>";
			}
			else
			{
				$this->load->model('Situs_model');
				//cari nohp pengirim
				$tnohp = $this->Situs_model->Tampil_Data_Umum_Pegawai($input['username']);
				$nohp='';
				$pengirim = '';
				foreach($tnohp->result() as $dnohp)
				{
					$nohp = $dnohp->seluler;
					$pengirim = $dnohp->nama;
				}
				$tnohp = $this->Situs_model->Tampil_Data_Siswa($input['username']);
				foreach($tnohp->result() as $dnohp)
				{
					$nohp = $dnohp->hp;
					$pengirim = $dnohp->nama;
				}
				$this->Situs_model->Simpan_Pesan_Admin($input);
				$notujuan = $this->config->item('nohpadmin');
				if (!empty($nohp))
				{
					$this->Situs_model->Kirim_SMS($nohp,$pengirim,$notujuan,$pesan);
				}
				echo"<font size='2' face='arial'>Pesan anda telah terkirim ke pihak admin. Tunggu balasan dari kami sesaat lagi.<br><b>Terima kasih</b></font>";
			}
		}
		else
		{
			?>
			<script type="text/javascript">
			alert("Anda belum Log In...!!!");			
			</script>
			<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/pesanadmin'>";
		}
	}
	function kirimpesanguru()
	{
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$datestring = "%d-%m-%Y | %h:%i:%a";
			$time = time();
			$input=array();
			$input['username']=hilangkanpetik($this->input->post('nim'));
			$input['subjek']=hilangkanpetik($this->input->post('subjek'));
			$input['tujuan']=hilangkanpetik($this->input->post('tujuan'));
			$input['status_pesan']="N";
			$input['waktu']=mdate($datestring,$time);
			$input['pesan']=hilangkanpetik($this->input->post('pesan'));
			$judul = $this->input->post('subjek');
			if ($input['subjek']=="")
			{
				$input['subjek']='tanpa subjek';
			}
			if($input['pesan']=="")
			{
				?>
				<script type="text/javascript">
				alert("Kolom pesan belum diisi ...!!!");			
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/pesanguru'>";
			}
			else
			{
				$this->load->model('Situs_model');
				//cari nohp pengirim
				$tnohp = $this->Situs_model->Tampil_Data_Umum_Pegawai($input['tujuan']);
				$nohpguru='';
				$namaguru = '';
				$jenkel ='';
				foreach($tnohp->result() as $dnohp)
				{
					$nohpguru = $dnohp->seluler;
					$namaguru = $dnohp->nama;
					$jenkel = $dnohp->jenkel;
				}
				$tpengirim = $this->Situs_model->Tampil_Data_Siswa($input['username']);
				foreach($tpengirim->result() as $dpeng)
				{
					$pengirim = $dpeng->nama;
					$kelas = $dpeng->kdkls;
				}
				if ($jenkel =='Lk')
				{
					$pesan = 'Bapak '.$namaguru.' mendapat pesan dari '.$pengirim.' kelas '.$kelas.' di portal';
				}
				elseif ($jenkel =='Pr')
				{
					$pesan = 'Ibu '.$namaguru.' mendapat pesan dari '.$pengirim.' kelas '.$kelas.' di portal';
				}
				else
				{
					$pesan = 'Bapak/Ibu mendapat pesan dari '.$pengirim.' kelas '.$kelas.' di portal';
				}
				$this->Situs_model->Simpan_Pesan_Admin($input);
				if (!empty($nohpguru))
				{
					$this->Situs_model->Kirim_SMS_Guru($nohpguru,$pesan,$this->config->item('id_sms_user'));
				}
				echo"<font size='2' face='arial'>Pesan anda telah terkirim ke pihak guru. Tunggu balasan dari guru yang bersangkutan.<br><b>Terima kasih</b></font>";
			}
		}
		else
		{
			?>
			<script type="text/javascript">
			alert("Anda belum Log In...!!!");			
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."situs/pesanadmin'>";
		}	
	}
	function detailprofil()
	{
		
		$id_berita='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_berita='';
		}
		else
		{
    			$id_berita = $this->uri->segment(3);
		}
		$data=array();
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$data["detail"]=$this->Situs_model->Detail_Profil($id_berita);
		$this->Situs_model->Update_Counter_Profil($id_berita);
		$data["acak_profil"] = $this->Situs_model->Profil_Acak($id_berita);
		$data['profilaktif'] = '';
		$this->load->view('situs/kepala');
		if($data["detail"]->num_rows()>0)
			{
			$this->load->view('situs/detail_profil',$data);
			}
			else
			{
			$datax["pesan_404"] = 'Mohon maaf, profil tidak ditemukan';
			$this->load->view('shared/404',$datax);
			}
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}

	function katprofil()
	{
		$id_kategori='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_kategori='';
		}
		else
		{
    			$id_kategori = $this->uri->segment(3);
		}
		$data['judulhalaman'] = 'Profil';
		$data2=array();
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
     		$page=$this->uri->segment(4);
      		$limit=6;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;	
		$judul_kategori = $this->Situs_model->Judul_Kategori_Profil($id_kategori);
        	$query = $this->Situs_model->Kategori_Profil($id_kategori,$offset,$limit);
		$tot_hal = $this->Situs_model->Total_Profil($id_kategori);
      	 	$config['base_url'] = base_url() . 'situs/katprofil/'.$id_kategori;
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
	    	$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
        	$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$data['profilaktif'] = '';
        	$data2 = array('query' => $query,'judul_kategori'=>$judul_kategori,'paginator'=>$paginator);
		$this->load->view('situs/kepala',$data);
		$this->load->view('situs/kategori_profil',$data2);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}

	function daftarabsen($page=null)
	{
		$this->load->model('Situs_model');
		$this->load->library('Pagination');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		//paging agenda
      		$limit_agenda=25;
		if(!$page):
		$offset_agenda = 0;
		else:
		$offset_agenda = $page;
		endif;	
		$tot_hal = $this->Situs_model->Total_Absen($thnajaran,$semester);
		$query = $this->Situs_model->Tampil_Absensi_Situs($thnajaran,$semester,$limit_agenda,$offset_agenda);
      	 	$config['base_url'] = base_url() . 'situs/daftarabsen/';
        	$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit_agenda;
		$config['uri_segment'] = 3;
	    	$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
        	$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data2 = array('query' => $query,'paginator'=>$paginator);
		$this->load->view('situs/kepala');
		$this->load->view('situs/absen',$data2);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

		
	}
	function lupasandi()
	{
		$get_proses = $this->uri->segment(3);
		$data['proses'] = '';
		if($get_proses == 1)
		{
			$data['proses'] = '1';
			$data['galat1'] = '';
			$data['galat2'] = '';
			$data['galat3'] = '';
			$data['galat4'] = '';
		}

		$this->load->view('shared/lupa_sandi',$data);

	}

	function proseslupasandi()
	{
		$telegram = 'Pesan singkat akan segera terkirim tidak lebih dari 5 menit. Bila lebih dari 5 menit, layanan sms mungkin sedang mati. Silakan hubungi admin.';
		$this->load->helper('string');
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('masukan', 'Nomor Seluler', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE)
        	{
			// fails
			$data['galat'] = form_error('masukan');
			$data['proses'] = '';
			$this->load->view('shared/lupa_sandi',$data);
        	}
		else
		{
		$masukan = hilangkanpetik($this->input->post('masukan'));
		$this->load->model('Situs_model');
		$username = $this->Situs_model->Reset_Password($masukan);
		$aktif = $this->Situs_model->Status_User($username);
		$noseluler = $this->Situs_model->Nomor_Seluler($username);
		$chat_id = $this->Situs_model->Chat_Id($username);
		$data["username"] = $username;
		$data["masukan"] = $masukan;
		if($username == 'xxganda')
		{
			$data['proses'] = '';
			$data['galat'] = 'Maaf, proses lupa sandi tidak dapat dilakukan. Kami menemukan nomor ponsel <strong>'.$masukan.'</strong> digunakan oleh lebih dari satu pengguna. Hubungi Admin lansung untuk me-reset password.';
			$this->load->view('shared/lupa_sandi',$data);


		}
		elseif ((empty($username)) or (empty($noseluler)))
			{
			$data['proses'] = '';
			$data['galat'] = 'Maaf, Nomor ponsel <strong>'.$masukan.'</strong> tidak kami temukan atau nomor seluler tidak terdaftar. Hubungi Admin.';
			$this->load->view('shared/lupa_sandi',$data);
			}
			else
			{
				if($aktif == 'Y')
				{
					$kode_reset = strtoupper(random_string('nozero','6'));
					$datainput=array();
					$datainput["noseluler"] = $noseluler;
					$datainput["kode_reset"] = $kode_reset;
					$this->Situs_model->Proses_Ganti_Password($datainput);
					$this->load->model('Referensi_model','ref');
					$token_bot = $this->ref->ambil_nilai('token_bot');
					$pesan = 'kode pemulihan kata sandi di SIANIS '.$kode_reset.'. Bila hendak mereset password klik tautan berikut '.base_url().'situs/resetpassword/1/'.$kode_reset.'. Abaikan pesan ini bila tidak memulihkan kata sandi.';	
					$telegram = $chat_id;
					if((!empty($chat_id)) and (!empty($token_bot)))
					{
						$this->load->helper('telegram');
						$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
						$telegram = 'Pesan singkat terkirim. Silakan periksa aplikasi telegram. Bila tidak terkirim coba lagi. atau silakan hubungi admin.';
					}
					else
					{
						$pesan = 'kode pemulihan kata sandi '.$kode_reset.' Abaikan pesan ini bila tidak memulihkan kata sandi.';	
						$this->Situs_model->Kirim_SMS_Guru($noseluler,$pesan,'');
					}
					$data['proses'] = 1;
					$data['galat1'] = '';
					$data['galat2'] = '';
					$data['galat3'] = '';
					$data['galat4'] = '';
					$data['telegram'] = $telegram;
					$data['token'] = '';
					$this->load->view('shared/lupa_sandi',$data);					
				}
				else
				{
					$data['proses'] = '2';
					$this->load->view('shared/lupa_sandi',$data);					
				}
			}
		}
	}
	function resetpassword($prosese=null,$get_reset_code=null)
	{
		if(($prosese == 1) and ($get_reset_code > 0))
		{
			$data['proses'] = 1;
			$data['galat1'] = '';
			$data['galat2'] = '';
			$data['galat3'] = '';
			$data['galat4'] = '';
			$data['telegram'] = '';
			$data['token'] = $get_reset_code;
			$this->load->view('shared/lupa_sandi',$data);
		}
	}

	function kirimsandi()
	{
		$data['telegram'] = '';
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('kode_reset', 'Kode Pemulihan', 'required');
		$this->form_validation->set_rules('username', 'Nama Pengguna', 'required');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Kata sandi lagi', 'trim|required|matches[password]');
		$kode_reset = hilangkanpetik($this->input->post('kode_reset'));
		if ($this->form_validation->run() == FALSE)
        	{
			// fails
			$data['galat1'] = form_error('kode_reset');
			$data['galat2'] = form_error('username');
			$data['galat3'] = form_error('password');
			$data['galat4'] = form_error('cpassword');
			$data['proses'] = '1';
			$data['token'] = $kode_reset;
			$this->load->view('shared/lupa_sandi',$data);
        	}
		else
		{

			$username = hilangkanpetik($this->input->post('username'));
			$psw=hilangkanpetik($this->input->post('password'));
			$this->load->model('Situs_model');
			$noseluler = $this->Situs_model->Cek_Reset_Password($kode_reset);
			$usernamex = $this->Situs_model->Seluler_Jadi_Username($noseluler);
				$data['token'] = $kode_reset;
			if($usernamex != $username)
			{
				$data['proses'] = 4;

				$this->load->view('shared/lupa_sandi',$data);
			}
			else
			{
				$options = array('cost' => 8);
				if(!empty($psw))
				{
					$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
				}
				$noseluler = $this->Situs_model->Nomor_Seluler($username);
				$this->Situs_model->Hapus_Reset($noseluler);				
				$this->Situs_model->Update_Password($username,$psw);
				$data['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
				$data['proses'] = 3;
				$this->load->view('shared/lupa_sandi',$data);
			}			
		}
	}
	function saran()
	{
		$data=array();
		$pesan_galat = '';
		$nama_tamu = hilangkanpetik($this->input->post('nama_tamu'));
		$nosel_tamu = hilangkanpetik($this->input->post('nosel_tamu'));
		$captcha = hilangkanpetik($this->input->post('captcha'));
		// First, delete old captchas
		$expiration = time()-600; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		$oke = 1;
		if ($row->count == 0)
		{
		    $oke = 0;
		}

		$saran = hilangkanpetik($this->input->post('saran'));
		$this->load->model('Situs_model');
		if(empty($nama_tamu))
			{
			$pesan_galat .= '<p class="text-info">Silakan menulis nama Anda</p>';
			}
		if(empty($saran))
			{
			$pesan_galat .= '<p class="text-info">Silakan menulis kritik / saran / pengaduan</p>';
			}
		if($oke == 0)
			{
			$pesan_galat .= '<p class="text-info">Kode keamanan salah</p>';
			}
		$data['nama_tamu'] = $nama_tamu;
		$data['nosel_tamu'] = $nosel_tamu;
		$data['saran'] = $saran;
		$this->load->model('Situs_model');
		if((!empty($nama_tamu)) and (!empty($saran)) and ($oke == 1))
		{
			$pbk = array();
			$pbk['nama_tamu'] = $nama_tamu;
			$pbk['nosel_tamu'] = $nosel_tamu;
			$pbk['saran'] = $saran;
			if (strpos($saran, '[url=') === FALSE)
			{
				$this->Situs_model->Simpan_Saran($pbk);
				$pesan_galat = '<div class="alert alert-success">Terima kasih sudah menulis kritik, saran atau pengaduan.</div>';

			}
			else
			{
			        $pesan_galat = 'Pesan mengandung spam';
			}
		}
		$data['pesan_galat'] = $pesan_galat;
		$data['nama_tamu'] = '';
		$data['nosel_tamu'] = '';
		$data['saran'] = '';
		$tabel_berita_utama = $this->Situs_model->Berita_Utama();
		$id_berita_utama ='';
		foreach($tabel_berita_utama->result() as $beritautama)
			{
				$id_berita_utama=$beritautama->id_berita;
			}
		$data["berita_utama"] = $this->Situs_model->Tampil_Berita_Utama($id_berita_utama);
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
		$id_soal = '';
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
		$this->load->view('situs/kepala');
		$this->load->view('situs/utama',$data);
		$data_footer['nama_web'] = $this->Referensi_model->ambil_nilai('nama_web');
		$data_footer['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
		$data_footer['maintainer'] = $this->Referensi_model->ambil_nilai('maintainer');
		$this->load->view('situs/bawah',$data_footer);

	}

}
?>
