<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 05 Jan 2016 09:55:58 WIB 
// Nama Berkas 		: tatausaha.php
// Lokasi      		: application/views/controllers
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.idf
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+

class Tatausaha extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Tatausaha")
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
		$this->load->model('Situs_model');
		$data['judulhalaman'] = 'Beranda Tatausaha';
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'tatausaha';
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
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}
	function penjurusan()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Penjurusan KTSP 2006 / Mutasi Kenaikan Kelas';
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
		$data_isi['tautan_balik'] = 'tatausaha';
		$semester = $this->input->post('semester');
		$thnajaran = $this->input->post('thnajaran');
		$tipemutasi = $this->input->post('tipemutasi');
		$data_isi['cacahsiswa'] = $this->input->post('cacahsiswa');
		$cacahsiswa = $this->input->post('cacahsiswa');
		if($cacahsiswa>0)
		{
			$param = array();
			for($i=1;$i<=$cacahsiswa;$i++)
			{
				$nis = $this->input->post('nis_'.$i);
				$kelas = $this->input->post('kelasmutasi_'.$i);
				$no_urut = '99';
				if($tipemutasi== '1')
				{
					$no_urut = $this->input->post('no_urut_'.$i);
				}
				$tsiswakelas = $this->Admin_model->Cek_Baru_Siswa_Kelas($thnajaranbaru,$semester,$nis);
				$csiswakelas = $tsiswakelas->num_rows();
				$param['thnajaran']=$thnajaranbaru;
				$param['semester'] = $semester;
				$param['status'] = 'Y';	
				$param['kelas'] = $kelas;
				$param['nis'] = $nis;
				$param['no_urut'] = $no_urut;
				if(!empty($kelas))
				{
					$tsiswakelas = $this->Admin_model->Add_Siswa_Kelas($param,$csiswakelas);
				}
			}
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/penjurusan',$data_isi);
		$this->load->view('shared/bawah');
	}
	function siswakelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Daftar Siswa Per Kelas';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
       		$data_isi['daftarkelas'] = $querykelas ;
		$data['kelas'] = $this->input->post('kelas');
		$data['thnajaran'] = $this->input->post('thnajaran');
		$data['urutkan'] = $this->input->post('urutkan');
		$data['semester'] = $this->input->post('semester');
		$data['tautan_balik'] = 'tatausaha';
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
				$statussiswa = $this->input->post('status_'.$i);
				$csiswakelas = 1;
				$param['thnajaran']=$thnajaran;
				$param['semester'] = $semester;
				$param['status'] = $statussiswa;	
				$param['kelas'] = $kelas;
				$param['nis'] = $nis;
				$param['no_urut'] = $no_urut;
				$param['bsm'] = $this->input->post('bsm_'.$i);
				$param['alasan_bsm'] = $this->input->post('alasan_bsm_'.$i);
				$tsiswakelas = $this->Admin_model->Add_Siswa_Kelas($param,$csiswakelas);
			}
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/siswa_kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tambahsiswapindahan()
	{		
		$data['judulhalaman'] = 'Tambah Siswa Pindahan';
		$data['masked'] = '';
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Nis_Terakhir();
		$data["nisterakhir"] ='';
		$data["namasiswa"] ='';
		foreach ($query->result() as $c)
		{
			$data["nisterakhir"]=$c->nis + 1;
			$data["namasiswa"]=$c->nama;  
		}
		$this->load->model('Siswa_model');
		$data['tdaftar_jarak']=$this->Siswa_model->Daftar_Jarak();
		$data['daftar_ruang']=$this->Siswa_model->Tampilkan_Semua_Kelas();
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/siswa_baru_pindahan',$data);
		$this->load->view('shared/bawah');
	}
	function updatedatasiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$in=array();
		$in["hdpibu"] = $this->input->post('hdpibu');
		$in["nis"] = $this->input->post('nis');
		$in["nokk"] = $this->input->post('nokk');
		$in["nisn"] = $this->input->post('nisn');
		$in["nik"] = $this->input->post('nik');
		$in["nik_kk"] = $this->input->post('nik_kk');
		$in["nik_ibu"] = $this->input->post('nik_ibu');
//		$in["tmpt"] = $this->input->post('tmpt');
//		$in["skhun"] = $this->input->post('skhun');
//		$in["nosttb"] = $this->input->post('nosttb');
//		$in["sltp"] = nopetik($this->input->post('sltp'));
//		$itglsttb = $this->input->post('tglsttb');
//		$in["tglsttb"] = tanggal_indonesia_ke_barat($itglsttb);
//		$in["ijazah"]= '';
//		$in["tgllhr"] = tanggal_indonesia_ke_barat($this->input->post('tgllhr'));
		$in["tglayah"] = tanggal_indonesia_ke_barat($this->input->post('tanggallahirayah'));
		$in["tglibu"] = tanggal_indonesia_ke_barat($this->input->post('tanggallahiribu'));
		$in["tglwali"] = tanggal_indonesia_ke_barat($this->input->post('tanggallahirwali'));
		$in["tglditerima"] = tanggal_indonesia_ke_barat($this->input->post('tanggalditerima'));
		$in["jenkel"] = $this->input->post('jenkel');
		$in["agama"] = $this->input->post('agama');
		$in["wn"] = $this->input->post('wn');
		$in["kls"] = $this->input->post('kls');
		$in["yatim"] = $this->input->post('yatim');
		$in["anakke"] = $this->input->post('anakke');
		$in["kandung"] = $this->input->post('kandung');
		$in["tiri"] = $this->input->post('tiri');
		$in["angkat"] = $this->input->post('angkat');
		$in["bhs"] = $this->input->post('bhs');
		$in["jalan"] = $this->input->post('jalan');
		$in["rt"] = $this->input->post('rt');
		$in["rw"] = $this->input->post('rw');
		$in["dusun"] = $this->input->post('dusun');
		$this->load->model('Model_select');
		$id_desa = hilangkanpetik($this->input->post('id_desa'));
		$datadesa = $this->Model_select->data_desa($id_desa);
		$id_kec = $datadesa[2];
		$datakec = $this->Model_select->data_kecamatan($id_kec);
		$id_kab = $datakec[2];
		$datakab = $this->Model_select->data_kabupaten($id_kab);
		$id_prov = $datakab[2];
		$dataprov = $this->Model_select->data_provinsi($id_prov);
		$provinsi = $this->Model_select->provinsi();
		$in["desa"] = $datadesa[1];
		$in["id_desa"] = $id_desa;
		$in["kec"] = $datakec[1];
		$in["kab"] = $datakab[1];
		$in["prov"] = $dataprov[1];
		$in["jarak"] = $this->input->post('jarak');
		$in["jenrumah"] = $this->input->post('jenrumah');
		$in["tinggal"] = $this->input->post('tinggal');
		$in["transportasi"] = $this->input->post('transportasi');
		$in["bb"] = $this->input->post('bb');
		$in["tb"] = $this->input->post('tb');
		$in["sakit"] = $this->input->post('sakit');
		$in["jasmani"] = $this->input->post('jasmani');
		$in["nmayah"] = $this->input->post('nmayah');
		$in["alayah"] = $this->input->post('alayah');
		$in["tmpayah"] = $this->input->post('tmpayah');
		$in["agayah"] = $this->input->post('agayah');
		$in["wnayah"] = $this->input->post('wnayah');
		$in["payah"] = $this->input->post('payah');
		$in["dayah"] = $this->input->post('dayah');
		$in["sekayah"] = $this->input->post('sekayah');
		$in["hdpayah"] = $this->input->post('hdpayah');
		$in["thnayah"] = $this->input->post('thnayah');
		$in["nmibu"] = $this->input->post('nmibu');
		$in["alibu"] = $this->input->post('alibu');
		$in["tmpibu"] = $this->input->post('tmpibu');
		$in["agibu"] = $this->input->post('agibu');
		$in["wnibu"] = $this->input->post('wnibu');
		$in["pibu"] = $this->input->post('pibu');
		$in["dibu"] = $this->input->post('dibu');
		$in["sekibu"] = $this->input->post('sekibu');
		$in["hdpibu"] = $this->input->post('hdpibu');
		$in["thnibu"] = $this->input->post('thnibu');
		$in["nmwali"] = $this->input->post('nmwali');
		$in["awali"] = $this->input->post('awali');
		$in["tmpwali"] = $this->input->post('tmpwali');
		$in["agwali"] = $this->input->post('agwali');
		$in["wnwali"] = $this->input->post('wnwali');
		$in["pwali"] = $this->input->post('pwali');
		$in["telepon"] = $this->input->post('telepon');
		$in["kdkls"] = $this->input->post('kdkls');
		$in["pinsek"] = $this->input->post('pinsek');
		$in["alasan"] = $this->input->post('alasan');
		$in["chat_id"] = $this->input->post('chat_id');
		$hp=$this->input->post('hp');
		$in["hp"]=$hp;		
		if (strlen($hp>9))
		{
			$hp = seluler($hp);
			$in["hp"]=$hp;
		}
		$tayah=$this->input->post('tayah');
		$tayah = seluler($tayah);
		$in["tayah"]=$tayah;
		$tibu=$this->input->post('tibu');
		$tibu = seluler($tibu);
		$in["tibu"]=$tibu;
		$twali=$this->input->post('twali');
		$twali = seluler($twali);
		$in["twali"]=$twali;
		$in["dwali"] = $this->input->post('dwali');
		$in["sekwali"] = $this->input->post('sekwali');
		$in["goldarah"] = $this->input->post('goldarah');
		$in["lama"] = $this->input->post('lama');
		$in["kesenian"] = $this->input->post('kesenian');
		$in["olahraga"] = $this->input->post('olahraga');
		$in["organisasi"] = $this->input->post('organisasi');
		$in["lain"] = $this->input->post('lain');
		$in["jalan"] = $this->input->post('jalan');
		$in["cita_cita"] = $this->input->post('cita');
		$in["hobi"] = $this->input->post('hobi');
		$in["dortu"] = $this->input->post('dortu');
		$in["kps"] = $this->input->post('kps');
		$in["pkh"] = $this->input->post('pkh');
		$in["kip"] = $this->input->post('kip');
		$in["kks"] = $this->input->post('kks');
		//$in["ket"] = $this->input->post('ket');
		$in["alamat"] = $in["dusun"];
		if ($in["dusun"]<>$in["desa"])
		{
			$in["alamat"] .= " ".$in["desa"];
		}
		if ($in["desa"]<>$in["kec"])
		{
			$in["alamat"] .= " ".$in["kec"];
		}
		$in["cacah_spm"] = $this->input->post('cacah_spm');
		$in["cacah_mobil"] = $this->input->post('cacah_mobil');
		$in["lantai"] = $this->input->post('lantai');
		$in["dinding"] = $this->input->post('dinding');
		$in["ternak"] = $this->input->post('ternak');
		$in["elektronik"] = $this->input->post('elektronik');
		$in["alamat"] = ucwords(strtolower($in["alamat"]));
		$in["id_ard_siswa"] = $this->input->post('id_ard_siswa');
		if ($in["hdpayah"]=="Ya") {$in["thnayah"]="";}
		if ($in["hdpibu"]=="Ya") {$in["thnibu"]=" ";}
		$pbk['username'] = $this->input->post('nis');
		$pbk['kdkls'] = $this->input->post('kdkls');
		$username = $this->input->post('nis');
		$pbk['nama'] = $this->input->post('nama');
		$pbk['aktif'] = $this->input->post('ket');
		$this->load->model('Admin_model');
		$username = $this->input->post('nis');
		$ada = $this->Admin_model->Cek_Baru($username);
		$ada = $ada->num_rows();
		$pbk["thnajaran"] = cari_thnajaran();
		$pbk["semester"] = cari_semester();
		$this->Admin_model->Add_Contact($pbk,$ada);
		$adadidatsis = $this->Admin_model->Cek_Baru_Datsis($username);
		$adadidatsis = $adadidatsis->num_rows();
		$this->Admin_model->Add_Contact_Datsis($pbk,$adadidatsis);
		$this->load->model('Siswa_model');
		$in["updated"] = 1;
		$in = nopetik($in);
		$this->Siswa_model->Update_Data($in); 
		$nis = $this->input->post('nis');
		redirect('tatausaha/fotosiswa/'.$nis);
	}
	function fotosiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$in=array();
		$nis=$this->uri->segment(3);
		$this->load->model('Admin_model');
		$data['status']= 'Tatausaha';
		$data['judulhalaman'] = 'Rincian Data Siswa';
		$data["nis"]=$nis;
		$data['query']=$this->Admin_model->Tampil_Data_Siswa($nis);
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/detil_siswa_foto',$data);
		$this->load->view('shared/bawah');
	}
	function carisiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Pencarian Siswa';
		$kunci_nama=cegah($this->input->post('nama'));
		if(!empty($kunci_nama))
		{
			redirect('tatausaha/hasilcarisiswa/'.$kunci_nama);
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/cari_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function hasilcarisiswa($kunci_nama=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Hasil Pencarian Siswa';
		$this->load->model('Admin_model');
		$kunci_nama = balikin($kunci_nama);
		if(empty($kunci_nama))
		{
			redirect('tatausaha/carisiswa');
		}
		$kunci_nama = nopetik($kunci_nama);
		$data["kunci_nama"]= $kunci_nama;
		$data['hasilpencarian']=$this->Admin_model->Cari_Siswa($kunci_nama);
		$data['status']='Tatausaha';
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/hasil_cari_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function mutasisiswa()
	{
		$data['judulhalaman'] = 'MUTASI ANTARKELAS';
		$data["nim"]=$this->session->userdata('username');
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
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/mutasi_siswa',$dataisi);
		$this->load->view('shared/bawah');
	}
	function simpanmutasisiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Tatausaha_model');
		$in=array();
		$kelas=$this->input->post('kelas');
		$nis=$this->input->post('nis');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$no_urut = $this->input->post('no_urut');
		$this->Tatausaha_model->Simpan_Mutasi_Siswa($nis,$thnajaran,$semester,$kelas,$no_urut);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/carisiswa'>";
	}
	function siswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Tatausaha_model');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/siswa');
		$this->load->view('shared/bawah');
	}
	function impor($id=null)
	{

		$data["nim"]=$this->session->userdata('username');
		if($id == 'emiss')
		{
			$data['judulhalaman'] = 'Unggah Data Siswa dari EMISS';
		}
		else
		{
			$data['judulhalaman'] = 'Unggah Data Siswa';
		}

		$data['id'] = $id;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/impor_siswa');
		$this->load->view('shared/bawah');
	}
	function siswabaru()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Siswa Baru';
		$thnajaranx = cari_thnajaran();
		$this->load->model('Tatausaha_model');
		$data["thnajaran"]=$thnajaranx;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/siswa_baru',$data);
		$this->load->view('shared/bawah');
	}
	function detilsiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$in=array();
		$nis=$this->uri->segment(3);
		$this->load->model('Admin_model');
		$data['status']='Tatausaha';
		$data["nis"]=$nis;
		$data['query']=$this->Admin_model->Tampil_Data_Siswa($nis);
		$this->load->view('shared/detil_siswa',$data);
	}
	function editsiswa()
	{
		$data['judulhalaman'] = 'Pemutakhiran Data Siswa';
		$data["nim"]=$this->session->userdata('username');
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
		$this->load->model('Model_select');
		$dataisi["query"]=$this->Admin_model->Tampil_Data_Siswa($id);
		$dataisi["nis"]=$id;
		$this->load->model('Siswa_model');
		$dataisi['tdaftar_jarak']=$this->Siswa_model->Daftar_Jarak();
		$dataisi['daftar_ruang']=$this->Siswa_model->Tampilkan_Semua_Kelas();
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->model('Referensi_model','ref');
		$this->load->model('Referensi_model','ref');
		$prov = $this->ref->ambil_nilai('kode_un_provinsi');
		$kab = $this->ref->ambil_nilai('kode_un_kab');
		$sek = $this->ref->ambil_nilai('kode_un_sekolah');
		$dataisi['kode_tambahan_nisn_ard'] = $prov.$kab.$sek;
		$dataisi['kode_tambahan_nis_ard'] = $this->ref->ambil_nilai('kode_tambahan_nis_ard');
		$this->load->view('tatausaha/edit_siswa',$dataisi);
		if(empty($id))
		{
			$this->load->view('shared/bawah');
		}
	}
	function ijazah()
	{
		$data['judulhalaman'] = 'Pemutakhiran Data Siswa Berdasar Ijazah';
		$data["nim"]=$this->session->userdata('username');
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
		$adanis = $this->input->post('nis');
		$dataisi['tersimpan'] = '';
		if(!empty($adanis))
		{
			$in=array();
			$in["nis"] = $this->input->post('nis');
			$in["nisn"] = $this->input->post('nisn');
			$in["nama"] = nopetik(ucwords(strtolower($this->input->post('nama'))));
			$in["tmpt"] = nopetik(ucwords(strtolower($this->input->post('tmpt'))));
			$in["nmortu"] = nopetik(ucwords(strtolower($this->input->post('nmortu'))));
			$in["skhun"] = $this->input->post('skhun');
			$nosttb = $this->input->post('nosttb');
			$nosttb2 = $this->input->post('nosttb2');
			$ijazah = $this->input->post('ijazah');
			$in["sltp"] = nopetik($this->input->post('sltp'));
			$itgllhr = $this->input->post('tgllhr');
			$in["tgllhr"] = tanggal_indonesia_ke_barat($itgllhr);
			$itglsttb = $this->input->post('tglsttb');
			$in["tglsttb"] = tanggal_indonesia_ke_barat($itglsttb);
			$in["ijazah"]= '';
			$in["updated"] = 1;
			if (!empty($nosttb))
			{
				$in["ijazah"]= $ijazah;
				$in["nosttb"] = $nosttb;
			}
			if (!empty($nosttb2))
			{
				$in["ijazah"]= $ijazah;
				$in["nosttb"] = $nosttb2;

			}
			$in["npsn_sltp"] = nopetik($this->input->post('npsn_sltp'));
			$no_blanko_skhun = '';
			$no_blanko_skhun1 = nopetik($this->input->post('no_blanko_skhun'));
			$no_blanko_skhun2 = nopetik($this->input->post('no_blanko_skhun2'));
			if(!empty($no_blanko_skhun1))
			{
				$no_blanko_skhun = $no_blanko_skhun1;
			}
			if(!empty($no_blanko_skhun2))
			{
				$no_blanko_skhun = $no_blanko_skhun2;
			}
			$in["no_blanko_skhun"] = $no_blanko_skhun;
			$this->load->model('Siswa_model');
			$this->Siswa_model->Update_Data($in);
			$dataisi['tersimpan'] = 'oke';
		}
		$dataisi["query"]=$this->Admin_model->Tampil_Data_Siswa($id);
		$dataisi["nis"]=$id;
		$this->load->model('Referensi_model','ref');
		$data['kode_tambahan_nis_ard'] = $this->ref->ambil_nilai('kode_tambahan_nis_ard');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/edit_ijazah',$dataisi);
		$this->load->view('shared/bawah');
	}
	function foto()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unggah Foto Siswa';
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
		$dataisi["nis"]=$id;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/unggah_foto',$dataisi);
		$this->load->view('shared/bawah');
	}
	function updatefotosiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$pesan = '';
		$in=array();
		$this->load->model('Admin_model');
		$config['upload_path'] = $this->config->item('folderfotosiswa');
		$config['allowed_types'] ='bmp|gif|jpg|jpeg|png';
		$namaberkas = $this->config->item('awalttd')."_".$this->input->post('nis');
		$nis = $this->input->post('nis');
		$config['file_name'] = md5($namaberkas);
		$config['max_size'] = '100000';
		$config['max_width'] = '640';
		$config['max_height'] = '480';	
		$config['overwrite'] = TRUE;					
		$this->load->library('upload', $config);
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	$data['pesan'] = '<div class="alert alert-warning">'.$this->upload->display_errors().'</div>';
				$data['modul'] = 'Mengunggah Berkas Foto';
				$data['judulhalaman'] = 'Mengunggah Berkas Foto';
				$data['tautan_balik'] = base_url().'tatausaha/foto/'.$nis;
				$this->load->view('tatausaha/bg_head',$data);
				$this->load->view('shared/adagalat',$data);
				$this->load->view('shared/bawah');

			}
			else 
			{
				$in2["nis"]=$this->input->post('nis');
				$file_ext = strrchr($_FILES['userfile']['name'], '.');
				$namaberkas = $this->config->item('awalttd')."_".$this->input->post('nis');
				$in2["foto"]= ''.md5($namaberkas).''.$file_ext.'';
				$in2["updated"] = 1;
				$this->Admin_model->Update_Foto_Siswa($in2);
				$nis = $this->input->post('nis');
				redirect('tatausaha/fotosiswa/'.$nis);
			}
		}
		else
		{
		redirect('tatausaha/editsiswa/'.$nis);
		}

	}
	function keluar()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Siswa Keluar';
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
		$this->load->model('Tatausaha_model');
		$dataisi["tabel_kode_surat"]=$this->Tatausaha_model->Total_Kode_Surat();
		$dataisi["nis"]=$id;
		$dataisi["thnajaran"]=cari_thnajaran();
		$dataisi["semester"]=cari_semester();
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/keluar',$dataisi);
		$this->load->view('shared/bawah');
	}
	function updatedatasiswakeluar()
	{
		$data["nim"]=$this->session->userdata('username');
		$in=array();
		$in["nis"] = $this->input->post('nis');
		$tanggalkeluar = $this->input->post('tanggalkeluar');
		$in["tanggalkeluar"] = substr($tanggalkeluar,6,4).'-'.substr($tanggalkeluar,3,2).'-'.substr($tanggalkeluar,0,2);
		$bulansurat = substr($tanggalkeluar,3,2);
		$tahunsurat = substr($tanggalkeluar,6,4);
		$in["thnajaran"] = $this->input->post('thnajaran');
		$in["semester"] = $this->input->post('semester');
		$in["nis"] = $this->input->post('nis');
		$in["alasankeluar"] = $this->input->post('alasankeluar');
		$in["sekolahtujuan"] = $this->input->post('sekolahtujuan');
		$in["nosurat"] = $this->input->post('nosurat');
		$in['kdkls'] = nis_ke_kelas_thnajaran_semester($in['nis'],$in['thnajaran'],$in['semester']);
		$in["ket"] = "P";
		$this->load->model('Siswa_model');
		$this->Siswa_model->Update_Data($in);
		$nis = $in["nis"] = $this->input->post('nis');
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$this->Siswa_model->Update_Data_Siswa_Keluar($nis,$thnajaran,$semester);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/fotosiswa/$nis'>";
	}
	function daftarsiswakeluar()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Daftar Siswa Keluar / Pindah / Lulus';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data['daftartahun'] = $query ;
		$data["thnajaran"] = $this->input->post('thnajaran');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/daftar_siswa_keluar',$data);
		$this->load->view('shared/bawah');
	}
	function nilai()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Tatausaha_model');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/nilai');
		$this->load->view('shared/bawah');
	}
	function nilaipesertaun()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Nilai Peserta UN';
		$tahun1 = $this->uri->segment(3);
		$tahun2 = $this->uri->segment(4);
		if(empty($tahun1))
		{
			$datax["thnajaran"] = cari_thnajaran();
		}
		else
		{
			$datax["thnajaran"] = $tahun1.'/'.$tahun2;
		}
		$id_walikelas = $this->uri->segment(5);
		$halaman = $this->uri->segment(6);
		$datax["status"]='tatausaha';
		if ((!empty($datax["thnajaran"])) and (!empty($id_walikelas)))  
		{
			$datax['id_walikelas'] = $this->uri->segment(5);
			$datax['halaman'] = $this->uri->segment(6);
			$data['adamenu'] = '';
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/nilai_data_sma_tampil',$datax);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/nilai_peserta_un',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function skhuns()
	{
		$data["nim"]=$this->session->userdata('username');
		$datax['nis']=$this->input->post('nis');
		$datax["thnajaran"] =  $this->input->post('thnajaran');
		$datax["kelas"] =  $this->input->post('kelas');
		if (!empty($datax['nis']))
		{
			$this->load->view('tatausaha/skhuns_cetak',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/skhuns',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function nilaiakhir()
	{
		$data['judulhalaman'] = 'Unduh Nilai Untuk Ijazah';
		$data["nim"]=$this->session->userdata('username');
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax["kelas"] = $this->input->post('kelas');
		if ((!empty($datax['thnajaran'])) and (!empty($datax['kelas'])))
		{
			$dataxx["kelas"] = $this->input->post('kelas');
			$dataxx["thnajaran"]=$this->input->post('thnajaran');
			$dataxx["mapel"]=$this->input->post('mapel');
			$dataxx['kodeguru'] = $this->input->post('kodeguru');
			$dataxx['cacah'] = $this->input->post('cacah');
			$this->load->view('shared/unduh_nilai_ijazah_csv',$dataxx);
		}
		else
		{
			$this->load->model('Guru_model');
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/nilai_akhir',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function cetakbukurapor($page=null,$tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Buku Rapor';
		$this->load->model('Pengajaran_model');
		$datax['semester']=$semester;
		$datax['tahun1']=$tahun1;
		$datax['id_walikelas'] = $id_walikelas;
		$datax['page'] = $page;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['usere'] = 'tatausaha';
		$data['loncat'] = '';
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/mencetak_buku_lck',$datax);
		$this->load->view('shared/bawah');
	}
	function imporsiswakelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = "Impor Siswa Per Kelas";
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/impor_siswa_kelas');
		$this->load->view('shared/bawah');
	}
	function kelassiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$thnajaranx = cari_thnajaran();
		$this->load->model('Admin_model');
		$tdatsis= $this->Admin_model->Data_Siswa_Kelas($thnajaranx);
		$input=array();
		foreach($tdatsis->result() as $ddatsis)
		{
			$input['kdkls'] = $ddatsis->kelas;
			$input['nis'] = $ddatsis->nis;
			if (($ddatsis->status=='Y') and ($ddatsis->status2=='Y'))
			{
				$input['ket'] = 'Y';
			}
			if (($ddatsis->status=='T') or ($ddatsis->status2=='T'))
			{
				$input['ket'] = 'T';
			}
			$input['nis'] = $ddatsis->nis;
			$this->Admin_model->Update_Kelas($input);
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha'>";
	}
	function imporsiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = "Impor Status Siswa";
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Nis_Terakhir();
		$data["nisterakhir"] ='';
		$data["namasiswa"] ='';
		foreach ($query->result() as $c)
		{
			$data["nisterakhir"]=$c->nis;
			$data["namasiswa"]=$c->nama;  
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/impor_status_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function proses_impor_status_siswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Proses Pemutakhiran Status Siswa';
		$this->load->model('Admin_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	echo $this->upload->display_errors();
			}
			else 
			{
				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				$csvData = $this->csvimport->get_array($filePath);	
				$adagalat = 0;
				$pesan = '';
				$n=0;
				foreach($csvData as $field):
					$baris = $n+1;
					$pesan .= 'Baris '.$baris.' Kolom';
					if(isset($field['nis']))
					{
						$pbk['username'] = nopetik($field['nis']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nis';
						$pbk['nis'] = '';
					}
					$username = $field["nis"];			
					if(isset($field['nama']))
					{
						$pbk['nama'] = nopetik($field['nama']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' nama';
						$pbk['nama'] = '';
					}
					if(isset($field['aktif']))
					{
						$pbk['aktif'] = nopetik($field['aktif']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' aktif';
						$pbk['aktif'] = '';
					}
					if(isset($field['thnajaran']))
					{
						$pbk['thnajaran'] = nopetik($field['thnajaran']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' thnajaran';
						$pbk['thnajaran'] = '';
					}
					if(isset($field['semester']))
					{
						$pbk['semester'] = nopetik($field['semester']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' semester';
						$pbk['semester'] = '';
					}
					if(isset($field['kelas']))
					{
						$pbk['kdkls'] = nopetik($field['kelas']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' kelas';
						$pbk['kdkls'] = '';
					}

					if ($adagalat==0)
					{
						$ada = $this->Admin_model->Cek_Baru($username);
						$ada = $ada->num_rows();
						$this->Admin_model->Add_Contact($pbk,$ada);
						$adadidatsis = $this->Admin_model->Cek_Baru_Datsis($username);
						$adadidatsis = $adadidatsis->num_rows();
						$this->Admin_model->Add_Contact_Datsis($pbk,$adadidatsis);
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink($filePath);
				$datay['modul'] = 'Impor Status Siswa';
				$datay['tautan_balik'] = ''.base_url().'tatausaha/imporsiswa';
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$this->load->view('tatausaha/bg_head',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/daftarsiswakeluar'>";
				}
			} //akhir kalau tidak error upload
		} // akhir kalau ada file terkirim
	}//kalau tatausaha
	function daftarekstra()
	{
		$data["nim"]=$this->session->userdata('username');
		$aksi=$this->uri->segment(3);
		$page=$this->uri->segment(4);
		$this->load->model('Admin_model');
		$namaekstra=$this->input->post('namaekstra');
		if(isset($namaekstra))
		{
			$in['namaekstra']=$this->input->post('namaekstra');
			$in['id_ekstra'] =$this->input->post('id_ekstra');
			$in['school_extracurricular_id'] =$this->input->post('school_extracurricular_id');
			$in = hilangkanpetik($in);
			if(!empty($in['id_ekstra']))
				{
				$this->Admin_model->Update_Ekstra($in);
				}
				else
				{
				$this->Admin_model->Simpan_ekstra($in);
				}
		}
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_ekstra($page);
			redirect('tatausaha/daftarekstra');
		}
		elseif($aksi == 'tambah')
		{
			$data['judulhalaman'] = 'Tambah Kegiatan Ekstrakurikuler';
	       		$data_isi = '';
			$data['aksi'] = 'tambah';
		}
		elseif($aksi == 'ubah')
		{
			$id=$this->uri->segment(4);
			$det=$this->Admin_model->Edit_Ekstra($id);
			$adatet = $det->num_rows();
			$data['adadata'] = $adatet;
			$data['det'] = $det;
			$data['judulhalaman'] = 'Ubah Kegiatan Ekstrakurikuler';
			$data['aksi'] = 'ubah';
	       		$data_isi = '';
		}
		else
		{
			$data['aksi'] = '';
			$data['judulhalaman'] = 'Daftar Kegiatan Ekstrakurikuler';
			$tampilsemuaekstra=$this->Admin_model->Tampil_Semua_Ekstra();
	       		$data_isi = array('query' => $tampilsemuaekstra);
		}
		$this->load->model('Referensi_model','ref');
		$data['url_ard_unduh'] = $this->ref->ambil_nilai('url_ard_unduh');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/daftar_ekstra',$data_isi);
		$this->load->view('shared/bawah');

	}
	function hapusekstra()
	{
		$data["nim"]=$this->session->userdata('username');
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
		$this->load->model('Admin_model');
		$this->Admin_model->Hapus_ekstra($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/daftarekstra'>";
	}
	function ekstrawajib()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Ekstrakurikuler Wajib';
		$data['loncat'] = '';
		$id = $this->uri->segment(4);
		$aksi = $this->uri->segment(3);
		if($aksi == 'hapus')
		{
			$this->load->model('Admin_model');
			$this->Admin_model->Hapus_Ekstra_Wajib_Kelas($id);
		}

		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
		$data['namaekstra']=$this->input->post('namaekstra');
		$data['thnajaran']=cari_thnajaran();
		$data['semester']=cari_semester();
		$data['daftar_nama_ekstra_wajib']= $this->Admin_model->Daftar_Nama_Ekstra_Wajib();
		$data['data_ekstra_wajib']=$this->Admin_model->Daftar_Ekstra_Wajib($data['thnajaran'],$data['semester']);
		$kelas = $this->input->post('kelas');
		$namaekstra=$this->input->post('namaekstra');
		$thnajaran=cari_thnajaran();
		$semester=cari_semester();
		if ((!empty($kelas)) and (!empty($namaekstra)))
		{
			$in = array();
			$in["kelas"] = $kelas;
			$in["namaekstra"]=$namaekstra;
			$in["thnajaran"]=cari_thnajaran();
			$in["semester"]=cari_semester();
			$this->Admin_model->Simpan_Ekstra_Wajib_Kelas($in);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/ekstrawajib'>";
		}
		elseif ($aksi=='proses')
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/proses_ekstra_wajib',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/ekstrawajib',$data);
			$this->load->view('shared/bawah');
		}
	}
	function pengampuekstra()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pengampus Ekstrakurikuler';
		$aksi = $this->uri->segment(3);
    		$id = $this->uri->segment(4);
		$this->load->model('Admin_model');
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Pengampu_Ekstra($id);
			redirect('tatausaha/pengampuekstra');
		}


		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$data['kelas']=$this->input->post('kelas');
		$data['kodeguru']=$this->input->post('kodeguru');
		$data['namaekstra']=$this->input->post('namaekstra');
		$data['thnajaran']=cari_thnajaran();
		$data['semester']=cari_semester();
		$data['daftar_tahun']= $this->Admin_model->Tampil_Semua_Tahun();
		$data['daftar_kelas']= $this->Admin_model->Tampil_Semua_Kelas();
		$data['daftar_nama_ekstra']= $this->Admin_model->Daftar_Nama_Ekstra();
		$data['daftar_semua_guru']= $this->Admin_model->Daftar_Semua_Guru();
		$data['pengampu_ekstra']=$this->Admin_model->Daftar_Pengampu_Ekstra($data['thnajaran'],$data['semester']);
		$kelas = $this->input->post('kelas');
		$namaekstra=$this->input->post('namaekstra');
		$thnajaran=cari_thnajaran();
		$semester=cari_semester();
		$kodeguru = $this->input->post('kodeguru');
		if ((!empty($kelas)) and (!empty($namaekstra)) and (!empty($kodeguru)))
		{
			$in = array();
			$in["kelas"] = $kelas;
			$in["namaekstra"]=$namaekstra;
			$in["thnajaran"]=cari_thnajaran();
			$in["semester"]=cari_semester();
			$in["kodeguru"]=$kodeguru;
			$this->Admin_model->Simpan_Pengampu_Ekstra($in);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/pengampuekstra'>";
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/pengampuekstra',$data);
			$this->load->view('shared/bawah');
		}
	}

	function hapussiswakelas()
	{
		$data["nim"]=$this->session->userdata('username');
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
		$this->load->model('Admin_model');
		$this->Admin_model->Hapus_Siswa_Kelas($id);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/siswakelas'>";
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
		$semester = $this->input->post('semester');
		$thnajaran = $this->input->post('thnajaran');
		$kelas = $this->input->post('kelas');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/unduh_siswa_kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function statistik()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data_isi['semester'] = $this->input->post('semester');
		$data_isi['thnajaran'] = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$thnajaran = $this->input->post('thnajaran');
		$kelas = $this->input->post('kelas');
		if ((!empty($thnajaran)) and (!empty($semester))) 
		{
			$this->load->view('tatausaha/statistik_tampil',$data_isi);
		}
		else
		{
			$this->load->model('Admin_model');
        		$data_isi['daftartahun'] = $this->Admin_model->Tampil_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/statistik',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function nilaiakhirmapel()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Nilai Untuk Ijazah Per Mapel';
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax["kelas"] = $this->input->post('kelas');
		$datax["mapel"] = $this->input->post('mapel');
		if ((!empty($datax['thnajaran'])) and (!empty($datax['kelas'])) and (!empty($datax['mapel'])))
		{
			$dataxx["kelas"] = $this->input->post('kelas');
			$dataxx["thnajaran"]=$this->input->post('thnajaran');
			$dataxx["mapel"]=$this->input->post('mapel');
			$this->load->view('shared/unduh_nilai_ijazah_mapel_csv',$dataxx);
		}
		else
		{
			$this->load->model('Guru_model');
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/nilai_akhir_mapel',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function nilaiunijazah()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai UN untuk Ijazah';
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax["kelas"] = $this->input->post('kelas');
		$dataxx["versi"] = $this->input->post('versi');
		if ((!empty($datax['thnajaran'])) and (!empty($datax['kelas'])))
		{
			$dataxx["kelas"] = $this->input->post('kelas');
			$dataxx["thnajaran"]=$this->input->post('thnajaran');
			$this->load->view('shared/unduh_nilai_ujian_nasional_csv',$dataxx);
		}
		else
		{
			$this->load->model('Guru_model');
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/nilai_ujian_nasional',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function lcksiswa()
	{
		$data["nim"]=$this->session->userdata('username');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$this->load->library('fpdf');
		$data['nis']=$this->uri->segment(3);
		$this->load->view('pdf/cetak_lck_siswa',$data);
	}
	function lhbsiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Rapor Siswa';
		$data['nis']=$this->uri->segment(3);
		$data['lhb']=$this->uri->segment(4);
		$this->load->model('Helper_model','helper');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/lhb_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function kartuaksesinternet()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['nis']=$this->uri->segment(3);
		$this->load->view('tatausaha/kartu_akses_internet',$data);
	}
	function kartuosis()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->view('tatausaha/kartu_osis');
	}
	function proses_impor_siswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data=array();
		$this->load->model('Tatausaha_model');
		$this->load->library('csvimport');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	echo $this->upload->display_errors();
			}
			else 
			{

				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				if ($this->csvimport->get_array($filePath))
				{
					$csvData = $this->csvimport->get_array($filePath);
					$n=0;
					foreach($csvData as $field):
						$psw = $field["nomor_pendaftaran"];
						$options = array('cost' => 8);
						if(!empty($psw))
						{
							$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
						}
						$pbk2['password'] = $psw;
						$pbk2['username']=$field["nis"];			
						$username = $field["nis"];			
						$pbk2['nama'] = nopetik($field["nama"]);
						$pbk2['aktif'] = "Y";
						if(!empty($username))
						{
							$ada = $this->Tatausaha_model->Cek_Baru($username);
							$ada = $ada->num_rows();
							$this->Tatausaha_model->Add_Contact($pbk2,$ada);
							$adadidatsis = $this->Tatausaha_model->Cek_Baru_Datsis($username);
							$adadidatsis = $adadidatsis->num_rows();
							$this->Tatausaha_model->Add_Contact_Datsis($pbk2,$adadidatsis);
							$pbk['nis']=$field["nis"];
							$pbk['nomor_pendaftaran']=$field["nomor_pendaftaran"];
							$pbk['tglditerima']=$field["tglditerima"];
							$kelas = $field["kelas"];
							if(empty($field["kelas"]))
							{
								$kelas = 'X-';
							}
							$pbk['kls']= $kelas;
							$pbk['ket']='Y';
							$this->Tatausaha_model->Perbarui_Data_Siswa_Baru($pbk);
							$pbk3['thnajaran'] = $thnajaran;
							$pbk3['kelas'] = $kelas;
							$pbk3['nis'] = $field["nis"];			
							$pbk3['status'] = 'Y';
							$pbk3['semester'] = $semester;
							$pbk3['no_urut'] = $field["no_urut"];
							$this->load->model('Admin_model');
							$tada = $this->Admin_model->Cek_Baru_Siswa_Kelas($thnajaran,$semester,$pbk['nis']);
							$ada = $tada->num_rows();
							$this->Admin_model->Add_Siswa_Kelas($pbk3,$ada);
						}
						$n++;
					endforeach;
				unlink($filePath);
				redirect('ambilppdb/unduhlagi');
				}
				else
				{
					echo 'galat impor';
				}
			}
		}
	}
	function proses_impor_siswa_kelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data = array();
		$this->load->model('Admin_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	echo $this->upload->display_errors();
			}
			else 
			{
				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				if ($this->csvimport->get_array($filePath))
				{
					$csvData = $this->csvimport->get_array($filePath);	
					$n=0;
					foreach($csvData as $field):
					$pbk['thnajaran'] = $field["thnajaran"];
					$pbk['kelas'] = $field["kelas"];
					$pbk['nis'] = $field["nis"];			
					$pbk['status'] = $field["status"];
					$pbk['semester'] = $field["semester"];
					$pbk['no_urut'] = $field["no_urut"];
					$kelas = $pbk['kelas'];			
					$ada = $this->Admin_model->Cek_Baru_Siswa_Kelas($pbk['thnajaran'],$pbk['semester'],$pbk['nis']);
					$ada = $ada->num_rows();
					$this->Admin_model->Add_Siswa_Kelas($pbk,$ada);
					$n++;
					endforeach;
					unlink($filePath);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/siswakelas'>";
				}
			}
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/imporsiswakelas'>";
		}
	}
	function entrynilaisiswapindahan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data = array();
		$tgl = " %Y-%m-%d";
		$jam = "%h:%i:%a";
		$time = time();
		$datax['thnajaran']=$this->input->post('thnajaran');
		$datax['semester']=$this->input->post('semester');
		$datax['kelas'] =  $this->input->post('kelas');
		$datax['nis']= $this->input->post('nis');
		$datax['konfirmasi'] = $this->input->post('konfirmasi');
		$datax['namasiswa'] = $this->input->post('namasiswa');
		$this->load->model('Tatausaha_model');
		$datax['daftar_tapel']= $this->Tatausaha_model->Tampilkan_Semua_Tahun();
		$cacahmapel = $this->input->post('cacahmapel');
		if($cacahmapel>0)
		{
			for($i=0;$i<=$cacahmapel;$i++)
			{
				$in['kd'] = $this->input->post('kd_'.$i);
				$in['kog'] = $this->input->post('item_'.$i);
				$in['psi'] = $this->input->post('itempsi_'.$i);
				$in['afektif'] = $this->input->post('itemafe_'.$i);
				$this->Tatausaha_model->Update_Nilai_Siswa_Pindahan($in);
			}
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/nilai_siswa_pindahan',$datax);
		$this->load->view('shared/bawah');
	}
	function supervisi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Hasil Supervisi';
		$this->load->model('Guru_model');
		$data["kodeguru"] = nopetik($this->input->post('kodeguru'));
		$data['thnajaran']=nopetik($this->input->post('thnajaran'));
		$data['semester']=nopetik($this->input->post('semester'));
		$data['supervisor']=nopetik($this->input->post('supervisor'));
		$dicetak=$this->input->post('dicetak');
		if ((!empty($data["kodeguru"])) and (!empty($data['thnajaran'])) and (!empty($data['semester'])))
		{
			$data['tautan_balik'] = 'tatausaha/supervisi';
			$this->load->view('shared/mencetak_supervisi',$data);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/supervisi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function daftarsurat()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Tatausaha_model');
		$dataisi['daftar_tapel']= $this->Tatausaha_model->Tampilkan_Semua_Tahun();
		$dataisi["tahun"] = $this->input->post('tahun');
		$dataisi["tipe"]=$this->input->post('tipe');
		$dataisi["bulan"]=$this->input->post('bulan');
		if((!empty($dataisi["tahun"])) and (!empty($dataisi["tipe"])) and (!empty($dataisi["bulan"])))
		{
			$this->load->view('tatausaha/surat_daftar_tampil',$dataisi);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/surat_daftar',$dataisi);
			$this->load->view('shared/bawah');
		}
	}
	function prosespenjurusan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data=array();
		$data_isi["nis"]=$this->uri->segment(3);
       		$data_isi['tahun1'] = $this->uri->segment(4);
		$data_isi['tautan_balik'] = 'tatausaha';
		$data_isi["kelas"] = $this->input->post('kelas');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/penjurusan_proses',$data_isi);
		$this->load->view('shared/bawah');
	}
	function tambahsiswa()
	{
		$data['judulhalaman'] = 'Tambah Siswa';
		$data["nim"]=$this->session->userdata('username');
		$datax['proses'] = '';
		$datax["nis"]=hilangkanpetik($this->input->post('nis'));
		$username = hilangkanpetik($this->input->post('nis'));
		$namasiswa =nopetik($this->input->post('namasiswa'));
		if((!empty($namasiswa)) and (!empty($username)))
		{
			$this->load->model('Admin_model');
			$ada = $this->Admin_model->Cek_Baru($username);
			$ada = $ada->num_rows();
			$pbk["thnajaran"] = cari_thnajaran();
			$pbk["semester"] = cari_semester();
			$pbk["aktif"] = 'Y';
			$pbk["nama"] = $namasiswa;
			$pbk["username"] = $username;
			$this->Admin_model->Add_Contact($pbk,$ada);
			$adadidatsis = $this->Admin_model->Cek_Baru_Datsis($username);
			$adadidatsis = $adadidatsis->num_rows();
			$this->Admin_model->Add_Contact_Datsis($pbk,$adadidatsis);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/mutasisiswa/".$username."'>";
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/siswa_tambah',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function nilaiuambn()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Nilai UAMBN';
		$data['loncat'] = '';
		$tahun1 = $this->uri->segment(3);
		$tahun2 = $this->uri->segment(4);
		if(empty($tahun1))
		{
			$datax["thnajaran"] = cari_thnajaran();
		}
		else
		{
			$datax["thnajaran"] = $tahun1.'/'.$tahun2;
		}
		$id_walikelas = $this->uri->segment(5);
		$halaman = $this->uri->segment(6);
		$datax["status"]='tatausaha';
		if ((!empty($datax["thnajaran"])) and (!empty($id_walikelas)))  
		{
			$datax['id_walikelas'] = $this->uri->segment(5);
			$this->load->view('shared/unduh_nilai_uambn_csv',$datax);
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/nilai_uambn',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function imporekstra()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Impor Nilai Ekstrakurikuler';
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/impor_ekstra');
		$this->load->view('shared/bawah');
	}
	function proses_impor_ekstra()
	{
		$this->load->model('Admin_model');
		$this->load->library('csvimport');
		$filePath = $_FILES["csvfile"]["tmp_name"];
		$csvData = $this->csvimport->get_array($filePath);		
		$n=0;
		foreach($csvData as $field):
			$pbk['thnajaran'] = $field["thnajaran"];
			$pbk['semester'] = $field["semester"];
			$pbk['kelas'] = $field["kelas"];
			$pbk['nis'] = $field["nis"];
			$pbk['nama_ekstra'] = $field["nama_ekstra"];
			$pbk['nilai'] = $field["nilai"];
			$pbk['keterangan'] = $field["keterangan"];
			$ada = $this->Admin_model->Cek_Nilai_Ekstra($pbk['thnajaran'],$pbk['semester'],$pbk['nis'],$pbk['nama_ekstra']);
			$ada = $ada->num_rows();
			$this->Admin_model->Add_Nilai_Ekstra($pbk,$ada);
			$n++;
		endforeach;
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/imporekstra'>";
	}
	function pkgtahun($page=null,$aksi=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Tahun Penilaian SKP / PKG';
		$this->load->model('Tatausaha_model');
		$this->load->library('Pagination');	
      		$limit_ti=8;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$tahun=$this->input->post('tahun');
		$awal=$this->input->post('awal');
		$akhir=$this->input->post('akhir');
		$aktif=$this->input->post('aktif');
		$id_masa=$this->input->post('id_masa');
		if ((!empty($tahun)) and (!empty($awal)) and (!empty($akhir)))
			{
			$datax['tahun']=$this->input->post('tahun');
			$datax['awal']=tanggal_indonesia_ke_barat($this->input->post('awal'));
			$datax['akhir']=tanggal_indonesia_ke_barat($this->input->post('akhir'));
			$datax['aktif']=$this->input->post('aktif');
			$datax['tpejabat']=tanggal_indonesia_ke_barat($this->input->post('tpejabat'));
			$datax['tybs']=tanggal_indonesia_ke_barat($this->input->post('tybs'));
			$datax['tatasanpejabat']=tanggal_indonesia_ke_barat($this->input->post('tatasanpejabat'));
			$datax['tskp']=tanggal_indonesia_ke_barat($this->input->post('tskp'));
			$datax['tpenilaian']=tanggal_indonesia_ke_barat($this->input->post('tpenilaian'));

			if (empty($id_masa))
				{
				$this->Tatausaha_model->Simpan_Tahun_Penilaian($datax);
				}
				else
				{
				$datax['id_masa']=$this->input->post('id_masa');
				$this->Tatausaha_model->Ubah_Tahun_Penilaian($datax);
				}

			}
		$query=$this->Tatausaha_model->Tampil_Semua_Tahun_Penilaian($limit_ti,$offset_ti);
		$tot_hal = $this->Tatausaha_model->Total_Tahun_Penilaian();
      		$config['base_url'] = base_url() . 'tatausaha/pkgtahun';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
        	$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page, 'aksi'=>$aksi, 'id'=>$id);
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/tahun_penilaian',$data_isi);
		$this->load->view('shared/bawah');
	}
	function anggotaperpustakaan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
	    	$id = $this->uri->segment(3);
		if (empty($id))
		{
			$this->load->library('excel');
			$this->load->view('tatausaha/anggota_perpustakaan');
		}
		else
		{
			$this->load->view('tatausaha/anggota_perpustakaan_csv');
		}
	}
	function siswapadamu()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$this->load->library('excel');
		$this->load->view('shared/siswa_padamu_xls','');
	}
	function unggahdatasiswapadamu()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Unggah Kode Siswa dari Padamu';
		$this->load->model('Tatausaha_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		$pesan = '';
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	$data['pesan'] = $this->upload->display_errors();
				$data['modul'] = 'Unggah Kode Siswa dari Padamu';
				$data['tautan_balik'] = base_url().'tatausaha/unggahdatasiswapadamu';
				$this->load->view('tatausaha/bg_head',$data);
				$this->load->view('shared/adagalat',$data);
				$this->load->view('shared/bawah');

			}
			else 
			{
				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				if ($this->csvimport->get_array($filePath))
				{
					$csvData = $this->csvimport->get_array($filePath);	
					$adagalat = 0;
					$n=0;
					foreach($csvData as $field):
						$baris = $n+1;
						$pesan .= 'Baris '.$baris.' Kolom';
						if(isset($field['NO INDUK']))
						{
							$pbk['nis'] = hilangkanpetik($field['NO INDUK']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' NO INDUK';
							$pbk['nis'] = '';
						}
						if(isset($field['KODE SISTEM']))
						{
							$pbk['kodepadamu'] = hilangkanpetik($field['KODE SISTEM']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' KODE SISTEM';
							$pbk['kodepadamu'] = '';
						}
						if ($adagalat==0)
						{
							$this->Tatausaha_model->Update_Kode_Padamu_Siswa($pbk);
						}
						$pesan .= ' TIDAK ADA<br />';
						$n++;
					endforeach;
					unlink($filePath);
					$datay['modul'] = 'Unggah Kode Sistem Siswa Padamu';
					$datay['tautan_balik'] = ''.base_url().'tatausaha/unggahdatasiswapadamu';
					$datay['pesan'] = $pesan;
					if($adagalat==1)
					{
						$this->load->view('tatausaha/bg_head',$data);
						$this->load->view('guru/adagalat',$datay);
						$this->load->view('shared/bawah',$data);
					}
					else	
					{
						$data['sukses'] = '';
						$this->load->view('tatausaha/bg_head',$data);
						$this->load->view('tatausaha/kode_siswa_padamu',$data);
						$this->load->view('shared/bawah',$data);

					}
				}

			}
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/kode_siswa_padamu',$data);
			$this->load->view('shared/bawah');
		}
	}
	function emiss()
	{
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$id = $this->uri->segment(3);
		if($id=='siswa')
		{
			$this->load->library('excel');
			$this->load->view('shared/emiss_siswa_xls',$data);
		}
		elseif($id=='siswaard')
		{
			$this->load->model('Referensi_model','ref');
			$prov = $this->ref->ambil_nilai('kode_un_provinsi');
			$kab = $this->ref->ambil_nilai('kode_un_kab');
			$sek = $this->ref->ambil_nilai('kode_un_sekolah');
			$data['depan'] = $prov.$kab.$sek;
			$this->load->library('excel');
			$this->load->view('shared/ard_siswa_xls',$data);
		}
		elseif($id=='siswacsv')
		{
			$this->load->view('shared/emiss_siswa_csv',$data);
		}
		elseif($id=='personal')
		{
			$this->load->library('excel');
			$this->load->view('shared/emiss_personal_xls',$data);
		}
		else
		{
			$this->load->view('tatausaha/emiss',$data);
		}
	}
	function umum($kd=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Data Pegawai / Guru';
		$usernamepegawai = $kd;
		$in["kd"]=$usernamepegawai;
		$in["status_kepegawaian"]=$this->input->post('status_kepegawaian');
		$in["jabatan"]=$this->input->post('jabatan');
		$in["nip"]=$this->input->post('nip');
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
		$in["guru"]=$this->input->post('guru');
		$in["ibu"]=$this->input->post('ibu');
		$in["alamatortu"]=$this->input->post('alamatortu');
		$in["alamat"]=$this->input->post('alamat');
		$in["jalan"]=$this->input->post('jalan');
		$in["telpon"]=$this->input->post('telpon');
		$hppegawai=$this->input->post('seluler');
		if (strlen($hppegawai>9))
		{
			$hppegawai = seluler($hppegawai);
			$in["seluler"]=$hppegawai;
		}
		else
		{
			$in["seluler"]= '';
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
		//kip-mm-dd
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
		$this->load->model('Model_select');
		$id_desa = hilangkanpetik($this->input->post('id_desa'));
		$datadesa = $this->Model_select->data_desa($id_desa);
		$id_kec = $datadesa[2];
		$datakec = $this->Model_select->data_kecamatan($id_kec);
		$id_kab = $datakec[2];
		$datakab = $this->Model_select->data_kabupaten($id_kab);
		$id_prov = $datakab[2];
		$dataprov = $this->Model_select->data_provinsi($id_prov);
		$provinsi = $this->Model_select->provinsi();
		$in["desa"] = $datadesa[1];
		$in["id_desa"] = $id_desa;
		$in["kecamatan"] = $datakec[1];
		$in["kabupaten"] = $datakab[1];
		$in["provinsi"] = $dataprov[1];
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
		$harilulus_sertifikasi = $this->input->post('harilulus_sertifikasi');
		$bulanlulus_sertifikasi = $this->input->post('bulanlulus_sertifikasi');
		$tahunlulus_sertifikasi = $this->input->post('tahunlulus_sertifikasi');
		$tgl_lulus_sertifikasi = "$tahunlulus_sertifikasi-$bulanlulus_sertifikasi-$harilulus_sertifikasi";
		$in["tgl_lulus_sertifikasi"]=$tgl_lulus_sertifikasi;
		$in["mapel_sertifikasi"]=$this->input->post('mapel_sertifikasi');
		$in["tugas_pokok"]=$this->input->post('tugas_pokok');
		$in["tugas_utama_non_guru"]=$this->input->post('tugas_utama_non_guru');
		$in["tugas_tambahan_non_guru"]=$this->input->post('tugas_tambahan_non_guru');
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
		$in["chat_id"]=$this->input->post('chat_id');
//				$in[""]=$this->input->post('');
		$nip = $in["nip"];
		$this->load->model('Tatausaha_model');
		$terupdate=$this->input->post('terupdate');
		$data["terupdate"]='';
		if ($terupdate =='oke')
		{
			$this->Tatausaha_model->Update_Data_Umum($in);
			$data["terupdate"]="Data telah Termutakhirkan";
			$this->load->model('Admin_model');
			$config['upload_path'] = 'images/foto_guru_pegawai';
			$config['allowed_types'] ='bmp|gif|jpg|jpeg|png';
			$namafilefoto = $this->config->item('awalttd')."_".$usernamepegawai;
			$config['file_name'] = md5($namafilefoto);
			$config['max_size'] = '100000';
			$config['max_width'] = '320';
			$config['max_height'] = '440';	
			$config['overwrite'] = TRUE;					
			$this->load->library('upload', $config);
			if(!empty($_FILES['userfile']['name']))
			{
				if(!$this->upload->do_upload())
				{
				 	echo $this->upload->display_errors();
				}
				else {
					$in2["kd"]=$usernamepegawai;
					$file_ext = strrchr($_FILES['userfile']['name'], '.');
					$in2["foto"]= ''.md5($namafilefoto).''.$file_ext.'';
					$this->Admin_model->Update_Foto_Guru_Pegawai($in2);
				}
			}
			redirect('tatausaha/ard/umum/'.$kd);
		}
		$data["usernamepegawai"] = $usernamepegawai;
		$data["querypegawai"] = $this->Tatausaha_model->Total_Semua_Pegawai();    
		$data["namapegawai"] = $this->Tatausaha_model->get_Nama($usernamepegawai);    
		$data['query']=$this->Tatausaha_model->Tampil_Data_Umum_Pegawai($usernamepegawai); 
		if (!empty($usernamepegawai))
		{
			$query=$this->Tatausaha_model->Tampil_Data_Umum_Pegawai($usernamepegawai); 
			$ada = $query->num_rows();
			if($ada==0)
			{
				$this->Tatausaha_model->Buat_Data_Umum_Baru($usernamepegawai,$data["namapegawai"]);
				$data['query']=$this->Tatausaha_model->Tampil_Data_Umum_Pegawai($usernamepegawai); 
			}
		}
		$data['loncat'] = '';
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/umum',$data);
		if(empty($kd))
		{
			$this->load->view('shared/bawah');
		}
	}
	function mutasi()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Mutasi';
		$usernamepegawai='';
		$id_p_pegawai = $this->input->post('id_p_pegawai');
		$status=$this->input->post('status');
		if ((!empty($id_p_pegawai)) or (!empty($status)))
		{
			$this->load->model('Tatausaha_model');
			$this->Tatausaha_model->Update_Status($id_p_pegawai,$status);
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/mutasi',$data);
		$this->load->view('shared/bawah');
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
		$data_isi['tautan_balik'] = 'tatausaha';
		$this->load->view('bp/bg_head',$data);
		$this->load->view('shared/data_penerima_bsm',$data_isi);
		$this->load->view('shared/bawah');
	}
	function nomorskbkskmt()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Nomor SKBK / SKMT';
		$thnajaran = cari_thnajaran();
		$semester= cari_semester();
		$this->load->model('Tatausaha_model');
		$nomor_skbk = $this->input->post('nomor_skbk');
		$nomor_skmt = $this->input->post('nomor_skmt');
		if((!empty($nomor_skbk)) and (!empty($nomor_skmt)))
		{
			$in=array();
			$tglsurat = $this->input->post('tglsurat');
			$blnsurat = $this->input->post('blnsurat');
			$thnsurat = $this->input->post('thnsurat');
			$in["tanggal"] = "$thnsurat-$blnsurat-$tglsurat";
			$nomor_aktif = $this->input->post('nomor_aktif');
			$kode_surat = $this->input->post('kode_surat');
			$thnsurat = $this->input->post('thnsurat');
			$in["thnajaran"] = $this->input->post('thnajaran');
			$in["semester"] = $this->input->post('semester');
			$in["nomor_skbk"] = $nomor_skbk;
			$in["nomor_skmt"] = $nomor_skmt;
			$in["nomor_aktif"] = $nomor_aktif;
			$in["nama_pengawas"] = $this->input->post('nama_pengawas');
			$in["nip"] = $this->input->post('nip_pengawas');
			$tglsurataktif = $this->input->post('tglsurataktif');
			$blnsurataktif = $this->input->post('blnsurataktif');
			$thnsurataktif = $this->input->post('thnsurataktif');
			$in["tanggal_aktif"] = "$thnsurataktif-$blnsurataktif-$tglsurataktif";
			$tnomorskbkskmt = $this->Tatausaha_model->Cek_Nomor_Skbk_Skmt($in);
			$ada = $tnomorskbkskmt->num_rows();
			$this->Tatausaha_model->Simpan_Nomor_Skbk_Skmt($in,$ada);
		}
		$dataisi["id_nomor_skbk"] = $this->uri->segment(3);
		$dataisi["tabel_kode_surat"]=$this->Tatausaha_model->Total_Kode_Surat();
		$dataisi["tabel_nomor_skbk_skmt"]=$this->Tatausaha_model->Tampil_Skbk_Skmt($thnajaran);
		$dataisi["thnajaran"]=$thnajaran;
		$dataisi["semester"]=$semester;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/nomor_skbk_skmt',$dataisi);
		$this->load->view('shared/bawah');
	}
	function bos()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Mencetak Borang BOS';
		$datax['status'] = 'tatausaha';
		$tahun1 = $this->uri->segment(3);
		$semester = $this->uri->segment(4);
		$borang = $this->uri->segment(5);
		if(empty($tahun1))
		{
			$tahun1 = substr(cari_thnajaran(),0,4);
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		$datax['tahun1'] = $tahun1;
		$datax['semester'] = $semester;
		$data['borang'] = $borang;
		if((!empty($tahun1)) and (!empty($semester)) and (!empty($borang)))
		{
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$this->load->library('fpdf');
			if($borang == 'bos2c') 
			{
				$this->load->view('pdf/bos2c',$datax);
			}
			elseif($borang == 'bos02a') 
			{
				$this->load->view('pdf/bos02a',$datax);
			}
			else
			{
			redirect('bos/'.$tahun1);
			}
		}
		else
		{
			$this->load->model('Guru_model');
			$datax['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/bos',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function pejabatpenilaippk($aksi=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Pejabat Penilai PPK';
		$this->load->model('Tatausaha_model');
		$this->load->helper(array('pkg_helper'));
		$tahun=cari_tahun_penilaian();
		$proses = nopetik($this->input->post('proses'));
		$datax['dinilai'] = nopetik($this->input->post('dinilai'));
		$datax['nama_penilai'] = nopetik($this->input->post('nama_penilai'));
		$datax['nip_penilai'] = nopetik($this->input->post('nip_penilai'));
		$datax['pangkat_golongan'] = nopetik($this->input->post('pangkat_golongan'));
		$datax['jabatan'] = nopetik($this->input->post('jabatan'));
		$datax['unit_organisasi'] = nopetik($this->input->post('unit_organisasi'));
		$datax['nama_atasan'] = nopetik($this->input->post('nama_atasan'));
		$datax['nip_atasan'] = nopetik($this->input->post('nip_atasan'));
		$datax['pangkat_golongan_atasan'] = nopetik($this->input->post('pangkat_golongan_atasan'));
		$datax['jabatan_atasan'] = nopetik($this->input->post('jabatan_atasan'));
		$datax['unit_organisasi_atasan'] = nopetik($this->input->post('unit_organisasi_atasan'));
		$datax['id_pejabat'] = nopetik($this->input->post('id_pejabat'));
		$datax['tahun'] = nopetik($tahun);
		if ($proses == 'oke')
		{
			if (empty($datax['id_pejabat']))
			{
				$this->Tatausaha_model->Simpan_Pejabat_Penilai($datax);
			}
			else
			{
				$this->Tatausaha_model->Ubah_Pejabat_Penilai($datax);
			}
		}
		if ($aksi == 'hapus')
		{
			$this->Tatausaha_model->Hapus_Pejabat_Penilai($id);
			redirect('tatausaha/pejabatpenilaippk');
		}
		$query=$this->Tatausaha_model->Tampil_Pejabat_Penilai($tahun);
        	$data_isi = array('query' => $query, 'aksi'=>$aksi, 'id'=>$id,'tahun'=>$tahun);
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/pejabat_penilai_prestasi_kerja',$data_isi);
		$this->load->view('shared/bawah');
	}
	function pkg()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Mencetak PKG';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$thnpkg=$this->uri->segment(3);
		$kodeguru=$this->uri->segment(4);
		if ((!empty($kodeguru)) and (!empty($thnpkg)))
		{
			redirect('pdf_report/pkg/'.$thnpkg.'/'.$kodeguru);
		}
		else
		{
			$data['tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$data['thnpkg'] = $thnpkg;
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/form_mencetak_penilaian_kinerja_guru_2',$data);
			$this->load->view('shared/bawah');
		}
	}
	function cetakpkg()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Mencetak PKG';
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['thnpkg']=$this->input->post('thnpkg');
		if ((!empty($data["kodeguru"])) and (!empty($data['thnpkg'])))
		{
			$data['tautan'] = 'tatausaha';
			$this->load->view('guru/mencetak_penilaian_kinerja_guru',$data);
		}
		else
		{
			$data['tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/form_mencetak_penilaian_kinerja_guru',$data);
			$this->load->view('shared/bawah');
		}
	}

	function cetakpkgtambahan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Mencatak PKG dengan Tugas Tambahan';
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['thnpkg']=$this->input->post('thnpkg');
		if ((!empty($data["kodeguru"])) and (!empty($data['thnpkg'])))
		{
			$this->load->view('tatausaha/mencetak_penilaian_kinerja_guru_tambahan',$data);
		}
		else
		{
			$data['tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/form_mencetak_penilaian_kinerja_guru_tambahan',$data);
			$this->load->view('shared/bawah');
		}
	}
	function cetakppkpns()
	{
		$this->load->helper('pkg');
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Mencetak PPK';
		$perilaku=$this->uri->segment(3);
		$this->load->model('Guru_model');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		if ($perilaku=='perilaku')
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/form_mencetak_penilaian_perilaku_pns',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/form_mencetak_penilaian_prestasi_kerja',$data);
			$this->load->view('shared/bawah');
		}
	}
	function cetakskp()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data["judulhalaman"]= 'Mencetak SKP';		
		$datax['tahunpenilaian']=$this->uri->segment(3);
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/form_mencetak_skp',$datax);
		$this->load->view('shared/bawah');
	}
	function unduhrekapppk()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data["judulhalaman"]= 'Unduh Rekap SKP';		
		$tahun=$this->uri->segment(3);
		$datax['tahun']=$tahun;
		if($tahun>0)
		{
			$this->load->library('excel');
			$this->load->view('shared/unduh_rekap_skp',$datax);
		}
		else
		{
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/form_mengunduh_rekap_skp',$datax);
		$this->load->view('shared/bawah');
		}
	}
	function cetakfoto()
	{
		$data["nim"]=$this->session->userdata('username');
		$item=$this->uri->segment(3);
		if($item == 'labelrapor')
		{
			$data['judulhalaman'] = 'Mencetak Label Rapor Siswa Per Kelas';
		}
		else
		{
			$data['judulhalaman'] = 'Mencetak Foto Siswa Per Kelas';
		}

		$this->load->model('Pengajaran_model');
		$datax['semester']=hilangkanpetik($this->input->post('semester'));
		$datax['thnajaran']=hilangkanpetik($this->input->post('thnajaran'));
		$datax['kelas']=hilangkanpetik($this->input->post('kelas'));
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['daftar_kelas']= $this->Pengajaran_model->Tampilkan_Semua_Kelas();
		$datax['item'] = $item;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/cetak_foto_siswa_per_kelas',$datax);
		$this->load->view('shared/bawah');
	}
	function pengampuekstra2()
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Pengampus Ekstrakurikuler';
		$data['loncat'] = '';
		$aksi = $this->uri->segment(3);
    		$id = $this->uri->segment(4);
		$this->load->model('Admin_model');
		$this->load->model('Pengajaran_model');
		if($aksi == 'hapus')
		{
			$this->Admin_model->Hapus_Pengampu_Ekstra($id);
			redirect('tatausaha/pengampuekstra2');
		}
		$data['kodeguru']=$this->input->post('kodeguru');
		$data['namaekstra']=$this->input->post('namaekstra');
		$data['thnajaran']=cari_thnajaran();
		$data['semester']=cari_semester();
		$data['daftar_nama_ekstra']= $this->Admin_model->Daftar_Nama_Ekstra();
		$data['daftar_semua_guru']= $this->Admin_model->Daftar_Semua_Guru();
		$data['pengampu_ekstra']=$this->Admin_model->Daftar_Pengampu_Ekstra($data['thnajaran'],$data['semester']);
		$namaekstra=$this->input->post('namaekstra');
		$thnajaran=cari_thnajaran();
		$semester=cari_semester();
		$kodeguru = $this->input->post('kodeguru');
		$cacah = $this->input->post('cacah');
		$wajib = $this->input->post('wajib');
		if (($cacah > 0) and (!empty($namaekstra)) and (!empty($kodeguru)))
		{
			for($i=1;$i<=$cacah;$i++)
			{
				if($this->input->post("id_kelas_$i") == 1 )
				{
					$kelas = $this->input->post("kelas_$i");
					$in = array();
					$in["kelas"] = $kelas;
					$in["namaekstra"]=$namaekstra;
					$in["thnajaran"]= $thnajaran;
					$in["semester"]= $semester;
					$in["kodeguru"]=$kodeguru;
					$in["wajib"]=$wajib;
					$this->Admin_model->Simpan_Pengampu_Ekstra($in);
				}
			}
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."tatausaha/pengampuekstra2'>";
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/pengampuekstra2',$data);
			$this->load->view('shared/bawah');
		}
	}
	function pesertatesdaring($v = null,$id_walikelas=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Peserta Tes';
		$this->load->helper('string');
		$data['thnajaran']= cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['loncat'] = '';
		$data['id_walikelas'] = $id_walikelas;
		$data['v'] = $v;
		if(!empty($id_walikelas))
		{
			if($v == 'v1')
			{
				$this->load->library('excel');
				$this->load->view('shared/peserta_ubk',$data);

			}
			elseif($v == 'v3')
			{
				$this->load->library('excel');
				$this->load->view('shared/peserta_kelas',$data);

			}
			elseif($v == 'v6')
			{
				$this->load->view('shared/peserta_uambnbk_csv',$data);

			}
			elseif($v == 'v7')
			{
				$this->load->library('excel');
				$this->load->view('shared/peserta_ubk_beesmart',$data);

			}

			elseif($v == 'v4')
			{
				$this->load->library('excel');
				$this->load->view('shared/peserta_mapel',$data);

			}
			elseif($v == 'v5')
			{
				$this->load->library('excel');
				$this->load->view('shared/peserta_beesmart',$data);

			}
			elseif($v == 'v8')
			{
				$this->load->view('shared/peserta_tes_cetak',$data);

			}

			else
			{
				$this->load->view('shared/peserta_tes',$data);
			}

		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/peserta_tes_form',$data);
			$this->load->view('shared/bawah');
		}

	}
	function siswaard($id_walikelas=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Kirim Daftar Siswa Kelas';
		$this->load->helper('string');
		$data['thnajaran']= cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['loncat'] = '';
		$data['id_walikelas'] = $id_walikelas;
		$this->load->model('Referensi_model','ref');
		$data['school_id'] = $this->ref->ambil_nilai('school_id');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('ard/siswa_ard',$data);
		$this->load->view('shared/bawah');
	}
	function kirimdaftarsiswakelas($id_walikelas=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Kirim Daftar Siswa Kelas';
		$this->load->helper('string');
		$data['thnajaran']= cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['loncat'] = '';
		$data['id_walikelas'] = $id_walikelas;
		$this->load->model('Referensi_model','ref');
		$data['school_id'] = $this->ref->ambil_nilai('school_id');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('ard/kirim_siswa_ard',$data);
		$this->load->view('shared/bawah');
	}
	function framekirimdaftarsiswakelas($id_walikelas=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Kirim Daftar Siswa Kelas';
		$this->load->helper('string');
		$data['thnajaran']= cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['loncat'] = '';
		$data['id_walikelas'] = $id_walikelas;
		$this->load->model('Referensi_model','ref');
		$data['school_id'] = $this->ref->ambil_nilai('school_id');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		if(!empty($id_walikelas))
		{
			$data['adamenu'] = '';
			$data['select'] = '';
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('ard/kirim_siswa_ard_frame2',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			echo 'Galat';
		}
	}

	function cetakrekap()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Daftar Riwayat Hidup';
		$usernamepegawai='';
		$this->load->model('Tatausaha_model');
		$usernamepegawai = $this->input->post('usernamepegawai');
		$nip = $usernamepegawai;
		$data["terupdate"]='';
		$data["usernamepegawai"] = $usernamepegawai;
		$data['query']=$this->Tatausaha_model->Tampil_Data_Umum_Pegawai($nip); 
		$data["querypegawai"] = $this->Tatausaha_model->Total_Semua_Pegawai();    
		$data["namapegawai"] = $this->Tatausaha_model->get_Nama($usernamepegawai);    

		if (!empty($usernamepegawai))
		{
			redirect('tatausaha/cetakropeg/'.$nip);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/cetak_rekap',$data);
			$this->load->view('shared/bawah');
		}
	}
	function cetakropeg()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Tatausaha_model');
		$nip=$this->uri->segment(3);
		$data['querykeluarga']=$this->Tatausaha_model->Tampil_Data_Keluarga_Pegawai($nip);
		$data['queryortu']=$this->Tatausaha_model->Tampil_Data_Ortu_Pegawai($nip);
		$data['querymertua']=$this->Tatausaha_model->Tampil_Data_Mertua_Pegawai($nip);
		$data['queryistrisuami']=$this->Tatausaha_model->Tampil_Data_Istri_Suami_Keluarga_Pegawai($nip);
		$data['queryanak']=$this->Tatausaha_model->Tampil_Data_Anak_Pegawai($nip);    
		$data['querykepeg']=$this->Tatausaha_model->Tampil_Data_Kepegawaian_Pegawai($nip); 
		$data['querypendidikan']=$this->Tatausaha_model->Tampil_Riwayat_Pendidikan_Pegawai($nip);
		$data['querydiklat']=$this->Tatausaha_model->Tampil_Data_Diklat_Pegawai($nip);
		$data['querykeluarnegeri']=$this->Tatausaha_model->Tampil_Data_Keluar_Negeri_Pegawai($nip);  
		$data['querypenghargaan']=$this->Tatausaha_model->Tampil_Data_Penghargaan_Pegawai($nip);    
		$data['querykakakadik']=$this->Tatausaha_model->Tampil_Data_Kakak_Adik_Pegawai($nip);
		$data['queryorgslta']=$this->Tatausaha_model->Tampil_Data_Organisasi_SLTA_Pegawai($nip);
		$data['queryorgpt']=$this->Tatausaha_model->Tampil_Data_Organisasi_PT_Pegawai($nip);
		$data['queryorgpegawai']=$this->Tatausaha_model->Tampil_Data_Organisasi_Pegawai_Pegawai($nip);
		$data['queryjabatan']=$this->Tatausaha_model->Tampil_Data_Jabatan_Pegawai($nip);  
		$data['query']=$this->Tatausaha_model->Tampil_Data_Umum_Pegawai($nip); 
		$this->load->view('tatausaha/cetak_ropeg_drh',$data);
	}
	function saran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["judulhalaman"]= 'Kritik / Saran';
		$aksi=$this->uri->segment(3);
		$id_saran=$this->uri->segment(5);
		$page=$this->uri->segment(4);
      		$limit_ti=15;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$this->load->model('Tatausaha_model');
		if($aksi == 'hapus')
		{
			$this->Tatausaha_model->Hapus_Saran($id_saran);
		}
		$this->load->library('Pagination');
		$tampilsemuatu=$this->Tatausaha_model->Tampil_Semua_Saran($limit_ti,$offset_ti);
		$tot_hal = $this->Tatausaha_model->Total_Saran();
      		$config['base_url'] = base_url() . 'tatausaha/saran/tampil';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
       		$data_isi = array('query' => $tampilsemuatu,'paginator'=>$paginator, 'page'=>$page);
		if($aksi == 'cetak')
		{
			$this->load->view('tatausaha/saran_cetak',$data_isi);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/saran',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function proses_impor_siswa_emiss()
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Tatausaha_model');
		$this->load->library('csvimport');
		$this->load->helper('emiss');
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		$pesan = '';
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	$pesan = $this->upload->display_errors();
				$data['judulhalaman'] = 'Unggah Data Siswa dari Emiss';
				$datay['modul'] = 'Unggah Data Siswa dari Emiss';
				$datay['tautan_balik'] = ''.base_url().'tatausaha/impor/emiss';
				$datay['pesan'] = $pesan;
				$this->load->view('tatausaha/bg_head',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);
			}
			else 
			{
				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				if ($this->csvimport->get_array($filePath))
				{
					$csvData = $this->csvimport->get_array($filePath);
					$adagalat = 0;
					$n=0;
					foreach($csvData as $field):
						$baris = $n+1;
						$pesan .= 'Baris '.$baris.' Kolom';
						$psw = '';
						if(isset($field['NIS Lokal']))
						{
							$nis = ambil_nis($field["NIS Lokal"]);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' NIS Lokal';
							$pbk['nis'] = '';
							$nis = '';
						}

						$options = array('cost' => 8);
						if(!empty($nis))
						{
							$psw = password_hash($nis, PASSWORD_BCRYPT, $options);
						}
						$pbk2['password'] = $psw;
						$pbk2['username']=$nis;
						$username = $nis;
						if(isset($field['Nama Siswa']))
						{
							$pbk2['nama'] = nopetik($field["Nama Siswa"]);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' Nama Siswa';
							$pbk2['nama'] = '';
						}
		
						$pbk2['aktif'] = "Y";
						if(!empty($username))
						{
							$ada = $this->Tatausaha_model->Cek_Baru($username);
							$ada = $ada->num_rows();
							$this->Tatausaha_model->Add_Contact($pbk2,$ada);
							$adadidatsis = $this->Tatausaha_model->Cek_Baru_Datsis($username);
							$adadidatsis = $adadidatsis->num_rows();
							$this->Tatausaha_model->Add_Contact_Datsis($pbk2,$adadidatsis);
							$pbk['nis']=$nis;
							if(isset($field['NISN']))
							{
								$pbk['nisn'] = nopetik($field["NISN"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' NISN';
								$pbk['nisn'] = '';
							}
							if(isset($field['Nomor Induk Kependudukan (NIK) Siswa']))
							{
								$pbk['nik'] = nopetik($field["Nomor Induk Kependudukan (NIK) Siswa"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nomor Induk Kependudukan (NIK) Siswa';
								$pbk['nik'] = '';
							}
							if(isset($field['Nama Siswa']))
							{
								$pbk['nama'] = nopetik($field["Nama Siswa"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nama Siswa';
								$pbk['nama'] = '';
							}
							if(isset($field['Tempat Lahir']))
							{
								$pbk['tmpt'] = nopetik($field["Tempat Lahir"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Tempat Lahir';
								$pbk['tmpt'] = '';
							}
							if(isset($field['Tanggal Lahir (dd/mm/yyyy)']))
							{
								$pbk['tgllhr'] =  date_to_en($field["Tanggal Lahir (dd/mm/yyyy)"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Tanggal Lahir (dd/mm/yyyy)';
								$pbk['tgllhr'] = '';
							}
							if(isset($field['Jenis Kelamin']))
							{
							$pbk['jenkel'] = ubah_jenkel($field["Jenis Kelamin"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Jenis Kelamin';
								$pbk['jenkel'] = '';
							}

							$pbk['wn'] = 'Indonesia';
							if(isset($field['Tingkat/Kelas']))
							{
								$kelas = ubah_kelas($field["Tingkat/Kelas"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Tingkat/Kelas';
								$kelas = '';
							}
							if(isset($field['Nomor Absen di Kelas']))
							{
								$nourut = $field["Nomor Absen di Kelas"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nomor Absen di Kelas';
								$nourut = '';
							}
							if(isset($field['No. Kartu Keluarga']))
							{
								$pbk['nokk'] = $field["No. Kartu Keluarga"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' No. Kartu Keluarga';
								$pbk['nokk'] = '';
							}
							if(isset($field['Nomor KKS/KPS']))
							{
								$pbk['kps'] = $field["Nomor KKS/KPS"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nomor KKS/KPS';
								$pbk['kps'] = '';
							}
							if(isset($field['Nomor Kartu PKH']))
							{
								$pbk['pkh'] = $field["Nomor Kartu PKH"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nomor Kartu PKH';
								$pbk['pkh'] = '';
							}
							if(isset($field['Nomor Kartu Indonesia Pintar (KIP)']))
							{
								$pbk['kip'] = $field["Nomor Kartu Indonesia Pintar (KIP)"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nomor Kartu Indonesia Pintar (KIP)';
								$pbk['kip'] = '';
							}
							if(isset($field['Agama Siswa']))
							{
								$pbk['agama'] = ubah_agama($field["Agama Siswa"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Agama Siswa';
								$pbk['agama'] = '';
							}
							if(isset($field['Hobi']))
							{
								$pbk['hobi'] = ubah_hobi($field["Hobi"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Hobi';
								$pbk['hobi'] = '';
							}
							if(isset($field['Diterima di kelas X']))
							{
								$pbk['kls'] = $field["Diterima di kelas X"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Diterima di kelas X';
								$pbk['kls'] = '';
							}
							//$pbk['kdkls'] = $kelas;
							if(isset($field['Cita-Cita']))
							{
								$pbk['cita_cita'] = ubah_cita($field["Cita-Cita"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Cita-Cita';
								$pbk['cita_cita'] = '';
							}
							if(isset($field['Jumlah Saudara']))
							{
								$pbk['kandung'] = $field["Jumlah Saudara"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Jumlah Saudara';
								$pbk['kandung'] = '';
							}
							if(isset($field['Jenis Sekolah']))
							{
								$pbk['sltpasal'] = $field["Jenis Sekolah"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Jenis Sekolah';
								$pbk['sltpasal'] = '';
							}
							if(isset($field['Nomor Peserta UN pada Jenjang Sebelumnya (SMP/MTs)']))
							{
								$pbk['skhun'] = $field["Nomor Peserta UN pada Jenjang Sebelumnya (SMP/MTs)"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nomor Peserta UN pada Jenjang Sebelumnya (SMP/MTs)';
								$pbk['skhun'] = '';
							}
							if(isset($field['Alamat']))
							{
								$pbk['alamat'] = $field["Alamat"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Alamat';
								$pbk['alamat'] = '';
							}
							if(isset($field['Provinsi']))
							{
								$pbk['prov'] = $field["Provinsi"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Provinsi';
								$pbk['prov'] = '';
							}
							if(isset($field['Kab./Kota']))
							{
								$pbk['kab'] = $field["Kab./Kota"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Kab./Kota';
								$pbk['kab'] = '';
							}
							if(isset($field['Kecamatan']))
							{
								$pbk['kec'] = $field["Kecamatan"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Kecamatan';
								$pbk['kec'] = '';
							}
							if(isset($field['Desa/Kelurahan']))
							{
								$pbk['desa'] = $field["Desa/Kelurahan"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Desa/Kelurahan';
								$pbk['desa'] = '';
							}
							if(isset($field['Kode Pos']))
							{
								$pbk['kodepos'] = $field["Kode Pos"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Kode Pos';
								$pbk['kodepos'] = '';
							}
							if(isset($field['Status Sekolah']))
							{
								$pbk['jenis_sltp'] = $field["Status Sekolah"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Status Sekolah';
								$pbk['jenis_sltp'] = '';
							}
							if(isset($field['Kabupaten/Kota Lokasi Sekolah']))
							{
								$pbk['kota_sltp'] = $field["Kabupaten/Kota Lokasi Sekolah"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Kabupaten/Kota Lokasi Sekolah';
								$pbk['kota_sltp'] = '';
							}
							if(isset($field['Jarak Tempat Tinggal Siswa Ke Madrasah']))
							{
								$pbk['jarak'] = ubah_jarak($field["Jarak Tempat Tinggal Siswa Ke Madrasah"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Jarak Tempat Tinggal Siswa Ke Madrasah';
								$pbk['jarak'] = '';
							}

							if(isset($field['Transportasi dari Tempat Tinggal Siswa ke Madrasah']))
							{
								$pbk['transportasi'] = ubah_transportasi($field["Transportasi dari Tempat Tinggal Siswa ke Madrasah"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Transportasi dari Tempat Tinggal Siswa ke Madrasah';
								$pbk['transportasi'] = '';
							}
							if(isset($field['Nama Lengkap Ayah']))
							{
								$pbk['nmayah'] = $field["Nama Lengkap Ayah"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nama Lengkap Ayah';
								$pbk['nmayah'] = '';
							}
							if(isset($field['NIK/Nomor KTP Ayah']))
							{
								$pbk['nik_kk'] = $field["NIK/Nomor KTP Ayah"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' NIK/Nomor KTP Ayah';
								$pbk['nik_kk'] = '';
							}
							if(isset($field['Pendidikan Ayah']))
							{
								$pbk['sekayah'] = ubah_pendidikan($field["Pendidikan Ayah"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Pendidikan Ayah';
								$pbk['sekayah'] = '';
							}
							if(isset($field['Pekerjaan Ayah']))
							{
								$pbk['payah'] = ubah_pekerjaan($field["Pekerjaan Ayah"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Pekerjaan Ayah';
								$pbk['payah'] = '';
							}
							if(isset($field['Nama Lengkap Ibu']))
							{
								$pbk['nmibu'] = $field["Nama Lengkap Ibu"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nama Lengkap Ibu';
								$pbk['nmibu'] = '';
							}
							if(isset($field['NIK/Nomor KTP Ibu']))
							{
								$pbk['nik_ibu'] = $field["NIK/Nomor KTP Ibu"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' NIK/Nomor KTP Ibu';
								$pbk['nik_ibu'] = '';
							}
							if(isset($field['Pendidikan Ibu']))
							{
								$pbk['sekibu'] = ubah_pendidikan($field["Pendidikan Ibu"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Pendidikan Ibu';
								$pbk['sekibu'] = '';
							}
							if(isset($field['Pekerjaan Ibu']))
							{
								$pbk['pibu'] = ubah_pekerjaan($field["Pekerjaan Ibu"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Pekerjaan Ibu';
								$pbk['pibu'] = '';
							}
							if(isset($field['Rata-Rata Penghasilan Orangtua per Bulan']))
							{
								$pbk['dortu'] = ubah_duit($field["Rata-Rata Penghasilan Orangtua per Bulan"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Rata-Rata Penghasilan Orangtua per Bulan';
								$pbk['dortu'] = '';
							}
							if(isset($field['Status Tempat Tinggal Siswa']))
							{
								$pbk['jenrumah'] = ubah_jenis_rumah($field["Status Tempat Tinggal Siswa"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Status Tempat Tinggal Siswa';
								$pbk['jenrumah'] = '';
							}
							if(isset($field['Nama Wali']))
							{
								$pbk['nmwali'] = $field["Nama Wali"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Nama Wali';
								$pbk['nmwali'] = '';
							}
							if(isset($field['NIK/Nomor KTP Wali']))
							{
								$pbk['nik_wali'] = $field["NIK/Nomor KTP Wali"];
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' NIK/Nomor KTP Wali';
								$pbk['nik_wali'] = '';
							}
							if(isset($field['Tahun Lahir Wali']))
							{
								$pbk['tglwali'] = date_to_en('01-01-'.$field["Tahun Lahir Wali"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Tahun Lahir Wali';
								$pbk['tglwali'] = '';
							}
							if(isset($field['Pendidikan Wali']))
							{
								$pbk['pwali'] = ubah_pekerjaan($field["Pendidikan Wali"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Pendidikan Wali';
								$pbk['pwali'] = '';
							}
							if(isset($field['Pekerjaan Wali']))
							{
								$pbk['pwali'] = ubah_pendidikan($field["Pekerjaan Wali"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Pekerjaan Wali';
								$pbk['pwali'] = '';
							}
							if(isset($field['Penghasilan Wali']))
							{
								$pbk['dwali'] = ubah_duit($field["Penghasilan Wali"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Penghasilan Wali';
								$pbk['dwali'] = '';
							}
							if(isset($field['Tanggal Diterima (dd/mm/yyyy)']))
							{
								$pbk['tglditerima'] = date_to_en($field["Tanggal Diterima (dd/mm/yyyy)"]);
							}
							else
							{
								$adagalat = 1;
								$pesan .= ' Tanggal Diterima (dd/mm/yyyy)';
								$pbk['tglditerima'] = '';
							}
							$pbk = nopetik($pbk);
							$this->Tatausaha_model->Perbarui_Data_Siswa_Baru($pbk);
							$pbk3['thnajaran'] = $thnajaran;
							$pbk3['kelas'] = $kelas;
							$pbk3['nis'] = $nis;			
							$pbk3['status'] = 'Y';
							$pbk3['semester'] = $semester;
							$pbk3['no_urut'] = $nourut;
							$this->load->model('Admin_model');
							$ada = $this->Admin_model->Cek_Baru_Siswa_Kelas($thnajaran,$semester,$pbk['nis']);
							$ada = $ada->num_rows();
							$this->Admin_model->Add_Siswa_Kelas($pbk3,$ada);
						}
						$pesan .= ' TIDAK ADA<br />';
						$n++;
					endforeach;
				unlink($filePath);
				}
				$data['judulhalaman'] = 'Unggah Data Siswa dari Emiss';
				$datay['modul'] = 'Unggah Data Siswa dari Emiss';
				$datay['tautan_balik'] = ''.base_url().'tatausaha/impor/emiss';
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$this->load->view('tatausaha/bg_head',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					redirect('tatausaha/siswabaru');
				}
			}
		}
	}
	function kelulusan($id_kelas=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'KELULUSAN';
		$this->load->model('Helper_model','helper');
		$this->load->model('Tatausaha_model','tatausaha');
		$data_isi['semester'] = '2';
		$data_isi['thnajaran'] = cari_thnajaran();
		$data_isi["id_kelas"] = $id_kelas;
		$cacahsiswa = $this->input->post('cacahsiswa');
		$data_isi['cacahsiswa'] = $cacahsiswa;
		$data['loncat'] = '';
		$tanggal = tanggal_indonesia_ke_barat($this->input->post('tgllulus'));
		if($cacahsiswa>0)
		{
			for($i=1;$i<=$cacahsiswa;$i++)
			{
				$ket = $this->input->post('status_'.$i);
				$nis = $this->input->post('nis_'.$i);
				$param['thnajaran']= cari_thnajaran();
				$param['semester'] = '2';
				$param['ket'] = $ket;$this->input->post('status_'.$i);
				$param['nis'] = $nis;
				$param['tanggalkeluar'] = $tanggal;
				$param['tamatbelajar'] = $tanggal;
				$param['alasankeluar'] = 'Lulus';
				if($ket == 'L')
				{
					$tsiswakelas = $this->tatausaha->Perbarui_Data_Siswa_Baru($param);
				}
			}
		}
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/kelulusan',$data_isi);
		$this->load->view('shared/bawah');
	}
	function mapelemiss($tahun1=null,$semester=null,$id_walikelas=null,$aksi=null,$id=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Daftar Mata Pelajaran Emiss';
		$this->load->model('Helper_model','helper');
		$this->load->model('Tatausaha_model','tatausaha');
		if($aksi == 'hapus')
		{
			$this->tatausaha->hapus_mapel_emiss($id);
			redirect('tatausaha/mapelemiss/'.$tahun1.'/'.$semester.'/'.$id_walikelas);
		}
		$this->load->model('Guru_model');
		$data_isi['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data_isi['semester'] = $semester;
		$data_isi['tahun1'] = $tahun1;
		$data_isi["id_walikelas"] = $id_walikelas;
		$data_isi["aksi"] = $aksi;
		$data['loncat'] = '';
		$proses = nopetik($this->input->post('proses'));
		if($proses == 'tambah')
		{
			$in['mapel'] = $this->input->post('mapel');
			$in['no_urut'] = $this->input->post('no_urut');
			$in['thnajaran'] = $this->input->post('thnajaran');
			$in['semester'] = $this->input->post('semester');
			$in['kelas'] = $this->input->post('kelas');
			$this->tatausaha->tambah_mapel_emiss($in);
			$aksi = '';
		}
		if($proses == 'ubah')
		{
			$cacah = nopetik($this->input->post('cacah'));
			if($cacah>0)
			{
				for($i=1;$i<=$cacah;$i++)
				{
					$in['id'] = $this->input->post('id_'.$i);
					$in['no_urut'] = $this->input->post('no_urut_'.$i);
					$this->tatausaha->ubah_mapel_emiss($in);
				}
			}
			$aksi = '';
		}

		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('shared/mapel_emiss',$data_isi);
		$this->load->view('shared/bawah');
	}
	function unduhrapor($tahun1=null,$semester=null,$id_walikelas=null,$aksi=null)
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data_isi['semester'] = $semester;
		$tahun2 = $tahun1 + 1;
		$data_isi['thnajaran'] = $tahun1.'/'.$tahun2;
		$data_isi["id_walikelas"] = $id_walikelas;

		if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_walikelas)))
		{
			$this->load->model('Helper_model','helper');
			$this->load->view('shared/unduh_rapor_emiss_csv',$data_isi);
		}
		else
		{
			redirect('tatausaha/mapelemiss');
		}		
	}
	function legernilai($tahun1=null,$semester=null,$id_walikelas=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Leger Nilai';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		if(empty($id))
		{
			$id = 0;
		}
		$datax['id' ] = $id;
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$datax['thnajaran' ] = $thnajaran;
		$datax['semester' ] = $semester;
		$datax['id_walikelas' ] = $id_walikelas;
		$datax['kelas' ] = $kelas;
		$datax['tahun1' ] = $tahun1;
		$daftar_siswa_kelas =  $this->Pengajaran_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$datax['total_siswa'] = $daftar_siswa_kelas->num_rows();
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/leger_nilai',$datax);
		$this->load->view('shared/bawah');
	}
	function legernilainamasaja($tahun1=null,$semester=null,$id_walikelas=null,$id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Leger Nilai';
		$data['loncat'] = '';
		$this->load->model('Pengajaran_model');
		if(empty($id))
		{
			$id = 0;
		}
		$datax['id' ] = $id;
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$datax['thnajaran' ] = $thnajaran;
		$datax['semester' ] = $semester;
		$datax['id_walikelas' ] = $id_walikelas;
		$datax['kelas' ] = $kelas;
		$datax['tahun1' ] = $tahun1;
		$daftar_siswa_kelas =  $this->Pengajaran_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		$datax['total_siswa'] = $daftar_siswa_kelas->num_rows();
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/leger_nilai_nama_saja',$datax);
		$this->load->view('shared/bawah');
	}
	function legerijazah($tahun1=null,$nis=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Proses Leger Nilai untuk Ijazah';
		$data['loncat'] = '';
		$this->load->model('Helper_model','helper');
		if(empty($id))
		{
			$id = 0;
		}
		$tahun2 = $tahun1 + 1;
		$datax['thnajaran']=$tahun1.'/'.$tahun2;
		$datax['nis' ] = $nis;
		$this->load->view('tatausaha/bg_head',$data);
		if($tahun1 == 2017)
		{
			$this->load->view('tatausaha/leger_ijazah_siswa_2017',$datax);
		}
		else
		{
			$this->load->view('tatausaha/leger_ijazah_siswa',$datax);
		}

		$this->load->view('shared/bawah');
	}
	function formcetakskbk($yangdicetak=null,$tahun1=null,$semester=null,$kodeguru=null,$bulan=null,$cacahbulan=null)
	{
		$data = array();
		$data['judulhalaman'] = 'Mencetak SKBK / SKMT';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$usernamepegawai='';
		$data["semester"]=$semester;
		$data["bulan"]=$bulan;
		$data["cacahbulan"]=$cacahbulan;
		$data['kodeguru'] = $kodeguru;
		$data['yangdicetak'] = $yangdicetak;
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
        	$data['daftartahun'] = $query ;
		$data['tautan_balik'] = 'tatausaha/formcetakskbk';
		if ((!empty($data['kodeguru'])) and (!empty($tahun1)) and (!empty($data['semester'])) and (!empty($data['yangdicetak'])))
		{
			$tahun2 = $tahun1+1;
			$data['thnajaran'] = $tahun1.'/'.$tahun2;
			if($data['yangdicetak'] == 'skbk')
			{
				$this->load->view('tatausaha/mencetak_skbk',$data);				
			}
			else if($data['yangdicetak'] == 'skmt')
			{
				$this->load->view('tatausaha/mencetak_skmt',$data);				
			}
			else if($data['yangdicetak'] == 'aktif')
			{
				$this->load->view('tatausaha/mencetak_sk_aktif',$data);				
			}
			else if($data['yangdicetak'] == 'identitas')
			{
				$this->load->view('tatausaha/mencetak_identitas_penerima_tunjangan',$data);				
			}
			else if($data['yangdicetak'] == 'pernyataan')
			{
				$this->load->view('tatausaha/mencetak_surat_pernyataan',$data);				
			}
			else if($data['yangdicetak'] == 'hasilsupervisi')
			{
				$this->load->view('shared/mencetak_supervisi',$data);
			}
			else if($data['yangdicetak'] == 'borangsupervisi')
			{
				$this->load->view('shared/mencetak_borang_supervisi',$data);
			}
			else if($data['yangdicetak'] == 'daftarberkas')
			{
				$this->load->view('tatausaha/mencetak_pemeriksaan_berkas',$data);				
			}
			else
			{
				$this->load->view('tatausaha/bg_head',$data);
				$this->load->view('tatausaha/cetak_skbk',$data);
				$this->load->view('situs/bawah');
			}
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/cetak_skbk',$data);
			$this->load->view('situs/bawah');
		}
	}
	function pemeriksaanberkas()
	{
		$data = array();
		$data['judulhalaman'] = 'Pemeriksaan Berkas Pencairan Tunjangan Sertifikasi';
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['kodeguru'] = $this->input->post('kodeguru');
		$data['thnajaran'] = $this->input->post('thnajaran');
		$data['semester'] = $this->input->post('semester');
		$data['proses'] = $this->input->post('proses');
		$data['cetak'] = '';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data['daftartahun'] = $query ;
		$data['tautan_balik'] = 'tatausaha/formcetakskmt';
		if($data['proses']=='oke')
		{
			$this->load->model('Tatausaha_model');
			$pbk['kodeguru'] = $this->input->post('kodeguru');
			$pbk['thnajaran'] = $this->input->post('thnajaran');
			$pbk['semester'] = $this->input->post('semester');
			$daftar_berkas ='';
			for($i=1;$i<=10;$i++)
			{
				if ($this->input->post('berkas_'.$i) == 1)
				{
					$daftar_berkas .= 1;
				}
				else
				{$daftar_berkas .= 0;
				}
			}
			$pbk['daftar_berkas'] = $daftar_berkas;
			$this->Tatausaha_model->Simpan_Pemeriksaan_Berkas($pbk);
			$data['cetak'] = 'oke';
		}
		$this->load->model('Admin_model');
		if ($data['proses'] == 'cetak')
		{
			$data['tautan_balik'] = 'tatausaha/pemeriksaanberkas';
			$this->load->view('tatausaha/mencetak_pemeriksaan_berkas',$data);				
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/pemeriksaan_berkas',$data);
			$this->load->view('situs/bawah');
		}
	}
	function cetakdaftarsiswa($tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['loncat'] = '';
		$data['judulhalaman'] = 'Daftar Siswa Kelas';
		$data['id_walikelas'] = $id_walikelas;
		$data['semester'] = $semester;
		$data['tahun1'] = $tahun1;
		if ((!empty($tahun1)) and (!empty($id_walikelas)) and (!empty($semester)))  
		{
			$this->load->view('shared/mencetak_daftar_siswa',$data);
		}
		else
		{
			redirect('tatausaha');
		}
	}
	function batalkeluar($nis=null)
	{
		$in["nis"] = $nis;
		$in["tanggalkeluar"] = '';
		$bulansurat = '';
		$tahunsurat = '';
		$in["thnajaran"] = '';
		$in["semester"] = '';
		$in["alasankeluar"] = '';
		$in["sekolahtujuan"] = '';
		$in["nosurat"] = '';
		$in['kdkls'] = '';
		$in["ket"] = "Y";
		$this->load->model('Siswa_model');
		$this->Siswa_model->Update_Data($in);
		$this->db->query("update `siswa_kelas` set `status` = 'Y' where `nis`='$nis'");
		redirect('tatausaha/fotosiswa/'.$nis);
	}
	function dataijazah()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Data untuk Ijazah Sementara';
		$thnajaran= cari_thnajaran();
		$proses=$this->input->post('proses');
		if($proses == 'ubah')
		{
			$nomor_ijazah = nopetik($this->input->post('nomor_ijazah'));
			$this->db->query("update `leger_info` set `konten` = '$nomor_ijazah' where `thnajaran`='$thnajaran' and `item`='nomor ijazah'");
			$lokasi = nopetik($this->input->post('lokasi'));
			$this->db->query("update `leger_info` set `konten` = '$lokasi' where `thnajaran`='$thnajaran' and `item`='lokasi'");

			$tanggal_kelulusan = nopetik($this->input->post('tanggal_kelulusan'));
			$this->db->query("update `leger_info` set `konten` = '$tanggal_kelulusan' where `thnajaran`='$thnajaran' and `item`='tanggal kelulusan'");
			$nomor_skl = nopetik($this->input->post('nomor_skl'));
			$this->db->query("update `leger_info` set `konten` = '$nomor_skl' where `thnajaran`='$thnajaran' and `item`='nomor skl'");
			redirect('tatausaha');
		}

		$datax['thnajaran']= cari_thnajaran();
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/data_ijazah_sementara',$datax);
		$this->load->view('shared/bawah');
	}
	function pesertabimtik($id_walikelas=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Unduh Peserta Bimbingan TIK';
		$this->load->helper('string');
		$data['thnajaran']= cari_thnajaran();
		$data['semester'] = cari_semester();
		$data['loncat'] = '';
		$data['id_walikelas'] = $id_walikelas;
		if(!empty($id_walikelas))
		{
			$this->load->view('shared/peserta_bimtik_csv',$data);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/peserta_bimtik_form',$data);
			$this->load->view('shared/bawah');
		}

	}
	function ratapkg($tahun=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Rata - rata PKG';
		$data['tahun'] = $tahun;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/rata_pkg',$data);
		$this->load->view('shared/bawah');
	}
	function aim()
	{
		$this->load->view('shared/aim_siswa_csv');
	}
	function unduhraporexcel($tahun1=null,$semester=null,$id_mapel=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mencetak Unduh Nilai Rapor Excel';
		$this->load->model('Pengajaran_model');
		$datax['semester']=$semester;
		$datax['tahun1']=$tahun1;
		$tahun2 = $tahun1 + 1;
		$data['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['id_mapel'] = $id_mapel;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['usere'] = 'tatausaha';
		$data['loncat'] = '';
		if(!empty($id_mapel))
		{
			$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['mapel']=$mapel;
			$data['semester']=$semester;
			$data['kkm'] = $kkm;
			$this->load->library('excel');
			$this->load->view('guru/unduh_rapor',$data);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/mengunduh_nilai_rapor',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function unduhdatasiswaraporexcel($tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mengunduh Nilai Rapor Excel';
		$this->load->model('Pengajaran_model');
		$datax['semester']=$semester;
		$datax['tahun1']=$tahun1;
		$tahun2 = $tahun1 + 1;
		$data['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['id_walikelas'] = $id_walikelas;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['usere'] = 'tatausaha';
		$data['loncat'] = '';
		if(!empty($id_walikelas))
		{
			$tmapel = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$this->load->library('excel');
			$this->load->view('guru/unduh_siswa_rapor',$data);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/mengunduh_siswa_rapor',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function unduhketidakhadiransiswaraporexcel($tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mengunduh Ketidakhadiran Ekstrakurikuler dan Ketidakhadiran';
		$this->load->model('Pengajaran_model');
		$datax['semester']=$semester;
		$datax['tahun1']=$tahun1;
		$tahun2 = $tahun1 + 1;
		$data['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['id_walikelas'] = $id_walikelas;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['usere'] = 'tatausaha';
		$data['loncat'] = '';
		if(!empty($id_walikelas))
		{
			$tmapel = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$this->load->library('excel');
			$this->load->view('guru/unduh_ketidakhadiran_ekstra_rapor',$data);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/mengunduh_ketidakhadiran_siswa_rapor',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function unduhsikapspiritulasosialraporexcel($tahun1=null,$semester=null,$id_walikelas=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Mengunduh Sikap Spiritual Sosial';
		$this->load->model('Pengajaran_model');
		$datax['semester']=$semester;
		$datax['tahun1']=$tahun1;
		$tahun2 = $tahun1 + 1;
		$data['thnajaran'] = $tahun1.'/'.$tahun2;
		$datax['id_walikelas'] = $id_walikelas;
		$datax['daftar_tapel']= $this->Pengajaran_model->Tampilkan_Semua_Tahun();
		$datax['usere'] = 'tatausaha';
		$data['loncat'] = '';
		if(!empty($id_walikelas))
		{
			$tmapel = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
			foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$thnajaran = $dtmapel->thnajaran;
			}
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$this->load->library('excel');
			$this->load->view('guru/unduh_sikap_spiritual_sosial_rapor',$data);
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('shared/mengunduh_sikap_spiritual_sosial_siswa_rapor',$datax);
			$this->load->view('shared/bawah');
		}
	}
	function kuliah($nis=null,$aksi=null)
	{
		if(($aksi == 'batal') or ($aksi == 'kuliah'))
		{
			if($aksi == 'batal')
			{
				$this->db->query("update `datsis` set `kuliah` = 'Tidak' where `nis`='$nis'");
			}
			if($aksi == 'kuliah')
			{
				$this->db->query("update `datsis` set `kuliah` = 'Ya' where `nis`='$nis'");
			}

		}
		redirect('tatausaha/hasilcarisiswa/'.$nis);
	}
	function unggahidsiswaemiss()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Unggah Kode Siswa dari EMISS';
		$this->load->model('Tatausaha_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		$pesan = '';
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	$data['pesan'] = $this->upload->display_errors();
				$data['modul'] = 'Unggah Kode Siswa dari EMISS';
				$data['tautan_balik'] = base_url().'tatausaha/unggahidsiswaemiss';
				$this->load->view('tatausaha/bg_head',$data);
				$this->load->view('shared/adagalat',$data);
				$this->load->view('shared/bawah');

			}
			else 
			{
				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				if ($this->csvimport->get_array($filePath))
				{
					$csvData = $this->csvimport->get_array($filePath);	
					$adagalat = 0;
					$n=0;
					foreach($csvData as $field):
						$baris = $n+1;
						$pesan .= 'Baris '.$baris.' Kolom';
						if(isset($field['ID SISWA']))
						{
							$pbk['id_siswa'] = hilangkanpetik($field['ID SISWA']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' ID SISWA';
							$pbk['id_siswa'] = '';
						}
						if(isset($field['NIS LOKAL']))
						{
							$pbk['nis'] = substr(hilangkanpetik($field['NIS LOKAL']),14,4);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' NIS LOKAL';
							$pbk['nis'] = '';
						}
						if(isset($field['KODE ROMBEL']))
						{
							$pbk['kode_rombel'] = hilangkanpetik($field['KODE ROMBEL']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' KODE ROMBEL';
							$pbk['kode_rombel'] = '';
						}
						if(isset($field['ROMBEL']))
						{
							$pbk['rombel'] = hilangkanpetik($field['ROMBEL']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' ROMBEL';
							$pbk['rombel'] = '';
						}
						if(isset($field['KODE JURUSAN']))
						{
							$pbk['kode_jurusan'] = hilangkanpetik($field['KODE JURUSAN']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' KODE JURUSAN';
							$pbk['kode_jurusan'] = '';
						}
						if(isset($field['JURUSAN']))
						{
							$pbk['jurusan_emiss'] = hilangkanpetik($field['JURUSAN']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' JURUSAN';
							$pbk['jurusan_emiss'] = '';
						}

						if ($adagalat==0)
						{
							$this->Tatausaha_model->Update_ID_Siswa_Emiss($pbk);
						}
						$pesan .= ' TIDAK ADA<br />';
						$n++;
					endforeach;
					unlink($filePath);
					$datay['modul'] = 'Unggah Kode Sistem Siswa Padamu';
					$datay['tautan_balik'] = ''.base_url().'tatausaha/unggahidsiswaemiss';
					$datay['pesan'] = $pesan;
					if($adagalat==1)
					{
						$this->load->view('tatausaha/bg_head',$data);
						$this->load->view('guru/adagalat',$datay);
						$this->load->view('shared/bawah',$data);
					}
					else	
					{
						$data['sukses'] = '';
						$this->load->view('tatausaha/bg_head',$data);
						$this->load->view('tatausaha/id_siswa_emiss',$data);
						$this->load->view('shared/bawah',$data);

					}
				}

			}
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/id_siswa_emiss',$data);
			$this->load->view('shared/bawah');
		}
	}
	function unggahidsiswaard()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Unggah Kode Siswa dari ARD';
		$this->load->model('Tatausaha_model');
		$this->load->model('Referensi_model','ref');
		$prov = $this->ref->ambil_nilai('kode_un_provinsi');
		$kab = $this->ref->ambil_nilai('kode_un_kab');
		$sek = $this->ref->ambil_nilai('kode_un_sekolah');
		$kode_awal_un = $prov.$kab.$sek;
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;	
		$this->load->library('upload', $config);
		$pesan = '';
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
			 	$data['pesan'] = $this->upload->display_errors();
				$data['modul'] = 'Unggah Kode Siswa dari ARD';
				$data['tautan_balik'] = base_url().'tatausaha/unggahidsiswaard';
				$this->load->view('tatausaha/bg_head',$data);
				$this->load->view('shared/adagalat',$data);
				$this->load->view('shared/bawah');

			}
			else 
			{
				$this->db->query("update `datsis` set `id_ard_siswa` = '' where `ket`='Y'");
				$filePath = 'uploads/'.$_FILES['userfile']['name'];
				if ($this->csvimport->get_array($filePath))
				{
					$csvData = $this->csvimport->get_array($filePath);	
					$adagalat = 0;
					$n=0;
					foreach($csvData as $field):
						$baris = $n+1;
						$pesan .= 'Baris '.$baris.' Kolom';
						if(isset($field['nisn']))
						{
							$nisn = hilangkanpetik($field['nisn']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' nisn';
							$nisn = '';
						}
						if(isset($field['student_id']))
						{
							$id_ard_siswa = hilangkanpetik($field['student_id']);
						}
						else
						{
							$adagalat = 1;
							$pesan .= ' student_id';
							$id_ard_siswa = '';
						}
						if ($adagalat==0)
						{
							$this->db->query("update `datsis` set `id_ard_siswa`='$id_ard_siswa' where `nisn`='$nisn'");
						}
						$pesan .= ' TIDAK ADA<br />';
						$n++;
					endforeach;
					unlink($filePath);
					$datay['modul'] = 'Unggah Kode Siswa ARD';
					$datay['tautan_balik'] = ''.base_url().'tatausaha/unggahidsiswaard';
					$datay['pesan'] = $pesan;
					if($adagalat>0)
					{
						$this->load->view('tatausaha/bg_head',$data);
						$this->load->view('guru/adagalat',$datay);
						$this->load->view('shared/bawah',$data);
					}
					else	
					{
						$data['sukses'] = '';
						$this->load->view('tatausaha/bg_head',$data);
						$this->load->view('tatausaha/id_siswa_ard',$data);
						$this->load->view('shared/bawah',$data);

					}
				}

			}
		}
		else
		{
			$this->load->view('tatausaha/bg_head',$data);
			$this->load->view('tatausaha/id_siswa_ard',$data);
			$this->load->view('shared/bawah');
		}
	}
	function kirimard($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Admin_model');
		$data["query"]=$this->Admin_model->Tampil_Data_Siswa($id);
		$data["nis"]=$id;
		$this->load->model('Siswa_model');
		$data["judulhalaman"]= 'Unggah Data Siswa dari ARD';
		$data['tdaftar_jarak']=$this->Siswa_model->Daftar_Jarak();
		$data['daftar_ruang']=$this->Siswa_model->Tampilkan_Semua_Kelas();
		$this->load->model('Referensi_model','ref');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['school_id'] = $this->ref->ambil_nilai('school_id');
		$data['kode_tambahan_nis_ard'] = $this->ref->ambil_nilai('kode_tambahan_nis_ard');
		$data['adamenu'] = '';
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/kirim_siswa',$data);
	}
	function ard($hal=null,$kd=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Kirim Ard';
		$data["hal"]= $hal;
		$data['kd'] = $kd;
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('ard/ard',$data);
		$this->load->view('shared/bawah');
	}
	function umumard($kd=null)
	{
		$data["judulhalaman"]= 'Kirim Ard';
		$data['kd'] = $kd;
		$data["nim"]=$this->session->userdata('username');
		$data['adamenu'] = '';
		$this->load->model('Referensi_model','ref');
		$data['id_desa'] = $this->ref->ambil_nilai('id_desa');
		$data['url_ard'] = $this->ref->ambil_nilai('url_ard');
		$data['school_id'] = $this->ref->ambil_nilai('school_id');
		$data['sek_nama_ard'] = $this->ref->ambil_nilai('sek_nama_ard');
		$this->load->model('Model_select');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('ard/kirim_data_guru_ke_ard',$data);
		$this->load->view('shared/bawah');
	}
	function idsiswaard($nis=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Kode Siswa dari ARD';
		$data['nis'] = $nis;
		$this->load->model('Tatausaha_model');
		$this->load->view('tatausaha/bg_head',$data);
		$this->load->view('tatausaha/id_siswa_ard_daftar',$data);
		$this->load->view('shared/bawah',$data);
	}


}//akhir fungsi

?>
