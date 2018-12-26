<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_siswa_kelas.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 10:47:32 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
	{
	$thnajarane = berkas($thnajaran);
	$kelase = berkas($kelas);
	$filename = 'daftar_siswa_kelas_'.$kelase.'_semester_'.$semester.'_tahun_'.$thnajarane.''; 	
	$csv_output = '"Nomor Urut","NIS","NAMA","L/P"';
	$csv_output .= "\n";
	$qdt = $this->db->query("SELECT * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and `status`='Y' order by no_urut ");
	$tdt = $qdt->num_rows();
	//nek gak null
	$dt_nox = 0;
	foreach($qdt->result() as $rdt)
	{
		$dt_nox = $dt_nox + 1;
		$nis = $rdt->nis;
		$namasiswa = nis_ke_nama($nis);
		$jenkel = jenkel_siswa($nis,0);
		$csv_output .= '"'.$rdt->no_urut.'","'.$nis.'","'.$namasiswa.'","'.$jenkel.'"';
		$csv_output .= "\n";
	}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
}
?>
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php echo form_open('bp/unduhsiswakelas');?>
<table class="table">
<tr><td>Tahun Pelajaran</td><td>
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
</select></td></tr>
<tr><td>Semester</td><td>
<select name="semester" class="form-control">
	<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	?>
	</select></td></tr>
<tr><td>Kelas</td><td>
<select name="kelas" class="form-control">

<?php
echo "<option value='".$kelas."'>".$kelas."</option>";
foreach($daftarkelas->result_array() as $ka)
{
echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
}
?>
</select></td></tr>
</table>
<p class="text-center"><button type="submit" class="btn btn-primary">UNDUH DATA SISWA</button></p>
</form>
</div>
