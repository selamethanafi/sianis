<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 04 Jan 2016 07:55:56 WIB 
// Nama Berkas 		: Login.php
// Lokasi      		: application/views/controller/
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

class Login extends CI_Controller {
 function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','string','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model', 'ref');
	}

function index()
 {
		$tanda = $this->session->userdata('tanda');
		if(isset($tanda))
		{
			if ($tanda=="Pegawai"){
				redirect('pegawai');
			}
			elseif($tanda=="Siswa"){
				redirect('siswa');
			}
			else if($tanda=="admin"){
				redirect('admin');
			}
			else if($tanda=="Staf"){
				redirect('admin');
			}
			else if($tanda=="Pengajaran"){
				redirect('pengajaran');
			}
			else if($tanda=="BP"){
				redirect('bp');
			}
			else if($tanda=="Tatausaha"){
				redirect('tatausaha');
			}
			else if($tanda=="Keuangan"){
				redirect('keuangan');
			}
			else if($tanda=="Panitia_Tes"){
				redirect('panitiates');
			}
			else if($tanda=="PA"){
				$d=strtotime("+7 days");
				$next_login = date("Y-m-d h:i:sa", $d);
				$this->db->query("update `tbllogin` set `next_login` = '$next_login' where `username`='$username'");
				redirect('guru');

			}
			else if($tanda=="Pengawas"){
				redirect('pengawas');
			}
			else if($tanda=="Kepala"){
				redirect('kepala');
			}
			else {
				redirect(base_url());
			}

		}
		$data = '';
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$this->load->view('login',$data);	
 }

function masuk()
	{
		$username = nopetik($this->input->post('usernameteks'));
		$psw = $this->input->post('passwordteks');
		$captcha = $this->input->post('captcha');
		// First, delete old captchas
		$expiration = time()-600; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		$oke = 1;
		if ($row->count == 0)
		{
		    $oke = 0;
		}
		$this->load->model('Situs_model');
		$password = 0;
		$pswhash = '';
		$hasil = $this->Situs_model->Data_Login($username);
		$ada = $hasil->num_rows();
		if (count($hasil->result_array())>0)
		{
			foreach($hasil->result() as $dh)
			{
				$pswhash = $dh->psw;
			}
			if (password_verify($psw, $pswhash)) 
			{
			    $password = 1;
			}
		}
		if (($password == 1) and ($oke == 1)){
			foreach($hasil->result() as $user){
				$data = array(
		                'username' => $user->username,
		                'nama' => $user->nama,
		                'login_status' => true,
		                'tanda' => $user->status,
            	);
			}
		        $this->session->set_userdata($data);
			$tanda = $this->session->userdata('tanda');
			if ($tanda=="Pegawai"){
				redirect('pegawai');
			}
			elseif($tanda=="Siswa"){
				redirect('siswa');
			}
			else if($tanda=="admin"){
				redirect('admin');
			}
			else if($tanda=="Staf"){
				redirect('admin');
			}
			else if($tanda=="Pengajaran"){
				redirect('pengajaran');
			}
			else if($tanda=="BP"){
				redirect('bp');
			}
			else if($tanda=="Tatausaha"){
				redirect('tatausaha');
			}
			else if($tanda=="Keuangan"){
				redirect('keuangan');
			}
			else if($tanda=="Panitia_Tes"){
				redirect('panitiates');
			}
			else if($tanda=="PA"){
				$d=strtotime("+7 days");
				$next_login = date("Y-m-d h:i:sa", $d);
				$this->db->query("update `tbllogin` set `next_login` = '$next_login' where `username`='$username'");
				redirect('guru');

			}
			else if($tanda=="Pengawas"){
				redirect('pengawas');
			}
			else if($tanda=="Kepala"){
				redirect('kepala');
			}
			else {
				redirect(base_url());
			}
		}
		else{
		$data['sek_nama'] = $this->ref->ambil_nilai('sek_nama');
		$data['galat'] = 'Username, password, kode keamanan yang Anda masukkan Salah atau belum diaktifkan..!!!';
		$this->load->view('login', $data);	
		}
	}
	function lupasandi()
	{
		$this->load->view('login/lupa_sandi');
	}

	function proseslupasandi()
	{
		$masukan = hilangkanpetik($this->input->post('masukan'));
		$this->load->model('Situs_model');
		$username = $this->Situs_model->Reset_Password($masukan);
		$noseluler = $this->Situs_model->Nomor_Seluler($username);
		$data["username"] = $username;
		$data["masukan"] = $masukan;
		if ((empty($username)) or (empty($noseluler)))
			{
			echo '<font size="2" face="arial">Maaf, Nomor ponsel <b>'.$username.' '.$noseluler.' '.$masukan.'</b> tidak kami temukan atau nomor seluler tidak terdaftar. Hubungi Admin.<br>Silakan <strong>Reload / Refresh</strong> halaman ini, <a href="'.base_url().'index.php/login/lupasandi"><strong>proses lagi</strong></a>';
			}
			else
			{
			$tahun = date("Y");
			$bulan = date("m");
			$tanggal = date("d");
			$jam = date("H");
			$menit = date("i");
			$detik = date("s");
			$today3 = "$tahun$bulan$tanggal$jam$menit$detik";
			$nirand = rand(1,1000);
			$nirandx = "$today3$nirand";
			$hajirobe = md5($nirandx);
			//pass baru
			$kode_reset = substr($hajirobe,0,10);
			$datainput=array();
			$datainput["noseluler"] = $noseluler;
			$datainput["kode_reset"] = $kode_reset;
			$this->Situs_model->Proses_Ganti_Password($datainput);
			$pesan = "kode pemulihan kata sandi $kode_reset Abaikan pesan ini bila tidak memulihkan kata sandi.";
			$this->Situs_model->Kirim_SMS_Guru($noseluler,$pesan,$this->config->item('id_sms_user'));
			$this->load->view('login/proses_lupa_sandi',$data);					
			}
	}
	function kirimsandi()
	{
		$kode_reset = hilangkanpetik($this->input->post('kode_reset'));
		$this->load->model('Situs_model');
		$treset = $this->Situs_model->Cek_Reset_Password($kode_reset);
		$ada = $treset->num_rows();
		
		if ($ada==0)
			{
			$this->load->view('login/proses_lupa_sandi_salah');
			}
			else
			{
			foreach ($treset->result() as $dd)
			{
				$data["noseluler"] = $dd->noseluler;
			}
			$this->load->view('login/ganti_password_user',$data);
			}			
	}
	function updatepassworduser()
	{
		$noseluler=hilangkanpetik($this->input->post('noseluler'));
		$psw=hilangkanpetik($this->input->post('pwd'));
		$psw1 = $psw;
		$this->load->model('Situs_model');
		$username = $this->Situs_model->Seluler_Jadi_Username($noseluler);
		$this->Situs_model->Hapus_Reset($noseluler);				
		$options = array('cost' => 8);
			if(!empty($psw))
			{
				$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
			}
		$this->Situs_model->Update_Password($username,$psw);
		echo "<font size='2' face='arial'>Sukses memperbarui password.<br> Password baru Anda : <b>".$psw1." ".$psw."</b><br>
			Dengan username : <b>".$username.",</b><br>";
		echo 'Silakan login di <a href="'.base_url().'index.php/login"><strong>sini</strong></a>';
	}
	function logout()
	{
		session_destroy();
		redirect('login');
	}

}
