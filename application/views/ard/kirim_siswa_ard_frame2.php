<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
$kelas = '';
$school_class_id = '';
$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_walikelas'");
foreach($tdx->result() as $dx)
{
	$id_kelasxx = $dx->id_walikelas;
	$kelas = $dx->kelas;
	$school_class_id = $dx->kode_rombel;
}
if(substr($kelas,0,2) == 'X-')
{
	$tingkat = 10;
}
elseif(substr($kelas,0,3) == 'XI-')
{
	$tingkat = 11;
}
elseif(substr($kelas,0,4) == 'XII-')
{
	$tingkat = 12;
}
else
{
	$tingkat = 13;
}
if(($tingkat > 12) or (empty($school_class_id)))
{
	echo 'Galat, tingkat kelas yaitu ('.$tingkat.') tidak didukung atau kode kelas ('.$school_class_id.') dari ard masih kosong';
}
else
{
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' and `status`='Y' order by `no_urut`");
	if($ta->num_rows()>0)
	{

		?>
		<form method="post" action="<?php echo $url_ard.'/ma/operator_madrasah/functions/school_class/student/add/'.$school_class_id;?>" enctype="multipart/form-data">

<?php
/*
<div class="form-group">
		<select name="student_id[]" multiple="multiple" class="form-control" required >
		<?php
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			$tc = $this->db->query("select * from `datsis` where `nis`='$nis'");
			foreach($tc->result() as $c)
			{
				$student_id = $c->id_ard_siswa;
				$namasiswa = $c->nama;
				$nisn = $c->nisn;
				echo '<option value="'.$student_id.'" selected>'.$nisn.' &bull; '.$namasiswa.'</option>';
			}
		}
		echo'</select></div><button type="submit" class="btn btn-md btn-primary"><i class="fa fa-upload"></i> KIRIM</button></form>';
*/
?>
		<?php
		echo '<table class="table table-striped table-hover table-bordered"><tr><td>Nomor</td><td>Nama</td><td>NISN</td><td>ID Siswa ARD</td></tr>';
		$nomor = 1;
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			$tc = $this->db->query("select * from `datsis` where `nis`='$nis'");
			foreach($tc->result() as $c)
			{
				$student_id = $c->id_ard_siswa;
				$namasiswa = $c->nama;
				$nisn = $c->nisn;
				echo '<tr><td><input type="hidden" name="student_id[]" value="'.$student_id.'">'.$nomor.'</td><td>'.$namasiswa.'</td><td>'.$nisn.' </td><td>'.$student_id.'</td></tr>';
			}
		$nomor++;
		}
		echo'</table><button type="submit" class="btn btn-md btn-primary"><i class="fa fa-upload"></i> KIRIM</button></form>';

	}
	else
	{
		echo 'Galat, belum ada siswa';
	}
}
?>
</div></div></div>
