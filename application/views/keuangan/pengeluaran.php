<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : pembayaran.php
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
<?php echo form_open('keuangan/cetakpengeluaran','class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-3"><p class="form-control-static">
<?php
	echo '<select name="tanggalhariini">';
	if ( (empty($tanggal)) or (strlen($tanggal)<10) )
		{
		$postedhari= date("d");
		}
		else
		{
		$postedhari= substr($tanggal,8,2);
		}
	if ((empty($tanggal)) or (strlen($tanggal)<10) )
		{
		$postedbulan=date("m");
		}
		else
		{
		$postedbulan= substr($tanggal,5,2);
		}

	if ((empty($tanggal)) or (strlen($tanggal)<10) )
		{
		$postedtahun=date("Y");
		}
		else
		{
		$postedtahun= substr($tanggal,0,4);
		}

	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select>';
	echo '<select name="bulanhariini" >';
			$bulan = gantibulan($postedbulan);
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
	echo '</select>';
	echo '<select name="tahunhariini" >';
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
	echo '</select></p></div></div>';
?>
<p class="text-center"><input type="submit" value="Tampilkan Data Pengeluaran" class="btn btn-primary"></p>
</form>
</div></div></div>
