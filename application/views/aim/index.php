<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">  
	<h1 class="text-center">Selamat Datang di AIM (Anjungan Izin Mandiri)<br /> <?php echo $sek_nama; ?></h1>
		<div class="row">
			<div class="col">
				<a href="<?php echo base_url();?>aim/depan">
	     			<h2 class="text-center text-info">Kalau tombol tidak terlihat, sentuh / klik saja video di bawah ini.</h2>
					<p class="text-center">
						<video height="400" autoplay>
						<?php
						$halaman_depan = '';
						$ta = $this->db->query("select * from `aim` where `item` = 'halaman_depan'");
						foreach($ta->result() as $a)
						{
							$halaman_depan = $a->isi;
						}
						if(!empty($halaman_depan))
						{?>
							  <source src="<?php echo $halaman_depan;?>" type="video/mp4">
							<?php
						} ?>
						   Your browser does not support HTML5 video.
						</video>
					</p>
			</div>
				</a>
		</div>
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
