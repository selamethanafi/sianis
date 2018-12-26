<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: piket.php
// Lokasi      		: application/views/pengajaran/
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
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

	<?php echo form_open('pengajaran/piket','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<?php echo "<strong>$thnajaran</strong>";?>
	</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">
	<?php echo "<strong>$semester</strong>";?>
	</p></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9">
	<select name="kode_guru" class="form-control">
	<?php
	echo "<option value=''></option>";
	foreach($daftar_guru->result_array() as $ka)
	{
	echo "<option value='".$ka["kd"]."'>".$ka["nama"]."</option>";
	}
	?>
	</select></div></div>
	<?php
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Hari Piket</label></div><div class="col-sm-9"><select name="hari" class="form-control">
	<option value=""></option>
	<option value="Monday">Senin</option>
	<option value="Tuesday">Selasa</option>
	<option value="Wednesday">Rabu</option>
	<option value="Thursday">Kamis</option>
	<option value="Friday">Jumat</option>
	<option value="Saturday">Sabtu</option>
	</select></div></div>';
	?>
	<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p></form><br>
	<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama</strong></td><td><strong>Hari Piket</strong></td></tr>
<?php
$nomor=1;
$tb = $this->db->query("select * from guru_piket where thnajaran='$thnajaran' and semester = '$semester' order by urutan_hari");
if(count($tb->result())>0)
{
	foreach($tb->result() as $b)
	{
	$nama = cari_nama_pegawai($b->kodeguru);
	$harine = day_to_hari($b->hari);
echo "<tr><td align=\"center\">".$nomor."</td><td>".$nama."</td><td align=\"center\">".$harine."</td></tr>";
$nomor++;
	}
}
?>
</table></div>
</div></div></div>
