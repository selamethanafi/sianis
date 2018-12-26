<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: rph_edit.php
// Lokasi      		: application/views/guru/
// Terakhir diperbarui	: Rab 11 Mei 2016 12:15:36 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">
<?php echo form_open('guru/tambahrph','class="form-horizontal" role="form"');
$ta = $this->db->query("select * from guru_rph_ringkas where id_rph='$id_rph'");
if(count($ta->result())>0)
{
foreach ($ta->result() as $d)
{
$thnajaran = $d->thnajaran;
$semester = $d->semester;
$tanggalrph = $d->tanggal;
$kode_rpp = $d->kode_rpp;
$mapel = $d->mapel;
$kelas = $d->kelas;
$jamke = $d->jamke;
$keterangan = $d->keterangan;
$hambatan_siswa = $d->hambatan_siswa;
$tanggal_bph = $d->tanggal_bph;
$solusi = $d->solusi;
$lab = $d->lab;
$alat_dan_bahan = $d->alat_dan_bahan;
}
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">
	<?php
if (empty($thnajaran))
	{$thnajaran=$thnajaranx;}
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
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal RPH</label></div><div class="col-sm-3">';
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
			echo '<option value="'.$postedbulan.'">'.gantibulan($postedbulan).'</option>';	
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
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal BPH</label></div><div class="col-sm-3">';
	echo '<select name="tanggalhadir2" class="form-control"">';
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
			echo '<option value="'.$postedbulan.'">'.gantibulan($postedbulan).'</option>';	
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
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode RPP</label></div><div class="col-sm-9"><input type="text" name="kode_rpp" class="form-control" value="<?php echo $kode_rpp;?>"></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Keterangan</label></div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="keterangan" rows="5" class="form-control"><?php echo $keterangan;?></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Hambatan Siswa</label>
Silakan kopi / paste<ul>
<li>Ada siswa yang tidak dapat mengerjakan soal</li>
<li>Ada siswa tidur</li>
<li>Ada siswa yang bermain HP</li>
<li>Ada siswa yang membuat gaduh</li>
<li>Ada siswa yang membolos</li>
<li>Ada siswa yang terlambat masuk kelas</li>
<li>Ada siswa yang belum memahami konsep</li></ul>
</div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="hambatan_siswa" rows="5" class="form-control"><?php echo $hambatan_siswa;?></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Solusi</label>
Silakan kopi / paste<ul>
<li>Sering mengerjakan latihan soal</li>
<li>Tutor sebaya</li>
<li>Pengamatan langsung</li>
<li>Tugas tambahan peta konsep</li>
<li>ditegur dan diingatkan</li>
<li>HP disita</li>
<li>dihadapkan ke walikelas atau BP</li>
<li>diberi skor</li></ul>
</div></div>
<div class="form-group row row"><div class="col-sm-12"><textarea name="solusi" rows="5" class="form-control"><?php echo $solusi;?></textarea></div></div>

<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Menggunakan Laboratorium</label></div><div class="col-sm-9">';
echo '<select name="lab" class="form-control">';
//cari id_mapel terpilih
	$td = $this->db->query("select * from `m_tugas_tambahan` where `nama_tugas_tambahan` like 'kepala laboratorium%' order by `nama_tugas_tambahan`");
	echo '<option value = "'.$lab.'">'.$lab.'</option>';
	echo '<option value = ""></option>';
	foreach($td->result() as $d)
	{
	$nkar = strlen($d->nama_tugas_tambahan);
	$kiri = $nkar - 6;
	echo '<option value = "'.substr($d->nama_tugas_tambahan,6,$kiri).'">'.substr($d->nama_tugas_tambahan,6,$kiri).'</option>';
	}
echo '</select></div></div><div class="form-group row row"><div class="col-sm-12"><label class="control-label">Jika menggunakan lab, alat, bahan, perangkat yang digunakan </label></div></div><div class="form-group row row"><div class="col-sm-12">
<textarea name="alat_dan_bahan" rows="5" class="form-control">'.$alat_dan_bahan.'</textarea></div></div>';
echo '<p class="text-center"><input name="id_rph" type="hidden" value="'.$id_rph.'"><input name="kodeguru" type="hidden" value="'.$kodeguru.'"><button type="submit" class="btn btn-primary">Simpan Data</button>&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rph" class="btn btn-info">Batal</a></div></div>';
?>
</form>
<?php
}
else
{
echo 'Galat, RPH/BPH tidak ditemukan';
}
?>
</div>
