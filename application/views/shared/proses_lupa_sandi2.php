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
<html lang="id">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lupa Kata Sandi Sianis</title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container-fluid">
	<div class="col-md-6 col-md-offset-3">
		<div class="card">
			<div class="card-header">
				<h3><span class="glyphicon glyphicon-user"></span>Lupa Kata Sandi Sianis</h3>
			</div>
			<div class="card-body">
				<p>Pesan singkat akan segera terkirim tidak lebih dari 5 menit. Bila lebih dari 5 menit, layanan sms mungkin sedang mati. Silakan hubungi admin.</p>
				<?php echo form_open('situs/kirimsandi');?>
				<div class="form-group row row"><label>Kode pemulihan kata sandi</label>
				<input type="text" class="form-control"  name="kode_reset"></div>
				<div class="form-group row row"><label>Nama Pengguna</label>
				<input type="text" class="form-control"  name="username"></div>

				<p><td><input type="submit" value="Proses" class="btn btn-primary"></p>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
