<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rujukan.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 18:23:19 WIB 
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
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
if(empty($tahun1))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Aksi</strong></td></tr>';
	$nomor=1;
	foreach($tc->result() as $c)
	{
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$c->thnajaran.'</td><td align="center">
<a href="'.base_url().'bp/rujukan/tampil/'.substr($c->thnajaran,0,4).'" title="Pilih Tahun Pelajaran"><span class="fa fa-bullseye"></span></a></td></tr>';
		$nomor++;
	}
	echo '</table>';
}
else
{

	echo '<h4>Tahun Pelajaran '.$thnajaran.'</h4>';
	$tb = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by `golongan` ASC, `id_sikap_spiritual` ASC");
	$cacah = $tb->num_rows();
	if($aksi == 'tambah')
	{
		if($cacah >= 15)
		{
			echo '<div class="alert alert-warning">
				<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Maaf!</strong> Untuk sementara cacah objek pengamatan paling banyak 15</div>';
			echo '<p><a href="'.base_url().'bp/rujukan/tampil/'.$tahun1.'" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>BATAL</b></a></p>';
		}
		else
		{
		echo form_open('bp/rujukan/tampil/'.$tahun1,'class="form-horizontal" role="form"');?>
		<div class="card">
		<div class="card-header"><strong>Tambah Kriteria Pengamatan</strong></div>
		<div class="card-body">
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kriteria Pengamatan</label></div>
			<div class="col-sm-9"><input type="text" name="item" class="form-control" required></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sikap spiritual atau sosial?</label></div>
			<div class="col-sm-9"><select name="golongan" class="form-control">
				<option value="">Spiritual</option><option value="1">Sosial</option></select></div></div>
		<input type="hidden" name="thnajaran" class="form-control" value="<?php echo $thnajaran;?>">
		<input type="hidden" name="proses" class="form-control" value="baru">
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN DATA</button>
		 <a href="<?php echo base_url(); ?>bp/rujukan/tampil/<?php echo $tahun1;?>" class="btn btn-info" role="button">BATAL</a></p>
		</div></div>
		</form>
		<?php
		}

	}
	elseif($aksi == 'ubah')
	{
		$td = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' and `id_sikap_spiritual`='$id'");
		$cacahd = $td->num_rows();
		if($cacahd == 0)
		{
			echo '<div class="alert alert-danger">Data tidak ditemukan</div><p><a href="'.base_url().'bp/rujukan/tampil/'.$tahun1.'" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>BATAL</b></a></p>';
		}
		else
		{
		foreach($td->result() as $d)
		{
			$golongan = $d->golongan;
			$item = $d->item;
		}
		echo form_open('bp/rujukan/tampil/'.$tahun1,'class="form-horizontal" role="form"');?>
		<div class="card">
		<div class="card-header"><strong>Ubah Kriteria Pengamatan</strong></div>
		<div class="card-body">
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Yang diamati</label></div>
			<div class="col-sm-9"><input type="text" name="item" class="form-control" value="<?php echo $item;?>" required></div></div>
			<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sikap spiritual atau sosial?</label></div>
			<div class="col-sm-9"><select name="golongan" class="form-control">
			<?php
			if(empty($golongan))
				{
				echo '<option value="">Spiritual</option><option value="1">Sosial</option>';
				}
				else
				{
				echo '<option value="1">Sosial</option><option value="">Spiritual</option>';
				}
				echo '</select>';
			?>
			</div></div>
			<input type="hidden" name="thnajaran" class="form-control" value="<?php echo $thnajaran;?>">
			<input type="hidden" name="id_sikap_spiritual" class="form-control" value="<?php echo $id;?>">
			<input type="hidden" name="proses" class="form-control" value="ubah">
			<p class="text-center"><button type="submit" class="btn btn-primary" role="button">PERBARUI DATA</button>
			 <a href="<?php echo base_url(); ?>bp/rujukan/tampil/<?php echo $tahun1;?>" class="btn btn-info" role="button">BATAL</a></p>
			</div></div></form>
			<?php
		}

	}
	else
	{
	echo '<p><a href="'.base_url().'bp/rujukan" class="btn btn-info"><span class="fa fa-arrow-left"></span> <b>Tahun Lainnya</b></a>  <a href="'.base_url().'bp/rujukan/tambah/'.$tahun1.'" class="btn btn-info"><span class="fa fa-plus"></span> <b>Data</b></a></p>';
	$tb = $ta = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by `golongan` ASC, `id_sikap_spiritual` ASC");
	
	echo '<div class="table-responsive"><table class="table table-hover table-striped table-bordered">	
	<tr align="center"><td><strong>No.</strong></td><td><strong>Sikap Spiritual / Sosial</strong></td><td><strong>Objek Pengamatan</strong></td><td><strong>Aksi</strong></td></tr>';
	$nomor=1;
	foreach($tb->result() as $b)
	{
		if(empty($b->golongan))
		{
			$sikap = 'Spiritual';
		}
		else
		{
			$sikap = 'Sosial';
		}

		echo '<tr><td align="center">'.$nomor.'</td><td>'.$sikap.'</td><td>'.$b->item.'</td><td align="center"><a href="'.base_url().'bp/rujukan/ubah/'.$tahun1.'/'.$b->id_sikap_spiritual.'" title="Ubah data"><span class="fa fa-edit"></span></a></td></tr>';
		$nomor++;
	}
	echo '</table></div>';
	}
}
?>
</div>
