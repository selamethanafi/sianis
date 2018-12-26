<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 19 Nov 2014 11:21:47 WIB 
// Nama Berkas 		: nilai_uambn.php
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
<?php
if ((!empty($thnajaran)) and (!empty($kelas)))
{
$filename = 'nilai_uambn_'.berkas($thnajaran).'_'.berkas($kelas);
$program = kelas_jadi_program($kelas);
$csv_output = '"","","",""';
$ta = $this->db->query("select * from `mapel_uambn` where thnajaran='$thnajaran' and program='$program' order by no_urut");
if(count($ta->result())>0)
{
	//cari ranah
	foreach($ta->result() as $a)
	{
	$mapel = $a->mapel;
	$tb = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and mapel='$mapel' and `kelas`='$kelas'");
	$ranah = 'KPA';
	foreach($tb->result() as $b)
		{
		$ranah = $b->ranah;
		}
	if ($ranah == 'KPA')
		{
		$csv_output .= ',"'.$mapel.'",""';
		}
	if ($ranah == 'KA')
		{
		$csv_output .= ',"'.$mapel.'"';
		}
	if ($ranah == 'PA')
		{
		$csv_output .= ',"'.$mapel.'"';
		}
	}

	$csv_output .= "\n";
	$csv_output .= '"No","Nama Peserta Didik","Nomor Peserta","Jenis Kelamin"';
	foreach($ta->result() as $a)
	{
	$mapel = $a->mapel;
	$tb = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and mapel='$mapel' and `kelas`='$kelas'");
	$ranah = 'KPA';
	foreach($tb->result() as $b)
		{
		$ranah = $b->ranah;
		}

	if ($ranah == 'KPA')
		{
		$csv_output .= ',"T","P"';
		}
	if ($ranah == 'KA')
		{
		$csv_output .= ',"T"';
		}
	if ($ranah == 'PA')
		{
		$csv_output .= ',"P"';
		}
	}

	$csv_output .= "\n";
	//peserta ujian
	$nomor = 1;
	$tc = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `kelas`='$kelas' and `semester`='2' and `status`='Y'");
	foreach($tc->result() as $c)
	{
		$nis = $c->nis;
		$namasiswa = nis_ke_nama($nis);
		$csv_output .='"'.$nomor.'","'.$namasiswa.'"';
		//cari nomor un
		$td = $this->db->query("select * from `siswa_nomor_tes_un` where `nis`='$nis'");
		$no_un = '';
		foreach($td->result() as $d)
		{
			$no_un = $d->no_peserta.'-'.$d->no_unik;
		}
		$csv_output .= ',"'.$no_un.'"';
		$kelamin = jenkel_siswa($nis,0);
		$csv_output .= ',"'.$kelamin.'"';
		foreach($ta->result() as $a)
		{
		$mapel = $a->mapel;
		$tb = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and mapel='$mapel' and `kelas`='$kelas'");
		$ranah = 'KPA';
		foreach($tb->result() as $b)
			{
			$ranah = $b->ranah;
			}
		$nilai = 0;
		$praktik = 0;
		$query=$this->db->query("select * from nilai_ujian where thnajaran='$thnajaran' and mapel='$mapel' and `nis`='$nis'");
		foreach($query->result() as $t)
			{
			$nilai = $t->nilai;
			$praktik = $t->praktik;
			}
		if ($ranah == 'KPA')
				{
				$csv_output .= ',"'.$nilai.'","'.$praktik.'"';
				}
			if ($ranah == 'KA')
				{
				$csv_output .= ',"'.$nilai.'"';
				}
			if ($ranah == 'PA')
				{
				$csv_output .= ',"'.$nilai.'"';
				}
		}
		$csv_output .= "\n";
	$nomor++;
	}
}
else
{
	$csv_output .= ',"mapel uambn belum ada"';
}
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
}
else
{
?>
<div class="container-fluid">
<?php echo form_open('pengajaran/unduhnilaiuambn','class="form-horizontal" role="form"');?>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
    <div class="panel-body">
<?php
$daftar_kelas = $this->db->query("select * from `m_ruang` where `ruang` like 'XII-%'");
if ((empty($thnajaran)) or (empty($kelas)))
{
	echo '<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control"><option value="'.$thnajaran.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">';
	foreach($daftar_kelas->result_array() as $ka)
	{
	echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
	}
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/unduhnilaiuambn" class="btn btn-info"><b>Batal</b></a></p>';
}
?>
</div></div>
</form>
</div>
<?php
}
