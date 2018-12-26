<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 31 Des 2015 12:15:49 WIB 
// Nama Berkas 		: form_mencetak.php
// Lokasi      		: application/views/gurutelegram/
// Terakhir diperbarui	: Jum 30 Mar 2018 15:13:48 WIB 
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
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$xloc = base_url().'gurutelegram/kirimnilai';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';
if(!empty($tahun1))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'" title="ganti tahun pelajaran">Tahun Pelajaran</a></label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$tahun1.'">'.$tahun1.'/'.$tahun2.'</option>';
	echo '</select></div></div>';

}
if(!empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'" title="ganti semester">Semester</a></label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$semester.'</option>';
	echo '</select></div></div>';

}
if(!empty($id_mapel))
{
	$tb=$this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	if($tb->num_rows() == 0)
	{
		echo 'Mata pelajaran yang diampu tidak ditemukan';
	}
	else
	{
		foreach($tb->result() as $b)
		{
			$mapel = $b->mapel;
			$kelas = $b->kelas;
		}
		echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'" title="ganti semester">Mata Pelajaran Kelas</a></label></div><div class="col-sm-9">';
		echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'">'.$mapel.' '.$kelas.'</option>';
		echo '</select></div></div>';
	}
}

if(empty($tahun1))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$tahun1.'">'.$tahun1.'/'.$tahun2.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$tahun1.'/'.$tahun2.'</option>';
	$ta = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$xloc.'/'.substr($a->thnajaran,0,4).'">'.$a->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
elseif(empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}
elseif(empty($id_mapel))
{
	$thnajaran = $tahun1.'/'.$tahun2;
	$tb=$this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label"><a href="'.$xloc.'/'.$tahun1.'/'.$semester.'" title="ganti mata pelajaran">Mata Pelajaran Kelas</a></label></div><div class="col-sm-9">';
	echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'">'.$mapel.'</option>';
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select></div></div>';
}


?>
</form>
</div></div></div>
