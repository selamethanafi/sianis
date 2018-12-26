<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: bph_lain_edit.php
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
<p><a href="<?php echo ''.base_url().'guru/rphlain2';?>" class="btn btn-info"><b>Batal</b></a></p>
<?php echo form_open('guru/tambahrphlain2','class="form-horizontal" role="form"');
$tb = $this->db->query("select * from m_mapel where id_mapel = '$id_mapel'");
foreach($tb->result() as $b)
	{
	$mapel = $b->mapel;
	$kelas = $b->kelas;
	}
$tc = $this->db->query("select * from `tharitatapmuka` where id_hari_tatap_muka = '$id_hari_tatap_muka'");
foreach($tc->result() as $c)
	{
	$hari_tatap_muka = day_to_hari($c->hari_tatap_muka);
	$jam_ke = $c->jam_ke;
	}

$ta = $this->db->query("select * from guru_rph_ringkas where thnajaran ='$thnajaran' and semester='$semester' and kodeguru='$kodeguru' and kelas='$kelas' and mapel='$mapel' and tanggal='$tanggalrphe'");
if(count($ta->result())>0)
{
	foreach($ta->result() as $a)
	{ 
	$id_rph = $a->id_rph;
	}
	$trph = $this->db->query("select * from guru_rph_ringkas where id_rph='$id_rph'");
	foreach($trph->result_array() as $d)
		{
		$kode_rpp = $d['kode_rpp'];
		$tanggal_bph = $d['tanggal_bph'];
		$keterangan = $d['keterangan'];
		$hambatan_siswa = $d['hambatan_siswa'];
		$alat_dan_bahan =  $d['alat_dan_bahan'];
		$lab = $d['lab'];
		}
}
else
{
	$id_rph = '';
	$kode_rpp = '';
	$sk = '';
	$materi = '';
	$tanggal_bph = $tanggalrphe;
	$rencana = '';
	$keterangan = '';
	$materi_selanjutnya = '';
	$hambatan_siswa = '';
	$alat_dan_bahan =  '';
	$lab = '';

}
?>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9 form-control-static"><?php echo $thnajaran;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9  form-control-static"><?php echo $semester;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Mapel</label></div><div class="col-sm-9  form-control-static"><?php echo $mapel;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kelas</label></div><div class="col-sm-9 form-control-static"><?php echo $kelas;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Hari tatap muka</label></div><div class="col-sm-9  form-control-static"><?php echo $hari_tatap_muka;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Jam Ke -</label></div><div class="col-sm-9  form-control-static"><?php echo $jam_ke;?></div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal RPH</label></div><div class="col-sm-9  form-control-static"><?php echo date_to_long_string($tanggalrphe);?></div></div>
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal BPH</label></div><div class="col-sm-9">';
	echo '<select name="tanggalhadir2">';
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
	echo '</select>';
	echo '<select name="bulanhadir2">';
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
	echo '</select>';
	echo '<select name="tahunhadir2">';
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
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode RPP</label></div><div class="col-sm-9"><input type="text" name="kode_rpp" size="5" class="form-control" value="<?php echo $kode_rpp;?>"></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Keterangan</div><div class="col-sm-12"><textarea name="keterangan" cols="65" rows="5" class="form-control"><?php echo $keterangan;?></textarea></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Hambatan Siswa</div><div class="col-sm-12"><textarea name="hambatan_siswa" cols="65" rows="5" class="form-control"><?php echo $hambatan_siswa;?></textarea></div></div>
<?php
echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Menggunakan Laboratorium</label></div><div class="col-sm-9">';
echo '<select name="lab" class="form-control">';
//cari id_mapel terpilih
	$td = $this->db->query("select * from `m_tugas_tambahan` where `nama_tugas_tambahan` like 'kepala laboratorium%' order by `nama_tugas_tambahan`");
	echo '<option value = ""></option>';
	foreach($td->result() as $d)
	{
	$nkar = strlen($d->nama_tugas_tambahan);
	$kiri = $nkar - 6;
	echo '<option value = "'.substr($d->nama_tugas_tambahan,6,$kiri).'">'.substr($d->nama_tugas_tambahan,6,$kiri).'</option>';
	}
echo '</select></div></div>
<div class="form-group row row"><div class="col-sm-12"><label class="control-label">Jika menggunakan lab, alat, bahan, perangkat yang digunakan</label></div><div class="col-sm-12"><textarea name="alat_dan_bahan" rows="5" class="form-control">'.$alat_dan_bahan.'</textarea></div></div>';
echo '<input name="id_rph" type="hidden" value="'.$id_rph.'">
<input name="id_mapel" type="hidden" value="'.$id_mapel.'">
<input name="jam_ke" type="hidden" value="'.$jam_ke.'">
<input name="thnajaran" type="hidden" value="'.$thnajaran.'">
<input name="semester" type="hidden" value="'.$semester.'">
<input name="kodeguru" type="hidden" value="'.$kodeguru.'">
<input name="tanggalrph" type="hidden" value="'.$tanggalrphe.'">
<p class="text-center"><input type="submit" value="Simpan Data" class="btn btn-primary">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'guru/rphlain" class="btn btn-info"><b>Batal</b></a></p>';
?>
</form>
</div></div></div>

