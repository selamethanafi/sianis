<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 03 Apr 2015 16:03:28 WIB 
// Nama Berkas 		: supervisi.php
// Lokasi      		: application/views/tatausaha/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php echo form_open('tatausaha/supervisi');
if(empty($thnajaran))
	{
	$thnajaran = cari_thnajaran();
	}
if(empty($semester))
	{
	$semester = cari_semester();
	}
$ta = $this->db->query("select * from `p_pegawai` where `status`='Y' and `guru`='Y' order by nama_tanpa_gelar");
echo '<table class="table table-bordered">';
	echo '<tr><td>Tahun Penilaian</td><td>
	<select name="thnajaran" class="form-control">';
       	echo '<option value="'.$thnajaran.'">'.$thnajaran.'</option>';
	$tb = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	foreach($tb->result() as $b)
	{
       	echo '<option value="'.$b->thnajaran.'">'.$b->thnajaran.'</option>';
	}
	echo '</select></td></tr>';
	echo '<tr><td>Semester</td><td>
	<select name="semester" class="form-control">';
	if($semester == 1)
		{
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '<option value="2">2</option>';
		}
		else
		{
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '<option value="1">1</option>';
		}
	echo '</select></td></tr>';
	echo '<tr><td>Nama Pegawai</td><td>
	<select name="kodeguru" class="form-control">';
	echo "<option value=''> pilih guru</option>";
	foreach($ta->result() as $a)
	{
       	echo '<option value="'.$a->kd.'">'.$a->nama_tanpa_gelar.' '.$a->nama.'</option>';
	}
	echo '</select></td></tr>';
	echo '<tr><td>Supervisor</td><td>
	<select name="supervisor" class="form-control">';
	echo '<option value="pengawas"> Pengawas</option>';
       	echo '<option value="kepala">Kepala</option>';
	echo '</select></td></tr>';
	echo '<tr><td></td><td>';
	echo '<input type="submit" value="Lanjut" class="btn btn-success"></td></tr>';
?>
</table>
</form>
</div>
