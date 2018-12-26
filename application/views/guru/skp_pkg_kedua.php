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
<div class="card-header"><h3>Tambah Unsur Utama / PKG</h3></div>
<div class="card-body">

<?php
$tx = $this->db->query("select * from p_pegawai where `kd`='$nim'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;
	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
	$kodelama = $x->kode;
}
$gurubk = 0;
$tc = $this->db->query("select * from `gurubk` where `nip` = '$nippegawai'");
if($tc->num_rows()>0)
{
	$gurubk = 1;
}
if($gurubk == 1)
{
	echo '<h3>Guru BK</h3>';
}
$bisa = 1;
$tahunsekarang=$tahunpenilaian;
$tanggalsekarang = tanggal_hari_ini();
$tahunsaja = tahunsaja($tanggalsekarang);
$bulansaja = bulansaja($tanggalsekarang);
echo '<p><a href="'.base_url().'pkg2/skp/" class="btn btn-info"><b>Kembali</b></a></p>';
$tb = $this->db->query("select * from `ppk_pns_kedua` where `kode`='$nippegawai' and `tahun`='$tahunsekarang'");
foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
	$tawal = $b->tawal;
	$takhir = $b->takhir;
}
$golongan = id_sk_jadi_golongan($idskawal) ;
$pangkat = golongan_jadi_pangkat($idskawal);
$jabatan = golongan_jadi_jabatan($idskawal);
$bulanawal = substr($tawal,5,2);
$bulanakhir = substr($takhir,5,2);
$cacahbulan = $bulanakhir - $bulanawal;
if(($cacahbulan > 0) and ($cacahbulan < 12))
{
	$cacahbulan++;
	echo '<div class="alert alert-info">Masa penilaian '.$cacahbulan.' bulan</div>';
}
else
{
	echo '<div class="alert alert-danger">Masa penilaian bermasalah</div>';
	$bisa = 0;
	echo '<div class="col-sm-3"><label class="control-label">Masa Penilaian</label></div><div class="col-sm-9"><strong>'.date_to_long_string($tawal).'</strong> s.d. <strong>'.date_to_long_string($takhir).'</strong></div>';

}
$tahunsekarang=$tahunpenilaian;
$awal = $tahunpenilaian ;
$akhir = $tahunpenilaian + 1;
$thnajarane = $awal."/".$akhir;
$semestere = 1;
$tz = $this->db->query("select * from `ppk_pns_kedua` where tahun = '$tahunpenilaian' and kode = '$nippegawai'");
$permanen = 1;
foreach($tz->result() as $z)
{
	$permanen = $z->permanen;
}
if($permanen == 0)
{
	if(($status=='baru') or ($status=='lama'))
	{
		//CARI ANGKA KREDIT
		if ($predikat == 'Amat baik')
		{
			$kriteria = 'a';
		}
		else
		{
			$kriteria = 'b';
		}
		$ak = 0;
		$ty = $this->db->query("select * from `skp_skor` where `kriteria`='$kriteria' and `golongan`='$golongan'");
		foreach($ty->result() as $y)
		{
			$ak = $y->skor;
		}
		$ak_target = $ak;
		$persentase = $waktu / 12;
		$ak_target = $ak * $persentase;
		$ak = $ak * $persentase;

		if($gurubk == 0)
		{
			$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.') ( 100% x '.$ak.')';
			//cek apakah mendapat tugas tambahan
			$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajarane' and semester='$semestere' and `kodeguru` = '$kodelama'");
			$kegiatan1='';
			$adatambahan = 0;
			foreach($ttambahan->result() as $dtambahan)
			{
				$tambahan = $dtambahan->nama_tugas;
			}
			if (substr($tambahan,0,4)=='Waka')
			{
				$ak_target = $ak / 2;
				$aktambahan_target = $ak / 2;
				$adatambahan = 1;
				$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.')  ( 50% x '.$ak.')';
				$kegiatan1 = ''.$tambahan.' dengan sebutan '.$predikat.' ( 50% x '.$ak.')';
			}
			if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
			{
				$ak_target = $ak / 4;
				$aktambahan_target = $ak * 0.75;
				$adatambahan = 1;
				$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.') ( 25% x '.$ak.')';
				$kegiatan1 = 'Menjadi kepala madrasah dengan sebutan '.$predikat.' ( 75% x '.$ak.')';
			}
			if ((substr($tambahan,0,10)=='Kepala Lab') or (substr($tambahan,0,10)=='Kepala Per'))
			{
				$ak_target = $ak / 2;
				$aktambahan_target = $ak / 2;
				$adatambahan = 1;
				$kegiatan = 'Melaksanakan Proses Pembelajaran (PKG) (sebutan '.$predikat.') ( 50% x '.$ak.')';
				$kegiatan1 = ''.$tambahan.' dengan sebutan '.$predikat.' ( 50% x '.$ak.')';
			}
		}
		if($gurubk == 1)
		{
			$kegiatan = 'Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai, menganalisis hasil penilaian, melaksanakan tindak lanjut hasil penilaian dan melaksanakan bimbingan di kelas';
		}
		if (($golongan=='III/a') or ($golongan=='III/b') or ($golongan=='III/c') or ($golongan=='III/d') or ($golongan=='IV/a') or ($golongan=='IV/b') or ($golongan=='IV/c') or ($golongan=='IV/d'))
		{
			$kegiatan = $kegiatan;
		}
		else
		{
			$kegiatan .= '<h2><strong>Golongan '.$golongan.' tidak sesuai dengan aplikasi, mutakhirkan data SK Kepegawaian per semester <a href="'.base_url().'pkg2/sk">di sini</a> lalu mutakhirkan data skp unsur tugas relevan.</strong></h2><BR>';
		}
		$tz = 	$this->db->query("select * from `skp_skor_guru_kedua` where `kode` = '00' and `nip` = '$nippegawai' and `tahun`='$tahunpenilaian'");
		$ada = $tz->num_rows();
		if($ada == 0)
		{
			$this->db->query("INSERT INTO `skp_skor_guru_kedua` (`kode`,`unsur`, `kegiatan`, `ak`,`ak_target`,`kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `tahun`,`status`) VALUES ('00', 'B', '$kegiatan', '$ak', '$ak_target','1', 'Laporan', '100', '$waktu', 'Bl', '0', '$nippegawai', '$tahunsekarang','0')");
		} // akhir kalau baru
		else
		{
			$this->db->query("update `skp_skor_guru_kedua` set `kegiatan`='$kegiatan', `ak`='$ak', `ak_target`='$ak_target', `status`='0', `waktu`='$waktu' where `nip`='$nippegawai' and `tahun`='$tahunsekarang' and `kode`='00'");
		}
		//cek tambahan sudah ada?
		if($gurubk == 0)
		{
			if((!empty($tambahan)) and ($adatambahan == 1))
			{
				$ta=$this->db->query("select * from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `kode`='01'");
				$ada = $ta->num_rows();
				if($ada == 0)
				{
					$this->db->query("INSERT INTO `skp_skor_guru_kedua` (`kode`,`unsur`, `kegiatan`, `ak`,`ak_target`,`kuantitas`, `satuan`, `kualitas`, `waktu`, `satuanwaktu`, `biaya`, `nip`, `tahun`,`status`) VALUES ('01', 'B', '$kegiatan1', '$ak', '$aktambahan_target','1', 'Laporan', '100', '$waktu', 'Bl', '0', '$nippegawai', '$tahunsekarang','0')");
				}
				else
				{
					$this->db->query("update `skp_skor_guru_kedua` set `kegiatan`='$kegiatan1', `ak`='$ak', `ak_target`='$aktambahan_target', `status`='0' , `waktu`='$waktu' where `nip`='$nippegawai' and `tahun`='$tahunsekarang' and `kode`='01'");
				}
			}
		}
		if((empty($tambahan)) or ($adatambahan == 0))
		{
			$this->db->query("delete from `skp_skor_guru_kedua` where `nip`='$nippegawai' and `tahun`='$tahunsekarang' and `kode`='01'");
		}
		header('Location: '.base_url().'pkg2/skp/'.$status.''); //redirect browser to public main page
	}
	$ta=$this->db->query("select * from `skp_skor_guru_kedua` where `tahun`='$tahunsekarang' and `nip`='$nippegawai' and `unsur`='B' and `kegiatan` like 'Unsur%'");
	if(count($ta->result())==0)
	{
		$status='baru';
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$keterangan = $a->keterangan;
			$status='lama';
		}
	}
	if($bisa == 1)
	{
		echo form_open('pkg2/tambahskp/pkg','class="form-horizontal" role="form"');
		echo '
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><p class="form-control-static"> <strong>'.$tahunsekarang.'</strong> Tahun Pelajaran <strong>'.$thnajarane.'</strong> Semester <strong> '.$semestere.'</strong></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Masa Penilaian</label></div><div class="col-sm-9"><p class="form-control-static"> <strong>'.date_to_long_string($tawal).'</strong> s.d. <strong>'.date_to_long_string($takhir).'</strong></p></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Golongan Saat SKP</label></div><div class="col-sm-9">
		<input type="text" name="golongan" class="form-control" value="'.$golongan.'" readonly></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pembelajaran (PKG) dengan sebutan</label></div><div class="col-sm-9">
		<select name="predikat" class="form-control">';
		if (empty($keterangan))
		{
			echo '<option value ="Amat baik">Amat baik</option>
			<option value ="Baik">Baik</option>';
		}
		else
		{
			echo '<option value ="'.$keterangan.'">'.$keterangan.'</option>
			<option value ="Amat baik">Amat baik</option>
			<option value ="Baik">Baik</option>';
		}
		echo '</select></div></div>
		<input type="hidden" name="status"  value ="'.$status.'"><input type="hidden" name="waktu"  value ="'.$cacahbulan.'">
		<input type="hidden" name="unsur"  value ="A"><p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
		</form>';
	}
}
else
{
	echo 'Sudah terproses, batalkan dulu';
}
echo '</div></div></div>';
?>

