<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:33:31 WIB 
// Nama Berkas 		: catata_walikelas.php
// Lokasi      		: application/views/sinkronard/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<div class="container-fluid">
<div class="card">
<div class="card-body">
<?php
$xloc = base_url().'sinkronard/catatanwalikelas';
	echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';
if(empty($tahun1))
{
	$tahun1 = substr(cari_thnajaran(),0,4);
}
if(empty($semester))
{
	$semester = cari_semester();
}
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
if(!empty($tahun1))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran </label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.$c->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
if(!empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}
echo '</form>';
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
echo '<p>';
foreach($ta->result() as $a)
{
	echo '<a href="'.base_url().'sinkronard/ard/tanggapanwalikelas/'.$a->id_walikelas.'/0" class="btn btn-success">'.$a->kelas.'</a> ';
}
echo '</p>';
?>

</div></div></div>
