<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : form_mencetak_daftar_nilai_psikomotor.php
// Lokasi      		: application/views/guru/
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
?><?php
$namamodul = 'Daftar Nilai Psikomotor';
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('guru/formmencetak/'.$noyangdicetak,'class="form-horizontal" role="form"');?>
<?php 
echo '<input type="hidden" name="yangdicetak" value="'.$namamodul.'"><input name="kodeguru" type="hidden" value="'.$kodeguru.'">';
?>
<?php
if (!empty($thnajaran))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="thnajaran" type="hidden" value="'.$thnajaran.'">'.$thnajaran.'</p></div></div>';
	}
if (!empty($semester))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9"><p class="form-control-static">
	<input name="semester" type="hidden" value="'.$semester.'">'.$semester.'</p></div></div>';
	}
if (!empty($ditandatangani))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9"><p class="form-control-static">';
			echo '<input name="ditandatangani" type="hidden" value="'.$ditandatangani.'">';
			echo ''.$ditandatangani.'</p></div></div>';
	}

if (!empty($id_mapel))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9"><p class="form-control-static">';
			echo '<input name="id_mapel" type="hidden" value="'.$id_mapel.'">';
			$mapel = id_mapel_jadi_mapel($id_mapel);
			$kelas = id_mapel_jadi_kelas($id_mapel);
			echo ''.$mapel.' '.$kelas.'</p></div></div>';
	}
if (!empty($nomoraspek))
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Aspek Penilaian</label></div><div class="col-sm-9"><p class="form-control-static">';
			echo '<input name="nomoraspek" type="hidden" value="'.$nomoraspek.'">';
			if($nomoraspek == 'Semua')
				{echo 'Semua';
				}
				else
				{
				$tb = $this->db->query("select * from `aspek_psikomotorik` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
				 foreach($tb->result() as $b)
					{
					$iteme = "p".$nomoraspek;
					echo ''.$b->$iteme.'';
					}
				}
			echo '</p></div></div>';
	}

if ((empty($thnajaran)) or (empty($semester)) or (empty($ditandatangani)))
{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';

		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></div></div>';
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Ditandatangani kepala</label></div><div class="col-sm-9">';
	echo '<select name="ditandatangani" class="form-control">';
	echo '<option value="ya">ya</option>';
	echo '<option value="tidak">tidak</option>';
	echo '</select></div></div>';
	echo '<p class="text-center">';
	echo '<input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p>';
}

elseif (empty($id_mapel))
{
	$ta = $this->db->query("select * from `m_mapel` where `thnajaran`='$thnajaran' and `semester`='$semester' and `kodeguru`='$kodeguru' and ranah !='KA'");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mata Pelajaran</label></div><div class="col-sm-9">';
	echo '<select name="id_mapel" class="form-control">';
	foreach($ta->result() as $a)
		{
		echo '<option value="'.$a->id_mapel.'">'.$a->mapel.' '.$a->kelas.'</option>';
		}
	echo '</select></div></div>';
	echo '<p class="text-center">';
	echo '<input type="submit" value="Lanjut" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p></div></div>';
}
else
{
	$cacahitem =0;
	$tb = $this->db->query("select * from `aspek_psikomotorik` where `thnajaran`='$thnajaran' and `semester`='$semester' and `mapel`='$mapel' and `kelas`='$kelas'");
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Aspek Penilaian</label></div><div class="col-sm-9"><p class="form-control-static">';
	echo '<select name="nomoraspek" class="form-control">';
		echo '<option value="Semua">Semua</option>';
	foreach($tb->result() as $b)
		{
		$cacahitem = $b->np;
		$urut = 1;
			do
			{
			$iteme = "p".$urut;
			echo '<option value="'.$urut.'">'.$b->$iteme.'</option>';
			$urut++;
			}
			while ($urut<=$cacahitem);
		}
	echo '</select></div></div>';
	echo '<p class="text-center">';
	echo '<input type="hidden" name="diproses" value="oke"><input type="submit" value="Cetak '.$namamodul.'" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/formmencetak" class="btn btn-info"><b>Batal</b></a></p></div></div>';
}
?>
</form>
</div></div></div>
