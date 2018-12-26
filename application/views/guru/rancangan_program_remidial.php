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

$ulangan = strtolower($itemnilai);
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
$penilaiane = 'BELUM DIDUKUNG APLIKASI';
if ($itemnilai=='uh1')
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
if ($itemnilai=='uh2')
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
if ($itemnilai=='uh3')
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
if ($itemnilai=='uh4')
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
if ($itemnilai=='mid')
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
if ($itemnilai=='uas')
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
		$materi = '';
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
	// cari di bip
	$tc = $this->db->query("select * from `guru_bip` where `thnajaran`='$thnajaran' and `semester`= '$semester' and `kelas`='$kelas' and `jenisulangan`='$ulangan' and `mapel`='$mapel' and `kodeguru`='$kodeguru'"); 
	foreach($tc->result() as $c)
	{
		$materi = $c->skkdmateri;
	}
	$skoruraian = 0;
	if($nsoalb>0)
		{
		$skoruraian = $skorb / $nsoalb;
		}
	$querysiswa = $this->db->query("SELECT * FROM `siswa_kelas` WHERE `thnajaran`='$thnajaran' and `semester`= '$semester' and `kelas`='$kelas' and `status`='Y'");
	$cacahsiswa = $querysiswa->num_rows();
	$lebarkolom = 20;
	$skormaks = $nsoal * $skor;
	$lebartabel = '95%';
	$nsoale = $nsoal + $nsoalb;
	$tb = $this->db->query("select * from `guru_tindak_lanjut` where `id_guru_tindak_lanjut`='$id_mapel' and ulangan='$ulangan'");
	$tanggalrp = '';
	$tindakan_pengayaan = '';
	$tindakan_satu = '';
	$tindakan_dua = '';
	foreach($tb->result() as $b)
	{
		$tanggalrp = $b->tanggal;
		$tindakan_pengayaan = $b->tindakan_pengayaan;
		$tindakan_satu = $b->tindakan_satu;
		$tindakan_dua = $b->tindakan_dua;
	}
	echo '<table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td align="center"><a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'"><b>RANCANGAN PROGRAM REMIDIAL '.$penilaiane.'</b></a></td></tr></table><table width="'.$lebartabel.'" cellpadding="2" cellspacing="1" class="widget-small"><tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong>'.$thnajaran.'</strong></td></tr><tr><td><strong>Semester</strong></td><td>: <strong>'.$semester.'</strong></td></tr><tr><td><strong>Kelas</strong></td><td>: <strong>'.$kelas.'</strong></td></tr><tr><td><strong>Mata Pelajaran</strong></td><td>: <strong>'.$mapel.'</strong></td></tr>
<tr><td><strong>Tanggal Pelaksanaan</strong></td><td>: <strong>'.date_to_long_string($tanggalrp).'</strong></td></tr><tr><td><strong>KKM Ulangan</strong></td><td>: <strong>'.$kkm_ulangan.'</strong></td></tr>
<tr><td valign="top" colspan="2"><strong>Materi</strong>'.$materi.'</td></tr>';
	//cari indikator
	$ta=$this->db->query("select * from `indikator` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel' and `ulangan`='$ulangan'");
	$adaindikator = $ta->num_rows();
	if($adaindikator == 0)
		{
		echo '</table>';
		}
		else
		{
		echo '<tr><td><strong>Indikator</strong></td><td>:</td></tr></table>';

			echo '<table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">';
			foreach($ta->result() as $a)
			{
				for($i=1;$i<=$nsoal;$i++)
				{
					$itemindikator = 'i_'.$i;
					$isi_indikator = $a->$itemindikator;
					echo "<tr bgcolor='#fff'><td align='center' width='30'>".$i;
					echo '</td><td>'.$isi_indikator.'</td></tr>';
				}
			}
			echo '</table>';
 		}
	echo '<BR /><div class="CSSTableGenerator"><table width="'.$lebartabel.'" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small"><tr align="center">	<td  width="25" align="center">NO</td><td   align="center">NAMA SISWA</td><td align="center">NILAI ULANGAN</td><td align="center">INDIKATOR YANG TIDAK DIKUASAI</td><td align="center" >BENTUK PELAKSANAAN PEMBELAJARAN REMIDIAL</td><td>Nomor Soal yang dikerjakan</td><td>Ket</td></tr>';
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
			$nis = $t->nis;
			$namasiswa = nis_ke_nama($nis);
			$kolom = 0;
			$nilaipersiswa= 0;
			$indikatorbelumdikuasai = '';
			$nindikatorbelumdikuasai = '';
			do
			{	
				$nilaine=0;
				$nokol = $kolom + 1;
				$item = 'nilai_s'.$nokol.'';
				$nilaine = $t->$item;
				$nil[$kolom]=$nil[$kolom]+$nilaine;	
				$nilaipersiswa= $nilaipersiswa + $nilaine;
				if($nilaine < $skor)
					{
					if(empty($indikatorbelumdikuasai))
						{
						$indikatorbelumdikuasai .= $nokol;
						$itemindikator = 'i_'.$nokol;
							foreach($ta->result() as $a)
							{
							$nindikatorbelumdikuasai .= $a->$itemindikator;
							}
						}
						else
						{
						$indikatorbelumdikuasai .= ', '.$nokol;
						$itemindikator = 'i_'.$nokol;
							foreach($ta->result() as $a)
							{
							$nindikatorbelumdikuasai .= ''.$a->$itemindikator;
							}

						}

					}
//				echo '<td align="center">'.$nilaine.'</td>';
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
				$nokol = $nsoal + $nokolb;
				$nilaineb = $t->$item;
				if($nilaineb < $skoruraian)
					{
					if(empty($indikatorbelumdikuasai))
						{
						$indikatorbelumdikuasai .= $nokol;
						$itemindikator = 'i_'.$nokol;
							foreach($ta->result() as $a)
							{
							$nindikatorbelumdikuasai .= $a->$itemindikator;
							}
						}
						else
						{
						$indikatorbelumdikuasai .= ', '.$nokol;
						$itemindikator = 'i_'.$nokol;
							foreach($ta->result() as $a)
							{
							$nindikatorbelumdikuasai .= ''.$a->$itemindikator;
							}

						}

					}

				$nilb[$kolomb]=$nilb[$kolomb]+$nilaineb;
				$nilaipersiswab= $nilaipersiswab + $nilaineb;
//				echo '<td align="center">'.$nilaineb.'</td>';
				$kolomb++;
				}
				while ($kolomb<$nsoalb);
			}
			$persentase =round($nilaipersiswa / $skormaks * $skora,2);
			$nilaiulangan = $persentase + $nilaipersiswab;
			if($nilaiulangan<$kkm)
			{
				if ($nilaiulangan < 50)
				{
					$tindakan = $tindakan_satu;
				}
				else
				{
					$tindakan = $tindakan_dua;
				}

				echo "<tr bgcolor='#fff' valign=\"top\"><td align='center'>";
				echo ''.$nomor.'</td><td>'.$namasiswa.'</td><td align="center">'.$nilaiulangan.'</td>';
				if(!empty($nindikatorbelumdikuasai))
					{
					echo '<td>'.$nindikatorbelumdikuasai.'</td>';
					}
					else
										{
					echo '<td>'.$indikatorbelumdikuasai.'</td>';
					}
				echo '<td>'.$tindakan.'</td><td>'.$indikatorbelumdikuasai.'</td><td></td>';
				$nomor++;
			}
			echo '</tr>';
		}
		echo '</table></div>';
		$namakepala = cari_kepala($thnajaran,$semester);
		$nipkepala = cari_nip_kepala($thnajaran,$semester);
		$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
		$namapegawai = cari_nama_pegawai($kodeguru);
		$nipguru = cari_nip_pegawai($kodeguru);
		$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
		$tanggalcetak = $tanggalrp;
		echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
	} // kalau ada siswa di tabel analisis
}
else
{
	echo '<h1>MACAM ULANGAN TIDAK DIKENAL, SEHARUSNYA uh1, uh2, uh3, uh4, mid, uas</h1>';
}
?>
</div>
</BODY></HTML>

