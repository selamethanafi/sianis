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
    <div class="card-header"><p class="text-center"><a href="<?php echo base_url().'aim';?>" class="btn btn-primary">Ke Halaman Proses Izin</a></p>
    </div>
    <div class="card-body">
	<?php
	$ta = $this->db->query("select * from `tblsaran` order by `tanggal` DESC limit 0,5");
	foreach($ta->result() as $a)
	{
		echo '<div class="alert alert-info"><p><strong>'.$a->nama_tamu.'</strong> '.$a->saran.'</p></div>';
	}
	?>
    </div>
    </div>
  </div>
</div>
</div>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>aim';
		},120000);
			</script>

</body>
</html>
