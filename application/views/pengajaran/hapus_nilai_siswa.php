<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Kam 12 Peb 2015 11:05:21 WIB 
// Nama Berkas 		: cek_blanko_nilai.php
// Lokasi      		: application/views/pengajaran/
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
<div class="container-fluid"><h3><?php echo $judulhalaman;?></h3>
<?php echo form_open('pengajaran/hapusnilaisiswa');
$kelas ='';
echo '<table class="table">';
if (!empty($namasiswa))
	{
	echo '<tr><td>Penggalan Nama Siswa</td><td>
<input type="hidden" name="namasiswa" value="'.$namasiswa.'" class="form-control">'.$namasiswa.'</td></tr>';
	}
if (!empty($nis))
	{
	echo '<tr><td>NIS</td><td>
<input type="hidden" name="nis" value="'.$nis.'" class="form-control">'.$nis.' '.nis_ke_nama($nis).'</td></tr>';
	}
if (!empty($thnajaran))
	{
	echo '<tr><td>Tahun Pelajaran</td><td>
<input type="hidden" name="thnajaran" value="'.$thnajaran.'" class="form-control">'.$thnajaran.'</td></tr>';
	}
if (!empty($semester))
	{
	echo '<tr><td>Semester</td><td>
<input type="hidden" name="semester" value="'.$semester.'" class="form-control">'.$semester.'</td></tr>';
	}
if (!empty($mapel))
	{
	echo '<tr><td>Mata pelajaran</td><td>
<input type="hidden" name="mapel" value="'.$mapel.'" class="form-control">'.$mapel.'</td></tr>';
	}
if (!empty($konfirmasi))
	{
	echo '<tr><td>Konfirmasi</td><td>
<input type="hidden" name="konfirmasi" value="'.$konfirmasi.'" class="form-control">'.$konfirmasi.'</td></tr>';
	}

if (empty($namasiswa))
{
	echo '<tr><td>Cari Nama Siswa</td><td>
<input type="text" name="namasiswa" class="form-control"></td></tr>';
}
else if (empty($nis))
{
	
	$ta = $this->db->query("select * from `datsis` where `nama` like '%$namasiswa%' and ket='Y'");
	echo '<tr><td>Pilih Siswa </td><td>
	<select name="nis" class="form-control">';

	if ($ta->num_rows() > 0)
	{
		foreach($ta->result() as $a)
		{
		echo '<option value="'.$a->nis.'">'.$a->nama.'</option>';
		}

	}
	else
	{
		echo '<option value="">Penggalan nama "'.$namasiswa.'" tidak ditemukan</option>';

	}
		echo '</select></td></tr>';	
}
else if ((empty($thnajaran)) or (empty($semester)) or (empty($mapel)))
{
	echo '	<tr><td>Tahun Pelajaran</td><td>
	<select name="thnajaran" class="form-control">';
	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></td></tr>
	<tr><td>Semester</td><td>
	<select name="semester" class="form-control">';
	echo "<option value=''></option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo '</select></td></tr>';
	$tb = $this->db->query("select * from `tblkategoritutorial` order by nama_kategori");
	echo '	<tr><td>Mata Pelajaran</td><td>
	<select name="mapel" class="form-control">';
	foreach($tb->result() as $b)
	{
	echo "<option value='".$b->nama_kategori."'>".$b->nama_kategori."</option>";
	}	
	echo '</select></td></tr>';
	
}
else if (empty($konfirmasi))
{
	echo '	<tr><td>Konfirmasi</td><td>
	<select name="konfirmasi" class="form-control">';
	echo '<option value="Tidak">Tidak</option>';
	echo '<option value="Ya">Ya</option>';
	echo '</select></td></tr>';
}
else
{
	$this->db->query("delete from `nilai` where  `thnajaran`='$thnajaran' and `semester`='$semester' and `nis`='$nis' and `mapel`='$mapel'");
	header('Location: '.base_url().'index.php/pengajaran/hapusnilaisiswa/berhasil');
	

}
echo '<tr><td></td><td><input type="submit" value="Proses" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'pengajaran/hapusnilaisiswa">Batal</a></td></tr>
</table></form><br>';
?>
</div>
