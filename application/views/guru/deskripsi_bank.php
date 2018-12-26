<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi_impor.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
		<div class="card-body">

<?php
if ($proses == 'tambah')
	{
	$deskripsi = preg_replace("/'/","`", $deskripsi);
	$this->db->query("insert into `bank_deskripsi` (`kodeguru`,`tingkat`,`mapel`,`deskripsi`) values ('$kodeguru','$tingkat','$mapel','$deskripsi')");
	$pesannya = 'Berhasil menambah data.';
	}
if ($proses == 'ubah')
	{
	$deskripsi = preg_replace("/'/","`", $deskripsi);
	$this->db->query("update `bank_deskripsi` set `tingkat`='$tingkat',`mapel`='$mapel',`deskripsi`='$deskripsi' where `kodeguru`='$kodeguru' and `id_bank_deskripsi`='$id_bank_deskripsine'");
	$pesannya = 'Berhasil mengubah data.';
	}
if ($aksi == 'hapus')
	{
	$this->db->query("delete from `bank_deskripsi` where `kodeguru`='$kodeguru' and `id_bank_deskripsi`='$id_bank_deskripsi'");
	$pesannya = 'Berhasil menghapus data.';
	}

if( ($proses == 'tambah') or ($proses == 'ubah') or ($aksi == 'hapus'))
	{?>
		<div class="alert alert-success">
		<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
	        <strong>Sukses!</strong> <?php echo $pesannya;?>
	     </div>
	<?php
	}

if ($aksi == 'tambah')
{
	$tmapel = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
	echo form_open('guru/bankdeskripsi','class="form-horizontal" role="form"');
	?>
		<h4>Tambah</h4>
		<div class="form-group row row">
			<div class="col-sm-3" ><label  class="control-label">Tingkat</label></div>
			<div class="col-sm-9" >
	 			<select name="tingkat" class="form-control">
				<?php
				echo '<option value="">'.$tingkat.'</option>';
				echo '<option value="X">X</option><option value="XI">XI</option><option value="XII">XII</option>';
				echo '</select>';
				?>
			</div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3" ><label class="control-label">Mata Pelajaran</label></div>
			<div class="col-sm-9" >
 				<select name="mapel" class="form-control">
				<?php
				echo '<option value="">'.$mapel.'</option>';
				$tc = $this->db->query("SELECT * from tblkategoritutorial order by `nama_kategori`");
				foreach($tc->result() as $c)
				{
					$namamapel = $c->nama_kategori;
					echo "<option value='".$c->nama_kategori."'>".$c->nama_kategori."</option>";
				}
				echo '</select>';
				?>	
			</div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3" ><label class="control-label">Deskripsi</label></div>
			<div class="col-sm-9" ><textarea name="deskripsi" class="form-control" rows="3"></textarea></div>
			</div>
		</div>
		<p class="text-center"><input type="hidden" name="proses" value="tambah"><button type="submit" class="btn btn-primary">SIMPAN DESKRIPSI</button> <a href="<?php echo base_url(); ?>guru/bankdeskripsi" class="btn btn-info" role="button">BATAL</a></p>
		</form>
	<?php

	}
if ($aksi == 'ubah')
	{
	$mapel = '';
	$tingkat = '';
	$deskripsi = '';
	$td = $this->db->query("SELECT * FROM `bank_deskripsi` where `id_bank_deskripsi`='$id_bank_deskripsi'");
	foreach($td->result() as $d)
		{
		$mapel = $d->mapel;
		$tingkat = $d->tingkat;
		$deskripsi = $d->deskripsi;
		}
	$tmapel = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
	echo form_open('guru/bankdeskripsi','class="form-horizontal" role="form"');
	?>
	<h4>Ubah</h4>
		<div class="form-group row row">
			<div class="col-sm-3" ><label  class="control-label">Tingkat</label></div>
			<div class="col-sm-9" >
	 			<select name="tingkat" class="form-control">
				<?php
				echo '<option value="'.$tingkat.'">'.$tingkat.'</option>';
				echo '<option value="X">X</option><option value="XI">XI</option><option value="XII">XII</option>';
				echo '</select>';
				?>
			</div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3" ><label class="control-label">Mata Pelajaran</label></div>
			<div class="col-sm-9" >
 				<select name="mapel" class="form-control">
				<?php
				echo '<option value="'.$mapel.'">'.$mapel.'</option>';
				$tc = $this->db->query("SELECT * from tblkategoritutorial order by `nama_kategori`");
				foreach($tc->result() as $c)
				{
					$namamapel = $c->nama_kategori;
					echo "<option value='".$c->nama_kategori."'>".$c->nama_kategori."</option>";
				}
				echo '</select>';
				?>	
			</div>
		</div>
		<div class="form-group row row">
			<div class="col-sm-3" ><label class="control-label">Deskripsi</label></div>
			<div class="col-sm-9" ><textarea name="deskripsi" class="form-control" rows="3"><?php echo $deskripsi;?></textarea></div>
		</div>
		<p class="text-center"><input type="hidden" name="proses" value="ubah"><input type="hidden" name="id_bank_deskripsi" value="<?php echo $id_bank_deskripsi;?>"><button type="submit" class="btn btn-primary">SIMPAN PERUBAHAN DESKRIPSI</button> <a href="<?php echo base_url(); ?>guru/bankdeskripsi" class="btn btn-info" role="button">BATAL</a></p>
	</form>
	<?php
	}

if(($aksi == 'tambah') or ($aksi == 'ubah'))
{

}
else
{
?>
<?php
echo '<a href="'.base_url().'guru/bankdeskripsi/tambah" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span><b>Deskripsi</b></a><p></p>';
$query = $this->db->query("select * from `bank_deskripsi` where kodeguru = '$kodeguru' order by tingkat ASC, mapel ASC, deskripsi ASC");
echo '<div class="table-responsive">
<table class="table table-hover table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Tingkat</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Deskripsi</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>';
$nomor=1;
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
	echo "<tr><td align='center'>".$nomor."</td><td>".$t->tingkat."</td><td>".$t->mapel."</td><td>".$t->deskripsi."</td><td align=center><a href='".base_url()."guru/bankdeskripsi/ubah/".$t->id_bank_deskripsi."' title='Ubah deskripsi capaian kompetensi'><span class='fa fa-edit'></span></a></td><td align=center><a href='".base_url()."guru/bankdeskripsi/hapus/".$t->id_bank_deskripsi."' onClick=\"return confirm('Anda yakin ingin menghapus datum ini?')\" title='Hapus Deskripsi'><span class='fa fa-trash-alt'></span></a></td></tr>";
$nomor++;	
	}
}
else
{
echo "<tr><td colspan='10'>Belum ada data deskripsi.</td></tr>";
}
?>
</table></div>
<?php
}
?>
</div></div>
</div>

