<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: lihat_semua_nilai.php
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
<?php echo form_open('pengajaran/lihatsemuanilai','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	
	echo '</select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
		echo '<option value="2">2</option></select></div></div>';
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">';
	
	echo "<option value='".$kelas."'>".$kelas."</option>";
	$daftar_kelas = $this->db->query("select * from `m_ruang` where `ruang` like 'XII-%' order by `ruang`");
	foreach($daftar_kelas->result() as $l)
	{
	echo "<option value='".$l->ruang."'>".$l->ruang."</option>";
	}
	
	echo '</select></div></div>';
	$ta = $this->db->query("select * from tblkategoritutorial order by nama_kategori");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">
	<select name="mapel" class="form-control">';
	echo "<option value='".$mapel."'>".$mapel."</option>";
	foreach($ta->result() as $a)
	{
	echo "<option value='".$a->nama_kategori."'>".$a->nama_kategori."</option>";
	}
	echo '</select></div></div>';
	echo '<p class="text-center"><button type="submit" class="btn btn-primary" role="button">TAMPILKAN</button></p>';?>
</div></div>
</form>
<?php
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($mapel)))
{
	//daftar siswa
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas' order by no_urut");

	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		?>
		<div class="panel panel-default">
		<div class="panel-heading"><h5><?php echo $nis.' '.nis_ke_nama($nis);?></h5></div>
		<div class="panel-body">
		<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
		<tr align="center"><td rowspan="2"><strong>No.</strong></td><td rowspan="2"><strong>Tahun</strong></td><td rowspan="2"><strong>SMT</strong></td><td rowspan="2"><strong>Kelas</strong></td>
		<?php
		echo '<td colspan="3"><strong>'.$mapel.'</strong></td></tr>';
		echo '<tr align="center"><td><strong>K</strong></td><td><strong>P</strong></td><td><strong>A</strong></td></tr>';
		//cari nilai
		$tc = $this->db->query("select * from `nilai` where `nis`='$nis' and `mapel`='$mapel' order by `thnajaran`,`semester` ");
		$nomor = 1;
		foreach($tc->result() as $c)
		{
		echo '<tr><td align="center">'.$nomor.'</td>';
			echo '<td align="center">'.$c->thnajaran.'</td><td align="center">'.$c->semester.'</td><td align="center">'.$c->kelas.'</td>';

				echo '<td align="center">'.$c->kog.'</td><td align="center">'.$c->psi.'</td><td align="center">'.$c->afektif.'</td>';
		echo '</tr>';
		$nomor++;
		}
		echo '</table></div></div></div>';	

	}

}
echo '</div>';
