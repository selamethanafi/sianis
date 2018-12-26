<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:27:12 WIB 
// Nama Berkas 		: Pengajaran_model.php
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
class Pengajaran_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
	function Tampil_Semua_Tahun($batas,$ofset)
		{
			$Tampil_Semua_Tahun=$this->db->query("SELECT * from m_tapel order by thnajaran DESC LIMIT $ofset,$batas");
			return $Tampil_Semua_Tahun;
		}
	function Tampilkan_Semua_Tahun()
		{
			$Tampilkan_Semua_Tahun=$this->db->query("SELECT * from m_tapel order by thnajaran DESC");
			return $Tampilkan_Semua_Tahun;
		}
	function Tampil_Edit_Tapel($id)
		{
			$Tampil_Sebuah_Tahun=$this->db->query("SELECT * from m_tapel where id='$id'");
			return $Tampil_Sebuah_Tahun;
		}
	function Total_Tahun()
		{
			$Total_Tahun=$this->db->query("SELECT * from m_tapel ");
			return $Total_Tahun;
		}
	function Simpan_Tapel($datainput)
		{
			$this->db->insert('m_tapel',$datainput);
		} 
	function Update_Tapel($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('m_tapel',$in);
		}
	function Id_Jadi_Thnajaran($id)
		{
			$ttapel = $this->db->query("SELECT * from m_tapel where id='$id'");
			return $ttapel;
		}
	function Update_Thnajaran_Aktif($id)
		{
			$this->db->query("update m_tapel set aktif='T'");
			$this->db->query("update m_tapel set aktif='Y' where id='$id'");
		}

	function Tampil_Semua_Kelas($batas,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Kelas=$this->db->query("SELECT * from m_ruang order by ruang LIMIT $ofset,$batas");
			return $Tampil_Semua_Kelas;
		}
	function Tampilkan_Semua_Kelas()
		{
			$Tampilkan_Semua_Kelas=$this->db->query("SELECT * from `m_ruang` order by `ruang`");
			return $Tampilkan_Semua_Kelas;
		}

	function Total_Kelas()
		{
			$Total_Kelas=$this->db->query("SELECT * from m_kelas");
			return $Total_Kelas;
		}
	function Total_Program()
		{
			$Total_Program=$this->db->query("SELECT * from m_program");
			return $Total_Program;
		}
	function Simpan_Kelas($datainput)
		{
			$this->db->insert('m_ruang',$datainput);
		}
	function Tampil_Edit_Kelas($id)
		{
			$Tampil_Edit_Kelas=$this->db->query("SELECT * from m_ruang where m_ruang.id_ruang='$id'");
			return $Tampil_Edit_Kelas;
		}
	function Update_Kelas($in)
		{
			$this->db->where('id_ruang',$in['id_ruang']);
			$this->db->update('m_ruang',$in);
		}
	function Tampil_Semua_Mapel($batas,$ofset)
		{
			$Tampil_Semua_Mapel=$this->db->query("SELECT * from tblkategoritutorial order by nama_kategori LIMIT $ofset,$batas ");
			return $Tampil_Semua_Mapel;
		}
	function Total_Mapel()
		{
			$Tampil_Semua_Mapel=$this->db->query("SELECT * from tblkategoritutorial order by nama_kategori ");
			return $Tampil_Semua_Mapel;
		}
	function Simpan_Mapel($datainput)
		{
			$this->db->insert('tblkategoritutorial',$datainput);
		}
	function Tampil_Edit_Mapel($id)
		{
			$Tampil_Edit_Mapel=$this->db->query("SELECT * from tblkategoritutorial where id_kategori_tutorial='$id'");
			return $Tampil_Edit_Mapel;
		}
	function Update_Mapel($in)
		{
			$this->db->where('id_kategori_tutorial',$in['id_kategori_tutorial']);
			$this->db->update('tblkategoritutorial',$in);
		}
	function Tampilkan_Semua_Kategori_Tutorial()
		{
			$Tampil_Semua_Mapel=$this->db->query("SELECT * from tblkategoritutorial order by nama_kategori ");
			return $Tampil_Semua_Mapel;
		}
	function Tampilkan_Mapel_Per_Tingkat()
		{
			$Tampil_Semua_Mapel=$this->db->query("SELECT * from m_mapel left outer join m_program on m_program.id=m_mapel.id_program left outer join m_kelas on m_kelas.id=m_mapel.id_tingkat left outer join tblkategoritutorial on tblkategoritutorial.id_kategori_tutorial=m_mapel.id_mapel ");
			return $Tampil_Semua_Mapel;
		}
//left outer join m_tapel on m_tapel.id=m_mapel.id_tapel  
//	function Tampilkan_Mapel_Per_Tingkat_Per_Tahun($id_tingkat,$id_tapel)
//		{
//			$Tampil_Semua_Mapel=$this->db->query("SELECT * from m_mapel left outer join m_tapel on m_tapel.id=m_mapel.id_tapel where m_mapel.id_tapel='$id_tapel' and m_mapel.id_tingkat='$id_tingkat' ");
//			return $Tampil_Semua_Mapel;
//		}

	function Cek_Mapel_Per_Tapel_Per_Tingkat($id_tapel,$id_tingkat,$id_mapel)
		{
			$ada = $this->db->query("select * from m_mapel where id_tapel='$id_tapel' and id_tingkat='$id_tingkat' and id_mapel='$id_mapel'");
			return $ada;
		} 
	function Tambah_Mapel_Per_Tapel_Per_Tingkat($id_tapel,$id_tingkat,$id_mapel)
		{
			$this->db->query("INSERT INTO `m_mapel` (`id_tapel`, `id_tingkat`, `id_mapel`) VALUES ('$id_tapel','$id_tingkat','$id_mapel')");
		} 
	function Id_Tapel_Ke_Thnajaran($id_tapel)
		{
			$Id_Tapel_Ke_Thnajaran = $this->db->query("select * from m_tapel where id='$id_tapel'");
			return $Id_Tapel_Ke_Thnajaran;
		}
	function Cari_Tingkat($id_tingkat)
		{
			$ada = $this->db->query("select * from m_kelas where id='$id_tingkat'");
			return $ada;
		} 
	function Cari_Program($id_tingkat)
		{
			$ada = $this->db->query("select * from m_program where id='$id_tingkat'");
			return $ada;
		} 

	function Daftar_Mapel_Per_Tingkat_Per_Program($id_tingkat,$id_program)
		{
			$ada = $this->db->query("select * from m_mapel left outer join tblkategoritutorial on tblkategoritutorial.id_kategori_tutorial=m_mapel.id_mapel where id_program='$id_program' and id_tingkat='$id_tingkat' ");
			return $ada;
		} 
	function Cari_Mapel_Per_Tingkat($tingkat)
		{
			$Tampil_Semua_Mapel=$this->db->query("SELECT * from m_mapel where m_mapel.tingkat='$tingkat' ");

			return $Tampil_Semua_Mapel;
		}
	function Simpan_Mapel_Per_Kelas($datainput)
		{
			$this->db->insert('m_mapel',$datainput);
		}
	function Cek_Mapel($thnajaran,$semester,$kelas,$mapel,$kodeguru)
		{
			$tampilmapel=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and kodeguru='$kodeguru'");
			return $tampilmapel;
		}
	function Add_Mapel($param,$ada)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$mapel = $param['mapel'];
			$program = $param['program'];
			$tingkat = $param['tingkat'];
			$kelompok = $param['kelompok'];
			$kodeguru = $param['kodeguru'];
			$kkm = $param['kkm'];
			$ranah = $param['ranah'];
			$no_urut_rapor = $param['no_urut_rapor'];	
			$jenis_deskripsi = $param['jenis_deskripsi'];
			$pilihan = $param['pilihan'];
			$jam = $param['jam'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `m_mapel` (`thnajaran`, `semester`,`tingkat`,`program`,`kelas`, `mapel`,`kodeguru`,`kkm`, `kelompok`,`no_urut_rapor`,`ranah`,`jam`, `jenis_deskripsi`, `pilihan`) VALUES ('$thnajaran', '$semester','$tingkat','$program','$kelas', '$mapel','$kodeguru','$kkm','$kelompok','$no_urut_rapor','$ranah','$jam', '$jenis_deskripsi', '$pilihan')");
			}
			else
			{
			$this->db->query("update `m_mapel` set program = '$program', tingkat = '$tingkat', kodeguru = '$kodeguru', no_urut_rapor = '$no_urut_rapor', kkm='$kkm', `kelompok`='$kelompok', ranah='$ranah', jam='$jam', `jenis_deskripsi`='$jenis_deskripsi', `pilihan`='$pilihan' where thnajaran = '$thnajaran' and semester='$semester' and  kelas = '$kelas' and mapel = '$mapel' and kodeguru='$kodeguru'");
			}
	
		}
		function Cek_Nilai($thnajaran,$semester,$mapel,$nis)
		{
			$tampilnilai=$this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and nis='$nis'");
			return $tampilnilai;
		}

		function Add_Nilai($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$nama = $param['nama'];
			$mapel = $param['mapel'];
			$nilai_uh1 = $param['nilai_uh1'];
			$nilai_uh2 = $param['nilai_uh2'];
			$nilai_uh3 = $param['nilai_uh3'];
			$nilai_uh4 = $param['nilai_uh4'];
			$nilai_ruh = $param['nilai_ruh'];
			$nilai_tu1 = $param['nilai_tu1'];
			$nilai_tu2 = $param['nilai_tu2'];
			$nilai_tu3 = $param['nilai_tu3'];
			$nilai_tu4 = $param['nilai_tu4'];
			$nilai_rtu = $param['nilai_rtu'];
			$nilai_nh = $param['nilai_nh'];
			$nilai_mid = $param['nilai_mid'];
			$nilai_uas = $param['nilai_uas'];
			$nilai_na = $param['nilai_na'];
			$nilai_nr = $param['nilai_nr'];
			$nilai_psi = $param['nilai_psi'];
			$nilai_afe = $param['nilai_afe'];
			$ket = $param['ket'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			$keterangan = $param['keterangan'];

			// edit mode

			if($ada>0) 
			{
				$this->db->query("update nilai set `nilai_uh1`='$nilai_uh1', `nilai_uh2`='$nilai_uh2', `nilai_uh3`='$nilai_uh3', `nilai_uh4`='$nilai_uh4', `nilai_ruh`='$nilai_ruh', `nilai_tu1`='$nilai_tu1', `nilai_tu2`='$nilai_tu2', `nilai_tu3`='$nilai_tu3', `nilai_tu4`='$nilai_tu4', `nilai_rtu`='$nilai_rtu', `nilai_nh`='$nilai_nh', `nilai_mid`='$nilai_mid', `nilai_uas`='$nilai_uas', `nilai_na`='$nilai_na', `nilai_nr`='$nilai_nr', `psikomotor`='$nilai_psi', `afektif`='$nilai_afe', `ket`='$ket', `keterangan`='$keterangan', `status`='$status',`no_urut`='$no_urut' where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and nis='$nis'");
			}
			else
			{
			$simpannilaisiswa=$this->db->query("INSERT INTO `nilai` (`thnajaran`, `semester`, `kelas`, `nis`, `nama`, `mapel`, `nilai_uh1`, `nilai_uh2`, `nilai_uh3`, `nilai_uh4`, `nilai_ruh`, `nilai_tu1`, `nilai_tu2`, `nilai_tu3`, `nilai_tu4`, `nilai_rtu`, `nilai_nh`, `nilai_mid`, `nilai_uas`, `nilai_na`, `nilai_nr`, `psikomotor`, `afektif`, `ket`, `keterangan`,`status`,`no_urut`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$nama', '$mapel', '$nilai_uh1', '$nilai_uh2', '$nilai_uh3', '$nilai_uh4', '$nilai_ruh', '$nilai_tu1', '$nilai_tu2', '$nilai_tu3', '$nilai_tu4', '$nilai_rtu', '$nilai_nh', '$nilai_mid', '$nilai_uas', '$nilai_na', '$nilai_nr', '$nilai_psi', '$nilai_afe', '$ket', '$keterangan','$status','$no_urut')");
			}

		}
		function Tampil_Mapel_Thnajaran_Ruang($thnajaran,$ruang)
		{
			$tTampil_Mapel_Thnajaran_Ruang=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and kelas='$ruang' order by semester DESC, no_urut_rapor ASC");
			return $tTampil_Mapel_Thnajaran_Ruang;
		}
		function Tampil_Mapel_Thnajaran_Semester($thnajaran,$semester)
		{
			$tTampil_Mapel_Thnajaran_Semester=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' order by semester DESC, no_urut_rapor ASC");
			return $tTampil_Mapel_Thnajaran_Semester;
		}

		function Tampil_Mapel_Thnajaran_Semester_Ruang($thnajaran,$semester,$ruang)
		{
			$tTampil_Mapel_Thnajaran_Semester_Ruang=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and kelas='$ruang' and semester='$semester' order by no_urut_rapor ASC");
			return $tTampil_Mapel_Thnajaran_Semester_Ruang;
		}

		function Tampil_Mapel_Thnajaran($thnajaran)
		{
			$tTampil_Mapel_Thnajaran=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='1' order by no_urut_rapor");
			return $tTampil_Mapel_Thnajaran;
		}
		function Perbarui_Nomor_Urut($thnajaran,$semester,$mapel,$no_urut_rapor,$kelas)
			{
			$this->db->query("update nilai set `kd_mapel`='$no_urut_rapor' where thnajaran='$thnajaran' and `semester`='$semester' and mapel='$mapel' and kelas='$kelas'");
			}
	function Daftar_Siswa($thnajaran,$semester,$kelas)
		{
		$tDaftar_Siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC");
		return $tDaftar_Siswa;
		}
		function Tampil_Nilai_Mapel_Belum_Kompeten($thnajaran,$semester,$nis)
		{
			$tTampil_Nilai_Mapel_Belum_Kompeten = $this->db->query("select * from nilai where (thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket='Belum kompeten' and `status`='Y') or (thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket='' and and `status`='Y')");
			return $tTampil_Nilai_Mapel_Belum_Kompeten;
		}
		function Tampil_Nilai_Akhir_Mapel_Belum_Kompeten($thnajaran,$semester,$nis)
		{
			$tTampil_Nilai_Mapel_Belum_Kompeten = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and ket_akhir='Belum kompeten' and `status`='Y'");
			return $tTampil_Nilai_Mapel_Belum_Kompeten;
		}
		function Semua_Guru()
		{
			$t=$this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by nama_tanpa_gelar");
			return $t;
		}
	function Hapus_Mapel_Kelas($id)
		{
			$this->db->where('id_mapel',$id);
			$this->db->delete('m_mapel');
		}
	function Hapus_Kelas($id)
		{
			$this->db->where('id_ruang',$id);
			$this->db->delete('m_ruang');
		}

		function Tampil_Mapel_Guru_Thnajaran_Semester($kode_guru,$thnajaran,$semester)
		{
			$tTampil_Mapel_Guru_Thnajaran_Semester=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and kodeguru='$kode_guru' and semester='$semester'");
			return $tTampil_Mapel_Guru_Thnajaran_Semester;
		}
		function Tampil_Mapel_Thnajaran_Semester_Guru($thnajaran,$semester,$kode_guru)
		{
			$tTampil_Mapel_Thnajaran_Semester_Guru=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kode_guru' order by mapel,kelas");
			return $tTampil_Mapel_Thnajaran_Semester_Guru;
		}
	function Tampil_Edit_Mapel_Kelas($id)
		{
			$Tampil_Edit_Mapel_Kelas=$this->db->query("SELECT * from m_mapel where id_mapel='$id'");
			return $Tampil_Edit_Mapel_Kelas;
		}
	function Update_Jam_Tatap_Muka($in)
		{
			$this->db->where('id_mapel',$in['id_mapel']);
			$this->db->update('m_mapel',$in);
		}
	function Cek_Piket($thnajaran,$semester,$kode_guru)
		{
			$tampilpiket=$this->db->query("select * from guru_piket where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kode_guru'");
			return $tampilpiket;
		}
	function Add_Piket($param,$ada)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$hari = $param['hari'];
			$urutan_hari = $param['urutan_hari'];
			$kode_guru = $param['kodeguru'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `guru_piket` (`thnajaran`, `semester`,`kodeguru`,`hari`,`urutan_hari`) VALUES ('$thnajaran', '$semester','$kode_guru','$hari','$urutan_hari')");
			}
			else
			{
			$this->db->query("update `guru_piket` set hari = '$hari', urutan_hari = '$urutan_hari' where thnajaran = '$thnajaran' and semester='$semester' and kodeguru='$kode_guru'");
			}
	
		}
		function Add_Nilai_Akhir($param)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$kog = $param['kog'];
			$psi = $param['psi'];
			$keterangan = $param['keterangan'];
			$nilai_afe = $param['nilai_afe'];
			$this->db->query("update nilai set `kog`='$kog', `psi`='$psi', `afektif`='$nilai_afe', `keterangan`='$keterangan' where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and nis='$nis'");

		}
		function Simpan_Nilai_Un($nis,$un,$ns,$na,$i)
		{
		$this->db->query("update `nilai_un` set `un`='$un', `ns`='$ns', `na`='$na' where `no_urut`='$i' and nis='$nis'");
		}
		function Add_Nilai_Ujian($param)
		{

			$thnajaran = $param['thnajaran'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$kog = $param['kog'];
			$psi = $param['psi'];
			$this->db->query("update nilai_ujian set `nilai`='$kog', `praktik`='$psi' where thnajaran='$thnajaran' and mapel='$mapel' and nis='$nis'");

		}

	function Simpan_Jurusan($datainput)
		{
			$this->db->insert('m_program',$datainput);
		}
	function Update_Jurusan($datainput)
		{
			$this->db->where('id',$datainput['id']);
			$this->db->update('m_program',$datainput);

		}
	function Simpan_Konversi($in)
		{
			$this->db->where('id_predikat',$in['id_predikat']);
			$this->db->update('m_predikat',$in);
		}
	function Ubah_Mapel($param)
		{
			$id_mapel = $param['id_mapel'];
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$mapel = $param['mapel'];
			$program = $param['program'];
			$tingkat = $param['tingkat'];
			$kelompok = $param['kelompok'];
			$kodeguru = $param['kodeguru'];
			$kkm = $param['kkm'];
			$ranah = $param['ranah'];
			$no_urut_rapor = $param['no_urut_rapor'];	
			$jam = $param['jam'];
			$this->db->query("update `m_mapel` set `mapel`='$mapel',`kelas`='$kelas', program = '$program', tingkat = '$tingkat', kodeguru = '$kodeguru', no_urut_rapor = '$no_urut_rapor', kkm='$kkm', `kelompok`='$kelompok', ranah='$ranah', jam='$jam' where id_mapel = '$id_mapel'");

	
		}
	function Update_Pembagian_Tugas($in)
		{
			$this->db->where('id_mapel',$in['id_mapel']);
			$this->db->update('m_mapel',$in);
		}
		function Tampil_Mapel_Rapor_Thnajaran_Ruang($thnajaran,$ruang)
		{
			$tTampil_Mapel_Rapor_Thnajaran_Ruang=$this->db->query("select * from m_mapel_rapor where thnajaran='$thnajaran' and kelas='$ruang' order by semester DESC, no_urut ASC");
			return $tTampil_Mapel_Rapor_Thnajaran_Ruang;
		}
		function Tampil_Mapel_Rapor_Thnajaran_Semester_Ruang($thnajaran,$semester,$ruang)
		{
			$tTampil_Mapel_Rapor_Thnajaran_Ruang=$this->db->query("select * from m_mapel_rapor where thnajaran='$thnajaran' and kelas='$ruang' and `semester` = '$semester' order by no_urut ASC");
			return $tTampil_Mapel_Rapor_Thnajaran_Ruang;
		}

	function Hapus_Mapel_Rapor($id)
		{
			$this->db->where('id_mapel_rapor',$id);
			$this->db->delete('m_mapel_rapor');
		}
	function Update_Mapel_Rapor($in)
		{
			$this->db->where('id_mapel_rapor',$in['id_mapel_rapor']);
			$this->db->update('m_mapel_rapor',$in);
		}
	function Tambah_Mapel_Rapor($datainput)
		{
			$this->db->insert('m_mapel_rapor',$datainput);
		}
	function Update_Logo($in)
		{
			$this->db->update('m_logo',$in);
		}
	function id_walikelas_jadi_kelas($id)
		{
			$kelas = '';
			$tRuang=$this->db->query("select * from m_walikelas where `id_walikelas` = '$id'");
			foreach($tRuang->result() as $R)
			{
				$kelas = $R->kelas;
			}
			return $kelas;
		}
	function Tampil_Walikelas($thnajaran,$semester)
	{
		$daftar_walikelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
		return $daftar_walikelas;
	}
	function Mapel_Ijazah($thnajaran)
		{
			$tampilmapel=$this->db->query("select * from `m_mapel_ijazah` where thnajaran='$thnajaran' order by `jurusan`,`no_urut`");
			return $tampilmapel;
		}
	function Tambah_Mapel_Ijazah($datainput)
		{
			$this->db->insert('m_mapel_ijazah',$datainput);
		} 
	function Update_Mapel_Ijazah($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('m_mapel_ijazah',$in);
		}
	function Hapus_Mapel_Ijazah($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('m_mapel_ijazah');
		}
	function Daftar_Siswa_Kelas_XII($thnajaran)
		{
		$tDaftar_Siswa=$this->db->query("select * from siswa_kelas where `thnajaran`='$thnajaran' and `kelas` like 'XII-%' and status='Y' and `semester`='2' order by no_urut ASC");
		return $tDaftar_Siswa;
		}
	function Cek_Bimtik_Mapel($thnajaran,$semester,$kelas,$kodeguru)
	{
		$tampilmapel=$this->db->query("select * from `bimtik_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and kodeguru='$kodeguru'");
		return $tampilmapel;
	}
	function Add_Bimtik_Mapel($param,$ada)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$kodeguru = $param['kodeguru'];
			$kkm = $param['kkm'];
			$ranah = $param['ranah'];
			$jam = $param['jam'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `bimtik_mapel` (`thnajaran`, `semester`,`kelas`, `kodeguru`,`kkm`, `ranah`,`jam`) VALUES ('$thnajaran', '$semester','$kelas', '$kodeguru','$kkm','$ranah','$jam')");
			}
			else
			{
			$this->db->query("update `bimtik_mapel` set `kodeguru` = '$kodeguru', `kkm`='$kkm', `ranah`='$ranah', `jam`='$jam' where `thnajaran` = '$thnajaran' and `semester`='$semester' and  `kelas` = '$kelas' and `kodeguru`='$kodeguru'");
			}
	
		}
	function Hapus_Bimtik_Mapel($id)
		{
			$this->db->where('id_mapel',$id);
			$this->db->delete('bimtik_mapel');
		}
		function Simpan_Nilai_UAMBN($nis,$ujian,$praktik,$mapel)
		{
			$this->db->query("update `nilai_ujian` set `nilai`='$ujian', `praktik`='$praktik' where `mapel`='$mapel' and nis='$nis'");
		}

}
