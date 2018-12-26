<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_unduh_bph.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman.' Buku Pelaksanaan Harian';?></h3></div>
<div class="card-body">
<?php
 $xloc = base_url().'unggah/unduhperangkat/'.$item;
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
if (!empty($tahun1))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'">Tahun Pelajaran</a></label></div><div class="col-sm-9">
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'"><p class="form-control-static">'.$thnajaran.'</p></div></div>';
}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<input name="semester" type="hidden" value="'.$semester.'"><p class="form-control-static">'.$semester.'</p></div></div>';
	}
if (!empty($id_mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9">';
			echo '<input name="id_mapel" type="hidden" value="'.$id_mapel.'">';
			$mapel = id_mapel_jadi_mapel($id_mapel);
			$kelas = id_mapel_jadi_kelas($id_mapel);
			echo '<p class="form-control-static">'.$mapel.' '.$kelas.'</p></div></div>';

	}

if(empty($tahun1))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	?>
	<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $k)
	{
	echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value=""></option>';
		echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
		echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option></select></div></div>';
	}
else
{
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran / Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value=""></option>';
	foreach($ta->result() as $a)
		{
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
		}
	echo '</select></div></div>';
}
?>
</form>
</div></div></div>
