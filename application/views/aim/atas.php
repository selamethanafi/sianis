<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Anjungan Izin Mandiri <?php echo $this->config->item('sek_nama');?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
	$ta = $this->db->query("select * from `temauser` where `user`='00'");
	$adata = $ta->num_rows();
	if($adata==0)
	{?>
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">		
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
		?>
		    <link href="<?php echo base_url();?>assets/css/<?php echo $temacss;?>" rel="stylesheet"/>
		<?php
	}

     ?>
    <link rel="stylesheet" href="<?php echo base_url();?>css/teks.css">		
    <link href="<?php echo base_url();?>assets/css/bootstrap-4-navbar.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/fontawesome-all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/select2.min.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico" />
</head>
<body>
