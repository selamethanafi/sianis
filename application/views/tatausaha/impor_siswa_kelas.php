<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: impor_siswa_kelas.php
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
<div class="container-fluid"><h3>Modul Impor Daftar Siswa per Kelas</h3>
<div class="alert alert-info">
<p>format data</p>
<p>
"thnajaran","semester","kelas","no_urut","nis","nama","status"
</p>
<?php echo form_open_multipart('tatausaha/proses_impor_siswa_kelas');?>
</div>
<div class="form-group row row">
	<label for="berkas" class="col-sm-3 control-label">Berkas (format csv)</label>
		<div class="col-sm-9" ><input type="file" name="userfile" class="textfield"></div>
	</div>
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>
</div>
