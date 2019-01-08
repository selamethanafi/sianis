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

<?php echo form_open('keuangan/macampenerimaan/'.$nomor);
if (empty($nomor))
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama penerimaan</label></div><div class="col-sm-9"><input name="macam_penerimaan" class="form-control" type="text" required></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor urut</label></div><div class="col-sm-9"><input name="nomor" class="form-control" type="number" min="4" required>lebih dari 3</div></div>
<p class="text-center"><input type="submit" value="Simpan Macam Penerimaan" class="btn btn-primary"></p>
<?php
}
else
{
	$ta = $this->db->query("select * from `m_penerimaan` where `nomor`='$nomor'");
	if($ta->num_rows() > 0)
	{
		//mode ubah
		foreach($ta->result() as $a)
		{
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama penerimaan</label></div><div class="col-sm-9"><input name="macam_penerimaan" class="form-control" type="text" value="<?php echo $a->macam_penerimaan;?>" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor urut</label></div><div class="col-sm-9"><input name="nomorss" value="<?php echo $a->nomor;?>" class="form-control" type="number" min="4" required readonly></div></div>
		<p class="text-center"><input type="submit" value="Perbarui Macam Penerimaan" class="btn btn-primary"></p>
	<?php
		}
	}
	else
	{
		echo '<div class="alert alert-danger">data tidak ditemukan</div>';
	}
}
?>
</form>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Macam Penerimaan</strong></td><td><strong>Nomor Urut</strong></td><td><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
$query = $this->db->query("select * from `m_penerimaan` order by `macam_penerimaan`");
foreach($query->result() as $b)
{
	echo '<tr><td>'.$b->macam_penerimaan.'</td><td align="center">'.$b->nomor.'</td><td align="center"><a href="'.base_url().'keuangan/macampenerimaan/'.$b->nomor.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';
	$nomor++;
}
?>
</table>
</div></div></div>
