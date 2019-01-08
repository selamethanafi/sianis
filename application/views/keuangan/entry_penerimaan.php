<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : macam.php
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
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggal").mask("99-99-9999")
	});
</script>

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php echo form_open('keuangan/entrypenerimaan/'.$id);
if (empty($id))
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama penerimaan</label></div><div class="col-sm-9">
<select name="id_m_penerimaan" class="form-control" type="text" required>
	<option value=""></option>
	<?php
	$ta = $this->db->query("select * from `m_penerimaan` order by `macam_penerimaan`");
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$a->id.'">'.$a->macam_penerimaan.'</option>';
	}
	?>
</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div>
			<div class="col-sm-9" >
			<input type="text" name="tanggal" value="" id="tanggal" class="form-control">
		</div></div>

<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar penerimaan</label></div><div class="col-sm-9"><input name="besar" class="form-control" type="text" id="rupiah" required></div></div>
<p class="text-center"><input type="submit" value="Simpan Penerimaan" class="btn btn-primary"></p>
<?php
}
else
{
	$ta = $this->db->query("select * from `m_penerimaan` where `id`='$id'");
	if($ta->num_rows() > 0)
	{
		//mode ubah
		foreach($ta->result() as $a)
		{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama penerimaan</label></div><div class="col-sm-9"><input name="macam_penerimaan" class="form-control" type="text" value="<?php echo $a->macam_penerimaan;?>" required></div></div>
		<p class="text-center"><input type="submit" value="Perbarui Macam Penerimaan" class="btn btn-primary"></p>
	<?php
		}
	}
	else
	{
		echo '<div class="alert alert-danger">data utama macam penerimaaan tidak ditemukan</div>';
	}
}
?>
</form>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Tanggal</strong></td><td><strong>Macam Penerimaan</strong></td><td><strong>Besar</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
$query = $this->db->query("select * from `penerimaan` order by `tanggal` DESC");
foreach($query->result() as $b)
{
	$id = $b->id_m_penerimaan;
	$macam = '?';
	$ta = $this->db->query("select * from `m_penerimaan` where `id`='$id'");
	foreach($ta->result() as $a)
	{
		$macam = $a->macam_penerimaan;
	}
	echo '<tr><td>'.tanggal($b->tanggal).'</td><td>'.$macam.'</td><td align="right">'.number_format($b->besar).'</td><td align="center"><a href="'.base_url().'keuangan/entrypenerimaan/'.$b->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';
	$nomor++;
}
?>
</table>
</div></div></div>
	<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
		}
	</script>

