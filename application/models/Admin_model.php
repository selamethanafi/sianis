<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: admin_model.php
// Lokasi      		: application/views/models
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
class Admin_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Tampil_Berita($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from tblberita left join tblkategori 
			on tblberita.id_kategori=tblkategori.id_kategori order by id_berita DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Berita()
		{
			$t=$this->db->query("select * from tblberita");
			return $t;
		}
		function Edit_Berita($id)
		{
			$t=$this->db->query("select * from tblberita left join tblkategori on tblberita.id_kategori=tblkategori.id_kategori where id_berita='$id'");
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
		function Berita_Utama($in)
		{
			$t=$this->db->query("select * from `tblberitautama`");
			$adat = $t->num_rows();
			if($adat==0)
			{
				$this->db->query("insert into `tblberitautama` (`id_berita`) values ('$in')");
			}
			else
			{
				$this->db->query("update tblberitautama set id_berita='$in' ");
			}

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
		function Simpan_Kat_Berita($in)
		{
			$kat=$this->db->insert('tblkategori',$in);
			return $kat;
		}
		function Edit_Kat_Berita($id)
		{
			$t=$this->db->query("select * from tblkategori where id_kategori='$id'");
			return $t;
		}
		function Update_Kat_Berita($in)
		{
			$this->db->where('id_kategori',$in['id_kategori']);
			$this->db->update('tblkategori',$in);
		}
		function Hapus_Kat_Berita($id)
		{
			$this->db->where('id_kategori',$id);
			$this->db->delete('tblkategori');
		}
		function Komen_Berita($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from tblkomentarberita left join tblberita
			on tblkomentarberita.id_berita=tblberita.id_berita order by id_komen_berita DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Komen_Berita()
		{
			$t=$this->db->query("select * from tblkomentarberita");
			return $t;
		}
		function Hapus_Komen_Berita($id)
		{
			$this->db->where('id_komen_berita',$id);
			$this->db->delete('tblkomentarberita');
		}
		
		function Tampil_Pengumuman($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$query_pengumuman=$this->db->query("select * from tblpengumuman left join tbllogin on tblpengumuman.penulis=tbllogin.username order by tanggal DESC LIMIT $ofset,$limit");
			return $query_pengumuman;
		}
		function Total_Pengumuman()
		{
			$t=$this->db->query("select * from tblpengumuman");
			return $t;
		}
		function Simpan_Pengumuman($in)
		{
			$kat=$this->db->insert('tblpengumuman',$in);
			return $kat;
		}
		function Edit_Pengumuman($id,$username)
		{
			$ed=$this->db->query("select * from tblpengumuman where id_pengumuman='$id'");
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
		function Tampil_Agenda($limit,$offset)
		{
			$offset = $offset * 1;
			$ta=$this->db->query("select * from tblagenda order by id_agenda DESC LIMIT $offset,$limit");
			return $ta;
		}
		function Total_Agenda()
		{
			$ta=$this->db->query("select * from tblagenda");
			return $ta;
		}
		function Simpan_Agenda($in)
		{
			$kat=$this->db->insert('tblagenda',$in);
			return $kat;
		}
		function Update_Agenda($in)
		{
			$this->db->where('id_agenda',$in['id_agenda']);
			$this->db->update('tblagenda',$in);
		}
		function Delete_Agenda($id)
		{
			$this->db->where('id_agenda',$id);
			$this->db->delete('tblagenda');
		}
		function Tampil_File($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from tbldownload left join tblkategoridownload on 	
			tbldownload.id_kat=tblkategoridownload.id_kategori_download order by id_download DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_File()
		{
			$t=$this->db->query("select * from tbldownload left join tblkategoridownload on 	
			tbldownload.id_kat=tblkategoridownload.id_kategori_download");
			return $t;
		}
		function Kat_Down()
		{
			$kat=$this->db->query("select * from tblkategoridownload order by id_kategori_download DESC");
			return $kat;
		}
		function Simpan_Upload($in)
		{
			$kat=$this->db->insert('tbldownload',$in);
			return $kat;
		}
		function Edit_Upload($id)
		{
			$t=$this->db->query("select * from tbldownload left join tblkategoridownload on 	
			tbldownload.id_kat=tblkategoridownload.id_kategori_download where id_download='$id'");
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
		function Simpan_Kat_Download($in)
		{
			$kat=$this->db->insert('tblkategoridownload',$in);
			return $kat;
		}
		function Edit_Kat_Download($id)
		{
			$t=$this->db->query("select * from tblkategoridownload where id_kategori_download='$id'");
			return $t;
		}
		function Update_Kat_Download($in)
		{
			$this->db->where('id_kategori_download',$in['id_kategori_download']);
			$this->db->update('tblkategoridownload',$in);
		}
		function Hapus_Kat_Download($id)
		{
			$this->db->where('id_kategori_download',$id);
			$this->db->delete('tblkategoridownload');
		}
		function Tampil_Tutorial($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from tbltutorial left join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial order by id_tutorial DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Tutorial()
		{
			$t=$this->db->query("select * from tbltutorial left join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial");
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
		function Edit_Tutorial($id)
		{
			$ed=$this->db->query("select * from tbltutorial left join tblkategoritutorial on tbltutorial.id_kategori_tutorial=tblkategoritutorial.id_kategori_tutorial where 				id_tutorial='$id'");
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
		function Tampil_Kat_Tutorial($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from tblkategoritutorial order by id_kategori_tutorial DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Simpan_Kat_Tutorial($in)
		{
			$kat=$this->db->insert('tblkategoritutorial',$in);
			return $kat;
		}
		function Edit_Kat_Tutorial($id)
		{
			$t=$this->db->query("select * from tblkategoritutorial where id_kategori_tutorial='$id'");
			return $t;
		}
		function Update_Kat_Tutorial($in)
		{
			$this->db->where('id_kategori_tutorial',$in['id_kategori_tutorial']);
			$this->db->update('tblkategoritutorial',$in);
		}
		function Hapus_Kat_Tutorial($id)
		{
			$this->db->where('id_kategori_tutorial',$id);
			$this->db->delete('tblkategoritutorial');
		}
		function Tampil_Inbox($user,$limit,$ofset)
		{
			$ofset = $ofset * 1;
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
			$mentah=base64_decode($id);
			$pecah=explode("9002",$mentah);
			$id2=$pecah[1];
			$t=$this->db->query("select * from tblinbox left join tbllogin on tblinbox.username=tbllogin.username where 
			tujuan='$user' AND id_inbox='$id2'");
			return $t;
		}
		function Update_Pesan($id_inbox)
		{
			$mentah=base64_decode($id_inbox);
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
		$u=$this->db->query("update tblinbox set pesan='$pesan' where id_inbox='$id'");
		return $u;
		}
		function Delete_Pesan($id_in)
		{
			$mentah=base64_decode($id_in);
			$pecah=explode("9002",$mentah);
			$id=$pecah[1];
			$this->db->where('id_inbox',$id);
			$this->db->delete('tblinbox');
		}
		function Polling($limit,$offset)
		{
			$offset = $offset * 1;
			$query_poll=$this->db->query("select * from tblsoalpolling  order by `id_soal_poll` DESC LIMIT $offset,$limit");
			return $query_poll;
		}
		function Total_Polling()
		{
			$query_poll=$this->db->query("select * from tblsoalpolling");
			return $query_poll;
		}
		function Tampil_Jwb_Polling($id_soal)
		{
			$query_soal=$this->db->query("select * from tbljawabanpoll where id_soal_poll='$id_soal'");
			return $query_soal;
		}
		function Hapus_Polling($id_soal)
		{
			$query_soal=$this->db->query("delete from `tblsoalpolling` where `id_soal_poll`='$id_soal'");
			return $query_soal;
		}
		function Edit_Polling($id)
		{
			$t=$this->db->query("select * from tblsoalpolling where id_soal_poll='$id'");
			return $t;
		}
		function Edit_Jawaban_Polling($id,$id_soal)
		{
			$djawabanpoll=$this->db->query("select * from tbljawabanpoll where id_jawaban_poll='$id' and `id_soal_poll`='$id_soal'");
			return $djawabanpoll;
		}

		function Update_Polling($in)
		{
			if($in['status'] == 'Y')
			{
				$this->db->query("update `tblsoalpolling` set `status`='T'");
			}
			$this->db->where('id_soal_poll',$in['id_soal_poll']);
			$this->db->update('tblsoalpolling',$in);
		}
		function Simpan_Polling($in)
		{
			if($in['status'] == 'Y')
			{
				$this->db->query("update `tblsoalpolling` set `status`='T'");
			}
			$poll=$this->db->insert('tblsoalpolling',$in);
			return $poll;
		}
		function Simpan_Jawaban_Polling($in)
		{
			$poll=$this->db->insert('tbljawabanpoll',$in);
			return $poll;
		}
		function Update_Jawaban_Polling($in)
		{
			$this->db->where('id_jawaban_poll',$in['id_jawaban_poll']);
			$this->db->update('tbljawabanpoll',$in);
		}
		function Tampil_Semua_Guru($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tampilsemuaguru=$this->db->query("select * from tbllogin where `status`='PA' order by nama ASC LIMIT $ofset,$limit");
			return $tampilsemuaguru;
		}

		function Tampil_Login_Guru($idlink)
		{
			$tampilloginguru=$this->db->query("select * from tbllogin where `status`='PA' and `idlink`='$idlink'");
			return $tampilloginguru;
		}

		function Total_Guru()
		{
			$t=$this->db->query("select * from tbllogin where `status`='PA'");
			return $t;
		}
		function Simpan_Login_Guru($username,$psw,$nama,$idlink)
		{
			$nama=$this->db->escape($nama);
			$username=$this->db->escape($username);
			$psw=$this->db->escape($psw);
			$simpanloginguru=$this->db->query("INSERT INTO `tbllogin` (`username` ,`psw` ,`nama` ,`status`,`idlink`) VALUES ($username, PASSWORD( $psw ) , $nama, 'PA','$idlink')");

			return $simpanloginguru;
		}
		function Update_Guru($username,$psw,$nama,$kodeguru,$idlink)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama', username='$username' where idlink='$idlink' and status='PA'");
				}
			if ((!empty($psw)) and (!empty($username)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', username='$username', psw=PASSWORD('$psw') where idlink='$idlink' and status='PA'");
				}

		}
		function Simpan_Guru($username,$nama,$kodeguru)
		{
			$nama=$this->db->escape($nama);
			$username=$this->db->escape($username);
			$kodeguru=$this->db->escape($kodeguru);
			$this->db->query("INSERT INTO `p_pegawai` (`kd` ,`kode` ,`nama` ,`guru`) VALUES ($username, $kodeguru, $nama, 'Y')");
			$tampilttdguru=$this->db->query("select * from p_pegawai where `kd`=$username");
			foreach($tampilttdguru->result() as $c1)
			{
				$idlink = $c1->id_p_pegawai;
			}
			return $idlink;
		}

		function Total_Siswa()
		{
			$t=$this->db->query("select * from tbllogin where `status`='Siswa'");
			return $t;
		}
		function Tampil_Semua_Siswa($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tampil_semua_siswa=$this->db->query("select * from tbllogin where status='Siswa' order by nama ASC LIMIT $ofset,$limit");
			return $tampil_semua_siswa;
		}
		function Total_Siswa_Aktif()
		{
			$t=$this->db->query("select * from tbllogin where `status`='Siswa' and aktif='Y'");
			return $t;
		}
		function Tampil_Semua_Siswa_Aktif($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$tampil_semua_siswa=$this->db->query("select * from tbllogin where status='Siswa' and aktif='Y' order by nama ASC LIMIT $ofset,$limit");
			return $tampil_semua_siswa;
		}

		function Cek_Baru($username)
		{
			$tampil_semua_siswa=$this->db->query("select * from tbllogin where `username`='$username'");
			return $tampil_semua_siswa;
		}
		function Add_Contact($param,$ada)
		{

			$username = $param['username'];
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kdkls = $param['kdkls'];
			$nama = $param['nama'];
			$aktif = $param['aktif'];
			$nama=$this->db->escape($nama);
			$psw = $param['username'];
			$idlink = $param['username'];
			// edit mode
			if ($aktif=='T')
				{
				$this->db->query("update datsis set `kdkls`='$kdkls', `ket`='T', `thnajaran`='$thnajaran', `semester`='$semester' where nis='$username'");
				}
			if ($aktif=='L')
				{
				$this->db->query("update datsis set `ket`='L', `kdkls`='$kdkls', `thnajaran`='$thnajaran', `semester`='$semester' where nis='$username'");
				}

			if ($aktif=='K')
				{
				$this->db->query("update datsis set `ket`='K', `kdkls`='$kdkls', `thnajaran`='$thnajaran', `semester`='$semester' where nis='$username'");
				}
			if ($aktif=='Y')
				{
				$this->db->query("update datsis set `kdkls`='$kdkls', `ket`='Y' where nis='$username'");
				}
			if ($aktif=='P')
				{
				$this->db->query("update datsis set `kdkls`='$kdkls', `ket`='P', `thnajaran`='$thnajaran', `semester`='$semester' where nis='$username'");
				}



			if($ada>0) 
			{
				$this->db->query("update tbllogin set `nama`=$nama, aktif='$aktif' where `username`='$username'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `tbllogin` (`username` ,`psw` ,`nama` ,`status` ,`idlink`) VALUES ('$username', PASSWORD( '$psw' ) , $nama, 'Siswa', '$idlink')");
			}

		}
		function Cek_Baru_Siswa_Kelas($thnajaran,$semester,$nis)
		{
			$tampil_semua_siswa_kelas=$this->db->query("select * from siswa_kelas where nis='$nis' and thnajaran='$thnajaran' and `semester`='$semester'");
			return $tampil_semua_siswa_kelas;
		}
		function Add_Siswa_Kelas($param,$ada)
		{

			$nis = $param['nis'];
			$kelas = $param['kelas'];
			$thnajaran = $param['thnajaran'];
			$status = $param['status'];
			$semester = $param['semester'];
			$no_urut = $param['no_urut'];
			if(isset($param['alasan_bsm']))
			{
				$alasan_bsm = $param['alasan_bsm'];
				$bsm = $param['bsm'];
			}
			else
			{
				$alasan_bsm = '';
				$bsm = '';

			}
			// edit mode
			if ($status=='T')
				{
				$this->db->query("update datsis set `ket`='T', `kdkls`='$kelas' where nis='$nis'");
				}
			if ($status=='Y')
				{
				$this->db->query("update datsis set `ket`='Y', `kdkls`='$kelas' where nis='$nis'");
				}

			if($ada>0) 
			{
				$this->db->query("update siswa_kelas set `kelas`='$kelas', `bsm`='$bsm', `alasan_bsm`='$alasan_bsm', `status`='$status', no_urut='$no_urut' where nis='$nis' and thnajaran='$thnajaran' and `semester`='$semester'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `siswa_kelas` (`thnajaran`,`kelas`,`nis`,`no_urut`,`status`, `semester`) VALUES ('$thnajaran', '$kelas', '$nis', '$no_urut','$status','$semester')");
			}

		}

		function Kat_Profil()
		{
			$kat=$this->db->query("select * from tblkategoriprofil order by id_kategori DESC");
			return $kat;
		}

		function Tampil_Profil($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from tblprofil left join tblkategoriprofil 
			on tblprofil.id_kategori=tblkategoriprofil.id_kategori order by id_berita DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Profil()
		{
			$t=$this->db->query("select * from tblprofil");
			return $t;
		}
		function Simpan_Profil($in)
		{
			$kat=$this->db->insert('tblprofil',$in);
			return $kat;
		}
		function Edit_Profil($id)
		{
			$t=$this->db->query("select * from tblprofil left join tblkategoriprofil on tblprofil.id_kategori=tblkategoriprofil.id_kategori where id_berita='$id'");
			return $t;
		}
		function Update_Profil($in)
		{
			$this->db->where('id_berita',$in['id_berita']);
			$this->db->update('tblprofil',$in);
		}
		function Hapus_Profil($id)
		{
			$this->db->where('id_berita',$id);
			$this->db->delete('tblprofil');
		}
		function Simpan_Kat_Profil($in)
		{
			$kat=$this->db->insert('tblkategoriprofil',$in);
			return $kat;
		}
		function Tampil_Semua_Pengajaran($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Pengajaran=$this->db->query("select * from tbllogin where status ='Pengajaran' LIMIT $ofset,$limit");
			return $Tampil_Semua_Pengajaran;
		}
		function Total_Pengajaran()
		{
			$Total_Pengajaran=$this->db->query("select * from tbllogin where status ='Pengajaran'");
			return $Total_Pengajaran;
		}
		function Tampil_Login_Pengajaran($idlink)
		{
			$tampilloginpengajaran=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginpengajaran;
		}
		function Update_Pengajaran($username,$psw,$nama)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama' where username='$username' and status='Pengajaran'");
				}
			if ((!empty($psw)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', psw=PASSWORD('$psw') where  username='$username' and status='Pengajaran'");
				}

		}
		function Tampil_Semua_Staf($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Staf=$this->db->query("select * from tbllogin where status ='admin' LIMIT $ofset,$limit");
			return $Tampil_Semua_Staf;
		}
		function Total_Staf()
		{
			$Total_Staf=$this->db->query("select * from tbllogin where status ='admin'");
			return $Total_Staf;
		}
		function Tampil_Login_Staf($idlink)
		{
			$tampilloginstaf=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginstaf;
		}
		function Update_Staf($username,$psw,$nama)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama' where username='$username' and status='admin'");
				}
			if ((!empty($psw)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', psw=PASSWORD('$psw') where  username='$username' and status='admin'");
				}

		}
		function Kelas_Jadi_Program_Tingkat($kelas)
		{
			$tKelas_Jadi_Program=$this->db->query("select * from m_ruang where ruang='$kelas'");
			return $tKelas_Jadi_Program;
		}
		function Tampil_Semua_Tahun()
		{
			$tTampil_Semua_Tahun=$this->db->query("select * from m_tapel order by thnajaran DESC");
			return $tTampil_Semua_Tahun;
		}

		function Tampil_Semua_Kelas()
		{
			$tTampil_Semua_Kelas=$this->db->query("select * from m_ruang order by ruang ASC");
			return $tTampil_Semua_Kelas;
		}
		function Tampil_Siswa_Kelas($thnajaran,$semester,$kelas)
		{
			$tTampil_Siswa_Kelas=$this->db->query("select * from `siswa_kelas` where thnajaran='$thnajaran' and `semester`='$semester' and kelas='$kelas' order by no_urut ASC");
			return $tTampil_Siswa_Kelas;
		}
		function Tampil_Semua_Kepala($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Kepala=$this->db->query("select * from m_kepala order by thnajaran DESC,semester DESC LIMIT $ofset,$limit");
			return $Tampil_Semua_Kepala;
		}
		function Total_Semua_Kepala()
		{
			$Total_Semua_Kepala=$this->db->query("select * from m_kepala ");
			return $Total_Semua_Kepala;
		}
		function Semua_Guru()
		{
			$t=$this->db->query("select * from `p_pegawai` where `guru`='Y' order by nama");
			return $t;
		}
		function Cek_Kepala($thnajaran,$semester)
		{
			$totalkepala=$this->db->query("select * from m_kepala where thnajaran='$thnajaran' and semester='$semester'");
			return $totalkepala;
		}
		function Tampil_Data_Kepala($id)
		{
			$Tampil_Data_Kepala=$this->db->query("select * from m_kepala where id_kepala='$id'");
			return $Tampil_Data_Kepala;
		}

		function Simpan_Kepala($in)
		{
			$this->db->insert('m_kepala',$in);
		}
		function Tampil_Wali_Kelas($thnajaran)
		{
			$tTampil_Wali_Kelas=$this->db->query("select * from m_walikelas where thnajaran='$thnajaran'");
			return $tTampil_Wali_Kelas;
		}
		function Cek_Walikelas($thnajaran,$semester,$kelas)
		{
			$tCek_Walikelas=$this->db->query("select * from m_walikelas where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
			return $tCek_Walikelas;
		}
		function Add_Walikelas($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$kodeguru = $param['kodeguru'];
			// edit mode

			if($ada>0) 
			{
				$this->db->query("update m_walikelas set kodeguru='$kodeguru' where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `m_walikelas` (`thnajaran` ,`semester` ,`kelas` ,`kodeguru`) VALUES ('$thnajaran', '$semester', '$kelas','$kodeguru')");
			}

		}
		function Tampil_Nilai_Kepribadian_Per_Kelas($thnajaran,$semester,$kelas)
		{
			$tTampil_Nilai_Kepribadian_Per_Kelas=$this->db->query("select * from kepribadian where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
			return $tTampil_Nilai_Kepribadian_Per_Kelas;
		}
		function Cek_Nilai_Akhlak($thnajaran,$semester,$nis)
		{
			$tCek_Nilai_Akhlak=$this->db->query("select * from kepribadian where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			return $tCek_Nilai_Akhlak;
		}
		function Add_Nilai_Akhlak($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$nama = $param['nama'];
			$sakit = $param['sakit'];
			$izin = $param['izin'];
			$tanpa_keterangan = $param['tanpa_keterangan'];
			$terlambat = $param['terlambat'];
			$membolos = $param['membolos'];
			$angka_kredit = $param['angka_kredit'];
			$satu = $param['satu'];
			$dua = $param['dua'];
			$tiga = $param['tiga'];
			$empat = $param['empat'];
			$lima = $param['lima'];
			$enam = $param['enam'];
			$tujuh = $param['tujuh'];
			$delapan = $param['delapan'];
			$sembilan = $param['sembilan'];
			$sepuluh = $param['sepuluh'];
			$kom1 = $param['kom1'];
			$kom2 = $param['kom2'];	
			$kom3 = $param['kom3'];
			$kom4 = $param['kom4'];	
			$kom5 = $param['kom5'];
			$kom6 = $param['kom6'];	
			$kom7 = $param['kom7'];
			$kom8 = $param['kom8'];	
			$kom9 = $param['kom9'];
			$kom10 = $param['kom10'];
	
			// edit mode

			if($ada>0) 
			{
				$this->db->query("update kepribadian set sakit = '$sakit', izin = '$izin', tanpa_keterangan = '$tanpa_keterangan', membolos = '$membolos', terlambat='$terlambat', angka_kredit = '$angka_kredit', satu = '$satu', dua = '$dua', tiga = '$tiga', empat = '$empat', lima = '$lima', enam = '$enam', tujuh = '$tujuh', delapan = '$delapan', sembilan = '$sembilan', sepuluh = '$sepuluh', kom1 = '$kom1', kom2 = '$kom2', kom3 = '$kom3', kom4 = '$kom4', kom5 = '$kom5', kom6 = '$kom6', kom7 = '$kom7', kom8 = '$kom8', kom9 = '$kom9', kom10 = '$kom10' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `kepribadian` (`thnajaran` ,`semester` ,`kelas` ,`nis` ,`nama`, `sakit`, `izin`, `tanpa_keterangan`, `membolos`, `terlambat`,`angka_kredit`,`satu`, `dua`, `tiga`, `empat`, `lima`, `enam`, `tujuh`, `delapan`, `sembilan`, `sepuluh`, `kom1`, `kom2`, `kom3`, `kom4`, `kom5`, `kom6`, `kom7`, `kom8`, `kom9`, `kom10`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$nama', '$sakit', '$izin', '$tanpa_keterangan', '$membolos', '$terlambat','$angka_kredit','$satu', '$dua', '$tiga', '$empat', '$lima', '$enam', '$tujuh', '$delapan', '$sembilan', '$sepuluh', '$kom1', '$kom2', '$kom3', '$kom4', '$kom5', '$kom6', '$kom7', '$kom8', '$kom9', '$kom10')");
			}

		}

		function Tampil_Nilai_Ekstra_Per_Kelas($thnajaran,$semester,$kelas)
		{
			$tTampil_Nilai_Ekstra_Per_Kelas=$this->db->query("select * from ekstrakurikuler where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas'");
			return $tTampil_Nilai_Ekstra_Per_Kelas;
		}
		function Cek_Nilai_Ekstra($thnajaran,$semester,$nis,$nama_ekstra)
		{
			$tCek_Nilai_Ekstra=$this->db->query("select * from ekstrakurikuler where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and nama_ekstra='$nama_ekstra'");
			return $tCek_Nilai_Ekstra;
		}
		function Add_Nilai_Ekstra($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$nama_ekstra = $param['nama_ekstra'];
			$nilai = $param['nilai'];
			$keterangan = $param['keterangan'];

			// edit mode

			if($ada>0) 
			{
				$this->db->query("update ekstrakurikuler set nilai = '$nilai', keterangan = '$keterangan' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and nama_ekstra='$nama_ekstra'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `ekstrakurikuler` (`thnajaran` ,`semester` ,`kelas` ,`nis` , `nama_ekstra`, `nilai`, `keterangan`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$nama_ekstra', '$nilai', '$keterangan')");
			}

		}
		function Tampil_Semua_Bp($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Bp=$this->db->query("select * from tbllogin where status ='BP' LIMIT $ofset,$limit");
			return $Tampil_Semua_Bp;
		}
		function Total_Bp()
		{
			$Total_Bp=$this->db->query("select * from tbllogin where status ='BP'");
			return $Total_Bp;
		}
		function Tampil_Login_Bp($idlink)
		{
			$tampilloginstaf=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginstaf;
		}
		function Update_Bp($username,$psw,$nama)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama' where username='$username' and status='BP'");
				}
			if ((!empty($psw)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', psw=PASSWORD('$psw') where  username='$username' and status='BP'");
				}

		}
		function Tampil_Semua_TU($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_TU=$this->db->query("select * from tbllogin where status ='Tatausaha' LIMIT $ofset,$limit");
			return $Tampil_Semua_TU;
		}
		function Total_TU()
		{
			$Total_TU=$this->db->query("select * from tbllogin where status ='Tatausaha'");
			return $Total_TU;
		}
		function Tampil_Login_TU($idlink)
		{
			$tampilloginstaf=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginstaf;
		}
		function Update_TU($username,$psw,$nama)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama' where username='$username' and status='Tatausaha'");
				}
			if ((!empty($psw)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', psw=PASSWORD('$psw') where  username='$username' and status='Tatausaha'");
				}

		}
		function Tampil_Semua_Keuangan($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Keuangan=$this->db->query("select * from tbllogin where status ='Keuangan' LIMIT $ofset,$limit");
			return $Tampil_Semua_Keuangan;
		}
		function Total_Keuangan()
		{
			$Total_Keuangan=$this->db->query("select * from tbllogin where status ='Keuangan'");
			return $Total_Keuangan;
		}
		function Tampil_Login_Keuangan($idlink)
		{
			$tampilloginkeuangan=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginkeuangan;
		}
		function Update_Keuangan($username,$psw,$nama)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama' where username='$username' and status='Keuangan'");
				}
			if ((!empty($psw)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', psw=PASSWORD('$psw') where  username='$username' and status='Keuangan'");
				}

		}
	function Simpan_Transaksi($in)
		{
			$transaksi=$this->db->insert('siswa_bayar',$in);
			return $transaksi;
		}
	function Hapus_Siswa_Kelas($id)
		{
			$this->db->where('id_siswa_kelas',$id);
			$this->db->delete('siswa_kelas');
		}
		function Tampil_Semua_Pegawai($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Pegawai=$this->db->query("select * from tbllogin where status ='Pegawai' LIMIT $ofset,$limit");
			return $Tampil_Semua_Pegawai;
		}
		function Total_Pegawai()
		{
			$Total_Pegawai=$this->db->query("select * from tbllogin where status ='Pegawai'");
			return $Total_Pegawai;
		}
		function Tampil_Login_Pegawai($idlink)
		{
			$tampilloginstaf=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginstaf;
		}
		function Update_Pegawai($username,$psw,$nama)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama' where username='$username' and status='Pegawai'");
				}
			if ((!empty($psw)) and (!empty($nama)))
				{
				$this->db->query("update tbllogin set nama='$nama', psw=PASSWORD('$psw') where  username='$username' and status='Pegawai'");
				}

		}
		function Data_Siswa_Aktif()
		{
			$tData_Siswa_Aktif=$this->db->query("select * from datsis where `ket`='Y'");
			return $tData_Siswa_Aktif;
		}
		function Update_Nama_Siswa_Login($in)
		{
			$this->db->where('username',$in['username']);
			$this->db->update('tbllogin',$in);
		}
		function Update_Nama_Siswa_Nilai($in)
		{
			$this->db->where('nis',$in['nis']);
			$this->db->update('nilai',$in);
		}
		function Cari_Siswa($nama)
		{
			$tCari_Siswa=$this->db->query("select * from datsis where `nama` like '%$nama%' or `nis`='$nama' order by ket DESC");
			return $tCari_Siswa;
		}
		function Data_Siswa_Kelas($thnajaran,$semester)
		{
			$tData_Siswa_Kelas=$this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and `semester`='$semester'");
			return $tData_Siswa_Kelas;
		}
		function Update_Kelas($in)
		{
			$this->db->where('nis',$in['nis']);
			$this->db->update('datsis',$in);
		}
		function Tampil_Data_Siswa($nis)
		{
			if (!empty($nis))
			{
			$tTampil_Data_Siswa=$this->db->query("select * from datsis where `nis`='$nis'");
			}
			else
			{
			$tTampil_Data_Siswa=$this->db->query("select * from datsis where `nis`='xxxxxxxxxx'");
			}
			return $tTampil_Data_Siswa;
		}
		function Tampil_Login_Siswa($idlink)
		{
			$tampilloginstaf=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampilloginstaf;
		}
		function Simpan_Login_User($username,$nama,$tipeuser)
		{
			if ($tipeuser=='staf')
				{
				$tipeuser='admin';
				}
			$simpanloginstaf=$this->db->query("INSERT INTO `tbllogin` (`username`,`nama` ,`status` ,`idlink`) VALUES ('$username', '$nama', '$tipeuser', '')");

			return $simpanloginstaf;
		}
		function Tampil_Semua_Panitia_Tes($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_Panitia_Tes=$this->db->query("select * from tbllogin where status ='Panitia_Tes' LIMIT $ofset,$limit");
			return $Tampil_Semua_Panitia_Tes;
		}
		function Total_Panitia_Tes()
		{
			$Total_Panitia_Tes=$this->db->query("select * from tbllogin where status ='Panitia_Tes'");
			return $Total_Panitia_Tes;
		}
		function Update_Foto_Siswa($in)
		{
			$this->db->where('nis',$in['nis']);
			$this->db->update('datsis',$in);
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
			$nama=$this->db->escape($nama);
			if($ada==0) 
			{
			$tambahdatsis=$this->db->query("INSERT INTO `datsis` (`nis` ,`nama`,`ket`) VALUES ('$nis', $nama,'$aktif')");
			}

		}
		function Nis_Terakhir()
		{
			$tNis_Terakhir=$this->db->query("select * from datsis order by nis DESC limit 0,1");
			return $tNis_Terakhir;
		}
		function Tampil_User($idlink)
		{
			$tampillogin=$this->db->query("select * from tbllogin where `username`='$idlink'");
			return $tampillogin;
		}
		function Update_User($username,$psw,$nama,$tipeuser,$idlink,$aktif)
		{
			if (empty($psw))
				{
				$this->db->query("update tbllogin set nama='$nama', username='$username', `status`='$tipeuser', `idlink`='$idlink', `aktif`='$aktif' where username='$username'");
				}
			if ((!empty($psw)) and (!empty($username)) and (!empty($nama)) and (!empty($tipeuser)))
				{
				$this->db->query("update tbllogin set nama='$nama', username='$username', psw='$psw', `status`='$tipeuser', `idlink`='$idlink', `aktif`='$aktif' where username='$username'");
				}

		}
		function Simpan_Ruang_Tes_Siswa($in)
		{
			$this->db->where('ruang',$in['ruang']);
			$this->db->update('m_ruang',$in);
		}
		function Tampil_Ttd_Guru($id)
		{
			$tampilttdguru=$this->db->query("select * from p_pegawai where kode='$id'");
			foreach($tampilttdguru->result() as $c1)
			{
				$ttdguru = $c1->tandatangan;
			}
			return $ttdguru;
		}

		function Update_Ttd_Guru($username,$filettd)
		{
		$this->db->query("update p_pegawai set tandatangan='$filettd' where kd='$username' ");
		}
		function Tampil_Semua_Ekstra()
		{
			$Tampil_Semua_Ekstra=$this->db->query("select * from m_ekstra");
			return $Tampil_Semua_Ekstra;
		}
		function Simpan_Ekstra($in)
		{
			$kat=$this->db->insert('m_ekstra',$in);
			return $kat;
		}
		function Hapus_Ekstra($id)
		{
			$this->db->where('id_ekstra',$id);
			$this->db->delete('m_ekstra');
		}

		function Edit_Ekstra($id)
		{
			$t=$this->db->query("select * from m_ekstra where id_ekstra='$id'");
			return $t;
		}
		function Update_Ekstra($in)
		{
			$this->db->where('id_ekstra',$in['id_ekstra']);
			$this->db->update('m_ekstra',$in);
		}
		function Daftar_Nama_Ekstra_Wajib()
		{
			$t=$this->db->query("select * from m_ekstra where wajib='1'");
			return $t;
		}
		function Daftar_Nama_Ekstra_Pilihan()
		{
			$t=$this->db->query("select * from m_ekstra where wajib='0'");
			return $t;
		}
		function Daftar_Ekstra_Wajib($thnajaran,$semester)
		{
			$t=$this->db->query("select * from m_ekstra_wajib where thnajaran='$thnajaran' and semester='$semester'");
			return $t;
		}
		function Simpan_Ekstra_Wajib_Kelas($in)
		{
			$kat=$this->db->insert('m_ekstra_wajib',$in);
			return $kat;
		}
		function Hapus_Ekstra_Wajib_Kelas($id)
		{
			$this->db->where('id_ekstra_wajib',$id);
			$this->db->delete('m_ekstra_wajib');
		}
		function Daftar_Pengampu_Ekstra($thnajaran,$semester)
		{
			$t=$this->db->query("select * from m_pengampu_ekstra where thnajaran='$thnajaran' and semester='$semester'");
			return $t;
		}
		function Daftar_Semua_Guru()
		{
			$tampilsemuaguru=$this->db->query("select * from `p_pegawai` where `guru`='Y' order by nama ASC");
			return $tampilsemuaguru;
		}
		function Daftar_Nama_Ekstra()
		{
			$t=$this->db->query("select * from m_ekstra order by namaekstra");
			return $t;
		}
		function Simpan_Pengampu_Ekstra($in)
		{
			$kat=$this->db->insert('m_pengampu_ekstra',$in);
			return $kat;
		}
		function Hapus_Pengampu_Ekstra($id)
		{
			$this->db->where('id_pengampu_ekstra',$id);
			$this->db->delete('m_pengampu_ekstra');
		}
		function Simpan_Ekstra_Siswa($param)
		{

			$nis = $param['nis'];
			$namaekstra = $param['nama_ekstra'];
			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$tsisek = $this->db->query("select * from ekstrakurikuler where nis='$nis' and thnajaran='$thnajaran' and semester='$semester' and nama_ekstra='$namaekstra'");
			$ada = $tsisek->num_rows();
			$tsiskel = $this->db->query("select * from siswa_kelas where nis='$nis' and thnajaran='$thnajaran' and `semester`='$semester'");
			foreach($tsiskel->result_array() as $dsiskel)
				{
				$kelas = $dsiskel['kelas'];
				}
			if ($ada == 0)
				{
				$this->db->query("insert into ekstrakurikuler (`thnajaran`,`semester`,`kelas`,`nis`,`nama_ekstra`) values ('$thnajaran','$semester','$kelas','$nis','$namaekstra')");
				}

		}
		function Cek_Nilai_Hadir($thnajaran,$semester,$nis)
		{
			$tCek_Nilai_Hadir=$this->db->query("select * from kepribadian where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			return $tCek_Nilai_Hadir;
		}
		function Add_Nilai_Hadir($param,$ada)
		{

			$thnajaran = $param['thnajaran'];
			$semester = $param['semester'];
			$kelas = $param['kelas'];
			$nis = $param['nis'];
			$sakit = $param['sakit'];
			$izin = $param['izin'];
			$tanpa_keterangan = $param['tanpa_keterangan'];
			$terlambat = $param['terlambat'];
			$membolos = $param['membolos'];
			$angka_kredit = $param['angka_kredit'];
			// edit mode

			if($ada>0) 
			{
				$this->db->query("update kepribadian set sakit = '$sakit', izin = '$izin', tanpa_keterangan = '$tanpa_keterangan', membolos = '$membolos', terlambat='$terlambat', angka_kredit = '$angka_kredit' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
			}
			else
			{
			$simpanloginsiswa=$this->db->query("INSERT INTO `kepribadian` (`thnajaran` ,`semester` ,`kelas` ,`nis` , `sakit`, `izin`, `tanpa_keterangan`, `membolos`, `terlambat`,`angka_kredit`) VALUES ('$thnajaran', '$semester', '$kelas', '$nis', '$sakit', '$izin', '$tanpa_keterangan', '$membolos', '$terlambat','$angka_kredit')");
			}

		}
		function Update_Foto_Guru_Pegawai($in)
		{
			$this->db->where('kd',$in['kd']);
			$this->db->update('p_pegawai',$in);
		}
		function Tambah_Tautan($in)
		{
			$kat=$this->db->insert('tbltautan',$in);
			return $kat;
		}
		function Hapus_Tautan($id)
		{
			$this->db->where('id_tautan',$id);
			$this->db->delete('tbltautan');
		}
		function Perbarui_Tautan($in)
		{
			$this->db->where('id_tautan',$in['id_tautan']);
			$this->db->update('tbltautan',$in);
		}
		function Tampil_Semua_User($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_User=$this->db->query("select * from tbllogin where status !='Siswa' LIMIT $ofset,$limit");
			return $Tampil_Semua_User;
		}
		function Total_User()
		{
			$Total_User=$this->db->query("select * from tbllogin where status !='Siswa'");
			return $Total_User;
		}
		function Delete_User($id)
		{
			$this->db->where('username',$id);
			$this->db->delete('tbllogin');

		}
		function Pegawai_Guru()
		{
			$t=$this->db->query("select * from `p_pegawai` where `guru`='Y' order by nama");
			return $t;
		}
		function Ubah_Menu_Kelompok_Mapel($in)
		{
			$this->db->where('id_kelompok_mapel',$in['id_kelompok_mapel']);
			$this->db->update('m_kelompok_mapel',$in);
		}
		function Tambah_Menu_Kelompok_Mapel($in)
		{
			$this->db->insert('m_kelompok_mapel',$in);
		}
		function Ubah_Menu_Mapel($in)
		{
			$this->db->where('id_kategori_tutorial',$in['id_kategori_tutorial']);
			$this->db->update('tblkategoritutorial',$in);
		}
		function Edit_Pengumuman_Admin($id)
		{
			$ed=$this->db->query("select * from tblpengumuman where id_pengumuman='$id'");
			return $ed;
		}
		function Update_Kategori_Profil($in)
		{
			$this->db->where('id_kategori',$in['id_kategori']);
			$this->db->update('tblkategoriprofil',$in);
		}
		function Hapus_Kategori_Profil($id)
		{
			$this->db->where('id_kategori',$id);
			$this->db->delete('tblkategoriprofil');
		}
	function Hapus_Hasil_Skp($tahun,$kode)
		{
		$this->db->query("update `ppk_pns` set `permanen`='0', `kepala`='0' where `tahun`='$tahun' and `kode`='$kode'");
		}
	function Delete_Data_Pengguna($id)
		{
			$this->db->where('kd',$id);
			$this->db->delete('p_pegawai');

		}
	function Delete_Data_Id_Pengguna($id)
		{
			$this->db->where('id_p_pegawai',$id);
			$this->db->delete('p_pegawai');

		}
		function Delete_User_Siswa($id)
		{
			$this->db->where('status','Siswa');
			$this->db->where('username',$id);
			$this->db->delete('tbllogin');

		}
		function Tampil_Semua_User_Terdaftar()
		{
			$Tampil_Semua_User=$this->db->query("select * from `tbllogin` where `aktif` !='Y' order by `nama`");
			return $Tampil_Semua_User;
		}
	function Aktifkan_User($pengguna)
		{
		$d=strtotime("+7 days");
		$next_login = date("Y-m-d h:i:sa", $d);
		$this->db->query("update `tbllogin` set `aktif`='Y', `next_login`='$next_login' where `username` = '$pengguna'");
		}
	function Total_Kepala()
		{
			$t=$this->db->query("select * from tbllogin where `status`='Kepala'");
			return $t;
		}
	function Update_Id_SMS_User($user,$id_sms_user)
		{
			$this->db->query("update `p_pegawai` set `id_sms_user`='$id_sms_user' where `kd` = '$user'");
		}
		function Update_Password($username,$psw)
		{
			$this->db->query("update tbllogin set psw='$psw' where username='$username'");
		}

	function Perbarui_Kepala($in)
	{
		$this->db->where('id_kepala',$in['id_kepala']);
		$this->db->update('m_kepala',$in);
	}
	function Data_Kat_Profil($id_kategori)
	{
		$datakatprofil = array('id_kategori' => '',
						'nama_kategori' => '',
			);
		$ta = $this->db->query("SELECT * FROM `tblkategoriprofil` where `id_kategori` = '$id_kategori'");
		foreach($ta->result() as $a)
		{
			$datakatprofil = array('id_kategori' => $a->id_kategori,
						'nama_kategori' => $a->nama_kategori,
			);


		}
		return $datakatprofil;
	}
	function Tambah_Kat_Profil($in)
	{
		$this->db->insert('tblkategoriprofil',$in);
	}
	function Perbarui_Kat_Profil($in)
	{
		$this->db->where('id_kategori',$in['id_kategori']);
		$this->db->update('tblkategoriprofil',$in);
	}
	function Hapus_Kat_Profil($id)
	{
		$this->db->where('id_kategori',$id);
		$this->db->delete('tblkategoriprofil');
	}
	function Hapus_Jawaban_Polling($id_jawaban_poll)
		{
			$this->db->where('id_jawaban_poll',$id_jawaban_poll);
			$this->db->delete('tbljawabanpoll');
		}
	function Tampil_Semua_Telegram($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_User=$this->db->query("select * from `telegram` order by `waktu` DESC LIMIT $ofset,$limit");
			return $Tampil_Semua_User;
		}
	function Total_Telegram()
		{
			$Total_User=$this->db->query("select * from `telegram`");
			return $Total_User;
		}
	function Tampil_Semua_Pengguna_Telegram($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_User=$this->db->query("select `kd`,`nama`, `nama_tanpa_gelar`, `chat_id` from `p_pegawai` where `status`='Y' order by `nama_tanpa_gelar` ASC LIMIT $ofset,$limit");
			return $Tampil_Semua_User;
		}
	function Total_Pengguna_Telegram()
		{
			$Total_User=$this->db->query("select * from `p_pegawai` where `status`='Y'");
			return $Total_User;
		}
	function Update_ID_Telegram($in)
	{
		$this->db->where('kd',$in['kd']);
		$this->db->update('p_pegawai',$in);
	}
	function Tampil_Semua_Siswa_Pengguna_Telegram($limit,$ofset)
		{
			$ofset = $ofset * 1;
			$Tampil_Semua_User=$this->db->query("select `nis`,`nama`, `chat_id` from `datsis` where `ket`='Y' order by `nama` ASC LIMIT $ofset,$limit");
			return $Tampil_Semua_User;
		}
	function Total_Siswa_Pengguna_Telegram()
		{
			$Total_User=$this->db->query("select `nis`,`nama`, `chat_id` from `datsis` where `ket`='Y'");
			return $Total_User;
		}
	function Update_ID_Siswa_Telegram($in)
	{
		$this->db->where('nis',$in['nis']);
		$this->db->update('datsis',$in);
	}
	function Total_Guru_Bk()
	{
		$t=$this->db->query("select * from tbllogin where `status`='BP'");
		return $t;
	}
	function Tampil_Semua_Guru_Bk($limit,$ofset)
	{
		$ofset = $ofset * 1;
		$tampilsemuaguru=$this->db->query("select * from `tbllogin` where `status`='BP' order by nama ASC LIMIT $ofset,$limit");
		return $tampilsemuaguru;
	}
	function Simpan_User_Baru($in)
		{
			$kat=$this->db->insert('tbllogin',$in);
			return $kat;
		}
		function Berita_Tampil($in)
		{
			$this->db->query("update `tblberita` set `terbit`='1' where `id_berita`='$in' ");
		}
		function Berita_Urung($in)
		{
			$this->db->query("update `tblberita` set `terbit`='0' where `id_berita`='$in' ");
		}

}
