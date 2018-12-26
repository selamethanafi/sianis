<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: keuangan_model.php
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
class Keuangan_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Daftar_Macam_Pembayaran()
		{
			$tDaftar_Macam_Pembayaran=$this->db->query("select * from m_uang order by status ASC,  `nomor_urut` ASC");
			return $tDaftar_Macam_Pembayaran;
		}
		function Macam_Pembayaran($kd)
		{
			$tDaftar_Macam_Pembayaran=$this->db->query("select * from m_uang where kd='$kd'");
			return $tDaftar_Macam_Pembayaran;
		}
		function Simpan_Macam_Pembayaran($in)
		{
			if(empty($in['kd']))
				{$this->db->insert('m_uang',$in);
				}
				else
				{
				$this->db->where('kd',$in['kd']);
				$this->db->update('m_uang',$in);
				}

		}
		function Cari_Siswa($kunci)
		{
			if (empty($kunci))
			{
			$tcarisiswa=$this->db->query("select * from `datsis` where `nama`='xxxxx'");
			}
			else
			{
			$tcarisiswa=$this->db->query("select * from `datsis` where `nama` like '%$kunci%' or `nis` like '%$kunci%' order by `ket` DESC");
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
		function Cari_Siswa_Aktif_Kelas($kunci,$thnajaran)
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
		function Daftar_Pembayaran_Siswa($nis)
		{
			$tDaftar_Pembayaran_Siswa = $this->db->query("SELECT * from siswa_bayar where nis='$nis' order by tanggal DESC");
			return $tDaftar_Pembayaran_Siswa;
		}
		function Daftar_Macam_Pembayaran_Aktif()
		{
			$tDaftar_Macam_Pembayaran = $this->db->query("SELECT * from m_uang where status='1' order by nama");
			return $tDaftar_Macam_Pembayaran;
		}
		function Simpan_Data_Pembayaran_Siswa($in)
		{
			$this->db->insert('siswa_bayar',$in);
		}
		function Hapus_Pembayaran_Siswa($id)
		{
			$this->db->where('id_siswa_bayar',$id);
			$this->db->delete('siswa_bayar');
		}
		function Daftar_Tingkat()
		{
			$tDaftar_Tingkat = $this->db->query("SELECT * from m_kelas order by kelas");
			return $tDaftar_Tingkat;
		}
		function Daftar_Nilai_Pembayaran($thnajaran)
		{
			$tDaftar_Nilai_Pembayaran = $this->db->query("SELECT * from `m_uang_besar` where thnajaran='$thnajaran' order by tingkat, macam_pembayaran ASC");
			return $tDaftar_Nilai_Pembayaran;
		}
		function Cek_Set_Uang($thnajaran,$tingkat,$macam_pembayaran)
		{
			$tset = $this->db->query("SELECT * from m_uang_besar where thnajaran='$thnajaran' and tingkat='$tingkat' and macam_pembayaran='$macam_pembayaran'");
			return $tset;
		}
		function Simpan_Set_Uang($thnajaran,$tingkat,$macam_pembayaran,$besar,$sudahadaset)
		{
			if ($sudahadaset==0)
			{
				$this->db->query("INSERT INTO `m_uang_besar` (`thnajaran`, `macam_pembayaran`, `besar`, `tingkat`) VALUES ('$thnajaran', '$macam_pembayaran', '$besar', '$tingkat')");
			}
			else
			{
			$this->db->query("update `m_uang_besar` set besar = '$besar' where thnajaran = '$thnajaran' and tingkat = '$tingkat' and macam_pembayaran = '$macam_pembayaran'");
			}
		}
		function Daftar_Ruang()
		{
			$tDaftar_Ruang = $this->db->query("SELECT * from m_ruang order by ruang");
			return $tDaftar_Ruang;
		}
		function Tampil_Data_Hari_Ini($tglhariini)
		{
			$tDaftar_Ruang = $this->db->query("SELECT * from siswa_bayar where tanggal='$tglhariini'");
			return $tDaftar_Ruang;
		}
		function Daftar_Besar_Pembayaran($tingkat,$thnajaran)
		{
			$tDaftar_Besar_Pembayaran = $this->db->query("SELECT * from `m_uang_besar` where tingkat='$tingkat' and `thnajaran`='$thnajaran' order by `nomor_urut`");
			return $tDaftar_Besar_Pembayaran;
		}
		function Cari_Tingkat($kelas)
		{
			$tCari_Tingkat = $this->db->query("SELECT * from m_ruang where ruang='$kelas'");
			return $tCari_Tingkat;
		}
		function Detil_Macam_Pembayaran($id)
		{
			$tcarisiswa=$this->db->query("select * from `m_uang_besar` where `id_uang_besar`='$id'");
			return $tcarisiswa;
		}
		function Daftar_Pembayaran_Siswa_Thnajaran($nis,$thnajaran)
		{
			$tDaftar_Pembayaran_Siswa = $this->db->query("SELECT * from siswa_bayar where nis='$nis' and `thnajaran`='$thnajaran' order by tanggal DESC");
			return $tDaftar_Pembayaran_Siswa;
		}
		function Tampil_Semua_Transaksi_Per_Thnajaran($thnajaran,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tahun1 = substr($thnajaran,0,4);
			$tahun2 = $tahun1 + 1;
			$urutan = 1;
			$where = '';
			do
			{
				$bulan = $urutan + 6;
				if ($urutan > 6)
				{
					$bulan = $urutan - 6;
				}
				if ($bulan<10)
				{
					$bulane = '0'.$bulan;
				}
				else
				{
					$bulane = $bulan;
				}
				if ($urutan > 6)
				{
					$thnbln = $tahun2.'-'.$bulane.'%';
				}
				else
				{
					$thnbln = $tahun1.'-'.$bulane.'%';
				}
				if(empty($where))
				{
					$where .= '`tanggal` like \''.$thnbln.'\'';
				}
				else
				{
					$where .= 'or `tanggal` like \''.$thnbln.'\'';
				}

				$urutan++;
			}
			while($urutan<13);
			$t=$this->db->query("select * from `tblkeluar` where $where order by `tanggal` DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Semua_Transaksi_Per_Thnajaran($thnajaran)
		{
			$tahun1 = substr($thnajaran,0,4);
			$tahun2 = $tahun1 + 1;
			$urutan = 1;
			$where = '';
			do
			{
				$bulan = $urutan + 6;
				if ($urutan > 6)
				{
					$bulan = $urutan - 6;
				}
				if ($bulan<10)
				{
					$bulane = '0'.$bulan;
				}
				else
				{
					$bulane = $bulan;
				}
				if ($urutan > 6)
				{
					$thnbln = $tahun2.'-'.$bulane.'%';
				}
				else
				{
					$thnbln = $tahun1.'-'.$bulane.'%';
				}
				if(empty($where))
				{
					$where .= '`tanggal` like \''.$thnbln.'\'';
				}
				else
				{
					$where .= 'or `tanggal` like \''.$thnbln.'\'';
				}

				$urutan++;
			}
			while($urutan<13);
			$t=$this->db->query("select * from `tblkeluar` where $where order by `tanggal`");
			return $t;
		}

	function Tambah_Pengeluaran($input)
	{
		$this->db->insert('tblkeluar',$input);
	}
	function Hapus_Pengeluaran($id)
		{
			$this->db->where('id_keluar',$id);
			$this->db->delete('tblkeluar');
		}
	function Tampil_Pengeluaran($id)
	{
		$t=$this->db->query("select * from `tblkeluar` where `id_keluar`='$id'");
		return $t;
	}
	function Perbarui_Pengeluaran($in)
	{
		$this->db->where('id_keluar',$in['id_keluar']);
		$this->db->update('tblkeluar',$in);
	}
	function Kas_Masuk($tanggale,$sumbere)
	{
		$t=$this->db->query("select * from `siswa_bayar` where `macam_pembayaran` like '%$sumbere%' and `tanggal` = '$tanggale' order by tanggal" );
		return $t;
	}
	function Kas_Keluar($tahun,$bulan,$sumbere)
	{
		if($bulan<10)
		{
			$bulan = '0'.$bulan;
		}
		$tanggale = $tahun.'-'.$bulan;
		$t=$this->db->query("select * from `tblkeluar` where `sumber`='$sumbere' and `tanggal` like '$tanggale%' order by tanggal" );
		return $t;
	}
	function Tampil_Data_Keluar_Hari_Ini($tglhariini)
	{
		$tDaftar_Ruang = $this->db->query("SELECT * from `tblkeluar` where tanggal='$tglhariini'");
		return $tDaftar_Ruang;
	}
	function Tampil_Semua_Penerimaan_Lain($limit,$ofset)
	{
		$ofset = $ofset * 1;
		$t=$this->db->query("select * from `tblpenerimaan` order by `tanggal` DESC LIMIT $ofset,$limit");
		return $t;
	}
	function Total_Semua_Penerimaan_Lain()
	{
		$t=$this->db->query("select * from `tblpenerimaan` order by `tanggal`");
		return $t;
	}
	function Tambah_Penerimaan_Lain($input)
	{
		$this->db->insert('tblpenerimaan',$input);
	}
	function Perbarui_Penerimaan_Lain($in)
	{
		$this->db->where('id_penerimaan',$in['id_penerimaan']);
		$this->db->update('tblpenerimaan',$in);
	}
	function Tampil_Penerimaan($id)
	{
		$t=$this->db->query("select * from `tblpenerimaan` where `id_penerimaan`='$id'");
		return $t;
	}
	function Hapus_Penerimaan($id)
	{
		$this->db->where('id_penerimaan',$id);
		$this->db->delete('tblpenerimaan');
	}
	function Kas_Penerimaan($tanggale,$sumbere)
	{
		$t=$this->db->query("select * from `tblpenerimaan` where `jenis` = '$sumbere' and `tanggal` = '$tanggale' order by tanggal" );
		return $t;
	}
	function Daftar_Macam_Pengeluaran()
	{
		$tDaftar_Macam_Pembayaran=$this->db->query("select * from m_jenis_pengeluaran order by `jenis` ASC");
		return $tDaftar_Macam_Pembayaran;
	}
	function Macam_Pengeluaran($kd)
		{
			$data = array();
			$ta =$this->db->query("select * from `m_jenis_pengeluaran` where `id_jenis`='$kd'");
			foreach($ta->result() as $a)
			{
				$data[0] = $a->jenis;
				$data[1] = $a->sumber;
			}
			return $data;
		}
	function Simpan_Macam_Pengeluaran($in)
	{
		if(empty($in['id_jenis']))
			{$this->db->insert('m_jenis_pengeluaran',$in);
			}
			else
			{
			$this->db->where('id_jenis',$in['id_jenis']);
			$this->db->update('m_jenis_pengeluaran',$in);
			}
	}
	function Pilih_Jenis_Pengeluaran($sumbere)
	{
		$macam="<option value=''>--pilih--</option>";
		$this->db->order_by('jenis','ASC');
		$tmacam = $this->db->get_where('m_jenis_pengeluaran',array('sumber'=>$sumbere));
		foreach ($tmacam->result_array() as $data ){
			$macam.= "<option value='$data[jenis]'>$data[jenis]</option>";
		}
		return $macam;
	}
	function Tampil_Semua_Transaksi($limit,$ofset)
	{
		$ofset = $ofset * 1;
		$t=$this->db->query("select * from `tblkeluar` order by `tanggal` DESC LIMIT $ofset,$limit");
		return $t;
	}
	function Total_Semua_Transaksi()
	{
		$t=$this->db->query("select * from `tblkeluar` order by `tanggal`");
		return $t;
	}
	function Simpan_Data_Pembayaran_Non_Komite_Siswa($in)
	{
		$this->db->insert('non_komite_bayar',$in);
	}
	function Daftar_Pembayaran_Non_Komite_Siswa($nis)
	{
		$tDaftar_Pembayaran_Siswa = $this->db->query("SELECT * from `non_komite_bayar` where nis='$nis' order by tanggal DESC");
		return $tDaftar_Pembayaran_Siswa;
	}
	function Hapus_Pembayaran_Non_Komite_Siswa($id)
	{
		$this->db->where('id_siswa_bayar',$id);
		$this->db->delete('non_komite_bayar');
	}
} //akhir fungsi
