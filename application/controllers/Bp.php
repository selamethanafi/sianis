<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bp extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="BP")
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
		$data['judulhalaman'] ='Panel Kendali BK';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'bp';
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
		$this->load->view('bp/bg_head',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}

	function carisiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Pencarian Data Siswa';
		$kunci_nama=cegah($this->input->post('nama'));
		if(!empty($kunci_nama))
		{
			redirect('bp/hasilcarisiswa/'.$kunci_nama);
		}
		$this->load->model('Bp_model');
		$data["query"]=$this->Bp_model->Cari_Siswa($kunci_nama);

		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/siswa',$data);
		$this->load->view('shared/bawah');
	}
	function hasilcarisiswa($kunci_nama=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Pencarian Data Siswa';
		$kunci_nama = nopetik(balikin($kunci_nama));
		if(empty($kunci_nama))
		{
			redirect('bp/carisiswa');
		}
		$this->load->model('Bp_model');
		$data["query"]=$this->Bp_model->Cari_Siswa($kunci_nama);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/siswa',$data);
		$this->load->view('shared/bawah');
	}

	function detilsiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Data Siswa';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    		$id='';
		}
		else
		{
    		$id = $this->uri->segment(3);
		}
		$this->load->model('Bp_model');
		$data['nis'] = $id;
		$data['tautan'] = 'bp';
		$data["query"]=$this->Bp_model->Detil_Siswa($id);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('tatausaha/detil_siswa_foto',$data);
		$this->load->view('shared/bawah');
	} 
	function ketertiban()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/ketertiban',$data);
		$this->load->view('shared/bawah');
	}
	function kredit($page=null)
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Pencatatan Kredit Pelanggaran';
		$nis = $this->uri->segment(3);
		$data["thnajaran"]=$thnajaran;
		$data["semester"]=$semester;
		$this->load->model('Bp_model');
		$this->load->library('Pagination');	
      		$limit_ti=9;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$querysiswa=$this->Bp_model->Tampilkan_Semua_Siswa_Aktif($thnajaran,$semester);
		$query=$this->Bp_model->Tampil_Semua_Kredit($thnajaran,$limit_ti,$offset_ti);
		$tot_hal = $this->Bp_model->Total_Semua_Kredit($thnajaran);
		$tabel_kredit=$this->Bp_model->Daftar_Kredit();
		$daftar_guru=$this->Bp_model->Daftar_Guru();
      		$config['base_url'] = base_url() . 'bp/kredit';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
	        $data_isi = array('query' => $query,'querysiswa' => $querysiswa,'daftar_guru'=>$daftar_guru, 'tabel_kredit'=>$tabel_kredit,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/kredit',$data_isi);
		//$this->load->view('shared/bawah');
	}
	function hapuskredit($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$this->load->model('Bp_model');
		$this->Bp_model->Hapus_Kredit($id);
		redirect('bp/kredit');
	}
	function siswakelas()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Siswa Kelas';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
        	$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
        	$data_isi['daftarkelas'] = $querykelas ;
		$data['kelas'] = $this->input->post('kelas');
		$data['thnajaran'] = $this->input->post('thnajaran');
		$data['semester'] = $this->input->post('semester');
		$data['urutkan'] = $this->input->post('urutkan');
		$data['tautan_balik'] = 'bp';
		$data_isi['cacahsiswa'] = $this->input->post('cacahsiswa');
		$cacahsiswa = $this->input->post('cacahsiswa');
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$kelas = $this->input->post('kelas');
		if($cacahsiswa>0)
		{
		$param = array();
		for($i=1;$i<=$cacahsiswa;$i++)
			{
			$nis = $this->input->post('nis_'.$i);
			$no_urut = $this->input->post('no_urut_'.$i);
			$csiswakelas = 1;
			$param['thnajaran']=$thnajaran;
			$param['semester'] = $semester;
			$param['status'] = 'Y';	
			$param['kelas'] = $kelas;
			$param['nis'] = $nis;
			$param['no_urut'] = $no_urut;
			$param['bsm'] = $this->input->post('bsm_'.$i);
			$param['alasan_bsm'] = $this->input->post('alasan_bsm_'.$i);

			$tsiswakelas = $this->Admin_model->Add_Siswa_Kelas($param,$csiswakelas);
			}
		}
		$querysiswa=$this->Admin_model->Tampil_Siswa_Kelas($data['thnajaran'],$data['semester'],$data['kelas']);
        	$data_isi['daftarsiswa'] = $querysiswa ;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('shared/siswa_kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function rekapharian()
	{
		$tahun = date("Y");
		$bulan = date("m");
		$tgl = date("d");
		$thnajaranx = cari_thnajaran();
		$semesterx = cari_semester();
		$data["tglskr"] = "$tahun-$bulan-$tgl";
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Ketidakhadiran Siswa Pada Tanggal Tertentu';
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		if(($tanggalhadir>0) and ($bulanhadir>0) and ($tahunhadir>0))
		{
			$this->load->model('Bp_model');
			$data["tanggalabsen"] = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$tanggalabsen = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$data["query"]=$this->Bp_model->Tampil_Absen_Tanggal($tanggalabsen);
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/tampil_rekap_harian',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/rekap_harian',$data);
			$this->load->view('shared/bawah');
		}
	}
	function tampilabsentanggal()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggalabsen = "$tahunhadir-$bulanhadir-$tanggalhadir";
		$this->load->model('Bp_model');
		$data["tanggalabsen"] = "$tahunhadir-$bulanhadir-$tanggalhadir";
		$data["query"]=$this->Bp_model->Tampil_Absen_Tanggal($tanggalabsen);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/tampil_rekap_harian',$data);
		$this->load->view('shared/bawah');
	}
	function daftarabsen()
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='DAFTAR KETIDAKHADIRAN SISWA';
		$this->load->model('Bp_model');
		$this->load->library('Pagination');	
		$page=$this->uri->segment(3);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$query=$this->Bp_model->Tampil_Semua_Absen($thnajaran,$limit_ti,$offset_ti);
		$tot_hal = $this->Bp_model->Total_Semua_Absen($thnajaran);
      		$config['base_url'] = base_url() . 'bp/daftarabsen';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/daftar_ketidakhadiran',$data_isi);
		$this->load->view('shared/bawah');
	}
	function ketidakhadiran($page=null)
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Pencatatan Ketidakhadiran';
		$data["thnajaran"]=$thnajaran;
		$data["semester"]=$semester;
		$data['adaautocomplete'] = '';
		$this->load->model('Bp_model');
		$this->load->library('Pagination');	
      		$limit_ti=9;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$querysiswa=$this->Bp_model->Tampilkan_Semua_Siswa_Aktif($thnajaran,$semester);
		$query=$this->Bp_model->Tampil_Semua_Absen($thnajaran,$limit_ti,$offset_ti);
		$tot_hal = $this->Bp_model->Total_Semua_Absen($thnajaran);
	      	$config['base_url'] = base_url() . 'bp/ketidakhadiran';
	       	$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
	        $data_isi = array('query' => $query,'querysiswa' => $querysiswa,'paginator'=>$paginator, 'page'=>$page);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/ketidakhadiran',$data_isi);
		//$this->load->view('shared/bawah');
	}
	function simpanabsensi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["namaguru"]=$this->session->userdata('nama');
		$namabp = $this->session->userdata('nama');
		$data['judulhalaman'] ='???';
		$in=array();
		$nis=$this->input->post('nis');
		$thnajaran=$this->input->post('thnajaran');
		$semester=$this->input->post('semester');
		$alasan=$this->input->post('alasan');
		$keterangan=$this->input->post('keterangan');
		$tanggalabsen = tanggal_indonesia_ke_barat($this->input->post('tanggaltidakmasuk'));
		$id = $this->input->post('id');
		$this->load->model('Bp_model');
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		if ((!empty($nis)) and (!empty($alasan)) and (!empty($tanggalabsen)))
		{
			$in=array();
			$in["thnajaran"] = $thnajaran;
			$in["semester"] = $semester;
			$in["nis"] = $nis;
			$in["tanggalabsen"] = $tanggalabsen;
			$in["alasan"] = $alasan;
			$in["keterangan"] = $keterangan;
			$in["kode_guru"] = 'bp';
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$param=array();
			$query = $this->Bp_model->Cek_Data_Absensi_Siswa($nis,$tanggalabsen);
	       		$ada = $query->num_rows();
			$this->Bp_model->Simpan_Data_Absensi_Siswa($in,$ada);
			$poin = 0;
			if($ada == 0)
			{
				$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');
				$this->load->helper('telegram');
				if ($alasan=='S')
				{
					$pesan = nis_ke_nama($nis).' '.$kelas.' tidak masuk karena sakit pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namabp;
					if(!empty($chat_id_grup_guru))
					{
						$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
					}
				}
				if ($alasan=='I')
				{
					$pesan = nis_ke_nama($nis).' '.$kelas.' tidak masuk karena izin pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namabp;
					if(!empty($chat_id_grup_guru))
					{
						$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
					}
				}
				if (($alasan=='A') or ($alasan=='T') or ($alasan=='B'))
				{
					if ($alasan=='T')
					{
						$kode = $this->ref->ambil_nilai('kode_terlambat');
						$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
						$pesan = nis_ke_nama($nis).' '.$kelas.' terlambat pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namabp;
					}
					if ($alasan=='A')
					{
						$kode = $this->ref->ambil_nilai('kode_tanpa_keterangan');
						$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
						$pesan = nis_ke_nama($nis).' '.$kelas.' tidak masuk tanpa keterangan pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namabp;
					}
					if ($alasan=='B')
					{
						$kode = $this->ref->ambil_nilai('kode_membolos');
						$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
						$pesan = nis_ke_nama($nis).' '.$kelas.' membolos pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namabp;
					}
					foreach($querypoin->result() as $dpoin)
					{
						$poin = $dpoin->point;
					}
					$param["thnajaran"] = $thnajaran;
					$param["semester"] = $semester;
					$param["nis"] = $nis;
					$param["tanggal"] = $tanggalabsen;
					$param["kd_pelanggaran"] = $kode;
					$param["kodeguru"] = $data["namaguru"];
					$param["point"] = $poin;
					$tkredit= $this->Bp_model->Cek_Kredit($nis,$kode,$tanggalabsen);
					$cacah = $tkredit->num_rows();
					$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
					if ($cacah==0)
					{
						$this->Bp_model->Simpan_Kredit($param);
						//ke wali kelas
						$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
						$kodewalikelas = '';
						foreach($twalikelas->result() as $dwalikelas)
						{
							$kodewalikelas = $dwalikelas->kodeguru;
						}
						$id_sms_user = '';
						$ponselwali ='';
						$chat_id_walikelas = '';
						if(!empty($kodewalikelas))
						{
							$ponselwali = cari_seluler_pegawai($kodewalikelas);
							$chat_id_walikelas = cari_chat_id_pegawai($kodewalikelas);
						}
						if(!empty($chat_id_grup_guru))
						{
							$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
						}
						if(!empty($chat_id_walikelas))
						{
							$kirimpesan = kirimtelegram($chat_id_walikelas,$pesan,$token_bot);
						}
						elseif(!empty($ponselwali))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselwali','$pesan','$id_sms_user')");
						}
						else
						{
						}
						//orang tua
						$tortu = $this->db->query("select `nis`,`tayah`,`tibu`,`twali`,`hp`, `chat_id` from `datsis` where `nis`='$nis'");
						$tayah = '';
						$tibu = '';
						$twali = '';
						foreach($tortu->result() as $dortu)
						{
							$tayah = $dortu->tayah;
							$tibu = $dortu->tibu;
							$twali = $dortu->twali;
							$ponselsiswa = $dortu->hp;
							$chat_id_siswa = $dortu->chat_id;
						}
						$ortu = 0;
						if(!empty($chat_id_siswa))
						{
							$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
							$kirimpesan = kirimtelegram($chat_id_siswa,$pesansiswa,$token_bot);
						}
						elseif(!empty($ponselsiswa))
						{
							if($ponselsiswa == $tayah)
							{
								$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
							}
							else
							{
								$pesansiswa = 'Ananda '.$pesan;
							}
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselsiswa','$pesansiswa','$id_sms_user')");
							$ortu = 1;
						}
						else
						{}
						$pesan = 'Assalamu alaikum, wr.wb. '.$pesan;
						if((!empty($tayah)) and ($ortu==0))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tayah','$pesan','$id_sms_user')");
							$ortu = 1;
						}
						if((!empty($tibu)) and ($ortu==0))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tibu','$pesan','$id_sms_user')");
							$ortu = 1;
						}
						if(!empty($twali))
						{
							$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$twali','$pesan','$id_sms_user')");
						}
					}
				}
			}
			else
			{
				if (empty($id))
				{
					redirect('bp/sudahdicatat/1/'.$nis.'/'.$tanggalabsen);
				}
				else
				{
					redirect('bp/sudahdicatat/2/'.$nis.'/'.$tanggalabsen);
				}

			}
			if (empty($id))
			{
				redirect('bp/ketidakhadiran');
			}
				else
			{
				redirect('bp/ketidakhadiransiswaharian/'.$id);
			}
		}
		else
		{
			redirect('bp/ketidakhadiran3');
		}
	}
	function simpankredit()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$in=array();
		$in["nis"]=$this->input->post('nis');
		$nis =$this->input->post('nis');
		$tanggalhadir =tanggal_indonesia_ke_barat($this->input->post('tanggaltidakmasuk'));
		$in["thnajaran"]=$this->input->post('thnajaran');
		$in["semester"]=$this->input->post('semester');
		$in["kd_pelanggaran"]=$this->input->post('kode');
		$kode = $this->input->post('kode');
		$in["kodeguru"]=$this->input->post('kodeguru');
		$in["tanggal"] = "$tanggalhadir";
		$tanggalabsen = "$tanggalhadir";
		$this->load->model('Bp_model');
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$tpkredit =$this->Bp_model->Cari_Point_Kredit($in["kd_pelanggaran"]);
		$in["point"]=0;
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		foreach($tpkredit->result() as $dpoint)
		{
			$in["point"]=$dpoint->point;
		}
		if ((!empty($in["nis"])) and (!empty($in["kd_pelanggaran"])) and (!empty($in["tanggal"])))
		{
			$tkredit= $this->Bp_model-> Cek_Kredit($in["nis"],$in["kd_pelanggaran"],$in["tanggal"]);
			$cacah = $tkredit->num_rows();
			if ($cacah>0)
			{
				?>
				<script type="text/javascript" language="javascript">
				alert("Pelanggaran ini sudah dicatat!");
				</script>
				<?php
				redirect('bp/kredit');
			}
			else
			{
				$this->Bp_model->Simpan_Kredit($in);
				$tkred = $this->db->query("select * from m_kredit where kode = '$kode'");
				$namapelanggaran ='';
				foreach($tkred->result() as $dkred)
				{
					$namapelanggaran = $dkred->nama_pelanggaran;
				}
				$pesan = nis_ke_nama($nis).' melanggar tata tertib sekolah yakni '.$namapelanggaran.' pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$namabp;
				$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
				$kodewalikelas = '';
				foreach($twalikelas->result() as $dwalikelas)
				{
					$kodewalikelas = $dwalikelas->kodeguru;
				}
				$id_sms_user = '';
				$ponselwali ='';
				$chat_id_walikelas = '';
				if(!empty($kodewalikelas))
				{
					$ponselwali = cari_seluler_pegawai($kodewalikelas);
					$chat_id_walikelas = cari_chat_id_pegawai($kodewalikelas);
				}
				$this->load->helper('telegram');
				$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');
				if(!empty($chat_id_grup_guru))
				{
					$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
				}
				if(!empty($chat_id_walikelas))
				{
					$kirimpesan = kirimtelegram($chat_id_walikelas,$pesan,$token_bot);
				}
				elseif(!empty($ponselwali))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselwali','$pesan','$id_sms_user')");
				}
				else
				{
				}
				//orang tua
				$tortu = $this->db->query("select `nis`,`tayah`,`tibu`,`twali`,`hp`, `chat_id` from `datsis` where `nis`='$nis'");
				$tayah = '';
				$tibu = '';
				$twali = '';
				foreach($tortu->result() as $dortu)
				{
					$tayah = $dortu->tayah;
					$tibu = $dortu->tibu;
					$twali = $dortu->twali;
					$ponselsiswa = $dortu->hp;
					$chat_id_siswa = $dortu->chat_id;
				}
				$ortu = 0;
				if(!empty($chat_id_siswa))
				{
					$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
					$kirimpesan = kirimtelegram($chat_id_siswa,$pesansiswa,$token_bot);
				}
				elseif(!empty($ponselsiswa))
				{
					if($ponselsiswa == $tayah)
					{
						$pesansiswa = 'Assalamu alaikum, wr.wb. Ananda '.$pesan;
					}
					else
					{
						$pesansiswa = 'Ananda '.$pesan;
					}
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselsiswa','$pesansiswa','$id_sms_user')");
					$ortu = 1;
				}
				else
				{}
				$pesan = 'Assalamu alaikum, wr.wb. '.$pesan;
				if((!empty($tayah)) and ($ortu==0))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tayah','$pesan','$id_sms_user')");
					$ortu = 1;
				}
				if((!empty($tibu)) and ($ortu==0))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tibu','$pesan','$id_sms_user')");
					$ortu = 1;
				}
				if(!empty($twali))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$twali','$pesan','$id_sms_user')");
				}

				redirect('bp/kredit');
			}
		}
		redirect('bp/kredit');
	}
	function tampilkreditsiswa($nis=null,$tahun1=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Kredit Pelanggaran Siswa';
		$data['nis']=$nis;
		$data['tahun1'] = $tahun1;
		$tahun2 = '';
		$data['thnajaran'] = '';
		$thnajaran = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1+1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;
			$thnajaran = $tahun1.'/'.$tahun2;
		}
		$data['tahun2'] = $tahun2;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/tampil_kredit_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function rekapkelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Rekapitulasi Ketidakhadiran Siswa Per Kelas';
		$data['kelas']=$this->input->post('kelas');
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$this->load->model('Pengajaran_model');
		$data['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$data['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		if ((empty($data["kelas"])) and (empty($data["thnajaran"])) and (empty($data["semester"])))
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/rekap_kelas',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->model('Nilai_model');
			$data["tkepala"] = $this->Nilai_model->Kepala($data["thnajaran"],$data["semester"]);
			$this->load->view('bp/cetak_rekap_kelas',$data);
		}
	}
	function akhlak()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Modul Nilai Akhlak Siswa tiap Kelas';
		$thnajaran= cari_thnajaran();
		$semester=cari_semester();
		$data_isi['semester'] = $semester;
		$data_isi['thnajaran'] = $thnajaran;
		$data_isi['proses'] = $this->input->post('proses');
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/akhlak',$data_isi);
		$this->load->view('shared/bawah');
	}
	function nilaiakhlak()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Modul Daftar Nilai Kepribadian dan Akhlak Mulia';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_kelas'] = $this->uri->segment(5);
		$datax['acuhkan'] = $this->uri->segment(6);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/nilai_akhlak',$datax);
		$this->load->view('shared/bawah');
	}
	function kirimhadirrapor()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='KIRIM DAFTAR KETIDAKHADIRAN KE RAPOR';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $this->uri->segment(3);
		$datax['semester'] = $this->uri->segment(4);
		$datax['id_kelas'] = $this->uri->segment(5);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/kirim_hadir_rapor',$datax);
		$this->load->view('shared/bawah');
	}
	function ketidakhadiransiswa()
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Pencatatan Ketidakhadiran Siswa';
		$data["thnajaran"]=$thnajaran;
		$data["semester"]=$semester;
		$this->load->model('Bp_model');
		$tanggalabsen = $this->input->post('tanggaltidakmasuk');
		if (!empty($tanggalabsen))
		{
			$tanggalabsen = tanggal_indonesia_ke_barat($this->input->post('tanggaltidakmasuk'));
			redirect('bp/ketidakhadiransiswaharian/'.$tanggalabsen);
		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/ketidakhadiran_siswa');
			$this->load->view('shared/bawah');
		}
	}
	function ketidakhadiransiswaharian($id=null)
	{

		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Pencatatan Ketidakhadiran Siswa Per Tanggal';
		$data["thnajaran"]=$thnajaran;
		$data["semester"]=$semester;
		$this->load->model('Bp_model');
		$tanggalabsen = $id;
		$data["querysiswa"]=$this->Bp_model->Tampilkan_Semua_Siswa_Aktif($thnajaran,$semester);
		$data["query"]=$this->Bp_model->Tampil_Absen_Tanggal($tanggalabsen);
		$data["id"] = $id;
		$datetime = new DateTime($id);
		$datetime->modify('+1 day');
		$besok = $datetime->format('Y-m-d');
		$data["besok"] = $besok;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/ketidakhadiran_siswa_harian',$data);
		//$this->load->view('shared/bawah');
	}
	function unduhketidakhadiran()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Unduh Daftar Ketidakhadiran Siswa tiap Kelas';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
        		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
        		$data_isi['daftarkelas'] = $querykelas ;
		$data_isi['semester'] = $this->input->post('semester');
		$data_isi['thnajaran'] = $this->input->post('thnajaran');
		$data_isi["kelas"] = $this->input->post('kelas');
		$semester = $this->input->post('semester');
		$thnajaran = $this->input->post('thnajaran');
		$kelas = $this->input->post('kelas');
		if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
		{
			$this->load->view('bp/unduh_ketidakhadiran_csv',$data_isi);
		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/unduh_ketidakhadiran',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function unggahketidakhadiran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Unggah Data Ketidakhadiran Siswa';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/unggah_ketidakhadiran');
		$this->load->view('shared/bawah');
	}
	function prosesunggahketidakhadiran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$this->load->model('Bp_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$n=0;
		foreach($csvData as $field):
		$pbk['thnajaran']=$field["thnajaran"];
		$pbk['semester']=$field["semester"];
		$pbk['nis']=$field["nis"];
		$pbk['tanggalabsen']=$field["tanggalabsen"];
		$pbk['alasan']=$field["alasan"];
		$pbk['kode_guru']=$field['kode_guru'];
		$pbk['keterangan']=$field["keterangan"];
		$pbk['lama_terlambat']=$field["lama_terlambat"];
		$tanggalabsen = $field["tanggalabsen"];
		$alasan = $field['alasan'];
		$nis = $field["nis"];
		$ada = $this->Bp_model->Cek_Data_Absensi_Siswa($nis,$tanggalabsen);
		$ada = $ada->num_rows();
		$this->Bp_model->Simpan_Data_Absensi_Siswa($pbk,$ada);
		$poin = 0;
		if (($alasan=='A') or ($alasan=='T') or ($alasan=='B'))
		{
			if ($alasan=='T')
			{
			$kode = $this->ref->ambil_nilai('kode_terlambat');
			$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
			}
			if ($alasan=='A')
			{
			$kode = $this->ref->ambil_nilai('kode_tanpa_keterangan');
			$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
			}
			if ($alasan=='B')
			{
			$kode = $this->ref->ambil_nilai('kode_membolos');
			$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
			}
			foreach($querypoin->result() as $dpoin)
			{
			$poin = $dpoin->point;
			}
			$param["thnajaran"] = $field["thnajaran"];
			$param["semester"] = $field["semester"];
			$param["nis"] = $nis;
			$param["tanggal"] = $tanggalabsen;
			$param["kd_pelanggaran"] = $kode;
			$param["kodeguru"] = $field['kode_guru'];
			$param["point"] = $poin;
			$tkredit= $this->Bp_model-> Cek_Kredit($nis,$kode,$tanggalabsen);
			$cacah = $tkredit->num_rows();
			if ($cacah==0)
			{
			$this->Bp_model->Simpan_Kredit($param);
			$this->Bp_model->Kirim_SMS($thnajaran,$semester,$kelas,$pesan,$nis);
			}
		}
		$n++;
		endforeach;
		redirect('bp/ketidakhadiran');
	}
	function snmptn()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/snmptn');
		$this->load->view('shared/bawah');
	}
	function unduhnilai()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Mengunduh Nilai';
		$tahun1=$this->uri->segment(3);
		$tahun1 = $tahun1 * 1;
		if($tahun1<2000)
		{
			$tahun1 = 2000;
		}
		$tahun2 = $tahun1 + 1;
		$semester=$this->uri->segment(4);
		$semester = $semester * 1;
		if($semester<1)
			{
			$semester = 1;
			}
		if($semester>2)
			{
			$semester = 2;
			}
		$datax['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['semester']=$semester;
		$id_kelas = $this->uri->segment(5);
		$datax['id_kelas']= $id_kelas;
		if ((!empty($tahun1)) and (!empty($semester)) and (!empty($id_kelas)))
		{
			$this->load->library('excel');
			$this->load->view('bp/unduh_nilai_xls',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/unduh_nilai',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function nisn()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Siswa Calon Peserta Ujian Nasional / SNMPTN';
		$datax['thnajaran'] = cari_thnajaran();
		$datax['semester'] = cari_semester();
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/nisn',$datax);
		$this->load->view('shared/bawah');
	}
	function editnisnsnmptn()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='PENYESUAIAN NISN UNTUK SNMPTN';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
	    		$id='';
		}
		else
		{
	    		$id = $this->uri->segment(3);
		}
		$this->load->model('Bp_model');
		$nisn_snmptn=$this->input->post('nisn_snmptn');
		$nise=$this->input->post('nis');
		$diproses = $this->input->post('diproses');
		if ($diproses == 'oke')
		{
			$this->db->query("update datsis set nisn_snmptn = '$nisn_snmptn' where nis='$nise'");
			redirect('bp/nisn');
		}
		else
		{
			$data["query"]=$this->Bp_model->Detil_Siswa($id);
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/edit_nisn_snmptn',$data);
			$this->load->view('shared/bawah');
		}
	}
	function unduhsemuanilai()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Mengunduh Semua Nilai';
		$data['loncat']='';
		$tahun1=$this->uri->segment(3);
		$tahun1 = $tahun1 * 1;
		if($tahun1<1)
		{
			$tahun1 = '';
			$tahun2 = '';
		}
		else
		{
			$tahun2 = $tahun1 + 1;
		}
		$semester=$this->uri->segment(4);
		$semester = $semester * 1;
		if($semester<1)
			{
			$semester = 1;
			}
		if($semester>2)
			{
			$semester = 2;
			}
		$datax['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['semester']=$semester;
		$id_kelas = $this->uri->segment(5);
		$datax['id_kelas']= $id_kelas;
		if ((!empty($tahun1)) and (!empty($semester)) and (!empty($id_kelas)))
		{
			$this->load->library('excel');
			$this->load->view('shared/unduh_semua_nilai_xls',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/unduh_semua_nilai',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function nilaispiritualantarmapel($tahun1=null,$semester=null,$id_kelas=null,$aksi=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Proses Deskripsi Sikap Sipiritual dan Sosial Antarmapel';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_kelas'] = $id_kelas;
		$datax['aksi'] = $aksi;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/deskripsi_sikap_spiritual_sosial_antarmapel',$datax);
		$this->load->view('shared/bawah');
	}
	function kreditharian()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Harian Pelanggaran Siswa';
		$this->load->model('Bp_model');
		$data_isi["tanggalhadir"] =$this->input->post('tanggalhadir');
		$data_isi["bulanhadir"] = $this->input->post('bulanhadir');
		$data_isi["tahunhadir"] = $this->input->post('tahunhadir');
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/kredit_harian',$data_isi);
		$this->load->view('shared/bawah');
	}
	function mutasisiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
		    	$id='';
		}
		else
		{
		    	$id = $this->uri->segment(3);
		}
		$this->load->model('Admin_model');
		$dataisi["query"]=$this->Admin_model->Tampil_Data_Siswa($id);
		$this->load->model('Siswa_model');
		$dataisi['daftar_kelas']=$this->Siswa_model->Tampilkan_Semua_Kelas();
		$dataisi["nis"]=$id;
		$dataisi["thnajaran"] = cari_thnajaran();
		$dataisi["semester"] = cari_semester();
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/bg_menu',$data);
		$this->load->view('bp/mutasi_siswa',$dataisi);
		$this->load->view('shared/bawah');
	}
	function simpanmutasisiswa()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$this->load->model('Tatausaha_model');
		$in=array();
		$kelas=$this->input->post('kelas');
		$nis=$this->input->post('nis');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$no_urut = $this->input->post('no_urut');
		$this->Tatausaha_model->Simpan_Mutasi_Siswa($nis,$thnajaran,$semester,$kelas,$no_urut);
		redirect('bp/siswa');
	}
	function unduhsiswakelas()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Daftar Siswa Per Kelas';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
       		$data_isi['daftarkelas'] = $querykelas ;
		$data_isi['semester'] = $this->input->post('semester');
		$data_isi['thnajaran'] = $this->input->post('thnajaran');
		$data_isi["kelas"] = $this->input->post('kelas');
		$data_isi["kolom"] = $this->input->post('kolom');
		$data_isi['thnajaran'] = $this->input->post('thnajaran');
		$data_isi['tautan_balik'] = 'bp';
		$semester = $this->input->post('semester');
		$thnajaran = $this->input->post('thnajaran');
		$kelas = $this->input->post('kelas');
		$this->load->view('bp/bg_head',$data);
		$this->load->view('tatausaha/unduh_siswa_kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function penanganan($nis=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Modul Penanganan Pelanggaran Siswa';
		if (empty($nis))
		{
			redirect('bp/carisiswa');
		}
		$data['nis'] = $nis;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/penanganan',$data);
		$this->load->view('shared/bawah');
	}
	function ubahpenanganan($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Penanganan Pelanggaran Tata Tertib';
		$data['tekseditor'] = '';
		$id = $id * 1;
		if($id>1)
		{
			$data["id"] = $id;
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/penanganan_ubah',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('bp');
		}
	}
	function simpanpenanganan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$in=array();
		$tindakan_bp=$this->input->post('tindakan_bp');
		$tindakan_kesiswaan=$this->input->post('tindakan_kesiswaan');
		$id=$this->input->post('id');
		$nis=$this->input->post('nis');
		$this->load->model('Guru_model');
		$in=array();
		$in["id"] = $id;
		$in["tindakan_bp"] = $tindakan_bp;
		$in["tindakan_kesiswaan"] = $tindakan_kesiswaan;
		$this->Guru_model->Update_Penanganan($in);
		redirect('bp/penanganan/'.$nis);
	}
	function daftarkredit()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Kredit Pelanggaran';
		$data["kode"]=$this->input->post('kode');
		$data["idpost"]=$this->input->post('idpost');
		$data["point"]=$this->input->post('point');
		$data["jenis"]=$this->input->post('jenis');
		$data["butir"]=$this->input->post('butir');
		$data["keterangan"]=$this->input->post('keterangan');
		$data["nama_pelanggaran"]=$this->input->post('nama_pelanggaran');
		$data["idsegment"]=$this->uri->segment(4);
		$data["aksi"]=$this->uri->segment(3);
		$data["proses"]=$this->input->post('proses');
		$data["thnajaran"]=cari_thnajaran();
		$data["semester"]=cari_semester();
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/daftar_kredit',$data);
		$this->load->view('shared/bawah');
	}
	function penjurusan()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Penjurusan / Mutasi / Kenaikan Kelas';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
        	$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
        	$data_isi['daftarkelas'] = $querykelas ;
		$data_isi['semester'] = $this->input->post('semester');
		$data_isi['thnajaran'] = $this->input->post('thnajaran');
		$data_isi["kelas"] = $this->input->post('kelas');
		$data_isi['thnajaran'] = $this->input->post('thnajaran');
		$thnajaranbaru = $this->input->post('thnajaranbaru');
		$data_isi['penjurusan'] = $this->input->post('penjurusan');
		$data_isi['tautan_balik'] = 'bp';
		$semester = $this->input->post('semester');
		$thnajaran = $this->input->post('thnajaran');
//		$kelas = $this->input->post('kelas');
		$data_isi['cacahsiswa'] = $this->input->post('cacahsiswa');
		$cacahsiswa = $this->input->post('cacahsiswa');
		if($cacahsiswa>0)
		{
		$param = array();
		for($i=1;$i<=$cacahsiswa;$i++)
			{
			$nis = $this->input->post('nis_'.$i);
			$kelas = $this->input->post('kelasmutasi_'.$i);
			$tsiswakelas = $this->Admin_model->Cek_Baru_Siswa_Kelas($thnajaranbaru,$semester,$nis);
			$csiswakelas = $tsiswakelas->num_rows();
			$param['thnajaran']=$thnajaranbaru;
			$param['semester'] = $semester;
			$param['status'] = 'Y';	
			$param['kelas'] = $kelas;
			$param['nis'] = $nis;
			$param['no_urut'] = '99';
			if(!empty($kelas))
			{
			$tsiswakelas = $this->Admin_model->Add_Siswa_Kelas($param,$csiswakelas);
			}
			}
		}
		$this->load->view('bp/bg_head',$data);
		$this->load->view('shared/penjurusan',$data_isi);
		$this->load->view('shared/bawah');
	}
	function prosespenjurusan()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$data_isi["nis"]=$this->uri->segment(3);
        	$data_isi['tahun1'] = $this->uri->segment(4);
		$data_isi['tautan_balik'] = 'bp';
		$data_isi["kelas"] = $this->input->post('kelas');
		$this->load->view('bp/bg_head',$data);
		$this->load->view('shared/penjurusan_proses',$data_isi);
		$this->load->view('shared/bawah');
	}
	function rujukan()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar Sikap Spiritual dan Sosial Antarmapel';
		$aksi = $this->uri->segment(3);
		$tahun1=$this->uri->segment(4);
		$id=$this->uri->segment(5);
		$data_isi['tahun1'] = $tahun1;
		$data_isi['aksi'] = $aksi;
		$data_isi['id'] = $id;
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['item']=nopetik($this->input->post('item'));
		$datax['golongan']=hilangkanpetik($this->input->post('golongan'));
		$diproses=hilangkanpetik($this->input->post('proses'));
		if($diproses == 'baru')
		{
			$this->load->model('Bp_model');
			$this->Bp_model->Tambah_Referensi_Sikap_Spiritual($datax);
		}
		if($diproses == 'ubah')
		{
			$datax['id_sikap_spiritual']=hilangkanpetik($this->input->post('id_sikap_spiritual'));
			$this->load->model('Bp_model');
			$this->Bp_model->Perbarui_Referensi_Sikap_Spiritual($datax);
		}
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/rujukan',$data_isi);
		$this->load->view('shared/bawah');
	}
	function kreditperkelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["loncat"] = '';
		$data['judulhalaman'] ='Kredit Pelanggaran Per Kelas';
		$this->load->model('Bp_model');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['id_kelas'] = $this->uri->segment(3);
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/kredit_kelas',$data);
		$this->load->view('shared/bawah');
	}
	function penerimabsm()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Daftar Penerima BSM / PIP';
        	$data_isi['tahun1'] = $this->uri->segment(3);
		$data_isi["semester"]=$this->uri->segment(4);
		$data_isi['tautan_balik'] = 'bp';
		if((!empty($data_isi['tahun1'])) and (!empty($data_isi['semester'])))
		{
			$this->load->view('shared/bg_atas_saja_cetak_landscape',$data);
			$this->load->view('shared/penerima_bsm_cetak',$data_isi);
			$this->load->view('shared/bawah');

		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('shared/penerima_bsm',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function datapenerimabsm()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Data Penerima BSM / PIP';
		$nise = $this->input->post('nise');
		$pesan = '';
		if(!empty($nise))
		{
			$in["nisn"] = $this->input->post('nisn');
			$in["jenkel"] = $this->input->post('jenkel');
			$in["wn"] = $this->input->post('wn');
			$in["nik"] = $this->input->post('nik');
			$in["nokk"] = $this->input->post('nokk');
			$in["kps"] = $this->input->post('kps');
			$in["pkh"] = $this->input->post('pkh');
			$in["kip"] = $this->input->post('kip');
			$in["kks"] = $this->input->post('kks');
			$in["yatim"] = $this->input->post('yatim');
			$in["jalan"] = $this->input->post('jalan');
			$in["rt"] = $this->input->post('rt');
			$in["rw"] = $this->input->post('rw');
			$in["dusun"] = $this->input->post('dusun');
			$in["desa"] = $this->input->post('desa');
			$in["kec"] = $this->input->post('kec');
			$in["kab"] = $this->input->post('kab');
			$in["prov"] = $this->input->post('prov');
			$in["nmayah"] = $this->input->post('nmayah');
			$in["nmibu"] = $this->input->post('nmibu');
			$in['nis'] = $nise;
			$this->load->model('Siswa_model');
			$this->Siswa_model->Update_Data($in);
			$pesan = '<div class="alert alert-success">Data berhasil diperbarui</div>';

		}
		$data_isi['pesan'] = $pesan;
        	$data_isi['nis'] = $this->uri->segment(3);
		$this->load->model('Admin_model');
		$data_isi["query"]=$this->Admin_model->Tampil_Data_Siswa($this->uri->segment(3));
		$data_isi['tautan_balik'] = 'bp';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('shared/data_penerima_bsm',$data_isi);
		$this->load->view('shared/bawah');
	}
	function sikap()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Mengolah data penilai sikap sosial dan spiritual';
		$tahun1 = substr(cari_thnajaran(),0,4);
		$semester = cari_semester();
		$datax['thnajaran'] = cari_thnajaran();
		$datax['semester']=$semester;
		$id_kelas = $this->uri->segment(3);
		$datax['id_kelas']= $id_kelas;
		$this->load->model('Guru_model');
		$datax['daftar_kelas']= $this->Guru_model->Tampilkan_Semua_Kelas();
		$thnajaran= cari_thnajaran();
		$semester=cari_semester();
		$kelas=$this->input->post('post_kelas');
		$id_kelas=$this->input->post('post_id_kelas');
		$kodeguru=$this->input->post('kodeguru');
		if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($kodeguru)))
		{
			$in['thnajaran']=$this->input->post('post_thnajaran');
			$in['semester']=$this->input->post('post_semester');
			$in['kelas']=$this->input->post('post_kelas');
			$in['kodeguru']=$this->input->post('kodeguru');
			$ada = $this->Guru_model->Cari_Penilai_Sikap($in);			
			if($ada == 0)
			{
				$this->Guru_model->Tambah_Penilai_Sikap($in);
			}
			redirect('bp/sikap/'.$id_kelas);
		}
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/penilai_sikap',$datax);
		$this->load->view('shared/bawah');
	}
	function hapuspenilaisikap()
	{
		$id_kelas=$this->uri->segment(3);
		$id_m_akhlak=$this->uri->segment(4);
		$this->load->model('Guru_model');
		$this->Guru_model->Hapus_Penilai_Sikap($id_m_akhlak);			
		redirect('bp/sikap/'.$id_kelas);
	}
	function unggahrekapketidakhadiran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Unggah Rekap Data Ketidakhadiran Siswa';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/unggah_rekap_ketidakhadiran');
		$this->load->view('shared/bawah');
	}
	function prosesunggahrekapketidakhadiran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='???';
		$this->load->model('Bp_model');
		$this->load->library('csvreader');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvreader->parse_file($filePath, true);	
		$pbk["thnajaran"] = cari_thnajaran();
		$pbk["semester"] = cari_semester();
		foreach($csvData as $field):
			$pbk['nis']=$field["nis"];
			$pbk['sakit']=$field["s"];
			$pbk['izin']=$field['i'];
			$pbk['tanpa_keterangan']=$field["a"];
			$this->Bp_model->Tambah_Rekap_Absensi_Siswa($pbk);
		endforeach;
		redirect('bp/ketidakhadiran');
	}
	function konseling($nis=null,$aksi=null,$id_bk_individune = null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Konseling Individu';
		$data['nis'] = $nis;
		$data['aksi'] = $aksi;
		$data['id_bk_individu'] = $id_bk_individune;
		if($aksi == 'simpan')
		{
			$id_bk_individu = nopetik($this->input->post('id_bk_individu'));
			$in["tanggal"] = tanggal_indonesia_ke_barat($this->input->post('tanggal'));
			$in['masalah'] = $this->input->post('masalah');
			$in['diagnosis'] = $this->input->post('diagnosis');
			$in['pronosis'] = $this->input->post('pronosis');
			$in['tujuan'] = $this->input->post('tujuan');
			$in['pendekatan'] = $this->input->post('pendekatan');
			$in['tahap_awal'] = $this->input->post('tahap_awal');
			$in['pertengahan'] = $this->input->post('pertengahan');
			$in['akhir'] = $this->input->post('akhir');
			$in['hasil'] = $this->input->post('hasil');
			$in['tindak_lanjut'] = $this->input->post('tindak_lanjut');
			$in['username'] = $this->session->userdata('username');
			$in['nis'] = $nis;
			$in = nopetik($in);
			$this->load->model('Bp_model','bp');
			if(empty($id_bk_individu))
			{
				$this->bp->Simpan_Konseling_Individu($in);
			}
			else
			{
				$in['id_bk_individu'] = $id_bk_individu;
				$this->bp->Perbarui_Konseling_Individu($in);
			}
			redirect('bp/konseling/'.$nis);
		}
		if($aksi == 'hapus')
		{
			$in['id_bk_individu'] = $id_bk_individune;
			$in['username'] = $this->session->userdata('username');
			$in['nis'] = $nis;
			$in = nopetik($in);
			$this->load->model('Bp_model','bp');
			$this->bp->Hapus_Konseling_Individu($in);
			redirect('bp/konseling/'.$nis);
		}
		if($aksi == 'cetak')
		{
			$this->load->view('shared/bg_bs_cetak',$data);
			$this->load->view('bp/konseling_individu_laporan');
//			$this->load->view('shared/bawah');

		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/konseling_individu');
			$this->load->view('shared/bawah');
		}
	}
	function siswaizin()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Daftar siswa mengajukan izin';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/siswa_izin');
		$this->load->view('shared/bawah');
	}
	function aproved($token)
	{
		$this->db->query("update `siswa_proses_izin` set `valid`='1' where `token`='$token'");
		redirect('bp/siswaizin');
	}
	function pending($token)
	{
		$this->db->query("update `siswa_proses_izin` set `valid`='0' where `token`='$token'");
		redirect('bp/siswaizin');
	}
	function sudahdicatat($asal=null,$nis=null,$tanggal=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Ketidakhadiran sudah dicatat';
		$data['nis'] =$nis;
		$data['tanggal'] = $tanggal;
		$data['asal'] = $asal;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/sudahdicatat');
		$this->load->view('shared/bawah');
    	}
	function rekapketidakhadiransiswa($nis=null,$tahun1=null,$semester=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Rekapitulasi Ketidakhadiran Siswa';
		$data['nis'] =$nis;
		$data['tahun1'] = $tahun1;
		$tahun2 = '';
		$data['thnajaran'] = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1+1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;
		}
		$data['semester'] = $semester;
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		$data['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();

		if(empty($nis))
		{
			redirect('bp/carisiswa');
		}
		if((!empty($nis)) and (!empty($tahun1)) and (!empty($semester)))
		{
			$this->load->view('bp/rekapitulasi_ketidakhadiran_siswa_cetak',$data);
		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/rekapitulasi_ketidakhadiran_siswa');
			$this->load->view('shared/bawah');
		}
    	}
	function rekapbulanan($tahun1=null,$semester=null,$id_wali=null,$bulan=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Rekapitulasi Ketidakhadiran Siswa per Bulan';
		$data['id_wali'] =$id_wali;
		$data['tahun1'] = $tahun1;
		$tahun2 = '';
		$data['thnajaran'] = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1+1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;
		}
		$data['tahun2'] = $tahun2;
		$data['semester'] = $semester;
		$data['loncat'] = '';
		$data['bulan'] = $bulan;
		$this->load->model('Pengajaran_model');
		$data['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		if((!empty($id_wali)) and (!empty($tahun1)) and (!empty($semester)) and (!empty($bulan)))
		{
			$this->load->view('bp/rekapitulasi_ketidakhadiran_siswa_per_bulan_cetak',$data);
		}
		else
		{
			$this->load->view('bp/bg_head',$data);
			$this->load->view('bp/rekapitulasi_ketidakhadiran_siswa_per_bulan');
			$this->load->view('shared/bawah');
		}
    	}
	function absensi($nis=null,$aksi=null,$id_siswa_absensi=null)
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] ='Penghapusan atau Perubahan Ketidakhadiran';
		$data['nis'] =$nis;
		$data['aksi'] = $aksi;
		$data['id_siswa_absensi'] = $id_siswa_absensi;
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data['thnajaran'] = $thnajaran;
		$data['semester'] = $semester;
		if($aksi == 'simpan')
		{
			$alasanawal = hilangkanpetik($this->input->post('alasanawal'));
			$alasan = hilangkanpetik($this->input->post('alasan'));
			$tanggal = hilangkanpetik($this->input->post('tanggal'));
			if($alasan == 'S')
			{
				$alasane = 'sakit';
			}
			elseif($alasan == 'I')
			{
				$alasane = 'izin';
			}

			else
			{
				$alasane = 'tanpa keterangan';
			}
			if($alasanawal == 'A')
			{
				$pesan = 'Ralat. '.nis_ke_nama($nis).' tanggal '.tanggal($tanggal).' tidak masuk karena '.$alasane;
				$kode = $this->ref->ambil_nilai('kode_tanpa_keterangan');
				$this->db->query("delete from `siswa_kredit` where `tanggal`='$tanggal' and `nis`='$nis' and `kd_pelanggaran`='$kode'");
				//orang tua
				$tortu = $this->db->query("select `nis`,`tayah`,`tibu`,`twali`,`hp`, `chat_id` from `datsis` where `nis`='$nis'");
				$tayah = '';
				$tibu = '';
				$twali = '';
				foreach($tortu->result() as $dortu)
				{
					$tayah = $dortu->tayah;
					$tibu = $dortu->tibu;
					$twali = $dortu->twali;
					$ponselsiswa = $dortu->hp;
					$chat_id_siswa = $dortu->chat_id;
				}
				$ortu = 0;
				$this->load->helper('telegram');
				$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
				$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
				$kodewalikelas = '';
				foreach($twalikelas->result() as $dwalikelas)
				{
					$kodewalikelas = $dwalikelas->kodeguru;
				}
				$chat_id_walikelas = '';
				if(!empty($kodewalikelas))
				{
					$ponselwali = cari_seluler_pegawai($kodewalikelas);
					$chat_id_walikelas = cari_chat_id_pegawai($kodewalikelas);
				}
				$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');
				if(!empty($chat_id_grup_guru))
				{
					$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
				}
				if(!empty($chat_id_walikelas))
				{
					$kirimpesan = kirimtelegram($chat_id_walikelas,$pesan,$token_bot);
				}
				elseif(!empty($ponselwali))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselwali','$pesan','$id_sms_user')");
				}
				else
				{
				}
				$pesan = 'Ralat. Ananda '.nis_ke_nama($nis).' tidak masuk tanggal '.tanggal($tanggal).' karena '.$alasane;
				if(!empty($chat_id_siswa))
				{
					$pesansiswa = 'Assalamu alaikum, wr.wb. '.$pesan;
					$kirimpesan = kirimtelegram($chat_id_siswa,$pesansiswa,$token_bot);
				}
				elseif(!empty($ponselsiswa))
				{
					if($ponselsiswa == $tayah)
					{
						$pesansiswa = 'Assalamu alaikum, wr.wb. '.$pesan;
					}
					else
					{
						$pesansiswa = $pesan;
					}
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$ponselsiswa','$pesansiswa')");
					$ortu = 1;
				}
				else
				{}
				$pesan = 'Assalamu alaikum, wr.wb. '.$pesan;
				if((!empty($tayah)) and ($ortu==0))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$tayah','$pesan')");
					$ortu = 1;
				}
				if((!empty($tibu)) and ($ortu==0))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$tibu','$pesan')");
					$ortu = 1;
				}
				if(!empty($twali))
				{
					$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`) values ('$twali','$pesan')");
				}
				$this->db->query("update `siswa_absensi` set `alasan`='$alasan' where `tanggal`='$tanggal' and `nis`='$nis'");
			}
			redirect('bp/absensi/'.$nis);
		}
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/perubahan_absensi');
		$this->load->view('shared/bawah');
    	}
	function mapel($tahun1=null,$semester=null,$id_kelas=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Daftar Mata Pelajaran Untuk PDSS';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_kelas'] = $id_kelas;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/mapel',$datax);
		$this->load->view('shared/bawah');
	}
	function simpanmapel($tahun1=null,$semester=null,$id_kelas=null)
	{
		$cacah = $this->input->post('cacah');
		if($cacah>0)
		{
			for($i=1;$i<=$cacah;$i++)
			{
				$urut_smptn = $this->input->post('urut_smptn_'.$i);
				$id_mapel_rapor = $this->input->post('id_mapel_rapor_'.$i);
				$this->db->query("update `m_mapel_rapor` set `urut_smptn` = '$urut_smptn' where `id_mapel_rapor` = '$id_mapel_rapor'");
			}
			redirect('bp/mapeltampil/'.$tahun1.'/'.$semester.'/'.$id_kelas);
		}
		redirect('bp');
	}
	function mapeltampil($tahun1=null,$semester=null,$id_kelas=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Daftar Mata Pelajaran Untuk PDSS';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_kelas'] = $id_kelas;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/mapel_tampil',$datax);
		$this->load->view('shared/bawah');
	}
	function kkmmapel($tahun1=null,$semester=null,$id_kelas=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] ='Daftar KKM Mata Pelajaran Untuk PDSS';
		$this->load->model('Guru_model');
		$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$datax['id_kelas'] = $id_kelas;
		$this->load->view('bp/bg_head',$data);
		$this->load->view('bp/mapel_tampil',$datax);
		$this->load->view('shared/bawah');
	}
	function peringkatparalel($tahun1=null,$semester=null,$tingkat=null,$id_jurusan=null)
	{
		$data = array();
		$data["nim"]=$tanda = $this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Peringkat Paralel Siswa';
		$data['loncat'] = '';
		$thnajaran = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1 + 1;
			$thnajaran = $tahun1.'/'.$tahun2;
		}
		$this->load->model('Pengajaran_model');
		$datax['tingkat']= $tingkat;
		$datax['tautan'] = 'bp';
		$datax['tahun1']= $tahun1;
		$datax['thnajaran']=$thnajaran;
		$datax['id_jurusan']=$id_jurusan;
		$datax['semester']=$semester;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		if (empty($id_jurusan))
		{
			$this->load->view('pengajaran/bg_head',$data);
			$this->load->view('pengajaran/peringkat_paralel_siswa',$datax);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('pengajaran/rekap_peringkat_paralel_siswa',$datax);
		}
	}
}//akhir fungsi
?>
