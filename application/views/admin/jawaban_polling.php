<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: edit_jawaban_polling.php
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
$adapoll = $det->num_rows();
if($adapoll==0)
{
	echo '<p><a href="'.base_url().'admin/polling" class="btn btn-info">Daftar Jajak Pendapat</a></p>';
	echo '<div class="alert alert-warning">Polling tidak ada</div>';
}
else
{
		foreach($det->result_array() as $k)
		{ 
			$judul=$k["soal_poll"];
		}

	if($aksi == 'tambah')
	{
		echo '<p><a href="'.base_url().'admin/jawabanpolling/'.$id_poll.'" class="btn btn-primary">Kembali</a></p>';
		echo '<h3>'.$judul.'</h3>';
		echo form_open('admin/jawabanpolling/'.$id_poll,'class="form-horizontal"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jawaban</label></div>
		<div class="col-sm-9" ><input type="text" name="jawaban" placeholder="jawaban polling" class="form-control"></div>
		</div>';
		echo '<p class="text-center"><input type="submit" value="Simpan Jawaban" class="btn btn-primary"></p>';
		echo form_close();
	}
	elseif($aksi == 'ubah')
	{
		echo '<p><a href="'.base_url().'admin/jawabanpolling/'.$id_poll.'" class="btn btn-primary">Kembali</a></p>';
		echo '<h3>'.$judul.'</h3>';
		if($tedit_jawaban_polling->num_rows()>0)
		{
			foreach($tedit_jawaban_polling->result() as $a)
			{
				$jawaban = $a->jawaban;
			}
			echo form_open('admin/jawabanpolling/'.$id_poll,'class="form-horizontal"');
			echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jawaban</label></div>
			<div class="col-sm-9" ><input type="text" name="jawaban" value="'.$jawaban.'" placeholder="jawaban polling" class="form-control"><input type="hidden" name="id_jawaban" value="'.$id_jawaban.'"></div>
			</div>';
			echo '<p class="text-center"><input type="submit" value="Simpan Jawaban" class="btn btn-primary"></p>';
			echo form_close();
		}
		else
		{
			echo '<div class="alert alert-warning">Data jawaban polling tidak ada</div>';
		}
	}

	else
	{
		echo '<p><a href="'.base_url().'admin/polling" class="btn btn-info">Daftar Jajak Pendapat</a> <a href="'.base_url().'admin/jawabanpolling/'.$id_poll.'/tambah" class="btn btn-primary">Tambah Jawaban</a></p>';
		echo '<h3>'.$judul.'</h3>';
		?>
		<table class="table table-striped table-hover table-bordered">
		<tr align="center"><td width="60"><strong>No.</strong></td><td><strong>Jawaban</strong></td><td colspan="2" width="30"><strong>Aksi</strong></td></tr>
		<?php
		$nomor = 1;
		foreach($qjawabanpoll->result() as $dxjawabanpoll)
		{
			echo '<tr><td>'.$nomor.'</td><td>'.$dxjawabanpoll->jawaban.'</td><td width="50" align="center"><a href="'.base_url().'admin/jawabanpolling/'.$id_poll.'/ubah/'.$dxjawabanpoll->id_jawaban_poll.'" title="ubah jawaban"><span class="fa fa-edit"></span></a></td><td width="50" align="center"><a href="'.base_url().'admin/jawabanpolling/'.$id_poll.'/hapus/'.$dxjawabanpoll->id_jawaban_poll.'" data-confirm="Anda yakin ingin menghapus jawaban polling ini" title="Hapus"><span class="fa fa-trash-alt"></span></a></td></tr>';
			$nomor++;
		}
		?>
		</table>
		<?php
	}
}?>
</div></div></div>
