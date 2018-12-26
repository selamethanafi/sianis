<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : terima.php
// Lokasi      : application/views/keuangan
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if(($aksi == 'tambah') or ($aksi == 'ubah'))
{?>
	<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript">
		jQuery(function($){
		$("#tanggal").mask("99-99-9999")
	});
	</script>
<?php
}

if($aksi == 'tambah')
{
echo form_open('keuangan/penerimaanlain','class="form-horizontal" role="form"');
$tanggal = tanggal(tanggal_hari_ini());
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Penerimaan / Pengembalian</label></div>
<div class="col-sm-9"><select name="jenis" class="form-control">
	<option value="dpm">dpm</option>
	<option value="syahriyah">syahriyah</option>
	</select>
</div></div>';
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		<div class="col-sm-9"><input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>" class="form-control" required></div></div>
<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Besar</label></div>
	<div class="col-sm-9"><input name="besar" type="number" class="form-control" required></div>
</div>
<div class="form-group row">
	<div class="col-sm-3"><label class="control-label">Keterangan</label></div>
	<div class="col-sm-9"><input name="keterangan" type="text" placeholder="keterangan tambahan" class="form-control"></div>
</div>
	<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>
<?php
}
elseif($aksi == 'ubah')
{
	if($query->num_rows()>0)
	{
		echo form_open('keuangan/penerimaanlain','class="form-horizontal" role="form"');
		foreach($query->result() as $q)
		{
		$tanggal = tanggal($q->tanggal);
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Penerimaan / Pengembalian</label></div>
		<div class="col-sm-9"><select name="jenis" class="form-control">
		<?php
		echo '<option value="'.$q->jenis.'">'.$q->jenis.'</option>';
		echo '<option value="Syahriyah">Syahriyah</option>';
		echo '<option value="dpm">dpm</option>';
		?>
		<select></div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		<div class="col-sm-9"><input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>" class="form-control" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar</label></div>
		<div class="col-sm-9"><input type="text" name="besar" value="<?php echo $q->besar;?>" class="form-control" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div>
		<div class="col-sm-9"><input type="text" name="keterangan" value="<?php echo $q->keterangan;?>" class="form-control"></div></div>
		<p class="text-center"><input type="hidden" name="id_penerimaan" value="<?php echo $q->id_penerimaan;?>"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp; <a href="<?php echo base_url();?>keuangan/penerimaan" class="btn btn-info">Batal</a></p>
		</form>
	<?php
		}
	}
	else
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan, <a href="'.base_url().'keuangan/keluar/tampil"><strong>Kembali</strong></a></div>';
	}

}
else
{
	echo '<p><a href="'.base_url().'keuangan/penerimaanlain/tambah" class="btn btn-info">Tambah</a></p>';
	$adaq = $query->num_rows();
	if($adaq>0)
	{
		$nomor = 1;
		echo '<table class="table table-striped table-hover table-bordered">';
		echo '<tr align="center"><td>Nomor</td><td>Jenis</td><td>Tanggal</td><td>Besar</td><td>Keterangan</td><td>Ubah</td><td>Hapus</td></tr>';
		foreach($query->result() as $q)
		{
		echo '<tr><td align="center">'.$nomor.'</td><td>'.$q->jenis.'</td><td align="center">'.tanggal($q->tanggal).'</td><td align="right">'.number_format($q->besar).'</td>
			<td>'.$q->keterangan.'</td>';
		echo '<td align="center"><a href="'.base_url().'keuangan/penerimaanlain/ubah/'.$q->id_penerimaan.'" title="Ubah Transaksi Pengeluaran"><span class="fa fa-edit"></span></td>';
		echo "<td align=\"center\"><a href='".base_url()."keuangan/penerimaanlain/hapus/".$q->id_penerimaan."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Transaksi Pengeluaran'><span class=\"fa fa-trash-alt\"></span></td>";
		echo '</tr>';
		$nomor++;
		}
		echo '</table>';
	}
	else
	{
		echo '<div class="alert alert-info">Belum ada data penerimaan / pengembalian</div>';
	}
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
}
?>
</div></div></div>
