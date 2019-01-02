<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:41:03 WIB 
// Nama Berkas 		: entity__category_subjects.php
// Lokasi      		: application/views/sinkronard/
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
$file = file_get_contents($url_ard_unduh.'/api/entity__category_subjects.php');
$json = json_decode($file, true);
foreach($json as $data)
{
    $category_subjects_id = $data['category_subjects_id'];
    $category_level_id = $data['category_level_id'];
    $category_majors_id = $data['category_majors_id'];
    $category_subjects_code = $data['category_subjects_code'];
    $category_subjects_name = $data['category_subjects_name'];
    $category_subjects_group = $data['category_subjects_group'];
	$this->db->query("insert into `entity__category_subjects` (`category_subjects_id`, `category_level_id`, `category_majors_id`, `category_subjects_code`, `category_subjects_name`, `category_subjects_group`) values ('$category_subjects_id', '$category_level_id', '$category_majors_id', '$category_subjects_code', '$category_subjects_name', '$category_subjects_group')");
}
echo 'Selesai';
