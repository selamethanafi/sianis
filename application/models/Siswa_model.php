<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: siswa_model.php
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
class Siswa_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		function Tampil_Nilai($username,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from nilai where nis='$username' order by thnajaran DESC, semester DESC, mapel ASC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Nilai($username)
		{
			$t=$this->db->query("select * from nilai where nis='$username'");
			return $t;
		}
		function Tampil_Nilai_Akhlak($username)
		{
			$tTampil_Nilai_Akhlak=$this->db->query("select * from kepribadian where nis='$username' order by thnajaran,semester ASC");
			return $tTampil_Nilai_Akhlak;
		}
		function Tampil_Data_Siswa($username)
		{
			$tTampil_Data_Siswa=$this->db->query("select * from datsis where nis='$username'");
			return $tTampil_Data_Siswa;
		}
	function Tampilkan_Semua_Kelas()
		{
			$Tampilkan_Semua_Kelas=$this->db->query("SELECT * from m_ruang ");
			return $Tampilkan_Semua_Kelas;
		}
	function Daftar_Jarak()
		{
			$Daftar_Jarak=$this->db->query("SELECT * from m_jarak ");
			return $Daftar_Jarak;
		}
	function Update_Data($in)
		{
			$in['updated']=1;
			$this->db->where('nis',$in['nis']);
			$this->db->update('datsis',$in);
		}
	function Tampil_Pembayaran($nis)
		{
			$tTampil_Pembayaran=$this->db->query("SELECT * from siswa_bayar where nis = '$nis' ");
			return $tTampil_Pembayaran;
		}
	function Tampil_Ketidakhadiran($username,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tKetidakhadiran=$this->db->query("select * from siswa_absensi where nis='$username' order by thnajaran DESC, semester DESC, tanggal DESC LIMIT $ofset,$limit");
			return $tKetidakhadiran;
		}
	function Total_Ketidakhadiran($username)
		{
			$tKetidakhadiran=$this->db->query("select * from siswa_absensi where nis='$username'");
			return $tKetidakhadiran;
		}
	function Tampil_Angka_Kredit($username,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tAngka_Kredit=$this->db->query("select * from siswa_kredit where nis='$username' order by tanggal DESC LIMIT $ofset,$limit");
			return $tAngka_Kredit;
		}
	function Total_Angka_Kredit($username)
		{
			$tTAngka_Kredit=$this->db->query("select * from siswa_kredit where nis='$username'");
			return $tTAngka_Kredit;
		}

	function Tampil_Nilai_Ekstra($username)
		{
			$tTampil_Nilai_Ekstra=$this->db->query("select * from ekstrakurikuler where nis='$username' order by thnajaran,semester DESC");
			return $tTampil_Nilai_Ekstra;
		}
	function Update_Data_Siswa_Keluar($nis,$thnajaran,$semester)
		{
		if ($semester == '1')
			{
			$this->db->query("update siswa_kelas set status='T' where nis='$nis' and thnajaran ='$thnajaran'");
			}
			else
			{
			$this->db->query("update siswa_kelas set status='T' where nis='$nis' and thnajaran ='$thnajaran' and `semester`='$semester'");
			}

		$this->db->query("update nilai set status='T' where nis='$nis' and thnajaran ='$thnajaran' and semester='$semester'");
		$this->db->query("update afektif set status='T' where nis='$nis' and thnajaran ='$thnajaran' and semester='$semester'");

		}

	function Buat_Hambatan($in)
		{
			$thambatan=$this->db->insert('siswa_hambatan',$in);
			return $thambatan;
		}
	function Tampil_Mapel_Siswa($thnajaran,$semester,$kelas)
		{
			$tTampil_Mapel_Siswa=$this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and `semester`='$semester' and kelas='$kelas' order by mapel ASC");
			return $tTampil_Mapel_Siswa;
		}
	function Cek_Hambatan($thnajaran,$mapel,$nis)
		{
			$tchambatan=$this->db->query("select * from siswa_hambatan where nis='$nis' and thnajaran='$thnajaran' and mapel='$mapel'");
			return $tchambatan;
		}

	function Simpan_Hambatan($thnajaran,$mapel,$nis,$hambatan)
		{
			$hambatan = $this->db->escape($hambatan);
			$tshambatan=$this->db->query("update siswa_hambatan set hambatan=$hambatan where nis='$nis' and thnajaran='$thnajaran' and mapel='$mapel'");
			return $tshambatan;
		}
	function Tampil_Hambatan($thnajaran,$nis)
		{
			$tchambatan=$this->db->query("select * from siswa_hambatan where nis='$nis' and thnajaran='$thnajaran' order by mapel");
			return $tchambatan;
		}
	function Tampil_Afektif($username,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from afektif where nis='$username' order by thnajaran DESC, semester ASC, mapel ASC LIMIT $ofset,$limit");
			return $t;
		}
	function Total_Afektif($username)
		{
			$t=$this->db->query("select * from afektif where nis='$username'");
			return $t;
		}
	function Tampil_Detil_Nilai_Afektif($username,$id_afektif)
		{

			$tTampil_Detil_Nilai_Afektif=$this->db->query("select * from afektif where nis='$username' and id_afektif='$id_afektif'");
			return $tTampil_Detil_Nilai_Afektif;
		}
		function Tampil_Analisis($username,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from analisis where nis='$username' order by thnajaran DESC, semester DESC, mapel ASC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Analisis($username)
		{
			$t=$this->db->query("select * from analisis where nis='$username'");
			return $t;
		}
	function Simpan_Jawaban($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('mapel',$in['mapel']);
			$this->db->where('nis',$in['nis']);
			$this->db->where('ulangan',$in['ulangan']);

			$this->db->update('analisis',$in);

		}
	function Simpan_Penilaian_Diri($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('nis',$in['nis']);
			$this->db->where('penilai',$in['nis']);
			$this->db->update('siswa_penilaian_diri',$in);
		}
	function Simpan_Penilaian_Antarteman($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('nis',$in['nis']);
			$this->db->where('penilai',$in['penilai']);
			$this->db->update('siswa_penilaian_diri',$in);
		}
	function tampil_siswa_semua($nama)
	{
		$q = $this->db->query("select * from `datsis` where nama like '%$nama%' and `ket`='Y'");
		return $q;
	}
	function tampil_siswa_limit($nama)
	{
		$q = $this->db->query("select * from `datsis` where nama like '%$nama%' and `ket`='Y' LIMIT 20");
		return $q;
	}


	}
