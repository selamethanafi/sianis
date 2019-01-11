<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tukardata extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}
	function index()
	{
	}
	function ambil()
	{
		$ttd = md5($this->config->item('awalttd'));
		$yangdiambil = $this->uri->segment(3);
		$token = $this->uri->segment(4);
		if($token == $ttd)
		{
			if($yangdiambil == 'smsaim')
			{
				$data['item'] = '1';
				$data['sms_user'] = '1';
				$this->load->view('tukardata/sms',$data);
			}
			else
			{
				$data['item'] = '';
				$data['sms_user'] = '';
				$this->load->view('tukardata/sms',$data);
			}
		}
	}
	function terima()
	{
		$ttd = md5($this->config->item('awalttd'));
		$yangdiambil = $this->uri->segment(3);
		$token = $this->uri->segment(4);
		if($token == $ttd)
		{
			if($yangdiambil == 'sms')
			{
				$id = $this->input->post('id');
				$this->db->query("DELETE FROM outbox WHERE id = '$id'");
			}
		}
	}
	function harian($token=null)
	{
		$this->load->helper('fungsi');
		$this->load->helper('telegram');
		$ttd = md5($this->config->item('awalttd'));
		$token = $this->uri->segment(3);
		if($token == $ttd)
		{
			$this->load->model('Referensi_model','ref');
			$data['token_bot'] = $this->ref->ambil_nilai('token_bot');
			$this->load->view('tukardata/harian',$data);
		}
	}
	function piket()
	{
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$ttd = md5($this->config->item('awalttd'));
		$token = $this->uri->segment(3);
		$data['id_walikelas'] = $this->uri->segment(4);
		$this->load->helper('fungsi');
		$this->load->helper('telegram');
		$chat_id_grup_guru = $this->ref->ambil_nilai('chat_id_grup_guru');
		$info = '';
		if($token == $ttd)
		{
			$cacahsiswa = $this->input->post('cacahsiswa');
			$cacahsiswatidakmasuk = $this->input->post('cacahsiswatidakmasuk');
			$kelas = $this->input->post('kelas');
			$kodeguru = $this->input->post('kodeguru');
			$this->load->model('Bp_model');
			$cacahsiswaterkirim = 0;
			if($cacahsiswa>0)
			{
				for($i=1;$i<=$cacahsiswa;$i++)
				{
					$nis = $this->input->post('nis_'.$i);
					$nama_siswa = nis_ke_nama($nis);
					$alasan=$this->input->post('alasan_'.$i);
					$tanggalabsen = tanggal_hari_ini();
					$this->load->model('Guru_model');
					$thnajaran = cari_thnajaran();
					$semester = cari_semester();
					if (!empty($alasan))
					{
						$cacahsiswaterkirim++;
						$info .= $nama_siswa.' ('.$alasan.') ';
						$in=array();
						$in["thnajaran"] = $thnajaran;
						$in["semester"] = $semester;
						$in["nis"] = $nis;
						$in["tanggalabsen"] = $tanggalabsen;
						$in["alasan"] = $alasan;
						$in["keterangan"] = '';
						$in["kode_guru"] = $kodeguru;
						$param=array();
						$query = $this->Bp_model->Cek_Data_Absensi_Siswa($nis,$tanggalabsen);
						$ada = $query->num_rows();
						$this->Bp_model->Simpan_Data_Absensi_Siswa($in,$ada);
						$poin = 0;
						if($ada == 0)
						{
							if (($alasan=='A') or ($alasan=='T') or ($alasan=='B'))
							{
								if ($alasan=='T')
								{
									$kode = $this->ref->ambil_nilai('kode_terlambat');
									$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
									$pesan = $nama_siswa.' '.$kelas.' terlambat pada tanggal '.date_to_long_string($tanggalabsen);
								}
								if ($alasan=='A')
								{
									$kode = $this->ref->ambil_nilai('kode_tanpa_keterangan');
									$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
									$pesan = $nama_siswa.' '.$kelas.' tidak masuk tanpa keterangan pada tanggal '.date_to_long_string($tanggalabsen);
								}
								if ($alasan=='B')
								{
									$kode = $this->ref->ambil_nilai('kode_membolos');
									$querypoin = $this->Bp_model->Cari_Point_Kredit($kode);
									$pesan = $nama_siswa.' '.$kelas.' membolos pada tanggal '.date_to_long_string($tanggalabsen);
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
								$param["kodeguru"] = $kodeguru;
								$param["point"] = $poin;
								$tkredit= $this->Bp_model->Cek_Kredit($nis,$kode,$tanggalabsen);
								$cacah = $tkredit->num_rows();
								$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
								$pesan .= ' ttd '.$kodeguru;
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
								} // kalau belum dikredit
							} //A T B
							if ($alasan=='S')
							{
								$pesan = nis_ke_nama($nis).' '.$kelas.' tidak masuk karena sakit pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$kodeguru;
								if(!empty($chat_id_grup_guru))
								{
									$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);
								}
							}
							if ($alasan=='I')
							{
								$pesan = nis_ke_nama($nis).' '.$kelas.' izin tidak masuk pada tanggal '.date_to_long_string($tanggalabsen).' ttd '.$kodeguru;
								if(!empty($chat_id_grup_guru))
								{
									$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);	
								}
							}
						} // kalau belum di data
					} // kalau ada alasan
				} // loop
			} // cacah siswa
			if(($cacahsiswatidakmasuk == 0) and ($cacahsiswaterkirim == 0))
			{
				//nihil
				$pesan = 'Kelas '.$kelas.' NIHIL ttd '.$kodeguru;
				if((!empty($chat_id_grup_guru)) and (!empty($kelas)))
				{
					$kirimpesan = kirimtelegram($chat_id_grup_guru,$pesan,$token_bot);	
				}
			}
			$data['thnajaran'] = cari_thnajaran();
			$data['semester'] = cari_semester();
			$data['tanggalhariini'] = tanggal_hari_ini();
			$data['token'] = $token;
			$data['info'] = $info;
			if(!empty($kodeguru))
			{
				$ta = $this->db->query("select `kd` from `p_pegawai` where `kd`= '$kodeguru'");
				foreach($ta->result() as $a)
				{
					$username = $a->kd;
					$d=strtotime("+7 days");
					$next_login = date("Y-m-d h:i:sa", $d);
					$this->db->query("update `tbllogin` set `next_login` = '$next_login' where `username`='$username'");
				}
			}
			$this->load->view('tukardata/piket',$data);
		}
	}
	function datasiswa()
	{
		$this->load->helper('fungsi');
		$ttd = md5($this->config->item('awalttd'));
		$token = $this->uri->segment(3);
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		if($token == $ttd)
		{
			$this->load->view('tukardata/datasiswa',$data);
		}
	}
	function postdata()
	{
		$token = $this->uri->segment(3);
		$ttd = md5($this->config->item('awalttd'));
		if($token == $ttd)
		{
			$nis = $this->input->post('nis');
			$this->db->query("update `datsis` set `updated`='0' WHERE nis = '$nis'");
		}
	}
	function nonaktifkanguru()
	{
		$ttd = md5($this->config->item('awalttd'));
		$token = $this->uri->segment(3);
		$tanggal = date("Y-m-d");
		if($token == $ttd)
		{
			$this->db->query("update `tbllogin` set `aktif` = 'N' WHERE `next_login` like '$tanggal%'");
		}
	}
	function infogurutidakaktif()
	{
		$ttd = md5($this->config->item('awalttd'));
		$token = $this->uri->segment(3);
		$data['tanggal'] = date("Y-m-d");
		$this->load->helper('telegram');
		if($token == $ttd)
		{
			$this->load->view('tukardata/info_guru_tidak_aktif',$data);
		}
	}
	function sieka($token=null,$jam_paksa=null)
	{
		$this->load->helper('fungsi');
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$ttd = md5($this->config->item('awalttd'));
		if($token == $ttd)
		{
			$data['jam_paksa'] = $jam_paksa;
			$this->load->view('tukardata/sieka',$data);
		}
	}
}
?>
