<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : skp_pkg.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3>Daftar Usulan PAK <?php echo $golongane;?></h3></div>
<div class="card-body">
<?php
	$ak_pbm_lama = 0;
	$ak_pkb = 0;
echo '<p><a href="'.base_url().'dupak/masa" class="btn btn-info"><b>Kembali</b></a> <a href="'.base_url().'dupak/skp/'.$golongan.'" class="btn btn-info"><b>Tambah SKP</b></a>  <a href="'.base_url().'dupak/pd/'.$golongan.'/'.$versi.'" class="btn btn-success"><b>RINCIAN PENGEMBANGAN DIRI</b></a>  <a href="'.base_url().'dupak/pj/'.$golongan.'/'.$versi.'" class="btn btn-success"><b>RINCIAN PENUNJANG TUGAS GURU</b></a></p>';
$tc = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongane' and `nip` = '$nip' order by `tahun`");
echo '<h3>Daftar SKP yang belum dinilai</h3>';
$nomor = 1;
echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td>Nomor</td><td>Tahun</td><td>Butir Kegiatan</td><td>Realisasi Hasil</td><td>Ak</td></tr>';
foreach($tc->result() as $c)
{
	if($c->ak_r > 0)
	{
	}
	else
	{
		if(($c->kegiatan == 'Unsur utama') or ($c->kegiatan == 'Unsur Penunjang Tugas Guru') or ($c->kegiatan == 'Unsur PKB'))
		{
		}
		else
		{
			echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$c->tahun.'</td><td>'.$c->kegiatan.'</td><td align="center">'.$c->kuantitas_r.'</td><td align="center">'.$c->ak_target.'</td></tr>';
			$nomor++;
		}
	}

}
echo '</table>';
if($proses == 'proses')
{
	$this->db->query("delete from `dupak_dupak` where `username` = '$nim' and `golongan`='$golongane'");
	$ta = $this->db->query("select * from `dupak_dupak` where `username` = '$nim' and `golongan`='$golongane'");
	$tb = $this->db->query("select * from `skp_tabel_skor`");
	if($ta->num_rows() == 0)
	{

		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', '05', '05')"); // pkg
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', '07', '07')"); // kepala
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', '08', '08')"); // waka
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', '09', '09')"); //ketua jurusan
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', '10', '10')"); // kepala perpustakaan
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', '11', '11')"); // kepala laboratorium
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', 'B01', '18a')"); // U PKB
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`) values ('$nim', '$golongane', 'B02', '63a')"); // U PENUNJANG
/*
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`, `jumlah`) values ('$nim', '$golongane', '05', '05','500')"); // pkg
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`, `jumlah`) values ('$nim', '$golongane', '07', '07','501')"); // kepala
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`, `jumlah`) values ('$nim', '$golongane', '08', '08','502')"); // waka
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`, `jumlah`) values ('$nim', '$golongane', '09', '09','503')"); //ketua jurusan
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`, `jumlah`) values ('$nim', '$golongane', '10', '10','504')"); // kepala perpustakaan
		$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `no_urut`, `jumlah`) values ('$nim', '$golongane', '11', '11','505')"); // kepala laboratorium
*/
		foreach($tb->result() as $b)
		{
			$kode = $b->kode;
			if($kode == '01a')
			{
				$kode = '01';
			}
			if($kode == '2')
			{
				$kode = '02';
			}
			if($kode == '3')
			{
				$kode = '03';
			}
			if($kode == '4')
			{
				$kode = '04';
			}

				$kode_resmi = $b->kode_resmi;
				$ak = $b->ak;
				$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `ref_ak`, `no_urut`) values ('$nim', '$golongane', '$kode', '$ak', '$kode_resmi')");
// percobaan
//				$this->db->query("insert into `dupak_dupak` (`username`,`golongan`,`kode`, `ref_ak`, `ak_item`, `jumlah`, `no_urut`) values ('$nim', '$golongane', '$kode', '$ak', '$ak', '$ak', '$kode_resmi')");
			
// percobaan
		}
	}
	$this->db->query("update `dupak_dupak` set `ak_item` = '' where `golongan`='$golongane' and `username`='$nim'");
	$ta = $this->db->query("select * from `dupak_dupak` where `username` = '$nim' and `golongan`='$golongane'");
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$kode = $a->kode;
		$dd = 'ak_'.$kode;
		$$dd = 0;
	}

	//ambil data dari skp;

	foreach($ta->result() as $a)
	{
		$kode = $a->kode;
		$kodex = $kode;
		if($kode == '01')
		{
			$kodex = '01a';
		}
		if($kode == '02')
		{
			$kodex = '2';
		}
		if($kode == '03')
		{
			$kodex = '3';
		}
		if($kode == '04')
		{
			$kodex = '4';
		}
 		// skp utama
		$td = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongane' and `nip` = '$nip' and `kode`='$kodex'");
		$dd = 'ak_'.$kode;
		$pertahun = $this->dupak->pertahun($kode);
		$kuantitas = 0;
		foreach($td->result() as $d)
		{
/*
			if($kode == 'T02')
			{
				$cacah = $d->cacah;
				$kuantitas = $kuantitas + $d->kuantitas;
				$$dd  = $$dd + ($d->ak_target * $cacah / 2);
			}
			else
			{
				$cacah = $d->cacah;
				$kuantitas = $kuantitas + $d->kuantitas;
				if($pertahun == 'Y')
				{
					$$dd  = $$dd + ($d->ak_r * $cacah / 2);
				}
				else
				{
*/
					$$dd  = $$dd + $d->ak_r;
					$kuantitas = $kuantitas + $d->kuantitas_r;
//				}
//			}

		}
		// skp rekedua
		/*
		$td = $this->db->query("SELECT * FROM `skp_skor_guru_kedua` where `golongan`='$golongane' and `nip` = '$nip' and `kode`='$kodex'");
		$dd = 'ak_'.$kode;
		$pertahun = $this->dupak->pertahun($kode);
		foreach($td->result() as $d)
		{
			if($kode == 'T02')
			{
				$cacah = $d->cacah;
				$kuantitas = $kuantitas + $d->kuantitas;
				$$dd  = $$dd + ($d->ak_target * $cacah / 2);
			}
			else
			{
				$cacah = $d->cacah;
				$kuantitas = $kuantitas + $d->kuantitas;
				if($pertahun == 'Y')
				{
					$$dd  = $$dd + ($d->ak_r * $cacah / 2);
				}
				else
				{
					$$dd  = $$dd + $d->ak_r;
				}
			}

		}
		*/ // sementara diabaikan
		$th = $this->db->query("select * from `dupak_skp` where `username` = '$nim' and `golongan`='$golongane' and `kode`='$kodex'");
		foreach($th->result() as $h)
		{
			$cacahh = $h->kuantitas;
			$kuantitas = $kuantitas + $cacahh;
			$$dd = $$dd + ($h->ak * $cacahh);
		}
		if($kuantitas == 0)
		{
			$kuantitas = '';
		}
		$ak_item = $$dd;
		if($ak_item > 0)
		{
			$this->db->query("update `dupak_dupak` set `cacah`='$kuantitas', `ak_item` = '$ak_item', `jumlah`='$ak_item' where `golongan`='$golongane' and `username`='$nim' and `kode`='$kode'");
		}
	}

	// PKG
	$kode_pbm = '00';
	$ak_r = 0;
	$td = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongane' and `nip` = '$nip' and `kode`='$kode_pbm'");
	foreach($td->result() as $d)
	{
		$tahun = $d->tahun;
		$cacah = $d->cacah;
		$ak_re = $d->ak_r * $cacah / 2;
	//	echo 'Tahun '.$tahun.' '.$ak_re.'<br />';
		$ak_r  = $ak_r + $ak_re;
	}
	// PKG
	/*
	$td = $this->db->query("SELECT * FROM `skp_skor_guru_kedua` where `golongan`='$golongane' and `nip` = '$nip' and `kode`='$kode_pbm'");
	foreach($td->result() as $d)
	{
		$tahun = $d->tahun;
		$cacah = $d->cacah;
		$ak_re = $d->ak_r * $cacah / 2;
	//	echo 'Tahun '.$tahun.' '.$ak_re.'<br />';
		$ak_r  = $ak_r + $ak_re;
	}
	*/
	//echo $$dd.'<br />';
	if($gabungan == 'ada')
	{
		$ak_pbm_lama = $this->dupak->Ak_Pbm($nim);
	}
	//cari pak lama
	$ak_pbm = $datapaklama['ak_pbm'];
	$ak_r = $ak_r + $ak_pbm_lama;
	$jumlah_pbm = $ak_pbm + $ak_r;
	//pendidikan
	$ak_pendidikan = $datapaklama['ak_pendidikan'];
	$this->db->query("update `dupak_dupak` set `ak_item`='',  `ak_item` = '$ak_r', `lama` = '$ak_pbm', `jumlah` = '$jumlah_pbm' where `golongan`='$golongane' and `username`='$nim' and `kode`='05'");
	//pendidikan
	$ak_pendidikan = $datapaklama['ak_pendidikan'];
	$pendidikan =  $datapaklama['pendidikan'];
	if(substr($pendidikan,0,3) == 'S-3')
	{
		$this->db->query("update `dupak_dupak` set `ak_item`='', `lama` = '$ak_pendidikan', `jumlah` = '$ak_pendidikan' where `golongan`='$golongane' and `username`='$nim' and `kode`='01'");
	}
	if(substr($pendidikan,0,3) == 'S-2')
	{
		$this->db->query("update `dupak_dupak` set `ak_item`='', `lama` = '$ak_pendidikan', `jumlah` = '$ak_pendidikan' where `golongan`='$golongane' and `username`='$nim' and `kode`='02'");
	}
	if(substr($pendidikan,0,3) == 'S-1')
	{
		$this->db->query("update `dupak_dupak` set `ak_item`='', `lama` = '$ak_pendidikan', `jumlah` = '$ak_pendidikan' where `golongan`='$golongane' and `username`='$nim' and `kode`='03'");
	}
	// pkb
	$ak_pkb = $datapaklama['ak_pkb'];
	$this->db->query("update `dupak_dupak` set `ak_item`='', `lama` = '$ak_pkb', `jumlah` = '$ak_pkb' where `golongan`='$golongane' and `username`='$nim' and `kode`='B01'");
	// pENUNJANG
	$ak_penunjang = $datapaklama['ak_penunjang'];
	$this->db->query("update `dupak_dupak` set `ak_item`='',  `lama` = '$ak_penunjang', `jumlah` = '$ak_penunjang' where `golongan`='$golongane' and `username`='$nim' and `kode`='B02'");
	// WAKA
	$ak_r = 0;
	$td = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongane' and `nip` = '$nip' and `kegiatan` like '%waka%'");
	$kuantitaswaka = 0;
	foreach($td->result() as $d)
	{
		$tahun = $d->tahun;
		$cacah = $d->cacah;
		$ak_re = $d->ak_r * $cacah / 2;
		$kuantitaswaka = $kuantitaswaka + $d->kuantitas;
		$ak_r  = $ak_r + $ak_re;
//		echo 'Tahun '.$tahun.' '.$ak_re.'<br />';
	}
	/*
	$td = $this->db->query("SELECT * FROM `skp_skor_guru_kedua` where `golongan`='$golongane' and `nip` = '$nip' and `kegiatan` like '%waka%'");
	foreach($td->result() as $d)
	{
		$tahun = $d->tahun;
		$cacah = $d->cacah;
		$ak_re = $d->ak_r * $cacah / 2;
		$kuantitaswaka = $kuantitaswaka + $d->kuantitas;
		$ak_r  = $ak_r + $ak_re;
//		echo 'Tahun '.$tahun.' '.$ak_re.'<br />';
	}
	*/
	if($kuantitaswaka == 0)
	{
		$kuantitaswaka = '';
	}
	if($ak_r > 0)
	{
		$this->db->query("update `dupak_dupak` set `cacah`='$kuantitaswaka', `ak_item` = '$ak_r', `jumlah`='$ak_r' where `golongan`='$golongane' and `username`='$nim' and `kode`='08'");
	}

	// KEPALA PERPUSTAKAAN
	$kode_giat = '10';
	$ak_r = 0;
	$td = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongane' and `nip` = '$nip' and `kegiatan` like '%kepala perpustakaan%'");
	$kuantitaskapus = 0;
	foreach($td->result() as $d)
	{
		$cacah = $d->cacah;
		$ak_r  = $ak_r + ($d->ak_r * $cacah / 2);
		$kuantitaskapus = $kuantitaskapus + $d->kuantitas;
	}
	/*
	$td = $this->db->query("SELECT * FROM `skp_skor_guru_kedua` where `golongan`='$golongane' and `nip` = '$nip' and `kegiatan` like '%kepala perpustakaan%'");
	foreach($td->result() as $d)
	{
		$cacah = $d->cacah;
		$ak_r  = $ak_r + ($d->ak_r * $cacah / 2);
		$kuantitaskapus = $kuantitaskapus + $d->kuantitas;
	}
	*/
	if($kuantitaskapus == 0)
	{
		$kuantitaskapus = '';
	}
	if($ak_r > 0)
	{
		$this->db->query("update `dupak_dupak` set `cacah`='$kuantitaskapus', `ak_item` = '$ak_r' , `jumlah`='$ak_r' where `golongan`='$golongane' and `username`='$nim' and `kode`='$kode_giat'");
	}
	// KEPALA LABORATORIUM
	$kode_giat = '11';
	$giat = 'kepala laboratorium';
	$ak_r = 0;
	$td = $this->db->query("SELECT * FROM `skp_skor_guru` where `golongan`='$golongane' and `nip` = '$nip' and `kegiatan` like '%$giat%'");
	$kuantitaskalab = 0;
	foreach($td->result() as $d)
	{
		$cacah = $d->cacah;
		$ak_r  = $ak_r + ($d->ak_r * $cacah / 2);
		$kuantitaskalab = $kuantitaskalab + $d->kuantitas;
	}
	/*
	$td = $this->db->query("SELECT * FROM `skp_skor_guru_kedua` where `golongan`='$golongane' and `nip` = '$nip' and `kegiatan` like '%$giat%'");
	foreach($td->result() as $d)
	{
		$cacah = $d->cacah;
		$ak_r  = $ak_r + ($d->ak_r * $cacah / 2);
		$kuantitaskalab = $kuantitaskalab + $d->kuantitas;
	}
	*/
	if($kuantitaskalab == 0)
	{
		$kuantitaskalab = '';
	}

	if($ak_r > 0)
	{
		$this->db->query("update `dupak_dupak` set `cacah`='$kuantitaskalab', `ak_item` = '$ak_r' , `jumlah`='$ak_r' where `golongan`='$golongane' and `username`='$nim' and `kode`='$kode_giat'");
	}
}
$total = 0;
$jumlah = 0;
$lama = 0;

$this->db->query("delete from `dupak_dupak`  where `golongan`='$golongane' and `username`='$nim' and `lama` is NULL and `ak_item` = '' and `jumlah` is NULL");
$tf = $this->db->query("SELECT * FROM `dupak_dupak` where `username`='$nim' and `golongan`='$golongane' order by `no_urut`");
$akr_pd = 0;
$akr_pi = 0;
$akr_ki = 0;
$akr_pj = 0;
$akr_pbm = 0;
echo '<h3>Penghitungan Angka Kredit</h3>';
echo '<table class="table table-striped table-bordered">
<tr align="center"><td>Nomor</td><td>Kode</td><td>Butir Kegiatan</td><td>Kuantitas</td><td>lama</td><td>Baru</td><td>Jumlah</td></tr>';
foreach($tf->result() as $f)
{
	$no_urut= $f->no_urut;
	$kode = $f->kode;
	$kegiatan = $this->dupak->Cari_Kegiatan_Berdasar_Kode($kode);
	echo '<tr><td align="center">'.$no_urut.'</td><td align="center">'.$f->kode.'</td><td>'.$kegiatan;
	$total = $total + $f->ak_item;
	$jumlah = $jumlah + $f->jumlah;
	$lama = $lama+$f->lama;
	$kode = $f->kode;
	$tipepd = $this->dupak->Tipe_Pd($kode);
	if($tipepd == 'pd')
	{
		$akr_pd = $akr_pd + $f->ak_item;
	}
	if($tipepd == 'pi')
	{
		$akr_pi = $akr_pi + $f->ak_item;
	}
	if($tipepd == 'ki')
	{
		$akr_ki = $akr_ki + $f->ak_item;
	}
	if($tipepd == 'pj')
	{
		$akr_pj = $akr_pj + $f->ak_item;
	}
	if($tipepd == 'pbm')
	{
		$akr_pbm = $akr_pbm + $f->ak_item;
	}


	echo ' <strong>'.$tipepd.'</strong></td><td align="center">'.$f->cacah.'</td><td align="center">'.$f->lama.'</td><td align="center">'.$f->ak_item.'</td><td align="center">'.$f->jumlah.'</td></tr>';
}
echo '<tr><td></td><td colspan="3">Jumlah</td><td align="center">'.$lama.'</td><td align="center">'.$total.'</td><td align="center">'.$jumlah.'</td></tr>';
echo '</table>';
$golongans = Pangkat_Sebelum($golongane);
if ($golongans=='III/a')
	{
	$ak = 100;
	$akk = 50;
	$akpkb =  3+0;
	$ak_pd = 3;
	$ak_pi = 0;
	$akp = 5;
	$kegolongan = 'III/b';
	$ak_pb = 42;
	}
if ($golongans=='III/b')
	{
	$ak = 150;
	$akk = 50;
	$akpkb =  3+4;
	$ak_pd = 3;
	$ak_pi = 4;
	$akp = 5;
	$kegolongan = 'III/c';
	$ak_pb = 38;
	}
if ($golongans=='III/c')
	{
	$ak = 200;
	$akk = 100;
	$akpkb =  3+6;
	$ak_pd = 3;
	$ak_pi = 6;
	$akp = 10;
	$kegolongan = 'III/d';
	$ak_pb = 81;
	}
if ($golongans=='III/d')
	{
	$ak = 300;
	$akk = 100;
	$akpkb =  4+8;
	$ak_pd = 4;
	$ak_pi = 8;
	$akp = 10;
	$kegolongan = 'IV/a';
	$ak_pb = 78;
	}
if ($golongans=='IV/a')
	{
	$ak = 400;
	$akk = 150;
	$akpkb =  4+12;
	$ak_pd = 4;
	$ak_pi = 12;
	$akp = 15;
	$kegolongan = 'IV/b';
	$ak_pb = 119;
	}
if ($golongans=='IV/b')
	{
	$ak = 550;
	$akk = 150;
	$akpkb =  4+12;
	$ak_pd = 4;
	$ak_pi = 12;
	$akp = 15;
	$kegolongan = 'IV/c';
	$ak_pb = 119;
	}
if ($golongans=='IV/c')
	{
	$ak = 700;
	$akk = 150;
	$akpkb =  5+14;
	$akp = 15;
	$kegolongan = 'IV/d';
	$ak_pb = 116;
	}
if ($golongans=='IV/d')
	{
	$ak = 850;
	$akk = 200;
	$akpkb =  5+20;
	$ak_pd = 5;
	$ak_pi = 20;
	$akp = 20;
	$kegolongan = 'IV/e';
	$ak_pb = 155;
	}
$oke = 1;
	if($golongane == 'III/b')
	{
		$total = $total + $datapaklama['ak_pbm'];
		$akr_pbm = $akr_pbm + $datapaklama['ak_pbm'];
	}
if($total < $akk)
{
	echo '<div class="alert alert-danger"><h3>Belum memenuhi. AKK yang dibutuhkan '.$akk.', baru diperoleh '.$total.'</h3></div>'; 
	if($oke == 1)
	{
		$oke = 0;
	}
}
else
{
	echo '<div class="alert alert-success"><h3>Sudah memenuhi. AKK yang dibutuhkan '.$akk.', diperoleh '.$total.'</div>'; 
}
if($akr_pbm < $ak_pb)
{
	echo '<div class="alert alert-danger"><h3>Proses Belajar Mengajar '.$akr_pbm.', minimal '.$ak_pb.'</h3></div>'; 
	if($oke == 1)
	{
		$oke = 0;
	}
}
else
{
	echo '<div class="alert alert-success"><h3>Proses Belajar Mengajar '.$akr_pbm.', minimal '.$ak_pb.'</div>'; 
}

if($akr_pd < $ak_pd)
{
	if($oke == 1)
	{
		$oke = 0;
	}
	echo '<div class="alert alert-danger"><h3>Pengembangan Diri '.$akr_pd.', minimal '.$ak_pd.'</h3></div>'; 
}
else
{
	echo '<div class="alert alert-success"><h3>Pengembangan Diri '.$akr_pd.', minimal '.$ak_pd.'</div>'; 
}

$akr_piki = $akr_pi + $akr_ki;
if($akr_piki < $ak_pi)
{
	if($oke == 1)
	{
		$oke = 0;
	}
	echo '<div class="alert alert-danger"><h3>Publikasi Ilmiah + Karya Inovatif = '.$akr_pi.' + '.$akr_ki.' = '.$akr_piki.' minimal '.$ak_pi.'</h3></div>'; 
}
else
{
	echo '<div class="alert alert-success"><h3>Publikasi Ilmiah + Karya Inovatif = '.$akr_pi.' + '.$akr_ki.' = '.$akr_piki.' minimal '.$ak_pi.'</div>'; 
}
echo '<div class="alert alert-success"><h3>Penunjang '.$akr_pj.' maksimal '.$akp.'</div>'; 
if($oke == 0)
{
	echo '<div class="alert alert-info"><h1>Mohon maaf, PAK belum dapat diajukan</h1></div>';
}
else
{
{
	echo '<div class="alert alert-success"><h1>Selamat, PAK dapat diajukan</h1></div>';
}

}
echo '<h3>Rangkuman SKP</h3>';
$total = 0;
$tg = $this->db->query("SELECT * FROM `skp_skor_guru` where `nip` = '$nip' and `golongan`='$golongane' order by `kode` ASC, `tahun` DESC");
echo '<table class="table table-striped table-bordered">
<tr><td>Nomor</td><td>Tahun</td><td>Butir Kegiatan</td><td>Cacah Semester</td><td>AK</td><td>Perolehan AK</td></tr>';
foreach($tg->result() as $g)
{
	if($g->ak_r == '0.000')
	{
	}
	else
	{
		$cacah = $g->cacah;
		$kegiatan = $g->kegiatan;
		if(substr($kegiatan,0,7) == 'Panitia')
		{
			$kegiatan .= '<div class="alert alert-danger">SKP ini harus dihapus</div>';
		}

		echo '<tr><td>'.$g->kode.'</td><td>'.$g->tahun.'</td><td>'.$kegiatan;
		$kode = $g->kode;
		$total = $total + $g->ak_r;
		echo '</td><td align="center">'.$g->cacah.'</td><td align="center">'.$g->ak_target.'</td><td align="center">'.$g->ak_r.'</td></tr>';
	}
}
/*
$tg = $this->db->query("SELECT * FROM `skp_skor_guru_kedua` where `nip` = '$nip' and `golongan`='$golongane' order by `kode` ASC, `tahun` DESC");
foreach($tg->result() as $g)
{
	if($g->ak_r == '0.000')
	{
	}
	else
	{
		$cacah = $g->cacah;
		$kegiatan = $g->kegiatan;
		if(substr($kegiatan,0,7) == 'Panitia')
		{
			$kegiatan .= '<div class="alert alert-danger">SKP ini harus dihapus</div>';
		}

		echo '<tr><td>'.$g->kode.'</td><td>'.$g->tahun.'</td><td>'.$kegiatan;
		$total = $total + $ak_r;
		echo '</td><td align="center">'.$g->cacah.'<br /><a href="'.base_url().'dupak/ubahcacahsemester/'.$g->id_skp_skor_guru.'" class="btn btn-success">Ubah<a/></td><td align="center">'.$g->ak.'</td><td align="center">'.$g->ak_r.'</td></tr>';
	}
}
*/
$ti = $this->db->query("select * from `dupak_skp` where `username` = '$nim' and `golongan`='$golongane'");
if($ti->num_rows()>0)
{
	echo '<tr><td colspan="6">SKP TAMBAHAN</tr>';
	foreach($ti->result() as $i)
	{
		$kode = $i->kode;
		$cacah = $i->kuantitas;
		$ak_r = $cacah * $i->ak;
		$total = $total + $ak_r;
		$kegiatan = $this->dupak->Cari_Kegiatan_Berdasar_Kode($kode);
		$tahun = $g->tahun;
		$tk=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nip' and `kode` = '$kode'");
		$pesan = '';
		if($tk->num_rows() >0)
		{
			$pesan = '<div class="alert alert-danger">Sudah ada di SKP, hubungi kepala untuk perbaikan.</div>';
		}

		echo '<tr><td>'.$kode.'</td><td>'.$i->tahun.'</td><td>'.$kegiatan.' '.$pesan;
		echo '</td><td align="center">'.$cacah.'</td><td align="center">'.$i->ak.'</td><td align="center">'.$ak_r.'</td></tr>';
	}
}

echo '<tr><td></td><td colspan="4">Jumlah AK</td><td align="center">'.$total.'</td></tr>';
if($gabungan == 'ada')
{
	echo '<tr><td></td><td colspan="4">DUPAK LAMA</td><td align="center">'.$ak_pbm_lama.'</td></tr>';
}
echo '<tr><td></td><td colspan="4">AK Sebelumnya</td><td align="center">'.$datapaklama['ak'].'</td></tr>';
$ak_sekarang = $datapaklama['ak'] + $total + $ak_pbm_lama;
echo '<tr><td></td><td colspan="4">Jumlah</td><td align="center">'.$ak_sekarang.'</td></tr>';
echo '</table>';

echo '</div></div></div>';
