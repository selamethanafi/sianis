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
<script type="text/javascript">
	jQuery(function($){
	$("#tanggaltidakmasuk").mask("99-99-9999")
	});
</script>
<div class="container-fluid">	<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<div class="alert alert-warning">Halaman ini digunakan untuk mencatat kejadian positif yang dilakukan oleh siswa</div>
<?php echo form_open('guru/jurnalsikap/'.$nis,'class="form-horizontal" role="form"');?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
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
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Nama</label></div><div class="col-sm-9"><input type="text" class="form-control" value="<?php echo $namasiswa;?>" disabled></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_kelas" value="<?php echo $kelas;?>" disabled></div></div>
	<div class="form-group row"><div class="col-sm-3"><label class="control-label">NIS</label></div><div class="col-sm-9"><input type="text" class="autocomplete form-control" id="v_nis" name="nis"  value="<?php echo $nis;?>" required readonly></div></div>
<?php
$tanggalhariini = tanggal(tanggal_hari_ini());
echo '<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
	echo '<input type="text" name="tanggal" class="form-control" id="tanggaltidakmasuk" value="'.$tanggalhariini.'" required></div></div>';
?>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Kejadian</label></div><div class="col-sm-9"><input type="text" name="kejadian" class="form-control" required></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Tindak Lanjut</label></div><div class="col-sm-9"><input type="text" name="tindak_lanjut" class="form-control" required></div></div>
<div class="form-group row"><div class="col-sm-3"><label class="control-label">Butir Sikap</label></div><div class="col-sm-9">
	<select name="butir" class="form-control" required>
	<?php
	$ta = $this->db->query("select * from `m_sikap_spiritual` where `thnajaran`='$thnajaran' order by `item`");
		echo '<option value=""></option>';
	foreach($ta->result() as $a)
	{
		echo '<option value="'.$a->item.'">'.$a->item.'</option>';
	}
	?>
	</select>Kalau belum ada ada silakan menghubungi admin</div></div>
<?php
echo '<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/carisiswa/jurnalsikap" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
<?php
if (!empty($nis))
{
$daftar_kredit = $this->db->query("select * from siswa_kredit where thnajaran='$thnajaran' and nis='$nis' order by tanggal DESC");
?>
		<div class="table-responsive"><table class="table table-striped table-hover table-bordered">	
		<tr><td width="30"><strong>No.</strong></td><td>NIS</td><td>Nama</td><td><strong>Tanggal</strong></td><td><strong>Kode / Pelanggaran / Kejadian</strong></td><td>Butir Sikap</td><td>Sikap</td><td><strong>Poin</strong></td><td><strong>Aksi</strong></td></tr>
		<?php
		$nomor=1;
		$jmlkredit =0;
		foreach($daftar_kredit->result() as $ba)
		{
		$kd_pelanggaran = $ba->kd_pelanggaran;
		$nama_pelanggaran = $ba->kejadian;
		$point = $ba->point;
		if($kd_pelanggaran != 'Z')
		{
			$tmkreditx = $this->db->query("select * from m_kredit where kode='$kd_pelanggaran'");
			foreach($tmkreditx->result() as $dmkx)
			{
			$nama_pelanggaran = $dmkx->nama_pelanggaran;
			$jenis = $dmkx->jenis;
			
			}
		}
		else
		{
			$jenis = $ba->jenis;
			$point = '';
		}
		if($jenis = '1')
		{
			$jenise = 'Sikap Sosial';
		}
		else
		{
			$jenise = 'Sikap Spiritual';
		}
		if($kd_pelanggaran != 'Z')
		{
			$jenise = '';
		}
		$nis = $ba->nis;
		$tanggalabsen = tanggal_slash($ba->tanggal);
		echo '<tr><td>'.$nomor.'</td><td>'.$nis.'</td><td>'.nis_ke_nama($nis).'<td>'.$tanggalabsen.'</td><td>'.$nama_pelanggaran.'</td><td>'.$ba->butir.'</td><td>'.$jenise.'</td><td>'.$point.'</td><td align="center"><a href="'.base_url().'guru/jurnalsikap/'.$nis.'/hapus/'.$ba->id_siswa_kredit.'" data-confirm="Hendak menghapus '.$nama_pelanggaran.'?"><span class="fa fa-trash-alt"></td></tr>';
		$jmlkredit = $jmlkredit + $ba->point;
		$nomor++;
		}
		echo '</table></div>';
		echo 'Jumlah kredit pelanggaran = <b>'.$jmlkredit.'</b>';
	
}
?>
</div></div>
</div>
