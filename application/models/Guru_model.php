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
class Guru_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Tampil_Tutorial($username,$limit,$ofset)
		{
			$t=$this->db->query("select * from tbltutorial left join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where 
			author='$username' order by `tanggal` DESC LIMIT $ofset,$limit" );
			return $t;
		}
		function Total_Tutorial($username)
		{
			$t=$this->db->query("select * from tbltutorial left join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where 
			author='$username'");
			return $t;
		}
		function Kat_Tutorial()
		{
			$kat=$this->db->query("select * from tblkategoritutorial");
			return $kat;
		}
		function Simpan_Tutorial($in)
		{
			$kat=$this->db->insert('tbltutorial',$in);
			return $kat;
		}
		function Edit_Tutorial($id,$username)
		{
			$ed=$this->db->query("select * from tbltutorial left join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where 
			author='$username' and id_tutorial='$id'");
			return $ed;
		}
		function Update_Tutorial($in)
		{
			$this->db->where('id_tutorial',$in['id_tutorial']);
			$this->db->update('tbltutorial',$in);
		}
		function Delete_Tutorial($id)
		{
			$this->db->where('id_tutorial',$id);
			$this->db->delete('tbltutorial');
		}
		function Tampil_Pengumuman($username,$limit,$ofset)
		{
			$t=$this->db->query("select * from tblpengumuman where penulis='$username' order by `tanggal` DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Pengumuman($username)
		{
			$t=$this->db->query("select * from tblpengumuman where penulis='$username'");
			return $t;
		}
		function Simpan_Pengumuman($in)
		{
			$kat=$this->db->insert('tblpengumuman',$in);
			return $kat;
		}
		function Edit_Pengumuman($id,$username)
		{
			$ed=$this->db->query("select * from tblpengumuman where penulis='$username' and id_pengumuman='$id'");
			return $ed;
		}
		function Update_Pengumuman($in)
		{
			$this->db->where('id_pengumuman',$in['id_pengumuman']);
			$this->db->update('tblpengumuman',$in);
		}
		function Delete_Pengumuman($id)
		{
			$this->db->where('id_pengumuman',$id);
			$this->db->delete('tblpengumuman');
		}
		function Tampil_File($username,$limit,$ofset)
		{
			$t=$this->db->query("select * from tbldownload left join tblkategoridownload on 	
			tbldownload.id_kat=tblkategoridownload.id_kategori_download where 
			author='$username' order by `tgl_posting` DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_File($username)
		{
			$t=$this->db->query("select * from tbldownload left join tblkategoridownload on 	
			tbldownload.id_kat=tblkategoridownload.id_kategori_download where 
			author='$username'");
			return $t;
		}
		function Kat_Down()
		{
			$kat=$this->db->query("select * from tblkategoridownload");
			return $kat;
		}
		function Simpan_Upload($in)
		{
			$kat=$this->db->insert('tbldownload',$in);
			return $kat;
		}
		function Edit_Upload($id,$username)
		{
			$t=$this->db->query("select * from tbldownload left join tblkategoridownload on 	
			tbldownload.id_kat=tblkategoridownload.id_kategori_download where id_download='$id' and author='$username'");
			return $t;
		}
		function Update_Upload($in)
		{
			$this->db->where('id_download',$in['id_download']);
			$this->db->update('tbldownload',$in);
		}
		function Delete_Upload($id)
		{
			$this->db->where('id_download',$id);
			$this->db->delete('tbldownload');
		}
		function Tampil_Inbox($user,$limit,$ofset)
		{
			$t=$this->db->query("select * from tblinbox left join tbllogin on tblinbox.username=tbllogin.username where 
			tujuan='$user' order by id_inbox DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Inbox($user)
		{
			$t=$this->db->query("select * from tblinbox left join tbllogin on tblinbox.username=tbllogin.username where 
			tujuan='$user'");
			return $t;
		}
		function Detail_Inbox($user,$id)
		{
			$str = preg_replace("/eqsmdng/","=", $id);
			$mentah=base64_decode($str);
			$pecah=explode("9002",$mentah);
			$id2=$pecah[1];
			$t=$this->db->query("select * from tblinbox left join tbllogin on tblinbox.username=tbllogin.username where 
			tujuan='$user' AND id_inbox='$id2'");
			return $t;
		}
		function Update_Pesan($id_inbox)
		{
			$str = preg_replace("/eqsmdng/","=", $id_inbox);
			$mentah=base64_decode($str);
			$pecah=explode("9002",$mentah);
			$id=$pecah[1];
			$this->db->query("update tblinbox set status_pesan='Y' where id_inbox='$id'");
		}
		function Balas_Pesan($in)
		{
			$kat=$this->db->insert('tblinbox',$in);
			return $kat;
		}
		function Update_Pesan_Lama($pesan,$id)
		{
		$pesan = $this->db->escape($pesan);
		$u=$this->db->query("update tblinbox set pesan=$pesan where id_inbox='$id'");
		return $u;
		}
		function Delete_Pesan($id_in)
		{
			$str = preg_replace("/eqsmdng/","=", $id_in);
			$mentah=base64_decode($id_in);
			$pecah=explode("9002",$mentah);
			$id=$pecah[1];
			$this->db->where('id_inbox',$id);
			$this->db->delete('tblinbox');
		}
	function Tampil_Semua_Berita($username,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Berita=$this->db->query("select * from tblberita left join tblkategori 
			on tblberita.id_kategori=tblkategori.id_kategori where author='$username' order by id_berita DESC LIMIT $ofset,$limit");

			return $Tampil_Semua_Berita;
		}
	function Total_Berita()
		{
			$t=$this->db->query("select * from tblberita");
			return $t;
		}
	function Total_Semua_Berita_User($username)
		{
			$t=$this->db->query("select * from tblberita where author='$username' ");
			return $t;
		}

	function Kat_Berita()
		{
			$kat=$this->db->query("select * from tblkategori order by id_kategori DESC");
			return $kat;
		}
	function Update_Berita($in)
		{
			$this->db->where('id_berita',$in['id_berita']);
			$this->db->update('tblberita',$in);
		}
	function Simpan_Berita($in)
		{
			$kat=$this->db->insert('tblberita',$in);
			return $kat;
		}
	function Hapus_Berita($id)
		{
			$this->db->where('id_berita',$id);
			$this->db->delete('tblberita');
		}
	function Edit_Berita($id,$username)
		{
			$t=$this->db->query("select * from tblberita left join tblkategori on tblberita.id_kategori=tblkategori.id_kategori where id_berita='$id' and author='$username'");
			return $t;
		}
	function Username_Jadi_Idlink($namapengguna)
		{
			$idlink = $namapengguna;
		return $idlink;

		}
	function Idlink_Jadi_Kode_Guru($idlink)
		{
		$kodeguru = $idlink;
		return $kodeguru;

		}
	function Tampil_Semua_Mapel_Guru($kodeguru,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Semua_Mapel_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, mapel ASC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Mapel_Guru;
		}
	function Total_Semua_Mapel_Guru($kodeguru)
		{
		$tTotal_Semua_Mapel_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru'");
			return $tTotal_Semua_Mapel_Guru;
		}	
	function Tampil_Semua_Mapel_Afektif_Guru($kodeguru,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Semua_Mapel_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and `ranah` like '%A%'order by thnajaran DESC, semester DESC, mapel ASC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Mapel_Guru;
		}
	function Total_Semua_Mapel_Afektif_Guru($kodeguru)
		{
		$tTotal_Semua_Mapel_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and `ranah` like '%A%'");
			return $tTotal_Semua_Mapel_Guru;
		}	

	function Id_Mapel($id,$kodeguru)
		{
			$tmapel=$this->db->query("select * from m_mapel where id_mapel='$id' and kodeguru='$kodeguru'");
			return $tmapel;
		}
	function Tampil_Semua_Nilai($kelas,$mapel,$semester,$thnajaran)
		{
		$tTampil_Semua_Nilai=$this->db->query("select * from nilai where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai;
		}
	function Tampil_Satu_Nilai($id_nilai,$mapel)
		{
		$tTampil_Satu_Nilai=$this->db->query("select * from nilai where kd='$id_nilai' and mapel='$mapel'");
			return $tTampil_Satu_Nilai;
		}
	function Update_Nilai($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('nilai',$in);
		}
	function Daftar_Siswa($thnajaran,$semester,$kelas)
		{
		$tDaftar_Siswa=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ASC");
		return $tDaftar_Siswa;
		}
	function Cek_Nilai($thnajaran,$semester,$mapel,$nis)
		{
		$tampilnilai=$this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
		return $tampilnilai;
		}
	function Add_Nilai($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$kd_mapel = $param['kd_mapel'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `nilai` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`kd_mapel`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel', '$kd_mapel','$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `nilai` set `kelas`='$kelas',`status`='$status', no_urut='$no_urut' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
		}
	function Update_KKM($in)
		{
			$this->db->where('id_mapel',$in['id_mapel']);
			$this->db->update('m_mapel',$in);
		}
	function Tampil_Wali_Kelas($kodeguru,$limit,$ofset)
		{
		$tTampil_Wali_Kelas=$this->db->query("select * from m_walikelas where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Wali_Kelas;

		}
	function Total_Wali_Kelas($kodeguru)
		{
		$tTotal_Wali_Kelas=$this->db->query("select * from m_walikelas where kodeguru='$kodeguru'");
			return $tTotal_Wali_Kelas;
		}	
	function Id_Wali($id,$kodeguru)
		{
			$twali=$this->db->query("select * from m_walikelas where id_walikelas='$id' and kodeguru='$kodeguru'");
			return $twali;
		}
		function Tampil_Nilai_Mapel_Belum_Kompeten($thnajaran,$semester,$nis)
		{
			$tTampil_Nilai_Mapel_Belum_Kompeten = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `ket_akhir`='Belum kompeten' and `status`='Y'");
			return $tTampil_Nilai_Mapel_Belum_Kompeten;
		}
		function Tampil_Nilai_Kepribadian_Per_Kelas($thnajaran,$semester,$kelas)
		{
			$tTampil_Nilai_Kepribadian_Per_Kelas=$this->db->query("select * from kepribadian where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
			return $tTampil_Nilai_Kepribadian_Per_Kelas;
		}
	function Tampil_Data_Umum_Pegawai($username) 
		{
		$tTampil_Data_Umum_Pegawai= $this->db->query("select * from p_pegawai where `kd` ='$username'");
		return $tTampil_Data_Umum_Pegawai;
		}
	function Buat_Data_Umum_Baru($username,$nama,$guru)
		{
			if($guru == 'Guru')
			{
				$tBuat_Data_Umum_Baru = $this->db->query("INSERT INTO `p_pegawai` (`kd`,`nama`,`guru`,`kodeguru`) VALUES ('$username','$nama','Y', '$username')");
			}
			return $tBuat_Data_Umum_Baru;
		}
	function Update_Data_Umum($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('p_pegawai',$in);
		}
	function Tampil_Data_Keluarga_Pegawai($username) 
		{
		$tTampil_Data_Keluarga_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' order by urut");
		return $tTampil_Data_Keluarga_Pegawai;
		}
	function Tampil_Riwayat_Pendidikan_Pegawai($username) 
		{
		$tTampil_Riwayat_Pendidikan_Pegawai= $this->db->query("select * from p_pendidikan where idpegawai ='$username' order by tahunlulus ASC");
		return $tTampil_Riwayat_Pendidikan_Pegawai;
		}
	function Tampil_Data_Kepegawaian_Pegawai($username) 
		{
		$tTampil_Data_Kepegawaian_Pegawai= $this->db->query("select * from p_kepegawaian where idpegawai ='$username' order by tanggal DESC");
		return $tTampil_Data_Kepegawaian_Pegawai;
		}
	function Tampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk($username) 
		{
		$tTampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk= $this->db->query("select * from p_kepegawaian where idpegawai ='$username' order by jenis_sk DESC");
		return $tTampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk;
		}

	function Cek_Data_Keluarga($username,$id) 
		{
		$tCek_Data_Keluarga= $this->db->query("select * from p_keluarga where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Keluarga;
		}
	function get_NIP($username) 
		{
		$tget_NIP= $this->db->query("select * from p_pegawai where kd ='$username'");
		$nippegawai='tidak diketahui';
		foreach($tget_NIP->result() as $d)
			{
				$nippegawai = $d->nip;
			}
		
		return $nippegawai;
		}
	function get_Nama($username) 
		{
		$tget_Nama= $this->db->query("select * from p_pegawai where kd ='$username'");
		$namapegawai='';
		foreach($tget_Nama->result() as $e)
			{
				$namapegawai = $e->nama;
			}
		
		return $namapegawai;
		}
	function get_Username_from_NIP($nip) 
		{
		$tget_Nama= $this->db->query("select * from p_pegawai where `nip` ='$nip'");
		$namapegawai='';
		foreach($tget_Nama->result() as $e)
			{
				$namapegawai = $e->kd;
			}
		
		return $namapegawai;
		}

	function get_Chat_Id($username) 
		{
		$tget_Nama= $this->db->query("select * from p_pegawai where kd ='$username'");
		$namapegawai='';
		foreach($tget_Nama->result() as $e)
			{
				$namapegawai = $e->chat_id;
			}
		
		return $namapegawai;
		}

	function Update_Data_Keluarga($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_keluarga',$in);
		}
	function Simpan_Data_Keluarga($in)
		{
			$Simpan_Data_Keluarga=$this->db->insert('p_keluarga',$in);
			return $Simpan_Data_Keluarga;
		}
	function Delete_Keluarga($id,$username)
		{
			$this->db->query("delete from p_keluarga where id='$id' and idpegawai='$username'");
		}
	function Simpan_Data_Pendidikan($in)
		{
			$Simpan_Data_Pendidikan=$this->db->insert('p_pendidikan',$in);
			return $Simpan_Data_Pendidikan;
		}
	function Delete_Pendidikan($id,$username)
		{
			$this->db->query("delete from p_pendidikan where id='$id' and idpegawai='$username'");
		}
	function Cek_Data_Pendidikan($username,$id) 
		{
		$tCek_Data_Pendidikan= $this->db->query("select * from p_pendidikan where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Pendidikan;
		}
	function Update_Data_Pendidikan($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_pendidikan',$in);
		}
	function Cek_Data_Kepegawaian($username,$id) 
		{
		$tCek_Data_Kepegawaian= $this->db->query("select * from p_kepegawaian where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Kepegawaian;
		}
	function Update_Data_Kepegawaian($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_kepegawaian',$in);
		}
	function Delete_Kepegawaian($id,$username)
		{
			$this->db->query("delete from p_kepegawaian where id='$id' and idpegawai='$username'");
		}
	function Simpan_Data_Kepegawaian($in)
		{
			$Simpan_Data_Kepegawaian=$this->db->insert('p_kepegawaian',$in);
			return $Simpan_Data_Kepegawaian;
		}
	function Tampil_Riwayat_Sertifikat_Pegawai($username) 
		{
		$tTampil_Riwayat_Sertifikat_Pegawai= $this->db->query("select * from p_sertifikat where idpegawai ='$username' order by tanggalsertifikat DESC");
		return $tTampil_Riwayat_Sertifikat_Pegawai;
		}
	function Simpan_Data_Sertifikat($in)
		{
			$Simpan_Data_Sertifikat=$this->db->insert('p_sertifikat',$in);
			return $Simpan_Data_Sertifikat;
		}
	function Delete_Sertifikat($id,$username)
		{
			$this->db->query("delete from p_sertifikat where id='$id' and idpegawai='$username'");
		}
	function Cek_Data_Sertifikat($username,$id) 
		{
		$tCek_Data_Sertifikat= $this->db->query("select * from p_sertifikat where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Sertifikat;
		}
	function Update_Data_Sertifikat($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_sertifikat',$in);
		}
	function Tampilkan_Semua_Tahun()
		{
			$Tampilkan_Semua_Tahun=$this->db->query("SELECT * from m_tapel order by thnajaran DESC");
			return $Tampilkan_Semua_Tahun;
		}
	function Tampilkan_Mapel_Guru($thnajaran,$semester,$kodeguru)
		{
		$tTampilkan_Mapel_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel ASC, kelas ASC");
			return $tTampilkan_Mapel_Guru;
		}
	function Tampil_Data_Istri_Suami_Keluarga_Pegawai($username) 
		{
		$tTampil_Data_Istri_Suami_Keluarga_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and (hubungan='Suami' or hubungan='Istri')");
		return $tTampil_Data_Istri_Suami_Keluarga_Pegawai;
		}
	function Tampil_Data_Anak_Pegawai($username) 
		{
		$tTampil_Data_Anak_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and hubungan like 'Anak%'");
		return $tTampil_Data_Anak_Pegawai;
		}

	function Tampil_Data_Ortu_Pegawai($username) 
		{
		$tTampil_Data_Ortu_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and (hubungan='Ayah kandung' or hubungan='Ibu kandung')");
		return $tTampil_Data_Ortu_Pegawai;
		}
	function Tampil_Data_Mertua_Pegawai($username) 
		{
		$tTampil_Data_Mertua_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and (hubungan='Ayah mertua' or hubungan='Ibu mertua')");
		return $tTampil_Data_Mertua_Pegawai;
		}
	function Simpan_Data_Organisasi($in)
		{
			$Simpan_Data_Organisasi=$this->db->insert('p_organisasi',$in);
			return $Simpan_Data_Organisasi;
		}
	function Update_Data_Organisasi($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_organisasi',$in);
		}
	function Simpan_Data_Diklat($in)
		{
			$Simpan_Data_Diklat=$this->db->insert('p_sertifikat',$in);
			return $Simpan_Data_Diklat;
		}
	function Delete_Diklat($id,$username)
		{
			$this->db->query("delete from p_sertifikat where id='$id' and idpegawai='$username'");
		}
	function Update_Data_Diklat($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_sertifikat',$in);
		}
	function Tampil_Data_Jabatan_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Jabatan_Pegawai= $this->db->query("select * from p_jabatan where idpegawai='$usernamepegawai'");
		return $tTampil_Data_Jabatan_Pegawai;
		}
	function Tampil_Riwayat_Jabatan_Pegawai($username) 
		{
		$tTampil_Riwayat_Jabatan_Pegawai= $this->db->query("select * from p_jabatan where idpegawai ='$username' order by tgl_awal DESC");

		return $tTampil_Riwayat_Jabatan_Pegawai;
		}
	function Simpan_Data_Jabatan($in)
		{
			$Simpan_Data_Jabatan=$this->db->insert('p_jabatan',$in);
			return $Simpan_Data_Jabatan;
		}
	function Delete_Jabatan($id,$username)
		{
			$this->db->query("delete from p_jabatan where id='$id' and idpegawai='$username'");
		}
	function Cek_Data_Jabatan($username,$id) 
		{
		$tCek_Data_Jabatan= $this->db->query("select * from p_jabatan where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Jabatan;
		}
	function Update_Data_Jabatan($in)
		{
			$this->db->where('id',$in['id']);

			$this->db->update('p_jabatan',$in);
		}
	function Simpan_Data_Keluarnegeri($in)
		{
			$Simpan_Data_Keluarnegeri=$this->db->insert('p_keluar_negeri',$in);
			return $Simpan_Data_Keluarnegeri;
		}
	function Delete_Keluarnegeri($id,$username)
		{
			$this->db->query("delete from p_keluar_negeri where id='$id' and idpegawai='$username'");
		}
	function Cek_Data_Keluarnegeri($username,$id) 
		{
		$tCek_Data_Keluarnegeri= $this->db->query("select * from p_keluar_negeri where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Keluarnegeri;
		}
	function Update_Data_Keluarnegeri($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('p_keluar_negeri',$in);
		}
	function Delete_Organisasi($id,$username)
		{
			$this->db->query("delete from p_organisasi where id='$id' and idpegawai='$username'");
		}
	function Cek_Data_Organisasi($username,$id) 
		{
		$tCek_Data_Organisasi= $this->db->query("select * from p_organisasi where id='$id' and idpegawai ='$username' ");
		return $tCek_Data_Organisasi;
		}
	function Tampil_Piket($thnajaran,$limit,$ofset)
		{
			$tTampil_Piket=$this->db->query("select * from `tblpiket` where  `thnajaran`='$thnajaran' order by tanggal DESC LIMIT $ofset,$limit");
			return $tTampil_Piket;
		}
	function Total_Piket($thnajaran)
		{
			$tTotal_Piket=$this->db->query("select * from `tblpiket` where  `thnajaran`='$thnajaran' ");
			return $tTotal_Piket;
		}
	function Edit_Piket($id_piket)
		{
			$tEdit_Piket=$this->db->query("select * from `tblpiket` where  `id_piket`='$id_piket'");
			return $tEdit_Piket;
		}
		function Update_Piket($in)
		{
			$this->db->where('id_piket',$in['id_piket']);
			$this->db->update('tblpiket',$in);
		}
		function Tambah_Piket($in)
		{
			$tTambah_piket=$this->db->insert('tblpiket',$in);
			return $tTambah_piket;
		}
	function Cari_Tanggal_Piket($tanggale)
		{
			$tCEdit_Piket=$this->db->query("select * from `tblpiket` where  `tanggal`='$tanggale'");
			return $tCEdit_Piket;
		}
	function Cek_Daftar_Hadir($tanggalsekarang,$mapel,$nis)
		{
		$tCek_Daftar_Hadir=$this->db->query("select * from hadir where tanggal='$tanggalsekarang' and mapel='$mapel' and nis='$nis'");
		return $tCek_Daftar_Hadir;
		}
	function Add_Daftar_Hadir($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$tanggalsekarang = $param['tanggalsekarang'];
			$mapel = $param['mapel'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `hadir` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`tanggal`,`ada`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel', '$tanggalsekarang','?')");
			}


		}
/*
	function Cek_Jurnal($tanggalsekarang,$mapel,$kode_guru,$kelas)
		{
		$tCek_Jurnal=$this->db->query("select * from jurnal where tanggal='$tanggalsekarang' and mapel='$mapel' and kelas='$kelas' and kode_guru='$kode_guru'");
		return $tCek_Jurnal;
		}
	function Add_Jurnal($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$tanggalsekarang = $param['tanggalsekarang'];
			$mapel = $param['mapel'];
			$kode_guru = $param['kodeguru'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `jurnal` (`thnajaran`, `semester`, `kelas`, `mapel`,`kode_guru`,`tanggal`) VALUES ('$thnajaran', '$semester', '$kelas', '$mapel', '$kode_guru','$tanggalsekarang')");
			}


		}
*/
	function Hapus_Kehadiran_Siswa($tanggalkbm,$mapel,$kelas)
		{
		$this->db->query("delete from hadir where tanggal='$tanggalkbm' and mapel='$mapel' and kelas='$kelas' ");
		}
	function Hapus_Jurnal($tanggalkbm,$mapel,$kode_guru,$kelas)
		{
		$this->db->query("delete from jurnal where tanggal='$tanggalkbm' and mapel='$mapel' and kode_guru='$kode_guru' and kelas='$kelas' ");
		}
	function Tampil_Jurnal_Guru_Tanggal($kelas,$mapel,$kodeguru,$tanggalkbmx)
		{
		$tTampil_Jurnal_Guru_Tanggal = $this->db->query("select * from `guru_rph` where tanggal='$tanggalkbmx' and mapel='$mapel' and kodeguru='$kodeguru' and kelas='$kelas' ");
		return $tTampil_Jurnal_Guru_Tanggal;
		}
	function Simpan_Jurnal($param)
		{

			$kelas = $param['kelas'];
			$materi = $this->db->escape($param['materi']);
			$materi_selanjutnya = $this->db->escape($param['materi_selanjutnya']);
			$tanggalkbmx = $param['tanggal'];
			$tanggal_bph = $param['tanggal_bph'];
			$mapel = $this->db->escape($param['mapel']);
			$kodeguru = $param['kodeguru'];
			$this->db->query("update guru_rph set `tanggal_bph`='$tanggal_bph', `materi`=$materi, `materi_selanjutnya`=$materi_selanjutnya where tanggal='$tanggalkbmx' and mapel=$mapel and kodeguru='$kodeguru' and kelas='$kelas' ");
		}
	function Tampil_Semua_Mapel_Guru_Per_Tahun($kodeguru,$thnajaran)
		{
		$tTampil_Semua_Mapel_Guru_Per_Tahun=$this->db->query("select distinct kelas,mapel,thnajaran from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran'");
			return $tTampil_Semua_Mapel_Guru_Per_Tahun;
		}
	function Tampil_Semua_Mapel_Guru_Per_Tahun_Per_Semester($kodeguru,$thnajaran,$semester)
		{
		$tTampil_Semua_Mapel_Guru_Per_Tahun_Per_Semester=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by `kelas`,`mapel`");
			return $tTampil_Semua_Mapel_Guru_Per_Tahun_Per_Semester;
		}

	function Tampil_Semua_Nilai_Analisis($kelas,$mapel,$semester,$thnajaran,$ulangan)
		{
		$tTampil_Semua_Nilai_Analisis=$this->db->query("select * from analisis where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and ulangan='$ulangan' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai_Analisis;
		}
	function Cek_Nilai_Analisis($thnajaran,$semester,$mapel,$ulangan,$nis)
		{
		$tampilnilai_Analisis=$this->db->query("select * from analisis where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and ulangan='$ulangan' and nis='$nis'");
		return $tampilnilai_Analisis;
		}
	function Add_Nilai_Analisis($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$ulangan = $param['ulangan'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode
			if($ada==0) 
			{
			$this->db->query("INSERT INTO `analisis` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`ulangan`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel', '$ulangan','$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `analisis` set `status`='$status', no_urut='$no_urut' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}


		}
	function Tampil_Satu_Nilai_Analisis($id_analisis)
		{
		$tTampil_Satu_Nilai_Analisis=$this->db->query("select * from analisis where id_analisis='$id_analisis'");
			return $tTampil_Satu_Nilai_Analisis;
		}
	function Update_Data_Tambahan($param)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kodeguru = $param['kodeguru'];
			$tpg = $param['tpg'];
			$nama_tugas = $this->db->escape($param['nama_tugas']);
			$jtm = $param['jtm'];
			$this->db->query("update p_tugas_tambahan set `tpg`='$tpg', `nama_tugas`=$nama_tugas, `jtm`='$jtm' where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
		}
	function Tambah_Data_Tambahan($param)
		{
			$this->db->insert('p_tugas_tambahan',$param);
		}
	function Update_Data_Tambahan_Luar($param)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kodeguru = $param['kodeguru'];
			$nama_tugas = $param['nama_tugas'];
			$nama_sekolah = $param['nama_sekolah'];
			$jtm = $param['jtm'];
			$this->db->query("update p_tugas_tambahan_luar set nama_tugas='$nama_tugas', jtm='$jtm', nama_sekolah='$nama_sekolah' where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru'");
		}
	function Tambah_Data_Tambahan_Luar($param)
		{
			$this->db->insert('p_tugas_tambahan_luar',$param);
		}
	function Update_Analisis($in)
		{
			$this->db->where('id_analisis',$in['id_analisis']);
			$this->db->update('analisis',$in);		
		}
	function Update_Analisis_Jawaban($in)
		{
			$this->db->where('id_analisis',$in['id_analisis']);
			$this->db->update('analisis',$in);		
		}

	function Tambah_Aspek_Psikomotor($param)
		{
			$this->db->insert('aspek_psikomotorik',$param);
		}
	function Update_Aspek_Psikomotor($in)
		{
			$this->db->where('id_aspek_psikomotor',$in['id_aspek_psikomotor']);
			$this->db->update('aspek_psikomotorik',$in);		

		}
	function Nomor_Seluler($masukan)
		{
			$noseluler = '';
			$t = $this->db->query("select * from datsis where nis='$masukan'");
			foreach($t->result_array() as $d)
			{
			$noseluler = $d['hp'];
			}
		return $noseluler;
		}
	function Kirim_Pesan($in)
		{
			$kato=$this->db->insert('outbox',$in);
			return $kato;
		}
	function Nilai_Asli($thnajaran,$semester,$mapel,$nis,$itemnilai)
		{
		$tsa = $this->db->query("select * from nilai where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		$nilaiaslik = 0;
		foreach($tsa->result_array() as $da)
		{
		$iteme = 'nilai_'.$itemnilai.'';
		$nilaiaslik = $da[$iteme];
		}
		return $nilaiaslik;
		
		}
	function Ubah_Nilai($param)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$nilai = $param['nilai'];
			$p = 'nilai_'.$param["itemnilai"].'';
			// edit mode
			$this->db->query("update `nilai` set `$p`='$nilai' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		}
	function Update_Nilai_Psikomotor_Rapor($thnajaran,$semester,$mapel,$nis,$nilai,$nilaiakhir)
		{
			// edit mode
			$this->db->query("update `nilai` set `psikomotor`='$nilai', `psi`='$nilaiakhir' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		}
	function Update_Nilai_Psikomotor_Akhir_Rapor($thnajaran,$semester,$mapel,$nis,$nilai)
		{
			// edit mode
			$this->db->query("update `nilai` set `psi`='$nilai' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		}

	function Tambah_Aspek_Afektif($param)
		{
			$this->db->insert('aspek_afektif',$param);
		}
	function Update_Aspek_Afektif($in)
		{
			$this->db->where('id_aspek_afektif',$in['id_aspek_afektif']);
			$this->db->update('aspek_afektif',$in);		

		}
	function Tampil_Semua_Nilai_Afektif($kelas,$mapel,$semester,$thnajaran)
		{
		$tTampil_Semua_Nilai_Afektif=$this->db->query("select * from afektif where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai_Afektif;
		}
	function Cek_Nilai_Afektif($thnajaran,$semester,$mapel,$nis)
		{
		$tampilnilai_Afektif=$this->db->query("select * from afektif where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and nis='$nis'");
		return $tampilnilai_Afektif;
		}
	function Add_Nilai_Afektif($param,$ada,$cacahitem,$nilaibaik)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `afektif` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel','$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `afektif` set kelas='$kelas', no_urut='$no_urut', status='$status' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			$this->db->query("update `afektif` set `p1`='', `p2`='', `p3`='', `p4`='', `p5`='', `p6`='', `p7`='', `p8`='', `p9`='', `p10`='',`p11`='', `p12`='', `p13`='', `p14`='' , `p15`='' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 1)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 2)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 3)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 4)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 5)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 6)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 7)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 8)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 9)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 10)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 11)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik',`p11`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 12)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik',`p11`='$nilaibaik', `p12`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 13)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik',`p11`='$nilaibaik', `p12`='$nilaibaik', `p13`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 14)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik',`p11`='$nilaibaik', `p12`='$nilaibaik', `p13`='$nilaibaik', `p14`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem == 15)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik',`p11`='$nilaibaik', `p12`='$nilaibaik', `p13`='$nilaibaik', `p14`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
			if($cacahitem > 15)
			{
				$this->db->query("update `afektif` set `p1`='$nilaibaik', `p2`='$nilaibaik', `p3`='$nilaibaik', `p4`='$nilaibaik', `p5`='$nilaibaik', `p6`='$nilaibaik', `p7`='$nilaibaik', `p8`='$nilaibaik', `p9`='$nilaibaik', `p10`='$nilaibaik',`p11`='$nilaibaik', `p12`='$nilaibaik', `p13`='$nilaibaik', `p14`='$nilaibaik' , `p15`='$nilaibaik' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}

		}
	function Update_Nilai_Afektif($in)
		{
			$this->db->where('id_afektif',$in['id_afektif']);
			$this->db->update('afektif',$in);
		}

	function Ubah_Nilai_Afektif($param)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$nilai = $param['nilai'];
			$p = 'p'.$param["itemnilai"].'';
			// edit mode
			$this->db->query("update `afektif` set `$p`='$nilai' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		}
	function Update_Nilai_Afektif_Rapor($thnajaran,$semester,$mapel,$nis,$nilai)
		{
			// edit mode
			$this->db->query("update `nilai` set `afektif`='$nilai' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		}
	function Tampil_Mapel_Guru_Thnajaran_Semester($kodeguru,$thnajaran,$semester)
		{
		$tTampil_Mapel_Guru_Thnajaran_Semester=$this->db->query("select distinct mapel from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester'");
			return $tTampil_Mapel_Guru_Thnajaran_Semester;
		}
	function Cek_Rph($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke)
		{
		$tCek_Rph=$this->db->query("select * from guru_rph where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and tanggal='$tanggalrph' and kelas='$kelas' and `jamke`='$jamke'");
		$sudahada =$tCek_Rph->num_rows();
			return $sudahada;
		}
	function Tambah_Rph($param)
		{
			$this->db->insert('guru_rph',$param);
		}
	function Update_Rph($in)
		{
			$this->db->where('id_rph',$in['id_rph']);
			$this->db->update('guru_rph',$in);		
		}
	function Update_Rph_Awal($thnajaran,$semester,$mapel,$kelas,$tanggal,$kodeguru,$jamke)
		{
			$this->db->query("update guru_rph set jamke='$jamke' where thnajaran='$thnajaran' and  semester='$semester' and mapel='$mapel' and kelas='$kelas' and tanggal='$tanggal' and kodeguru='$kodeguru' ");
			$this->db->query("update guru_rph set tanggal_bph= '$tanggal' where thnajaran='$thnajaran' and  semester='$semester' and mapel='$mapel' and kelas='$kelas' and tanggal='$tanggal' and kodeguru='$kodeguru' and tanggal_bph='0000-00-00'");

		}
	function Id_Rph($id_rph,$kodeguru)
		{
		$tId_Rph=$this->db->query("select * from guru_rph where kodeguru='$kodeguru' and id_rph='$id_rph'");
		return $tId_Rph;
		}

	function Delete_Rph($id,$kodeguru)
		{
			$this->db->query("delete from guru_rph where kodeguru='$kodeguru' and id_rph='$id'");
		}

	function Tampil_Bph_Guru($thnajaran,$semester,$kodeguru,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tb=$this->db->query("select * from `guru_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal DESC, jamke DESC LIMIT $ofset,$limit");
			return $tb;
		}
	function Total_Bph_Guru($thnajaran,$semester,$kodeguru)
		{
			$ta=$this->db->query("select * from `guru_rph` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester'");
			return $ta;
		}
	function Tampil_Semua_Nilai_Akhlak_Guru($kodeguru,$limit,$ofset)
		{
		$tTampil_Semua_Nilai_Akhlak_Guru=$this->db->query("select * from m_akhlak where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Nilai_Akhlak_Guru;
		}
	function Total_Semua_Nilai_Akhlak_Guru($kodeguru)
		{
		$tTotal_Semua_Nilai_Akhlak_Guru=$this->db->query("select * from m_akhlak where kodeguru='$kodeguru'");
			return $tTotal_Semua_Nilai_Akhlak_Guru;
		}	
	function Id_M_Akhlak($id,$kodeguru)
		{
			$tmapel=$this->db->query("select * from m_akhlak where id_m_akhlak='$id' and kodeguru='$kodeguru'");
			return $tmapel;
		}
	function Tampil_Semua_Nilai_Akhlak($kelas,$kodeguru,$semester,$thnajaran)
		{
		$tTampil_Semua_Nilai_Akhlak=$this->db->query("select * from nilai_akhlak where kodeguru='$kodeguru' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai_Akhlak;
		}
	function Cek_Nilai_Akhlak($thnajaran,$semester,$kodeguru,$nis)
		{
		$tampilnilai=$this->db->query("select * from nilai_akhlak where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' and nis='$nis'");
		return $tampilnilai;
		}
	function Add_Nilai_Akhlak($param,$ada,$cacahitem)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$kodeguru = $param['kodeguru'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `nilai_akhlak` (`thnajaran`, `semester`, `kelas`, `nis`, `kodeguru`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$kodeguru','$no_urut','$status')");
			}
			if($cacahitem == 1)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 2)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 3)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 4)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 5)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 6)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 7)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6', `tujuh`='7' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 8)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6', `tujuh`='7', `delapan`='8' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 9)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='4', `lima`='5', `enam`='6', `tujuh`='7', `delapan`='8', `sembilan`='9' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 10)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 11)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 12)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 13)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3', `i13`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			elseif($cacahitem == 14)
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3', `i13`='3', `i14`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
			else
			{
				$this->db->query("update `nilai_akhlak` set `satu`='3', `dua`='3', `tiga`='3', `empat`='3', `lima`='3', `enam`='3', `tujuh`='3', `delapan`='3', `sembilan`='3', `sepuluh`='3', `i11`='3', `i12`='3', `i13`='3', `i14`='3', `i15`='3' where `thnajaran`= '$thnajaran' and `semester`= '$semester' and `nis`='$nis' and `kodeguru`= '$kodeguru'");
			}
		}
	function Tampil_Satu_Nilai_Akhlak_Siswa($id_nilai,$kodeguru)
		{
		$tTampil_Satu_Nilai_Akhlak_Siswa=$this->db->query("select * from nilai_akhlak where id_nilai_akhlak='$id_nilai' and kodeguru='$kodeguru'");
			return $tTampil_Satu_Nilai_Akhlak_Siswa;
		}
	function Simpan_Nilai_Akhlak($in)
		{
			$this->db->where('id_nilai_akhlak',$in['id_nilai_akhlak']);
			$this->db->update('nilai_akhlak',$in);
		}
	function Tampil_Semua_Ekstra_Guru($kodeguru,$limit,$ofset)
		{

		$tTampil_Semua_Ekstra_Guru=$this->db->query("select * from m_pengampu_ekstra where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, namaekstra ASC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Ekstra_Guru;
		}
	function Total_Semua_Ekstra_Guru($kodeguru)
		{
		$tTotal_Semua_Ekstra_Guru=$this->db->query("select * from m_pengampu_ekstra where kodeguru='$kodeguru'");
			return $tTotal_Semua_Ekstra_Guru;
		}	
	function Id_Ekstra($id,$kodeguru)
		{
			$tmapel=$this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra='$id' and kodeguru='$kodeguru'");
			return $tmapel;
		}
	function Tampil_Semua_Nilai_Ekstra($kelas,$mapel,$semester,$thnajaran)
		{
		if ($kelas == 'semua')
			{
			$tTampil_Semua_Nilai_Ekstra=$this->db->query("select * from ekstrakurikuler where nama_ekstra='$mapel' and thnajaran='$thnajaran' and semester='$semester' and status='Y' order by nis");
			}
			else
			{
			$tTampil_Semua_Nilai_Ekstra=$this->db->query("select * from ekstrakurikuler where nama_ekstra='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by nis");
			}

			return $tTampil_Semua_Nilai_Ekstra;
			
		}
	function Update_Nilai_Ekstra($in)
		{
			$this->db->where('id_siswa_ekstra',$in['id_siswa_ekstra']);
			$this->db->update('ekstrakurikuler',$in);
		}
	function Update_Nilai_Afektif_Impor($param)

		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$kelas = $param['kelas'];
			$p1 = $param["p1"];
			$p2 = $param["p2"];
			$p3 = $param["p3"];
			$p4 = $param["p4"];
			$p5 = $param["p5"];
			$p6 = $param["p6"];
			$p7 = $param["p7"];
			$p8 = $param["p8"];
			$p9 = $param["p9"];
			$p10 = $param["p10"];
			$p11 = $param["p11"];
			$p12 = $param["p12"];
			$p13 = $param["p13"];
			$p14 = $param["p14"];
			$p15 = $param["p15"];
			$this->db->query("update `afektif` set `p1`='$p1', `p2`='$p2', `p3`='$p3', `p4`='$p4', `p5`='$p5', `p6`='$p6', `p7`='$p7', `p8`='$p8', `p9`='$p9', `p10`='$p10', `p11`='$p11', `p12`='$p13', `p13`='$p13', `p14`='$p14', `p15`='$p15' where thnajaran = '$thnajaran' and semester = '$semester' and kelas='$kelas' and nis = '$nis' and mapel = '$mapel'");
		}
		function Tampilkan_Semua_Kelas()
		{
			$tTampilkan_Semua_Kelas=$this->db->query("select * from m_ruang order by ruang");
			return $tTampilkan_Semua_Kelas;
		}
	function Cek_Nilai_Ujian($thnajaran,$mapel,$nis)
		{
		$tampilnilaiujian=$this->db->query("select * from nilai_ujian where thnajaran='$thnajaran' and mapel='$mapel' and nis='$nis'");
		return $tampilnilaiujian;
		}
	function Add_Nilai_Ujian($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$kelas = $param['ruang'];
			$no_urut = $param['no_urut'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `nilai_ujian` (`thnajaran`, `ruang`, `nis`, `mapel`,`no_urut`) VALUES ('$thnajaran', '$kelas','$nis', '$mapel', '$no_urut')");
			}

		}
	function Update_Nilai_Ujian($in)
		{
			$this->db->where('id_nilai_ujian',$in['id_nilai_ujian']);
			$this->db->update('nilai_ujian',$in);
		}
	function Id_Nilai($id)
		{
			$tnilai=$this->db->query("select * from nilai where kd='$id'");
			return $tnilai;
		}
	function Update_Nilai_Akhir($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('nilai',$in);
		}
		function Total_Rpp_Induk($kodeguru)
		{
			$t=$this->db->query("select * from guru_rpp_induk where kodeguru = '$kodeguru' order by `no_rpp`");
			return $t;
		}

	function Tampil_Rpp($kodeguru,$limit,$ofset)
		{
		$tTampil_Tugas = $this->db->query("select * from `guru_rpp_induk` where `kodeguru`='$kodeguru' order by `no_rpp` limit $ofset,$limit ");
		return $tTampil_Tugas;
		}
		function Tambah_Rpp($in)
		{
			$tTambah_Rpp=$this->db->insert('guru_rpp_induk',$in);
			return $tTambah_Rpp;
		}
	function Update_Rpp($in)
		{
			$this->db->where('id_guru_rpp_induk',$in['id_guru_rpp_induk']);
			$this->db->update('guru_rpp_induk',$in);
		}
	function Hapus_Rpp($id,$kodeguru)
		{
			$this->db->query("delete from `guru_rpp_induk` where `id_guru_rpp_induk` = '$id' and `kodeguru`='$kodeguru'");
		}
	function Total_Bip($kodeguru)
		{
		$tTotal_Bip=$this->db->query("select * from guru_bip where kodeguru='$kodeguru'");
			return $tTotal_Bip;
		}	
	function Tambah_Bip($in)
		{
			$tTambah_Bip=$this->db->insert('guru_bip',$in);
			return $tTambah_Bip;
		}
	function Update_Bip($in)
		{
			$this->db->where('id_guru_bip',$in['id_guru_bip']);
			$this->db->update('guru_bip',$in);
		}

	function Hapus_Bip($id,$kodeguru)
		{
			$this->db->query("delete from `guru_bip` where `id_guru_bip` = '$id' and `kodeguru`='$kodeguru'");
		}
	function Update_Data_Tindak_Lanjut($in)
		{
			$this->db->where('id_guru_tindak_lanjut',$in['id_guru_tindak_lanjut']);
			$this->db->update('guru_tindak_lanjut',$in);
		}
	function Tambah_Buku($in)
		{
			$tTambah_Buku=$this->db->insert('guru_buku_pegangan',$in);
			return $tTambah_Buku;
		}
	function Update_Buku($in)
		{
			$this->db->where('id_guru_buku_pegangan',$in['id_guru_buku_pegangan']);
			$this->db->update('guru_buku_pegangan',$in);
		}

	function Hapus_Buku($id,$kodeguru)
		{
			$this->db->query("delete from `guru_buku_pegangan` where `id_guru_buku_pegangan` = '$id' and `kodeguru`='$kodeguru'");

		}
	function Tambah_Tugas($in)
		{
			$tTambah_Tugas=$this->db->insert('guru_tugas',$in);
			return $tTambah_Tugas;
		}
	function Update_Tugas($in)
		{
			$this->db->where('id_guru_tugas',$in['id_guru_tugas']);
			$this->db->update('guru_tugas',$in);
		}

	function Hapus_Tugas($id,$kodeguru)
		{
			$this->db->query("delete from `guru_tugas` where `id_guru_tugas` = '$id' and `kodeguru`='$kodeguru'");

		}
	function Total_Tugas($kodeguru)
		{
		$tTotal_Tugas=$this->db->query("select * from guru_tugas where kodeguru='$kodeguru'");
			return $tTotal_Tugas;
		}	
	function Tampil_Tugas($kodeguru,$limit,$ofset)
		{
		$tTampil_Tugas = $this->db->query("select * from `guru_tugas` where `kodeguru`='$kodeguru' order by tanggal limit $ofset,$limit ");
		return $tTampil_Tugas;
		}
	function Update_Nilai_Remidi($in)
		{
			$this->db->where('id_nilai_remidi',$in['id_nilai_remidi']);
			$this->db->update('nilai_remidi',$in);		
		}
	function Update_Rpp_Impor($in)
		{
			$this->db->where('mapel',$in['mapel']);
			$this->db->where('no_rpp',$in['no_rpp']);
			$this->db->where('kodeguru',$in['kodeguru']);
			$this->db->update('guru_rpp_induk',$in);
		}
	function Tampil_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Semua_Mapel_Ada_Psikomotor_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and ranah != 'KA' order by thnajaran DESC, semester DESC, mapel ASC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Mapel_Ada_Psikomotor_Guru;
		}
	function Total_Semua_Mapel_Ada_Psikomotor_Guru($kodeguru)
		{
		$tTotal_Semua_Mapel_Ada_Psikomotor_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and ranah != 'KA' ");
			return $tTotal_Semua_Mapel_Ada_Psikomotor_Guru;
		}	
	function Update_Analisis_Impor($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('mapel',$in['mapel']);
			$this->db->where('ulangan',$in['ulangan']);
			$this->db->where('nis',$in['nis']);
			$this->db->update('analisis',$in);		
		}
	function Update_Skor_Pkg($in)
		{
			$this->db->where('id_pkg_t_nilai',$in['id_pkg_t_nilai']);
			$this->db->update('pkg_t_nilai',$in);
		}
	function Hapus_Skp($id,$nip)
		{
			$this->db->query("delete from `skp_skor_guru` where `id_skp_skor_guru` = '$id' and `nip`='$nip'");
		}
	function Update_Skor_Pkg_Proses($in)
		{
			$this->db->where('id_pkg_proses',$in['id_pkg_proses']);
			$this->db->update('pkg_proses',$in);
		}
	function Update_Nilai_Pkg($in)
		{
			$this->db->where('tahun',$in['tahun']);
			$this->db->where('nip',$in['nip']);
			$this->db->where('id_indikator',$in['id_indikator']);
			$this->db->update('pkg_t_nilai',$in);		
		}
	function Update_Skor_Skp($in)
		{
			$this->db->where('id_skp_skor_guru',$in['id_skp_skor_guru']);
			$this->db->update('skp_skor_guru',$in);
		}
	function Update_Nilai_Remidi_Unggah($kd,$ulangan,$nilai)
		{
			$this->db->query("update `nilai_remidi` set `nilai`='$nilai' where `kd`='$kd' and `ulangan`='$ulangan'");		
		}
	function Hapus_Capaian_Kompetensi($id_mapel,$nomor_materi)
		{
			$this->db->query("delete from `deskripsi_capaian_nilai` where `id_mapel` = '$id_mapel' and `nomor_materi`='$nomor_materi'");
			$this->db->query("delete from `deskripsi_capaian_nilai` where `materi` = ''");

		}
	function Hapus_Capaian_Kompetensi_Siswa($id_mapel,$nis)
		{
			$this->db->query("delete from `deskripsi_capaian_nilai` where `id_mapel` = '$id_mapel' and `nis`='$nis'");
		}

	function Simpan_Capaian_Kompetensi($in)
		{
			$this->db->insert('deskripsi_capaian_nilai',$in);
		
		}
	function Simpan_Tahun_guru($in)

		{
			$this->db->where('kodeguru',$in['kodeguru']);
			$this->db->update('tbldosen',$in);
		}
	function Update_Penanganan($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('pemberitahuan',$in);
		}
	function Tampil_Bip_Guru($kodeguru,$limit,$ofset)
		{
		$tTampil_Bip_Guru=$this->db->query("select * from `guru_bip` where kodeguru='$kodeguru' order by tanggal DESC LIMIT $ofset,$limit");
			return $tTampil_Bip_Guru;
		}	

	function Tampil_Daftar_Tugas_Siswa($thnajaran,$semester,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Daftar_Tugas_Siswa=$this->db->query("select * from `guru_tugas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by tanggal DESC LIMIT $ofset,$limit");
		return $tTampil_Daftar_Tugas_Siswa;
		}
	function Total_Daftar_Tugas_Siswa($thnajaran,$semester)
		{
		$tTotal_Daftar_Tugas_Siswa=$this->db->query("select * from `guru_tugas` where `thnajaran`='$thnajaran' and `semester`='$semester'");
			return $tTotal_Daftar_Tugas_Siswa;
		}
	function Tampil_Bpu($kodeguru,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Bpu=$this->db->query("select * from `guru_bpu` where `kodeguru`='$kodeguru' order by tanggal DESC LIMIT $ofset,$limit");
		return $tTampil_Bpu;
		}
	function Total_Bpu($kodeguru)
		{
		$tTotal_Bpu=$this->db->query("select * from `guru_bpu` where `kodeguru`='$kodeguru'");
			return $tTotal_Bpu;
		}

	function Tambah_Bpu($in)
		{
			$tTambah_Bpu=$this->db->insert('guru_bpu',$in);
			return $tTambah_Bpu;
		}
	function Update_Bpu($in)
		{
			$this->db->where('id_guru_bpu',$in['id_guru_bpu']);
			$this->db->update('guru_bpu',$in);
		}

	function Hapus_Bpu($id,$kodeguru)
		{
			$this->db->query("delete from `guru_bpu` where `id_guru_bpu` = '$id' and `kodeguru`='$kodeguru'");
		}
	function Ubah_Status_Nilai($thnajaran,$semester,$mapel,$kelas)
		{

			$this->db->query("update `nilai` set `status`='T' where thnajaran = '$thnajaran' and semester = '$semester' and 	`kelas` = '$kelas' and mapel = '$mapel'");
		}
	function Tampil_Kalab_Guru($kodeguru,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `p_tugas_tambahan` where kodeguru=$kodeguru  and nama_tugas like 'kepala labora%' order by thnajaran DESC, semester DESC LIMIT $ofset,$limit");
			return $tb;
		}
	function Total_Kalab_Guru($kodeguru)
		{
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `p_tugas_tambahan` where kodeguru=$kodeguru and nama_tugas like 'kepala labora%'");
			return $tb;
		}
/*
	function Tampil_Proker_Kalab_Guru($thnajaran,$semester,$kodeguru,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `kalab_proker` where kodeguru=$kodeguru  and thnajaran = '$thnajaran' and semester = '$semester'  order by nourut ASC LIMIT $ofset,$limit");
			return $tb;
		}
	function Total_Proker_Kalab_Guru($thnajaran,$semester,$kodeguru)
		{
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from  `kalab_proker` where kodeguru=$kodeguru  and thnajaran = '$thnajaran' and semester = '$semester'");
			return $tb;
		}
*/
	function Tambah_Proker_Kalab($in)
		{
			$t=$this->db->insert('kalab_proker',$in);
			return $t;
		}
	function Update_Proker_Kalab($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('kalab_proker',$in);
		}
	function Hapus_Proker_Kalab($id,$kodeguru)
		{
			$this->db->where('id',$id);
			$this->db->where('kodeguru',$kodeguru);
			$this->db->delete('kalab_proker');
		}
	function Tambah_Agenda_Kalab($in)
		{
			$t=$this->db->insert('kalab_harian',$in);
			return $t;
		}
	function Update_Agenda_Kalab($in)
		{
			$this->db->where('id_kalab_harian',$in['id_kalab_harian']);
			$this->db->update('kalab_harian',$in);
		}
	function Hapus_Agenda_Kalab($id,$kodeguru)
		{
			$this->db->where('id_kalab_harian',$id);
			$this->db->where('kodeguru',$kodeguru);
			$this->db->delete('kalab_harian');
		}
	function Update_Detil_Aspek_Psikomotor($in)
		{
			$this->db->where('id_detil_aspek_psikomotor',$in['id_detil_aspek_psikomotor']);
			$this->db->update('detil_aspek_psikomotor',$in);		

		}
	function Cek_Nilai_Keterampilan($thnajaran,$semester,$mapel,$nomoraspek,$nis)
		{
		$tampilnilai_Analisis=$this->db->query("select * from detil_keterampilan where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and nomoraspek='$nomoraspek' and nis='$nis'");
		return $tampilnilai_Analisis;
		}
	function Add_Nilai_Keterampilan($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$nomoraspek = $param['nomoraspek'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `detil_keterampilan` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`nomoraspek`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel', '$nomoraspek','$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `detil_keterampilan` set kelas='$kelas', no_urut='$no_urut', status='$status' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}

		}
	function Update_Nilai_Keterampilan($in)
		{
			$this->db->where('id_detil_keterampilan',$in['id_detil_keterampilan']);
			$this->db->update('detil_keterampilan',$in);
		}
	function Update_Detil_Aspek_Afektif($in)
		{
			$this->db->where('id_detil_aspek_afektif',$in['id_detil_aspek_afektif']);
			$this->db->update('detil_aspek_afektif',$in);		

		}
	function Cek_Nilai_Sikap($thnajaran,$semester,$mapel,$nomoraspek,$nis)
		{
		$tampilnilai_Analisis=$this->db->query("select * from detil_sikap where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and nomoraspek='$nomoraspek' and nis='$nis'");
		return $tampilnilai_Analisis;
		}
	function Add_Nilai_Sikap($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$nomoraspek = $param['nomoraspek'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `detil_sikap` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`nomoraspek`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel', '$nomoraspek','$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `detil_sikap` set kelas='$kelas', no_urut='$no_urut', status='$status' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}

		}
	function Update_Nilai_Sikap($in)
		{
			$this->db->where('id_detil_sikap',$in['id_detil_sikap']);
			$this->db->update('detil_sikap',$in);
		}
	function Update_Jawaban($param)
		{
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$ulangan = $param['ulangan'];
			$kelompok = $param['kelompok'];
			$jawaban = $param['jawaban'];			
			$this->db->query("update `analisis` set `jawaban`='$jawaban', `kelompok`='$kelompok' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel' and `ulangan`='$ulangan'");
		}
	function Permanen_Hasil_Skp($tahun,$kode)
		{
		$this->db->query("update `ppk_pns` set `permanen`='1' where `tahun`='$tahun' and `kode`='$kode'");
		}
	function Ubah_Rph($param)
		{
		$thnajaran = $param['thnajaran'];
		$semester = $param['semester'];
		$kodeguru = $param['kodeguru'];
		$mapel = $param['mapel'];
		$kelas = $param['kelas'];
		$tanggal = $param['tanggal'];
		$jamke = $param['jamke'];
		$rencana = $param['rencana'];
		$sk = $param['sk'];
		$kd = $param['kd'];
		$keterangan = $param['keterangan'];
		$materi = $param['materi'];
		$materi_selanjutnya = $param['materi_selanjutnya'];
		$tanggal_bph = $param['tanggal_bph'];
		$tugas = $param['tugas'];
		$hambatan_siswa = $param['hambatan_siswa'];
		$tanggalselesai = $param['tanggalselesai'];
		$is_mandiri = $param['is_mandiri'];
		$solusi = $param['solusi'];
		$this->db->query("update guru_rph set `rencana` = '$rencana', `sk` = '$sk', `kd` = '$kd', `keterangan` = '$keterangan', `materi` = '$materi', `materi_selanjutnya` = '$materi_selanjutnya', `tanggal_bph` = '$tanggal_bph', `hambatan_siswa` = '$tugas', `tanggalselesai` = '$tanggalselesai', `is_mandiri` = '$is_mandiri', `solusi` = '$solusi' where thnajaran='$thnajaran' and  semester='$semester' and mapel='$mapel' and kelas='$kelas' and `jamke`='$jamke' and tanggal='$tanggal' and kodeguru='$kodeguru'");
		}
	function Cek_Rpp($semester,$mapel,$kodeguru,$no_rpp)
		{
		$tCek_Rpp=$this->db->query("select * from  guru_rpp_induk where kodeguru='$kodeguru' and semester='$semester' and mapel='$mapel' and no_rpp='$no_rpp'");
		$sudahada =$tCek_Rpp->num_rows();
			return $sudahada;
		}
	function Cari_Id_Mapel($thnajaran,$semester,$kelas,$mapel,$kodeguru)
		{
		$id_mapel = '';
		$tcekberhak=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
		foreach($tcekberhak->result() as $tc)
			{
			$id_mapel = $tc->id_mapel;
			}
		return $id_mapel;
		}
	function Update_Nilai_Dari_Unggahan($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('kelas',$in['kelas']);
			$this->db->where('mapel',$in['mapel']);
			$this->db->where('nis',$in['nis']);
			$this->db->update('nilai',$in);
		}
	function Update_Bip_Dari_Unggahan($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('kelas',$in['kelas']);
			$this->db->where('mapel',$in['mapel']);
			$this->db->where('tanggal',$in['tanggal']);
			$this->db->where('kodeguru',$in['kodeguru']);
			$this->db->update('guru_bip',$in);
		}
	function Cek_Bip($thnajaran,$semester,$kelas,$mapel,$tanggal,$kodeguru)
		{
		$tCek_Bip=$this->db->query("select * from  guru_bip where kodeguru='$kodeguru' and semester='$semester' and mapel='$mapel' and `thnajaran`='$thnajaran' and `kelas`='$kelas' and `tanggal`='$tanggal'");
		$sudahada =$tCek_Bip->num_rows();
			return $sudahada;
		}
	function Cek_Proker($thnajaran,$nourut,$kodeguru)
		{
		$tCek_Proker=$this->db->query("select * from `kalab_proker` where `thnajaran`='$thnajaran' and nourut='$nourut' and `kodeguru`='$kodeguru'");
		$sudahada =$tCek_Proker->num_rows();
		return $sudahada;
		}

	function Cari_Kalab($thnajaran,$kodeguru)
		{
		$tCek_Proker=$this->db->query("select * from `p_tugas_tambahan` where `thnajaran`='$thnajaran' and `nama_tugas` like '%kepala lab%' and `kodeguru`='$kodeguru'");
		$sudahada =$tCek_Proker->num_rows();
		return $sudahada;
		}
	function Update_Proker_Kalab_Dari_Unggahan($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('nourut',$in['nourut']);
			$this->db->where('kodeguru',$in['kodeguru']);
			$this->db->update('kalab_proker',$in);
		}
	function Update_Agenda_Kalab_Dari_Unggahan($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('tanggal',$in['tanggal']);
			$this->db->where('kodeguru',$in['kodeguru']);
			$this->db->update('kalab_harian',$in);
		}
	function Cek_Prohar($thnajaran,$tanggal,$kodeguru)
		{
		$tCek_Proker=$this->db->query("select * from `kalab_harian` where `thnajaran`='$thnajaran' and `tanggal`='$tanggal' and `kodeguru`='$kodeguru'");
		$sudahada =$tCek_Proker->num_rows();
		return $sudahada;
		}
	function Update_Skor_Supervisi_Guru($in)
		{
			$this->db->where('tipe','guru');
			$this->db->where('id_supervisi_nilai',$in['id_supervisi_nilai']);
			$this->db->update('supervisi_nilai',$in);
		}
	function Update_Skor_Supervisi_Tambahan($in)
		{
			$this->db->where('tipe','tambahan');
			$this->db->where('id_supervisi_nilai',$in['id_supervisi_nilai']);
			$this->db->update('supervisi_nilai',$in);
		}
	function Overide_Kepribadian($in)
		{
			$this->db->where('thnajaran',$in['thnajaran']);
			$this->db->where('semester',$in['semester']);
			$this->db->where('nis',$in['nis']);
			$this->db->update('kepribadian',$in);
		}
	function Tampil_Waka_Guru($kodeguru,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `p_tugas_tambahan` where kodeguru=$kodeguru  and nama_tugas like 'Waka%' order by thnajaran DESC, semester DESC LIMIT $ofset,$limit");
			return $tb;
		}
	function Total_Waka_Guru($kodeguru)
		{
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `p_tugas_tambahan` where kodeguru=$kodeguru and nama_tugas like 'Waka%' ");
			return $tb;
		}
	function Tampil_Kapus_Guru($kodeguru,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `p_tugas_tambahan` where kodeguru=$kodeguru  and nama_tugas like '%Kepala Perpustakaan%' order by thnajaran DESC, semester DESC LIMIT $ofset,$limit");
			return $tb;
		}
	function Total_Kapus_Guru($kodeguru)
		{
			$kodeguru = $this->db->escape($kodeguru);
			$tb=$this->db->query("select * from `p_tugas_tambahan` where kodeguru=$kodeguru and nama_tugas like '%Kepala Perpustakaan%'");
			return $tb;
		}
	function Tampilkan_Tahun_Per_Halaman($limit,$ofset)
		{
			$Tampilkan_Semua_Tahun=$this->db->query("SELECT * from m_tapel order by thnajaran DESC LIMIT $ofset,$limit");
			return $Tampilkan_Semua_Tahun;
		}
	function Simpan_Indikator($input)
		{
			$this->db->query("insert into `indikator` ".$input."");
		}
	function Perbarui_Indikator($input)
		{
			$this->db->query("update `indikator` set ".$input."");
		}

	function Simpan_Materi($input)
		{
			$this->db->query("update `m_mapel` set ".$input."");
		}
	function Simpan_Nilai_Detil_Keterampilan($in)
		{
			$this->db->where('id_detil_keterampilan',$in['id_detil_keterampilan']);
			$this->db->update('detil_keterampilan',$in);		
		}
	function Simpan_Saran($id_komentar,$itemkomentar,$komentar)
		{
			$this->db->query("update `komentar` set `$itemkomentar`='$komentar' where `id_komentar`='$id_komentar'");
		}
	function Cek_Nilai_Akhlak_Rekap($thnajaran,$semester,$nis)
		{
		$tampilnilai=$this->db->query("select * from `siswa_penilaian_diri_rekap` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		return $tampilnilai;
		}
	function Add_Nilai_Akhlak_Rekap($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `siswa_penilaian_diri_rekap` (`thnajaran`, `semester`, `nis`) VALUES ('$thnajaran', '$semester', '$nis')");
			}
		}
	function Ubah_Status_Siswa($tabel,$thnajaran,$semester,$kelas,$mapel)
		{
		$this->db->query("update `$tabel` set `status`='T' where `thnajaran`='$thnajaran' and `kelas`='$kelas' and `mapel`='$mapel' and `semester`='$semester'");
		}
	function Tampil_Bph2_Guru($thnajaran,$semester,$kodeguru,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tb=$this->db->query("select * from `guru_rph_ringkas` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by tanggal DESC, jamke DESC LIMIT $ofset,$limit");
			return $tb;
		}
	function Total_Bph2_Guru($thnajaran,$semester,$kodeguru)
		{
			$ta=$this->db->query("select * from `guru_rph_ringkas` where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester'");
			return $ta;
		}
	function Cek_Rph2($thnajaran,$semester,$mapel,$kelas,$tanggalrph,$kodeguru,$jamke)
		{
		$tCek_Rph2=$this->db->query("select * from guru_rph_ringkas where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and tanggal='$tanggalrph' and kelas='$kelas' and `jamke`='$jamke'");
		$sudahada =$tCek_Rph2->num_rows();
			return $sudahada;
		}
	function Tambah_Rph2($param)
		{
			$this->db->insert('guru_rph_ringkas',$param);
		}
	function Update_Rph2($in)
		{
			$this->db->where('id_rph',$in['id_rph']);
			$this->db->update('guru_rph_ringkas',$in);		
		}
	function Id_Rph2($id_rph,$kodeguru)
		{
		$tId_Rph=$this->db->query("select * from guru_rph_ringkas where kodeguru='$kodeguru' and id_rph='$id_rph'");
		return $tId_Rph;
		}

	function Delete_Rph2($id,$kodeguru)
		{
			$this->db->query("delete from guru_rph_ringkas where kodeguru='$kodeguru' and id_rph='$id'");
		}
	function Ubah_Rph2($param)
		{
		$thnajaran = $param['thnajaran'];
		$semester = $param['semester'];
		$kodeguru = $param['kodeguru'];
		$mapel = $param['mapel'];
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
		$this->db->query("update guru_rph_ringkas set `kode_rpp` = '$kode_rpp', `kode_rpp2` = '$kode_rpp2', `keterangan` = '$keterangan', `lab` = '$lab', `alat_dan_bahan` = '$alat_dan_bahan', `tanggal_bph` = '$tanggal_bph', `hambatan_siswa` = '$hambatan_siswa', `solusi` = '$solusi' where thnajaran='$thnajaran' and  semester='$semester' and mapel='$mapel' and kelas='$kelas' and `jamke`='$jamke' and tanggal='$tanggal' and kodeguru='$kodeguru'");
		}
	function Update_Tema($in)
		{
			$this->db->where('user',$in['user']);
			$this->db->update('temauser',$in);
		}
	function Simpan_Tanggapan_Wali($id_kepribadian,$wali)
		{
			$this->db->query("update `kepribadian` set `wali`='$wali' where `id_kepribadian`= '$id_kepribadian'");
		}
	function Update_Parameter_Skp($in)
		{
			$this->db->where('tahun',$in['tahun']);
			$this->db->where('kode',$in['kode']);
			$this->db->update('ppk_pns',$in);

		}
	function Permanen_Pkg($tahun,$kode)
		{
		$this->db->query("update `ppk_pns` set `permanen_pkg`='1' where `tahun`='$tahun' and `kode`='$kode'");
		}
	function Status_Permanen_Pkg($tahun,$kode)
		{
		$ta = $this->db->query("select * from `ppk_pns` where `tahun`='$tahun' and `kode`='$kode'");
		$status_pkg = '';
		foreach($ta->result() as $a)
		{
			$status_pkg = $a->permanen_pkg;
		}
		return $status_pkg;
		}
	function Batal_Permanen_Pkg($tahun,$kode)
		{
		$this->db->query("update `ppk_pns` set `permanen_pkg`='0', `pkg`='0', `pkg_tambahan`= '0' where `tahun`='$tahun' and `kode`='$kode'");
		}
	function Nopes_NIS($nopes)
		{
			$nis = '';
			$ta = $this->db->query("select * from `siswa_nomor_tes` where `no_peserta`='$nopes'");
			foreach($ta->result() as $a)
			{
				$nis = $a->nis;
			}
			return $nis;
		}
	function Hapus_Realisasi_SKP($id)
		{
			$this->db->where('id_skp_realisasi',$id);
			$this->db->delete('skp_realisasi');
		}
	function Tambah_Realisasi_Skp($param)
		{
			$this->db->insert('skp_realisasi',$param);
		}
	function Tambah_Penilai_Sikap($param)
		{
			$this->db->insert('m_akhlak_2015',$param);
		}
	function Cari_Penilai_Sikap($param)
	{
		$thnajaran = $param['thnajaran'];
		$semester = $param['semester'];
		$kodeguru = $param['kodeguru'];
		$kelas = $param['kelas'];
		$ta = $this->db->query("select * from `m_akhlak_2015` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
		$ada = $ta->num_rows();
		return $ada;
	}
	function Hapus_Penilai_Sikap($id)
		{
			$this->db->where('id_m_akhlak',$id);
			$this->db->delete('m_akhlak_2015');
		}
	function Hapus_Siswa_Ekstra($id)
		{
			$this->db->where('id_siswa_ekstra',$id);
			$this->db->delete('ekstrakurikuler');
		}
	function Update_Nilai_Akhlak_dari_Walikelas($param)
	{
		$this->db->where('thnajaran', $param['thnajaran']);
		$this->db->where('semester', $param['semester']);
		$this->db->where('nis', $param['nis']);
		$this->db->update('siswa_penilaian_diri_rekap',$param);
	}
	function Tampil_Semua_Mapel_Guru_Semester_Ini($kodeguru,$thnajaran,$semester,$limit,$ofset)
		{
		$ofset = $ofset * 1;
		$tTampil_Semua_Mapel_Guru=$this->db->query("select * from m_mapel where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, mapel ASC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Mapel_Guru;
		}
	function Cek_Guru_Ekstra($thnajaran,$semester,$kodeguru)
	{
		$tTampil_Semua_Ekstra_Guru=$this->db->query("select * from `m_pengampu_ekstra` where `kodeguru`='$kodeguru' and  `thnajaran`='$thnajaran' and `semester`='$semester'");
		return $tTampil_Semua_Ekstra_Guru;
	}
	function Cek_Nilai_Ekstrakurikuler($thnajaran,$semester,$nama_ekstra,$nis)
	{
		$tTampil_Semua_Ekstra_Guru=$this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nama_ekstra`='$nama_ekstra' and `nis`='$nis'");
		return $tTampil_Semua_Ekstra_Guru;
	}
	function Tambah_Nilai_Ekstrakurikuler($thnajaran,$semester,$kelas,$nama_ekstra,$nis)
	{
		$this->db->query("insert into `ekstrakurikuler` (`thnajaran`,`semester`,`kelas`,`nama_ekstra`,`nis`) values ('$thnajaran', '$semester', '$kelas', '$nama_ekstra', '$nis')");
	}
	function Ubah_Nilai_Ekstrakurikuler($pbk)
	{
		$this->db->where('thnajaran',$pbk['thnajaran']);
		$this->db->where('semester',$pbk['semester']);
		$this->db->where('nama_ekstra',$pbk['nama_ekstra']);
		$this->db->where('nis',$pbk['nis']);
		$this->db->update('ekstrakurikuler',$pbk);
	}
	function Tampil_Semua_Nilai_Separuh($kelas,$mapel,$semester,$thnajaran,$separuh)
	{
		if($separuh == 1)
		{
			$tTampil_Semua_Nilai=$this->db->query("select * from nilai where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut limit 30,20");
		}
		else
		{
			$tTampil_Semua_Nilai=$this->db->query("select * from nilai where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut limit 0,30");
		}
			return $tTampil_Semua_Nilai;
		}
	function Hapus_Deskripsi($id_mapel)
		{
			$this->db->query("delete from `deskripsi_capaian_nilai` where `id_mapel` = '$id_mapel'");
		}
	function Tampil_Semua_Nilai_Akhlak_Guru_K13($kodeguru,$limit,$ofset)
		{
		$tTampil_Semua_Nilai_Akhlak_Guru=$this->db->query("select * from m_akhlak_2015 where kodeguru='$kodeguru' order by thnajaran DESC, semester DESC, kelas ASC LIMIT $ofset,$limit");
			return $tTampil_Semua_Nilai_Akhlak_Guru;
		}
	function Total_Semua_Nilai_Akhlak_Guru_k13($kodeguru)
		{
		$tTotal_Semua_Nilai_Akhlak_Guru=$this->db->query("select * from m_akhlak_2015 where kodeguru='$kodeguru'");
			return $tTotal_Semua_Nilai_Akhlak_Guru;
		}	
	function Nilai_Asli_Psikomotor($thnajaran,$semester,$mapel,$nis,$itemnilai)
	{
		$iteme = 'p'.$itemnilai;
		$tsa = $this->db->query("select * from `nilai` where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		$nilaiaslik = 0;
		foreach($tsa->result() as $da)
		{
			$nilaiaslik = $da->$iteme;
		}
		return $nilaiaslik;
		
		}
	function Ubah_Nilai_Psikomotor($param)
	{
		$iteme = 'p'.$param['itemnilai'];
		$thnajaran = $param['thnajaran'];
		$semester = $param['semester'];
		$nis  = $param['nis'];
		$mapel = $param['mapel'];
		if($param['itemnilai'] == 'semua')
		{
			for($i=1;$i<=10;$i++)
			{
				$iteme = 'p'.$i;
				$$iteme = $param[$iteme];
			}
			$this->db->query("update `nilai` set `p1` = '$p1', `p2` = '$p2', `p3` = '$p3', `p4` = '$p4', `p5` = '$p5', `p6` = '$p6', `p7` = '$p7', `p8` = '$p8', `p9` = '$p9', `p10` = '$p10' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");

		}
		else
		{
			$nilai = $param['nilai'];
			$this->db->query("update `nilai` set `$iteme` = '$nilai' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
		}
	}
	function Update_Skor_Skp_Revisi($in)
		{
			$this->db->where('id_skp_skor_guru_revisi',$in['id_skp_skor_guru_revisi']);
			$this->db->update('skp_skor_guru_revisi',$in);
		}
	function Hapus_Skor_Skp_Revisi($nip, $id)
	{
		$this->db->where('id_skp_skor_guru_revisi',$id);
		$this->db->where('nip',$nip);
		$this->db->delete('skp_skor_guru_revisi');
	}
	function Update_Parameter_Skp_Kedua($in)
		{
			$this->db->where('tahun',$in['tahun']);
			$this->db->where('kode',$in['kode']);
			$this->db->update('ppk_pns_kedua',$in);

		}
	function Tambah_Realisasi_Skp_Kedua($param)
		{
			$this->db->insert('skp_realisasi_kedua',$param);
		}
	function Hapus_Realisasi_SKP_Kedua($id)
		{
			$this->db->where('id_skp_realisasi',$id);
			$this->db->delete('skp_realisasi_kedua');
		}
	function Update_Skor_Skp_Kedua($in)
		{
			$this->db->where('id_skp_skor_guru',$in['id_skp_skor_guru']);
			$this->db->update('skp_skor_guru_kedua',$in);
		}
	function Hapus_Skp_Kedua($id,$nip)
		{
			$this->db->query("delete from `skp_skor_guru_kedua` where `id_skp_skor_guru` = '$id' and `nip`='$nip'");
		}
	function Update_Data_Supervisi_Mengajar($in)
		{
			$this->db->where('id_data_supervisi',$in['id_data_supervisi']);
			$this->db->where('username',$in['username']);
			$this->db->update('guru_data_supervisi',$in);

		}
	function Update_Skor_Supervisi_Guru_Mengajar($in)
		{
			$this->db->where('id_supervisi_mengajar_nilai',$in['id_supervisi_mengajar_nilai']);
			$this->db->update('supervisi_mengajar_nilai',$in);
		}
	function Id_Mapel_Saja($id)
		{
			$tmapel=$this->db->query("select * from m_mapel where id_mapel='$id'");
			return $tmapel;
		}
	function Tampil_Semua_Nilai_Pilihan($kelas,$mapel,$semester,$thnajaran)
		{
		$tTampil_Semua_Nilai=$this->db->query("select * from `nilai_pilihan` where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
			return $tTampil_Semua_Nilai;
		}
	function Cek_Nilai_Pilihan($thnajaran,$semester,$mapel,$nis)
		{
		$tampilnilai=$this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `nis`='$nis'");
		return $tampilnilai;
		}
	function Add_Nilai_Pilihan($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$mapel = $param['mapel'];
			$kd_mapel = $param['kd_mapel'];
			$no_urut = $param['no_urut'];
			$status = $param['status'];
			// edit mode

			if($ada==0) 
			{
			$this->db->query("INSERT INTO `nilai_pilihan` (`thnajaran`, `semester`, `kelas`, `nis`, `mapel`,`kd_mapel`,`no_urut`,`status`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$mapel', '$kd_mapel','$no_urut','$status')");
			}
			else
			{
			$this->db->query("update `nilai_pilihan` set `kelas`='$kelas',`status`='$status', no_urut='$no_urut' where thnajaran = '$thnajaran' and semester = '$semester' and nis = '$nis' and mapel = '$mapel'");
			}
		}
	function Update_Nilai_Pilihan($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('nilai_pilihan',$in);
		}
	function Hapus_Berkas_Keluarga($username,$item,$id) 
	{
		$this->db->query("update `p_keluarga` set `$item`='' where id='$id' and idpegawai ='$username' ");
	}
	function Hapus_Berkas_Pegawai($username,$item) 
	{
		$this->db->query("update `p_pegawai` set `$item`='' where `kd` ='$username' ");
	}
	function Hapus_Berkas_Pendidikan($username,$id) 
	{
		$this->db->query("update `p_pendidikan` set `berkas`='' where `idpegawai` ='$username' and `id`='$id'");
	}
	function Data_Pendidikan_Pegawai($username,$id) 
		{
		$tTampil_Riwayat_Pendidikan_Pegawai= $this->db->query("select * from p_pendidikan where idpegawai ='$username' and `id`='$id'");
		return $tTampil_Riwayat_Pendidikan_Pegawai;
		}
	function Hapus_Berkas_Kepegawaian($username,$id) 
	{
		$this->db->query("update `p_kepegawaian` set `berkas`='' where `idpegawai` ='$username' and `id`='$id'");
	}
	function Data_Kepegawaian($username,$id) 
		{
		$tTampil_Riwayat_Pendidikan_Pegawai= $this->db->query("select * from p_kepegawaian where idpegawai ='$username' and `id`='$id'");
		return $tTampil_Riwayat_Pendidikan_Pegawai;
		}
	function Data_Sertifikat($username,$id) 
		{
		$tTampil_Riwayat_Sertifikat_Pegawai= $this->db->query("select * from p_sertifikat where idpegawai ='$username' and `id`='$id'");
		return $tTampil_Riwayat_Sertifikat_Pegawai;
		}
	function Hapus_Berkas_Sertifikat($username,$id) 
	{
		$this->db->query("update `p_sertifikat` set `berkas`='' where `idpegawai` ='$username' and `id`='$id'");
	}
	function Data_Berkas($username,$id) 
		{
		$tTampil_Riwayat_Sertifikat_Pegawai= $this->db->query("select * from p_berkas where kd ='$username' and `id_berkas`='$id'");
		return $tTampil_Riwayat_Sertifikat_Pegawai;
		}
	function Hapus_Berkas_Lain($username,$id) 
	{
		$this->db->query("delete from `p_berkas` where `kd` ='$username' and `id_berkas`='$id'");
	}

}
