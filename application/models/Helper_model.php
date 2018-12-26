<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : helper_model.php
// Lokasi      : application/models/
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

class Helper_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		function get_foto($nis)
		{
			$t=$this->db->query("select * from `datsis` where nis='$nis'");
			return $t;
		}
		function nis_ke_nama($nis)
		{
			$namasiswa ='';
			$t=$this->db->query("select * from `datsis` where nis='$nis'");
			foreach($t->result() as $tt)
				{
				$namasiswa=$tt->nama;
				}
			return $namasiswa;
		}
		function nis_ke_kelas($nis)
		{
			$kelas ='';
			$t=$this->db->query("select * from `datsis` where nis='$nis'");
			foreach($t->result() as $tt)
				{
				$kelas=$tt->kdkls;
				}
			return $kelas;
		}
		function nis_ke_status($nis)
		{
			$status ='';
			$t=$this->db->query("select * from `datsis` where nis='$nis'");
			foreach($t->result() as $tt)
				{
				$status=$tt->ket;
				}
			return $status;
		}
		function kelas_jadi_program($kelas)
		{
			$program ='';
			$kelas = $this->db->escape($kelas);
			$t=$this->db->query("select * from m_ruang where ruang= $kelas");
			foreach($t->result() as $tt)
				{
				$program=$tt->program;
				}
			return $program;	
		}
		function kelas_jadi_tingkat($kelas)
		{
			$tingkat ='';
			$kelas = $this->db->escape($kelas);
			$t=$this->db->query("select * from m_ruang where ruang= $kelas");
			foreach($t->result() as $tt)
				{
				$tingkat=$tt->tingkat;
				}
			return $tingkat;	
		}
		function cari_nama_pegawai($masukan) 
		{
			$namapegawai ='';
			$masukan = $this->db->escape($masukan);
			$t=$this->db->query("select * from p_pegawai where `kd`=$masukan");
			foreach($t->result() as $tt)
				{
				$namapegawai=$tt->nama;
				}
			return $namapegawai;		
		}
	function nomor_urut_terakhir($thnajaran,$semester,$kelas)
	{
		$no_urut='';
		$thnajaran = $this->db->escape($thnajaran);
		$semester = $this->db->escape($semester);
		$t=$this->db->query("select * from siswa_kelas where thnajaran = $thnajaran and kelas = $kelas and `semester` = $semester order by no_urut DESC limit 0,1");
		foreach($t->result() as $tt)
				{
				$no_urut =$tt->no_urut;
				}
		return $no_urut;
	}
	function id_mapel_jadi_mapel($str) 
	{
		$mapel ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$mapel=$tt->mapel;
				}
		return $mapel;
  	}
	function id_mapel_jadi_ranah($str) 
	{
		$ranah ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$mapel=$tt->ranah;
				}
		return $ranah;

	}

	function deskripsi_nilai($str) 
	{
		$kembali ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_predikat order by batas DESC");
		foreach($t->result() as $tt)
				{
				$kembali=$tt->keterangan;
				}
		return $kembali;

	}
	function tabel_predikat() 
	{
		$t=$this->db->query("select * from m_predikat order by batas DESC");
		return $t;

	}
	function id_mapel_jadi_kkm_ulangan($str,$ulangan) 
	{
		$kkm_ulangan = 75;
		$str = $this->db->escape($str);
		$tmapel = $this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($tmapel->result_array() as $dmapel)
			{
			$itemulangan = "kkm_".$ulangan;
			$kkm_ulangan = $dmapel["$itemulangan"];
			}

	return $kkm_ulangan;
  	}
	function id_mapel_jadi_kelas($str) 
	{
		$kelas ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$kelas=$tt->kelas;
				}
		return $kelas;
  	}
	function kode_ke_pelanggaran($str)
	{
		$namapelanggaran ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_kredit where kode = $str");
		foreach($t->result() as $tt)
				{
				$namapelanggaran=$tt->nama_pelanggaran;
				}
		return $namapelanggaran;
  	}
		
	function remisi($str)
	{
		$remisi = 0;
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from siswa_remisi where nis=$str");
		foreach($t->result() as $tt)
				{
				$remisi = $remisi + $tt->point;
				}
		return $remisi;
  	}
	function nisn($str)
		{
			$str = $this->db->escape($str);
			$nisn ='';
			$t=$this->db->query("select * from `datsis` where nis=$str");
			foreach($t->result() as $tt)
				{
				$nisn=$tt->nisn;
				}
			return $nisn;
		}
	function predikat_nilai($str)
		{
			$tpn = $this->db->query("select * from m_predikat order by batas DESC");
			$predikat_nilai ='D';
			$stop = 0;
			foreach($tpn->result() as $dpn)
			
			{
			if ($str>=$dpn->batas)
				{	
				if ($stop == 0)
					{
					$predikat_nilai = strtoupper($dpn->predikat);
					$stop = 1;
					}
				}
			}
		return $predikat_nilai;
		}
	function konversi_nilai($str)
		{
			$tpn = $this->db->query("select * from m_predikat order by batas DESC");
			$predikat_nilai ='D';
			$stop = 0;
			$konversi_nilai ='1';
			foreach($tpn->result() as $dpn)
			{
			if ($str>=$dpn->batas)
				{	
				if ($stop == 0)
					{
					$konversi_nilai = $dpn->konversi;
					$stop = 1;
					}
				}
			}
		return $konversi_nilai;
		}
	function cari_kepala($thnajaran,$semester)
		{
			$semester = $this->db->escape($semester);
			$thnajaran = $this->db->escape($thnajaran);
			$tmapel = $this->db->query("select * from m_kepala where thnajaran=$thnajaran and semester=$semester");
			$kodeguru='SDASDASDASDASD';
			$namakepala='';
			foreach($tmapel->result() as $dmapel)
				{
				$kodeguru = $dmapel->kodeguru;
				}
			$kodeguru = $this->db->escape($kodeguru);
			$ttd = $this->db->query("select * from p_pegawai where `kd`=$kodeguru");
			foreach($ttd->result() as $dttd)
				{
				$namakepala = $dttd->nama;
				}
		return $namakepala;
		}

	function cari_nip_kepala($thnajaran,$semester)
		{
			$semester = $this->db->escape($semester);
			$thnajaran = $this->db->escape($thnajaran);
			$tmapel = $this->db->query("select * from m_kepala where thnajaran=$thnajaran and semester=$semester");
			$kodeguru='SDASDASDASDASD';
			$nipkepala='';
			foreach($tmapel->result() as $dmapel)
				{
				$kodeguru = $dmapel->kodeguru;
				}
			$kodeguru = $this->db->escape($kodeguru);
			$ttd = $this->db->query("select * from p_pegawai where `kd`=$kodeguru");
			foreach($ttd->result() as $dttd)
				{
				$nipkepala = $dttd->nip;
				}
		return $nipkepala;
		}
	function cari_ttd_kepala($thnajaran,$semester)
		{
			$semester = $this->db->escape($semester);
			$thnajaran = $this->db->escape($thnajaran);
			$tmapel = $this->db->query("select * from m_kepala where thnajaran=$thnajaran and semester=$semester");
			$kodeguru='SDASDASDASDASD';
			$ttdkepala='';
			foreach($tmapel->result() as $dmapel)
				{
				$kodeguru = $dmapel->kodeguru;
				}
			$kodeguru = $this->db->escape($kodeguru);
			$ttd = $this->db->query("select * from p_pegawai where `kd`=$kodeguru");
			foreach($ttd->result() as $dttd)
				{
				$ttdkepala = $dttd->tandatangan;
				}
		return $ttdkepala;
		}
	function tanggalcetak($thnajaran,$semester)
		{
			$thnajaran = $this->db->escape($thnajaran);
			$ttapel = $this->db->query("select * from m_tapel where thnajaran=$thnajaran");
			foreach($ttapel->result() as $dtapel)
				{
					if ($semester==1)
					{$tanggalcetak = $dtapel->akhir1;}
					else
					{$tanggalcetak = $dtapel->akhir2;}
				}
			return $tanggalcetak;
		}

	function cari_nip_pegawai($str)
		{
			$str = $this->db->escape($str);
			$ttd = $this->db->query("select * from p_pegawai where `kd`=$str");
			$nippegawai ='';
			foreach($ttd->result() as $dttd)
				{
				$nippegawai= $dttd->nip;
				}
		return $nippegawai;
		}
	function cari_kode_dari_nip_pegawai($nip)
		{
			$nip = $this->db->escape($nip);
			$ttd = $this->db->query("select * from p_pegawai where `nip`=$nip");
			$nippegawai ='';
			foreach($ttd->result() as $dttd)
				{
				$nippegawai= $dttd->kodeguru;
				}
		return $nippegawai;
		}
	function cari_tahun_penilaian()
	{
		$tahunpenilaian = '';
	$tkd1 = $this->db->query("select * from pkg_masa where aktif='1'");
	foreach($tkd1->result() as $dkd1)
		{
		$tahunpenilaian = $dkd1->tahun;
		}
	return $tahunpenilaian;
	}
	function id_ke_kompetensi_guru($str) 
	{
		$kompetensi = '';
		$tkd = $this->db->query("select * from pkg_m_kompetensi where id_pkg_m_kompetensi='$str'");
		foreach($tkd->result() as $dkd)
			{
			$kompetensi = $dkd->kompetensi;
			}
		return $kompetensi;
	}
	function tanggalsiswaditerima($thnajaran) 
	{
		$tanggalsiswaditerima = '1970-01-01';
		$ttapel = $this->db->query("select * from m_tapel where thnajaran='$thnajaran'");
		foreach($ttapel->result() as $dtapel)
			{
			$tanggalsiswaditerima = $dtapel->awal;
			}
	return $tanggalsiswaditerima;
  	}
	function jenkel_siswa($nis,$pilihan)
	{
		$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
		foreach($tdatsis->result_array() as $ddatsis)
			{
			$jeniskelamin = $ddatsis['jenkel'];
			}
		if(empty($jeniskelamin))
			{$jeniskelamin='?';}
		if ($pilihan==0)
			{
			$jeniskelamin = substr($jeniskelamin,0,1);
			}
		return $jeniskelamin;

	}
	function tempat_lahir_siswa($nis)
	{
		$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
		foreach($tdatsis->result_array() as $ddatsis)
			{
			$tempatlahir = $ddatsis['tmpt'];
			}
		return $tempatlahir;
	}
	function tanggal_lahir_siswa($nis)
	{
		$tanggallahir='';
		$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
		foreach($tdatsis->result_array() as $ddatsis)
			{
			$tanggallahir = $ddatsis['tgllhr'];
			}
		return $tanggallahir;
	}
	function fotosiswa($nis)
	{
		$tfoto = $this->db->query("select * from `datsis` where nis = '$nis'");
		foreach($tfoto->result_array() as $dfoto)
			{
			$fotosiswa = $dfoto['foto'];
			}
		return $fotosiswa;
	}
	function id_mapel_jadi_kelompok($str) 
	{
		$tmapel = $this->db->query("select * from m_mapel where id_mapel='$str'");
		$kelompok = '';
		foreach($tmapel->result_array() as $dmapel)
			{
			$kelompok = strtoupper($dmapel["kelompok"]);
			}
	return $kelompok;
  	}
	function nomor_un($nis)
	{
		$nomorun = '';
		$tdatsis = $this->db->query("select * from `siswa_nomor_tes_un` where nis = '$nis'");
		foreach($tdatsis->result_array() as $ddatsis)
			{
			$nomorun = $ddatsis['no_peserta'];
			}
		return $nomorun;
	}
	function cari_pengawas($thnajaran,$semester) 
	{
	$namapengawas ='';
	$tmapel = $this->db->query("select * from nomor_skbk_skmt where thnajaran='$thnajaran' and semester='$semester'");
	foreach($tmapel->result_array() as $dmapel)
		{
		$namapengawas = $dmapel["nama_pengawas"];
		}
	return $namapengawas;
  	}
	function cari_nip_pengawas($thnajaran,$semester) 
	{
	$nippengawas ='';
	$tmapel = $this->db->query("select * from nomor_skbk_skmt where thnajaran='$thnajaran' and semester='$semester'");
	foreach($tmapel->result_array() as $dmapel)
		{
		$nippengawas = $dmapel["nip"];
		}
	return $nippengawas;
  	}
	function id_mapel_jadi_kkm($str) 
	{
	$tmapel = $this->db->query("select * from m_mapel where id_mapel='$str'");
	foreach($tmapel->result_array() as $dmapel)
		{
		$kkm = $dmapel["kkm"];
		}
	return $kkm;
  	}
	function id_mapel_jadi_cacah_soal($str,$ulangan) 
	{
	$tmapel = $this->db->query("select * from m_mapel where id_mapel='$str'");
	foreach($tmapel->result_array() as $dmapel)
		{
		$cacah_soal = $dmapel["nsoal_$ulangan"];
		}
	return $cacah_soal;
  	}
	function id_kd_jadi_kd($str) 
	{
	$kd = '';
	$tkd = $this->db->query("select * from kompetensi_dasar where id_kd='$str'");
	foreach($tkd->result_array() as $dkd)
		{
		$kd = $dkd["kd"];
		}
	return $kd;
  	}
	function id_kd_jadi_sk($str) 
	{
	$sk='';
	$tskd = $this->db->query("select * from kompetensi_dasar where id_kd='$str'");
	foreach($tskd->result_array() as $dskd)
		{
		$sk = $dskd["sk"];
		}
	return $sk;
  	}
	function awalsemester($thnajaran,$semester)
		{
			$thnajaran = $this->db->escape($thnajaran);
			$ttapel = $this->db->query("select * from m_tapel where thnajaran=$thnajaran");
			foreach($ttapel->result() as $dtapel)
				{
					if ($semester==1)
					{$tanggalcetak = $dtapel->awal;}
					else
					{$tanggalcetak = $dtapel->akhir1;}
				}
			return $tanggalcetak;
		}
	function cari_seluler_pegawai($masukan) 
		{
			$namapegawai ='';
			$masukan = $this->db->escape($masukan);
			$t=$this->db->query("select * from p_pegawai where kd=$masukan");
			foreach($t->result() as $tt)
				{
				$namapegawai=$tt->seluler;
				}
			return $namapegawai;		
		}
	function cari_username_pegawai($masukan) 
		{
			$namapegawai ='';
			$masukan = $this->db->escape($masukan);
			$t=$this->db->query("select * from p_pegawai where `kd`=$masukan");
			foreach($t->result() as $tt)
				{
				$namapegawai=$tt->kd;
				}
			return $namapegawai;		
		}
	function id_sk_per_semester($kode,$thnajaran,$semester) 
		{
			$id_sk = '';
			$t=$this->db->query("SELECT * FROM `p_tugas_tambahan` where kodeguru ='$kode' and thnajaran='$thnajaran' and semester = '$semester'");
			foreach($t->result() as $tt)
				{
				$id_sk=$tt->id_sk;
				}
			return $id_sk;		
		}

	function id_sk_jadi_golongan($id_sk)
		{
			$golongan ='';
			$t=$this->db->query("SELECT * FROM `p_kepegawaian` where `id` ='$id_sk'");
			foreach($t->result() as $tt)
				{
				$golongan=$tt->gol;
				}
			$golongan = substr($golongan,3,10);
			return $golongan;		
		}
	function id_sk_jadi_gapok($id_sk)
		{
			$golongan ='';
			$t=$this->db->query("SELECT * FROM `p_kepegawaian` where `id` ='$id_sk'");
			foreach($t->result() as $tt)
				{
				$golongan=$tt->gapok;
				}
			return $golongan;		
		}

	function id_mapel_jadi_thnajaran($str) 
	{
		$thnajaran ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$thnajaran=$tt->thnajaran;
				}
		return $thnajaran;
  	}
	function id_mapel_jadi_semester($str) 
	{
		$semester ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$semester=$tt->semester;
				}
		return $semester;
  	}
		function nis_ke_alamat($nis)
		{
			$namasiswa ='';
			$t=$this->db->query("select * from `datsis` where nis='$nis'");
			foreach($t->result() as $tt)
				{
				$namasiswa=$tt->alamat;
				}
			return $namasiswa;
		}
	function id_mapel_jadi_kodeguru($str) 
	{
		$kodeguru ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$kodeguru=$tt->kodeguru;
				}
		return $kodeguru;
  	}
	function cari_tugas_tambahan($thnajaran,$semester,$kode) 
		{
			$namatugas = '';
			if(!empty($kode))
			{
				$t=$this->db->query("SELECT * FROM `p_tugas_tambahan` where kodeguru ='$kode' and thnajaran='$thnajaran' and semester = '$semester'");
				foreach($t->result() as $tt)
					{
					$namatugas=$tt->nama_tugas;
					}
			}
			return $namatugas;		
		}
		function nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester)
		{
			$kelas ='';
			$t=$this->db->query("select * from siswa_kelas where thnajaran = '$thnajaran' and `semester` = '$semester' and `nis`='$nis'");
			foreach($t->result() as $tt)
				{
				$kelas=$tt->kelas;
				}
			return $kelas;
		}
	function id_thnajaran_jadi_thnajaran($str) 
	{
		$thnajaran ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_tapel where id=$str");
		foreach($t->result() as $tt)
				{
				$thnajaran=$tt->thnajaran;
				}
		return $thnajaran;
  	}
	function id_ruang_jadi_ruang($str) 
	{
		$ruang ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from m_ruang where id_ruang= $str");
		foreach($t->result() as $tt)
			{
			$ruang=$tt->ruang;
			}
		return $ruang;	
  	}
	function cari_kurikulum($thnajaran,$semester,$kelas)
		{
			$kurikulum ='';
			$t=$this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester` = '$semester' and `kelas`='$kelas'");
			foreach($t->result() as $tt)
				{
				$kurikulum=$tt->kurikulum;
				}
			return $kurikulum;
		}
	function cari_kkm($thnajaran,$semester,$kelas,$mapel)
		{
			$kkm ='';
			$t=$this->db->query("select * from `m_mapel` where `thnajaran` = '$thnajaran' and `semester` = '$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
			foreach($t->result() as $tt)
				{
				$kkm=$tt->kkm;
				}
			return $kkm;
		}
	function cari_seluler_siswa($nis)
	{
			$namasiswa ='';
			$t=$this->db->query("select nis,hp from `datsis` where nis='$nis'");
			foreach($t->result() as $tt)
				{
				$namasiswa=$tt->hp;
				}
			return $namasiswa;
	}
	function cari_seluler_orangtua($nis)
	{
			$hportu ='';
			$t=$this->db->query("select nis,tayah,tibu,twali from `datsis` where nis='$nis'");
			foreach($t->result() as $tt)
			{
				$hpayah=$tt->tayah;
				$hpibu=$tt->tibu;
				$hpwali=$tt->twali;
			}
			if(!empty($hpayah))
			{
				$hportu = $hpayah;
			}
			elseif(!empty($hpibu))
			{
				$hportu = $hpibu;
			}
			elseif(!empty($hpwali))
			{
				$hportu = $hpwali;
			}
			else
			{
				$hportu = '';
			}

			return $hportu;
	}
	function cari_walikelas($thnajaran,$semester,$kelas)
		{
			$kurikulum ='?';
			$t=$this->db->query("select * from `m_walikelas` where `thnajaran` = '$thnajaran' and `semester` = '$semester' and `kelas`='$kelas'");
			foreach($t->result() as $tt)
				{
				$kurikulum=$tt->kodeguru;
				}
			return $kurikulum;
		}
	function tmtsk($id_sk)
		{
			$tmtsk ='';
			$t=$this->db->query("SELECT * FROM `p_kepegawaian` where `id` ='$id_sk'");
			foreach($t->result() as $tt)
				{
				$tmtsk=$tt->tmt;
				}
			return $tmtsk;		
		}
	function data_siswa($nis)
	{
		$datasiswa = array();
		$tdatsis = $this->db->query("select * from datsis where nis = '$nis'");
		foreach($tdatsis->result() as $q)
		{
			$datasiswa = array(
				'nama_siswa'=>$q->nama,
				'tmpt'=>$q->tmpt,
				'tgllhr'=>$q->tgllhr,
				'nmortu'=>$q->nmortu,
				'nisn'=>$q->nisn,
				'foto'=>$q->foto,
				'ket'=>$q->ket,
				'tamatbelajar'=>$q->tamatbelajar,
				'thnajaran'=>$q->thnajaran,
				'semester'=>$q->semester,
				'kls'=>$q->kls,
				'tglditerima'=>$q->tglditerima,
/*
				''=>$q->,
*/
				);
		}
		return $datasiswa;
	}
	function nis_kelas_jadi_thnajaran_semester($nis,$kelas)
		{
			$datakelas = array('thnajaran'=>'????', 'semester'=>'????',
				);
			$t=$this->db->query("select * from siswa_kelas where `kelas` = '$kelas' and `nis`='$nis'");
			foreach($t->result() as $tt)
				{
					$datakelas = array('thnajaran'=>$tt->thnajaran, 'semester'=>$tt->semester,
				);

				}
			return $datakelas;
		}
	function cari_chat_id_pegawai($masukan) 
		{
			$namapegawai ='';
			$masukan = $this->db->escape($masukan);
			$t=$this->db->query("select * from p_pegawai where `kd`=$masukan");
			foreach($t->result() as $tt)
				{
				$namapegawai=$tt->chat_id;
				}
			return $namapegawai;		
		}
	function username_jadi_nip($masukan) 
		{
			$namapegawai ='';
			$masukan = $this->db->escape($masukan);
			$t=$this->db->query("select * from p_pegawai where kd=$masukan");
			foreach($t->result() as $tt)
				{
				$namapegawai=$tt->nip;
				}
			return $namapegawai;		
		}
	function cari_kepala_baru($thnajaran,$semester)
		{
			$semester = $this->db->escape($semester);
			$thnajaran = $this->db->escape($thnajaran);
			$tmapel = $this->db->query("select * from m_kepala where thnajaran=$thnajaran and semester=$semester");
			$namakepala='?';
			foreach($tmapel->result() as $dmapel)
			{
				$namakepala = $dmapel->nama;
			}
		return $namakepala;
		}

	function cari_nip_kepala_baru($thnajaran,$semester)
		{
			$semester = $this->db->escape($semester);
			$thnajaran = $this->db->escape($thnajaran);
			$tmapel = $this->db->query("select * from m_kepala where thnajaran=$thnajaran and semester=$semester");
			$nipkepala='?';
			foreach($tmapel->result() as $dmapel)
			{
				$nipkepala = $dmapel->nip;
			}
		return $nipkepala;
		}

}
