<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rph_lain.php
// Lokasi      : application/views/guru
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
<?php echo '<p><a href="'.base_url().'guru/rph2" class="btn btn-info"><b>Tampil Semua RPH</b></a>&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphtanggal" class="btn btn-info"><b>Tampil/Ubah RPH/BPH tanggal tertentu</b></a></p>';?>
<?php echo form_open('guru/rphlain2','class="form-horizontal" role="form"');?>
<?php 
$tanggalrphe = '';
$harine = '';
if (!empty($tanggalrph))
{
$tanggalrphe = ''.substr($tanggalrph,0,4).'-'.substr($tanggalrph,4,2).'-'.substr($tanggalrph,6,2).'';
$x = substr($tanggalrphe,0,4);
$y = substr($tanggalrphe,5,2);
$z = substr($tanggalrphe,8,2);
$harine = date("l", mktime(0, 0, 0, $y, $z, $x));
}
//echo 'id_hari_tatap_muka '.$kodeguru.' '.$id_hari_tatap_muka.' tanggal '.$tanggalrph.' id_mapel '.$id_mapel.' tanggale '.$tanggalrphe.' hari '.$harine.'';
echo '<input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><input name="thnajaran" type="hidden" value="'.$thnajaran.'"><p class="form-control-static">'.$thnajaran.'</p></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><input name="semester" type="hidden" value="'.$semester.'"><p class="form-control-static">'.$semester.'</p></div></div>';
	}
if (!empty($tanggalrph))
	{
	$hari_inggris = tanggal_ke_day($tanggalrphe);
	$hari = tanggal_ke_hari($tanggalrphe);
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal RPH</label></div><div class="col-sm-9">';
	echo '<input type="hidden" name="tanggalhadir"  value="'.substr($tanggalrph,6,2).'"><input type="hidden" name="bulanhadir" value="'.substr($tanggalrph,4,2).'"><input type="hidden" name="tahunhadir" value="'.substr($tanggalrph,0,4).'"><p class="form-control-static">'.$hari.', '.substr($tanggalrph,6,2).'-'.substr($tanggalrph,4,2).'-'.substr($tanggalrph,0,4).'</p></div></div>';
	}

if (!empty($id_hari_tatap_muka))
	{
	$td = $this->db->query("select * from tharitatapmuka where `id_hari_tatap_muka` = '$id_hari_tatap_muka'");
	foreach($td->result() as $d)
		{
		$id_mapel = $d->id_mapel;
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hari tatap muka</label></div><div class="col-sm-9">'.day_to_hari($d->hari_tatap_muka).'</div></div>';
	echo '<tr><td data-label="Jam ke-">Jam ke-</label></div><div class="col-sm-9">'.$d->jam_ke.'<input name="id_hari_tatap_muka" type="hidden" value="'.$id_hari_tatap_muka.'"></div></div>';
		}

	}
if (!empty($id_mapel))
	{
	$ta = $this->db->query("select * from m_mapel where id_mapel = '$id_mapel'");
	foreach($ta->result() as $a)
		{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">'.$a->mapel.'</p></div></div>';
	echo '<input name="id_mapel" type="hidden" value="'.$id_mapel.'">';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">'.$a->kelas.'</div></div>';
		}
	}
if (!empty($ditandatangani))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9">';
			echo '<input name="ditandatangani" type="hidden" value="'.$ditandatangani.'">';
			echo ''.$ditandatangani.'</div></div>';
	}

if ((empty($thnajaran)) or (empty($semester)))
	{
	$thnajaran = cari_thnajaran();
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	$semester = cari_semester();
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
		echo '<option value="'.$semester.'">'.$semester.'</option><option value="1">1</option>';
		echo '<option value="2">2</option></select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Batal</b></a></p>';
	}
elseif (empty($tanggalrph))
	{
	$tanggalhariini = tanggal_hari_ini();
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal RPH</label></div><div class="col-sm-3">';
	echo '<select name="tanggalhadir" class="form-control">';
	$postedhari= date("d");
	$postedbulan=date("m");
	$postedtahun=date("Y");
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanhadir" class="form-control">';
			 if ($postedbulan=="01")
			{
			$bulan = "Januari";
			}
			if ($postedbulan=="02")
			{
			$bulan = "Februari";
			}
			if ($postedbulan=="03")
			{
			$bulan = "Maret";
			}
			if ($postedbulan=="04")
			{
			$bulan = "April";
			}
			if ($postedbulan=="05")
			{
			$bulan = "Mei";
			}
			if ($postedbulan=="06")
			{
			$bulan = "Juni";
			}
			if ($postedbulan=="07")
			{
			$bulan = "Juli";
			}
			if ($postedbulan=="08")
			{
			$bulan = "Agustus";
			}
			if ($postedbulan=="09")
			{
			$bulan = "September";
			}
			if ($postedbulan=="10")
			{
			$bulan = "Oktober";
			}
			if ($postedbulan=="11")
			{
			$bulan = "November";
			}
			if ($postedbulan=="12")
			{
			$bulan = "Desember";
			}
			if (($postedbulan=="00") or ($postedbulan==""))
			{
			$bulan = "-----";
			}
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunhadir" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	  	$th=date("Y");
	        $awal_th=$th;
	        $akhir_th=$th-20;
		$i = $awal_th;
		do
		{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
		}
		while ($i>=$akhir_th);
	echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Batal</b></a></p>';

	}
elseif (empty($id_mapel))
{
$tb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9">';
	echo '<select name="id_mapel" class="form-control">';
	foreach($tb->result() as $b)
	{
		$id_mapel = $b->id_mapel;
		$mapel = $b->mapel;
		$kelas = $b->kelas;
		$td = $this->db->query("select * from tharitatapmuka where `id_mapel` = '$id_mapel' and `hari_tatap_muka`='$hari_inggris'");
		foreach($td->result() as $d)
		{
			$jamke = $d->jam_ke;
			echo '<option value="'.$id_mapel.'">'.$mapel.' '.$kelas.' Jam ke '.$jamke.'</option>';			
		}
	}
echo '</select></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Batal</b></a><p>';

}
elseif (empty($id_hari_tatap_muka))
{
$te = $this->db->query("select * from tharitatapmuka where `hari_tatap_muka`='$harine' and `id_mapel`='$id_mapel'");
$adate = $te->num_rows();
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hari Tatap Muka</label></div><div class="col-sm-9">';
	echo '<select name="id_hari_tatap_muka" class="form-control">';
	foreach($te->result() as $e)
	{
		$id_mapele = $e->id_mapel;
		$mapele = id_mapel_jadi_mapel($id_mapele);
	echo '<option value="'.$e->id_hari_tatap_muka.'">'.day_to_hari($e->hari_tatap_muka).' jam ke- '.$e->jam_ke.'</option>';
	}
echo '</select></div></div>';
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;';
	echo '<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Batal</b></a></p>';
}
else
{
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Batal</b></a></p>';
}
?>
</form>
</div></div></div>
