<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mencetak_akhlak.php
// Lokasi      		: application/views/guru/
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
$lebartabel=670;
if($kurikulum == '2013')
{
$lebartabel='100%';
}
echo '<h3><p class="text-center"><a href="'.base_url().'guru/formmencetak">';
if($kurikulum == 'KTSP')
	{echo 'Daftar Nilai Akhlak Mulia dan Kepribadian';}
elseif($kurikulum == '2013')

	{echo 'Daftar Nilai Sikap Spiritual dan Sosial AntarMata Pelajaran';}
elseif($kurikulum == '2015')

	{echo 'Daftar Nilai Sikap Spiritual dan Nilai Sosial';}

else
	{echo 'Daftar Nilai Akhlak Mulia dan Kepribadian / Daftar Nilai Sikap Spiritual dan Sosial AntarMata Pelajaran';}
echo '</a></p></h3>';
?>
<table width="<?php echo $lebartabel;?>" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="350"><strong>Tahun Pelajaran</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
</table>
<?php
if($kurikulum == 'KTSP')
{
?>
<div class="CSSTableGenerator">
<table width="<?php echo $lebartabel;?>">
<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td><td><strong>Kedisiplinan</strong></td><td><strong>Kebersihan</strong></td><td><strong>Kesehatan</strong></td><td><strong>Tanggung jawab</strong></td><td><strong>Sopan santun</strong></td><td><strong>Percaya diri</strong></td><td><strong>Kompetitif</strong></td><td><strong>Hubungan Sosial</strong></td><td><strong>Kejujuran</strong></td><td><strong>Ibadah ritual</strong></td></tr>
<?php
$nomor=1;
$ta = $this->db->query("select * from nilai_akhlak where kodeguru='$kodeguru' and thnajaran='$thnajaran' and kelas='$kelas' and semester='$semester' and status='Y' order by no_urut");
if(count($ta->result())>0)
{
	foreach($ta->result() as $t)
	{
	echo "<tr><td align='center'>".$nomor."</a></td><td>".nis_ke_nama($t->nis)."</td>
<td align='center'>".nilai_akhlak($t->satu).". ".$t->kom1."</td>
<td align='center'>".nilai_akhlak($t->dua).". ".$t->kom2."</td>
<td align='center'>".nilai_akhlak($t->tiga).". ".$t->kom3."</td>
<td align='center'>".nilai_akhlak($t->empat).". ".$t->kom4."</td>
<td align='center'>".nilai_akhlak($t->lima).". ".$t->kom5."</td>
<td align='center'>".nilai_akhlak($t->enam).". ".$t->kom6."</td>
<td align='center'>".nilai_akhlak($t->tujuh).". ".$t->kom7."</td>
<td align='center'>".nilai_akhlak($t->delapan).". ".$t->kom8."</td>
<td align='center'>".nilai_akhlak($t->sembilan).". ".$t->kom9."</td>
<td align='center'>".nilai_akhlak($t->sepuluh).". ".$t->kom10."</td></tr>";
	$nomor++;
	}
}
?>
</table></div>
<?php
}
elseif($kurikulum == '2013')
{

$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
$cacahkolom = $tb->num_rows();
$kolomheader = $cacahkolom + 1;
echo '<div class="CSSTableGenerator">';
echo '<table width="'.$lebartabel.'">
<tr align="center"><td width="30"><strong>No.</strong></td><td colspan="'.$kolomheader.'"><strong>Nama</strong></td>';
if(count($tb->result())>0)
	{
	$adaitem = 1;
	$itemke = 1;
	foreach($tb->result() as $b)
		{
		echo '<td align="center" colspan="4"><strong>'.$b->item.'</strong></td>';
		$itemke++;
		}
	$cacahkolom = $itemke;
	}
echo '</tr>';
$nomor=1;
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
if((count($query->result())>0) and ($cacahkolom>0))
	{
		echo '<tr><td align="center" colspan="2">Penilaian Diri (D), Teman (T), Guru - guru(G), Nilai Akhir (A)</td>';
		$kolom = 1;
		do
		{
			echo '<td align="center" width="15">D</td><td align="center" width="15">T</td><td align="center" width="15">G</td><td align="center" width="15">A</td>';
			$kolom++;
		}
		while ($kolom<$cacahkolom);
		echo '</tr>';
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`='$nis'");
			$tt = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`!='$nis'");
			$tg = $this->db->query("select * from `nilai_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
			$cacahguru = $tg->num_rows();
			echo '<tr>';
			$ta = $this->db->query("select * from `nilai_akhlak` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
			$id_nilai_akhlak = '';
			foreach($ta->result() as $a)
			{
				$id_nilai_akhlak = $a->id_nilai_akhlak;
			}
			if(!empty($id_nilai_akhlak))
			{
				echo '<td align="center">'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
			}
			else
			{
				echo '<td align="center"></td><td>'.nis_ke_nama($nis).'</td>';
			}
			$noitem = 1;
			do
			{
				//nilai diri
				$iteme = 'i'.$noitem;
				$skor = '';
				foreach($td->result() as $d)
				{
					$skor = $d->$iteme;
				}
				echo '<td align="center" valign="bottom"><strong>'.$skor.'</strong></td>';
				//cari hasil teman
				$itemjumlah1 = 0;
				$itemjumlah2 = 0;
				$itemjumlah3 = 0;
				$itemjumlah4 = 0;
				foreach($tt->result() as $t)
				{
					if($t->$iteme == '1')
					{
						$itemjumlah1++; 			
					}
					if($t->$iteme == '2')
					{
						$itemjumlah2++; 			
					}
					if($t->$iteme == '3')
					{
						$itemjumlah3++; 			
					}
					if($t->$iteme == '4')
					{
						$itemjumlah4++; 			
					}
				}
				$simpulan = '';
				$tertinggi = max($itemjumlah1,$itemjumlah2,$itemjumlah3,$itemjumlah4);
				if($tertinggi == $itemjumlah1)
					{
					$simpulan = 1;
					}
				if($tertinggi == $itemjumlah2)
					{
					$simpulan = 2;
					}
				if($tertinggi == $itemjumlah3)
					{
					$simpulan = 3;
					}
				if($tertinggi == $itemjumlah4)
					{
					$simpulan = 4;
					}
				if($tertinggi == 0)
					{
					$simpulan = '?';
					}
				echo '<td align="center"  valign="bottom">'.$itemjumlah1.''.$itemjumlah2.''.$itemjumlah3.''.$itemjumlah4.'<strong>'.$simpulan.'</strong></td>';
				//guru
				if($noitem == 1)
					{
					$itemeguru = 'satu';
					}
				if($noitem == 2)
					{
					$itemeguru = 'dua';
					}
				if($noitem == 3)
					{
					$itemeguru = 'tiga';
					}
				if($noitem == 4)
					{
					$itemeguru = 'empat';
					}
				if($noitem == 5)
					{
					$itemeguru = 'lima';
					}
				if($noitem == 6)
					{
					$itemeguru = 'enam';
					}
				if($noitem == 7)
					{
					$itemeguru = 'tujuh';
					}
				if($noitem == 8)
					{
					$itemeguru = 'delapan';
					}
				if($noitem == 9)
					{
					$itemeguru = 'sembilan';
					}
				if($noitem == 10)
					{
					$itemeguru = 'sepuluh';
					}
				if($noitem>10)
					{
					$itemeguru = 'sepuluh';
					}
				$itemjumlahguru1 = 0;
				$itemjumlahguru2 = 0;
				$itemjumlahguru3 = 0;
				$itemjumlahguru4 = 0;
				foreach($tg->result() as $g)
				{
					if($g->$itemeguru == '1')
					{
						$itemjumlahguru1++; 			
					}
					if($g->$itemeguru == '2')
					{
						$itemjumlahguru2++; 			
					}
					if($g->$itemeguru == '3')
					{
						$itemjumlahguru3++; 			
					}
					if($g->$itemeguru == '4')
					{
						$itemjumlahguru4++; 			
					}
				}
				$simpulanguru = '';
				$tertinggiguru = max($itemjumlahguru1,$itemjumlahguru2,$itemjumlahguru3,$itemjumlahguru4);
				if($tertinggiguru == $itemjumlahguru1)
				{
					$simpulanguru = 1;
				}
				if($tertinggiguru == $itemjumlahguru2)
				{
					$simpulanguru = 2;
				}
				if($tertinggiguru == $itemjumlahguru3)
				{
					$simpulanguru = 3;
				}
				if($tertinggiguru == $itemjumlahguru4)
				{
					$simpulanguru = 4;
				}
				if($tertinggiguru == 0)
				{
					$simpulanguru = '?';
				}
				echo '<td align="center">'.$itemjumlahguru1.''.$itemjumlahguru2.''.$itemjumlahguru3.''.$itemjumlahguru4.'<strong>'.$simpulanguru.'</strong></td>';
				//simpulan sistem
				$cacah1 = 0;
				$cacah2 = 0;
				$cacah3 = 0;
				$cacah4 = 0;
				$simpulansistem = '';
				if($skor == 1)
					{
					$cacah1++;
					}
				if($simpulan == 1)
					{
					$cacah1++;
					}
				if($simpulanguru == 1)	
					{
					$cacah1++;
					}
				if($skor == 2)
					{
					$cacah2++;
					}
				if($simpulan == 2)
					{
					$cacah2++;
					}
				if($simpulanguru == 2)
					{
					$cacah2++;
					}
				if($skor == 3)
					{
					$cacah3++;
					}
				if($simpulan == 3)
					{
					$cacah3++;
					}
				if($simpulanguru == 3)
					{
					$cacah3++;
					}
				if($skor == 4)
				{
				$cacah4++;
				}
			if($simpulan == 4)
				{
				$cacah4++;
				}
			if($simpulanguru == 4)
				{
				$cacah4++;
				}
			$tertinggisistem = max($cacah1,$cacah2,$cacah3,$cacah4);
			if($tertinggisistem == $cacah1)
				{
				$simpulansistem = 1;
				}

			if($tertinggisistem == $cacah2)
				{
				$simpulansistem = 2;
				}
			if($tertinggisistem == $cacah3)
				{
				$simpulansistem = 3;
				}
			if($tertinggisistem == $cacah4)
				{
				$simpulansistem = 4;
				}
			if($tertinggisistem == 0)
				{
				$simpulansistem = '?';
				}
			echo '<td align="center" valign="bottom"><strong>'.$simpulansistem.'</strong></td>';
			$noitem++;
			}
		while($noitem<$cacahkolom);
		$nomor++;
		}
	} // kalau ada siswa
	else
	{
		echo '<tr><td colspan="2">Tidak ada siswa atau tidak ada indikator</td></tr>';
	}
		echo '</table></div>';
} // akhir k2013
elseif($kurikulum == '2015')
{

$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
$cacahkolom = $tb->num_rows();
echo '<div class="CSSTableGenerator">';
echo '<table width="'.$lebartabel.'"><tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td>';
if($cacahkolom > 0)
	{
	$adaitem = 1;
	$itemke = 1;
	foreach($tb->result() as $b)
		{
		echo '<td align="center"><strong>'.$b->item.'</strong></td>';
		$itemke++;
		}
	$cacahkolom = $itemke;
	}
echo '</tr>';
$nomor=1;
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
if((count($query->result())>0) and ($cacahkolom>0))
	{
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			echo '<tr>';
			$ta = $this->db->query("select * from `nilai_akhlak` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
			$id_nilai_akhlak = '';
			foreach($ta->result() as $a)
			{
				$id_nilai_akhlak = $a->id_nilai_akhlak;
			}
			if(!empty($id_nilai_akhlak))
			{
				echo '<td align="center">'.$nomor.'</td><td>'.nis_ke_nama($nis).'</td>';
			}
			else
			{
				echo '<td align="center"></td><td>'.nis_ke_nama($nis).'</td>';
			}
			$noitem = 1;
			do
			{
				//guru
				if($noitem == 1)
					{
					$itemeguru = 'satu';
					}
				if($noitem == 2)
					{
					$itemeguru = 'dua';
					}
				if($noitem == 3)
					{
					$itemeguru = 'tiga';
					}
				if($noitem == 4)
					{
					$itemeguru = 'empat';
					}
				if($noitem == 5)
					{
					$itemeguru = 'lima';
					}
				if($noitem == 6)
					{
					$itemeguru = 'enam';
					}
				if($noitem == 7)
					{
					$itemeguru = 'tujuh';
					}
				if($noitem == 8)
					{
					$itemeguru = 'delapan';
					}
				if($noitem == 9)
					{
					$itemeguru = 'sembilan';
					}
				if($noitem == 10)
					{
					$itemeguru = 'sepuluh';
					}
				if($noitem== 11)
					{
					$itemeguru = 'i11';
					}
				if($noitem== 12)
					{
					$itemeguru = 'i12';
					}
				if($noitem== 13)
					{
					$itemeguru = 'i13';
					}
				if($noitem== 14)
					{
					$itemeguru = 'i14';
					}
				if($noitem== 15)
					{
					$itemeguru = 'i15';
					}
				if($noitem > 15)
					{
					$itemeguru = 'i15';
					}
					$simpulanguru = '';
				foreach($ta->result() as $g)
				{

					if($g->$itemeguru == '1')
					{
						$simpulanguru = 'Kurang';
					}
					if($g->$itemeguru == '2')
					{
						$simpulanguru = 'Cukup';
					}
					if($g->$itemeguru == '3')
					{
						$simpulanguru = 'Baik';
					}
					if($g->$itemeguru == '4')
					{
						$simpulanguru = 'Sangat Baik';
					}
				}
				echo '<td align="center">'.$simpulanguru.'</td>';
			$noitem++;
			}
		while($noitem<$cacahkolom);
		$nomor++;
		}
	} // kalau ada siswa
	else
	{
		echo '<tr><td colspan="2">Tidak ada siswa atau tidak ada indikator</td></tr>';
	}
		echo '</table></div>';
} // akhir k2013
else
{
	echo 'Kurikulum belum ditentukan';
}
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
<tr><td valign="top" width="330"><table height="135" width="328" background="'.base_url().'images/ttd/'.$ttdkepala.'"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
else
{
echo '<table width="670" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td valign="top" width="330"><table height="135" width="328"><tr><td width="150"></td><td>Mengetahui,<br>Kepala<br><br><br><br>'.$namakepala.'<br>NIP '.$nipkepala.'</td></tr></table></td><td width="70"></td><td><table  height="135" width="240"><tr><td>'.$lokasi.', '.date_to_long_string($tanggalcetak).'<br>Guru Mata Pelajaran<br><br><br><br>'.$namapegawai.'<br>NIP '.$nipguru.'</td></tr></table></td></tr>
</table>';
}
?>



