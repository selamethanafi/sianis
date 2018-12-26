<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/penilaian
// Nama Berkas 		: indikator.php
// Terakhir diperbarui	: Kam 12 Mei 2016 22:20:01 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
$cacah_soal = 0;
$totalsoal = 0;
$mapelkelas = '';
$xloc = base_url().'akreditasi/indikator';

if($sukses == 'sukses')
{?>
    <div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Sukses!</strong> Berhasil menyimpan data
     </div>
<?php
}
if($sukses == 'tidak sukses')
{?>
    <div class="alert alert-danger">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Tidak sukses!</strong> Tidak berhasil menyimpan data
     </div>
<?php
}
echo '<form class="form-horizontal" role="form" name="formx" method="post" action="'.$xloc.'">';
?>
    <div class="form-group row row">
	<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9">
	<select name="thnajaran" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	if(empty($tahun1))
	{
		$tahun2 = '';
		$thnajaran = '';
	}
	else
	{
		$tahun2 = $tahun1+1;
		$thnajaran = $tahun1.'/'.$tahun2;
	}
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	$daftar_tapel = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
	foreach($daftar_tapel->result() as $k)
	{
	$thn1 = substr($k->thnajaran,0,4);
	echo '<option value="'.$xloc.'/'.$thn1.'">'.$k->thnajaran.'</option>';
	}
	?>
	</select>
       </div>
    </div>
    <div class="form-group row row">
	<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
	<div class="col-sm-9">
	<select name="semester" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo "<option value='".$semester."'>".$semester."</option>";
	$thn1 = substr($thnajaran,0,4);
	echo '<option value="'.$xloc.'/'.$thn1.'/1">1</option>';
	echo '<option value="'.$xloc.'/'.$thn1.'/2">2</option>';
	echo '</select>';
	?>
        </div>
    </div>
    <?php
	if(!empty($id_mapel))
	{

	$ta = $this->db->query("select * from m_mapel where id_mapel = '$id_mapel'");

	foreach($ta->result() as $a)
		{
		$kelas= $a->kelas;
		$mapel = $a->mapel;
		$mapelkelas = $mapel.' '.$kelas;
		}
	}
	$tb = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");

    ?>
    <div class="form-group row row">
	<div class="col-sm-3"><label for="matapelajaran" class="control-label">Mata Pelajaran</label></div>
	<div class="col-sm-9">
	<select name="id_mapel" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'">'.$mapelkelas.'</option>';
	foreach($tb->result() as $b)
	{
	echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$b->id_mapel.'">'.$b->mapel.' '.$b->kelas.'</option>';
	}
	echo '</select>';
	?>
	</div>
    </div>
    <div class="form-group row row">
	<div class="col-sm-3"><label for="ulangan" class="control-label">Ulangan</label></div>
	<div class="col-sm-9">
	<select name="ulangan" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
	<?php
	echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_mapel.'/'.$ulangan.'">'.$ulangan.'</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/uh1">uh1</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/uh2">uh2</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/uh3">uh3</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/uh4">uh4</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/mid">mid</option>';
	echo '<option value="'.$xloc.'/'.$tahun1.'/'.$semester.'/'.$id_mapel.'/uas">uas</option>';
	echo '</select>';
	?>
	</div>
    </div>
    <?php
    if((!empty($thnajaran)) and (!empty($semester)) and (!empty($id_mapel)) and (!empty($ulangan)))
    {
	//cari cacah soal
	$cacah_soal = 0;
	$cacah_soalb = 0;
	$tc = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel' and `kodeguru`='$kodeguru'");
	foreach($tc->result() as $c)
	{
		if(($ulangan == 'uh1') or ($ulangan == 'uh2') or ($ulangan == 'uh3') or ($ulangan == 'uh4') or ($ulangan == 'mid') or ($ulangan == 'uas'))
			{
			$itemnilai = 'nsoal_'.$ulangan;
			$itemnilaib = 'nsoal_b_'.$ulangan;
			$cacah_soal = $c->$itemnilai;
			$cacah_soalb = $c->$itemnilaib;
			$mapel = $c->mapel;
			$kelas = $c->kelas;
			}
	}
	$totalsoal = $cacah_soal + $cacah_soalb;
	?>
    <div class="form-group row row">
	<div class="col-sm-3"><label for="cacahsoal" class="control-label">Cacah Soal</label></div>
	<div class="col-sm-9" ><p class="form-control-static"><?php echo $totalsoal;?></p></div>
    </div>
	<?php
    }
    if($totalsoal>0)
    {
	$isi_indikator = '';
	$td = $this->db->query("select * from `indikator` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas' and `ulangan`='$ulangan'");
	$ada = $td->num_rows();
	$proses = 'lama';
	if($ada == 0)
		{
		$proses = 'baru';
		}

	for($i=1;$i<=$totalsoal;$i++)
	{
		echo '<div class="form-group row row"><div class="col-sm-3"><label for="indikator_'.$i.'" class="control-label">Indikator '.$i.'</label></div>';
		foreach($td->result() as $d)
		{
			$xitem = 'i_'.$i;
			$isi_indikator = $d->$xitem;
		}
		$data = array(
		        'name'          => 'indikator_'.$i,
		        'value'         => $isi_indikator,
			'class'		=> 'form-control');
		echo '<div class="col-sm-9" >';
		echo form_input($data);
		echo '</div></div>';
	}
	echo form_hidden('proses', $proses);
	echo form_hidden('post_cacah_soal', $totalsoal);
	echo form_hidden('post_thnajaran', $thnajaran);
	echo form_hidden('post_semester', $semester);
	echo form_hidden('post_kelas', $kelas);
	echo form_hidden('post_mapel', $mapel);
	echo form_hidden('post_id_mapel', $id_mapel);
	echo form_hidden('post_ulangan', $ulangan);
	echo '<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN INDIKATOR</button></p>';
	echo form_close();
}
echo '';
echo '</div></div></div>';
?>
