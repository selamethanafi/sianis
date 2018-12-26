<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aim extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model','ref');
		$ip_aim = $this->ref->ambil_nilai('ip_aim');
		$ip = $_SERVER['REMOTE_ADDR'];
		if($ip != $ip_aim)
		{
			die('Galat, akses ilegal');
		}
	}
	function index()
	{
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['cetak_kartu_tes_sementara'] = $this->ref->ambil_nilai('cetak_kartu_tes_sementara');
		$this->load->view('aim/atas');
		$this->load->view('aim/index',$data);
		$this->load->view('situs/bawah');
	}
	function depan()
	{
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['cetak_kartu_tes_sementara'] = $this->ref->ambil_nilai('cetak_kartu_tes_sementara');
		$data['resolusi'] = '640';
		$this->load->view('aim/atas');
		$this->load->view('aim/depan',$data);
		$this->load->view('situs/bawah');
	}

	function token()
	{
		$data['kode_guru'] = $this->uri->segment(3);
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');

		$this->load->view('aim/atas');
		$this->load->view('aim/token_izin',$data);
		$this->load->view('situs/bawah');
	}

	function cektoken($token=null)
	{
		$data['token_bot'] = $this->ref->ambil_nilai('token_bot');
		$data['chat_id_grup_guru'] = $this->ref->ambil_nilai('chat_id_grup_guru');
		$data['url_sms_post'] = $this->ref->ambil_nilai('url_sms_post');
		$jenis_printer = $this->ref->ambil_nilai('jenis_printer_izin');
		$this->load->model('Situs_model');
		if(empty($token))
		{
			$token = nopetik($this->input->post('token'));
		}
		$data['token'] = $token;
		$this->load->helper('telegram');
		$this->load->view('aim/bootstrap');
		if($jenis_printer == 'Thermal')
		{
			$data['nama_printer'] = $this->ref->ambil_nilai('nama_printer_aim');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$this->load->view('aim/cek_token_thermal',$data);
		}
		else
		{
			$data['baris1'] = $this->ref->ambil_nilai('baris1');
			$data['baris2'] = $this->ref->ambil_nilai('baris2');
			$data['baris3'] = $this->ref->ambil_nilai('baris3');
			$data['baris4'] = $this->ref->ambil_nilai('baris4');
			$this->load->view('aim/cek_token',$data);
		}

	}
	function gerbang()
	{
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$this->load->view('aim/atas',$data);
		$this->load->view('aim/gerbang');
		$this->load->view('situs/bawah');
	}
	function approved($token=null)
	{
		$this->load->helper('telegram');
		$this->db->query("update `siswa_proses_izin` set `valid`='1' where `token`='$token'");
		$data['token'] = $token;
		$this->load->view('aim/bootstrap');
		$this->load->view('aim/approved',$data);
	}
	function cetak()
	{
		$data = array();
		$data['token'] = $this->uri->segment(3);
		$this->load->view('aim/bootstrap');
		$this->load->view('aim/surat_izin',$data);
	}
	function dispensasi()
	{
		$this->load->helper('string');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['select'] = '';
		$this->load->view('aim/atas');
		$this->load->view('aim/dispensasi',$data);
		$this->load->view('situs/bawah');
	}
	function suratdispensasi()
	{
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$this->load->view('aim/atas',$data );
		$this->load->view('aim/surat_dispensasi');
		$this->load->view('situs/bawah');
	}
	function cekdispensasi($token=null)
	{
		if(empty($token))
		{
			$token = nopetik($this->input->post('token'));
		}
		$data['token'] = $token;
		$jenis_printer = $this->ref->ambil_nilai('jenis_printer_izin');
		$this->load->view('aim/bootstrap');
		if($jenis_printer == 'Thermal')
		{
			$data['nama_printer'] = $this->ref->ambil_nilai('nama_printer_izin');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$this->load->view('aim/cek_dispensasi_thermal',$data);
		}
		else
		{
			$data['baris1'] = $this->ref->ambil_nilai('baris1');
			$data['baris2'] = $this->ref->ambil_nilai('baris2');
			$data['baris3'] = $this->ref->ambil_nilai('baris3');
			$data['baris4'] = $this->ref->ambil_nilai('baris4');
			$this->load->view('aim/cek_dispensasi',$data);
		}
	}
	function carinis($aksi=null)
	{
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		if(empty($aksi))
		{
			$data['aksi'] = 'izin';
		}
		elseif($aksi == 'dispensasi')
		{
			$data['aksi'] = 'dispensasi';
		}
		elseif($aksi == 'bayar')
		{
			$data['aksi'] = 'bayar';
		}

		else
		{
			$data['aksi'] = 'izin';
		}

		$this->load->view('aim/atas');
		$this->load->view('aim/cari_siswa',$data);
//		$this->load->view('situs/bawah');

	}

	function tampil($aksi=null)
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$nama = $this->input->post('kirimNama');
		$this->load->model('Siswa_model');
		$data['hasil_semua']=$this->Siswa_model->tampil_siswa_semua($nama);
		$data['hasil_limit']=$this->Siswa_model->tampil_siswa_limit($nama);
		if($nama!="")
		{
				echo '<div class="alert alert-success">Tunggu pencarian berhenti, lalu silakan klik nama Anda.</div>';
				foreach($data['hasil_limit']->result() as $result)
				{
					$nis = $result->nis;
					$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
					if(!empty($kelas))
					{
				 		echo '<div class="col-sm-4"><p><a href="'.base_url().'aim/'.$aksi.'/'.$result->nis.'" class="btn btn-success"><b>'.$result->nis.' '.$result->nama.'</b> '.$kelas.'</a></p></div>';
					}
				}
		}
		else
		{
			echo "error";
		}
	}
	function bayar($get_nis=null,$tahun=null,$semester=null)
	{
		$this->load->helper('string');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$post_nis = nopetik($this->input->post('post_nis'));
		$besar = nopetik($this->input->post('besar'));
		$data['get_nis'] = $get_nis;
		if(!empty($post_nis))
		{
			redirect('aim/bayar/'.$post_nis);
		}
		if(empty($tahun))
		{
			$tahun = substr(cari_thnajaran(),0,4);
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		if((!empty($get_nis)) and ($besar>0))
		{
			$this->db->query("delete from `siswa_proses_bayar` where `nis`='$get_nis'");
			$this->db->query("insert into `siswa_proses_bayar` (`nis`, `besar`) values ('$get_nis', '$besar')");
			redirect('aim/sukses/'.$get_nis);
		}
		$tahun2 = $tahun + 1;
		$thnajaran = $tahun.'/'.$tahun2;
		$data['tahun']= $tahun;
		$data['thnajaran'] = $thnajaran;
		$data['semester'] = $semester;
		$this->load->model('Keuangan_model');
		$this->load->view('aim/atas');
		$this->load->view('aim/bayar',$data);
		$this->load->view('situs/bawah');
	}
	function sukses($get_nis=null)
	{
		if(empty($get_nis))
		{
			redirect('aim');
		}
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['nis'] = $get_nis;
		$this->load->view('aim/atas');
		$this->load->view('aim/sukses',$data);
		$this->load->view('situs/bawah');
	}
	function izin()
	{
		$this->load->helper('string');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['select'] = '';
		$this->load->view('aim/atas');
		$this->load->view('aim/izin',$data);
		$this->load->view('situs/bawah');

	}
	function prosesizin()
	{
		$this->load->helper('string');
		$alasan = nopetik($this->input->post('alasan'));
		$kode_guru = nopetik($this->input->post('kode_guru'));
		$token_bot = $this->ref->ambil_nilai('token_bot');
		if(!empty($alasan))
		{
			foreach ($_POST['nis'] as $nis) 
			{
				$token = strtoupper(random_string('nozero','6'));
				$tokenmd5 = md5($this->config->item('awalttd').$token);
				$this->load->model('Aim_model');
				$in['nis'] = $nis;
				$in['tanggal'] = tanggal_hari_ini();
				$in['alasan'] = nopetik($this->input->post('alasan'));
				$in['jamke'] = nopetik($this->input->post('jamke'));
				$in['kembali'] = nopetik($this->input->post('kembali'));
				$in['token'] = $token;
				$in['tokenmd5'] = $tokenmd5;
				$in['kodeguru'] = $kode_guru;
				$this->Aim_model->Simpan_Izin($in);
				$nama_siswa = nis_ke_nama($nis);
				//cari nohp guru piket
				if(!empty($kode_guru))
				{
					$chat_id = $kode_guru;
				}
				else
				{
					$chat_id = cari_chat_id_pegawai($kode_guru);
				}
				$pesan = 'Ananda '.$nama_siswa.' mengajukan izin. Token '.$token.'. atau klik '.base_url().'aim/approved/'.$token;
				if((!empty($chat_id)) and (!empty($token_bot)))
				{
					$this->load->helper('telegram');
					$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
				}
			}
			redirect(base_url().'aim/token/'.$kode_guru); 
		}
		else
		{
			redirect('aim');
		}
	}
	function carinisjson()
	{
		$data['q']=$this->input->get("q");
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$this->load->view('aim/carinisjson',$data);
	}
	function prosesdispensasi()
	{
		$this->load->helper('string');
		$alasan = nopetik($this->input->post('alasan'));
		$kode_guru = nopetik($this->input->post('kode_guru'));
		$chat_id = $this->ref->ambil_nilai('chat_id_grup_guru');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$token_bot = $this->ref->ambil_nilai('token_bot');
		if(!empty($alasan))
		{
			$this->load->model('Aim_model');
			$ada = 0;
			foreach ($_POST['nis'] as $nis) 
			{
				$token = strtoupper(random_string('nozero','6'));
				$tokenmd5 = md5($this->config->item('awalttd').$token);
				$in['nis'] = $nis;
				$in['tanggal'] = tanggal_hari_ini();
				$in['kodeguru'] = $kode_guru;
				$in['alasan'] = nopetik($this->input->post('alasan'));
				$in['dispensasi'] = nopetik($this->input->post('dispensasi'));
				$in['jamke'] = nopetik($this->input->post('jamke'));
				$in['token'] = $token;
				$this->Aim_model->Simpan_Izin($in);
				$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
				$pesan = 'Ananda '.nis_ke_nama($nis).' kelas '.$kelas.' mengajukan dispensasi ('.$in['dispensasi'].') karena '.$in['alasan'];

				if((!empty($chat_id)) and (!empty($token_bot)))
				{
					$this->load->helper('telegram');
					$kirimpesan = kirimtelegram($chat_id,$pesan,$token_bot);
				}
				$ada++;
			}
			if($ada == 1)
			{
				redirect(base_url().'aim/cekdispensasi/'.$token); 
			}
			else
			{
				redirect(base_url().'aim/suratdispensasi'); 
			}

		}
		else
		{
			redirect('aim');
		}
	}
	function bayarnama()
	{
		$this->load->helper('string');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$nis = nopetik($this->input->post('post_nis'));
		$besar = nopetik($this->input->post('besar'));
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data['thnajaran'] = $thnajaran;
		$data['semester'] = $semester;
		$data['select'] = '';
		$this->load->view('aim/atas');
		$this->load->view('aim/bayar_nama',$data);
		$this->load->view('situs/bawah');
	}
	function prosesbayarnama()
	{
		$nis = nopetik($this->input->post('nis'));
		$besar = nopetik($this->input->post('besar'));
		$besar = preg_replace("/ /","", $besar);
		$besar = preg_replace("/Rp/","", $besar);
		$besar = preg_replace("/\./","", $besar);
		if((!empty($nis)) and ($besar>0))
		{
			$this->db->query("delete from `siswa_proses_bayar` where `nis`='$nis'");
			$this->db->query("insert into `siswa_proses_bayar` (`nis`, `besar`) values ('$nis', '$besar')");
			redirect('aim/sukses/'.$nis);
		}
		else
		{
			redirect('aim');
		}
	}
	function kartutes()
	{
		$this->load->helper('string');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['select'] = '';
		$data['nama_printer'] = $this->ref->ambil_nilai('nama_printer_izin');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['nis'] = nopetik($this->input->post('nis'));
		$data['nama_tes'] = nopetik($this->input->post('nama_tes'));
		$this->load->view('aim/atas');
		$this->load->view('aim/kartu_tes_sementara',$data);
		$this->load->view('situs/bawah');
	}
	function passwordtes()
	{
		$this->load->helper('string');
		$data['nama_web'] = $this->ref->ambil_nilai('nama_web');
		$data['maintainer'] = $this->ref->ambil_nilai('maintainer');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['select'] = '';
		$data['nama_printer'] = $this->ref->ambil_nilai('nama_printer_izin');
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['nis'] = nopetik($this->input->post('nis'));
		$this->load->view('aim/atas');
		$this->load->view('aim/kartu_tes_daring',$data);
		$this->load->view('situs/bawah');
	}

}
?>
