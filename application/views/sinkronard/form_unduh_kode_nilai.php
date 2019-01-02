<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:43:34 WIB 
// Nama Berkas 		: form_unduh_kode_nilai.php
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
$query = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `mapel`");
$cacahsiswa = $query->num_rows();
$cacahsiswa = $cacahsiswa - 1;
$next = $nomor+1;
$prev = $nomor - 1;
$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `mapel` limit $nomor,1");
$mapel = '';
$subjects_value = '';
foreach($tb->result() as $b)
{
	$mapel = $b->mapel;
	$subjects_value = $b->subjects_value;
	$kelas = $b->kelas;
	$id_mapel = $b->id_mapel;
}
if($nomor == 0)
{
	//selanjutnya
	echo '<p class="text-center"><a href="'.base_url().'sinkronard/unduh_kode_nilai/'.$next.'/'.$id_mapel.'" class="btn btn-primary">Selanjutnya</a></p>';

}
elseif(($nomor < $cacahsiswa) and ($nomor > 0))
{
	
	echo '<p class="text-center"><a href="'.base_url().'sinkronard/unduh_kode_nilai/'.$prev.'" class="btn btn-primary">Sebelumnya</a> ';
	echo ' <a href="'.base_url().'sinkronard/unduh_kode_nilai/'.$next.'/'.$id_mapel.'" class="btn btn-primary">Selanjutnya</a>';
	echo '</p>';
}
elseif($nomor == $cacahsiswa)
{
	
	echo '<p class="text-center"><a href="'.base_url().'sinkronard/unduh_kode_nilai/'.$prev.'" class="btn btn-primary">Sebelumnya</a></p>';
}
else
{
}
echo $mapel.' '.$kelas.' '.$subjects_value;
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
$school_class_id = '';
foreach($ta->result() as $a)
{
	$school_class_id = $a->kode_rombel;
}
echo ' '.$school_class_id;
?>
<?php
$query = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `mapel` = '$mapel' and `status`='Y' order by `no_urut`");
$cacahsiswa = $query->num_rows();
//school_class_id;
if(empty($school_class_id))
{
	echo '<div class="alert alert-danger">Kode Kelas dari ARD belum ada<?div>';
}
if(count($query->result())>0)
{
	$nomore=1;
	$gagal=0;
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		$kd = $t->kd;
		$tb = $this->db->query("select `nis`,`id_ard_siswa`, `nama` from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{
			$student_id = $b->id_ard_siswa;
			$file = file_get_contents($url_ard_unduh.'/api/nilai.php?subjects_value_id='.$subjects_value.'&student_id='.$student_id);
			$json = json_decode($file, true);
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
				echo '<p class="text-danger">'.$nomore.' '.$b->nama.' kode nilai gagal diunduh</p>';
				$gagal++;
			}
			elseif($student_subjects_value_id == 'tidak ada data')
			{
				echo '<p class="text-danger">'.$nomore.' '.$b->nama.' kode nilai gagal diunduh</p>';
				$gagal++;
			}
			else
			{
				echo '<p class="text-success">'.$nomore.' --- '.$student_subjects_value_id.'</p>';
			}
//			echo $file;
		}
		$nomore++;
	}
	if($gagal > 0)
	{
		echo '<p><a href="'.base_url().'sinkronard/unduh_kode_nilai/'.$nomor.'" class="btn btn-primary"><span class="fa fa-download"></span>   <b>Unduh Kode Nilai Lagi</b></a> </p>';
	}
	else
	{
		echo '<p><a href="'.base_url().'sinkronard/kirimnilai/'.$nomor.'" class="btn btn-primary"><span class="fa fa-download"></span>   <b>Unduh Kode Nilai Lagi</b></a> </p>';
	}


}
else
{
echo 'Belum ada daftar nilai semester ini';
}
?>
</div></div></div>
