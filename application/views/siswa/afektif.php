<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 06 Jan 2016 11:47:19 WIB 
// Nama Berkas 		: afektif.php
// Lokasi      		: application/views/siswa/
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php

echo '<p>';
$kelas = '';
$predikat = '';
$tb = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester'");
foreach($tb->result() as $b)
{
	$kelas = $b->kelas;
}
$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC");
foreach($ta->result() as $a)
{
	if(($thnajaran == $a->thnajaran) and ($semester == $a->semester) and ($kelas == $a->kelas))
	{
		echo ' <a href="'.base_url().'siswa/afektif/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-info">'.$a->kelas.' smt '.$a->semester.'</a>';
	}
	else
	{
		echo ' <a href="'.base_url().'siswa/afektif/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-primary">'.$a->kelas.' smt '.$a->semester.'</a>';

	}
}
echo '</p>';
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
echo '<h3>Kurikulum '.$kurikulum.'</h3>';
if($kurikulum == '2015')
{
}
else
{
$query = $this->db->query("select * from `afektif` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `mapel`");
if(count($query->result())>0){
echo '<table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>Nilai</strong></td><td><strong>Predikat</strong></td><td><strong>Ketuntasan</strong></td><td><strong>Lihat Nilai</strong></td></tr>';
$nomor=1;
foreach($query->result() as $t)
{
//cari cacah item penilai
	$mapel = $t->mapel;
	$thnajaran = $t->thnajaran;
	$semester = $t->semester;
	$kelas = $t->kelas;
	$taspek = $this->db->query("select * from aspek_afektif where mapel = '$mapel' and thnajaran = '$thnajaran' and semester = '$semester' and kelas = '$kelas'");
	$cacahitem = 0;
	$dasnmax = '';
	$dasnamat='';
	$dasnbaik='';
	$nilai_sikap = '';
	foreach($taspek->result() as $das)
		{
		$cacahitem = $das->np;
		$dasnmax = $das->nmax;
		$dasnamat= $das->namat;
		$dasnbaik= $das->nbaik;

		}
	
	if ($cacahitem>0)
		{
			$b = 0;
			$ab = 0;
			$k = 0;
			$c = 0;
			$nomore = 1;
			do
			{
				$iteme = "p$nomore";
				if($t->$iteme == 4)
				{
					$ab++;
				}
				elseif($t->$iteme == 3)
				{
					$b++;
				}
				elseif($t->$iteme == 2)
				{
					$c++;
				}
				else
				{
					$k++;
				}
				$nomore++;
			}
			while ($nomore<=$cacahitem);
			$predikat = max($k,$c,$b,$ab);
			if($predikat == $ab)
			{
				$nilai_sikap = 'A';
			}
			elseif($predikat == $b)
			{
				$nilai_sikap = 'B';
			}
			elseif($predikat == 'C')
			{
				$nilai_sikap = 'C';
			}
			else
			{
				$nilai_sikap = 'K';
			}
		}
		if (($nilai_sikap =='A') or ($predikat=='B'))
		{
			$tuntas = 'Ya';
		}
		else
		{
			$tuntas = 'Belum';
		}
		$tkkm = $this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
		$ranah = '';	
		foreach($tkkm->result() as $dkkm)
		{
			$ranah = $dkkm->ranah;
		}
		if(($ranah == 'KPA') or ($ranah == 'PA') or ($ranah == 'KA'))
		{
			echo "<tr><td align='center'>".$nomor."</td><td>".$t->mapel."</td><td align=\"center\">".$nilai_sikap."</td><td align=\"center\">".predikat_sikap($nilai_sikap)."</td><td align=\"center\">".$tuntas."</td><td align=\"center\">";
echo '<a href="'.base_url().'siswa/detilafektif/'.$t->id_afektif.'" title="Lihat Rincian Nilai Afektif"><span class="fa fa-bullseye"></span></a></td></tr>';
			$nomor++;	
		}
}
	echo '</table>';
}
else{
echo '<div class="alert alert-warning">Belum Ada Nilai</div>';
}
}
?>
</div></div></div>
