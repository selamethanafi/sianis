<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: impor_ekstra.php
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
<p class="help-block">Format Berkas CSV dengan judul kolom</p>
<p class="help-block">"thnajaran","semester","kelas","nis","nama","nama_ekstra","nilai","keterangan"</p>
<?php echo form_open_multipart('tatausaha/proses_impor_ekstra');?>
<label>Berkas</label><input type="file" name="csvfile"><p class="text-center"><p>
<input type="submit" value="Kirim Berkas" class="btn btn-primary" role="btn btn-primary"></p><form>
</div>
