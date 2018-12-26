<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sel 10 Mei 2016 21:47:55 WIB 
// Nama Berkas 		: kkm_edit.php
// Lokasi      		: application/views/guru/
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
<div class="container-fluid"><h2><?php echo $judulhalaman;?></h2>
<?php
foreach($tmapel->result() as $dtmapel)
{
	$kelas = $dtmapel->kelas;
	$mapel = $dtmapel->mapel;
	$thnajaran = $dtmapel->thnajaran;
	$semester= $dtmapel->semester;
	$kkm = $dtmapel->kkm;
	$ranah = $dtmapel->ranah;
	$ncacah_ulangan_harian = $dtmapel->cacah_ulangan_harian;
	$ncacah_tugas = $dtmapel->cacah_tugas;
	$nbobot_ulangan_harian = $dtmapel->bobot_ulangan_harian;
	$nbobot_kuis = $dtmapel->bobot_kuis;
	$nbobot_tugas = $dtmapel->bobot_tugas;
	$nbobot_mid = $dtmapel->bobot_mid;
	$nbobot_semester = $dtmapel->bobot_semester;
	$nbobot_projek = $dtmapel->bobot_projek;
	$nbobot_praktik = $dtmapel->bobot_praktik;
	$nbobot_portofolio = $dtmapel->bobot_portofolio;
	$njam = $dtmapel->jam;
	$nadamid = $dtmapel->adamid;
	$kkm_uh1 = $dtmapel->kkm_uh1;
	$kkm_uh2 = $dtmapel->kkm_uh2;
	$kkm_uh3 = $dtmapel->kkm_uh3;
	$kkm_uh4 = $dtmapel->kkm_uh4;
	$kkm_mid = $dtmapel->kkm_mid;
	$kkm_uas = $dtmapel->kkm_uas;
	$nsoal_uh1 = $dtmapel->nsoal_uh1;
	$nsoal_uh2 = $dtmapel->nsoal_uh2;
	$nsoal_uh3 = $dtmapel->nsoal_uh3;
	$nsoal_uh4 = $dtmapel->nsoal_uh4;
	$nsoal_mid = $dtmapel->nsoal_mid;
	$nsoal_uas = $dtmapel->nsoal_uas;
	$ncacah_kuis = $dtmapel->nkuis;
	$skor_uh1 = $dtmapel->skor_uh1;
	$skor_uh2 = $dtmapel->skor_uh2;
	$skor_uh3 = $dtmapel->skor_uh3;
	$skor_uh4 = $dtmapel->skor_uh4;
	$skor_mid = $dtmapel->skor_mid;
	$skor_uas = $dtmapel->skor_uas;
	if ($skor_uh1 == 0)
		{$skor_uh1 = 1;}
	if ($skor_uh2 == 0)
		{$skor_uh2 = 1;}
	if ($skor_uh3 == 0)
		{$skor_uh3 = 1;}
	if ($skor_uh4 == 0)
		{$skor_uh4 = 1;}
	if ($skor_mid == 0)
		{$skor_mid = 1;}
	if ($skor_uas == 0)
		{$skor_uas = 1;}

	$jam_ke = $dtmapel->jam_ke;
	$hari_tatap_muka = $dtmapel->hari_tatap_muka;
	$kuncibuh1 = $dtmapel->kuncibuh1;
	$kuncibuh2 = $dtmapel->kuncibuh2;
	$kuncibuh3 = $dtmapel->kuncibuh3;
	$kuncibuh4 = $dtmapel->kuncibuh4;
	$kuncibmid = $dtmapel->kuncibmid;
	$kuncibuas = $dtmapel->kuncibuas;
	$kunciuh1 = $dtmapel->kunciuh1;
	$kunciuh2 = $dtmapel->kunciuh2;
	$kunciuh3 = $dtmapel->kunciuh3;
	$kunciuh4 = $dtmapel->kunciuh4;
	$kuncimid = $dtmapel->kuncimid;
	$kunciuas = $dtmapel->kunciuas;
	$nilai_maks_bagian_a_uh1 = $dtmapel->nilai_maks_bagian_a_uh1;
	$nilai_maks_bagian_a_uh2 = $dtmapel->nilai_maks_bagian_a_uh2;
	$nilai_maks_bagian_a_uh3 = $dtmapel->nilai_maks_bagian_a_uh3;
	$nilai_maks_bagian_a_uh4 = $dtmapel->nilai_maks_bagian_a_uh4;
	$nilai_maks_bagian_a_mid = $dtmapel->nilai_maks_bagian_a_mid;
	$nilai_maks_bagian_a_uas = $dtmapel->nilai_maks_bagian_a_uas;
	$nilai_maks_bagian_b_uh1 = $dtmapel->nilai_maks_bagian_b_uh1;
	$nilai_maks_bagian_b_uh2 = $dtmapel->nilai_maks_bagian_b_uh2;
	$nilai_maks_bagian_b_uh3 = $dtmapel->nilai_maks_bagian_b_uh3;
	$nilai_maks_bagian_b_uh4 = $dtmapel->nilai_maks_bagian_b_uh4;
	$nilai_maks_bagian_b_mid = $dtmapel->nilai_maks_bagian_b_mid;
	$nilai_maks_bagian_b_uas = $dtmapel->nilai_maks_bagian_b_uas;

	$nsoal_b_uh1 = $dtmapel->nsoal_b_uh1;
	$nsoal_b_uh2 = $dtmapel->nsoal_b_uh2;
	$nsoal_b_uh3 = $dtmapel->nsoal_b_uh3;
	$nsoal_b_uh4 = $dtmapel->nsoal_b_uh4;
	$nsoal_b_mid = $dtmapel->nsoal_b_mid;
	$nsoal_b_uas = $dtmapel->nsoal_b_uas;
	$kelompok = $dtmapel->kelompok;
}

if ((empty($mapel)) or (empty($thnajaran)) or (empty($semester)) or (empty($kelas)))
{
	echo '<div class="alert alert-danger"><strong>KKM mata pelajaran dimaksud tidak ada, = 0, tidak boleh disunting, atau Anda tidak mengampu mata pelajaran ini. Hubungi Pengajaran</strong>.</div>';
}
else
{
$kurikulum = cari_kurikulum($thnajaran,$semester,$kelas);
if($kurikulum == '?')
{
	echo '<div class="alert alert-danger"><strong>Kurikulum belum ditentukan, hubungi pengajaran</strong>.</div>';
}
else
{
echo form_open('guru/updatekkm','class="form-horizontal" role="form"');?>
	<div class="card">
	<div class="card-header"><h3>Kurikulum <?php echo $kurikulum;?></h3></div>
	<div class="card-body">
	<div class="form-group row">
		<div class="col-sm-3"><label for="thnajaran" class="control-label">Tahun Pelajaran</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $thnajaran;?></p></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="semester" class="control-label">Semester</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $semester;?></p></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="kelas" class="control-label">Kelas</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $kelas;?></p></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="mapel" class="control-label">Mata Pelajaran</label></div>
		<div class="col-sm-9"><p class="form-control-static"><?php echo $mapel;?></p></div>
	</div>
	<div class="form-group row">
		<?php
		$kadamid = $nadamid;
		if ($nadamid=="Y")
			{$kadamid="Ya";}
		if ($nadamid=="T")
			{$kadamid="Tidak";}
		?>
		<div class="col-sm-3"><label for="njam" class="control-label">Cacah Jam Tatap Muka</label></div>
		<div class="col-sm-9" ><input type="text" name="jam" value="<?php echo $njam;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3" ><label for="kadamid" class="control-label">Ada Ulangan Tengah Semester</label></div>
		<div class="col-sm-9" >
 			<select name="adamid" class="form-control">
				<option value="<?php echo $kadamid;?>"><?php echo $kadamid;?></option>
				<option value="Y">Ya</option>
				<option value="T">Tidak</option>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="kkm" class="control-label">KKM</label></div>
		<div class="col-sm-9" ><input type="number" name="kkm" min="70" max="100" value="<?php echo $kkm;?>" class="form-control" required></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3" ><label for="ranah" class="control-label">Ranah Penilaian</label></div>
		<div class="col-sm-9" >
 			<select name="ranah" class="form-control">
				<option value="<?php echo $ranah;?>"><?php echo $ranah;?></option>
				<option value="KP">KP</option>
<?php
/*
				<option value="KPA">KPA</option>
				<option value="KA">KA</option>
				<option value="PA">PA</option>
*/
?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="cacah_ulangan_harian" class="control-label">Cacah Ulangan Harian (maks 10)</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="10" name="cacah_ulangan_harian" value="<?php echo $ncacah_ulangan_harian;?>" class="form-control"></div>
	</div>

	<div class="form-group row">
		<div class="col-sm-3"><label for="cacah_tugas" class="control-label">Cacah Tugas (maks 10)</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="10" name="cacah_tugas" value="0" class="form-control" readonly></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="cacah_kuis" class="control-label">Cacah Kuis (maks 4)</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="4" name="cacah_kuis" value="0" class="form-control" readonly></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_ulangan_harian" class="control-label">Bobor Penilaian Harian</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_ulangan_harian" value="<?php echo $nbobot_ulangan_harian;?>" class="form-control"></div>
	</div>
<?php
/*
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_tugas" class="control-label">Bobot Tugas</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_tugas" value="0" class="form-control" readonly></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_kuis" class="control-label">Bobot Kuis</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_kuis" value="<?php echo $nbobot_kuis;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_mid" class="control-label">Bobot Ulangan Tengah Semester</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_mid" value="<?php echo $nbobot_mid;?>" class="form-control"></div>
	</div>
*/
?>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_semester" class="control-label">Bobot Ulangan Akhir Semester / Kenaikan Kelas</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_semester" value="<?php echo $nbobot_semester;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_praktik" class="control-label">Bobot Praktik</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_praktik" value="<?php echo $nbobot_praktik;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_portofolio" class="control-label">Bobot portofolio</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_portofolio" value="<?php echo $nbobot_portofolio;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="bobot_projek" class="control-label">Bobot projek</label></div>
		<div class="col-sm-9" ><input type="number" min="0" max="100" name="bobot_projek" value="<?php echo $nbobot_projek;?>" class="form-control"></div>
	</div>

	<div class="form-group row">
		<div class="col-sm-12 alert alert-info"><p>Sebelum K2013 Bobot Ulangan Harian + Bobot Tugas + Bobot Mid + Bobot Ulangan Semester / UKK = 100</p>
			<p>K2013</p>
			<p>Bobot Ulangan Harian + Bobot Kuis + Bobot Tugas = 33%</p>
			<p>Bobot Mid = 33%</p>
			<p>Bobot Ulangan Semester / UKK = 34%</p>
		</div>
		<div class="col-sm-12"><strong>Parameter Untuk Analisis / Deskripsi LCK</strong></div>
	</div>
	<div class="form-group row">
		<?php
		$tahun1 = substr($thnajaran,0,4);
		?>
		<div class="col-sm-12"><h3>Ulangan Harian I</h3></div>
		<div class="col-sm-3"><label for="" class="control-label">KKM UH1</label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="kkm_uh1" value="<?php echo $kkm_uh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Indikator UH1</label></div>
		<div class="col-sm-9"><a href="<?php echo base_url();?>akreditasi/indikator/<?php echo $tahun1.'/'.$semester.'/'.$id_mapel.'/uh1';?>" target="_blank" class="btn btn-link"><span class="glyphicon glyphicon-new-window"></span></a></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian A UH1 <a href="#" title="Info lebih lanjut" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi cacah soal pilihan, Bentuk soal uraian diisi cacah soal uraian, Bentuk soal pilihan + uraian diisi cacah soal pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="50" name="nsoal_uh1" value="<?php echo $nsoal_uh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian B UH1 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi cacah soal uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="10" name="nsoal_b_uh1" value="<?php echo $nsoal_b_uh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Skor tertinggi tiap soal <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 1, Bentuk soal uraian diisi skor tertinggi tiap soal, Bentuk soal pilihan + uraian diisi 1"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="skor_uh1" value="<?php echo $skor_uh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian A <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 100, Bentuk soal uraian diisi 100, Bentuk soal pilihan + uraian diisi total skor pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_a_uh1" value="<?php echo $nilai_maks_bagian_a_uh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian B <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi total skor uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_b_uh1" value="<?php echo $nilai_maks_bagian_b_uh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12"><h3>Ulangan Harian II</h3></div>
		<div class="col-sm-3"><label for="" class="control-label">KKM UH2</label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="kkm_uh2" value="<?php echo $kkm_uh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Indikator UH2</label></div>
		<div class="col-sm-9"><a href="<?php echo base_url();?>akreditasi/indikator/<?php echo $tahun1.'/'.$semester.'/'.$id_mapel.'/uh2';?>" target="_blank" class="btn btn-link"><span class="glyphicon glyphicon-new-window"></span></a></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian A UH2 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi cacah soal pilihan, Bentuk soal uraian diisi cacah soal uraian, Bentuk soal pilihan + uraian diisi cacah soal pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="50" name="nsoal_uh2" value="<?php echo $nsoal_uh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian B UH2 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi cacah soal uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="10" name="nsoal_b_uh2" value="<?php echo $nsoal_b_uh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Skor tertinggi tiap soal <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 1, Bentuk soal uraian diisi skor tertinggi tiap soal, Bentuk soal pilihan + uraian diisi 1"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="skor_uh2" value="<?php echo $skor_uh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian A <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 100, Bentuk soal uraian diisi 100, Bentuk soal pilihan + uraian diisi total skor pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_a_uh2" value="<?php echo $nilai_maks_bagian_a_uh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian B <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi total skor uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_b_uh2" value="<?php echo $nilai_maks_bagian_b_uh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12"><h3>Ulangan Harian III</h3></div>
		<div class="col-sm-3"><label for="" class="control-label">KKM UH3</label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="kkm_uh3" value="<?php echo $kkm_uh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Indikator UH3</label></div>
		<div class="col-sm-9"><a href="<?php echo base_url();?>akreditasi/indikator/<?php echo $tahun1.'/'.$semester.'/'.$id_mapel.'/uh3';?>" target="_blank" class="btn btn-link"><span class="glyphicon glyphicon-new-window"></span></a></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian A UH3 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi cacah soal pilihan, Bentuk soal uraian diisi cacah soal uraian, Bentuk soal pilihan + uraian diisi cacah soal pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="50" name="nsoal_uh3" value="<?php echo $nsoal_uh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian B UH3 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi cacah soal uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="10" name="nsoal_b_uh3" value="<?php echo $nsoal_b_uh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Skor tertinggi tiap soal <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 1, Bentuk soal uraian diisi skor tertinggi tiap soal, Bentuk soal pilihan + uraian diisi 1"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="skor_uh3" value="<?php echo $skor_uh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian A <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 100, Bentuk soal uraian diisi 100, Bentuk soal pilihan + uraian diisi total skor pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_a_uh3" value="<?php echo $nilai_maks_bagian_a_uh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian B <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi total skor uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_b_uh3" value="<?php echo $nilai_maks_bagian_b_uh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12"><h3>Ulangan Harian IV</h3></div>
		<div class="col-sm-3"><label for="" class="control-label">KKM UH4</label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="kkm_uh4" value="<?php echo $kkm_uh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Indikator UH4</label></div>
		<div class="col-sm-9"><a href="<?php echo base_url();?>akreditasi/indikator/<?php echo $tahun1.'/'.$semester.'/'.$id_mapel.'/uh4';?>" target="_blank" class="btn btn-link"><span class="glyphicon glyphicon-new-window"></span></a></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian A UH4 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi cacah soal pilihan, Bentuk soal uraian diisi cacah soal uraian, Bentuk soal pilihan + uraian diisi cacah soal pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="50" name="nsoal_uh4" value="<?php echo $nsoal_uh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian B UH4 <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi cacah soal uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="10" name="nsoal_b_uh4" value="<?php echo $nsoal_b_uh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Skor tertinggi tiap soal <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 1, Bentuk soal uraian diisi skor tertinggi tiap soal, Bentuk soal pilihan + uraian diisi 1"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="skor_uh4" value="<?php echo $skor_uh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian A <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 100, Bentuk soal uraian diisi 100, Bentuk soal pilihan + uraian diisi total skor pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_a_uh4" value="<?php echo $nilai_maks_bagian_a_uh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian B <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi total skor uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_b_uh4" value="<?php echo $nilai_maks_bagian_b_uh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12"><h3>Ulangan Tengah Semester</h3></div>
		<div class="col-sm-3"><label for="" class="control-label">KKM MID</label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="kkm_mid" value="<?php echo $kkm_mid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Indikator MID</label></div>
		<div class="col-sm-9"><a href="<?php echo base_url();?>akreditasi/indikator/<?php echo $tahun1.'/'.$semester.'/'.$id_mapel.'/mid';?>" target="_blank" class="btn btn-link"><span class="glyphicon glyphicon-new-window"></span></a></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian A mid <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi cacah soal pilihan, Bentuk soal uraian diisi cacah soal uraian, Bentuk soal pilihan + uraian diisi cacah soal pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="50" name="nsoal_mid" value="<?php echo $nsoal_mid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian B mid <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi cacah soal uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="10" name="nsoal_b_mid" value="<?php echo $nsoal_b_mid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Skor tertinggi tiap soal <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 1, Bentuk soal uraian diisi skor tertinggi tiap soal, Bentuk soal pilihan + uraian diisi 1"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="skor_mid" value="<?php echo $skor_mid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian A <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 100, Bentuk soal uraian diisi 100, Bentuk soal pilihan + uraian diisi total skor pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_a_mid" value="<?php echo $nilai_maks_bagian_a_mid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian B <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi total skor uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_b_mid" value="<?php echo $nilai_maks_bagian_b_mid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12"><h3>Ulangan Akhir Semester / Ulangan Kenaikan Kelas</h3></div>
		<div class="col-sm-3"><label for="" class="control-label">KKM UAS</label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="kkm_uas" value="<?php echo $kkm_uas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Indikator UAS</label></div>
		<div class="col-sm-9"><a href="<?php echo base_url();?>akreditasi/indikator/<?php echo $tahun1.'/'.$semester.'/'.$id_mapel.'/uas';?>" target="_blank" class="btn btn-link"><span class="glyphicon glyphicon-new-window"></span></a></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian A uas <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi cacah soal pilihan, Bentuk soal uraian diisi cacah soal uraian, Bentuk soal pilihan + uraian diisi cacah soal pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="50" name="nsoal_uas" value="<?php echo $nsoal_uas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Soal Bagian B uas <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi cacah soal uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="10" name="nsoal_b_uas" value="<?php echo $nsoal_b_uas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Skor tertinggi tiap soal <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 1, Bentuk soal uraian diisi skor tertinggi tiap soal, Bentuk soal pilihan + uraian diisi 1"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="skor_uas" value="<?php echo $skor_uas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian A <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 100, Bentuk soal uraian diisi 100, Bentuk soal pilihan + uraian diisi total skor pilihan"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_a_uas" value="<?php echo $nilai_maks_bagian_a_uas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jumlah Skor Bagian B <a href="#" title="Info" data-toggle="popover" data-trigger="hover" data-content="Bentuk soal pilihan diisi 0, Bentuk soal uraian diisi 0, Bentuk soal pilihan + uraian diisi total skor uraian"><span class="badge badge-primary">INFO</span></a></label></div>
		<div class="col-sm-9"><input type="number" min="0" max="100" name="nilai_maks_bagian_b_uas" value="<?php echo $nilai_maks_bagian_b_uas;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian I</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok A </label></div>
			<div class="col-sm-7"><input type="text" name="kunciuh1" value="<?php echo $kunciuh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian I</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok B </label></div>
			<div class="col-sm-7"><input type="text" name="kuncibuh1" value="<?php echo $kuncibuh1;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian II</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok A</label></div>
			<div class="col-sm-7"><input type="text" name="kunciuh2" value="<?php echo $kunciuh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian II</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok B</label></div>
			<div class="col-sm-7"><input type="text" name="kuncibuh2" value="<?php echo $kuncibuh2;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian III</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok A</label></div>
			<div class="col-sm-7"><input type="text" name="kunciuh3" value="<?php echo $kunciuh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian III</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok B</label></div>
			<div class="col-sm-7"><input type="text" name="kuncibuh3" value="<?php echo $kuncibuh3;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban Ulangan Harian IV</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok A</label></div>
			<div class="col-sm-7"><input type="text" name="kunciuh4" value="<?php echo $kunciuh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label class="control-label">Kunci Jawaban Ulangan Harian IV</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok B</label></div>
			<div class="col-sm-7"><input type="text" name="kuncibuh4" value="<?php echo $kuncibuh4;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban PTS</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok A</label></div>
			<div class="col-sm-7"><input type="text" name="kuncimid" value="<?php echo $kuncimid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban PTS</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok B</label></div>
			<div class="col-sm-7"><input type="text" name="kuncibmid" value="<?php echo $kuncibmid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Jawaban PAS / PAT</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok A</label></div>
			<div class="col-sm-7"><input type="text" name="kunciuas" value="<?php echo $kuncimid;?>" class="form-control"></div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3"><label for="" class="control-label">Kunci Jawaban PAS / PAT</label></div>
			<div class="col-sm-2"><label for="" class="control-label">Kelompok B</label></div>
			<div class="col-sm-7"><input type="text" name="kuncibuas" value="<?php echo $kuncibmid;?>" class="form-control"></div>
	</div>

   <p class="text-center"><button type="submit" class="btn btn-primary">Simpan KKM</button><input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>"></p>
</div></div></form>
<?php
} // akhir ada kurikulum
}//akhir berhak
?>
</div>

