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
$xloc = base_url().'admin/kodemapel';
$kelasxx ='';
$school_class_id = '';
$adamapel = 0;
//thnajaran

echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
$tdx = $this->db->query("SELECT * FROM `entity__category_subjects` where `category_subjects_id`='$category_subjects_id'");
foreach($tdx->result() as $dx)
{
	if($dx->category_majors_id == 1)
	{
		$jurusanx = 'IPA';
	}
	elseif($dx->category_majors_id == 2)
	{
		$jurusanx = 'IPS';
	}
	elseif($dx->category_majors_id == 3)
	{
		$jurusanx = 'BAHASA';
	}
	elseif($dx->category_majors_id == 4)
	{
		$jurusanx = 'KEAGAMAAN';
	}
	else
	{
		$jurusanx = 'jurusan tidak jelas';
	}

	echo '<option value="'.$xloc.'/'.$dx->category_subjects_id.'">Kelas '.$dx->category_level_id.' &bull; '.$jurusanx.' &bull; '.$dx->category_subjects_name.' &bull; '.$dx->category_subjects_group.'</option>';
}
echo '<option value=""></option>';
$td = $this->db->query("SELECT * FROM `entity__category_subjects` where  `category_level_id` = '12' or `category_level_id` = '11' or `category_level_id`=10 ORDER BY `category_level_id` DESC ");

foreach($td->result() as $d)
{
	$category_subjects_id = $dx->category_subjects_id;
	if($d->category_majors_id == 1)
	{
		$jurusan = 'IPA';
	}
	elseif($d->category_majors_id == 2)
	{
		$jurusan = 'IPS';
	}
	elseif($d->category_majors_id == 3)
	{
		$jurusan = 'BAHASA';
	}
	elseif($d->category_majors_id == 4)
	{
		$jurusan = 'KEAGAMAAN';
	}
	else
	{
		$jurusan = 'jurusan tidak jelas';
	}

	echo '<option value="'.$xloc.'/'.$d->category_subjects_id.'">Kelas '.$d->category_level_id.' &bull; '.$jurusan.'  &bull; '.$d->category_subjects_name.' &bull; '.$d->category_subjects_group.'</option>';
}
echo '</select></div></div>';
echo '</form>';
if(!empty($category_subjects_id))
{
	$file = file_get_contents($url_ard_unduh.'/api/category_subjects_id.php?category_subjects_id='.$category_subjects_id);
	$json = json_decode($file, true);
	$subjects_value_id = $json[0]['subjects_value_id'];	
	echo $subjects_value_id.'<br />';
	$file = file_get_contents($url_ard_unduh.'/api/nilai.php?subjects_value_id='.$subjects_value_id);
	$json = json_decode($file, true);
	print_r($json);
}

?>
</div></div></div>
