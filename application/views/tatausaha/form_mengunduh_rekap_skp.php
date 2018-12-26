<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 08 Jan 2016 12:50:40 WIB 
// Nama Berkas 		: form_mencetak_skp.php
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$xloc = base_url().'tatausaha/unduhrekapppk/';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">';
echo 'Tahun Penilaian</label></div><div class="col-sm-9"><p class="form-control-static">';
echo "<select name=\"tahunpenilaian\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"textfield-option\">";
echo '<option value="'.$tahun.'">'.$tahun.'</option>';
$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
foreach($ta->result() as $a)
{
	$xtahun = substr($a->thnajaran,0,4);
echo '<option value="'.$xloc.''.$xtahun.'">'.$xtahun.'</option>';
}
echo '</select></p></div></div>';
echo '</form>';
?>
</div></div></div>
