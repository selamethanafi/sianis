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
if(empty($tugase))
	{
	$tugase = 'kalab';
	$namatugas = 'Kepala Laboratorium';
	}
if($tugase == 'kalab')
	{
	$tugase = 'kalab';
	$namatugas = 'Kepala Laboratorium';
	}
	else
	{
	$tugase = 'waka';
	$namatugas = 'Wakil Kepala Madrasah';
	}

?>
<div class="container-fluid">
<?php 
	$daftar_tapel = $this->db->query("select * from `m_tapel` order by thnajaran DESC");
if ($aksi == 'tambah')
{
	?>
	<h2>Tambah Kegiatan</h2>
	<form method="post" action="<?php echo base_url(); ?>index.php/<?php echo $tugase;?>/bpk/<?php echo $id;?>">
	<table cellspacing="5">
	<?php

	echo '<tr><td >Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
	<tr><td>Tahun Pelajaran</td><td>:</td><td>
	<select name="thnajaran" class="textfield-option">';
	if (empty($thnajaran))
		{
		$thnajaran = cari_thnajaran();
		}

	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></td></tr><tr><td>Semester</td><td>:</td><td>
	<select name="semester" class="textfield-option">';
	echo "<option value='".$semester."'>".$semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></td></tr>';
	$postedhari= date('d');
	$postedbulan= date('m');
	$postedtahun= date('Y');

	echo '<tr><td>Tanggal</td><td>: </td><td>';
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
	echo '</select></td></tr>';
	echo '<tr><td>Nama Kegiatan</td><td align="top">:</td><td><input type="text" name="namakegiatan" class="textfield" size="50"> </td></tr>
<tr><td>Tempat</td><td align="top">:</td><td><input type="text" name="tempat" class="textfield" size="50"> </td></tr>
<tr><td>Waktu/pukul</td><td align="top">:</td><td><input type="text" name="waktu" class="textfield" size="50"> </td></tr>
<tr><td>Keterangan</td><td align="top">:</td><td><input type="text" name="keterangan" class="textfield" size="50"> </td></tr>
<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah"><a href="'.base_url().'index.php/'.$tugase.'/bpk/'.$id.'"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="tambah_data" class="textfield" size="30"></td></tr>
</table>';
}

if ($aksi == 'ubah')
{
echo '<h2>Ubah Kegiatan</h2>';
?><form method="post" action="<?php echo base_url(); ?>index.php/<?php echo $tugase;?>/bpk/<?php echo $id;?>">
<?php
$tb = $this->db->query("SELECT * FROM `kalab_harian` where kodeguru='$kodeguru' and id_kalab_harian='$id_proker'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
		
 echo '<table cellspacing="5"><tr><td >Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
	<tr><td>Tahun Pelajaran</td><td>:</td><td>
	<select name="thnajaran" class="textfield-option">';
	echo "<option value='".$b->thnajaran."'>".$b->thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></td></tr><tr><td>Semester</td><td>:</td><td>
	<select name="semester" class="textfield-option">';
	echo "<option value='".$b->semester."'>".$b->semester."</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></td></tr>';
	$postedhari= substr($b->tanggal,8,2);
	$postedbulan= substr($b->tanggal,5,2);
	$postedtahun= substr($b->tanggal,0,4);

	echo '<tr><td>Tanggal</td><td>: </td><td>';
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
	echo '</select></td></tr>';
	echo '<tr><td>Nama Kegiatan</td><td align="top">:</td><td><input type="text" name="namakegiatan" class="textfield" size="50" value="'.$b->namakegiatan.'"> </td></tr>
<tr><td>Tempat</td><td align="top">:</td><td><input type="text" name="tempat" class="textfield" size="50" value="'.$b->tempat.'"> </td></tr>
<tr><td>Waktu/pukul</td><td align="top">:</td><td><input type="text" name="waktu" class="textfield" size="50" value="'.$b->waktu.'"> </td></tr>
<tr><td>Keterangan</td><td align="top">:</td><td><input type="text" name="keterangan" class="textfield" size="50" value="'.$b->keterangan.'"> </td></tr>

<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah"><a href="'.base_url().'index.php/'.$tugase.'/bpk/'.$id.'"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="id_kalab_harian" value="'.$id_proker.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="ubah_data" class="textfield" size="30"></td></tr>
</table>';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah

echo '</form></div>';
?>
