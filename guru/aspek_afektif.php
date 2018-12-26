<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: aspek_afektif.php
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
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
$kurikulum=cari_kurikulum($thnajaran,$semester,$kelas);
?>
<form class="form-horizontal" role="form" action="<?php echo base_url().'guru/updateaspekafektif/'.$id_mapel;?>" method="post">
    <div class="form-group row row">
		<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
		<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?></p></div>
		<div class="col-sm-3"><label for="kelas" class="control-label">Kelas</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $kelas;?></p></div>
		<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $mapel;?></p></div>
    </div>
<?php
$nmax = 5;
$namat = 4;
$nbaik = 3;
$nomor = 0;
do
{
	$item = $nomor+1;
	$iteme2 = "s".$item;
	$dapiteme2 = $dtmapel->$iteme2;
	if(empty($dapiteme2))
	{
		if($item == 1)
		{
			$dapiteme2 = 'menghargai dan menghayati ajaran Islam';
		}
		if($item == 2)
			{
			$dapiteme2 = 'jujur';
			}
		if($item == 3)
			{
			$dapiteme2 = 'disiplin';
			}
		if($item == 4)
			{
			$dapiteme2 = 'tanggung jawab';
			}
		if($item == 5)
			{
			$dapiteme2 = 'toleransi';
			}
		if($item == 6)
			{
			$dapiteme2 = 'gotong royong';
			}
		if($item == 7)
			{
			$dapiteme2 = 'santun atau sopan';
			}
		if($item == 8)
			{
			$dapiteme2 = 'percaya diri';
			}


		}
	echo '<div class="form-group row row">
		<div class="col-sm-4"><label for="Penilaian_Afektif_'.$item.'" class="control-label">Penilaian Sikap '.$item.'</label></div>
		<div class="col-sm-8" ><textarea name="p'.$item.'" class="form-control" rows="2">'.$dapiteme2.'</textarea></div>
	</div>';
	$nomor++;
}
while ($nomor<15);
echo'
<p class="text-center"><button type="submit" class="btn btn-primary">Simpan</button></p>
</form>';
?>

</div>
