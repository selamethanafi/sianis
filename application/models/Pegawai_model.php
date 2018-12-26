<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: guru_model.php
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
class Pegawai_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function tambah_kegiatan_skp($in)
	{
		$this->db->insert('skp_pegawai',$in);
	}
	function perbarui_kegiatan_skp($in)
	{
		$this->db->where('id_skp_pegawai',$in['id_skp_pegawai']);
		$this->db->where('kodepegawai',$in['kodepegawai']);
		$this->db->update('skp_pegawai',$in);

	}
	function daftar_kegiatan_skp($in)
	{
		$ta = $this->db->query("select * from `skp_pegawai` where `kodepegawai` = $in");
		return $ta;
	}
	function daftar_kegiatan_skp_urut($in)
	{
		$ta = $this->db->query("select * from `skp_pegawai` where `kodepegawai` = '$in' order by `kegiatan`");
		return $ta;
	}
	function data_macam_kegiatan_skp($id_skp_pegawai)
	{
		$dataskppegawai = array('','');
		$ta = $this->db->query("select * from `skp_skor_guru` where `id_skp_skor_guru` = '$id_skp_pegawai'");
		foreach($ta->result() as $a)
		{
			$dataskppegawai = array($a->kegiatan,$a->satuan);
		}
		return $dataskppegawai;
	}
	function form_tambah_skp($in)	
		{
			$kato=$this->db->insert('skp_skor_guru',$in);
			return $kato;
		}
	function form_perbarui_skp($in)	
		{
		$this->db->where('id_skp_skor_guru',$in['id_skp_skor_guru']);
		$this->db->where('kodeguru',$in['kodeguru']);
		$this->db->update('skp_skor_guru',$in);
		}

	function data_ubah_skp($kodepegawai,$id)
	{
		$ta = $this->db->query("select * from `skp_skor_guru` where `id_skp_skor_guru`='$id' and `kodeguru` = '$kodepegawai'");
		return $ta;
	}
	function daftar_referensi_kegiatan_harian($in)
	{
		$ta = $this->db->query("select * from `m_harian` where `kodepegawai` = $in");
		return $ta;
	}
	function tambah_referensi_kegiatan_harian($in)
	{
		$this->db->insert('m_harian',$in);
	}
	function perbarui_referensi_kegiatan_harian($in)
	{
		$this->db->where('id_harian',$in['id_harian']);
		$this->db->where('kodepegawai',$in['kodepegawai']);
		$this->db->update('m_harian',$in);

	}
	function tampil_harian_tahun($tahun,$kodeguru,$limit,$ofset)
	{
		$ta = $this->db->query("select * from `skp_harian` where `kodepegawai`='$kodeguru' and `tanggal` like '%$tahun%' order by `tanggal` DESC LIMIT $ofset,$limit");
		return $ta;
	}
	function tampil_semua_harian_tahun($tahun,$kodeguru)
	{
		$ta = $this->db->query("select * from `skp_harian` where `kodepegawai`='$kodeguru' and `tanggal` like '%$tahun%'");
		return $ta;
	}
	function tambah_kegiatan_harian($in)
	{
		$this->db->insert('skp_harian',$in);
	}
	function data_kegiatan_harian($id_harian)
	{
		$dataskppegawai = array();
		$ta = $this->db->query("select * from `m_harian` where `id_harian` = '$id_harian'");
		foreach($ta->result() as $a)
		{
			$dataskppegawai = array($a->id_skp_pegawai,$a->giat_harian,$a->giat_output,$a->giat_satuan);
		}
		return $dataskppegawai;
	}
	function perbarui_kegiatan_harian($in)
	{
		$this->db->where('id_skp_harian',$in['id_skp_harian']);
		$this->db->where('kodepegawai',$in['kodepegawai']);
		$this->db->update('skp_harian',$in);

	}
	function hapus_skp_harian($kodepegawai,$id_skp_harian)
	{
		$this->db->where('id_skp_harian',$id_skp_harian);
		$this->db->where('kodepegawai',$kodepegawai);
		$this->db->delete('skp_harian');

	}
	function datapejabatpenilai($id_pejabat)
	{
		$dataskppegawai = array();
		$ta = $this->db->query("select * from `pejabat_penilai` where `id_pejabat` = '$id_pejabat'");
		foreach($ta->result() as $a)
		{
			$dataskppegawai = array('nama_penilai'=>$a->nama_penilai,'nip_penilai'=>$a->nip_penilai,'pangkat_golongan_penilai'=>$a->pangkat_golongan,'jabatan_penilai'=>$a->jabatan,'unit_organisasi_penilai'=>$a->unit_organisasi,'nama_atasan'=>$a->nama_atasan,'nip_atasan'=>$a->nip_atasan,'pangkat_golongan_atasan'=>$a->pangkat_golongan_atasan,'jabatan_atasan'=>$a->jabatan_atasan,'unit_organisasi_atasan'=>$a->unit_organisasi_atasan,'lokasi'=>$a->lokasi);
		}
		return $dataskppegawai;
	}
	function daftar_referensi_kegiatan_skp($in,$tahun)
	{
		$ta = $this->db->query("select * from `skp_skor_guru` where `kodeguru` = '$in' and `tahun`='$tahun'");
		return $ta;
	}
	function daftar_ref_skp()
	{
		$ta = $this->db->query("select * from `m_skp_pengawas`");
		return $ta;
	}
	function data_kegiatan_skp_pengawas($id)
	{
		$datakegiatan = array('kegiatan' => '',
						'ak' => '',
						'satuan' => '',
			);
		$ta = $this->db->query("select * from `m_skp_pengawas` where `id_m_skp_pengawas` = '$id'");
		foreach($ta->result() as $a)
		{
			$datakegiatan = array('kegiatan' => $a->kegiatan,
						'ak' => $a->ak,
						'satuan' => $a->satuan,
				);
		}
		return $datakegiatan;
	}
	function data_macam_kegiatan_skp_pegawai($id_skp_pegawai)
	{
		$dataskppegawai = array('','');
		$ta = $this->db->query("select * from `skp_pegawai` where `id_skp_pegawai` = '$id_skp_pegawai'");
		foreach($ta->result() as $a)
		{
			$dataskppegawai = array($a->kegiatan,$a->satuan);
		}
		return $dataskppegawai;
	}

}
