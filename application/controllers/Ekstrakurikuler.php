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
class Ekstrakurikuler extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'fungsi'));
		$this->load->database();
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
		redirect('guru');
	}
	function borang($thn1=null,$semester=null)
	{
		$nim=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($nim);	
		$thn2 = $thn1 + 1;
		$thnajaran = $thn1.'/'.$thn2;
		if(empty($thn1))
		{
			$thnajaran = cari_thnajaran();
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		$tcacah = $this->Guru_model->Cek_Guru_Ekstra($thnajaran,$semester,$kodeguru);
		$cacah = $tcacah->num_rows();
		if($cacah == 0)
		{
			redirect('guru/ekstrakurikuler');
		}
		else
		{
			$data['judulhalaman'] = 'Borang Unggah Nilai Ekstrakurikuler';
			$data['nim'] = $nim;
			$data['thnajaran'] = $thnajaran;
			$data['semester'] = $semester;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/borang_unggah_nilai_ekstrakurikuler',$data);
			$this->load->view('shared/bawah');
		}
	}
	function proses($thn1=null,$semester=null)
	{
		$input=array();
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$this->load->library('csvimport');
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] ='csv';
		$config['overwrite'] = TRUE;
		$filename = 'nilai_ekstra_'.$data["nim"].'.csv';	
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$datay['modul'] = 'Unggah Nilai Esktrakurikuler';
		$datay['tautan_balik'] = ''.base_url().'ekstrakurikuler/borang';
		$thn2 = $thn1 + 1;
		$thnajaran = $thn1.'/'.$thn2;
		if(empty($thn1))
		{
			$thnajaran = cari_thnajaran();
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}

		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
				$data['judulhalaman'] =' Galat, unggah berkas';
				$datay['pesan'] = $this->upload->display_errors();
				$datay['tautan_balik'] = ''.base_url().'ekstrakurikuler/borang';
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);

			}
			else 
			{
				$pbk['thnajaran'] = $thnajaran;
				$pbk['semester'] = $semester;
				$filePath = 'uploads/'.$filename;
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
						$pbk['nis'] = $nis;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' NIS';
						$pbk['nis'] = '';
					}
					if(isset($field['nilai']))
					{
						$pbk['nilai'] = nopetik($field['nilai']);
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' Nilai';
						$pbk['nilai'] = '';
					}
					if(isset($field['nama_ekstra']))
					{
						$nama_ekstra = nopetik($field['nama_ekstra']);
						$pbk['nama_ekstra'] = $nama_ekstra;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' Nama Ekstra';
						$pbk['nama_ekstra'] = '';
					}
					if(isset($field['deskripsi']))
					{
						$deskripsi = nopetik($field['deskripsi']);
						$pbk['keterangan'] = $deskripsi;
					}
					else
					{
						$adagalat = 1;
						$pesan .= ' Deskripsi';
						$pbk['keterangan'] = '';
					}

					if ($adagalat==0)
					{
						$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
						$tada = $this->Guru_model->Cek_Nilai_Ekstrakurikuler($thnajaran,$semester,$nama_ekstra,$nis);
						$adat = $tada->num_rows();
						if($adat == 0)
						{
							$this->Guru_model->Tambah_Nilai_Ekstrakurikuler($thnajaran,$semester,$kelas,$nama_ekstra,$nis);
						}
						$pbk['kelas'] = $kelas;
						$pbk['status'] = 'Y';
						$this->Guru_model->Ubah_Nilai_Ekstrakurikuler($pbk);
					}
					$pesan .= ' TIDAK ADA<br />';
					$n++;
				endforeach;
				unlink($filePath);
				$datay['pesan'] = $pesan;
				if($adagalat==1)
				{
					$data['judulhalaman'] =' Galat, unggah berkas';
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('shared/bawah',$data);
				}
				else
				{
					redirect('guru/ekstrakurikuler');
				}
			}
		}
		else
		{
			redirect('guru');
		}
	}//akhir fungsi proses impor nilai
	function ekstrakurikuler($thn1=null,$semester=null,$id_pengampu_ekstra=null,$aksi=null,$id_siswa_ekstra=null)
	{
		$this->load->helper(array('form'));
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Nilai Ekstrakurikuler';
		$data['loncat'] = '';
		$thn2 = $thn1 + 1;
		$thnajaran = $thn1.'/'.$thn2;
		if(empty($thn1))
		{
			$thnajaran = cari_thnajaran();
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		$this->load->model('Guru_model');
		if($aksi == 'hapus')
		{
			$this->Guru_model->Hapus_Siswa_Ekstra($id_siswa_ekstra);
			redirect('guru/ekstrakurikuler/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra);
		}
		$kodeguru = $data["nim"];
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data["kodeguru"]=$kodeguru;
		$data['id_pengampu_ekstra']=$id_pengampu_ekstra;
		$data['proses'] = hilangkanpetik($this->input->post('proses'));
		$data['thnajaran'] = $thnajaran;
		$data['semester'] = $semester;
		if ($data['proses']=='oke')
			{
			$data['nis'] = nopetik($this->input->post('nis'));
			$data['nilai'] = nopetik($this->input->post('nilai'));
			$data['keterangan'] = nopetik($this->input->post('keterangan'));
			}
		if((!empty($thn1)) and (!empty($semester)) and (!empty($id_pengampu_ekstra)))
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/daftar_nilai_ekstrakurikuler',$data);
			$this->load->view('shared/bawah');

		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/ekstrakurikuler',$data);
			$this->load->view('shared/bawah');
		}
	}
	function jurnal($thn1=null,$semester=null,$id_pengampu_ekstra=null,$aksi=null,$id=null)
	{
		$this->load->helper(array('form'));
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$nim = $this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Jurnal Ekstrakurikuler';
		$data['loncat'] = '';
		$thn2 = $thn1 + 1;
		$thnajaran = $thn1.'/'.$thn2;
		if(empty($thn1))
		{
			$thnajaran = cari_thnajaran();
		}
		if(empty($semester))
		{
			$semester = cari_semester();
		}
		$this->load->model('Guru_model');
		if($aksi == 'hapus')
		{
			$this->db->query("delete from `jurnal_ekstrakurikuler` where `id`='$id' and `kodeguru`='$nim'");
			redirect('ekstrakurikuler/jurnal/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra);
		}
		$kodeguru = $data["nim"];
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data["kodeguru"]=$kodeguru;
		$data['id_pengampu_ekstra']=$id_pengampu_ekstra;
		$data['proses'] = hilangkanpetik($this->input->post('proses'));
		$data['thnajaran'] = $thnajaran;
		$data['semester'] = $semester;
		if ($aksi=='baru')
		{
			$tanggal = $this->input->post('tanggal');
			$tanggal = nopetik( tanggal_indonesia_ke_barat($tanggal));
			$nama_ekstra = nopetik($this->input->post('nama_ekstra'));
			$keterangan = nopetik($this->input->post('keterangan'));
			$this->db->query("insert into `jurnal_ekstrakurikuler` (`thnajaran`, `semester`, `kodeguru`, `tanggal`, `keterangan`)  values ('$thnajaran', '$semester', '$nim', '$tanggal', '$keterangan')");
			$aksi = '';
			$x = substr($tanggal,0,4);
			$y = substr($tanggal,5,2);
			$z = substr($tanggal,8,2);
			$bulan = angka_jadi_bulan($y);
			$kegiatan = 'melaksanakan pembimbingan ekstrakurikuler di bulan '.$bulan.' '.$x;
			$tc = $this->db->query("select * FROM `p_pegawai` where `kd`='$nim'");
			$nip = '';
			foreach($tc->result() as $c)
			{
				$nip = $c->nip;
				$pns = $c->status_kepegawaian;
			}
			if(($pns == 'PNS') or ($pns == 'CPNS'))
			{
				$td = $this->db->query("select * from `sieka_bulanan` where `tahun`='$x' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
				$id_bulanan = '';
				foreach($td->result() as $d)
				{
					$id_bulanan = $d->id_bulanan;
				}
				$tb = $this->db->query("select * FROM `sieka_harian` where `kegiatan`='$keterangan' and `tanggal`='$tanggal' and `nip`='$nip'");
				if($tb->num_rows() == 0)
				{
					if(!empty($id_bulanan))
					{
						$this->db->query("insert into `sieka_harian` (`tahun`, `nip`, `kegiatan`, `tanggal`, `id_bulanan`, `jam_mulai`, `menit_mulai`, `jam_selesai`, `menit_selesai`, `kuantitas`, `satuan`) values ('$x','$nip', '$keterangan', '$tanggal', '$id_bulanan', '14', '30', '16', '00','2', 'jam tatap muka')");
					}
				}
			}
		}
		$data['aksi'] = $aksi;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/jurnal_ekstrakurikuler',$data);
		$this->load->view('shared/bawah');
	}

/* akhir controller */
}
?>
