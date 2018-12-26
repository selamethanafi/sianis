<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kekurangan_siswa_per_kelas.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('keuangan/cetakkekurangansiswaperkelas','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div  class="col-sm-9"><input name="thnajaran" type="text" value="<?php echo $thnajaran;?>" class="form-control"></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div  class="col-sm-9"><input name="semester" type="text" value="<?php echo $semester;?>" class="form-control"></div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div  class="col-sm-9">
<select name="ruang" class="form-control">
<?php
	echo '<option value="'.$ruang.'">'.$ruang.'</option>';
$querykelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
foreach($querykelas->result() as $bc)
{
	echo '<option value="'.$bc->kelas.'">'.$bc->kelas.'</option>';
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Rinci</label></div><div  class="col-sm-9">
<select name="rinci" class="form-control">
<?php
	echo '<option value="Y">Ya</option>';
	echo '<option value="">Tidak</option>';
?>
</select></div></div>
<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary"></p>
</form>
</div></div></div>
