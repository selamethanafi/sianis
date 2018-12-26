<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: analisis_cetak.php
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
<title>ANALISIS BUTIR SOAL ULANGAN <?php echo $penilaiane.' '.$mapel.' Kelas '.$kelas.' Semester '.$semester.' Tahun '.$thnajaran.' '.$sek_nama;?></title>
</head>
<body>
<div class="landscape">
<?php
$lebarkolom = 20;
$skormaks = $nsoal * $skor;
$lebartabel = 455 + ($nsoal*$lebarkolom);
$nsoale = $nsoal + $nsoalb;
$nilaiuraian = $nsoalb * $skorb;
echo '<table width="95%">
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="90"> </td><td align="center">'.$baris1.'<br/>'.$baris2.'<br/>'.$baris3.'<br/>'.$baris4.'</TD><TR>
</table>';
if($kkm_ulangan == 0)
{
	$kkm_ulangan = $kkm;
}
echo '<h3 class="text-center"><a href="'.base_url().'guru/analisis/'.$id_mapel.'/'.$ulangan.'"><strong>ANALISIS BUTIR SOAL '.$penilaiane.'</strong></a></h3>';
?>
<table width="95%">
<tr><td width="250"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>KKM</strong></td><td>: <strong><?php echo $kkm_ulangan;?></strong></td></tr>

</table>
<?php
$ta = $this->db->query("select * from `analisis_skor` where `id_mapel`='$id_mapel' and `itemnilai`='$ulangan' and `dipakai`='1' limit 0,1");
if($ta->num_rows() > 0)
{
	foreach($ta->result() as $a)
	{
		$skormaks = 0;
		for($i=1;$i<=50;$i++)
		{
			$iteme = 's'.$i;
			$skormaks = $skormaks + $a->$iteme;
		}
	}
}

echo '<div class="CSSTableGenerator"><table width="95%">';
?>

<tr align="center">	  
		    <td align="center" rowspan="2">No</td>
		    <td align="center" rowspan="2">Nama Siswa</td>
		    <td align="center" colspan="<?php echo $nsoale;?>">SKOR YANG DICAPAI</td>
		    <td align="center" colspan="2">SKOR</td>
		    <td align="center" rowspan="2">Ketuntasan</td>
		  </tr>
<tr align="center">
<?php
$lebarkolom = ($lebartabel- 320) / $nsoale;
$kolom = 0;
do
{	
	$nokol = $kolom + 1;
	$nil[$kolom]=0;
	echo '<td>'.$nokol.'</td>';
	$kolom++;
}
while ($kolom<$nsoal);
if ($nsoalb>0)
{
	$kolomb = 0;
	do
	{	
	$nokolb = $kolomb + 1;
	$nilb[$kolomb]=0;
	echo '<td>'.$nokolb.'</td>';
	$kolomb++;
	}
	while ($kolomb<$nsoalb);

}
echo '<td align="center">Dicapai</td><td align="center">Nilai</td>';
echo '</tr>';
$nomor=1;
$cacahsiswa = count($query->result());
if($ta->num_rows() > 0)
{
	$kolom = 0;
	do
	{	
		$nokol = $kolom + 1;
		$iskor = 's'.$nokol;
		$skormakspersoal[$kolom]= $a->$iskor * $cacahsiswa;
		$kolom++;
	}
	while ($kolom<$nsoal);
}
else
{
	$skormakspersoal = $skor * $cacahsiswa;
}

if(count($query->result())>0)
{
	$kolom = 0;
	do
		{
		$nil[$kolom]=0;
		$kolom++;
		}
	while ($kolom<$nsoal);
	$kolomb = 0;
	do
		{
		$nilb[$kolomb]=0;
		$kolomb++;
		}
	while ($kolomb<$nsoalb);

	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$namasiswa = nis_ke_nama($nis);

	echo "<tr><td align='center'>";
	echo ''.$nomor.'</td><td>'.$namasiswa.'</td>';
	$kolom = 0;
	$nilaipersiswa= 0;
	do
	{	
	$nilaine=0;
	$nokol = $kolom + 1;
	$item = 'nilai_s'.$nokol.'';
	$nilaine = $t->$item;
	$nil[$kolom]=$nil[$kolom]+$nilaine;
	$nilaipersiswa= $nilaipersiswa + $nilaine;
	echo '<td align="center">'.$nilaine.'</td>';
	$kolom++;
	}
	while ($kolom<$nsoal);
	$nilaipersiswab= 0;
	if ($nsoalb>0)
	{
		$kolomb = 0;

		do
		{	
		$nilaineb=0;
		$nokolb = $kolomb + 1;
		$item = 'uraian_'.$nokolb.'';
		$nilaineb = $t->$item;
		$nilb[$kolomb]=$nilb[$kolomb]+$nilaineb;
		$nilaipersiswab= $nilaipersiswab + $nilaineb;
		echo '<td align="center">'.$nilaineb.'</td>';
		$kolomb++;
		}
	while ($kolomb<$nsoalb);
	}
	$persentase =round($nilaipersiswa / $skormaks * $skora,2);
	$nilaiulangan = $persentase + $nilaipersiswab;
	if ($nilaiulangan < $kkm_ulangan)
		{
		$tuntas = "Tidak";
		}
		else
		{
		$tuntas = "Ya";
		}

	if ($nsoalb>0)
		{
		echo '<td align="center">'.$persentase.' '.$nilaipersiswab.'</td><td align="center">'.$nilaiulangan.'</td><td align="center">'.$tuntas.'</td></tr>';
		}
		else
		{
		echo '<td align="center">'.$nilaipersiswa.'</td><td align="center">'.$nilaiulangan.'</td><td align="center">'.$tuntas.'</td></tr>';
		}
	$nomor++;	
	}
	echo '<tr bgcolor=""><td align="center"></td><td>Jumlah Nilai</td>';
	$kolom = 0;
	do
	{	
	$nokol = $kolom + 1;
	echo '<td align="center">'.$nil[$kolom].'</td>';
	$kolom++;
	}
	while ($kolom<$nsoal);
	if($nsoalb>0)
	{
		$kolomb = 0;
		do
		{	
		$nokolb = $kolomb + 1;
		echo '<td align="center">'.$nilb[$kolomb].'</td>';
		$kolomb++;
		}
		while ($kolomb<$nsoalb);
	}
	
	echo '<td colspan="3"></td></tr><tr><td align="center"></td><td>Rata - rata</td>';
	$kolom = 0;
	do
	{
		$rata[$kolom] = round($nil[$kolom]/$cacahsiswa,2);
		echo '<td align="center">'.$rata[$kolom].'</td>';
		$kolom++;
	}
	while ($kolom<$nsoal);
	if($nsoalb>0)
	{
		$kolomb = 0;
		do
		{
			$ratab[$kolomb] = round($nilb[$kolomb]/$cacahsiswa,2);
			echo '<td align="center">'.$ratab[$kolomb].'</td>';
			$kolomb++;
		}
		while ($kolomb<$nsoalb);
	}
	echo '<td colspan="3"></td></tr>';
	echo '<tr><td align="center"></td><td>Tingkat Kesukaran</td>';
	$kolom = 0;
	do
	{
		if($ta->num_rows() > 0)
		{
			$nokol = $kolom + 1;
			$iskor = 's'.$nokol;
			$skormakspersoal= $a->$iskor;
		}
		$TK = $rata[$kolom]/$skor;
		if($TK <= 1)
		{
			$dtk = 'Mdh';
		} 
		if($TK <= 0.7)
		{
			$dtk = 'Sdg';
		} 
		if($TK <= 0.3)
		{
			$dtk = 'Skr';
		} 

		echo '<td align="center">'.$dtk.'</td>';
		$kolom++;
	}
	while ($kolom<$nsoal);
	if ($nsoalb>0)
	{
		$persoal = $skorb / $nsoalb;
		$kolomb = 0;
		do
		{
			$TKb = $ratab[$kolomb] / $skorb;	
			if($TKb <= 1)
			{
				$dtkb = 'Mdh';
			} 
			if($TKb <= 0.7)
			{
				$dtkb = 'Sdg';
			} 
			if($TKb <= 0.3)
			{
				$dtkb = 'Skr';
			} 
			echo '<td align="center">'.$dtkb.'</td>';

			$kolomb++;
		}
		while ($kolomb<$nsoalb);
	}
	echo '<td colspan="3"></td></tr>';
	//daya pembeda
	$tc = $this->db->query("select * from `analisis_dayabeda` where `id_mapel`='$id_mapel' and `ulangan`='$ulangan'");
	echo '<tr><td align="center"></td><td>Status Soal</td>';
	if($tc->num_rows() == 0)
	{
		echo '<td colspan="'.$nsoale.'">Tidak ada data pembeda</td></tr>';
	}
	else
	{
		$kolom = 1;
		do
		{
			foreach($tc->result() as $c)
			{
				$itempembeda = 'nilai_s'.$kolom;
				$dp = $c->$itempembeda;
				if($dp <= 0.19)
				{
					echo '<td align="center">J</td>';
				}
				elseif(($dp > 0.19) and ($dp<= 0.29))
				{
					echo '<td align="center">C</td>';
				}
				elseif(($dp > 0.29) and ($dp<= 0.39))
				{
					echo '<td align="center">B</td>';
				}
				else
				{
					echo '<td align="center">SB</td>';
				}
				$kolom++;
			}
		}
		while ($kolom<=$nsoale);
	}
	echo '<td colspan="3"></td></tr>';

	echo '</table></div>';
echo 'Keterangan tingkat kesukaran : Mdh = mudah, Sdg = Sedang, Skr = Sukar<br />Keterangan Status Soal : J = jelek, jangan digunakan; C = cukup, perlu perbaikan; B = baik; SB = sangat baik';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggal_hari_ini();
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.'Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.'Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
?>
<script type="text/javascript">self.print();</script>
<?php

}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr></table>";
}
?>
</div>
</BODY></HTML>
<?php
/*
DP   ≤   0,19              ► jelek, dibuang
0,19  <  DP ≤ 0,29    ► Cukup, perlu
                                      perbaikan
 0,29 < DP ≤ 0,39     ► Baik
 DP  > 0,39         ► Sangat baik
*/
