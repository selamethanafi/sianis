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
<p><a href="<?php echo base_url().'guruard/unduhkodenilai/'.$id_mapel.'" class="btn btn-primary"><span class="fa fa-download"></span>   <b>Unduh Kode Nilai dari ARD</b></a> <a href="'.base_url().'guruard/kirimnilaiakhir/'.$id_mapel.'" class="btn btn-success"><span class="fa fa-upload"></span>   <b>Kirim Nilai Akhir ke ARD</b></a></p>';?>
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
	echo form_open($url_ard.'/ma/guru/functions/student_value/daily/'.$school_class_id.'/'.$subjects_value.'/1');
	?>
	<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered"><thead>
	<tr align="center"><td><strong>No</strong></td><td><strong>Nama</strong></td>
	<?php
	echo '<td><strong>PH1</strong></td><td><strong>PH2</strong></td><td><strong>PH3</strong></td><td><strong>PH4</strong></td><td><strong>PH5</strong></td><td><strong>PH6</strong></td><td><strong>PH7</strong></td><td><strong>PH8</strong></td><td><strong>PH9</strong></td><td><strong>PH10</strong></td><td><strong>RPH</strong></td></thead>';
	$nomor=1;
	$galat = 0;
	foreach($query->result() as $t)
	{
		$nis = $t->nis;
		$tb = $this->db->query("select `nis`,`id_ard_siswa` from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{
			$student_id = $b->id_ard_siswa;
		}
		$namasiswa = nis_ke_nama($nis);
		if(!empty($t->student_value))
		{
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td>';
			if($t->nilai_uh1>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh1.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh1.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh2>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh2.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh2.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh3>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh3.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh3.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh4>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh4.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh4.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh5>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh5.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh5.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh6>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh6.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh6.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh7>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh7.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh7.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh8>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh8.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh8.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh9>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh9.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh9.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
			if($t->nilai_uh10>100)
			{
				echo '<td align="center">lebih dari 100</td>';
				$galat++;
			}
			else
			{
				echo '<td align="center">'.$t->nilai_uh10.'<input type="hidden" class="form-control" name="value_daily_score[]" value="'.$t->nilai_uh10.'" /><input type="hidden" class="form-control" name="value_daily_remed[]" value="" /></td>';
			}
		echo '<td align="center">'.$t->kog.'<input type="hidden" name="student_id[]" value="'.$student_id.'" required /><input type="hidden" name="student_status[]" value="1" required /><input type="hidden" name="student_value[]" value="'.$t->student_value.'" required /></td>';
		echo '</tr>';
		}
		else
		{
			echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td><td colspan="11">belum ada kode nilai dari ARD</div>';
		}
		$nomor++;
	}
	echo '</table></div>';
	if($galat==0)
	{
		echo '<p class="text-center"><input type="submit" value="Kirim ke ARD" class="btn btn-success"></p>';
	}
	echo '</form>';

}
else
{
echo 'Belum ada daftar nilai semester ini';
}
?>
</div></div></div>
