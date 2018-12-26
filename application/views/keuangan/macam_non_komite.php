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

<?php echo form_open('keuangan/macamnonkomite/'.$id);
if (empty($id))
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama pembayaran</label></div><div class="col-sm-9"><input name="nama_tunggakan" class="form-control" type="text" required></div></div>
<p class="text-center"><input type="submit" value="Tambah Macam Pembayaran" class="btn btn-primary"></p></form>
<?php
}
else
{
	$ta = $this->db->query("select * from `non_komite_macam` where `id`='$id'");
	if($ta->num_rows() == 0)
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$macampembayaran = $a->nama_tunggakan;
		}
		//mode ubah
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama pembayaran</label></div><div class="col-sm-9"><input name="nama_tunggakan" class="form-control" type="text" value="<?php echo $macampembayaran;?>" required></div></div>
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<p class="text-center"><input type="submit" value="Simpan Macam Pembayaran" class="btn btn-primary"></p>
		</form>
		<?php
	}
}
$query = $this->db->query("select * from `non_komite_macam`");
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Macam Pembayaran</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
	echo '<tr><td>'.$b->nama_tunggakan.'</td><td><a href="'.base_url().'keuangan/macamnonkomite/'.$b->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';

$nomor++;
}
?>
</table>
</div></div></div>
