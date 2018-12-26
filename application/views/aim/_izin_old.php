<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">  
    <h2>Proses Pengajuan Izin Meninggalkan Madrasah</h2>
    <div class="well">
      <?php
      if(empty($get_nis))
	{echo '<form class="form-horizontal" role="form" action="'.base_url().'aim/izin" method="post">';
	}
	else
	{echo '<form class="form-horizontal" role="form" action="'.base_url().'aim/izin/'.$get_nis.'" method="post">';
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
	   <p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary"> <a href="<?php echo base_url();?>aim" class="btn btn-danger">Batal</a>  <a href="<?php echo base_url();?>aim/carinis" class="btn btn-success">Cari NIS</a>
            </p>
	<?php
	}
	else
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$nama_siswa = nis_ke_nama($get_nis);
		$ta = $this->db->query("select * from `siswa_kelas` where `nis`='$get_nis' and `thnajaran`='$thnajaran' and `semester`='$semester' and `status`='Y'");
		if($ta->num_rows()==0)
		{
		echo '<div class="alert alert-danger"><h2>'.$get_nis.' '.$nama_siswa.'</h2> tidak ada / sudah lulus / tidak terdaftar di kelas manapun.</div>';
			?>
			<script>setTimeout(function () {
   window.location.href= '<?php echo base_url();?>aim/izin'; // the redirect goes here

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
	 	          <div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">Jam ke *</label></div>
		             <div class="col-sm-9" ><input type="text" name="jamke" class="form-control" placeholder="jam pelajaran yang ditinggalkan" autofocus required></div>
  			  </div>

	 	          <div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">Alasan Meninggalkan Madrasah *</label></div>
		             <div class="col-sm-9" ><input type="text" name="alasan" class="form-control" placeholder="masukkan alasan Anda meninggalkan madrasah" required></div>
  			  </div>
	 	          <div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">Pilih Guru Piket *</label></div>
		             <div class="col-sm-9" ><select name="kode_guru" class="form-control" required>
				<option value="">Pilih guru piket</option>
				<?php

				$tb = $this->db->query("select * from `guru_piket` where `thnajaran`='$thnajaran' and `semester`='$semester' and `hari` = '$name_of_day'");
//				echo '<option value="SH">SH</option>';
				foreach($tb->result() as $b)
				{
					echo '<option value="'.$b->kodeguru.'">'.cari_nama_pegawai($b->kode_guru).'</option>';
				}
				$tc = $this->db->query("select * from `tbllogin` where `status`='BP' order by `nama`");
				foreach($tc->result() as $c)
				{
					echo '<option value="'.$c->idlink.'">'.$c->nama.'</option>';
				}
				?>
				</select>
 			     </div>
			  </div>
	 	          <div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">Kembali ke Madrasah *</label></div>
		             <div class="col-sm-9" ><select name="kembali" class="form-control" required>
				<option value=""></option>
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
				</select>
 			     </div>
			  </div>

			   <p class="text-center"><input type="submit" value="Proses Pengajuan Izin" class="btn btn-primary"> <a href="<?php echo base_url();?>aim" class="btn btn-danger">Batal</a>
		            </p>
			<?php

		}
	}
	?>
    </div>
</div>

