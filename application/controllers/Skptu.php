<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
class Skptu extends CI_Controller
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

    public function index()
    {
	$this->load->helper('pkg');
	$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
	$kodeguru = $this->session->userdata('username');
	$tautan = 'pegawai';
	$data = array('judulhalaman' => 'SKP Tenaga Kependidikan',
        'main_view' => 'pegawai/skp', 'tahunpenilaian'=>$tahunpenilaian, 'kodeguru'=>$kodeguru, 'tautan'=>$tautan, );
	$this->load->view('pegawai/bg_atas',$data);
	$this->load->view('pegawai/skp',$data);
	$this->load->view('shared/bawah');
    }
    function macam($aksi=null,$id=null)
    {
	$this->load->helper('pkg');
	$this->load->model('Pegawai_model','pegawai');
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
	$data = array('nim' => $kodeguru, 'kodeguru'=>$kodeguru, 'judulhalaman' => 'Modul Macam Kegiatan Tugas Jabatan', 'aksi'=>$aksi, 'id'=>$id, 'query' => $query
	    );
	$this->load->view('pegawai/bg_atas',$data);
	$this->load->view('pegawai/skp_pegawai',$data);
	$this->load->view('shared/bawah');
    }
	function skskp()
	{
		$this->load->helper('pkg');
		$this->load->model('Guru_model');
		$gol_awal = $this->input->post("gol_awal");
		$gol_akhir = $this->input->post("gol_akhir");
		$tahunpenilaian = cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$kodeguru = $this->session->userdata('username');
		$proses = $this->input->post("proses");
		$jabatan = $this->input->post("jabatan");
		if($proses == 'post')
		{
			$in['tambah'] = $this->input->post("tambah");
			$in['gol_akhir'] = $gol_akhir;
			$in['gol_awal'] = $gol_awal;
			$in['tahun'] = $tahunpenilaian;
			$in['kode'] = $kodeguru;
			$in['jabatan'] = $jabatan;
			$this->Guru_model->Update_Parameter_Skp($in);
			redirect('pegawai/skp');

		}
		else
		{
			$awal=awal_tahun($this->session->userdata('unit_kerja'));
			$akhir=akhir_tahun($this->session->userdata('unit_kerja'));
			$tautan = 'guru';
			$data = array(
			        'halaman' => 'skp',
			        'main_view' => 'shared/gol_pegawai', 'tahunpenilaian'=>$tahunpenilaian, 'kodeguru'=>$kodeguru, 'tautan'=>$tautan, 'awal'=>$awal, 'akhir'=>$akhir
			    );
		        $this->load->view($this->layout, $data);
		}
	}
	function tambahskp()
	{
		$this->load->helper('pkg');
		$this->load->model('Pegawai_model','pegawai');
		$aksi = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$kodepegawai = $this->session->userdata('username');
		$awal=awal_tahun($this->session->userdata('unit_kerja'));
		$akhir=akhir_tahun($this->session->userdata('unit_kerja'));
		$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$id_skp_pegawai = $this->input->post("id_skp_pegawai");
		$kegiatan = $this->input->post("kegiatan");
		$satuan = $this->input->post("satuan");
		$nourut = $this->input->post("nourut");
		$id_skp_skor_guru = $this->input->post("id_skp_skor_guru");
		if((!empty($id_skp_pegawai)) or (!empty($kegiatan)))
		{
			if(empty($kegiatan))
			{
				$dataskppegawai = $this->pegawai->data_macam_kegiatan_skp_pegawai($id_skp_pegawai);
				$kegiatan = $dataskppegawai[0];
				$satuan =  $dataskppegawai[1];
			}
			$in['kegiatan'] = hilangkanpetik($kegiatan);
			$in['satuan'] = hilangkanpetik($satuan);
			$in['nourut'] = hilangkanpetik($nourut);
			$in['kodeguru'] = $kodepegawai;
			$in['kuantitas'] = hilangkanpetik($this->input->post("kuantitas"));
			$in['waktu'] = hilangkanpetik($this->input->post("waktu"));
			$in['satuanwaktu'] = 'Bulan';
			$in['kualitas'] = 100;
			$in['tahun'] = $tahunpenilaian;
			if(empty($id_skp_skor_guru))
			{
				$this->pegawai->form_tambah_skp($in);	
			}
			else
			{
				$in['id_skp_skor_guru'] = $id_skp_skor_guru;
				$this->pegawai->form_perbarui_skp($in);	
			}
			redirect('pegawai/skp');
		}
		$query = $this->pegawai->daftar_kegiatan_skp_urut($kodepegawai);
		$data = array(
		        'halaman' => 'skp',
		        'main_view' => 'pegawai/skp_tambah', 'tahunpenilaian'=>$tahunpenilaian, 'kodepegawai'=>$kodepegawai, 'awal'=>$awal, 'akhir'=>$akhir, 'judulhalaman' => 'Menambah Kegiatan SKP', 'aksi'=>$aksi, 'id'=>$id, 'query' => $query
		    );
		$this->load->view($this->layout, $data);
	}
	function ubahskp()
	{
		$this->load->helper('pkg');
		$this->load->model('Pegawai_model','pegawai');
		$id = $this->uri->segment(4);
		$kodepegawai = $this->session->userdata('username');
		$awal=awal_tahun($this->session->userdata('unit_kerja'));
		$akhir=akhir_tahun($this->session->userdata('unit_kerja'));
		$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$query = $this->pegawai->data_ubah_skp($kodepegawai,$id);
		if($query->num_rows() == 0)
		{
			redirect('pegawai/skp');
		}
		else
		{
			$data = array(
		        'halaman' => 'skp',
		        'main_view' => 'pegawai/skp_ubah', 'kodepegawai'=>$kodepegawai, 'judulhalaman' => 'Mengubah Borang SKP', 'id'=>$id, 'query' => $query
		    );
			$this->load->view($this->layout, $data);
		}
	}

	function hapusskp()
	{
		$kodeguru = $this->session->userdata('username');
		$this->load->model('Guru_model');
		$id='';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(4);
		}
		$this->load->helper('pkg');
		$tahunpenilaian = cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and kode = '$kodeguru'");
		$permanen = 1;
		foreach($tz->result() as $z)
		{
			$permanen = $z->permanen;
		}
		if ($permanen == 1)
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Tidak bisa menghapus, sudah permanen, batalkan terlebih dahulu.");
			</script>
			<?php
			redirect('pegawai/skp');
		}
		else
		{
			$this->Guru_model->Hapus_Skp($id,$kodeguru);
			redirect('pegawai/skp');
		}
	}
	function realisasiskp()
	{
		$this->load->helper('pkg');
		$kodeguru = $this->session->userdata('username');
		$datapegawai = cari_data_pegawai($kodeguru);
		$namapegawai = $datapegawai[0];

		$id='';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(4);
		}
		$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$nomoroperator = nomor_operator($this->session->userdata('unit_kerja'));
		if($id == 'permanen')
		{
			$inpes["DestinationNumber"]= $nomoroperator;
			$inpes["TextDecoded"] = $namapegawai.' mengirim realisasi SKP '.$tahunpenilaian.'';
			$inpes["id_sms_user"] = '';
			if(!empty($nomoroperator))
			{
				$this->Guru_model->Kirim_Pesan($inpes);
				$this->session->set_flashdata('pesan', 'Informasi dikirimkan ke Admin ' . anchor('guru/pkg/skp', 'kembali ke SKP', 'class="alert-link"'));
			}
			else
			{
				$this->session->set_flashdata('pesan', 'Silakan menghubungi Admin ' . anchor('guru/pkg/skp', 'kembali ke SKP', 'class="alert-link"'));
			}
			redirect('guru/pkg/sukses');
			?>
			<script type="text/javascript" language="javascript">
			alert("Realisasi SKP telah disampaikan ke Admin. Terima kasih.");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."pkg/skp'>";


		}
		else
		{
			$data["id"] = $id;
			$bulan = $this->input->post("bulan");
			$data["tahunpenilaian"]= $tahunpenilaian;
			$data['kodeguru'] = $kodeguru;
			if((!empty($bulan)) and (!empty($id)))
			{
				$in['id_skp'] = $id;
				$in["tahun"] = $tahunpenilaian;
				$in["kodeguru"] = $kodeguru;
				$in['bulan'] = $bulan;
				$this->Guru_model->Tambah_Realisasi_Skp($in);
				redirect('guru/pkg/realisasiskp');
			}
			$data = array(
			        'halaman' => 'skp',
			        'main_view' => 'guru/skp_realisasi', 'tahunpenilaian'=>$tahunpenilaian, 'kodeguru'=>$kodeguru, 'judulhalaman'=>'Realisasi SKP', 'id'=>$id
			    );
		$this->load->view($this->layout, $data);

		}
	}
	function hapusrealisasiskp()
	{
		$this->load->model('Guru_model');
		$kodeguru = $this->session->userdata('username');
		$id = $this->uri->segment(4);
		$this->Guru_model->Hapus_Realisasi_SKP($kodeguru,$id);
		redirect('guru/pkg/realisasiskp');
	}

    public function sukses()
    {
        $this->data['main_view'] = 'sukses';
        $this->data['title'] = 'Berhasil';
        $this->load->view($this->layout, $this->data);
    }
    public function permanen()
    {
		$this->load->helper('pkg');
		$datapegawai = cari_data_pegawai($this->session->userdata('username'));
		$namapegawai = $datapegawai[0];
		$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$nomoroperator = nomor_operator($this->session->userdata('unit_kerja'));
		$this->load->model('Guru_model');
		$inpes["DestinationNumber"]= $nomoroperator;
		$inpes["TextDecoded"] = $namapegawai.' telah menetapkan SKP '.$tahunpenilaian.'';
		$inpes["id_sms_user"] = '';
		$this->Guru_model->Kirim_Pesan($inpes);
		$this->Guru_model->Permanen_Hasil_Skp($tahunpenilaian,$this->session->userdata('username'));
		$this->session->set_flashdata('pesan', 'SKP telah dipermanenkan ' . anchor('pegawai/skp', 'kembali ke SKP', 'class="alert-link"'));
		redirect('pegawai/skp/skp-sukses');
	}
    function refharian()
    {
	$this->load->helper('pkg');
	$this->load->model('Pegawai_model','pegawai');
	$kodeguru = $this->session->userdata('username');
	$aksi = $this->uri->segment(4);
	$id = $this->uri->segment(5);
	$kodeguru = $this->session->userdata('username');
	$giat_harian = $this->input->post("giat_harian");
	$giat_output = $this->input->post("giat_output");
	$giat_satuan = $this->input->post("giat_satuan");
	$id_skp_pegawai = $this->input->post("id_skp_pegawai");
	$id_harian = $this->input->post("id_harian");
	if((!empty($giat_harian)) and (!empty($giat_satuan)) and (!empty($giat_output)) and (!empty($id_skp_pegawai)))
	{
		$in['giat_harian'] = hilangkanpetik($giat_harian);
		$in['giat_satuan'] = hilangkanpetik($giat_satuan);
		$in['giat_output'] = hilangkanpetik($giat_output);
		$in['id_skp_pegawai'] = hilangkanpetik($id_skp_pegawai);
		$in['kodepegawai'] = $kodeguru;
		if(empty($id_harian))
		{
			$this->pegawai->tambah_referensi_kegiatan_harian($in);	
		}
		else
		{
			$in['id_harian'] = $id_harian;
			$this->pegawai->perbarui_referensi_kegiatan_harian($in);	
		}


	}
	$qrefskp = $this->pegawai->daftar_kegiatan_skp($kodeguru);
	$tautan = 'pegawai';
	$query = $this->pegawai->daftar_referensi_kegiatan_harian($kodeguru);
	$data = array(
        'halaman' => 'referensi',
        'main_view' => 'pegawai/referensi_harian', 'kodeguru'=>$kodeguru, 'judulhalaman' => 'Daftar Kegiatan Harian', 'aksi'=>$aksi, 'id'=>$id, 'query' => $query, 'qrefskp'=>$qrefskp
	    );
        $this->load->view($this->layout, $data);
    }
    function harian()
    {
		$aksi=$this->uri->segment(4);
		$page=$this->uri->segment(5);
		$kodeguru = $this->session->userdata('username');
		$this->load->helper(array('pkg','skp'));
		$this->load->model('Pegawai_model','pegawai');
		$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		if($aksi == 'hapus')
		{
			$this->pegawai->hapus_skp_harian($kodeguru,$page);
			redirect('pegawai/skp/harian/tampil');
		}
		$this->load->library('Pagination');
		$kegiatan = $this->input->post("kegiatan");
		$id_skp_harian = $this->input->post("id_skp_harian");
		$id_skp_pegawai = $this->input->post("id_skp_pegawai");
		$volume = $this->input->post("volume");
		$tanggal = date_to_en($this->input->post("tanggal"));
		if((!empty($kegiatan)) and (!empty($tanggal)) and ($volume>0))
		{
			$datakegiatan = $this->pegawai->data_macam_kegiatan_skp($id_skp_pegawai);
			$in['satuan'] = $datakegiatan[1];
			$in['id_skp_skor_guru'] = $id_skp_pegawai;
			$in['kegiatan'] = hilangkanpetik($kegiatan);
			$in['tanggal'] = hilangkanpetik($tanggal);
			$in['kodepegawai'] = $kodeguru;
			$in['volume'] = $volume;
			if(empty($id_skp_harian))
			{
				$this->pegawai->tambah_kegiatan_harian($in);	
			}
			else
			{
				$in['id_skp_harian'] = $id_skp_harian;
				$this->pegawai->perbarui_kegiatan_harian($in);	
			}
		}

      		$limit_ti=20;
		if(!$page):
		$offset_ti = 0;
		else:
		$offset_ti = $page;
		endif;
		$tahun=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$query=$this->pegawai->tampil_harian_tahun($tahun,$kodeguru,$limit_ti,$offset_ti);
		$tot_hal = $this->pegawai->tampil_semua_harian_tahun($tahun,$kodeguru);
      		$config['base_url'] = base_url() . 'pegawai/skp/harian/tampil';
       		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit_ti;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		$trefskp = $this->pegawai->daftar_referensi_kegiatan_skp($kodeguru,$tahun);
		$tanggalhariini = tanggal_hari_ini();
		$data = array(
		        'halaman' => 'harian',
		        'main_view' => 'pegawai/harian', 'kodeguru'=>$kodeguru, 'judulhalaman' => 'Daftar Kegiatan Harian', 'aksi'=>$aksi, 'query' => $query, 'paginator'=>$paginator, 'page'=>$page, 'trefskp'=>$trefskp, 'tanggalhariini'=>$tanggalhariini, 'tahunpenilaian'=>$tahunpenilaian
		    );
        $this->load->view($this->layout, $data);

    }
	function ubahpenilai()
	{
		$this->load->helper('pkg');
		$this->load->model('Guru_model');
		$id_pejabat = $this->input->post("id_pejabat");
		$unit_kerja = $this->session->userdata('unit_kerja');
		$tahunpenilaian = cari_tahun_penilaian($unit_kerja);
		$kodeguru = $this->session->userdata('username');
		$proses = $this->input->post("proses");
		if($proses == 'post')
		{
			$in['id_pejabat'] = $id_pejabat;
			$in['tahun'] = $tahunpenilaian;
			$in['kode'] = $kodeguru;
			$this->Guru_model->Update_Parameter_Skp($in);
			redirect('pegawai/skp');

		}
		else
		{
			$tautan = 'pegawai';
			$data = array(
			        'halaman' => 'skp',
			        'main_view' => 'shared/pilih_penilai', 'tahunpenilaian'=>$tahunpenilaian, 'kodeguru'=>$kodeguru, 'tautan'=>$tautan, 'unit_kerja'=>$unit_kerja
			    );
		        $this->load->view($this->layout, $data);
		}
	}
    public function batalpermanen()
    {
		$this->load->helper('pkg');
		$datapegawai = cari_data_pegawai($this->session->userdata('username'));
		$namapegawai = $datapegawai[0];
		$tahunpenilaian=cari_tahun_penilaian($this->session->userdata('unit_kerja'));
		$nomoroperator = nomor_operator($this->session->userdata('unit_kerja'));
		$this->load->model('Guru_model');
		$inpes["DestinationNumber"]= $nomoroperator;
		$inpes["TextDecoded"] = $namapegawai.' mengajukan pembatalan SKP '.$tahunpenilaian.'';
		$inpes["id_sms_user"] = '';
		$this->Guru_model->Kirim_Pesan($inpes);
		$this->Guru_model->Permanen_Hasil_Skp($tahunpenilaian,$this->session->userdata('username'));
		$this->session->set_flashdata('pesan', 'Permintaan pembatalan SKP telah dikirimkan ' . anchor('pegawai/skp', 'kembali ke SKP', 'class="alert-link"'));
		redirect('pegawai/skp/skp-sukses');
	}
    function lkb()
    {
		$bulan=$this->uri->segment(4);
		$tahun=$this->uri->segment(5);
		$kodepegawai = $this->session->userdata('username');
		$unit_kerja = $this->session->userdata('unit_kerja');
		$this->load->helper(array('pkg','skp'));
		$tahunpenilaian = cari_tahun_penilaian($unit_kerja);
		$this->load->model('Pegawai_model','pegawai');
		$data = array(
		        'halaman' => 'laporan',
		        'main_view' => 'pegawai/form_lkb', 'kodepegawai'=>$kodepegawai, 'judulhalaman' => 'Laporan Kegiatan Bulanan', 'tahunpenilaian'=>$tahunpenilaian
		    );
		$data2 = array(
		        'halaman' => 'laporan',
		        'kodepegawai'=>$kodepegawai, 'judulhalaman' => 'Laporan Kegiatan Bulanan', 'tahun'=>$tahun, 'bulan'=>$bulan, 'unit_kerja'=>$unit_kerja
		    );

		if(($bulan>0) and ($tahun>0))
		{
			$this->load->view('pegawai/kepala_cetak',$data2);			
			$this->load->view('pegawai/laporan_kegiatan_bulanan');
			$this->load->view('pegawai/bawah',$data2);			
		}
		else
		{
		        $this->load->view($this->layout, $data);
		}

    }
    function lkh()
    {
		$bulan=$this->uri->segment(4);
		$tahun=$this->uri->segment(5);
		$kodepegawai = $this->session->userdata('username');
		$unit_kerja = $this->session->userdata('unit_kerja');
		$this->load->helper(array('pkg','skp'));
		$tahunpenilaian = cari_tahun_penilaian($unit_kerja);
		$this->load->model('Pegawai_model','pegawai');
		$data = array(
		        'halaman' => 'laporan',
		        'main_view' => 'pegawai/form_lkh', 'kodepegawai'=>$kodepegawai, 'judulhalaman' => 'Reakapitulasi Kegiatan Harian', 'tahunpenilaian'=>$tahunpenilaian
		    );
		$data2 = array(
		        'halaman' => 'laporan',
		        'kodepegawai'=>$kodepegawai, 'judulhalaman' => 'Rekapitulasi Kegiatan Harian', 'tahun'=>$tahun, 'bulan'=>$bulan, 'unit_kerja'=>$unit_kerja
		    );

		if(($bulan>0) and ($tahun>0))
		{
			$this->load->view('pegawai/kepala_cetak',$data2);			
			$this->load->view('pegawai/laporan_kegiatan_harian');
			$this->load->view('pegawai/bawah',$data2);			
		}
		else
		{
		        $this->load->view($this->layout, $data);
		}

    }

}
