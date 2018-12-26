<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : siswa_kelas.php
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
<p><a href="<?php echo base_url(); ?>keuangan/siswa" class="btn btn-info"><b>Cari Siswa</b></a></p>
<?php echo form_open('keuangan/siswakelas','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<select name="thnajaran" class="form-control">
<?php
echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
foreach($daftartahun->result_array() as $k)
{
echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<select name="semester" class="form-control">
<?php
echo "<option value='".$semester."'>".$semester."</option>";
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
<select name="kelas" class="form-control">
<?php
echo "<option value='".$kelas."'>".$kelas."</option>";
foreach($daftarkelas->result_array() as $ka)
{
echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
}
?>
</select></div></div>
<p class="text-center"><input type="submit" value="Tampilkan Daftar Siswa" class="btn btn-primary"></p>
</form>
<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td></tr>
<?php
$nomor=1;
foreach($daftarsiswa->result() as $b)
{
echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$b->nis.'</td><td>'.nis_ke_nama($b->nis).'</td></tr>';
$nomor++;
}
?>
</table></div>
</div></div></div>
