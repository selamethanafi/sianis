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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
echo form_open_multipart('tatausaha/updatefotosiswa','class="form-horizontal" role="form"');
?>
<?php
if (empty($nis))
	{
	echo '<div class="alert alert-info">Galat! Siswa tidak ditemukan</div>';
	}
else
{
if (count($query->result())>0) 
{
	foreach($query->result() as $t)
	{
		if (!empty($t->foto))
			{
			$fotone = ''.base_url().$this->config->item('folderfotosiswa').'/'.$t->foto.'';
			echo '<p class="text-center"><img src="'.$fotone.'" height="200" alt="foto siswa"></p>';
			}

	?>
     <div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $t->nis;?></p></div>
  	</div>
     <div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Nama Siswa</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo nis_ke_nama($t->nis);?></p></div>
	</div>
     <div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Berkas</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><input type="file" name="userfile"></p></div>
	</div>
	<p class="text-center"><input type="submit" value="Unggah Foto" class="btn btn-primary"> <a href="<?php echo base_url();?>tatausaha/carisiswa" class="btn btn-info">Batal</a></p>
	<input type="hidden" name="nis" value="<?php echo $t->nis;?>">
		
		<?php
	}
}
}
?>
</form>
</div>

