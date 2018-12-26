<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : analisis_cetak.php
// Lokasi      : application/views/shared/
// Author: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>ANALISIS BUTIR SOAL ULANGAN - <?php echo $this->config->item('nama_web');?></title>
</head>
<body>
<?php echo '<a href="'.base_url().'index.php/'.strtolower($status).'/perangkat"><h3>Kembali</h3></a>';
$ulangan = strtolower($ulangan);
if(!empty($id_mapel))
	{
	$tmapel = $this->db->query("SELECT * FROM `m_mapel` WHERE `id_mapel`='$id_mapel'");
	}
	else
	{
	$tmapel = $this->db->query("SELECT * FROM `m_mapel` WHERE `thnajaran`='$thnajaran' and `semester`= '$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
	}
$ditemukan = $tmapel->num_rows();
if($ditemukan == 0)
	{
		echo '<h1>DATA TIDAK DITEMUKAN</h1>';
	}
elseif(($ulangan=='uh1') or ($ulangan=='uh2') or ($ulangan=='uh3') or ($ulangan=='uh4') or ($ulangan=='mid') or ($ulangan=='uas'))
{
	foreach($tmapel->result() as $dtmapel)
	{
		$kelas = $dtmapel->kelas;
		$mapel = $dtmapel->mapel;
		$thnajaran = $dtmapel->thnajaran;
		$semester = $dtmapel->semester;
		$kkm = $dtmapel->kkm;
		$kodeguru = $dtmapel->kodeguru;
		if ($ulangan=='uh1')
		{
			$kkm_ulangan = $dtmapel->kkm_uh1;
			$nsoal = $dtmapel->nsoal_uh1;
			$skor = $dtmapel->skor_uh1;
			$skora = $dtmapel->nilai_maks_bagian_a_uh1;
			$skorb = $dtmapel->nilai_maks_bagian_b_uh1;
			$nsoalb = $dtmapel->nsoal_b_uh1;
			$oke = 0;
		}
		if ($ulangan=='uh3')
		{
				$kkm_ulangan = $dtmapel->kkm_uh3;
				$nsoal = $dtmapel->nsoal_uh3;
				$skor = $dtmapel->skor_uh3;
				$skora = $dtmapel->nilai_maks_bagian_a_uh3;
				$skorb = $dtmapel->nilai_maks_bagian_b_uh3;
				$nsoalb = $dtmapel->nsoal_b_uh3;
				$oke = 0;
		}
		if ($ulangan=='uh4')
		{
				$kkm_ulangan = $dtmapel->kkm_uh4;
				$nsoal = $dtmapel->nsoal_uh4;
				$skor = $dtmapel->skor_uh4;
				$skora = $dtmapel->nilai_maks_bagian_a_uh4;
				$skorb = $dtmapel->nilai_maks_bagian_b_uh4;
				$nsoalb = $dtmapel->nsoal_b_uh4;
		}
		if ($ulangan=='uh2')
		{
				$kkm_ulangan = $dtmapel->kkm_uh2;
				$nsoal = $dtmapel->nsoal_uh2;
				$skor = $dtmapel->skor_uh2;
				$skora = $dtmapel->nilai_maks_bagian_a_uh2;
				$skorb = $dtmapel->nilai_maks_bagian_b_uh2;
				$nsoalb = $dtmapel->nsoal_b_uh2;
				$oke = 0;
		}
		if ($ulangan=='mid')
		{
				$kkm_ulangan = $dtmapel->kkm_mid;
				$nsoal = $dtmapel->nsoal_mid;
				$skor = $dtmapel->skor_mid;
				$skora = $dtmapel->nilai_maks_bagian_a_mid;
				$skorb = $dtmapel->nilai_maks_bagian_b_mid;
				$nsoalb = $dtmapel->nsoal_b_mid;
				$oke = 0;
		}
		if ($ulangan=='uas')
				{
				$kkm_ulangan = $dtmapel->kkm_uas;
				$nsoal = $dtmapel->nsoal_uas;
				$skor = $dtmapel->skor_uas;
				$skora = $dtmapel->nilai_maks_bagian_a_uas;
				$skorb = $dtmapel->nilai_maks_bagian_b_uas;
				$nsoalb = $dtmapel->nsoal_b_uas;
				$oke = 0;
		}
	} // akhir data mapel
	$querysiswa = $this->db->query("SELECT * FROM `siswa_kelas` WHERE `thnajaran`='$thnajaran' and `semester`= '$semester' and `kelas`='$kelas' and `status`='Y'");
	$cacahsiswa = $querysiswa->num_rows();
	$lebarkolom = 20;
	$skormaks = $nsoal * $skor;
	$lebartabel = 455 + ($nsoal*$lebarkolom);
	$nsoale = $nsoal + $nsoalb;
	echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="100"><img src ="'.base_url().'/images/depag.png" width="90"> </td><td align="center">'.$this->config->item('baris1').'<br>'.$this->config->item('baris2').'<br>'.$this->config->item('baris3').'<br>'.$this->config->item('baris4').'</TD><TR>
</table>';
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
	if ($ulangan=='uas')
	{
		$penilaiane = 'ULANGAN AKHIR SEMESTER';
	}
	echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center"><b>ANALISIS BUTIR SOAL '.$penilaiane.'</b><br></td></tr></table><table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr><tr><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr><tr><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr><tr><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr><tr><td><strong>KKM</strong></td><td>: <strong>'.$kkm_ulangan.'</strong></td></tr></table><br>';
	echo '<table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small"><tr bgcolor="#FFF" align="center">	<td  width="25" align="center" rowspan="2">No</td>		    <td  width="200" align="center" rowspan="2">Nama Siswa</td>		    <td align="center" colspan="'.$nsoale.'">SKOR YANG DICAPAI</td>		    <td width="150" align="center" colspan="2">SKOR</td><td width="80" align="center" rowspan="2">Ketuntasan</td></tr><tr bgcolor="#FFF" align="center">';
	$lebarkolom = ($lebartabel- 320) / $nsoale;
	$kolom = 0;
	do
	{	
		$nokol = $kolom + 1;
		$nil[$kolom]=0;
		echo '<td width="'.$lebarkolom.'">'.$nokol.'</td>';
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
		echo '<td width="'.$lebarkolom.'">'.$nokolb.'</td>';
		$kolomb++;
		}
		while ($kolomb<$nsoalb);
	}
	echo '<td align="center">Dicapai</td><td align="center">Nilai</td></tr>';
	$nomor=1;
	$jmlbelumtuntas=0;

	$query = $this->db->query("SELECT * FROM `analisis` WHERE `thnajaran`='$thnajaran' and `semester`= '$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `ulangan`='$ulangan' and `status`='Y'");
	$skormakspersoal = $skor * $cacahsiswa;
	$siswa_belum_tuntas = '';
	if($cacahsiswa>0)
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
			if(($nomor%2)==0){
				$warna="#C8E862";
			} else{
				$warna="#D6F3FF";
			}
			$nis = $t->nis;
			$namasiswa = nis_ke_nama($nis);
			echo "<tr bgcolor='".$warna."'><td align='center'>";
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
				$jmlbelumtuntas++;
				if(empty($siswa_belum_tuntas))
				{
					$siswa_belum_tuntas .= $namasiswa;
				}
				else
				{
				$siswa_belum_tuntas .= ', '.$namasiswa;
				}
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
		echo '</tr><tr><td align="center"></td><td>Persentase</td>';
		$kolom = 0;
		do
		{	
			$persentase = round($nil[$kolom]/$skormakspersoal*100,0);
			echo '<td align="center">'.$persentase.'</td>';
		//	echo '<td></td>';
			if ($persentase<$kkm_ulangan)
			{
				$perbaikan[$kolom]='Y';
			}
			else
			{
				$perbaikan[$kolom]='T';
			}
			$kolom++;
		}
		while ($kolom<$nsoal);
		echo '</tr><tr><td align="center"></td><td>Perbaikan Soal</td>';
		$kolom = 0;
		do
		{	
			echo '<td align="center">'.$perbaikan[$kolom].'</td>';
			$kolom++;
		}
		while ($kolom<$nsoal);
		echo '</tr>';
		echo '</table><br />';
		echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center"><b> HASIL ANALISIS '.$penilaiane.'</b><br></td></tr></table>';
		$jmltuntas = $cacahsiswa - $jmlbelumtuntas;
		echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="20">1.</td><td colspan="3">Ketuntasan Belajar</td></tr><tr><td></td><td width="20">a.</td><td colspan="2">Perorangan</td><tr><tr><td></td><td></td><td width="300">Banyak siswa seluruhnya</td><td>: '.$cacahsiswa.' siswa<tr><tr><td></td><td></td><td>Banyak siswa yang belum tuntas belajar</td><td>: '.$jmlbelumtuntas.' siswa<tr><tr><td></td><td></td><td>Banyak siswa yang tuntas belajar</td><td>: '.$jmltuntas.' siswa<tr>';
		$persen=round($jmltuntas/$cacahsiswa*100,2);
		echo '<tr><td></td><td></td><td>Persentase banyak siswa yang tuntas belajar</td><td>: '.$persen.' %<tr>';
		if ($persen<$this->config->item('persentase_klasikal'))
		{$klasik='Ya';}
		else
		{$klasik='Tidak';}	
		echo '<tr><td></td><td>b.</td><td>Klasikal</td><td>: '.$klasik.'<tr><tr></tr><tr><td>2.</td><td colspan="3">Simpulan</td></tr><tr><td></td><td valign="top">a.</td><td valign="top" colspan="2">Perlu perbaikan klasikal untuk soal nomor<br>';
		$tTampil_Semua_Nilai_Analisis=$this->db->query("select * from analisis where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and ulangan='$ulangan' and status='Y' order by no_urut");
		$nomor=1;
		$skormaksb = $skorb;
		$skormaks = $nsoal * $skor;
		$kolom = 0;
		do
		{	
			$nil[$kolom]=0;
			$kolom++;
		}
		while ($kolom<$nsoal);
		$nomorsoal ='';
		$cacahsiswa = count($tTampil_Semua_Nilai_Analisis->result());
		$skormakspersoal = $skor * $cacahsiswa;
		$skormakspersoalb =0;
		if ($nsoalb>0)
		{
			$skormakspersoalb = $skorb * $cacahsiswa / $nsoalb;
			$kolomb = 0;
			do
			{
				$nokolb = $kolomb + 1;
				$nilb[$kolomb]=0;
				$kolomb++;
			}
			while ($kolomb<$nsoalb);
		}
		if(count($tTampil_Semua_Nilai_Analisis->result())>0)
		{
			foreach($tTampil_Semua_Nilai_Analisis->result() as $u)
			{
				$kolom = 0;
				$nilaine=0;
				do
				{
					$nokol = $kolom + 1;
					$item = 'nilai_s'.$nokol.'';
					$nilaine = $u->$item;
					$nil["$kolom"]=$nil["$kolom"]+$nilaine;
					$kolom++;
				}
				while ($kolom<$nsoal);
				if ($nsoalb>0)
				{
					$kolomb = 0;
					$nilaineb=0;
					do
					{
						$nokolb = $kolomb + 1;
						$itemb = 'uraian_'.$nokolb.'';
						$nilaineb = $u->$itemb;
						$nilb[$kolomb]=$nilb[$kolomb]+$nilaineb;
						$kolomb++;
					}
					while ($kolomb<$nsoalb);
				}
				$nomor++;	
			}
			$kolom = 0;
			do
			{
				$nokol = $kolom + 1;
				$persentase = $nil[$kolom] / $skormakspersoal * 100;
				if ($persentase<$kkm_ulangan)
				{
					if (empty($nomorsoal))
					{	
						$nomorsoal .= '<b>'.$nokol.'</b>';
					}
					else
					{	
						$nomorsoal .= ', <b>'.$nokol.'</b>';
					}
				}
				$kolom++;
			}
			while ($kolom<$nsoal);
			if ($nsoalb>0)
			{
				$kolomb = 0;
				$nomorsoalb='';
				do
				{
					$nokolb = $kolomb + 1;
					$persentaseb = $nilb[$kolomb] / $skormakspersoalb * 100;
					if ($persentaseb<$kkm_ulangan)
					{
						if (empty($nomorsoalb))
						{	
							$nomorsoalb .= '<b>'.$nokolb.'</b>';
						}
						else
						{	
							$nomorsoalb .= ', <b>'.$nokolb.'</b>';
						}
					}
				$kolomb++;
				}
				while ($kolomb<$nsoalb);
			}
			echo $nomorsoal;
			if ($nsoalb>0)
			{
				echo '<br />Uraian nomor '.$nomorsoalb;
			}
			echo '<br><br></td><tr>';
			echo '<tr><td></td><td valign="top">b.</td><td valign="top" colspan="2">Perlu perbaikan secara individual untuk siswa sebagai berikut :<br>'.$siswa_belum_tuntas.'</td><tr>';
		} 
		echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td colspan="2">Keterangan :</td></tr><tr><td valign="top" width="30">a.</td><td> Daya serap siswa : seorang siswa disebut telah tuntas belajar bila ia telah mencapai KKM</td></tr><tr><td valign="top">b.</td><td>Daya serap klasikal : Suatu kelas disebut telah tuntas belajar bila di kelas tersebut telah terdapat '.$this->config->item('persentase_klasikal').'% yang mencapai KKM</td><tr></table><br><br>';
		// akhir hasil analisis
		$tb = $this->db->query("select * from `guru_tindak_lanjut` where `id_guru_tindak_lanjut`='$id_mapel' and ulangan='$ulangan'");
		if(count($tb->result())>0)
		{
			foreach($tb->result() as $b)
			{
				$tanggalrp = $b->tanggal;
				$tindakan_pengayaan = $b->tindakan_pengayaan;
				$tindakan_satu = $b->tindakan_satu;
				$tindakan_dua = $b->tindakan_dua;
			}
			echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center"><b>PERBAIKAN / PENGAYAAN</b></td></tr></table><br>';
			$lebartabel='400';
			echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td><strong>Tanggal Perbaikan / Pengayaan</strong></td><td>: <strong>'.date_to_long_string($tanggalrp).'</strong></td></tr></table><br>';
			echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td><strong>PERBAIKAN</strong></td></tr></table>';
			$nomor = 1;
			$query = $this->db->query("SELECT * FROM `analisis` WHERE `thnajaran`='$thnajaran' and `semester`= '$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `ulangan`='$ulangan' and `status`='Y'");
			$cacahsiswa = count($query->result());
			$skormakspersoal = $skor * $cacahsiswa;
			$siswa_belum_tuntas = '';
			$lebartabel = "100%";
			echo '<table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small"><tr align="center" bgcolor="#fff"><td width="30">Nomor</td><td width="200">Nama Siswa</td><td width="40">Nilai</td><td>Tindak Lanjut</td><td width="50">Nilai Perbaikan</td></tr>';
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
				if(($nomor%2)==0){
				$warna="#C8E862";
				} else{
				$warna="#D6F3FF";
				}
				$nis = $t->nis;
				$namasiswa = nis_ke_nama($nis);
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
						$kolomb++;
					}
					while ($kolomb<$nsoalb);
				}
				$persentase =round($nilaipersiswa / $skormaks * $skora,2);
				$nilaiulangan = $persentase + $nilaipersiswab;
				$tindakan = $tindakan_dua;
				if ($nilaiulangan < $kkm_ulangan)
				{
				
					$kd ='';
					if($nilaiulangan<50)
						{
						$tindakan = $tindakan_satu;
						}
					$tc = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `nis`='$nis'");
					$nilai_tersimpan = 0;
					foreach($tc->result() as $c)
					{
						$itemnilai = 'nilai_'.$ulangan;
						$kd = $c->kd;
						$nilai_tersimpan = $c->$itemnilai;
					}
					$nilairemidi = 0;
					$nilaiuh = 0;
					$td = $this->db->query("select * from `nilai_remidi` where `kd`='$kd' and ulangan='$ulangan'");
					foreach($td->result() as $d)
					{
						$nilairemidi = $d->nilai;
						$nilaiuh = $d->nilai_uh;
					}
					if($nilai_tersimpan>$nilairemidi)
						{
						$nilairemidi = $nilai_tersimpan;
						}
					echo "<tr bgcolor='".$warna."'><td align='center'>";
					echo ''.$nomor.'</td><td>'.$namasiswa.'</td>';
					echo '<td align="center">'.$nilaiulangan.' </td><td>'.$tindakan.'</td><td align="center">'.$nilairemidi.'</td></tr>';
					$nomor++;	
				}
			}
			echo '</table><br />';
			//PENGAYAAN
			echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td><strong>PENGAYAAN</strong></td></tr></table>';
			$lebartabel='100%';
			$nomor = 1;
			$query = $this->db->query("SELECT * FROM `analisis` WHERE `thnajaran`='$thnajaran' and `semester`= '$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `ulangan`='$ulangan' and `status`='Y'");
			$cacahsiswa = count($query->result());
			$skormakspersoal = $skor * $cacahsiswa;
			$siswa_belum_tuntas = '';
			$lebartabel = "100%";

			echo '<table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small"><tr bgcolor="#FFF" align="center"><td width="30">Nomor</td><td width="200">Nama Siswa</td><td width="40">Nilai</td><td>Tindak Lanjut</td></tr>';
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
				if(($nomor%2)==0){
				$warna="#C8E862";
				} else{
				$warna="#D6F3FF";
				}
				$nis = $t->nis;
				$namasiswa = nis_ke_nama($nis);
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
						$kolomb++;
					}
					while ($kolomb<$nsoalb);
				}
				$persentase =round($nilaipersiswa / $skormaks * $skora,2);
				$nilaiulangan = $persentase + $nilaipersiswab;
				if ($nilaiulangan >= $kkm_ulangan)
				{
					echo "<tr bgcolor='".$warna."'><td align='center'>";
					echo ''.$nomor.'</td><td>'.$namasiswa.'</td>';
					echo '<td align="center">'.$nilaiulangan.' </td><td>'.$tindakan_pengayaan.'</td>';
					echo '</tr>';
					$nomor++;	
				}
			}
			echo '</table><br />';
			$jmlblmtuntas = 0;
			echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center"><b>KETUNTASAN BELAJAR</b></td></tr></table><br>';
			$query_nilai = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and kelas='$kelas' and status='Y' order by no_urut");
			if(count($query_nilai->result())>0)
			{
				foreach($query_nilai->result() as $t)
				{
					$itemnilai= 'nilai_'.$ulangan;
					$nilaine = $t->$itemnilai;
					$kd = $t->kd;
					if ($nilaine<$kkm)
					{
						$td = $this->db->query("select * from `nilai_remidi` where `kd`='$kd' and ulangan='$ulangan'");
						foreach($td->result() as $d)
						{
							$nilairemidi = $d->nilai;
						}
						if($nilairemidi<$kkm)
						{
							$jmlblmtuntas++;
						}
					}
				}
			}
			$jmltuntas = $cacahsiswa - $jmlblmtuntas;
			echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="300">Banyak siswa seluruhnya</td><td>: '.$cacahsiswa.' siswa</td></tr><tr><td>Banyak siswa yang belum tuntas belajar</td><td>: '.$jmlblmtuntas.' siswa</td></tr><tr><td>Banyak siswa yang tuntas belajar</td><td>: '.$jmltuntas.' siswa</td></tr>';
			$persen=round($jmltuntas/$cacahsiswa*100,2);
			echo '<tr><td>Persentase banyak siswa yang tuntas belajar</td><td>: '.$persen.' %</td></tr>';
			echo '</table><br/>';

		}
		else
		{
		echo '<h1>BELUM ADA DATA PROGRAM PELAKSANAAN REMIDIAL ATAU PENGAYAAN</h1>';
		}

	} // kalau ada siswa di tabel analisis
	$namaguru = cari_nama_pegawai($kodeguru);
	$yangdicetak = 'ANALISIS BUTIR SOAL '.$penilaiane;
	$tugastambahan = '';
	if($sms==1)
	{
	require_once("kirim_pesan.php");
	}

}
else
{
	echo '<h1>MACAM ULANGAN TIDAK DIKENAL, SEHARUSNYA uh1, uh2, uh3, uh4, mid, uas</h1>';
}
?>
</BODY></HTML>
<script>
	window.close();
</script>
