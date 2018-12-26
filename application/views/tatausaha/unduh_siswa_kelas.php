<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: unduh_siswa_kelas.php
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
<?php
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($kolom)))
	{
	$thnajarane = berkas($thnajaran);
	$kelase = berkas($kelas);
	if ($kelas == 'Semua')
		{
		$filename = 'daftar_siswa_semester_'.$semester.'_tahun_'.$thnajarane.''; 	
		}
		else
		{
		$filename = 'daftar_siswa_kelas_'.$kelase.'_semester_'.$semester.'_tahun_'.$thnajarane.''; 	
		}

	if ($kolom == 'Sebagian')
		{
		$csv_output = '"Nomor Urut","NIS","NAMA","L/P"';
		}
	if ($kolom == 'Semua')
		{
		$csv_output = '"thnajaran","semester","kelas","no_urut","nis","nama","status"';
		}
		$csv_output .= "\n";
		if ($kelas == 'Semua')
			{
			$qdt = $this->db->query("SELECT * from siswa_kelas where thnajaran='$thnajaran' and `status`='Y' and `semester`='$semester' order by kelas ASC, no_urut ASC");
			}
			else
			{
			$qdt = $this->db->query("SELECT * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `status`='Y' and `semester`='$semester' order by no_urut ");
			}

	//nek gak null
	$dt_nox = 0;
	foreach($qdt->result_array() as $rdt)
	{
	$dt_nox = $dt_nox + 1;
	$nis = $rdt['nis'];
	$namasiswa = nis_ke_nama($nis);
	$jenkel = jenkel_siswa($nis,0);
	if ($kelas == 'Semua')
		{
		if ($kolom == 'Sebagian')
			{
			$csv_output .= '"'.$rdt['no_urut'].'","'.$nis.'","'.$namasiswa.'","'.$jenkel.'"';
			}
			else
			{
			$csv_output .='"'.$thnajaran.'","'.$rdt['semester'].'","'.$rdt['kelas'].'","'.$rdt['no_urut'].'","'.$nis.'","'.$namasiswa.'","'.$rdt['status'].'"'; 
			}
		}
		else
		{
		if ($kolom == 'Sebagian')
			{
			$csv_output .= '"'.$rdt['no_urut'].'","'.$nis.'","'.$namasiswa.'","'.$jenkel.'"';
			}
			else
			{
			$csv_output .='"'.$thnajaran.'","'.$rdt['semester'].'","'.$rdt['kelas'].'","'.$rdt['no_urut'].'","'.$nis.'","'.$namasiswa.'","'.$rdt['status'].'"'; 
			}
		}

	$csv_output .= "\n";
	}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
}
?>
<div class="container-fluid">
<?php
	echo '<h3>'.$judulhalaman.'</h3>';
if(isset($tautan_balik))
	{
	echo form_open('bp/unduhsiswakelas','class="form-horizontal" role="form"');
	}
else
{
	echo form_open('tatausaha/unduhsiswakelas','class="form-horizontal" role="form"');
}
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
	if (empty($thnajaran))
		{
		$thnajaran = cari_thnajaran();
		}
	if (empty($semester))
		{
		$semester = cari_semester();
		}

echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
foreach($daftartahun->result_array() as $k)
{
echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
}
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">
	<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	?>
	</select></div></div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
<select name="kelas" class="form-control">

<?php
echo "<option value='".$kelas."'>".$kelas."</option>";
echo "<option value='Semua'>Semua</option>";
foreach($daftarkelas->result_array() as $ka)
{
echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
}
?>
</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kolom</label></div><div class="col-sm-9">
<select name="kolom" class="form-control">
<?php
echo "<option value='".$kolom."'>".$kolom."</option>";
echo "<option value='Semua'>Semua</option>";
echo "<option value='Sebagian'>Sebagian</option>";
?>
</select></div></div>
<p class="text-center"><input type="submit" value="Unduh Daftar Siswa" class="btn btn-primary"></p>
</form>
</div>
