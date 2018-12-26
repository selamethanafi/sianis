<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : pengampuekstra.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Modul Pengampu Ekstrakurikuler</h2>
<?php echo form_open('tatausaha/pengampuekstra2','class="form-horizontal" role="form"');?>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9" ><select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div>
</div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div>
	<div class="col-sm-9" >
	<select name="semester" class="form-control">
	<?php
	echo "<option value='".$semester."'>".$semester."</option>";
	?>
	</select></div>
</div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div>
	<div class="col-sm-9" >
	<select name="namaekstra" class="form-control" required>
	<?php
	echo "<option value='".$namaekstra."'>".$namaekstra."</option>";
	foreach($daftar_nama_ekstra->result_array() as $kb)
	{
	echo "<option value='".$kb["namaekstra"]."'>".$kb["namaekstra"]."</option>";
	}
	?>
	</select></div>
</div>
<div class="form-group row row">
		<div class="col-sm-3"><label class="control-label">Wajib / Pilihan</label></div><div class="col-sm-9">
		<select name="wajib" class="form-control">	
		<?php
			echo "<option value='0'>Pilihan</option>";
			echo "<option value='1'>Wajib</option>";
		?>
		</select></div>
</div>

<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pengampu Ektrakurikuler</label></div>
	<div class="col-sm-9" >
	<select name="kodeguru" class="form-control" required>
	<?php
	echo "<option value=''></option>";
	foreach($daftar_semua_guru->result_array() as $kc)
	{
	echo "<option value='".$kc["kd"]."'>".$kc["nama"]."</option>";
	}
	?>
	</select></div>
</div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Kelas</label></div>

	<?php
	$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	$cacah = $ta->num_rows();
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		echo '<div class="col-sm-2" >';
		echo '<input type="hidden" name="kelas_'.$nomor.'" value="'.$a->kelas.'">';
		echo form_checkbox('id_kelas_'.$nomor, '1', FALSE);echo $a->kelas.'</div>';
		$nomor++;
	}
	?>
</div>
<p class="text-center"><input type="hidden" name="cacah" value="<?php echo $cacah;?>"><input type="submit" value="Simpan Data" class="btn btn-primary" role="button"></p></form>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama Ekstrakurikuler</strong></td><td><strong>Status</strong></td><td><strong>Kelas</strong></td><td><strong>Pengampu</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($pengampu_ekstra->result() as $b)
{
		$namagurune = cari_nama_pegawai($b->kodeguru);
	if ($b->wajib == 0)
		{
		$wajib = 'Pilihan';
		}
		else
		{
		$wajib = 'Wajib';
		}

echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->namaekstra."</td>";
echo "<td align=\"center\">".$wajib."</td><td>".$b->kelas."</td><td>".$namagurune."</td><td  align=\"center\"><a href='".base_url()."tatausaha/pengampuekstra2/hapus/".$b->id_pengampu_ekstra."' onClick=\"return confirm('Anda yakin ingin menghapus ".$b->namaekstra." ".$b->kelas." ".$namagurune." ?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
</div>
