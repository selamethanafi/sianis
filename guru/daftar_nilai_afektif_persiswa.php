<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: daftar_nilai_afektif_persiswa.php
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
?><div class="container-fluid"><h2><?php $judulhalaman;?></h2>
<a href="<?php echo base_url(); ?>index.php/guru/daftarnilaiafektif/<?php echo $id_mapel;?>"><span class="glyphicon glyphicon-arrow-left"></span><b>Kembali</b></a>

<?php
if(!empty($id_afektif))
{
$query = $this->db->query("select * from afektif where `id_afektif`='$id_afektif'");
$namasiswa ='';
foreach($query->result() as $q)
	{
	$nis = $q->nis;
	}
$namasiswa = nis_ke_nama($nis);
$tap = $this->db->query("select * from aspek_afektif where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
$cacahitem = 0;
$dapnbaik = 0;
$dapnmax = 0;
$dapnamat = 0;
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
foreach($tap->result() as $dap)
	{
	$cacahitem = $dap->np;
	$dapnbaik = $dap->nbaik;
	$dapnmax = $dap->nmax;
	$dapnamat = $dap->namat;
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
	}
?>
<div class="table-responsive">
<table class="table">
<tr><td>Tahun Pelajaran.</td><td>: <strong><?php echo $thnajaran;?></strong></td></tr>
<tr><td>Semester</td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td>Kelas</td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td>Mata Pelajaran</td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<tr><td>Cacah Item Penilaian</td><td>: <strong><?php echo $cacahitem;?></strong></td></tr>
<tr><td>Nama</td><td>: <strong><?php echo $namasiswa;?></strong></td></tr>
</table></div>
<form class="form-horizontal" role="form" action="<?php echo base_url();?>guru/updatenilaiafektif" method="post">
<?php
$iteme = 1;
$nomor = 1;
do
{
	$ite = "p$iteme";
	$dite = "dapp$iteme";
	$nilaine = $q->$ite;
	if ($nilaine == 0)
			{$nilaine = round($dapnbaik,0);}
	if (!empty($$dite))
	{?>
	<div class="form-group row row">
		<div class="col-sm-4"><label for="<?php echo $dite;?>" class="control-label"><?php echo $$dite;?></label></div>
		<div class="col-sm-2" ><input type="text" name="p<?php echo $iteme.'_'.$nomor;?>" value ="<?php echo $nilaine;?>" class="form-control"></div>
	</div>
	<?php
	}
	$iteme++;
}
while ($iteme<15);
if($cacahitem>0)
{
echo '<input type="hidden" name="cacahitem"  value ='.$cacahitem.'><input type="hidden" name="id_afektif_'.$nomor.'"  value ='.$q->id_afektif.'><input type="hidden" name="cacah_siswa"  value ='.$nomor.'>';
?>
	<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
	<input type="hidden" name="semester" value="<?php echo $semester;?>">
	<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
	<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>">
	<input type="hidden" name="namat" value="<?php echo $dapnamat;?>">
	<input type="hidden" name="nmax" value="<?php echo $dapnmax;?>">
	<input type="hidden" name="nbaik" value="<?php echo $dapnbaik;?>">
	<input type="hidden" name="kurikulum" value="<?php echo $kurikulum;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN</button></p>
</form>
<?php
}
else
{
	echo '<div class="alert alert-warning">Belum ada indikator penilaian, tambah indikator penilaian <a href="'.base_url().'guru/aspekafektif/'.$id_mapel.'" class="btn btn-primary">di sini</a></div>';
}
}
?>
</div>
