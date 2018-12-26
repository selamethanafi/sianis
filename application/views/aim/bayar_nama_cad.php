<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3>Proses Pembayaran Mandiri</h3></div>
<div class="card-body">
	<?php
	if(!empty($halaman_depan))
		{?>
		  <audio autoplay><source src="<?php echo $halaman_depan;?>" type="audio/mpeg"></audio>
			<?php
		}
			$namahari = tanggal_ke_hari(tanggal_hari_ini());
			$name_of_day = name_of_day(tanggal_hari_ini());
			echo '<form class="form-horizontal" role="form" action="'.base_url().'aim/prosesbayarnama" method="post">';
			?>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Nama</label></div>
			<div class="col-sm-9" ><select id="nis" name="nis" class="form-control" required autofocus>
					<option value=""></option>
					<?php
				// ambil data dari database
				$hasil2 = $this->db->query("SELECT * FROM `datsis` where `ket`='Y'");
				foreach($hasil2->result() as $row) {
					$nis = $row->nis;
					$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
					if(!empty($kelas))
					{
					 ?>
						
					 <option value="<?php echo $row->nis?>"><?php echo $row->nama.' '.$nis.'  '.$kelas;?></option>
				 <?php
					}
				}
				?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			     <div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		             <div class="col-sm-9" ><p class="form-control-static"><?php echo $namahari.' '.tanggal(tanggal_hari_ini());?></p></div>
  			  </div>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar pembayaran</label></div><div class="col-sm-3"><input name="besar" type="text" id="dengan-rupiah" class="form-control" required> </div>
				</div>
				<p class="text-center"><input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>aim" class="btn btn-info"><b>Batal</b></a></p>
	</form>
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

<script>
$(document).ready(function () {
 $("#nis").select2({
placeholder: "Klik disini, ketik nama Anda lalu pilih bila sudah muncul"
 });
});
</script>

<script type="text/javascript">

	/* Tanpa Rupiah */
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
	
	/* Dengan Rupiah */
	var dengan_rupiah = document.getElementById('dengan-rupiah');
	dengan_rupiah.addEventListener('keyup', function(e)
	{
		dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
	});
	
	/* Fungsi */
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
</script>
</div></div></div>

