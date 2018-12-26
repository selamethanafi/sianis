<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_akhlak.php
// Terakhir diperbarui	: Kam 12 Mei 2016 07:34:41 WIB 
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
?>
<?php
if($kurikulum == '2013')
{
	echo '<div class="container-fluid"><h2>Modul Penilaian Sikap Spiritual dan Sosial</h2>';
}
elseif($kurikulum == '2015')
{
	echo '<div class="container-fluid"><h2>Modul Penilaian Sikap Spiritual dan Sosial</h2>';
}
else
{
	echo '<div class="container-fluid"><h2>Modul Nilai Kepribadian dan Akhlak Mulia</h2>';
}
$tc = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
$adatc = $tc->num_rows();
if($adatc == 0)
{
	echo '<div class="alert alert-danger">Galat, data guru tidak sesuai</div>';
}
else
{
	$te = $this->db->query("select * from `nilai_akhlak` where `kelas`='$kelas' and `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	$adate = $te->num_rows();

	?>
	<a href="<?php echo base_url(); ?>guru/nilaiakhlak/" class="btn btn-info" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a>
<div class="table-responsive">
<table class="table">
	<tr><td width="40%"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
	<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Kurikulum</strong></td><td>: <strong><?php echo $kurikulum;?></strong></td></tr>
</table></div>
<div class="alert alert-info">
4 = Amat Baik / Selalu, 3 = Baik / Sering, 2 = Cukup / Kadang- kadang, 1 = Kurang / Jarang / tidak pernah, klik nomor urut siswa untuk mengubah nilai, atau kolom bertanda G untuk mengubah nilai tiap kolom.<br />
Keterangan untuk kolom T dan G<br />
Baris 1 menyatakan cacah teman atau guru yang menilai 1<br />
Baris 2 menyatakan cacah teman atau guru yang menilai 2<br />
Baris 3 menyatakan cacah teman atau guru yang menilai 3<br />
Baris 4 menyatakan cacah teman atau guru yang menilai 4<br />
Baris 5 menyatakan modus penilaian diri<br />
</div>
<?php
$adaitem = 0;

if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester))) 
{
$tf = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `kodeguru`='$kodeguru'");
$status = '';
foreach($tf->result() as $f)
{
	$status = $f->status;
}
$tf = $this->db->query("select * from `m_akhlak` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$cacahsemuaguru = $tf->num_rows();
$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by id_sikap_spiritual");
if(count($tb->result())>0)
	{
	$adaitem = 1;
	$itemke = 1;
	foreach($tb->result() as $b)
		{
		$des[$itemke] = $b->item;
		$itemke++;
		}
	}
		echo '<div class="alert alert-info">Jika nomor urut siswa tidak muncul, silakan perbarui daftar siswa.</div>';
echo form_open('guru/perbaruidaftarsiswaakhlak');
	if($adate>0)
	{
		echo '<div class="table-responsive">
<table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td ><strong>Nama</strong></td>';
		if ($kurikulum == '')
		{
			echo '<td colspan="4"><strong>Kedisiplinan</strong></td><td colspan="4"><strong>Kebersihan</strong></td><td colspan="4"><strong>Kesehatan</strong></td><td colspan="4"><strong>Tanggung jawab</strong></td><td colspan="4"><strong>Sopan santun</strong></td><td colspan="4"><strong>Percaya diri</strong></td><td colspan="4"><strong>Kompetitif</strong></td><td colspan="4"><strong>Hubungan Sosial</strong></td><td colspan="4"><strong>Kejujuran</strong></td><td colspan="4"><strong>Ibadah ritual</strong></td></tr>';
			$cacahkolom = 11;
		}
		elseif($kurikulum == 'KTSP')
		{
			echo '<td colspan="4"><strong>Kedisiplinan</strong></td><td colspan="4"><strong>Kebersihan</strong></td><td colspan="4"><strong>Kesehatan</strong></td><td colspan="4"><strong>Tanggung jawab</strong></td><td colspan="4"><strong>Sopan santun</strong></td><td colspan="4"><strong>Percaya diri</strong></td><td colspan="4"><strong>Kompetitif</strong></td><td colspan="4"><strong>Hubungan Sosial</strong></td><td colspan="4"><strong>Kejujuran</strong></td><td colspan="4"><strong>Ibadah ritual</strong></td></tr>';
		$cacahkolom = 11;
		}
		else
		{
			$itemke = 1;
			foreach($tb->result() as $b)
				{
				echo '<td colspan="4"><strong>'.$b->item.'</strong></td>';
				$itemke++;
				}		
			echo '</tr>';
			$cacahkolom = $itemke;
		}
		$nomor=1;

		$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
		$cacahsemuasiswa = $query->num_rows()-1;
		if(count($query->result())>0)
		{
			echo '<tr><td align="center" colspan="2">Penilaian Diri (D), Teman (T), Guru - guru(G), Nilai Akhir (A)</td>';
			$kolom = 1;
			do
			{
				echo '<td align="center" width="15">D</td><td align="center" width="15">T</td><td align="center" width="15"><a href="'.base_url().'guru/ubahnilaiakhlakkolom/'.$id_mapel.'/'.$kolom.'">G</a></td><td align="center" width="15">A</td>';
				$kolom++;
			}
		while ($kolom<$cacahkolom);
		echo '</tr>';
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$td = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`='$nis'");
			$tt = $this->db->query("select * from `siswa_penilaian_diri` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `penilai`!='$nis'");
			$cacahsiswa = $tt->num_rows();
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
				echo '<td align="center"><a href="'.base_url().'guru/ubahnilaiakhlak/'.$id_mapel.'/'.$id_nilai_akhlak.'" class="btn btn-primary">'.$nomor.'</a></td><td>'.nis_ke_nama($nis).'</td>';
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
				echo '<td align="center"  valign="bottom">'.$itemjumlah1.'<br />'.$itemjumlah2.'<br />'.$itemjumlah3.'<br />'.$itemjumlah4.'<br /><strong>'.$simpulan.'</strong></td>';
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
				echo '<td align="center">'.$itemjumlahguru1.'<br />'.$itemjumlahguru2.'<br />'.$itemjumlahguru3.'<br />'.$itemjumlahguru4.'<br /><strong>'.$simpulanguru.'</strong></td>';
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
		
		if($kirim == 'kirim')
		{
		$this->db->query("update `siswa_penilaian_diri_rekap` set `$iteme`= '$simpulansistem' where thnajaran='$thnajaran' and semester='$semester' and nis='$nis'");
		}
		$noitem++;
	}
	while($noitem<$cacahkolom);
	echo '</tr>';
	$nomor++;
	}
	$cacahekolom = $cacahkolom-1; 
	echo '<tr><td colspan="2">Cacah Guru</td><td colspan="'.$cacahekolom.'">'.$cacahsemuaguru.'</td></tr>';
	echo '<tr><td colspan="2">Cacah Guru Sudah Menilai</td><td colspan="'.$cacahekolom.'">'.$cacahguru.'</td></tr>';
	$persentasecacahguru = '0%';
	if($cacahsemuaguru>0)
		{
			$persentasecacahguru = round($cacahguru/$cacahsemuaguru*100,0).'%';
		}
	echo '<tr><td colspan="2">Persentase Guru Sudah Menilai</td><td colspan="'.$cacahekolom.'">'.$persentasecacahguru.'</td></tr>';
	echo '<tr><td colspan="2">Cacah Siswa</td><td colspan="'.$cacahekolom.'">'.$cacahsemuasiswa.'</td></tr>';
	echo '<tr><td colspan="2">Cacah Siswa Sudah Menilai</td><td colspan="'.$cacahekolom.'">'.$cacahsiswa.'</td></tr>';
	$persentasecacahsiswa = '0%';
	if($cacahsemuasiswa>0)
		{
			$persentasecacahsiswa = round($cacahsiswa/$cacahsemuasiswa*100,0).'%';
		}
	echo '<tr><td colspan="2">Persentase Siswa Sudah Menilai</td><td colspan="'.$cacahekolom.'">'.$persentasecacahsiswa.'</td></tr>';

} // kalau ada siswa
		if($kirim == 'kirim')
		{
		$this->db->query("update m_akhlak set status='Y' where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and kodeguru='$kodeguru'");
		$status = 'Y';
		}

?>
</table></div>
<?php
}
?>
<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>"><p></p>
<p class="text-center">
<?php
if($adate>0)
{
	if($status == 'Y')
	{?>
		<a href="<?php echo base_url(); ?>guru/daftarnilaiakhlak/<?php echo $id_mapel;?>/kirimulang" class="btn btn-info" role="button"><strong><span class="glyphicon glyphicon-export"></span> Kirim Ulang ke Rapor</strong></a>
	<?php
	}else
	{?>
		 <a href="<?php echo base_url(); ?>guru/daftarnilaiakhlak/<?php echo $id_mapel;?>/kirim" class="btn btn-info" role="button"><strong><span class="glyphicon glyphicon-export"></span> Kirim ke Rapor</strong></a>
	<?php
	}

?>
<a href="<?php echo base_url(); ?>guru/formmencetak" class="btn btn-info" role="button"><span class="glyphicon glyphicon-print"></span> <b> Daftar Nilai</b></a>
<?php
}
?>
<button type="submit" class="btn btn-primary">Perbarui Daftar Siswa</button></p>
</form>

<?php
}
}
?>
</div>
