<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 25 Nov 2014 23:36:22 WIB 
// Nama Berkas 		: siswa.php
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
<?php echo form_open('panitiates/siswa','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" name="nama" class="form-control"></div></div>
<p class="text-center"><input type="submit" value="Cari Siswa" class="btn btn-primary"></p>
</form>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>NIS.</strong></td><td><strong>Nama</strong></td><td><strong>Status</strong></td></tr>
<?php
$nomor=1;
$ket='';
foreach($query->result() as $b)
{
		if ($b->ket=='Y')
			{
			$ket = 'Aktif';
			}
		if ($b->ket=='T')
			{
			$ket = 'Keluar';
			}
		if ($b->ket=='P')
			{
			$ket = 'Pindah';
			}
		if ($b->ket=='L')
			{
			$ket = 'Lulus';
			}

echo "<tr><td>".$nomor."</td><td>".$b->nis."</td><td>".$b->nama."</td><td>".$b->ket."
 ".$ket."</td></tr>";

$nomor++;
}
?>
</table></div>
</div></div></div>
