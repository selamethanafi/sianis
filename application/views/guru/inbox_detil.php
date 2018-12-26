<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: inbox_detil.php
// Lokasi      		: application/views/guru/
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
<p><a href="<?php echo base_url(); ?>guru/inbox" class="btn btn-info"><b>Kembali ke Inbox</b></a></p>
<?php echo form_open('guru/balasinbox','class="form-horizontal" role="form"');?>
<?php
foreach($detail->result_array() as $isi)
{
echo'<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Subjek Pesan</label></div><div class="col-sm-9"><input type="hidden" name="subjek" value="'.$isi["subjek"].'">'.$isi["subjek"].'</div></div>';
echo'<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Dari</label></div><div class="col-sm-9">'.$isi["nama"].'</div></div>';
$pesanasli = $isi["pesan"].'';
echo'<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Riwayat Percakapan</label></div><div class="col-sm-9">'.$pesanasli.'<input type="hidden" name="pesanasli" value="'.$pesanasli.'"></div></div>';
echo'<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Isi Pesan</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="pesan" rows="3" class="form-control"></textarea></div></div>';
echo'<p class="text-center"><input type="submit" value="Kirim Pesan ke '.$isi["nama"].'" class="btn btn-primary"><input type="hidden" name="tujuan" value="'.$isi["username"].'"><input type="hidden" name="username" value="'.$isi["tujuan"].'"><input type="hidden" name="id_inbox" value="'.$isi["id_inbox"].'"></p>';
}
?>
</form>
</div></div></div>
