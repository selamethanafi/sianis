<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
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
			  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
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


  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
<body>
<div class="container-fluid">
  <div class="card">
    <div class="card-header"><h1>Beranda <?php echo $this->config->item('sek_nama');?></h1>
		<strong>Terakreditasi "A"</strong> --- <small><a href="<?php echo $this->config->item('sek_website');?>"><?php echo $this->config->item('sek_website');?></a></small>
<p class="text-center"><a href="<?php echo base_url().'aim';?>" class="btn btn-primary">Ke Halaman Proses Izin</a></p>
    </div>
    <div class="card-body">
	<?php
//		$tanggalhariini = '2016-10-10';
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$tanggalhariini = tanggal_hari_ini();
		$ta = $this->db->query("select * from `siswa_absensi` where `tanggal`= '$tanggalhariini' and `alasan`='S'");
		$sa = '';
		$j = 1;
		foreach($ta->result () as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			if($j == 1)
			{
				$sa .= $namasiswa.' (S) ('.$kelas.')';
				$j = 2;
			}
			else
			{
				$sa .= ' <strong>'.$namasiswa.' (S) ('.$kelas.')</strong> ';
				$j = 1;
			}

		}
		$sa .= '<br />';
		$ta = $this->db->query("select * from `siswa_absensi` where `tanggal`= '$tanggalhariini' and `alasan`='I'");
		foreach($ta->result () as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			if($j == 1)
			{
				$sa .= $namasiswa.' (I) ('.$kelas.')';
				$j = 2;
			}
			else
			{
				$sa .= ' <strong>'.$namasiswa.' (I) ('.$kelas.')</strong> ';
				$j = 1;
			}
		}
		$ta = $this->db->query("select * from `siswa_absensi` where `tanggal`= '$tanggalhariini' and `alasan`='A'");
		$aa = '';
		foreach($ta->result () as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$aa .= $namasiswa.' ('.$kelas.')<br />';
		}
		$ta = $this->db->query("select * from `siswa_absensi` where `tanggal`= '$tanggalhariini' and `alasan`='B'");
		$ba = '';
		foreach($ta->result () as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$ba .= $namasiswa.' ('.$kelas.') ';
		}
		$ta = $this->db->query("select * from `siswa_absensi` where `tanggal`= '$tanggalhariini' and `alasan`='M'");
		$ma = '';
		foreach($ta->result () as $a)
		{
			$nis = $a->nis;
			$namasiswa = nis_ke_nama($nis);
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$ma .= $namasiswa.' ('.$kelas.')';
		}
		echo '<div class="col-sm-12"><h4>Siswa Tidak Masuk Karena Sakit atau Izin</h4><div class="well">'.$sa.'</div></div>';
		echo '<div class="col-sm-4"><h4>Siswa Tidak Masuk Tanpa Keterangan</h4><div class="well">'.$aa.'</div></div>';
		echo '<div class="col-sm-4"><h4>Siswa Membolos</h4><div class="well">'.$ba.'</div></div>';
		echo '<div class="col-sm-4"><h4>Siswa Izin Meninggalkan Madrasah</h4><div class="well">'.$ma.'</div></div>';

		?>
    </div>
  </div>
</div>
		<script>setTimeout(function () {
		   window.location.href= '<?php echo base_url();?>beranda/tampilan/2';
		},120000);
			</script>

</body>
</html>
