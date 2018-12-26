<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: panitia_model.php
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
class Panitia_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Simpan_Nama_Tes($in,$id_nama_tes)
		{
			if(empty($id_nama_tes))
			{
				$Simpan_Nama_Tes=$this->db->insert('nama_tes',$in);
			}
			else
			{
				$this->db->where('id_nama_tes',$id_nama_tes);
				$this->db->update('nama_tes',$in);

			}
			return $Simpan_Nama_Tes;
		}
		function Hapus_Tabel_Siswa_Nomor_Tes()
		{
			//$in = mysql_real_escape_string($in)
			//$this->db->query("delete siswa_nomor_tes where nis !=' '");
			$this->db->query("truncate table siswa_nomor_tes");
		}
		function Hapus_Tabel_Denah_Tempat_Duduk()
		{
			$this->db->query("truncate table `siswa_denah_tempat_duduk`");
		}
		function Hapus_Tabel_Label()
		{
			$this->db->query("truncate table `label`");
		}

		function Tambah_Nominasi($in)
		{
			$tTambah_Nominasi=$this->db->insert('siswa_nomor_tes',$in);
			return $tTambah_Nominasi;
		}
		function Tambah_Nominasi_UN($in)
		{
			$tTambah_Nominasi=$this->db->insert('siswa_nomor_tes_un',$in);
			return $tTambah_Nominasi;
		}

		function Daftar_Tes($thnajaran)
		{
			$tDaftar_Tes=$this->db->query("select * from `nama_tes` where `thnajaran`='$thnajaran' order by `id_nama_tes` DESC");
			return $tDaftar_Tes;
		}
		function Hapus_Nominasi_UN($nis)
		{
			$this->db->query("delete from `siswa_nomor_tes_un` where `nis`='$nis'");
		}
		function Cek_Baris($ruang,$baris)
		{
			$tCek_Baris=$this->db->query("select * from `siswa_denah_tempat_duduk` where `ruang`='$ruang' and `baris`='$baris'");
			return $tCek_Baris;
		}
		function Tambah_Baris($in)
		{
			$tTambah_Baris=$this->db->insert('siswa_denah_tempat_duduk',$in);
			return $tTambah_Baris;
		}
		function Update_Baris($nis,$ruang,$baris,$kolom,$kiri_kanan)
		{
		if($kiri_kanan == 1)
			{
			if ($kolom == 1)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kiri1`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			if ($kolom == 2)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kiri2`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			if ($kolom == 3)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kiri3`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}	
			if ($kolom == 4)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kiri4`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			}

		if($kiri_kanan == 2)
			{
			if ($kolom == 1)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kanan1`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			if ($kolom == 2)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kanan2`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			if ($kolom == 3)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kanan3`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			if ($kolom == 4)
				{$this->db->query("update `siswa_denah_tempat_duduk` set `kanan4`='$nis' where `ruang`='$ruang' and `baris`='$baris'");
				}
			}
		}
		function Tambah_Label($in)
		{
			$tTambah_Label=$this->db->insert('label',$in);
			return $tTambah_Label;
		}
		function Hapus_Tes($id)
		{
			$this->db->query("delete from `nama_tes` where `id_nama_tes`='$id'");
		}
		function Perbarui_No_Urut($no_urut,$id_walikelas)
		{
			$this->db->query("update `m_walikelas` set `no_urut` = '$no_urut' where `id_walikelas`='$id_walikelas'");
		}

	}
    
