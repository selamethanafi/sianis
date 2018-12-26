<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 06 Jan 2016 11:49:06 WIB  
// Nama Berkas 		: analisis.php
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
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun</strong></td><td><strong>Semester</strong></td><td><strong>Mapel</strong></td><td><strong>Ulangan</strong></td><td><strong>Nilai</strong></td><td><strong>Tuntas</strong></td><td ><strong>Rinci</strong></td></tr>
<?php
$nomor=$page+1;
if(count($query->result())>0){
foreach($query->result() as $t)
{
	$thnajaran = $t->thnajaran;
	$semester = $t->semester;
	$mapel = $t->mapel;
	$kelas = $t->kelas;
	$ulangan = $t->ulangan;
	$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and kelas='$kelas' and semester='$semester' and mapel='$mapel'");
	$kkm = 70;
	$nsoal = 0;
	foreach($tmapel->result() as $dtmapel)
			{
				$kelas = $dtmapel->kelas;
				$mapel = $dtmapel->mapel;
				$thnajaran = $dtmapel->thnajaran;
				$semester = $dtmapel->semester;
				$kkm = $dtmapel->kkm;
				if ($ulangan=='uh1')
					{
					$kkm_ulangan = $dtmapel->kkm_uh1;
					$nsoal = $dtmapel->nsoal_uh1;
					$skor = $dtmapel->skor_uh1;
					}
				if ($ulangan=='uh3')
					{
					$kkm_ulangan = $dtmapel->kkm_uh3;
					$nsoal = $dtmapel->nsoal_uh3;
					$skor = $dtmapel->skor_uh3;
					}
				if ($ulangan=='uh4')
					{
					$kkm_ulangan = $dtmapel->kkm_uh4;
					$nsoal = $dtmapel->nsoal_uh4;
					$skor = $dtmapel->skor_uh4;
					}
				if ($ulangan=='uh2')
					{
					$kkm_ulangan = $dtmapel->kkm_uh2;
					$nsoal = $dtmapel->nsoal_uh2;
					$skor = $dtmapel->skor_uh2;
					}
				if ($ulangan=='mid')
					{
					$kkm_ulangan = $dtmapel->kkm_mid;
					$nsoal = $dtmapel->nsoal_mid;
					$skor = $dtmapel->skor_mid;
					}
				if ($ulangan=='uas')
					{
					$kkm_ulangan = $dtmapel->kkm_uas;
					$nsoal = $dtmapel->nsoal_uas;
					$skor = $dtmapel->skor_uas;
					}
		}
	if($kkm_ulangan==0)
		{
		$kkm_ulangan = $kkm;
		}
	$kolom = 0;
	$nilaipersiswa= 0;
	$skormaks = $skor*$nsoal;
	do
	{	
	$nilaine=0;
	$nokol = $kolom + 1;
	$item = 'nilai_s'.$nokol.'';
	$nilaine = $t->$item;
	$nilaipersiswa= $nilaipersiswa + $nilaine;
	$kolom++;
	}
	while ($kolom<$nsoal);
	$skoruraian = $t->uraian_1 + $t->uraian_2 + $t->uraian_3 + $t->uraian_4 + $t->uraian_5 + $t->uraian_6 + $t->uraian_7 + $t->uraian_8 + $t->uraian_9 + $t->uraian_10;
	$nilaiulangan = $nilaipersiswa + $skoruraian; 
	if ($nilaiulangan < $kkm_ulangan)
		{
		$tuntas = "Belum";
		}
		else
		{
		$tuntas = "Ya";
		}


echo "<tr><td align='center'>".$nomor."</td><td align=\"center\">".$thnajaran."</td><td align=\"center\">".$semester."</td><td>".$mapel."</td><td align=\"center\">".$ulangan."</td><td align=\"center\">".$nilaiulangan."</td><td align=\"center\">".$tuntas."</td>";
echo '<td align="center"><a href="'.base_url().'siswa/analisis/detil/'.$t->id_analisis.'"><span class="fa fa-bullseye"></span></a></td></tr>';
$nomor++;	
}
}
else{
echo "<tr><td colspan='5'>Belum Ada Nilai</td></tr>";
}
?>
</table></div>
<?php
if(!empty($paginator))
	{
	echo '<h5>'.$paginator.'</h5>';
	}
?>
</div></div></div>
