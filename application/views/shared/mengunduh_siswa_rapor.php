<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_emiss.php
// Lokasi      		: application/views/shared/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
$xloc = base_url().'tatausaha/unduhdatasiswaraporexcel';
?>
<form name="formx" method="post" action="<?php echo $xloc;?>" class="form-horizontal" role="form">
<?php
	if (!empty($tahun1))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().$usere.'/cetakbukurapor" title="Ganti Tahun Pelajaran">Tahun Pelajaran</a></label></div><div class="col-sm-9"><select name="tahun1" class="form-control">';
		echo "<option value='".$tahun1."'>".$thnajaran."</option>";
		echo '</select></div></div>';
	}
	if (!empty($semester))
	{
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().$usere.'/cetakbukurapor/'.$tahun1.'" title="Ganti Semester">Semester</a></label></div><div class="col-sm-9"><select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option></select></div></div>';
	}
if(empty($tahun1))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value="'.$xloc.'/'.$page.'/'.$tahun1.'">'.$thnajaran.'</option>';
		foreach($daftar_tapel->result() as $k)
		{
			echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
		}
		echo '</select></div></div>';
	}
	elseif(empty($semester))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		if($semester == 1)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		}
		elseif($semester == 2)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
		}
		else
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
			echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
		}

		echo '</select></div></div>';
	}
	elseif(empty($id_walikelas))
	{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="id_mapel" onChange="MM_jumpMenu('self',this,0)" class="form-control">
		<?php
		echo '<option value=""></option>';
		$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`= '$thnajaran' and `semester` = '$semester' order by `kelas` ASC");
		foreach($ta->result() as $a)
		{
			echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
		}
	}

echo '</form>';
?>
</div></div></div>
