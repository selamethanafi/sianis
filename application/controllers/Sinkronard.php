<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 18 Agu 2018 07:33:55 WIB 
// Nama Berkas 		: Sieka.php
// Lokasi      		: application/controllers/
// Author      		: Selamet Hanafi
//	                  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
class Sinkronard extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$this->load->model('Ard_model', 'ard');	
		$this->load->model('Referensi_model','ref');	
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="admin")
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
		$data = array();
		$data["nim"]='';
		$data['judulhalaman'] = 'Menu Sinkron';
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/sinkron_index',$data);
		$this->load->view('shared/bawah');

	}
	function formnilai($category_level_id=null, $category_majors_id=null,$category_subjects_id=null,$id_mapel=null)
	{
		$data = array();
		$data["nim"]='';
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Unggah Nilai';
		$data['category_level_id'] = $category_level_id;
		$data['category_majors_id'] = $category_majors_id;
		$data['category_subjects_id'] = $category_subjects_id;
		$data['id_mapel'] = $id_mapel;
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$this->load->model('Guru_model', 'guru');
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_unggah_nilai',$data);
		$this->load->view('shared/bawah');
	}
	function buatdaftarnilai($nomor=null)
	{
		$data["nim"]='';
		$data['judulhalaman'] = 'Buat Daftar Nilai';
		$data['adamenu'] = '';
		$data['nomor'] = $nomor;
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->model('Guru_model', 'guru');	
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/buat_nilai',$data);

	}
	function pembagiantugas($nomor=null)
	{
		$data["nim"]='';
		$data['judulhalaman'] = 'Pembagian Tugas';
		$data['adamenu'] = '';
		$data['nomor'] = $nomor;
		$data['semester'] = cari_semester();
		$data['thnajaran'] = cari_thnajaran();
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->model('Guru_model', 'guru');	
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/pembagian_tugas',$data);

	}
	function kirimnilai($id_mapel=null)
	{
		$data = array();
		$data["nim"]='';
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Kirim Nilai';
		$data['id_mapel'] = $id_mapel;
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_kirim_nilai',$data);
		$this->load->view('shared/bawah');
	}
	function entity__category_subjects()
	{
		$data['judulhalaman'] = 'Sinkron Tabel entity__category_subjetcs';
		$data["nim"]='';
		$this->db->query("truncate `entity__category_subjects`");
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/entity__category_subjects',$data);
		$this->load->view('shared/bawah');
	}
	function form_input_nilai_harian($nomor=null,$id_mapel=null)
	{
		if(!is_numeric($nomor))
		{
			$nomor = 0;
		}
		$data["nim"]='';

		$this->db->query("update `m_mapel` set `ard`='1' where `id_mapel`='$id_mapel'");
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['nomor'] = $nomor;
		$data['judulhalaman'] = 'Form Input Nilai Harian';
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_input_nilai_harian',$data);
		$this->load->view('shared/bawah');
	}
	function unduh_kode_nilai($nomor=null,$id_mapel=null)
	{
		$data["nim"]='';
		if(!is_numeric($nomor))
		{
			$nomor = 0;
		}
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['nomor'] = $nomor;
		$data['judulhalaman'] = 'Unduh Kode Nilai Harian';
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_unduh_kode_nilai',$data);
		$this->load->view('shared/bawah');
	}
	function ambil_kode_mapel($id_mapel=null)
	{
		$data["nim"]='';
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['id_mapel'] = $id_mapel;
		$data['judulhalaman'] = 'Unduh Kode Mapel';
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_unduh_kode_mapel',$data);
		$this->load->view('shared/bawah');
	}
	function prosesunggahnilai($id_mapel=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Proses Unggah Nilai';
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$config['file_name'] = 'nilai_siswa.csv';
		$this->load->library('upload', $config);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$mapel=nopetik($this->input->post('mapel'));
		$subjects_value=nopetik($this->input->post('subjects_value_id'));
		$this->db->query("update `m_mapel` set `subjects_value`='$subjects_value' where `id_mapel`='$id_mapel'");
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	echo $this->upload->display_errors();
			}
			else 
			{
				$filePath = 'uploads/nilai_siswa.csv';
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if(isset($field['nis']))
					{
						$nis = nopetik($field['nis']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nis';
						$nis = '';
					}
					$username = $field["nis"];			
					if(isset($field['pengetahuan']))
					{
						$kog = nopetik($field['pengetahuan']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' pengetahuan';
						$kog = '';
					}
					if(isset($field['keterampilan']))
					{
						$psi = nopetik($field['keterampilan']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterampilan';
						$psi = '';
					}
					if(isset($field['deskripsi_pengetahuan']))
					{
						$keterangan = nopetik($field['deskripsi_pengetahuan']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' deskripsi_pengetahuan';
						$keterangan = '';
					}
					if(isset($field['deskripsi_keterampilan']))
					{
						$deskripsi = nopetik($field['deskripsi_keterampilan']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' deskripsi_keterampilan';
						$deskripsi = '';
					}
					if(isset($field['ph1']))
					{
						$nilai_uh1 = nopetik($field['ph1']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph1';
						$nilai_uh1 = '';
					}
					if(isset($field['ph2']))
					{
						$nilai_uh2 = nopetik($field['ph2']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph2';
						$nilai_uh2 = '';
					}
					if(isset($field['ph3']))
					{
						$nilai_uh3 = nopetik($field['ph3']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph3';
						$nilai_uh3 = '';
					}
					if(isset($field['ph4']))
					{
						$nilai_uh4 = nopetik($field['ph4']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph4';
						$nilai_uh4 = '';
					}
					if(isset($field['ph5']))
					{
						$nilai_uh5 = nopetik($field['ph5']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph5';
						$nilai_uh5 = '';
					}
					if(isset($field['ph6']))
					{
						$nilai_uh6 = nopetik($field['ph6']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph6';
						$nilai_uh6 = '';
					}
					if(isset($field['ph7']))
					{
						$nilai_uh7 = nopetik($field['ph7']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph7';
						$nilai_uh7 = '';
					}
					if(isset($field['ph8']))
					{
						$nilai_uh8 = nopetik($field['ph8']);
					}
					else
					{
						$adagalat = 8;
						$pesan .= ' ph8';
						$nilai_uh8 = '';
					}
					if(isset($field['ph9']))
					{
						$nilai_uh9 = nopetik($field['ph9']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph9';
						$nilai_uh9 = '';
					}
					if(isset($field['ph10']))
					{
						$nilai_uh10 = nopetik($field['ph10']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ph10';
						$nilai_uh10 = '';
					}
					if(isset($field['pas']))
					{
						$nilai_uas = nopetik($field['pas']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' pas';
						$nilai_uas = '';
					}
					if ($adagalat==0)
					{
						$this->db->query("update `nilai` set `kog`='$kog', `psi`='$psi', `deskripsi`='$deskripsi', `keterangan`='$keterangan', `nilai_uh1` = '$nilai_uh1', `nilai_uh2` = '$nilai_uh2', `nilai_uh3` = '$nilai_uh3', `nilai_uh4` = '$nilai_uh4', `nilai_uh5` = '$nilai_uh5', `nilai_uh6` = '$nilai_uh6', `nilai_uh7` = '$nilai_uh7', `nilai_uh8` = '$nilai_uh8', `nilai_uh9` = '$nilai_uh9', `nilai_uh10` = '$nilai_uh10', `nilai_uas`='$nilai_uas' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink($filePath);
				$datay['modul'] = 'Impor Status Siswa';
				$datay['tautan_balik'] = ''.base_url().'sinkronard/formnilai';
				$datay['pesan'] = $pesan;
				if($adagalat>0)
				{
					$this->load->view('admin/bg_head',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					redirect('sinkronard/formnilai');
				}
			} //akhir kalau tidak error upload
		} // akhir kalau ada file terkirim
		else
		{
			redirect('admin');
		}
	}//kalau tatausaha
	function formwalikelas($id_walikelas=null)
	{
		$data = array();
		$data["nim"]='';
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Unggah Catatan Walikelas';
		$data['id_walikelas'] = $id_walikelas;
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_unggah_catatan_walikelas',$data);
		$this->load->view('shared/bawah');
	}
	function prosesunggahwalikelas($id_mapel=null)
	{
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$config['file_name'] = 'catatan_walikelas.csv';
		$this->load->library('upload', $config);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	echo $this->upload->display_errors();
			}
			else 
			{
				$filePath = 'uploads/catatan_walikelas.csv';
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if(isset($field['nis']))
					{
						$nis = nopetik($field['nis']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nis';
						$nis = '';
					}
					$username = $field["nis"];			
					if(isset($field['sakit']))
					{
						$sakit = nopetik($field['sakit']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' sakit';
						$sakit = '';
					}
					if(isset($field['izin']))
					{
						$izin = nopetik($field['izin']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' izin';
						$izin = '';
					}
					if(isset($field['alpa']))
					{
						$alpa = nopetik($field['alpa']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' alpa';
						$alpa = '';
					}
					if(isset($field['e1']))
					{
						$e1 = nopetik($field['e1']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ekstra 1';
						$e1 = '';
					}
					if(isset($field['n1']))
					{
						$n1 = nopetik($field['n1']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nilai ekstra 1';
						$n1 = '';
					}
					if(isset($field['k1']))
					{
						$k1 = nopetik($field['k1']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterangan ekstra 1';
						$k1 = '';
					}
					if(isset($field['k1']))
					{
						$k1 = nopetik($field['k1']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterangan ekstra 1';
						$k1 = '';
					}
					if(isset($field['e2']))
					{
						$e2 = nopetik($field['e2']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ekstra 2';
						$e2 = '';
					}
					if(isset($field['n2']))
					{
						$n2 = nopetik($field['n2']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nilai ekstra 2';
						$n2 = '';
					}
					if(isset($field['k2']))
					{
						$k2 = nopetik($field['k2']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterangan ekstra 2';
						$k2 = '';
					}
					if(isset($field['k2']))
					{
						$k2 = nopetik($field['k2']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterangan ekstra 2';
						$k2 = '';
					}
					if(isset($field['e3']))
					{
						$e3 = nopetik($field['e3']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' ekstra 3';
						$e3 = '';
					}
					if(isset($field['n3']))
					{
						$n3 = nopetik($field['n3']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nilai ekstra 3';
						$n3 = '';
					}
					if(isset($field['k3']))
					{
						$k3 = nopetik($field['k3']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterangan ekstra 3';
						$k3 = '';
					}
					if(isset($field['k3']))
					{
						$k3 = nopetik($field['k3']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' keterangan ekstra 3';
						$k3 = '';
					}
					if(isset($field['predikat_sikap_spiritual']))
					{
						$predikat_sikap_spiritual = nopetik($field['predikat_sikap_spiritual']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' predikat_sikap_spiritual';
						$predikat_sikap_spiritual = '';
					}
					if(isset($field['predikat_sikap_sosial']))
					{
						$predikat_sikap_sosial = nopetik($field['predikat_sikap_sosial']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' predikat_sikap_sosial';
						$predikat_sikap_sosial = '';
					}
					if(isset($field['deskripsi_sikap_spiritual']))
					{
						$deskripsi_sikap_spiritual = nopetik($field['deskripsi_sikap_spiritual']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' deskripsi_sikap_spiritual';
						$deskripsi_sikap_spiritual = '';
					}
					if(isset($field['deskripsi_sikap_sosial']))
					{
						$deskripsi_sikap_sosial = nopetik($field['deskripsi_sikap_sosial']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' deskripsi_sikap_sosial';
						$deskripsi_sikap_sosial = '';
					}
					if(isset($field['catatan_walikelas']))
					{
						$catatan_walikelas = nopetik($field['catatan_walikelas']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' catatan_walikelas';
						$catatan_walikelas = '';
					}
					if ($adagalat==0)
					{
						$this->db->query("update `kepribadian` set `sakit`='$sakit', `izin`='$izin', `tanpa_keterangan`='$alpa', `satu`='$predikat_sikap_spiritual', `kom1`='$deskripsi_sikap_spiritual', `dua`='$predikat_sikap_sosial', `kom2`='$deskripsi_sikap_sosial', `wali`='$catatan_walikelas' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
						if(!empty($e1))
						{
							$te = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `nama_ekstra`='$e1'");
							if($te->num_rows() == 0)
							{
								$this->db->query("insert into `ekstrakurikuler` (`thnajaran`, `semester`, `nama_ekstra`, `nis`, `nilai`, `keterangan`) values ('$thnajaran', '$semester', '$e1', '$nis', '$n1', '$k1')");
							}
							else
							{
								$this->db->query("update `ekstrakurikuler` set `nilai`='$n1', `keterangan`='$k1'  where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `nama_ekstra`='$e1'");
							}
						}
						if(!empty($e2))
						{
							$te = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `nama_ekstra`='$e2'");
							if($te->num_rows() == 0)
							{
								$this->db->query("insert into `ekstrakurikuler` (`thnajaran`, `semester`, `nama_ekstra`, `nis`, `nilai`, `keterangan`) values ('$thnajaran', '$semester', '$e2', '$nis', '$n2', '$k2')");
							}
							else
							{
								$this->db->query("update `ekstrakurikuler` set `nilai`='$n2', `keterangan`='$k2'  where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `nama_ekstra`='$e2'");
							}
						}
						if(!empty($e3))
						{
							$te = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `nama_ekstra`='$e3'");
							if($te->num_rows() == 0)
							{
								$this->db->query("insert into `ekstrakurikuler` (`thnajaran`, `semester`, `nama_ekstra`, `nis`, `nilai`, `keterangan`) values ('$thnajaran', '$semester', '$e3', '$nis', '$n3', '$k3')");
							}
							else
							{
								$this->db->query("update `ekstrakurikuler` set `nilai`='$n3', `keterangan`='$k3'  where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `nama_ekstra`='$e3'");
							}


						}
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink($filePath);
				$data['judulhalaman'] = 'Unggah Catatan Walikelas';
				$data['nim'] = '';
				$datay['modul'] = 'Unggah Catatan Walikelas';
				$datay['tautan_balik'] = ''.base_url().'sinkronard/formwalikelas';
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$this->load->view('admin/bg_head',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					redirect('sinkronard/formwalikelas');
				}
			} //akhir kalau tfnidak error upload
		} // akhir kalau ada file terkirim
	}//kalau tatausaha
	function kirimnilaiharian($id_mapel=null)
	{
		$data = array();
		$data["nim"]='';
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Unggah Nilai Ke ARD';
		$data['id_mapel'] = $id_mapel;
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
//		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_kirim_nilai',$data);
		$this->load->view('shared/bawah');
	}
	function fkirimnilaiharian($id_mapel=null)
	{
		$data = array();
		$data["nim"]='';
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Unggah Nilai';
		$data['id_mapel'] = $id_mapel;
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['adamenu'] = '';
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/frame_form_kirim_nilai',$data);
		$this->load->view('shared/bawah');
	}
	function kirimnilaiakhir($id_mapel=null,$nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Kirim Daftar Nilai Siswa ke ARD';
		$data['loncat'] = '';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$data['id_mapel']=$id_mapel;
		if(!empty($id_mapel))
		{
			$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
			if($tmapel->num_rows() > 0)
			{
				foreach($tmapel->result() as $dtmapel)
				{
					$subjects_value = $dtmapel->subjects_value;
					$data['kelas'] = $dtmapel->kelas;
					$data['mapel'] = $dtmapel->mapel;
					$data['thnajaran'] = $dtmapel->thnajaran;
					$data['semester'] = $dtmapel->semester;
					$kkm = $dtmapel->kkm;
					$ranah = $dtmapel->ranah;
					$pilihan = $dtmapel->pilihan;
					$kurikulum = cari_kurikulum($dtmapel->thnajaran,$dtmapel->semester,$dtmapel->kelas);
				}
				if(empty($subjects_value))
				{
					redirect('sinkronard/subjects_value_not_found');	
				}
				$data['kurikulum'] = $kurikulum;
				$data['pilihan'] = $pilihan;
				$data['kkm'] = $kkm;
				$data['ranah'] = $ranah;
				if(!is_numeric($nomor))
				{
					$nomor = 0;
				}
				$data['nomor'] = $nomor;
				if ((empty($kkm)) or (empty($ranah)))
				{
					redirect('admin');
				}
				$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
				$data['subjects_value'] = $subjects_value;
				$this->load->view('admin/bg_head',$data);
				$this->load->view('sinkronard/kirim_daftar_nilai_akhir_ke_ard',$data);
				$this->load->view('shared/bawah');
			}
			else
			{
				redirect('sinkronard/kirimnilaiakhir');
			}
		}
		else
		{
			$data['thnajaran'] = cari_thnajaran();
			$data['semester'] = cari_semester();
			$this->load->view('admin/bg_head',$data);
			$this->load->view('sinkronard/kirim_daftar_nilai_akhir_ke_ard',$data);
			$this->load->view('shared/bawah');

		}
	}
	function fkirimnilaiakhir($id_mapel=null,$nomor=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Kirim Daftar Nilai Siswa ke ARD';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
//		$this->load->model('Guru_model');
		$kodeguru = $data["nim"];
		$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$subjects_value = $dtmapel->subjects_value;
				$data['kelas'] = $dtmapel->kelas;
				$data['mapel'] = $dtmapel->mapel;
				$data['thnajaran'] = $dtmapel->thnajaran;
				$data['semester'] = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$ranah = $dtmapel->ranah;
			}
			if(empty($subjects_value))
			{
				redirect('sinkronard/subjects_value_empty');	
			}
			if ((empty($kkm)) or (empty($ranah)))
			{
				redirect('sinkronard/kkm_atau_ranah_kosong');
			}
			$data['adamenu'] = '';
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['kkm'] = $kkm;
			$data['nomor'] = $nomor;
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$data['subjects_value'] = $subjects_value;
			$data['adamenu'] = '';
			$this->load->view('admin/bg_head',$data);
			$this->load->view('sinkronard/frame_kirim_daftar_nilai_akhir_ke_ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect ('admin');
		}
	}
	function catatanwalikelas()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Tanggapan Walikelas';
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/catatan_walikelas',$data);
		$this->load->view('shared/bawah');
	}	
	function ard($hal=null,$id_walikelas=null,$nomor=null,$ulang=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Tanggapan Walikelas';
		$twali = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
		$data['id_walikelas']=$id_walikelas;
		$data['hal'] = $hal;
		$data['ulang'] = $ulang;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
			foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['id_walikelas']=$id_walikelas;
			$data['nomor'] = $nomor;
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$this->load->view('admin/bg_head',$data);
			$this->load->view('sinkronard/ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('admin');
		}
	}
	function tanggapanwalikelas($id_walikelas=null,$nomor=null,$ulang=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Tanggapan Walikelas';
		$twali = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
		$data['id_walikelas']=$id_walikelas;
		$ada = $twali->num_rows();
		if ($ada>0)
		{
			foreach($twali->result() as $dtwali)
			{
				$kelas = $dtwali->kelas;
				$thnajaran = $dtwali->thnajaran;
				$semester = $dtwali->semester;
			}
			if(!is_numeric($nomor))
			{
				$nomor = 0;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['id_walikelas']=$id_walikelas;
			$data['adamenu'] = '';
			$data['nomor'] = $nomor;
			$data['ulang'] = $ulang;
			$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
			$this->load->view('admin/bg_head',$data);
			$this->load->view('sinkronard/ftanggapan_walikelas',$data);
			$this->load->view('shared/bawah');
		}
	}
	function unduhkodenilai($id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Mengunduh Kode Nilai Siswa ke ARD';
		$kelas='';
		$thnajaran='';
		$mapel='';
		$itemnilai='';
		$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
		$data['id_mapel']=$id_mapel;
		$ada = $tmapel->num_rows();
		if ($ada>0)
		{
			foreach($tmapel->result() as $dtmapel)
			{
				$subjects_value = $dtmapel->subjects_value;
				$data['kelas'] = $dtmapel->kelas;
				$data['kelas'] = $dtmapel->kelas;
				$data['mapel'] = $dtmapel->mapel;
				$data['thnajaran'] = $dtmapel->thnajaran;
				$data['semester'] = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$ranah = $dtmapel->ranah;
				$pilihan = $dtmapel->pilihan;
				$kurikulum = cari_kurikulum($dtmapel->thnajaran,$dtmapel->semester,$dtmapel->kelas);
			}
			if(empty($subjects_value))
			{
				redirect('sinkronard/subjects_value_kosong');	
			}
			$data['kurikulum'] = $kurikulum;
			$data['pilihan'] = $pilihan;
			$data['kkm'] = $kkm;
			$data['ranah'] = $ranah;
			$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
			$data['subjects_value'] = $subjects_value;
			$data['adamenu'] = '';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('sinkronard/unduh_kode_nilai_dari_ard',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect ('guru');
		}
	}
	function form_input_nilai_harian2($id_mapel=null)
	{
		$data["nim"]='';
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['judulhalaman'] = 'Form Input Nilai Harian';
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['id_mapel'] = $id_mapel;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_input_nilai_harian2',$data);
		$this->load->view('shared/bawah');
	}
/*
	function student_report($nomor)
	{
		$data["nim"]='';
		$data['thnajaran'] = cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['judulhalaman'] = 'Kirim Nilai Akhir ke ARD';
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$data['nomor'] = $nomor;
		$this->load->view('admin/bg_head',$data);
		$this->load->view('sinkronard/form_kirim_nilai_rapor',$data);
		$this->load->view('shared/bawah');
	}
*/

/* akhir controller */
}
?> 
