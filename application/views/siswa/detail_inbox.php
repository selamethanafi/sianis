<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: detail_inbox.php
// Lokasi      		: application/views/siswa/
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
<?php echo form_open('siswa/balasinbox','class="form-horizontal" role="form"');?>
<?php
foreach($detail->result_array() as $isi)
{
echo'<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Subjek Pesan</label></div>
	<div class="col-sm-9"><input type="text" name="subjek" value="'.$isi["subjek"].'" readonly="readonly" class="form-control"></div>
     </div>';
echo'<div class="form-group row"><div class="col-sm-3"><label class="control-label">Dari</label></div><div class="col-sm-9"><p class="form-control-static">'.$isi["nama"].'</p></div></div>';
$pesanasli =''.$isi["pesan"].'<br />';
echo'<div class="form-group row"><div class="col-sm-3"><label class="control-label">Riwayat Percakapan</label></div>
	<div class="col-sm-9"><p class="form-control-static">'.$pesanasli.'<input type="hidden" name="pesanasli" value="'.$pesanasli.'"></div></div>';
echo'<div class="form-group row"><div class="col-sm-3"><label class="control-label">Isi Pesan</label></div><div class="col-sm-9"><p class="form-control-static"><textarea name="pesan" rows="2" class="form-control"></textarea></div></div>';
echo'<p class="text-center"><input type="submit" value="Kirim Pesan ke '.$isi["nama"].'" class="btn btn-primary"><input type="hidden" name="tujuan" value="'.$isi["username"].'"><input type="hidden" name="username" value="'.$isi["tujuan"].'"><input type="hidden" name="id_inbox" value="'.$isi["id_inbox"].'"></p>';
}
?>
</form>
</div></div></div>
