<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 17 Mei 2016 16:13:10 WIB 
// Nama Berkas 		: kredit_siswa.php
// Lokasi      		: application/views/bp/
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
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>

    <!-- Memanggil file .css untuk style saat data dicari dalam filed -->
    <link href="<?php echo base_url();?>assets/css/jquery.autocomplete.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggaltidakmasuk").mask("99-99-9999")
	});
</script>
    <script type='text/javascript'>
        var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/autocomplete/search',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#v_nis').val(''+suggestion.nis); // membuat id 'v_nim' untuk ditampilkan
                    $('#v_kelas').val(''+suggestion.kelas); // membuat id 'v_jurusan' untuk ditampilkan
                }
            });
        });
    </script>

<div class="container-fluid">
<?php 
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$daftartahun=$this->db->query("select * from `m_tapel` order by `awal` DESC");
echo form_open('bp/tampilkreditsiswa','class="form-horizontal" role="form"');?>
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftartahun->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	?>
	</select></div></div>
<?php
echo '
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="search" class="autocomplete form-control" id="autocomplete1" placeholder="ketik sebagian nama siswa tanpa spasi" required/></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_kelas" disabled></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_nis" name="nis" required readonly></div></div>';
?>
<p class="text-center"><button type="submit" class="btn btn-primary">TAMPILKAN</button></p>
</div></div></form>

</div>
