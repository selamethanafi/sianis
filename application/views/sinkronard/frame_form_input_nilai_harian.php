<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:46:19 WIB 
// Nama Berkas 		: frame_form_input_nilai_harian.php
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
<?php
$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `mapel` limit $nomor,1");
$mapel = '';
$subjects_value = '';
foreach($tb->result() as $b)
{
	$mapel = $b->mapel;
	$subjects_value = $b->subjects_value;
	$kelas = $b->kelas;
	$ard = 1;
}
echo $nomor.' ssss '.$mapel.' '.$kelas.' '.$subjects_value;
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$school_class_id = '';
foreach($ta->result() as $a)
{
	$school_class_id = $a->kode_rombel;
}
?>
sasas
<iframe src="<?php echo $url_ard.'/ma/guru/input_nilai_harian?school_class=school_class&school_class_id='.$school_class_id.'&amp;subjects_value='.$subjects_value.'&category_value=1';?>" width="100%" height="100"></iframe>

