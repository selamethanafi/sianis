<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: cetak_daftar_nilai.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
$tmapel = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				$cacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
				$cacah_tugas = $dtmapel->cacah_tugas;
				$ranah = $dtmapel->ranah;
				$no_urut_rapor = $dtmapel->no_urut_rapor;
				$bobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
				$bobot_tugas = $dtmapel->bobot_tugas;
				$bobot_mid = $dtmapel->bobot_mid;
				$bobot_semester = $dtmapel->bobot_semester;
				$kkm_uh1 = $dtmapel->kkm_uh1;
				$kkm_uh2 = $dtmapel->kkm_uh2;
				$kkm_uh3 = $dtmapel->kkm_uh3;
				$kkm_uh4 = $dtmapel->kkm_uh4;
				$kkm_mid = $dtmapel->kkm_mid;
				$kkm_uas = $dtmapel->kkm_uas;
				$cacah_kuis = $dtmapel->nkuis;
				$bobot_kuis = $dtmapel->bobot_kuis;
			}
$kurikulum=cari_kurikulum($thnajaran,$semester,$kelas);
$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas` = '$kelas' and `mapel`='$mapel' and `status`='Y'");
?>
<h3><p class="text-center"><a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>">
<?php
if(($kurikulum == '2013') or ($kurikulum=='2015'))
{
	echo 'Daftar Nilai Pengetahuan';
}
elseif($kurikulum == 'KTSP')
{
	echo 'Daftar Nilai Kognitif';
}
else
{
	echo 'Daftar Nilai';
}
echo '</a></p></h3>';
?>

<table width="100%" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Ranah Penilaian</strong></td><td>: <strong><?php echo $ranah;?></strong></td></tr>
<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
</table>
<div class="CSSTableGenerator">
<table>
<tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td>
<?php
if ($cacah_ulangan_harian>0)
	{
	echo '<td><strong>UH1</strong></td>';
	}
if ($cacah_ulangan_harian>1)
	{
	echo '<td><strong>UH2</strong>';
	}
if ($cacah_ulangan_harian>2)
	{
	echo '</td><td><strong>UH3</strong></td>';
	}
if ($cacah_ulangan_harian>3)
	{
	echo '<td><strong>UH4</strong></td>';
	}
//echo '<td><strong>RUH</strong></td>';
if ($cacah_kuis>0)
	{
	echo '<td><strong>KU1</strong></td>';
	}
if ($cacah_kuis>1)
	{
	echo '<td><strong>KU2</strong></td>';
	}
if ($cacah_kuis>2)
	{
	echo '<td><strong>KU3</strong></td>';
	}
if ($cacah_kuis>3)
	{
	echo '<td><strong>KU4</strong></td>';
	}
if ($cacah_kuis>0)
	{
//	echo '<td><strong>RKU</strong></td>';
	}
if ($cacah_tugas>0)
	{
	echo '<td><strong>TU1</strong></td>';
	}
if ($cacah_tugas>1)
	{
	echo '<td><strong>TU2</strong></td>';
	}
if ($cacah_tugas>2)
	{
	echo '<td><strong>TU3</strong></td>';
	}
if ($cacah_tugas>3)
	{
	echo '<td><strong>TU4</strong></td>';
	}
if ($cacah_tugas>0)
	{
//	echo '<td><strong>RTU</strong></td>';
	}
//	echo '<td><strong>NH</strong></td>';
echo '<td><strong>MID</strong></td><td><strong>SMT</strong></td><td><strong>NA</strong></td><td><strong>NR</strong></td>';
if($kurikulum == '2013')
	{
	echo '<td><strong>HRF</strong></td>';
	}
echo '</tr>';

$nomor=1;
$rata_nilai_uh1= 0;
$rata_nilai_uh2= 0;
$rata_nilai_uh3= 0;
$rata_nilai_uh4= 0;
$rata_nilai_ruh= 0;
$rata_nilai_tu1= 0;
$rata_nilai_tu2= 0;
$rata_nilai_tu3= 0;
$rata_nilai_tu4= 0;
$rata_nilai_rtu= 0;
$rata_nilai_mid= 0;
$rata_nilai_uas= 0;
$rata_nilai_na= 0;
$rata_kog= 0;
$tertinggi_nilai_uh1= 0;
$tertinggi_nilai_uh2= 0;
$tertinggi_nilai_uh3= 0;
$tertinggi_nilai_uh4= 0;
$tertinggi_nilai_ruh= 0;
$tertinggi_nilai_tu1= 0;
$tertinggi_nilai_tu2= 0;
$tertinggi_nilai_tu3= 0;
$tertinggi_nilai_tu4= 0;
$tertinggi_nilai_rtu= 0;
$tertinggi_nilai_mid= 0;
$tertinggi_nilai_uas= 0;
$tertinggi_nilai_na= 0;
$tertinggi_kog= 0;
$terendah_nilai_uh1= 101;
$terendah_nilai_uh2= 101;
$terendah_nilai_uh3= 101;
$terendah_nilai_uh4= 101;
$terendah_nilai_ruh= 101;
$terendah_nilai_tu1= 101;
$terendah_nilai_tu2= 101;
$terendah_nilai_tu3= 101;
$terendah_nilai_tu4= 101;
$terendah_nilai_rtu= 101;
$terendah_nilai_mid= 101;
$terendah_nilai_uas= 101;
$terendah_nilai_na= 101;
$terendah_kog= 101;

if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	echo "<tr><td align='center'>".$nomor."</td><td>".nis_ke_nama($t->nis)."</td>";
	if ($kurikulum=='2013')
	{
		if ($cacah_ulangan_harian>0)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_uh1)."</td>";
		}
		if ($cacah_ulangan_harian>1)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_uh2)."</td>";
		}
		if ($cacah_ulangan_harian>2)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_uh3)."</td>";
		}
		if ($cacah_ulangan_harian>3)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_uh4)."</td>";
		}
		if ($cacah_ulangan_harian>0)
		{
		$ruh = ($t->nilai_uh1 + $t->nilai_uh2 + $t->nilai_uh3 + $t->nilai_uh4 ) / $cacah_ulangan_harian;
		//echo "<td align='center'>".round(konversi_nilai($ruh),2)."</td>";
		}
		if ($cacah_kuis>0)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_ku1)."</td>";
		}
		if ($cacah_kuis>1)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_ku2)."</td>";
		}
		if ($cacah_kuis>2)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_ku3)."</td>";
		}
		if ($cacah_kuis>3)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_ku4)."</td>";
		}
		if ($cacah_kuis>0)
		{
		$rku = ($t->nilai_ku1 + $t->nilai_ku2 + $t->nilai_ku3 + $t->nilai_ku4 ) / $cacah_kuis;
		//echo "<td align='center'>".round(konversi_nilai($rku),2)."</td>";
		}
		if ($cacah_tugas>0)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_tu1)."</td>";
		}
		if ($cacah_tugas>1)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_tu2)."</td>";
		}
		if ($cacah_tugas>2)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_tu3)."</td>";
		}
		if ($cacah_tugas>3)
		{
		echo "<td align='center'>".konversi_nilai($t->nilai_tu4)."</td>";
		}
		if ($cacah_tugas>0)
		{
		$rtu = ($t->nilai_tu1 + $t->nilai_tu2 + $t->nilai_tu3 + $t->nilai_tu4 ) / $cacah_tugas;
		//echo "<td align='center'>".round(konversi_nilai($rtu),2)."</td>";
		}

		echo "<td align='center'>".konversi_nilai($t->nilai_mid)."</td><td align='center'>".konversi_nilai($t->nilai_uas)."</td><td align='center'>".round(konversi_nilai($t->nilai_na),2)."</td><td align='center'>".konversi_nilai($t->kog)."</td><td align='center'>".predikat_nilai($t->kog)."</td>";
	}
	else
	{
		if ($cacah_ulangan_harian>0)
		{
		echo "<td align='center'>".$t->nilai_uh1."</td>";
		}
		if ($cacah_ulangan_harian>1)
		{
		echo "<td align='center'>".$t->nilai_uh2."</td>";
		}
		if ($cacah_ulangan_harian>2)
		{
		echo "<td align='center'>".$t->nilai_uh3."</td>";
		}
		if ($cacah_ulangan_harian>3)
		{
		echo "<td align='center'>".$t->nilai_uh4."</td>";
		}
		if ($cacah_kuis>0)
		{
		echo "<td align='center'>".$t->nilai_ku1."</td>";
		}
		if ($cacah_kuis>1)
		{
		echo "<td align='center'>".$t->nilai_ku2."</td>";
		}
		if ($cacah_kuis>2)
		{
		echo "<td align='center'>".$t->nilai_ku3."</td>";
		}
		if ($cacah_kuis>3)
		{
		echo "<td align='center'>".$t->nilai_ku4."</td>";
		}
		if ($cacah_tugas>0)
		{
		echo "<td align='center'>".$t->nilai_tu1."</td>";
		}
		if ($cacah_tugas>1)
		{
		echo "<td align='center'>".$t->nilai_tu2."</td>";
		}
		if ($cacah_tugas>2)
		{
		echo "<td align='center'>".$t->nilai_tu3."</td>";
		}
		if ($cacah_tugas>3)
		{
		echo "<td align='center'>".$t->nilai_tu4."</td>";
		}
		echo "<td align='center'>".$t->nilai_mid."</td><td align='center'>".$t->nilai_uas."</td><td align='center'>".$t->nilai_na."</td><td align='center'>".$t->kog."</td>";
	}
	echo '</tr>';

/*<td align='center'>".$t->nilai_uh1."</td><td align='center'>".$t->nilai_uh2."</td><td align='center'>".$t->nilai_uh3."</td><td align='center'>".$t->nilai_uh4."</td><td align='center'>".$t->nilai_ruh."</td><td align='center'>".$t->nilai_tu1."</td><td align='center'>".$t->nilai_tu2."</td><td align='center'>".$t->nilai_tu3."</td><td align='center'>".$t->nilai_tu4."</td><td align='center'>".$t->nilai_rtu."</td><td align='center'>".$t->nilai_mid."</td><td align='center'>".$t->nilai_uas."</td><td align='center'>".$t->nilai_na."</td><td align='center'>".$t->kog."</td></tr>";
*/
	if ($tertinggi_nilai_mid < $t->nilai_mid)
		{$tertinggi_nilai_mid = $t->nilai_mid;}
	if ($tertinggi_nilai_uh1 < $t->nilai_uh1)
		{$tertinggi_nilai_uh1 = $t->nilai_uh1;}
	if ($tertinggi_nilai_uh2 < $t->nilai_uh2)
		{$tertinggi_nilai_uh2 = $t->nilai_uh2;}
	if ($tertinggi_nilai_uh3 < $t->nilai_uh3)
		{$tertinggi_nilai_uh3 = $t->nilai_uh3;}
	if ($tertinggi_nilai_uh4 < $t->nilai_uh4)
		{$tertinggi_nilai_uh4 = $t->nilai_uh4;}
	if ($tertinggi_nilai_ruh < $t->nilai_ruh)
		{$tertinggi_nilai_ruh = $t->nilai_ruh;}
	if ($tertinggi_nilai_tu1 < $t->nilai_tu1)
		{$tertinggi_nilai_tu1 = $t->nilai_tu1;}
	if ($tertinggi_nilai_tu2 < $t->nilai_tu2)
		{$tertinggi_nilai_tu2 = $t->nilai_tu2;}
	if ($tertinggi_nilai_tu3 < $t->nilai_tu3)
		{$tertinggi_nilai_tu3 = $t->nilai_tu3;}
	if ($tertinggi_nilai_tu4 < $t->nilai_tu4)
		{$tertinggi_nilai_tu4 = $t->nilai_tu4;}
	if ($tertinggi_nilai_rtu < $t->nilai_rtu)
		{$tertinggi_nilai_rtu = $t->nilai_rtu;}
	if ($tertinggi_nilai_uas < $t->nilai_uas)
		{$tertinggi_nilai_uas = $t->nilai_uas;}
	if ($tertinggi_nilai_na < $t->nilai_na)
		{$tertinggi_nilai_na = $t->nilai_na;}
	if ($tertinggi_kog < $t->kog)
		{$tertinggi_kog = $t->kog;}
	if ($terendah_nilai_mid > $t->nilai_mid)
		{$terendah_nilai_mid = $t->nilai_mid;}
	if ($terendah_nilai_uh1 > $t->nilai_uh1)
		{$terendah_nilai_uh1 = $t->nilai_uh1;}
	if ($terendah_nilai_uh2 > $t->nilai_uh2)
		{$terendah_nilai_uh2 = $t->nilai_uh2;}
	if ($terendah_nilai_uh3 > $t->nilai_uh3)
		{$terendah_nilai_uh3 = $t->nilai_uh3;}
	if ($terendah_nilai_uh4 > $t->nilai_uh4)
		{$terendah_nilai_uh4 = $t->nilai_uh4;}
	if ($terendah_nilai_ruh > $t->nilai_ruh)
		{$terendah_nilai_ruh = $t->nilai_ruh;}
	if ($terendah_nilai_tu1 > $t->nilai_tu1)
		{$terendah_nilai_tu1 = $t->nilai_tu1;}
	if ($terendah_nilai_tu2 > $t->nilai_tu2)
		{$terendah_nilai_tu2 = $t->nilai_tu2;}
	if ($terendah_nilai_tu3 > $t->nilai_tu3)
		{$terendah_nilai_tu3 = $t->nilai_tu3;}
	if ($terendah_nilai_tu4 > $t->nilai_tu4)
		{$terendah_nilai_tu4 = $t->nilai_tu4;}
	if ($terendah_nilai_rtu > $t->nilai_rtu)
		{$terendah_nilai_rtu = $t->nilai_rtu;}
	if ($terendah_nilai_uas > $t->nilai_uas)
		{$terendah_nilai_uas = $t->nilai_uas;}
	if ($terendah_nilai_na > $t->nilai_na)
		{$terendah_nilai_na = $t->nilai_na;}
	if ($terendah_kog > $t->kog)
		{$terendah_kog = $t->kog;}

	$rata_nilai_uh1= $rata_nilai_uh1 + $t->nilai_uh1 ;
	$rata_nilai_uh2= $rata_nilai_uh2 + $t->nilai_uh2 ;
	$rata_nilai_uh3= $rata_nilai_uh3 + $t->nilai_uh3 ;
	$rata_nilai_uh4= $rata_nilai_uh4 + $t->nilai_uh4 ;
	$rata_nilai_ruh= $rata_nilai_ruh + $t->nilai_ruh ;
	$rata_nilai_tu1= $rata_nilai_tu1 + $t->nilai_tu1 ;
	$rata_nilai_tu2= $rata_nilai_tu2 + $t->nilai_tu2 ;
	$rata_nilai_tu3= $rata_nilai_tu3 + $t->nilai_tu3 ;
	$rata_nilai_tu4= $rata_nilai_tu4 + $t->nilai_tu4 ;
	$rata_nilai_rtu= $rata_nilai_rtu + $t->nilai_rtu ;
	$rata_nilai_mid= $rata_nilai_mid + $t->nilai_mid ;
	$rata_nilai_uas= $rata_nilai_uas + $t->nilai_uas ;
	$rata_nilai_na= $rata_nilai_na + $t->nilai_na ;
	$rata_kog= $rata_kog + $t->kog ;
	$nomor++;	
	}
$jmlsiswa = $nomor-1;
$rata_nilai_uh1= $rata_nilai_uh1 / $jmlsiswa;
$rata_nilai_uh2= $rata_nilai_uh2 / $jmlsiswa;
$rata_nilai_uh3= $rata_nilai_uh3 / $jmlsiswa;
$rata_nilai_uh4= $rata_nilai_uh4 / $jmlsiswa;
$rata_nilai_ruh= $rata_nilai_ruh / $jmlsiswa;
$rata_nilai_tu1= $rata_nilai_tu1 / $jmlsiswa;
$rata_nilai_tu2= $rata_nilai_tu2 / $jmlsiswa;
$rata_nilai_tu3= $rata_nilai_tu3 / $jmlsiswa;
$rata_nilai_tu4= $rata_nilai_tu4 / $jmlsiswa;
$rata_nilai_rtu= $rata_nilai_rtu / $jmlsiswa;
$rata_nilai_mid= $rata_nilai_mid / $jmlsiswa;
$rata_nilai_uas= $rata_nilai_uas / $jmlsiswa;
$rata_nilai_na= $rata_nilai_na / $jmlsiswa;
$rata_kog= $rata_kog / $jmlsiswa;
if ($kurikulum == '2013')
	{
echo "<tr bgcolor='#FFF'><td align='center'></td><td>Rata - rata</td>";
if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_uh1), 2)."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_uh2), 2)."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_uh3), 2)."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_uh4), 2)."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_tugas>0)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_tu1), 2)."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_tu2), 2)."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_tu3), 2)."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".round(konversi_nilai($rata_nilai_tu4), 2)."</td>";
	}
echo "<td align='center'>".round(konversi_nilai($rata_nilai_mid), 2)."</td><td align='center'>".round(konversi_nilai($rata_nilai_uas), 2)."</td><td align='center'>".round(konversi_nilai($rata_nilai_na), 2)."</td><td align='center'>".round(konversi_nilai($rata_kog), 2)."</td><td></td></tr>";
	}
	else
	{
echo "<tr bgcolor='#FFF'><td align='center'></td><td>Rata - rata</td>";
if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".round($rata_nilai_uh1,2)."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".round($rata_nilai_uh2,2)."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".round($rata_nilai_uh3,2)."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".round($rata_nilai_uh4,2)."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_tugas>0)
	{
	echo "<td align='center'>".round($rata_nilai_tu1,2)."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".round($rata_nilai_tu2,2)."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".round($rata_nilai_tu3,2)."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".round($rata_nilai_tu4,2)."</td>";
	}
echo "<td align='center'>".round($rata_nilai_mid,2)."</td><td align='center'>".round($rata_nilai_uas,2)."</td><td align='center'>".round($rata_nilai_na,2)."</td><td align='center'>".round($rata_kog,2)."</td></tr>";
} //rata kurikulum bukan 2013

// simpangan baku
	$xi_uh1=0;
	$xi_uh2=0;
	$xi_uh3=0;
	$xi_uh4=0;
	$xi_ruh=0;
	$xi_tu1=0;
	$xi_tu2=0;
	$xi_tu3=0;
	$xi_tu4=0;
	$xi_rtu=0;
	$xi_mid=0;
	$xi_uas=0;
	$xi_na= 0;
	$xi_nr= 0;
	foreach($query->result() as $t)
	{
	$x_uh1= $rata_nilai_uh1 - $t->nilai_uh1 ;
	$x_uh2= $rata_nilai_uh2 - $t->nilai_uh2 ;
	$x_uh3= $rata_nilai_uh3 - $t->nilai_uh3 ;
	$x_uh4= $rata_nilai_uh4 - $t->nilai_uh4 ;
	$x_ruh= $rata_nilai_ruh - $t->nilai_ruh ;
	$x_tu1= $rata_nilai_tu1 - $t->nilai_tu1 ;
	$x_tu2= $rata_nilai_tu2 - $t->nilai_tu2 ;
	$x_tu3= $rata_nilai_tu3 - $t->nilai_tu3 ;
	$x_tu4= $rata_nilai_tu4 - $t->nilai_tu4 ;
	$x_rtu= $rata_nilai_rtu - $t->nilai_rtu ;
	$x_mid= $rata_nilai_mid - $t->nilai_mid ;
	$x_uas= $rata_nilai_uas - $t->nilai_uas ;
	$x_na= $rata_nilai_na - $t->nilai_na ;
	$x_nr= $rata_kog - $t->kog ;

	$xx_uh1= $x_uh1 * $x_uh1 ;
	$xx_uh2= $x_uh2 * $x_uh2 ;
	$xx_uh3= $x_uh3 * $x_uh3 ;
	$xx_uh4= $x_uh4 * $x_uh4 ;
	$xx_ruh= $x_ruh * $x_ruh ;
	$xx_tu1= $x_tu1 * $x_tu1 ;
	$xx_tu2= $x_tu2 * $x_tu2 ;
	$xx_tu3= $x_tu3 * $x_tu3 ;
	$xx_tu4= $x_tu4 * $x_tu4 ;
	$xx_rtu= $x_rtu * $x_rtu ;
	$xx_mid= $x_mid * $x_mid ;
	$xx_uas= $x_uas * $x_uas ;
	$xx_na= $x_na * $x_na ;
	$xx_nr= $x_nr * $x_nr ;

	$xi_uh1= $xi_uh1 + $xx_uh1 ;
	$xi_uh2= $xi_uh2 + $xx_uh2 ;
	$xi_uh3= $xi_uh3 + $xx_uh3 ;
	$xi_uh4= $xi_uh4 + $xx_uh4 ;
	$xi_ruh= $xi_ruh + $xx_ruh ;
	$xi_tu1= $xi_tu1 + $xx_tu1 ;
	$xi_tu2= $xi_tu2 + $xx_tu2 ;
	$xi_tu3= $xi_tu3 + $xx_tu3 ;
	$xi_tu4= $xi_tu4 + $xx_tu4 ;
	$xi_rtu= $xi_rtu + $xx_rtu ;
	$xi_mid= $xi_mid + $xx_mid ;
	$xi_uas= $xi_uas + $xx_uas ;
	$xi_na= $xi_na + $xx_na ;
	$xi_nr= $xi_nr + $xx_nr ;
	$nomor++;	
	}
	$xi_uh1= $xi_uh1 / $jmlsiswa;
	$xi_uh2= $xi_uh2 / $jmlsiswa;
	$xi_uh3= $xi_uh3 / $jmlsiswa;
	$xi_uh4= $xi_uh4 / $jmlsiswa;
	$xi_ruh= $xi_ruh / $jmlsiswa;
	$xi_tu1= $xi_tu1 / $jmlsiswa;
	$xi_tu2= $xi_tu2 / $jmlsiswa;
	$xi_tu3= $xi_tu3 / $jmlsiswa;
	$xi_tu4= $xi_tu4 / $jmlsiswa;
	$xi_rtu= $xi_rtu / $jmlsiswa;
	$xi_mid= $xi_mid / $jmlsiswa;
	$xi_uas= $xi_uas / $jmlsiswa;
	$xi_na= $xi_na / $jmlsiswa;
	$xi_nr= $xi_nr / $jmlsiswa;

	$xi_uh1= sqrt($xi_uh1);
	$xi_uh2= sqrt($xi_uh2);
	$xi_uh3= sqrt($xi_uh3);
	$xi_uh4= sqrt($xi_uh4);
	$xi_ruh= sqrt($xi_ruh);
	$xi_tu1= sqrt($xi_tu1);
	$xi_tu2= sqrt($xi_tu2);
	$xi_tu3= sqrt($xi_tu3);
	$xi_tu4= sqrt($xi_tu4);
	$xi_rtu= sqrt($xi_rtu);
	$xi_mid= sqrt($xi_mid);
	$xi_uas= sqrt($xi_uas);
	$xi_na= sqrt($xi_na);
	$xi_nr= sqrt($xi_nr);

echo "<tr bgcolor=\"#FFF\"><td align='center'></td><td>Simpangan Baku</td>";
if ($kurikulum == '2013')
	{
if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_uh1), 2)."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_uh2), 2)."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_uh3), 2)."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_uh4), 2)."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}

if ($cacah_tugas>0)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_tu1), 2)."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_tu2), 2)."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_tu3), 2)."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".round(konversi_nilai($xi_tu4), 2)."</td>";
	}
echo "<td align='center'>".round(konversi_nilai($xi_mid), 2)."</td><td align='center'>".round(konversi_nilai($xi_uas), 2)."</td><td align='center'>".round(konversi_nilai($xi_na), 2)."</td><td align='center'>".round(konversi_nilai($xi_nr), 2)."</td><td></td>";

	}
else
{
if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".round($xi_uh1, 2)."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".round($xi_uh2, 2)."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".round($xi_uh3, 2)."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".round($xi_uh4, 2)."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}

if ($cacah_tugas>0)
	{
	echo "<td align='center'>".round($xi_tu1, 2)."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".round($xi_tu2, 2)."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".round($xi_tu3, 2)."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".round($xi_tu4, 2)."</td>";
	}
echo "<td align='center'>".round($xi_mid, 2)."</td><td align='center'>".round($xi_uas, 2)."</td><td align='center'>".round($xi_na, 2)."</td><td align='center'>".round($xi_nr, 2)."</td>";
	
}
echo "</tr>";
if ($kurikulum == '2013')
{
echo "<tr bgcolor=\"#FFF\"><td align='center'></td><td>Nilai Tertinggi</td>";

if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_uh1)."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_uh2)."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_uh3)."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_uh4)."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_tugas>0)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_tu1)."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_tu2)."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_tu3)."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".konversi_nilai($tertinggi_nilai_tu4)."</td>";
	}
echo "<td align='center'>".konversi_nilai($tertinggi_nilai_mid)."</td><td align='center'>".konversi_nilai($tertinggi_nilai_uas)."</td><td align='center'>".konversi_nilai($tertinggi_nilai_na)."</td><td align='center'>".konversi_nilai($tertinggi_kog)."</td><td></td></tr>";

echo "<tr bgcolor=\"#FFF\"><td align='center'></td><td>Nilai terendah</td>";
if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_uh1)."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_uh2)."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_uh3)."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_uh4)."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_tugas>0)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_tu1)."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_tu2)."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_tu3)."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".konversi_nilai($terendah_nilai_tu4)."</td>";
	}
echo "<td align='center'>".konversi_nilai($terendah_nilai_mid)."</td><td align='center'>".konversi_nilai($terendah_nilai_uas)."</td><td align='center'>".konversi_nilai($terendah_nilai_na)."</td><td align='center'>".konversi_nilai($terendah_kog)."</td><td></td></tr>";

}
else
{
echo "<tr bgcolor=\"#FFF\"><td align='center'></td><td>Nilai Tertinggi</td>";

if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".$tertinggi_nilai_uh1."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".$tertinggi_nilai_uh2."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".$tertinggi_nilai_uh3."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".$tertinggi_nilai_uh4."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_tugas>0)
	{
	echo "<td align='center'>".$tertinggi_nilai_tu1."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".$tertinggi_nilai_tu2."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".$tertinggi_nilai_tu3."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".$tertinggi_nilai_tu4."</td>";
	}
echo "<td align='center'>".$tertinggi_nilai_mid."</td><td align='center'>".$tertinggi_nilai_uas."</td><td align='center'>".$tertinggi_nilai_na."</td><td align='center'>".$tertinggi_kog."</td></tr>";

echo "<tr bgcolor=\"#FFF\"><td align='center'></td><td>Nilai terendah</td>";if ($cacah_ulangan_harian>0)
	{
	echo "<td align='center'>".$terendah_nilai_uh1."</td>";
	}
if ($cacah_ulangan_harian>1)
	{
	echo "<td align='center'>".$terendah_nilai_uh2."</td>";
	}
if ($cacah_ulangan_harian>2)
	{
	echo "<td align='center'>".$terendah_nilai_uh3."</td>";
	}
if ($cacah_ulangan_harian>3)
	{
	echo "<td align='center'>".$terendah_nilai_uh4."</td>";
	}
if ($cacah_kuis>0)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>1)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>2)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_kuis>3)
	{
	echo "<td align='center'></td>";
	}
if ($cacah_tugas>0)
	{
	echo "<td align='center'>".$terendah_nilai_tu1."</td>";
	}
if ($cacah_tugas>1)
	{
	echo "<td align='center'>".$terendah_nilai_tu2."</td>";
	}
if ($cacah_tugas>2)
	{
	echo "<td align='center'>".$terendah_nilai_tu3."</td>";
	}
if ($cacah_tugas>3)
	{
	echo "<td align='center'>".$terendah_nilai_tu4."</td>";
	}
echo "<td align='center'>".$terendah_nilai_mid."</td><td align='center'>".$terendah_nilai_uas."</td><td align='center'>".$terendah_nilai_na."</td><td align='center'>".$terendah_kog."</td></tr>";
}

}
else{
echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}

echo '</table></div>';
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$this->config->item('lokasi').', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}

?>

</body></html>
