<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:34:41 WIB 
// Nama Berkas 		: kirim_daftar_nilai_akhir_ke_ard.php
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
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<div class="container-fluid">
<?php
$xloc = base_url().'sinkronard/kirimnilaiakhir';
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
if(empty($id_mapel))
{
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `subjects_value` != '' order by `mapel`, `kelas`");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mapel Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$id_mapel.'">'.$mapel.' '.$kelas.'</option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
	}
	echo '</select></div></div>';
	echo '</form>';
}
else
{
	echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `subjects_value` != '' order by `mapel`, `kelas`");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mapel Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$id_mapel.'">'.$mapel.' '.$kelas.'</option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
	}
	echo '</select></div></div>';
	echo '</form>';
	$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
	$cacahsiswa = $query->num_rows();
	$cacahsiswa = $cacahsiswa - 1;
	$next = $nomor+1;
	$prev = $nomor - 1;
	if($nomor == 0)
	{
		//selanjutnya
		echo '<p class="text-center"><a href="'.base_url().'sinkronard/kirimnilaiakhir/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/'.$next.'" class="btn btn-primary">Selanjutnya</a></p>';
	}
	elseif(($nomor < $cacahsiswa) and ($nomor > 0))
	{
		echo '<p class="text-center"><a href="'.base_url().'sinkronard/kirimnilaiakhir/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/'.$prev.'" class="btn btn-primary">Sebelumnya</a> <a href="'.base_url().'sinkronard/kirimnilaiakhir/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/'.$next.'" class="btn btn-info">Selanjutnya</a></p>';
	}
	elseif($nomor == $cacahsiswa)
	{
		echo '<p class="text-center"><a href="'.base_url().'sinkronard/kirimnilaiakhir/'.$id_mapel.'/'.$prev.'" class="btn btn-primary">Sebelumnya</a></p>';
	}
	else
	{
	}
	?>
	<iframe src="<?php echo base_url().'sinkronard/fkirimnilaiakhir/'.$id_mapel.'/'.$nomor;?>" width="100%" height="600"></iframe>
<?php
}
?>
</div>
</div></div></div>
