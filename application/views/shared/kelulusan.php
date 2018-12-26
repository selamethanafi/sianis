<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: unduh_siswa_kelas.php
// Lokasi      		: application/views/bp
// Terakhir diperbarui	: Sel 05 Jan 2016 11:06:22 WIB 
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
<script src="<?php echo base_url();?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tgl1").mask("99-99-9999")
	$("#tgl2").mask("99-99-9999")
	});
</script>

<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php
$xloc = base_url().'tatausaha/kelulusan';
$ta = $this->db->query("select * from `m_walikelas` where `id_walikelas`='$id_kelas'");
$kelasx = '';
foreach($ta->result() as $a)
{
	$kelasx = $a->kelas;
}
$ta = $this->db->query("select * from `m_walikelas` where `thnajaran`='$thnajaran' and `semester`='2' and `kelas` like 'XII-%' order by `kelas`");
?>
<?php echo form_open($xloc,'class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9">
<select name="id_kelas" onChange="MM_jumpMenu('self',this,0)" class="form-control">
<?php
echo '<option value="'.$id_kelas.'">'.$kelasx.'</option>';
foreach($ta->result() as $a)
{
	echo '<option value="'.$xloc.'/'.$a->id_walikelas.'">'.$a->kelas.'</option>';
}
?>
</select></div></div>
</form>
<?php
if(!empty($kelasx))
{
	echo form_open('tatausaha/kelulusan/'.$id_kelas,'class="form-horizontal" role="form"');
	?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Lulus</label></div><div class="col-sm-9"><input type="text" name="tgllulus" id="tgl1" class="form-control"></div></div>
	<?php
	$daftarsiswa = $this->db->query("select * from `siswa_kelas`  where `thnajaran`='$thnajaran' and `semester`='2' and `kelas`='$kelasx' and `status`='Y' order by no_urut");
	echo '<table class="table table-hover table-striped table-bordered">
	<tr align="center"><td><strong>No.</strong></td><td><strong>NIS</strong></td><td><strong>Nama</strong></td><td>Status</td><td>Tanggal Lulus</td><td><strong>Lulus / Tidak Lulus</strong></td></tr>';
	$nomor=1;
	foreach($daftarsiswa->result() as $b)
	{
		$nis= $b->nis;
		$data_siswa = $this->helper->data_siswa($nis);
		echo '<tr><td>'.$nomor.'</td><td>'.$b->nis.'<input type="hidden" name="nis_'.$nomor.'" value="'.$nis.'"></td><td>'.$data_siswa['nama_siswa'].'</td>';
		if($data_siswa['ket'] == 'L')
		{
			echo '<td align="center">Lulus</td><td align="center">'.tanggal($data_siswa['tamatbelajar']).'</td><td>';
			echo '<select name="status_'.$nomor.'" class="form-control">';
			echo '<option value="L">Lulus</option>';
			echo '<option value="Y">Aktif</option>';
			echo '</select></td></tr>';
		}
		else
		{
			echo '<td align="center">Aktif</td><td align="center">'.tanggal($data_siswa['tamatbelajar']).'</td><td>';
			echo '<select name="status_'.$nomor.'" class="form-control">';
			echo '<option value="Y">Aktif</option>';
			echo '<option value="L">Lulus</option>';
			echo '</select></td></tr>';
		}


	$nomor++;
	}
	echo '</table>';
	$cacahsiswa = $nomor-1;
	echo '<p class="text-center"><input type="hidden" name="cacahsiswa" value="'.$cacahsiswa.'"><input type="submit" value="Proses Kelulusan Tahun '.$thnajaran.' Semester '.$semester.'" class="btn btn-primary"></p>';
	echo '</form>';
}
echo '</div></div></div>';
