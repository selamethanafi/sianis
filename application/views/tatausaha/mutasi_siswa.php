<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mutasi.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Min 15 Mei 2016 19:26:02 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Modul Mutasi Siswa </h2>
<?php
if (empty($nis))
	{
		echo '<div class="alert alert-danger">NIS KOSONG</div>';
	}
else
{
if (count($query->result())>0) 
{
	foreach($query->result() as $t)
	{
	$ket = $t->ket;
	$nis = $t->nis;
	if ($ket=='Y')
	{
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis'");
		if (count($ta->result())==0) 
			{
			$this->db->query("insert into `siswa_kelas` (`thnajaran`,`nis`,`semester`,`status`) values ('$thnajaran','$nis','$semester','Y')");
			}

		echo form_open('tatausaha/simpanmutasisiswa','class="form-horizontal" role="form"');
		?>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $thnajaran;?></p></div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Semester</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $semester;?>
		</div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nomor Induk Siswa</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $t->nis;?>
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nama</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $t->nama;?>
		</div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas sekarang</label></div>
			<div class="col-sm-9" ><p class="form-control-static"><?php echo $t->kdkls;?>
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Mutasi ke kelas</label></div>
			<div class="col-sm-9" ><select name="kelas" class="form-control">
			<?php
			echo "<option value=''></option>";
			foreach($daftar_kelas->result_array() as $ka)
			{
				echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
			}
			?>
			</select>
		</div></div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">No Urut</label></div>
			<div class="col-sm-9" ><input type="text" name="no_urut" class="form-control">
		</div></div>
		<p class="text-center"><button input type="submit" class="btn btn-primary">SIMPAN DATA</button>
		<input type="hidden" name="nis" value="<?php echo $t->nis;?>"> 
		<a href="<?php echo base_url();?>tatausaha" class="btn btn-info">Batal</a></p>
		</form>
		<?php
	}
	else
		{
		echo '<div class="alert alert-danger">Siswa sudah tidak aktif lagi (pindah, keluar, dsb.)</div>';
		}
	}
}
else{
echo '<div class="alert alert-danger">Tidak Ada Data</div>';
}
}
?>
</div>

