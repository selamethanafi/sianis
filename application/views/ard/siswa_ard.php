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
$xloc = base_url().'tatausaha/siswaard';
$kelasxx ='';
$school_class_id = '';
$adamapel = 0;
//thnajaran
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$thnajaran.'</p></div></div>';
//semester
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">'.$semester.'</p></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
foreach($tdx->result() as $dx)
{
	$id_kelasxx = $dx->id_walikelas;
	$kelasxx = $dx->kelas;
	$school_class_id = $dx->kode_rombel;
	echo '<option value="'.$xloc.'/'.$id_kelasxx.'">'.$kelasxx.'</option>';
}

echo '<option value=""></option>';
$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
foreach($td->result() as $d)
{
	$id_kelasx = $d->id_walikelas;
	$kelasx = $d->kelas;
	echo '<option value="'.$xloc.'/'.$id_kelasx.'">'.$kelasx.'</option>';
}
echo '</select></div></div>';
echo '</form>';
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelasxx' and `status`='Y' order by `no_urut`");
if($ta->num_rows()>0)
{
	echo 'School Class ID '.$school_class_id;
	echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>ID Siswa ARD</td><td>Nama</td><td>NISN</td><td>Terkirim</td></tr>';
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		echo '<tr><td>'.$a->no_urut.'</td>';
		$tc = $this->db->query("select * from `datsis` where `nis`='$nis'");
		foreach($tc->result() as $c)
		{
			$student_id = $c->id_ard_siswa;
			$namasiswa = $c->nama;
			$nisn = $c->nisn;
			$post = [
					'school_id' => $school_id, 'student_id' => $student_id, 'school_class_id'=> $school_class_id,
 					];
				$ch = curl_init($url_ard.'/api/siswakelas.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				// execute!
				$response = curl_exec($ch);
				$json = json_decode($response, true);
				$terkirim = $json[0]['message'];
				$file = file_get_contents($url_ard.'/api/siswa.php?student_id='.$student_id);
				$json = json_decode($file, true);
				$school_class_id_ard = $json[0]['school_class_id'];
				if($school_class_id_ard == $school_class_id)
				{
					echo '<td>'.$student_id.'</td><td>'.$namasiswa.'</td><td>'.$nisn.'</td><td>Berhasil</td></tr>';
				}
				else
				{
					echo '<td>'.$student_id.'</td><td>'.$namasiswa.'</td><td>'.$nisn.'</td><td>Gagal</td></tr>';
				}

		}
	}
	echo '</table>';
}
?>
</div></div></div>
