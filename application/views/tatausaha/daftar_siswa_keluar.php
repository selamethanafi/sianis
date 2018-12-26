<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: daftar_siswa_keluar.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php echo form_open('tatausaha/daftarsiswakeluar','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
foreach($daftartahun->result_array() as $k)
{
echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
}
?>
</select></div></div>
<p class="text-center"><input type="submit" value="Tampilkan" class="btn btn-primary"></p>
</form>
<?php
if (!empty($thnajaran))
	{
?>
<table class="table table-striped table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td><strong>Kelas</strong></td><td><strong>Keterangan</strong></td></tr>
<?php
	$tsk = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran'");
	$nomor=1;
	foreach($tsk->result_array() as $dsk)
	{
		$nis = $dsk['nis'];
		$td = $this->db->query("select * from datsis where nis='$nis'");
		foreach($td->result_array() as $dd)
		if ($dd['ket'] != 'Y')
			{
			echo '<tr><td>'.$nomor.'</td><td>'.$dd['nis'].'</td><td>'.$dd['nama'].'</td><td>'.$dd['kdkls'].'</td><td>'.$dd['ket'].'</td></tr>';
			$nomor++;
			}
	}

	echo '</table>';
	}
?>
</div></div></div>
