<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 15 Mei 2016 23:00:22 WIB 
// Nama Berkas 		: tapel.php
// Lokasi      		: application/views/pengajaran/
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
<link href="<?php echo base_url();?>assets/bootstrap_datepicker/css/datepicker.css" rel="stylesheet">
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
$galat = 0;
$tmt = '';
$tahun = 0;
$bulan = 0;
$versi = '';
$golongan = preg_replace("/_/","/", $aksi);
if (($aksi== 'II_a') or ($aksi== 'II_b') or ($aksi== 'II_c') or ($aksi== 'II_d') or ($aksi== 'III_a') or ($aksi== 'III_b') or ($aksi== 'III_c') or ($aksi== 'III_d') or ($aksi== 'IV_a') or ($aksi== 'IV_b') or ($aksi== 'IV_c') or ($aksi== 'IV_d'))
{
	?>
	<?php echo form_open('dupak/pak','class="form-horizontal" role="form"');?>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Nomor</label></div>
		<div class="col-sm-9"><input type="text" name="nomor" value="<?php echo $pak['nomor'];?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Masa Penilaian</label></div>
		<div class="col-sm-9"><div class="input-group"><input type="text" name="awal_penilaian" value="<?php echo tanggal($pak['awal_penilaian']);?>" id="tanggal_lahir" class="form-control"><span class="input-group-addon">s.d.</span><input type="text" name="akhir_penilaian" value="<?php echo tanggal($pak['akhir_penilaian']);?>" id="tanggal" class="form-control"></div></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-6"><label class="control-label">Pendidikan yang telah diperhitungkan angka kreditnya</label></div>
		<div class="col-sm-6"><select name="pendidikan" class="form-control">
			<option value="<?php echo $pak['pendidikan'];?>"><?php echo $pak['pendidikan'];?></option>
			<option value="S-1 / Akta IV">S-1 / Akta IV</option>
			<option value="S-2">S-2</option>
			<option value="S-3">S-3</option>
			</select>
			</div>
	</div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pangkat / golongan ruang TMT</label></div>
		<div class="col-sm-3"><input type="text" name="pangkat" value="<?php echo $pak['pangkat'];?>" class="form-control"></div>
		<div class="col-sm-3"><input type="text" name="golongan" value="<?php echo $pak['golongan'];?>" class="form-control" readonly>
		</div>
		<div class="col-sm-3"><input type="text" name="tmt" value="<?php echo tanggal($pak['tmt']);?>" id="tanggal1" class="form-control">
		</div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Jabatan</label></div>
		<div class="col-sm-9"><input type="text" name="jabatan" value="<?php echo $pak['jabatan'];?>" class="form-control"></div>
	</div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Masa Kerja Baru</label></div>
			<div class="col-sm-9"><div class="input-group"><input type="text" name="tahun" value="<?php echo $pak['tahun'];?>" class="form-control"><span class="input-group-addon">tahun</span><input type="text" name="bulan" value="<?php echo $pak['bulan'];?>" class="form-control"><span class="input-group-addon">bulan</span></div>
			</div>
		</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Tugas</label></div>
		<?php if(empty($pak['tugas']))
			{?>
				<div class="col-sm-9"><input type="text" name="tugas" value="" placeholder ="misal mengajar matematika" class="form-control"></div>
			<?php
			}
			else
			{?>
				<div class="col-sm-9"><input type="text" name="tugas" value="<?php echo $pak['tugas'];?>" placeholder ="misal mengajar matematika" class="form-control"></div>
			<?php
			}?>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">AK Pendidikan S1/Akta IV, S2, S3</label></div>
		<div class="col-sm-9"><input type="text" name="ak_pendidikan" value="<?php echo $pak['ak_pendidikan'];?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">AK Diklat kedinasan / STTPP)</label></div>
		<div class="col-sm-9"><input type="text" name="ak_sttpl" value="<?php echo $pak['ak_sttpl'];?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">AK PBM</label></div>
		<div class="col-sm-9"><input type="text" name="ak_pbm" value="<?php echo $pak['ak_pbm'];?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">AK Pengembangan Profesi</label></div>
		<div class="col-sm-9"><input type="text" name="ak_pkb" value="<?php echo $pak['ak_pkb'];?>" class="form-control"></div>
	</div>
	<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">AK Unsur Penunjang</label></div>
		<div class="col-sm-9"><input type="text" name="ak_penunjang" value="<?php echo $pak['ak_penunjang'];?>" class="form-control"></div>
	</div>
	<input type="hidden" name="proses" value="proses">
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Riwayat PAK</button> <a href="<?php echo base_url(); ?>dupak/masa" class="btn btn-info"><b>BATAL</b></a></p></form>
<?php
}	
else
{
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Masa Penilaian</strong></td><td><strong>Golongan</strong></td><td><strong>Masa Kerja</strong></td><td><strong>Jumlah AK</strong></td><td><strong>Ubah Data</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
	$golongan = preg_replace("/\//","_", $b->golongan);
echo '<tr align="center"><td>'.$nomor.'</td><td>'.date_to_long_string($b->awal_penilaian).' s.d. '.date_to_long_string($b->akhir_penilaian).'</td><td>'.$b->golongan.'</td><td>'.$b->tahun.' tahun '.$b->bulan.' bulan</td><td>'.$b->ak.'</td><td><a href="'.base_url().'dupak/pak/'.$golongan.'">Ubah</a></td></tr>';
$nomor++;
}
?>
</table></div>
<?php
}?>
<script src="<?php echo base_url();?>assets/bootstrap_datepicker/js/bootstrap-datepicker.js"></script>
</div></div></div>
