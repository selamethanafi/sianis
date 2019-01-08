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
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<?php
if(($aksi == 'tambah') or ($aksi == 'ubah'))
{?>
<script type="text/javascript">

$(function(){

$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('keuangan/pilihmacampembayaran') ?>",
cache: false,
});

$("#provinsi").change(function(){

var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kabupaten',id:value},
success: function(respond){
$("#kabupaten-kota").html(respond);
}
})
}

});


$("#kabupaten-kota").change(function(){
var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kecamatan',id:value},
success: function(respond){
$("#kecamatan").html(respond);
}
})
}
})


})

</script>
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>

<script type="text/javascript">
	jQuery(function($){
	$("#tanggal").mask("99-99-9999")
	});
</script>

<?php
}
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
if($aksi == 'tambah')
{
	?>
	<?php echo form_open('keuangan/keluar','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Sumber Pengeluaran</label></div><div class="col-sm-9">
	<select name="sumber" class="form-control" id="provinsi" required>
	<option value='0'>--pilih--</option>
	<option value='1'>Syahriyah</option>
	<option value='2'>dpm</option>
	<option value='3'>infaq</option>
	<?php
	$tb = $this->db->query("select * from `m_penerimaan` order by `macam_penerimaan`");
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$b->nomor.'">'.$b->macam_penerimaan.'</option>';
	}
	?>

	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Macam Pengeluaran</label></div><div class="col-sm-9">
	<select name="jenis" class="form-control" id="kabupaten-kota"  required>
	<option value='0'>--pilih--</option>
	</select>
	</div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		<div class="col-sm-9"><input type="text" name="tanggal" id="tanggal" class="form-control" required></div></div>

	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar</label></div>
		<div class="col-sm-9"><input type="text" name="besar" class="form-control" required></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div>
		<div class="col-sm-9"><input type="text" name="keterangan" class="form-control"></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="cotrol-label">Penerima</label></div>
		<div class="col-sm-9"><input type="text" name="penerima" class="form-control" rquired></div></div>
	<p class="text-center"><input type="hidden" name="proses" value="baru"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp; <a href="<?php echo base_url();?>keuangan/keluar" class="btn btn-info">Batal</a></p>
	</form>

	<?php

}
elseif($aksi == 'ubah')
{
	if($query->num_rows()>0)
	{
		echo form_open('keuangan/keluar','class="form-horizontal" role="form"');
		foreach($query->result() as $q)
		{
			$tanggal = tanggal($q->tanggal);
			$macam_penerimaan = $q->sumber;
			if($q->sumber == 'Syahriyah')
			{
				$sumbere = '1';
			}
			elseif($q->sumber == 'dpm')
			{
				$sumbere = '2';
			}
			elseif($q->sumber == 'Infaq/jariyah')
			{
				$sumbere = '3';
			}
			else
			{
				$ta = $this->db->query("select * from `m_penerimaan` where `macam_penerimaan`='$macam_penerimaan'");
				foreach($ta->result() as $data )
				{
					$sumbere = $data->nomor;
				}
			}

		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Sumber Dana Operasional</label></div>
		<div class="col-sm-9"><select name="sumber" id="provinsi" class="form-control" required>
		<?php
		echo '<option value="'.$sumbere.'">'.$macam_penerimaan.'</option>
		<option value="1">Syahriyah</option><option value="2">dpm</option><option value="3">Infaq/jariyah</option>';
		?>
		</select></div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis Pengeluaran</label></div>
		<div class="col-sm-9"><select name="jenis" class="form-control">
		<?php
		$ta = $this->db->query("select * from `m_jenis_pengeluaran`");
		echo '<option value="'.$q->jenis.'">'.$q->jenis.'</option>';
		foreach($ta->result() as $a)
		{
			?>
			<option value="<?php echo $a->jenis;?>"><?php echo $a->jenis;?></option>
			<?php
		}
		?>
		</select></div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div>
		<div class="col-sm-9"><input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggal;?>" class="form-control" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar</label></div>
		<div class="col-sm-9"><input type="text" name="besar" value="<?php echo $q->besar;?>" class="form-control" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div>
		<div class="col-sm-9"><input type="text" name="keterangan" value="<?php echo $q->keterangan;?>" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="cotrol-label">Penerima</label></div>
		<div class="col-sm-9"><input type="text" name="penerima" value="<?php echo $q->penerima;?>" class="form-control" rquired></div></div>
		<p class="text-center"><input type="hidden" name="id_keluar" value="<?php echo $q->id_keluar;?>"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp; <a href="<?php echo base_url();?>keuangan/keluar" class="btn btn-info">Batal</a></p>
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
	echo '<p><a href="'.base_url().'keuangan/keluar/tambah" class="btn btn-info">Tambah</a></p>';
	$adaq = $query->num_rows();
	if($adaq>0)
	{
		$nomor = 1 + $page;
		echo '<table class="table table-striped table-hover table-bordered">';
		echo '<tr align="center"><td>Nomor</td><td>Sumber</td><td>Tanggal</td><td>Besar</td><td>Pengeluaran</td><td>Penerima</td><td>Keterangan</td><td>Ubah</td><td>Cetak<br />Kuintasi</td><td>Hapus</td></tr>';
		foreach($query->result() as $q)
		{
		echo '<tr><td align="center">'.$nomor.'</td><td>'.$q->sumber.'</td><td align="center">'.tanggal($q->tanggal).'</td><td align="right">'.number_format($q->besar).'</td>
			<td>'.$q->jenis.'</td><td>'.$q->penerima.'</td><td>'.$q->keterangan.'</td>';
		echo '<td align="center"><a href="'.base_url().'keuangan/keluar/ubah/'.$q->id_keluar.'" title="Ubah Transaksi Pengeluaran"><span class="fa fa-edit"></span></td>';
		echo '<td align="center"><a href="'.base_url().'keuangan/keluar/cetak/'.$q->id_keluar.'" title="Cetak bukti Pengeluaran"><span class="fa fa-print"></span></td>';
		echo "<td align=\"center\"><a href='".base_url()."keuangan/keluar/hapus/".$q->id_keluar."' onClick=\"return confirm('Anda yakin ingin menghapus record ini?')\" title='Hapus Transaksi Pengeluaran'><span class=\"fa fa-trash-alt\"></span></td>";
		echo '</tr>';
		$nomor++;
		}
		echo '</table>';
	}
	else
	{
		echo '<div class="alert alert-info">Belum ada data pengeluaran</div>';
	}
	echo '<h5><p class="text-center">'.$paginator.'</p></h5>';
}
?>
</div></div></div>



