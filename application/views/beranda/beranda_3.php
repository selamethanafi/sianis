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
	$tanggalhariini = tanggal_hari_ini();
//	$tanggalhariini = '2016-10-05';
	$dinane = tanggal_ke_hari($tanggalhariini);
	$x = substr($tanggalhariini,0,4);
	$y = substr($tanggalhariini,5,2);
	$z = substr($tanggalhariini,8,2);
	$hariini = date("l", mktime(0, 0, 0, $y, $z, $x));
	$waktu = date('H:i:s');
//	$waktu = '13:20';
	$waktune = substr($waktu,0,4);
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$kodeguru = '';
	$jamke = '';
	if($hariini == 'Friday')
	{
		if(($waktune == '07:0') or ($waktune == '07:1') or ($waktune == '07:2') or ($waktune == '07:3') or ($waktune == '07:4'))
		{
			$jamke = '%1%';
		}
		if(($waktune == '07:5') or ($waktune == '07:6') or ($waktune == '08:0') or ($waktune == '08:1') or ($waktune == '08:2'))
		{
			$jamke = '%2%';
		}
		if(($waktune == '08:3') or ($waktune == '08:4') or ($waktune == '08:5') or ($waktune == '09:0') or ($waktune == '09:1'))
		{
			$jamke = '%3%';
		}
		if(($waktune == '09:3') or ($waktune == '09:4') or ($waktune == '09:5') or ($waktune == '10:0') or ($waktune == '10:1'))
		{
			$jamke = '%4%';
		}
		if(($waktune == '10:2') or ($waktune == '10:3') or ($waktune == '10:4') or ($waktune == '10:5') or ($waktune == '11:0'))
		{
			$jamke = '%5%';
		}
	}
	else
	{
		if(($waktune == '07:0') or ($waktune == '07:1') or ($waktune == '07:2') or ($waktune == '07:3') or ($waktune == '07:4'))
		{
			$jamke = '%1%';
		}
		if(($waktune == '07:5') or ($waktune == '07:6') or ($waktune == '08:0') or ($waktune == '08:1') or ($waktune == '08:2'))
		{
			$jamke = '%2%';
		}
		if(($waktune == '08:3') or ($waktune == '08:4') or ($waktune == '08:5') or ($waktune == '09:0') or ($waktune == '09:1'))
		{
			$jamke = '%3%';
		}
		if(($waktune == '09:2') or ($waktune == '09:3') or ($waktune == '09:4') or ($waktune == '09:5'))
		{
			$jamke = '%4%';
		}
		if(($waktune == '10:2') or ($waktune == '10:3') or ($waktune == '10:4') or ($waktune == '10:5') or ($waktune == '11:0'))
		{
			$jamke = '%5%';
		}
		if(($waktune == '11:1') or ($waktune == '11:2') or ($waktune == '11:3') or ($waktune == '11:4'))
		{
			$jamke = '%6%';
		}
		if(($waktune == '11:5') or ($waktune == '12:0') or ($waktune == '12:1') or ($waktune == '12:2'))
		{
			$jamke = '%7%';
		}
		if(($waktune == '13:0') or ($waktune == '13:1') or ($waktune == '13:2') or ($waktune == '13:3') or ($waktune == '13:4'))
		{
			$jamke = '%8%';
		}
		if(($waktune == '13:5') or ($waktune == '14:0') or ($waktune == '14:1') or ($waktune == '14:2'))
		{
			$jamke = '%9%';
		}
		if(($waktune == '14:3') or ($waktune == '14:4') or ($waktune == '14:5') or ($waktune == '15:0') or ($waktune == '15:1'))
		{
			$jamke = '%8%';
		}



	}

	echo '<h1><p class="text-center">'.$dinane.', '.date_to_long_string($tanggalhariini).' Pukul '.$waktu.'</p></h1>';
	$cacahtagar = 0;
	$kodeguru = array();
	$ta = $this->db->query("select `id_mapel`, `thnajaran` , `semester` from `m_mapel` where `thnajaran`='$thnajaran' and `semester` = '$semester'");
	foreach($ta->result() as $a)
	{
		$id_mapel = $a->id_mapel;
		$tb = $this->db->query("select * from `tharitatapmuka` where `id_mapel`='$id_mapel' and `hari_tatap_muka` = '$hariini' and `jam_ke` like '$jamke'");
		foreach($tb->result() as $b)
		{
			$kodegurune = $b->kodeguru;
			$kodeguru[$cacahtagar] = $kodegurune;
			$tc = $this->db->query("select `kode`,`foto` from `p_pegawai` where `kode`='$kodegurune'");
			$fotone = '';
			foreach($tc->result() as $c)
			{
				$fotone = $c->foto;
			}
			$foto[$cacahtagar] = $fotone;
			$mapel[$cacahtagar] = id_mapel_jadi_mapel($id_mapel);
			$kelas[$cacahtagar] = id_mapel_jadi_kelas($id_mapel);
			$cacahtagar++;
		}
	}

	?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
	<?php
	for($i=0;$i<$cacahtagar;$i++)
	{
		if($i == 0 )
		{
			?>
			<div class="item active"><?php
				if(!empty($foto[$i]))
				{
					echo '<p class="text-center"><img src ="'.base_url().'images/foto_guru_pegawai/'.$foto[$i].'" width="100" alt="foto" class="img img-rounded"></p>';
				}
					 echo '<h2><p class="text-center">'.$kodeguru[$i].' '.$mapel[$i].' '.$kelas[$i].'</p></h2>';?></div>
			<?php
		}
		else
		{
			?>
			<div class="item"><?php
				if(!empty($foto[$i]))
				{
					echo '<p class="text-center"><img src ="'.base_url().'images/foto_guru_pegawai/'.$foto[$i].'" width="100" alt="foto" class="img img-rounded"></p>';
				}
				 echo '<h2><p class="text-center">'.$kodeguru[$i].' '.$mapel[$i].' '.$kelas[$i].'</p></h2>';?></div>
			<?php
		}
	}
		?>
    </div>
    </div>
  </div>
</div>
</div>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>beranda/tampilan/4';
		},120000);
			</script>

</body>
</html>
