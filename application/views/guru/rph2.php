<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : rph.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$xloc = base_url().'guru/rph';
$tahun2 = $tahun1 + 1;
$thnajaran = $tahun1.'/'.$tahun2;
?>
<form class="form-horizontal" role="form">
     <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
<?php
echo "<select name=\"noyangdicetak\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'/'.$semester.'">'.$a->thnajaran.'</option>';
	}
	echo '</select></div></div>';
?>
     <div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
<?php
echo "<select name=\"noyangdicetak\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	if($semester == 1)
	{
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
		echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	}
	else
	{
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
		echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	}

	echo '</select></div></div>';
?>
</form>
<p><?php echo '<a href="'.base_url().'guru/rphlain2" class="btn btn-info"><b>Tambah/Ubah RPH/BPH</b></a>';?>&nbsp;&nbsp;&nbsp;<?php echo '<a href="'.base_url().'guru/rphtanggal2" class="btn btn-info"><b>Tampil, Ubah, Salin RPH/BPH tanggal tertentu</b></a></p>';?>

<?php
$tahun3 = $tahun2 + 1;
$nomor=$page+1;
echo '<div class="table-responsive">
<table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Tanggal</strong></td><td><strong>Jam Ke-</strong></td><td><strong>Kelas</strong></td><td><strong>Mapel</strong></td><td><strong>Kode RPP</strong></td><td><strong>Rencana</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Aksi</strong></td><td colspan="2"><strong>Salin ke Thnajaran '.$tahun2.'/'.$tahun3.'</strong></td></tr>';
if(count($query->result())>0)
{
	foreach($query->result() as $t)
	{
//date("l", mktime(0, 0, 0, 7, 1, 2000));
	$kode_rpp = $t->kode_rpp;
	$no_rpp = '';
	$dinane = tanggal_ke_hari($t->tanggal);
	$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
	$rencana ='';
	foreach($trpp->result() as $rpp)
		{
						$rencana = $rpp->rencana;
		$no_rpp = $rpp->no_rpp;
					
					}
	echo "<tr valign=\"top\"><td>".$nomor."</td><td>".$dinane.", ".date_to_long_string($t->tanggal)."</td><td>".$t->jamke."</td><td>".$t->kelas."</td><td>".$t->mapel."</td><td><b>".tanpa_paragraf($kode_rpp)." / ".$no_rpp."</b></td><td>".tanpa_paragraf($rencana)."</td><td>".tanpa_paragraf($t->keterangan)."</td><td>
<a href='".base_url()."guru/ubahrph/".$t->id_rph."' title='Ubah Rencana Pelaksanaan Harian'><span class='fa fa-edit'></span></a></td><td align=\"center\"><a href='".base_url()."guru/hapusrph2/".$t->id_rph."' onClick=\"return confirm('Anda yakin ingin menghapus data RPH dan BPH ini?')\" title='Hapus Data'><span class='fa fa-trash-alt'></span></a></td><td align=\"center\"><a href='".base_url()."guru/ubahrph/".$t->id_rph."/".$tahun2."/1' title='Salin ke Semester 1'>SMT 1</a></td><td align=\"center\"><a href='".base_url()."guru/ubahrph/".$t->id_rph."/".$tahun2."/2' title='Salin ke Semester 2'>SMT 2</a></td></tr></tr>";
	$nomor++;
	}

}
else
{
echo "<tr><td colspan='5'>Belum ada data RPH</td></tr>";
}
echo '</table></div>';
?>
<?php
if (!empty($paginator))
	{
	?>
	?>
	<div class="col-md-12 text-center">
	<?php echo $paginator;?></div>
	<?php }?>
</div></div></div>
