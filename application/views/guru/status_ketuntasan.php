<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: status_ketuntasan.php
// Lokasi      		: application/views/guru
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
    <title><?php echo 'Proses Sinkronisasi';?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">		
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
</head>
<body>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
	<div style="margin-top:10px;">Penyesuaian Data</div>
		<!-- Progress bar holder -->
		<div id="progress" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
		<!-- Progress information -->
		<div id="information" style="width"></div>
		<?php
		$baris = 10;
		for($i=1;$i<=$baris;$i++)
		{
			// Calculate the percentation
			$percent = intval($i/$baris * 100)."%";
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-image:url(/images/pbar-ani1.gif);\">&nbsp;</div>"; document.getElementById("information").innerHTML="  Proses penyesuaian data <b>'.$i.'</b> dari <b>'. $baris.'</b> terproses.";
			 </script>';
				// This is for the buffer achieve the minimum size in order to flush data
				echo str_repeat(' ',1024*64);
				// Send output to browser immediately
				flush();
				// Tell user that the process is completed
				echo '<script language="javascript">document.getElementById("information").innerHTML=" Proses penyesuaian data : rampung '.$i.'"</script>';
				$i++;
				sleep(1);
		}
?>
</div></div></div>

<script src="/assets/js/jquery-1.11.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
