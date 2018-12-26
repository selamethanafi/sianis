<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: status_ketuntasan.php
// Lokasi      		: application/views/guru
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
<?php
$token = md5($this->config->item('awalttd'));
$url_ppdb = $url_ppdb.'/tukardata/unduh/'.$token.'/'.$nomor;
$dataxml = simplexml_load_file($url_ppdb);
$nis ='?';
$cacah = '?';
foreach($dataxml->data as $a)
{
	$cacah = $a->cacah;
	$nis = $a->nis;
}
if($nisterakhir == $nis)
{
	echo '<p>Untuk melanjutkan pengunduhan data dari web ppdb, klik <a href="'.base_url().'ambilppdb/unduh">disini</a></p>';
}
else
{
	echo '<h4>Galat, nis awal tidak cocok. NIS baru di web ini '.$nisterakhir.' dan di web ppdb '.$url_ppdb.' : '.$nis.'</h4>';
	echo '<p>Sudah pernah mengambil data dari web? bila sudah pernah, klik <a href="'.base_url().'ambilppdb/unduhlagi">disini</a></p>';
	echo '<p>Bila belum perbarui data nis di web ppdb</p>';
}
?>
</div></div></div>
