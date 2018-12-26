<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:15:30 WIB 
// Nama Berkas 		: mapel_rapor.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               admin@mantengaran.sch.id
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
if($aksi == 'tambah')
{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	$truang = $this->db->query("select * from `m_ruang` order by `ruang`");
	$tmapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
	echo form_open('pengajaran/mapelrapor/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas,'class="form-horizontal" role="form"');?>
			<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				?>
				</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo "<option value='".$semester."'>".$semester."</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">
	<?php
	echo "<option value='".$kelas."'>".$kelas."</option>";
	echo '</select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran Tampil di Rapor</label></div><div class="col-sm-9"><input type="text" name="nama_mapel" placeholder="teks tampil di rapor" class="form-control"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><select name="nama_mapel_portal" class="form-control"><option value=""></option>';
	foreach($tmapel->result_array() as $m)
	{
	echo "<option value='".$m["nama_kategori"]."'>".$m["nama_kategori"]."</option>";
	}
	echo '</select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Komponen</label></div><div class="col-sm-9">
<input type="text" name="komponen" class="form-control"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Wajib / Pilihan</label></div><div class="col-sm-9">
	<select name="pilihan" class="form-control">';
	echo '<option value="0">Siswa wajib mengikuti</option>';echo '<option value="1">Siswa boleh memilih</option>';
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="no_urut" value="'.$no_urut.'" class="form-control"></div></div>';
	echo '<input type="hidden" name="proses" value="tambah"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button> <a href="'.base_url().'pengajaran/mapelrapor/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas.'" class="btn btn-info">BATAL</a></p></form>';

}
elseif($aksi == 'ubah')
{
	$kelase = '?';
	$mapele = '?';
	$nama_mapel_portale = '?';
	$komponene = '?';
	$pilihane = '?';
	$no_urute = '';
	$ta = $this->db->query("select * from `m_mapel_rapor` where `id_mapel_rapor`='$id_mapel_rapor'");
	foreach($ta->result() as $a)
	{
		$kelase = $a->kelas;
		$nama_mapele = $a->nama_mapel;
		$nama_mapel_portale = $a->nama_mapel_portal;
		$komponene = $a->komponen;
		$pilihane = $a->pilihan;
		$no_urute = $a->no_urut;
	}
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	if($pilihane==0)
		{
		$namapilihane = 'Siswa wajib mengikuti';
		}
	elseif($pilihane==1)
		{
		$namapilihane = 'Siswa boleh memilih mengikuti';
		}
	else
		{
		$namapilihane = '?';
		}
	$truang = $this->db->query("select * from `m_ruang` order by `ruang`");
	$tmapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
	echo form_open('pengajaran/mapelrapor/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas,'class="form-horizontal" role="form"');?>
			<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				?>
				</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo "<option value='".$semester."'>".$semester."</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">
	<?php
	echo "<option value='".$kelase."'>".$kelase."</option>";
	echo '</select></div></div><div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran Tampil di Rapor</label></div>
		<div class="col-sm-9"><input type="text" name="nama_mapel" value="'.$nama_mapele.'" class="form-control"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
	<div class="col-sm-9"><select name="nama_mapel_portal" class="form-control">';
	echo "<option value='".$nama_mapel_portale."'>".$nama_mapel_portale."</option>";
	foreach($tmapel->result_array() as $m)
	{
	echo "<option value='".$m["nama_kategori"]."'>".$m["nama_kategori"]."</option>";
	}
	echo '</select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Komponen</label></div><div class="col-sm-9">
<input type="text" name="komponen" class="form-control" value="'.$komponene.'"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Wajib / Pilihan</label></div><div class="col-sm-9">
	<select name="pilihan" class="form-control"><option value="'.$pilihane.'">'.$namapilihane.'</option>';
	echo '<option value="0">Siswa wajib mengikuti</option>';echo '<option value="1">Siswa boleh memilih</option>';
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label" value="'.$no_urute.'">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="no_urut" value="'.$no_urute.'" class="form-control"></div></div>';
	echo '<input type="hidden" name="proses" value="ubah"><input type="hidden" name="id_mapel_rapor" value="'.$id_mapel_rapor.'"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button> <a href="'.base_url().'pengajaran/mapelrapor/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas.'" class="btn btn-info">BATAL</a></p></form>';

}
else
{
$xloc = base_url().'pengajaran/mapelrapor/tampil';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	}

	echo '	<div class="panel-body"><div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
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
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select><p class="help-block">Kalau kelas tidak muncul, silakan cek daftar walikelas</p></div></div>';
	$kelas = $kelasxx;
echo '</form>';

if ((!empty($thnajaran)) and (!empty($kelas)))
{
echo '<p><a href="'.base_url().'pengajaran/mapelrapor/tambah/'.$tahun1.'/'.$semester.'/'.$id_kelas.'" class="btn btn-info" role="button">TAMBAH MAPEL RAPOR</a></p>';
?>
<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Thnajaran</strong></td><td><strong>Semester</strong></td><td><strong>Kelas</strong></td><td><strong>No Urut</strong></td><td><strong>Komponen</strong></td><td><strong>Tampil di Rapor</strong></td><td><strong>Mapel di Portal</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($daftar_mapel->result() as $b)
{
	if ($b->semester == $semester)
	{

echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->thnajaran."</td><td align=\"center\">".$b->semester."</td>
<td align=\"center\">".$b->kelas."</td>
<td align=\"center\">".$b->no_urut."</td><td align=\"center\">".$b->komponen."</td>";
		if($b->pilihan == 1)
			{
			echo "<td>".$b->nama_mapel." *</td><td>".$b->nama_mapel_portal." *</td>";
			}
			else
			{
			echo "<td>".$b->nama_mapel."</td><td>".$b->nama_mapel_portal."</td>";
			}
	echo "<td align=\"center\"><a href=".base_url()."pengajaran/mapelrapor/ubah/".$tahun1."/".$semester."/".$id_kelas."/".$b->id_mapel_rapor."><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."pengajaran/mapelrapor/hapus/".$tahun1."/".$semester."/".$id_kelas."/".$b->id_mapel_rapor."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td>";
echo "</tr>";
$nomor++;
	}
}
?>
</table></div>
<h5>* Mapel pilihan</h5>
<?php
}
if((!empty($thnajaran)) and (!empty($semester)) and (!empty($kelas)))
{
	echo form_open('pengajaran/mapelrapor/tampil/'.$tahun1.'/'.$semester.'/'.$id_kelas,'class="form-horizontal" role="form"');
	echo '<h4>Disalin ke</h4></div>';
		echo '
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="thnajaranx" class="form-control">';
		echo "<option value=''></option>";
		foreach($daftar_tapel->result_array() as $k)
		{
			echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
		echo '</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
		<select name="semesterx" class="form-control">';
		echo "<option value=''></option>";
		echo "<option value='1'>1</option>";
		echo "<option value='2'>2</option>";
		echo '</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="kelasx" class="form-control">';
		echo "<option value=''></option>";
		foreach($daftar_kelas->result_array() as $ka)
		{
		echo "<option value='".$ka["ruang"]."'>".$ka["ruang"]."</option>";
		}
		echo '</select></div></div>
	<input type="hidden" name="proses" value="salin">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Salin Mata Pelajaran</button></p>
	</form>';
}

}
?>
</div></div></div>
