<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: situs_model.php
// Lokasi      		: application/models
// Terakhir diperbarui	: Sen 16 Mei 2016 22:26:38 WIB 
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
class Situs_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
	
		function Daftar_Kategori_Berita()
		{
			$query_kategori=$this->db->query("select * from tblkategori");
			return $query_kategori;
		}
		function Daftar_Kategori_Download()
		{
			$query_kategori_download=$this->db->query("select * from tblkategoridownload");
			return $query_kategori_download;
		}
		function Daftar_Kategori_Materi()
		{
			$query_kategori_tutorial=$this->db->query("select * from tblkategoritutorial");
			return $query_kategori_tutorial;
		}
		function Slide_Berita()
		{
			$query_berita=$this->db->query("SELECT tblberita.id_berita, tblberita.judul_berita, tblberita.isi, tblberita.gambar, tblberita.waktu, tblberita.tanggal, 
			tblkategori.nama_kategori from tblberita left outer join tblkategori on tblberita.id_kategori=tblkategori.id_kategori where `terbit`='1' order by id_berita DESC LIMIT 4");
			return $query_berita;
		}
		function Tampil_Materi()
		{
			$query_tutorial=$this->db->query("SELECT tbltutorial.id_tutorial, tbltutorial.judul_tutorial, tbltutorial.isi, tbltutorial.gambar, tbltutorial.waktu, tbltutorial.tanggal, tblkategoritutorial.nama_kategori from tbltutorial left outer join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial and `status`='1' order by id_tutorial DESC LIMIT 4");
			return $query_tutorial;

		}
		function Detail_Berita($id_berita)
		{
			$id_berita = $this->db->escape($id_berita);
			$query_detail_berita=$this->db->query("SELECT tblberita.counter, tblberita.author, tblberita.id_berita, tblberita.judul_berita, tblberita.isi, tblberita.gambar, tblberita.waktu, tblberita.tanggal, tblkategori.id_kategori, tblkategori.nama_kategori from tblberita left outer join tblkategori on tblberita.id_kategori=tblkategori.id_kategori where id_berita=$id_berita and `terbit`='1'");
			return $query_detail_berita;
		}
		function Detail_Tutorial($id_tutorial)
		{
			$id_tutorial = $this->db->escape($id_tutorial);
			$query_detail_tutorial=$this->db->query("SELECT tbltutorial.author, tbltutorial.id_tutorial, tbltutorial.judul_tutorial, tbltutorial.isi, tbltutorial.gambar, tbltutorial.waktu, tbltutorial.tanggal, tblkategoritutorial.nama_kategori, tblkategoritutorial.id_kategori_tutorial, tbltutorial.counter from tbltutorial left outer join
			tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where id_tutorial=$id_tutorial and `status`='1'");
			return $query_detail_tutorial;
		}
		function Kategori_Berita($id_kategori,$ofset,$batas)
		{
			$ofset = $ofset * 1;
			$id_kategori = $this->db->escape($id_kategori);
			$query_kat_berita=$this->db->query("SELECT tblberita.id_berita, tblberita.judul_berita, tblberita.isi, tblberita.gambar, 
			tblberita.waktu, tblberita.tanggal, tblkategori.nama_kategori from tblberita left outer join tblkategori on 
			tblberita.id_kategori=tblkategori.id_kategori where tblberita.id_kategori=$id_kategori order by id_berita DESC LIMIT $ofset,$batas");
			return $query_kat_berita;
		}
		function Total_Berita($id_kategori)
		{
			$id_kategori = $this->db->escape($id_kategori);
			$query_kat_berita=$this->db->query("SELECT tblberita.id_berita, tblberita.judul_berita, tblberita.isi, tblberita.gambar, 
			tblberita.waktu, tblberita.tanggal, tblkategori.nama_kategori from tblberita left outer join tblkategori on 
			tblberita.id_kategori=tblkategori.id_kategori where tblberita.id_kategori=$id_kategori order by id_berita DESC");
			return $query_kat_berita;
		}
		function Kategori_Tutorial($id_kategori,$ofset,$batas)
		{
			$ofset = $ofset * 1;
			$id_kategori = $this->db->escape($id_kategori);
			$query_kat_tutorial=$this->db->query("SELECT tbltutorial.id_tutorial, tbltutorial.judul_tutorial, tbltutorial.isi, 
			tbltutorial.gambar, tbltutorial.waktu, tbltutorial.tanggal, tblkategoritutorial.nama_kategori from tbltutorial left outer join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where tbltutorial.id_kategori_tutorial=$id_kategori and `status`='1' order by id_tutorial DESC LIMIT $ofset,$batas");
			return $query_kat_tutorial;
		}
		function Total_Tutorial($id_kategori)
		{
			$query_kat_tutorial=$this->db->query("SELECT tbltutorial.id_tutorial, tbltutorial.judul_tutorial, tbltutorial.isi, 
			tbltutorial.gambar, tbltutorial.waktu, tbltutorial.tanggal, tblkategoritutorial.nama_kategori from tbltutorial left outer join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where tbltutorial.id_kategori_tutorial='$id_kategori' and `status`='1' order by id_tutorial DESC");
			return $query_kat_tutorial;
		}
		function Berita_Acak($id_berita)
		{
			$id_berita = $this->db->escape($id_berita);
			$query_berita=$this->db->query("SELECT * from tblberita where id_berita!=$id_berita order by RAND() LIMIT 5");
			return $query_berita;
		}
		function Tutorial_Acak($id_tutorial)
		{
			$id_tutorial = $this->db->escape($id_tutorial);
			$query_tutorial=$this->db->query("SELECT * from tbltutorial where id_tutorial!=$id_tutorial and `status`='1' order by RAND() LIMIT 5");
			return $query_tutorial;
		}
		function Tampil_Polling()
		{
			$query_poll=$this->db->query("select * from `tblsoalpolling` where status='Y'");
			return $query_poll;
		}
		function Tampil_Soal_Polling($id_soal)
		{
			$query_soal=$this->db->query("select * from tbljawabanpoll where id_soal_poll='$id_soal'");
			return $query_soal;
		}
		function Update_Counter_Berita($id_berita)
		{
			$id_berita = $this->db->escape($id_berita);
			$query_update=$this->db->query("update tblberita set counter=counter+1 where id_berita=$id_berita");
			return $query_update;
		}
		function Berita_Populer()
		{
			$query_populer=$this->db->query("select tblberita.id_berita, tblberita.judul_berita, tblberita.counter from tblberita 
			order by counter
			DESC limit 6");
			return $query_populer;
		}
		function Update_Counter_Tutorial($id_tutorial)
		{
			$query_update=$this->db->query("update tbltutorial set counter=counter+1 where id_tutorial='$id_tutorial'");
			return $query_update;
		}

		function Tutorial_Populer()
		{
			$query_populer=$this->db->query("select tbltutorial.id_tutorial, tbltutorial.judul_tutorial, tbltutorial.counter from 
			tbltutorial where `status`='1' order by counter DESC limit 5");
			return $query_populer;
		}
		function Simpan_Data($datainput)
		{
			$datainput = $this->db->escape($datainput);
			$this->db->insert('tblkomentarberita',$datainput);
		} 
		function Judul_Kategori_Berita($id_kategori)
		{
			$id_kategori = $this->db->escape($id_kategori);
			$query_kategori=$this->db->query("select * from tblkategori where id_kategori=$id_kategori");
			return $query_kategori;
		}
		function Judul_Kategori_Tutorial($id_kategori)
		{
			$id_kategori = $this->db->escape($id_kategori);
			$query_kategori=$this->db->query("select * from tblkategoritutorial where id_kategori_tutorial=$id_kategori");
			return $query_kategori;
		}
		function Tampil_Agenda_Terbaru($batas,$ofset)
		{
			$ofset = $ofset * 1;
			$query_agenda=$this->db->query("select * from tblagenda order by id_agenda DESC LIMIT $ofset,$batas");
			return $query_agenda;
		}
		function Total_Agenda()
		{
			$query_total=$this->db->query("select * from tblagenda");
			return $query_total;
		}
		function Detail_Agenda($id_agenda)
		{
			$id_agenda = $this->db->escape($id_agenda);
			$query_detail=$this->db->query("select * from tblagenda where id_agenda=$id_agenda");
			return $query_detail;
		}
		function Tampil_Pengumuman_Terbaru($batas,$ofset)
		{
			$ofset = $ofset * 1;
			$query_pengumuman=$this->db->query("select * from tblpengumuman left join tbllogin on tblpengumuman.penulis=tbllogin.username order by id_pengumuman DESC LIMIT $ofset,$batas");
			return $query_pengumuman;
		}
		function Total_Pengumuman()
		{
			$query_total=$this->db->query("select * from tblpengumuman");
			return $query_total;
		}
		function Detail_Pengumuman($id_pengumuman)
		{
			$id_pengumuman = $this->db->escape($id_pengumuman);
			$query_pengumuman=$this->db->query("select * from tblpengumuman left join tbllogin on tblpengumuman.penulis=tbllogin.username where id_pengumuman=$id_pengumuman");
			return $query_pengumuman;
		}
		function Pencarian($kata_kunci,$tabel)
		{
			if ((!empty($kata_kunci)) and (!empty($tabel)))
				{
				$kata_kunci = preg_replace("/'/","",$kata_kunci);
				$query_cari=$this->db->query("select * from `$tabel` where `isi` like '%$kata_kunci%'");
				}
				else
				{
				$query_cari=$this->db->query("select * from `tblberita` where `isi`='dasdasdsersdfsdfsdfsdf'");
				}


			return $query_cari;
		}
		function Update_Polling($id_poll)
		{
			$id_poll = $this->db->escape($id_poll);
			$query_update=$this->db->query("update tbljawabanpoll set counter=counter+1 where id_jawaban_poll=$id_poll");
			return $query_update;
		}
		function Daftar_Semua_Guru($batas,$ofset)
		{
			$ofset = $ofset * 1;
			$query_guru=$this->db->query("select * from `p_pegawai` where `guru`='Y' order by nama ASC LIMIT $ofset,$batas");
			return $query_guru;
		}
		function Total_Semua_Guru_Aktif()
		{
			$query_jumlah=$this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by nama_tanpa_gelar");
			return $query_jumlah;
		}
		function Kategori_Download($id_kat,$ofset,$batas)
		{
			$ofset = $ofset * 1;
			$id_kat = $this->db->escape($id_kat);
			$query_kat=$this->db->query("select * from tbldownload where tbldownload.id_kat=$id_kat order by tbldownload.id_download DESC LIMIT $ofset,$batas");
			return $query_kat;
		}
		function Total_Kat_Down($id_kat)
		{
			$id_kat = $this->db->escape($id_kat);
			$query_total=$this->db->query("select * from tbldownload where id_kat=$id_kat");
			return $query_total;
		}
		function Judul_Kat_Down($id_kat)
		{
			$id_kat = $this->db->escape($id_kat);
			$query_kategori=$this->db->query("select * from tblkategoridownload where id_kategori_download=$id_kat");
			return $query_kategori;
		}
		function Data_Login($user)
		{
			$query=$this->db->query("select * from tbllogin where username='$user' and aktif='Y'");
			return $query;
		}
		function Status_User($user)
		{
			$aktif = '';
			$query=$this->db->query("select * from `tbllogin` where `username` = '$user'");
			foreach($query->result() as $q)
			{
				$aktif = $q->aktif;
			}
			return $aktif;
		}

		function Update_Password($nim,$pwd)
		{
			$nim = $this->db->escape($nim);
			$pwd = $this->db->escape($pwd);
			$this->db->query("update tbllogin set psw=$pwd where username=$nim");
		}
		function Simpan_Pesan_Admin($input)
		{
			$this->db->insert('tblinbox',$input);
		}
		function Simpan_Pesan_Guru($input)
		{
			$this->db->insert('tblinbox',$input);
		}
		function Inbox_Mhs($id_milik)
		{
			$id_milik = $this->db->escape($id_milik);
			$inbox=$this->db->query("select * from tblinbox left join tbllogin on tblinbox.username=tbllogin.username where tujuan=$id_milik");
			return $inbox;
		}
		function Daftar_Login_Semua_Guru()
		{
			$daftar=$this->db->query("select * from tbllogin where status='PA'");
			return $daftar;
		}
		function Detail_Pesan($user,$id_inbox)
		{
			$mentah=base64_decode($id_inbox);
			$pecah=explode("9002",$mentah);
			$id=$pecah[1];
			$daftar=$this->db->query("select * from tblinbox left join tbllogin on tblinbox.username=tbllogin.username where tblinbox.username='$user' and id_inbox='$id'");
			return $daftar;
		}
		function Update_Pesan($id_inbox)
		{
			$mentah=base64_decode($id_inbox);
			$pecah=explode("9002",$mentah);
			$id=$pecah[1];
			$this->db->query("update tblinbox set status_pesan='Y' where id_inbox='$id'");
		}
		function Delete_Pesan($id_in)
		{
			$mentah=base64_decode($id_in);
			$pecah=explode("9002",$mentah);
			$id=$pecah[1];
			$this->db->where('id_inbox',$id);
			$this->db->delete('tblinbox');
		}

		function Daftar_Kategori_Profil()
		{
			$query_kategori=$this->db->query("select * from tblkategoriprofil");
			return $query_kategori;
		}

		function Profil_Acak($id_profil)
		{
			$id_profil = $this->db->escape($id_profil);
			$query_berita=$this->db->query("SELECT * from tblprofil where id_berita!=$id_profil order by RAND() LIMIT 5");
			return $query_berita;
		}

		function Kategori_Profil($id_kategori,$ofset,$batas)
		{
			$ofset = $ofset * 1;
			$id_kategori = $this->db->escape($id_kategori);
			$query_kat_profil=$this->db->query("SELECT tblprofil.id_berita, tblprofil.judul_berita, tblprofil.isi, tblprofil.gambar, 
			tblprofil.waktu, tblprofil.tanggal, tblkategoriprofil.nama_kategori from tblprofil left outer join tblkategoriprofil on 
			tblprofil.id_kategori=tblkategoriprofil.id_kategori where tblprofil.id_kategori=$id_kategori  order by id_berita DESC LIMIT $ofset,$batas");
			return $query_kat_profil;
		}
		function Total_Profil($id_kategori)
		{
			$query_kat_profil=$this->db->query("SELECT tblprofil.id_berita, tblprofil.judul_berita, tblprofil.isi, tblprofil.gambar, 
			tblprofil.waktu, tblprofil.tanggal, tblkategoriprofil.nama_kategori from tblprofil left outer join tblkategoriprofil on 
			tblprofil.id_kategori=tblkategoriprofil.id_kategori where tblprofil.id_kategori='$id_kategori' order by id_berita DESC");
			return $query_kat_profil;
		}
		function Detail_Profil($id_berita)
		{
			$query_detail_profil=$this->db->query("SELECT tblprofil.counter, tblprofil.id_berita, tblprofil.judul_berita, tblprofil.isi, tblprofil.gambar, tblprofil.waktu, tblprofil.tanggal, tblkategoriprofil.id_kategori, tblkategoriprofil.nama_kategori from tblprofil left outer join tblkategoriprofil on tblprofil.id_kategori=tblkategoriprofil.id_kategori where id_berita='$id_berita'");
			return $query_detail_profil;
		}
		function Judul_Kategori_Profil($id_kategori)
		{
			$query_kategori=$this->db->query("select * from tblkategoriprofil where id_kategori='$id_kategori'");
			return $query_kategori;
		}
		function Update_Counter_Profil($id_tutorial)
		{
			$query_update=$this->db->query("update tblprofil set counter=counter+1 where id_berita='$id_tutorial'");
			return $query_update;
		}

		function Berita_Utama()
		{
			$Id_Berita_Utama=$this->db->query("SELECT * from tblberitautama ");
			return $Id_Berita_Utama;
		}
		function Tampil_Berita_Utama($id)
		{
			$Tampil_Berita_Utama=$this->db->query("SELECT tblberita.penuh, tblberita.id_berita, tblberita.judul_berita, tblberita.isi, tblberita.gambar, tblberita.waktu, tblberita.tanggal, 
			tblkategori.nama_kategori from tblberita left outer join tblkategori on tblberita.id_kategori=tblkategori.id_kategori where tblberita.id_berita='$id' and `tblberita`.`terbit`='1'");
			return $Tampil_Berita_Utama;
		}
		function Tampil_Absensi_Terbatas()
		{
			$tahun = date("Y");
			$bulan = date("m");
			$tgl = date("d");
			$tanggalhariini = "$tahun-$bulan-$tgl";
			$Tampil_Absensi_Terbatas=$this->db->query("SELECT * from siswa_absensi where tanggal ='$tanggalhariini'");
			return $Tampil_Absensi_Terbatas;
		}
		function Tampil_Angka_Kredit_Terbatas()
		{
			$Tampil_Angka_Kredit_Terbatas=$this->db->query("SELECT * from siswa_kredit_total order by nilai DESC limit 20");
			return $Tampil_Angka_Kredit_Terbatas;
		}
		function Tampil_Absensi_Kemarin($thnajaran,$semester)
		{
			$tahun = date("Y");
			$bulan = date("m");
			$tgl = date("d");
			$tanggalhariini = "$tahun-$bulan-$tgl";
			$Tampil_Absensi_Kemarin=$this->db->query("SELECT * from siswa_absensi where tanggal !='$tanggalhariini' and `thnajaran`='$thnajaran' and `semester`='$semester' order by tanggal DESC limit 30");
			return $Tampil_Absensi_Kemarin;
		}
	function Tampil_Data_Umum_Pegawai($username) 
		{
		$tTampil_Data_Umum_Pegawai= $this->db->query("select * from p_pegawai where kd ='$username'");
		return $tTampil_Data_Umum_Pegawai;
		}
		function Tampil_Data_Siswa($username)
		{
			$tTampil_Data_Siswa=$this->db->query("select * from datsis where nis='$username'");
			return $tTampil_Data_Siswa;
		}
	function Kirim_SMS($nohp,$pengirim,$notujuan,$judul)
		{
			//
			$pesane = 'pesan dari '.$pengirim.', "'.$judul.'"';
			$tkirim_sms = $this->db->query("INSERT INTO `outbox` (`DestinationNumber`,`TextDecoded`) VALUES ('$notujuan','$pesane')");
			return $tkirim_sms;		
		}
	function Kirim_SMS_Guru($nohpguru,$pesan,$id_sms_user)
		{
			//
			$tkirim_sms = $this->db->query("INSERT INTO `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) VALUES ('$nohpguru','$pesan','$id_sms_user')");
			return $tkirim_sms;		
		}
		function Tampil_Materi_Acak()
		{
			$query_materi_acak=$this->db->query("SELECT * from tbltutorial where `status`='1' order by RAND() LIMIT 4");
			return $query_materi_acak;
		}
		function Tampil_Absensi_Situs($thnajaran,$semester,$batas,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Absensi_Situs=$this->db->query("SELECT * from siswa_absensi where (thnajaran='$thnajaran' and semester='$semester' and alasan='S' ) or (thnajaran='$thnajaran' and semester='$semester' and alasan='I' ) or (thnajaran='$thnajaran' and semester='$semester' and alasan='A' ) or (thnajaran='$thnajaran' and semester='$semester' and alasan='B' ) order by tanggal DESC LIMIT $ofset,$batas");
			return $Tampil_Absensi_Situs;
		}
		function Total_Absen($thnajaran,$semester)
		{
			$Total_Absen=$this->db->query("SELECT * from siswa_absensi where (thnajaran='$thnajaran' and semester='$semester' and alasan='S' ) or (thnajaran='$thnajaran' and semester='$semester' and alasan='I' ) or (thnajaran='$thnajaran' and semester='$semester' and alasan='A' ) or (thnajaran='$thnajaran' and semester='$semester' and alasan='B' )");
			return $Total_Absen;
		}

		function Reset_Password($masukan)
		{
			if (!empty($masukan))
				{
				if (substr($masukan,0,1)=="0")
					{
					$panjang =strlen($masukan);
					$sisa = $panjang-1;
					$nosel = substr($masukan,-$sisa);
					$masukan = "+62$nosel";
					}
				if (substr($masukan,0,1)=="8")
					{
					$panjang =strlen($masukan);
					$sisa = $panjang-1;
					$nosel = substr($masukan,-$sisa);
					$masukan = "+628$nosel";
					}
				}

			//siswa
				// username / nis

				$t = $this->db->query("select * from datsis where hp = '$masukan'");
				$username = '';
				$adat = $t->num_rows();
				foreach($t->result_array() as $d)
					{
					$username = $d['nis'];
					}

				if (empty($username))
				{
				//guru / pegawai
				// username / nip

				$t = $this->db->query("select * from p_pegawai where seluler='$masukan'");
				foreach($t->result_array() as $d)
					{
					$username = $d['kd'];
					}
				}
				if($adat >1)
				{
					$username = 'xxganda';
				}
			return $username;
		}
		function Nomor_Seluler($masukan)
		{
			//siswa
				// username / nis
				$noseluler ='';
				$t = $this->db->query("select * from datsis where nis='$masukan'");

				foreach($t->result_array() as $d)
					{
					$noseluler = $d['hp'];
					}
				if (empty($noseluler))
				{
				//guru / pegawai
				// username / nip
				$t = $this->db->query("select * from p_pegawai where kd = '$masukan'");
				foreach($t->result_array() as $d)
					{
					$noseluler = $d['seluler'];
					}
				}
			return $noseluler;
		}
		function Chat_Id($masukan)
		{
			//siswa
				// username / nis
				$chat_id ='';
				$t = $this->db->query("select * from datsis where nis='$masukan'");

				foreach($t->result_array() as $d)
					{
					$chat_id = $d['chat_id'];
					}
				if (empty($chat_id))
				{
				//guru / pegawai
				// username / nip
				$t = $this->db->query("select * from p_pegawai where kd = '$masukan'");
				foreach($t->result_array() as $d)
					{
					$chat_id = $d['chat_id'];
					}
				}
			return $chat_id;
		}
		function Nomor_Seluler_Siswa($masukan)
		{
			//siswa
				// username / nis

				$t = $this->db->query("select * from datsis where nis='$masukan'");
				foreach($t->result_array() as $d)
					{
					$noseluler = $d['hp'];
					}
			return $noseluler;
		}

		function Proses_Ganti_Password($datainput)
		{
		$this->db->insert('reset_password',$datainput);			
		}
		function Cek_Reset_Password($masukan)
		{
			$noseluler = '';
			$treset = $this->db->query("select * from reset_password where kode_reset='$masukan'");
			foreach($treset->result() as $dreset)
			{
				$noseluler = $dreset->noseluler;
			}
			return $noseluler;
		}
		function Seluler_Jadi_Username($noseluler)
		{
				//siswa
				// username / nis

				$t = $this->db->query("select * from datsis where hp='$noseluler'");
				foreach($t->result_array() as $d)
					{
					$username = $d['nis'];
					}
				if (empty($username))
				{
				//guru / pegawai
				// username / nip

				$t = $this->db->query("select * from p_pegawai where seluler = '$noseluler'");
				foreach($t->result_array() as $d)
					{
					$username = $d['kd'];
					}
				}
			return $username;

		}
		function Hapus_Reset($noseluler)
		{
			$this->db->where('noseluler',$noseluler);
			$this->db->delete('reset_password');
		}
	function Cek_Inbox($username)
		{
			$tdaftar=$this->db->query("select * from tblinbox where tujuan='$username' and status_pesan='N'");
			return $tdaftar;
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
	function Simpan_Saran($datainput)
		{
			$this->db->insert('tblsaran',$datainput);
		} 
		function Kodeguru_Jadi_Username($kodeguru)
		{
			$username = '';
			$t = $this->db->query("select * from p_pegawai where `kode` = '$kodeguru'");
			foreach($t->result_array() as $d)
			{
				$username = $d['kd'];
			}
			return $username;
		}
	function Kirim_SMS_Umum($notujuan,$pesan,$id_sms_user)
		{
			//
			$tkirim_sms = $this->db->query("INSERT INTO `outbox` (`DestinationNumber`,`TextDecoded`,`id_sms_user`) VALUES ('$notujuan','$pesan','$id_sms_user')");
			return $tkirim_sms;		
		}

	function Chat_ID_Siswa($masukan)
		{
			$chat_id = '';
			$t = $this->db->query("select * from datsis where nis='$masukan'");
			foreach($t->result_array() as $d)
			{
				$chat_id = $d['chat_id'];
			}
			return $chat_id;
		}

	}
?>
