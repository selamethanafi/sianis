<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">  
    <h1 class="text-center">Cetak Surat Izin</h1>
    <div class="jumbotron">
	<?php
	echo '<h3>Silakan menemui guru piket / BK, mintalah kode / token pengajuan izin lalu masukkan ke kolom di bawah ini</h3>';
	echo '<form class="form-horizontal" role="form" action="'.base_url().'aim/cektoken" method="post">';
	?>
           <div class="form-group row row">
	     <div class="col-sm-3"><label class="control-label">Token *</label></div>
                <div class="col-sm-9" ><input type="number" name="token" class="form-control" placeholder="masukkan token dari guru piket" autofocus required></div>
  	   </div>
	   <p class="text-center"><input type="submit" value="CETAK SURAT IZIN" class="btn btn-success"> <a href="<?php echo base_url();?>aim" class="btn btn-primary">BATAL</a>
            </p>
	<?php
	echo '<p class="text-center"><a href="'.base_url().'aim/token/'.$kode_guru.'" class="btn btn-info">KLIK DISINI UNTUK MELIHAT IZIN ANANDA SUDAH DISETUJUI</a></p>';

	$tanggal = tanggal_hari_ini();
	$thnajaran = cari_thnajaran();
	$semester = cari_semester();
	$this->db->query("delete from `siswa_proses_izin` where `tanggal` !='$tanggal'");
	$ta = $this->db->query("select * from `siswa_proses_izin` where `tanggal`='$tanggal' and `dispensasi` is NULL and `valid`='1'");
	if($ta->num_rows()>0)
	{
		echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">
		<tr align="center"><td>Nama</td><td>Kelas</td><td>Keterangan</td><td>Token</td><td>Cetak</td></tr>';
		foreach($ta->result() as $a)
		{
			$nis = $a->nis;
			echo '<tr><td>'.nis_ke_nama($nis).'</td><td>'.nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester).'</td><td>'.$a->alasan.'</td><td align="center"><strong>'.$a->token.'</strong></td><td><a href="'.base_url().'aim/cektoken/'.$a->token.'" class="btn btn-success"><span class="fa fa-print"></span></td></tr>';
		}
		echo '</table></div>';
	}
	?>
    </div>
</div>

