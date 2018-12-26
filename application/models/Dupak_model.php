<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: dupakTampil_Tapel($data["nim"])_model.php
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
class Dupak_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function Cari_Masa_Penilaian($username)
	{
		$ta = $this->db->query("select * from `dupak_masa` where `username` = '$username' and `aktif`= '1'");
		$id_masa_aktif = '';
		foreach($ta->result() as $a)
		{
			$id_masa_aktif = $a->id_dupak_masa;
		}
		return $id_masa_aktif;
	}
	function Tampil_Tapel($username,$masa)
	{
		$ta = $this->db->query("select * from `dupak_tapel` where `username` = '$username' and `golongan`='$masa' order by tahun DESC");
		return $ta;
	}
	function Tampil_Masa($username)
	{
		$ta = $this->db->query("select * from `dupak_masa` where `username` = '$username'");
		return $ta;
	}
	function Cek_Tapel($in)
	{
		$username = $in['username'];
		$tahun = $in['tahun'];
		$semester = $in['semester'];
		$golongan = $in['golongan'];
		$ta = $this->db->query("select * from `dupak_tapel` where `username` = '$username' and `golongan`='$golongan' and `tahun`='$tahun'");
		return $ta;
	}
	function Perbarui_Tapel($in)
	{
		$username = $in['username'];
		$tahun = $in['tahun'];
		$semester = $in['semester'];
		$golongan = $in['golongan'];
		$versi = $in['versi'];
		$ta = $this->db->query("update `dupak_tapel` set `semester`='$semester', `versi`='$versi' where `username` = '$username' and `golongan`='$golongan' and `tahun`='$tahun'");
		return $ta;
	}

	function Tambah_Tapel($param)
	{
		$sk=$this->db->insert('dupak_tapel',$param);
		return $sk;
	}
	function Hapus_Tapel($username,$id_dupak_tapel)
	{
		$ta = $this->db->query("delete from `dupak_tapel` where `username` = '$username' and `id_dupak_tahun` = '$id_dupak_tapel'");
	}
	function Simpan_Masa($username,$golongan)
	{
		if($golongan == 'II/b')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','II/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','II/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'II/b')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','II/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','II/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'II/c')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','II/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'II/d')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'III/a')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'III/b')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'III/c')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','III/d', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'III/d')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/a', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'IV/a')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/b', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'IV/b')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/c', '1')");
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
		if($golongan == 'IV/c')
		{
			$this->db->query("insert into `dupak_masa` (`username`,`golongan`, `versi`) values ('$username','IV/d', '1')");
		}
	}
	function Perbarui_Masa($in)
	{
		$this->db->where('golongan',$in['golongan']);
		$this->db->where('username',$in['username']);
		$this->db->update('dupak_masa',$in);
	}
	function Versi_Dupak($username,$golongan)
	{
		$ta = $this->db->query("select * from `dupak_masa` where `username` = '$username' and `golongan`= '$golongan'");
		$versi_dupak = '';
		foreach($ta->result() as $a)
		{
			$versi_dupak = $a->versi;
		}
		return $versi_dupak;
	}
	function dataguru($username)
	{
		$ta = $this->db->query("select * from `p_pegawai` where `kd` = '$username'");
		$dataguru = array('nama'=>'',
					'nip'=>'',
					'tempat'=>'',
					'tanggallahir'=>'',
					'jenkel'=>'',
					'tugas_pokok'=>'',
					'karpeg'=>'',
					'alamat'=>'',
				);
		foreach($ta->result() as $a)
		{
			$dataguru = array(
					'nama'=>$a->nama,
					'nip'=>$a->nip,
					'tempat'=>$a->tempat,
					'tanggallahir'=>$a->tanggallahir,
					'jenkel'=>$a->jenkel,
					'tugas_pokok'=>$a->tugas_pokok,
					'karpeg'=>$a->karpeg,
					'alamat'=>$a->alamat,
					'nuptk'=>$a->nuptk,
					'npk'=>$a->npk,
				);
		}
		return $dataguru;
	}
	function datapangkat($username,$golongan)
	{
		$golongan = preg_replace("/_/","/", $golongan);
		$ta = $this->db->query("SELECT * FROM `p_kepegawaian` where `idpegawai`='$username' and `gol` like '%$golongan%' and (`jenis_sk` = 'SK CPNS' or `jenis_sk` = 'SK PNS' or `jenis_sk` = 'SK KP')");
		$datapangkat = array('tmt' => '',
						'tahun' => '',
						'bulan' => '',
						'gol' => '',
						'pangkat'=>'',
						'jabatan' => '');
		foreach($ta->result() as $a)
		{
			$datapangkat = array('tmt' => tanggal($a->tmt),
						'tahun' => $a->tahun,
						'bulan' => $a->bulan,
						'gol' => substr($a->gol,3,10),
						'pangkat' => $a->pangkat,
						'jabatan' => $a->jabatan
					);
		}
		return $datapangkat;
	}
	function datamasa($username,$golongan)
	{
		$golongan = preg_replace("/_/","/", $golongan);
		$ta = $this->db->query("select * from `dupak_masa` where `username` = '$username' and `golongan`='$golongan'");
		$datamasa = array('awal_penilaian' => '',
						'tahun' => '',
						'bulan' => '',
						'tahun_baru' => '',
						'bulan_baru' => '',
						'akhir_penilaian' => '',
						'versi' => '',
						'tmt' => '',
						'awal' => '',
						'tanggal' => ''
				);
		foreach($ta->result() as $a)
		{
			$datamasa = array('awal_penilaian' => $a->awal_penilaian,
						'tahun' => $a->tahun,
						'bulan' => $a->bulan,
						'tahun_baru' => $a->tahun_baru,
						'bulan_baru' => $a->bulan_baru,
						'akhir_penilaian' => $a->akhir_penilaian,
						'versi' => $a->versi,
						'tmt' => $a->tmt,
						'awal' => $a->awal,
						'tanggal' => $a->tanggal
					);
		}
		return $datamasa;
	}
	function ak($id,$golongan)
	{
		$ak = 0;
		if(($golongan == 'IV/a') or ($golongan == 'IV/b') or ($golongan == 'IV/c') or ($golongan == 'IV/d'))
		{
			$ta = $this->db->query("SELECT * FROM `m_ak_lama_guru_mapel` where `id`='$id'");
			foreach($ta->result() as $a)
			{
				$ak = $a->IV;
			}
		}
		if(($golongan == 'III/c') or ($golongan == 'III/d'))
		{
			$ta = $this->db->query("SELECT * FROM `m_ak_lama_guru_mapel` where `id`='$id'");
			foreach($ta->result() as $a)
			{
				$ak = $a->IIIcd;
			}
		}
		if(($golongan == 'III/a') or ($golongan == 'III/b'))
		{
			$ta = $this->db->query("SELECT * FROM `m_ak_lama_guru_mapel` where `id`='$id'");
			foreach($ta->result() as $a)
			{
				$ak = $a->IIIab;
			}
		}
		if(($golongan == 'II/a') or ($golongan == 'II/b') or ($golongan == 'II/c') or ($golongan == 'II/d'))
		{
			$ta = $this->db->query("SELECT * FROM `m_ak_lama_guru_mapel` where `id`='$id'");
			foreach($ta->result() as $a)
			{
				$ak = $a->II;
			}
		}

		return $ak;
	}
	function buatpak($username)
	{
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','III/a')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','III/b')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','III/c')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','III/d')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','IV/a')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','IV/b')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','IV/c')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','IV/d')");
		$this->db->query("insert into `dupak_pak` (`username`,`golongan`) values ('$username','IV/e')");
	}
	function Tampil_Riwayat_Pak($username)
	{
		$ta = $this->db->query("select * from `dupak_pak` where `username` = '$username'");
		return $ta;
	}
	function Tampil_Data_Pak($username,$golongan)
	{
		$golongan = preg_replace("/_/","/", $golongan);
		$ta = $this->db->query("select * from `dupak_pak` where `username` = '$username' and `golongan`='$golongan'");
		$datapak = array('awal_penilaian'=>'',
				'akhir_penilaian'=>'',
				'pendidikan'=>'',
				'pangkat'=>'',
				'golongan'=>'',
				'tmt'=>'',
				'jabatan'=>'',
				'tahun_lama'=>'',
				'bulan_lama'=>'',
				'tahun'=>'',
				'bulan'=>'',
				'tugas'=>'',
				'ak_pendidikan'=>'',
				'ak_sttpl'=>'',
				'ak_pbm'=>'',
				'ak_pkb'=>'',
				'ak_penunjang'=>'',
				'nomor'=>'',
				'ak'=>'',
				);
		foreach($ta->result() as $a)
		{
			$datapak = array('awal_penilaian' => $a->awal_penilaian,
					'akhir_penilaian' => $a->akhir_penilaian,
					'pendidikan' => $a->pendidikan,
					'pangkat' => $a->pangkat,
					'golongan' => $a->golongan,
					'tmt' => $a->tmt,
					'jabatan' => $a->jabatan,
					'tahun_lama' => $a->tahun_lama,
					'bulan_lama' => $a->bulan_lama,
					'tahun' => $a->tahun,
					'bulan' => $a->bulan,
					'tugas' => $a->tugas,
					'ak_pendidikan' => $a->ak_pendidikan,
					'ak_sttpl' => $a->ak_sttpl,
					'ak_pbm' => $a->ak_pbm,
					'ak_pkb' => $a->ak_pkb,
					'ak_penunjang' => $a->ak_penunjang,
					'nomor'=> $a->nomor,
					'ak' => $a->ak,
					);
		}
		return $datapak;
	}
	function Perbarui_Riwayat_Pak($in)
	{
		$this->db->where('golongan',$in['golongan']);
		$this->db->where('username',$in['username']);
		$this->db->update('dupak_pak',$in);
	}
	function Tampil_Tapel_Lama($username,$masa)
	{
		$ta = $this->db->query("select * from `dupak_tapel` where `username` = '$username' and `golongan`='$masa' and `versi`='0' order by `tahun` DESC");
		return $ta;
	}
	function Tampil_Tapel_Baru($username,$masa)
	{
		$ta = $this->db->query("select * from `dupak_tapel` where `username` = '$username' and `golongan`='$masa' and `versi`='1' order by thnajaran DESC, semester DESC");
		return $ta;
	}
	function Ak_Pbm($username)
	{
		$ta = $this->db->query("select * from `dupak_dupak_lama` where `username` = '$username'");
		$versi_dupak = '';
		foreach($ta->result() as $a)
		{
			$versi_dupak = $a->ak_pbm;
		}
		return $versi_dupak;
	}
	function Pertahun($kode) // kode resmi
	{
		if($kode == '00')
		{
			$pertahun = 'Y';
		}
		elseif($kode == '01')
		{
			$pertahun = 'Y';
		}
		elseif($kode == '71')
		{
			$pertahun = 'Y';
		}
		else
		{
			$pertahun = '';
		}
		return $pertahun;
	}
	function Tampil_Skp($username,$masa)
	{
		$ta = $this->db->query("select * from `dupak_skp` where `username` = '$username' and `golongan`='$masa' order by `kode`, `tahun`");
		return $ta;
	}
	function Cari_Ak($kode)
	{
		$ak = '';
		$ta = $this->db->query("select * from `skp_tabel_skor` where `kode` = '$kode'");
		foreach($ta->result() as $a)
		{
			$ak = $a->ak;
		}
		return $ak;
	}
	function Tambah_Skp($param)
	{
		$sk=$this->db->insert('dupak_skp',$param);
		return $sk;
	}
	function Cari_Kegiatan_Berdasar_Kode($kode)
	{
		$kegiatan = '';
		$ta = $this->db->query("select * from `skp_tabel_skor` where `kode` = '$kode'");
		foreach($ta->result() as $a)
		{
			$kegiatan = $a->kegiatan;
		}
		if($kode == 'B01')
		{
			$kegiatan = 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN (PKB)';
		}
		if($kode == 'B02')
		{
			$kegiatan = 'UNSUR PENUNJANG';
		}

		if($kode == '01')
		{
			$kegiatan = 'Doktor (S-3)';
		}
		if($kode == '02')
		{
			$kegiatan = 'Magister (S-2)';
		}
		if($kode == '03')
		{
			$kegiatan = 'Sarjana (S-1)';
		}
		if($kode == '04')
		{
			$kegiatan = 'Pelatihan prajabatan fungsional bagi guru calon pegawai negeri sipil/program induksi.';
		}
		if($kode == '05')
		{
			$kegiatan = 'Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, melaksanakan tindak lanjut hasil penilaian';

		}
		if($kode == '07')  
		{
			$kegiatan = 'Menjadi Kepala Sekolah/Madrasah';
		}

		if($kode == '08')  
		{
			$kegiatan = 'Menjadi Wakil Kepala Sekolah/Madrasah';
		}
		if($kode == '09') 
		{
			$kegiatan = 'Menjadi ketua program keahlian/program studi atau yang sejenisnya';
		}
		if($kode == '10') 
		{
			$kegiatan = 'Menjadi kepala perpustakaan';
		}
		if($kode == '11') 
		{
			$kegiatan = 'Menjadi kepala laboratorium, bengkel, unit produksi atau yang sejenisnya';
		}
		if($kode == '18a')
		{
			$kegiatan = 'Pengembangan Keprofesian Berkelanjutan';

		}
		if($kode == '63a')
		{
			$kegiatan = 'Penunjang Tugas Guru';

		}
		return $kegiatan;
	}
	function Hapus_Skp($username,$id_dupak_skp)
	{
		$ta = $this->db->query("delete from `dupak_skp` where `username` = '$username' and `id_dupak_skp` = '$id_dupak_skp'");
	}
	function Tipe_Pd($kode)
	{
		$tipe = '';
		if(($kode > 18) and ($kode < 29))
		{
			$tipe = 'pd';
		}
		if(($kode > 28) and ($kode < 52))
		{
			$tipe = 'pi';
		}
		if(($kode > 51) and ($kode < 64))
		{
			$tipe = 'ki';
		}
		if(($kode > 63) and ($kode < 80))
		{
			$tipe = 'pj';
		}
		if(($kode == '05') or ($kode == '11'))
		{
			$tipe = 'pbm';
		}
		return $tipe;
	}
	function Tampil_Pd($username,$masa)
	{
		$ta = $this->db->query("select * from `dupak_pd` where `username` = '$username' and `golongan`='$masa'");
		return $ta;
	}
	function Ubah_Pd($in)
	{
		$this->db->where('id_dupak_pd',$in['id_dupak_pd']);
		$this->db->update('dupak_pd',$in);
	}
	function Hapus_Pd($username,$id_dupak_skp)
	{
		$ta = $this->db->query("delete from `dupak_pd` where `username` = '$username' and `id_dupak_pd` = '$id_dupak_skp'");
	}
	function Cari_Satuan($kode)
	{
		$ak = '';
		$ta = $this->db->query("select * from `skp_tabel_skor` where `kode` = '$kode'");
		foreach($ta->result() as $a)
		{
			$ak = $a->satuan;
		}
		return $ak;
	}
	function Tampil_Pj($username,$masa)
	{
		$ta = $this->db->query("select * from `dupak_pj` where `username` = '$username' and `golongan`='$masa'");
		return $ta;
	}
	function Ubah_Pj($in)
	{
		$this->db->where('id_dupak_pj',$in['id_dupak_pj']);
		$this->db->update('dupak_pj',$in);
	}
	function datapangkatterakhir($username)
	{
		$ta = $this->db->query("SELECT * FROM `p_kepegawaian` where `idpegawai`='$username' and (`jenis_sk` = 'SK CPNS' or `jenis_sk` = 'SK PNS' or `jenis_sk` = 'SK KP') order by `tmt` DESC limit 0,1");
		$datapangkatterakhir = array('tmt' => '',
						'tahun' => '',
						'bulan' => '',
						'gol' => '',
						'pangkat'=>'',
						'jabatan' => '');
		foreach($ta->result() as $a)
		{
			$datapangkatterakhir = array('tmt' => tanggal($a->tmt),
						'tahun' => $a->tahun,
						'bulan' => $a->bulan,
						'gol' => substr($a->gol,3,10),
						'pangkat' => $a->pangkat,
						'jabatan' => $a->jabatan
					);
		}
		return $datapangkatterakhir;
	}
	function nip_jadi_username($nip)
	{
		$username = '';
		$ta = $this->db->query("SELECT * FROM `p_pegawai` where `nip`='$nip'");
		foreach($ta->result() as $a)
		{
			$username = $a->kd;
		}
		return $username;
	}
	function Cari_Ak_Dupak($username,$golongan,$kode)
	{
		$data_ak = array('lama' => '',
						'ak_item' => '',
						'jumlah' => '',
			);
		$ta = $this->db->query("select * from `dupak_dupak` where `username` = '$username' and `golongan`='$golongan' and `kode`='$kode'");
		foreach($ta->result() as $a)
		{
			$data_ak = array('lama' => $a->lama,
						'ak_item' => $a->ak_item,
						'jumlah' => $a->jumlah,
				);
		}
		return $data_ak;
	}
	function Tampil_Skp_Pkg($nip,$golongan)
	{
		$ta = $this->db->query("select * from `skp_skor_guru` where (`nip` = '$nip' and `golongan`='$golongan' and `kode`='00') or (`nip` = '$nip' and `golongan`='$golongan' and `kode`='01') or (`nip` = '$nip' and `golongan`='$golongan' and `kode`='T02')");
		return $ta;
	}
	function Hapus_Pj($username,$id_dupak_skp)
	{
		$ta = $this->db->query("delete from `dupak_pj` where `username` = '$username' and `id_dupak_pj` = '$id_dupak_skp'");
	}

}
