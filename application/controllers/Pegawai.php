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
class Pegawai extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Pegawai")
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
		$kd = $this->session->userdata('username');
		$this->load->model('Situs_model');
		$ta = $this->db->query("select * from `p_pegawai` where `kd`='$kd'");
		$adata = $ta->num_rows();
		if($adata==0)
		{
			redirect('pegawai/buatdataumum');	
		}
		$tinbox = $this->Situs_model->Cek_Inbox($data["nim"]);
		$data["adapesan"] = $tinbox->num_rows();
		$data['judulhalaman'] = 'Beranda Guru';
		$this->load->view('pegawai/bg_atas',$data);
		$this->load->view('pegawai/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'guru';
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
		$this->load->view('pegawai/bg_atas',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}
	function umum()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Data Pribadi Guru '.$data['nama'];
		$this->load->model('Guru_model');
		$data['tautan'] = 'pegawai';
		$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$this->load->view('pegawai/bg_atas',$data);
		$this->load->view('pegawai/detil_pegawai',$data);
		$this->load->view('shared/bawah');
	}
	function editdataumum()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Ubah Data Pribadi '.$data['nama'];
		$this->load->model('Guru_model');
		$data['query']=$this->Guru_model->Tampil_Data_Umum_Pegawai($data["nim"]); 
		$data['kd']=$data["nim"];
		$this->load->view('pegawai/bg_atas',$data);
		$this->load->view('pegawai/edit_detil_pegawai',$data);
		$this->load->view('shared/bawah');
	}
	function updatedataumum()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$in["kodeguru"]=$nim;
		$in["kd"]=$this->input->post('kd');
		$in["status_tempat_tugas"] = $this->input->post('status_tempat_tugas');
		$in["kode_lptk"]=$this->input->post('kode_lptk');
		$in["jalur_sertifikasi"]=$this->input->post('jalur_sertifikasi');
		$in["jabatan"]=$this->input->post('jabatan');
		$in["jalan"]=$this->input->post('jalan');
		$in["pegid"]=$this->input->post('pegid');
		$in["kode_mapel_utama"]=$this->input->post('kode_mapel_utama');
		$in["nip"]=$this->input->post('nip');
		$in["efin"]=$this->input->post('efin');
		$in["nama"]=$this->input->post('nama');
		$in["tempat"]=$this->input->post('tempat');
		$harilahir = $this->input->post('harilahir');
		$bulanlahir = $this->input->post('bulanlahir');
		$tahunlahir = $this->input->post('tahunlahir');
		$tanggallahir = "$tahunlahir-$bulanlahir-$harilahir";
		$in["tanggallahir"]=$tanggallahir;
		$in["jenkel"]=$this->input->post('jenkel');
		$in["usiapensiun"]=$this->input->post('usiapensiun');
		$tahunpensiun = $in['usiapensiun']+$tahunlahir;
		$tanggalpensiun = "$tahunpensiun-$bulanlahir-$harilahir";
		$in["tanggalpensiun"]=$tanggalpensiun;
		$in["ayah"]=$this->input->post('ayah');
		$in["ibu"]=$this->input->post('ibu');
		$in["alamatortu"]=$this->input->post('alamatortu');
		$in["alamat"]=$this->input->post('alamat');
		$in["telpon"]=$this->input->post('telpon');
		$nohp=$this->input->post('seluler');
		if (strlen($nohp>9))
		{
			$in["seluler"]=seluler($nohp);
		}
		$in["bangsa"]=$this->input->post('bangsa');
		$in["agama"]=$this->input->post('agama');
		$in["ayahmertua"]=$this->input->post('ayahmertua');
		$in["ibumertua"]=$this->input->post('ibumertua');
		$in["alamatmertua"]=$this->input->post('alamatmertua');
		$in["nuptk"]=$this->input->post('nuptk');
		$in["nrg"]=$this->input->post('nrg');
		$in["npwp"]=$this->input->post('npwp');
		$haripertama = $this->input->post('haripertama');
		$bulanpertama = $this->input->post('bulanpertama');
		$tahunpertama = $this->input->post('tahunpertama');
		$kgb_pertama = "$tahunpertama-$bulanpertama-$haripertama";
		$harikgb = $this->input->post('harikgb');
		$bulankgb = $this->input->post('bulankgb');
		$tahunkgb = $this->input->post('tahunkgb');
		$tanggalkgb = "$tahunkgb-$bulankgb-$harikgb";
		$tahunkgbyad=substr($tanggalkgb,0,4)+2;
		$kgbyad = ''.$tahunkgbyad.''.substr($tanggalkgb,4,8).'';
		$in["kgb_pertama"]=$kgb_pertama;
		$in["kgb"]=$tanggalkgb;
		$in["kgb_yad"]=$kgbyad;
		//yyyy-mm-dd
		$tglkgbyad = substr($kgbyad,8,2);
		$blnkgbyad = substr($kgbyad,5,2);
		$thnkgbyad = substr($kgbyad,0,4);
		//2013-01-01 --> 2012-12-01
		if ($blnkgbyad==1)
		{
			$blnkgbyad = 12;
			$thnkgbyad = $thnkgbyad - 1;
		}
		else
		{
			$blnkgbyad = $blnkgbyad-1;
		}
		$in["kgb_sms"]= "$thnkgbyad-$blnkgbyad-$tglkgbyad";
		$in["nama_tanpa_gelar"]=$this->input->post('nama_tanpa_gelar');
		$in["gelar_depan"]=$this->input->post('gelar_depan');
		$in["gelar_belakang"]=$this->input->post('gelar_belakang');
		$in["status_perkawinan"]=$this->input->post('status_perkawinan');
		$in["cacah_anak_kandung"]=$this->input->post('cacah_anak_kandung');
		$in["rt"]=$this->input->post('rt');
		$in["rw"]=$this->input->post('rw');
		$in["desa"]=$this->input->post('desa');
		$in["kecamatan"]=$this->input->post('kecamatan');
		$in["kabupaten"]=$this->input->post('kabupaten');
		$in["provinsi"]=$this->input->post('provinsi');
		$in["jenis_tempat_tinggal"]=$this->input->post('jenis_tempat_tinggal');
		$in["golongan_darah"]=$this->input->post('golongan_darah');
		$in["email"]=$this->input->post('email');
		$in["karpeg"]=$this->input->post('karpeg');
		$in["askes"]=$this->input->post('askes');
		$in["taspen"]=$this->input->post('taspen');
		$in["karis_karsu"]=$this->input->post('karis_karsu');
		$in["nama_ibu_kandung"]=$this->input->post('nama_ibu_kandung');
		$in["nik"]=$this->input->post('nik');
		$in["sudah_sertifikasi"]=$this->input->post('sudah_sertifikasi');
		$in["no_peserta_sertifikasi"]=$this->input->post('no_peserta_sertifikasi');
		$in["no_sertifikat"]=$this->input->post('no_sertifikat');
		$in["lulus_sertifikasi"]=$this->input->post('lulus_sertifikasi');
		$in["kode_mapel_sertifikasi"]=$this->input->post('kode_mapel_sertifikasi');
		$harilulus_sertifikasi = $this->input->post('harilulus_sertifikasi');
		$bulanlulus_sertifikasi = $this->input->post('bulanlulus_sertifikasi');
		$tahunlulus_sertifikasi = $this->input->post('tahunlulus_sertifikasi');
		$tgl_lulus_sertifikasi = "$tahunlulus_sertifikasi-$bulanlulus_sertifikasi-$harilulus_sertifikasi";
		$in["tgl_lulus_sertifikasi"]=$tgl_lulus_sertifikasi;
		$in["mapel_sertifikasi"]=$this->input->post('mapel_sertifikasi');
		$in["tugas_pokok"]=$this->input->post('tugas_pokok');
		$in["kodepos"]=$this->input->post('kodepos');
		$in["nip_lama"]=$this->input->post('nip_lama');
		$in["kpe"]=$this->input->post('kpe');
		$in["tb"]=$this->input->post('tb');
		$in["bb"]=$this->input->post('bb');
		$in["rambut"]=$this->input->post('rambut');
		$in["bentuk_muka"]=$this->input->post('bentuk_muka');
		$in["warna_kulit"]=$this->input->post('warna_kulit');
		$in["ciri_khas"]=$this->input->post('ciri_khas');
		$in["cacat_tubuh"]=$this->input->post('cacat_tubuh');
		$in["kegemaran"]=$this->input->post('kegemaran');
		$this->load->model('Guru_model');
		$this->Guru_model->Update_Data_Umum($in);
		redirect('pegawai/umum');
	}
    function macam()
    {
	$this->load->helper('pkg');
	$this->load->model('Pegawai_model','pegawai');
	$kodeguru = $this->session->userdata('username');
	$aksi = $this->uri->segment(4);
	$id = $this->uri->segment(5);
	$kodeguru = $this->session->userdata('username');
	$kegiatan = $this->input->post("kegiatan");
	$satuan = $this->input->post("satuan");
	$id_skp = $this->input->post("id_skp");
	if((!empty($kegiatan)) and (!empty($satuan)))
	{
		$in['kegiatan'] = hilangkanpetik($kegiatan);
		$in['satuan'] = hilangkanpetik($satuan);
		$in['kodepegawai'] = $kodeguru;
		if(empty($id_skp))
		{
			$this->pegawai->tambah_kegiatan_skp($in);	
		}
		else
		{
			$in['id_skp_pegawai'] = hilangkanpetik($id_skp);
			$this->pegawai->perbarui_kegiatan_skp($in);	
		}


	}

	$tautan = 'pegawai';
	$query = $this->pegawai->daftar_kegiatan_skp($kodeguru);
	$data = array('halaman' => 'referensi',
        'main_view' => 'pegawai/skp_pegawai', 'kodeguru'=>$kodeguru, 'judulhalaman' => 'Modul Macam Kegiatan Tugas Jabatan', 'aksi'=>$aksi, 'id'=>$id, 'query' => $query
	    );
	$this->load->view('pegawai/bg_atas',$data);
	$this->load->view('pegawai/skp_pegawai',$data);
	$this->load->view('shared/bawah');
    }

/* akhir controller */
}
?>
