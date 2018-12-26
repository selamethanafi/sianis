<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mutasi.php
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
<?php echo form_open('tatausaha/mutasi','class="form-horizontal" role="form"');
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><select name="id_p_pegawai" class="form-control">';
$tp = $this->db->query("select * from p_pegawai where status='Y' order by nama");
	echo '<option value="">Pilih pegawai</option>';
foreach($tp->result_array() as $dp)
	{
	echo '<option value="'.$dp["id_p_pegawai"].'">'.$dp["nama"].'</option>';
	}
$tp = $this->db->query("select * from p_pegawai where status='T' order by nama");
foreach($tp->result_array() as $dp)
	{
	echo '<option value="'.$dp["id_p_pegawai"].'">'.$dp["nama"].'</option>';
	}

	echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9"><select name="status" class="form-control">';
echo '<option value="T">Mutasi / Purnatugas</option>';
echo '<option value="Y">Aktif</option>';
echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Ubah Status Pegawai" class="btn btn-primary"></p>';
?>
</table>
</form>
<?php
echo "<h4>Daftar Pegawai Mutasi atau Purna</h4>";
echo '<table class="table table-striped table-hover table-bordered">';?>
<tr align="center"><td><strong>No.</strong></td><td><strong>NIP</strong></td><td><strong>Nama</strong></td></tr>
<?php
	$tsk = $this->db->query("select * from p_pegawai where status='T'");
	$nomor=1;
	foreach($tsk->result_array() as $dsk)

	{
		echo '<tr><td>'.$nomor.'</td><td>'.$dsk['nip'].'</td><td>'.$dsk['nama'].'</td></tr>';
			$nomor++;
	}
	echo '</table>';
?>
</div></div></div>

