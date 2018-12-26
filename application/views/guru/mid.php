<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: lck.php
// Lokasi      		: application/views/guru/
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
?>
<?php
if($kkm_mid == 0)
{
	$kkm_mid = $kkm;
}
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url();?>guru/daftarnilai/<?php echo $id_mapel;?>" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span><b>Kembali</b></a> 
<?php
if(count($query->result())>0)
{
	echo form_open('guru/updatemid/'.$id_mapel,'class="form-horizontal" role="form"');
	?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $mapel;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ranah Penilaian</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $ranah;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">KKM</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kkm_mid;?></p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kurikulum</label></div><div class="col-sm-9"><p class="form-control-static"><?php echo $kurikulum;?></p></div></div>
	<?php
	$k1 = 25;
	$k2 = 250;
	$k3 = 10;
	$k4 = 10;
	echo '<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered"><tr align="center"><td width="'.$k1.'"><strong>No.</strong></td><td width="'.$k2.'"><strong>Nama</strong></td>';

	echo '<td width="'.$k3.'"><strong>Nilai</strong></td><td width="'.$k4.'"><strong>Ketuntasan</strong></td><td>';
	if($aksi == 'proses')
	{
		echo '<strong>Deskripsi</strong>';
	}
	else
	{
		echo '<a href="'.base_url().'guru/deskripsimid/'.$id_mapel.'/proses" title="Ubah Deskripsi" class="btn btn-success">Deskripsi</a>';
	}
	echo '</td></tr>';
	$nomor=1;
	foreach($query->result() as $a)
	{
		$nis = $a->nis;
		$namasiswa = nis_ke_nama($nis);
		echo '<tr><td align="center">'.$nomor.'</td><td>'.$namasiswa.'</td>';
		$nilai_mid = $a->nilai_mid;
		$kettuntas1 = '<p class="text-success">Sudah</p>';
		if($nilai_mid < $kkm_mid)
		{
			$nilai_mid = '<p class="text-danger">'.$nilai_mid.'</p>';	
			$kettuntas1 = '<p class="text-danger">Belum</p>';
		}
		echo '<td align="center">'.$nilai_mid.'</td>';
		echo '<td align="center">'.$kettuntas1;
		if($aksi == 'proses')
		{
			echo '<input type="hidden" name="kd_'.$nomor.'"  value ='.$a->kd.'><input type="hidden" name="nis_'.$nomor.'"  value ='.$nis.'></td>';
		}
		echo '<td>';
		if($aksi == 'proses')
		{
			echo '<input type="text" name="keterangan_'.$nomor.'" value ="'.$a->keterangan.'" class="form-control">';
		}
		else
		{
			echo $a->keterangan;
		}
		echo '</td></tr>';
		$nomor++;	
	}
	echo '</table></div>';
	if ((!empty($id_mapel)) and (!empty($semester)) and (!empty($kelas)) and (!empty($thnajaran)) and (!empty($semester)) and ($aksi == 'proses')) 
	{
		$cacah_siswa = $nomor - 1;
		?>
		<p class="text-center">	<input type="hidden" name="cacah_siswa" value ="<?php echo $cacah_siswa;?>">
		<input type="submit" value="Simpan Deskripsi" class="btn btn-primary" role="button"></p>
		<?php
	}
	echo '</form>';
}
else
{
echo "Belum ada daftar nilai";
}
?>
</div></div></div>
