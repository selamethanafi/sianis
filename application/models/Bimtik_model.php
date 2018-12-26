<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:26:33 WIB 
// Nama Berkas 		: Bimtik_model.php
// Lokasi      		: application/models/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
class Bimtik_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function Cek_Mapel($thnajaran,$semester,$kelas,$kodeguru)
		{
			$tampilmapel=$this->db->query("select * from `bimtik_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and kodeguru='$kodeguru'");
			return $tampilmapel;
		}
	function Add_Mapel($param,$ada)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$program = $param['program'];
			$tingkat = $param['tingkat'];
			$kodeguru = $param['kodeguru'];
			$kkm = $param['kkm'];
			$jam = $param['jam'];
			$ranah = $param['ranah'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `bimtik_mapel` (`thnajaran`, `semester`,`tingkat`,`program`,`kelas`,`kodeguru`,`kkm`, `ranah`,`jam`) VALUES ('$thnajaran', '$semester','$tingkat','$program','$kelas','$kodeguru','$kkm','$ranah','$jam')");
			}
			else
			{
			$this->db->query("update `bimtik_mapel` set program = '$program', tingkat = '$tingkat', kodeguru = '$kodeguru', `kkm`='$kkm', `ranah`='$ranah', jam='$jam' where thnajaran = '$thnajaran' and semester='$semester' and  kelas = '$kelas' and kodeguru='$kodeguru'");
			}
	
		}
	function Tampil_Semua_Mapel_Guru($kodeguru,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Semua_Mapel_Guru=$this->db->query("select * from `bimtik_mapel` where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Mapel_Guru;
		}
	function Total_Semua_Mapel_Guru($kodeguru)
		{
		$tTotal_Semua_Mapel_Guru=$this->db->query("select * from `bimtik_mapel` where kodeguru='$kodeguru'");
			return $tTotal_Semua_Mapel_Guru;
		}	

	function Id_Mapel($id,$kodeguru)
		{
			$tmapel=$this->db->query("select * from `bimtik_mapel` where id_mapel='$id' and kodeguru='$kodeguru'");
			return $tmapel;
		}
	function Update_KKM($in)
		{
			$this->db->where('id_mapel',$in['id_mapel']);
			$this->db->update('bimtik_mapel',$in);
		}
	function Tampil_Semua_Nilai($kelas,$semester,$thnajaran)
		{
		$tTampil_Semua_Nilai=$this->db->query("select * from `bimtik_nilai` where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai;
		}
	function id_mapel_jadi_kelas($str) 
	{
		$kelas ='';
		$str = $this->db->escape($str);
		$t=$this->db->query("select * from bimtik_mapel where id_mapel=$str");
		foreach($t->result() as $tt)
				{
				$kelas=$tt->kelas;
				}
		return $kelas;
  	}
	function Tampilkan_Mapel_Guru($thnajaran,$semester,$kodeguru)
		{
		$tTampilkan_Mapel_Guru=$this->db->query("select * from bimtik_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel ASC, kelas ASC");
			return $tTampilkan_Mapel_Guru;
		}
	function Cek_Nilai($thnajaran,$semester,$nis)
		{
		$tampilnilai=$this->db->query("select * from `bimtik_nilai` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		return $tampilnilai;
		}
	function Add_Nilai($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `bimtik_nilai` (`thnajaran`, `semester`, `kelas`, `nis`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `nilai` set `kelas`='$kelas',`status`='$status', no_urut='$no_urut' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis'");
			}


		}
	function Tampil_Semua_Nilai_Separuh($kelas,$semester,$thnajaran,$separuh)
	{
		if($separuh == 1)
		{
			$tTampil_Semua_Nilai=$this->db->query("select * from `bimtik_nilai` where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut limit 30,20");
		}
		else
		{
			$tTampil_Semua_Nilai=$this->db->query("select * from bimtik_nilai where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut limit 0,30");
		}
			return $tTampil_Semua_Nilai;
		}
	function Hapus_Capaian_Kompetensi($id_mapel,$nomor_materi)
		{
			$this->db->query("delete from `bimtik_deskripsi_capaian_nilai` where `id_mapel` = '$id_mapel' and `nomor_materi`='$nomor_materi'");
			$this->db->query("delete from `bimtik_deskripsi_capaian_nilai` where `materi` = ''");

		}
	function Update_Nilai($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('bimtik_nilai',$in);
		}
	function Simpan_Capaian_Kompetensi($in)
		{
			$this->db->insert('bimtik_deskripsi_capaian_nilai',$in);
		
		}
	function Tampil_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Semua_Mapel_Ada_Psikomotor_Guru=$this->db->query("select * from bimtik_mapel where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Mapel_Ada_Psikomotor_Guru;
		}
	function Total_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru)
		{
		$tTotal_Semua_Mapel_Ada_Psikomotor_Guru=$this->db->query("select * from bimtik_mapel where kodeguru='$kodeguru'");
			return $tTotal_Semua_Mapel_Ada_Psikomotor_Guru;
		}
	function Update_Aspek_Psikomotor($in)
		{
			$this->db->where('id_aspek_psikomotor',$in['id_aspek_psikomotor']);
			$this->db->update('bimtik_aspek_psikomotorik',$in);		

		}
	function Tampil_Semua_Nilai_Psikomotor($kelas,$semester,$thnajaran)
		{
		$tTampil_Semua_Nilai_Psikomotor=$this->db->query("select * from bimtik_psikomotorik where thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai_Psikomotor;
		}
	function Cek_Nilai_Psikomotor($thnajaran,$semester,$nis)
		{
		$tampilnilai_Psikomotor=$this->db->query("select * from `bimtik_psikomotorik` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		return $tampilnilai_Psikomotor;
		}
	function Add_Nilai_Psikomotor($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `bimtik_psikomotorik` (`thnajaran`, `semester`, `kelas`, `nis`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `bimtik_psikomotorik` set kelas='$kelas', `status`='$status', no_urut='$no_urut' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis'");
			}


		}
	function Update_Nilai_Psikomotor($in)
		{
			$this->db->where('id_psikomotor',$in['id_psikomotor']);
			$this->db->update('bimtik_psikomotorik',$in);
		}
	function Update_Nilai_Psikomotor_Rapor($thnajaran,$semester,$nis,$nilai,$nilaiakhir)
		{
			// edit mode
			$this->db->query("update `bimtik_nilai` set `psikomotor`='$nilai', `psi`='$nilaiakhir' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis'");
		}
	function Ubah_Nilai($param)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$nilai = $param['nilai'];
			$p = 'nilai_'.$param["itemnilai"].'';
			// edit mode
			$this->db->query("update `bimtik_nilai` set `$p`='$nilai' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis'");
		}
	function Hapus_Deskripsi($id_mapel)
		{
			$this->db->query("delete from `bimtik_deskripsi_capaian_nilai` where `id_mapel` = '$id_mapel'");
		}
	function Tampil_Rpp($kodeguru,$limit,$ofset)
	{
		$tTampil_Tugas = $this->db->query("select * from `bimtik_rpp` where `kodeguru`='$kodeguru' order by `no_rpp` limit $ofset,$limit ");
		return $tTampil_Tugas;
	}
	function Tambah_Rpp($in)
	{
		$tTambah_Rpp=$this->db->insert('bimtik_rpp',$in);
		return $tTambah_Rpp;
	}
	function Update_Rpp($in)
	{
		$this->db->where('id_bimtik_rpp',$in['id_bimtik_rpp']);
		$this->db->update('bimtik_rpp',$in);
	}
	function Hapus_Rpp($id,$kodeguru)
	{
		$this->db->query("delete from `bimtik_rpp` where `id_guru_rpp_induk` = '$id' and `kodeguru`='$kodeguru'");
	}
	function Total_Rpp_Induk($kodeguru)
	{
		$t=$this->db->query("select * from `bimtik_rpp` where `kodeguru` = '$kodeguru' order by `no_rpp`");
		return $t;
	}
	function Tampil_Bph2_Guru($thnajaran,$semester,$kodeguru,$limit,$ofset)
	{
		$ofset = $ofset * 1;
		$tb=$this->db->query("select * from `bimtik_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal DESC, jamke DESC LIMIT $ofset,$limit");
		return $tb;
	}
	function Total_Bph2_Guru($thnajaran,$semester,$kodeguru)
	{
		$ta=$this->db->query("select * from `bimtik_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester'");
		return $ta;
	}
	function Cek_Rph2($thnajaran,$semester,$kelas,$tanggalrph,$kodeguru,$jamke)
	{
		$tCek_Rph2=$this->db->query("select * from `bimtik_rph` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester' and `tanggal`='$tanggalrph' and kelas='$kelas' and `jamke`='$jamke'");
		$sudahada =$tCek_Rph2->num_rows();
		return $sudahada;
	}
	function Tambah_Rph2($param)
	{
		$this->db->insert('bimtik_rph',$param);
	}
	function Update_Rph2($in)
	{
		$this->db->where('id_rph',$in['id_rph']);
		$this->db->update('bimtik_rph',$in);		
	}
	function Id_Rph2($id_rph,$kodeguru)
	{
		$tId_Rph=$this->db->query("select * from `bimtik_rph` where `kodeguru`='$kodeguru' and `id_rph`='$id_rph'");
		return $tId_Rph;
	}

	function Delete_Rph2($id,$kodeguru)
	{
		$this->db->query("delete from `bimtik_rph` where `kodeguru`='$kodeguru' and `id_rph`='$id'");
	}
	function Ubah_Rph2($param)
	{
		$thnajaran = $param['thnajaran'];
		$semester = $param['semester'];
		$kodeguru = $param['kodeguru'];
		$kelas = $param['kelas'];
		$tanggal = $param['tanggal'];
		$jamke = $param['jamke'];
		$kode_rpp = $param['kode_rpp'];
		$kode_rpp2 = $param['kode_rpp2'];
		$lab = $param['lab'];
		$alat_dan_bahan = $param['alat_dan_bahan'];
		$tanggal_bph = $param['tanggal_bph'];
		$hambatan_siswa = $param['hambatan_siswa'];
		$keterangan = $param['keterangan'];
		$solusi = $param['solusi'];
		$this->db->query("update `bimtik_rph` set `kode_rpp` = '$kode_rpp', `kode_rpp2` = '$kode_rpp2', `keterangan` = '$keterangan', `lab` = '$lab', `alat_dan_bahan` = '$alat_dan_bahan', `tanggal_bph` = '$tanggal_bph', `hambatan_siswa` = '$hambatan_siswa', `solusi` = '$solusi' where thnajaran='$thnajaran' and  semester='$semester' and kelas='$kelas' and `jamke`='$jamke' and tanggal='$tanggal' and kodeguru='$kodeguru'");
	}


}
