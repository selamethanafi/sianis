<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : keuangan.php
// Lokasi      : application/controller
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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

class Keuangan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','fungsi','file'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Keuangan")
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
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["status"]= 'Keuangan';
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
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}

	function siswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Cari Siswa';
		$data["status"]=$this->session->userdata('tanda');
		$kunci=nopetik($this->input->post('nama'));
		$this->load->model('Keuangan_model');
		$data['kunci']=$kunci;
		$tahun = substr(cari_thnajaran(),0,4);
		$semester = cari_semester();
		$query=$this->Keuangan_model->Cari_Siswa($kunci);
		if($query->num_rows() == 1)
		{
			foreach($query->result() as $a)
			{
				$nis = $a->nis;
			}
			redirect('keuangan/terima/'.$nis);
		}
		$data["query"] = $query;
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/siswa',$data);
		$this->load->view('shared/bawah');
	}
	function aim()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Daftar Pembayaran Siswa dari AIM';
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/aim',$data);
		$this->load->view('shared/bawah');
	}
	function detilsiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$this->load->model('Keuangan_model');
		$data["query"]=$this->Keuangan_model->Detil_Siswa($id);
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/detil_siswa',$data);
		$this->load->view('shared/bawah');
	}
/*
	function referensi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/referensi',$data);
		$this->load->view('shared/bawah');
	}
*/
	function transaksi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/transaksi',$data);
		$this->load->view('shared/bawah');
	}
	function laporan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/laporan',$data);
		$this->load->view('shared/bawah');
	}
	function macam($kd=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Data Induk Macam Pembayaran';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Keuangan_model');
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pembayaran();
		$macampembayaran = '';
		$statusdigunakan='1';
		$nomor='';
		$querya=$this->Keuangan_model->Macam_Pembayaran($kd);
		foreach($querya->result() as $mp)
		{$macampembayaran=$mp->nama;
		 $statusdigunakan=$mp->status;
		$nomor = $mp->nomor;
		}
		$data["macampembayaran"]=$macampembayaran;
		$data["statusdigunakan"]=$statusdigunakan;
		$data["nomor"]=$nomor;
		$data["kd"]=$kd;
		$in=array();
		$in["nama"] = $this->input->post('nama');
		$in["nomor"] = $this->input->post('nomor');
		$in["status"] = $this->input->post('statusdigunakan');
		$in["kd"]=$this->input->post('kd');
		if ((!empty($in["nama"])) and (!empty($in["status"])))
		{
			$in = hilangkanpetik($in);	
			$this->Keuangan_model->Simpan_Macam_Pembayaran($in);
			redirect('keuangan/macam');
		}
		else
		{
			$data['thnajaran']= cari_thnajaran();
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/macam',$data);
			$this->load->view('shared/bawah');	
		}
	}	
	function set($tahun1=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Besaran Pembayaran';
		$data["loncat"] = '';
		$thnajaran= cari_thnajaran();
		$this->load->model('Guru_model');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->model('Keuangan_model');
		if(empty($tahun1))
		{
			$tahun1 = substr($thnajaran,0,4);
	
		}
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pembayaran();
		$data["querymacamaktif"]=$this->Keuangan_model->Daftar_Macam_Pembayaran_Aktif();
		$data["querytingkat"]=$this->Keuangan_model->Daftar_Tingkat();
		$tingkat = $this->input->post('tingkat');
		$macam_pembayaran = $this->input->post('macam_pembayaran');
		$besar = $this->input->post('besar');
		if ((!empty($thnajaran)) and (!empty($tingkat)) and (!empty($macam_pembayaran)))
		{
			$tset = $this->Keuangan_model->Cek_Set_Uang($thnajaran,$tingkat,$macam_pembayaran);
			$sudahadaset = $tset->num_rows();
			$this->Keuangan_model->Simpan_Set_Uang($thnajaran,$tingkat,$macam_pembayaran,$besar,$sudahadaset);
		}
		$data['tahun1'] = $tahun1;
		$data["daftar_set"]=$this->Keuangan_model->Daftar_Nilai_Pembayaran($thnajaran);
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/set',$data);
		$this->load->view('shared/bawah');	
	}	
	function siswakelas()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
       		$data_isi['daftarkelas'] = $querykelas ;
		$data['kelas'] = $this->input->post('kelas');
		$data['thnajaran'] = $this->input->post('thnajaran');
		$data['semester'] = $this->input->post('semester');
		$querysiswa=$this->Admin_model->Tampil_Siswa_Kelas($data['thnajaran'],$data['semester'],$data['kelas']);
       		$data_isi['daftarsiswa'] = $querysiswa ;
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/siswa_kelas',$data_isi);
		$this->load->view('shared/bawah');
	}
	function terima($nis=null,$tahun1=null,$semester=null,$besar=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Penerimaan Pembayaran';
		$data["status"]=$this->session->userdata('tanda');
		if(empty($tahun1))
		{
			$tahun1 = substr(cari_thnajaran(),0,4);
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}

		if((empty($nis)) or (empty($tahun1)) or (empty($semester)))
		{
			redirect('keuangan/siswa');
		}
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$this->load->model('Keuangan_model');			
		$ta = $this->Keuangan_model->Detil_Siswa($nis);
		$adata = $ta->num_rows();
		if($adata>0)
		{
			$tanggalhadir =$this->input->post('tanggalhadir');
			$bulanhadir =$this->input->post('bulanhadir');
			$tahunhadir =$this->input->post('tahunhadir');
			$cacah_item =$this->input->post('cacah_item');
			$cacah_item2 =$this->input->post('cacah_item2');
			$thnajaranini=$this->input->post('thnajaranini');
			$in["nis"]=$nis;
			$tanggalbayar = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$kunci=$this->input->post('nama');
			$data["daftar_pembayaran"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa_Thnajaran($nis,$thnajaran);
			$data["daftar_semua_pembayaran"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa($nis);
			$data["daftar_semua_pembayaran_non_komite"]=$this->Keuangan_model->Daftar_Pembayaran_Non_Komite_Siswa($nis);
			$jumlah = 0;
			if(($cacah_item>0) or ($cacah_item2>0))
			{
				$this->load->model('Referensi_model','ref');
				$url_sms_post = $this->ref->ambil_nilai('url_sms_post');
				$sek_nama = $this->ref->ambil_nilai('sek_nama');
				$nohp = cari_seluler_orangtua($nis);
				$pesan = '';
				for($i=0;$i<=$cacah_item;$i++)
				{
					$besar = $this->input->post('besar_'.$i);
					$jumlah = $jumlah + $besar;
//					redirect('keuangan222/aa'.$besar);
					$macam_pembayaran=$this->input->post('macam_pembayaran_'.$i);
					$keterangan=$this->input->post('keterangan_'.$i);
					if ((!empty($nis)) and (!empty($besar)) and (!empty($tanggalbayar)) and (!empty	($macam_pembayaran)))
					{
						$in=array();
						$in["thnajaran"] = cari_thnajaran();
						$in["besar"] = $besar;
						$in["nis"] = $nis;
						$in["tanggal"] = $tanggalbayar;
						$in["besar"] = $besar;
						$in["keterangan"] = $keterangan;
						$in["macam_pembayaran"] = $macam_pembayaran;
						$in["user"]=$data["nim"];
						$in = hilangkanpetik($in);
						$param=array();
						$this->Keuangan_model->Simpan_Data_Pembayaran_Siswa($in);
						if($i==0)
						{
							$pesan .= $macam_pembayaran.' sebesar '.xduit($besar);
						}
						else
						{
							$pesan .= ', '.$macam_pembayaran.' sebesar '.xduit($besar);
						}
						if(!empty($keterangan))
						{
							$pesan .= ' ('.$keterangan.')';
						}
					}
				}
				for($i=0;$i<=$cacah_item2;$i++)
				{
					$besar = $this->input->post('besar2_'.$i);
					$macam_pembayaran=$this->input->post('macam_pembayaran2_'.$i);
					$jumlah = $jumlah + $besar;
//					redirect('keuangan222/aa'.$besar);
					$id_non_komite=$this->input->post('id_non_komite_'.$i);
					$keterangan=$this->input->post('keterangan2_'.$i);
					if ((!empty($nis)) and (!empty($besar)) and (!empty($tanggalbayar)) and (!empty	($id_non_komite)))
					{
						$in=array();
						$in["thnajaran"] = cari_thnajaran();
						$in["besar"] = $besar;
						$in["nis"] = $nis;
						$in["tanggal"] = $tanggalbayar;
						$in["besar"] = $besar;
						$in["keterangan"] = $keterangan;
						$in["id_non_komite"] = $id_non_komite;
						$in["user"]=$data["nim"];
						$in = hilangkanpetik($in);
						$param=array();
						$this->Keuangan_model->Simpan_Data_Pembayaran_Non_Komite_Siswa($in);
						if($i==0)
						{
							$pesan .= $macam_pembayaran.' sebesar '.xduit($besar);
						}
						else
						{
							$pesan .= ', '.$macam_pembayaran.' sebesar '.xduit($besar);
						}
						if(!empty($keterangan))
						{
							$pesan .= ' ('.$keterangan.')';
						}
					}
				}

				$pesan = 'Kami telah menerima pembayaran a.n. '.nis_ke_nama($nis).' sejumlah '.xduit($jumlah).' dengan rincian berikut '.$pesan.'. '.$sek_nama;
				if((!empty($url_sms_post)) and (!empty($nohp)))
				{
					$this->load->helper('telegram');
					$kirim = postsms($url_sms_post,$nohp,$pesan);
				}
				$this->db->query("delete from `siswa_proses_bayar` where `nis`='$nis'");
				redirect('keuangan/terima/'.$nis.'/'.$tahun1.'/'.$semester);
			}
			else
			{

				$data['nis'] = $nis;
				$data['thnajaran'] = $thnajaran;
				$data['semester'] = $semester;
				$data["querybayar"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa($nis);
				$this->load->view('keuangan/bg_atas',$data);
				$this->load->view('keuangan/bg_menu',$data);
				$ta = $this->db->query("select * from `siswa_proses_bayar` where `nis`='$nis'");
				$besar = 0;
				foreach($ta->result() as $a)
				{
					$besar = $a->besar;
				}
				if($besar > 0)
				{
					$data['besar_ajuan'] = $besar;
					$this->load->view('keuangan/terima_mandiri',$data);
				}
				else
				{
					$this->load->view('keuangan/terima',$data);
				}
				$this->load->view('shared/bawah');
			}
		}
		else
		{
			redirect('keuangan/siswa');
		}
	}
	function hapuspembayaran($id=null,$nis=null,$tahun1=null,$semester=null)
	{
		$this->load->model('Keuangan_model');
		$this->Keuangan_model->Hapus_Pembayaran_Siswa($id);
		redirect('keuangan/terima/'.$nis.'/'.$tahun1.'/'.$semester);
	}
	function hapuspembayarannonkomite($id=null,$nis=null,$tahun1=null,$semester=null)
	{
		$this->load->model('Keuangan_model');
		$this->Keuangan_model->Hapus_Pembayaran_Non_Komite_Siswa($id);
		redirect('keuangan/terima/'.$nis.'/'.$tahun1.'/'.$semester);
	}

	function kekurangansiswaperkelas()
	{
		$semesterx = cari_semester();
		$thnajaranx = cari_thnajaran();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$data["thnajaran"]=$thnajaranx;
		$this->load->model('Keuangan_model');
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pembayaran();
		$data["querymacamaktif"]=$this->Keuangan_model->Daftar_Macam_Pembayaran_Aktif();
		$data["ruang"] = $this->input->post('ruang');
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		if (empty($semester))
		{
			$semester=$semesterx;
		}
		$data["semester"]=$semester;
		if (empty($thnajaran))
		{
			$thnajaran=$thnajaranx;
		}
		$data["thnajaran"]=$thnajaran;
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/kekurangan_siswa_per_kelas',$data);
		$this->load->view('shared/bawah');	
	}	
	function kekurangansiswaperkelaspertahun()
	{
		$thnajaranx = cari_thnajaran();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$data["thnajaran"]=$thnajaranx;
		$this->load->model('Keuangan_model');
		$kd = $this->uri->segment(3);
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pembayaran();
		$data["querymacamaktif"]=$this->Keuangan_model->Daftar_Macam_Pembayaran_Aktif();
		$data["querykelas"]=$this->Keuangan_model->Daftar_Ruang();
		$data["ruang"] = $this->input->post('ruang');
		$thnajaran = $this->input->post('thnajaran');
		if (empty($thnajaran))
		{
			$thnajaran=$thnajaranx;
		}
		$data["thnajaran"]=$thnajaran;
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/kekurangan_siswa_per_kelas_per_tahun',$data);
		$this->load->view('shared/bawah');	
	}	
	function pembayaran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Laporan Penerimaan Harian';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/pembayaran',$data);
		$this->load->view('shared/bawah');	
	}	
	function cetakpembayaran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Laporan Penerimaan Harian';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Keuangan_model');
		$tanggalhariini = $this->input->post('tanggalhariini');
		$bulanhariini = $this->input->post('bulanhariini');
		$tahunhariini = $this->input->post('tahunhariini');
		$hariini = "$tahunhariini-$bulanhariini-$tanggalhariini";
		$data["tanggalhariini"]="$tanggalhariini-$bulanhariini-$tahunhariini";
		$data["queryhariini"] = $this->Keuangan_model->Tampil_Data_Hari_Ini($hariini);
		$this->load->model('Referensi_model');
		$data['baris1'] = $this->Referensi_model->ambil_nilai('baris_1_komite');
		$data['baris2'] = $this->Referensi_model->ambil_nilai('baris_2_komite');
		$data['baris3'] = $this->Referensi_model->ambil_nilai('baris_3_komite');
		$data['baris4'] = $this->Referensi_model->ambil_nilai('baris_4_komite');
		$data['nama_ketua_komite'] = $this->Referensi_model->ambil_nilai('nama_ketua_komite');
		$data['lokasi'] = $this->Referensi_model->ambil_nilai('lokasi');
		$data['bendahara_komite'] = $this->Referensi_model->ambil_nilai('bendahara_komite');
		$this->load->view('shared/bg_atas_cetak',$data);
		$this->load->view('keuangan/cetak_pembayaran',$data);
	}	
	function cetakkekurangansiswaperkelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Daftar Kekurangan Pembayaran Siswa Per Kelas';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Keuangan_model');
		$data["bulan"]=date("m");
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pembayaran();
		$data["querymacamaktif"]=$this->Keuangan_model->Daftar_Macam_Pembayaran_Aktif();
		$data["querykelas"]=$this->Keuangan_model->Daftar_Ruang();
		$data["ruang"] = $this->input->post('ruang');
		$rinci = $this->input->post('rinci');
		$thnajaran = $this->input->post('thnajaran');
		$data["thnajaran"]=$thnajaran;
		$semester = $this->input->post('semester');
		$data["semester"]=$semester;
		//$this->load->view('keuangan/bg_head',$data);
		if ($rinci == 'Y')
		{
			$this->load->view('shared/bg_atas_cetak_saja',$data);
			$this->load->view('keuangan/cetak_kekurangan_siswa_per_kelas_rinci',$data);
		}
		else
		{
			$this->load->view('shared/bg_atas_cetak_saja',$data);
			$this->load->view('keuangan/cetak_kekurangan_siswa_per_kelas',$data);
		}
	}	
	function cetakkekurangansiswaperkelaspertahun()
	{
		$thnajaranx = cari_thnajaran();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$data["thnajaran"]=$thnajaranx;
		$this->load->model('Keuangan_model');
		$kd = $this->uri->segment(3);
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pembayaran();
		$data["querymacamaktif"]=$this->Keuangan_model->Daftar_Macam_Pembayaran_Aktif();
		$data["querykelas"]=$this->Keuangan_model->Daftar_Ruang();
		$data["ruang"] = $this->input->post('ruang');
		$thnajaran = $this->input->post('thnajaran');
		if (empty($thnajaran))
		{
			$thnajaran=$thnajaranx;
		}
		$data["thnajaran"]=$thnajaran;
		$data["bulan"]=date("m");
		$this->load->view('keuangan/cetak_kekurangan_siswa_per_kelas_per_tahun',$data);
	}	
	function kekurangansiswa()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Kekurangan Siswa';
		$data["status"]=$this->session->userdata('tanda');
		$nis='';
		$nis1 = $this->uri->segment(3);
		if (!empty($nis1))
			{$nis=$nis1;}
		$in=array();
		$nis2=$this->input->post('nis');
		if (!empty($nis2))
		{
			$nis=$nis2;
		}	
		$in["nis"]=$nis;
		$kunci=$this->input->post('nama');
		$this->load->model('Keuangan_model');
		$data['kunci']=$kunci;
		$data["query"]=$this->Keuangan_model->Cari_Siswa($kunci);
		$tdatsis = $this->Keuangan_model->Detil_Siswa($nis);
		$nama ='';
		$kelas='';
		foreach($tdatsis->result() as $ddatsis)
		{
			$nama=$ddatsis->nama;
			$nis=$ddatsis->nis;
			$kelas = $ddatsis->kdkls;
		}
		$data["kelas"] =$kelas;				
		$data["nama"] =$nama;
		$data["nis"] =$nis;
		$data["querybayar"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa($nis);
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/kekurangan_siswa',$data);
		$this->load->view('shared/bawah');
	}
	function penerimaan()
	{
		$thnajaranx = cari_thnajaran();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Rekapitulasi Penerimaan';
		$data["status"]=$this->session->userdata('tanda');
		$data["thnajaran"]=$thnajaranx;
		$thnajaran = $this->input->post('thnajaran');
		$data["proses"] = $this->input->post('proses');
		if (empty($thnajaran))
		{
			$thnajaran=$thnajaranx;
		}
		$data["thnajaran"]=$thnajaran;
		if ($data["proses"] == 1)
		{
			$this->load->view('shared/bg_atas_cetak_landscape',$data);
			$this->load->view('keuangan/cetak_penerimaan',$data);
		}
		else
		{
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/penerimaan',$data);
			$this->load->view('shared/bawah');	
		}
	}	
	function bulanan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = '';
		$data["status"]=$this->session->userdata('tanda');
		$data["thnajaran"] = $this->input->post('thnajaran');
		$data["bulan"] = $this->input->post('bulan');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/transaksi_bulanan',$data);
		$this->load->view('shared/bawah');	
	}	
	function cetakkuitansi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["namauser"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Kuitansi Pembayaran';
		$cacah = $this->input->post('cacah');
		$cacah2 = $this->input->post('cacah2');
		$tahun1=$this->input->post('tahun1');
		$semester=$this->input->post('semester');
		if(($cacah >0) or ($cacah2 >0))
		{
			$id = '';
			$id2 = '';
			$idn = '';
			$idn2 = '';
			for($i=1;$i<=$cacah;$i++)
			{
				$pilihan = $this->input->post("pilihan_$i");
				if($pilihan == 1)
				{
					$id_siswa_bayar = $this->input->post("id_siswa_bayar_$i");
					if(empty($id))
					{
						$id .= 'where `id_siswa_bayar` = \''.$id_siswa_bayar.'\'';
						$id2 .= $id_siswa_bayar;
					}
					else
					{
						$id .= ' or `id_siswa_bayar` = \''.$id_siswa_bayar.'\'';
						$id2 .= 'x'.$id_siswa_bayar;
					}
				}

			}
			for($j=1;$j<=$cacah2;$j++)
			{
				$pilihan2 = $this->input->post("pilihan2_$j");
				if($pilihan2 == 1)
				{
					$id_siswa_bayar2 = $this->input->post("id_siswa_bayar2_$j");
					if(empty($idn))
					{
						$idn .= 'where `id_siswa_bayar` = \''.$id_siswa_bayar2.'\'';
						$idn2 .= $id_siswa_bayar2;
					}
					else
					{
						$idn .= ' or `id_siswa_bayar` = \''.$id_siswa_bayar2.'\'';
						$idn2 .= 'x'.$id_siswa_bayar2;
					}
				}

			}
			$data['id'] = $id;
			$data['id2'] = $id2;
			$data['idn'] = $idn;
			$data['idn2'] = $idn2;
			$data['tahun1'] = $tahun1;
			$data['semester'] = $semester;
			$data['nis'] = $this->input->post('nis');
			$tipe_printer = $this->input->post('tipe_printer');
			$this->load->model('Referensi_model');
			$data['baris1'] = $this->Referensi_model->ambil_nilai('baris_1_komite');
			$data['baris2'] = $this->Referensi_model->ambil_nilai('baris_2_komite');
			$data['baris3'] = $this->Referensi_model->ambil_nilai('baris_3_komite');
			$data['baris4'] = $this->Referensi_model->ambil_nilai('baris_4_komite');
			$data['nama_ketua_komite'] = $this->Referensi_model->ambil_nilai('nama_ketua_komite');
			$data['lokasi'] = $this->Referensi_model->ambil_nilai('lokasi');
			$data['bendahara_komite'] = $this->Referensi_model->ambil_nilai('bendahara_komite');
			$this->load->view('shared/bg_atas_saja',$data);
			if($tipe_printer == 'Thermal')
			{
				$data['sek_nama'] = $this->Referensi_model->ambil_nilai('sek_nama');
				$data['nama_printer_pembayaran'] = $this->Referensi_model->ambil_nilai('nama_printer_pembayaran');
				$this->load->view('keuangan/kuitansi_thermal',$data);
			}
			else
			{
				$this->load->view('keuangan/kuitansi',$data);
			}

		}
		else
		{
			redirect('keuangan');
		}
	}	
	function semuatransaksi()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Semua Transaksi';
		$data["status"]=$this->session->userdata('tanda');
		$data["tahun1"] = $this->uri->segment(3);
		$this->load->model('Guru_model');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/transaksi_per_tahun',$data);
		$this->load->view('shared/bawah');	
	}	
	function buatsiswakelas()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Proses Riwayat Siswa per Tahun Pelajaran';
		$data["loncat"] = '';
		$thnajaran= cari_thnajaran();
		$this->load->model('Guru_model');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$this->load->model('Keuangan_model');
		$tahun1 = $this->uri->segment(3);
		if(empty($tahun1))
		{
			$tahun1 = substr($thnajaran,0,4);
	
		}
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$data['tahun1'] = $tahun1;
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/riwayat_kelas_siswa',$data);
		$this->load->view('shared/bawah');	
	}	
	function keluar2()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Pengeluaran';
		$data['namapengguna'] = $this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$aksi = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data_isi = '';
		$this->load->model('Keuangan_model');
		$besar=$this->input->post('besar');
		if(!empty($besar))
		{
			$id_keluar = nopetik($this->input->post('id_keluar'));
			$in['besar'] = nopetik($this->input->post('besar'));
			$sumber = nopetik($this->input->post('sumber'));
			if($sumber == '1')
			{
				$sumbere = 'Syahriyah';
			}
			elseif($sumber == '2')
			{
				$sumbere = 'dpm';
			}
			elseif($sumber == '3')
			{
				$sumbere = 'Infaq/jariyah';
			}
			else
			{
				$sumbere = '';
			}
			$in['sumber'] = $sumbere;
			$in['penerima'] = nopetik($this->input->post('penerima'));
			$in['keterangan'] = nopetik($this->input->post('keterangan'));
			$in['jenis'] = nopetik($this->input->post('jenis'));
			$tanggal = nopetik($this->input->post('tanggal'));
			$in['tanggal'] = tanggal_indonesia_ke_barat($tanggal);
			if(!empty($sumbere))
			{
				if(empty($id_keluar))
				{
					$this->Keuangan_model->Tambah_Pengeluaran($in);
				}
				else
				{
					$in['id_keluar'] = $id_keluar;
					$this->Keuangan_model->Perbarui_Pengeluaran($in);
				}
			}
		}
		if($aksi == 'tambah')
		{
			$data["judulhalaman"] = 'Tambah Pengeluaran';
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"] = 'Ubah Pengeluaran';
			$data['query'] = $this->Keuangan_model->Tampil_Pengeluaran($id);
		}
		elseif($aksi == 'hapus')
		{
			$this->Keuangan_model->Hapus_Pengeluaran($id);
			redirect('keuangan/keluar/tampil');
		}
		else
		{
			$this->load->library('Pagination');	
			$page=$this->uri->segment(4);
      			$limit_ti=10;
			if(!$page):
				$offset_ti = 0;
				else:
				$offset_ti = $page;
			endif;
			$thnajaran = cari_thnajaran();
			$query=$this->Keuangan_model->Tampil_Semua_Transaksi_Per_Thnajaran($thnajaran,$limit_ti,$offset_ti);
			$tot_hal = $this->Keuangan_model->Total_Semua_Transaksi_Per_Thnajaran($thnajaran);
      			$config['base_url'] = base_url() . 'keuangan/keluar/tampil';
       			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
        		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		if($aksi == 'cetak')
		{
			$data['query'] = $this->Keuangan_model->Tampil_Pengeluaran($id);
			$this->load->view('shared/bg_atas_saja',$data);
			$this->load->view('keuangan/bukti_pengeluaran',$data);

		}
		else
		{
			$data['aksi'] = $aksi;
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/keluar',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function kas($tahun=null,$bulan=null,$sumber=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Kas Dana Operasional';
		$data['namapengguna'] = $this->session->userdata('nama');
		$data["loncat"]= '';
		$data['tahun'] = $tahun;
		$data['bulan'] = $bulan;
		$data['sumber'] = $sumber;
		if((!empty($tahun)) and (!empty($bulan)) and (!empty($sumber)))
		{
			$this->load->model('Keuangan_model');
			if($sumber == '1')
			{
				$sumbere = 'Syahriyah';
				$data["judulhalaman"] = 'Kas Dana Operasional Syahriyah';
			}
			elseif($sumber == '2')
			{
				$sumbere = 'dpm';
				$data["judulhalaman"] = 'Kas Dana Operasional DPM';
			}

			else
			{
				$sumbere = 'infaq';
				$data["judulhalaman"] = 'Kas Dana Operasional Infaq/Jariyah';
			}
			$this->load->model('Referensi_model');
			$data['baris1'] = $this->Referensi_model->ambil_nilai('baris_1_komite');
			$data['baris2'] = $this->Referensi_model->ambil_nilai('baris_2_komite');
			$data['baris3'] = $this->Referensi_model->ambil_nilai('baris_3_komite');
			$data['baris4'] = $this->Referensi_model->ambil_nilai('baris_4_komite');
			$data['nama_ketua_komite'] = $this->Referensi_model->ambil_nilai('nama_ketua_komite');
			$data['lokasi'] = $this->Referensi_model->ambil_nilai('lokasi');
			$data['bendahara_komite'] = $this->Referensi_model->ambil_nilai('bendahara_komite');
			$data['qk'] = $this->Keuangan_model->Kas_Keluar($tahun,$bulan,$sumbere);
			$this->load->view('shared/bg_atas_cetak_komite_landscape',$data);
			if($sumber<4)
			{
				$this->load->view('keuangan/kas',$data);
			}
			else
			{
				$this->load->view('keuangan/kas_lain',$data);
			}


		}
		else
		{
			$this->load->model('Guru_model');
			$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/kas',$data);
			$this->load->view('shared/bawah');
		}
	}
	function pengeluaran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Laporan Pengeluaran Harian';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/pengeluaran',$data);
		$this->load->view('shared/bawah');	
	}	
	function cetakpengeluaran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Laporan Pengeluaran';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Keuangan_model');
		$tanggalhariini = $this->input->post('tanggalhariini');
		$bulanhariini = $this->input->post('bulanhariini');
		$tahunhariini = $this->input->post('tahunhariini');
		$hariini = "$tahunhariini-$bulanhariini-$tanggalhariini";
		$data["tanggalhariini"]="$tanggalhariini-$bulanhariini-$tahunhariini";
		$data["queryhariini"] = $this->Keuangan_model->Tampil_Data_Keluar_Hari_Ini($hariini);
		$this->load->view('shared/bg_atas_cetak',$data);
		$this->load->view('keuangan/cetak_pengeluaran',$data);
	}	
	function penerimaanlain()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Penerimaan / Pengembalian';
		$data["status"]=$this->session->userdata('tanda');
		$data_isi = array();
		$aksi = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$this->load->model('Keuangan_model');
		$besar = $this->input->post('besar');
		if($besar>0)
		{
			$in['tanggal'] = tanggal_indonesia_ke_barat($this->input->post('tanggal'));
			$in['keterangan'] = $this->input->post('keterangan');
			$in['jenis'] = $this->input->post('jenis');
			$id_penerimaan = $this->input->post('id_penerimaan');
			$in['besar'] = $besar;
			if(empty($id_penerimaan))
			{
				$in = nopetik($in);
				$this->Keuangan_model->Tambah_Penerimaan_Lain($in);	
			}
			else
			{
				$in['id_penerimaan'] = $this->input->post('id_penerimaan');
				$in = nopetik($in);
				$this->Keuangan_model->Perbarui_Penerimaan_Lain($in);	
			}
			

		}			
		if($aksi == 'tambah')
		{
			$data["judulhalaman"] = 'Tambah Penerimaan / Pengembalian';
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"] = 'Ubah Penerimaan / Pengembalian';
			$data['query'] = $this->Keuangan_model->Tampil_Penerimaan($id);
		}
		elseif($aksi == 'hapus')
		{
			$this->Keuangan_model->Hapus_Penerimaan($id);
			redirect('keuangan/penerimaanlain/tampil');
		}
		else
		{
			$this->load->library('Pagination');	
			$page=$this->uri->segment(4);
      			$limit_ti=10;
			if(!$page):
				$offset_ti = 0;
				else:
				$offset_ti = $page;
			endif;
			$query=$this->Keuangan_model->Tampil_Semua_Penerimaan_Lain($limit_ti,$offset_ti);
			$tot_hal = $this->Keuangan_model->Total_Semua_Penerimaan_Lain();
      			$config['base_url'] = base_url() . 'keuangan/penerimaanlain/tampil';
       			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
        		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}

		$data['aksi'] = $aksi;
		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/penerimaan_lain',$data_isi);
		$this->load->view('shared/bawah');
	}	
	function buku()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["namauser"]=$this->session->userdata('nama');
		$data["judulhalaman"] = 'Cetak Bukti Pembayaran';
		$data["status"]=$this->session->userdata('tanda');
		$data['nis'] = $this->uri->segment(3);
		$data['tahun1'] = $this->uri->segment(4);
		$data['semester'] = $this->uri->segment(5);
		$data['record'] = $this->uri->segment(6);
		$baris = $this->uri->segment(7);
		$data['baris'] = $baris;
		$data["loncat"] = '';
		if(!empty($baris))
		{
			$this->load->view('shared/bg_atas_saja',$data);
			$this->load->view('keuangan/cetak_buku',$data);

		}
		else
		{
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/buku',$data);
			$this->load->view('shared/bawah');
		}
	}
	function kartupembayaran()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Mencetak Kartu Pembayaran';
		$data["loncat"]= '';
		$lembar = $this->uri->segment(7);
		$tahun1 = $this->uri->segment(3);
		$semester = $this->uri->segment(4);
		$id_walikelas = $this->uri->segment(5);
		$this->load->model('Pengajaran_model');
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$nis = $this->uri->segment(6);
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		if(!empty($lembar))
		{
//			redirect('keuangan/cetak/'.$tahun1.'/'.$semester.'/'.$id_walikelas);
			$this->load->library('fpdf');
		        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
			$tahun2 = $tahun1 + 1;
			$thnajaran = $tahun1.'/'.$tahun2;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['kelas']= $kelas;
			$data['nis']= $nis;
			if($lembar == 'depan')
			{
			$this->load->view('pdf/kartu_pembayaran', $data);
			}
			elseif($lembar == 'belakang')
			{
			$this->load->view('pdf/kartu_pembayaran_belakang', $data);
			}
			else
			{

			}

		}
		else
		{
			$data_isi['lembar'] = $lembar;
			$data_isi['tahun1'] = $tahun1;
			$data_isi['semester'] = $semester;
			$data_isi['id_walikelas'] = $id_walikelas;
			$data_isi['kelas'] = $kelas;
			$data_isi['nis'] = $nis;
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/kartu_pembayaran',$data_isi);
			$this->load->view('shared/bawah');
		}
	}
	function cetak()
	{
	    // Load library FPDF 
		$this->load->library('fpdf');
	        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$tahun1 = $this->uri->segment(3);
		$semester = $this->uri->segment(4);
		$id_walikelas = $this->uri->segment(5);
		$this->load->model('Pengajaran_model');
		$kelas = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$data['kelas']= $kelas;
		if ((!empty($semester)) and (!empty($thnajaran)) and (!empty($kelas)))
	       	{
			$this->load->view('pdf/kartu_pembayaran', $data);
		}
		else
		{
			redirect('keuangan/kartupembayaran');
		}
	}
	function massal()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Terima Pembayaran Massal';
		$data["loncat"]= '';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
       		$data_isi['daftarkelas'] = $querykelas ;
		$data_isi['tahun1'] = $this->uri->segment(3);
		$data_isi['semester'] = $this->uri->segment(4);
		$tahun1 = $this->uri->segment(3);
		$semester = $this->uri->segment(4);
		$id_walikelas = $this->uri->segment(5);
		$id_macam_pembayaran = $this->uri->segment(6);
		$data_isi['daftar_tapel'] = $query;
		$this->load->model('Pengajaran_model');
		$data_isi['kelas'] = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$this->load->model('Keuangan_model');
		$data_isi['id_walikelas'] = $id_walikelas;
		$cacah = $this->input->post('cacah');
		$data_isi['id_macam_pembayaran'] = $id_macam_pembayaran;
		$data_isi['pesan'] = $this->uri->segment(7);
		$hapus = $this->uri->segment(8);
		$id_siswa_bayar = $this->uri->segment(9);
		if($cacah >0)
		{
//			redirect('ddd');
			$tanggalhadir =$this->input->post('tanggalhadir');
			$bulanhadir =$this->input->post('bulanhadir');
			$tahunhadir =$this->input->post('tahunhadir');
			$thnajaranini= cari_thnajaran();
			$tanggalbayar = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$macam_pembayaran=$this->input->post('macam_pembayaran');
			for($i=1;$i<=$cacah;$i++)
			{
				$besar = $this->input->post('besar_'.$i);
				if($besar > 0)
				{
					$keterangan=$this->input->post('keterangan_'.$i);
					$nis = $this->input->post("nis_$i");
					$in["thnajaran"] = $thnajaranini;
					$in["besar"] = $besar;
					$in["nis"] = $nis;
					$in["tanggal"] = $tanggalbayar;
					$in["besar"] = $besar;
					$in["keterangan"] = $keterangan;
					$in["macam_pembayaran"] = $macam_pembayaran;
					$in["user"]= $data["nim"];
					$this->Keuangan_model->Simpan_Data_Pembayaran_Siswa($in);
				}

			}
				redirect('keuangan/massal/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/'.$id_macam_pembayaran.'/sukses');
		}
		if($hapus == 'hapus')
		{
			$this->Keuangan_model->Hapus_Pembayaran_Siswa($id_siswa_bayar);
			redirect('keuangan/massal/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/'.$id_macam_pembayaran.'/sukses');
		}

		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/terima_massal',$data_isi);
		$this->load->view('shared/bawah');
	}
	function massal2()
	{
		$data=array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Terima Pembayaran Massal Versi 2';
		$data["loncat"]= '';
		$this->load->model('Admin_model');
		$query=$this->Admin_model->Tampil_Semua_Tahun();
       		$data_isi['daftartahun'] = $query ;
		$querykelas=$this->Admin_model->Tampil_Semua_Kelas();
       		$data_isi['daftarkelas'] = $querykelas ;
		$data_isi['tahun1'] = $this->uri->segment(3);
		$data_isi['semester'] = $this->uri->segment(4);
		$tahun1 = $this->uri->segment(3);
		$semester = $this->uri->segment(4);
		$id_walikelas = $this->uri->segment(5);
		$data_isi['daftar_tapel'] = $query;
		$this->load->model('Pengajaran_model');
		$data_isi['kelas'] = $this->Pengajaran_model->id_walikelas_jadi_kelas($id_walikelas);
		$this->load->model('Keuangan_model');
		$data_isi['id_walikelas'] = $id_walikelas;
		$cacah = $this->input->post('cacah');
		$data_isi['pesan'] = $this->uri->segment(6);
		$hapus = $this->uri->segment(7);
		$id_siswa_bayar = $this->uri->segment(8);
		if($cacah >0)
		{
			$tanggalhadir =$this->input->post('tanggalhadir');
			$bulanhadir =$this->input->post('bulanhadir');
			$tahunhadir =$this->input->post('tahunhadir');
			$thnajaranini= cari_thnajaran();
			$tanggalbayar = "$tahunhadir-$bulanhadir-$tanggalhadir";
			for($i=1;$i<=$cacah;$i++)
			{
				$besar = $this->input->post('besar_'.$i);
				$keterangan=$this->input->post('keterangan_'.$i);
				$macam_pembayaran=$this->input->post('macam_pembayaran_'.$i);
				$nis = $this->input->post("nis_$i");
				if($besar>0)
				{
					$in["thnajaran"] = $thnajaranini;
					$in["besar"] = $besar;
					$in["nis"] = $nis;
					$in["tanggal"] = $tanggalbayar;
					$in["besar"] = $besar;
					$in["keterangan"] = $keterangan;
					$in["macam_pembayaran"] = $macam_pembayaran;
					$in["user"]= $data["nim"];
					$this->Keuangan_model->Simpan_Data_Pembayaran_Siswa($in);
				}

			}
				redirect('keuangan/massal2/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/sukses');
		}
		if($hapus == 'hapus')
		{
			$this->Keuangan_model->Hapus_Pembayaran_Siswa($id_siswa_bayar);
			redirect('keuangan/massal2/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/sukses');
		}

		$this->load->view('keuangan/bg_atas',$data);
		$this->load->view('keuangan/bg_menu',$data);
		$this->load->view('keuangan/terima_massal_2',$data_isi);
		$this->load->view('shared/bawah');
	}
	function macampengeluaran()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Macam Pengeluaran';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Keuangan_model');
		$kd = $this->uri->segment(3);
		$data["query"]=$this->Keuangan_model->Daftar_Macam_Pengeluaran();
		$data["querysumber"]=$this->Keuangan_model->Daftar_Macam_Pembayaran_Aktif();
		$data['datapengeluaran'] =$this->Keuangan_model->Macam_Pengeluaran($kd);
		$data["kd"]=$kd;
		$in=array();
		$in["jenis"] = $this->input->post('nama');
		$in["sumber"] = $this->input->post('sumber');
		$in["id_jenis"]=$this->input->post('kd');
		if ((!empty($in["jenis"])) and (!empty($in["sumber"])))
		{
			$this->Keuangan_model->Simpan_Macam_Pengeluaran($in);
			redirect('keuangan/macampengeluaran');
		}
		else
		{
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/macam_pengeluaran',$data);
			$this->load->view('shared/bawah');	
		}
	}	
	function pilihmacampembayaran()
	{
		$sumber =$this->input->post('id');
		if($sumber == '1')
		{
			$sumbere = 'syahriyah';
		}
		elseif($sumber == '2')
		{
			$sumbere = 'dpm';
		}
		elseif($sumber == '3')
		{
			$sumbere = 'infaq/jariyah';
		}
		else
		{
			$sumbere = '';
		}
		if($sumber > 3)
		{
			$ta = $this->db->query("select * from `m_penerimaan` where `nomor`='$sumber'");
			foreach($ta->result() as $data )
			{
				$sumbere = $data->macam_penerimaan;
			}
		}
		$this->load->model('Keuangan_model');
		echo $this->Keuangan_model->Pilih_Jenis_Pengeluaran($sumbere);
		//redirect('dasdasdasd');
	}
	function keluar()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Pengeluaran';
		$data['namapengguna'] = $this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$aksi = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data_isi = '';
		$this->load->model('Keuangan_model');
		$besar=$this->input->post('besar');
		if(!empty($besar))
		{
			$id_keluar = nopetik($this->input->post('id_keluar'));
			$in['besar'] = nopetik($this->input->post('besar'));
			$sumber = nopetik($this->input->post('sumber'));
			if($sumber == '1')
			{
				$sumbere = 'Syahriyah';
			}
			elseif($sumber == '2')
			{
				$sumbere = 'dpm';
			}
			elseif($sumber == '3')
			{
				$sumbere = 'Infaq/jariyah';
			}
			else
			{
				$sumbere = '';
			}
			if($sumber > 3)
			{
				$ta = $this->db->query("select * from `m_penerimaan` where `nomor`='$sumber'");
				foreach($ta->result() as $data )
				{
					$sumbere = $data->macam_penerimaan;
				}
			}

			$in['sumber'] = $sumbere;
			$in['penerima'] = nopetik($this->input->post('penerima'));
			$in['keterangan'] = nopetik($this->input->post('keterangan'));
			$in['jenis'] = nopetik($this->input->post('jenis'));
			$tanggal = nopetik($this->input->post('tanggal'));
			$in['tanggal'] = tanggal_indonesia_ke_barat($tanggal);
			if(!empty($sumbere))
			{
				if(empty($id_keluar))
				{
					$this->Keuangan_model->Tambah_Pengeluaran($in);
				}
				else
				{
					$in['id_keluar'] = $id_keluar;
					$this->Keuangan_model->Perbarui_Pengeluaran($in);
				}
				redirect('keuangan/keluar/tampil');
			}

		}
		if($aksi == 'tambah')
		{
			$data["judulhalaman"] = 'Tambah Pengeluaran';
		}
		elseif($aksi == 'ubah')
		{
			$data["judulhalaman"] = 'Ubah Pengeluaran';
			$data['query'] = $this->Keuangan_model->Tampil_Pengeluaran($id);
		}
		elseif($aksi == 'hapus')
		{
			$this->Keuangan_model->Hapus_Pengeluaran($id);
			redirect('keuangan/keluar2/tampil');
		}
		else
		{
			$this->load->library('Pagination');	
			$page=$this->uri->segment(4);
      			$limit_ti=10;
			if(!$page):
				$offset_ti = 0;
				else:
				$offset_ti = $page;
			endif;
			$thnajaran = cari_thnajaran();
			$query=$this->Keuangan_model->Tampil_Semua_Transaksi($limit_ti,$offset_ti);
			$tot_hal = $this->Keuangan_model->Total_Semua_Transaksi();
      			$config['base_url'] = base_url() . 'keuangan/keluar/tampil';
       			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit_ti;
			$config['uri_segment'] = 4;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
        		$data_isi = array('query' => $query,'paginator'=>$paginator, 'page'=>$page);
		}
		if($aksi == 'cetak')
		{
			$this->load->model('Referensi_model');
			$data['baris1'] = $this->Referensi_model->ambil_nilai('baris_1_komite');
			$data['baris2'] = $this->Referensi_model->ambil_nilai('baris_2_komite');
			$data['baris3'] = $this->Referensi_model->ambil_nilai('baris_3_komite');
			$data['baris4'] = $this->Referensi_model->ambil_nilai('baris_4_komite');
			$data['bendahara_komite'] = $this->Referensi_model->ambil_nilai('bendahara_komite');
			$data['query'] = $this->Keuangan_model->Tampil_Pengeluaran($id);
			$this->load->view('shared/bg_atas_saja',$data);
			$this->load->view('keuangan/bukti_pengeluaran',$data);

		}
		else
		{
			$data['aksi'] = $aksi;
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/keluar',$data_isi);
			if(empty($aksi))
			{
				$this->load->view('shared/bawah');
			}
		}
	}
	function macamnonkomite($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Data Induk Macam Pembayaran Non Komite';
		$data["status"]=$this->session->userdata('tanda');
		$nama_tunggakan = hilangkanpetik($this->input->post('nama_tunggakan'));
		$id = hilangkanpetik($id);
		$data['id'] = $id;
		if (!empty($nama_tunggakan))
		{
			if(empty($id))
			{
				$this->db->query("insert into `non_komite_macam` (`nama_tunggakan`) values ('$nama_tunggakan')");

			}
			else
			{
				$this->db->query("update `non_komite_macam` set `nama_tunggakan`='$nama_tunggakan' where `id`='$id'");
			}
			redirect('keuangan/macamnonkomite');
		}
		else
		{
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/macam_non_komite',$data);
			$this->load->view('shared/bawah');	
		}
	}	
	function tunggakannonkomite($nis=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Data Tunggakan Pembayaran Non Komite';
		$data["status"]=$this->session->userdata('tanda');
		$id_non_komite = hilangkanpetik($this->input->post('id_non_komite'));
		$besar = hilangkanpetik($this->input->post('besar'));
		$data['nis'] = $nis;
		$data['id'] = $id;
		if ((empty($id)) and (!empty($id_non_komite)) and ($besar > 0) and (!empty($nis)))
		{ 
			$this->db->query("insert into `non_komite_besar` (`nis`, `id_non_komite`, `besar`) values ('$nis','$id_non_komite', '$besar')");
			redirect('keuangan/tunggakannonkomite/'.$nis);
		}
		elseif ((!empty($id)) and (!empty($id_non_komite)) and ($besar > 0) and (!empty($nis)))
		{ 
			$this->db->query("update `non_komite_besar` set `id_non_komite`='$id_non_komite', `besar`='$besar' where `nis`='$nis' and `id`='$id'");
			redirect('keuangan/tunggakannonkomite/'.$nis);
		}

		else
		{
			
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/tunggakan_non_komite',$data);
			$this->load->view('shared/bawah');	
		}
	}
	function batal($nis=null)
	{
		$this->db->query("delete from `siswa_proses_bayar` where `nis`='$nis'");
		redirect('keuangan/aim');
	}
	function bayar($nis=null,$tahun1=null,$semester=null,$besar=null)
	{
		$this->load->model('Referensi_model','ref');
		$jenis_printer_pembayaran = $this->ref->ambil_nilai('jenis_printer_pembayaran');
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Penerimaan Pembayaran';
		$data["status"]=$this->session->userdata('tanda');
		if(empty($tahun1))
		{
			$tahun1 = substr(cari_thnajaran(),0,4);
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}

		if((empty($nis)) or (empty($tahun1)) or (empty($semester)))
		{
			redirect('keuangan/siswa');
		}
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		$this->load->model('Keuangan_model');			
		$ta = $this->Keuangan_model->Detil_Siswa($nis);
		$adata = $ta->num_rows();
		$tanggalbayar = tanggal_hari_ini();
		if($adata>0)
		{
			$tanggalhadir =$this->input->post('tanggalhadir');
			$bulanhadir =$this->input->post('bulanhadir');
			$tahunhadir =$this->input->post('tahunhadir');
			$cacah_item =$this->input->post('cacah_item');
			$cacah_item2 =$this->input->post('cacah_item2');
			$thnajaranini=$this->input->post('thnajaranini');
			$in["nis"]=$nis;
			$tanggalbayar = "$tahunhadir-$bulanhadir-$tanggalhadir";
			$kunci=$this->input->post('nama');
			$data["daftar_pembayaran"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa_Thnajaran($nis,$thnajaran);
			$data["daftar_semua_pembayaran"]=$this->Keuangan_model->Daftar_Pembayaran_Siswa($nis);
			$data["daftar_semua_pembayaran_non_komite"]=$this->Keuangan_model->Daftar_Pembayaran_Non_Komite_Siswa($nis);
			$jumlah = 0;
			if(($cacah_item>0) or ($cacah_item2>0))
			{

				$url_sms_post = $this->ref->ambil_nilai('url_sms_post');
				$sek_nama = $this->ref->ambil_nilai('sek_nama');
				$nohp = cari_seluler_orangtua($nis);
				$pesan = '';
				for($i=0;$i<=$cacah_item;$i++)
				{
					$besar = $this->input->post('besar_'.$i);
					$jumlah = $jumlah + $besar;
//					redirect('keuangan222/aa'.$besar);
					$macam_pembayaran=$this->input->post('macam_pembayaran_'.$i);
					$keterangan=$this->input->post('keterangan_'.$i);
					if ((!empty($nis)) and (!empty($besar)) and (!empty($tanggalbayar)) and (!empty	($macam_pembayaran)))
					{
						$in=array();
						$in["thnajaran"] = $thnajaran;
						$in["besar"] = $besar;
						$in["nis"] = $nis;
						$in["tanggal"] = $tanggalbayar;
						$in["besar"] = $besar;
						$in["keterangan"] = $keterangan;
						$in["macam_pembayaran"] = $macam_pembayaran;
						$in["user"]=$data["nim"];
						$in = hilangkanpetik($in);
						$param=array();
						$this->Keuangan_model->Simpan_Data_Pembayaran_Siswa($in);
						if($i==0)
						{
							$pesan .= $macam_pembayaran.' sebesar '.xduit($besar);
						}
						else
						{
							$pesan .= ', '.$macam_pembayaran.' sebesar '.xduit($besar);
						}
						if(!empty($keterangan))
						{
							$pesan .= ' ('.$keterangan.')';
						}
					}
				}
				for($i=0;$i<=$cacah_item2;$i++)
				{
					$besar = $this->input->post('besar2_'.$i);
					$macam_pembayaran=$this->input->post('macam_pembayaran2_'.$i);
					$jumlah = $jumlah + $besar;
//					redirect('keuangan222/aa'.$besar);
					$id_non_komite=$this->input->post('id_non_komite_'.$i);
					$keterangan=$this->input->post('keterangan2_'.$i);
					if ((!empty($nis)) and (!empty($besar)) and (!empty($tanggalbayar)) and (!empty	($id_non_komite)))
					{
						$in=array();
						$in["thnajaran"] = $thnajaran;
						$in["besar"] = $besar;
						$in["nis"] = $nis;
						$in["tanggal"] = $tanggalbayar;
						$in["besar"] = $besar;
						$in["keterangan"] = $keterangan;
						$in["id_non_komite"] = $id_non_komite;
						$in["user"]=$data["nim"];
						$in = hilangkanpetik($in);
						$param=array();
						$this->Keuangan_model->Simpan_Data_Pembayaran_Non_Komite_Siswa($in);
						if($i==0)
						{
							$pesan .= $macam_pembayaran.' sebesar '.xduit($besar);
						}
						else
						{
							$pesan .= ', '.$macam_pembayaran.' sebesar '.xduit($besar);
						}
						if(!empty($keterangan))
						{
							$pesan .= ' ('.$keterangan.')';
						}
					}
				}

				$pesan = 'Kami telah menerima pembayaran a.n. '.nis_ke_nama($nis).' sejumlah '.xduit($jumlah).' dengan rincian berikut '.$pesan.'. '.$sek_nama;
				if((!empty($url_sms_post)) and (!empty($nohp)))
				{
					$this->load->helper('telegram');
					$kirim = postsms($url_sms_post,$nohp,$pesan);
				}
				$this->db->query("delete from `siswa_proses_bayar` where `nis`='$nis'");
			}
		}
		else
		{
			redirect('keuangan/siswa');
		}
		$data['tanggal'] = $tanggalbayar;
		$data['nis'] = $nis;
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$data["namauser"]=$this->session->userdata('nama');
		if($jenis_printer_pembayaran == 'Thermal')
		{
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$data['nama_printer_pembayaran'] = $this->ref->ambil_nilai('nama_printer_pembayaran');
			$this->load->view('keuangan/kuitansi_mandiri_thermal',$data);
		}
		else
		{
			$data['baris1'] = $this->ref->ambil_nilai('baris_1_komite');
			$data['baris2'] = $this->ref->ambil_nilai('baris_2_komite');
			$data['baris3'] = $this->ref->ambil_nilai('baris_3_komite');
			$data['baris4'] = $this->ref->ambil_nilai('baris_4_komite');
			$data['lokasi'] = $this->ref->ambil_nilai('lokasi');
			$this->load->view('shared/bg_atas_saja',$data);
			$this->load->view('keuangan/kuitansi_mandiri',$data);
		}

	}
	function mutasi($id=null, $nis=null,$tahun1=null,$semester=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Penerimaan Pembayaran';
		$data["status"]=$this->session->userdata('tanda');
		if((empty($nis)) or (empty($tahun1)) or (empty($semester)) or (empty($id)))
		{
			redirect('keuangan/siswa');
		}
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
		redirect('keuangan/terima/'.$nis.'/'.$tahun1.'/'.$semester);
	}
	function macampenerimaan($nomor=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Data Induk Macam Penerimaan Non Pembayaran Siswa';
		$data["status"]=$this->session->userdata('tanda');
		$macam_penerimaan =  hilangkanpetik($this->input->post('macam_penerimaan'));
		$data['nomor'] = $nomor;
		$post_nomor =  hilangkanpetik($this->input->post('nomor'));
		if ((!empty($macam_penerimaan)) and (!empty($post_nomor)))
		{
			$ta = $this->db->query("select * from `m_penerimaan` where `nomor`='$post_nomor'");
			if($ta->num_rows() == 0)
			{
				$this->db->query("insert into `m_penerimaan` (`macam_penerimaan`, `nomor`) values ('$macam_penerimaan', '$post_nomor')");
			}
			redirect('keuangan/macampenerimaan');
		}
		elseif ((!empty($macam_penerimaan)) and (!empty($nomor)))
		{
			$this->db->query("update `m_penerimaan` set `macam_penerimaan` = '$macam_penerimaan' where `nomor`='$nomor'");
			redirect('keuangan/macampenerimaan');
		}

		else
		{
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/macam_penerimaan',$data);
			$this->load->view('shared/bawah');	
		}
	}
	function entrypenerimaan($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"] = 'Daftar Penerimaan Non Pembayaran Siswa';
		$data["status"]=$this->session->userdata('tanda');
		$data["id"]=$id;
		$besar =  hilangkanpetik($this->input->post('besar'));
		$besar = preg_replace("/ /","", $besar);
		$besar = preg_replace("/Rp/","", $besar);
		$besar = preg_replace("/\./","", $besar);
		$tanggal = $this->input->post('tanggal');
		$tanggal = tanggal_indonesia_ke_barat($tanggal);
		$id_m_penerimaan =  hilangkanpetik($this->input->post('id_m_penerimaan'));
		if ($besar>0)
		{
			if(empty($id))
			{
				$this->db->query("insert into `penerimaan` (`besar`, `tanggal`, `id_m_penerimaan`) values ('$besar', '$tanggal', '$id_m_penerimaan')");
			}
			else
			{
				$this->db->query("update `penerimaan` set `besar` = '$besar', `tanggal` = '$tanggal', `id_m_penerimaan` = '$id_m_penerimaan' where `id`='$id'");
			}
			redirect('keuangan/entrypenerimaan');
		}
		else
		{
			$this->load->view('keuangan/bg_atas',$data);
			$this->load->view('keuangan/bg_menu',$data);
			$this->load->view('keuangan/entry_penerimaan',$data);
			$this->load->view('shared/bawah');	
		}
	}	

}//akhir fungsi

?>
