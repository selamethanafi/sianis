<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: form_impor_nilai_psikomotor.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 01 Jul 2015 09:56:09 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Selamet Hanafi
//               sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Selamet Hanafi
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo base_url(); ?>guru/psikomotor/" class="btn btn-info"><b> Kembali</b></a></p>
<table width="100%">
<tr><td width="40%"><strong>Tahun Pelajaran.</strong></td><td>: <strong><?php echo $thnajaran?></strong></td></tr>
<tr><td><strong>Semester</strong></td><td>: <strong><?php echo $semester;?></strong></td></tr>
<tr><td><strong>Kelas</strong></td><td>: <strong><?php echo $kelas;?></strong></td></tr>
<tr><td><strong>Mata Pelajaran</strong></td><td>: <strong><?php echo $mapel;?></strong></td></tr>
<?php
if(($itemnilai>1) and ($itemnilai < 11))
{
	$tap = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
	foreach($tap->result() as $dap)
	{
	$iteme = "p".$itemnilai;
	$penilaian = $dap->$iteme;
	$cacahitem = $dap->np;
	}
}
else
{
	$tap = $this->db->query("select * from `m_mapel` where thnajaran='$thnajaran' and semester='$semester' and kelas='$kelas' and mapel='$mapel'");
	foreach($tap->result() as $dap)
	{
	$cacahitem = $dap->np;
	}

	$penilaian = 'semua';
}
?>
<tr><td><strong>Penilaian</strong></td><td>: <strong><?php echo $penilaian;?></strong></td></tr>
<tr><td><strong>Cacah Item Penilaian</strong></td><td>: <strong><?php echo $cacahitem;?></strong></td></tr>
</table>

<?php echo form_open_multipart('guru/prosesunggahnilaipsikomotor/'.$id_mapel,'class="form-horizontal" role="form"');
if($itemnilai == 'semua')
{
	echo '<div class="alert alert-info">format data<p>"nis","nama","kelas","p1","p2","p3","p4","p5","p6","p7","p8","p9","p10","pesan"</p></div>';
}
else
{
	echo '<div class="alert alert-info">format data<p>"nis","nama","kelas","nilai","pesan"</p></div>';
}
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Berkas</label></div><div class="col-sm-9"><p class="form-control-static"><input type="file" name="csvfile"></div></div>
<input type="hidden" name="cacahitem"  value ="<?php echo $cacahitem;?>">
<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
<input type="hidden" name="semester" value="<?php echo $semester;?>">
<input type="hidden" name="itemnilai" value="<?php echo $itemnilai;?>">
<input type="hidden" name="tugas" value="<?php echo $penilaian;?>">
<p class="text-center"><input type="submit" value="Kirim Berkas" class="btn btn-primary"></p>
</form>
</div></div></div>
