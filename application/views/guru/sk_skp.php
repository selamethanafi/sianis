<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 21 Nov 2014 20:44:35 WIB 
// Nama Berkas 		: sk_semester.php
// Lokasi      		: application/views/guru/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
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
<script src="<?php echo base_url(); ?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggal1").mask("99-99-9999")
	$("#tanggal2").mask("99-99-9999")
	});
</script>

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url();?>pkg/skp" class="btn btn-info">Ke SKP</a></p>
<?php
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nippegawai' and `tahun`='$tahun'");
$adatb = $tb->num_rows();
if($adatb == 0)
{
	$this->db->query("insert into `ppk_pns` (`tahun`,`kode`) values ('$nippegawai', '$tahun')");
}
$tb = $this->db->query("select * from `ppk_pns` where `kode`='$nippegawai' and `tahun`='$tahun'");
foreach($tb->result() as $b)
{
	$idskawal = $b->skawal;
	$idskakhir = $b->skakhir;
	$tawal = $b->tawal;
	$takhir = $b->takhir;
	$tambah = $b->tambah;
}
$gol1 = id_sk_jadi_golongan($idskawal) ;
$pangkat1 = golongan_jadi_pangkat($idskawal);
$jabatan1 = golongan_jadi_jabatan($idskawal);
$gol2 = id_sk_jadi_golongan($idskakhir) ;
$pangkat2 = golongan_jadi_pangkat($idskakhir);
$jabatan2 = golongan_jadi_jabatan($idskakhir);
echo form_open('pkg/skskp','class="form-horizontal" role="form"');
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Penilaian</label></div><div class="col-sm-9"><p class="form-control">'.$tahun.'</p></div></div>';
/*
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal di awal penilaian</label></div><div class="col-sm-9"><input type="text" name="tawal" value="'.tanggal($tawal).'" id="tanggal1" class="form-control"></div></div>';
*/
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">SK yang berlaku di awal penilaian</label></div><div class="col-sm-9">
	<select name="idskawal" class="form-control">';
	foreach($query->result() as $l)
	{
	echo "<option value='".$l->id."'>".$l->uraian." - ".$l->pangkat." ".substr($l->gol,3,20)."</option>";
	}
	echo '</select></div></div>';
/*
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal akhir penilaian</label></div><div class="col-sm-9"><input type="text" name="takhir" value="'.tanggal($takhir).'" id="tanggal2" class="form-control"></div></div>';
*/
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">SK yang berlaku di akhir penilaian</label></div><div class="col-sm-9">
	<select name="idskakhir" class="form-control">';
	foreach($query->result() as $l)
	{
	echo "<option value='".$l->id."'>".$l->uraian." - ".$l->pangkat." ".substr($l->gol,3,20)."</option>";
	}
	echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tambah margin dari atas (cm)</label></div><div class="col-sm-9"><input type="number" name="tambah" value="'.$tambah.'" class="form-control"></div></div>
<p class="text-center"><input type="hidden" name="proses" value="post"><input type="submit" value="Simpan Data" class="btn btn-primary"></p>
</form>';
?>
</div></div></div>
