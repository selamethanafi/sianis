<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: nilai_peserta_un.php
// Lokasi      		: application/views/tatausaha/
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
$xloc = base_url().''.$status.'/nilaiuambn';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="card">
    <div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="card-body">
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
echo "<select name=\"thnajaran\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$thnajaran.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result_array() as $k)
{
	echo '<option value="'.$xloc.'/'.$k['thnajaran'].'">'.$k['thnajaran'].'</option>';
}
echo '</select></div></div>';
?>
</div></div></form>
<table class="table table-hover table-striped table-bordered"><tr align="center"><td>Kelas</td><td>Unduh</td></tr>
<?php
$ta = $this->db->query("select * from m_walikelas where `kelas` like 'XII-%' and `thnajaran`='$thnajaran' and `semester`='2' order by `kelas`");
foreach($ta->result() as $a)
{
	echo '<tr align="center"><td>'.$a->kelas.'</td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/unduh" target="_blank">Unduh</a></td></tr>';
}
?>
</table>
</div>
