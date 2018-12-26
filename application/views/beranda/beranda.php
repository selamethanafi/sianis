<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $this->config->item('sek_nama');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
	$ta = $this->db->query("select * from `temauser` where `user`='00'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
		  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<?php
	}
	else
	{
		$temacss = '';
		$ta = $this->db->query("select * from `temauser` where `user`='00'");
		foreach($ta->result() as $a)
		{
			$temacss = $a->temacss;
		}
		if(!empty($temacss))
		{?>
			  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
		}
		else
		{?>
		  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<?php
		}
	}

     ?>


  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
<body>
<div class="container-fluid">
  <div class="card">
    <div class="card-header"><h1>Beranda <?php echo $this->config->item('sek_nama');?></h1>
		<strong>Terakreditasi "A"</strong> --- <small><a href="<?php echo $this->config->item('sek_website');?>"><?php echo $this->config->item('sek_website');?></a></small>
<p class="text-center"><a href="<?php echo base_url().'aim';?>" class="btn btn-primary">Ke Halaman Proses Izin</a></p>
</div>
    <div class="card-body">

      <div class="well">
	  

		<?php
		$ofset = 0;
		$batas = 1;
		$ta = $this->db->query("select * from `tblpengumuman` order by id_pengumuman DESC LIMIT $ofset,$batas");
		$teks_berjalan = '';
		foreach($ta->result() as $pengumuman)
		{
			$teks_berjalan .= $pengumuman->judul_pengumuman.' :<br /> '.($pengumuman->isi);
		}
		?>
		<h1><?php echo $teks_berjalan;?></h1>
      </div>
</div>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>beranda/tampilan/1';
		},120000);
			</script>


</body>
</html>
