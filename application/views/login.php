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
  <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
  </head>
  <body>
<div class="container-fluid">
<?php
	if (isset($galat)) : ?>
	<div class="row">
	<div class="col">
		<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		  <strong>Warning!</strong> <?php echo $galat;?>
		</div>
	</div>
	</div>
	<?php endif;?>

<div class="row">
	<?php
	$this->load->helper('captcha');
	$word = strtoupper(random_string('alnum','4'));
	$vals = array(
	'word' => $word,
	'img_path' => './captcha/',
	'img_url' => ''.base_url().'captcha/',
	'font_path'	 => $this->config->item('fonts_path').'/monaco.ttf',
	'img_width' => '130',
	'font_size' => '16',
	'img_height' => 50,
	'expiration' => 600,
	'colors'		=> array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 255,150)
		)
	);
	$cap = create_captcha($vals);
	$data = array(
		'captcha_time' => $cap['time'],
		'ip_address' => $this->input->ip_address(),
		'word' => $cap['word']
		);
	$query = $this->db->insert_string('captcha', $data);
	$this->db->query($query);
	?>
	<div class="col"></div>
	<div class="col-md-6 col-md-offset-3">
		<div class="card">
			<div class="card-header">
				<h3>  Login Sianis <?php echo $sek_nama;?></h3>
			</div>
			<div class="card-body">
			<?php
				echo form_open('login/masuk');
			?>
				<div class="form-group"><label for="name">Nama Pengguna</label>
					<input type="text" class="form-control" name="usernameteks" placeholder="Username">
				</div>
				<div class="form-group"><label for="name">Kata Sandi</label>
					<input type="password" class="form-control" name="passwordteks" placeholder="Password">
				</div>
				<div class="form-group"><label for="name">Kode Keamanan</label><p><?php	echo $cap['image'];?></p></div>
				<div class="form-group">
					<input type="text" class="form-control" name="captcha" placeholder="kode keamanan">
				</div>
				<p class="text-center"><input type="submit" class="btn btn-primary" value="LOGIN" /> <a href="<?php echo base_url();?>" class="btn btn-info">BERANDA</a></p>
				
				<div class="text-center forget">
					<?php
					$pendaftaran_mandiri = $this->config->item('pendaftaran_mandiri');
					if(!empty($pendaftaran_mandiri))
					{?>
					<p>Belum punya akun? <a href="<?php echo base_url();?>user">daftar</a></p>
					<?php };?><p>Lupa password? Hubungi langsung Admin atau klik <a href="<?php echo base_url();?>situs/lupasandi">di sini</a></p>
<p>Sudah mendapat token lupa password, <a href="<?php echo base_url();?>situs/lupasandi/1" class="btn btn-info">MASUKKAN TOKEN</a></p>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col"></div>
</div>
</div>
	<script src="/assets/js/jquery.min-1.12.0.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
