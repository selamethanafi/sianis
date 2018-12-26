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
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$golongane = preg_replace("/\//","_", $golongan);

if(!empty($id_dupak_pj))
{
	echo '<p><a href="'.base_url().'dupak/pj/'.$golongane.'/'.$versi.'" class="btn btn-primary"><b>Kembali</b></a></p>';
	$tb = $this->db->query("SELECT * FROM `dupak_pj` where `username`='$nim' and `id_dupak_pj`='$id_dupak_pj'");
	if($tb->num_rows() == 0)
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
	}
	else
	{
		foreach($tb->result() as $b)
		{
			$nama_kegiatan = $b->nama_kegiatan;
			$tanggal = $b->tanggal;
			$kode = $b->kode;

		}
		echo '<h3>'.$this->dupak->Cari_Kegiatan_Berdasar_Kode($kode).'</h3>';
		echo form_open('dupak/pj/'.$golongane.'/'.$versi,'class="form-horizontal" role="form"');
		?>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div>
			<div class="col-sm-9"><input type="text" name="nama_kegiatan" value="<?php echo $nama_kegiatan;?>" class="form-control"><p class="help-block">Sertakan tahun pelajaran dan semester atau mungkin tahun saja</p></div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3"><label class="control-label">Tanggal</label></div>
			<div class="col-sm-9"><input type="text" name="tanggal" value="<?php echo $tanggal;?>" class="form-control"></div>
		</div>
		<input type="hidden" name="id_dupak_pj" value="<?php echo $id_dupak_pj;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Kegiatan</button></p></form>

	<?php
	}

}
else
{
echo '<p><a href="'.base_url().'dupak/olah/'.$golongane.'/'.$versi.'" class="btn btn-primary"><b>Kembali</b></a></p>';
$tf = $this->db->query("SELECT * FROM `dupak_dupak` where `username`='$nim' and `golongan`='$golongan' order by `no_urut`");
$akr_pj = 0;
$nomor = 1;
echo '<table class="table table-striped table-bordered">
<tr align="center"><td>Nomor</td><td>Kode</td><td>Butir Kegiatan</td><td>Kuantitas</td></tr>';
foreach($tf->result() as $f)
{
	$kode= $f->kode;
	$kegiatan = $this->dupak->Cari_Kegiatan_Berdasar_Kode($kode);
	$tipepd = $this->dupak->Tipe_Pd($kode);
	if($tipepd == 'pj')
	{
		$cacah = $f->cacah;
		$galat = '';
		$ta = $this->db->query("SELECT * FROM `dupak_pj` where `username`='$nim' and `golongan`='$golongan' and `kode`='$kode'");
		$adata = $ta->num_rows();
		if($adata < $cacah)
		{
			$selisih = $cacah - $adata;
			for($i=1;$i<=$selisih;$i++)
			{
				$this->db->query("insert into `dupak_pj` (`username`, `golongan`, `kode`) values ('$nim', '$golongan', '$kode')");
			}
		}
		if($adata > $cacah)
		{
			$galat = '<div class="alert alert-danger">Galat: Ada kelebihan Kegiatan</div>';
		}
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$f->kode.'</td><td>'.$kegiatan.''.$galat;
		echo '<table class="table table-striped table-bordered">
<tr align="center"><td width="45%">Nama Kegiatan</td><td width="30%">Tanggal</td><td>Ubah</td></tr>';
		$ta = $this->db->query("SELECT * FROM `dupak_pj` where `username`='$nim' and `golongan`='$golongan' and `kode`='$kode'");
		foreach($ta->result() as $a)
		{
			echo '<tr><td>'.$a->nama_kegiatan.'</td><td>'.$a->tanggal.'</td><td align="center"><a href="'.base_url().'dupak/pj/'.$golongane.'/'.$versi.'/'.$a->id_dupak_pj.'" class="btn btn-success">Ubah</a> <a href="'.base_url().'dupak/pj/'.$golongane.'/'.$versi.'/'.$a->id_dupak_pj.'/hapus" class="btn btn-danger" data-confirm="Anda yakin akan menghapus data ini?">Hapus</a></td></tr>';
		}
		echo '</table>';
echo '</td><td align="center">'.$f->cacah.'</td></tr>';
		$nomor++;
	}
}
echo '</table>';
}
?>
</div></div></div>
