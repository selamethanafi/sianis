<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_un.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
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
$thnajaran = cari_thnajaran();
if ((!empty($mapel)) and (!empty($nmapel)) and (!empty($no_urut)) and ($proses=='oke'))
	{
	$nmapel = strtoupper($nmapel);
	$ta = $this->db->query("select * from `mapel_un` where `thnajaran`='$thnajaran' and `mapel` = '$mapel' and `program`='$program'");
	if(count($ta->result())==0)
		{
		$this->db->query("insert into `mapel_un` (`thnajaran`,`mapel`,`program`,`nmapel`,`no_urut`, `pilihan`) values ('$thnajaran','$mapel','$program','$nmapel','$no_urut', '$pilihan')");
		}
	}
if ($aksi == 'hapus')
	{
	$this->db->query("delete from `mapel_un` where `id_mapel_un`='$id' and `thnajaran`='$thnajaran'");
	$aksi = '';
	}
if ($aksi == 'tambah')
	{
	$daftar_tapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
	$daftar_program = $this->db->query("select * from `m_program` order by `program`");
	echo form_open('pengajaran/matapelajaranujiannasional','class="form-horizontal" role="form"');?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">
	<select name="mapel" class="form-control">
	<?php
	echo "<option value=''></option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["nama_kategori"]."'>".$k["nama_kategori"]."</option>";
	}
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Disingkat</label></div><div class="col-sm-9">
	<input type="text" name="nmapel" placeholder="3 karakter saja" class="form-control" required>';
	echo '</div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Program / Jurusan</label></div><div class="col-sm-9">
		<select name="program" class="form-control">';
	echo "<option value=''></option>";
	foreach($daftar_program->result_array() as $j)
	{
	echo "<option value='".$j["program"]."'>".$j["program"]."</option>";
	}
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Pilihan</label></div><div class="col-sm-9">
		<select name="pilihan" class="form-control">';
	echo "<option value='0'>Tidak</option>";
	echo "<option value='1'>Ya</option>";
	echo '</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9">
	<input type="text" name="no_urut" class="form-control">';
	echo '</div></div></table><input type="hidden" name="proses" value="oke">
	<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Mapel UN</button>
	<a href="'.base_url().'pengajaran/matapelajaranujiannasional" class="btn btn-info" role="button">BATAL</a></p>
	</form>';
	}
if ((empty($aksi)) or ($aksi == 'hapus'))
	{
	echo '<p><a href="'.base_url().'pengajaran/matapelajaranujiannasional/tambah" class="btn btn-primary" role="button"><b>TAMBAH</b></a></p>';
	}
if(empty($aksi))
{

echo 'Tahun Pelajaran saat ini : <b>'.$thnajaran.'</b><br>';
echo '<div class="table-responsive"><table class="table table-hover table-striped table-bordered">
<tr align="center"><td width="30"><strong>No.</strong></td><td><strong>Program</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Mata Pelajaran (3 karakter)</strong></td><td><strong>Nomor Urut</strong></td><td><strong>Pilihan</strong></td><td><strong>Hapus</strong></td></tr>';
$query = $this->db->query("select * from `mapel_un` where `thnajaran` = '$thnajaran' order by `program`,`no_urut`");
$nomor = 1;
foreach($query->result() as $b)
{
echo "<tr><td  align=\"center\">".$nomor."</td><td>".$b->program."</td><td>".$b->mapel."</td><td>".$b->nmapel."</td><td>".$b->no_urut."</td><td>".$b->pilihan."</td><td  align=\"center\"><a href='".base_url()."index.php/pengajaran/matapelajaranujiannasional/hapus/".$b->id_mapel_un."' onClick=\"return confirm('Anda yakin ingin menghapus ".$b->mapel." program ".$b->program." ini?')\" title='Hapus'><span class=\"fa fa-trash-alt\"></span></a></td>";echo "</tr>";
$nomor++;
}
?>
</table></div>
<?php
}
?>
</div></div></div>
