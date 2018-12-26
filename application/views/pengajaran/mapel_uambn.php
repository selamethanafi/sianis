<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 04:16:05 WIB 
// Nama Berkas 		: mapel_uambn.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               admin@mantengaran.sch.id
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
<?php
$thnajaran = cari_thnajaran();
if ((!empty($mapel)) and (!empty($nmapel)) and (!empty($no_urut)) and ($proses=='oke'))
	{
	$nmapel = strtoupper($nmapel);
	$ta = $this->db->query("select * from `mapel_uambn` where `thnajaran`='$thnajaran' and `mapel` = '$mapel' and `program`='$program'");
	if(count($ta->result())==0)
		{
		$this->db->query("insert into `mapel_uambn` (`thnajaran`,`mapel`,`program`,`nmapel`,`no_urut`) values ('$thnajaran','$mapel','$program','$nmapel','$no_urut')");
		}
	}
if ($aksi == 'hapus')
	{
	$this->db->query("delete from `mapel_uambn` where `id_mapel_uambn`='$id' and `thnajaran`='$thnajaran'");
	}
if ($aksi == 'tambah')
	{

	$daftar_tapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
	$daftar_program = $this->db->query("select * from `m_program` order by `program`");
	echo form_open('pengajaran/mapeluambn','class="form-horizontal" role="form"');?>
	<?php
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">
	<select name="mapel" class="form-control">';
	echo "<option value=''></option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["nama_kategori"]."'>".$k["nama_kategori"]."</option>";
	}
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Disingkat</label></div><div class="col-sm-9">
	<input type="text" placeholdder="3 karakter saja" name="nmapel" class="form-control" required><p class="help-block">3 karakter saja</p>';
	echo '</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Program / Jurusan</label></div><div class="col-sm-9">
	<select name="program" class="form-control">';
	echo "<option value=''></option>";
	foreach($daftar_program->result_array() as $j)
	{
	echo "<option value='".$j["program"]."'>".$j["program"]."</option>";
	}
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9">
	<input type="text" name="no_urut" class="form-control" required>';
	echo '</div></div><input type="hidden" name="proses" value="oke">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">SIMPAN</button> 
	<a href="'.base_url().'pengajaran/mapeluambn" class="btn btn-info" role="button"><strong>BATAL</strong></a></p></form>';
	}
if ((empty($aksi)) or ($aksi == 'hapus'))
	{
	echo '<p><a href="'.base_url().'pengajaran/mapeluambn/tambah" class="btn btn-info" role="button"><b>TAMBAH</b></a></p>';
echo 'Tahun Pelajaran saat ini : <b>'.$thnajaran.'</b><br>';
echo '<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Program</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Mata Pelajaran (3 karakter)</strong></td><td><strong>Nomor Urut</strong></td><td><strong>Hapus</strong></td></tr>';

$query = $this->db->query("select * from `mapel_uambn` where `thnajaran` = '$thnajaran' order by `program`,`no_urut`");
$nomor = 1;
foreach($query->result() as $b)
{
echo "<tr align=\"center\"><td>".$nomor."</td><td>".$b->program."</td><td>".$b->mapel."</td><td>".$b->nmapel."</td><td>".$b->no_urut."</td><td><a href='".base_url()."pengajaran/mapeluambn/hapus/".$b->id_mapel_uambn."' onClick=\"return confirm('Anda yakin ingin menghapus ".$b->mapel." program ".$b->program." ?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td>";echo "</tr>";
$nomor++;
}
?>
</table></div>
	<?php
	}
	?>
</div></div></div>
