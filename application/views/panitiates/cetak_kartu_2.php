<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: cetak_kartu.php
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
<?php echo form_open('pdf_kartu_tes/kartu','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><input type="hidden" name="semester" value="<?php echo $semester;?>"><?php echo $semester;?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Tes</label></div><div class="col-sm-9">
<select name="id_nama_tes" class="form-control">
<?php
$daftar_kelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");

foreach($daftar_tes->result_array() as $k)
{
echo "<option value='".$k["id_nama_tes"]."'>".$k["nama_tes"]."</option>";
}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
<select name="kelas" class="form-control">

<?php
foreach($daftar_kelas->result_array() as $ka)
{
echo "<option value='".$ka["kelas"]."'>".$ka["kelas"]."</option>";
}
?>
</select></div></div>
<p class="text-center"><input type="submit" value="Cetak Kartu" class="tombol"></p>
</table>
</form>
</div></div></div>
