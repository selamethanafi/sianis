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
	<?php
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$ta = $this->db->query("select * from `siswa_kredit_total` order by `nilai` DESC");
	$danger = '';
	$warning = '';
	$info = '';
	$success = '';
	foreach($ta->result() as $a)
	{
		$nis = $a->nis;
		$status = nis_ke_status($nis);
		if($status == 'Y')
		{
		$namasiswa = nis_ke_nama($nis);
		$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
		$nilai = $a->nilai;
		if($nilai >= 100)
		{
			if(empty($danger))
			{
				$danger .= $namasiswa.' ('.$kelas.')';
			}
			else
			{
				$danger .= ', '.$namasiswa.' ('.$kelas.')';
			}

		}
		if(($nilai < 100) and ($nilai >= 75))
		{
			if(empty($warning))
			{
				$warning .= $namasiswa.' ('.$kelas.')';
			}
			else
			{
				$warning .= ', '.$namasiswa.' ('.$kelas.')';
			}

		}
		if(($nilai < 75) and ($nilai >= 50))
		{
			if(empty($info))
			{
				$info .= $namasiswa.' ('.$kelas.')';
			}
			else
			{
				$info .= ', '.$namasiswa.' ('.$kelas.')';
			}

		}
		if(($nilai < 50) and ($nilai >= 25))
		{
			if(empty($success))
			{
				$success .= $namasiswa.' ('.$kelas.')';
			}
			else
			{
				$success .= ', '.$namasiswa.' ('.$kelas.')';
			}

		}
		} // status
	}
	echo '<div class="alert alert-danger"><h1>'.$danger.'<h1></div>';
	echo '<div class="alert alert-warning"><h1>'.$warning.'</h1></div>';
	echo '<div class="alert alert-info"><h2>'.$info.'</h2></div>';
	echo '<div class="alert alert-success"><h3>'.$success.'</h3></div>';
	?>
    </div>
  </div>
</div>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>beranda/tampilan/3';
		},1000);
			</script>

</body>
</html>
