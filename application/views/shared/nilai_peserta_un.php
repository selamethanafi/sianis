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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
$xloc = base_url().''.$status.'/nilaipesertaun';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
echo "<select name=\"thnajaran\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$thnajaran.'">'.$thnajaran.'</option>';
foreach($daftar_tapel->result_array() as $k)
{
	echo '<option value="'.$xloc.'/'.$k['thnajaran'].'">'.$k['thnajaran'].'</option>';
}
echo '</select></div></div>';
?>
</form>
<table class="table table-hover table-striped table-bordered"><tr align="center"><td>Kelas</td><td colspan="7">Halaman</td></tr>
<?php
$ta = $this->db->query("select * from m_walikelas where `kelas` like 'XII-%' and `thnajaran`='$thnajaran' and `semester`='2' order by `kelas`");
foreach($ta->result() as $a)
{
	echo '<tr align="center"><td>'.$a->kelas.'</td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/1" target="_blank">1</a></td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/2" target="_blank">2</a></td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/3" target="_blank">3</a></td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/4" target="_blank">4</a></td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/5" target="_blank">5</a></td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/6" target="_blank">6</a></td><td><a href="'.$xloc.'/'.$thnajaran.'/'.$a->id_walikelas.'/7" target="_blank">7</a></td></tr>';
}
?>
</table>
</div>
