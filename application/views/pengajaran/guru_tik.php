<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:24:08 WIB 
// Nama Berkas 		: guru_tik.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
if($aksi == 'ubah')
{
	if (empty($id_mapel))
	{
		echo 'Galat';
	}
	else
	{
		$ta = $this->db->query("select * from `bimtik_mapel` where `id_mapel`='$id_mapel'");
		foreach($ta->result() as $a)
		{
			$thnajaran = $a->thnajaran;
			$semester = $a->semester;
			$kelas = $a->kelas;
			$kode_guru = $a->kodeguru;
			$ranah = $a->ranah;
			$kelompok = $a->kelompok;
			$jam = $a->jam;
			$no_urut_rapor = $a->no_urut_rapor;
			$kkm = $a->kkm;
		}
		$tahun1 = substr($thnajaran,0,4);
		$truang = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
		echo form_open('pengajaran/pembagiantugas','class="form-horizontal" role="form"');?>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="thnajaran" class="form-control">
		<option value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></option>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semester" class="form-control">
		<option value="<?php echo $semester;?>"><?php echo $semester;?></option>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="kelas" class="form-control">
		<option value="<?php echo $kelas;?>"><?php echo $kelas;?></option>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama / Kode Guru</label></div><div class="col-sm-9">
		<select name="kode_guru" class="form-control">
		<?php
		echo "<option value='".$kode_guru."'>".cari_nama_pegawai($kode_guru)."</option>";
		?>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">
		<select name="mapel" class="form-control">
		<?php
		echo "<option value='".$mapel."'>".$mapel."</option>";
		?>
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ranah penilaian</label></div><div class="col-sm-9">
			<select name="ranah" class="form-control">
			<option value="<?php echo $ranah;?>"><?php echo $ranah;?></option>
			<option value="KP">KP</option>
			<option value="KPA">KPA</option>
			<option value="KA">KA</option>
			<option value="PA">PA</option>
			</select>
			</div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jam Tatap Muka</label></div><div class="col-sm-9"><input type="text" name="jam" value="<?php echo $jam;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">KKM </label></div><div class="col-sm-9"><input type="text" name="kkm" value="<?php echo $kkm;?>" class="form-control"></div></div></table>
		<input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>"><input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>">
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button> 
		<a href="<?php echo base_url();?>pengajaran/mapelperruang/tampil/<?php echo $tahun1.'/'.$semester.'/'.$id_kelas;?>" class="btn btn-info" role="button"><b>Batal</b></a></p>
		</form>
		<?php
	}

}
elseif($aksi == 'tambah')
{
	$tahun1 = substr($thnajaran,0,4);
	echo form_open('pengajaran/pembagiantugasbktik','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<option value="<?php echo $thnajaran;?>"><?php echo $thnajaran;?></option>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control" required><option value="<?php echo $semester;?>"><?php echo $semester;?></option>
	</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="kelas" class="form-control">
		<option value="<?php echo $kelas;?>"><?php echo $kelas;?></option></select></div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama / Kode Guru</label></div><div class="col-sm-9">
	<select name="kode_guru" class="form-control" required>
		<option value="">pilih guru</option>
		<?php
		foreach($daftar_guru->result_array() as $ka)
		{
			echo "<option value='".$ka["kd"]."'>".$ka["nama"]."</option>";
		}
		?>
	</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Ranah penilaian</label></div><div class="col-sm-9">
		<select name="ranah" class="form-control">
		<option value="KP">KP</option>
		<option value="KPA">KPA</option>
		<option value="KA">KA</option>
		<option value="PA">PA</option>
		</select>
		</div></div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Jam Tatap Muka</label></div>
			<div class="col-sm-9"><input type="text" name="jam" placeholder="cacah jam tatap muka" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">KKM </label></div>
			<div class="col-sm-9"><input type="text" name="kkm" placeholder="kriteria mata pelajaran" class="form-control" required></div>
		</div>
		<p class="text-center"><input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>">
		<button type="submit" class="btn btn-primary" role="button">Simpan Data</button> 
		<a href="<?php echo base_url();?>pengajaran/gurutik/<?php echo $tahun1.'/'.$semester;?>" class="btn btn-info" role="button"><b>Batal</b></a></p>
		</form>

		<?php

}
else
{
$xloc = base_url().'pengajaran/gurutik/tampil';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9">';
		echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$thnajaran.'</option>';
		foreach($daftar_tapel->result() as $k)
		{
			echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$k->thnajaran.'</option>';
		}
		echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1/'.$id_kelas.'">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2/'.$id_kelas.'">2</option>';
	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
	}
	$kelas = $kelasxx;
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
echo '</form>';
if ((!empty($thnajaran)) and (!empty($semester)))
{
	$tahun1 = substr($thnajaran,0,4);
	echo '<a href="'.base_url().'pengajaran/gurutik/tambah/'.$tahun1.'/'.$semester.'/'.$id_kelas.'" class="btn btn-info" role="button"><span class="fa fa-plus"></span> Pembagian Tugas Guru TIK</a><p> </p>';
	$daftar_mapel= $this->db->query("select * from `bimtik_mapel` where `thnajaran` = '$thnajaran' and `semester` = '$semester' order by `kelas`");
?>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Thnajaran</strong></td><td><strong>Semester</strong></td><td><strong>Kelas</strong></td><td><strong>Ranah</strong></td><td><strong>KKM</strong></td><td><strong>JTM</strong></td><td><strong>Nama Guru</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($daftar_mapel->result() as $b)
{
	if ($b->semester == $semester)
	{
		$link_hapus = anchor('pengajaran/gurutik/hapus/'.$tahun1.'/'.$semester.'/'.$id_kelas.'/'.$b->id_mapel,'<span class="fa fa-trash-alt"></span>', array('title' => 'Hapus', 'data-confirm' => 'Anda yakin akan menghapus data ini?'));
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->thnajaran."</td><td align=\"center\">".$b->semester."</td>
<td align=\"center\">".$b->kelas."</td><td align=\"center\">".$b->ranah."</td><td align=\"center\">".$b->kkm."</td><td align=\"center\">".$b->jam."</td>
<td align=\"center\">".cari_nama_pegawai($b->kodeguru)."</td>";
	echo '<td align="center">'.$link_hapus.'</td></tr>';
$nomor++;
	}
}
?>
</table></div>

<?php
}
}
?>
</div></div></div>
