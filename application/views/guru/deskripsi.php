<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: deskripsi.php
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
?>
<?php

		$materi1 = '';
		$materi2 = '';
		$materi3 = '';
		$materi4 = '';
		$materi5 = '';
		$materi6 = '';
		$materi7 = '';
		$materi8 = '';
		$materi9 = '';
		$materi10 = '';
		$keterampilan1 = '';
		$keterampilan2 = '';
		$kelas = id_mapel_jadi_kelas($id_mapel);
		$mapel = '';
//terpilih
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


echo '<div class="container-fluid">';
$xloc = base_url().'guru/deskripsi/';
echo '<form name="formx" method="post" action="'.$xloc.'" class="form-horizontal" role="form">';?>
<div class="card">
	<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
	<div class="card-body">
<?php
echo $sukses;
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran </label></div><div class="col-sm-9">';
echo "<select name=\"tahun1\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$tahun1.'">'.$thnajaran.'</option>';
$ta = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
foreach($ta->result() as $a)
{
$xtahun1 = substr($a->thnajaran,0,4);
$xtahun2 = $xtahun1+1;
$xthnajaran = $xtahun1.'/'.$xtahun2;
echo '<option value="'.$xloc.''.$xtahun1.'/'.$semester.'/'.$id_mapel.'/'.$jenis_deskripsi.'">'.$xthnajaran.'</option>';
}
echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">';
echo 'Semester </label></div><div class="col-sm-9">';
echo "<select name=\"semester\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
	echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'">'.$semester.'</option>';
if($semester==1)
	{
	echo '<option value="'.$xloc.''.$tahun1.'/2/'.$id_mapel.'/'.$jenis_deskripsi.'">2</option>';
	}
if($semester==2)
	{
	echo '<option value="'.$xloc.''.$tahun1.'/1/'.$id_mapel.'/'.$jenis_deskripsi.'">1</option>';
	}
else
	{
	echo '<option value="'.$xloc.''.$tahun1.'/1/'.$id_mapel.'/'.$jenis_deskripsi.'">1</option>';
	echo '<option value="'.$xloc.''.$tahun1.'/2/'.$id_mapel.'/'.$jenis_deskripsi.'">2</option>';
	}
echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">';
echo 'Mata Pelajaran / Kelas </label></div><div class="col-sm-9">';
echo "<select name=\"id_mapel\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/'.$jenis_deskripsi.'">'.id_mapel_jadi_mapel($id_mapel).' '.id_mapel_jadi_kelas($id_mapel).'</option>';
$tmapel = $this->db->query("select * from `m_mapel` where `kodeguru`='$kodeguru' and `thnajaran`='$thnajaran' and `semester`='$semester' order by `mapel`,`kelas`");
foreach($tmapel->result() as $dm)
{
	echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$dm->id_mapel.'/'.$jenis_deskripsi.'">'.id_mapel_jadi_mapel($dm->id_mapel).' '.id_mapel_jadi_kelas($dm->id_mapel).'</option>';
}

echo '</select></div></div>';
if($jenis_deskripsi== 1)
	{
	$jenis_deskripsine = 'Berdasarkan Ulangan (Deskripsi Otomatis)';
	}
elseif($jenis_deskripsi== 5)
	{
	$jenis_deskripsine = 'Berdasarkan Nilai Rapor (Deskripsi Otomatis)';
	}

elseif($jenis_deskripsi== 3)
	{
	$jenis_deskripsine = 'Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)';
	}
elseif($jenis_deskripsi== 4)
	{
	$jenis_deskripsine = 'Berdasar bank deskripsi';
	}
elseif($jenis_deskripsi== 6)
	{
	$jenis_deskripsine = $this->config->item('versi_deskripsi');
	}

else
	{
	$jenis_deskripsine = 'Kopi Paste / Manual';
	}

echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jenis Deskripsi</label></div><div class="col-sm-9">';
echo "<select name=\"jenis_deskripsi\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"form-control\">";
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/'.$jenis_deskripsi.'">'.$jenis_deskripsine.'</option>';
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/1">Berdasarkan Ulangan (Deskripsi Otomatis)</option>';
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/5">Berdasarkan Nilai Rapor (Deskripsi Otomatis)</option>';
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/3">Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)</option>';
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/4">Berdasar bank deskripsi</option>';
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/6">'.$this->config->item('versi_deskripsi').'</option>';
echo '<option value="'.$xloc.''.$tahun1.'/'.$semester.'/'.$id_mapel.'/">Kopi Paste / Manual</option>';
echo '</select></div></div>';
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);

	$tmapelx = $this->db->query("select * from `m_mapel` where `id_mapel`='$id_mapel'");
	$batas1 = '?';
	$batas2 = '?';
	$batas3 = '?';
	$batas4 = '?';
	$batas5 = '?';
	$batas6 = '?';
	foreach($tmapelx->result() as $dx)
	{
		$materi1 = $dx->materi1;
		$materi2 = $dx->materi2;
		$materi3 = $dx->materi3;
		$materi4 = $dx->materi4;
		$materi5 = $dx->materi5;
		$materi6 = $dx->materi6;
		$materi7 = $dx->materi7;
		$materi8 = $dx->materi8;
		$materi9 = $dx->materi9;
		$materi10 = $dx->materi10;
		$keterampilan1 = $dx->keterampilan1;
		$keterampilan2 = $dx->keterampilan2;
		$kkm = $dx->kkm;
		$batas1 = $dx->batas1;
		$batas2 = $dx->batas2;
		$batas3 = $dx->batas3;
		$batas4 = $dx->batas4;
		$batas5 = $dx->batas5;
		$batas6 = $dx->batas6;
	}
	if ($jenis_deskripsi==3)
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi / KD (1)</strong></label></div><div class="col-sm-9"><textarea name ="materi1"  rows="2" class="form-control">'.$materi1.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi / KD (2)</strong></label></div><div class="col-sm-9"><textarea name ="materi2" rows="2" class="form-control">'.$materi2.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi / KD (3)</strong></label></div><div class="col-sm-9"><textarea name ="materi3" rows="2" class="form-control">'.$materi3.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi / KD (4)</strong></label></div><div class="col-sm-9"><textarea name ="materi4" rows="2" class="form-control">'.$materi4.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi / KD (5)</strong></label></div><div class="col-sm-9"><textarea name ="materi5" rows="2" class="form-control">'.$materi5.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi / KD (6)</strong></label></div><div class="col-sm-9"><textarea name ="materi6" rows="2" class="form-control">'.$materi6.'</textarea></div></div>';
	}
	if ($jenis_deskripsi==1)
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi UH1</strong></label></div><div class="col-sm-9"><textarea name ="materi1"  rows="2" class="form-control">'.$materi1.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi UH2</strong></label></div><div class="col-sm-9"><textarea name ="materi2" rows="2" class="form-control">'.$materi2.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi UH3</strong></label></div><div class="col-sm-9"><textarea name ="materi3" rows="2" class="form-control">'.$materi3.'</textarea></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi UH4</strong></label></div><div class="col-sm-9"><textarea name ="materi4" rows="2" class="form-control">'.$materi4.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi MID</strong></label></div><div class="col-sm-9"><textarea name ="materi5" rows="2" class="form-control">'.$materi5.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Materi UAS/UKK</strong></label></div><div class="col-sm-9"><textarea name ="materi6" rows="2" class="form-control">'.$materi6.'</textarea></div></div>';
	}
	if ($jenis_deskripsi==6)
	{
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 1</strong></label></div><div class="col-sm-9"><textarea name ="materi1"  rows="2" class="form-control">'.$materi1.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 2</strong></label></div><div class="col-sm-9"><textarea name ="materi2" rows="2" class="form-control">'.$materi2.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 3</strong></label></div><div class="col-sm-9"><textarea name ="materi3" rows="2" class="form-control">'.$materi3.'</textarea></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 4</strong></label></div><div class="col-sm-9"><textarea name ="materi4" rows="2" class="form-control">'.$materi4.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 5</strong></label></div><div class="col-sm-9"><textarea name ="materi5" rows="2" class="form-control">'.$materi5.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 6</strong></label></div><div class="col-sm-9"><textarea name ="materi6" rows="2" class="form-control">'.$materi6.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 7</strong></label></div><div class="col-sm-9"><textarea name ="materi7" rows="2" class="form-control">'.$materi7.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 8</strong></label></div><div class="col-sm-9"><textarea name ="materi8" rows="2" class="form-control">'.$materi8.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 9</strong></label></div><div class="col-sm-9"><textarea name ="materi9" rows="2" class="form-control">'.$materi9.'</textarea></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>KD 10</strong></label></div><div class="col-sm-9"><textarea name ="materi10" rows="2" class="form-control">'.$materi10.'</textarea></div></div>';

	}

	if (($jenis_deskripsi==2) or ($jenis_deskripsi==5))
	{
		if($kurikulum == '2013')
		{
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai >= 3.67 </strong></label></div><div class="col-sm-9"><textarea name ="materi1" rows="2" class="form-control">'.$materi1.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai 3.34 s.d. 3.66</strong></label></div><div class="col-sm-9"><textarea name ="materi2" rows="2" class="form-control">'.$materi2.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai 3.01 s.d. 3.33 </strong></label></div><div class="col-sm-9"><textarea name ="materi3" rows="2" class="form-control">'.$materi3.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai 2.67 s.d. 3.00</strong></label></div><div class="col-sm-9"><textarea name ="materi4" rows="2" class="form-control">'.$materi4.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai 2.34 s.d. 2.66</strong></label></div><div class="col-sm-9"><textarea name ="materi5" rows="2" class="form-control">'.$materi5.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai kurang dari 2.34</strong></label></div><div class="col-sm-9"><textarea name ="materi6" rows="2" class="form-control">'.$materi6.'</textarea></div></div>';
		}
		else
		{
			echo '<p class="help-block">Urutkan Batas nilai dari yang tertinggi</p>';
			echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai >= <input type="number" name="batas1" value="'.$batas1.'"></label></div><div class="col-sm-9"><textarea name ="materi1" rows="2" class="form-control">'.$materi1.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai </strong><input type="number" name="batas2" value="'.$batas2.'"> s.d. &lt '.$batas1.'</strong></label></div><div class="col-sm-9"><textarea name ="materi2" rows="2" class="form-control">'.$materi2.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai <input type="number" name="batas3" value="'.$batas3.'"> s.d. &lt '.$batas2.' </strong></label></div><div class="col-sm-9"><textarea name ="materi3" rows="2" class="form-control">'.$materi3.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai <input type="number" name="batas4" value="'.$batas4.'"> s.d. &lt '.$batas3.'</strong></label></div><div class="col-sm-9"><textarea name ="materi4" rows="2" class="form-control">'.$materi4.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai <input type="number" name="batas5" value="'.$batas5.'"> s.d. &lt '.$batas4.'</strong></label></div><div class="col-sm-9"><textarea name ="materi5" rows="2" class="form-control">'.$materi5.'</textarea></div></div>
			<div class="form-group row row"><div class="col-sm-3"><label class="control-label"><strong>Nilai kurang dari <input type="hidden" name="batas6" value="'.$batas5.'">'.$batas6.'</strong></label></div><div class="col-sm-9"><textarea name ="materi6" rows="2" class="form-control">'.$materi6.'</textarea></div></div>';

		}
	}
	echo '<p class="text-center">';
	if((!empty($tahun1)) and (!empty($semester)) and (!empty($id_mapel)))
	{
		$thnajaranx = $tahun1.'/'.$tahun2;
		$semesterx = $semester;
		$id_mapelx = $id_mapel;
		$jenis_deskripsix = $jenis_deskripsi;
		echo '<input type="hidden" name="thnajaranx" value="'.$thnajaranx.'"><input type="hidden" name="semesterx" value="'.$semesterx.'"><input type="hidden" name="id_mapelx" value="'.$id_mapelx.'"><input type="hidden" name="jenis_deskripsix" value="'.$jenis_deskripsix.'"><input type="hidden" name="diproses" value="oke"><input type="submit" value="Simpan" class="btn btn-primary">&nbsp;&nbsp;&nbsp;';
	}
	echo '<a href="'.base_url().'guru/deskripsi" class="btn btn-info"><b>Batal</b></a></p>';
echo 'Kurikulum '.$kurikulum;
	if((!empty($tahun1)) and (!empty($semester)))
	{
		$tb = $this->Guru_model->Tampilkan_Mapel_Guru($thnajaran,$semester,$kodeguru);
		if($tb->num_rows()==0)
		{
			echo '<div class="alert alert-warning">Belum ada pembagian tugas tahun '.$thnajaran.' Semester '.$semester.'</div>';
		}
		else
		{
			echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered"><tr align="center"><td>Nomor</td><td>Mata Pelajaran</td><td>Kelas</td><td>Jenis Desktripsi</td></tr>';
			$nomor = 1;
			foreach($tb->result() as $b)
			{
				$deskripsi_tersimpan = $b->jenis_deskripsi;
				if($deskripsi_tersimpan== 1)
				{
					$deskripsi_tersimpanne = 'Berdasarkan Ulangan (Deskripsi Otomatis)';
				}
				elseif($deskripsi_tersimpan== 5)
				{
					$deskripsi_tersimpanne = 'Berdasarkan Nilai Rapor (Deskripsi Otomatis)';
				}
				elseif($deskripsi_tersimpan== 3)
				{
					$deskripsi_tersimpanne = 'Berdasarkan Kriteria lalu dipilih (Deskripsi Otomatis)';
				}
				elseif($deskripsi_tersimpan== 4)
				{
					$deskripsi_tersimpanne = 'Berdasar bank deskripsi';
				}
				elseif($deskripsi_tersimpan== 6)
				{
					$deskripsi_tersimpanne = $this->config->item('versi_deskripsi');
				}

				else
				{
					$deskripsi_tersimpanne = 'Kopi Paste / Manual';
				}

				echo '<tr align="center"><td>'.$nomor.'</td><td>'.$b->mapel.'</td><td>'.$b->kelas.'</td><td>'.$deskripsi_tersimpanne.'</td></tr>';
				$nomor++;
			}
			echo '</table></div>';
		}
	}

echo '</div></div></form></div>';

