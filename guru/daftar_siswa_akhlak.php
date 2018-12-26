<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 10 Jun 2015 12:16:38 WIB 
// Nama Berkas 		: daftari_siswa_akhlak.php
// Lokasi      		: application/views/bp/
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
<div class="container-fluid"><h2>Modul Daftar Nilai Kepribadian dan Akhlak Mulia</h2>
<p><a href="<?php echo base_url(); ?>guru/walikelas/" class="btn btn-info"><b> Kembali</b></a></p>

<table width="100%" bgcolor="#fff" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
</table>
<?php
$adaitem = 0;
$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
$itemke = 1;
foreach($tb->result() as $b)
	{
	$des[$itemke] = $b->item;
	$itemke++;
	}
$adatb = $tb->num_rows();
if(($adatb == 0) and (!empty($thnajaran)))
{
	echo 'Tabel item penilaian sikap spiritual kosong';
}
//jmlguru
$tma = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='T' and `kelas`='$kelas' order by `kodeguru`,kelas");
$rekapkodeguru = '';
foreach($tma->result_array() as $dma)
	{
	if(empty($rekapkodeguru))
		{
		$rekapkodeguru .= cari_nama_pegawai($dma['kodeguru']);
		}
		else
		{
		$rekapkodeguru .= ', '.cari_nama_pegawai($dma['kodeguru']);
		}

	}
if(!empty($rekapkodeguru))
{
	echo '<div class="alert alert-warning">Daftar Guru Belum mengirim penilaian sikap spiritual dan sosial antarmapel';
	echo $rekapkodeguru.'</div>';
}
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td width="50"><strong>NIS</strong></td><td ><strong>Nama</strong></td><td><strong>Kedisiplinan</strong></td><td><strong>Kebersihan</strong></td><td><strong>Kesehatan</strong></td><td><strong>Tanggung jawab</strong></td><td><strong>Sopan santun</strong></td><td><strong>Percaya diri</strong></td><td><strong>Kompetitif</strong></td><td><strong>Hubungan Sosial</strong></td><td><strong>Kejujuran</strong></td><td><strong>Ibadah ritual</strong></td></tr>
<?php
//jmlguru
$daftarsiswa = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
$nomor=1;
foreach($daftarsiswa->result() as $b)
{
		$nis = $b->nis;
		$namasiswa = nis_ke_nama($nis);
		$tnilaiakhlak = $this->db->query("select * from nilai_akhlak where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		$adanilai = $tnilaiakhlak->num_rows();
		$j1a=0;
		$j1b=0;
		$j1c=0;
		$j2a=0;
		$j2b=0;
		$j2c=0;
		$j3a=0;
		$j3b=0;
		$j3c=0;
		$j4a=0;
		$j4b=0;
		$j4c=0;
		$j5a=0;
		$j5b=0;
		$j5c=0;
		$j6a=0;
		$j6b=0;
		$j6c=0;
		$j7a=0;
		$j7b=0;
		$j7c=0;
		$j8a=0;
		$j8b=0;
		$j8c=0;
		$j9a=0;
		$j9b=0;
		$j9c=0;
		$j10a=0;
		$j10b=0;
		$j10c=0;
		foreach($tnilaiakhlak->result() as $d)
		{
			if($d->satu == '4')
				{
				$j1a++;
				}
			elseif($d->satu== '3')
				{
				$j1b++;
				}
			else if ($d->satu== '2')
				{
				$j1c++;
				}
			else
				{
				$j1c++;
				}
			if($d->dua == '4')
				{
				$j2a++;
				}
			elseif($d->dua== '3')
				{
				$j2b++;
				}
			else if ($d->dua== '2')
				{
				$j2c++;
				}
			else
				{
				$j2c++;
				}
			if($d->tiga == '4')
				{
				$j3a++;
				}
			elseif($d->tiga== '3')
				{
				$j3b++;
				}
			else if ($d->tiga== '2')
				{
				$j3c++;
				}
			else
				{
				$j3c++;
				}
			if($d->empat == '4')
				{
				$j4a++;
				}
			elseif($d->empat== '3')
				{
				$j4b++;
				}
			else if ($d->empat== '2')
				{
				$j4c++;
				}
			else
				{
				$j4c++;
				}
			if($d->lima == '4')
				{
				$j5a++;
				}
			elseif($d->lima== '3')
				{
				$j5b++;
				}
			else if ($d->lima== '2')
				{
				$j5c++;
				}
			else
				{
				$j5c++;
				}
			if($d->enam == '4')
				{
				$j6a++;
				}
			elseif($d->enam== '3')
				{
				$j6b++;
				}
			else if ($d->enam== '2')
				{
				$j6c++;
				}
			else
				{
				$j6c++;
				}
			if($d->tujuh == '4')
				{
				$j7a++;
				}
			elseif($d->tujuh== '3')
				{
				$j7b++;
				}
			else if ($d->tujuh== '2')
				{
				$j7c++;
				}
			else
				{
				$j7c++;
				}
			if($d->delapan == '4')
				{
				$j8a++;
				}
			elseif($d->delapan== '3')
				{
				$j8b++;
				}
			else if ($d->delapan== '2')
				{
				$j8c++;
				}
			else
				{
				$j8c++;
				}
			if($d->sembilan == '4')
				{
				$j9a++;
				}
			elseif($d->sembilan== '3')
				{
				$j9b++;
				}
			else if ($d->sembilan== '2')
				{
				$j9c++;
				}
			else
				{
				$j9c++;
				}
			if($d->sepuluh == '4')
				{
				$j10a++;
				}
			elseif($d->sepuluh== '3')
				{
				$j10b++;
				}
			else if ($d->sepuluh== '2')
				{
				$j10c++;
				}
			else
				{
				$j10c++;
				}

		}
		$j1 = max($j1a,$j1b,$j1c);
		$j2 = max($j2a,$j2b,$j2c);
		$j3 = max($j3a,$j3b,$j3c);
		$j4 = max($j4a,$j4b,$j4c);
		$j5 = max($j5a,$j5b,$j5c);
		$j6 = max($j6a,$j6b,$j6c);
		$j7 = max($j7a,$j7b,$j7c);
		$j8 = max($j8a,$j8b,$j8c);
		$j9 = max($j9a,$j9b,$j9c);
		$j10 = max($j10a,$j10b,$j10c);
		if ($j1 == $j1a)
			{
			$satu = predikat_akhlak(4);
			}
		elseif ($j1 == $j1b)
			{
			$satu = predikat_akhlak(3);
			}
		else
			{
			$satu = predikat_akhlak(2);
			}
		if ($j2 == $j2a)
			{
			$dua = predikat_akhlak(4);
			}
		elseif ($j2 == $j2b)
			{
			$dua = predikat_akhlak(3);
			}
		else
			{
			$dua = predikat_akhlak(2);
			}
		if ($j3 == $j3a)
			{
			$tiga = predikat_akhlak(4);
			}
		elseif ($j3 == $j3b)
			{
			$tiga = predikat_akhlak(3);
			}
		else
			{
			$tiga = predikat_akhlak(2);
			}
		if ($j4 == $j4a)
			{
			$empat = predikat_akhlak(4);
			}
		elseif ($j4 == $j4b)
			{
			$empat = predikat_akhlak(3);
			}
		else
			{
			$empat = predikat_akhlak(2);
			}
		if ($j5 == $j5a)
			{
			$lima = predikat_akhlak(4);
			}
		elseif ($j5 == $j5b)
			{
			$lima = predikat_akhlak(3);
			}
		else
			{
			$lima = predikat_akhlak(2);
			}
		if ($j6 == $j6a)
			{
			$enam = predikat_akhlak(4);
			}
		elseif ($j6 == $j6b)
			{
			$enam = predikat_akhlak(3);
			}
		else
			{
			$enam = predikat_akhlak(2);
			}
		if ($j8 == $j8a)
			{
			$tujuh = predikat_akhlak(4);
			}
		elseif ($j8 == $j8b)
			{
			$tujuh = predikat_akhlak(3);
			}
		else
			{
			$tujuh = predikat_akhlak(2);
			}
		if ($j8 == $j8a)
			{
			$delapan = predikat_akhlak(4);
			}
		elseif ($j8 == $j8b)
			{
			$delapan = predikat_akhlak(3);
			}
		else
			{
			$delapan = predikat_akhlak(2);
			}
		if ($j9 == $j9a)
			{
			$sembilan = predikat_akhlak(4);
			}
		elseif ($j9 == $j9b)
			{
			$sembilan = predikat_akhlak(3);
			}
		else
			{
			$sembilan = predikat_akhlak(2);
			}
		if ($j10 == $j10a)
			{
			$sepuluh = predikat_akhlak(4);
			}
		elseif ($j10 == $j10b)
			{
			$sepuluh = predikat_akhlak(3);
			}
		else
			{
			$sepuluh = predikat_akhlak(2);
			}
		if($adanilai == 0)
			{
			$satu = predikat_akhlak(1);
			$dua = predikat_akhlak(1);
			$tiga = predikat_akhlak(1);
			$empat = predikat_akhlak(1);
			$lima = predikat_akhlak(1);
			$enam = predikat_akhlak(1);
			$tujuh = predikat_akhlak(1);
			$delapan = predikat_akhlak(1);
			$sembilan = predikat_akhlak(1);
			$sepuluh = predikat_akhlak(1);
			}
		$ta = $this->db->query("select * from `kepribadian` where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		if(count($ta->result())==0)
			{
			$this->db->query("insert into `kepribadian`  (`satu`,`dua`, `tiga`,`empat`, `lima`, `enam`, `tujuh`, `delapan`, `sembilan`, `sepuluh`, `thnajaran`, `semester`, `nis`,`kelas`) values ('$satu', '$dua', '$tiga', '$empat', '$lima', '$enam', '$tujuh', '$delapan', '$sembilan', '$sepuluh', '$thnajaran', '$semester', '$nis', '$kelas')");
			}
			else
			{
			$this->db->query("update kepribadian set satu = '$satu', dua = '$dua', tiga = '$tiga', empat = '$empat', lima = '$lima', enam = '$enam', tujuh = '$tujuh', delapan = '$delapan', sembilan = '$sembilan', sepuluh = '$sepuluh' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and `status`=''");
			}
echo "<tr><td>".$nomor."</td><td>".$nis."</td><td width=\"50\">".$namasiswa."</td><td align=\"center\">".$satu."</td><td align=\"center\">".$dua."</td><td align=\"center\">".$tiga."</td><td align=\"center\">".$empat."</td><td align=\"center\">".$lima."</td><td align=\"center\">".$enam."</td><td align=\"center\">".$tujuh."</td><td align=\"center\">".$delapan."</td><td align=\"center\">".$sembilan."</td><td align=\"center\">".$sepuluh."</td></tr>";

$nomor++;
}
?>
</table>
</div>
