<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 04 Nov 2014 22:38:01 WIB 
// Nama Berkas 		: pkg_rekap.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php $judulhalaman;?></title>
</head>
<body>
<div class="potret">
<div class="container-fluid">
<table width="100%">
<tr><td align ="center"><a href="<?php echo base_url();?>pkg"><h2>REKAP HASIL PENILAIAN KINERJA GURU</h2></a></td></tr></table>


<?php
$tahun = $tahunpenilaian;
$tx = $this->db->query("select * from p_pegawai where `kd`='$kodeguru'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;
	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
/*
	$ = $x->;
*/
}
$bulantmt ='';
$tahuntmt ='';
$tahunmasa = '';
$bulanmasa ='';
$pangkatgolongan = '';
$tkepeg = $this->db->query("select * from p_kepegawaian where idpegawai = '$usernamepegawai' order by tanggal DESC limit 0,1 ");
foreach($tkepeg->result() as $dkepeg)
{
	$pangkat = $dkepeg->pangkat;
	$golongan = substr($dkepeg->gol,3,10);
	if(($golongan=='III/a') or ($golongan=='III/b'))
		{
		$jabatan = 'Guru pertama';
		}
	if(($golongan=='III/c') or ($golongan=='III/d'))
		{
		$jabatan = 'Guru muda';
		}
	if(($golongan=='IV/a') or ($golongan=='IV/b'))
		{
		$jabatan = 'Guru madya';
		}
	if(($golongan=='IV/c') or ($golongan=='IV/d'))
		{
		$jabatan = 'Guru utama';
		}

	$pangkatgolongan = $pangkat.'/'.$jabatan.'/'.$golongan;
	$tahunmasa = $dkepeg->tahun;
	$bulanmasa = $dkepeg->bulan;	
	$tahuntmt = substr($dkepeg->tmt,0,4);
	$bulantmt = substr($dkepeg->tmt,5,2);

}
//$tahunsekarang = date("Y");
$tahunsekarang = $tahunpenilaian;
$tmasa = $this->db->query("select * from pkg_masa where tahun='$tahunsekarang'");
foreach($tmasa->result() as $dmasa)
{
	$tanggalkp4 = $dmasa->akhir;
	$tanggalawal = $dmasa->awal;
	$tanggalakhir = $dmasa->akhir;
}
$tahunkp4 = substr($tanggalkp4,0,4);
$bulankp4 = substr($tanggalkp4,5,2);

if ($bulankp4<$bulantmt)
	{$bulankp4 = $bulankp4+12;
	$tahunkp4 = $tahunkp4 - 1;
	}
$jmlbulan = $bulankp4 - $bulantmt;
$jmltahun = $tahunkp4 - $tahuntmt;
if ($jmlbulan > 11)
	{
	$jmlbulan = $jmlbulan - 12;
	$jmltahun = $jmltahun + 1;
	}

$tahungol = $tahunmasa + $jmltahun;
$bulangol = $bulanmasa + $jmlbulan;
if ($bulangol>11)
	{$bulangol=0;
	 $tahungol++;
	}
$tpend = $this->db->query("select * from p_pendidikan where idpegawai = '$usernamepegawai' order by tanggalijazah DESC limit 0,1 ");
$tingkat = 'belum ada data pendidikan terakhir';
$jurusan = 'fakultas / jurusan dalam pendidikan terakhir belum ditentukan';
foreach($tpend->result() as $dpend)
{
	$tingkat = $dpend->tingkat;
	$jurusan = $dpend->jurusan;
}
	// cari mapel skbk
	$tmapelx = $this->db->query("select * from m_mapel_skbk where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");

	$mapele = '';
	foreach($tmapelx->result() as $dmapelx)
	{
		if (!empty($mapele))
			{
			$mapele .= ', '.$dmapelx->mapel;
			}
			else
			{
			$mapele .= $dmapelx->mapel;
			}
	}

$namasekolah = $this->config->item('sek_nama');
$teleponsekolah = $this->config->item('sek_telepon');
$desa = $this->config->item('sek_desa');
$kec = $this->config->item('sek_kec');
$kab = $this->config->item('sek_kab');
$prov = $this->config->item('sek_prov');
?>
<table width="100%">
<tr><td>Nama</td><td width="10">:</td><td><?php echo $nama;?></td></tr>
<tr><td>NIP</td><td width="10">:</td><td><?php echo $nippegawai;?></td></tr>
<tr><td>Tempat/Tanggal Lahir</td><td width="10">:</td><td><?php echo $tempat;?>, <?php echo date_to_long_string($tgllhr);?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan</td><td width="10">:</td><td><?php echo $pangkatgolongan;?></td></tr>
<tr><td>TMT sebagai CPNS / guru</td><td width="10">:</td><td><?php echo date_to_long_string($tmtguru);?></td></tr>
<tr><td>Masa kerja</td><td width="10">:</td><td><?php echo $tahungol;?> tahun <?php echo $bulangol;?> bulan</td></tr>
<tr><td>Jenis Kelamin</td><td width="10">:</td><td><?php echo $jenkel;?></td></tr>
<tr><td>Pendidikan Terakhir/Spesialisasi</td><td width="10">:</td><td><?php echo "$tingkat/$jurusan";?></td></tr>
<tr><td>Program Keahlian yang diampu</td><td width="10">:</td><td><?php echo $mapele;?></td></tr>
<tr><td>Nama Instansi/Sekolah</td><td width="10">:</td><td><?php echo $namasekolah;?></td></tr>
<tr><td>Telp/Fax</td><td width="10">:</td><td><?php echo $teleponsekolah;?></td></tr>
<tr><td>Kelurahan</td><td width="10">:</td><td><?php echo $desa;?></td></tr>
<tr><td>Kecamatan</td><td width="10">:</td><td><?php echo $kec;?></td></tr>
<tr><td>Kabupaten/Kota</td><td width="10">:</td><td><?php echo $kab;?></td></tr>
<tr><td>Provinsi</td><td width="10">:</td><td><?php echo $prov;?></td></tr>
<tr><td>Tahun</td><td width="10">:</td><td><?php echo $tahunsekarang;?></td></tr>
<tr><td>Periode Penilaian</td><td width="10">:</td><td><?php echo date_to_long_string($tanggalawal);?> s.d. <?php echo date_to_long_string($tanggalakhir);?></td></tr>
<tr><td>Formatif</td><td width="10">:</td><td></td></tr>
<tr><td>Sumatif</td><td width="10">:</td><td></td></tr>
<tr><td>Kemajuan</td><td width="10">:</td><td></td></tr>
</table>
<table class="table table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Kompetensi</strong></td><td><strong>Nilai</strong></td></tr>
<tr><td colspan="10"><strong>A. Pedagogik</strong></td></tr>
<?php

$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='A' and `untuk`='guru' order by nourut");
$nomor = 1;
$jskor = 0;
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$tahun'");
		
		foreach($tc->result() as $c)
			{
			$nskor = $nskor + $c->skor;
			}
		$cacah_indikator++;
		}
		$skormaks = 2 * $cacah_indikator;
		$persentase = $nskor / $skormaks * 100;
		$nilai = 0;
		if (($persentase > 0) and ($persentase<=25))
			{
			$nilai = 1;
			}
		if (($persentase > 25) and ($persentase<=50))
			{
			$nilai = 2;
			}
		if (($persentase > 50) and ($persentase<=75))
			{
			$nilai = 3;
			}
		if ($persentase > 75)
			{
			$nilai = 4;
			}

	echo $nilai;
	$jskor = $jskor + $nilai;

	$nomor++;
	echo '</td></tr>';
	}

?>
<tr><td colspan="10"><strong>B. Kepribadian</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='B' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$tahun'");

		foreach($tc->result() as $c)
			{
			$nskor = $nskor + $c->skor;
			}
		$cacah_indikator++;
		}
		$skormaks = 2 * $cacah_indikator;
		$persentase = $nskor / $skormaks * 100;
		$nilai = 0;
		if (($persentase > 0) and ($persentase<=25))
			{
			$nilai = 1;
			}
		if (($persentase > 25) and ($persentase<=50))
			{
			$nilai = 2;
			}
		if (($persentase > 50) and ($persentase<=75))
			{
			$nilai = 3;
			}
		if ($persentase > 75)
			{
			$nilai = 4;
			}

	echo $nilai;
	$jskor = $jskor + $nilai;

	$nomor++;
	echo '</td></tr>';
	}

?>
<tr><td colspan="10"><strong>C. Sosial</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='C' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator=0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$tahun'");

		foreach($tc->result() as $c)
			{
			$nskor = $nskor + $c->skor;
//			echo $c->skor;echo '';
			}
		$cacah_indikator++;
		}
		$skormaks = 2 * $cacah_indikator;
		$persentase = $nskor / $skormaks * 100;
		$nilai = 0;
		if (($persentase > 0) and ($persentase<=25))
			{
			$nilai = 1;
			}
		if (($persentase > 25) and ($persentase<=50))
			{
			$nilai = 2;
			}
		if (($persentase > 50) and ($persentase<=75))
			{
			$nilai = 3;
			}
		if ($persentase > 75)
			{
			$nilai = 4;
			}

	echo $nilai;
	$jskor = $jskor + $nilai;

	$nomor++;
	echo '</td></tr>';
	}

?>
<tr><td colspan="10"><strong>D. Profesional</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='D' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$tahun'");

		foreach($tc->result() as $c)
			{
			$nskor = $nskor + $c->skor;
//			echo $nskor;echo '';
			}
		$cacah_indikator++;
		}
		$skormaks = 2 * $cacah_indikator;
		$persentase = $nskor / $skormaks * 100;
		$nilai = 0;
		if (($persentase > 0) and ($persentase<=25))
			{
			$nilai = 1;
			}
		if (($persentase > 25) and ($persentase<=50))
			{
			$nilai = 2;
			}
		if (($persentase > 50) and ($persentase<=75))
			{
			$nilai = 3;
			}
		if ($persentase > 75)
			{
			$nilai = 4;
			}

	echo $nilai;
	$jskor = $jskor + $nilai;

	$nomor++;

	echo '</td></tr>';
	}
$jskore = $jskor / 56 * 100;
$sebutan = 'Buruk';
if ($jskore > 76)
	{
	$sebutan = 'Baik';
	}
if ($jskore == 76)
	{
	$sebutan = 'Baik';
	}
if ($jskore == 91)
	{
	$sebutan = 'Amat Baik';
	}

if ($jskore > 91)
	{
	$sebutan = 'Amat Baik';
	}


echo '<tr><td></td><td align="center">Jumlah (Hasil Penilaian Kinerja Guru)
</td><td align="center">'.$jskor.'</td></tr>
<tr><td></td><td align="center">Sebutan
</td><td align="center">'.$sebutan.'</td></tr></table>';
echo '*) Nilai diisi berdasarkan laporan dan evaluasi PK Guru. Nilai minimum per kompetensi = 1 dan nilai maksimum = 4';
//cari penilai
$kodepenilai='??';
$tpenilai = $this->db->query("select * from pkg_tim_penilai where tahun='$tahunsekarang' and kode_ternilai='$kodeguru'");
foreach($tpenilai->result() as $dpenilai)
	{
	$kodepenilai=$dpenilai->kode_penilai;
	}
$namapenilai = cari_nama_pegawai($kodepenilai);
$nippenilai = cari_nip_pegawai($kodepenilai);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);


?>
<br /><br />
<table width="670" cellpadding="2" cellspacing="1">
<tr><td colspan="3" width="470"></td><td><?php echo $this->config->item('lokasi');?>, <?php echo date_to_long_string($tanggalakhir);?></td></tr><tr><td></td><td >Guru yang dinilai,<br /><br /><br /></td><td width="250">Penilai,<br /><br /><br /></td><td >Kepala <?php echo $this->config->item('sek_nama');?>,<br /><br /><br /></td></tr><tr><td colspan="4"></td></tr>
<tr><td></td><td><?php echo $nama;?></td><td><?php echo $namapenilai;?></td><td><?php echo $namakepala;?></td></tr>
<tr><td></td><td><?php echo 'NIP '.$nippegawai;?></td><td><?php echo 'NIP '.$nippenilai;?></td><td><?php echo 'NIP '.$nipkepala;?></td></tr>
</table>


</div>

</div>
