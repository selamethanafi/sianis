<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : guru.php
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


class Unggah extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$this->load->library('image_lib');
//		$this->load->plugin();
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
		$data["nama"]=$this->session->userdata('nama');
		$data["status"]=$this->session->userdata('tanda');
		$data["thnajaran"] = cari_thnajaran();
		$data["semester"] = cari_semester();
		$this->load->view('guru/bg_atas',$data);
		$this->load->view('guru/unggah_index',$data);
		$this->load->view('situs/bawah');
	}
	function unggahperangkat()
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["judulhalaman"]= 'Unggah Perangkat';
		$this->load->model('Guru_model');
		$kodeguru = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['yangdiunggah']=$this->input->post('yangdiunggah');
		$diproses=$this->input->post('diproses');	
		if ($diproses != 'oke') 
			{
			$this->load->view('guru/bg_atas',$data);
		}
		if ($diproses == 'oke')
			{ // awal oke
			if ($data['yangdiunggah'] == 'Analisis ulangan')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
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
				if(isset($field['mapel']))
					{
					$pbk['mapel'] = nopetik($field['mapel']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' mapel';
					$pbk['mapel'] = '';
					}
				if(isset($field['kelas']))
					{
					$pbk['kelas'] = nopetik($field['kelas']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kelas';
					$pbk['kelas'] = '';
					}
				if(isset($field['nis']))
					{
					$pbk['nis'] = nopetik($field['nis']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nis';
					$pbk['nis'] = '';
					}
				if(isset($field['no_urut']))
					{
					$pbk['no_urut'] = nopetik($field['no_urut']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' no_urut';
					$pbk['no_urut'] = '';
					}
				if(isset($field['ulangan']))
					{
					$pbk['ulangan'] = nopetik($field['ulangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' ulangan';
					$pbk['ulangan'] = '';
					}
				if(isset($field['jawaban']))
					{
					$pbk['jawaban'] = nopetik($field['jawaban']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' jawaban';
					$pbk['jawaban'] = '';
					}
				if(isset($field['nilai_s1']))
					{
					$pbk['nilai_s1'] = nopetik($field['nilai_s1']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s1';
					$pbk['nilai_s1'] = '';
					}
				if(isset($field['nilai_s2']))
					{
					$pbk['nilai_s2'] = nopetik($field['nilai_s2']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s2';
					$pbk['nilai_s2'] = '';
					}
				if(isset($field['nilai_s3']))
					{
					$pbk['nilai_s3'] = nopetik($field['nilai_s3']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s3';
					$pbk['nilai_s3'] = '';
					}
				if(isset($field['nilai_s4']))
					{
					$pbk['nilai_s4'] = nopetik($field['nilai_s4']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s4';
					$pbk['nilai_s4'] = '';
					}
				if(isset($field['nilai_s5']))
					{
					$pbk['nilai_s5'] = nopetik($field['nilai_s5']);
					}
					else
					{
					$adagalat = 1;
					$pbk['nilai_s5'] = '';
					}
				if(isset($field['nilai_s6']))
					{
					$pbk['nilai_s6'] = nopetik($field['nilai_s6']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s6';
					$pbk['nilai_s6'] = '';
					}
				if(isset($field['nilai_s7']))
					{
					$pbk['nilai_s7'] = nopetik($field['nilai_s7']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s7';
					$pbk['nilai_s7'] = '';
					}
				if(isset($field['nilai_s8']))
					{
					$pbk['nilai_s8'] = nopetik($field['nilai_s8']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s8';
					$pbk['nilai_s8'] = '';
					}
				if(isset($field['nilai_s9']))
					{
					$pbk['nilai_s9'] = nopetik($field['nilai_s9']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s9';
					$pbk['nilai_s9'] = '';
					}
				if(isset($field['nilai_s10']))
					{
					$pbk['nilai_s10'] = nopetik($field['nilai_s10']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s10';
					$pbk['nilai_s10'] = '';
					}
				if(isset($field['nilai_s11']))
					{
					$pbk['nilai_s11'] = nopetik($field['nilai_s11']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s11';
					$pbk['nilai_s11'] = '';
					}
				if(isset($field['nilai_s12']))
					{
					$pbk['nilai_s12'] = nopetik($field['nilai_s12']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s12';
					$pbk['nilai_s12'] = '';
					}
				if(isset($field['nilai_s13']))
					{
					$pbk['nilai_s13'] = nopetik($field['nilai_s13']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s13';
					$pbk['nilai_s13'] = '';
					}
				if(isset($field['nilai_s14']))
					{
					$pbk['nilai_s14'] = nopetik($field['nilai_s14']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s14';
					$pbk['nilai_s14'] = '';
					}
				if(isset($field['nilai_s15']))
					{
					$pbk['nilai_s15'] = nopetik($field['nilai_s15']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s15';
					$pbk['nilai_s15'] = '';
					}
				if(isset($field['nilai_s16']))
					{
					$pbk['nilai_s16'] = nopetik($field['nilai_s16']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s16';
					$pbk['nilai_s16'] = '';
					}
				if(isset($field['nilai_s17']))
					{
					$pbk['nilai_s17'] = nopetik($field['nilai_s17']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s17';
					$pbk['nilai_s17'] = '';
					}
				if(isset($field['nilai_s18']))
					{
					$pbk['nilai_s18'] = nopetik($field['nilai_s18']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s18';
					$pbk['nilai_s18'] = '';
					}
				if(isset($field['nilai_s19']))
					{
					$pbk['nilai_s19'] = nopetik($field['nilai_s19']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s19';
					$pbk['nilai_s19'] = '';
					}
				if(isset($field['nilai_s20']))
					{
					$pbk['nilai_s20'] = nopetik($field['nilai_s20']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s20';
					$pbk['nilai_s20'] = '';
					}
				if(isset($field['nilai_s21']))
					{
					$pbk['nilai_s21'] = nopetik($field['nilai_s21']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s21';
					$pbk['nilai_s21'] = '';
					}
				if(isset($field['nilai_s22']))
					{
					$pbk['nilai_s22'] = nopetik($field['nilai_s22']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s22';
					$pbk['nilai_s22'] = '';
					}
				if(isset($field['nilai_s23']))
					{
					$pbk['nilai_s23'] = nopetik($field['nilai_s23']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s23';
					$pbk['nilai_s23'] = '';
					}
				if(isset($field['nilai_s24']))
					{
					$pbk['nilai_s24'] = nopetik($field['nilai_s24']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s24';
					$pbk['nilai_s24'] = '';
					}
				if(isset($field['nilai_s25']))
					{
					$pbk['nilai_s25'] = nopetik($field['nilai_s25']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s25';
					$pbk['nilai_s25'] = '';
					}
				if(isset($field['nilai_s26']))
					{
					$pbk['nilai_s26'] = nopetik($field['nilai_s26']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s26';
					$pbk['nilai_s26'] = '';
					}
				if(isset($field['nilai_s27']))
					{
					$pbk['nilai_s27'] = nopetik($field['nilai_s27']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s27';
					$pbk['nilai_s27'] = '';
					}
				if(isset($field['nilai_s28']))
					{
					$pbk['nilai_s28'] = nopetik($field['nilai_s28']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s28';
					$pbk['nilai_s28'] = '';
					}
				if(isset($field['nilai_s29']))
					{
					$pbk['nilai_s29'] = nopetik($field['nilai_s29']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s29';
					$pbk['nilai_s29'] = '';
					}
				if(isset($field['nilai_s30']))
					{
					$pbk['nilai_s30'] = nopetik($field['nilai_s30']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s30';
					$pbk['nilai_s30'] = '';
					}
				if(isset($field['nilai_s31']))
					{
					$pbk['nilai_s31'] = nopetik($field['nilai_s31']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s31';
					$pbk['nilai_s31'] = '';
					}
				if(isset($field['nilai_s32']))
					{
					$pbk['nilai_s32'] = nopetik($field['nilai_s32']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s32';
					$pbk['nilai_s32'] = '';
					}
				if(isset($field['nilai_s33']))
					{
					$pbk['nilai_s33'] = nopetik($field['nilai_s33']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s33';
					$pbk['nilai_s33'] = '';
					}
				if(isset($field['nilai_s34']))
					{
					$pbk['nilai_s34'] = nopetik($field['nilai_s34']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s34';
					$pbk['nilai_s34'] = '';
					}
				if(isset($field['nilai_s35']))
					{
					$pbk['nilai_s35'] = nopetik($field['nilai_s35']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s35';
					$pbk['nilai_s35'] = '';
					}
				if(isset($field['nilai_s36']))
					{
					$pbk['nilai_s36'] = nopetik($field['nilai_s36']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s36';
					$pbk['nilai_s36'] = '';
					}
				if(isset($field['nilai_s37']))
					{
					$pbk['nilai_s37'] = nopetik($field['nilai_s37']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s37';
					$pbk['nilai_s37'] = '';
					}
				if(isset($field['nilai_s38']))
					{
					$pbk['nilai_s38'] = nopetik($field['nilai_s38']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s38';
					$pbk['nilai_s38'] = '';
					}
				if(isset($field['nilai_s39']))
					{
					$pbk['nilai_s39'] = nopetik($field['nilai_s39']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s39';
					$pbk['nilai_s39'] = '';
					}
				if(isset($field['nilai_s40']))
					{
					$pbk['nilai_s40'] = nopetik($field['nilai_s40']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s40';
					$pbk['nilai_s40'] = '';
					}
				if(isset($field['nilai_s41']))
					{
					$pbk['nilai_s41'] = nopetik($field['nilai_s41']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s41';
					$pbk['nilai_s41'] = '';
					}
				if(isset($field['nilai_s42']))
					{
					$pbk['nilai_s42'] = nopetik($field['nilai_s42']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s42';
					$pbk['nilai_s42'] = '';
					}
				if(isset($field['nilai_s43']))
					{
					$pbk['nilai_s43'] = nopetik($field['nilai_s43']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s43';
					$pbk['nilai_s43'] = '';
					}
				if(isset($field['nilai_s44']))
					{
					$pbk['nilai_s44'] = nopetik($field['nilai_s44']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s44';
					$pbk['nilai_s44'] = '';
					}
				if(isset($field['nilai_s45']))
					{
					$pbk['nilai_s45'] = nopetik($field['nilai_s45']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s45';
					$pbk['nilai_s45'] = '';
					}
				if(isset($field['nilai_s46']))
					{
					$pbk['nilai_s46'] = nopetik($field['nilai_s46']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s46';
					$pbk['nilai_s46'] = '';
					}
				if(isset($field['nilai_s47']))
					{
					$pbk['nilai_s47'] = nopetik($field['nilai_s47']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s47';
					$pbk['nilai_s47'] = '';
					}
				if(isset($field['nilai_s48']))
					{
					$pbk['nilai_s48'] = nopetik($field['nilai_s48']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s48';
					$pbk['nilai_s48'] = '';
					}
				if(isset($field['nilai_s49']))
					{
					$pbk['nilai_s49'] = nopetik($field['nilai_s49']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s49';
					$pbk['nilai_s49'] = '';
					}
				if(isset($field['nilai_s50']))
					{
					$pbk['nilai_s50'] = nopetik($field['nilai_s50']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_s50';
					$pbk['nilai_s50'] = '';
					}
				if(isset($field['dicapai']))
					{
					$pbk['dicapai'] = nopetik($field['dicapai']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' dicapai';
					$pbk['dicapai'] = '';
					}
				if(isset($field['nilai_ideal']))
					{
					$pbk['nilai_ideal'] = nopetik($field['nilai_ideal']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_ideal';
					$pbk['nilai_ideal'] = '';
					}
				if(isset($field['persentase']))
					{
					$pbk['persentase'] = nopetik($field['persentase']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' persentase';
					$pbk['persentase'] = '';
					}
				if(isset($field['ketuntasan']))
					{
					$pbk['ketuntasan'] = nopetik($field['ketuntasan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' ketuntasan';
					$pbk['ketuntasan'] = '';
					}
				if(isset($field['status']))
					{
					$pbk['status'] = nopetik($field['status']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' status';
					$pbk['status'] = '';
					}
				if(isset($field['uraian_1']))
					{
					$pbk['uraian_1'] = nopetik($field['uraian_1']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' uraian_1';
					$pbk['uraian_1'] = '';
					}
				if(isset($field['uraian_2']))
					{
					$pbk['uraian_2'] = nopetik($field['uraian_2']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' uraian_2';
					$pbk['uraian_2'] = '';
					}
				if(isset($field['uraian_3']))
					{
					$pbk['uraian_3'] = nopetik($field['uraian_3']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' uraian_3';
					$pbk['uraian_3'] = '';
					}
				if(isset($field['uraian_4']))
					{
					$pbk['uraian_4'] = nopetik($field['uraian_4']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' uraian_4';
					$pbk['uraian_4'] = '';
					}
				if(isset($field['uraian_5']))
					{
					$pbk['uraian_5'] = nopetik($field['uraian_5']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' uraian_5';
					$pbk['uraian_5'] = '';
					}
				if(isset($field['nilai_akhir']))
					{
					$pbk['nilai_akhir'] = nopetik($field['nilai_akhir']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_akhir';
					$pbk['nilai_akhir'] = '';
					}
				if(isset($field['terkunci']))
					{
					$pbk['terkunci'] = nopetik($field['terkunci']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' terkunci';
					$pbk['terkunci'] = '';
					}
				if(isset($field['kelompok']))
					{
					$pbk['kelompok'] = nopetik($field['kelompok']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kelompok';
					$pbk['kelompok'] = '';
					}
				$sudahada = 1;
				if($data["status"] == 'PA')
					{
					$id_mapel = $this->Guru_model->Cari_Id_Mapel($pbk['thnajaran'],$pbk['semester'],$pbk['kelas'],$pbk['mapel'],$kodeguru);
					}
				if((!empty($id_mapel)) and ($adagalat == 0))
					{
					$this->Guru_model->Update_Analisis_Impor($pbk);
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Tabel Analisis';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if($adagalat==1)
					{
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/guru/analisis/".$id_mapel."/".$pbk['ulangan']."'>";
					}
				}
			if ($data['yangdiunggah'] == 'Rencana Pelaksanaan Pembelajaran')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
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
				if(isset($field['kodeguru']))
					{
					$pbk['kodeguru'] = nopetik($field['kodeguru']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kodeguru';
					$pbk['kodeguru'] = '';
					}
				if(isset($field['mapel']))
					{
					$pbk['mapel'] = nopetik($field['mapel']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' mapel';
					$pbk['mapel'] = '';
					}
				if(isset($field['tingkat']))
					{
					$pbk['kelas'] = nopetik($field['tingkat']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tingkat';
					$pbk['kelas'] = '';
					}
				if(isset($field['no_rpp']))
					{
					$pbk['no_rpp'] = nopetik($field['no_rpp']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' no_rpp';
					$pbk['no_rpp'] = '';
					}
				if(isset($field['waktu']))
					{
					$pbk['waktu'] = nopetik($field['waktu']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' waktu';
					$pbk['waktu'] = '';
					}
				if(isset($field['standar_kompetensi']))
					{
					$pbk['standar_kompetensi'] = nopetik($field['standar_kompetensi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' standar_kompetensi';
					$pbk['standar_kompetensi'] = '';
					}
				if(isset($field['kompetensi_dasar']))
					{
					$pbk['kompetensi_dasar'] = nopetik($field['kompetensi_dasar']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kompetensi_dasar';
					$pbk['kompetensi_dasar'] = '';
					}
				if(isset($field['indikator_pencapaian_kompetensi']))
					{
					$pbk['indikator_pencapaian_kompetensi'] = nopetik($field['indikator_pencapaian_kompetensi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' indikator_pencapaian_kompetensi';
					$pbk['indikator_pencapaian_kompetensi'] = '';
					}
				if(isset($field['tujuan_pembelajaran']))
					{
					$pbk['tujuan_pembelajaran'] = nopetik($field['tujuan_pembelajaran']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tujuan_pembelajaran';
					$pbk['tujuan_pembelajaran'] = '';
					}
				if(isset($field['materi_pembelajaran']))
					{
					$pbk['materi_pembelajaran'] = nopetik($field['materi_pembelajaran']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' materi_pembelajaran';
					$pbk['materi_pembelajaran'] = '';
					}
				if(isset($field['model_pembelajaran']))
					{
					$pbk['model_pembelajaran'] = nopetik($field['model_pembelajaran']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' model_pembelajaran';
					$pbk['model_pembelajaran'] = '';
					}
				if(isset($field['strategi_pembelajaran']))
					{
					$pbk['strategi_pembelajaran'] = nopetik($field['strategi_pembelajaran']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' strategi_pembelajaran';
					$pbk['strategi_pembelajaran'] = '';
					}
				if(isset($field['sumber_belajar']))
					{
					$pbk['sumber_belajar'] = nopetik($field['sumber_belajar']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' sumber_belajar';
					$pbk['sumber_belajar'] = '';
					}
				if(isset($field['pendahuluan']))
					{
					$pbk['pendahuluan'] = nopetik($field['pendahuluan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' pendahuluan';
					$pbk['pendahuluan'] = '';
					}
				if(isset($field['eksplorasi']))
					{
					$pbk['eksplorasi'] = nopetik($field['eksplorasi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' eksplorasi';
					$pbk['eksplorasi'] = '';
					}
				if(isset($field['elaborasi']))
					{
					$pbk['elaborasi'] = nopetik($field['elaborasi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' elaborasi';
					$pbk['elaborasi'] = '';
					}
				if(isset($field['konfirmasi']))
					{
					$pbk['konfirmasi'] = nopetik($field['konfirmasi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' konfirmasi';
					$pbk['konfirmasi'] = '';
					}
				if(isset($field['penutup']))
					{
					$pbk['penutup'] = nopetik($field['penutup']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' penutup';
					$pbk['penutup'] = '';
					}
				if(isset($field['penilaian']))
					{
					$pbk['penilaian'] = nopetik($field['penilaian']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' penilaian';
					$pbk['penilaian'] = '';
					}
				if(isset($field['rencana']))
					{
					$pbk['rencana'] = nopetik($field['rencana']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' rencana';
					$pbk['rencana'] = '';
					}
				if(isset($field['tugas']))
					{
					$pbk['tugas'] = nopetik($field['tugas']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tugas';
					$pbk['tugas'] = '';
					}
				if(isset($field['jenis']))
					{
					$pbk['jenis'] = nopetik($field['jenis']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' jenis';
					$pbk['jenis'] = '';
					}

				$pbk['penilaian'] = nopetik($field['penilaian']);
				$sudahada = $this->Guru_model->Cek_Rpp($pbk['semester'],$pbk['mapel'],$pbk['kodeguru'],$pbk['no_rpp']);
				if($adagalat==0)
					{
					if ($kodeguru == $pbk['kodeguru'])
						{	
							if ($sudahada == 0)
							{
							$this->Guru_model->Tambah_Rpp($pbk);
							}
							else
							{
							$this->Guru_model->Update_Rpp_Impor($pbk);
							}
						}
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Rencana Pelaksanaan Pembelajaran';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if($adagalat==1)
					{
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/guru/rpp/tampil/'>";
					}
				}
			if (($data['yangdiunggah'] == 'Rencana Pelaksanaan Harian') or ($data['yangdiunggah'] == 'Buku Pelaksanaan Harian'))
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
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
				if(isset($field['kodeguru']))
					{
					$pbk['kodeguru'] = nopetik($field['kodeguru']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kodeguru';
					$pbk['kodeguru'] = '';
					}
				if(isset($field['mapel']))
					{
					$pbk['mapel'] = nopetik($field['mapel']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' mapel';
					$pbk['mapel'] = '';
					}
				if(isset($field['kelas']))
					{
					$pbk['kelas'] = nopetik($field['kelas']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kelas';
					$pbk['kelas'] = '';
					}
				if(isset($field['tanggal']))
					{
					$pbk['tanggal'] = nopetik($field['tanggal']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tanggal';
					$pbk['tanggal'] = '';
					}
				if(isset($field['jamke']))
					{
					$pbk['jamke'] = nopetik($field['jamke']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' jamke';
					$pbk['jamke'] = '';
					}
				if(isset($field['kode_rpp']))
					{
					$pbk['kode_rpp'] = nopetik($field['kode_rpp']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kode_rpp';
					$pbk['kode_rpp'] = '';
					}
				if(isset($field['kode_rpp2']))
					{
					$pbk['kode_rpp2'] = nopetik($field['kode_rpp2']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kode_rpp2';
					$pbk['kode_rpp2'] = '';
					}
				if(isset($field['kode_rpp']))
					{
					$pbk['kode_rpp'] = nopetik($field['kode_rpp']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kode_rpp';
					$pbk['kode_rpp'] = '';
					}
				if(isset($field['keterangan']))
					{
					$pbk['keterangan'] = nopetik($field['keterangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan';
					$pbk['keterangan'] = '';
					}
				if(isset($field['tanggal_bph']))
					{
					$pbk['tanggal_bph'] = nopetik($field['tanggal_bph']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tanggal_bph';
					$pbk['tanggal_bph'] = '';
					}
				if(isset($field['hambatan_siswa']))
					{
					$pbk['hambatan_siswa'] = nopetik($field['hambatan_siswa']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' hambatan_siswa';
					$pbk['hambatan_siswa'] = '';
					}
				if(isset($field['solusi']))
					{
					$pbk['solusi'] = nopetik($field['solusi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' solusi';
					$pbk['solusi'] = '';
					}
				if(isset($field['alat_dan_bahan']))
					{
					$pbk['alat_dan_bahan'] = nopetik($field['alat_dan_bahan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' alat_dan_bahan';
					$pbk['alat_dan_bahan'] = '';
					}
				if(isset($field['lab']))
					{
					$pbk['lab'] = nopetik($field['lab']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' lab';
					$pbk['lab'] = '';
					}
				$thnajaran = $pbk['thnajaran'];
				$semester = $pbk['semester'];
				$kodegurux = $pbk['kodeguru'];
				$mapel = $pbk['mapel'];
				$kelas = $pbk['kelas'];
				$tanggal = $pbk['tanggal'];
				$jamke = $pbk['jamke'];
				$sudahada = $this->Guru_model->Cek_Rph2($thnajaran,$semester,$mapel,$kelas,$tanggal,$kodegurux,$jamke);
				$id_mapel = $this->Guru_model->Cari_Id_Mapel($thnajaran,$semester,$kelas,$mapel,$kodeguru);
				if(empty($id_mapel))
				{
					$adagalat = 1;
					$pesan .= ' id_mapel';
				}
				if((!empty($id_mapel)) and ($adagalat==0))
					{
					if ($kodeguru == $pbk['kodeguru'])
						{	
						if ($sudahada > 0)
							{
							$this->Guru_model->Ubah_Rph2($pbk);
							}
							else
							{
							$this->Guru_model->Tambah_Rph2($pbk);
							}
						}
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah RPH / BPH / Buku Tugas';
				$datay['tautan_balik'] = ''.base_url().'unggah/unggahperangkat';
				if($adagalat==1)
					{
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
						redirect('guru/rph');	
					}
				}
			if ($data['yangdiunggah'] == 'Buku Tugas')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
				if(isset($field['id_rph']))
					{
					$pbk['id_rph'] = nopetik($field['id_rph']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' id_rph';
					$pbk['id_rph'] = '';
					}
				if(isset($field['tanggalselesai']))
					{
					$pbk['tanggalselesai'] = nopetik($field['tanggalselesai']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tanggalselesai';
					$pbk['tanggalselesai'] = '';
					}
				if(isset($field['tugas']))
					{
					$pbk['tugas'] = nopetik($field['tugas']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tugas';
					$pbk['tugas'] = '';
					}
				if(isset($field['is_mandiri']))
					{
					$pbk['is_mandiri'] = nopetik($field['is_mandiri']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' is_mandiri';
					$pbk['is_mandiri'] = '';
					}
				$this->Guru_model->Update_Rph($pbk);
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Tabel Buku Tugas';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if($adagalat==1)
					{
					$this->load->view('guru/bg_atas',$data);

					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					}

				}
			if ($data['yangdiunggah'] == 'Jawaban Siswa')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
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
				if(isset($field['mapel']))
					{
					$pbk['mapel'] = nopetik($field['mapel']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' mapel';
					$pbk['mapel'] = '';
					}
				if(isset($field['ulangan']))
					{
					$pbk['ulangan'] = nopetik($field['ulangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' ulangan';
					$pbk['ulangan'] = '';
					}
				if(isset($field['nis']))
					{
					$pbk['nis'] = nopetik($field['nis']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nis';
					$pbk['nis'] = '';
					}
				if(isset($field['jawaban']))
					{
					$pbk['jawaban'] = nopetik($field['jawaban']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' jawaban';
					$pbk['jawaban'] = '';
					}
				$id_mapel = $this->Guru_model->Cari_Id_Mapel($pbk['thnajaran'],$pbk['semester'],$pbk['kelas'],$pbk['mapel'],$kodeguru);
				if((!empty($id_mapel)) and ($adagalat==0))
					{
					$this->Guru_model->Update_Jawaban_Impor($pbk);
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Jawaban Siswa';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if($adagalat==1)
					{
					$this->load->view('guru/bg_atas',$data);

					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/guru/analisisjawabansiswa/".$id_mapel."/".$ulangan."'>";
					}
				}
			if ($data['yangdiunggah'] == 'Daftar Nilai Kognitif')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$isi = '';
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
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
					$pbk['kelas'] = nopetik($field['kelas']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kelas';
					$pbk['kelas'] = '';
					}
				if(isset($field['mapel']))
					{
					$pbk['mapel'] = nopetik($field['mapel']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' mapel';
					$pbk['mapel'] = '';
					}
				if(isset($field['no_urut_lhb']))
					{
					$pbk['kd_mapel'] = nopetik($field['no_urut_lhb']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' no_urut_lhb';
					$pbk['kd_mapel'] = '';
					}
				if(isset($field['no_urut']))
					{
					$pbk['no_urut'] = nopetik($field['no_urut']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' no_urut';
					$pbk['no_urut'] = '';
					}
				if(isset($field['nis']))
					{
					$pbk['nis'] = nopetik($field['nis']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nis';
					$pbk['nis'] = '';
					}
				if(isset($field['nilai_uh1']))
					{
					$pbk['nilai_uh1'] = nopetik($field['nilai_uh1']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_uh1';
					$pbk['nilai_uh1'] = '';
					}
				if(isset($field['nilai_uh2']))
					{
					$pbk['nilai_uh2'] = nopetik($field['nilai_uh2']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_uh2';
					$pbk['nilai_uh2'] = '';
					}
				if(isset($field['nilai_uh3']))
					{
					$pbk['nilai_uh3'] = nopetik($field['nilai_uh3']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_uh3';
					$pbk['nilai_uh3'] = '';
					}
				if(isset($field['nilai_uh4']))
					{
					$pbk['nilai_uh4'] = nopetik($field['nilai_uh4']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_uh4';
					$pbk['nilai_uh4'] = '';
					}
				if(isset($field['nilai_ruh']))
					{
					$pbk['nilai_ruh'] = nopetik($field['nilai_ruh']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_ruh';
					$pbk['nilai_ruh'] = '';
					}
				if(isset($field['nilai_ku1']))
					{
					$pbk['nilai_ku1'] = nopetik($field['nilai_ku1']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_ku1';
					$pbk['nilai_ku1'] = '';
					}
				if(isset($field['nilai_ku2']))
					{
					$pbk['nilai_ku2'] = nopetik($field['nilai_ku2']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_ku2';
					$pbk['nilai_ku2'] = '';
					}
				if(isset($field['nilai_ku3']))
					{
					$pbk['nilai_ku3'] = nopetik($field['nilai_ku3']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_ku3';
					$pbk['nilai_ku3'] = '';
					}
				if(isset($field['nilai_ku4']))
					{
					$pbk['nilai_ku4'] = nopetik($field['nilai_ku4']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_ku4';
					$pbk['nilai_ku4'] = '';
					}
				if(isset($field['nilai_rku']))
					{
					$pbk['nilai_rku'] = nopetik($field['nilai_rku']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_rku';
					$pbk['nilai_rku'] = '';
					}
				if(isset($field['nilai_tu1']))
					{
					$pbk['nilai_tu1'] = nopetik($field['nilai_tu1']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_tu1';
					$pbk['nilai_tu1'] = '';
					}
				if(isset($field['nilai_tu2']))
					{
					$pbk['nilai_tu2'] = nopetik($field['nilai_tu2']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_tu2';
					$pbk['nilai_tu2'] = '';
					}
				if(isset($field['nilai_tu3']))
					{
					$pbk['nilai_tu3'] = nopetik($field['nilai_tu3']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_tu3';
					$pbk['nilai_tu3'] = '';
					}
				if(isset($field['nilai_tu4']))
					{
					$pbk['nilai_tu4'] = nopetik($field['nilai_tu4']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_tu4';
					$pbk['nilai_tu4'] = '';
					}
				if(isset($field['nilai_rtu']))
					{
					$pbk['nilai_rtu'] = nopetik($field['nilai_rtu']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_rtu';
					$pbk['nilai_rtu'] = '';
					}
				if(isset($field['nilai_nh']))
					{
					$pbk['nilai_nh'] = nopetik($field['nilai_nh']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_nh';
					$pbk['nilai_nh'] = '';
					}
				if(isset($field['nilai_mid']))
					{
					$pbk['nilai_mid'] = nopetik($field['nilai_mid']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_mid';
					$pbk['nilai_mid'] = '';
					}
				if(isset($field['nilai_na']))
					{
					$pbk['nilai_na'] = nopetik($field['nilai_na']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_na';
					$pbk['nilai_na'] = '';
					}
				if(isset($field['nilai_nr']))
					{
					$pbk['nilai_nr'] = nopetik($field['nilai_nr']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nilai_nr';
					$pbk['nilai_nr'] = '';
					}
				if(isset($field['psikomotor']))
					{
					$pbk['psikomotor'] = nopetik($field['psikomotor']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' psikomotor';
					$pbk['psikomotor'] = '';
					}
				if(isset($field['afektif']))
					{
					$pbk['afektif'] = nopetik($field['afektif']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' afektif';
					$pbk['afektif'] = '';
					}
				if(isset($field['kog']))
					{
					$pbk['kog'] = nopetik($field['kog']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kog';
					$pbk['kog'] = '';
					}
				if(isset($field['psi']))
					{
					$pbk['psi'] = nopetik($field['psi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' psi';
					$pbk['psi'] = '';
					}
				if(isset($field['afe']))
					{
					$pbk['afe'] = nopetik($field['afe']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' afe';
					$pbk['afe'] = '';
					}
				if(isset($field['ket']))
					{
					$pbk['ket'] = nopetik($field['ket']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' ket';
					$pbk['ket'] = '';
					}
				if(isset($field['keterangan']))
					{
					$pbk['keterangan'] = nopetik($field['keterangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan';
					$pbk['keterangan'] = '';
					}
				if(isset($field['status']))
					{
					$pbk['status'] = nopetik($field['status']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' status';
					$pbk['status'] = '';
					}
					$id_mapel = $this->Guru_model->Cari_Id_Mapel($pbk['thnajaran'],$pbk['semester'],$pbk['kelas'],$pbk['mapel'],$kodeguru);
					if((!empty($id_mapel)) and ($adagalat==0))
						{
						$this->Guru_model->Update_Nilai_Dari_Unggahan($pbk);
						}

				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Nilai Kognitif';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if($adagalat==1)
					{
					$this->load->view('guru/bg_atas',$data);

					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/guru/daftarnilai/".$id_mapel."'>";
					}
				}
			//awal buku informasi penilaian
			if ($data['yangdiunggah'] == 'Buku Informasi Penilaian')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
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
					$pbk['kelas'] = nopetik($field['kelas']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kelas';
					$pbk['kelas'] = '';
					}
				if(isset($field['mapel']))
					{
					$pbk['mapel'] = nopetik($field['mapel']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' mapel';
					$pbk['mapel'] = '';
					}
				if(isset($field['kodeguru']))
					{
					$pbk['kodeguru'] = nopetik($field['kodeguru']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kodeguru';
					$pbk['kodeguru'] = '';
					}
				if(isset($field['tanggal']))
					{
					$pbk['tanggal'] = nopetik($field['tanggal']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tanggal';
					$pbk['tanggal'] = '';
					}
				if(isset($field['jenisulangan']))
					{
					$pbk['jenisulangan'] = nopetik($field['jenisulangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' jenisulangan';
					$pbk['jenisulangan'] = '';
					}
				if(isset($field['skkdmateri']))
					{
					$pbk['skkdmateri'] = nopetik($field['skkdmateri']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' skkdmateri';
					$pbk['skkdmateri'] = '';
					}
				if(isset($field['isiinformasi']))
					{
					$pbk['isiinformasi'] = nopetik($field['isiinformasi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' isiinformasi';
					$pbk['isiinformasi'] = '';
					}
				if(isset($field['penerima']))
					{
					$pbk['penerima'] = nopetik($field['penerima']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' penerima';
					$pbk['penerima'] = '';
					}
				$sudahada = $this->Guru_model->Cek_Bip($pbk['thnajaran'],$pbk['semester'],$pbk['kelas'],$pbk['mapel'],$pbk['tanggal'],$pbk['kodeguru']);
				$id_mapel = $this->Guru_model->Cari_Id_Mapel($pbk['thnajaran'],$pbk['semester'],$pbk['kelas'],$pbk['mapel'],$kodeguru);
				if((!empty($id_mapel)) and ($adagalat==0))
					{
					if ($kodeguru == $pbk['kodeguru'])
						{	
							if ($sudahada == 0)
							{
							$this->Guru_model->Tambah_Bip($pbk);
							}
							else
							{		
							$this->Guru_model->Update_Bip_Dari_Unggahan($pbk);
							}
						}
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Buku Informasi Penilaian';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if(($adagalat==1) or (empty($id_mapel)))
					{
					$this->load->view('guru/bg_atas',$data);
					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/guru/bip/tampil'>";
					}
				}


			//akhir buku informasi penilaian
			//awal program kerja kepala laboratorium
			if ($data['yangdiunggah'] == 'Program Kerja Kepala Laboratorium')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
				if(isset($field['nourut']))
					{
					$pbk['nourut'] = nopetik($field['nourut']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nourut';
					$pbk['nourut'] = '';
					}
				if(isset($field['kodeguru']))
					{
					$pbk['kodeguru'] = nopetik($field['kodeguru']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kodeguru';
					$pbk['kodeguru'] = '';
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
				if(isset($field['namakegiatan']))
					{
					$pbk['namakegiatan'] = nopetik($field['namakegiatan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nama kegiatan';
					$pbk['namakegiatan'] = '';
					}
				if(isset($field['tujuan']))
					{
					$pbk['tujuan'] = nopetik($field['tujuan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tujuan';
					$pbk['tujuan'] = '';
					}
				if(isset($field['sasaran']))
					{
					$pbk['sasaran'] = nopetik($field['sasaran']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' sasaran';
					$pbk['sasaran'] = '';
					}
				if(isset($field['waktu']))
					{
					$pbk['waktu'] = nopetik($field['waktu']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' waktu';
					$pbk['waktu'] = '';
					}
				if(isset($field['sumberdana']))
					{
					$pbk['sumberdana'] = nopetik($field['sumberdana']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' sumberdana';
					$pbk['sumberdana'] = '';
					}
				if(isset($field['hasil']))
					{
					$pbk['hasil'] = nopetik($field['hasil']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' hasil';
					$pbk['hasil'] = '';
					}
				if(isset($field['keterangan']))
					{
					$pbk['keterangan'] = nopetik($field['keterangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan';
					$pbk['keterangan'] = '';
					}
				$sudahada = $this->Guru_model->Cek_Proker($pbk['thnajaran'],$pbk['nourut'],$pbk['kodeguru']);
				$is_kalab = $this->Guru_model->Cari_Kalab($pbk['thnajaran'],$kodeguru);
				if(($is_kalab > 0) and ($adagalat==0))
					{
					if ($kodeguru == $pbk['kodeguru'])
						{	
							if ($sudahada == 0)
							{
							$this->Guru_model->Tambah_Proker_Kalab($pbk);
							}
							else
							{		
							$this->Guru_model->Update_Proker_Kalab_Dari_Unggahan($pbk);
							}
						}
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Program Kerja Kepala Laboratorium';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if(($adagalat==1) or ($is_kalab == 0))
					{
					$this->load->view('guru/bg_atas',$data);

					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/kalab'>";
					}
				}
			//akhir program kerja kepala laboratorium
			//awal program harian kepala laboratorium
			if ($data['yangdiunggah'] == 'Program Harian Kepala Laboratorium')
				{
				$this->load->library('csvimport');
				$filePath = $_FILES["csvfile"]["tmp_name"];
				$csvData = $this->csvimport->get_array($filePath);	
				$n=0;
				$adagalat = 0;
				$pesan = '';
				foreach($csvData as $field):
				$baris = $n+1;
				$pesan .= 'Baris '.$baris.' Kolom';
				if(isset($field['kodeguru']))
					{
					$pbk['kodeguru'] = nopetik($field['kodeguru']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' kodeguru';
					$pbk['kodeguru'] = '';
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
					$pesan .= ' thnajaran';
					$pbk['thnajaran'] = '';
					}
				if(isset($field['tanggal']))
					{
					$pbk['tanggal'] = nopetik($field['tanggal']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tanggal';
					$pbk['tanggal'] = '';
					}
				if(isset($field['tempat']))
					{
					$pbk['tempat'] = nopetik($field['tempat']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' tempat';
					$pbk['tempat'] = '';
					}
				if(isset($field['waktu']))
					{
					$pbk['waktu'] = nopetik($field['waktu']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' waktu';
					$pbk['waktu'] = '';
					}
				if(isset($field['keterangan']))
					{
					$pbk['keterangan'] = nopetik($field['keterangan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan';
					$pbk['keterangan'] = '';
					}
				if(isset($field['namakegiatan']))
					{
					$pbk['namakegiatan'] = nopetik($field['namakegiatan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' nama kegiatan';
					$pbk['namakegiatan'] = '';
					}
				if(isset($field['terlaksana']))
					{
					$pbk['terlaksana'] = nopetik($field['terlaksana']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' terlaksana';
					$pbk['terlaksana'] = '';
					}
				if(isset($field['persentase']))
					{
					$pbk['persentase'] = nopetik($field['persentase']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' persentase';
					$pbk['persentase'] = '';
					}
				if(isset($field['keterangan_pelaksanaan']))
					{
					$pbk['keterangan_pelaksanaan'] = nopetik($field['keterangan_pelaksanaan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan_pelaksanaan';
					$pbk['keterangan_pelaksanaan'] = '';
					}
				if(isset($field['dukungan']))
					{
					$pbk['dukungan'] = nopetik($field['dukungan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' dukungan';
					$pbk['dukungan'] = '';
					}
				if(isset($field['hambatan']))
					{
					$pbk['hambatan'] = nopetik($field['hambatan']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' hambatan';
					$pbk['hambatan'] = '';
					}
				if(isset($field['keterangan_analisis']))
					{
					$pbk['keterangan_analisis'] = nopetik($field['keterangan_analisis']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan_analisis';
					$pbk['keterangan_analisis'] = '';
					}
				if(isset($field['solusi']))
					{
					$pbk['solusi'] = nopetik($field['solusi']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' solusi';
					$pbk['solusi'] = '';
					}
				if(isset($field['keterangan_tindak_lanjut']))
					{
					$pbk['keterangan_tindak_lanjut'] = nopetik($field['keterangan_tindak_lanjut']);
					}
					else
					{
					$adagalat = 1;
					$pesan .= ' keterangan_tindak_lanjut';
					$pbk['keterangan_tindak_lanjut'] = '';
					}

				$sudahada = $this->Guru_model->Cek_Prohar($pbk['thnajaran'],$pbk['tanggal'],$pbk['kodeguru']);
				$is_kalab = $this->Guru_model->Cari_Kalab($pbk['thnajaran'],$kodeguru);
				if(($is_kalab > 0) and ($adagalat==0))
					{
					if ($kodeguru == $pbk['kodeguru'])
						{	
							if ($sudahada == 0)
							{
							$this->Guru_model->Tambah_Agenda_Kalab($pbk);
							}
							else
							{		
							$this->Guru_model->Update_Agenda_Kalab_Dari_Unggahan($pbk);
							}
						}
					}
				$pesan .= ' TIDAK ADA<br />';
				$n++;
				endforeach;
				$datay['pesan'] = $pesan;
				$datay['modul'] = 'Unggah Program Kerja Kepala Laboratorium';
				$datay['tautan_balik'] = ''.base_url().'index.php/unggah/unggahperangkat';
				if(($adagalat==1) or ($is_kalab == 0))
					{
					$this->load->view('guru/bg_atas',$data);

					$this->load->view('guru/adagalat',$datay);
					$this->load->view('situs/bawah',$data);
					}
					else
					{
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/kalab'>";
					}
				}


			//akhir programharian kepala laboratorium

			} // akhir oke

			else
			{
			$this->load->view('shared/form_unggah_perangkat',$data);
			}
			if ($diproses != 'oke') 
			{
			$this->load->view('shared/bawah');
			}
	}
	function unduhperangkat($item=null,$tahun1=null,$semester=null,$id_mapel=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["loncat"]='';
		$data["judulhalaman"]= 'Mengunduh Perangkat';
		$data['item'] = $item;
		$data['tahun1'] = $tahun1;
		$data['semester'] = $semester;
		$data['id_mapel']= $id_mapel;
		$tahun2 = '';
		if($tahun1>0)
		{
			$tahun2 = $tahun1 + 1;
		}
		$this->load->model('Guru_model');
		$data["kodeguru"] = $this->Guru_model->Idlink_Jadi_Kode_Guru($data["nim"]);	
		$data['daftar_tapel']= $this->Guru_model->Tampilkan_Semua_Tahun();
		$data['thnajaran'] = $tahun1.'/'.$tahun2;
		if((!empty($item)) and (!empty($tahun1)) and (!empty($semester)) and (!empty($id_mapel)))
		{
			if($item == 13)
			{
				$this->load->view('guru/mengunduh_bph',$data);
			}
			else
			{
				echo 'maaf, belum dibuat';
			}
		}
		else
		{
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/form_unduh_perangkat',$data);
			$this->load->view('shared/bawah');
		}
	}
	function prosesunggahberkas($item=null,$id=null)
	{
		$nim=$this->session->userdata('username');
		$config['allowed_types'] ='jpg|png';

		$config['overwrite'] = TRUE;
		if($item == 'foto')
		{
			$config['upload_path'] = 'images/foto_guru_pegawai';
			$config['max_size'] = '100000';
			$config['max_width'] = '320';
			$config['max_height'] = '440';	
			$config['overwrite'] = TRUE;					
		}
		else
		{
			$config['upload_path'] = 'images/berkas_guru_pegawai';
		}
		if(empty($id))
		{
			$idne = $this->config->item('awalttd').$nim;
		}
		else
		{
			$idne = $this->config->item('awalttd').$id;
		}
		$this->load->model('Guru_model');
		$nama_pegawai = $this->Guru_model->get_Nama($nim);
		$nama_ybs = $this->input->post('nama_ybs');
		$tingkat = $this->input->post('tingkat');
		$nama_berkas = $this->input->post('nama_berkas');
		$uraian = $this->input->post('uraian');
		if(!empty($tingkat))
		{
			$acak = berkas($nama_pegawai).'_'.$item.'_tingkat_'.berkas($tingkat).'_'.md5($idne);
		}
		elseif(!empty($uraian))
		{
			$acak = berkas($nama_pegawai).'_'.$item.'_'.berkas($uraian).'_'.md5($idne);
		}
		elseif(!empty($nama_berkas))
		{
			$acak = berkas($nama_pegawai).'_'.berkas($nama_berkas).'_'.md5($idne);
		}

		else
		{
			if(empty($nama_ybs))
			{
				$acak = berkas($nama_pegawai).'_'.$item.'_'.md5($idne);
			}
			else
			{
				$acak = berkas($nama_pegawai).'_'.$item.'_'.berkas($nama_ybs).'_'.md5($idne);
			}
		}

		$file_ext = strrchr($_FILES['userfile']['name'], '.');
		$filename = $acak.''.$file_ext;
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$modul = 'Tidak diketahui';
		if($item == 'akta_kelahiran')
		{
			$modul = 'Akta Kelahiran';
		}
		$datay['modul'] = 'Unggah '.$modul;
		if(!empty($_FILES['userfile']['name']))
		{
			if(!$this->upload->do_upload())
			{
				$data['nim'] = $nim;
				$data['judulhalaman'] =' Galat, unggah berkas';
				$datay['pesan'] = $this->upload->display_errors();
				$datay['tautan_balik'] = base_url().'unggah/unggah/'.$item.'/'.$id;
				$this->load->view('guru/bg_atas',$data);
				$this->load->view('guru/adagalat',$datay);
				$this->load->view('shared/bawah',$data);
			}
			else 
			{
				if($item == 'akta_kelahiran')
				{
					$in["id"] = $id;
					$in['akta_kelahiran'] = $filename;
					$this->Guru_model->Update_Data_Keluarga($in);
					redirect('guru/keluarga');
				}
				elseif($item == 'akta_nikah')
				{
					$in["kd"] = $nim;
					$in['berkas_akta_nikah'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/keluarga');
				}
				elseif($item == 'akta_cerai')
				{
					$in["kd"] = $nim;
					$in['berkas_akta_cerai'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/keluarga');
				}

				elseif($item == 'askes_keluarga')
				{
					$in["id"] = $id;
					$in['kis'] = $filename;
					$this->Guru_model->Update_Data_Keluarga($in);
					redirect('guru/keluarga');
				}
				elseif($item == 'nip')
				{
					$in["kd"] = $nim;
					$in['berkas_nip'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'ktp')
				{
					$in["kd"] = $nim;
					$in['berkas_ktp'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'karpeg')
				{
					$in["kd"] = $nim;
					$in['berkas_karpeg'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'kpe')
				{
					$in["kd"] = $nim;
					$in['berkas_kpe'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'askes')
				{
					$in["kd"] = $nim;
					$in['berkas_askes'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'taspen')
				{
					$in["kd"] = $nim;
					$in['berkas_taspen'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'karsu')
				{
					$in["kd"] = $nim;
					$in['berkas_karsu'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'npwp')
				{
					$in["kd"] = $nim;
					$in['berkas_npwp'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'rekening')
				{
					$in["kd"] = $nim;
					$in['berkas_rekening'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'sertifikat_pendidik')
				{
					$in["kd"] = $nim;
					$in['berkas_sertifikat_pendidik'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'foto')
				{
					$in["kd"] = $nim;
					$in['foto'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/umum');
				}
				elseif($item == 'kartu_keluarga')
				{
					$in["kd"] = $nim;
					$in['berkas_kartu_keluarga'] = $filename;
					$this->Guru_model->Update_Data_Umum($in);
					redirect('guru/keluarga');
				}
				elseif($item == 'pendidikan')
				{
					$in["id"] = $id;
					$in["idpegawai"] = $nim;
					$in['berkas'] = $filename;
					$this->Guru_model->Update_Data_Pendidikan($in);
					redirect('guru/pendidikan');
				}
				elseif($item == 'kepegawaian')
				{
					$in["id"] = $id;
					$in["idpegawai"] = $nim;
					$in['berkas'] = $filename;
					$this->Guru_model->Update_Data_Kepegawaian($in);
					redirect('guru/kepegawaian');
				}
				elseif($item == 'sertifikat')
				{
					$in["id"] = $id;
					$in["idpegawai"] = $nim;
					$in['berkas'] = $filename;
					$this->Guru_model->Update_Data_Sertifikat($in);
					redirect('guru/sertifikat');
				}
				elseif($item == 'lain')
				{
					$this->db->query("insert into `p_berkas` (`kd`, `nama_berkas`, `berkas`) values ('$nim', '$nama_berkas', '$filename')");
					redirect('unggah/unggah/lain');
				}

				else
				{
					redirect('guru');
				}


			}
		}
		else
		{
			redirect('guru');
		}

	}
	function unggah($item=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah Anggota Keluarga';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data['item'] = $item;
		$ada = 0;
		if($item == 'akta_kelahiran')
		{
			$query=$this->Guru_model->Cek_Data_Keluarga($data["nim"],$id);
			$ada = $query->num_rows();
			$data['nama_item'] = 'Akta Kelahiran';
			$data["judulhalaman"]= 'Unggah Berkas Pindai Akta Kelahiran';
		}
		elseif($item == 'askes_keluarga')
		{
			$query=$this->Guru_model->Cek_Data_Keluarga($data["nim"],$id);
			$ada = $query->num_rows();
			$data['nama_item'] = 'Kartu Askes';
			$data["judulhalaman"]= 'Unggah Berkas Pindai Asuransi Kesehatan';
		}
		elseif($item == 'nip')
		{
			$data['nama_item'] = 'SK NIP';
			$data["judulhalaman"]= 'Unggah Berkas NIP';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'ktp')
		{
			$data['nama_item'] = 'Kartu Tanda Penduduk';
			$data["judulhalaman"]= 'Unggah Berkas KTP';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'karpeg')
		{
			$data['nama_item'] = 'Kartu Pegawai';
			$data["judulhalaman"]= 'Unggah Berkas Kartu Pegawai';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'kpe')
		{
			$data['nama_item'] = 'Kartu Pegawai Elektronik';
			$data["judulhalaman"]= 'Unggah Berkas Kartu Pegawai Elektronik';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'askes')
		{
			$data['nama_item'] = 'Kartu Askes';
			$data["judulhalaman"]= 'Unggah Berkas Kartu Askes';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'taspen')
		{
			$data['nama_item'] = 'Kartu Taspen';
			$data["judulhalaman"]= 'Unggah Berkas Kartu Taspen';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'karsu')
		{
			$data['nama_item'] = 'Kartu Suami / Istri';
			$data["judulhalaman"]= 'Unggah Berkas Kartu Suami / Istri';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'npwp')
		{
			$data['nama_item'] = 'Kartu NPWP';
			$data["judulhalaman"]= 'Unggah Berkas Kartu NPWP';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'rekening')
		{
			$data['nama_item'] = 'Buku Rekening';
			$data["judulhalaman"]= 'Unggah Berkas Buku Rekening';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'sertifikat_pendidik')
		{
			$data['nama_item'] = 'Sertifikat Pendidik';
			$data["judulhalaman"]= 'Unggah Berkas Sertifikat Pendidik';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'foto')
		{
			$data['nama_item'] = 'Foto';
			$data["judulhalaman"]= 'Unggah Berkas Foto';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'akta_nikah')
		{
			$data['nama_item'] = 'Akta Nikah';
			$data["judulhalaman"]= 'Unggah Berkas Akta Nikah';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'akta_cerai')
		{
			$data['nama_item'] = 'Akta Cerai';
			$data["judulhalaman"]= 'Unggah Berkas Akta Cerai';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'kartu_keluarga')
		{
			$data['nama_item'] = 'Kartu Keluarga';
			$data["judulhalaman"]= 'Unggah Berkas Kartu Keluarga';
			$ada = 1;
			$query="";
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'pendidikan')
		{
			$query=$this->Guru_model->Cek_Data_Pendidikan($data["nim"],$id);
			$ada = $query->num_rows();
			if($ada == 0)
			{
				redirect('guru/pendidikan');
			}
			$data['nama_item'] = 'Ijazah / Akta IV';
			$data["judulhalaman"]= 'Unggah Berkas Pindai Ijazah / Akta IV';
		}
		elseif($item == 'kepegawaian')
		{
			$query=$this->Guru_model->Cek_Data_Kepegawaian($data["nim"],$id);
			$ada = $query->num_rows();
			if($ada == 0)
			{
				redirect('guru/kependidikan');
			}
			$data['nama_item'] = 'Data Kepegawaian';
			$data["judulhalaman"]= 'Unggah Berkas Kepegawaian';
		}
		elseif($item == 'sertifikat')
		{
			$data['nama_item'] = 'Sertifikat';
			$data["judulhalaman"]= 'Unggah Sertifikat';
			$query=$this->Guru_model->Cek_Data_Sertifikat($data["nim"],$id);
			$ada = $query->num_rows();
			if($ada == 0)
			{
				redirect('guru/sertifikat');
			}
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
		}
		elseif($item == 'lain')
		{
			$data['nama_item'] = 'Lain - lain';
			$data["judulhalaman"]= 'Unggah Berkas Lain - Lain';
			$data['nama'] = $this->Guru_model->get_Nama($data['nim']);
			$ada = 1;
			$query= '';
		}

		else
		{
			redirect('guru');
		}

		if ($ada >0)
		{
			$data['id']=$id;
			$data['query']=$query;
			$data['nip']=$this->Guru_model->get_NIP($data["nim"]);
			$data['nama']=$this->Guru_model->get_Nama($data["nim"]);
			$this->load->view('guru/bg_atas',$data);
			$this->load->view('guru/unggah',$data);
			$this->load->view('shared/bawah');
		}
		else
		{
			redirect('guru');
		}
	}
	function hapus($item=null,$id=null)
	{
		$data["nim"]=$this->session->userdata('username');
		$data["judulhalaman"]= 'Ubah Anggota Keluarga';
		$data["status"]=$this->session->userdata('tanda');
		$this->load->model('Guru_model');
		$data['item'] = $item;
		$ada = 0;
		if(($item == 'akta_kelahiran') or ($item == 'askes_keluarga'))
		{
			if($item == 'askes_keluarga')
			{
				$item = 'kis';
			}
			$query=$this->Guru_model->Cek_Data_Keluarga($data["nim"],$id);
			$ada = $query->num_rows();
			$berkas = '';
			foreach($query->result() as $a)
			{
				$berkas = $a->$item;
			}
			$query=$this->Guru_model->Hapus_Berkas_Keluarga($data["nim"],$item,$id);
			unlink('images/berkas_guru_pegawai/'.$berkas);
			redirect('guru/keluarga');
		}
		elseif(($item == 'nip') or ($item == 'ktp') or ($item == 'karpeg') or ($item == 'kpe') or ($item == 'askes') or ($item == 'taspen') or ($item == 'karsu') or ($item == 'npwp') or ($item == 'rekening') or ($item == 'sertifikat_pendidik') or ($item == 'foto') or ($item == 'akta_nikah') or ($item == 'akta_cerai') or ($item == 'kartu_keluarga'))
		{
			$query = $this->Guru_model->Tampil_Data_Umum_Pegawai($data['nim']);
			$berkas = '';
			$field = 'berkas_'.$item;
			if($item == 'foto')
			{
				$field = 'foto';
			}
			foreach($query->result() as $a)
			{
				$berkas = $a->$field;
			}
			$query=$this->Guru_model->Hapus_Berkas_Pegawai($data["nim"],$field);
			unlink('images/berkas_guru_pegawai/'.$berkas);
			if(($item == 'akta_nikah') or ($item == 'akta_cerai') or ($item == 'kartu_keluarga'))
			{
				redirect('guru/keluarga');
			}
			redirect('guru/umum');

		}
		elseif($item == 'pendidikan')
		{
			$query = $this->Guru_model->Data_Pendidikan_Pegawai($data['nim'],$id);
			$berkas = '';
			foreach($query->result() as $a)
			{
				$berkas = $a->berkas;
			}
			$query=$this->Guru_model->Hapus_Berkas_Pendidikan($data["nim"],$id);
			unlink('images/berkas_guru_pegawai/'.$berkas);
			redirect('guru/pendidikan/'.$berkas);

		}
		elseif($item == 'kepegawaian')
		{
			$query = $this->Guru_model->Data_Kepegawaian($data['nim'],$id);
			$berkas = '';
			foreach($query->result() as $a)
			{
				$berkas = $a->berkas;
			}
			$query=$this->Guru_model->Hapus_Berkas_Kepegawaian($data["nim"],$id);
			unlink('images/berkas_guru_pegawai/'.$berkas);
			redirect('guru/kepegawaian');

		}
		elseif($item == 'sertifikat')
		{
			$query = $this->Guru_model->Data_Sertifikat($data['nim'],$id);
			$berkas = '';
			foreach($query->result() as $a)
			{
				$berkas = $a->berkas;
			}
			$query=$this->Guru_model->Hapus_Berkas_Sertifikat($data["nim"],$id);
			unlink('images/berkas_guru_pegawai/'.$berkas);
			redirect('guru/sertifikat');

		}
		elseif($item == 'lain')
		{
			$query = $this->Guru_model->Data_Berkas($data['nim'],$id);
			$berkas = '';
			foreach($query->result() as $a)
			{
				$berkas = $a->berkas;
			}
			$query=$this->Guru_model->Hapus_Berkas_Lain($data["nim"],$id);
			unlink('images/berkas_guru_pegawai/'.$berkas);
			redirect('unggah/unggah/lain');

		}

		else
		{
			redirect('guru');
		}
	}

// akhir controller
}
?>
