<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">  
        <h3><p class="text-center">Daftar Siswa Diizinkan</p></h3>
      <div class="jumbotron">

	<?php
	$tanggal = tanggal_hari_ini();
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$ta = $this->db->query("select * from `siswa_proses_izin` where `tanggal`='$tanggal' and `valid`='1'");
	if($ta->num_rows()>0)
	{
		echo '	<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td>Nama</td><td>Kelas</td><td>Keterangan</td></tr>';
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			echo '<tr><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td></tr>';
		}
		echo '</table></div>';
	}
	else
	{
		echo '<div class="alert alert-info">Belum ada siswa yang diizinkan</div>';
	}
	echo '<p class="text-center"><a href="'.base_url().'aim/gerbang" class="btn btn-primary">Tampilkan</a></p>';
	?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>aim/gerbang';

},60000);
			</script>

     </div>
</div>

