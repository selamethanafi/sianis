<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: pkg_tim_penilai.php
// Lokasi      		: application/views/tatausaha
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<h3>Tahun Penilaian : <?php echo $tahun;?></h3>
<?php
if ($aksi == 'ubah')
{?>

	<?php
	if (empty($id))
	{
		echo '<div class="alert alert-warning">Galat, data tidak ditemukan, karena kode kosong <a href="'.base_url().'tatausaha/pkgtimpenilai"><b>Kembali</b></a></a>';

	}
	else
	{
		$ta=$this->db->query("SELECT * from pkg_tim_penilai where id_tim_penilai='$id'");
		if(count($ta->result()) == 0)
		{
			echo '<div class="alert alert-warning">Galat, data tidak ditemukan <a href="'.base_url().'tatausaha/pkgtimpenilai"><b>Kembali</b></a></div>';
		}
		else
		{
			foreach($ta->result() as $a)
			{
				$kode_penilai = $a->kode_penilai;
				$kode_ternilai = $a->kode_ternilai;
			}
			?>
			<?php echo form_open('tatausaha/pkgtimpenilai','class="form-horizontal" role="form"');
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penilai</label></div><div class="col-sm-9"><select name="kode_penilai" class="form-control">';
			$daftar_guru = $this->db->query("select nama_tanpa_gelar,nama,kode,guru,status from `p_pegawai` where `status`='Y' and `guru`='Y' order by nama_tanpa_gelar");
			echo "<option value='".$kode_penilai."'>".cari_nama_pegawai($kode_penilai)."</option>";
			foreach($daftar_guru->result_array() as $ka)
			{
				echo "<option value='".$ka["kode"]."'>".$ka["nama_tanpa_gelar"]." (".$ka["nama"].")</option>";
			}
			echo '</select></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Yang dinilai</label></div><div class="col-sm-9"><select name="kode_ternilai" class="form-control">';
			$daftar_guru = $this->db->query("select nama_tanpa_gelar,nama,kode,guru,status from `p_pegawai` where `status`='Y' and `guru`='Y' order by nama_tanpa_gelar");
			echo "<option value='".$kode_ternilai."'>".cari_nama_pegawai($kode_ternilai)."</option>";
			foreach($daftar_guru->result_array() as $ka)
			{
				echo "<option value='".$ka["kode"]."'>".$ka["nama_tanpa_gelar"]." (".$ka["nama"].")</option>";
			}
			echo '</select></div></div>
			<p class="text-center"><input type="hidden" name="id_tim_penilai" class="form-control" value="'.$id.'"><input type="submit" value="Ubah Data Tim Penilai" class="btn btn-primary"></form>';
		}
	}
}
else
{	?>
	<?php echo form_open('tatausaha/pkgtimpenilai','class="form-horizontal" role="form"');
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Penilai</label></div><div class="col-sm-9"><select name="kode_penilai" class="form-control">';
	$daftar_guru = $this->db->query("select nama_tanpa_gelar,nama,kode,guru,status from `p_pegawai` where `status`='Y' and `guru`='Y' order by nama_tanpa_gelar");
		echo '<option value="'.$kode_penilai.'">'.cari_nama_pegawai($kode_penilai).'</option>';
	foreach($daftar_guru->result_array() as $ka)
	{	
		echo "<option value='".$ka["kode"]."'>".$ka["nama_tanpa_gelar"]." (".$ka["nama"].")</option>";
	}
	echo '</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Yang dinilai</label></div><div class="col-sm-9"><select name="kode_ternilai" class="form-control">';
	$daftar_guru = $this->db->query("select nama_tanpa_gelar,nama,kode,guru,status from `p_pegawai` where `status`='Y' and `guru`='Y' order by nama_tanpa_gelar");
	foreach($daftar_guru->result_array() as $ka)
	{
		echo "<option value='".$ka["kode"]."'>".$ka["nama_tanpa_gelar"]." (".$ka["nama"].")</option>";
	}
	echo '</select></div></div>

	<p class="text-center"><input type="submit" value="Simpan Data Tim Penilai" class="btn btn-primary"></p>
	</form>';
}
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Kode Penilai</strong></td><td><strong>Penilai</strong></td><td><strong>Kode Yang Dinilai</strong></td><td><strong>Guru Yang Dinilai</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
echo "<tr><td  align=\"center\">".$nomor."</td><td  align=\"center\">".$b->kode_penilai."</td><td>".cari_nama_pegawai($b->kode_penilai)."</td><td  align=\"center\">".$b->kode_ternilai."</td><td>".cari_nama_pegawai($b->kode_ternilai)."</td><td align=\"center\"><a href='".base_url()."tatausaha/pkgtimpenilai/hapus/".$b->id_tim_penilai."' title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td><td align=\"center\"><a href='".base_url()."tatausaha/pkgtimpenilai/ubah/".$b->id_tim_penilai."' title='Edit'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
?>
</table>
</div></div></div>
