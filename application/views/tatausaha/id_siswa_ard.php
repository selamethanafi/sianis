<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 10 Nov 2014 04:24:41 WIB 
// Nama Berkas 		: unggah_foto.php
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
if(isset($sukses))
{
	echo '<div class="alert alert-success">Proses unggah kode siswa dari ARD sukses.</div>';
}
else
{
echo form_open_multipart('tatausaha/unggahidsiswaard','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile" class="textfield"></p></div></div>
<p class="text-center"><input type="submit" value="Unggah Berkas" class="btn btn-primary"></p></form>
<?php
}
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$no = 1;
	echo '<table class="table table-striped table-hover table-bordered"><tr align="center"><td>Kelas</td><td>Nomor</td><td>NIS</td><td>Nama</td><td>NISN</td><td>ID ARD</td></tr>';
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'  order by `kelas`, `no_urut`");
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		echo '<tr><td>'.$a->kelas.'</td><td>'.$no.'</td><td>'.$nis.'</td>';
		$tb = $this->db->query("select `nama`, `nis`, `nisn`, `id_ard_siswa` from `datsis` where `nis`='$nis'");
		foreach($tb->result() as $b)
		{
			echo '<td>'.$b->nama.'</td><td>'.$b->nisn.'</td><td>'.$b->id_ard_siswa.'</td>';
		}
		echo '</tr>';
		$no++;
	}
	echo '</table>';
?>
</div></div></div>

