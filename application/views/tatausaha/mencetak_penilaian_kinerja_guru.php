<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: mencetak_penilaian_kinerja_guru.php
// Lokasi      		: application/views/guru/
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/perangkat-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>LAPORAN DAN EVALUASI PENILAIAN KINERJA GURU MATA PELAJARAN - <?php echo $this->config->item('nama_web');?></title>
</head>
<?php
$semester = 1;
$thnpkgakhir = $thnpkg+1;
$thnajaran = $thnpkg.'/'.$thnpkgakhir;
$tx = $this->db->query("select * from `p_pegawai` where `kode`='$kodeguru'");
foreach($tx->result() as $dx)
{
	$namaguru = $dx->nama;
	$nipguru = $dx->nip;
	$karpeg = $dx->karpeg;
	$nuptk = $dx->nuptk;
	$nrg = $dx->nrg;
	$tmt_di_sekolah = date_to_long_string($dx->tmt_di_sekolah);
	$tanggallahirpegawai = date_to_long_string($dx->tanggallahir);
	//cari pangkat golongan
	$pangkat ='';
	$golongan = '';
	$jabatan = '';
	$id_sk = '';
	$tkepeg = $this->db->query("select * from `p_tugas_tambahan` where thnajaran = '$thnajaran' and semester='$semester' and kodeguru = '$kodeguru'");
	foreach($tkepeg->result() as $dkepeg)
	{
		$id_sk = $dkepeg->id_sk;
	}
	$golongan = id_sk_jadi_golongan($id_sk);
	$pangkat = golongan_jadi_pangkat($golongan);
	$jabatan = golongan_jadi_jabatan($golongan);
	$pangkatgolongan = $pangkat.', '.$golongan.', '.$jabatan;
	if (empty($pangkat))
	{
		$pangkatgolongan = '-';
	}
	if (empty($jabatan))
	{
		$jabatan = '-';
	}
	$tkepeg = $this->db->query("select * from `p_kepegawaian` where id = '$id_sk'");
	$adask = $tkepeg->num_rows();
	if ($adask == 0)
	{
		$tmt = '';
	}
	else
	{
		foreach($tkepeg->result() as $t)
		{
			$tmt = date_to_long_string($t->tmt);
		}
	}
}
$lebartabel="670";
/*
echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100"><img src ="'.base_url().'/images/depag.png" width="90"> </td><td align="center">'.$this->config->item('baris1').''.$this->config->item('baris2').''.$this->config->item('baris3').''.$this->config->item('baris4').'</TD><TR>
</table>';
*/
?>

<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td align ="center"><h2><a href="<?php echo base_url();?>index.php/tatausaha/cetakpkg">LAPORAN DAN EVALUASI PENILAIAN KINERJA GURU MATA PELAJARAN</a></h2></td></tr></table>
<div id="container-fluid">

<?php
echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Nama Guru</strong></td><td>: <strong>'.$namaguru.'</strong></td></tr>
<tr><td><strong>NIP/Nomor Seri Karpeg</strong></td><td>: <strong>'.$nipguru.'</strong> / <strong>'.$karpeg.'</strong></td></tr>
<tr><td><strong>Pangkat /Golongan Ruang / Jabatan</strong></td><td>: <strong>'.$pangkatgolongan.'</strong></td></tr>
<tr><td><strong>Terhitung Mulai Tanggal</strong></td><td>: <strong>'.$tmt.'</strong></td></tr>
<tr><td><strong>NUPTK/NRG</strong></td><td>: <strong>'.$nuptk.'</strong> / <strong>'.$nrg.'</strong></td></tr>
<tr><td><strong>Nama sekolah</strong></td><td>: <strong>'.$this->config->item('sek_nama').'</strong></td></tr>
<tr><td><strong>Alamat sekolah</strong></td><td>: <strong>'.$this->config->item('sek_alamat').'</strong></td></tr>
<tr><td><strong>Tanggal mulai bekerja di sekolah ini</strong></td><td>: <strong>'.$tmt_di_sekolah.'</strong></td></tr>
<tr><td><strong>Periode penilaian</strong></td><td>: <strong> 01 Januari '.$thnpkg.'</strong> sampai <strong> 31 Desember '.$thnpkg.'</strong></td></tr>
</table><vr />';
$nomor =1;
$ta = $this->db->query("select * from pkg_m_kompetensi where untuk='guru' order by nourut");
foreach($ta->result() as $a)
{
	echo '<table width="'.$lebartabel.'"cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="200">Penilaian untuk Kompetensi '.$nomor.'</td><td>:</td><td>'.$a->kompetensi.'</td></tr></table>
<table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">';
echo '<tr align="center" bgcolor="#fff" rowspan="2"><td rowspan="2">Nomor</td><td rowspan="2">Indikator</td><td colspan="3">Skor</td></tr><tr bgcolor="#fff"><td align="center">Tidak ada Bukti</td><td align="center">Terpenuhi Sebagian</td><td align="center">Terpenuhi Seluruhnya</td></tr>';
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$nomor' order by nourut");
	$nomor1 = 1;
	$jskor = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		echo '<tr bgcolor="#fff"><td align="center">'.$nomor1.'</td><td>'.$b->indikator.'</td>';
		//cari nilai
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$thnpkg'");
		$skore = 0;
			foreach($tc->result() as $c)
			{
			$skore = $c->skor;
			$id_pkg_t_nilai = $c->id_pkg_t_nilai;
			}
			if ($skore == 1)
			{
			echo '<td></td><td align="center"><img src ="'.base_url().'/images/bunder.png"></td><td></td></tr>';
			}
			elseif ($skore == 2)
			{
			echo '<td></td><td></td><td align="center"><img src ="'.base_url().'/images/bunder.png"></td></tr>';
			}
			else 
			{
			echo '<td align="center"><img src ="'.base_url().'/images/bunder.png"></td><td></td><td></td></tr>';
			}
			$jskor = $jskor + $skore;
			$nomor1++;
		}
		$cacah_indikator = $nomor1 - 1;
		$skormaks = 2 * $cacah_indikator;
		$persentase = $jskor / $skormaks * 100;
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
		
echo '<tr bgcolor="#fff"><td></td><td align="center">Persentase = (total skor/skor maksimal) x 100%</td><td align="center" colspan="3">'.round($persentase,2).'</td></tr>
<tr bgcolor="#fff"><td></td><td align="center">Nilai untuk kompetensi ini</td><td align="center" colspan="3">'.$nilai.'</td></tr>
<tr bgcolor="#fff"><td></td><td align="center">Nilai untuk kompetensi
(0% &lt; X ≤ 25% = 1; 25% < X ≤ 50% = 2)
50% < X ≤ 75% = 3; 75% < X ≤ 100% = 4)
</td><td align="center" colspan="3"></td></tr></table>';
	$nomor++;
}
echo '<table width="670" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr bgcolor="#FFF" align="center"><td><strong>No.</strong></td><td><strong>Kompetensi</strong></td><td><strong>Nilai</strong></td></tr>
<tr bgcolor="#FFF"><td colspan="3"><strong>A. Pedagogik</strong></td></tr>';
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='A' and `untuk`='guru' order by nourut");
$nomor = 1;
$jskor = 0;
foreach($ta->result() as $a)
	{
		if(($nomor%2)==0){
			$warna=warna1;
		} else{
			$warna=warna2;
		}
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr bgcolor='".$warna."'><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$thnpkg'");
		
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
<tr bgcolor="#FFF"><td colspan="3"><strong>B. Kepribadian</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='B' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
		if(($nomor%2)==0){
			$warna=warna1;
		} else{
			$warna=warna2;
		}
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr bgcolor='".$warna."'><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$thnpkg'");

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
<tr bgcolor="#FFF"><td colspan="3"><strong>C. Sosial</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='C' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
		if(($nomor%2)==0){
			$warna=warna1;
		} else{
			$warna=warna2;
		}
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr bgcolor='".$warna."'><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator=0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$thnpkg'");

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
<tr bgcolor="#FFF"><td colspan="3"><strong>D. Profesional</strong></td></tr>
<?php
$ta = $this->db->query("select * from `pkg_m_kompetensi` where `kelompok`='D' and `untuk`='guru' order by nourut");
foreach($ta->result() as $a)
	{
		if(($nomor%2)==0){
			$warna=warna1;
		} else{
			$warna=warna2;
		}
	$id_kompetensi = $a->id_pkg_m_kompetensi;
	echo "<tr bgcolor='".$warna."'><td align='center'>".$nomor."</td><td>".$a->kompetensi."</td><td align='center'>";
	//cari indikator
	$tb = $this->db->query("select * from `pkg_m_indikator` where `id_pkg_m_kompetensi`='$id_kompetensi' order by nourut");
	$nskor = 0;
	$cacah_indikator = 0;
	foreach($tb->result() as $b)
		{
		$id_indikator = $b->id_pkg_m_indikator;
		//cari skor per indikator
		$tc = $this->db->query("select * from `pkg_t_nilai` where `id_indikator`='$id_indikator' and `kodeguru`='$kodeguru' and `tahun`='$thnpkg'");

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
if ($jskore >= 76)
	{
	$sebutan = 'Baik';
	}
if ($jskore >= 91)
	{
	$sebutan = 'Amat Baik';
	}


echo '<tr><td></td><td align="center">Jumlah (Hasil Penilaian Kinerja Guru)
</td><td align="center">'.$jskor.'</td></tr>
<tr><td></td><td align="center">Sebutan
</td><td align="center">'.$sebutan.'</td></tr></table>';
echo '*) Nilai diisi berdasarkan laporan dan evaluasi PK Guru. Nilai minimum per kompetensi = 1 dan nilai maksimum = 4';
?>

</div>
