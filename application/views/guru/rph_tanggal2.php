<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rph_tanggal.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
echo '<a href="'.base_url().'guru/rph"><b>Tampil RPH semester ini</b></a>&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain"><b>Tambah RPH</b></a>';
?>

<?php echo form_open('guru/rphtanggal2','class="form-horizontal" role="form"');?>
<?php 
echo '<input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<table>
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<input name="semester" type="hidden" value="'.$semester.'">'.$semester.'</div></div>';
	}
if (!empty($tanggalrph))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal RPH</label></div><div class="col-sm-9">';
	echo '<select name="tanggalhadir" class="form-control">';
	echo '<option value="'.substr($tanggalrph,6,2).'">'.substr($tanggalrph,6,2).'</option>';
	echo '</select>';
	echo '<select name="bulanhadir" class="form-control">';
	echo '<option value="'.substr($tanggalrph,4,2).'">'.substr($tanggalrph,4,2).'</option>';
	echo '</select>';
	echo '<select name="tahunhadir" class="form-control">';
	echo '<option value="'.substr($tanggalrph,0,4).'">'.substr($tanggalrph,0,4).'</option>';
	echo '</select></div></div>';
	}
if (empty($tanggalrph))
	{
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
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphtanggal2"><b>Batal</b></a></div></div>';

	}

elseif (empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select><font color="#FF0000"><strong> Pilih tahun pelajaran</strong></div></div>';
	echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphtanggal2"><b>Batal</b></a></div></div>';
	}

elseif (empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';

		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select><font color="#FF0000"><strong> Pilih semester</strong></div></div>';
		echo '<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphtanggal2"><b>Batal</b></a></div></div>';

	}
else
{
	echo '<p class="text-center"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Tampilkan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphtanggal2"><b>Batal</b></a></p>';
}
?>
</form>
</div></div></div>
