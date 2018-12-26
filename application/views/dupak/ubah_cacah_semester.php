<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : skp_pkg.php
// Lokasi      : application/views/guru/
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
<?php
$ta = $this->db->query("select * from `skp_skor_guru_kedua` where `id_skp_skor_guru` = '$id_skp_skor_guru' and `nip` = '$nip'");
if($ta->num_rows() >0)
{ echo form_open('dupak/ubahcacahsemester','class="form-horizontal" role="form"');
	foreach($ta->result() as $a)
	{
		$kegiatan = $a->kegiatan;
		$cacah = $a->cacah;
	}
	?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kegiatan;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah Semester</label></div><div class="col-sm-9"><select name="cacah" class="form-control"><option value="<?php echo $cacah;?>"><?php echo $cacah;?></option><option value="1">1</option><option value="2">2</option></select></div></div><input type="hidden" name="id" value="<?php echo $id_skp_skor_guru;?>">
	<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="<?php echo base_url().'dupak/masa';?>" class="btn btn-info">Batal</a></p>
	</form>
<?php
}
else
{
	echo 'Galat, data tidak ditemukan';
}
echo '</div></div></div>';
