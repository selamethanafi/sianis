<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: urut_kelas.php
// Lokasi      		: application/views/panitiates/
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
if(isset($info))
{
	echo $info;
}
?>
<form class="form-horizontal" role="form">
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?></p></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
</form>
<?php
echo form_open('panitiates/urutankelas','class="form-horizontal" role="form"');?>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr><td width="30"><strong>No.</strong></td><td><strong>Kelas</strong></td><td><strong>Nomor Urut</strong></td></tr>
<?php
$query = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `no_urut`");
$cacahkelas= $query->num_rows();
$nomor=1;
$ket='';
foreach($query->result() as $b)
{
	echo '<tr><td>'.$nomor.'</td><td>'.$b->kelas.'</td><td><input type="text" name="no_urut_'.$nomor.'" value="'.$b->no_urut.'" class="form-control"><input type="hidden" name="id_walikelas_'.$nomor.'" value="'.$b->id_walikelas.'"></td></tr>';
$nomor++;
}
?>
</table></div>
<input type="hidden" name="cacahkelas" value="<?php echo $cacahkelas;?>"><p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p></form>
</div></div></div>
