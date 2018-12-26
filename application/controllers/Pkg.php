<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pkg extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date'));
		$this->load->database();
		$this->load->library('image_lib');
		if($this->config->item('pkg') !='1')
		{
			redirect('nonaktif/pkg');

		}
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
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Penilaian Kinerja Guru';
		$data["status"]=$this->session->userdata('tanda');
		$data["alert"]= $this->session->flashdata('pesan_info');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$datax["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$datax["tahunpenilaian"] = cari_tahun_penilaian();
		$nippegawai = cari_nip_pegawai($datax["kodeguru"]);
		$datax["status_pkg"] = $this->Guru_model->Status_Permanen_Pkg($datax["tahunpenilaian"],$nippegawai);
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/pkg_index',$datax);
		$this->load->view('shared/bawah');
	}
	function entry($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Proses Penilaian Kinerja Guru';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$tahunpenilaian = cari_tahun_penilaian();
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["id"] = $id;
		$data["kodeguru"] = $kodeguru;
		$data["tahunpenilaian"] = cari_tahun_penilaian();
		$nippegawai = cari_nip_pegawai($kodeguru);
		$status_pkg = $this->Guru_model->Status_Permanen_Pkg($tahunpenilaian,$nippegawai);
		if($status_pkg == '1')
		{
			redirect('pkg');
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pkg',$data);
			$this->load->view('shared/bawah');
		}
	}
	function updateskorpkg()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$cacah_indikator = $this->input->post('cacah_indikator');
		$tugas_tambahan = $this->input->post('tugas_tambahan');
		$id_kompetensi = $this->input->post('id_kompetensi');
		for($i=1;$i<=$cacah_indikator;$i++)
		{
			$in["id_pkg_t_nilai"]=$this->input->post("id_pkg_t_nilai_$i");
			$in["skor"]=$this->input->post("skor_$i");
			$this->Guru_model->Update_Skor_Pkg($in);
		}
		if (!empty($tugas_tambahan))
		{

			redirect('pkg/tambahan/'.$id_kompetensi);
		}
		else
		{
			redirect('pkg/entry/'.$id_kompetensi);
		}
	}
	function rekap()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= '';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["kodeguru"] = $kodeguru;
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
			$id='';
		}
		else
		{
			$id = $this->uri->segment(3);
		}
		if ($id =='tambahan')
		{
			$this->load->view('guru/pkg_tambahan_rekap',$data);
		}
		else
		{
			$this->load->view('guru/pkg_rekap',$data);
		}
	}
	function tambahan()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'PKG Tugas Tambahan';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$this->load->model('Helper_model','helper');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$id='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data["id"] = $id;
		$data["kodeguru"] = $kodeguru;
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$data["nippegawai"] = $this->helper->cari_nip_pegawai($kodeguru);
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/pkg_tugas_tambahan',$data);
		$this->load->view('shared/bawah');
	}
	function skp($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= '';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Situs_model');
		$this->load->model('Guru_model');
		$data["id"] = $id;
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/skp',$data);
		$this->load->view('shared/bawah');
	}
	function tambahskp($id=null)
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Tambah Unsur Tugas Relevan';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$pakaisms = $this->config->item('sms');
		$nip= $this->Guru_model->get_NIP($data["nim"]);
		$data["tanggal"] = mdate($datestring, $time);
		$data["id"] = $id;
		$data["nip"] = $nip;
		$data["status"] = $this->input->post('status');
		$data["predikat"] = $this->input->post('predikat');
		$data["kode"] = $this->input->post('kode');
		$data["kuantitas"] = $this->input->post('kuantitas');
		$data["waktu"] = $this->input->post('waktu');
		$data["satuanwaktu"] = $this->input->post('satuanwaktu');
		$data["biaya"] = $this->input->post('biaya');
		$data["kegiatane"] = $this->input->post('kegiatane');
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$tahunpenilaian=cari_tahun_penilaian();
		if ($id=='cetakskp')
		{
			$datax["tautanbalik"] = 'pkg/skp';
			$datax["nip"] = $nip;
			$datax["tahunpenilaian"]=cari_tahun_penilaian();
			$datax["usere"]='guru';
			$this->load->view('shared/mencetak_borang_skp',$datax);
		}
		if ($id != 'cetakskp')
		{
			$this->load->view('guru/bg_atas',$data);
		}
		if ($id=='hapus')
		{
			$tahunsekarang = date("Y");
			$bulansekarang = date('m');
			$tahunpenilaian = cari_tahun_penilaian();
			$pesan = 'mengajukan pembatalan';
			if(($bulansekarang<12) and ($tahunsekarang == $tahunpenilaian))
			{
				$this->db->query("update `ppk_pns` set `permanen`='0', `kepala`='0' where `tahun`='$tahunpenilaian' and `kode`='$nip'");
				$pesan = 'membatalkan';
			}

			$chat_id_admin_skp = $this->ref->ambil_nilai('chat_id_admin_skp');
			if(!empty($chat_id_admin_skp))
			{
				$this->load->helper('telegram');
				$pesanguru = $this->Guru_model->get_Nama($this->session->userdata('username')).' '.$pesan.' SKP '.$tahunpenilaian;
				$kirimpesan = kirimtelegram($chat_id_admin_skp,$pesanguru,$token_bot);
				$this->session->set_flashdata('pesan_info', '<div class="alert alert-info">Permintaan pembatalan SKP telah disampaikan ke Admin. Mohon bersabar.</div>');
				redirect('pkg/skp');
			}
			elseif($pakaisms == 1)
			{
				$inpes["DestinationNumber"]=$this->config->item('nohpadminskp');
				$inpes["TextDecoded"] = $this->Guru_model->get_Nama($this->session->userdata('username')).' '.$pesan.' SKP '.$tahunpenilaian.'';
				$inpes["id_sms_user"] =$this->config->item('id_sms_user');
				$this->Guru_model->Kirim_Pesan($inpes);
				$input=array();
				$input['username']=$data['nim'];
				$input['subjek']= 'Pembatalan SKP';
				$input['tujuan']="admin";
				$input['status_pesan']="N";
				$datestring = "%d-%m-%Y | %h:%i:%a";
				$input['waktu']=mdate($datestring,$time);
				$input['pesan']= $this->Guru_model->get_Nama($this->session->userdata('username')).' mengajukan pembatalan SKP '.$tahunpenilaian.', <a href="'.base_url().'admin/batalskp/'.$kodeguru.'">Batalkan</a>';
				$this->load->model('Situs_model');
				$this->Situs_model->Simpan_Pesan_Admin($input);
				?>
				<script type="text/javascript" language="javascript">
				alert("Permintaan pembatalan SKP telah disampaikan ke Admin. Mohon bersabar.");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."pkg/skp'>";
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
				alert("Silakan menghubungi langsung admin SKP.");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."pkg/skp'>";

			}
		}
		if ($id=='permanen')
		{
			$chat_id_admin_skp = $this->ref->ambil_nilai('chat_id_admin_skp');
			if(!empty($chat_id_admin_skp))
			{
				$this->load->helper('telegram');
				$pesanguru = $this->Guru_model->get_Nama($this->session->userdata('username')).' menetapkan SKP '.$tahunpenilaian;
				$kirimpesan = kirimtelegram($chat_id_admin_skp,$pesanguru,$token_bot);
			}
			else
			{
				$inpes["DestinationNumber"]=$this->config->item('nohpadminskp');
				$inpes["TextDecoded"] = $this->Guru_model->get_Nama($this->session->userdata('username')).' telah menetapkan SKP '.$tahunpenilaian.'';
				$inpes["id_sms_user"] =$this->config->item('id_sms_user');
				$this->Guru_model->Kirim_Pesan($inpes);
				?>
				<script type="text/javascript" language="javascript">
				alert("SKP permanen telah disampaikan ke Admin. Terima kasih.");
				</script>
				<?php
			}
			$this->Guru_model->Permanen_Hasil_Skp($tahunpenilaian,$nip);
			redirect('pkg/skp');
		}
		if ($id=='pkg')
		{
			$this->load->view('guru/skp_pkg',$data);
		}
		if ($id=='utama')
		{
			$this->load->view('guru/skp_utama',$data);
		}
		if ($id=='pkb')
		{
			$this->load->view('guru/skp_pkb',$data);
		}
		if ($id=='tugas')
		{
			$this->load->view('guru/skp_tugas',$data);
		}
		if ($id=='penunjang')
		{
			$this->load->view('guru/skp_penunjang',$data);
		}
		if ($id != 'cetakskp')
		{
			$this->load->view('shared/bawah');
		}
	}
	function hapusskp($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$nip = $this->Guru_model->get_NIP($data["nim"]);
		$this->load->helper(array('fungsi','pkg'));
		$tahunpenilaian = cari_tahun_penilaian();
		$tz = $this->db->query("select * from `ppk_pns` where tahun = '$tahunpenilaian' and `kode` = '$nip'");
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
			redirect('pkg/skp');
		}
		else
		{
			$this->Guru_model->Hapus_Skp($id,$nip);
			redirect('pkg/skp');
		}
	}
	function ubahskp($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah SKP';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$data['nip'] = $this->Guru_model->get_NIP($data["nim"]);
		$data["id"] = $id;
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$id_skp_skor_guru = $this->input->post('id_skp_skor_guru');
		if(!empty($id_skp_skor_guru))
		{
			$in["id_skp_skor_guru"]=$this->input->post("id_skp_skor_guru");
			$ak=$this->input->post("ak");
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
			redirect('pkg/skp');
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/skp_ubah',$data);
			$this->load->view('shared/bawah');
		}
	}
	function hitungskp()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= '';
		$data["status"]=$this->session->userdata('tanda');
		if ($this->uri->segment(3) === FALSE)
		{
    			$id='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}

		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["tanggal"] = mdate($datestring, $time);
		$data["kodeguru"] = $kodeguru;
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$data["id"] = $id;
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$this->load->view('guru/skp_hitung',$data);
	}
	function proses($id=null,$id_indikator=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= '';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$data["id"] = $id;
		$data["id_indikator"] = $id_indikator;
		$data["kodeguru"] = $kodeguru;
		$data["tahunpenilaian"] = cari_tahun_penilaian();
		$this->load->view('guru/bg_atas',$data);
		if(!empty($id_indikator))
		{
			$this->load->view('guru/pkg_proses_entry',$data);
		}
		else
		{
			$this->load->view('guru/pkg_proses',$data);
		}
		$this->load->view('shared/bawah');
	}
	function updateskorpkgproses()
	{
		$in=array();
		$in2=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$cacah_parameter = $this->input->post('cacah_parameter');
		$id_kompetensi = $this->input->post('id_kompetensi');
		$in2['id_indikator'] = $this->input->post('id_indikator');
		$in2['tahun'] = $this->input->post('tahun');
		$satu = $this->input->post('satu');
		$dua = $this->input->post('dua');
		$in2['nip'] = $this->Guru_model->get_NIP($nim);
		$skor = 0;
		for($i=1;$i<=$cacah_parameter;$i++)
		{
			$in["id_pkg_proses"]=$this->input->post("id_proses_$i");
			$in["nilai"]=$this->input->post("parameter_$i");
			$skor = $skor + $this->input->post("parameter_$i");
			$this->Guru_model->Update_Skor_Pkg_Proses($in);
		}
		$skore = 0;
		if ($skor==$satu)
		{
			$skore = 1;
		}
		if (($skor>$satu) and ($skor<$dua))
		{
			$skore = 1;
		}
		if (($skor==$dua) or ($skor>$dua))
		{
			$skore = 2;
		}
		$in2['skor']= $skore;
		$this->Guru_model->Update_Nilai_Pkg($in2);
		redirect('pkg/proses/'.$id_kompetensi);
	}
	function angkakredit()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= '';
		$data["nama"]=$this->session->userdata('nama');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$dari = $this->uri->segment(3);
		$data["kodeguru"] = $kodeguru;
		$data["thnajaran"] = $thnajaran;
		$data["semester"] = $semester;
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		if ($dari == 'skp')
		{
			$this->load->view('guru/pkg_angka_kredit_realisasi',$data);
		}
		else
		{
			$this->load->view('guru/pkg_angka_kredit',$data);
		}
	}
	function updaterealisasi()
	{
		$in=array();
		$in2=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$cacah_parameter = $this->input->post('cacah_indikator');
		for($i=1;$i<=$cacah_parameter;$i++)
		{
			$in["id_skp_skor_guru"]=$this->input->post("id_nilai_$i");
			$in["biaya_r"]=$this->input->post("biaya_$i");
			$in["kuantitas_r"]=$this->input->post("kuantitas_$i");
			$in["kualitas_r"]=$this->input->post("kualitas_$i");
			if($this->input->post("waktu_$i")>0)
			{
				$in["waktu_r"]=$this->input->post("waktu_$i");
			}
			else
			{
				$in["waktu_r"]=1;
			}
			$this->Guru_model->Update_Skor_Skp($in);
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pkg/hitungskp'>";
	}
	function sk()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'SK berlaku tiap semester';
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$data["kodeguru"]=$kodeguru;
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['query']=$this->Guru_model->Tampil_Data_Kepegawaian_Pegawai($data["nim"]); 
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$thnajaran = $this->input->post("thnajaran");
		$semester = $this->input->post("semester");
		$id_sk = $this->input->post("id_sk");
		if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($id_sk)))
		{
			$tsk = $this->db->query("select * from p_kepegawaian where id = '$id_sk'");
			$adask = $tsk->num_rows();
			$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
			$ada = $ttambahan->num_rows();
			if ($ada==0)
			{
				$this->db->query("insert into `p_tugas_tambahan` (`thnajaran`,`semester`,`kodeguru`) values ('$thnajaran','$semester','$kodeguru')");
			}
			if($adask > 0)
			{
				$this->db->query("update p_tugas_tambahan set id_sk='$id_sk' where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
			}
		}
		$data['thnajaran']=$thnajaran;
		$data['semester']=$semester;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/sk_semester',$data);
		$this->load->view('shared/bawah');
	}
	function skskp()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Pangkat Golongan Masa Penilaian SKP';
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$nippegawai = $this->Guru_model->get_NIP($data["nim"]);
		$data["nippegawai"]=$nippegawai;
		$data['query']=$this->Guru_model->Tampil_Data_Kepegawaian_Pegawai($data["nim"]); 
		$data["tahun"] = cari_tahun_penilaian();
//		$tawal = tanggal_indonesia_ke_barat($this->input->post("tawal"));
//		$takhir = tanggal_indonesia_ke_barat($this->input->post("takhir"));
		$skawal = $this->input->post("idskawal");
		$skakhir = $this->input->post("idskakhir");
		$tambah = $this->input->post("tambah");
//		$id_pejabat = $this->input->post("id_pejabat");
		$tahun = cari_tahun_penilaian();
		$proses = $this->input->post("proses");
		if($proses == 'post')
		{
//			$in['takhir'] = $takhir;
//			$in['tawal'] = $tawal;
			$in['skawal'] = $skawal;
			$in['skakhir'] = $skakhir;
			$in['tahun'] = $tahun;
			$in['kode'] = $nippegawai;
			$in['tambah'] = $tambah;
//			$in['id_pejabat'] = $id_pejabat;
			$in = nopetik($in);
			$this->Guru_model->Update_Parameter_Skp($in);
			redirect('pkg/skp');

		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/sk_skp',$data);
			$this->load->view('shared/bawah');
		}
	}
	function permanenpkg()
	{
		$this->load->helper(array('fungsi','pkg'));
		$data["nim"]=$this->session->userdata('username');
		$data['judulhalaman'] = 'Penilaian Kinerja Guru';
		$aksi = $this->uri->segment(3);
		$this->load->model('Guru_model');
		$this->load->model('Referensi_model','ref');
		$token_bot = $this->ref->ambil_nilai('token_bot');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$tahunpenilaian = cari_tahun_penilaian();
		$datax["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$datax["tahunpenilaian"] = cari_tahun_penilaian();
		$nippegawai = cari_nip_pegawai($kodeguru);
		if($aksi == 'batal')
		{
			$pesantelegram = $this->Guru_model->get_Nama($this->session->userdata('username')).' mengajukan pembatalan PKG '.$tahunpenilaian;
			$chat_id = $this->ref->ambil_nilai('chat_id_admin_skp');
			if(!empty($chat_id))
			{
				$this->load->helper('telegram');
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);

			}
			else
			{
				$inpes["DestinationNumber"]=$this->config->item('nohpadminskp');
				$inpes["TextDecoded"] = $pesantelegram;
				$this->Guru_model->Kirim_Pesan($inpes);
			}

			$this->session->set_flashdata('pesan_info', '<div class="alert alert-info">Pembatalan PKG telah disampaikan ke Admin. Mohon bersabar.</div>');
			redirect('pkg');
		}
		else
		{
			$this->Guru_model->Permanen_Pkg($tahunpenilaian,$nippegawai);
			$chat_id = $this->ref->ambil_nilai('chat_id_admin_skp');
			$pesantelegram = $this->Guru_model->get_Nama($this->session->userdata('username')).' menetapkan PKG '.$tahunpenilaian;
			if(!empty($chat_id))
			{
				$this->load->helper('telegram');
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);

			}
			else
			{
				$inpes["DestinationNumber"]=$this->config->item('nohpadminskp');
				$inpes["TextDecoded"] = $pesantelegram;
				$this->Guru_model->Kirim_Pesan($inpes);
			}
			$this->session->set_flashdata('pesan_info', '<div class="alert alert-info">Penetapan PKG telah disampaikan ke Admin. Terima kasih.</div>');
			redirect('pkg');
		}
	}
	function realisasiskp($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Realisasi SKP';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$nip = $this->Guru_model->get_NIP($this->session->userdata('username'));
		$tahunpenilaian=cari_tahun_penilaian();
		if($id == 'permanen')
		{
			$this->load->model('Referensi_model','ref');
			$chat_id = $this->ref->ambil_nilai('chat_id_admin_skp');
			$token_bot = $this->ref->ambil_nilai('token_bot');
			$pesantelegram = $this->Guru_model->get_Nama($this->session->userdata('username')).' mengirim realisasi SKP '.$tahunpenilaian.'';
			if(!empty($chat_id))
			{
				$this->load->helper('telegram');
				$kirimpesan = kirimtelegram($chat_id,$pesantelegram,$token_bot);
				$this->session->set_flashdata('pesan_info', '<div class="alert alert-info">Realisasi SKP telah disampaikan ke Admin. Mohon bersabar.</div>');
			}
			else
			{
				$inpes["DestinationNumber"]=$this->config->item('nohpadminskp');
				$inpes["TextDecoded"] = $pesantelegram;
				$inpes["id_sms_user"] =$this->config->item('id_sms_user');
				$this->Guru_model->Kirim_Pesan($inpes);
				?>
				<script type="text/javascript" language="javascript">
				alert("Realisasi SKP telah disampaikan ke Admin. Terima kasih.");
				</script>
				<?php
			}
			redirect('pkg/skp');


		}
		else
		{
			$data["id"] = $id;
			$bulan = $this->input->post("bulan");
			$data["tahunpenilaian"]= $tahunpenilaian;
			$data['nip'] = $nip;
			if((!empty($bulan)) and (!empty($id)))
			{
				$in['id_skp'] = $id;
				$in["tahun"] = cari_tahun_penilaian();
				$in["nip"] = $nip;
				$in['bulan'] = $bulan;
				$this->Guru_model->Tambah_Realisasi_Skp($in);
				redirect('pkg/realisasiskp');
			}
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/skp_realisasi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function hapusrealisasiskp()
	{
		$this->load->model('Guru_model');
		$id = $this->uri->segment(3);
		$this->Guru_model->Hapus_Realisasi_SKP($id);
		redirect('pkg/realisasiskp');
	}
	function penilai($tahun=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Penilai PKG';
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$data['query']=$this->Guru_model->Tampil_Data_Kepegawaian_Pegawai($data["nim"]); 
		$data['loncat'] = '';
		if($tahun > 0)
		{
			$tahunpenilaian = $tahun;
		}
		else
		{
			$tahunpenilaian = cari_tahun_penilaian();
		}
		$nip = $this->Guru_model->get_NIP($data["nim"]);
		$nip_penilai = nopetik($this->input->post("nip_penilai"));
		$haripkg = nopetik($this->input->post('haripkg'));
		$bulanpkg = nopetik($this->input->post('bulanpkg'));
		$tahunpkg = nopetik($this->input->post('tahunpkg'));
		$idskakhir = nopetik($this->input->post('idskakhir'));
		$tanggal = "$tahunpkg-$bulanpkg-$haripkg";
		if(!empty($nip_penilai))
		{
			$ta = $this->db->query("select `nip`,`nama` from `p_pegawai` where `nip`='$nip_penilai'");
			$nama_penilai = '';
			foreach($ta->result() as $a)
			{
				$nama_penilai = $a->nama;
			}
			$this->db->query("update `pkg_tim_penilai` set `nama_penilai`='$nama_penilai', `kode_penilai`='$nip_penilai', `tanggal`='$tanggal' where `kode_ternilai`='$nip' and `tahun`='$tahunpenilaian'");
			$this->db->query("update `ppk_pns` set `skakhir`='$idskakhir' where `kode`='$nip' and `tahun`='$tahunpenilaian'");

			redirect('pkg');
		}
		else
		{
			$data['tahun'] = $tahunpenilaian;
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pkg_penilai',$data);
			$this->load->view('shared/bawah');
		}
	}
	function penilai2($tahun=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Penilai PKG';
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$data['loncat'] = '';
		if($tahun > 0)
		{
			$tahunpenilaian = $tahun;
		}
		else
		{
			$tahunpenilaian = cari_tahun_penilaian();
		}

		$nip = $this->Guru_model->get_NIP($data["nim"]);
		$kode_penilai = nopetik($this->input->post("kode_penilai"));
		$nama_penilai = nopetik($this->input->post("nama_penilai"));
		$nip_penilai = nopetik($this->input->post("nip_penilai"));
		$haripkg = nopetik($this->input->post('haripkg'));
		$bulanpkg = nopetik($this->input->post('bulanpkg'));
		$tahunpkg = nopetik($this->input->post('tahunpkg'));
		$tanggal = "$tahunpkg-$bulanpkg-$haripkg";
		if((!empty($nip_penilai)) and (!empty($nama_penilai)))
		{
			$this->db->query("update `pkg_tim_penilai` set `nama_penilai`='$nama_penilai', `kode_penilai`='$nip_penilai', `tanggal`='$tanggal' where `kode_ternilai`='$nip' and `tahun`='$tahunpenilaian'");
			redirect('pkg');
		}
		else
		{
			$this->load->model('Referensi_model','ref');
			$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
			$data['tahun'] = $tahunpenilaian;
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/pkg_penilai2',$data);
			$this->load->view('shared/bawah');
		}
	}

	function revisiskp($id=null)
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Revisi Capaian SKP';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$data['nip'] = $this->Guru_model->get_NIP($data["nim"]);
		$data["id"] = $id;
		$data["tahunpenilaian"]=cari_tahun_penilaian();
		$id_skp_skor_guru_revisi = $this->input->post('id_skp_skor_guru');
		if(!empty($id_skp_skor_guru_revisi))
		{
			$in["id_skp_skor_guru_revisi"]=$this->input->post("id_skp_skor_guru");
			$ak=$this->input->post("ak");
			$in["biaya"]=$this->input->post("biaya");
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
			redirect('pkg/skp');
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/skp_revisi',$data);
			$this->load->view('shared/bawah');
		}
	}
	function hapusrevisiskp($id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$this->load->helper(array('fungsi','pkg'));
		$this->load->model('Guru_model');
		$nip = $this->Guru_model->get_NIP($data["nim"]);
		$this->Guru_model->Hapus_Skor_Skp_Revisi($nip,$id);
		redirect('pkg/skp');
	}
	function golskp($tahun = null,$id=null)
	{
		$this->load->helper('fungsi');
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$data['nippegawai'] = $this->Guru_model->get_NIP($data["nim"]);
		$data["judulhalaman"]= 'Penyesuaian Golongan Saat Menyusun Sasaran Kerja Pegawai Negeri Sipil';
		$data['loncat'] = '';
		$data["id"] = $id;
		if(empty($tahun))
		{
			$tahun =date("Y");
		}
		$data['tahun'] = $tahun;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/skp_golongan',$data);
		$this->load->view('shared/bawah');
	}
	function menilai($kodeguru= null)
	{
		$this->load->helper(array('fungsi','pkg'));
		$data["judulhalaman"]= 'Menilai PKG';
		$data["nim"]=$this->session->userdata('username');
		$this->load->model('Guru_model');
		$tahun =date("Y");
		$data["tahunpenilaian"] = cari_tahun_penilaian();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/menilai_pkg',$data);
		$this->load->view('shared/bawah');
	}
// akhir controller
}


?>
