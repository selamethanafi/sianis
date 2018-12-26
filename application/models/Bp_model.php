<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: bp_model.php
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
class Bp_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Cari_Siswa($kunci)
		{
			if (empty($kunci))
			{
			$tcarisiswa=$this->db->query("select * from datsis where nama='xxxxx'");
			}
			else
			{
			$tcarisiswa=$this->db->query("select * from datsis where nama like '%$kunci%'");
			}
			return $tcarisiswa;
		}
		function Cari_Siswa_Aktif($kunci)
		{
			if (empty($kunci))
			{
			$tcarisiswa=$this->db->query("select * from datsis where nama='xxxxx'");
			}
			else
			{
			$tcarisiswa=$this->db->query("select * from datsis where nama like '%$kunci%' and ket='Y'");
			}
			return $tcarisiswa;
		}

		function Detil_Siswa($nis)
		{
			$tcarisiswa=$this->db->query("select * from datsis where nis='$nis'");
			return $tcarisiswa;
		}
		function Detil_Siswa_Aktif($nis)
		{
			$tcarisiswa=$this->db->query("select * from datsis where nis='$nis' and ket='Y'");
			return $tcarisiswa;
		}

	function Tampilkan_Semua_Tahun()
		{
			$Tampilkan_Semua_Tahun=$this->db->query("SELECT * from m_tapel order by thnajaran DESC");
			return $Tampilkan_Semua_Tahun;
		}

	function Tampilkan_Semua_Siswa_Aktif($thnajaran,$semester)
		{
		$tTampilkan_Semua_Siswa_Aktif=$this->db->query("SELECT * from siswa_kelas where status='Y' and thnajaran='$thnajaran' and `semester`='$semester' order by kelas ASC,no_urut ASC");
		return $tTampilkan_Semua_Siswa_Aktif;
		}
		function Cek_Data_Absensi_Siswa($nis,$tanggalabsen)
		{
			$tCek_Data_Absensi_Siswa = $this->db->query("SELECT * from siswa_absensi where nis='$nis' and tanggal='$tanggalabsen'");
			return $tCek_Data_Absensi_Siswa;
		}
		function Simpan_Data_Absensi_Siswa($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$tanggalabsen = $param['tanggalabsen'];
			$alasan = $param['alasan'];
			$keterangan = $param['keterangan'];
			$kode_guru = $param['kode_guru'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `siswa_absensi` (`nis`, `tanggal`, `thnajaran`, `semester`, `alasan`, `keterangan`,`kodeguru`) VALUES ('$nis','$tanggalabsen','$thnajaran', '$semester', '$alasan', '$keterangan','$kode_guru')");
			}
/*
			else
			{
			$this->db->query("update `siswa_absensi` set alasan = '$alasan' where `tanggal`='$tanggalabsen' and nis = '$nis'");
			}
*/
		}
		function Tampil_Data_Absensi_Siswa($nis,$thnajaran,$semester)
		{

			$tTampil_Data_Absensi_Siswa = $this->db->query("SELECT * from siswa_absensi where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' order by tanggal DESC");
			return $tTampil_Data_Absensi_Siswa;
		}
		function Daftar_Kredit()
		{
			$tDaftar_Kredit=$this->db->query("select * from m_kredit order by nama_pelanggaran");
			return $tDaftar_Kredit;
		}
		function Cek_Kredit($nis,$kode,$tanggal)
		{
			$tCek_Kredit = $this->db->query("SELECT * from siswa_kredit where nis='$nis' and tanggal='$tanggal' and kd_pelanggaran='$kode'");
			return $tCek_Kredit;
		}
		function Cari_Point_Kredit($kode)
		{
			$tCari_Point_Kredit = $this->db->query("SELECT * from m_kredit where kode='$kode'");
			return $tCari_Point_Kredit;
		}

		function Simpan_Kredit($param)
		{
			$sk=$this->db->insert('siswa_kredit',$param);
			return $sk;

		}
		function Daftar_Pelanggaran_Siswa($thnajaran,$nis)
		{
			$tDaftar_Pelanggaran_Siswa = $this->db->query("SELECT * from siswa_kredit where nis='$nis' and thnajaran='$thnajaran' order by tanggal DESC");
			return $tDaftar_Pelanggaran_Siswa;
		}
		function Daftar_Guru()
		{
			$tDaftar_Guru = $this->db->query("SELECT * from `p_pegawai` where `guru`='Y' order by nama");
			return $tDaftar_Guru;
		}
		function Hapus_Kredit($id)
		{
			$this->db->where('id_siswa_kredit',$id);
			$this->db->delete('siswa_kredit');
		}
		function Daftar_Absensi_Siswa($thnajaran,$nis)
		{
			$tDaftar_Absensi_Siswa = $this->db->query("SELECT * from siswa_absensi where nis='$nis' and thnajaran='$thnajaran' order by tanggal DESC");
			return $tDaftar_Absensi_Siswa;
		}
		function Hapus_Absensi($id)
		{
			$tabs = $this->db->query("select * from siswa_absensi where id_siswa_absensi='$id'");
			foreach($tabs->result_array() as $dabs)
				{
				$nis = $dabs['nis'];
				$tanggalabs = $dabs['tanggal'];
				if (!empty($nis))
					{$this->db->query("delete from siswa_kredit where nis='$nis' and tanggal='$tanggalabs'");
					}
				}
			$this->db->where('id_siswa_absensi',$id);
			$this->db->delete('siswa_absensi');
		}
		function Tampil_Absen_Tanggal($tanggal)
		{
			$tTampil_Absensi_Tanggal = $this->db->query("SELECT * from siswa_absensi where tanggal='$tanggal'");
			return $tTampil_Absensi_Tanggal;
		}
		function Tampil_Semua_Absen($thnajaran,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tTampil_Semua_Absen=$this->db->query("select * from siswa_absensi where thnajaran = '$thnajaran' order by tanggal DESC LIMIT $ofset,$limit");
			return $tTampil_Semua_Absen;
		}
		function Total_Semua_Absen($thnajaran)
		{
			$tTotal_Semua_Absen=$this->db->query("select * from siswa_absensi where thnajaran = '$thnajaran'");
			return $tTotal_Semua_Absen;
		}
		function Tampil_Datsis()
		{
			$tsiswa=$this->db->query("select * from datsis where ket='Y' order by nama ");
			return $tsiswa;
		}
		function Tampil_Semua_Kredit($thnajaran,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tTampil_Semua_Kredit=$this->db->query("select * from siswa_kredit where thnajaran = '$thnajaran' order by tanggal DESC LIMIT $ofset,$limit");
			return $tTampil_Semua_Kredit;
		}
		function Total_Semua_Kredit($thnajaran)
		{
			$tTotal_Semua_Kredit=$this->db->query("select * from siswa_kredit where thnajaran = '$thnajaran'");
			return $tTotal_Semua_Kredit;
		}
		function Tampil_Kredit_Siswa($nis,$thnajaran)
		{
			$tTampil_Kredit_Siswa = $this->db->query("SELECT * from siswa_kredit where nis='$nis' and thnajaran='$thnajaran' order by tanggal DESC");
			return $tTampil_Kredit_Siswa;
		}
	function Simpan_Data_Absensi_Siswa_Kbm($in)
		{
		$nis = $in["nis"];
		$tanggal = $in["tanggalabsen"];
		$alasan = $in["alasan"];
		$mapel = $in["mapel"];
		$kelas = $in["kelas"];
		if (($alasan=='L') or ($alasan=='B') or ($alasan=='M'))
			{
			$this->db->query("update hadir set `ada`='$alasan' where nis='$nis' and tanggal='$tanggal' and mapel='$mapel' and kelas='$kelas' ");
			}
		}
		function Tampil_Siswa_Kelas($thnajaran,$semester,$kelas)
		{
			$tTampil_Siswa_Kelas=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC");
			return $tTampil_Siswa_Kelas;
		}
		function Kirim_SMS($thnajaran,$semester,$kelas,$pesan,$nis)
		{
			$id_sms_user = $this->config->item('id_sms_user');
			//ke wali kelas
			$twalikelas = $this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
			$kodeguru = '??';
			foreach($twalikelas->result() as $dwalikelas)
				{
				$kodeguru = $dwalikelas->kodeguru;
				}
			$ponselwali ='';
			if(!empty($kodeguru))
			{
				$ponselwali = cari_seluler_pegawai($kodeguru);
			}
			if(!empty($ponselwali))
				{
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselwali','$pesan','$id_sms_user')");
				}
			//orang tua
			$tortu = $this->db->query("select `nis`,`tayah`,`tibu`,`twali`,`hp` from `datsis` where `nis`='$nis'");
			$tayah = '';
			$tibu = '';
			$twali = '';
			foreach($tortu->result() as $dortu)
				{
				$tayah = $dortu->tayah;
				$tibu = $dortu->tibu;
				$twali = $dortu->twali;
				$ponselsiswa = $dortu->hp;
				}
			if(!empty($ponselsiswa))
				{
				$pesansiswa = 'Ananda '.$pesan;
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$ponselsiswa','$pesansiswa','$id_sms_user')");
				}

			$pesan = 'Assalamu alaikum, wr.wb. '.$pesan;
			$ortu = 0;
			if(!empty($tayah))
				{
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tayah','$pesan','$id_sms_user')");
				$ortu = 1;
				}
			if((!empty($tibu)) and ($ortu==0))
				{
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$tibu','$pesan','$id_sms_user')");
				$ortu = 1;
				}
			if(!empty($twali))
				{
				$this->db->query("insert into `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) values ('$twali','$pesan','$id_sms_user')");
				}
		}
		function Tambah_Referensi_Sikap_Spiritual($param)
		{
			$sk=$this->db->insert('m_sikap_spiritual',$param);
			return $sk;

		}
		function Perbarui_Referensi_Sikap_Spiritual($in)
		{
			$this->db->where('id_sikap_spiritual',$in['id_sikap_spiritual']);
			$this->db->update('m_sikap_spiritual',$in);
		}
		function Simpan_Jurnal_Sikap($param)
		{
			$sk=$this->db->insert('siswa_kredit',$param);
			return $sk;

		}
		function Cari_Jenis_Sikap($butir)
		{
			$ta = $this->db->query("select * from `m_sikap_spiritual` where `item`='$butir'");
			$butir = '';
			foreach($ta->result() as $a)
			{
				$butir = $a->golongan;
			}
			return $butir;
		}
		function Tambah_Rekap_Absensi_Siswa($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('nis',$in['nis']);
			$this->db->update('kepribadian',$in);
		}
		function Simpan_Konseling_Individu($param)
		{
			$this->db->insert('bk_individu',$param);
		}
		function Perbarui_Konseling_Individu($param)
		{
			$this->db->where('id_bk_individu',$param['id_bk_individu']);
			$this->db->update('bk_individu',$param);
		}
		function Hapus_Konseling_Individu($param)
		{
			$this->db->where('id_bk_individu',$param['id_bk_individu']);
			$this->db->where('username',$param['username']);
			$this->db->delete('bk_individu');
		}
	} //akhir fungsi
