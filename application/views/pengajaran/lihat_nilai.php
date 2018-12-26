<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: lihat_nilai.php
// Lokasi      		: application/views/pengajaran/
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
<?php echo form_open('pengajaran/lihatnilai','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">';
	echo "<option value='".$kelas."'>".$kelas."</option>";
	foreach($daftar_kelas->result() as $l)
	{
	echo "<option value='".$l->ruang."'>".$l->ruang."</option>";
	}
	
	echo '</select></div></div>';
	$ta = $this->db->query("select * from tblkategoritutorial order by nama_kategori");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">
	<select name="mapel" class="form-control">';
	echo "<option value='".$mapel."'>".$mapel."</option>";
	foreach($ta->result() as $a)
	{
	echo "<option value='".$a->nama_kategori."'>".$a->nama_kategori."</option>";
	}
	
	echo '</select></div></div>';
	echo '<p class="text-center"><button type="submit" class="btn btn-info" role="button">Tampilkan</button></p>';
?>
</div></div>
</form>
<?php
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($mapel)))
	{
	$kkm = '';
	$ranah = '';
	$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel`='$mapel'");
	foreach($tb->result() as $b)
		{
		$kkm = $b->kkm;
		$ranah = $b->ranah;
		}
echo 'KKM = '.$kkm.', Ranah = '.$ranah.'';
?>
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>UH1</strong></td><td><strong>UH2</strong></td><td><strong>UH3</strong></td><td><strong>UH4</strong></td><td><strong>RUH</strong></td><td><strong>KU1</strong></td><td><strong>KU2</strong></td><td><strong>KU3</strong></td><td><strong>KU4</strong></td><td><strong>RKU</strong></td><td><strong>TU1</strong></td><td><strong>TU2</strong></td><td><strong>TU3</strong></td><td><strong>TU4</strong></td><td><strong>RTU</strong></td><td><strong>MID</strong></td><td>
<?php
if($semester == 2)
	{
	echo '<strong>UKK</strong>';
	}
	else
	{
	echo '<strong>UAS</strong>';
	}
echo '</td><td><strong>NA</strong></td><td>Ket 1</td><td>Ket 2</td><td>Ket 3</td><td>Ket 4</td><td>Ket 5</td><td>Ket 6</td><td>Ket 7</td><td>Ket 8</td><td>Ket 9</td><td>Ket 10</td></tr>';
	$tb = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester` = '$semester' order by no_urut ");
$nomor=1;
foreach($tb->result() as $b)
{
	$nis = $b->nis;
	$nama = nis_ke_nama($nis);
	$tc = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and mapel='$mapel'");
	echo "<tr><td align=\"center\">".$nomor."</td><td>".$nis." ".$nama."</td>";
	if(count($tc->result())>0)
		{
		foreach($tc->result() as $c)
			{
						echo '<td align="center">'.round($c->nilai_uh1,2).'</td><td align="center">'.round($c->nilai_uh2,2).'</td><td align="center">'.round($c->nilai_uh3,2).'</td><td align="center">'.round($c->nilai_uh4,2).'</td><td align="center">'.round($c->nilai_ruh,2).'</td><td align="center">'.round($c->nilai_ku1,2).'</td><td align="center">'.round($c->nilai_ku2,2).'</td><td align="center">'.round($c->nilai_ku3,2).'</td><td align="center">'.round($c->nilai_ku4,2).'</td><td align="center">'.round($c->nilai_rku,2).'</td><td align="center">'.round($c->nilai_tu1,2).'</td><td align="center">'.round($c->nilai_tu2,2).'</td><td align="center">'.round($c->nilai_tu3,2).'</td><td align="center">'.round($c->nilai_tu4,2).'</td><td align="center">'.round($c->nilai_rtu,2).'</td><td align="center">'.round($c->nilai_mid,2).'</td><td align="center">'.round($c->nilai_uas,2).'</td><td align="center">'.round($c->nilai_na,2).'</td><td>'.$c->p1.'</td><td>'.$c->p2.'</td><td>'.$c->p3.'</td><td>'.$c->p4.'</td><td>'.$c->p5.'</td><td>'.$c->p6.'</td><td>'.$c->p7.'</td><td>'.$c->p8.'</td><td>'.$c->p9.'</td><td>'.$c->p10.'</td></tr>';

			}
		
		}
	else
	{
	echo '</tr>';
	}
$nomor++;
}
echo '</table><br>';
echo '<table class="table table-hover table-bordered">
<tr align="center"><td width="40"><strong>NIS</strong></td><td width="200"><strong>Nama</strong><td width="25"><strong>Pengetahuan</strong></td><td width="25"><strong>Keterampilan</strong></td><td width="25"><strong>Sikap</strong></td><td width="30"><strong>TUNTAS</strong></td><td><strong>Keterangan</strong></td></tr>';
$tb = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and status='Y' and `semester`='$semester' order by no_urut ");
$nomor=1;
foreach($tb->result() as $b)
{
	$nis = $b->nis;
	$nama = nis_ke_nama($nis);
	$tc = $this->db->query("select * from nilai where thnajaran='$thnajaran' and semester='$semester' and nis='$nis' and mapel='$mapel'");
	echo "<tr><td align=\"center\">".$nomor."</td><td>".$nis." ".$nama."</td>";
	$sikap ='?';
	$td = $this->db->query("select * from `afektif` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and mapel='$mapel'");
	foreach($td->result() as $d)
	{
	    $sikap = $d->deskripsi;
	}
	if(count($tc->result())>0)
	{
		foreach($tc->result() as $c)
		{
			echo '<td align="center">'.$c->kog.'</td><td align="center">'.$c->psi.'</td><td align="center">'.$c->afektif.'</td><td align="center">';
			if(substr($c->ket_akhir,0,5)=='Belum')
			{
				echo '<font color="#FF0000">'.substr($c->ket_akhir,0,5).'</font>';
			}
			else
			{
				echo substr($c->ket_akhir,0,5);
			}
			echo '</td><td><strong>Pengetahuan</strong> '.$c->keterangan.'<br /><strong>Keterampilan</strong> '.$c->deskripsi.'<br /><strong>Sikap</strong> '.$sikap.'</td></tr>';
		}
	}
	else
	{
		echo '</tr>';
	}
	$nomor++;
}
echo '</table>';
}
?>
</div>
