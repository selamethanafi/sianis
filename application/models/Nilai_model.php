<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: nilai_model.php
// Lokasi      		: application/models
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
class Nilai_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Rapor($thnajaran,$semester,$nis)
		{
			$tRapor_Per_Kelas=$this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and status='Y' order by kd_mapel ASC");
			return $tRapor_Per_Kelas;
		}
		function Data_Siswa($thnajaran,$nis)
		{
			$tData_Siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and nis='$nis'");
			return $tData_Siswa;
		}
		function Siswa_Kelas($thnajaran,$kelas,$semester)
		{
			$tSiswa_Kelas=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut");
			return $tSiswa_Kelas;
		}
		function Cari_KKM($thnajaran,$semester,$kelas,$mapel)
		{
			$tkkm=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
			return $tkkm;
		}
		function Ekstra($thnajaran,$semester,$nis)
		{
			$tEkstra=$this->db->query("select * from ekstrakurikuler where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' order by nama_ekstra ASC");
			return $tEkstra;
		}
		function Kepribadian($thnajaran,$semester,$nis)
		{
			$tKepribadian=$this->db->query("select * from kepribadian where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			return $tKepribadian;
		}
		function Tanggal_Rapor($thnajaran)
		{
			$tTanggal_Rapor=$this->db->query("select * from m_tapel where thnajaran='$thnajaran'");
			return $tTanggal_Rapor;
		}
		function Kepala($thnajaran,$semester)
		{
			$tKepala=$this->db->query("select * from m_kepala where thnajaran='$thnajaran' and semester='$semester'");
			return $tKepala;
		}
		function Walikelas($thnajaran,$semester,$kelas)
		{
			$tWalikelas=$this->db->query("select * from m_walikelas where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
			return $tWalikelas;
		}
		function Foto($nis)
		{
			$tFoto=$this->db->query("select * from datsis where nis='$nis'");
			return $tFoto;
		}
		function Daftar_Mapel($thnajaran,$semester,$kodeguru)
		{
			if (empty($kodeguru))
			{
			$tDaftar_Mapel=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
			}
			else
			{
			$tDaftar_Mapel=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' order by mapel,kelas");
			}

			return $tDaftar_Mapel;
		}
		function Kode_Guru_ke_Nama_Guru($kodeguru)
		{
			$tPegawai=$this->db->query("select * from p_pegawai where kd='$kodeguru'");
			return $tPegawai;
		}
		function Nilai_Siswa($thnajaran,$semester,$nis,$mapel)
		{
			$tNilai_Siswa=$this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and mapel='$mapel'");
			return $tNilai_Siswa;
		}


	}
