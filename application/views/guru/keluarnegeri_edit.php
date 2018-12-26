<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : keluarnegeri_edit.php
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
<p><a href="<?php echo base_url(); ?>guru/keluarnegeri" class="btn btn-info"><b>Kembali ke Daftar Keluar Negeri</b></a></p>
<?php echo form_open('guru/updatedatakeluarnegeri','class="form-horizontal" role="form"');
foreach($query->result() as $t)
	{
	echo '
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Pegawai</label></div><div class="col-sm-9"><p class="form-control-static">'.$nama.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIP</label></div><div class="col-sm-9"><p class="form-control-static">'.$nip.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Negara Tujuan</label></div><div class="col-sm-9"><input type="text" name="negara" value="'.$t->negara.'" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tujuan Kunjungan</label></div><div class="col-sm-9"><input type="text" name="tujuan_kunjungan" value="'.$t->tujuan_kunjungan.'" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Lama</label></div><div class="col-sm-9"><input type="text" name="lama" value="'.$t->lama.'" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Yang Membiayai</label></div><div class="col-sm-9"><input type="text" name="pembiaya" value="'.$t->pembiaya.'" class="form-control"></div></div>';
	}
	
?>
<input type="hidden" name="kd" value="<?php echo $kd;?>">
<input type="hidden" name="id" value="<?php echo $id;?>">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
</div></div></div>
