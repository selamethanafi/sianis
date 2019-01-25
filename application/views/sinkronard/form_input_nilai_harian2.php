<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:42:09 WIB 
// Nama Berkas 		: form_input_nilai_harian2.php
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
$query = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
$cacahsiswa = $query->num_rows();
if($cacahsiswa > 0)
{
	foreach($query->result() as $b)
	{
		$mapel = $b->mapel;
		$kelas = $b->kelas;
		$subjects_value = $b->subjects_value;
		$thnajaran = $b->thnajaran;
		$semester = $b->semester;
	}
	echo $mapel.' '.$kelas.'<br />subjects_value '.$subjects_value;
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	$school_class_id = '';
	foreach($ta->result() as $a)
	{
		$school_class_id = $a->kode_rombel;
	}
	echo '<br />school_class_id '.$school_class_id;
	echo '<p><a href="'.base_url().'sinkronard/kirimnilaiharian/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_mapel.'" class="btn btn-primary"><span class="fa fa-upload"></span>   <b>Kirim Nilai Harian ke ARD</b></a></p>';
	if((!empty($school_class_id)) and (!empty($subjects_value)))
	{
	?>
		<iframe src="<?php echo $url_ard.'/ma/guru/input_nilai_harian?school_class=school_class&school_class_id='.$school_class_id.'&amp;subjects_value='.$subjects_value.'&category_value=1';?>" width="100%" height="400"></iframe>
	<?php
	}
}
else
{
	echo '<div class="alert alert-danger">subjects_value atau school_class_id kosong</div>';
}
?>
</div></div></div>
