<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:40:20 WIB 
// Nama Berkas 		: form_kirim_nilai_rapor.php
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
$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'");
$total_siswa = $ta->num_rows();
echo '<h2>Mohon bersabar</h2>';
$total_siswa = 3000;
if($nomor <= $total_siswa)
{
//	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y' limit $nomor,1");
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nomor'");		
	foreach($ta->result() as $a)
	{
		$nis = 	$a->nis;
		$no_urut = $a->no_urut;
		$kelas = $a->kelas;
		$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
		$student_id = '?';
		foreach($tb->result() as $b)
		{
			$student_id = $b->id_ard_siswa;
		}
		$tahun1 = substr($thnajaran,0,4);
		$file = file_get_contents($url_ard_unduh.'/api/student_report.php?student_id='.$student_id.'&student_report_year='.$tahun1.'&student_report_semester='.$semester);
		$json = json_decode($file, true);
		$ada_rapor = '?';
		foreach($json as $data)
		{
			$ada_rapor = $data['ada_rapor'];
		}
		if($ada_rapor == 'tidak ada data')
		{
			$server_pusat = $url_ard.'/ma/guru/functions/student_report/add/'.$student_id;
		}
		else
		{
			$server_pusat = $url_ard.'/ma/guru/functions/student_report/edit/'.$student_id;
		}
		echo '<p>'.$file.'</p>';
		echo $url_ard_unduh.'/api/student_report.php?student_id='.$student_id.'&student_report_year='.$tahun1.'&student_report_semester='.$semester;
		$tc = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		foreach($tc->result() as $c)
		{
			if($c->satu == 'A')
			{
				$predikat_sikap_spiritual = 'sangat+baik';
			}
			elseif($c->satu == 'B')
			{
				$predikat_sikap_spiritual = 'baik';
			}
			elseif($c->satu == 'C')
			{
				$predikat_sikap_spiritual = 'cukup';
			}
			else
			{
				$predikat_sikap_spiritual = 'kurang';
			}
			$deskripsi_sikap_spiritual = $c->kom1;
			if($c->dua == 'A')
			{
				$predikat_sikap_sosial = 'sangat+baik';
			}
			elseif($c->dua == 'B')
			{
				$predikat_sikap_sosial = 'baik';
			}
			elseif($c->dua == 'C')
			{
				$predikat_sikap_sosial = 'cukup';
			}
			else
			{
				$predikat_sikap_sosial = 'kurang';
			}
			$deskripsi_sikap_sosial = $c->kom2;
			$post = [
					'student_report_predicate_attitude_spiritual'=>$predikat_sikap_spiritual,
					'student_report_description_attitude_spiritual'=>$deskripsi_sikap_spiritual,
					'student_report_predicate_attitude_social'=>$predikat_sikap_sosial,
					'student_report_description_attitude_social'=>$deskripsi_sikap_sosial,
 					];
				$ch = curl_init($server_pusat);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				// execute!
				$response = curl_exec($ch);
				echo $response;
			echo 'curl '.$server_pusat;
			$file = file_get_contents($url_ard_unduh.'/api/update_student_report.php?student_id='.$student_id.'&student_report_year='.$tahun1.'&student_report_semester='.$semester);
			$json = json_decode($file, true);
			$rapor = '?';
			foreach($json as $data)
			{
				$rapor = $data['rapor'];
			}
			echo $file;
			echo 'Update rapor '.$rapor;
		}
	}
}
else
{

}
?>
</div></div></div>
