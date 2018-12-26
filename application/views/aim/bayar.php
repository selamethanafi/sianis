<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3>Proses Pembayaran Mandiri</h3></div>
<div class="card-body">
      <?php
      if(empty($get_nis))
	{echo '<form class="form-horizontal" role="form" action="'.base_url().'aim/bayar" method="post">';
	}
	else
	{echo '<form class="form-horizontal" role="form" action="'.base_url().'aim/bayar/'.$get_nis.'" method="post">';
	}
      if(empty($get_nis))
        {
		$halaman_depan = '';
		$ta = $this->db->query("select * from `aim` where `item` = 'nis'");
		foreach($ta->result() as $a)
		{
			$halaman_depan = $a->isi;
		}
		if(!empty($halaman_depan))
		{?>
		  <audio autoplay><source src="<?php echo $halaman_depan;?>" type="audio/mpeg"></audio>
			<?php
		} ?>
           <div class="form-group row">
	     <div class="col-sm-3"><label class="control-label">NIS</label></div>
             <div class="col-sm-9" ><input type="number" name="post_nis" class="form-control" placeholder="masukkan NIS Anda lalu klik lanjut" required autofocus></div>
           </div>
	   <p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary"> <a href="<?php echo base_url();?>aim" class="btn btn-danger">Batal</a>  <a href="<?php echo base_url();?>aim/carinis/bayar" class="btn btn-success">Cari NIS</a>
            </p>
	<?php
	}
	else
	{
		$nis = $get_nis;
		$nama_siswa = nis_ke_nama($get_nis);
		$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$get_nis'");
		if($ta->num_rows()==0)
		{
		echo '<div class="alert alert-danger"><h2>'.$get_nis.' '.$nama_siswa.'</h2> tidak ada / sudah lulus / tidak terdaftar di kelas manapun.</div>';
			?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>aim/bayar'; // the redirect goes here

},2000);
			</script>
			<?php
		}
		else
		{
			$namahari = tanggal_ke_hari(tanggal_hari_ini());
			$name_of_day = name_of_day(tanggal_hari_ini());
			?>
	 	          <div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">NIS</label></div>
		             <div class="col-sm-9" ><p class="form-control-static"><?php echo $get_nis;?></p></div>
			     <div class="col-sm-3"><label class="control-label">Nama</label></div>
		             <div class="col-sm-9" ><p class="form-control-static"><?php echo nis_ke_nama($get_nis);?></p></div>
			     <div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		             <div class="col-sm-9" ><p class="form-control-static"><?php echo $namahari.' '.tanggal(tanggal_hari_ini());?></p></div>
  			  </div>
			<?php
			echo 'Pilih kelas lain : ';
			$thnajaranini = cari_thnajaran();
			$namasiswa = nis_ke_nama($nis);
			$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$nis' order by thnajaran DESC, semester DESC");
			foreach($ta->result() as $a)
			{
				$thnajaranx = $a->thnajaran;
				$kelas = $a->kelas;
				$semesterx = $a->semester;
				$tahunx = substr($thnajaranx,0,4);
				if(($tahunx == $tahun) and ($semesterx == $semester))
				{
					//echo '<a href="'.base_url().'aim/bayar/'.$nis.'/'.substr($thnajaranx,0,4).'/'.$semester.'" title="terima pembayaran" class="btn btn-primary" disabled>'.$kelas.' '.$thnajaranx.' '.$semesterx.'</a>';
				}
				else
				{
					echo '<a href="'.base_url().'aim/bayar/'.$nis.'/'.substr($thnajaranx,0,4).'/'.$semester.'" title="terima pembayaran" class="btn btn-primary">'.$kelas.' '.$thnajaranx.' '.$semesterx.'</a>';
				}

			}
			echo '</p>';
			//cari kelas 
			?>
			<?php
			$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
			$tingkat = kelas_jadi_tingkat($kelas);
			echo '<h4 class="text-success">Pembayaran Kelas '.$kelas.' '.$thnajaran.' Semester '.$semester.'</h4>';
			$tabel_pembayaran=$this->Keuangan_model->Daftar_Besar_Pembayaran($tingkat,$thnajaran);	
			$noitem = 1;
			$totalkekurangan = 0;
			foreach($tabel_pembayaran->result() as $c)
			{
				$macam_pembayaran = $c->macam_pembayaran;
				$td = $this->db->query("SELECT * FROM `m_uang_besar` where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and tingkat='$tingkat' order by `nomor_urut`");
				$tagihan = 0;
				foreach($td->result() as $d)
				{
					$tagihan = $d->besar;
				}
				$tc = $this->db->query("select * from siswa_bayar where macam_pembayaran='$macam_pembayaran' and thnajaran='$thnajaran' and nis='$nis'");
				$terbayar = 0;
				foreach($tc->result() as $c)
				{
					$terbayar = $terbayar + $c->besar;
				}
				$kurang = $tagihan - $terbayar;
				$totalkekurangan = $totalkekurangan + $kurang;
			}
			if($kurang>0)
			{
				?>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar pembayaran</label></div><div class="col-sm-3"><input name="besar" type="number" class="form-control" max="<?php echo $totalkekurangan;?>" required autofocus> </div>
				</div>
				<?php
			}
			?>
			<?php
			if($totalkekurangan > 0 )
			{
				echo '<div class="alert alert-info">Kekurangan '.xduit($totalkekurangan).' ('.xduitf($totalkekurangan).')</div>';
			?>
				<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>aim" class="btn btn-info"><b>Batal</b></a></p>
			<?php

			}
			else
			{
				echo '<div class="alert alert-success">SUDAH LUNAS</div>';
			}
		}
	}
	?>
	</form>
</div></div></div>

