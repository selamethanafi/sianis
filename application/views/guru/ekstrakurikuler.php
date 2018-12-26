<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: ekstrakurikuler.php
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
?><div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$bisa = 0;
$xloc = base_url().'guru/ekstrakurikuler';
echo form_open($xloc,'class="form-horizontal" role="form"');
?>
<div class="form-group row row">
	<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
	<div class="col-sm-9">
		<select name="thnajaran" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
		echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
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
	$namaekstra = '';
	$kelasekstra = '';
	$kelas = '';
	$tpengampu = $this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra = '$id_pengampu_ekstra'");
	foreach($tpengampu->result() as $dp)
		{
		$namaekstra = $dp->namaekstra;
		$kelasekstra = $dp->kelas;
		}
?>
<div class="form-group row row">	
	<div class="col-sm-3"><label for="semester" class="control-label">Ekstrakurikuler</label></div>
	<div class="col-sm-9">
		<select name="id_pengampu_ekstra" onChange="MM_jumpMenu('self',this,0)" class="form-control">";
		<?php
			echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra.'">'.$namaekstra.' '.$kelasekstra.'</option>';
		$tpengampu1 = $this->db->query("select * from m_pengampu_ekstra where id_pengampu_ekstra != '$id_pengampu_ekstra' and `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester'");
		foreach($tpengampu1->result() as $dp1)
		{
			$namaekstra1 = $dp1->namaekstra;
			$kelasekstra1 = $dp1->kelas;
			$id_pengampu_ekstra1 = $dp1->id_pengampu_ekstra;
			$thn1 = substr($thnajaran,0,4);
			echo '<option value="'.$xloc.'/'.$thn1.'/'.$semester.'/'.$id_pengampu_ekstra1.'">'.$namaekstra1.' '.$kelasekstra1.'</option>';
		}
		echo '</select>';
		?>
	</div>
</div>
</form>
<p class="text-center">Bila hendak mengunggah nilai ekstra, klik <a href="<?php echo base_url();?>ekstrakurikuler/borang" class="btn btn-primary">di sini</a></p>
</div></div></div>
