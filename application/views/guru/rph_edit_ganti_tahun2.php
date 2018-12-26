<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rph_edit.php
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
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<p><a href="<?php echo ''.base_url().'guru/rph';?>" class="btn btn-info"><b>Batal</b></a></p>
<?php echo form_open('guru/tambahrph','class="form-horizontal" role="form"');
$ta = $this->db->query("select * from `guru_rph_ringkas` where id_rph='$id_rph' and `kodeguru`='$kodeguru'");
if(count($ta->result())>0)
{
foreach ($ta->result() as $d)
{
$tanggalrph = $d->tanggal;
$mapel = $d->mapel;
$kelas = $d->kelas;
$jamke = $d->jamke;
$keterangan = $d->keterangan;
$hambatan_siswa = $d->hambatan_siswa;
$tanggal_bph = $d->tanggal_bph;
$solusi = $d->solusi;
$kode_rpp = $d->kode_rpp;
}
$no_rpp = '';
$dinane = tanggal_ke_hari($tanggalrph);
$trpp = $this->db->query("select * from `guru_rpp_induk` where `id_guru_rpp_induk`='$kode_rpp'");
$rencana ='';
foreach($trpp->result() as $rpp)
{
	$rencana = $rpp->rencana;
	$sk = $rpp->standar_kompetensi;
	$kd = $rpp->kompetensi_dasar;
}

$tahun2 = $tahun1+1;
$thnajaran = $tahun1.'/'.$tahun2;
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	?>
	</select></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">
	<?php
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	?>
	</select></div></div>
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Rencaran Harian</label></div><div class="col-sm-3">';
	echo '<select name="tanggalhadir" class="form-control">';
	$postedhari= substr($tanggalrph,8,2);
	$postedbulan=substr($tanggalrph,5,2);
	$postedtahun=substr($tanggalrph,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanhadir" class="form-control">';
			 if ($postedbulan=="01")
			{
			$bulan = "Januari";
			}
			if ($postedbulan=="02")
			{
			$bulan = "Februari";
			}
			if ($postedbulan=="03")
			{
			$bulan = "Maret";
			}
			if ($postedbulan=="04")
			{
			$bulan = "April";
			}
			if ($postedbulan=="05")
			{
			$bulan = "Mei";
			}
			if ($postedbulan=="06")
			{
			$bulan = "Juni";
			}
			if ($postedbulan=="07")
			{
			$bulan = "Juli";
			}
			if ($postedbulan=="08")
			{
			$bulan = "Agustus";
			}
			if ($postedbulan=="09")
			{
			$bulan = "September";
			}
			if ($postedbulan=="10")
			{
			$bulan = "Oktober";
			}
			if ($postedbulan=="11")
			{
			$bulan = "November";
			}
			if ($postedbulan=="12")
			{
			$bulan = "Desember";
			}
			if (($postedbulan=="00") or ($postedbulan==""))
			{
			$bulan = "-----";
			}
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunhadir" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	  	$th=date("Y");
	        $awal_th=$th;
	        $akhir_th=$th-20;
		$i = $awal_th;
		do
		{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
		}
		while ($i>=$akhir_th);
	echo '</select></div></div>';
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal Pelaksanaan</label></div><div class="col-sm-3">';
	echo '<select name="tanggalhadir2" class="form-control">';
	$postedhari= substr($tanggal_bph,8,2);
	$postedbulan=substr($tanggal_bph,5,2);
	$postedtahun=substr($tanggal_bph,0,4);
	echo '<option value="'.$postedhari.'">'.$postedhari.'</option>';
	for($i=1;$i<=9;$i++)
		{
		echo '<option value="0'.$i.'">0'.$i.'</option>';
		}	
	for($i=10;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="bulanhadir2" class="form-control">';
			 if ($postedbulan=="01")
			{
			$bulan = "Januari";
			}
			if ($postedbulan=="02")
			{
			$bulan = "Februari";
			}
			if ($postedbulan=="03")
			{
			$bulan = "Maret";
			}
			if ($postedbulan=="04")
			{
			$bulan = "April";
			}
			if ($postedbulan=="05")
			{
			$bulan = "Mei";
			}
			if ($postedbulan=="06")
			{
			$bulan = "Juni";
			}
			if ($postedbulan=="07")
			{
			$bulan = "Juli";
			}
			if ($postedbulan=="08")
			{
			$bulan = "Agustus";
			}
			if ($postedbulan=="09")
			{
			$bulan = "September";
			}
			if ($postedbulan=="10")
			{
			$bulan = "Oktober";
			}
			if ($postedbulan=="11")
			{
			$bulan = "November";
			}
			if ($postedbulan=="12")
			{
			$bulan = "Desember";
			}
			if (($postedbulan=="00") or ($postedbulan==""))
			{
			$bulan = "-----";
			}
			echo '<option value="'.$postedbulan.'">'.$bulan.'</option>';	
			echo '<option value="01">Januari</option>';
			echo '<option value="02">Februari</option>';
			echo '<option value="03">Maret</option>';
			echo '<option value="04">April</option>';
			echo '<option value="05">Mei</option>';
			echo '<option value="06">Juni</option>';
			echo '<option value="07">Juli</option>';
			echo '<option value="08">Agustus</option>';
			echo '<option value="09">September</option>';
			echo '<option value="10">Oktober</option>';
			echo '<option value="11">November</option>';
			echo '<option value="12">Desember</option>';
	echo '</select></div><div class="col-sm-3">';
	echo '<select name="tahunhadir2" class="form-control">';
	echo '<option value="'.$postedtahun.'">'.$postedtahun.'</option>';	
	  	$th=date("Y");
	        $awal_th=$th;
	        $akhir_th=$th-20;
		$i = $awal_th;
		do
		{
	       	echo '<option value="'.$i.'">'.$i.'</option>';
		$i=$i-1;
		}
		while ($i>=$akhir_th);
	echo '</select></div></div>';

?>
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel / Kelas</label></div><div class="col-sm-9">';
echo '<select name="id_mapel" class="form-control">';
//cari id_mapel terpilih
$tmapele = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' and mapel='$mapel' and kelas='$kelas'");
$id_mapele = '';
foreach($tmapele->result() as $dmapele)
	{	
	$id_mapele = $dmapele->id_mapel;
	}
	echo '<option value="'.$id_mapele.'">'.$mapel.' '.$kelas.'</option>';
$tmapel = $this->db->query("select * from m_mapel where kodeguru='$kodeguru' and thnajaran='$thnajaran' and semester='$semester' order by mapel,kelas");
foreach($tmapel->result() as $dm)
{
	echo '<option value="'.$dm->id_mapel.'">'.$dm->mapel.' '.$dm->kelas.'</option>';
}

	echo '</select></div></div>';
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jam Ke -</label></div><div class="col-sm-9"><input type="text" name="jamke" value="<?php echo $jamke;?>" class="form-control"></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode RPP</label></div><div class="col-sm-9"><input type="text" name="kode_rpp" value="<?php echo $kode_rpp;?>" class="form-control"></div></div>

<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Standar Kompetensi</label></div><div class="col-sm-12"><?php echo $sk;?></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Kompetensi Dasar</label></div><div class="col-sm-12"><?php echo $kd;?></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Rencana</label></div><div class="col-sm-12"><?php echo $rencana;?></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Keterangan</label></div><div class="col-sm-12"><textarea name="keterangan"  rows="5" class="textfield"><?php echo $keterangan;?></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Hambatan Siswa</label></div><div class="col-sm-12"> Silakan kopi / paste<ul>
<li>Ada siswa yang tidak dapat mengerjakan soal</li>
<li>Ada siswa tidur</li>
<li>Ada siswa yang bermain HP</li>
<li>Ada siswa yang membuat gaduh</li>
<li>Ada siswa yang membolos</li>
<li>Ada siswa yang terlambat masuk kelas</li>
<li>Ada siswa yang belum memahami konsep</li>
</ul><textarea name="hambatan_siswa" rows="10" class="form-control"><?php echo $hambatan_siswa;?></textarea></div></div>

<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Solusi</label></div><div class="col-sm-12"> Silakan kopi / paste<ul>
<li>Sering mengerjakan latihan soal</li>
<li>Tutor sebaya</li>
<li>Pengamatan langsung</li>
<li>Tugas tambahan peta konsep</li>
<li>ditegur dan diingatkan</li>
<li>HP disita</li>
<li>dihadapkan ke walikelas atau BP</li>
<li>diberi skor</li>
</ul><textarea name="solusi" rows="10" class="form-control"><?php echo $solusi;?></textarea></div></div>

<?php

echo '<p class="text-center"><input name="id_rph" type="hidden" value="'.$id_rph.'"><input name="kodeguru" type="hidden" value="'.$kodeguru.'"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rph" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
<?php
}
else
{
echo '<div class="alert alert-warning">Galat, Rencana, pelaksanaan harian tidak ditemukan</div>';
}
?>
</div></div></div>
