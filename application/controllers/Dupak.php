<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: Guru.php
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
class Dupak extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->model('Dupak_model','dupak');
		$this->load->model('Guru_model','guru');
		$this->load->model('Helper_model','helper');
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
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Situs_model');
		$tinbox = $this->Situs_model->Cek_Inbox($data["nim"]);
		//$temail = $this->Situs_model->Ada_Email($data["nim"]);
		//$tvalidemail = $this->Situs_model->Valid_Email($data["nim"]);
		$data["adapesan"] = $tinbox->num_rows();
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}

	function awal()
	{
		$data = array();
		$nim=$this->session->userdata('username');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['aksi'] = $this->uri->segment(3);
		$ta = $this->db->query("select * from `dupak_masa` where `username` = '$nim'");
		$ada = $ta->num_rows();
		if($ada > 0 )
		{
			redirect('dupak/masa');
		}
		$data['judulhalaman'] = 'Masa Penilaian';
		$proses=$this->input->post('proses');
		$golongan = $this->input->post('golongan');
		if(!empty($proses))
		{
			$this->dupak->Simpan_Masa($nim,$golongan);
			redirect('dupak/masa');
		}
		$data['username'] = $nim;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/awal',$data);
		$this->load->view('shared/bawah');
	}
	function masa()
	{
		$data = array();
		$nim=$this->session->userdata('username');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['aksi'] = $this->uri->segment(3);
		$ta = $this->db->query("select * from `dupak_masa` where `username` = '$nim'");
		if($ta->num_rows()==0)
		{
			redirect('dupak/awal');
		}		
		$data['id_dupak_masa'] = $this->uri->segment(4);
		$data['judulhalaman'] = 'Masa Penilaian';
		$proses=$this->input->post('proses');
		if(!empty($proses))
		{
			$in['awal_penilaian'] = tanggal_indonesia_ke_barat($this->input->post('awal_penilaian'));
			$in['akhir_penilaian'] = tanggal_indonesia_ke_barat($this->input->post('akhir_penilaian'));
			$in['tanggal'] = tanggal_indonesia_ke_barat($this->input->post('tanggal'));
			$awal = $this->input->post('awal');
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$tahun_baru = $this->input->post('tahun_baru');
			$bulan_baru = $this->input->post('bulan_baru');
			$tmt = tanggal_indonesia_ke_barat($this->input->post('tmt'));
			$in['tahun_baru'] = $tahun_baru;
			$in['bulan_baru'] = $bulan_baru;
			$in['tahun'] = $tahun;
			$in['bulan'] = $bulan;
			$in['tmt'] = $tmt;
			$in['golongan'] = $this->input->post('proses');
			$in['versi'] = $this->input->post('versi');
			$in['username'] = $data["nim"];
			$this->dupak->Perbarui_Masa($in);
		}
		$data['username'] = $nim;
		$data['query'] = $this->dupak->Tampil_Masa($nim);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/masa',$data);
		$this->load->view('shared/bawah');
	}

	function tapel()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		$data['nip'] = $this->helper->username_jadi_nip($data['nim']);
		$golongan = $this->uri->segment(3);
		if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
		{
		}
		else
		{
			redirect('dupak/masa');
		}
		$aksi = $this->uri->segment(4);
		$golongan = preg_replace("/_/","/", $golongan);
		$id_dupak_tahun = $this->uri->segment(5);
		if($aksi == 'hapus')
		{
			$this->dupak->Hapus_Tapel($data["nim"],$id_dupak_tahun);
			redirect('dupak/tapel/'.$this->uri->segment(3));
		}
		$data['id_dupak_tahun'] = $this->uri->segment(4);
		$data['judulhalaman'] = 'Tahun Pelajaran Termasuk DUPAK Saat Golongan '.$golongan;
		$proses=$this->input->post('proses');
		$thnajaran=$this->input->post('thnajaran');
		$versi=$this->input->post('versi');
		$semester=$this->input->post('semester');
		if(!empty($proses))
		{
			$in['username'] = $data["nim"];
			$in['tahun'] = $thnajaran;
			$in['semester'] = $semester;
			$in['golongan'] = $golongan;
			$in['versi'] = $versi;
			$cek = $this->dupak->Cek_Tapel($in);
			if($cek->num_rows() == 0)
			{
				$this->dupak->Tambah_Tapel($in);
			}
			else
			{
				$this->dupak->Perbarui_Tapel($in);
			}
			redirect('dupak/tapel/'.$this->uri->segment(3));
		}
		$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['golongan'] = $golongan;		
		$data['aksi'] = $aksi;
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$data['query'] = $this->dupak->Tampil_Tapel($data["nim"],$golongan);
		
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/tapel',$data);
		$this->load->view('shared/bawah');
	}
	function olah($golongan=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		$data['nip'] = $this->helper->username_jadi_nip($data['nim']);
		if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
		{
		}
		else
		{
			redirect('dupak/masa');
		}
		$data['golongan'] = $golongan;		
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$data['query'] = $this->dupak->Tampil_Tapel($data["nim"],$golongan);
		$golongane = preg_replace("/_/","/", $golongan);
		$versi = $this->uri->segment(4);
		$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
		$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
		$data['datamasa'] = $this->dupak->datamasa($data["nim"],$golongan);
		$golongans = Pangkat_Sebelum($golongane);
		$data['datapaklama'] = $this->dupak->Tampil_Data_Pak($data["nim"],$golongans);
		$data['tmasa'] = $this->dupak->Tampil_Tapel_Lama($data["nim"],$golongane);
		$data['golongans'] = $golongans;
		$data['golongane'] = $golongane;
		$data['proses'] = $this->uri->segment(5);
		$data['versi'] = $versi;
		if($versi == 'lama')
		{
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->library('fpdf');
			$this->load->view('dupak/dupak_sebelum_2014',$data);
		}
		elseif($versi == 'gabungan')
		{
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['gabungan'] = 'ada';
			$data['judulhalaman'] = 'Daftar Usulan Penetapan Angka Kredit Golongan '.$golongane;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('dupak/dupak_2014_proses',$data);
			$this->load->view('shared/bawah');

		}
		else
		{
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['judulhalaman'] = 'Daftar Usulan Penetapan Angka Kredit Golongan '.$golongane;
			$data['gabungan'] = 'tidakada';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('dupak/dupak_2014_proses',$data);
			$this->load->view('shared/bawah');
		}
	}
	function pak()
	{
		$data = array();
		$nim=$this->session->userdata('username');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$ta = $this->db->query("select * from `dupak_pak` where `username` = '$nim'");
		if($ta->num_rows()==0)
		{
			redirect('dupak/buatpak');
		}
		$proses = $this->input->post('proses');
		if($proses == 'proses')
		{
			$in['awal_penilaian'] = tanggal_indonesia_ke_barat($this->input->post('awal_penilaian'));
			$in['akhir_penilaian'] = tanggal_indonesia_ke_barat($this->input->post('akhir_penilaian'));
			$in['pendidikan'] = $this->input->post('pendidikan');
			$in['pangkat'] = $this->input->post('pangkat');
			$in['golongan'] = $this->input->post('golongan');
			$in['tmt'] = tanggal_indonesia_ke_barat($this->input->post('tmt'));
			$in['jabatan'] = $this->input->post('jabatan');
			$in['tahun_lama'] = $this->input->post('tahun_lama');
			$in['bulan_lama'] = $this->input->post('bulan_lama');
			$in['tahun'] = $this->input->post('tahun');
			$in['bulan'] = $this->input->post('bulan');
			$in['tugas'] = $this->input->post('tugas');
			$in['ak_pendidikan'] = $this->input->post('ak_pendidikan');
			$in['ak_sttpl'] = $this->input->post('ak_sttpl');
			$in['ak_pbm'] = $this->input->post('ak_pbm');
			$in['ak_pkb'] = $this->input->post('ak_pkb');
			$in['ak_penunjang'] = $this->input->post('ak_penunjang');
			$in['nomor'] = $this->input->post('nomor');
			$in['username'] = $nim;
			$in['ak'] = $in['ak_pendidikan']+ $in['ak_sttpl'] + $in['ak_pbm'] + $in['ak_pkb'] + $in['ak_penunjang'];
			$in = hilangkanpetik($in);
			$this->dupak->Perbarui_Riwayat_Pak($in);	
		}
		$golongan = $this->uri->segment(3);
		$data['username'] = $nim;
		$data['query'] = $this->dupak->Tampil_Riwayat_Pak($nim);
		$data['pak'] = $this->dupak->Tampil_Data_Pak($nim,$golongan);
		$data['aksi'] = $golongan;
		$data['judulhalaman'] = 'Riwayat PAK';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/p_a_k',$data);
		$this->load->view('shared/bawah');
	}
	function buatpak()
	{
		$data = array();
		$nim=$this->session->userdata('username');
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$ta = $this->db->query("select * from `dupak_pak` where `username` = '$nim'");
		if($ta->num_rows()>0)
		{
			redirect('dupak/pak');
		}
		else
		{
			$this->dupak->buatpak($nim);
			redirect('dupak/pak');
		}
	}
	function cetak($golongan=null,$versi=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
		{
		}
		else
		{
			redirect('dupak/masa');
		}
		$data['golongan'] = $golongan;		
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$data['query'] = $this->dupak->Tampil_Tapel($data["nim"],$golongan);
		$golongane = preg_replace("/_/","/", $golongan);
		$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
		$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
		$data['datamasa'] = $this->dupak->datamasa($data["nim"],$golongan);
		$golongans = Pangkat_Sebelum($golongane);
		$data['datapaklama'] = $this->dupak->Tampil_Data_Pak($data["nim"],$golongans);
		$data['tmasa'] = $this->dupak->Tampil_Tapel_Lama($data["nim"],$golongane);
		$data['golongans'] = $golongans;
		$data['golongane'] = $golongane;
		if($versi == 'lama')
		{
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->library('fpdf');
			$this->load->view('dupak/dupak_sebelum_2014',$data);
		}
		elseif($versi == 'gabungan')
		{
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->library('fpdf');
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['gabungan'] = 'ada';
			$this->load->view('dupak/dupak_2014',$data);
		}
		else
		{
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['judulhalaman'] = 'Daftar Usulan Penetapan Angka Kredit Golongan '.$golongane;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('dupak/dupak_2014_proses',$data);
			$this->load->view('shared/bawah');
		}
	}
	function skp($golongan=null,$aksi=null,$tahun=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['loncat'] = '';
		$data["status"]= 'guru';
		if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
		{
		}
		else
		{
			redirect('dupak/masa');
		} 
		if($aksi== 'hapus')
		{
			$username = $data["nim"];
			$id_dupak_skp = $this->uri->segment(5);
			$this->dupak->Hapus_Skp($username,$id_dupak_skp);
			redirect('dupak/skp/'.$golongan);
		}
		$golongan = preg_replace("/_/","/", $golongan);
		$status_data = $this->input->post('status_data');
		if(($status_data == 'baru') or ($status_data == 'lama'))
		{
			$in["username"] = $data["nim"];
			$kode = $this->input->post('kode');
			$in["kode"] = $kode;
			$in["kuantitas"] = $this->input->post('kuantitas');
			$in["tahun"] = $tahun;
			$in["golongan"] = $golongan;
			$in['ak'] = $this->dupak->Cari_Ak($kode);
			if($status_data == 'baru')
			{
				$this->dupak->Tambah_Skp($in);
			}
			if($status_data == 'lama')
			{
				$in["id_dupak_skp"] = $this->input->post('id_dupak_skp');
				$this->dupak->Ubah($in);
			}

		}
		$data['tahun'] = $tahun;
		$data['judulhalaman'] = 'Tambah SKP Saat Golongan '.$golongan;
		$data['kodeguru'] = $data["nim"];
		$nip= $this->guru->get_NIP($data["nim"]);

		$data['golongan'] = $golongan;		
		$data['aksi'] = $aksi;
		$data['query'] = $this->dupak->Tampil_Skp($data["nim"],$golongan);
		$data['query2'] = $this->dupak->Tampil_Skp_Pkg($nip,$golongan);
		$data["username"] = $data["nim"];
		$data['nip'] = $nip;
		$data['daftar_tapel']= $this->guru->Tampilkan_Semua_Tahun();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/skp',$data);
		$this->load->view('shared/bawah');
	}
	function pd()
	{
		$this->load->model('Dupak_model','dupak');
		$this->load->model('Guru_model','guru');
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		$golongan = $this->uri->segment(3);
		$versi = $this->uri->segment(4);
		$aksi = $this->uri->segment(6);
		$id_dupak_pd = $this->uri->segment(5);
		if($aksi== 'hapus')
		{
			$username = $data["nim"];
			$this->dupak->Hapus_Pd($username,$id_dupak_pd);
			redirect('dupak/pd/'.$golongan.'/'.$versi);
		}

		if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
		{
		}
		else
		{
			redirect('dupak/masa');
		} 
		$golongan = preg_replace("/_/","/", $golongan);
		$id_dupak_pd_post = $this->input->post('id_dupak_pd');
		if(!empty($id_dupak_pd_post))
		{
			$in["tanggal"] = $this->input->post('tanggal');
			$in["nama_kegiatan"] = $this->input->post('nama_kegiatan');
			$in["keterangan"] = $this->input->post('keterangan');
			$in["id_dupak_pd"] = $id_dupak_pd_post;
			$in["jam"] = $this->input->post('jam');
			$in["materi"] = $this->input->post('materi');
			$in["peran"] = $this->input->post('peran');
			$in["fasilitator"] = $this->input->post('fasilitator');
			$in["tempat"] = $this->input->post('tempat');
			$in["penyelenggara"] = $this->input->post('penyelenggara');
			$in["bukti"] = $this->input->post('bukti');
			$in = hilangkanpetik($in);
			$this->dupak->Ubah_Pd($in);
		}

		$data['judulhalaman'] = 'Data Pengembangan Diri untuk Pengajuan Angka Kredit Golongan '.$golongan;
		$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['golongan'] = $golongan;		
		$data['versi'] = $versi;
		$data['query'] = $this->dupak->Tampil_Pd($data["nim"],$golongan);
		$data["username"] = $data["nim"];
		$data['id_dupak_pd'] = $this->uri->segment(5);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/pd',$data);
		$this->load->view('shared/bawah');
	}
	function mencetak()
	{
		$this->load->model('Dupak_model','dupak');
		$this->load->model('Guru_model','guru');
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		$golongan = $this->uri->segment(3);
		$item = $this->uri->segment(4);
		if(!empty($golongan))
		{
			if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
			{
			}
			else
			{
				redirect('dupak/masa');
			} 
		}
		$this->load->model('Referensi_model','ref');
		$data['unit_kerja'] = $this->ref->ambil_nilai('unit_kerja');
		$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
		if($item == 1)
		{
			redirect('dupak/cetak/'.$golongan.'/lama');
		}
		elseif($item == 2)
		{
			
			$golongan = preg_replace("/_/","/", $golongan);
			$golongann = Pangkat_Sesudah($golongan);
			$data['judulhalaman'] = 'Daftar Usulan Penilaian Angka Kredit';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;	
			$data['golongann'] = $golongann;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
			$data['datapak'] = $this->dupak->Tampil_Data_Pak($data["nim"],$golongan);
			$data['datamasa'] = $this->dupak->datamasa($data["nim"],$golongann);
			$this->load->view('dupak/dupak_2014',$data);
		}
		elseif($item == 3)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Surat Pernyataan Melaksanakan Tugas Pembelajaran / Bimbingan dan Tugas Tertentu';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
			$data['datamasa'] = $this->dupak->datamasa($data["nim"],$golongan);
			$this->load->view('dupak/spmtpbdtt',$data);
		}
		elseif($item == 4)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Surat Pernyataan Melakukan Kegiatan Pengembangan Keprofesian Berkelanjutan';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
			$this->load->view('dupak/spmkpkb',$data);
		}
		elseif($item == 5)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'SURAT PERNYATAAN MELAKUKAN KEGIATAN PENUNJANG TUGAS GURU';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
			$this->load->view('dupak/spmkptg',$data);
		}
		elseif($item == 6)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Surat Pernyataan Melaksanakan Kegiatan Proses Belajar Mengajar atau Bimbingan';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$data['datapangkat'] = $this->dupak->datapangkat($data["nim"],$golongan);
			$this->load->view('dupak/spmkpbm',$data);
		}
		elseif($item == 7)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Rekapitulasi Kegiatan Pengembangan Diri dan Publikasi Ilmiah';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$this->load->view('dupak/rekap_pd_pi',$data);
		}
		elseif($item == 8)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Rekapitulasi Kegiatan Pengembangan Diri';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$this->load->view('dupak/rekap_pd',$data);
		}
		elseif($item == 9)
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Rekapitulasi Kegiatan Publikasi Ilmiah';
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['dataguru'] = $this->dupak->dataguru($data["nim"]);
			$this->load->view('dupak/rekap_pi',$data);
		}
		else
		{
			$golongan = preg_replace("/_/","/", $golongan);
			$data['judulhalaman'] = 'Mencetak Borang Pengajuan AK Golongan '.$golongan;
			$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
			$data['golongan'] = $golongan;		
			$data['item'] = $item;
			$data["username"] = $data["nim"];
			$data['loncat'] = '';
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('dupak/mencetak_borang_dupak',$data);
			$this->load->view('shared/bawah');
		}
	}
	function pj()
	{
		$this->load->model('Dupak_model','dupak');
		$this->load->model('Guru_model','guru');
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
		$golongan = $this->uri->segment(3);
		$versi = $this->uri->segment(4);
		$aksi = $this->uri->segment(6);
		$id_dupak_pj = $this->uri->segment(5);
		if($aksi== 'hapus')
		{
			$username = $data["nim"];
			$this->dupak->Hapus_Pj($username,$id_dupak_pj);
			redirect('dupak/pj/'.$golongan.'/'.$versi);
		}

		if (($golongan== 'II_a') or ($golongan== 'II_b') or ($golongan== 'II_c') or ($golongan== 'II_d') or ($golongan== 'III_a') or ($golongan== 'III_b') or ($golongan== 'III_c') or ($golongan== 'III_d') or ($golongan== 'IV_a') or ($golongan== 'IV_b') or ($golongan== 'IV_c') or ($golongan== 'IV_d'))
		{
		}
		else
		{
			redirect('dupak/masa');
		} 
		$golongan = preg_replace("/_/","/", $golongan);
		$id_dupak_pj_post = $this->input->post('id_dupak_pj');
		if(!empty($id_dupak_pj_post))
		{
			$in["tanggal"] = $this->input->post('tanggal');
			$in["nama_kegiatan"] = $this->input->post('nama_kegiatan');
			$in["id_dupak_pj"] = $id_dupak_pj_post;
			$in = hilangkanpetik($in);
			$this->dupak->Ubah_Pj($in);
		}

		$data['judulhalaman'] = 'Data Penunjang Tugas Guru untuk Pengajuan Angka Kredit Golongan '.$golongan;
		$data['kodeguru'] = $this->guru->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data['golongan'] = $golongan;		
		$data['versi'] = $versi;
		$data['query'] = $this->dupak->Tampil_Pj($data["nim"],$golongan);
		$data["username"] = $data["nim"];
		$data['id_dupak_pj'] = $this->uri->segment(5);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/pj',$data);
		$this->load->view('shared/bawah');
	}
	function ubahcacahsemester($id_skp_skor_guru=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['nip'] = $this->helper->username_jadi_nip($data['nim']);
		$nip = $this->helper->username_jadi_nip($data['nim']);
		$data['judulhalaman'] = 'Mengubah Cacah Semester SKP Mutasi';
		$data['id_skp_skor_guru'] = $id_skp_skor_guru;
		$id_skp_skor_guru_post = $this->input->post('id');
		if(!empty($id_skp_skor_guru_post))
		{
			$cacah = $this->input->post('cacah');
			$this->db->query("update `skp_skor_guru_kedua` set `cacah` = '$cacah' where `id_skp_skor_guru` = '$id_skp_skor_guru_post' and `nip` = '$nip'");
			redirect('dupak/masa');
		}
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('dupak/ubah_cacah_semester',$data);
		$this->load->view('shared/bawah');

	}
	function pkg($golongane=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$nip= $this->Guru_model->get_NIP($data["nim"]);
		$gurubk = 0;
		$tc = $this->db->query("select * from `gurubk` where `nip` = '$nip'");
		if($tc->num_rows()>0)
		{
			$gurubk = 1;
		}
		$predikat = 'Baik';
		$golongan = nopetik($this->input->post('golongan'));
		$tambahan = nopetik($this->input->post('tambahan'));
		$waktu = nopetik($this->input->post('waktu'));
		$tahun= nopetik($this->input->post('tahun'));
		$ak = 0;
		$ty = $this->db->query("select * from `skp_skor` where `kriteria`='b' and `golongan`='$golongan'");
		foreach($ty->result() as $y)
		{
			$ak = $y->skor;
		}
		if($gurubk == 0)
		{
			$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.') ( 100% x '.$ak.')';
			$ak_target = $ak;
			if ($tambahan=='Waka')
			{
				$ak_target = $ak / 2;
				$aktambahan_target = $ak / 2;
				$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.')  ( 50% x '.$ak.')';
				$kegiatan1 = ''.$tambahan.' dengan sebutan '.$predikat.' ( 50% x '.$ak.')';
			}
			if ($tambahan=='Kepala')
			{
				$ak_target = $ak / 4;
				$aktambahan_target = $ak * 0.75;
				$adatambahan = 1;
				$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.') ( 25% x '.$ak.')';
				$kegiatan1 = 'Menjadi kepala madrasah dengan sebutan '.$predikat.' ( 75% x '.$ak.')';
			}
			if ($tambahan=='Kalab')
			{
				$ak_target = $ak / 2;
				$aktambahan_target = $ak / 2;
				$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.') ( 50% x '.$ak.')';
				$kegiatan1 = ''.$tambahan.' dengan sebutan '.$predikat.' ( 50% x '.$ak.')';
			}
			if ($tambahan=='Walikelas')
			{
				if($waktu == 6)
				{
					$ak_target = $ak;
					$aktambahan_target = $ak * 0.05;
					$kegiatan1 = 'Wali kelas ( 5% x '.$ak.')';
				}
				else
				{
					$ak_target = $ak;
					$aktambahan_target = $ak * 0.02;
					$kegiatan1 = 'Wali kelas ( 2% x '.$ak.')';
				}
			}

		}
		if($gurubk == 1)
		{
			$kegiatan = 'Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai, menganalisis hasil penilaian, melaksanakan tindak lanjut hasil penilaian dan melaksanakan bimbingan di kelas';
		}
		$tz = 	$this->db->query("select * from `skp_skor_guru` where `kode` = '00' and `nip` = '$nip' and `tahun`='$tahun'");
		$ada = $tz->num_rows();
		$golongan_pak = Pangkat_Sesudah($golongan);
		if($ada == 0)
		{
			$this->db->query("INSERT INTO `skp_skor_guru` (`kode`,`unsur`, `kegiatan`, `ak`, `ak_target`,`kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `tahun`,`status`, `golongan`) VALUES ('00', 'B', '$kegiatan', '$ak', '$ak_target','1', 'Laporan', '100', '$waktu', 'bl', '0', '$nip', '$tahun','0', '$golongan_pak')");
		} // akhir kalau baru
		else
		{
			$this->db->query("update `skp_skor_guru` set `kegiatan`='$kegiatan', `ak`='$ak', `ak_target`='$ak_target', `status`='0', `waktu`='$waktu', `golongan` = '$golongan_pak' where `nip`='$nip' and `tahun`='$tahun' and `kode`='00'");
		}
		if(!empty($tambahan))
		{
			if($tambahan == 'Walikelas')
			{
				$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nip' and `kode`='T02'");
				$ada = $ta->num_rows();
				if($ada == 0)
				{
					$this->db->query("INSERT INTO `skp_skor_guru` (`kode`,`unsur`, `kegiatan`, `ak`, `ak_target`,`kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `tahun`,`status`, `golongan`) VALUES ('T02', 'B', '$kegiatan1', '$ak', '$aktambahan_target', '1', 'Laporan', '100', '$waktu', 'bl', '0', '$nip', '$tahun','0', '$golongan_pak')");
				}
				else
				{
					$this->db->query("update `skp_skor_guru` set `kegiatan`='$kegiatan1', `ak`='$ak', `ak_target`='$aktambahan_target', `status`='0' , `waktu`='$waktu', `golongan` = '$golongan_pak' where `nip`='$nip' and `tahun`='$tahun' and `kode`='T02'");
				}
			}
			else
			{
				$ta=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nip' and `kode`='01'");
				$ada = $ta->num_rows();
				if($ada == 0)
				{
					$this->db->query("INSERT INTO `skp_skor_guru` (`kode`,`unsur`, `kegiatan`, `ak`, `ak_target`,`kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `tahun`,`status`, `golongan`) VALUES ('01', 'B', '$kegiatan1', '$ak', '$aktambahan_target', '1', 'Laporan', '100', '$waktu', 'bl', '0', '$nip', '$tahun','0', '$golongan_pak')");
				}
				else
				{
					$this->db->query("update `skp_skor_guru` set `kegiatan`='$kegiatan1', `ak`='$ak', `ak_target`='$aktambahan_target', `status`='0' , `waktu`='$waktu', `golongan` = '$golongan_pak' where `nip`='$nip' and `tahun`='$tahun' and `kode`='01'");
				}
			}
		}
		redirect('dupak/skp/'.$golongane);
	}
/* akhir controller */
}
?>
