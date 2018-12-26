<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas : kalab_btlpk_ubah.php
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
<?php 
	$daftar_tapel = $this->db->query("select * from `m_tapel` order by thnajaran DESC");

if ($aksi == 'ubah')
{
echo '<h2>Ubah Analisis Pelaksanaan Kegiatan '.$namatugas.'</h2>';
?><form method="post" action="<?php echo base_url(); ?>index.php/<?php echo $tugase;?>/btlpk/<?php echo $id;?>">
<?php
$tb = $this->db->query("SELECT * FROM `kalab_harian` where kodeguru='$kodeguru' and id_kalab_harian='$id_proker'");
	if(count($tb->result())>0)
	{
		foreach($tb->result() as $b)
		{
		
 echo '<table cellspacing="5"><tr><td >Kode Guru</td><td>:</td><td>'.$kodeguru.'</td></tr>
	<tr><td>Tahun Pelajaran</td><td>:</td><td>'.$b->thnajaran.'</td></tr>';
	echo '<tr><td>Semester</td><td>: </td><td>'.$b->semester;
	echo '<tr><td>Tanggal</td><td>: </td><td>';
	echo ''.date_to_long_string($b->tanggal).'</td></tr>';
	echo '<tr><td>Nama Kegiatan</td><td align="top">:</td><td>'.$b->namakegiatan.'</td></tr>
<tr><td>Tempat</td><td align="top">:</td><td>'.$b->tempat.'</td></tr>
<tr><td>Waktu/pukul</td><td align="top">:</td><td>'.$b->waktu.'</td></tr>
<tr><td>Ketercapaian</td><td align="top">:</td><td>'.$b->persentase.'</td></tr>
<tr><td>Dukungan</td><td align="top">:</td><td>'.strip_tags($b->dukungan).'</td></tr>
<tr><td>Hambatan</td><td align="top">:</td><td>'.strip_tags($b->hambatan).'</td></tr>
<tr><td colspan="3">Solusi<textarea name="solusi" cols="85" rows="10" class="textfield">'.$b->solusi.'</textarea></td></tr>
<tr><td colspan="3">Keterangan<textarea name="keterangan_tindak_lanjut" cols="85" rows="10" class="textfield">'.$b->keterangan_tindak_lanjut.'</textarea></td></tr>
<tr><td></td><td></td><td><input type="submit" value="Simpan" class="tombol-merah">&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/'.$tugase.'/btlpk/'.$id.'"><b>Batal</b></a>
<input type="hidden" name="kodeguru" value="'.$kodeguru.'" class="textfield" size="30">
<input type="hidden" name="id_kalab_harian" value="'.$id_proker.'" class="textfield" size="30">
<input type="hidden" name="post_aksi" value="ubah_data" class="textfield" size="30"></td></tr>
</table>';
		} // data
	} //kalau ada / ditemukan

} // kalau ubah

echo '</form></div>';
?>
