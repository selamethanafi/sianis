<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : siswa_kelas.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$xloc = base_url().'keuangan/kartupembayaran';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($lembar))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Halaman</label></div><div class="col-sm-9"><p class="form-control-static"><input name="lembar" type="text" value="<?php echo $lembar;?>" class="form-control" readonly></p></div></div>
	<?php
}

if(!empty($tahun1))
{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc;?>">Tahun Pelajaran</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="tahun" type="text" value="<?php echo $thnajaran;?>" class="form-control" readonly></p></div></div>
	<?php
}
if(!empty($semester))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc.'/'.$tahun1;?>">Semester</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="semester" type="text" value="<?php echo $semester;?>" class="form-control" readonly></p></div></div>
	<?php
}
if(!empty($id_walikelas))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc.'/'.$tahun1.'/'.$semester;?>">Kelas</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="id_walikelas" type="text" value="<?php echo $kelas;?>" class="form-control" readonly></p></div></div>
	<?php
}
if(!empty($nis))
{
	if($nis=='semua')
	{
		$namasiswa = 'semua siswa';
	}
	else
	{
		$namasiswa = nis_ke_nama($nis);
	}

	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo $xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas;?>">Semua atau Siswa</a></label></div><div class="col-sm-9"><p class="form-control-static"><input name="nis" type="text" value="<?php echo $namasiswa;?>" class="form-control" readonly></p></div></div>
	<?php
}

if(empty($tahun1))
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="tahun1" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo "<option value=''></option>";
	foreach($daftartahun->result() as $k)
	{
	echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	?>
	</select></div></div>
<?php
}
elseif(empty($semester))
{?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	?>
	</select></div></div>
<?php
}
elseif(empty($id_walikelas))
{
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by kelas");
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="id_walikelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value=""></option>';
	foreach($ta->result() as $a)
	{
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
	}
	?>
	</select></div></div>
	<?php
}
elseif(empty($nis))
{
	$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semua atau Siswa</label></div><div class="col-sm-9">
	<select name="nis" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/semua">semua</option>';
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/'.$b->nis.'">'.nis_ke_nama($b->nis).'</option>';
	}
	?>
	</select></div></div>
	<?php
}
else
{
	?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Halaman</label></div><div class="col-sm-9">
	<select name="lembar" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo "<option value=''></option>";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/'.$nis.'/depan">depan</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_walikelas.'/'.$nis.'/belakang">belakang</option>';
	?>
	</select></div></div>
	<?php
}
?>

</form>
</div></div></div>
