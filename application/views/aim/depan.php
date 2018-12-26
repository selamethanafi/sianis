<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">  
	<h1 class="text-center">Selamat Datang di AIM (Anjungan Izin Mandiri)</h1>
	<h1 class="text-center"><?php echo $sek_nama; ?></h1>
	<div class="jumbotron">
		<div class="row">
			<div class="col">
				 <h2 class="text-center">Silakan Klik tombol di bawah ini sesuai yang diinginkan</h2>
			</div>
		</div>
		<div class="row">
			<div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/dispensasi" class="btn btn-primary">Surat  <br />Dispensasi</a></p></div>
			<div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/suratdispensasi" class="btn btn-primary">Cetak<br />Surat<br />Dispensasi</a></p></div>
		        <div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/izin" class="btn btn-primary">Izin<br />Meninggalkan<br />Madrasah</a></p></div>
			<div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/token" class="btn btn-primary">Cetak <br />Surat Izin</a></p></div>
			<div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/bayarnama" class="btn btn-primary">Pembayaran</a></p></div>
			<?php
			if($cetak_kartu_tes_sementara == 'YA')
			{?>
				<div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/kartutes" class="btn btn-primary">Kartu Tes<br /> Sementara</a></p></div>
			<?php
			}?>
				<div class="col"><p class="text-center"><a href="<?php echo base_url();?>aim/passwordtes" class="btn btn-primary">Kartu Tes<br />Daring</a></p></div>


		</div>
	</div>
</div>
