<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 10 Jan 2019 20:01:34 WIB 
// Nama Berkas 		: bg_atas.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8"  class="ie"lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9"  class="ie"lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"lang="en-US">
<![endif]-->
<!-- This doesn't work but i prefer to leave it here... maybe in the future the MS will support it... i hope... -->
<!--[if IE 10]>
<html id="ie10"  class="ie"lang="en-US">
<![endif]-->
<!--[if !IE]>
<html lang="en-US">
<![endif]-->
<!-- START HEAD -->
<head>
    <meta charset="UTF-8" />
    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
    <title><?php echo $judulhalaman;?></title>
    <?php
	$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
	<?php
	}
	else
	{
		$temacss = '';
		$ta = $this->db->query("select * from `temauser` where `user`='$nim'");
		foreach($ta->result() as $a)
		{
			$temacss = $a->temacss;
		}
		if(!empty($temacss))
		{?>
		    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
		}
		else
		{?>
		    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">	
		<?php
		}
	}

     ?>
    <link rel="stylesheet" href="<?php echo base_url();?>css/teks.css">		
    <link href="/assets/css/bootstrap-4-navbar.css" rel="stylesheet">
    <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

</head>
<body>
<?php
if(!isset($adamenu))
{
?>

<div class="container-fluid">
 <!-- Static navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo base_url();?>guru">Beranda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>guru/ubahpassword">Ubah Password <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Akademik
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/pembagiantugas" title="Melihat, mengubah pembagian tugas ">Pembagian Tugas Guru Mapel Wajib</a></li>
				    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/pembagiantugas/pilihan" title="Melihat, mengubah pembagian tugas ">Pembagian Tugas Guru Mapel Pilihan</a></li>
	                            <li><a class="dropdown-item dropdown-toggle" href="#">Nilai</a>
	                                <ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/nilai" title="Melihat, mengubah nilai semester ini">Nilai Semester Ini</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/nilailama" title="Melihat, mengubah nilai semester lalu">Nilai</a></li>
<!--
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/nilaiakhir" title="Melihat, mengubah nilai akhir">Nilai Akhir</a></li>
-->
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/nilairemidi">Nilai Remidi</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/unggahnilairemidi">Unggah Nilai Remidi</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/psikomotor">Psikomotor/Keterampilan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/afektif">Afektif/Sikap</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/nilaiakhlak">Akhlak Mulia / Sikap Sosial Antarmapel</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/cetakblankonilai">Blanko Nilai</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/unduhnilai">Unduh Nilai</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ujian" title="Melihat nilai untuk persiapan ujian nasional">Nilai Ujian</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/intake" title="Melihat daya dukung siswa">Intake KKM</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/carisiswa/jurnalsikap" title="Mengolah jurnal sikap sosial dan spiritual">Jurnal Sikap Sosial dan Spiritual</a></li>
                                    	</ul>
                                </li>
				<li><a class="dropdown-item dropdown-toggle" href="#">Akreditasi</a>
				   	<ul class="dropdown-menu">
	                                        <li><a class="dropdown-item" href="<?php echo base_url();?>akreditasi/materi" title="Melihat, mengubah materi ulangan">Materi Ulangan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>akreditasi/indikator" title="Melihat, mengubah indikator ulangan">Indikator Ulangan</a></li>
					</ul>
                                </li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>guru/deskripsi" title="Melihat, mengubah jenis deksripsi capaian kompetensi siswa">Jenis Deskripsi Capaian Kompetensi</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>guru/salindeskripsi" title="Menyalin jenis deksripsi capaian kompetensi siswa ke kelas lain">Salin Jenis Deskripsi Kompetensi</a></li>
<li><a class="dropdown-item" href="<?php echo base_url();?>guru/salindeskripsiketerampilan" title="Menyalin jenis deksripsi capaian kompetensi keterampilan siswa ke kelas lain">Salin Jenis Deskripsi Kompetensi Keterampilan</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>guru/bankdeskripsi" title="Mengolah bank deksripsi capaian kompetensi siswa format">Bank Deskripsi Capaian Kompetensi</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>deskripsi" title="Memproses deskripsi capaian kompetensi">Proses Deskripsi</a></li>
				<li><a class="dropdown-item dropdown-toggle" href="#">Perangkat</a>
				   	<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>guru/rpp/tampil">RPP</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>guru/rph">RPH/BPH</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>guru/bip/tampil">Buku Informasi Penilaian</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>perangkat/bpu/tampil">Buku Pengembalian Ulangan</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>guru/buku/tampil">Daftar Buku Pegangan Guru dan Siswa</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>guru/tugas">Tugas Mandiri, Tugas Tak Terstruktur</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>unggah/unduhperangkat">Unduh Perangkat</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>unggah/unggahperangkat">Unggah Perangkat</a></li>
				   	</ul>
				</li>
				<li><a class="dropdown-item dropdown-toggle" href="#">Tugas Tambahan</a>
				   	<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?php echo base_url();?>guru/walikelas">Wali Kelas</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>piket">Piket</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>piket/daftartugas">Tugas Siswa dari Guru</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kepala">Kepala Madrasah</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>waka">Wakil Kepala</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kalab">Kepala Laboratorium</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>kapus">Kepala Perpustakaan</a></li>
					</ul>
				</li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>guru/prestasisiswa">Daftar Prestasi / Organisasi Siswa</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>guru/carisiswa">Siswa Tidak Masuk / Izin Pulang</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>guru/carisiswa/siswakredit">Kredit Pelanggaran Siswa</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>guru/haritatapmuka">Hari Tatap Muka</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>guru/formmencetak">Mencetak</a></li>
				<li><a class="dropdown-item" href="<?php echo base_url();?>guru/mencetakperangkat">Mencetak (baru)</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ekstrakurikuler
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<li><a class="dropdown-item" href="<?php echo base_url();?>ekstrakurikuler/ekstrakurikuler">Ekstrakurikuler</a></li>
					<li><a class="dropdown-item" href="<?php echo base_url();?>ekstrakurikuler/jurnal">Jurnal Ekstrakurikuler</a></li>

			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pribadi  <b class="caret"></b></a>

			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<li><a class="dropdown-item dropdown-toggle" href="#">Data <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/umum">Pribadi</a><li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/keluarga">Keluarga</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/pendidikan">Pendidikan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/jabatan">Jabatan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/kepegawaian">Kepegawaian</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/sertifikat">Diklat</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/organisasi">Organisasi</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/penelitian">Penelitian</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/tandajasa">Tanda Jasa</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/keluarnegeri">Pengalaman Ke Luar Negeri </a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>perangkat/sertifikasi">Data Sertifikasi</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>unggah/unggah/lain">Unggah Berkas Pindaian</a></li>
					</ul>
				</li>
				<li><a class="dropdown-item dropdown-toggle" href="#">SimPeg Kemenag <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ropegdrh">Cetak SimPEG Kemenag</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ropegdrh">Daftar Riwayat Hidup</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ropegalamat">Alamat</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ketdiri">Keterangan Diri</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ropegpendidikan">Pendidikan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/pekerjaan">Pangkat Golong Jabatan</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ropegnomor">Nomor nomor Kepegawaian</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url();?>guru/ropegkeluarga">Data Keluarga</a></li>
					</ul>
				</li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>guru/kpppp">KP4</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>pkg/sk">SK per semester</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>pkg/skp">SKP</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>pkg">PKG</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>perangkat/supervisi">Supervisi</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>pkg/golskp">Golongan Saat Penyusunan SKP</a></li>
			    	<li><a class="dropdown-item" href="<?php echo base_url();?>evaluasi">Evaluasi Diri Guru</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DUPAK  <b class="caret"></b></a>

			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			  	<li><a class="dropdown-item" href="<?php echo base_url();?>dupak/pak">Riwayat PAK</a><li>
			  	<li><a class="dropdown-item" href="<?php echo base_url();?>dupak/masa">Pengajuan PAK</a><li>
			  	<li><a class="dropdown-item" href="<?php echo base_url();?>dupak/mencetak">Mencetak Borang PAK</a><li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Halaman Situs  <b class="caret"></b></a>

			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/berita"  title="Menulis, mengubah, menghapus berita di portal">Berita </a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/pengumuman"  title="Menulis, mengubah, menghapus pengumuan di portal">Pengumuman</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/tutorial"  title="Menulis, mengubah, menghapus materi pelajaran di portal">Materi Pelajaran</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/upload"  title="Mengunggah, mengubah data unggahan">Unggah</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/inbox"  title="Melihat, mengirim, menjawab pesan">Pesan</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>guru/pesanmassalsiswa"  title="Mengirim pesan massal ke siswa">Kirim Pesan Massal Siswa</a></li>
  				    <li><a class="dropdown-item" href="<?php echo base_url(); ?>situs/pesanadmin" title="Mengirim pesan ke Admin" onclick="return hs.htmlExpand(this, { objectType: 'iframe' } )">Kirim Pesan ke Admin</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SIEKA  <b class="caret"></b></a>

			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				    <li><a class="dropdown-item" href="<?php echo base_url();?>sieka/ubahdata"  title="Ubah data Login ke SiEka">Data Login </a></li>
				    <li><a class="dropdown-item" href="<?php echo base_url();?>sieka"  title="Login ke SiEka">Login </a></li>

			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>sieka/tahunan"  title="Mengubah nomor ID kegiatan tautan">Tahunan</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>sieka/bulanan"  title="Mengubah nomor ID kegiatan tahunan">Bulanan</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>sieka/funggahkodebulanan"  title="Unggah kode bulanan dari Sieka">Unggah Kode Bulanan</a></li>
			  	    <li><a class="dropdown-item" href="<?php echo base_url();?>sieka/harian"  title="Kirim kegiatan harian ke Sieka">Harian</a></li>
			  	    <li><a class="dropdown-item" href="http://sieka.kemenag.go.id/kinerja"  title="Menampilkan laman Sieka" target="_blank">Laman Sieka</a></li>

			    </ul>
			</li>
			<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aplikasi Rapor Digital <b class="caret"></b></a>

			    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				    <li><a class="dropdown-item" href="<?php echo base_url();?>ard/ubahdata"  title="Ubah data Login ke ARD">Data Login </a></li>
				    <li><a class="dropdown-item" href="<?php echo base_url();?>ard/ard"  title="Login ke Aplikasi Rapor Digital">Login </a></li>

			    </ul>
			</li>
			<li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url();?>">Laman <span class="sr-only"></span></a>
                        </li>
                    </ul>
      <ul class="nav navbar-nav ml-auto">
        <li><a href="<?php echo base_url();?>login/logout" data-confirm="Yakin hendak keluar?"> Keluar <span class="fa fa-sign-out-alt"></span></a></li>
      </ul>

                </div>
            </nav>
</div>
<?php
}
?>
