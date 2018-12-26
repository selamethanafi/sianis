<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: agenda.php
// Lokasi      		: application/views/shared
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
if($aksi == 'ubah')
{
	echo '<p><a href="'.base_url().''.$tautan.'/agenda/tampil" class="btn btn-info"><b>Kembali ke Daftar Agenda </b></a></p>';
	echo form_open($tautan.'/agenda/tampil','class="form-horizontal" role="form"');
	if (empty($id))
	{
		header('Location: '.base_url().''.$tautan.'/agenda');
	}
	else
	{
		$ed=$this->db->query("select * from tblagenda where id_agenda='$id'");
		if(count($ed->result())==0)
		{
			echo 'Agenda yang dimaksud tidak ada';
		}
		else
		{
			foreach($ed->result_array() as $e)
			{
				$ps=array();
				$ps=explode("-",$wkt_skr);
				$tgl_skr=$ps[0];
				$bln_skr=$ps[1];
				$thn_skr=$ps[2];
				$psh=array();
				$psh=explode("-",$e["tgl_mulai"]);
				$tgl_ml=$psh[2];
				$bln_ml=$psh[1];
				$thn_ml=$psh[0];
				$psh2=array();
				$psh2=explode("-",$e["tgl_selesai"]);
				$tgl_sl=$psh2[2];
				$bln_sl=$psh2[1];
				$thn_sl=$psh2[0];
				$judul=$e["tema_agenda"];
				$isi=$e["isi"];
				$tempat=$e["tempat"];
				$waktu=$e["jam"];
				$keterangan=$e["keterangan"];
				$id=$e["id_agenda"];
			}
			?>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tema</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"  value="<?php echo $judul; ?>"></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="5" class="form-control"><?php echo $isi; ?></textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mulai</label></div><div class="col-sm-3">
			<?php
			echo '<select name="tgl_mulai" class="form-control" >';
			for($i=1;$i<32;$i++)
			{
				if($tgl_ml==$i)
				{
				echo "<option selected>".$i."</option>";
				}
				else{
					echo "<option>".$i."</option>";
				}
			}
			echo '</select></div><div class="col-sm-3">';
			echo '<select name="bln_mulai" class="form-control" >';
			for($i=1;$i<13;$i++)
			{
				if($bln_ml==$i){
				echo "<option selected>".$i."</option>";
				}
				else{
				echo "<option>".$i."</option>";
				}
			}
			echo '</select></div><div class="col-sm-3">';
			echo '<select name="thn_mulai" class="form-control" >';
			for($i=$thn_skr-2;$i<=$thn_skr+2;$i++)
			{
				if($thn_ml==$i){
				echo "<option selected>".$i."</option>";
				}
				else{
				echo "<option>".$i."</option>";
				}
			}
			echo '</select>';
			?>
			</div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Selesai</label></div><div class="col-sm-3">
			<?php
			echo '<select name="tgl_selesai" class="form-control" >';
			for($i=1;$i<32;$i++)
			{
				if($tgl_sl==$i){
				echo "<option selected>".$i."</option>";
				}
				else{
				echo "<option>".$i."</option>";
				}
			}
			echo '</select></div><div class="col-sm-3">';
			echo '<select name="bln_selesai" class="form-control">';
			for($i=1;$i<13;$i++)
			{
				if($bln_sl==$i){
				echo "<option selected>".$i."</option>";
				}
				else{
				echo "<option>".$i."</option>";
				}
			}
			echo '</select></div><div class="col-sm-3">';
			echo '<select name="thn_selesai"  class="form-control">';
			for($i=$thn_skr-2;$i<=$thn_skr+2;$i++)
			{
				if($thn_sl==$i){
				echo "<option selected>".$i."</option>";
				}
				else{
				echo "<option>".$i."</option>";
				}
			}
			echo '</select>';
			?>
			</div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><input type="text" name="tempat" class="form-control"  value="<?php echo $tempat; ?>"></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu Kegiatan</label></div><div class="col-sm-9"><input type="text" name="jam" class="form-control"  value="<?php echo $waktu; ?>"></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><textarea name="keterangan" rows="5" class="form-control"><?php echo $keterangan; ?></textarea></div></div>
			<p class="text-center"><input type="hidden" name="id_agenda" value="<?php echo $id; ?>"><input type="hidden" name="proses" value="ubah"><input type="submit" value="Simpan Agenda" class="btn btn-primary"> <a href="<?php echo base_url(); ?><?php echo $tautan;?>/agenda/tampil" class="btn btn-info"><b>Batal</b></a></p>
			</form>
			<?php
		}
	}
}
elseif($aksi == 'tambah')
{
	?>
	<p><a href="<?php echo base_url(); ?><?php echo $tautan;?>/agenda/tampil" class="btn btn-info"><b>Kembali ke Daftar Agenda</b></a></p>
	<?php echo form_open($tautan.'/agenda/tampil','class="form-horizontal" role="form"');?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tema</label></div><div class="col-sm-9"><input type="text" name="judul" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Isi</label></div><div class="col-sm-9"><textarea name="isi" rows="5" class="form-control"></textarea></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mulai</label></div><div class="col-sm-3">
	<?php
	$psh=array();
	$psh=explode("-",$wkt_skr);
	$tgl_skr=$psh[0];
	$bln_skr=$psh[1];
	$thn_skr=$psh[2];
	echo '<select name="tgl_mulai" class="form-control">';
	for($i=1;$i<32;$i++)
	{
		if($tgl_skr==$i)
		{
			echo "<option selected>".$i."</option>";
		}
		else{
			echo "<option>".$i."</option>";
		}
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bln_mulai" class="form-control">';
	for($i=1;$i<13;$i++)
	{
		if($bln_skr==$i)
		{
			echo "<option selected>".$i."</option>";
		}
		else{
			echo "<option>".$i."</option>";
		}
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="thn_mulai" class="form-control">';
	for($i=$thn_skr-2;$i<=$thn_skr+2;$i++)
	{
		if($thn_skr==$i)
		{
			echo "<option selected>".$i."</option>";
		}
		else{
			echo "<option>".$i."</option>";
		}
	}
	echo "</select>";
	?>
	</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Selesai</label></div><div class="col-sm-3">
	<?php
	$psh=array();
	$psh=explode("-",$wkt_skr);
	$tgl_skr=$psh[0];
	$bln_skr=$psh[1];
	$thn_skr=$psh[2];
	echo '<select name="tgl_selesai" class="form-control">';
	for($i=1;$i<32;$i++)
	{
		if($tgl_skr==$i){
			echo "<option selected>".$i."</option>";
		}
		else{
			echo "<option>".$i."</option>";
		}
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bln_selesai" class="form-control">';
	for($i=1;$i<13;$i++)
	{
		if($bln_skr==$i){
		echo "<option selected>".$i."</option>";
		}
		else{
			echo "<option>".$i."</option>";
		}
	}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="thn_selesai" class="form-control">';
	for($i=$thn_skr-2;$i<=$thn_skr+2;$i++)
	{
		if($thn_skr==$i){
		echo "<option selected>".$i."</option>";
		}
		else{
		echo "<option>".$i."</option>";
		}
	}
	echo "</select>";
	?>
	</div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><input type="text" name="tempat" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu Kegiatan</label></div><div class="col-sm-9"><input type="text" name="jam" class="form-control"></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><textarea name="keterangan" rows="5" class="form-control"></textarea></div></div>
	<p class="text-center"><input type="hidden" name="proses" value="kirim"><input type="submit" value="Simpan Agenda" class="btn btn-primary"> <a href="<?php echo base_url(); ?><?php echo $tautan;?>/agenda/tampil" class="btn btn-info"><b>Batal</b></a></p>
	</form>
<?php
}
else
{
?>
	<p><a href="<?php echo base_url(); ?><?php echo $tautan;?>/agenda/tambah" class="btn btn-primary"><b>Tambah Agenda</b></a></p>
	<?php
	if(count($query->result())>0)
	{
	?>
		<div class="table-responsive">
		<table class="table table-hover table-striped table-hover table-bordered">
		<tr align="center"><td><strong>No.</strong></td><td><strong>Tema Agenda</strong></td><td><strong>Mulai</strong></td><td><strong>Selesai</strong></td><td><strong>Waktu</strong></td><td><strong>Posting</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
		<?php
		$nomor=$page+1;
		foreach($query->result() as $t)
		{
		echo "<tr><td align='center'>".$nomor."</td><td>".$t->tema_agenda."</td><td>".tanggal($t->tgl_mulai)."</td><td>".tanggal($t->tgl_selesai)."</td><td>".$t->jam."</td><td>".tanggal($t->tgl_posting)."</td><td><a href='".base_url()."".$tautan."/agenda/ubah/".$t->id_agenda."' title='Ubah Agenda'><span class=\"fa fa-edit\"></span></a></td><td><a href='".base_url()."".$tautan."/agenda/hapus/".$t->id_agenda."' onClick=\"return confirm('Anda yakin ingin menghapus agenda ini?')\" title='Hapus Agenda'><span class=\"fa fa-trash-alt\"></span></a></td></td></tr>";
		$nomor++;	
		}
		echo '</table></div>';
	}
	else
	{
		echo '<div class="alert alert-info">Belum ada agenda</div>';
	}
	if(!empty($paginator))
	{
		echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
	}
}
?>
</div></div></div>
