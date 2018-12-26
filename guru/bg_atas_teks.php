<!DOCTYPE HTML>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/editor.js"></script>
		<script>
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		</script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href="<?php echo base_url();?>assets/css/editor.css" type="text/css" rel="stylesheet"/>
		<title>LineControl | v1.1.0</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<h2 class="demo-text">LineControl Demo</h2>
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 nopadding">
							<textarea id="txtEditor" name="keterangan"></textarea> 
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 nopadding">
							<textarea id="txtEditor" name="keterangan2"></textarea> 
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="container-fluid footer">
			<p class="pull-right">&copy; Suyati Technologies <script>document.write(new Date().getFullYear())</script>. All rights reserved.</p>
		</div>
	</body>
</html>
