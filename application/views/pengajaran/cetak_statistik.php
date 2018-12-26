<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: cetak_statistik.php
// Lokasi      		: application/views/pengajaran/
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
<?php
if ($ulangan=='uh1')
	{
	$penilaiane = 'ULANGAN HARIAN I';
	}
if ($ulangan=='uh2')
	{
	$penilaiane = 'ULANGAN HARIAN II';
	}
if ($ulangan=='uh3')
	{
	$penilaiane = 'ULANGAN HARIAN III';
	}
if ($ulangan=='uh4')
	{
	$penilaiane = 'ULANGAN HARIAN IV';
	}
if ($ulangan=='mid')
	{
	$penilaiane = 'ULANGAN TENGAH SEMESTER';
	}
if ($ulangan=='smt')
	{
	$penilaiane = 'ULANGAN AKHIR SEMESTER';
	}
echo '<p class="text-center"><a href="'.base_url().'pengajaran/statistik">STATISTIK '.$penilaiane.'</a>';
?>
<table>
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
</table><br>
<?php

echo '<table class="table table-striped table-bordered">
<tr><td width="50">No</td><td align="center">Mata Pelajaran</td><td align="center">KKM</td><td align="center">Rata - Rata</td><td align="center">Tertinggi</td><td align="center">Terendah</td><td align="center">Simpangan Baku</td><td align="center">Klasikal</td></tr>';

	if ($ulangan=='mid')
	{
	$tmapel = $this->db->query("select DISTINCT `mapel`, `ranah`, `kkm`,`kkm_uh1`, `kkm_uh2`, `kkm_uh3`, `kkm_uh4`, `kkm_mid`, `kkm_uas` from m_mapel where thnajaran='$thnajaran' and semester='$semester' and `kelas`='$kelas' and adamid='Y' order by mapel");
	}
	else
	{
	$tmapel = $this->db->query("select DISTINCT `mapel`, `ranah`, `kkm`,`kkm_uh1`, `kkm_uh2`, `kkm_uh3`, `kkm_uh4`, `kkm_mid`, `kkm_uas` from m_mapel where thnajaran='$thnajaran' and semester='$semester' and `kelas`='$kelas' order by mapel");
	}

	$no=1;
	$cacah = 0;
	foreach($tmapel->result_array() as $dmapel)
	{
		$ranah = $dmapel['ranah'];
		$mapel = $dmapel['mapel'];
		$kkmmapel = $dmapel['kkm'];
		$kkm = $dmapel['kkm'];
			if ($ulangan=='uh1')
			{
			$kkm = $dmapel['kkm_uh1'];
			}
			if ($ulangan=='uh2')
			{
			$kkm = $dmapel['kkm_uh2'];
			}
			if ($ulangan=='uh3')
			{
			$kkm = $dmapel['kkm_uh3'];
			}
			if ($ulangan=='uh4')
			{
			$kkm = $dmapel['kkm_uh4'];
			}
			if ($ulangan=='mid')
			{
			$kkm_mid = $dmapel['kkm_mid'];
			}
			if ($ulangan=='smt')
			{
			$kkm = $dmapel['kkm_uas'];
			}
			if ($kkm == 0)
				{
				$kkm=$dmapel['kkm'];				
				}
				else
				{
				$kkm=$kkmmapel; 
				}
		//echo 'kkm_'.$no.'-'.$kkmmapel.'-kkmule '.$kkm.'-'.$dmapel['kkm_mid'].' '.$kkm_mid.'<br>';
		$tnilai = $this->db->query("select * from `nilai` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and status='Y'");

		$adaka = $tnilai->num_rows();
		$ratanilai = 0;
		$tertinggi =0;
		$terendah = 1000;
		foreach($tnilai->result_array() as $dnilai)
		{
			if ($ulangan=='uh1')
			{
			$nilai_mid = $dnilai['nilai_uh1'];
			}
			if ($ulangan=='uh2')
			{
			$nilai_mid = $dnilai['nilai_uh2'];
			}
			if ($ulangan=='uh3')
			{
			$nilai_mid = $dnilai['nilai_uh3'];
			}
			if ($ulangan=='uh4')
			{
			$nilai_mid = $dnilai['nilai_uh4'];
			}
			if ($ulangan=='mid')
			{
			$nilai_mid = $dnilai['nilai_mid'];
			}
			if ($ulangan=='smt')
			{
			$nilai_mid = $dnilai['nilai_uas'];
			}

		if ($tertinggi < $nilai_mid)
			{$tertinggi = $nilai_mid;}
		if ($terendah > $nilai_mid)
			{$terendah = $nilai_mid;}

		if (($ranah=='KA') or ($ranah=='KPA'))
			{$ratanilai = $ratanilai + $nilai_mid;}
		}

		if ($adaka==0)
			{
			$ratanilaine='?';
			}
			else
			{
			$ratanilaine= $ratanilai/$adaka;
			$ratanilaine = round($ratanilaine, 2);
			}
		//simpangan baku
		$xi_ul=0;
		$xi_ule=0;
		$tnilai = $this->db->query("select * from `nilai` where `mapel`='$mapel' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and status='Y'");
		$adaka = $tnilai->num_rows();
		$ratanilai = 0;
		foreach($tnilai->result_array() as $dnilai)
		{
			if ($ulangan=='uh1')
			{
			$nilai_mid = $dnilai['nilai_uh1'];
			}
			if ($ulangan=='uh2')
			{
			$nilai_mid = $dnilai['nilai_uh2'];
			}
			if ($ulangan=='uh3')
			{
			$nilai_mid = $dnilai['nilai_uh3'];
			}
			if ($ulangan=='uh4')
			{
			$nilai_mid = $dnilai['nilai_uh4'];
			}
			if ($ulangan=='mid')
			{
			$nilai_mid = $dnilai['nilai_mid'];
			}
			if ($ulangan=='smt')
			{
			$nilai_mid = $dnilai['nilai_uas'];
			}
			$x_ul = $ratanilaine - $nilai_mid ;
			$xx_ul= $x_ul * $x_ul ;
			$xi_ul= $xi_ul + $xx_ul ;
			//echo 'mapel '.$mapel.' '.$nilai_mid.' - '.$ratanilaine.' '.$x_ul.' kuadrat '.$xx_ul.' jml '.$xi_ul.'<br>';
		}
		$xi_ule= sqrt($xi_ul);
		$klasikal='';
		if ($ratanilaine > 0 )
			 {
			if ($ratanilaine<$kkm)
				{
				$klasikal='Ya';
				}
				else
				{
				$klasikal='Tidak';
				}
			}
		echo '<tr><td align="center">'.$no.'</td><td>'.$mapel.'</td><td align="center">'.$kkm.'</td><td align="center">'.$ratanilaine.'</td><td align="center">'.$tertinggi.'</td><td align="center">'.$terendah.'</td><td align="center">'.round($xi_ule,2).'</td><td align="center">'.$klasikal.'</td></tr>';
		$no++;
	}

echo '</table><br><br><br>';
?>
