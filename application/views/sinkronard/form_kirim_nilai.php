<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:36:26 WIB 
// Nama Berkas 		: form_kirim_nilai.php
// Lokasi      		: application/views/sinkronard
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$kelas = '';
$mapel = '';
$subjects_value = '';

$tw = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
foreach($tw->result() as $w)
{
	$kelas =$w->kelas;
	$mapel =$w->mapel;
	$subjects_value = $w->subjects_value;
	$thnajaran = $w->thnajaran;
	$semester = $w->semester;
}
$xloc = base_url().'sinkronard/kirimnilaiharian';
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';
if(empty($tahun1))
{
	$tahun1 = substr(cari_thnajaran(),0,4);
}
if(empty($semester))
{
	$semester = cari_semester();
}
$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
if(!empty($tahun1))
{
	$tc = $this->db->query("select * from `m_tapel` order by `thnajaran` DESC");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran </label></div><div class="col-sm-9">';
	echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'">'.$thnajaran.'</option>';
	foreach($tc->result() as $c)
	{
		echo '<option value="'.$xloc.'/'.substr($c->thnajaran,0,4).'">'.$c->thnajaran.'</option>';
	}
	echo '</select></div></div>';
}
if(!empty($semester))
{
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">';
	echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'">'.$semester.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/2">2</option>';
	echo '</select></div></div>';
}

$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `subjects_value` != '' order by `mapel`, `kelas`");
	echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Mapel Kelas</label></div><div class="col-sm-9">';
echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.'/'.$id_mapel.'">'.$mapel.' '.$kelas.'</option>';
foreach($ta->result() as $a)
{
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
}
echo '</select></div></div>';
echo '</form>';
if(!empty($id_mapel))
{
	$tb = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
	$school_class_id = '';
	foreach($tb->result() as $b)
	{
		$school_class_id = $b->kode_rombel;
	}
	if((empty($school_class_id)) or (empty($subjects_value)))
	{
		echo '<div class="alert alert-danger">Kode Kelas atau Kode Mapel dari ARD  belum ada </div>';
	}
	else
	{
		echo 'school_class_id '.$school_class_id;
		echo '<br />subjects_value '.$subjects_value;
		if($base_url == 'http:')
		{
		?>
		<iframe src="<?php echo base_url().'sinkronard/fkirimnilaiharian/'.$id_mapel;?>" width="100%" height="400"></iframe>
		<?php
		echo '<p>Kalau gagal mengunduh mungkin perlu -&gt; <a href="'.base_url().'sinkronard/form_input_nilai_harian2/'.$id_mapel.'" class="btn btn-info"><span class="fa fa-servers"></span>   <b>Buat Daftar Nilai di ARD</b></a></p>';

		}
		else
		{?>
			<a href="javascript:;"  onClick="window.open('<?php echo base_url();?>sinkronard/fkirimnilaiharian/<?php echo $id_mapel;?>','yes','scrollbars=yes,width=1024,height=600')" class="btn btn-success"><strong>Kirim ke ARD</strong></a>
			<?php
		}
	}
}
echo '</div></div></div>';
