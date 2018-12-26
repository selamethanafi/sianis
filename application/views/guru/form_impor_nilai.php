<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: form_impor_nilai.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/daftarnilai/<?php echo $id_mapel;?>"><b> Kembali</b></a></p>
<table width="100%">
<tr><td width="40%"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td><strong>Penilaian</strong></td><td>: <strong><?php echo $itemnilai;?></strong></td></tr>
<tr><td><strong>KKM Mapel</strong></td><td>: <strong><?php echo $kkm;?></strong></td></tr>
<tr><td><strong>KKM Ulangan</strong></td><td>: <strong><?php echo $kkm_ulangan;?></strong></td></tr>
</table>
<?php echo form_open_multipart('guru/prosesunggahnilai','class="form-horizontal" role="form"');?>
<strong>Proses ini akan memutakhirkan daftar nilai sesuai data unggahan</strong>
<div class="alert alert-info">format data<p>
<?php
if($sumber == 'pemindai')
{
	echo '"Nomor_Peserta","Score';
}
else
{
	echo '"nis","nilai';
}
?>
"</p></div>
 <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="userfile"></p></div></div>
<p class="text-center"><input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>">
<input type="hidden" name="kkm_ulangan" value="<?php echo $kkm_ulangan;?>">
<input type="hidden" name="itemnilai" value="<?php echo $itemnilai;?>">
<input type="hidden" name="sumber" value="<?php echo $sumber;?>">
<input type="submit" value="Kirim Berkas" class="btn btn-primary"></p></form>
</div></div></div>
