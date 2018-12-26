<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: lihat_nilai_ujian_sekolah.php
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
<?php echo form_open('pengajaran/nilaium','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
	<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="panel-body">
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9" >'.$thnajaran.'<input name="thnajaran" type="hidden" value="'.$thnajaran.'"></div></div>';
	}

if (!empty($kelas))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9" >'.$kelas.'<input name="kelas" type="hidden" value="'.$kelas.'"></div></div>';
	}
if (!empty($mapel))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9" >'.$mapel.'<input name="mapel" type="hidden" value="'.$mapel.'"></div></div>';
	}

if ((empty($kelas)) or (empty($mapel)) or (empty($thnajaran)))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9" >
	<select name="thnajaran" class="form-control"><option value="'.$thnajaran.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';

	$tx = $this->db->query("select * from m_ruang where ruang like 'XII-%' order by ruang");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9" ><select name="kelas" class="form-control">';
	echo "<option value='".$kelas."'>".$kelas."</option>";
	foreach($tx->result() as $l)
	{
	echo "<option value='".$l->ruang."'>".$l->ruang."</option>";
	}
	
	echo '</select></div></div>';
	$ta = $this->db->query("select * from tblkategoritutorial order by nama_kategori");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9" ><select name="mapel" class="form-control">';
	echo "<option value='".$mapel."'>".$mapel."</option>";
	foreach($ta->result() as $a)
	{
	echo "<option value='".$a->nama_kategori."'>".$a->nama_kategori."</option>";
	}
	
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/pengajaran/nilaium" class="btn btn-info">Batal</a></p>';
}
else
{
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Tampilkan Lagi" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/pengajaran/nilaium" class="btn btn-info"><b>Batal</b></a></p>';
}

?>
</div></div>
</form>
<?php
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)) and (!empty($mapel)))
	{
	$ta = $this->db->query("select * from siswa_kelas where thnajaran='$thnajaran' and kelas='$kelas' and `semester`='$semester' and status='Y' order by no_urut ");
	?>
<?php
foreach($ta->result() as $a)
{	

	$nis = $a->nis;
	$nourut = $a->no_urut;
	$nama = nis_ke_nama($nis);
	$tb = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");

	if(count($tb->result())==0)
				{
				//$this->db->query("INSERT INTO `nilai_ujian` (`thnajaran`, `ruang`, `no_urut`,`nis`, `mapel`,`oleh`) VALUES ('$thnajaran', '$kelas', '$nourut','$nis', '$mapel','1')");		
	}
}

$nourut = 1;
$daftarnilai = "";
echo '<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="50"><strong>Nomor</strong></td><td width="50"><strong>NIS</strong></td><td><strong>Nama</strong></td><td width="150"><strong>Tertulis</strong></td><td width="150"><strong>Praktik</strong></td><td width="150"><strong>Oleh</strong></td></tr>';
foreach($ta->result() as $a)
{	

	$nis = $a->nis;
	$nourut = $a->no_urut;
	$namasiswa = nis_ke_nama($nis);
	echo '<tr><td>'.$nourut.'</td><td>'.$nis.'</td><td>'.$namasiswa.'</td>';
	$tb = $this->db->query("select * from nilai_ujian where nis='$nis' and mapel='$mapel'");
	foreach($tb->result() as $b)
	{
/*
		$ntulis = $b->nilai * 10;
		$npraktik = $b->praktik * 10;
		$this->db->query("update `nilai_ujian` set `nilai`='$ntulis', `praktik` = '$npraktik' where `nis`='$nis' and `mapel`='$mapel'");
*/
		echo '<td>'.$b->nilai.'</td><td>'.$b->praktik.'</td>';
	
	echo '<td>';
	if ($b->oleh==1)
		{
		echo 'Pengajaran';
		}
	echo '</td></tr>';
	}
	$nourut++;
}
echo '</table>';
}
?>
</div>
