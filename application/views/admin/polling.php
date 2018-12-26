<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: polling.php
// Lokasi      		: application/views/admin
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
if($aksi == 'tambah')
{
	echo '<p><a href="'.base_url().'admin/polling/tampil" class="btn btn-info"><b>Daftar Jajak Pendapat</b></a></p>';
	echo form_open('admin/polling/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Isi Jajak Pendapat</label></div>
			<div class="col-sm-12">
				<textarea name="soal_poll" rows="10" class="form-control"></textarea>
			</div>
	</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9">
		<select name="status" class="form-control">
		<option value='Y' selected>Aktifkan</option>
		<option value='T'>Nonaktifkan</option>
		</select></div></div>

	<input type="hidden" name="proses" value="baru">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
	</form>
	<?php	

}
elseif($aksi == 'ubah')
{
	echo '<p><a href="'.base_url().'admin/polling/tampil" class="btn btn-info"><b>Daftar Jajak Pendapat</b></a></p>';
	if (empty($page))
	{
		header('Location: '.base_url().'admin/polling/tampil');
	}
	else
	{
		$det = $this->Admin_model->Edit_Polling($page);
		if(count($det->result())==0)
		{
			echo 'Jajak pendapat yang dimaksud tidak ada';
		}
		else
		{
			$qjawabanpoll = $this->Admin_model->Tampil_Jwb_Polling($page);
		}
		foreach($det->result_array() as $k)
		{ 
			$judul=$k["soal_poll"];
			$id=$k["id_soal_poll"];
			$status=$k["status"];
		}
		echo form_open('admin/polling/tampil','class="form-horizontal" role="form"');?>
		<div class="form-group row">
			<div class="col-sm-9"><label class="control-label">Isi Jajak Pendapat</label></div>
			<div class="col-sm-12">
				<textarea name="soal_poll" rows="10" class="form-control" required><?php echo $judul; ?></textarea>
			</div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9">
		<select name="status" class="form-control">
		<?php
		if($status=='Y')
		{
			echo "<option value='Y' selected>".$status."</option>";
			echo "<option value='T'>Nonaktifkan</option>";
		}
		else
		{
			echo "<option value='T' selected>".$status."</option>";
			echo "<option value='Y'>Aktifkan</option>";
		}
		?>
		</select></div></div>
		<input type="hidden" name="proses" value="ubah">
		<input type="hidden" name="id_soal_poll" value="<?php echo $page;?>">
		<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
		</form>
		<p><a href="<?php echo base_url(); ?>admin/tambahjawabanpolling/<?php echo $id;?>" class="btn btn-info">Tambah Jawaban Jajak Pendapat</b></a></p>
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td width="30"><strong>No.</strong></td><td <td width="740"><strong>Jawaban</strong></td></td><td colspan="2" width="100"><strong>Aksi</strong></td></tr>
		<?php
		$nomor = 1;
		foreach($qjawabanpoll->result() as $djawabanpoll)
		{
			echo "<tr><td>".$nomor."</td><td>".$djawabanpoll->jawaban."</td><td align=\"center\"><a href='".base_url()."admin/editjawabanpolling/".$djawabanpoll->id_jawaban_poll."/".$djawabanpoll->id_soal_poll."' title='Edit'><span class=\"fa fa-edit\"></span></a></td><td align=\"center\"><a href='".base_url()."admin/hapusjawabanpolling/".$djawabanpoll->id_jawaban_poll."' onClick=\"return confirm('Anda yakin ingin menghapus jawaban ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td></tr>";
$nomor++;
		}
		?>
		</table></div>
		<?php	
	}
}
else
{
?>
<p><a href="<?php echo base_url(); ?>admin/polling/tambah" class="btn btn-info"><b>Tambah Jajak Pendapat</b></a></p>
<p class="text-info">Klik jajak pendapat untuk mengubah pilihan jawaban</p>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Jajak Pendapat</strong></td><td><strong>Status</strong></td><td colspan="2" width="60"><strong>Aksi</strong></td></tr>
<?php
$nomor=$page+1;
foreach($query->result() as $b)
{
	echo '<tr><td>'.$nomor.'</td><td><a href="'.base_url().'admin/jawabanpolling/'.$b->id_soal_poll.'" title="jawaban polling">'.$b->soal_poll.'</a></td><td align="center">';
		$status = $b->status;
		if($status=='Y')
		{
			echo 'Aktif';
		}
		else
		{
			echo 'Nonaktif';
		}
	echo '</td><td align="center"><a href="'.base_url().'admin/polling/ubah/'.$b->id_soal_poll.'" title="ubah"><span class="fa fa-edit"></span></a></td><td align="center"><a href="'.base_url().'admin/polling/hapus/'.$b->id_soal_poll.'" data-confirm="Anda yakin ingin menghapus polling ini?" title="Hapus"><span class="fa fa-trash-alt"></span></a></td></tr>';
$nomor++;
}
?>
</table></div>
<?php
if(!empty($paginator))
	{
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
	}
}
?>
</div></div></div>
