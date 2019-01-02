<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:39:41 WIB 
// Nama Berkas 		: ftanggapan_walikelas.php
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
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$school_class_id = '';
foreach($ta->result() as $a)
{
	$school_class_id = $a->kode_rombel;
}
if($nomor > 0)
{
	$sebelumnya = $nomor - 1;
	$query2 = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut` limit $sebelumnya,1 ");
	foreach($query2->result() as $t2)
	{
		$nis = $t2->nis;
	}
	$query2 = $this->db->query("update `kepribadian` set `tiga`='s' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
}
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut` limit $nomor,1 ");
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{

		$nis = $t->nis;
	}
	if($ulang == 1)
	{
		$query = $this->db->query("update `kepribadian` set `tiga`='' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");

	}
	if($ulang == 2)
	{
		$query = $this->db->query("update `kepribadian` set `tiga`='s' where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");

	}

}
$query = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut` limit $nomor,1 ");

if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{

		$nis = $t->nis;
		$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{
			$student_id = $b->id_ard_siswa;
		}
		echo '<p class="text center">'.$namasiswa = nis_ke_nama($nis).'</p>';
		$ta = $this->db->query("select * from `kepribadian` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `nis`='$nis'");
		foreach($ta->result() as $a)
		{
			if($a->satu == 'A')
			{
				$predikat_sikap_spiritual = 'sangat+baik';
			}
			elseif($a->satu == 'B')
			{
				$predikat_sikap_spiritual = 'baik';
			}
			elseif($a->satu == 'C')
			{
				$predikat_sikap_spiritual = 'cukup';
			}
			else
			{
				$predikat_sikap_spiritual = 'kurang';
			}
			$deskripsi_sikap_spiritual = $a->kom1;
			if($a->dua == 'A')
			{
				$predikat_sikap_sosial = 'sangat+baik';
			}
			elseif($a->dua == 'B')
			{
				$predikat_sikap_sosial = 'baik';
			}
			elseif($a->dua == 'C')
			{
				$predikat_sikap_sosial = 'cukup';
			}
			else
			{
				$predikat_sikap_sosial = 'kurang';
			}
			$deskripsi_sikap_sosial = $a->kom2;
			if(empty($a->tiga))
			{
				echo '<form method="post" action="'.$url_ard.'/ma/guru/functions/student_report/add/'.$student_id.'" enctype="multipart/form-data">';
				$button = 'Kirim ke ARD';
			}
			else
			{
				echo '<form method="post" action="'.$url_ard.'/ma/guru/functions/student_report/edit/'.$student_id.'" enctype="multipart/form-data">';
				$button = 'Perbarui ARD';
			}
			echo '<input type="hidden" name="student_report_predicate_attitude_spiritual" value ="'.$predikat_sikap_spiritual.'">';
			echo '<input type="hidden" name="student_report_description_attitude_spiritual" value="'.$deskripsi_sikap_spiritual.'">';
			echo '<input type="hidden" name="student_report_predicate_attitude_social" value="'.$predikat_sikap_sosial.'">';
			echo '<input type="hidden" name="student_report_description_attitude_social" value="'.$deskripsi_sikap_sosial.'">';
			$tb = $this->db->query("select * from `ekstrakurikuler` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' order by `nama_ekstra` limit 0,3 ");
			foreach($tb->result() as $b)
			{
				$nama_ekstra = $b->nama_ekstra;
				$td = $this->db->query("select * from `m_ekstra` where `namaekstra`='$nama_ekstra'");
				$school_extracurricular_id = '';
				foreach($td->result() as $d)
				{
					$school_extracurricular_id = $d->school_extracurricular_id;
				}
				//$school_extracurricular_id = '';
				if(empty($school_extracurricular_id))
				{
					echo '<p>Bahaya! Kode Ekstrakurikuler dari ARD belum ada, hubungi Tatausaha!</p>';
				}
				echo '<input type="hidden" name="student_report_extracurricular_id[]" value="'.$school_extracurricular_id.'">';
				if($b->nilai == 'A')
				{
					$predekstra = 'sangat+baik';
				}
				elseif($b->nilai == 'B')
				{
					$predekstra = 'baik';
				}
				elseif($b->nilai == 'C')
				{
					$predekstra = 'cukup';
				}
				elseif($b->nilai == 'K')
				{
					$predekstra = 'kurang';
				}

				else
				{
					$predekstra = '';
				}
				echo '<input type="hidden" name="student_report_extracurricular_predicate[]" value="'.$predekstra.'">';
				echo '<input type="hidden" name="student_report_extracurricular_description[]" value="'.$b->keterangan.'">';
			}
			$tc = $this->db->query("select * from `siswa_prestasi` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' limit 0,3 ");
			foreach($tc->result() as $c)
			{
				echo '<input type="hidden" name="student_report_achievement_name[]" value="'.$c->kegiatan.'">';
				echo '<input type="hidden" name="student_report_achievement_description[]" value="'.$c->keterangan.'">';
			}
			echo '<input type="hidden" name="student_report_absence[]" value="'.$a->sakit.'">';
			echo '<input type="hidden" name="student_report_absence[]" value="'.$a->izin.'">';
			echo '<input type="hidden" name="student_report_absence[]" value="'.$a->tanpa_keterangan.'">';
			echo '<input type="hidden" name="student_report_note" value="'.$a->wali.'">';
			echo '<input type="hidden" name="student_report_status" value="tetap">';
			echo '<input type="hidden" name="student_report_class" value="'.$school_class_id.'">';
			echo '<p class="text center"><button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> '.$button.' </button></p>
		</form>';
		}
	}
}
