<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: ekstrawajib.php
// Lokasi      		: application/views/tatausaha
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
<div class="container-fluid"><h2>Modul Ekstrakurikuler Wajib</h2>
<?php
$xloc = base_url().'tatausaha/ekstrawajib';
echo form_open($xloc,'class="form-horizontal" role="form"');?>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9" ><select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div>
</div>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Semester</label></div>
<div class="col-sm-9" ><select name="semester" class="form-control">
<?php
echo "<option value='".$semester."'>".$semester."</option>";
?>
</select></div>
</div>
<div class="form-group row row">
<div class="col-sm-3"><label class="control-label">Nama Ektrakurikuler</label></div>
<div class="col-sm-9" ><select name="namaekstra" onChange="MM_jumpMenu('self',this,0)" class="form-control" required>
<?php
echo "<option value=''>pilih ekstra wajib</option>";
foreach($daftar_nama_ekstra_wajib->result() as $kb)
{
	echo '<option value="'.$xloc.'/'.$kb->id_ekstra.'">'.$kb->namaekstra.'</option>';

}
?>
</select></div>
</div>
<p class="text-center"><input type="submit" value="Proses" class="btn btn-primary" role="button"></p>
</form>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama Ekstrakurikuler</strong></td><td><strong>Kelas</strong></td><td><strong>Hapus</strong></td></tr>
<?php
$nomor=1;
foreach($data_ekstra_wajib->result() as $b)
{
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->namaekstra."</td><td  align=\"center\">".$b->kelas."</td><td  align=\"center\"><a href='".base_url()."tatausaha/ekstrawajib/hapus/".$b->id_ekstra_wajib."' onClick=\"return confirm('Anda yakin ingin menghapus data ".$b->namaekstra." ".$b->kelas." ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></td></tr>";
$nomor++;
}
?>

</table>
</form>


</div>
