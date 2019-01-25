<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:23:28 WIB 
// Nama Berkas 		: daftarnilai.php
// Lokasi      		: application/views/guru/
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
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url().'guruard/unggahkodenilai/'.$id_mapel.'" class="btn btn-primary"><span class="fa fa-upload"></span>  <b>Unggah Kode Nilai dari ARD</b></a></p>';?>
<form class="form-horizontal" role="form">
<div class="form-group row"><div class="col-sm-5"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $thnajaran;?></div></div>
<div class="form-group row"><div class="col-sm-5"><label class="control-label">Semester</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $semester;?></div></div>
<div class="form-group row"><div class="col-sm-5"><label class="control-label">Kelas</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $kelas;?></div></div>
<div class="form-group row"><div class="col-sm-5"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $mapel;?></div></div>
<div class="form-group row"><div class="col-sm-5"><label class="control-label">Kode Kelas ARD</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $school_class_id;?></div></div>
<div class="form-group row"><div class="col-sm-5"><label class="control-label">Kode Mapel ARD</label></div><div class="col-sm-7"><p class="form-control-static"><?php echo $subjects_value;?> <a href="<?php echo base_url().'guruard/subjects_value/'.$id_mapel;?>">Ganti Kode</a></div></div>

</form>
<?php
if($pilihan == 1)
{
	$query = $this->db->query("select * from `nilai_pilihan` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
}
else
{
	$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
}
$cacahsiswa = $query->num_rows();
//school_class_id;
if(empty($school_class_id))
{
	echo '<div class="alert alert-danger">Kode Kelas dari ARD belum ada<?div>';
}
if(count($query->result())>0)
{
	$nomor=1;
	$gagal=0;
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		$kd = $t->kd;
		$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{
			$student_id = $b->id_ard_siswa;
			$json = via_curl($url_ard_unduh.'/api/nilai.php?subjects_value_id='.$subjects_value.'&student_id='.$student_id);
			$student_subjects_value_id = $json[0]['student_subjects_value_id'];
			if($student_subjects_value_id != 'tidak ada data')
			{
				if(!empty($student_subjects_value_id))
				{
					$this->db->query("update `nilai` set `student_value`='$student_subjects_value_id' where `kd`='$kd'");
				}
			}
			if(empty($student_subjects_value_id))
			{
				echo '<p class="text-danger">'.$nomor.' kode nilai gagal diunduh</p>';
				$gagal++;
			}
			elseif($student_subjects_value_id == 'tidak ada data')
			{
				echo '<p class="text-danger">'.$nomor.' kode nilai gagal diunduh</p>';
				$gagal++;
			}
			else
			{
				echo '<p class="text-success">'.$nomor.' --- '.$student_subjects_value_id.'</p>';
			}
		}
		$nomor++;
	}
	if($gagal == 0)
	{
		echo '<p><a href="'.base_url().'guruard/kirimnilai/'.$id_mapel.'" class="btn btn-primary"><span class="fa fa-upload"></span>   <b>Kirim Nilai ke ARD</b></a></p>';
	}
	else
	{
		echo '<p><a href="'.base_url().'guruard/unduhkodenilai/'.$id_mapel.'" class="btn btn-primary"><span class="fa fa-download"></span>   <b>Unduh Kode Nilai Lagi</b></a> <a href="'.base_url().'guruard/kirimnilai/'.$id_mapel.'" class="btn btn-info"><span class="fa fa-upload"></span>   <b>Kembali</b></a> </p>';
	}

}
else
{
echo 'Belum ada daftar nilai semester ini';
}
?>
</div></div></div>
