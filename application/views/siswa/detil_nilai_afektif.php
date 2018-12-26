<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: detil_nilai_afektif.php
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
foreach($query->result() as $t)
{
	$thnajaran = $t->thnajaran;
	$mapel = $t->mapel;
	$semester = $t->semester;
	$kelas = $t->kelas;
?>
<p><a href="<?php echo base_url(); ?>siswa/afektif/<?php echo substr($thnajaran,0,4);?>/<?php echo $semester;?>" class="btn btn-primary"><b>Kembali</b></a></p>

<form class="form-horizontal" role="form">
<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9" ><p class="form-control-static"><strong><?php echo $thnajaran;?></strong></div></div>
<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9" ><p class="form-control-static"><strong><?php echo $semester;?></strong></div></div>
<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9" ><p class="form-control-static"><strong><?php echo $kelas;?></strong></div></div>
<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9" ><p class="form-control-static"><strong><?php echo $mapel;?></strong></div></div>
</form>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr bgcolor="#FFF" align="center"><td><strong>No.</strong></td><td><strong>Aspek Penilaian</strong></td><td><strong>Nilai</strong></td>
</td></tr>
<?php
$tap = $this->db->query("select * from aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
$np = 0;
$k = 0;
$c = 0;
$b= 0;
$ab = 0;
foreach($tap->result() as $dap)
{
	$np = $dap->np;
	$nomor = 0;
	$ratarata=0;
	do
	{
		$item = $nomor+1;	
		$iteme = "p$item";
		$dapitem[$item]= $dap->$iteme;
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
			$nomor++;
		}
		while ($nomor<$np);
		$predikat = max($k,$c,$b,$ab);
	}

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

$nomor = 0;
	do
	{
	$item = $nomor+1;
	$iteme = "p$item";
	echo '
	<tr><td align="center">'.$item.'</td><td>'.$dapitem[$item].'</td><td align="center">'.$t->$iteme.'</td></tr>';
	$nomor++;
	}
	while ($nomor<$np);
	if (($nilai_sikap =='A') or ($predikat=='B'))
	{
		$tuntas = 'Ya';
	}
	else
	{
		$tuntas = 'Belum';
	}
echo '<tr align="center"><td><strong></strong></td><td><strong>Modus Nilai Sikap</strong></td><td><strong>'.$nilai_sikap.'</strong></td></tr>';
echo '<tr align="center"><td><strong></strong></td><td><strong>Predikat</strong></td><td><strong>'.predikat_sikap($nilai_sikap).'</strong></td></tr>';

echo '<tr align="center"><td><strong></strong></td><td><strong>Ketuntasan / Kelulusan </strong></td><td><strong>'.$tuntas.'</strong></td></tr>';
	
}

?>
</table></div>
</div></div></div>

