<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="">
    <meta name="author" content="FaberNainggolan">
    <title><?php echo $judulhalaman?></title>
 
    <!-- Custom styles for this template -->
    <link href="<?php echo  base_url()?>auto/style.css" rel="stylesheet">
    <link href="<?php echo  base_url()?>auto/jquery-ui.css" rel="stylesheet">
 
    <!-- jquery -->
    <script src="<?php echo base_url()?>auto/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>auto/jquery-ui.js" type="text/javascript"></script>
    <script>
     $(function () {
        $("#nis").autocomplete({    //id kode sebagai key autocomplete yang akan dibawa ke source url
            minLength:0,
            delay:0,
            source:'<?php echo site_url('autocarisiswa/get_siswa'); ?>',   //nama source kita ambil langsung memangil fungsi get_allkota
            select:function(event, ui){
                $('#namasiswa').val(ui.item.namasiswa);
                $('#kelas').val(ui.item.kelas);

                }
            });
        });
    </script>
  </head>
<body>
<header>
 <h1><?php echo $judulhalaman?> </h1>
</header>
<div class="container-fluid">
<p> <input type="text" id="nis" placeholder="Ketikan nama siswa" > </p>
<p>
 Nama Kota : </br><input type="text" id="namasiswa"></br>
 Ibu Kota : </br><input type="text" id="kelas"></br>
 </p>
</div>
<footer>
 by Faber Nainggolan
</footer>
</body>
</html>
