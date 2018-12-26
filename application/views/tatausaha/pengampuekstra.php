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
<?php echo form_open('tatausaha/pengampuekstra','class="form-horizontal" role="form"');?>
<div class="form-group row row">
	<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9" ><select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tahun->result_array() as $k)
	{
		echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	?>
	</select></div>
</div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div>
	<div class="col-sm-9" >
	<select name="semester" class="form-control">
	<?php
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	?>
	</select></div>
</div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div>
	<div class="col-sm-9" >
	<select name="kelas" class="form-control">
	<?php
	echo "<option value='".$kelas."'>".$kelas."</option>";
	echo "<option value='semua'>semua</option>";
	foreach($daftar_kelas->result_array() as $ka)
	{
	echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
	}
	?>
	</select></div>
</div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Ekstrakurikuler</label></div>
	<div class="col-sm-9" >
	<select name="namaekstra" class="form-control">
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
	<select name="kodeguru" class="form-control">
	<?php
	echo "<option value=''></option>";
	foreach($daftar_semua_guru->result_array() as $kc)
	{
	echo "<option value='".$kc["kode"]."'>".$kc["nama"]."</option>";
	}
	?>
	</select></div>
</div>
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary" role="button"></p></form>
<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Nama Ekstrakurikuler</strong></td><td><strong>Wajib / Pilihan</strong></td><td><strong>Kelas</strong></td><td><strong>Pengampu</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($pengampu_ekstra->result() as $b)
{
		$namagurune = cari_nama_pegawai($b->kodeguru);
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->namaekstra."</td>";
	if ($b->wajib == 0)
		{
		$wajib = 'Pilihan';
		}
		else
		{
		$wajib = 'Wajib';
		}
echo "<td align=\"center\">".$wajib."</td><td>".$b->kelas."</td><td>".$namagurune."</td><td  align=\"center\"><a href='".base_url()."tatausaha/pengampuekstra/hapus/".$b->id_pengampu_ekstra."' onClick=\"return confirm('Anda yakin ingin menghapus ".$b->namaekstra." ".$b->kelas." ".$namagurune." ?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
</div>
