<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Sistem Informasi Madrasah Aliyah 
 *
 * Copyright (C) 2014  Selamet Hanafi (selamethanafi@yahoo.co.id)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
?>
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
if($proses == 1)
{
?>
	<div class="card">
		<div class="card-header">
			<h3><span class="fa fa-user"></span>Lupa Kata Sandi Sianis <?php echo $this->config->item('sek_nama');?></h3>
		</div>
		<div class="card-body">
			<p><?php echo $telegram;?></p>
			<?php echo form_open('situs/kirimsandi');?>
			<div class="form-group"><label>Kode pemulihan kata sandi</label>
				<input type="text" class="form-control" value="<?php echo $token;?>" name="kode_reset">
				 <span class="text-danger"><?php echo $galat1;?></span></div>
			<div class="form-group"><label>Nama Pengguna</label>
				<input type="text" class="form-control"  name="username">
				 <span class="text-danger"><?php echo $galat2;?></span></div>
			<div class="form-group">
					<label for="subject">Kata Sandi</label>
					<input class="form-control" name="password" placeholder="Kata Sandi" type="password" />
					<span class="text-danger"><?php echo $galat3; ?></span>
			</div>

			<div class="form-group">
					<label for="subject">Kata Sandi (lagi)</label>
					<input class="form-control" name="cpassword" placeholder="Tulis kata sandi lagi" type="password" />
					<span class="text-danger"><?php echo $galat4; ?></span>
			</div>

			<p><input type="submit" value="Proses" class="btn btn-primary"> <a href="<?php echo base_url();?>situs/lupasandi" class="btn btn-info">Kirim Kode Lagi</a></p>
			</form>
		</div>
	</div>
<?php
}
elseif($proses=='3')
{
?>
	<div class="card">
		<div class="card-header">
			<h3><span class="fa fa-user"></span>Lupa Kata Sandi Sianis <?php echo $sek_nama;?></h3>
		</div>
		<div class="card-body">
			<p class="text-success">Proses pemulihan kata sandi berhasil, <a href="<?php echo base_url();?>login">Login</a></p>
		</div>
	</div>
<?php
}
elseif($proses=='4')
{
?>
	<div class="card">
		<div class="card-header">
			<h3><span class="fa fa-user"></span> Lupa Kata Sandi Sianis <?php echo $this->config->item('sek_nama');?></h3>
		</div>
		<div class="card-body">
			<p class="text-danger">Data yang Anda kirim tidak sesuai!</p>
			<p class="text-info">Untuk mengulang klik <a href="<?php echo base_url();?>situs/lupasandi">di sini</a></p>
		</div>
	</div>
<?php
}

elseif($proses=='2')
{
?>
	<div class="card">
		<div class="card-header">
			<h3><span class="fa fa-user"></span> Lupa Kata Sandi Sianis <?php echo $this->config->item('sek_nama');?></h3>
		</div>
		<div class="card-body">
			<p class="text-danger">Akun pemegang nomor tersebut dinonaktifkan</p>
			<p class="text-info">Silakan menghubungi admin. <a href="<?php echo base_url();?>">KE LAMAN <?php echo $this->config->item('sek_nama');?></a></p>
		</div>
	</div>
<?php
}
else
{
?>
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<div class="card">
				<div class="card-header"><h3><span class="fa fa-user"></span> Lupa Kata Sandi Sianis <?php echo $this->config->item('sek_nama');?></h3></div>
				<div class="card-body">
					<p>Proses mendapatkan kata sandi hanya bisa dilakukan pada pukul 07.00 s.d. 14.00 WIB, tetapi bila Anda memiliki akun telegram terdaftar, silakan dilanjut </p>
					<?php echo form_open('situs/proseslupasandi');?>
						<div class="form-group"><label for="name">Nomor Ponsel</label>
							<input type="text" class="form-control" name="masukan" placeholder="nomor seluler">
							<?php
							if (isset($galat)) : ?>
							 <span class="text-danger"><?php echo $galat;?></span>
							<?php endif;?>
						</div>
						<p><input type="submit" value="Proses" class="btn btn-primary"> <a href="<?php echo base_url();?>" class="btn btn-info">BATAL</a> <a href="<?php echo base_url();?>situs/lupasandi/1" class="btn btn-info">MASUKKAN TOKEN</a></p>
					</form>
				</div>
			</div>
		</div>
		<div class="col"></div>
	</div>	
<?php
}?>	
</div>
</body>
</html>
