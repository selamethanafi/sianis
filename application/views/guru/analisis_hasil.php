<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:33:06 WIB 
// Nama Berkas 		: analisis_hasil.php
// Lokasi      		: application/views/guru
// Author      		: Selamet Hanafi
//              	 selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
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

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/cetak-style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title>HASIL ANALISIS <?php echo $penilaiane.' '.$mapel.' Kelas '.$kelas.' Semester '.$semester.' Tahun '.$thnajaran.' '.$sek_nama;?></title>
</head>
<body>
<div class="potret">
<?php
echo '<table>
<tr><td width="100"><img src ="'.base_url().'images/depag.png" width="90"> </td><td align="center">'.$baris1.'<br />'.$baris2.'<br />'.$baris3.'<br />'.$baris4.'</TD><TR>
</table>';
echo '<h3 class="text-center"><a href="'.base_url().'guru/daftarnilai/'.$id_mapel.'"><strong>HASIL ANALISIS '.$penilaiane.'</strong></a></h3>';
if (!empty($penilaiane))
{
if($kkm_ulangan == 0)
{
	$kkm_ulangan = $kkm;
}
?>
<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Ranah Penilaian</strong></td><td>: <strong><?php echo $ranah;?></strong></td></tr>
<tr><td><strong>KKM Ulangan </strong></td><td>: <strong><?php echo $kkm_ulangan;?> </strong></td></tr>
<tr><td><strong>Cacah Soal </strong></td><td>: <strong><?php echo $nsoal+$nsoalb;?> </strong></td></tr>
</table>
<?php
$jmlsiswa=0;
$jmlblmtuntas=0;
$namasiswa='';
$tebal=0;
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	if ($itemnilai=='uh1')
		{
		$nilaine = $t->nilai_uh1;
		}
	if ($itemnilai=='uh2')
		{
		$nilaine = $t->nilai_uh2;
		}
	if ($itemnilai=='uh3')
		{
		$nilaine = $t->nilai_uh3;
		}
	if ($itemnilai=='uh4')
		{
		$nilaine = $t->nilai_uh4;
		}
	if ($itemnilai=='mid')
		{
		$nilaine = $t->nilai_mid;
		}
	if ($itemnilai=='uas')
		{
		$nilaine = $t->nilai_uas;
		}
	if ($nilaine<$kkm_ulangan)
		{
		if (empty($namasiswa))
			{
			if ($tebal==1)
				{
				$namasiswa .= '<b>'.nis_ke_nama($t->nis).'</b>';	
				$tebal=0;
				}
				else
				{
				$namasiswa .= nis_ke_nama($t->nis);	
				$tebal=1;
				}

			}
			else
			{
			if ($tebal==1)
				{
				$namasiswa .= ', <b>'.nis_ke_nama($t->nis).'</b>';	
				$tebal=0;
				}
				else
				{
				$namasiswa .= ', '.nis_ke_nama($t->nis);	
				$tebal=1;
				}

			}

		$jmlblmtuntas++;
		}
	$jmlsiswa++;
	}
	$jmltuntas = $jmlsiswa - $jmlblmtuntas;
	echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
	<tr><td width="20">1.</td><td colspan="3">Ketuntasan Belajar</td></tr>
	<tr><td></td><td width="20">a.</td><td width="300" colspan="2">Perorangan</td><tr>
	<tr><td></td><td></td><td>Banyak siswa seluruhnya</td><td>: '.$jmlsiswa.' siswa<tr>
	<tr><td></td><td></td><td>Banyak siswa yang belum tuntas belajar</td><td>: '.$jmlblmtuntas.' siswa<tr>
	<tr><td></td><td></td><td>Banyak siswa yang tuntas belajar</td><td>: '.$jmltuntas.' siswa<tr>';
	$persen=round($jmltuntas/$jmlsiswa*100,2);
	echo '<tr><td></td><td></td><td>Persentase banyak siswa yang tuntas belajar</td><td>: '.$persen.' %<tr>';
	if ($persen<$persentase_klasikal)
	{$klasik='Ya';}
	else
	{$klasik='Tidak';}	
	echo '<tr><td></td><td>b.</td><td>Klasikal</td><td>: '.$klasik.'<tr><tr></tr><tr><td>2.</td><td colspan="3">Simpulan</td></tr>
<tr><td></td><td valign="top">a.</td><td colspan="2">Perlu perbaikan klasikal untuk soal nomor ';
	$nomorsoal ='';
	$totalsoal = $nsoal + $nsoalb;
	$ta = $this->db->query("select * from `analisis_dayabeda` where `id_mapel`='$id_mapel' and `ulangan`='$itemnilai'");
	if($ta->num_rows() > 0)
	{
		for($i=1;$i<=$nsoal;$i++)
		{
			$iteme = 'nilai_s'.$i;
			foreach($ta->result() as $a)
			{
				$dayabeda = $a->$iteme;
				if ($dayabeda<= 0.29)
				{
					if (empty($nomorsoal))
					{
						
						$nomorsoal .= '<b>'.$i.'</b>';
					}
					else
					{	
						$nomorsoal .= ', <b>'.$i.'</b>';
					}
				}
			}
		}
		if($nsoalb>0)
		{
			$nomorsoal .= '. Soal uraian nomor';
			for($i=1;$i<=$nsoalb;$i++)
			{
				$ii = $i+$nsoal;
				$iteme = 'nilai_s'.$ii;
				foreach($ta->result() as $a)
				{
					$dayabeda = $a->$iteme;
					if ($dayabeda<= 0.29)
					{
						if (empty($nomorsoal))
						{
								$nomorsoal .= '<b>'.$i.'</b>';
						}
						else
						{	
							$nomorsoal .= ', <b>'.$i.'</b>';
						}
					}
				}
			}
		}
	}  // pembeda
	
	else
	{ // biasa
		$tTampil_Semua_Nilai_Analisis=$this->db->query("select * from analisis where mapel='$mapel' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and ulangan='$itemnilai' and status='Y' order by no_urut");
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
					$persentaseb = 0;
					if($skormakspersoalb>0)
					{
						$persentaseb = $nilb[$kolomb] / $skormakspersoalb * 100;
					}
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
			if ($nsoalb>0)
			{
				$nomorsoal .= '<br />Uraian nomor '.$nomorsoalb;
			}
		}
	 }  // akhir biasa
	echo $nomorsoal;
	echo '</td><tr>';
	echo '<tr><td></td><td valign="top">b.</td><td colspan="2">Perlu perbaikan secara individual untuk siswa sebagai berikut : '.$namasiswa.'</td><tr>';
}
else
{
	echo "<tr><td colspan='5'>Belum ada daftar nilai</td></tr>";
}
?>
</table>
<?php
$namakepala = cari_kepala($thnajaran,$semester);
$nipkepala = cari_nip_kepala($thnajaran,$semester);
$ttdkepala = cari_ttd_kepala($thnajaran,$semester);
$tanggalcetak = tanggalcetak($thnajaran,$semester);
$namapegawai = cari_nama_pegawai($kodeguru);
$nipguru = cari_nip_pegawai($kodeguru);

echo '<table>
<tr><td colspan="2">Keterangan :</td></tr>
<tr><td width="30">a.</td><td> Daya serap siswa : seorang siswa disebut telah tuntas belajar bila ia telah mencapai KKM</td></tr>
<tr><td>b.</td><td>Daya serap klasikal : Suatu kelas disebut telah tuntas belajar bila di kelas tersebut telah terdapat '.$persentase_klasikal.'% yang mencapai KKM</td><tr></table>';
}
if ($ditandatangani=='ya')
{
	$ttdkepala = cari_ttd_kepala_stempel($thnajaran,$semester);
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.'Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>'.$plt.'Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', <br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
?>
</div>
</body></html>
