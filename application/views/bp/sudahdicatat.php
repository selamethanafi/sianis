<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$thnajaran = cari_thnajaran();
$semester = cari_semester();
$namasiswa = nis_ke_nama($nis);
$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
$ta = $this->db->query("select * from `siswa_absensi` where `nis`='$nis' and `tanggal`='$tanggal'");
if($ta->num_rows() > 0)
{
	echo '<h4>Ketidakhadiran '.$namasiswa.' Kelas '.$kelas.' tanggal '.tanggal($tanggal).' sudah dicatat</h3>';
	if($asal == 1)
	{
	?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>bp/ketidakhadiran'; // the redirect goes here
		},2000);
		</script>
<?php
	}
	else
	{
	?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>bp/ketidakhadiransiswaharian/<?php echo $tanggal;?>'; // the redirect goes here
		},2000);
		</script>
<?php

	}
}
else
{
	if($asal == 1)
	{
	?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>bp/ketidakhadiran'; // the redirect goes here
		},0);
		</script>
<?php
	}
	else
	{
	?>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>bp/ketidakhadiransiswaharian/<?php echo $tanggal;?>'; // the redirect goes here
		},0);
		</script>
<?php

	}
}?>
<p>Halaman ini akan berpindah otomatis</p>
</div></div></div>

