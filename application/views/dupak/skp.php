<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: skp.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?><div class="container-fluid"><h2>Modul Tambahan SKP Untuk Pengajuan PAK dari <?php echo $golongan;?></h2>
<?php
$golongane = preg_replace("/\//","_", $golongan);
if($aksi == 'tambah')
{
	if($tahun > 0)
	{
		echo form_open('dupak/skp/'.$golongane.'/tambah/'.$tahun,'class="form-horizontal" role="form"');
		?>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><select name="tahun" class="form-control" required>
		<?php
		echo '<option value="'.$tahun.'">'.$tahun.'</option>';
		?></select></div></div>
		<?php
		$tb = $this->db->query("SELECT * FROM `skp_tabel_skor` where `unsur`='C' or `unsur`='D' or `unsur`='A' order by `unsur`,kode");
		echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kegiatan</label></div><div class="col-sm-9">
		<select name="kode" class="form-control" required>';
		echo '<option value =""></option>';
		foreach($tb->result() as $b)
		{
			$kode_skp = $b->kode;
			$tc = $this->db->query("select * from `skp_skor_guru` where `kode` = '$kode_skp' and `nip`='$nip' and `tahun` = '$tahun'");
			if($tc->num_rows() == 0)
			{
				echo '<option value ="'.$b->kode.'">'.$b->kegiatan.' ('.$b->ak.')</option>';
			}
		}
		echo '</select></div></div>
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Cacah ( kali / buah )</label></div><div class="col-sm-9">
		<input type="number" min="1" name="kuantitas"  value="1" class="form-control"></div></div>
		<p class="text-center"><input type="hidden" name="status_data"  value ="baru"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().'dupak/skp/'.$golongane.'" class="btn btn-info"><b>Batal</b></a></p></form>';
	}
	else
	{
		$xloc = base_url().'dupak/skp/'.$golongane.'/tambah';
		echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
		?><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9">
		<?php
		echo "<select name=\"tahun\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		$tanggalhariini = tanggal_hari_ini();
		echo '<option value=""></option>';
		echo '<option value="'.$xloc.'/'.substr($tanggalhariini,0,4).'">'.substr($tanggalhariini,0,4).'</option>';
		foreach($daftar_tapel->result() as $b)
		{
			echo '<option value="'.$xloc.'/'.substr($b->thnajaran,0,4).'">'.substr($b->thnajaran,0,4).'</option>';
		}?></select></div></div>
		</form>
		<?php
	}
}
elseif($aksi == 'tambahpkg')
{
	echo 'SKP PKG';
	echo form_open('dupak/pkg/'.$golongane,'class="form-horizontal" role="form"');
	?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun</label></div><div class="col-sm-9"><select name="tahun" class="form-control" required><option value=""></option>
		<?php
		$tanggalhariini = tanggal_hari_ini();
		echo '<option value="'.substr($tanggalhariini,0,4).'">'.substr($tanggalhariini,0,4).'</option>';
		foreach($daftar_tapel->result() as $b)
		{
			echo '<option value="'.substr($b->thnajaran,0,4).'">'.substr($b->thnajaran,0,4).'</option>';
		}?></select></div></div>
	<?php
		echo '
		<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Golongan Saat Penyusunan SKP</label></div><div class="col-sm-9">';
		echo '<select name="golongan" class="form-control" required><option value =""></option>
			<option value ="III/a">III/a</option><option value ="III/b">III/b</option>
			<option value ="III/c">III/c</option>
			<option value ="III/d">III/d</option>
			<option value ="IV/a">IV/a</option>
			<option value ="IV/b">IV/b</option>
			<option value ="IV/c">IV/c</option>
			<option value ="IV/d">IV/d</option></select></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pembelajaran (PKG) dengan sebutan</label></div><div class="col-sm-9">
			<select name="predikat" class="form-control">';
			echo '<option value ="Baik">Baik</option>';
			echo '</select></div></div>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tugas Tambahan</label></div><div class="col-sm-9"><select name="tambahan" class="form-control"><option value =""></option>
			<option value ="Kepala">Kepala '.$this->config->item('sek_tipe').'</option>
			<option value ="Waka">Waka</option>
			<option value ="Kapus">Kepala Perpustakaan</option>
			<option value ="Kalab">Kalab</option>
			<option value ="Walikelas">Walikelas</option>
			</select></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu</label></div><div class="col-sm-9"><select name="waktu" class="form-control" required><option value =""></option>
			<option value ="6">6 bulan</option>
			<option value ="12">12 bulan</option>
			</select></div></div>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
		echo '</form>';
}
else
{
echo '<p><a href="'.base_url().'dupak/tapel/'.$golongane.'" class="btn btn-primary"><b>Proses</b></a> <a href="'.base_url().'dupak/skp/'.$golongane.'/tambah" class="btn btn-info"><b>Tambah SKP NonPKG</b></a> <a href="'.base_url().'dupak/skp/'.$golongane.'/tambahpkg" class="btn btn-warning"><b>Tambah PKG</b></a></p>';
echo '<h4>Daftar SKP Tambahan</h4>';
echo '<table class="table table-striped table-bordered">
<tr align="center"><td>Kode</td><td>Tahun</td><td>Butir Kegiatan</td><td>Kuantitas</td><td>AK</td><td>Perolehan AK</td><td>Hapus</td></tr>';
$total = 0;
foreach($query->result() as $g)
{
	$link_hapus = anchor('dupak/skp/'.$golongane.'/hapus/'.$g->id_dupak_skp,'<span class="fa fa-trash"></span>', array('title' => 'Hapus', 'data-confirm' => 'Anda yakin akan menghapus data ini?'));
	$cacah = $g->kuantitas;
	$kode = $g->kode;
	$tahun = $g->tahun;
	$te=$this->db->query("select * from `skp_skor_guru` where `tahun`='$tahun' and `nip`='$nip' and `kode` = '$kode'");
	$pesan = '';
	if($te->num_rows() >0)
	{
		$pesan = '<div class="alert alert-danger">Sudah ada di SKP, hubungi kepala untuk perbaikan.</div>';
	}

	$kegiatan = $this->dupak->Cari_Kegiatan_Berdasar_Kode($kode);
	echo '<tr><td>'.$g->kode.'</td><td>'.$g->tahun.'</td><td>'.$kegiatan.' '.$pesan;
		$ak_r = $cacah * $g->ak;
		$total = $total + $ak_r;
		echo '</td><td align="center">'.$cacah.'</td><td align="center">'.$g->ak.'</td><td align="center">'.$ak_r.'</td><td align="center">'.$link_hapus.'</td></tr>';
}
echo '<tr><td></td><td colspan="4">Jumlah</td><td align="center">'.$total.'</td></tr>';
echo '</table>';
echo '<h4>Daftar SKP PKG dan Tugas Tambahan</h4>';
echo '<table class="table table-striped table-bordered">
<tr align="center"><td>Kode</td><td>Tahun</td><td>Butir Kegiatan</td><td>Kuantitas</td><td>AK</td><td>Perolehan AK</td></tr>';
$total = 0;
foreach($query2->result() as $g2)
{
	$cacah = $g2->kuantitas;
	$kegiatan = $g2->kegiatan;
	echo '<tr><td>'.$g2->kode.'</td><td>'.$g2->tahun.'</td><td>'.$kegiatan;
		$ak_r = $cacah * $g2->ak_r;
		$total = $total + $ak_r;
		echo '</td><td align="center">'.$cacah.'</td><td align="center">'.$g2->ak_target.'</td><td align="center">'.$ak_r.'</td></tr>';
}
echo '<tr><td></td><td colspan="4">Jumlah</td><td align="center">'.$total.'</td></tr>';
echo '</table>';

}
?>
</div>
