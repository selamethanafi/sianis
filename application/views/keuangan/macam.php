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

<?php echo form_open('keuangan/macam');
if (empty($kd))
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama pembayaran</label></div><div class="col-sm-9"><input name="nama" class="form-control" type="text" required></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9"><select name="statusdigunakan" class="form-control" required>
<option value="1">Digunakan</option>
<option value="2">Tidak Digunakan</option>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input name="nomor_urut" class="form-control" type="number" min="0"></div></div>

<p class="text-center"><input type="submit" value="Simpan Macam Pembayaran" class="btn btn-primary"></p>
<?php
}
else
{
//mode ubah
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama pembayaran</label></div><div class="col-sm-9"><input name="nama" class="form-control" type="text" value="<?php echo $macampembayaran;?>" required></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Status</label></div><div class="col-sm-9"><select name="statusdigunakan" class="form-control" required>
<?php
if ($statusdigunakan=='1')
	{
	
	echo '<option value="1">Digunakan</option>';
	echo '<option value="2">Tidak Digunakan</option>';
	}
	else
	{
	echo '<option value="2">Tidak Digunakan</option>';	
	echo '<option value="1">Digunakan</option>';
	}
?>
</select></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input name="nomor_urut" class="form-control" value="<?php echo $nomor_urut;?>" type="number" min="0"></div></div>

<input type="hidden" name="kd" value="<?php echo $kd;?>">
<p class="text-center"><input type="submit" value="Simpan Macam Pembayaran" class="btn btn-primary"></p>
</form>

<?php
}
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Macam Pembayaran</strong></td><td><strong>Status</strong></td><td><strong>Nomor Urut</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
		if ($b->status=='1')
			{
			$statusdigunakan = 'Digunakan';
			}
			else
			{
			$statusdigunakan = 'Tidak Digunakan';
			}
		$macam_pembayaran = $b->nama;
		$nomor_urut = $b->nomor_urut;
		$this->db->query("update `m_uang_besar` set `nomor_urut` = '$nomor_urut' where `macam_pembayaran`='$macam_pembayaran' and `thnajaran`='$thnajaran'");
echo '<tr><td>'.$b->nama.'</td><td>'.$statusdigunakan.'</td><td>'.$b->nomor_urut.'</td><td align="center"><a href="'.base_url().'keuangan/macam/'.$b->kd.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';

$nomor++;
}
?>
</table>
</div></div></div>
