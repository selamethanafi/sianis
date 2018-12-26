<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Rab 05 Nov 2014 09:54:47 WIB 
// Nama Berkas 		: detik_analisis.php
// Lokasi      		: application/views/siswa/
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
<div class="container-fluid">
<div class="panel panel-default">
<div class="panel-heading"><h3><?php echo $judulhalaman;?></h3></div>
<div class="panel-body">
<?php
echo '<a href="'.base_url().'index.php/siswa/analisis"><b>Kembali</b></a><br>';
$query = $this->db->query("select * from analisis where `id_analisis` = '$id_analisis' and nis='$nim'");
if(count($query->result())>0){
?>
	<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td><strong>Tahun</strong></td><td><strong>Semester</strong></td><td><strong>Mapel</strong></td><td><strong>Ulangan</strong></td><td><strong>Nilai</strong></td><td><strong>Tuntas</strong></td><td><strong>Cacah Soal Pilihan</strong></td><td><strong>Skor Tiap Soal</strong></td></tr>
	<?php
	$nomor=1;
	foreach($query->result() as $t)
	{
		$thnajaran = $t->thnajaran;
		$semester = $t->semester;
		$mapel = $t->mapel;
		$kelas = $t->kelas;
		$ulangan = $t->ulangan;
		$tmapel = $this->db->query("select * from m_mapel where thnajaran = '$thnajaran' and kelas='$kelas' and semester='$semester' and mapel='$mapel'");
		$tjawaban = $this->db->query("select * from analisis where thnajaran = '$thnajaran' and kelas='$kelas' and semester='$semester' and mapel='$mapel' and ulangan='$ulangan' and nis='$nim'");
		$jawabansiswa ='';
		foreach($tjawaban->result() as $j)
		{
			$jawabansiswa = $j->jawaban;
			$uraian_1 = $j->uraian_1;
			$uraian_2 = $j->uraian_2;
			$uraian_3 = $j->uraian_3;
			$uraian_4 = $j->uraian_4;
			$uraian_5 = $j->uraian_5;
			$uraian_6 = $j->uraian_6;
			$uraian_7 = $j->uraian_7;
			$uraian_8 = $j->uraian_8;
			$uraian_9 = $j->uraian_9;
			$uraian_10 = $j->uraian_10;
			$terkunci = $j->terkunci;
		}	
		$kkm = 70;
		$nsoal = 0;
		foreach($tmapel->result() as $dtmapel)
		{
			$kelas = $dtmapel->kelas;
			$mapel = $dtmapel->mapel;
			$thnajaran = $dtmapel->thnajaran;
			$semester = $dtmapel->semester;
			$kkm = $dtmapel->kkm;
			if ($ulangan=='uh1')
			{
				$kkm_ulangan = $dtmapel->kkm_uh1;
				$nsoal = $dtmapel->nsoal_uh1;
				$skor = $dtmapel->skor_uh1;
			}
			if ($ulangan=='uh3')
			{
				$kkm_ulangan = $dtmapel->kkm_uh3;
				$nsoal = $dtmapel->nsoal_uh3;
				$skor = $dtmapel->skor_uh3;
			}
			if ($ulangan=='uh4')
			{
				$kkm_ulangan = $dtmapel->kkm_uh4;
				$nsoal = $dtmapel->nsoal_uh4;
				$skor = $dtmapel->skor_uh4;
			}
			if ($ulangan=='uh2')
			{
				$kkm_ulangan = $dtmapel->kkm_uh2;
				$nsoal = $dtmapel->nsoal_uh2;
				$skor = $dtmapel->skor_uh2;
			}
			if ($ulangan=='mid')
			{
				$kkm_ulangan = $dtmapel->kkm_mid;
				$nsoal = $dtmapel->nsoal_mid;
				$skor = $dtmapel->skor_mid;
			}
			if ($ulangan=='uas')
			{
				$kkm_ulangan = $dtmapel->kkm_uas;
				$nsoal = $dtmapel->nsoal_uas;
				$skor = $dtmapel->skor_uas;
			}
		}
		if($kkm_ulangan==0)
		{
			$kkm_ulangan = $kkm;
		}
		$kolom = 0;
		$nilaipersiswa= 0;
		$skormaks = $skor*$nsoal;
		do
		{	
			$nilaine=0;
			$nokol = $kolom + 1;
			$item = 'nilai_s'.$nokol.'';
			$nilaine = $t->$item;
			$nilaipersiswa= $nilaipersiswa + $nilaine;
			$kolom++;
		}
		while ($kolom<$nsoal);
		$skoruraian = $t->uraian_1 + $t->uraian_2 + $t->uraian_3 + $t->uraian_4 + $t->uraian_5 + $t->uraian_6 + $t->uraian_7 + $t->uraian_8 + $t->uraian_9 + $t->uraian_10;
		$nilaiulangan = $nilaipersiswa + $skoruraian; 
		if ($nilaiulangan < $kkm_ulangan)
		{
			$tuntas = "Belum";
		}
		else
		{
			$tuntas = "Ya";
		}

		echo "<tr><td align=\"center\">".$thnajaran."</td><td align=\"center\">".$semester."</td><td>".$mapel."</td><td align=\"center\">".$ulangan."</td><td align=\"center\">".$nilaiulangan."</td><td align=\"center\">".$tuntas."</td><td align=\"center\">".$nsoal."</td><td align=\"center\">".$skor."</td></tr>";
		$nomor++;	
	}
	?>
	</table></div>
	<?php
	if ($terkunci==0)
	{
		echo form_open('siswa/analisis','class="form-horizontal" role="form"');?>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Jawaban</label></div><div class="col-sm-9"><input type="text" name="jawaban" value="<?php echo $jawabansiswa;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 1</label></div><div class="col-sm-9"><input type="text" name="uraian_1" value="<?php echo $uraian_1;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 2</label></div><div class="col-sm-9"><input type="text" name="uraian_2" value="<?php echo $uraian_2;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 3</label></div><div class="col-sm-9"><input type="text" name="uraian_3" value="<?php echo $uraian_3;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 4</label></div><div class="col-sm-9"><input type="text" name="uraian_4" value="<?php echo $uraian_4;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 5</label></div><div class="col-sm-9"><input type="text" name="uraian_5" value="<?php echo $uraian_5;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 6</label></div><div class="col-sm-9"><input type="text" name="uraian_6" value="<?php echo $uraian_6;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 7</label></div><div class="col-sm-9"><input type="text" name="uraian_7" value="<?php echo $uraian_7;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 8</label></div><div class="col-sm-9"><input type="text" name="uraian_8" value="<?php echo $uraian_8;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 9</label></div><div class="col-sm-9"><input type="text" name="uraian_9" value="<?php echo $uraian_9;?>" class="form-control"></div></div>
	     <div class="form-group row"><div class="col-sm-3"><label class="control-label">Nilai Uraian Nomor 10</label></div><div class="col-sm-9"><input type="text" name="uraian_10" value="<?php echo $uraian_10;?>" class="form-control"></div></div>
		<input type="hidden" name="thnajaran" value="<?php echo $thnajaran;?>">
		<input type="hidden" name="semester" value="<?php echo $semester;?>">
		<input type="hidden" name="mapel" value="<?php echo $mapel;?>">
		<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
		<input type="hidden" name="kelas" value="<?php echo $kelas;?>">
		<input type="hidden" name="ulangan" value="<?php echo $ulangan;?>">
		<input type="hidden" name="nis" value="<?php echo $nim;?>">
		<input type="hidden" name="kirim" value="oke">
		<p class="text-center"><input type="submit" value="Kirim Jawaban" class="btn btn-primary"></p>
		</form>
		<?php
	}
	$nomor = 1;
	$jumlahnilai = 0;
	?>
	<div class="col-sm-6">
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td><strong>Nomor Soal</strong></td><td><strong>Nilai</strong></td></tr>
	<?php
	do
	{
		$item = 'nilai_s'.$nomor.'';
		$nilaine = $t->$item;
		echo "<tr><td width=\"100\" align=\"center\">".$nomor."</td><td align=\"center\">".$nilaine."</td></tr>";
		$jumlahnilai = $jumlahnilai + $nilaine;
		$limit = $nomor;
		$nomor++;

	}
	while ($limit<$nsoal);
	echo "<tr><td width=\"100\" align=\"center\">Jumlah Skor</td><td align=\"center\">".$jumlahnilai."</td></tr>";

	echo '</table>';
	?>
	</div>
	<div class="col-sm-6">
	<table class="table table-striped table-hover table-bordered">
	<tr align="center"><td><strong>Nomor Soal Uraian</strong></td><td><strong>Nilai</strong></td></tr>
	<?php
	$nomor = 1;
	$jumlahnilaiuraian = 0;
	do
	{
		$item = 'uraian_'.$nomor.'';
		$nilaine = $t->$item;
		echo "<tr><td width=\"100\" align=\"center\">".$nomor."</td><td align=\"center\">".$nilaine."</td></tr>";
		$jumlahnilaiuraian = $jumlahnilaiuraian + $nilaine;
		$limit = $nomor;
		$nomor++;

	}
	while ($limit<10);
	$nilaiulangan = $jumlahnilai + $jumlahnilaiuraian;
	echo "<tr><td width=\"100\" align=\"center\">Jumlah Skor</td><td align=\"center\">".$jumlahnilaiuraian."</td></tr>";
	echo "<tr><td width=\"100\" align=\"center\">Nilai Akhir</td><td align=\"center\">".$nilaiulangan."</td></tr>";
	echo '</table>
</div>';
}
else{
echo '<div class="alert alert-warning">Belum Ada Nilai / Tidak ditemukan</div>';
}
?>
</div></div></div>
