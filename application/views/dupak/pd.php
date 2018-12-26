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

if(!empty($id_dupak_pd))
{
	echo '<p><a href="'.base_url().'dupak/pd/'.$golongane.'/'.$versi.'" class="btn btn-primary"><b>Kembali</b></a></p>';
	$tb = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `id_dupak_pd`='$id_dupak_pd'");
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
			$keterangan = $b->keterangan;
			$kode = $b->kode;
			$jam = $b->jam;
			$materi = $b->materi;
			$peran = $b->peran;
			$fasilitator = $b->fasilitator;
			$tempat = $b->tempat;
			$penyelenggara = $b->penyelenggara;
			$bukti = $b->bukti;

		}
		echo '<h3>'.$this->dupak->Cari_Kegiatan_Berdasar_Kode($kode).'</h3>';
		echo form_open('dupak/pd/'.$golongane.'/'.$versi,'class="form-horizontal" role="form"');
		?>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div>
			<div class="col-sm-9"><input type="text" name="nama_kegiatan" value="<?php echo $nama_kegiatan;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tanggal</label></div>
			<div class="col-sm-9"><input type="text" name="tanggal" value="<?php echo $tanggal;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Materi / Kompetensi</label></div>
			<div class="col-sm-9"><input type="text" name="materi" value="<?php echo $materi;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Fasilitator</label></div>
			<div class="col-sm-9"><input type="text" name="fasilitator" value="<?php echo $fasilitator;?>" class="form-control"></div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Peran Guru</label></div>
			<div class="col-sm-9"><input type="text" name="peran" value="<?php echo $peran;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Jam</label></div>
			<div class="col-sm-9"><input type="text" name="jam" value="<?php echo $jam;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Tempat Kegiatan</label></div>
			<div class="col-sm-9"><input type="text" name="tempat" value="<?php echo $tempat;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Institusi Penyelenggara</label></div>
			<div class="col-sm-9"><input type="text" name="penyelenggara" value="<?php echo $penyelenggara;?>" class="form-control"></div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Keterangan</label></div>
			<div class="col-sm-9"><input type="text" name="keterangan" value="<?php echo $keterangan;?>" class="form-control"></div>
		</div>
<?php
		if(empty($bukti))
		{
			$bukti = $this->dupak->Cari_Satuan($kode);
		}
?>
		<div class="form-group row">
			<div class="col-sm-3"><label class="control-label">Bukti</label></div>
			<div class="col-sm-9"><input type="text" name="bukti" value="<?php echo $bukti;?>" class="form-control"></div>
		</div>

		<input type="hidden" name="id_dupak_pd" value="<?php echo $id_dupak_pd;?>">
	<p class="text-center"><button type="submit" class="btn btn-primary">Simpan Kegiatan</button></p></form>

	<?php
	}

}
else
{
echo '<p><a href="'.base_url().'dupak/olah/'.$golongane.'/'.$versi.'" class="btn btn-primary"><b>Kembali</b></a></p>';
$tf = $this->db->query("SELECT * FROM `dupak_dupak` where `username`='$nim' and `golongan`='$golongan' order by `no_urut`");
$akr_pd = 0;
$akr_pi = 0;
$akr_ki = 0;
$akr_pj = 0;
$akr_pbm = 0;
$nomor = 1;
echo '<table class="table table-striped table-bordered">
<tr align="center"><td>Nomor</td><td>Kode</td><td>Butir Kegiatan</td><td>Kuantitas</td></tr>';
foreach($tf->result() as $f)
{
	$adagalat = 0;
	$no_urut= $f->no_urut;
	$kode = $f->kode;
	$kegiatan = $this->dupak->Cari_Kegiatan_Berdasar_Kode($kode);
	$tipepd = $this->dupak->Tipe_Pd($kode);
	if(($tipepd == 'pd') or ($tipepd == 'pi') or ($tipepd == 'ki'))
	{
		$cacah = $f->cacah;
		$galat = '';
		$ta = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `golongan`='$golongan' and `kode`='$kode'");
		$adata = $ta->num_rows();
		if($adata < $cacah)
		{
			$selisih = $cacah - $adata;
			for($i=1;$i<=$selisih;$i++)
			{
				$this->db->query("insert into `dupak_pd` (`username`, `golongan`, `kode`) values ('$nim', '$golongan', '$kode')");
			}
		}
		if($adata > $cacah)
		{
			$galat = '<div class="alert alert-danger">Galat: Ada kelebihan Kegiatan</div>';
			$adagalat = '1';
		}
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$f->kode.'</td><td>'.$kegiatan.''.$galat;
		echo '<table class="table table-striped table-bordered">
<tr align="center"><td width="20%">Nama Kegiatan</td><td width="20%">Tanggal</td><td width="20%">Keterangan</td><td width="20%">Bukti</td><td>Ubah</td></tr>';
		$ta = $this->db->query("SELECT * FROM `dupak_pd` where `username`='$nim' and `golongan`='$golongan' and `kode`='$kode'");
		foreach($ta->result() as $a)
		{
			echo '<tr><td>'.$a->nama_kegiatan.'</td><td>'.$a->tanggal.'</td><td><p>'.$a->materi.'</p><p>'.$a->fasilitator.'</p><p>'.$a->tempat.'</p><p>'.$a->penyelenggara.'</p><p>'.$a->keterangan.'</p></td><td><p>'.$a->bukti.'</p></td><td align="center"><a href="'.base_url().'dupak/pd/'.$golongane.'/'.$versi.'/'.$a->id_dupak_pd.'" class="btn btn-success">Ubah</a>';
			if($adagalat == 1)
			{
				echo '&nbsp;&nbsp;&nbsp;<a href="'.base_url().'dupak/pd/'.$golongane.'/'.$versi.'/'.$a->id_dupak_pd.'/hapus" class="btn btn-danger" data-confirm="Anda yakin akan menghapus data ini?">Hapus</a>';
			}
			echo '</td></tr>';
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
