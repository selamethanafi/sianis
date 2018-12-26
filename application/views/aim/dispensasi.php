<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid"><h1>Proses Pengajuan Dispensasi</h1>
	<div class="alert alert-info"><h2>Borang ini bisa digunakan beberapa siswa sekaligus dengan syarat <strong>kelas</strong>, <strong>waktu</strong>, <strong>macam dispensasi</strong> dan <strong>alasan dispensasi</strong> harus <strong>sama</strong></h2></div>
	<div class="well">
		<form action="<?php echo base_url();?>aim/prosesdispensasi" method="post">
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Nama</label></div>
			<div class="col-sm-9" ><select id="nis" name="nis[]" class="form-control" multiple="multiple" autofocus required>
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
				 <option value="<?php echo $row->nis?>"><?php echo $row->nama.' '.$nis.'  Kelas '.$kelas;?></option>
					 <?php
					}
				}
				?>
				</select>
			</div>
		</div>
		<?php
			$namahari = tanggal_ke_hari(tanggal_hari_ini());
			$name_of_day = name_of_day(tanggal_hari_ini());
			?>
	 			<div class="form-group row">
					<div class="col-sm-3"><label class="control-label">Tanggal</label></div>
					<div class="col-sm-9" ><p class="form-control-static"><?php echo $namahari.' '.tanggal(tanggal_hari_ini());?></p></div>
				</div>
			 	<div class="form-group row">
					<div class="col-sm-3"><label class="control-label">Jam ke *</label></div>
					<div class="col-sm-9" ><input type="text" name="jamke" class="form-control" placeholder="jam pelajaran yang hendak diikuti" required></div>
				</div>
			 	<div class="form-group row">
					<div class="col-sm-3"><label class="control-label">Dispensasi *</label></div>
					<div class="col-sm-9" ><input type="text" name="dispensasi" class="form-control" placeholder="misal terlambat" required></div>
				</div>
			 	<div class="form-group row">
					<div class="col-sm-3"><label class="control-label">Alasan Dispensasi *</label></div>
					<div class="col-sm-9" ><input type="text" name="alasan" class="form-control" placeholder="misal terlambat karena bangun kesiangan atau motor mogok" required></div>
				</div>
			 	<div class="form-group row">
					<div class="col-sm-3"><label class="control-label">Pilih Guru Piket *</label></div>
					<div class="col-sm-9" ><select name="kode_guru" class="form-control" required>
						<option value="">Pilih guru piket</option>
						<?php
						$tb = $this->db->query("select * from `guru_piket` where `thnajaran`='$thnajaran' and `semester`='$semester' and `hari` = '$name_of_day'");
//					echo '<option value="SH">SH</option>';
						foreach($tb->result() as $b)
						{
							echo '<option value="'.$b->kodeguru.'">'.cari_nama_pegawai($b->kodeguru).'</option>';
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
				<p class="text-center"><input type="submit" value="Proses Dispensasi" class="btn btn-primary"> <a href="<?php echo base_url();?>aim" class="btn btn-danger">Batal</a>
				</p>
		</form>
	</div>
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

<script>
$(document).ready(function () {
 $("#nis").select2({
placeholder: "Klik disini, ketik nama Anda lalu pilih bila sudah muncul"
 });
});
</script>
</div>

