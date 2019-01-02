<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 01 Jan 2019 21:44:03 WIB 
// Nama Berkas 		: form_unduh_kode_mapel.php
// Lokasi      		: application/views/sinkronard/
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamet.hanafi@gmail.com
//
// License:
//    Copyright (C) 2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<div class="container-fluid">
<?php
if(!empty($id_mapel))
{
	$query = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	foreach($query->result() as $a)
	{
		echo form_open('admin/tampilansitus','class="form-horizontal" role="form"');
		echo '
		<div class="form-group row">
			<div class="col-sm-3" ><label class="control-label">Mapel / Kelas </label></div>
			<div class="col-sm-9" >'.$a->mapel.' '.$a->kelas.'</div>
		</div>
		<div class="form-group row"><div class="col-sm-3"><label class="control-label">Subjects Value dari ARD</label></div><div class="col-sm-9"><input type="text" name="post_subjects_value" value="'.$a->subjects_value.'" class="form-control"> </div></div>
	<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>
		</form>';
	}

}
else
{
	$nomor = 0;
	$query = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' order by `mapel`");
	foreach($query->result() as $a)
	{
		$kelas = $a->kelas;
		$subjects_value = $a->subjects_value;
		$tc = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kelas`='$kelas'");
		$school_class_id = '';
		foreach($tc->result() as $c)
		{
			$school_class_id = $c->kode_rombel;
		}
		//echo ' school_class_id '.$school_class_id;

		echo '<a href="'.base_url().'sinkronard/ambil_kode_mapel/'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.' '.$a->kodeguru.'</a> ';
		if((!empty($school_class_id)) and (!empty($subjects_value)))
		{
			echo '<a href="'.$url_ard.'/ma/guru/input_nilai_harian?school_class=school_class&school_class_id='.$school_class_id.'&amp;subjects_value='.$subjects_value.'&category_value=1" target="_blank">Form Input Nilai Harian</a> <a href="'.base_url().'sinkronard/unduh_kode_nilai/'.$nomor.'/'.$a->id_mapel.'">Unduh Kode Nilai</a>';
		}
		echo '<br />';
	$nomor++;
	}
}
?>
</div></div></div>
