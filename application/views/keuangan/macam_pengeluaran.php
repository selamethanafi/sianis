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

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('keuangan/macampengeluaran','class="form-horizontal" role="form"');
if (empty($kd))
{
?>
<div class="form-group row">
	<label class="col-sm-3 control-label">Macam Pengeluaran</label><div class="col-sm-9"><input name="nama" type="text" class="form-control" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-3 control-label">Sumber Pengeluaran</label><div class="col-sm-9">
	<select name="sumber" class="form-control" required>
	<option value=""></option>
	<?php
	foreach($querysumber->result() as $dsumber)
	{
		echo '<option value="'.$dsumber->nama.'">'.$dsumber->nama.'</option>';
	}
	$query2 = $this->db->query("select * from `m_penerimaan` order by `macam_penerimaan`");
	foreach($query2->result() as $dsumber)
	{
		echo '<option value="'.$dsumber->macam_penerimaan.'">'.$dsumber->macam_penerimaan.'</option>';
	}
	
	?>
	</select></div>
</div>

<p class="text-center"><input type="submit" value="Simpan Macam Pengeluaran" class="btn btn-primary"></p>
</form>
<?php
}
else
{
//mode ubah
?>
<div class="form-group row">
	<label class="col-sm-3 control-label">Macam Pengeluaran</label><div class="col-sm-9"><input name="nama" value="<?php echo $datapengeluaran[0];?>" type="text" class="form-control" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-3 control-label">Sumber Pengeluaran</label><div class="col-sm-9">
	<select name="sumber" class="form-control">
	<option value="<?php echo $datapengeluaran[1];?>"><?php echo $datapengeluaran[1];?></option>
	<?php
	foreach($querysumber->result() as $dsumber)
	{
		echo '<option value="'.$dsumber->nama.'">'.$dsumber->nama.'</option>';
	}
	$query2 = $this->db->query("select * from `m_penerimaan` order by `macam_penerimaan`");
	foreach($query2->result() as $dsumber)
	{
		echo '<option value="'.$dsumber->macam_penerimaan.'">'.$dsumber->macam_penerimaan.'</option>';
	}

	?>
	</select></div>
</div>

<p class="text-center"><input type="hidden" name="kd" value="<?php echo $kd;?>"><input type="submit" value="Perbarui Macam Pengeluaran" class="btn btn-primary"></p>
</form>
<?php
}
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Macam Pembayaran</strong></td><td><strong>Sumber</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{

echo "<tr><td>".$b->jenis."</td><td>".$b->sumber."</td><td><a href='".base_url()."keuangan/macampengeluaran/".$b->id_jenis."' title='Ubah Data'><span class=\"fa fa-edit\"></span></a></td></tr>";

$nomor++;
}
?>
</table>
</div></div></div>
