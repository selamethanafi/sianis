<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: daftar_nilai_ujian.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Kam 12 Mei 2016 12:41:45 WIB 
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
?><div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<a href="<?php echo base_url(); ?>guru/ujian/" class="btn btn-info" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a><p> </p>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<tr><td>Tahun Pelajaran.</td><td><strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td><strong><?php echo $semester;?></strong></td></tr>
<tr><td>Kelas</td><td><strong><?php echo $kelas;?></strong></td></tr>
<tr><td>Mata Pelajaran</td><td><strong><?php echo $mapel;?></strong></td></tr>
<tr><td>Ranah Penilaian</td><td><strong><?php echo $ranah;?></strong></td></tr>
<tr><td>Jurusan</td><td><strong><?php echo kelas_jadi_program($kelas);?></strong></td></tr>
</table></div>
<?php
$bobot_ujian_tertulis = $this->config->item('bobot_ujian_tertulis') / 100;
$bobot_ujian_praktik = $this->config->item('bobot_ujian_praktik') / 100;
$tahun = substr($thnajaran,0,4);
$jurusan = kelas_jadi_program($kelas);
$bisa = 1;
$pembagine = 0;
$ta = $this->db->query("select * from `m_mapel_ijazah` where `thnajaran`='$thnajaran' and `mapel`='$mapel' and `jurusan`='$jurusan'");
if($ta->num_rows() == 0)
{
	$bisa = 0;
}
else
{
	foreach($ta->result() as $a)
	{
		$no_urut = $a->no_urut;
		$pembagine = $a->cacah_semester;
	}
	echo 'Nomor urut mapel di ijazah : '.$no_urut;
	$field = 'r'.$no_urut;
}
if($bisa == 1)
{
	$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
	if(($thnajaran == '2016/2017') or ($thnajaran == '2017/2018'))
	{
		
	}
	else
	{
		echo '<p class="help-block">Silakan klik nilai untuk mengubah, Nilai Akhir = 0.6 rata semester + 0.4 Ujian</p>';
	}

$cacahe = ($cacah -  1) * 5;
$query=$this->db->query("select * from nilai_ujian where thnajaran='$thnajaran' and mapel='$mapel' and ruang='$kelas' order by no_urut limit $cacahe,5");
/*
$cacahe = 0;
$query=$this->db->query("select * from nilai_ujian where thnajaran='$thnajaran' and mapel='$mapel' and ruang='$kelas' order by no_urut");
*/
$adasiswa = $query->num_rows();
$adadata = $tc->num_rows();
if($adadata>0)
{
	if($thnajaran == '2017/2018')
	{
		
		?>
		<div class="table-responsive"><table class="table table-hover table-bordered"><tr align="center"><td><strong>No.</strong></td><td><strong>Nama</strong></td>
		<?php
		$pembagi = 0;
		foreach($tc->result() as $c)
		{
			echo '<td align="center"><strong>'.$c->thnajaran_penilaian.'<br />Semester '.$c->semester.'</strong></td>';
			$pembagi++;
		}
		echo '<td align="center"><strong>Rata rata nilai rapor</strong></td>';
		if ($ranah == 'KPA')
		{echo '<td align="center"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/'.$cacah.'" title="Ubah Nilai Ujian"><strong>Tertulis</strong></a><br />'.$bobot_ujian_tertulis.'</td><td align="center"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/'.$cacah.'" title="Ubah Nilai Ujian Praktik"><strong>Praktik</strong></a><br />'.$bobot_ujian_praktik.'</td>';
		}
		if ($ranah == 'KA')
		{echo '<td align="center"><strong>Rata - rara rapor</strong></td><td align="center"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/'.$cacah.'" title="Ubah Nilai Ujian"><strong>Tertulis</strong></a></td>';
		}
		if ($ranah == 'PA')
		{echo '<td align="center"></td><td align="center"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/'.$cacah.'" title="Ubah Nilai Ujian Praktik"><strong>Praktik</strong></a></td>';
		}
		echo '<td align="center"><strong>Nilai Ujian</strong></td><td align="center"><strong>Nilai Ijazah</strong></td>';
		echo '<tr>';
		$nomor=$cacahe+1;
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$nama = nis_ke_nama($nis);
			echo "<tr><td align='center'>".$nomor."</td><td>".$nama."</td>";
			$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
			$nsem = 0;
			foreach($tc->result() as $c)
			{
				$thnajaranx = $c->thnajaran_penilaian;
				$semesterx = $c->semester;
				$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx' and `status`='Y'");
				foreach($td->result() as $d)
				{
					$nilai = $d->kog;
					$nsem = $nsem + $nilai;
					$id_nilai_siswa = $d->kd;
					$nr = $d->nilai_nr;
					$kunci =$d->kunci;
				}
				$adanilai = $td->num_rows();
				if ($adanilai == 0)
				{
					echo '<td align="center">NULL</td>';
				}
				else
				{
					echo '<td align="center">'.$nilai.'</td>';
				}
			}
			//rata rata nilai rapor
			if($pembagine > 0)
			{
				$nsem = $nsem / $pembagine;
			}
			elseif($pembagi > 0)
			{
				$nsem = $nsem / $pembagi;
			}
			else
			{
				$nsem = $nsem;
			}
			if(($nsem>100) or ($nsem<$kkm))
				{
					$tnsem = '<p class="text-danger">'.$nsem.'</p>';
				}
				else
				{
					$tnsem = '<p class="text-success">'.$nsem.'</p>';
				}

			echo '<td align="center">'.$tnsem.'</td>';
			if ($ranah == 'KPA')
			{
				$nujian = ($bobot_ujian_tertulis * $t->nilai) + ($bobot_ujian_praktik * $t->praktik);
				$bijiujian = $nujian;
				if(($t->nilai>100) or ($t->nilai<$kkm))
				{
					$tnilai = '<p class="text-danger">'.$t->nilai.'</p>';
				}
				else
				{
					$tnilai = '<p class="text-success">'.$t->nilai.'</p>';
				}
				if(($t->praktik>100) or ($t->praktik<$kkm))
				{
					$tpraktik = '<p class="text-danger">'.$t->praktik.'</p>';
				}
				else
				{
					$tpraktik = '<p class="text-success">'.$t->praktik.'</p>';
				}
				if(($nujian>100) or ($nujian<$kkm))
				{
					$nujian = '<p class="text-danger">'.$nujian.'</p>';
				}
				else
				{
					$nujian = '<p class="text-success">'.$nujian.'</p>';
				}
				echo '<td align="center">'.$tnilai.'</td><td align="center">'.$tpraktik.'</td>';
			}
			if ($ranah == 'KA')
			{
				$bijiujian = $t->nilai;
				echo '<td align="center">'.$t->nilai.'</td><td align="center"></td><td align="center">'.$t->nilai.'</td>';
			}
			if ($ranah == 'PA')
			{
				$bijiujian = $t->praktik;
				echo '<td align="center">'.$t->praktik.'</td><td align="center">'.$t->praktik.'</td>';
			}
			if($bijiujian < $kkm)
			{
				echo '<td align="center"><p class="text-danger">'.$bijiujian.'</p></td>';
			}
			else
			{
				echo '<td align="center"><p class="text-success">'.$bijiujian.'</p></td>';
			}
			$te = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaran' and semester='2' and `status`='Y'");
			
			$nijazah = ($nsem + $bijiujian) / 2;
			$nijazah = round($nijazah,0);
			if($nijazah < $kkm)
			{
				echo '<td align="center"><p class="text-danger">'.$nijazah.'</p></td></tr>';
			}
			else
			{
				echo '<td align="center"><p class="text-success">'.$nijazah.'</p></td></tr>';
			}
			if($te->num_rows() == 0)
			{
				if($pembagine > 0)
				{
					$jmlkol = $pembagi + 7;
				}
				elseif($pembagi > 0)
				{
					$jmlkol = $pembagi + 9;
				}
				else
				{
					$jmlkol = 3;
				}
				echo '<tr class="table-danger"><td colspan = "'.$jmlkol.'">Proses rata - rata GAGAL. Belum ada daftar nilai thnajaran '.$thnajaran.' semester 2 '.$nama.'</td></tr>';
			}
			else
			{
				$this->db->query("update `nilai` set `rata_rapor`='$nsem' where `mapel`='$mapel' and `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='2'");
			}
			$nomor++;
		}
		echo '</table></div>';
		if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran))) 
		{
			if(($adasiswa == 0) and ($cacah > 1))
			{
				echo '<p class="text-center"><a href="'.base_url().'guru/lihatnilaiujian/'.$id_mapel.'" class="btn btn-primary">Lihat Daftar Nilai Ujian</a> atau <a href="'.base_url().'guru/daftarnilaiujian/'.$id_mapel.'" class="btn btn-primary">Kembali ke Awal</a></p>';
			}
			else
			{
				$cacah++;
				echo ' ';
				echo form_open('guru/perbaruidaftarsiswaujian');?>
				<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
				<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
				<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
				<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
				<input type="hidden" name="semester" value="<?php echo $semester;?>">
				<p class="text-center"><button type="submit" class="btn btn-primary">Perbarui Daftar Siswa</button> <a href="<?php echo base_url();?>guru/nilaiujian/<?php echo $id_mapel.'/'.$cacah;?>" title="Ubah Nilai Ujian" class="btn btn-warning"><strong>Berikutnya</strong></a>
				</form></p>
				<?php
			}
		}
	}
	elseif($thnajaran == '2016/2017')
	{
		?>
		<div class="table-responsive"><table class="table table-hover table-bordered"><tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Nama</strong></td>
		<?php
		$pembagi = 0;
		foreach($tc->result() as $c)
		{
			echo '<td align="center" colspan="2"><strong>'.$c->thnajaran_penilaian.'<br />Semester '.$c->semester.'</strong></td>';
			$pembagi++;
		}
		if ($ranah == 'KPA')
		{echo '<td align="center" rowspan="2"><strong>Rata - rata rapor</strong></td><td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/1" title="Ubah Nilai Ujian"><strong>Tertulis</strong></a></td><td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/2" title="Ubah Nilai Ujian Praktik"><strong>Praktik</strong></a></td></tr>';
		}
		if ($ranah == 'KA')
		{echo '<td align="center" rowspan="2"><strong>Rata - rara rapor</strong></td><td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/1" title="Ubah Nilai Ujian"><strong>Tertulis</strong></a></td><td align="center"></td></tr>';
		}
		if ($ranah == 'PA')
		{echo '<td align="center" rowspan="2"></td><td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/2" title="Ubah Nilai Ujian Praktik"><strong>Praktik</strong></a></td></tr>';
		}
		echo '<tr>';
		foreach($tc->result() as $c)
		{
			echo '<td align="center"><strong>NR</td><td align="center"><strong>NS</strong></td>';
		}
		echo '</tr>';
		$nomor=1;
		foreach($query->result() as $t)
		{
			$nis = $t->nis;
			$nama = nis_ke_nama($nis);
			echo "<tr><td align='center'>".$nomor."</td><td>".$nama."</td>";
			$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
			$nsem = 0;
			foreach($tc->result() as $c)
			{
				$thnajaranx = $c->thnajaran_penilaian;
				$semesterx = $c->semester;
				$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");
				foreach($td->result() as $d)
				{
					$nilai = $d->kog;
					$nsem = $nsem + $nilai;
					$id_nilai_siswa = $d->kd;
					$nr = $d->nilai_nr;
					$kunci =$d->kunci;
				}
				$adanilai = $td->num_rows();
				if ($adanilai == 0)
				{
					echo '<td align="center">NULL</td><td align="center">NULL</td>';
				}
				else
				{
					echo '<td align="center">'.$nr.'</td><td align="center">';
					if($kunci != 1)
					{
						echo '<a href="'.base_url().'guru/editnilaiakhir/'.$id_mapel.'/'.$id_nilai_siswa.'">'.$nilai.'</a>';
					}
					else
					{
						echo $nilai;
					}
					echo '</td>';
				}
			}
			//rata rata nilai rapor
			if($pembagine > 0)
			{
				$nsem = $nsem / $pembagine;
			}
			elseif($pembagi > 0)
			{
				$nsem = $nsem / $pembagi;
			}
			else
			{
				$nsem = $nsem;
			}
			$ujian = $t->nilai;
			$ns = round($nsem,2);
			if ($ranah == 'KPA')
			{echo "<td align='center'>".$ns."</td><td align='center'>".$t->nilai."</td><td align='center'>".$t->praktik."</td></tr>";
			}
			if ($ranah == 'KA')
			{echo "<td align='center'>".$ns."</td><td align='center'>".$t->nilai."</td><td align='center'></td></tr>";
			}
			if ($ranah == 'PA')
			{echo "<td align='center'></td><td align='center'>".$t->praktik."</td></tr>";
			}
			$this->db->query("update `leger_ijazah` set `$field`='$nsem' where `thnajaran`='$thnajaran' and `nis`='$nis'");
			$nomor++;
		}
		echo '</table></div>';
		if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran))) 
		{
			echo form_open('guru/perbaruidaftarsiswaujian');?><div class="clear padding10"></div>
			<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
			<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
			<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
			<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
			<input type="hidden" name="semester" value="<?php echo $semester;?>">
			<p class="text-center"><button type="submit" class="btn btn-primary">Perbarui Daftar Siswa</button></p>
			</form>
			<?php
		}
	}

	else // tahun sebelum 2016
	{
		?>
		<div class="table-responsive"><table class="table table-hover table-bordered"><tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Nama</strong></td>
<?php
	$pembagi = 0;
	foreach($tc->result() as $c)
		{
		echo '<td align="center" colspan="2"><strong>'.$c->thnajaran_penilaian.'<br />Semester '.$c->semester.'</strong></td>';
		$pembagi++;
		}
	if ($ranah == 'KPA')
		{echo '<td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/1" title="Ubah Nilai Ujian"><strong>Tertulis</strong></a></td><td align="center" rowspan="2"><strong>NS</strong></td><td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/2" title="Ubah Nilai Ujian Praktik"><strong>Praktik</strong></a></td></tr>';
		}
	if ($ranah == 'KA')
		{echo '<td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/1" title="Ubah Nilai Ujian"><strong>Tertulis</strong></a></td><td align="center" rowspan="2"><strong>NS</strong></td><td align="center"></td></tr>';
		}
	if ($ranah == 'PA')
		{echo '<td align="center" rowspan="2"></td><td align="center" rowspan="2"><a href="'.base_url().'guru/nilaiujian/'.$id_mapel.'/2" title="Ubah Nilai Ujian Praktik"><strong>Praktik</strong></a></td></tr>';
		}
	echo '<tr>';
	foreach($tc->result() as $c)
		{
		echo '<td align="center"><strong>NR</td><td align="center"><strong>NS</strong></td>';
		}
	echo '</tr>';

$nomor=1;
	foreach($query->result() as $t)
	{
	$nis = $t->nis;
	$nama = nis_ke_nama($nis);
	echo "<tr><td align='center'>".$nomor."</td><td>".$nama."</td>";
	$tc = $this->db->query("select * from tahun_penilaian where thnajaran='$thnajaran' order by thnajaran_penilaian ASC, semester ASC");
	$nsem = 0;
	foreach($tc->result() as $c)
		{
		$thnajaranx = $c->thnajaran_penilaian;
		$semesterx = $c->semester;
		$td = $this->db->query("select * from nilai where nis='$nis' and mapel='$mapel' and thnajaran = '$thnajaranx' and semester='$semesterx'");

		foreach($td->result() as $d)
					{
					$nilai = $d->kog;
					$nsem = $nsem + $nilai;
					$id_nilai_siswa = $d->kd;
					$nr = $d->nilai_nr;
					}
		$adanilai = $td->num_rows();
		if ($adanilai == 0)
			{
				echo '<td align="center">NULL</td><td align="center">NULL</td>';
			}
			else
			{
				echo '<td align="center">'.$nr.'</td><td align="center"><a href="'.base_url().'guru/editnilaiakhir/'.$id_mapel.'/'.$id_nilai_siswa.'">'.$nilai.'</a></td>';

			}
		}
		//rata rata nilai rapor
		if ($pembagi > 0)
			{
			$nsem = $nsem / $pembagi;
			}
	
//(0.7*$nsemsum) + (0.3*$t->nilai)

		// CEK NILAI versi <2014
/*
		if ($t->nilai<10)
			{
			$ujian = $t->nilai*10;
			}
			else
			{
			$ujian = $t->nilai;
			}
		if ($pembagi == 0)	
			{
			$ns = round(($ujian/10),2);
			}
			else
			{
			$ns = round(((0.7*$nsem) + (0.3*$ujian))/10,2);
			}
*/
		// CEK NILAI versi = 2015
		$ujian = $t->nilai;
		if ($pembagi == 0)	
			{
			$ns = round($ujian,1);
			}
			else
			{
			$ns = round((0.6*$nsem) + (0.4*$ujian),1);
			}

	if ($ranah == 'KPA')
		{echo "<td align='center'>".$t->nilai."</td><td align='center'>".$ns."</td><td align='center'>".$t->praktik."</td></tr>";
		}
	if ($ranah == 'KA')
		{echo "<td align='center'>".$t->nilai."</td><td align='center'>".$ns."</td><td align='center'></td></tr>";
		}
	if ($ranah == 'PA')
		{echo "<td align='center'></td><td align='center'>".$t->praktik."</td></tr>";
		}

	$nomor++;

	}
echo '</table></div>';
	if ((!empty($id_mapel)) and (!empty($kelas)) and (!empty($thnajaran))) 
	{
		echo form_open('guru/perbaruidaftarsiswaujian');?><div class="clear padding10"></div>
		<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
		<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
		<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
		<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
		<input type="hidden" name="semester" value="<?php echo $semester;?>">
		<p class="text-center"><button type="submit" class="btn btn-primary">Perbarui Daftar Siswa</button></p>
		</form>
		<?php
	}
	} // kalau tahun sebelum 2016/2017
}
else{
echo '<div class="alert alert-danger">Pengajaran belum membuat daftar tahun penilaian</div>';
}
} // kalau bisa
else
{
echo '<div class="alert alert-danger">Belum ada data mata pelajaran di ijazah, silakan menghubungi pengajaran.</div>';
}
?>
</div>
