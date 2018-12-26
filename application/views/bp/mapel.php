<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_nilai.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 17 Mei 2016 20:40:06 WIB 
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
<?php
$xloc = base_url().'bp/mapel';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';?>
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php
if(!empty($tahun1))
{?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo base_url().'bp/mapel';?>">Tahun Pelajaran</a></label></div><div class="col-sm-9">
	<?php
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="">'.$thnajaran.'</option>';
	echo '</select></div></div>';
}
if(!empty($semester))
{?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="<?php echo base_url().'bp/mapel/'.$tahun1;?>">Semester</a></label></div><div class="col-sm-9">
	<?php
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="">'.$semester.'</option>';
	echo '</select></div></div>';
}
if(empty($tahun1))
{?>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<?php
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="">pilih tahun pelajaran</option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
else
if(empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}
else
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$te = $this->db->query("select * from `m_walikelas` where `id_walikelas` = '$id_kelas'");
	$kelas = '';
	foreach($te->result() as $e)
	{
		$kelas = $e->kelas;
	}
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelas.'</option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}
	echo '</select></div></div>';
echo '</div></div>';
}
echo '</form>';
if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_kelas)))
{
	
	$ta = $this->db->query("select * from `m_mapel_rapor` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	if($ta->num_rows() > 0)
	{
		echo '<div class="alert alert-info">Isi nomor urut sesuai urutan mapel file template pdss, kosongkan bila tidak termasuk mapel pdss</div>';
		echo '<form class="form-horizontal" role="form" action="'.base_url().'bp/simpanmapel/'.$tahun1.'/'.$semester.'/'.$id_kelas.'" method="post">';
	?>
		<div class="table-responsive"><table class="table table-hover table-bordered">
<tr align="center"><td width="50"><strong>No.</strong></td><td><strong>Mata Pelajaran</strong></td><td><strong>Nomor Urut PDSS</strong></td></tr>
		<?php
		$nomor=1;
		foreach($ta->result() as $a)
		{
			$mapel = $a->nama_mapel_portal;
			if(!empty($mapel))
			{
				echo '<tr><td>'.$nomor.'</td><td>'.$mapel.'</td><td><input type="number" name="urut_smptn_'.$nomor.'" value="'.$a->urut_smptn.'" class="form-control"><input type="hidden" name="id_mapel_rapor_'.$nomor.'" value="'.$a->id_mapel_rapor.'" class="form-control"></td></tr>';
				$nomor++;
			}
		}
		echo '</table></div>';
			$cacah = $nomor - 1;
			echo '<input type="hidden" name="cacah" value="'.$cacah.'" class="form-control">';
		echo '<p class="text-center"><button type="submit" class="btn btn-primary" role="button">Simpan</button></p>';

	}
	else
	{
		echo 'data tidak ditemukan';
	}
	
}
?>
</form>

</div>

