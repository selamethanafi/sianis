<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : set.php
// Lokasi      : application/views/keuangan
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
if($baris >0)
{
	$where = $record;
//	$where = ' `id_bayar = \''.$record.'\'';
	$where = preg_replace("/x/","' or `id_bayar`='", $where);
	$where = '`id_bayar`=\''.$where.'\'';
	echo $where;
}
else
{

	$xloc = base_url().'keuangan/buku/'.$nis.'/'.$tahun1.'/'.$semester.'/'.$record;
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cetak mulai baris ke-</label></div><div class="col-sm-9">
	<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	for($i=0;$i<=20;$i++)
	{
		echo '<option value="'.$xloc.'/'.$i.'">'.$i.'</option>';
	}
	?>
	</select></div></div></form>
<?php

}
?>
</div></div></div>
