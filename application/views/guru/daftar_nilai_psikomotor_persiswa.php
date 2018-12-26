<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_psikomotor_persiswa.php
// Terakhir diperbarui	: Rab 11 Mei 2016 22:34:04 WIB 
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
?><div class="container-fluid"><h2>Modul Penilaian Psikomotor Per Siswa</h2>
<a href="<?php echo base_url(); ?>index.php/guru/daftarnilaipsikomotor/<?php echo $id_mapel;?>" class="btn btn-success"><b>Kembali</b></a>

<?php
if(!empty($id_psikomotor))
{
$mapelnilai = '?';
$tap = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
$cacahitem = 0;
foreach($tap->result() as $dap)
{
	$cacahitem = $dap->np;
	$mapel = $dap->mapel;
}

$query = $this->db->query("select * from `nilai` where `kd`='$id_psikomotor'");
$namasiswa ='';
$terkunci = '';
foreach($query->result() as $q)
{
	$nis = $q->nis;
	$terkunci = $q->kunci;
	$mapelnilai = $q->mapel;
}
if($terkunci == 1)
{
	echo '<h1>terkunci</h2>';
}
elseif($mapel != $mapelnilai)
{
	echo 'Galat, mapel tidak sama';

}
else
{
$namasiswa = nis_ke_nama($nis);
$dapp1 = '';
$dapp2 = '';
$dapp3 = '';
$dapp4 = '';
$dapp5 = '';
$dapp6 = '';
$dapp7 = '';
$dapp8 = '';
$dapp9 = '';
$dapp10 = '';
$dapp11 = '';
$dapp12 = '';
$dapp13 = '';
$dapp14 = '';
$dapp15 = '';
$dapp16 = '';
$dapp17 = '';
$dapp18 = '';
$cacahitem = 1;
foreach($tap->result() as $dap)
	{
	$cacahitem = $dap->np;
	$dapp1 = $dap->p1;
	$dapp2 = $dap->p2;
	$dapp3 = $dap->p3;
	$dapp4 = $dap->p4;
	$dapp5 = $dap->p5;
	$dapp6 = $dap->p6;
	$dapp7 = $dap->p7;
	$dapp8 = $dap->p8;
	$dapp9 = $dap->p9;
	$dapp10 = $dap->p10;
	$dapp11 = $dap->p11;
	$dapp12 = $dap->p12;
	$dapp13 = $dap->p13;
	$dapp14 = $dap->p14;
	$dapp15 = $dap->p15;
	$dapp16 = $dap->p16;
	$dapp17 = $dap->p17;
	$dapp18 = $dap->p18;
	$cacahitem = $dap->np;
	}
?>
<form class="form-horizontal" role="form">
    <div class="form-group row row">
		<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
		<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?></p></div>
		<div class="col-sm-3"><label for="kelas" class="control-label">Kelas</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $kelas;?></p></div>
		<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $mapel;?></p></div>
		<div class="col-sm-3"><label for="cacahitempenilaian" class="control-label">Cacah kriteria penilaian</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $cacahitem;?></p></div>
		<div class="col-sm-3"><label for="namasiswa" class="control-label">Nama Siswa</label></div>
		<div class="col-sm-9" ><p class="form-control-static"><?php echo $namasiswa;?></p></div>

    </div>
</form>
<form class="form-horizontal" role="form" action="<?php echo base_url().'guru/updatenilaipsikomotor/'.$id_mapel;?>" method="post">
<?php
$iteme = 1;
$nomor = 1;
do
{
	$ite = "p$iteme";
	$dite = "dapp$iteme";
	$nilaine = $q->$ite;
	if (!empty($$dite))
	{?>
	<div class="form-group row row">
		<div class="col-sm-9"><label for="<?php echo $$dite;?>" class="control-label"><?php echo $$dite;?></label></div>
		<div class="col-sm-3" ><input type="number" name="<?php echo 'p'.$iteme.'_'.$nomor;?>" value ="<?php echo $nilaine;?>" class="form-control">
		</div>
	</div>
	<?php
	}
	$iteme++;
}
while ($iteme<19);
echo '<input type="hidden" name="cacahitem"  value ='.$cacahitem.'><input type="hidden" name="kd_'.$nomor.'"  value ='.$q->kd.'><input type="hidden" name="cacah_siswa"  value ='.$nomor.'>';
?>
	<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
	<input type="hidden" name="semester" value="<?php echo $semester;?>">
	<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
	<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Nilai</button></p>
</form>
<?php
}
}
?>
</div>
