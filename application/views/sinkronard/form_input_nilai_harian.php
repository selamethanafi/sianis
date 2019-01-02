<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:43:12 WIB 
// Nama Berkas 		: form_input_nilai_harian.php
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
$query = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `subjects_value` !='' order by `mapel`");
$cacahsiswa = $query->num_rows();
$cacahsiswa = $cacahsiswa - 1;
$next = $nomor+1;
$prev = $nomor - 1;
$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `subjects_value` !='' order by `mapel` limit $nomor,1");
$mapel = '';
$subjects_value = '';
foreach($tb->result() as $b)
{
	$mapel = $b->mapel;
	$subjects_value = $b->subjects_value;
	$kelas = $b->kelas;
	$id_mapel = $b->id_mapel;
}
$tc = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `mapel` limit $next,1");
$ard = '';
foreach($tc->result() as $c)
{
	$ard = $c->ard;
}

if($nomor == 0)
{
	//selanjutnya
	echo '<p class="text-center">';
	if($ard == 1)
	{
		$next2 = $next+1;
		echo '<a href="'.base_url().'sinkronard/form_input_nilai_harian/'.$next2.'/'.$id_mapel.'" class="btn btn-primary">Lewati</a>';
	}
	echo ' <a href="'.base_url().'sinkronard/form_input_nilai_harian/'.$next.'/'.$id_mapel.'" class="btn btn-primary">Selanjutnya</a>';
	echo '</p>';

}
elseif(($nomor < $cacahsiswa) and ($nomor > 0))
{
	
	echo '<p class="text-center"><a href="'.base_url().'sinkronard/form_input_nilai_harian/'.$prev.'" class="btn btn-primary">Sebelumnya</a> ';
	if($ard == 1)
	{
		$next2 = $next+1;
		echo ' <a href="'.base_url().'sinkronard/form_input_nilai_harian/'.$next2.'/'.$id_mapel.'" class="btn btn-primary">Lewati</a>';
	}
	echo ' <a href="'.base_url().'sinkronard/form_input_nilai_harian/'.$next.'/'.$id_mapel.'" class="btn btn-primary">Selanjutnya</a>';
	echo '</p>';
}
elseif($nomor == $cacahsiswa)
{
	
	echo '<p class="text-center"><a href="'.base_url().'sinkronard/form_input_nilai_harian/'.$prev.'" class="btn btn-primary">Sebelumnya</a></p>';
}
else
{
}
echo $nomor.' '.$mapel.' '.$kelas.' subjects_value '.$subjects_value;
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$school_class_id = '';
foreach($ta->result() as $a)
{
	$school_class_id = $a->kode_rombel;
}
echo ' school_class_id '.$school_class_id;
$konten = $kelas.' subjects_value '.$subjects_value.' school_class_id '.$school_class_id;
if((!empty($school_class_id)) and (!empty($subjects_value)))
{

?>
<iframe src="<?php echo $url_ard.'/ma/guru/input_nilai_harian?school_class=school_class&school_class_id='.$school_class_id.'&amp;subjects_value='.$subjects_value.'&category_value=1';?>" width="100%" height="400"></iframe>
<?php
}
else
{
	$this->db->query("insert into `kosong` (`nomor`, `id_mapel`, `isi`) values ('$nomor', '$id_mapel', '$konten')");
	echo '<div class="alert alert-danger">subjects_value atau school_class_id kosong</div>';
}
?>
</div></div></div>
