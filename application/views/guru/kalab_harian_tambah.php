<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : bip_tambah.php
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
<div class="card">
<div class="card-header"><h3><?php echo $judulhalaman;?></h3></div>
<div class="card-body">

<?php 
	$daftar_tapel = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
if ($aksi == 'tambah')
{
	?>
	<h3>Tambah Agenda Harian</h3>
	<form method="post" action="<?php echo base_url(); ?><?php echo $tugase;?>/harian/<?php echo $id;?>" class="form-horizontal" role="form">
	<?php
	if (empty($thnajaran))
		{
		$thnajaran = cari_thnajaran();
		}
	if (empty($semester))
		{
		$semester = cari_semester();
		}

	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9"><p class="form-control-static">'.$kodeguru.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></div></div>';
	$postedhari= date('d');
	$postedbulan= date('m');
	$postedtahun= date('Y');

	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
	echo '<select name="tanggalhadir">';
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
	echo '<select name="bulanhadir" >';
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
	echo '<select name="tahunhadir" >';
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
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div><div class="col-sm-9"><input type="text" name="namakegiatan" class="form-control"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><input type="text" name="tempat" class="form-control"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu/pukul</label></div><div class="col-sm-9"><input type="text" name="waktu" class="form-control"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><input type="text" name="keterangan" class="form-control"> </div></div>
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().''.$tugase.'/harian/'.$id.'" class="btn btn-info"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="form-control">
<input type="hidden" name="post_aksi" value="tambah_data" class="form-control"></div></div>';
}

if ($aksi == 'ubah')
{
echo '<h2>Ubah Agenda Harian</h2>';
?><form method="post" action="<?php echo base_url(); ?><?php echo $tugase;?>/harian/<?php echo $id;?>" class="form-horizontal" role="form">
<?php
$tb = $this->db->query("SELECT * FROM `kalab_harian` where kodeguru='$kodeguru' and id_kalab_harian='$id_proker'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
		
 echo '<table cellspacing="5"><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Kode Guru</label></div><div class="col-sm-9"><p class="form-control-static">'.$kodeguru.'</p></div></div>
	<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tahun Pelajaran</label></div><div class="col-sm-9">
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$b->thnajaran."'>".$b->thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></div></div><div class="form-group row row"><div class="col-sm-3"><label class="control-label">Semester</label></div><div class="col-sm-9">
	<select name="semester" class="form-control">';
	echo "<option value='".$b->semester."'>".$b->semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></div></div>';
	$postedhari= substr($b->tanggal,8,2);
	$postedbulan= substr($b->tanggal,5,2);
	$postedtahun= substr($b->tanggal,0,4);

	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tanggal</label></div><div class="col-sm-9">';
	echo '<select name="tanggalhadir">';
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
	echo '<select name="bulanhadir" >';
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
	echo '<select name="tahunhadir" >';
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
	echo '<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Nama Kegiatan</label></div><div class="col-sm-9"><input type="text" name="namakegiatan" class="form-control" value="'.$b->namakegiatan.'"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Tempat</label></div><div class="col-sm-9"><input type="text" name="tempat" class="form-control" value="'.$b->tempat.'"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Waktu/pukul</label></div><div class="col-sm-9"><input type="text" name="waktu" class="form-control" value="'.$b->waktu.'"> </div></div>
<div class="form-group row row"><div class="col-sm-3"><label class="control-label">Keterangan</label></div><div class="col-sm-9"><input type="text" name="keterangan" class="form-control" value="'.$b->keterangan.'"> </div></div>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="form-control">
<input type="hidden" name="id_kalab_harian" value="'.$id_proker.'" class="form-control">
<input type="hidden" name="post_aksi" value="ubah_data" class="form-control">
<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"> <a href="'.base_url().''.$tugase.'/harian/'.$id.'" class="btn btn-info"><b>Batal</b></a></p>';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah
echo '</form>';
?>
</div></div></div>
