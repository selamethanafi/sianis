<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: mapel_ijazah.php
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
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
$xloc = base_url().'pengajaran/mapelijazah';
$tmapel = $this->db->query("select * from `tblkategoritutorial` order by `nama_kategori`");
if($aksi == 'ubah')
{
	$ta = $this->db->query("select * from `m_mapel_ijazah` where `id`='$id'");
	if($ta->num_rows()>0)
	{
		foreach($ta->result() as $a)
		{
			$mapele = $a->mapel;
			$cacahe = $a->cacah_semester;
			$urute = $a->no_urut;
			$jurusan = $a->jurusan;
			$jenis = $a->jenis;
		}
		echo form_open('pengajaran/mapelijazah/'.$tahun1,'class="form-horizontal" role="form"');?>
		<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9">
			<select name="thnajaran" class="form-control">
			<?php
			echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
			?>
			</select></div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><select name="mapel" class="form-control">
		<?php
		echo '<option value="'.$mapele.'">'.$mapele.'</option>';
		foreach($tmapel->result_array() as $m)
		{
		echo "<option value='".$m["nama_kategori"]."'>".$m["nama_kategori"]."</option>";
		}
		echo '</select></div></div>';
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jurusan</label></div><div class="col-sm-9"><select name="jurusan" class="form-control" required>
		<?php
		echo '<option value="'.$jurusan.'">'.$jurusan.'</option>';
		$tb = $this->db->query("select * from `m_program`");
		foreach($tb->result() as $b)
		{
			echo '<option value="'.$b->program.'">'.$b->program.'</option>';
		}
		echo '
		</select></div></div>';
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis</label></div><div class="col-sm-9"><select name="jenis" class="form-control">
		<?php
		if($jenis == 1)
		{
			echo '<option value="'.$jenis.'">Mapel keterampilan</option>';
			echo '<option value="2">Mapel mulok</option>';
			echo '<option value="">Bukan mapel keterampilan, bukan mapel mulok</option>';

		}
		elseif($jenis == 2)
		{
			echo '<option value="2">Mapel mulok</option>';
			echo '<option value="1">Mapel keterampilan</option>';
			echo '<option value="">Bukan mapel keterampilan, bukan mapel mulok</option>';
		}
		else
		{
			echo '<option value="">Bukan mapel keterampilan, bukan mapel mulok</option>';
			echo '<option value="2">Mapel mulok</option>';
			echo '<option value="1">Mapel keterampilan</option>';

		}
		echo '
		</select></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="no_urut" value="'.$urute.'" class="form-control"></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Semester yang termasuk penilaian</label></div><div class="col-sm-9"><div class="input-group"><input type="number" name="cacah_semester" value="'.$cacahe.'" min="0" max="8" class="form-control"><span class="input-group-addon">Kalau kosong, rata - rata nilai rapor mengikuti tahun penilaian</span></div></div>';
		echo '<input type="hidden" name="proses" value="ubah"><input type="hidden" name="id_post" value="'.$id.'"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button></p></div></div></form>';
	}
	else
	{
		echo '<div class="alert alert-info">data tidak ditemukan, <a href="'.base_url().'pengajaran/mapelijazah" class="btn btn-primary">Batal</a></div>';
	}
}
else
{
	echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
	if(!empty($tahun1))
	{
		$tahun2 = $tahun1 + 1;
		$thnajaran = $tahun1.'/'.$tahun2;
	}
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\" required>";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div></form>';
	if(!empty($tahun1))
	{
		$query = $this->db->query("select * from `tahun_penilaian` where `thnajaran` = '$thnajaran' order by `thnajaran_penilaian` DESC, `semester` DESC");
		$cacahe = $query->num_rows();
		echo form_open('pengajaran/mapelijazah/'.$tahun1,'class="form-horizontal" role="form"');
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9"><select name="mapel" class="form-control" required><option value=""></option>';
		foreach($tmapel->result_array() as $m)
		{
		echo "<option value='".$m["nama_kategori"]."'>".$m["nama_kategori"]."</option>";
		}
		echo '</select></div></div>';
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jurusan</label></div><div class="col-sm-9"><select name="jurusan" class="form-control" required>
		<?php
		echo '<option value=""></option>';
		$tb = $this->db->query("select * from `m_program`");
		foreach($tb->result() as $b)
		{
			echo '<option value="'.$b->program.'">'.$b->program.'</option>';
		}
		echo '
		</select></div></div>';
		?>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Jenis</label></div><div class="col-sm-9"><select name="jenis" class="form-control">
		<?php
		echo '<option value="">Bukan mapel keterampilan, bukan mapel mulok</option>';
		echo '<option value="2">Mapel mulok</option>';
		echo '<option value="1">Mapel keterampilan</option>';
		echo '</select></div></div>';
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nomor Urut</label></div><div class="col-sm-9"><input type="text" name="no_urut" class="form-control" required></div></div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Cacah Semester yang termasuk penilaian</label></div><div class="col-sm-9"><div class="input-group"><input type="number" name="cacah_semester" value="'.$cacahe.'" min="0" max="8" class="form-control"><span class="input-group-addon">Kalau kosong, rata - rata nilai rapor mengikuti tahun penilaian</span></div></div></div>';
		echo '<input type="hidden" name="proses" value="tambah"><input type="hidden" name="thnajaran" value="'.$thnajaran.'"><p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan Data</button></p></div></div>';
	echo '</form>';
	echo '<h2>Tahun Penilaian</h2>';
	echo '<div class="table-responsive">';
	echo '<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>Tahun Pelajaran</strong></td><td><strong>Semester</strong></td><td>Tingkat</td></tr>';

	$query = $this->db->query("select * from `tahun_penilaian` where `thnajaran` = '$thnajaran' order by `thnajaran_penilaian` DESC, `semester` DESC");
	$nomor = 1;
	foreach($query->result() as $b)
	{
		echo '<tr align="center"><td>'.$nomor.'</td><td>'.$b->thnajaran_penilaian.'</td><td>'.$b->semester.'</td><td>'.$b->tingkat.'</td></tr>';
		$nomor++;
	}
	?>
</table></div>
	<h2>Daftar Mata Pelajaran Ijazah</h2>
	<div class="table-responsive"><table class="table table-hover table-bordered">
	<tr align="center"><td width="30"><strong>No Urut</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Cacah Semester yang diperhitungkan</strong></td><td><strong>Jurusan</strong></td><td><strong>Jenis Mapel</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
	<?php
	foreach($daftar_mapel->result() as $b)
	{
		$jenisx = $b->jenis;
		if($jenisx == 1)
		{
			$jenisxx = 'Keterampilan';
		}
		elseif($jenisx == 2)
		{
			$jenisxx = 'Muatan lokal';
		}
		else
		{
			$jenisxx = '';
		}
		echo '<tr><td align="center">'.$b->no_urut.'</td><td>'.$b->mapel.'</td><td align="center">'.$b->cacah_semester.'</td><td align="center">'.$b->jurusan.'</td><td align="center">'.$jenisxx.'</td>';
		echo '<td align="center"><a href="'.base_url().'pengajaran/mapelijazah/'.$tahun1.'/ubah/'.$b->id.'"><span class="fa fa-edit"></span></a></td><td align="center"><a href="'.base_url().'pengajaran/mapelijazah/'.$tahun1.'/hapus/'.$b->id.'" data-confirm="Anda yakin ingin menghapus record ini?" title="Hapus"><span class="fa fa-trash-alt"></span></a></td>';
echo '</tr>';
	}
	?>
	</table></div>
<?php
	echo 'Kalau data sudah benar, proses data awal leger ijazah, <a href="'.base_url().'pengajaran/legerijazahnamasaja" class="btn btn-primary">PROSES DATA AWAL LEGER</a>';

	}
}
?>
</div></div></div>
