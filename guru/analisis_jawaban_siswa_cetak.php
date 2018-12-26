<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_jawaban_siswa_cetak.php
// Terakhir diperbarui	: Kam 31 Des 2015 12:35:17 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
$penilaiane = 'BELUM DIDUKUNG APLIKASI';
if ($ulangan=='uh1')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN I';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN I';
	}
	
}
if ($ulangan=='uh2')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN II';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN II';
	}
}
if ($ulangan=='uh3')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN III';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN III';
	}
}
if ($ulangan=='uh4')
{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN HARIAN IV';
	}
	else
	{
		$penilaiane = 'ULANGAN HARIAN IV';
	}

}
if ($ulangan=='mid')
	{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN TENGAH SEMESTER';
	}
	else
	{
		$penilaiane = 'ULANGAN TENGAH SEMESTER';
	}

	}
if ($ulangan=='uas')
	{
	if(($kurikulum == '2015') or ($kurikulum == '2018'))
	{
		$penilaiane = 'PENILAIAN AKHIR SEMESTER';
	}
	else
	{
		$penilaiane = 'ULANGAN AKHIR SEMESTER';
	}
	}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>css/table.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>ANALISIS BUTIR SOAL <?php echo $penilaiane.' '.$mapel.' Kelas '.$kelas.' Semester '.$semester.' Tahun '.$thnajaran.' '.$sek_nama;?></title>
</head>
<body>
<div class="landscape">
<?php

if (empty($id_mapel))
	{
	echo '<a href="'.base_url().'guru/nilai"><b>Kembali</b></a>';
	}
else
{
echo '<table width="95%">
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="90"> </td><td align="center">'.$baris1.'<br/>'.$baris2.'<br/>'.$baris3.'<br/>'.$baris4.'</TD><TR>
</table>';
echo '<h3 class="text-center"><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/'.$ulangan.'"><strong>ANALISIS BUTIR SOAL '.$penilaiane.'</strong></a></h3>';
$skor = 1;
$skormaks = $nsoal * $skor;
?>
<table>
<tr><td>Tahun Pelajaran</td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td>Kelas</td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td>Mata Pelajaran</td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td>Analisis</td><td>: <strong><?php echo $penilaiane;?></strong></td></tr>
<tr><td>KKM</td><td>: <strong><?php echo $kkm_ulangan;?> </strong> </td></tr>
<tr><td>Soal Bagian A : Cacah Soal A / Skor tiap soal / Skor maksimal / Jumlah Skor </td><td>: <strong><?php echo $nsoal;?></strong> / <strong><?php echo $skor;?></strong> / <strong><?php echo $skormaks;?></strong> / <strong><?php echo $skora;?></td></tr>
<tr><td>Soal Bagian B : Cacah soal </td><td>: <strong><?php echo $nsoalb;?></strong></td></tr>
<tr><td>Kunci Jawaban Kelompok A</td><td>: <strong><?php echo $kunci;?> </strong></td></tr>
<tr><td>Kunci Jawaban Kelompok B</td><td>: <strong><?php echo $kuncib;?> </strong></td></tr>
</table>
<?php
if ($nsoal==0)
{
	echo 'ubah cacah soal di <a href="'.base_url().'guru/ubahkkm/'.$id_mapel.'" class="btn btn-primary"><b>sini</b></a>';
}
else
{
	$kegiatanharian = 'menganalisis hasil penilaian pembelajaran mata pelajaran '.$mapel.' kelas '.$kelas.' semester '.$semester.' tahun '.$thnajaran;
	$tahun = tahunsaja(tanggal_hari_ini());
	$bulan = bulansaja(tanggal_hari_ini());
	$bulane = angka_jadi_bulan($bulan);
	$kegiatan = 'menganalisis hasil penilaian pembelajaran di bulan '.$bulane.' '.$tahun;
	$tc = $this->db->query("select * from `sieka_bulanan` where `tahun`='$tahun' and `nip`='$nip' and `kegiatan` = '$kegiatan'");
	$id_bulanan = '';
	foreach($tc->result() as $c)
	{
		$id_bulanan = $c->id_bulanan;
	}

echo '<div class="CSSTableGenerator"><table width="95%">';
?>
<tr><td align="center">No</td><td align="center">Nama Siswa</td><td align="center">Kelompok</td><td align="center">Jawaban Siswa</td><td align="center">Analisis</td><td align="center">SKOR</td><?php 
if ($nsoalb>0)
	{
	$kolomuraian = 0;
	do
	{
		$kolomuraian++;
		echo '<td align="center">'.$kolomuraian.'</td>';


	}
	while ($kolomuraian<$nsoalb);
	echo '<td align="center">SKOR</td>';
	}
echo '<td align="center">Nilai</td></tr><tr align="center">';
$nomor=1;
if(count($query->result())>0)
{

	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);

	$jawaban = $t->jawaban;
	if (empty($t->kelompok))
		{
		$kelompok = 'A';
		}
		else
		{
		$kelompok = 'B';
		}

	$nis = $t->nis;
	echo "<tr><td align='center'>";
	echo ''.$nomor.'</td><td><a href="'.base_url().'guru/analisisjawabansiswa/'.$id_mapel.'/'.$ulangan.'/'.$t->id_analisis.'/sekaligus">'.$namasiswa.'</a></td>';
	echo '<td>'.$kelompok.'</td><td>'.$jawaban.'</td>';
	$analisis ='';
	$skore = 0;
	for($i=1;$i<=$nsoal;$i++)
	{
		$posisi = $i - 1;
		if ($kelompok== 'A')
			{
			$kuncine = substr($kunci,$posisi,1);
			}
			else
			{
			$kuncine = substr($kuncib,$posisi,1);
			}

		$jawabane = substr($jawaban,$posisi,1);
		if ($kuncine == $jawabane)
			{
				$analisis .= $jawabane;
				if($id_analisis== 'proses')
					{
					$this->db->query("update analisis set `nilai_s$i`='$skor' where `nis`='$nis' and `mapel`='$mapel' and `ulangan`='$ulangan' and `semester`='$semester' and `thnajaran`='$thnajaran'");
					}
				$skore++;
			}
			else
			{
				if($id_analisis== 'proses')
					{

					$this->db->query("update analisis set `nilai_s$i`='0' where `nis`='$nis' and `mapel`='$mapel' and `ulangan`='$ulangan' and `semester`='$semester' and `thnajaran`='$thnajaran'");
					}

				$analisis .= '-';
			}
	}
	$skore = $skore * $skor;
	$skorea = $skore / $skormaks * $skora;
	$kurang = 0;
	$skoruraian = $t->uraian_1 + $t->uraian_2 + $t->uraian_3 + $t->uraian_4 + $t->uraian_5 + $t->uraian_6 + $t->uraian_7 + $t->uraian_8 + $t->uraian_9 + $t->uraian_10;

		if ($nsoal > strlen($jawaban))
			{
			$kurang = $nsoal - strlen($jawaban);
			$analisis .= ' kurang '.$kurang;
			}

		if ($nsoal < strlen($jawaban))
			{
			$lebih = strlen($jawaban) - $nsoal;
			$analisis .= ' lebih '.$lebih;
			}
	if($nsoal == $kurang)
		{
		$skorea = 0;
		}

	$nilaiulangan = $skorea + $skoruraian; 
	$skorea = round($skorea,2);
	echo '<td>'.$analisis.'</td><td align="center">'.$skorea.'</td>';
	if ($nsoalb>0)
		{
		$kolomuraian = 0;
		do
			{
			$kolomuraian++;
			$itemuraian = 'uraian_'.$kolomuraian;
			$skor_uraian = $t->$itemuraian;
			echo '<td align="center">'.$skor_uraian.'</td>';


			}
		while ($kolomuraian<$nsoalb);
		echo '<td align="center">'.$skoruraian.'</td>';
		}
	$nilaiulangan = round($nilaiulangan,2);
	echo '<td align="center">'.$nilaiulangan.'</td></tr>';
	$nomor++;	
	}
}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}
?>
</table></div>
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggal_hari_ini();
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);

	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.'Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
} // kalau id_mapel tidak  kosong
?>
</div>


