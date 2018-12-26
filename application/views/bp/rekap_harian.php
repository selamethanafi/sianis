<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rekap_harian.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 10:16:23 WIB 
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
<form class="form-horizontal" role="form" action= "<?php echo base_url();?>bp/rekapharian" method="post">
	<div class="card">
	<div class="card-header"><h4><?php echo $judulhalaman;?></h4></div>
	<div class="card-body">
	<div class="col-sm-2">
		<label class="control-label">Tanggal</label></div>
	<div class="col-sm-1">
		<select name="tanggalhadir" class="form-control">
		<?php
			$postedhari= substr($tglskr,8,2);
			$postedbulan= substr($tglskr,5,2);
			$postedtahun= substr($tglskr,0,4);
			echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
			for($i=1;$i<=9;$i++)
			{
				echo '<option value="0'.$i.'">0'.$i.'</option>';
			}	
			for($i=10;$i<=31;$i++)
			{
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
			?>
		</select>
	</div>
	<div class="col-sm-2">
		<select name="bulanhadir" class="form-control">
			<?php
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
			?>
	</div>
	<div class="col-sm-2">
			<?php
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
			?>
			</select>
	</div>
	<p class="text-center"><button type="submit" class="btn btn-primary">TAMPILKAN DATA</button></p>
</div></div>
</form>
</div>
