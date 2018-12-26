<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: konversi_nilai.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
	<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">

<?php
if (!empty($id_predikat))
{
	$ta = $this->db->query("select * from `m_predikat` where `id_predikat`='$id_predikat'");
	if(count($ta->result())==0)
	{
		header('Location: '.base_url().'pengajaran/konversinilai');
	}
	foreach($ta->result() as $a)
	{
	$batas = $a->batas;
	$konversi = $a->konversi;
	$predikat = $a->predikat;
	$positif = $a->positif;
	$keterangan = $a->keterangan;
	$keterangan2 = $a->keterangan2;
	$predikat_2015 = $a->predikat_2015;
	}
	?>
<?php echo form_open('pengajaran/konversinilai','class="form-horizontal" role="form"');?>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Batas</label></div>
		<div class="col-sm-9"><input type="text" name="batas" value="<?php echo $batas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Termasuk nilai baik</label></div>
		<div class="col-sm-9"><select name="positif" class="form-control">
		<?php
		if ($positif == 1)
		{
			echo '<option value="1">Ya</option>
			 <option value="0">Tidak</option>';
		}
		else
		{echo '<option value="0">Tidak</option>
			<option value="1">Ya</option>';
		}
		?>
		</select></div>
	</div>

	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Konversi</label></div>
		<div class="col-sm-9"><input type="text" name="konversi" value="<?php echo $konversi;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Predikat</label></div>
		<div class="col-sm-9"><input type="text" name="predikat" value="<?php echo $predikat;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Frasa Awal Deskripsi Pengetahuan</label></div>
		<div class="col-sm-9"><input type="text" name="keterangan" value="<?php echo $keterangan;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Frasa Awal Deskripsi Keterampilan</label></div>
		<div class="col-sm-9"><input type="text" name="keterangan2" value="<?php echo $keterangan2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Predikat Nilai</label></div>
		<div class="col-sm-9"><input type="text" name="predikat_2015" value="<?php echo $predikat_2015;?>" class="form-control"></div>
	</div>

	<input type="hidden" name="id_predikat" value="<?php echo $id_predikat;?>" class="form-control">
	<input type="hidden" name="diproses" value="simpan" class="form-control">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button></p>
	</form>
	<?php
}
else
{
?>
<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td><strong>No.</strong></td><td><strong>Batas</strong></td><td><strong>Konversi Nilai</strong></td><td><strong>Predikat</strong></td><td><strong>Frasa Awal Deskripsi Capaian Kompetensi</strong></td><td><strong>Frasa Awal Deskripsi Keterampilan</strong></td><td><strong>Predikat Nilai</strong></td><td><strong>Positif</strong></td><td width="30"><strong>Aksi</strong></td></tr>
<?php
$query = $this->db->query("select * from `m_predikat` order by `batas`");
$nomor=1;
foreach($query->result() as $b)
{
echo "<tr><td align=\"center\">".$nomor."</td><td align=\"center\">".$b->batas."</td><td align=\"center\">".$b->konversi."</td><td align=\"center\">".$b->predikat."</td><td>".$b->keterangan."</td><td>".$b->keterangan2."</td><td>".$b->predikat_2015."</td><td align=\"center\">".$b->positif."</td><td align=\"center\"><a href='".base_url()."index.php/pengajaran/konversinilai/".$b->id_predikat."' title='Edit'><span class=\"fa fa-edit\"></span></a></td></tr>";
$nomor++;
}
?>
</table></div>
<?php
 }?>
</div></div></div>
