<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3>Proses Pembayaran Mandiri</h3></div>
<div class="card-body">
	<div class="jumbotron">
		<?php
		$ta = $this->db->query("select * from `siswa_proses_bayar` where `nis`='$nis'");
		$besar = 0;
		foreach($ta->result() as $a)
		{
			$besar = $a->besar;
		}
		?>
		
		<h3 class="text-center">Ananda hendak membayar</h3><h1 class="text-center"><?php echo xduit($besar).'</h1><h1 class="text-center">'.xduitf($besar).'</h1><h3 class="text-center">Jika benar, silakan menuju ke loket pembayaran.</h3>';?>
	</div>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>aim/bayarnama'; // the redirect goes here

},1000);
			</script>
</div></div></div>

