<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if((isset($cariotomatis)) or (isset($select)))
	{
	}
	else
	{?>
	    <script src="/assets/js/jquery-3.2.1.slim.min.js"></script> 
	       <script src="/assets/js/popper.min.js"></script>
        	<script src="/assets/js/bootstrap.min.js"></script>
	        <script src="/assets/js/bootstrap-4-navbar.js"></script>
	        <script src="/assets/js/tambahan.js"></script>
	<?php
	}
	?>
<footer class="container text-center">
	<p class="text-info"><?php echo $nama_web;?></p>
	<p class="text-info">Copyright &copy; <strong><?php echo $sek_nama;?></strong> Maintained by <?php echo $maintainer;?>
	<?php
	$ip = $_SERVER['REMOTE_ADDR'];
				echo" || Anda berkunjung dengan IP Address $ip";
				?>
	</p>
</footer>
</body>
</html>
