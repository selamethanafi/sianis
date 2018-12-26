<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kredit.php
// Lokasi      : application/views/guru/
// Author      : Selamet Hanafi
//               selamethanafi@yahoo.co.id
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
<script src="<?php echo base_url(); ?>assets/js/jquery.min-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
	jQuery(function($){
	$("#tanggaltidakmasuk").mask("99-99-9999")
	});
</script>
<div class="container-fluid">	<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo $pesan;?>
<?php echo form_open('guru/siswakredit/'.$nis,'class="form-horizontal" role="form"');?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	if (empty($semester))
	{$semester=$semesterx;}

	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	?>
	</select></div></div>
<?php
	$namasiswa = nis_ke_nama($nis);
	$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
	$daftar_absensi=$this->Bp_model->Daftar_Absensi_Siswa($thnajaran,$nis);
?>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="search" class="autocomplete form-control" id="autocomplete1" value="<?php echo $namasiswa;?>" disabled/></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_kelas" value="<?php echo $kelas;?>" disabled></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">NIS</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_nis" name="nis"  value="<?php echo $nis;?>" required readonly></div></div>
<?php
$tanggalhariini = tanggal(tanggal_hari_ini());
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
	echo '<input type="text" name="tanggaltidakmasuk" class="form-control" id="tanggaltidakmasuk" value="'.$tanggalhariini.'" required></div></div>';
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Pelanggaran</label></div><div class="col-sm-9"><select name="kd_pelanggaran" class="form-control" required>
<?php
echo '<option value=""></option>';
$tmkredit = $this->db->query("select * from m_kredit order by nama_pelanggaran");
foreach($tmkredit->result() as $dmk)
{	
	if(strlen($dmk->nama_pelanggaran)>100)
		{
		echo '<option value="'.$dmk->kode.'">'.substr($dmk->nama_pelanggaran,0,100).' ...</option>';
		}
		else
		{
		echo '<option value="'.$dmk->kode.'">'.$dmk->nama_pelanggaran.'</option>';
		}

}
?>
</select></div></div>
<?php
echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/guru/siswakredit" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
<?php
if (!empty($nis))
{
$daftar_kredit = $this->db->query("select * from siswa_kredit where thnajaran='$thnajaran' and nis='$nis' order by tanggal DESC");
?>
		<div class="table-responsive"><table class="table table-striped table-hover table-bordered">	
		<tr><td width="30"><strong>No.</strong></td><td>NIS</td><td>Nama</td><td><strong>Tanggal</strong></td><td><strong>Kode / Pelanggaran</strong></td><td><strong>Poin</strong></td></tr>
		<?php
		$nomor=1;
		$jmlkredit =0;
		foreach($daftar_kredit->result() as $ba)
		{
		$kd_pelanggaran = $ba->kd_pelanggaran;
		$tmkreditx = $this->db->query("select * from m_kredit where kode='$kd_pelanggaran'");
		foreach($tmkreditx->result() as $dmkx)
		{
		$nama_pelanggaran = $dmkx->nama_pelanggaran;
		}
		$nis = $ba->nis;
		$tanggalabsen = tanggal_slash($ba->tanggal);
		echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'<td>'.$tanggalabsen.'</td><td>'.$kd_pelanggaran.' / '.$nama_pelanggaran.'</td><td>'.$ba->point.'</td></tr>';
		$jmlkredit = $jmlkredit + $ba->point;
		$nomor++;
		}
		echo '</table></div>';
		echo 'Jumlah kredit pelanggaran = <b>'.$jmlkredit.'</b>';
	
}
?>
</div></div>
</div>
