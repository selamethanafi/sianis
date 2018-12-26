<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:17:07 WIB 
// Nama Berkas 		: mapel_ijazah.php
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
	$kelas = '?';
	$truang = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	foreach($truang->result() as $dk)
	{
		$kelas = $dk->kelas;
	}
	$tmapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
	echo form_open('pengajaran/mapelijazah/tampil/'.$tahun1.'/'.$id_kelas,'class="form-horizontal" role="form"');?>
			<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				?>
				</select></div></div>
				<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">
	<?php
	echo "<option value='".$kelas."'>".$kelas."</option>";
	echo '</select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran Tampil di Ijazah</label></div><div class="col-sm-9"><input type="text" name="nama_mapel" placeholder="teks tampil di ijazah" class="form-control"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><select name="nama_mapel_portal" class="form-control"><option value=""></option>';
	foreach($tmapel->result_array() as $m)
	{
	echo "<option value='".$m["nama_kategori"]."'>".$m["nama_kategori"]."</option>";
	}
	echo '</select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Komponen</label></div><div class="col-sm-9">
<input type="text" name="komponen" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="no_urut" value="'.$no_urut.'" class="form-control"></div></div>';
	echo '<input type="hidden" name="proses" value="tambah"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button> <a href="'.base_url().'pengajaran/mapelijazah/tampil/'.$tahun1.'/'.$id_kelas.'" class="btn btn-info">BATAL</a></p></form>';

}
elseif($aksi == 'ubah')
{
	$kelase = '?';
	$mapele = '?';
	$nama_mapel_portale = '?';
	$komponene = '?';
	$pilihane = '?';
	$no_urute = '';
	$ta = $this->db->query("select * from `m_mapel_ijazah` where `id`='$id'");
	foreach($ta->result() as $a)
	{
		$kelase = $a->kelas;
		$nama_mapele = $a->teks_mapel;
		$nama_mapel_portale = $a->mapel;
		$komponene = $a->komponen;
		$no_urute = $a->no_urut;
	}
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	$truang = $this->db->query("select * from `m_ruang` order by `ruang`");
	$tmapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
	echo form_open('pengajaran/mapelijazah/tampil/'.$tahun1.'/'.$id_kelas,'class="form-horizontal" role="form"');?>
			<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
			<div class="col-sm-9">
				<select name="thnajaran" class="form-control">
				<?php
				echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
				?>
				</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
	<select name="kelas" class="form-control">
	<?php
	echo "<option value='".$kelase."'>".$kelase."</option>";
	echo '</select></div></div><div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Mata Pelajaran Tampil di Ijazah</label></div>
		<div class="col-sm-9"><input type="text" name="nama_mapel" value="'.$nama_mapele.'" class="form-control"></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div>
	<div class="col-sm-9"><select name="nama_mapel_portal" class="form-control">';
	echo "<option value='".$nama_mapel_portale."'>".$nama_mapel_portale."</option>";
	foreach($tmapel->result_array() as $m)
	{
	echo "<option value='".$m["nama_kategori"]."'>".$m["nama_kategori"]."</option>";
	}
	echo '</select></div></div><div class="form-group row"><div class="col-sm-3"><label class="control-label">Komponen</label></div><div class="col-sm-9">
<input type="text" name="komponen" class="form-control" value="'.$komponene.'"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label" value="'.$no_urute.'">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="no_urut" value="'.$no_urute.'" class="form-control"></div></div>';
	echo '<input type="hidden" name="proses" value="ubah"><input type="hidden" name="id" value="'.$id.'"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button> <a href="'.base_url().'pengajaran/mapelijazah/tampil/'.$tahun1.'/'.$id_kelas.'" class="btn btn-info">BATAL</a></p></form>';

}
else
{
$xloc = base_url().'pengajaran/mapelijazah/tampil';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	}

echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$id_kelas.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'/'.$id_kelas.'">'.$k->thnajaran.'</option>';
	}

	echo '</select></div></div>';
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
	}
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$id_kelas.'">'.$kelasxx.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select><p class="help-block">Kalau kelas tidak muncul, silakan cek daftar walikelas</p></div></div>';
	$kelas = $kelasxx;
echo '</form>';

if ((!empty($thnajaran)) and (!empty($id_kelas)))
{
$truang = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
foreach($truang->result() as $dk)
{
	$kelas = $dk->kelas;
}
echo '<p><a href="'.base_url().'pengajaran/mapelijazah/tambah/'.$tahun1.'/'.$id_kelas.'" class="btn btn-info" role="button">TAMBAH MAPEL IJAZAH</a></p>';
?>
<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Thnajaran</strong></td><td><strong>Kelas</strong></td><td><strong>No Urut</strong></td><td><strong>Komponen</strong></td><td><strong>Teks di Ijazah</strong></td><td><strong>Mapel di Portal</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$daftar_mapel = $this->db->query("select * from `m_mapel_ijazah` where `thnajaran`='$thnajaran' and `kelas` = '$kelas' order by `no_urut`");
$nomor=1;
foreach($daftar_mapel->result() as $b)
{
	echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->thnajaran."</td><td align=\"center\">".$b->kelas."</td>
<td align=\"center\">".$b->no_urut."</td><td align=\"center\">".$b->komponen."</td><td>".$b->teks_mapel."</td><td>".$b->mapel."</td>";
	echo "<td align=\"center\"><a href=".base_url()."pengajaran/mapelijazah/ubah/".$tahun1."/".$id_kelas."/".$b->id."><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."pengajaran/mapelijazah/hapus/".$tahun1."/".$id_kelas."/".$b->id."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td>";
echo "</tr>";
$nomor++;
}
?>
</table></div>
<?php
}
if((!empty($thnajaran)) and (!empty($kelas)))
{
	$daftar_kelas = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%' order by `kelas`");
	echo '<h4>Disalin</h4>';
	echo form_open('pengajaran/mapelijazah/tampil/'.$tahun1.'/'.$id_kelas,'class="form-horizontal" role="form"');
		echo '
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
		<select name="thnajaranx" class="form-control">';
		echo "<option value=''></option>";
		foreach($daftar_tapel->result_array() as $k)
		{
			echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
		}
		echo '</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
		<select name="kelasx" class="form-control">';
		echo "<option value=''></option>";
		foreach($daftar_kelas->result() as $ka)
		{
		echo "<option value='".$ka->kelas."'>".$ka->kelas."</option>";
		}
		echo '</select></div></div>
	<input type="hidden" name="thnajaran" value="'.$thnajaran.'">
	<input type="hidden" name="kelas" value="'.$kelas.'">
	<input type="hidden" name="proses" value="salin">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Salin Mata Pelajaran</button></p>
	</form>';
}

}
?>
</div></div></div>
