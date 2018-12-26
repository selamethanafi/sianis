<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 06 Jan 2016 11:45:39 WIB 
// Nama Berkas 		: psikomotor.php
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
$tanggal = tanggal_hari_ini();
$bulan = bulansaja($tanggal);
 echo '<p>';
$kelas = '';
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
		echo ' <a href="'.base_url().'siswa/psikomotor/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-info">'.$a->kelas.' smt '.$a->semester.'</a>';
	}
	else
	{
		echo ' <a href="'.base_url().'siswa/psikomotor/'.substr($a->thnajaran,0,4).'/'.$a->semester.'" class="btn btn-primary">'.$a->kelas.' smt '.$a->semester.'</a>';

	}
}
echo '</p>';
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
echo '<h3>Kurikulum '.$kurikulum.'</h3>';
$query = $this->db->query("select * from `nilai` where `nis`='$nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' order by `mapel`");

if(count($query->result())>0)
{
	$nomor=1;
	echo '<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>1</strong></td><td><strong>2</strong></td><td><strong>3</strong></td><td><strong>4</strong></td><td><strong>5</strong></td><td><strong>Nilai</strong></td><td><strong>Ketuntasan</strong></td><td><strong>Lihat Nilai</strong></td></tr>';
	foreach($query->result() as $t)
	{
//cari cacah item penilai
	$mapel = $t->mapel;	$thnajaran = $t->thnajaran; 	$semester = $t->semester;	$kelas = $t->kelas;
	$taspek = $this->db->query("select * from aspek_psikomotorik where mapel = '$mapel' and thnajaran = '$thnajaran' and semester = '$semester' and kelas = '$kelas'");
	$cacahitem = 0;
	foreach($taspek->result() as $das)
		{
		$cacahitem = $das->np;
		}
	$tkkm = $this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
	$kkm = 0;
	$ranah = '';
	foreach($tkkm->result() as $dkkm)
		{
		$kkm = $dkkm->kkm;
		$ranah = $dkkm->ranah;
		}


	
	if ($cacahitem>0)
		{
		$nilai = round(($t->p1+$t->p2+$t->p3+$t->p4+$t->p5+$t->p6+$t->p7+$t->p8+$t->p9+$t->p10+$t->p11+$t->p12+$t->p13+$t->p14+$t->p15+$t->p16+$t->p17+$t->p18)/$cacahitem,2);
		$np = $t->psi;
		if($np>0)
		{
			$nilai = $np; 
		}
			if ($kkm>0)
			{
				if ($nilai<$kkm)
				{
				$tuntas = '<p class="text-center text-danger">Belum</p>';
				}
				else
				{
				$tuntas = '<p class="text-center text-success">Ya</p>';
				}
			}

		}
		else
		{$nilai ='?';
		$tuntas = "?";
		}
		if(($ranah == 'KPA') or ($ranah == 'PA') or ($ranah == 'KP'))
		{
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$t->mapel.'</td><td align="center">'.$t->p1.'</td><td align="center">'.$t->p2.'</td><td align="center">'.$t->p3.'</td><td align="center">'.$t->p4.'</td><td align="center">'.$t->p5.'</td><td align="center">'.$nilai.'</td><td align="center">'.$tuntas.'</td><td align="center">';
echo '<a href="'.base_url().'siswa/detilpsikomotor/'.$t->kd.'" title="Lihat Rincian Nilai Psikomotor"><span class="fa fa-bullseye"></span></a></td></tr>';
$nomor++;	
		}
	}
	echo '</table>';
}
else{
echo '<div class="alert alert-warning">Belum Ada Nilai</div>';
}
?>
</div></div></div>
