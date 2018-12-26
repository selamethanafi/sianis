<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : pengumuman_tambah.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2009-2013 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/pengumuman/tampil" class="btn btn-info">Batal</a></p>
<?php echo form_open('guru/pengumuman/tampil','class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Judul</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Isi</label></div>
<div class="col-sm-12"><textarea name="isi" rows="10" class="form-control"></textarea></div>
</div>
<p class="text-center"><input type="submit" value="Simpan Pengumuman" class="btn btn-primary"></div>
</form>
</div></div></div>

