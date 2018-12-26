<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 08:43:21 WIB 
// Nama Berkas 		: pkg_angka_kredit.php
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

$sebutantambahan = '';
$aksetahun2 = 0;
$aksetahun = 0;
$tahunsekarang = $tahunpenilaian;
$tx = $this->db->query("select * from p_pegawai where `kode`='$kodeguru'");
foreach($tx->result() as $x)
{
	$nippegawai = $x->nip;
	$tempat = $x->tempat;
	$tgllhr = $x->tanggallahir;

	$usernamepegawai = $x->kd;
	$tmtguru = $x->tmt_guru;
	$jenkel = $x->jenkel;
}
	//2014 JADI 2014/2015 SMT 1
	$awal = $tahunpenilaian;
	$akhir = $tahunpenilaian+1;
	$thnajaran = $awal."/".$akhir;
	$semester = 1;

	//2014 JADI 2013/2014 SMT 2
	$awal1 = $tahunpenilaian - 1;
	$akhir1 = $tahunpenilaian;
	$thnajaran1 = $awal1."/".$akhir1;
	$semester1 = 1;

$id_sk = '';
$tsk = $this->db->query("SELECT * FROM `p_tugas_tambahan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
foreach($tsk->result() as $dsk)
	{
	$id_sk = $dsk->id_sk;
	}
$tkepeg = $this->db->query("select * from p_kepegawaian where id = '$id_sk'");
$pangkatgolongan = '?????????';
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

	$pangkatgolongan = $pangkat.', '.$golongan;
	$tahunmasa = $dkepeg->tahun;
	$bulanmasa = $dkepeg->bulan;	
	$tahuntmt = substr($dkepeg->tmt,0,4);
	$bulantmt = substr($dkepeg->tmt,5,2);

}

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
<table class="table table-bordered table-striped">
<tr><td>Nama</td><td><?php echo cari_nama_pegawai($kodeguru);?></td></tr>
<tr><td>NIP</td><td><?php echo $nippegawai;?></td></tr>
<tr><td>Tempat/Tanggal Lahir</td><td><?php echo $tempat;?>, <?php echo date_to_long_string($tgllhr);?></td></tr>
<tr><td>Pangkat/Jabatan/Golongan</td><td><?php echo $pangkatgolongan;?></td></tr>
</table><br><br>
<?php

$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='A' and `untuk`='guru' order by nourut");
$nomor = 1;
$jskor = 0;
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
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


	$jskor = $jskor + $nilai;
	$nomor++;

	}

?>

<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='B' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
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

	$jskor = $jskor + $nilai;
	$nomor++;
	}

?>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='C' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
		if(($nomor%2)==0){
			$warna="#C8E862";
		} else{
			$warna="#D6F3FF";
		}
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator=0;
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

	$jskor = $jskor + $nilai;
	$nomor++;
	}

?>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='D' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
	$id_kompetensi = $a->id_pkg_m_kompetensi;
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

	$jskor = $jskor + $nilai;
	$nomor++;
	}

if ($jskor < 76)
	{
	$sebutan = 'BURUK';
	}
if (($jskor == 76) or ($jskor > 76))
	{
	$sebutan = 'Baik';
	}
if ($jskor > 90)
	{
	$sebutan = 'Amat Baik';
	}
echo '<table class="table table-striped table-bordered">
<tr><td>Nilai PK Guru</td><td align="center"><strong>'.$jskor.'</strong></td></tr>
<tr><td>Konversi Nilai PK Guru ke dalam skala 0 - 100 sesuai permenneg PAN dan RM Nomor 16 Tahun 2009 dengan Rumus<br>
Nilai PKG (100) = (Nilai PKG / Nilai PKG Tertinggi) x 100<br>
Nilai PKG (100) = ('.$jskor.' / 56) x 100</td>';
$nilaipkg = $jskor / 56 * 100;
echo '<td align="center" valign="bottom"><strong>'.round($nilaipkg,2).'</strong></td></tr>
<tr><td colspan="2">Berdasarkan hasil konversi ke dalam skala sesuai peraturan tersebut selanjutnya ditetapkan sebutan dan persentase angka kreditnya</td></tr>
<tr><td>Nilai PKG tersebut mendapat sebutan</td>';
$sebutan = 'Kurang';
$npk = 25;
if (($nilaipkg>51) or ($nilaipkg==51))
	{
	$sebutan = 'Sedang';
	$npk = 50;
	}
if (($nilaipkg>61) or ($nilaipkg==61))
	{
	$sebutan = 'Cukup';
	$npk = 75;
	}
if (($nilaipkg>76) or ($nilaipkg==76))
	{
	$sebutan = 'Baik';
	$npk = 100;
	}

if ( ($nilaipkg>91) or ($nilaipkg==91))
	{
	$sebutan = 'Amat Baik';
	$npk = 125;
	}
$sebutanguru = $sebutan;
echo '<td align="center"><strong>'.$sebutan.'</strong></td></tr>
<tr><td>Nilai persentase angka kredit </td><td align="center"><strong>'.$npk.' %</strong></td></tr>';

if ($golongan=='III/a')
	{
	$ak = 100;
	$akk = 50;
	$akpkb =  3+0;
	$akp = 5;
	$kegolongan = 'III/b';
	}
if ($golongan=='III/b')
	{
	$ak = 150;
	$akk = 50;
	$akpkb =  3+4;
	$akp = 5;
	$kegolongan = 'III/c';
	}
if ($golongan=='III/c')
	{
	$ak = 200;
	$akk = 100;
	$akpkb =  3+6;
	$akp = 10;
	$kegolongan = 'III/d';
	}
if ($golongan=='III/d')
	{
	$ak = 300;
	$akk = 100;
	$akpkb =  4+8;
	$akp = 10;
	$kegolongan = 'IV/a';
	}
if ($golongan=='IV/a')
	{
	$ak = 400;
	$akk = 150;
	$akpkb =  4+12;
	$akp = 15;
	$kegolongan = 'IV/b';
	}
if ($golongan=='IV/b')
	{
	$ak = 550;
	$akk = 150;
	$akpkb =  4+12;
	$akp = 15;
	$kegolongan = 'IV/c';
	}
if ($golongan=='IV/c')
	{
	$ak = 700;
	$akk = 150;
	$akpkb =  5+14;
	$akp = 15;
	$kegolongan = 'IV/d';
	}
if ($golongan=='IV/d')
	{
	$ak = 850;
	$akk = 200;
	$akpkb =  5+20;
	$akp = 20;
	$kegolongan = 'IV/e';
	}
echo '
<tr>
	<td>
		<table class="table table-striped table-bordered">
			<tr align="center"><td>AKK Minimal Golongan</td><td>AKPKB Minimal</td><td>AKP Minimal</td></tr>
			<tr><td align="center"><strong>'.$akk.'</strong></td><td align="center"><strong>'.$akpkb.'</strong></td><td align="center"><strong>'.$akp.'</strong></td></tr>
			<tr><td colspan="3" align="center">'.$golongan.' ke '.$kegolongan.'</td></tr>
		</table>
		<br>
	Perolehan angka kredit (untuk pembelajaran) dihitung berdasarkan rumus berikut<br>
	Angka kredit 1 tahun = ((AKK - AKPKB - AKP) x (JW/JWM) x NPK)/4<br>';
	$ttambahan1 = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran1' and semester='$semester1' and kodeguru = '$kodeguru'");
	$tambahan1 = '';
	foreach($ttambahan1->result() as $dtambahan1)
		{
		$tambahan1 = $dtambahan1->nama_tugas;
		}
	if (substr($tambahan1,0,10)=='Kepala Mad')
		{
		$adatambahan1 = 1;
		}
	if (substr($tambahan1,0,4)=='Waka')
		{
		$adatambahan1 = 1;
		}
	if (substr($tambahan1,0,10)=='Kepala Lab')
		{
		$adatambahan1 = 1;
		}
	if (substr($tambahan1,0,10)=='Kepala Per')
		{
		$adatambahan1 = 1;
		}

	$ttambahan = $this->db->query("select * from p_tugas_tambahan where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$tambahan = '';
	$jwtambahan = 0;
	foreach($ttambahan->result() as $dtambahan)
		{
		$tambahan = $dtambahan->nama_tugas;
		$jwtambahan = $dtambahan->jtm;
		}
	$jwm = 24;
	$adatambahan = 0;
	if (substr($tambahan,0,10)=='Kepala Mad')
		{
		$jwm = 6;
		$kg = 0.25;
		$kt = 0.75;
		$pktmaks = 24;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if (substr($tambahan,0,4)=='Waka')
		{
		$jwm = 12;
		$kg = 0.5;
		$kt = 0.5;
		$pktmaks = 20;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if (substr($tambahan,0,10)=='Kepala Lab')
		{
		$jwm = 12;
		$kg = 0.5;
		$kt = 0.5;
		$pktmaks = 28;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if (substr($tambahan,0,10)=='Kepala Per')
		{
		$jwm = 12;
		$kg = 0.5;
		$kt = 0.5;
		$pktmaks = 40;
		$adatambahan = 1;
		$jwtambahan = 0;
		}
	if ($tambahan=='Bimbingan TIK')
		{
		$jwm = 24;
		$kg = 1;
		$kt = 0;
		$pktmaks = 40;
		$adatambahan = 0;
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
		if ($tambahan=='Bimbingan TIK')
		{
		$untuk = $tambahan;
		$skorx = 4;
		}


	// cari mapel
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru' order by mapel ASC");
	$jtm = 0;
	foreach($tmapel->result() as $dmapel)
	{
		$mapelguru = $dmapel->mapel;
		$jtm = $jtm + $dmapel->jam;

	}

	$tlain = $this->db->query("SELECT * FROM `p_tugas_tambahan_luar` where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	$jtmlain = 0;
	foreach($tlain->result() as $dlain)
	{
		$jtmlain = $dlain->jtm;

	}
	$jw = $jtm + $jtmlain+$jwtambahan;
	$galat = '';
	if($jw == 0)
	{
		$jw = 24;
		$galat = '<div class="alert alert-danger">JW diasumsikan 24, data JTM = 0</div>';
	}

	if ($jw>$jwm)
		{
		$jw = $jwm;
		}
	$aksetahun = (($akk - $akpkb - $akp) * ($jw/$jwm) * $npk)/400;
	echo 'Jam Mengajar '.$jw.' '.$jwtambahan.' '.$thnajaran.' '.$semester.'<br />';
	echo $galat;
	echo 'Angka kredit 1 Tahun = (( '.$akk.' - '.$akpkb.' - '.$akp.' ) x ('.$jw.'/'.$jwm.') x '.$npk.'%)/4<br>';
	echo '</td><td valign="bottom" align="center"><b>'.$aksetahun.'</b></td></tr></table>';
	$akguru = $aksetahun;

//apakah mempunyai tugas tambahan
$aktambahan_realisasi = 0;
if ($adatambahan==1)
{
?><div class="table-responsive"><table class="table table-striped table-bordered">
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
//	echo ' - '.$jskor.'';
	$nomor++;
	echo '</td></tr>';
	}
echo '</table></div><br />';
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
	$jskortambahan = $jskor;
	echo '<table class="table table-striped table-bordered">';
	echo '<tr><td>Nilai PK '.$tambahan.'</td><td align="center"><strong>'.$jskor.'</strong></td></tr>
<tr><td>Konversi Nilai PK '.$tambahan.' ke dalam skala 0 - 100 sesuai permenneg PAN dan RM Nomor 16 Tahun 2009 dengan Rumus<br>
Nilai PKG (100) = (Nilai PKG / Nilai PKG Tertinggi) x 100<br>
Nilai PKG (100) = ('.round($jskortambahan,3).' / '.$pktmaks.') x 100</td>';
$nilaipkg = $jskortambahan / $pktmaks * 100;
echo '<td align="center" valign="bottom"><strong>'.round($nilaipkg,2).'</strong></td></tr>
<tr><td colspan="2">Berdasarkan hasil konversi ke dalam skala sesuai peraturan tersebut selanjutnya ditetapkan sebutan dan persentase angka kreditnya</td></tr>
<tr><td>Nilai PK '.$tambahan.' tersebut mendapat sebutan</td>';
$sebutan = 'Kurang';
$npk = 25;
if (($nilaipkg>51) or ($nilaipkg==51))
	{
	$sebutan = 'Sedang';
	$npk = 50;
	}
if (($nilaipkg>61) or ($nilaipkg==61))
	{
	$sebutan = 'Cukup';
	$npk = 75;
	}
if (($nilaipkg>76) or ($nilaipkg==76))
	{
	$sebutan = 'Baik';
	$npk = 100;
	}

if ( ($nilaipkg>91) or ($nilaipkg==91))
	{
	$sebutan = 'Amat Baik';
	$npk = 125;
	}
$sebutantambahan = $sebutan;
echo '<td align="center"><strong>'.$sebutan.'</strong></td></tr><tr><td>Nilai persentase angka kredit </td><td align="center"><strong>'.$npk.' %</strong></td></tr>';
	$aksetahun2 = (($akk - $akpkb - $akp) * $npk)/400;
	echo '<tr><td>
	Perolehan angka kredit ('.$tambahan.') dihitung berdasarkan rumus berikut<br>
	Angka kredit 1 tahun = ((AKK - (AKPKB - AKP)) x NPK)/400<br>';

	echo 'Angka kredit 1 Tahun = (( '.$akk.' - '.$akpkb.' - '.$akp.' ) x '.$npk.'%)/4<br>';
	echo '</td><td valign="bottom" align="center"><b>'.$aksetahun2.'</b></td></tr>';
	echo '<tr><td colspan="2">&nbsp;</td></tr>';
	$akakhir = ($kg * $aksetahun) + ($kt * $aksetahun2);
	echo '<tr><td>Nilai Akhir = '.$kg.' x '.$aksetahun.' + '.$kt.' x '.$aksetahun2.'</td><td align="center"><b>'.$akakhir.'</td></tr>';

}
echo '</table>';
//cari penilai
$kodepenilai = 'x';
$tpenilai = $this->db->query("select * from pkg_tim_penilai where tahun='$tahunsekarang' and kode_ternilai='$kodeguru'");
foreach($tpenilai->result() as $dpenilai)
	{
	$kodepenilai=$dpenilai->kode_penilai;
	}
$namapenilai = cari_nama_pegawai($kodepenilai);
$nippenilai = cari_nip_pegawai($kodepenilai);
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
		//CARI ANGKA KREDIT
			if ($sebutanguru == 'Amat baik')
			{
				$kriteria = 'a';
			}
			elseif ($sebutanguru == 'Baik')
			{
				$kriteria = 'b';
			}
			else
			{
				$kriteria = 'c';
			}
			$kriteriatambahan = 'c';
			if ($sebutantambahan == 'Amat Baik')
			{
				$kriteriatambahan = 'a';
			}
			if ($sebutantambahan == 'Baik')
			{
				$kriteriatambahan = 'b';
			}
		
		$ak = 0;
		$ty = $this->db->query("select * from `skp_skor` where `kriteria`='$kriteria' and `golongan`='$golongan'");
		foreach($ty->result() as $y)
			{
				$ak = $y->skor;
			}
		$ak_target = $ak;
		$aktambahan = $aksetahun2;
		$aktambahan_target = $aktambahan;

	$ak_realisasi = $akguru;
	if((!empty($tambahan)) and ($adatambahan == 1))
	{
		$ak_realisasi = $akguru * $kg;
		$ak_target = $akguru * $kg;
		$aktambahan_realisasi = round($aktambahan,2) * $kt;
		$kdpe = $kg * 100;

	}
//		$ak_realisasi = $akguru * $kg;
	

	//cek tambahan sudah ada?
	$this->db->query("update `skp_skor_guru` set `ak_r`=''  where `kodeguru`='$kodeguru' and `tahun`='$tahunsekarang' and `kode`='01'");

	if((!empty($tambahan)) and ($adatambahan == 1))
	{
		if (substr($tambahan,0,4)=='Waka')
			{
			$aktambahan_target = $aktambahan / 2;
			}
		if ((substr($tambahan,0,10)=='Kepala Mad') or (substr($tambahan,0,10)=='Kepala Sek'))
			{
			$aktambahan_target = $aktambahan * 3 / 4;
			}
		if ((substr($tambahan,0,10)=='Kepala Lab') or (substr($tambahan,0,10)=='Kepala Per'))
			{
			$aktambahan_target = $aktambahan / 2;
			}
		$td = $this->db->query("select * from `skp_skor_guru` where `kodeguru`='$kodeguru' and `tahun`='$tahunsekarang' and `kode`='01'");
		$adatd = $td->num_rows();
		if($adatd>0)
			{
			$this->db->query("update `skp_skor_guru` set `ak_r`='$aktambahan_realisasi' where `kodeguru`='$kodeguru' and `tahun`='$tahunsekarang' and `kode`='01'");
			}
			else
			{
			$this->db->query("update `skp_skor_guru` set `ak_r`='' where `kodeguru`='$kodeguru' and `tahun`='$tahunsekarang' and `kode`='01'");

			$ak_realisasi = $ak_realisasi + $aktambahan_realisasi;
			}
	}
	$this->db->query("update `skp_skor_guru` set `ak_r`='$ak_realisasi'  where `kodeguru`='$kodeguru' and `tahun`='$tahunsekarang' and `kode`='00'");



?>
</table><br />


