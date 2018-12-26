<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 18 Mei 2018 05:18:56 WIB 
// Nama Berkas 		: melihat_nilai_siswa.php
// Lokasi      		: application/views/pengajaran/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Selamet Hanafi
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
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
$xloc = base_url().'pengajaran/melihatnilaisiswa';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($tahun1))
	{
	$tahun2 = $tahun1 + 1;
	$thnajaran = $tahun1.'/'.$tahun2;
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/melihatnilaisiswa">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'">'.$thnajaran.'</option>';
	echo '</select></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/melihatnilaisiswa/'.$tahun1.'">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '</select></div></div>';
	}
if (!empty($id_kelas))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.base_url().'pengajaran/melihatnilaisiswa/'.$tahun1.'/'.$semester.'">Kelas</a></label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	$tdx = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
	$kelasxx = '??';
	foreach($tdx->result() as $dx)
	{
		$kelasxx = $dx->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'">'.$kelasxx.'</option>';
	}
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}

	echo '</select></div></div>';
	$kelas = $kelasxx;
	}
if (empty($tahun1))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	foreach($daftar_tapel->result() as $k)
	{
		echo '<option value="'.$xloc.'/'.substr($k->thnajaran,0,4).'">'.$k->thnajaran.'</option>';
	}
	echo '</select></div></div></form>';
	}
elseif(empty($semester))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/1">1</option>';
	echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/2">2</option>';
	echo '</select></div></div></form>';
	}
elseif(empty($id_kelas))
	{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">';
	echo "<select name=\"id_kelas\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value=""></option>';
	$td = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `kelas`");
	foreach($td->result() as $d)
	{
		$id_kelasx = $d->id_walikelas;
		$kelasx = $d->kelas;
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelasx.'">'.$kelasx.'</option>';
	}
	echo '</select></div></div></form>';
	}
else
{
	$ta = $this->db->query("select * from `siswa_kelas` where `thnajaran`='$thnajaran' and `status`='Y' and `semester`='$semester' and `kelas`='$kelasxx' order by no_urut");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9">';
	echo "<select name=\"nis\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$nis.'">'.nis_ke_nama($nis).'</option>';
	foreach($ta->result() as $a)
		{
		echo '<option value="'.$xloc.'/'.substr($thnajaran,0,4).'/'.$semester.'/'.$id_kelas.'/'.$a->nis.'">'.nis_ke_nama($a->nis).'</option>';
		}
	echo '</select></div></div></form>';

}
if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($nis)))
{
	$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
?>
<table class="table table-hover table-striped table-bordered">
<?php
if($kurikulum == '2015')
{?>
	<tr bgcolor="#FFF" align="center"><td width="30"><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>PTS</strong></td><td><strong>PAS/PKK</strong></td><td><strong>Pengetahuan</strong></td><td><strong>Keterampilan</strong></td><td><strong>Tuntas</strong></td><td><strong>Deskripsi</strong></td></tr>
<?php
}
else
{

?>
	<tr bgcolor="#FFF" align="center"><td width="30"><strong>No.</strong></td><td><strong>Mapel</strong></td><td><strong>MID</strong></td><td><strong>SMT</strong></td><td><strong>Kog</strong></td><td><strong>Psi</strong></td><td><strong>Afe</strong></td><td><strong>Tuntas</strong></td><td><strong>Deskripsi</strong></td></tr>
<?php
}
$nomor=1;
$tb = $this->db->query("select * from `nilai` where `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' order by `mapel`");
foreach($tb->result() as $b)
{
	if($kurikulum == '2015')
	{
		echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.$b->mapel.'</td><td align="center">'.round($b->nilai_mid,2).'</td><td align="center">'.round($b->nilai_uas,2).'</td><td align="center">'.round($b->kog,2).'</td><td align="center">'.round($b->psi,2).'</td><td align="center">'.substr($b->ket_akhir,0,5).'</td><td><p>Pengetahuan<br />'.$b->keterangan.'</p><p>Keterampilan<br />'.$b->deskripsi.'</p></td></tr>';
	}
	else
	{
		$mapel = $b->mapel;
		$tc = $this->db->query("select * from `afektif` where `nis`='$nis' and `mapel`='$mapel' and `thnajaran`='$thnajaran' and `semester`='$semester'");
		$kef_sikap = '';
		foreach($tc->result() as $c)
		{
			$ket_sikap = $c->deskripsi;
		}
		echo '<td align="center">'.$nomor.'</td><td>'.$b->mapel.'</td><td align="center">'.round($b->nilai_mid,2).'</td><td align="center">'.round($b->nilai_uas,2).'</td><td align="center">'.round($b->kog,2).'</td><td align="center">'.round($b->psi,2).'</td><td align="center">'.$b->afektif.'</td><td align="center">'.substr($b->ket_akhir,0,5).'</td><td><p>Pengetahuan<br />'.$b->keterangan.'</p><p>Keterampilan<br />'.$b->deskripsi.'</p><p>Sikap<br />'.$ket_sikap.'</p></td></tr>';
	}

	$nomor++;
}
?>
</table>
* Nilai Sekolah
<?php
}
?>
</div></div></div>
