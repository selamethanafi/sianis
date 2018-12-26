<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 17 Jan 2016 09:21:58 WIB 
// Nama Berkas 		: Kepala.php
// Lokasi      		: application/controllers
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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

/**
 * Sistem Informasi Madrasah Aliyah 
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
?>
<?php
class Kepala extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi','pkg'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="Kepala")
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
		$data['judulhalaman'] = '';
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function csstema()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]= 'kepala';
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
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('shared/ganti_css',$data);
		$this->load->view('shared/bawah');
	}

	function perangkat()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Perangkat Guru';
		$data['yangdicetak']=$this->input->post('yangdicetak');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['ulangan']=$this->input->post('ulangan');
		$data['namaguru'] = cari_nama_pegawai($this->input->post('kodeguru'));
		$data['kelas'] = id_mapel_jadi_kelas($data['id_mapel']);
		$data['mapel'] = id_mapel_jadi_mapel($data['id_mapel']);
		$data['tugastambahan'] = $data['mapel'].' '.$data['kelas'].' '.$data['thnajaran'].' smt '.$data['semester'];
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');	
		if ($diproses != 'oke') 
			{
			$this->load->view('kepala/bg_atas',$data);
			$this->load->view('shared/form_mencetak_perangkat',$data);
			$this->load->view('shared/bawah');

			}
		if ($diproses == 'oke') 
			{
			if ($data['yangdicetak'] == 'Analisis')
				{
				$data['sms']=1;
				$this->load->view('shared/mencetak_analisis_ulangan_lengkap',$data);
				}
			elseif ($data['yangdicetak'] == 'Penilaian Kinerja Guru')
				{
				$this->load->view('shared/mencetak_penilaian_kinerja_guru',$data);
				}
			elseif ($data['yangdicetak'] == 'Catatan Hambatan Belajar Siswa')
				{
				$this->load->view('shared/mencetak_catatan_hambatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Hambatan Belajar Siswa')
				{
				$this->load->view('shared/mencetak_hambatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Laporan Capaian Kompetensi')
				{
				$this->load->view('shared/mencetak_lck',$data);
				}
			elseif ($data['yangdicetak'] == 'Laporan Hasil Belajar')
				{
				$this->load->view('shared/mencetak_lhb_mapel',$data);
				}
			elseif ($data['yangdicetak'] == 'Deskripsi Laporan Capaian Kompetensi')
				{
				$this->load->view('shared/mencetak_deskripsi_lck',$data);
				}
			elseif ($data['yangdicetak'] == 'Rencana Pelaksanaan Harian')
				{
				$this->load->view('shared/mencetak_rph',$data);
				}
			elseif ($data['yangdicetak'] == 'Rencana Pelaksanaan Pembelajaran')
				{
				$this->load->view('shared/mencetak_rencana_pelaksanaan_pembelajaran',$data);
				}
			elseif ($data['yangdicetak'] == 'Buku Pelaksanaan Harian')
				{
				$this->load->view('shared/mencetak_bph',$data);
				}
			elseif ($data['yangdicetak'] == 'Buku Pengembalian Ulangan')
				{
				$this->load->view('shared/mencetak_bpu',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Hadir Siswa')
				{
				$this->load->view('shared/mencetak_kehadiran',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Akhlak')
				{
				$this->load->view('shared/mencetak_akhlak',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Kognitif')
				{
				$this->load->view('shared/mencetak_daftar_nilai_kognitif',$data);
				}

			elseif ($data['yangdicetak'] == 'Buku Informasi Penilaian')
				{
				$this->load->view('shared/mencetak_informasi_penilaian',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Buku Pegangan')
				{
				$this->load->view('shared/mencetak_daftar_buku_pegangan',$data);
				}
			elseif ($data['yangdicetak'] == 'Buku Tugas')
				{
				$this->load->view('shared/mencetak_daftar_tugas',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Psikomotor')
				{
				$this->load->view('shared/mencetak_daftar_nilai_psikomotor',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Afektif')
				{
				$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
				}
			elseif ($data['yangdicetak'] == 'Jurnal Piket')
				{
				$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
				}

			else
				{
				redirect('kepala/perangkat');
				}
			}
	}
	function perangkattambahan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data["tanggal"] = mdate($datestring, $time);
		$data['yangdicetak']=$this->input->post('yangdicetak');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['namaguru'] = cari_nama_pegawai($this->input->post('kodeguru'));
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');	
		if ($diproses != 'oke') 
			{
			$this->load->view('kepala/bg_atas',$data);
			$this->load->view('shared/form_mencetak_perangkat_tambahan',$data);
			$this->load->view('shared/bawah');

			}
		if ($diproses == 'oke') 
			{
			if ($data['yangdicetak'] == 'Agenda Harian')
				{
				$this->load->view('shared/mencetak_agenda_harian',$data);
				}
			elseif ($data['yangdicetak'] == 'Analisis Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_analisis_pelaksanaan_kegiatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Laporan Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_laporan_pelaksanaan_kegiatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Program Kerja')
				{
				$this->load->view('shared/mencetak_program_kerja',$data);
				}
			elseif ($data['yangdicetak'] == 'Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_pelaksanaan_kegiatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Tindak Lanjut Pelaksanaan Kegiatan')
				{
				$this->load->view('shared/mencetak_tindak_lanjut_pelaksanaan_kegiatan',$data);
				}
			else
				{
				$this->load->view('shared/form_mencetak_perangkat_tambahan',$data);
				}
			}
	}
	function kirimpesan()
	{
		$datestring = "%d-%m-%Y | %h:%i:%a";
		$time = time();
		$input=array();
		$kodeguru=$this->input->post('kodeguru');
		$input['subjek']=$this->input->post('subjek');
		$input['status_pesan']="N";
		$input['waktu']=mdate($datestring,$time);
		$input['pesan']=$this->input->post('pesan');
		$input['username'] = 'pengawas';
		$judul = $this->input->post('subjek');
		if (!empty($input['subjek']))
			{
			//cari hp guru
			$this->load->model('Situs_model');
			$nohpguru = cari_seluler_pegawai($kodeguru);
			$username = cari_username_pegawai($kodeguru);
			$input['tujuan'] = $username;
			$pesan = 'Pesan pengawas di portal, "'.$this->input->post('pesan').'"';
			$this->Situs_model->Simpan_Pesan_Admin($input);
			}
		if (!empty($nohpguru))
			{
			$this->Situs_model->Kirim_SMS_Guru($nohpguru,$pesan,5);
			}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pengawas'>";
		
	}
	function perilaku($tahun=null,$nip=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['judulhalaman'] = '';
		$data['loncat'] = '';
		$tahun1 =cari_tahun_penilaian();
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$data['nip'] = $nip;
		$data['bulan'] = $this->uri->segment(5);
		$data["aksi"] = $this->input->post('aksi');
		$data['pelayanan']=$this->input->post('pelayanan');
		$data['integritas']=$this->input->post('integritas');
		$data['komitmen']=$this->input->post('komitmen');
		$data['disiplin'] = $this->input->post('disiplin');
		$data["kerjasama"] = $this->input->post('kerjasama');
		$data["kepemimpinan"] = $this->input->post('kepemimpinan');
		$data["bulanpost"] = $this->input->post('bulanpost');
		$data["awalbulanpost"] = $this->input->post('awal_bulan');
		$data["akhirbulanpost"] = $this->input->post('akhir_bulan');
		$data["namapenilaipost"] = $this->input->post('nama_penilai');
		$data["nippenilaipost"] = $this->input->post('nip_penilai');
		$data["jabatanpenilaipost"] = $this->input->post('jabatan_penilai');
		$data["batas_skp"] = $this->input->post('batas_skp');
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/perilaku',$data);
		$this->load->view('shared/bawah');
	}
	function skp($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$this->load->model('Referensi_model','ref');
		$this->load->model('Guru_model','guru');
		$data['token_bot'] = $this->ref->ambil_nilai('token_bot');
		$tahun1 =cari_tahun_penilaian();
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		if(empty($nip))
		{
			redirect('kepala');
		}
		else
		{
			$data['nip'] = $nip;
			$data['id'] = $id;
			$data["aksi"] = $this->input->post('aksi');
			$data['pelayanan']=$this->input->post('pelayanan');
			$data['integritas']=$this->input->post('integritas');
			$data['komitmen']=$this->input->post('komitmen');
			$data['disiplin'] = $this->input->post('disiplin');
			$data["kerjasama"] = $this->input->post('kerjasama');
			$data["bulanpost"] = $this->input->post('bulanpost');
			$this->load->view('kepala/bg_atas',$data);
			$this->load->view('kepala/skp',$data);
			$this->load->view('shared/bawah');
		}
	}
	function updaterealisasi($tahun=null,$nip=null)
	{
		$in=array();
		$in2=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $this->input->post('kodeguru');
		$kodeunsur = $this->input->post('kodeunsur');
		$in["id_skp_skor_guru"]=$this->input->post("id_skp_skor_guru");
		$in["biaya_r"]=$this->input->post("biaya");
		$in["kuantitas_r"]=$this->input->post("kuantitas");
		$in["kualitas_r"]=$this->input->post("kualitas");
		$in["waktu_r"]=$this->input->post("waktu");
		$in["ak_r"]=$this->input->post("ak_r");
		$in["status"]=1;
 		$this->Guru_model->Update_Skor_Skp($in);
		redirect('kepala/skp/'.$tahun.'/'.$nip);
	}
	function unduhskp()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['kode'] = $this->uri->segment(4);
		$data['tahun']= $this->uri->segment(3);
		$data['item'] = 'skp';
		$this->load->library('excel');
		$this->load->view('shared/unduh_borang_skp',$data);
	}
	function unduhborangskp()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['kode'] = $this->uri->segment(4);
		$data['tahun']= $this->uri->segment(3);
		$data['item'] = 'borang';
		$this->load->library('excel');
		$this->load->view('shared/unduh_borang_skp',$data);
	}

	function cetak()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = '';
		$perangkat = $this->uri->segment(3);
		$perangkat = strtolower($perangkat);
		if($perangkat == 'analisis')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_analisis',$data);
			}
		elseif($perangkat == 'analisislengkap')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_analisis_ulangan_lengkap',$data);
			}
		elseif($perangkat == 'remidial')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_rancangan_program_remidial',$data);
			}
		elseif($perangkat == 'pengayaan')
			{
			$data['id_mapel']= $this->uri->segment(4);
			$data['ulangan']= $this->uri->segment(5);
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_pengayaan',$data);
			}
		elseif($perangkat == 'bukutugas')
			{
			$data['kodebukutugas']= $this->uri->segment(4);
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_daftar_tugas',$data);
			}
		elseif($perangkat == 'daftarhadirsiswa')
			{
			$data['kodebukutugas']= $this->uri->segment(4);
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_kehadiran',$data);
			}

		elseif($perangkat == 'bip')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_informasi_penilaian',$data);
			}
		elseif($perangkat == 'bpu')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_bpu',$data);
			}

		elseif($perangkat == 'rph')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_rph',$data);
			}
		elseif($perangkat == 'bph')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_bph',$data);
			}
		elseif($perangkat == 'chbs')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_catatan_hambatan',$data);
			}
		elseif($perangkat == 'daftarbukupegangan')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_daftar_buku_pegangan',$data);
			}

		elseif($perangkat == 'afe')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
			}
		elseif($perangkat == 'daftarnilaiakhlak')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_akhlak',$data);
			}
		elseif($perangkat == 'psi')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_daftar_nilai_psikomotor',$data);
			}
		elseif($perangkat == 'lck')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_lck',$data);
			}
		elseif($perangkat == 'dlck')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_deskripsi_lck',$data);
			}

		elseif($perangkat == 'lhb')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_lhb_mapel',$data);
			}
		elseif($perangkat == 'kog')
			{
			$data['kodebukutugas']= strtoupper($this->uri->segment(4).'/'.$this->uri->segment(5));
			$data['sms'] = 0;
			$this->load->view('shared/mencetak_daftar_nilai_kognitif',$data);
			}

		else
			{
			redirect('kepala/perangkat');
			}
	}
	function akreditasi()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data["tanggal"] = mdate($datestring, $time);
		$data['yangdicetak']=$this->input->post('yangdicetak');
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->input->post('kodeguru');
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran']=$this->input->post('thnajaran');
		$data['semester']=$this->input->post('semester');
		$data['id_mapel']=$this->input->post('id_mapel');
		$data['ulangan']=$this->input->post('ulangan');
		$data['namaguru'] = cari_nama_pegawai($this->input->post('kodeguru'));
		$data['kelas'] = id_mapel_jadi_kelas($data['id_mapel']);
		$data['mapel'] = id_mapel_jadi_mapel($data['id_mapel']);
		$data['tugastambahan'] = $data['mapel'].' '.$data['kelas'].' '.$data['thnajaran'].' smt '.$data['semester'];
		$tanggalhadir =$this->input->post('tanggalhadir');
		$bulanhadir =$this->input->post('bulanhadir');
		$tahunhadir =$this->input->post('tahunhadir');
		$tanggaljurnal = "$tahunhadir$bulanhadir$tanggalhadir";
		$diproses=$this->input->post('diproses');	
		if ($diproses != 'oke') 
			{
			$this->load->view('kepala/bg_atas',$data);
			$this->load->view('shared/form_mencetak_perangkat_akreditasi',$data);
			$this->load->view('shared/bawah');

			}
		if ($diproses == 'oke') 
			{
			if ($data['yangdicetak'] == 'Analisis')
				{
				$this->load->view('shared/mencetak_147_1',$data);
				}
			elseif ($data['yangdicetak'] == '147_2')
				{
				$this->load->view('shared/mencetak_147_2',$data);
				}
			elseif ($data['yangdicetak'] == '147_3')
				{
				$this->load->view('shared/mencetak_147_3',$data);
				}

			elseif ($data['yangdicetak'] == 'Penilaian Kinerja Guru')
				{
				$this->load->view('shared/mencetak_penilaian_kinerja_guru',$data);
				}
			elseif ($data['yangdicetak'] == 'Catatan Hambatan Belajar Siswa')
				{
				$this->load->view('shared/mencetak_catatan_hambatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Hambatan Belajar Siswa')
				{
				$this->load->view('shared/mencetak_hambatan',$data);
				}
			elseif ($data['yangdicetak'] == 'Laporan Capaian Kompetensi')
				{
				$this->load->view('shared/mencetak_lck',$data);
				}
			elseif ($data['yangdicetak'] == 'Laporan Hasil Belajar')
				{
				$this->load->view('shared/mencetak_lhb_mapel',$data);
				}
			elseif ($data['yangdicetak'] == 'Deskripsi Laporan Capaian Kompetensi')
				{
				$this->load->view('shared/mencetak_deskripsi_lck',$data);
				}
			elseif ($data['yangdicetak'] == 'Rencana Pelaksanaan Harian')
				{
				$this->load->view('shared/mencetak_rph',$data);
				}
			elseif ($data['yangdicetak'] == 'Rencana Pelaksanaan Pembelajaran')
				{
				$this->load->view('shared/mencetak_rencana_pelaksanaan_pembelajaran',$data);
				}
			elseif ($data['yangdicetak'] == 'Buku Pelaksanaan Harian')
				{
				$this->load->view('shared/mencetak_bph',$data);
				}
			elseif ($data['yangdicetak'] == 'Buku Pengembalian Ulangan')
				{
				$this->load->view('shared/mencetak_bpu',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Hadir Siswa')
				{
				$this->load->view('shared/mencetak_kehadiran',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Akhlak')
				{
				$this->load->view('shared/mencetak_akhlak',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Kognitif')
				{
				$this->load->view('shared/mencetak_daftar_nilai_kognitif',$data);
				}

			elseif ($data['yangdicetak'] == 'Buku Informasi Penilaian')
				{
				$this->load->view('shared/mencetak_informasi_penilaian',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Buku Pegangan')
				{
				$this->load->view('shared/mencetak_daftar_buku_pegangan',$data);
				}
			elseif ($data['yangdicetak'] == 'Buku Tugas')
				{
				$this->load->view('shared/mencetak_daftar_tugas',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Psikomotor')
				{
				$this->load->view('shared/mencetak_daftar_nilai_psikomotor',$data);
				}
			elseif ($data['yangdicetak'] == 'Daftar Nilai Afektif')
				{
				$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
				}
			elseif ($data['yangdicetak'] == 'Jurnal Piket')
				{
				$this->load->view('shared/mencetak_daftar_nilai_afektif',$data);
				}

			else
				{
				redirect('kepala/perangkat');
				}
			}
	}
	function batalpkg($tahun=null,$nip=null)
	{
		$this->load->model('Guru_model');
		$this->load->model('Referensi_model','ref');
		$this->Guru_model->Batal_Permanen_Pkg($tahun,$nip);
		$chat_id = $this->Guru_model->get_Chat_id($username);
		$token_bot = $this->ref->ambil_nilai('token_bot');
		if((!empty($chat_id)) and (!empty($token_bot)))
		{
			$this->load->helper('telegram');
			$pesantelegram = 'PKG '.$tahun.' telah dibatalkan.';
			$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
		}
		else
		{
			$inpes["DestinationNumber"]= cari_seluler_pegawai($username);
			$inpes["TextDecoded"] = 'PKG '.$tahun.' telah dibatalkan';
			$this->Guru_model->Kirim_Pesan($inpes);
		}
		redirect('kepala/perilaku');
	}
	function bukuperilaku()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Buku Perilaku';
		$data['loncat'] = '';
		$data['tahun'] = $this->uri->segment(3);
		$data['kodeguru'] = $this->uri->segment(4);
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/buku_perilaku',$data);
		$this->load->view('shared/bawah');
	}
	function nilaiskp($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$tahunsekarang = date("Y");
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		if(empty($nip))
		{
			redirect('kepala');
		}
		else
		{
			$this->load->model('Helper_model', 'helper');
			$data['nip'] = $nip;
			$data['kodeguru'] = $this->helper->cari_kode_dari_nip_pegawai($nip);
			$data['id'] = $id;
			$this->load->view('kepala/bg_atas',$data);
			if($tahun < $tahunsekarang)
			{
				$this->load->view('kepala/skp_nilai_2014',$data);
			}
			else
			{
				$this->load->view('kepala/skp_nilai',$data);
			}
			$this->load->view('shared/bawah');
		}
	}
	function updaterealisasiskp()
	{
		$in=array();
		$in2=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$tahun = $this->uri->segment(3);
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$this->load->model('Guru_model');
		$nip = nopetik($this->input->post('nip'));
		$cacah = $this->input->post('cacahitem');
		if($cacah>0)
		{
			for($i=1;$i<=$cacah;$i++)
			{
				$kodeunsur = $this->input->post('kodeunsur_'.$i);
				$in["id_skp_skor_guru"]=$this->input->post("id_skp_skor_guru_$i");
				$in["biaya_r"]=$this->input->post("biaya_$i");
				$in["kuantitas_r"]=$this->input->post("kuantitas_$i");
				$in["kualitas_r"]=$this->input->post("kualitas_$i");
				$in["waktu_r"]=$this->input->post("waktu_$i");
				if($kodeunsur == 'T0')
				{
					$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i");
/*
					if($this->input->post("waktu_$i")<12)
					{
						$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i")*2/100;
					}
					else
					{
						$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i")*5/100;
					}
*/
				}
				else
				{
					$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i");
				}
				$in["status"]=1;
				$in = nopetik($in);
	 			$this->Guru_model->Update_Skor_Skp($in);
			}
		}
		redirect('kepala/skp/'.$tahun.'/'.$nip);
	}
	function perilakusetahun($tahun=null,$nip=null,$sekaligus=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$data['judulhalaman'] = '';
		$data['loncat'] = '';
		$tahun1 =cari_tahun_penilaian();
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$data['nip'] = $nip;
		$this->load->view('kepala/bg_atas',$data);
		if($sekaligus == 'sekaligus')
		{
			$this->load->view('kepala/perilaku_setahun_sekaligus',$data);
		}
		else
		{
			$this->load->view('kepala/perilaku_setahun',$data);
		}

		$this->load->view('shared/bawah');
	}
    public function simpanperilaku($tahun=null,$nip=null,$sekaligus=null)
    {
	$jpelayanan = 0;
	$jintegritas = 0;
	$jkomitmen = 0;
	$jdisiplin = 0;
	$jkerjasama = 0;
	if($sekaligus == 'sekaligus')
	{
		for($i=1;$i<=12;$i++)
		{
			$bulan = $i;
			if($i<10)
			{
				$bulan = '0'.$i;
			}
			$pelayanan=$this->input->post('pelayanan');
			$integritas=$this->input->post('integritas');
			$komitmen=$this->input->post('komitmen');
			$disiplin = $this->input->post('disiplin');
			$kerjasama = $this->input->post('kerjasama');
			$jpelayanan = $jpelayanan + $pelayanan;
			$jintegritas = $jintegritas + $integritas;
			$jkomitmen = $jkomitmen + $komitmen;
			$jdisiplin = $jdisiplin + $disiplin;
			$jkerjasama = $jkerjasama + $kerjasama;
			$this->db->query("update `perilaku_pns` set `pelayanan`='$pelayanan', `integritas`='$integritas' , `komitmen`='$komitmen' , `disiplin`='$disiplin' , `kerjasama`='$kerjasama' where `tahun`='$tahun' and `bulan`='$bulan' and `nip`='$nip'");
		}

	}
	else
	{
		for($i=1;$i<=12;$i++)
		{
			$bulan = $i;
			if($i<10)
			{
				$bulan = '0'.$i;
			}
			$pelayanan=$this->input->post('pelayanan_'.$bulan);
			$integritas=$this->input->post('integritas_'.$bulan);
			$komitmen=$this->input->post('komitmen_'.$bulan);
			$disiplin = $this->input->post('disiplin_'.$bulan);
			$kerjasama = $this->input->post('kerjasama_'.$bulan);
			$jpelayanan = $jpelayanan + $pelayanan;
			$jintegritas = $jintegritas + $integritas;
			$jkomitmen = $jkomitmen + $komitmen;
			$jdisiplin = $jdisiplin + $disiplin;
			$jkerjasama = $jkerjasama + $kerjasama;
			$this->db->query("update `perilaku_pns` set `pelayanan`='$pelayanan', `integritas`='$integritas' , `komitmen`='$komitmen' , `disiplin`='$disiplin' , `kerjasama`='$kerjasama' where `tahun`='$tahun' and `bulan`='$bulan' and `nip`='$nip'");
		}
	}
	$namapenilai = nopetik($this->input->post('nama_penilai'));
	$nippenilai = nopetik($this->input->post('nip_penilai'));
	$jabatanpenilai = nopetik($this->input->post('jabatan_penilai'));
	$this->db->query("update `perilaku_pns` set `nama_penilai`='$namapenilai', `nip_penilai`='$nippenilai', `jabatan_penilai`='$jabatanpenilai' where `tahun`='$tahun' and `bulan`='12' and `nip`='$nip'");

	$this->db->query("update `ppk_pns` set `pelayanan`='$jpelayanan', `integritas`='$jintegritas', `komitmen`='$jkomitmen', `disiplin`='$jdisiplin', `kerjasama`='$jkerjasama' where tahun = '$tahun' and `kode` = '$nip'");
	redirect('kepala/perilaku/'.$tahun.'/'.$nip);
    }
/*
	function nilaiskp2($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = '';
		$tahun1 =cari_tahun_penilaian();
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		if(empty($nip))
		{
			redirect('kepala');
		}
		else
		{
			$this->load->model('Helper_model', 'helper');
			$data['nip'] = $nip;
			$data['kodeguru'] = $this->helper->cari_kode_dari_nip_pegawai($nip);
			$data['id'] = $id;
			$this->load->view('kepala/bg_atas',$data);
			$this->load->view('kepala/skp_nilai_kedua',$data);
			$this->load->view('shared/bawah');
		}
	}

	function updaterealisasiskp2()
	{
		$in=array();
		$in2=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$tahun = $this->uri->segment(3);
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$this->load->model('Guru_model');
		$nip = nopetik($this->input->post('nip'));
		$cacah = $this->input->post('cacahitem');
		if($cacah>0)
		{
			for($i=1;$i<=$cacah;$i++)
			{
				$kodeunsur = $this->input->post('kodeunsur_'.$i);
				$in["id_skp_skor_guru"]=$this->input->post("id_skp_skor_guru_$i");
				$in["biaya_r"]=$this->input->post("biaya_$i");
				$in["kuantitas_r"]=$this->input->post("kuantitas_$i");
				$in["kualitas_r"]=$this->input->post("kualitas_$i");
				$in["waktu_r"]=$this->input->post("waktu_$i");
				if($kodeunsur == 'T0')
				{
					if($this->input->post("waktu_$i")<12)
					{
						$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i")*2/100;
					}
					else
					{
						$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i")*5/100;
					}
				}
				else
				{
					$in["ak_r"]=$this->input->post("kuantitas_$i")*$this->input->post("ak_r_$i");
				}
				$in["status"]=1;
				$in = nopetik($in);
	 			$this->Guru_model->Update_Skor_Skp_Kedua($in);
			}
		}
		redirect('kepala/skp/'.$tahun.'/'.$nip);
	}
*/
	function periksaskp($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Memeriksa SKP';
		$data['tahun'] = $tahun;
		$data['nip'] = $nip;
		$data['loncat'] = '';
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/skp_periksa',$data);
		$this->load->view('shared/bawah');
	}
	function hapusskp($tahun=null,$nip=null,$id=null)
	{
		$this->load->model('Guru_model');
		$ta = $this->db->query("select * from `skp_skor_guru` where `id_skp_skor_guru` = '$id' and `nip`='$nip'");
		foreach($ta->result() as $a)
		{
			$kegiatan = $a->kegiatan;
		}

		if($ta->num_rows() >0)
		{
			$this->load->model('Referensi_model','ref');
			$usernamepegawai = $this->Guru_model->get_Username_from_NIP($nip);
			$chat_id = $this->Guru_model->get_Chat_id($usernamepegawai);
			$token_bot = $this->ref->ambil_nilai('token_bot');
			if((!empty($chat_id)) and (!empty($token_bot)))
			{
				$this->load->helper('telegram');
				$pesantelegram = 'SKP '.$tahun.', '.$kegiatan.' telah dihapus.';
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
			}
			$this->Guru_model->Hapus_Skp($id,$nip);
			redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
		}
		redirect('kepala');
	}
	function hapusskprevisi($tahun=null,$nip=null,$id=null)
	{
		$this->load->model('Guru_model');
		$tb = $this->db->query("select * from `skp_skor_guru` where `id_skp_skor_guru` = '$id' and `nip`='$nip'");
		$kegiatan = '?';
		foreach($tb->result() as $b)
		{
			$kegiatan = $b->kegiatan;
		}
		$ta = $this->db->query("select * from `skp_skor_guru_revisi` where `id_skp_skor_guru_revisi` = '$id' and `nip`='$nip'");

		if($ta->num_rows() >0)
		{
			$this->load->model('Referensi_model','ref');
			$usernamepegawai = $this->Guru_model->get_Username_from_NIP($nip);
			$chat_id = $this->Guru_model->get_Chat_id($usernamepegawai);
			$token_bot = $this->ref->ambil_nilai('token_bot');
			if((!empty($chat_id)) and (!empty($token_bot)))
			{
				$this->load->helper('telegram');
				$pesantelegram = 'SKP Revisi '.$tahun.', '.$kegiatan.' telah dihapus.';
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
			}
			$this->Guru_model->Hapus_Skor_Skp_Revisi($nip,$id);
			redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
		}
		redirect('kepala');
	}

	function updaterealisasiskp2014()
	{
		$in=array();
		$in2=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$tahun = $this->uri->segment(3);
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$this->load->model('Guru_model');
		$nip = nopetik($this->input->post('nip'));
		$cacah = $this->input->post('cacahitem');
		if($cacah>0)
		{
			for($i=1;$i<=$cacah;$i++)
			{
				$kodeunsur = $this->input->post('kodeunsur_'.$i);
				$in["id_skp_skor_guru"]=$this->input->post("id_skp_skor_guru_$i");
				$in["kuantitas"]=$this->input->post("kuantitas_$i");
				$in["kualitas"]=$this->input->post("kualitas_$i");
				$in["waktu"]=$this->input->post("waktu_$i");
				$in["kuantitas_r"]=$this->input->post("kuantitas_r_$i");
				$in["kualitas_r"]=$this->input->post("kualitas_r_$i");
				$in["waktu_r"]=$this->input->post("waktu_r_$i");
				$in["ak_r"]=$this->input->post("ak_r_$i");
				$in["nourut"]=$this->input->post("nourut_$i");
				$in["status"]=1;
				$in = nopetik($in);
	 			$this->Guru_model->Update_Skor_Skp($in);
			}
		}
		redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
	}
	function revisiskp($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Merevisi SKP';
		$data['tahun'] = $tahun;
		$data['nip'] = $nip;
		$data['id'] = $id;
		$data['loncat'] = '';
		$this->load->model('Guru_model');
		$id_skp_skor_guru_revisi = $this->input->post('id_skp_skor_guru');
		if(!empty($id_skp_skor_guru_revisi))
		{
			$in["id_skp_skor_guru_revisi"]=$this->input->post("id_skp_skor_guru");
			$ak=$this->input->post("ak");
			$in["biaya"]=$this->input->post("biaya");
			$in["ak_r"]=$this->input->post("ak_r");
			$in["kuantitas"]=$this->input->post("kuantitas");
			$in["kualitas"]=$this->input->post("kualitas");
//			$in['ak_target'] = $ak * $this->input->post("kuantitas");
			if($this->input->post("waktu")>0)
			{
				$in["waktu"]=$this->input->post("waktu");
			}
			else
			{
				$in["waktu"]=1;
			}
			$in["satuanwaktu"]=$this->input->post("satuanwaktu");
			$in['status']=0;
			$this->Guru_model->Update_Skor_Skp_Revisi($in);
			redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
		}
		else
		{
			$this->load->view('kepala/bg_atas',$data);
			$this->load->view('kepala/skp_revisi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function updaterevak($tahun=null,$nip=null)
	{
		$in=array();
		$this->load->model('Guru_model');
		$in["id_skp_skor_guru"]=$this->input->post("id_skp_skor_guru");
		$in["biaya"]=$this->input->post("biaya");
		$in["kuantitas"]=$this->input->post("kuantitas");
		$in["kualitas"]=$this->input->post("kualitas");
		$in["waktu"]=$this->input->post("waktu");
		$in["ak"]= $this->input->post("ak");
		$in["ak_target"]=$this->input->post("kuantitas")*$this->input->post("ak_target");
		$in["status"]=1;
		$in = nopetik($in);
		$this->Guru_model->Update_Skor_Skp($in);
		redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
	}
	function revak($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mengubah SKP';
		$data['tahun'] = $tahun;
		$data['nip'] = $nip;
		$data['id'] = $id;
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/skp_revak',$data);
		$this->load->view('shared/bawah');

	}
	function statusppk($tahun=null,$aksi=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Status Proses PPK';
		$data['loncat'] = '';
		$data['aksi'] = $aksi;
		$tahun1 =cari_tahun_penilaian();
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/skp_status',$data);
		$this->load->view('shared/bawah');
	}
	function ubahskp($tahun=null,$nip=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Mengubah SKP Pegawai';
		$tahun1 =cari_tahun_penilaian();
		if($tahun > 0)
		{
			$data['tahun'] = $tahun;
		}
		else
		{
			$data['tahun'] = $tahun1;
		}
		$data['tahun'] = $tahun;
		$data['nip'] = $nip;
		$data['id'] = $id;
		$this->load->view('kepala/bg_atas',$data);
		$this->load->view('kepala/skp_ubah',$data);
		$this->load->view('shared/bawah');
	}
	function simpanskp($tahun=null,$nip=null,$id=null)
	{
		$data = array();
		$data['nip'] = $nip;
		$data["id"] = $id;
		$data["tahunpenilaian"]= $tahun;
		$id_skp_skor_guru = $id;
		$this->load->model('Guru_model');
		if(!empty($id_skp_skor_guru))
		{
			$in["id_skp_skor_guru"]= $id_skp_skor_guru;
			$in['ak'] = $this->input->post("ak");
			$ak = $this->input->post("ak");
			$in["biaya"]=$this->input->post("biaya");
			$in["kuantitas"]=$this->input->post("kuantitas");
			$in["kualitas"]=$this->input->post("kualitas");
			$in['ak_target'] = $ak * $this->input->post("kuantitas");
			if($this->input->post("waktu")>0)
			{
				$in["waktu"]=$this->input->post("waktu");
			}
			else
			{
				$in["waktu"]=1;
			}
			$in["satuanwaktu"]=$this->input->post("satuanwaktu");
			$in['status']=0;
			$this->Guru_model->Update_Skor_Skp($in);
		}
		redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
	}
	function tambahrealisasi($tahun=null,$nip=null,$id=null)
	{
		$this->load->model('Guru_model');
		$in["tahun"] = $tahun;
		$in["nip"] = $nip;
		$in['id_skp'] = $id;
		$in['bulan'] = 12;
		$this->Guru_model->Tambah_Realisasi_Skp($in);
		redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
	}
	function hapusrealisasiskp($tahun=null,$nip=null,$id=null)
	{
		$this->load->model('Guru_model');
		$this->Guru_model->Hapus_Realisasi_SKP($id);
		redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
	}
	function pindahskptambahan($tahun=null,$nip=null,$id=null)
	{
		$ta = $this->db->query("select * from `dupak_skp` where `id_dupak_skp` = '$id' and `tahun`='$tahun'");
		if($ta->num_rows() > 0)
		{
			foreach($ta->result() as $a)
			{
				$kode = $a->kode;
				$ak = $a->ak;
				$kuantitas = $a->kuantitas;
				$golongan = $a->golongan;
			}
			$tb = $this->db->query("SELECT * FROM `skp_tabel_skor` where `kode` = '$kode'");
			if($tb->num_rows() >0)
			{
				foreach($tb->result() as $b)
				{
					$kegiatan = $b->kegiatan;
					$unsur = $b->unsur;
				}		
				$this->db->query("insert into `skp_skor_guru` (`unsur`, `kode`, `kegiatan`, `ak`, `ak_target`, `kualitas`, `kuantitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `status`, `golongan`, `tahun`) values ('$unsur', '$kode', '$kegiatan', '$ak', '$ak', '100', '$kuantitas', '12', 'Bl', '0', '$nip', '0', '$golongan', '$tahun')");
			}
			$this->db->query("delete from `dupak_skp` where `id_dupak_skp` = '$id' and `tahun`='$tahun'");
		}
		redirect('kepala/periksaskp/'.$tahun.'/'.$nip);
	}

}//akhir fungsi
?>
