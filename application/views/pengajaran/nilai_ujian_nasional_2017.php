<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: nilai_ujian_nasional.php
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php
echo $keterangan;
if(empty($nis))
{
	$xloc = base_url().'pengajaran/nilaiujiannasional';
}
else
{
	$xloc = base_url().'pengajaran/nilaiujiannasional/'.$tahun;
}

echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9"><select name="tahun" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div>';
	
if (!empty($nis))
{?>
	
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Semester</label></div>
		<div class="col-sm-9"><input type="text" name="semester" class="form-control" value="<?php echo $semester;?>"></div></div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Siswa</label></div><div class="col-sm-9">
		<select name="nis" class="form-control">
		<?php
			$tb = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and `nis`='$nis'");
		$kelas = '';
		foreach($tb->result() as $b)
		{	
			$kelas = $b->kelas;
		}
		$program = kelas_jadi_program($kelas);
		$namasiswa = nis_ke_nama($nis);
		echo '<option value="'.$nis.'">'.$namasiswa.'</option>';
		echo '</select></div></div>	';
	echo '<table class="table table-hover table-bordered table-striped">';
	echo '<tr align="center"><td>Mapel</td>';
	//cari mapel un
	$tc = $this->db->query("select * from `mapel_un` where `thnajaran`='$thnajaran' and `program`='$program' order by no_urut");
	$cacah_mapel = $tc->num_rows();
	foreach($tc->result() as $c)
	{
		$mapel = $c->mapel;
		$no_urut = $c->no_urut;
		// masukkan ke daftar nilai siswa
		$td = $this->db->query("select * from `nilai_un` where `nis`='$nis' and `mapel`='$mapel'");
		if($td->num_rows()==0)
		{
			$this->db->query("insert into `nilai_un` (`nis`,`mapel`,`no_urut`) values ('$nis','$mapel','$no_urut')");
		}
		echo '<td align="center">'.$mapel.'</td>';
	}
	//judul mapel
	//ujian nasional
	echo '</tr><tr align="center"><td>Nilai</td>';
	$nomor = 1;
	$te = $this->db->query("select * from `nilai_un` where `nis`='$nis' order by no_urut");	
	foreach($te->result() as $e)
	{
		echo '<td width="15%"><input type="text" name="un_'.$nomor.'" value="'.$e->un.'" class="form-control"></td>';
		$nomor++;
	}
	echo '</tr></table>';
	echo '<p class="text-center"><input type="hidden"  name="cacah_mapel" value="'.$cacah_mapel.'"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/nilaiujiannasional" class="btn btn-info"><b>Batal</b></a></p></form>';
}
else
{
	?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Semester</label></div>
		<div class="col-sm-9"><input type="text" name="semester" class="form-control" value="<?php echo $semester;?>"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><select name="nis" onChange="MM_jumpMenu('self',this,0)" class="form-control">
	<?php
	echo '<option value="">Pilih siswa</option>';
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='2' and kelas like 'XII-%' order by nis");
	foreach($ta->result() as $a)
	{
		
		$namasiswane = nis_ke_nama($a->nis);
		echo '<option value="'.$xloc.'/'.$tahun.'/'.$a->nis.'">'.$namasiswane.'</option>';
	}
	echo '</select></div></div>';
	echo '<p class="text-center"><a href="'.base_url().'pengajaran/nilaiujiannasional" class="btn btn-info"><b>Batal</b></a></p>';
}
echo '</form>';
?>
</div>


