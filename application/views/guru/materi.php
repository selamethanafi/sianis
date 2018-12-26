<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru
// Nama Berkas 		: indikator.php
// Terakhir diperbarui	: Kam 12 Mei 2016 20:40:00 WIB 
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
$mapelkelas = '';

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

$xloc = base_url().'akreditasi/materi';
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
</form>
<?php
$cacah_materi = 0;
if((!empty($thnajaran)) and (!empty($semester)) and (!empty($id_mapel)))
{
	$cacah_materi = 6;
}
if($cacah_materi>0)
{
	$isi_indikator = '';
	$mapel = id_mapel_jadi_mapel($id_mapel);
	$kelas = id_mapel_jadi_kelas($id_mapel);
	$tahun1 = substr($thnajaran,0,4);
	$td = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	$ada = $td->num_rows();
	$proses = 'lama';
	if($ada == 0)
		{
		$proses = 'baru';
		}
	?>
	<form class="form-horizontal" role="form" action="<?php echo base_url();?>akreditasi/materi" method="post">
			<?php
			for($i=1;$i<=$cacah_materi;$i++)
			{

				echo '<div class="form-group row row">
<div class="col-sm-3" ><label for="materi_'.$i.'" class="control-label">Materi '.$i.'</label></div>';
				foreach($td->result() as $d)
				{
					$xitem = 'materi'.$i;
					$isi_indikator = $d->$xitem;
				}
				$data = array(
				        'name'          => 'materi'.$i,
				        'value'         => $isi_indikator,
					'class'		=> 'form-control');
				echo '<div class="col-sm-9">';
				echo form_input($data);
				echo '</div></div>';
			}
	$tautan = 'akreditasi/materi/'.$tahun1.'/'.$semester.'/'.$id_mapel.'';
	echo form_hidden('proses', $proses);
	echo form_hidden('tautan', $tautan);
	echo form_hidden('cacah_materi', $cacah_materi);
	echo form_hidden('post_id_mapel', $id_mapel);
	echo form_hidden('post_tahun1', $tahun1);
	echo form_hidden('post_semester', $semester);
	echo '<p class="text-center"><button type="submit" class="btn btn-primary">SIMPAN</button></p>';
	echo form_close();
}
echo '</div></div></div>';
?>
