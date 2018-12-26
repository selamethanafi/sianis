<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sab 07 Mar 2015 20:39:26 WIB 
// Nama Berkas 		: pemeriksaan_berkas.php
// Lokasi      		: application/views/tatausaha
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid"><h2>Pemeriksaan Berkas Pencairan Tunjangan Profesi</h2>
<?php echo form_open('tatausaha/pemeriksaanberkas','class="form-horizontal" role="form"');
$querypegawai=$this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' and `lulus_sertifikasi`='Ya' order by nama ASC");
?>
<?php
	echo '	<div class="form-group row row"><div class="col-sm-6"><label>Nama Pegawai</label></div><div class="col-sm-6">';
	echo '<select name="thnajaran" class="form-control"><option value="'.$thnajaran.'">'.$thnajaran.'</option>';
	foreach($daftartahun->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-6"><label>Semester</label></div><div class="col-sm-6">';
	echo '<select name="semester" class="form-control"><option value="'.$semester.'">'.$semester.'</option>';
	echo "<option value='1'>1</option>";	echo "<option value='2'>2</option>";
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-6"><label>Nama Pegawai</label></div><div class="col-sm-6">
	<select name="kodeguru" class="form-control"><option value="'.$kodeguru.'">'.cari_nama_pegawai($kodeguru).'</option>';
		foreach($querypegawai->result() as $a)
			{
			echo "<option value='".$a->kode."'>".$a->nama."</option>";
			}


	echo	'</select></div></div>';
	if ((!empty($thnajaran)) and (!empty($semester)) and (!empty($kodeguru)))
		{
		$daftar_berkas = '0000000000';
		$ta = $this->db->query("SELECT * from p_tugas_tambahan where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru'");
		foreach($ta->result() as $a)
			{
			$daftar_berkas = $a->daftar_berkas;
			}
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Foto kopi sertifikat pendidikan dilegalisasi LPTK</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,0,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_1','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_1', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Foto kopi SK Dirjen Penerima Tunjangan Profesi dan NRG</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,1,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_2','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_2', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Foto kopi SK Awal, SK Terakhir, KGB terakhir dilegalisasi</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,2,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_3','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_3', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>SKMT asli</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,3,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_4','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_4', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>SKBK asli</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,4,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_5','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_5', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Surat pernyataan bermeterai</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,5,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_6','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_6', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Foto kopi Rekening</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,6,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_7','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_7', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Foto kopi NPWP</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,7,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_8','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_8', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>SK Pembagian Tugas</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,8,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_9','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_9', '1', TRUE);
			}
		echo '</div></div>';
		echo '<div class="form-group row row"><div class="col-sm-6"><label>Jadwal Mengajar</label></div><div class="col-sm-6">';
		$skore = substr($daftar_berkas,9,1);
		if ($skore == 0)
			{
			echo form_checkbox('berkas_10','1', FALSE);
			}
			else
			{
			echo form_checkbox('berkas_10', '1', TRUE);
			}
		echo '<input type="hidden" value="oke" name="proses"></div></div>';
		}
		echo'<p class="text-center">';
		if ($cetak == 'oke')
		{
		echo '<input type="hidden" value="cetak" name="proses"><input type="submit" value="Cetak" class="btn btn-primary">';
		}
		else
		{
		echo '<input type="submit" value="Lanjut" class="btn btn-primary">';
		}
		echo '</p>';


?>
</form>
</div>
