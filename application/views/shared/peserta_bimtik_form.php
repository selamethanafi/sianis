<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_emiss.php
// Lokasi      		: application/views/shared/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<?php
echo '<h2>Unduh Data Bimbingan TIK</h2>';
$xloc = base_url().'tatausaha/pesertabimtik';
$kelasx ='';
$adamapel = 0;
//thnajaran
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$thnajaran.'</p></div></div>';
//semester
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">'.$semester.'</p></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_walikelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	echo '<option value=""></option>';
foreach($td->result() as $d)
{
	$id_kelasx = $d->id_walikelas;
	$kelasx = $d->kelas;
	echo '<option value="'.$xloc.'/'.$id_kelasx.'">'.$kelasx.'</option>';
}
echo '</select></div></div>';
echo '</form>';
?>
</div></div></div>
