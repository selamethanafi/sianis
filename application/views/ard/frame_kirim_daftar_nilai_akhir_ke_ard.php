<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 06 Jan 2019 21:12:43 WIB 
// Nama Berkas 		: frame_kirim_daftar_nilai_akhirf_ke_ard.php
// Lokasi      		: application/views/ard/
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
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$school_class_id = '';
foreach($ta->result() as $a)
{
	$school_class_id = $a->kode_rombel;
}
?>
<div class="container-fluid">
<div class="card">
<div class="card-body">
<?php
if($pilihan == 1)
{
	$query = $this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut` limit $nomor,1");
}
else
{
	$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut` limit $nomor,1 ");
}
$cacahsiswa = $query->num_rows();
//school_class_id;
if(empty($school_class_id))
{
	echo '<div class="alert alert-danger">Kode Kelas dari ARD belum ada</div>';
}
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		$student_value = $t->student_value;
		$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{
			$student_id = $b->id_ard_siswa;
		}
		$namasiswa = nis_ke_nama($nis);
		$student_value_id = $t->student_value;
		if(!empty($t->student_value))
		{
			$value_daily = $t->nilai_ruh;
			$value_final = $t->nilai_uas;
			$value_knowledge_total = $t->kog;
			$value_knowledge_description = $t->keterangan;
			$value_practice = $t->p1;
			$value_portfolio = $t->p2;
			$value_project = $t->p3;
			$value_skill_total = $t->psi;
			$value_skill_description = $t->deskripsi;
			$value_knowledge_predicate = predikat_nilai_2018($value_knowledge_total,$kkm);
			$value_skill_predicate = predikat_nilai_2018($value_skill_total,$kkm);
		}
	}
	if(!empty($student_value_id))
		{
		echo '<form method="post" action="'.$url_ard.'/ma/guru/functions/student_value/edit/'.$student_value.'/1">';
			echo '<input type="hidden" name="value_daily" value="'.$value_daily.'">
			<input type="hidden" name="value_final" value="'.$value_final.'">
			<input type="hidden" name="value_knowledge_total" value="'.$value_knowledge_total.'">
			<input type="hidden" name="value_knowledge_predicate" value="'.$value_knowledge_predicate.'">
			<input type="hidden" name="value_knowledge_description" value="'.$value_knowledge_description.'">
			<input type="hidden" name="value_practice" value="'.$value_practice.'">
			<input type="hidden" name="value_portfolio" value="'.$value_portfolio.'">
			<input type="hidden" name="value_project" value="'.$value_project.'">
			<input type="hidden" name="value_skill_total" value="'.$value_skill_total.'">
			<input type="hidden" name="value_skill_predicate" value="'.$value_skill_predicate.'">
			<input type="hidden" name="value_skill_description" value="'.$value_skill_description.'">';
		echo '<p class="text-center"><input type="submit" value="Kirim ke ARD" class="btn btn-success"></p></form>';

	
	?>
Tahun Pelajaran <?php echo $thnajaran;?><br />
Semester <?php echo $semester;?><br />
Kelas <?php echo $kelas;?><br />
Mata Pelajaran <?php echo $mapel;?><br />
Kode Kelas ARD <?php echo $school_class_id;?><br />
Kode Mapel ARD <?php echo $subjects_value;?><br />

	<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered"><thead>
	<tr align="center"><td><strong>Nama</strong></td>
	<?php
	echo '<td>KKM</td><td><strong>RPH</strong></td><td><strong>PAS</strong></td><td><strong>Nilai Pengetahuan</strong></td><td><strong>Predikat</strong></td><td><strong>Praktik</strong></td><td><strong>Portofolio</strong></td><td><strong>Proyek</strong></td><td><strong>Nilai Keterampilan</strong></td><td><strong>Predikat</strong></td></tr></thead>';
	echo '<tr align="center"><td>'.$namasiswa.'</td>';
			echo '<td>'.$kkm.'</td><td>'.$value_daily.'</td><td>'.$value_final.'</td><td>'.$value_knowledge_total.'</td><td>'.$value_knowledge_predicate.'</td><td>'.$value_practice.'</td><td>'.$value_portfolio.'</td><td><strong>'.$value_project.'</strong></td><td>'.$value_skill_total.'</td><td>'.$value_skill_predicate.'</td></tr>';
			echo '<tr><td colspan="10">'.$value_knowledge_description.'</td></tr>';
			echo '<tr><td colspan="10">'.$value_skill_description.'</td></tr>';
	echo '</table></div>';
	}
	else
	{
		echo $namasiswa.' belum mendapat kode nilai ARD';
	}
}
else
{
echo 'Belum ada daftar nilai semester ini';
}
?>
</div></div></div>
