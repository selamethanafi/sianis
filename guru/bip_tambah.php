<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: bip_tambah.php
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
jQuery(function($){
$("#tanggalpemberitahuan").mask("99-99-9999")
$("#tanggalulangan").mask("99-99-9999")
$("#tanggalanalisis").mask("99-99-9999")
});
</script>
<div class="container-fluid">
<?php 

if ($aksi == 'tambah')
{
	?>
	<h2>Tambah Informasi Penilaian </h2>
	<form method="post" action="<?php echo base_url(); ?>index.php/guru/bip/tampil/">
	<table>
	<?php
	echo '<tr><td >Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
	<tr><td>Tahun Pelajaran</td><td>:</td><td>
	<select name="thnajaran" class="textfield-option">';
	if (empty($thnajaran))
		{
		$thnajaran = cari_thnajaran();
		}
	if (empty($semester))
		{
		$semester = cari_semester();
		}

	echo "<option value='".$thnajaran."'>".$thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></td></tr><tr><td>Semester</td><td>:</td><td>';
	echo '<select name="semester" class="textfield-option">';
	echo '<option value="'.$semester.'">'.$semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '</select></td></tr>';
	$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
	echo '<tr><td>Mata Pelajaran</td><td>:</td><td><select name="mapel" class="textfield-option">';
	echo '<option value="">Pilih Mapel</option>';
	foreach ($ta->result() as $a)
	{
		echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
	}
	echo '</select></td></tr>';
	$td = $this->db->query("select * from m_ruang where status='1' order by ruang");
	echo '<tr><td>Kelas</td><td>:</td><td><select name="kelas" class="textfield-option">';
	foreach($td->result() as $d)
		{
		echo '<option value="'.$d->ruang.'">'.$d->ruang.'</option>';
		}
	echo '</select></td></tr>';

	if (empty($tanggalbip))
		{
		$tanggalhariini = tanggal(tanggal_hari_ini());
		}
	echo '<tr><td>Tanggal Pemberitahuan</td><td>: </td><td>';
	echo '<input type text name="tanggalhadir" id="tanggalpemberitahuan" value="'.$tanggalhariini.'"></td></tr>
	<tr><td>Tanggal Ulangan</td><td>: </td><td><input type text name="tanggalulangan" id="tanggalulangan" value="'.$tanggalhariini.'"></td></tr>
	<tr><td>Tanggal Rencana Analisis</td><td>: </td><td>';
	echo '<input type text name="tanggalanalisis" id="tanggalanalisis" value="'.$tanggalhariini.'">
</td></tr>

<tr><td>Jenis Ulangan</td><td align="top">:</td><td><select name="jenisulangan" class="textfield-option">
<option value="uh1">uh1<option>
<option value="uh2">uh2<option>
<option value="uh3">uh3<option>
<option value="uh4">uh4<option>
<option value="mid">mid<option>
<option value="uas">uas<option>
</select></td></tr>
<tr><td>Standar Kompetensi / Kompetensi Dasar / Materi </td><td>:</td><td><textarea name="skkdmateri" rows="15" cols="80" class="textfield"></textarea></td></tr>
<tr><td>Isi Informasi</td><td>:</td><td><textarea name="isiinformasi" rows="15" cols="80" class="textfield" ></textarea></td></tr>
<tr><td>Penerima Informasi</td><td>:</td><td><textarea name="penerima" rows="15" cols="80" class="textfield"></textarea></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah"><a href="'.base_url().'index.php/guru/bip/tampil"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="tambah_data" class="textfield" size="30"></td></tr>
</table>';
}

if ($aksi == 'ubah')
{
echo '<h2>Ubah Informasi Penilaian</h2>';
?><form method="post" action="<?php echo base_url(); ?>index.php/guru/bip/tampil/">
<?php
$tb = $this->db->query("SELECT * FROM `guru_bip` where kodeguru='$kodeguru' and id_guru_bip='$id_guru_bip'");
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
	echo '</select></td></tr><tr><td>Semester</td><td>:</td><td>';
	echo '<select name="semester" class="textfield-option">';
	echo '<option value="'.$b->semester.'">'.$b->semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '</select></td></tr>';
	$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
	echo '<tr><td>Mata Pelajaran</td><td>:</td><td><select name="mapel" class="textfield-option">';
	echo '<option value="'.$b->mapel.'">'.$b->mapel.'</option>';
	foreach ($ta->result() as $a)
	{
		echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
	}
	echo '</select></td></tr>';
	$td = $this->db->query("select * from m_ruang where status='1' order by ruang");
	echo '<tr><td>Kelas</td><td>:</td><td><select name="kelas" class="textfield-option">';
		echo '<option value="'.$b->kelas.'">'.$b->kelas.'</option>';
	foreach($td->result() as $d)
		{
		echo '<option value="'.$d->ruang.'">'.$d->ruang.'</option>';
		}
	echo '</select></td></tr>';
	$tanggalpemberitahuan = tanggal($b->tanggal);
	$tanggalulangan = tanggal($b->tanggal_ulangan);
	$tanggalanalisis = tanggal($b->tanggal_analisis);
	echo '<tr><td>Tanggal Pemberitahuan</td><td>: </td><td>';
	echo '<input type text name="tanggalhadir" id="tanggalpemberitahuan" value="'.$tanggalpemberitahuan.'"></td></tr>
	<tr><td>Tanggal Ulangan</td><td>: </td><td><input type text name="tanggalulangan" id="tanggalulangan" value="'.$tanggalulangan.'"></td></tr>
	<tr><td>Tanggal Rencana Analisis</td><td>: </td><td>';
	echo '<input type text name="tanggalanalisis" id="tanggalanalisis" value="'.$tanggalanalisis.'">
</td></tr>
<tr><td>Jenis Ulangan</td><td align="top">:</td><td><select name="jenisulangan" class="textfield-option">
<option value="'.$b->jenisulangan.'">'.$b->jenisulangan.'<option>
<option value="uh1">uh1<option>
<option value="uh2">uh2<option>
<option value="uh3">uh3<option>
<option value="uh4">uh4<option>
<option value="mid">mid<option>
<option value="uas">uas<option>
</select></td></tr>
<tr><td>Standar Kompetensi / Kompetensi Dasar / Materi </td><td>:</td><td><textarea name="skkdmateri" rows="15" cols="80" class="textfield">'.$b->skkdmateri.'</textarea></td></tr>
<tr><td>Isi Informasi</td><td>:</td><td><textarea name="isiinformasi" rows="15" cols="80" class="textfield">'.$b->isiinformasi.'</textarea></td></tr>
<tr><td>Penerima Informasi</td><td>:</td><td><textarea name="penerima" rows="15" cols="80" class="textfield">'.$b->penerima.'</textarea></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah"><a href="'.base_url().'index.php/guru/bip/tampil"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="id_guru_bip" value="'.$id_guru_bip.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="ubah_data" class="textfield" size="30"></td></tr>
</table>';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah

if ($aksi == 'salin')
{
echo '<h2>Salin bip</h2>';
?><form method="post" action="<?php echo base_url(); ?>index.php/guru/bip/salin/">
<?php
if (empty($id_guru_bip))
	{
	echo '<table cellspacing="5"><tr><td>Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
<tr><td>Informasi yang disalin</td><td>:</td><td>';
	$tc = $this->db->query("SELECT * FROM `guru_bip` where kodeguru='$kodeguru' order by tanggal DESC");
	echo '<select name="id_kopi">';
	foreach ($tc->result() as $c)
		{
		echo '<option value="'.$c->id_guru_bip.'">'.$c->kelas.' '.substr(strip_tags($c->isiinformasi),0,200).'</option>';
		}
	echo '</select></td></tr>
<tr><td></td><td></td><td><input type="hidden" name="post_aksi" value="salin_data" class="textfield" size="30"><input type="submit" value="Lanjut" class="tombol-merah"><a href="'.base_url().'index.php/guru/bip/tampil"><b>Batal</b></a></td></tr></table>';
	}
$tb = $this->db->query("SELECT * FROM `guru_bip` where kodeguru='$kodeguru' and id_guru_bip='$id_guru_bip'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
 echo '<table cellspacing="5"><tr><td>Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
	<tr><td>Tahun Pelajaran</td><td>:</td><td>
	<select name="thnajaran" class="textfield-option">';
	echo "<option value='".$b->thnajaran."'>".$b->thnajaran."</option>";
	foreach($daftar_tapel->result_array() as $k)
	{
	echo "<option value='".$k["thnajaran"]."'>".$k["thnajaran"]."</option>";
	}
	echo '</select></td></tr><tr><td>Semester</td><td>:</td><td>';
	echo '<select name="semester" class="textfield-option">';
	echo '<option value="'.$b->semester.'">'.$b->semester.'</option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '</select></td></tr>';
	$ta = $this->db->query("SELECT * FROM `tblkategoritutorial` order by nama_kategori");
	echo '<tr><td>Mata Pelajaran</td><td>:</td><td><select name="mapel" class="textfield-option">';
	echo '<option value="'.$b->mapel.'">'.$b->mapel.'</option>';
	foreach ($ta->result() as $a)
	{
		echo '<option value="'.$a->nama_kategori.'">'.$a->nama_kategori.'</option>';
	}
	echo '</select></td></tr>';
	$td = $this->db->query("select * from m_ruang where status='1' order by ruang");
	echo '<tr><td>Kelas</td><td>:</td><td><select name="kelas" class="textfield-option">';
		echo '<option value="'.$b->kelas.'">'.$b->kelas.'</option>';
	foreach($td->result() as $d)
		{
		echo '<option value="'.$d->ruang.'">'.$d->ruang.'</option>';
		}
	echo '</select></td></tr>';
	$tanggalpemberitahuan = tanggal($b->tanggal);
	$tanggalulangan = tanggal($b->tanggal_ulangan);
	$tanggalanalisis = tanggal($b->tanggal_analisis);
	echo '<tr><td>Tanggal Pemberitahuan</td><td>: </td><td>';
	echo '<input type text name="tanggalhadir" id="tanggalpemberitahuan" value="'.$tanggalpemberitahuan.'"></td></tr>
	<tr><td>Tanggal Ulangan</td><td>: </td><td><input type text name="tanggalulangan" id="tanggalulangan" value="'.$tanggalulangan.'"></td></tr>
	<tr><td>Tanggal Rencana Analisis</td><td>: </td><td>';
	echo '<input type text name="tanggalanalisis" id="tanggalanalisis" value="'.$tanggalanalisis.'">
</td></tr>
<tr><td>Jenis Ulangan</td><td align="top">:</td><td><select name="jenisulangan" class="textfield-option">
<option value="'.$b->jenisulangan.'">'.$b->jenisulangan.'<option>
<option value="uh1">uh1<option>
<option value="uh2">uh2<option>
<option value="uh3">uh3<option>
<option value="uh4">uh4<option>
<option value="mid">mid<option>
<option value="uas">uas<option>
</select></td></tr>
<tr><td>Standar Kompetensi / Kompetensi Dasar / Materi </td><td>:</td><td><textarea name="skkdmateri" rows="15" cols="80" class="textfield">'.$b->skkdmateri.'</textarea></td></tr>
<tr><td>Isi Informasi</td><td>:</td><td><textarea name="isiinformasi" rows="15" cols="80" class="textfield">'.$b->isiinformasi.'</textarea></td></tr>
<tr><td>Penerima Informasi</td><td>:</td><td><textarea name="penerima" rows="15" cols="80" class="textfield">'.$b->penerima.'</textarea></td></tr>

<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah"><a href="'.base_url().'index.php/guru/bip/tampil"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="tambah_data" class="textfield" size="30"></td></tr>
</table>';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah
echo '</form></div>';
?>
