<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: piket_index.php
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
<?php echo form_open('guru/piketguru','class="form-horizontal" role="form"');?>
<?php 
$harine = tanggal_ke_hari($tanggalrph);
echo '<input name="kodegurupiket" type="hidden" value="'.$kodegurupiket.'">';
?>
<table>
<?php
	echo '<tr><td>Tahun Pelajaran</td><td>:</td><td>
	<select name="thnajaran" class="textfield-option">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></td></tr>';
	echo '<tr><td>Semester</td><td>:</td><td>
	<select name="semester" class="textfield-option">';
		echo '<option value="'.$semester.'">'.$semester.'</option>';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option></select></td></tr>';
	echo '<tr><td>Tanggal Berhalangan Hadir</td><td>: </td><td>';
	echo '<select name="tanggalhadir">';
	if (!empty($tanggalrph))
	{
	$postedhari =substr($tanggalrph,6,2);
	$postedbulan=substr($tanggalrph,4,2);
	$postedtahun=substr($tanggalrph,0,4);
	}
	else
	{
	$postedhari= date("d");
	$postedbulan=date("m");
	$postedtahun=date("Y");
	}
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
	echo '</select></td></tr>';
	echo '<tr><td>Nama / Kode Guru</td><td>:</td><td>
	<select name="kodeguru" class="textfield-option">';
	echo "<option value=''></option>";
	$daftar_guru = $this->db->query("select * from `p_pegawai` where `guru`='Y' and `status`='Y' order by `nama`");

	foreach($daftar_guru->result_array() as $ka)
	{
	echo "<option value='".$ka["kode"]."'>".$ka["nama"]."</option>";
	}
	echo '</select></td></tr>';
	$tb = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori ");
echo '<tr><td>Mapel </td><td>: </td><td>';
	echo '<select name="mapel">';
	echo "<option value=''></option>";
	foreach($tb->result() as $b)
	{
		echo '<option value="'.$b->nama_kategori.'">'.$b->nama_kategori.'</option>';
	}
	echo '</select></td></tr>';
echo '<tr><td>Kelas</td><td>: </td><td>';
	echo '<select name="kelas">';
	echo "<option value=''></option>";
	$td = $this->db->query("select * from `m_ruang` order by `ruang`");
	foreach($td->result() as $d)
		{ 
		echo '<option value="'.$d->ruang.'">'.$d->ruang.'</option>';
		}
	echo '<tr><td>Alasan ketidakhadiran</td><td>:</td><td><input type="text" name="keterangan" class="textfield" size="70"></td></tr>';	
	echo '
	<tr><td colspan="3">Tugas :<textarea name="tugas" cols="65" rows="25" class="textfield"></td></tr>';
echo '<tr><td></td><td></textarea></td></tr><tr><td>';
		echo '<input type="submit" value="Simpan" class="tombol-merah">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/guru/piketguru"><b>Batal</b></a></td></tr>';
?>
</table>
</form>
</div></div></div>
