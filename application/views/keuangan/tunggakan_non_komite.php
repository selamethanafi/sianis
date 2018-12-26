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

<?php echo form_open('keuangan/tunggakannonkomite/'.$nis.'/'.$id);
if (empty($id))
{
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama </label></div><div class="col-sm-9"><?php echo nis_ke_nama($nis);?></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama tunggakan</label></div><div class="col-sm-9"><select name="id_non_komite" class="form-control" required>
	<?php
	echo '<option value=""></option>';
	$tb = $this->db->query("select * from `non_komite_macam` order by `nama_tunggakan`");
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$b->id.'">'.$b->nama_tunggakan.'</option>';
	}
	?>
	</select>
	</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar tunggakan</label></div><div class="col-sm-9"><input name="besar" class="form-control" type="text" required></div></div>
	<p class="text-center"><input type="submit" value="Simpan Tunggakan Pembayaran" class="btn btn-primary"></p></form>
<?php
}
else
{
	$ta = $this->db->query("select * from `non_komite_besar` where `id`='$id'");
	if($ta->num_rows() == 0)
	{
		echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
	}
	else
	{
		foreach($ta->result() as $a)
		{
			$id_non_komite = $a->id_non_komite;
		}
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama </label></div><div class="col-sm-9"><?php echo nis_ke_nama($nis);?></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama tunggakan</label></div><div class="col-sm-9"><select name="id_non_komite" class="form-control" required>
	<?php
		$tc = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
		$nama_tunggakan = '';
		foreach($tc->result() as $c)
		{
			$nama_tunggakan = $c->nama_tunggakan;
		}
		echo '<option value="'.$id_non_komite.'">'.$nama_tunggakan.'</option>';
		$tb = $this->db->query("select * from `non_komite_macam` order by `nama_tunggakan`");
		foreach($tb->result() as $b)
		{
			echo '<option value="'.$b->id.'">'.$b->nama_tunggakan.'</option>';
		}
		?>
		</select>
		</div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Besar tunggakan</label></div><div class="col-sm-9"><input name="besar" class="form-control" type="text" value="<?php echo $a->besar;?>" required></div></div>
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<p class="text-center"><input type="submit" value="Simpan Macam Pembayaran" class="btn btn-primary"></p>
		</form>
		<?php
	}
}
$query = $this->db->query("select * from `non_komite_besar` where `nis`='$nis'");
?>
<table class="table table-striped table-hover table-bordered">
<tr align="center"><td><strong>Macam Pembayaran</strong></td><td><strong>Besar</strong></td><td width="50"><strong>Aksi</strong></td></tr>
<?php
$nomor=1;
foreach($query->result() as $b)
{
	$id_non_komite = $b->id_non_komite;
	$nama_tunggakan = 'nama tunggakan tidak ditemukan';
	$tc = $this->db->query("select * from `non_komite_macam` where `id`='$id_non_komite'");
	foreach($tc->result() as $c)
	{
		$nama_tunggakan = $c->nama_tunggakan;
	}
	echo '<tr><td>'.$nama_tunggakan.'</td><td align="right">'.number_format($b->besar).'</td><td align="center"><a href="'.base_url().'keuangan/tunggakannonkomite/'.$nis.'/'.$b->id.'" title="Ubah Data"><span class="fa fa-edit"></span></a></td></tr>';

$nomor++;
}
?>
</table>
</div></div></div>
