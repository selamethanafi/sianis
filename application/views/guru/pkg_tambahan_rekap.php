<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 08:43:21 WIB 
// Nama Berkas 		: pkg_tambahan_reakp.php
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

<?php
	//2014 JADI 2014/2015 SMT 1
	$awal = $tahunpenilaian;
	$akhir = $tahunpenilaian+1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;
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
//	$tz = $this->db->query("SELECT * from `tbldosen` where `kodeguru`='$kodeguru'");
//	foreach($tz->result() as $z)
//	{
//		$thnajaran = $z->thnajaran;
//		$semester = $z->semester;
//	}
$id_sk = '';
$bulantmt = '';
$tahuntmt = '';
$tahunmasa = '';
$bulanmasa = '';
$pangkatgolongan = '';
$jabatan = '';
$tsk = $this->db->query("SELECT * FROM `p_tugas_tambahan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
foreach($tsk->result() as $dsk)
	{
	$id_sk = $dsk->id_sk;
	}
$tkepeg = $this->db->query("select * from p_kepegawaian where id = '$id_sk'");
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

	$pangkatgolongan = $pangkat.'/'.$golongan;
	$tahunmasa = $dkepeg->tahun;
	$bulanmasa = $dkepeg->bulan;	
	$tahuntmt = substr($dkepeg->tmt,0,4);
	$bulantmt = substr($dkepeg->tmt,5,2);

}

$tmasa = $this->db->query("select * from pkg_masa where tahun='$tahunpenilaian'");
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

//cek apakah mendapat tugas tambahan
$skorx = 2;
$untuk = 'xxxxx';
$tax = $this->db->query("select * from `p_tugas_tambahan` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and semester='$semester'");
if(count($tax->result())>0)
{
	foreach($tax->result() as $ax)
	{
		$tambahan = $ax->nama_tugas;
	}
		
		if (substr($tambahan,0,10)=='Kepala Mad')
		{
		$untuk = 'kepala madrasah';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Kuri')
		{
		$untuk = 'waka kurikulum';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Sara')
		{
		$untuk = 'waka sarana';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Kesi')
		{
		$untuk = 'waka kesiswaan';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Waka Madrasah Huma')
		{
		$untuk = 'waka humas';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Kepala Laboratoriu')
		{
		$untuk = 'kepala laboratorium';
		$skorx = 4;
		}
		if (substr($tambahan,0,18)=='Kepala Perpustakaa')
		{
		$untuk = 'kepala perpustakaan';
		$skorx = 4;
		}

}
//cari penilai
$tpenilai = $this->db->query("select * from pkg_tim_penilai where tahun='$tahunpenilaian' and kode_ternilai='$kodeguru'");
$kodepenilai ='??';
foreach($tpenilai->result() as $dpenilai)
	{
	$kodepenilai=$dpenilai->kode_penilai;
	}
$namapenilai = cari_nama_pegawai($kodepenilai);
$nippenilai = cari_nip_pegawai($kodepenilai);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$txx = $this->db->query("select * from p_pegawai where `nip`='$nipkepala'");
foreach($txx->result() as $xx)
{
	$usernamepegawaix = $xx->kd;
}
//data kepala
$bulantmtx = '';
$tahuntmtx = '';
$tahunmasax = '';
$bulanmasax = '';	
$pangkatx = '';
$golonganx = '';
$pangkatgolonganx='';
$tmtx = '';
$tahungolx= '';
$bulangolx='';
$tkepegx = $this->db->query("select * from p_kepegawaian where idpegawai = '$usernamepegawaix' order by tanggal DESC limit 0,1 ");
foreach($tkepegx->result() as $dkepegx)
{
	$pangkatx = $dkepegx->pangkat;
	$golonganx = substr($dkepegx->gol,3,10);
	if(($golonganx=='III/a') or ($golonganx=='III/b'))
		{
		$jabatanx = 'Guru pertama';
		}
	if(($golonganx=='III/c') or ($golonganx=='III/d'))
		{
		$jabatanx = 'Guru muda';
		}
	if(($golonganx=='IV/a') or ($golonganx=='IV/b'))
		{
		$jabatanx = 'Guru madya';
		}
	if(($golonganx=='IV/c') or ($golonganx=='IV/d'))
		{
		$jabatanx = 'Guru utama';
		}
	
	$pangkatgolonganx = $pangkatx.'/'.$jabatanx.'/'.$golonganx;
	$tahunmasax = $dkepegx->tahun;
	$bulanmasax = $dkepegx->bulan;	
	$tahuntmtx = substr($dkepegx->tmt,0,4);
	$bulantmtx = substr($dkepegx->tmt,5,2);
	$tmtx = $dkepegx->tmt;
	}
$bulankp4x = $bulankp4;
$tahunkp4x = $tahunkp4;
if ($bulankp4x<$bulantmtx)
	{$bulankp4x = $bulankp4x+12;
	$tahunkp4x = $tahunkp4x - 1;
	}
$jmlbulanx = $bulankp4x - $bulantmtx;
$jmltahunx = $tahunkp4x - $tahuntmtx;
if ($jmlbulanx > 11)
	{
	$jmlbulanx = $jmlbulanx - 12;
	$jmltahunx = $jmltahunx + 1;
	}

$tahungolx = $tahunmasax + $jmltahunx;
$bulangolx = $bulanmasax + $jmlbulanx;
if ($bulangolx>11)
	{$bulangolx=0;
	 $tahungolx++;
	}


?>
<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td align ="LEFT"><a href="<?php echo base_url();?>pkg/tambahan"><h2>Format 1F</h2></a></td></tr>
<tr><td align ="center"><h2>INSTRUMEN<BR>PENILAIAN KINERJA GURU (PKG)<BR>SEBAGAI <?php echo strtoupper($tambahan);?></h2></a></td></tr></table>

<table width="100%">
<tr><td colspan="10">Yang bertanda tangan di bawah ini</td></tr>
<tr><td>Nama</td><td width="10">:</td><td><?php echo $namakepala;?></td></tr>
<tr><td>NIP</td><td width="10">:</td><td><?php echo $nipkepala;?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan</td><td width="10">:</td><td><?php echo $pangkatgolonganx;?></td></tr>
<tr><td>TMT</td><td width="10">:</td><td><?php echo date_to_long_string($tmtx);?></td></tr>
<tr><td>Masa kerja</td><td width="10">:</td><td><?php echo $tahungolx;?> tahun <?php echo $bulangolx;?> bulan</td></tr>
<tr><td>Jabatan</td><td width="10">:</td><td><?php echo $this->config->item('plt');?>Kepala Madrasah</td></tr>
<tr><td>Unit kerja</td><td width="10">:</td><td><?php echo $namasekolah;?></td></tr>
<tr><td colspan="10">menyatakan bahwa</td></tr>
<tr><td colspan="10">&nbsp;</td></tr>
<tr><td>Nama</td><td width="10">:</td><td><?php echo $nama;?></td></tr>
<tr><td>NIP</td><td width="10">:</td><td><?php echo $nippegawai;?></td></tr>
<tr><td>Tempat/Tanggal Lahir</td><td width="10">:</td><td><?php echo $tempat;?>, <?php echo date_to_long_string($tgllhr);?></td></tr>
<tr><td>Pangkat/Golongan</td><td width="10">:</td><td><?php echo $pangkatgolongan;?></td></tr>
<tr><td>TMT</td><td width="10">:</td><td><?php echo date_to_long_string($tmtguru);?></td></tr>
<tr><td>Jabatan</td><td width="10">:</td><td><?php echo $jabatan;?></td></tr>
<tr><td>Unit kerja</td><td width="10">:</td><td><?php echo $namasekolah;?></td></tr>
<tr><td colspan="10">&nbsp;</td></tr>
<tr><td colspan="10">telah melakukan kegiatan tugas tambahan sebagai <?php echo $tambahan;?> dengan penilaian sebagai berikut:&nbsp;</td></tr>
</table>
<table width="670" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr align="center"><td><strong>No.</strong></td><td><strong>Kompetensi</strong></td><td><strong>Kode</strong></td><td><strong>Skor Rata -rata</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `untuk`='$untuk' order by kelompok");
$nomor = 1;
$jskor = 0;
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align=\"center\">".$a->kelompok."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$tahunpenilaian'");
		
		foreach($tc->result() as $c)
			{
			$nskor = $nskor + $c->skor;
			}
		$cacah_indikator++;
//		echo ' '.$c->skor.' ';
		}
		$rata = $nskor / $cacah_indikator;
	echo round($rata,2);
	$jskor = $jskor + $rata;
	//echo ' - '.$jskor.'';
	$nomor++;
	echo '</td></tr>';
	}
$cacah_kompetensi = $nomor - 1;
$skortertinggi = $skorx * $cacah_kompetensi;
if ($skortertinggi > 0 )
	{
	$jskore = $jskor / $skortertinggi * 100;
	}
	else
	{
	$jskore = 0;
	}
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

echo '<tr><td></td><td align="center">Total Skor Rata - rata</td><td align="center"></td><td align="center">'.round($jskor,2).'</td></tr>
<tr><td></td><td align="center">Persentase Skor</td><td align="center"></td><td align="center">'.round($jskore,2).'</td></tr><tr><td></td><td align="center">Sebutan</td><td align="center"></td><td align="center">'.$sebutan.'</td></tr></table>';
?>
<br /><br />
<table width="670" cellpadding="2" cellspacing="1">
<tr><td colspan="3" width="470"></td><td><?php echo $this->config->item('lokasi');?>, <?php echo date_to_long_string($tanggalakhir);?></td></tr><tr><td></td><td >Guru yang dinilai,<br /><br /><br /><br /></td><td width="250">Penilai,<br /><br /><br /><br /></td><td><?php echo $this->config->item('plt');?>Kepala,<br /><br /><br /><br /></td></tr><tr><td colspan="4"></td></tr>
<tr><td></td><td><?php echo $nama;?></td><td><?php echo $namapenilai;?></td><td><?php echo $namakepala;?></td></tr>
<tr><td></td><td><?php echo 'NIP '.$nippegawai;?></td><td><?php echo 'NIP '.$nippenilai;?></td><td><?php echo 'NIP '.$nipkepala;?></td></tr>

</table>


</div>

</div></div>
