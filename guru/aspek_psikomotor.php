<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: aspek_psikomotor.php
// Terakhir diperbarui	: Rab 11 Mei 2016 21:15:59 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
foreach($tmapel->result() as $dtmapel)
{
	$kelas = $dtmapel->kelas;
	$mapel = $dtmapel->mapel;
	$thnajaran = $dtmapel->thnajaran;
	$semester= $dtmapel->semester;
}
if ((empty($mapel)) or (empty($thnajaran)) or (empty($semester)) or (empty($kelas)))
{
	echo '<div class="alert alert-danger"><strong>Peringatan!</strong> Mata pelajaran dimaksud tidak ada, tidak boleh disunting, atau Anda tidak mengampu mata pelajaran ini. Hubungi Pengajaran.</div>';
}
else
{
?>
<form class="form-horizontal" role="form" action="<?php echo base_url().'guru/updateaspekpsikomotor/'.$id_mapel;?>" method="post">
	<div class="form-group row row">
		<div class="col-sm-4"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-8" ><input disabled type="text" value="<?php echo $thnajaran;?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4"><label for="semester" class="control-label">Semester</label></div>
		<div class="col-sm-8" ><input disabled type="text" value="<?php echo $semester;?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4"><label for="kelas" class="control-label">Kelas</label></div>
		<div class="col-sm-8" ><input disabled type="text" value="<?php echo $kelas;?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-4"><label for="mapel" class="control-label">Mata pelajaran</label></div>
		<div class="col-sm-8" ><input disabled type="text" value="<?php echo $mapel;?>" class="form-control"></div>
	</div>
<?php
$tap = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel' and `kodeguru`='$nim'");
$nomor = 0;
foreach($tap->result() as $dap)
{
	do
	{
	$item = $nomor+1;
	$iteme2 = "p".$item;
	echo '<div class="form-group row row">
		<div class="col-sm-4"><label for="Penilaian_Psikomotor_'.$item.'" class="control-label">Penilaian Psikomotor '.$item.'</label></div>
		<div class="col-sm-8" ><textarea name="p'.$item.'" class="form-control" rows="2">'.$dap->$iteme2.'</textarea></div>
	</div>';
	$nomor++;
	}
	while ($nomor<18);
}
echo '<p class="text-center"><button type="submit" class="btn btn-primary">Simpan</button></p>';
?>
</form>
<?php
}//akhir berhak
?>
</div>
