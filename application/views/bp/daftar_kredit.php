<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: daftar_kredit.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sen 16 Mei 2016 10:47:17 WIB 
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php 
$pesan ='';
$thnajaran = cari_thnajaran();
//echo 'idpost = '.$idpost.' idsegment = '.$idsegment.'';
if ($aksi == 'ubah')
{
$ta = $this->db->query("select * from `m_kredit` where `id`='$idsegment'");
$ada = count($ta->result());
if ($ada == 0)
	{
	header('Location: '.base_url().'bp/daftarkredit');
	}
	else
	{
	foreach($ta->result() as $a)
		{
		$id = $a->id;
		$nama_pelanggaran = $a->nama_pelanggaran;
		$point = $a->point;
		$kode = $a->kode;
		$keterangan = $a->keterangan;
		$jenis = $a->jenis;
		$butir = $a->butir;
		}
	echo form_open('bp/daftarkredit','class="form-horizontal" role="form"');
	?>
	<div class="card">
	<div class="card-header"><h4>Ubah Data Kredit</h4></div>
	<div class="card-body">
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kode Pelanggaran</label></div>
		<div class="col-sm-9">
	<input type="text" name="kode" class="form-control" value="<?php echo $kode;?>"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pelanggaran</label></div>
		<div class="col-sm-9">
	<input type="text" name="nama_pelanggaran" class="form-control" value="<?php echo $nama_pelanggaran;?>" required></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Pelanggaran</label></div>
		<div class="col-sm-9">
	<input type="number" min="0" max="100" name="point"   class="form-control" value="<?php echo $point;?>"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div>
		<div class="col-sm-9">
	<input type="text" name="keterangan" class="form-control" value="<?php echo $keterangan;?>"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Butir Sikap</label></div>
		<div class="col-sm-9">
		<select name="butir" class="form-control">
		<?php
		$td = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran` = '$thnajaran' order by `item`");
		echo '<option value="'.$butir.'">'.$butir.'</option>';		
		foreach($td->result() as $d)
		{	
			echo '<option value="'.$d->item.'">'.$d->item.'</option>';
		}
		?>
		</select></div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sikap Sosial / Spriritual</label></div>
		<div class="col-sm-9">
		<select name="jenis" class="form-control">
		<?php
		if(empty($jenis))
		{	
			echo '<option value="">Sikap Spiritual</option>';
			echo '<option value="1">Sikap Sosial</option>';
		}
		else
		{	
			echo '<option value="1">Sikap Sosial</option>';
			echo '<option value="">Sikap Spiritual</option>';

		}

		?>
		</select></div></div>
	<p class="text-center"><input type="hidden" name="idpost" value="<?php echo $idsegment;?>">
	<input type="hidden" name="proses" class="form-control" value="ubah"><button type="submit" class="btn btn-primary">PERBARUI DATA</button> <a href="<?php echo base_url();?>bp/daftarkredit" class="btn btn-info"><b>Batal</b></a></p>
	</div></div></form>
	<?php
	}
}
if ($aksi == 'tambah')
{
	echo form_open('bp/daftarkredit','class="form-horizontal" role="form"');?>
	<div class="card">
	<div class="card-header"><h4>Tambah Kredit</h4></div>
	<div class="card-body">
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kode Pelanggaran</label></div>
		<div class="col-sm-9">
	<input type="text" name="kode" class="form-control" placeholder="isi kode"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama Pelanggaran</label></div>
		<div class="col-sm-9">
	<input type="text" name="nama_pelanggaran" class="form-control"  placeholder="nama pelanggaran"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Pelanggaran</label></div>
		<div class="col-sm-9">
	<input type="number" min="0" max="100" name="point" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div>
		<div class="col-sm-9">
	<input type="text" name="keterangan" class="form-control" placeholder="keterangan"></div></div>
	</tr></table><p class="text-center"><input type="hidden" name="proses" class="form-control" value="tambah"><button  type="submit" class="btn btn-primary">TAMBAH DATA</button> <a href="<?php echo base_url();?>bp/daftarkredit" class="btn btn-info"><b>Batal</b></a></p>
	</div></div></form>
	<?php

}

if ($proses == "ubah")
	{
	$kode = strtoupper($kode);
	$tc = $this->db->query("select * from `m_kredit` where `id` !='$idpost' and `kode` = '$kode'");
	$ada = count($tc->result());
		if ($ada == 0)
		{
		$this->db->query("update `m_kredit` set `kode`='$kode',`jenis`='$jenis', `butir`='$butir', `nama_pelanggaran`='$nama_pelanggaran', `point`='$point', `keterangan`='$keterangan' where `id`='$idpost'");
		$this->db->query("update `siswa_kredit` set `point`='$point' where `kd_pelanggaran`='$kode' and `thnajaran`='$thnajaran' and `semester`='$semester'");
		header('Location: '.base_url().'bp/daftarkredit');
		}
		else
		{
		$pesan = '<strong>Kode '.$kode.' sudah ada. Data tidak tersimpan.</strong>';
		}
	}
if ($proses == "tambah")
	{
	$kode = strtoupper($kode);
	$tc = $this->db->query("select * from `m_kredit` where `kode` = '$kode'");
	$ada = count($tc->result());
		if ($ada == 0)
		{
		$this->db->query("insert into `m_kredit` (`kode`,`nama_pelanggaran`, `point`, `keterangan`) values ('$kode', '$nama_pelanggaran', '$point', '$keterangan')");
		header('Location: '.base_url().'bp/daftarkredit');
		}
		else
		{
		$pesan = '<strong>Kode '.$kode.' sudah ada. Data tidak tersimpan.</strong>';
		}
	}
if(!empty($pesan))
{
	echo '<div class="alert alert-info">'.$pesan.'</div>';
}
if(($aksi == 'tambah') or ($aksi == 'ubah'))
{
}
else
{
echo '<p class="text-left"><a href="'.base_url().'bp/daftarkredit/tambah" class="btn btn-info"><b>Tambah Data</b></a></p>';
$tb = $this->db->query("select * from `m_kredit`order by kode");
echo '<table class="table table-hover table-striped table-bordered">	
		<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Kode</strong></td><td><strong>Nama Pelanggaran</strong></td><td><strong>Point</strong></td><td><strong>Keterangan</strong></td><td><strong>Butir Sikap</strong></td><td><strong>Sikap Spiritual /<br />Sikap Sosial</strong></td><td><strong>Aksi</strong></td></tr>';
$nomor=1;
foreach($tb->result() as $b)
	{
	echo "<tr><td>".$nomor."</td><td>".$b->kode."</td><td>".$b->nama_pelanggaran."</td><td>".$b->point."</td><td>".$b->keterangan."</td><td>".$b->butir."</td>";
	if($b->jenis == 1)
	{
		$jenis = 'Sikap Sosial';
	}
	else
	{
		$jenis = 'Sikap Spritual';
	}
	echo '<td>'.$jenis.'</td><td><a href="'.base_url().'bp/daftarkredit/ubah/'.$b->id.'" title="Ubah data"><span class="fa fa-edit"></span></a></td></tr>';
		$nomor++;
		}
		echo '</table>';
}
?>
</div>
