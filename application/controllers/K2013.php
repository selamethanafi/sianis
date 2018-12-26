<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : k2013.php
// Lokasi      : application/controllers/
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


class K2013 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
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
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/isi_index',$data);
		$this->load->view('shared/bawah');
	}
	function aspekpenilaianketerampilan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Indikator Penilaian Keterampilan';
		$data['tekseditor'] = '';
		$id_mapel = $this->uri->segment(3);
		$data['nomoraspek'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['id_mapel']=$id_mapel;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/aspek_psikomotor_detil',$data);
		$this->load->view('shared/bawah');
	}
	function updateaspekpsikomotor()
	{
		$in=array();
		if($session!=""){
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
			if($status=="PA"){
				$id_mapel=$this->input->post('id_mapel');
				$nomoraspek=$this->input->post('nomoraspek');
				$in["thnajaran"]=$this->input->post('thnajaran');
				$in["semester"]=$this->input->post('semester');
				$in["kelas"]=$this->input->post('kelas');
				$in["mapel"]=$this->input->post('mapel');
				$in["keterangan"]=$this->input->post('keterangan');
				$np=0;				
				$in["p1"]=$this->input->post('p1');
				$in["p2"]=$this->input->post('p2');
				$in["p3"]=$this->input->post('p3');
				$in["p4"]=$this->input->post('p4');
				$in["p5"]=$this->input->post('p5');
				$in["p6"]=$this->input->post('p6');
				$in["p7"]=$this->input->post('p7');
				$in["p8"]=$this->input->post('p8');
				$in["p9"]=$this->input->post('p9');
				$in["p10"]=$this->input->post('p10');
		
				if (!empty($in["p1"]))
					{$np=$np+1;}
				if (!empty($in["p2"]))
					{$np=$np+1;}
				if (!empty($in["p3"]))
					{$np=$np+1;}
				if (!empty($in["p4"]))
					{$np=$np+1;}
				if (!empty($in["p5"]))
					{$np=$np+1;}
				if (!empty($in["p6"]))
					{$np=$np+1;}
				if (!empty($in["p7"]))
					{$np=$np+1;}
				if (!empty($in["p8"]))
					{$np=$np+1;}
				if (!empty($in["p9"]))
					{$np=$np+1;}
				if (!empty($in["p10"]))
					{$np=$np+1;}
				$in["np"] = $np;
				$in["s1"]=$this->input->post('s1');
				$in["s2"]=$this->input->post('s2');
				$in["s3"]=$this->input->post('s3');
				$in["s4"]=$this->input->post('s4');
				$in["s5"]=$this->input->post('s5');
				$in["s6"]=$this->input->post('s6');
				$in["s7"]=$this->input->post('s7');
				$in["s8"]=$this->input->post('s8');
				$in["s9"]=$this->input->post('s9');
				$in["s10"]=$this->input->post('s10');

				$this->load->model('Guru_model');
				$in["id_detil_aspek_psikomotor"]=$this->input->post('id_aspek_psikomotor');
				$this->Guru_model->Update_Detil_Aspek_Psikomotor($in);


				echo "<meta http-equiv='refresh' content='0; url=".base_url()."k2013/penilaianketerampilan/".$id_mapel."/".$nomoraspek."'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Guru...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
	}
	function penilaianketerampilan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Penilaian Keterampilan';
		$id_mapel = $this->uri->segment(3);
		$data['nomoraspek'] = $this->uri->segment(4);
		$data['id_nilai'] = $this->uri->segment(5);
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['id_mapel']=$id_mapel;
		$this->load->view('guru/bg_atas',$data);
		if(!empty($data['id_nilai']))
			{
			$this->load->view('guru/penilaian_keterampilan_persiswa',$data);
			}
			else
			{
			$this->load->view('guru/penilaian_keterampilan',$data);
			}

		$this->load->view('shared/bawah');
	}
	function perbaruidaftarsiswapenilaianketerampilan()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran=$this->input->post('thnajaran');
		$kelas=$this->input->post('kelas');
		$id_mapel=$this->input->post('id_mapel');
		$mapel=$this->input->post('mapel');
		$nomoraspek=$this->input->post('nomoraspek');
		$semester=$this->input->post('semester');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
			{
				$nis = $dsiswa->nis;
				$no_urut = $dsiswa->no_urut;
				if($semester==1)
					{
					$status=$dsiswa->status;
					}
					else
					{
					$status2=$dsiswa->status2;
					}
				$ada = $this->Guru_model->Cek_Nilai_Keterampilan($thnajaran,$semester,$mapel,$nomoraspek,$nis);
				$ada = $ada->num_rows();
				$pbk['thnajaran'] = $thnajaran;
				$pbk['semester'] = $semester;
				$pbk['kelas'] = $kelas;
				$pbk['nis'] = $nis;
				$pbk['mapel'] = $mapel;
				$pbk['nomoraspek'] = $nomoraspek;
				$pbk['no_urut'] = $no_urut;
				$pbk['status'] = $status;
				$this->Guru_model->Add_Nilai_Keterampilan($pbk,$ada);
				
			}

		redirect('k2013/penilaianketerampilan/'.$id_mapel.'/'.$nomoraspek);
	}
	function keterampilanharian()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		if($session!=""){
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
			if($data["status"]=="PA"){
		$data['id_mapel'] = $this->uri->segment(3);
		$data['nomoraspek'] = $this->uri->segment(4);
		$data['itemnilai'] = $this->uri->segment(5);
		$data["tanggal"] = mdate($datestring, $time);
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/keterampilan_harian',$data);
		$this->load->view('shared/bawah');
			}
					else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Guru...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
	}
	function updatenilaiketerampilan()
	{
		$in=array();
		if($session!=""){
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
			if($status=="PA"){
				$this->load->model('Guru_model');
				$cacah_siswa = $this->input->post('cacah_siswa');
				$thnajaran = $this->input->post('thnajaran');
				$semester = $this->input->post('semester');
				$mapel = $this->input->post('mapel');
				$cacahitem = $this->input->post('cacahitem');
				$nomoraspek = $this->input->post('nomoraspek');
				$id_mapel = $this->input->post('id_mapel');
				$param['thnajaran'] = $thnajaran;
				$param['semester'] = $semester;
				$param['mapel'] = $mapel;
				$param["itemnilai"] = $nomoraspek;
				$pembagi = $cacahitem * 4;
				for($i=1;$i<=$cacah_siswa;$i++)
				{
				$in["id_detil_keterampilan"]=$this->input->post("id_detil_keterampilan_$i");
				$in["p1"]=$this->input->post("p1_$i");
				$in["p2"]=$this->input->post("p2_$i");
				$in["p3"]=$this->input->post("p3_$i");
				$in["p4"]=$this->input->post("p4_$i");
				$in["p5"]=$this->input->post("p5_$i");
				$in["p6"]=$this->input->post("p6_$i");
				$in["p7"]=$this->input->post("p7_$i");
				$in["p8"]=$this->input->post("p8_$i");
				$in["p9"]=$this->input->post("p9_$i");
				$in["p10"]=$this->input->post("p10_$i");
				$in["nilai"] = 0;
				if ($pembagi>0)
					{
					$in["nilai"] = ($in["p1"]+$in["p2"]+$in["p3"]+$in["p4"]+$in["p5"]+$in["p6"]+$in["p7"]+$in["p8"]+$in["p9"]+$in["p10"]) * 100 / $pembagi;
					}
				
				
				$nis = $this->input->post("nis_$i");
				$this->Guru_model->Update_Nilai_Keterampilan($in);

				//update daftar nilai keterampilan
				$param['nis'] = $nis;
				$param['nilai'] = $in["nilai"];
				$this->Guru_model->Ubah_Nilai_Psikomotor($param);

				}

			if (empty($cacah_siswa))
				{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."k2013/errorcacahsiswa'>";
				}
			else 
				{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."k2013/penilaianketerampilan/$id_mapel/$nomoraspek'>";
				}
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Guru...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
	}
	function aspekpenilaiansikap()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$id_mapel = $this->uri->segment(3);
		$data['nomoraspek'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['id_mapel']=$id_mapel;
		$data['judulhalaman'] = 'Rincian Kriteria Penilaian Sikap';
		$data['tekseditor'] = '';
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/aspek_afektif_detil',$data);
		$this->load->view('shared/bawah');
	}
	function updateaspekafektif()
	{
		$in=array();
		if($session!=""){
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
			if($status=="PA"){
				$id_mapel=$this->input->post('id_mapel');
				$nomoraspek=$this->input->post('nomoraspek');
				$in["thnajaran"]=$this->input->post('thnajaran');
				$in["semester"]=$this->input->post('semester');
				$in["kelas"]=$this->input->post('kelas');
				$in["mapel"]=$this->input->post('mapel');
				$in["teknik"]=$this->input->post('teknik');
				$in["keterangan"]=$this->input->post('keterangan');
				$np=0;				
				$in["p1"]=$this->input->post('p1');
				$in["p2"]=$this->input->post('p2');
				$in["p3"]=$this->input->post('p3');
				$in["p4"]=$this->input->post('p4');
				$in["p5"]=$this->input->post('p5');
				$in["p6"]=$this->input->post('p6');
				$in["p7"]=$this->input->post('p7');
				$in["p8"]=$this->input->post('p8');
				$in["p9"]=$this->input->post('p9');
				$in["p10"]=$this->input->post('p10');
		
				if (!empty($in["p1"]))
					{$np=$np+1;}
				if (!empty($in["p2"]))
					{$np=$np+1;}
				if (!empty($in["p3"]))
					{$np=$np+1;}
				if (!empty($in["p4"]))
					{$np=$np+1;}
				if (!empty($in["p5"]))
					{$np=$np+1;}
				if (!empty($in["p6"]))
					{$np=$np+1;}
				if (!empty($in["p7"]))
					{$np=$np+1;}
				if (!empty($in["p8"]))
					{$np=$np+1;}
				if (!empty($in["p9"]))
					{$np=$np+1;}
				if (!empty($in["p10"]))
					{$np=$np+1;}
				$in["np"] = $np;
				$this->load->model('Guru_model');
				$in["id_detil_aspek_afektif"]=$this->input->post('id_aspek_afektif');
				$this->Guru_model->Update_Detil_Aspek_Afektif($in);


				echo "<meta http-equiv='refresh' content='0; url=".base_url()."k2013/penilaiansikap/".$id_mapel."/".$nomoraspek."'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Guru...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
	}
	function penilaiansikap()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Sikap';
		$id_mapel = $this->uri->segment(3);
		$data['nomoraspek'] = $this->uri->segment(4);
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['id_mapel']=$id_mapel;
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/penilaian_sikap',$data);
		$this->load->view('shared/bawah');
	}
	function perbaruidaftarsiswapenilaiansikap()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran=$this->input->post('thnajaran');
		$kelas=$this->input->post('kelas');
		$id_mapel=$this->input->post('id_mapel');
		$mapel=$this->input->post('mapel');
		$nomoraspek=$this->input->post('nomoraspek');
		$semester=$this->input->post('semester');
		$daftar_siswa = $this->Guru_model->Daftar_Siswa($thnajaran,$semester,$kelas);
		foreach($daftar_siswa->result() as $dsiswa)
			{
				$nis = $dsiswa->nis;
				$no_urut = $dsiswa->no_urut;
				if($semester==1)
					{
					$status=$dsiswa->status;
					}
					else
					{
					$status2=$dsiswa->status2;
					}
				$ada = $this->Guru_model->Cek_Nilai_Sikap($thnajaran,$semester,$mapel,$nomoraspek,$nis);
				$ada = $ada->num_rows();
				$pbk['thnajaran'] = $thnajaran;
				$pbk['semester'] = $semester;
				$pbk['kelas'] = $kelas;
				$pbk['nis'] = $nis;
				$pbk['mapel'] = $mapel;
				$pbk['nomoraspek'] = $nomoraspek;
				$pbk['no_urut'] = $no_urut;
				$pbk['status'] = $status;
				$this->Guru_model->Add_Nilai_Sikap($pbk,$ada);
				
			}
		redirect('k2013/penilaiansikap/'.$id_mapel.'/'.$nomoraspek);
	}
	function sikapharian()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data['judulhalaman'] = 'Penilaian Sikap Harian';
		$data['id_mapel'] = $this->uri->segment(3);
		$data['nomoraspek'] = $this->uri->segment(4);
		$data['itemnilai'] = $this->uri->segment(5);
		$this->load->model('Guru_model');
		$data['kodeguru'] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/sikap_harian',$data);
		$this->load->view('shared/bawah');
	}
	function updatenilaisikap()
	{
		$in=array();
		$nim=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$cacah_siswa = $this->input->post('cacah_siswa');
		$thnajaran = $this->input->post('thnajaran');
		$semester = $this->input->post('semester');
		$mapel = $this->input->post('mapel');
		$cacahitem = $this->input->post('cacahitem');
		$nomoraspek = $this->input->post('nomoraspek');
		$id_mapel = $this->input->post('id_mapel');
		$param['thnajaran'] = $thnajaran;
		$param['semester'] = $semester;
		$param['mapel'] = $mapel;
		$param["itemnilai"] = $nomoraspek;
		for($i=1;$i<=$cacah_siswa;$i++)
		{
			$in["id_detil_sikap"]=$this->input->post("id_detil_sikap_$i");
			$in["p1"]=$this->input->post("p1_$i");
			$in["p2"]=$this->input->post("p2_$i");
			$in["p3"]=$this->input->post("p3_$i");
			$in["p4"]=$this->input->post("p4_$i");
			$in["p5"]=$this->input->post("p5_$i");
			$in["p6"]=$this->input->post("p6_$i");
			$in["p7"]=$this->input->post("p7_$i");
			$in["p8"]=$this->input->post("p8_$i");
			$in["p9"]=$this->input->post("p9_$i");
			$in["p10"]=$this->input->post("p10_$i");
			$in["nilai"] = ($in["p1"]+$in["p2"]+$in["p3"]+$in["p4"]+$in["p5"]+$in["p6"]+$in["p7"]+$in["p8"]+$in["p9"]+$in["p10"])/$cacahitem;
			$nis = $this->input->post("nis_$i");
			$this->Guru_model->Update_Nilai_Sikap($in);
			//update daftar nilai sikap
			$param['nis'] = $nis;
			$param['nilai'] = $in["nilai"];
			$this->Guru_model->Ubah_Nilai_Afektif($param);
		}
		if (empty($cacah_siswa))
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."k2013/errorcacahsiswa'>";
		}
		else 
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."k2013/penilaiansikap/$id_mapel/$nomoraspek'>";
		}
	}
	function detilsiswa()
	{
		$in=array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		if($session!=""){
		$data['nim']=$this->session->userdata('username');
		$status=$this->session->userdata('tanda');
		$data["nama"]=$this->session->userdata('nama');
		$nis='';		
		$item = '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$nis='';
		}
		else
		{
    			$nis = $this->uri->segment(3);
		}
		if ($this->uri->segment(4) === FALSE)
		{
    			$id_walikelas='';
		}
		else
		{
    			$id_walikelas = $this->uri->segment(4);
		}
		if ($this->uri->segment(5) === FALSE)
		{
    			$item='';
		}
		else
		{
    			$item = $this->uri->segment(5);
		}
		if ($this->uri->segment(6) === FALSE)
		{
    			$penanganan='';
		}
		else
		{
    			$penanganan = $this->uri->segment(6);
		}

		if($status=="PA"){
			$data["tanggal"] = mdate($datestring, $time);
			$this->load->model('Admin_model');
			$data['query']=$this->Admin_model->Tampil_Data_Siswa($nis);
			$data["nis"]=$nis;
			$data["id_walikelas"]=$id_walikelas;
			$data["id_pemberitahuan"]=$penanganan;
			$this->load->model('Guru_model');
			$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
			$twali = $this->Guru_model->Id_Wali($id_walikelas,$kodeguru);
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
			$data['kelas']=$kelas;
			$data['thnajaran']=$thnajaran;
			$data['semester']=$semester;
			$data['kodeguru']=$kodeguru;
			}
			$this->load->view('guru/lck_pd_hasil',$data);

			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Guru...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
			}
	}
	function perbaruipenilaianketerampilanpersiswa()
	{
		$data = array();
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);
		$thnajaran=$this->input->post('thnajaran');
		$id_mapel=$this->input->post('id_mapel');
		$nomoraspek=$this->input->post('nomoraspek');
		$cacahindikator=$this->input->post('cacahindikator');
		$skore=$this->input->post('skore');
		$pbk['id_detil_keterampilan'] = $this->input->post('id_detil_keterampilan');
		$pbk['p1'] = $this->input->post('p1');
		$pbk['p2'] = $this->input->post('p2');
		$pbk['p3'] = $this->input->post('p3');
		$pbk['p4'] = $this->input->post('p4');
		$pbk['p5'] = $this->input->post('p5');
		$pbk['p6'] = $this->input->post('p6');
		$pbk['p7'] = $this->input->post('p7');
		$pbk['p8'] = $this->input->post('p8');
		$pbk['p9'] = $this->input->post('p9');
		$pbk['p10'] = $this->input->post('p10');
		$pbk['nilai'] = ($pbk['p1']+$pbk['p2']+$pbk['p3']+$pbk['p4']+$pbk['p5']+$pbk['p6']+$pbk['p7']+$pbk['p8']+$pbk['p9']+	$pbk['p10']) * 100 / $skore;
		$nilaipsi = $pbk['nilai'];
		$mapel = $this->input->post('mapel');
		$semester = $this->input->post('semester');
		$nis = $this->input->post('nis');
		$this->Guru_model->Simpan_Nilai_Detil_Keterampilan($pbk);
		$itempsi = "p$nomoraspek";
		/* versi baru */
		$this->db->query("update `nilai` set `$itempsi`='$nilaipsi' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and mapel='$mapel'");
		redirect('k2013/penilaianketerampilan/'.$id_mapel.'/'.$nomoraspek);
	}
// akhir controller
}


?>
