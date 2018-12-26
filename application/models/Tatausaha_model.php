<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : tatausaha_model.php
// Lokasi      : application/models
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
?>
<?php
class Tatausaha_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Tampil_Semua_Kode_Surat($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Kode_Surat=$this->db->query("select * from m_kode_surat order by kode_surat LIMIT $ofset,$limit");
			return $Tampil_Semua_Kode_Surat;
		}
		function Total_Kode_Surat()
		{
			$Tampil_Semua_Kode_Surat=$this->db->query("select * from m_kode_surat order by kode_surat ASC");
			return $Tampil_Semua_Kode_Surat;
		}
		function Simpan_Kode_Surat($in)
		{
			$this->db->insert('m_kode_surat',$in);
		}
		function Tampil_Semua_Surat_Masuk($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Surat_Masuk=$this->db->query("select * from surat_masuk order by tahun_surat DESC, nomor_urut DESC LIMIT $ofset,$limit");
			return $Tampil_Semua_Surat_Masuk;
		}
		function Total_Surat_Masuk()
		{
			$Tampil_Semua_Surat_Masuk=$this->db->query("select * from surat_masuk");
			return $Tampil_Semua_Surat_Masuk;
		}
		function Simpan_Surat_Masuk($input)
		{
			$this->db->insert('surat_masuk',$input);
		}
		function Tampil_Semua_Surat_Keluar($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Surat_Keluar=$this->db->query("select * from surat_keluar order by tahun_surat DESC,nomor_surat DESC LIMIT $ofset,$limit");
			return $Tampil_Semua_Surat_Keluar;
		}
		function Total_Surat_Keluar()
		{
			$Tampil_Semua_Surat_Keluar=$this->db->query("select * from surat_keluar");
			return $Tampil_Semua_Surat_Keluar;
		}
		function Hapus_Surat_Masuk($id_surat_masuk)
		{
			$this->db->where('id_surat_masuk',$id_surat_masuk);
			$this->db->delete('surat_masuk');
		}
		function Detil_Surat_Masuk($id_surat_masuk)
		{
			$tDetil_Surat_Masuk=$this->db->query("select * from surat_masuk where id_surat_masuk='$id_surat_masuk'");
			return $tDetil_Surat_Masuk;
		}
		function Update_Surat_Masuk($in)
		{
			$this->db->where('id_surat_masuk',$in['id_surat_masuk']);
			$this->db->update('surat_masuk',$in);
		}
		function Simpan_Surat_Keluar($input)
		{
			$this->db->insert('surat_keluar',$input);
		}
		function Hapus_Surat_Keluar($id_surat_keluar)
		{
			$this->db->where('id_surat_keluar',$id_surat_keluar);
			$this->db->delete('surat_keluar');
		}
		function Detil_Surat_Keluar($id_surat_keluar)
		{
			$tDetil_Surat_Keluar=$this->db->query("select * from surat_keluar where id_surat_keluar='$id_surat_keluar'");
			return $tDetil_Surat_Keluar;
		}
		function Update_Surat_Keluar($in)
		{
			$this->db->where('id_surat_keluar',$in['id_surat_keluar']);
			$this->db->update('surat_keluar',$in);
		}

		function Cari_Siswa_Tbllogin($kunci)
		{
			if (empty($kunci))
			{
			$tcarisiswa=$this->db->query("select * from tbllogin where nama='xxxxx'");
			}
			else
			{
			$tcarisiswa=$this->db->query("select * from tbllogin where nama like '%$kunci%' and status='Siswa'");
			}
			return $tcarisiswa;
		}
		function Detil_Siswa_Tbllogin($nis)
		{
			$tcarisiswa=$this->db->query("select * from tbllogin where username='$nis'");
			return $tcarisiswa;
		}
		function Cari_Tgl_Penerimaan($thnajaran)
		{
			$tCari_Tgl_Penerimaan=$this->db->query("select * from m_tapel where thnajaran='$thnajaran'");
			return $tCari_Tgl_Penerimaan;
		}
		function Cari_Nomor_Pendaftaran($nisx)
		{
			$tCari_Nomor_Pendaftaran=$this->db->query("select * from datsis where nis='$nisx'");
			return $tCari_Nomor_Pendaftaran;
		}

		function Cek_Data_Siswa($nisx)
		{
			$tCek_Data_Siswa=$this->db->query("select * from datsis where nis='$nisx'");
			return $tCek_Data_Siswa;
		}
		function Simpan_Nomor_Pendaftaran_Siswa($input,$ada)
		{
			if ($ada==0)
			{
			$this->db->insert('datsis',$input);
			}
			else
			{
			$this->db->where('nis',$input['nis']);
			$this->db->update('datsis',$input);
			}
		}
		function Perbarui_Data_Siswa_Baru($inputpbk)
		{
			$this->db->where('nis',$inputpbk['nis']);
			$this->db->update('datsis',$inputpbk);
		}
		function Tampil_Semua_Guru($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tampilsemuaguru=$this->db->query("select * from `p_pegawai` where `guru`='Y' order by nama ASC LIMIT $ofset,$limit");
			return $tampilsemuaguru;
		}
		function Total_Guru()
		{
			$t=$this->db->query("select * from tbllogin where `status`='PA'");
			return $t;
		}
	function Update_Data_Umum($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('p_pegawai',$in);
		}
	function Tampil_Data_Umum_Pegawai($username) 
		{
		$tTampil_Data_Umum_Pegawai= $this->db->query("select * from p_pegawai where kd ='$username'");
		return $tTampil_Data_Umum_Pegawai;
		}
	function Tampil_Data_Istri_Suami_Keluarga_Pegawai($username) 
		{
		$tTampil_Data_Istri_Suami_Keluarga_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and (hubungan='Suami' or hubungan='Istri')");
		return $tTampil_Data_Istri_Suami_Keluarga_Pegawai;
		}
	function Tampil_Data_Anak_Pegawai($username) 
		{
		$tTampil_Data_Anak_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and hubungan like 'Anak%' order by tanggallahir ASC");
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
	function Tampil_Data_Kakak_Adik_Pegawai($username) 
		{
		$tTampil_Data_Mertua_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' and (hubungan='Adik' or hubungan='Kakak')");
		return $tTampil_Data_Mertua_Pegawai;
		}

	function Tampil_Data_Keluarga_Pegawai($username) 
		{
		$tTampil_Data_Keluarga_Pegawai= $this->db->query("select * from p_keluarga where idpegawai ='$username' order by urut");
		return $tTampil_Data_Keluarga_Pegawai;
		}
	function Tampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk($username) 
		{
		$tTampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk= $this->db->query("select * from p_kepegawaian where idpegawai ='$username' order by jenis_sk DESC");
		return $tTampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk;
		}
	function Tampil_Riwayat_Pendidikan_Pegawai($username) 
		{
		$tTampil_Riwayat_Pendidikan_Pegawai= $this->db->query("select * from p_pendidikan where idpegawai ='$username' order by tahunlulus ASC");
		return $tTampil_Riwayat_Pendidikan_Pegawai;
		}
	function Total_Semua_Pegawai() 
		{
		$tTotal_Semua_Pegawai= $this->db->query("select * from `p_pegawai` where status='Y' order by nama ASC");
		return $tTotal_Semua_Pegawai;
		}
	function get_Nama($username) 
		{
		$tget_Nama= $this->db->query("select * from `p_pegawai` where `kd` ='$username'");
		$namapegawai='';
		foreach($tget_Nama->result() as $e)
			{
				$namapegawai = $e->nama;
			}
		
		return $namapegawai;
		}
	function Buat_Data_Umum_Baru($username,$nama)
		{
			$tBuat_Data_Umum_Baru = $this->db->query("INSERT INTO `p_pegawai` (`kd`,`nama`) VALUES ('$username','$nama')");
			return $tBuat_Data_Umum_Baru;
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
	function Tampil_Data_Keluarga($id) 
		{
		$tCek_Data_Keluarga= $this->db->query("select * from p_keluarga where id='$id'");
		return $tCek_Data_Keluarga;
		}
	function Tampil_Data_Pendidikan($id) 
		{
		$tCek_Data_Pendidikan= $this->db->query("select * from p_pendidikan where id='$id'");
		return $tCek_Data_Pendidikan;
		}
	function Tampil_Data_Kepegawaian($id) 
		{
		$tTampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk= $this->db->query("select * from p_kepegawaian where id ='$id'");
		return $tTampil_Data_Kepegawaian_Pegawai_Urut_Jenis_Sk;
		}
	function Tampil_Data_Organisasi_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Organisasi_Pegawai= $this->db->query("select * from p_organisasi where idpegawai='$usernamepegawai'");
		return $tTampil_Data_Organisasi_Pegawai;
		}
	function Tampil_Data_Organisasi($id) 
		{
		$tTampil_Data_Organisasi= $this->db->query("select * from p_organisasi where id='$id'");
		return $tTampil_Data_Organisasi;
		}
	function Tampil_Data_Diklat_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Diklat_Pegawai= $this->db->query("select * from p_sertifikat where idpegawai='$usernamepegawai'");
		return $tTampil_Data_Diklat_Pegawai;
		}
	function Tampil_Data_Diklat($id) 
		{
		$tTampil_Data_Diklat= $this->db->query("select * from p_sertifikat where id='$id'");
		return $tTampil_Data_Diklat;
		}
	function Tampil_Data_Penghargaan_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Penghargaan_Pegawai= $this->db->query("select * from p_penghargaan where idpegawai='$usernamepegawai'");
		return $tTampil_Data_Penghargaan_Pegawai;
		}
	function Tampil_Data_Penghargaan($id) 
		{
		$tTampil_Data_Penghargaan= $this->db->query("select * from p_penghargaan where id='$id'");
		return $tTampil_Data_Penghargaan;
		}
	function Tampil_Data_Keluar_Negeri_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Keluar_Negeri_Pegawai= $this->db->query("select * from p_keluar_negeri where idpegawai='$usernamepegawai'");
		return $tTampil_Data_Keluar_Negeri_Pegawai;
		}
	function Tampil_Data_Keluar_Negeri($id) 
		{
		$tTampil_Data_Keluar_Negeri= $this->db->query("select * from p_keluar_negeri where id='$id'");
		return $tTampil_Data_Keluar_Negeri;
		}
	function Tampil_Data_Organisasi_SLTA_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Organisasi_SLTA_Pegawai= $this->db->query("select * from p_organisasi where idpegawai='$usernamepegawai' and tingkat='SLTA'");
		return $tTampil_Data_Organisasi_SLTA_Pegawai;
		}
	function Tampil_Data_Organisasi_PT_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Organisasi_PT_Pegawai= $this->db->query("select * from p_organisasi where idpegawai='$usernamepegawai' and tingkat='PT'");
		return $tTampil_Data_Organisasi_PT_Pegawai;
		}
	function Tampil_Data_Organisasi_Pegawai_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Organisasi_Pegawai_Pegawai= $this->db->query("select * from p_organisasi where idpegawai='$usernamepegawai' and tingkat='Pegawai'");
		return $tTampil_Data_Organisasi_Pegawai_Pegawai;
		}
	function Tampil_Data_Jabatan_Pegawai($usernamepegawai) 
		{
		$tTampil_Data_Jabatan_Pegawai= $this->db->query("select * from p_jabatan where idpegawai='$usernamepegawai'");
		return $tTampil_Data_Jabatan_Pegawai;
		}
	function Tampil_Data_Kepegawaian_Pegawai($username) 
		{
		$tTampil_Data_Kepegawaian_Pegawai= $this->db->query("select * from p_kepegawaian where idpegawai ='$username' order by tanggal DESC");
		return $tTampil_Data_Kepegawaian_Pegawai;
		}
	function Tampil_Skbk_Skmt($thnajaran)
		{
		$tTampil_Skbk_Skmt= $this->db->query("SELECT * FROM `nomor_skbk_skmt` where thnajaran='$thnajaran'");
		return $tTampil_Skbk_Skmt;
		}
		function Cek_Nomor_Skbk_Skmt($in)
		{
			$tCek_Nomor_Skbk_Skmt=$this->db->query("select * from nomor_skbk_skmt where thnajaran = '$in[thnajaran]' and semester = '$in[semester]'");
			return $tCek_Nomor_Skbk_Skmt;
		}

		function Simpan_Nomor_Skbk_Skmt($in,$ada)
		{
			if ($ada==0)
				{
				$this->db->insert('nomor_skbk_skmt',$in);
				}
				else
				{
				$this->db->query("update nomor_skbk_skmt set nomor_aktif = '$in[nomor_aktif]', nomor_skbk = '$in[nomor_skbk]', nomor_skmt='$in[nomor_skmt]', nama_pengawas='$in[nama_pengawas]', nip='$in[nip]', tanggal='$in[tanggal]', tanggal_aktif='$in[tanggal_aktif]' where thnajaran = '$in[thnajaran]' and semester = '$in[semester]'");
				}

		}
	function Simpan_Mutasi_Siswa($nis,$thnajaran,$semester,$kelas,$no_urut) 
		{
		$this->db->query("update siswa_kelas set kelas = '$kelas', no_urut='$no_urut'  where thnajaran = '$thnajaran' and nis='$nis' and `semester`='$semester'");
		$this->db->query("update datsis set kdkls = '$kelas', ket='Y' where nis='$nis'");
		$this->db->query("update nilai set kelas = '$kelas' where nis='$nis' and thnajaran='$thnajaran' and semester='$semester'");
		$this->db->query("update ekstrakurikuler set kelas = '$kelas' where nis='$nis' and thnajaran='$thnajaran' and semester='$semester'");
		$this->db->query("update afektif set kelas = '$kelas' where nis='$nis' and thnajaran='$thnajaran' and semester='$semester'");
		$this->db->query("update analisis set kelas = '$kelas' where nis='$nis' and thnajaran='$thnajaran' and semester='$semester'");
		}
	function Update_Status($id_p_pegawai,$status)
		{
			$this->db->query("update `p_pegawai` set `status`='$status' where id_p_pegawai = '$id_p_pegawai'");
		}
	function Simpan_Data_Kp4($in)
		{
		$this->db->update('tblkp4',$in);
		}
	function Cek_Baru($username)
		{
			$tampil_semua_siswa=$this->db->query("select * from tbllogin where `username`='$username'");
			return $tampil_semua_siswa;
		}
		function Add_Contact($param,$ada)
		{

			$username = $param['username'];
			$nama = nopetik($param['nama']);
			$aktif = $param['aktif'];
			$psw = $param['password'];
			$idlink = $param['username'];
			// edit mode
			if ($aktif=='T')
				{
				$this->db->query("update datsis set `ket`='T' where nis='$username'");
				}
			if ($aktif=='L')
				{
				$this->db->query("update datsis set `ket`='L' where nis='$username'");
				}

			if ($aktif=='K')
				{
				$this->db->query("update datsis set `ket`='K' where nis='$username'");
				}
			if ($aktif=='Y')
				{
				$this->db->query("update datsis set `ket`='T' where nis='$username'");
				}
			if ($aktif=='P')
				{
				$this->db->query("update datsis set `ket`='P' where nis='$username'");
				}



			if($ada>0) 
			{
				$this->db->query("update tbllogin set `nama`='$nama', `psw`='$psw', aktif='$aktif' where `username`='$username'");
			} 
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `tbllogin` (`username` ,`psw` ,`nama` ,`status` ,`idlink`,`aktif`) VALUES ('$username', '$psw' , '$nama', 'Siswa', '$idlink','Y')");
			}

		}
		function Cek_Baru_Datsis($username)
		{
			$tampil_semua_siswa_Datsis=$this->db->query("select * from datsis where `nis`='$username'");
			return $tampil_semua_siswa_Datsis;
		}
		function Add_Contact_Datsis($param,$ada)
		{

			$nis = $param['username'];
			$nama = $param['nama'];
			$aktif = $param['aktif'];
			$nama=nopetik($nama);
			if($ada==0) 
			{
			$tambahdatsis=$this->db->query("INSERT INTO `datsis` (`nis` ,`nama`,`ket`) VALUES ('$nis', '$nama','$aktif')");
			}

		}
		function Hapus_Kode_Surat($id_surat_masuk)
		{
			$this->db->where('kd',$id_surat_masuk);
			$this->db->delete('m_kode_surat');
		}
	function Tampil_Semua_Tahun_Penilaian($batas,$ofset)
		{
			$Tampil_Semua_Tahun=$this->db->query("SELECT * from pkg_masa order by tahun DESC LIMIT $ofset,$batas");
			return $Tampil_Semua_Tahun;
		}
	function Total_Tahun_Penilaian()
		{
			$Total_Tahun=$this->db->query("SELECT * from pkg_masa ");
			return $Total_Tahun;
		}
		function Simpan_Tahun_Penilaian($input)
		{
			$awal = $input['awal'];
			$akhir = $input['akhir'];
			$tahun = $input['tahun'];
			$aktif = $input['aktif'];
			if ($aktif == 1)
				{
				$this->db->query("update pkg_masa set `aktif` = 0 where `aktif`='1'");
				}
			$this->db->insert('pkg_masa',$input);
		}
		function Ubah_Tahun_Penilaian($input)
		{
			$awal = $input['awal'];
			$akhir = $input['akhir'];
			$tahun = $input['tahun'];
			$aktif = $input['aktif'];
			$id_masa = $input['id_masa'];
			if ($aktif == 1)
				{
				$this->db->query("update pkg_masa set `aktif` = 0 where `aktif`='1'");
				}
			$this->db->where('id_masa',$id_masa);
			$this->db->update('pkg_masa',$input);

		}
		function Hapus_Tahun_Penilaian($input)
		{
			$this->db->where('id_masa',$id_masa);
			$this->db->delete('pkg_masa');
		}
	function Tampil_Tim_Penilai($tahun)
		{
			$Tampil_Semua_Tahun=$this->db->query("SELECT * from pkg_tim_penilai where `tahun`='$tahun' order by kode_penilai");
			return $Tampil_Semua_Tahun;
		}
		function Simpan_Tim_Penilai($input)
		{
			$kode_penilai = $input['kode_penilai'];
			$kode_ternilai = $input['kode_ternilai'];
			$tahun = $input['tahun'];
			$this->db->insert('pkg_tim_penilai',$input);
		}
		function Hapus_Tim_Penilai($id)
		{
			$this->db->where('id_tim_penilai',$id);
			$this->db->delete('pkg_tim_penilai');

		}
		function Ubah_Tim_Penilai($input)
		{
			$this->db->where('id_tim_penilai',$input['id_tim_penilai']);
			$this->db->update('pkg_tim_penilai',$input);

		}
		function Simpan_Pejabat_Penilai($input)
		{
			$this->db->insert('pejabat_penilai',$input);
		}
		function Hapus_Pejabat_Penilai($id)
		{
			$this->db->where('id_pejabat',$id);
			$this->db->delete('pejabat_penilai');

		}
		function Ubah_Pejabat_Penilai($input)
		{
			$this->db->where('id_pejabat',$input['id_pejabat']);
			$this->db->update('pejabat_penilai',$input);

		}

	function Tampil_Pejabat_Penilai($tahun)
		{
			$Tampil_Semua_Tahun=$this->db->query("SELECT * from `pejabat_penilai` where `tahun`='$tahun'");
			return $Tampil_Semua_Tahun;
		}
	function Simpan_Pemeriksaan_Berkas($input)
		{
			$this->db->where('thnajaran',$input['thnajaran']);
			$this->db->where('semester',$input['semester']);
			$this->db->where('kodeguru',$input['kodeguru']);
			$this->db->update('p_tugas_tambahan',$input);

		}
	function Update_Kode_Padamu_Siswa($input)
		{
			$this->db->where('nis',$input['nis']);
			$this->db->update('datsis',$input);

		}
	function Update_ID_Siswa_Emiss($input)
		{
			$this->db->where('nis',$input['nis']);
			$this->db->update('datsis',$input);
		}
	function Tampilkan_Semua_Tahun()
		{
			$Tampilkan_Semua_Tahun=$this->db->query("SELECT * from m_tapel order by thnajaran DESC");
			return $Tampilkan_Semua_Tahun;
		}
	function Update_Nilai_Siswa_Pindahan($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('nilai',$in);
		}
	function Tampil_Semua_Saran($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Saran=$this->db->query("select * from `tblsaran` order by `id_saran` DESC LIMIT $ofset,$limit");
			return $Tampil_Semua_Saran;
		}
		function Total_Saran()
		{
			$Total_Saran=$this->db->query("select * from `tblsaran`");
			return $Total_Saran;
		}
		function Hapus_Saran($id_saran)
		{
			$Total_Saran=$this->db->query("delete from `tblsaran` where `id_saran`='$id_saran'");
			return $Total_Saran;
		}
		function tambah_mapel_emiss($in)
		{
			$this->db->insert('m_mapel_emiss',$in);
		}
		function hapus_mapel_emiss($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('m_mapel_emiss');
		}
		function ubah_mapel_emiss($in)
		{
			$this->db->where('id',$in['id']);
			$this->db->update('m_mapel_emiss',$in);
		}
		function Perbarui_Data_Siswa_Baru_Nomor_Pendaftaran($inputpbk)
		{
			$this->db->where('nomor_pendaftaran',$inputpbk['nomor_pendaftaran']);
			$this->db->update('datsis',$inputpbk);
		}

	} //akhir fungsi
