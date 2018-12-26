<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Diperbarui  : Kam 12 Mei 2016 12:15:23 WIB 
// Nama Berkas : ujian.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
?>
<?php
$xloc = base_url().'guru/ujian';
$ta = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
$query=$this->db->query("select * from m_mapel where thnajaran='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' and kelas like 'XII-%'");
$adadata = count($query->result())
?>
<div class="container-fluid">
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$thnajaran.'">'.$thnajaran.'</option>';

foreach($ta->result() as $a)
{
	echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';	
}
echo '</select></div></div>';


if($adadata>0)
{
?>
<div class="table-responsive">
<table class="table table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td><strong>Nilai</strong></td><td><strong>Unduh Nilai</strong></td><td><strong>Unduh Nilai Akhir</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $t)
{
if ($t->semester=='1')
	{
	$semestere = 'Gasal';
	}
	else
	{
	$semestere = 'Genap';
	}


echo "<tr><td align='center'>".$nomor."</td><td>".$t->kelas."</td><td>".$t->mapel."</td><td>".$t->thnajaran."</td><td align=center>".$t->semester."</td>";
	echo "</td>
<td align=center><a href='".base_url()."guru/nilaiujian/".$t->id_mapel."/1' title='Mengolah Nilai Ujian'><span class='fa fa-bullseye'></span></a></td><td align=center><a href='".base_url()."guru/unduhnilaipesertaun/".$t->id_mapel."' title='Mengunduh Nilai Peserta Ujian Nasional'><span class='fa fa-bullseye'></span></a></td><td align=center><a href='".base_url()."guru/unduhnilaiakhir/".$t->id_mapel."' title='Mengunduh Nilai Peserta Ujian Nasional'><span class='fa fa-bullseye'></span></a></td></tr>";
$nomor++;	
}
echo '</table></div>';
}
else
{?>
<div class="alert alert-danger">Belum ada data Mata Pelajaran di kelas XII, sudah membuat pembagian tugas? Silakan hubungi Admin atau Pengajaran</div>
<?php
}
?>
</div></div>
</div>
