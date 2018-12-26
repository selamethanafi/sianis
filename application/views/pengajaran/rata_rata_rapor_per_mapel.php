<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_ijazah.php
// Lokasi      		: application/views/pengajaran/
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
$thnajaran = cari_thnajaran();
$tb = $this->db->query("select * from `m_mapel` where `id_mapel` = '$id_mapel'");
$kelas = '';
$mapel = '';
foreach($tb->result() as $b)
{
	$kelas = $b->kelas;
	$mapel = $b->mapel;
}
$xloc = base_url().'pengajaran/rataraporpermapel';
$tb = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%' order by `mapel`");
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mapel Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$id_mapel.'">'.$mapel.' '.$kelas.'</option>';
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$xloc.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select></div></div></form>';
	echo '<h2>'.$mapel.' '.$kelas.'</h2>';
	echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr  align="center"><td>Nomor</td><td>NIS</td><td>Nama</td><td>Rata - rata Rapor</td></tr>';
	$nomor = 1;
	$tb = $this->db->query("select `nis`, `thnajaran`, `kelas`, `semester`, `rata_rapor`, `status`, `no_urut` from `nilai` where `thnajaran`='$thnajaran' and `kelas`= '$kelas' and `mapel`='$mapel' and status='Y' and `semester`='2' order by no_urut ASC");
	foreach($tb->result() as $b)
	{
		$nis = $b->nis;
		echo '<tr><td  align="center">'.$nomor.'</td><td  align="center">'.$nis.'</td><td>'.nis_ke_nama($nis).'</td>';
		echo '<td align="center">'.$b->rata_rapor.'</td>';
		echo '</tr>';
		$nomor++;
	}
	echo '</table></div>';

?>
</div></div></div>
